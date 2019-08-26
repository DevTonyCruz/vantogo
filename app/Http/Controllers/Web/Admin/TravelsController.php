<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Travels;
use Illuminate\Database\QueryException;
use App\Models\Routes;
use App\Models\Cars;
use App\Models\Drivers;
use Carbon\Carbon;

class TravelsController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $travels = Travels::get();
        return view('admin.travels.index',["travels" => $travels]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Routes::all();
        $cars = Cars::all();
        $drivers = Drivers::all();

        return view('admin.travels.create', [
            "routes" => $routes,
            "cars" => $cars,
            "drivers" => $drivers,
        ]);
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
            'route_id' => 'required|numeric',
            'car_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'hour' => 'required|date_format:G:i:s',
            'date' => 'required|date_format:m/d/Y',
            'place' => 'required',
        ];

        $messages = [
            'code.required' => 'El campo código es requerido',
            'route_id.required' => 'El campo ruta es requerido',
            'route_id.numeric' => 'Debe seleccionar una ruta válida',
            'car_id.required' => 'El campo vehículo es requerido',
            'car_id.numeric' => 'Debe seleccionar un vehículo válido',
            'driver_id.required' => 'El campo chofer es requerido',
            'driver_id.numeric' => 'Debe seleccionar un chofer válida',
            'hour.required' => 'El campo hora de salida es requerido',
            'hour.date_format' => 'El campo hora de salida no es válido',
            'date.required' => 'El campo fecha de salida no es válido',
            'date.date_format' => 'El campo fecha de salida es requerido',
            'place.required' => 'El campo lugar de salida es requerido',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $travels = Travels::where('code', $request->code)->count();

            if ($travels == 0) {

                $travels = new Travels();
                $travels->code = $request->code;
                $travels->route_id = $request->route_id;
                $travels->car_id = $request->car_id;
                $travels->driver_id = $request->driver_id;
                $travels->hour = Carbon::parse($request->hour)->format('H:i');
                $travels->date = Carbon::parse($request->date)->format('Y-m-d');
                $travels->place = $request->place;

                if ($travels->save()) {

                    return redirect()->route('travels.index');
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
        $travel = Travels::where('id', $id)->first();
        return view('admin.travels.show', ["travel" => $travel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $routes = Routes::all();
        $cars = Cars::all();
        $drivers = Drivers::all();
        $travel = Travels::where('id', $id)->first();

        return view('admin.travels.edit', [
            "travel" => $travel,
            "routes" => $routes,
            "cars" => $cars,
            "drivers" => $drivers,
        ]);
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
            'route_id' => 'required|numeric',
            'car_id' => 'required|numeric',
            'driver_id' => 'required|numeric',
            'hour' => 'required|date_format:H:i:s',
            'date' => 'required|date_format:m/d/Y',
            'place' => 'required',
        ];

        $messages = [
            'code.required' => 'El campo código es requerido',
            'route_id.required' => 'El campo ruta es requerido',
            'route_id.numeric' => 'Debe seleccionar una ruta válida',
            'car_id.required' => 'El campo vehículo es requerido',
            'car_id.numeric' => 'Debe seleccionar un vehículo válido',
            'driver_id.required' => 'El campo chofer es requerido',
            'driver_id.numeric' => 'Debe seleccionar un chofer válida',
            'hour.required' => 'El campo hora de salida es requerido',
            'hour.date_format' => 'El campo hora de salida no es válido',
            'date.required' => 'El campo fecha de salida no es válido',
            'date.date_format' => 'El campo fecha de salida es requerido',
            'place.required' => 'El campo lugar de salida es requerido',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $travels = Travels::where('code', $request->code)->where('id', '<>', $id)->count();

            if ($travels == 0) {

                $travels = Travels::where('id', $id)->first();
                $travels->code = $request->code;
                $travels->route_id = $request->route_id;
                $travels->car_id = $request->car_id;
                $travels->driver_id = $request->driver_id;
                $travels->hour = Carbon::parse($request->hour)->format('H:i');
                $travels->date = Carbon::parse($request->date)->format('Y-m-d');
                $travels->place = $request->place;

                if ($travels->save()) {
                    return redirect()->route('travels.index');
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

            $travels = Travels::where('id', $id)->first();

            if ($travels) {

                if ($travels->delete()) {

                    return redirect()->route('travels.index');
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

            $travels = Travels::where('id', $id)->first();

            if ($travels) {

                if ($travels->status == 1) {
                    $travels->status = 0;
                } else {
                    $travels->status = 1;
                }

                if ($travels->save()) {

                    return redirect()->route('travels.index');
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
