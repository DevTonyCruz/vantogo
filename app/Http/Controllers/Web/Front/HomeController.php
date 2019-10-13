<?php

namespace App\Http\Controllers\Web\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Routes;
use App\Models\Travels;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $origin = Routes::groupBy('origin')->get();
        $destination = Routes::groupBy('destination')->get();
        return view('front.home.index', [
            'origin' => $origin,
            'destination' => $destination
        ]);
    }

    public function viaje(Request $request)
    {
        $rules = [
            'origen' => 'required',
            'destino' => 'required',
            'date' => 'required|date_format:m/d/Y',
            'destino' => 'required',
            'pasajeros' => 'required|numeric|min:1',
        ];

        $messages = [
            'origen.required' => 'Debe seleccionar el origen del viaje.',
            'destino.required' => 'Debe seleccionar el destino del viaje.',
            'destino.date' => 'Debe seleccionar la fecha del viaje.',
            'destino.date_format' => 'El formato de la fecha no es válido.',
            'pasajeros.required' => 'Debe seleccionar la cantidad de pasajeros.',
            'pasajeros.numeric' => 'El campo total de pasajeros debe ser numérico.',
            'pasajeros.min' => [
                'numeric' => 'El campo :attribute debe ser al menos :min.',
            ]
        ];

        $this->validate($request, $rules, $messages);

        if ($request->origen == $request->destino) {
            return back()->with('warning', 'El origen debe ser distinto al destino del viaje.')->withInput();
        }

        $route = Routes::where('origin', $request->origen)
            ->where('destination', $request->destino)
            ->first();

        if ($route) {

            $date = Carbon::parse($request->date)->format('Y-m-d');
            $travels = Travels::where('route_id', $route->id)
                ->where('date', $date)->get();

            if (!is_null($travels->first())) {

                $request->session()->forget('vantogo');
                $request->session()->flush();
                $request->session()->get('vantogo');
                $request->session()->put('vantogo.pasajeros', []);
                $request->session()->push('vantogo.cantidad', $request->pasajeros);

                return view('front.home.result', [
                    'travels' => $travels
                ]);
            } else {
                return back()->with('warning', 'Por el momento no contamos con salidas para la fecha solicitada.')->withInput();
            }
        } else {
            return back()->with('warning', 'Por el momento no contamos con salidas para el origen y destino solicitado.')->withInput();
        }
    }

    public function asientos(Request $request)
    {
        if (!$request->session()->has('vantogo')) {
            return redirect('pago');
        }

        $cantidad = $request->session()->get('vantogo.cantidad')[0];
        $pasajeros = count($request->session()->get('vantogo.pasajeros'));
        $session = $request->session()->get('vantogo');
        $travel = Travels::where('code', $request->viaje_seleccionado)->first();

        if ($cantidad == $pasajeros) {

            return redirect('/pago');
        }

        return view('front.home.asientos', [
            'travel' => $travel,
            'session' => $session
        ]);
    }

    public function pasajeros(Request $request)
    {
        $cantidad = $request->session()->get('vantogo.cantidad')[0];
        $pasajeros = count($request->session()->get('vantogo.pasajeros'));

        $session = $request->session()->get('vantogo');
        $travel = Travels::where('id', $request->travel_id)->first();

        if ($cantidad == $pasajeros) {

            return view('front.home.pago', [
                'session' => $session,
                'travel' => $travel
            ]);
        }

        $rules = [
            'asiento' => 'required|numeric|min:1',
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'travel_id' => 'required|numeric|min:1',
        ];

        $messages = [
            'asiento.required' => 'Debe seleccionar un asiento disponible.',
            'asiento.numeric' => 'El asiento que seleccionó no es válido.',
            'asiento.min' => [
                'numeric' => 'El asiento seleccionado debe ser diferente de cero',
            ],
            'name.required' => 'Debe agregar el nombre del pasajero.',
            'email.required' => 'Debe agregar un correo electrónico.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'phone.required' => 'Debe agregar un teléfono.',
            'travel_id.required' => 'Por el momento la ruta seleccionada no esta disponible. ERR: 01',
            'travel_id.numeric' => 'Por el momento la ruta seleccionada no esta disponible. ERR: 02',
            'travel_id.min' => [
                'numeric' => 'Por el momento la ruta seleccionada no esta disponible. ERR: 03',
            ]
        ];

        $this->validate($request, $rules, $messages);

        if ($request->session()->has('vantogo')) {

            if (!$request->session()->has('vantogo.viaje')) {
                $request->session()->push('vantogo.viaje', $request->travel_id);
            }
            $request->session()->push('vantogo.pasajeros', [
                "asiento" => $request->asiento,
                "name" => $request->name,
                "email" => $request->email,
                "phone" => $request->phone,
            ]);
        } else {
            $request->session()->get('vantogo');
        }

        $pasajeros = count($request->session()->get('vantogo.pasajeros'));

        if ($cantidad == $pasajeros) {

            return redirect('/pago');
        } else {

            return redirect('/asientos?viaje_seleccionado=' . $travel->code);
        }
    }

    public function pago(Request $request)
    {
        $session = $request->session()->get('vantogo');
        $travel = Travels::where('id', $session['viaje'][0])->first();

        return view('front.home.pago', [
            'session' => $session,
            'travel' => $travel
        ]);
    }
}
