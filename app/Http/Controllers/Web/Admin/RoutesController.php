<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Routes;
use Illuminate\Database\QueryException;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Routes::get();
        return view('admin.routes.index',["routes" => $routes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.routes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'code' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'price' => 'required|numeric',
            'kilometer' => 'required|numeric',
            'hour' => 'required|numeric',
            'minutes' => 'required|numeric',
        ];

        $messages = [
            'code.required' => 'El campo código es requerido',
            'origin.required' => 'El campo origen es requerido',
            'destination.required' => 'El campo destino es requerido',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio no es válido',
            'kilometros.required' => 'El campo kilometros es requerido',
            'kilometer.numeric' => 'El campo kilometros no es válido',
            'hour.required' => 'El campo horas es requerido',
            'hour.numeric' => 'El campo horas no es válido',
            'minutes.required' => 'El campo minutos es requerido',
            'minutes.numeric' => 'El campo minutos no es válido'
        ];

        $this->validate($request, $rules, $messages);

        if($request->minutes >= 60){
            return back()
                ->withInput()
                ->withErrors(['minutes' => 'El campo minutos debe ser menor a 60']);;
        }

        try {

            $routes = Routes::where('code', $request->code)->count();

            if ($routes == 0) {

                $routes = new Routes();
                $routes->code = $request->code;
                $routes->origin = $request->origin;
                $routes->destination = $request->destination;
                $routes->price = $request->price;
                $routes->kilometer = $request->kilometer;
                $routes->hour = $request->hour;
                $routes->minute = $request->minutes;

                if ($routes->save()) {

                    return redirect()->route('routes.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            } else {
                return back()->with('status', 'Ya existe un registro con estos datos.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Routes::where('id', $id)->first();
        return view('admin.routes.show', ["route" => $route]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $route = Routes::where('id', $id)->first();
        return view('admin.routes.edit', ["route" => $route]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'code' => 'required',
            'origin' => 'required',
            'destination' => 'required',
            'price' => 'required|numeric',
            'kilometer' => 'required|numeric',
            'hour' => 'required|numeric',
            'minutes' => 'required|numeric',
        ];

        $messages = [
            'code.required' => 'El campo código es requerido',
            'origin.required' => 'El campo origen es requerido',
            'destination.required' => 'El campo destino es requerido',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio no es válido',
            'kilometros.required' => 'El campo kilometros es requerido',
            'kilometer.numeric' => 'El campo kilometros no es válido',
            'hour.required' => 'El campo horas es requerido',
            'hour.numeric' => 'El campo horas no es válido',
            'minutes.required' => 'El campo minutos es requerido',
            'minutes.numeric' => 'El campo minutos no es válido'
        ];

        $this->validate($request, $rules, $messages);

        if($request->minute >= 60){
            return back()
                ->withInput()
                ->withErrors(['minutes' => 'El campo minutos debe ser menor a 60']);;
        }

        try {

            $routes = Routes::where('code', $request->code)->where('id', '<>', $id)->count();

            if ($routes == 0) {

                $routes = Routes::where('id', $id)->first();
                $routes->code = $request->code;
                $routes->origin = $request->origin;
                $routes->destination = $request->destination;
                $routes->price = $request->price;
                $routes->kilometer = $request->kilometer;
                $routes->hour = $request->hour;
                $routes->minute = $request->minutes;

                if ($routes->save()) {
                    return redirect()->route('routes.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            } else {
                return back()->with('status', 'Ya existe un registro con estos datos.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {

            $routes = Routes::where('id', $id)->first();

            if ($routes) {

                if ($routes->delete()) {

                    return redirect()->route('routes.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

            } else {
                return back()->with('status', 'El registro que desea eliminar no existe.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {

            $routes = Routes::where('id', $id)->first();

            if ($routes) {

                if ($routes->status == 1) {
                    $routes->status = 0;
                } else {
                    $routes->status = 1;
                }

                if ($routes->save()) {

                    return redirect()->route('routes.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            } else {
                return back()->with('status', 'El registro al que desea cambiar el estatus no existe.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }
}
