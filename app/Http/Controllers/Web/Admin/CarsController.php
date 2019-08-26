<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cars;
use Illuminate\Database\QueryException;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Cars::get();
        return view('admin.cars.index',["cars" => $cars]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cars.create');
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
            'brand' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'capacity' => 'required|numeric',
        ];

        $messages = [
            'brand.required' => 'El campo marca es requerido',
            'model.required' => 'El campo modelo es requerido',
            'registration.required' => 'El campo placas es requerido',
            'capacity.required' => 'El campo asientos es requerido',
            'capacity.numeric' => 'El campo asientos no es válido'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $cars = Cars::where('registration', $request->registration)->count();

            if ($cars == 0) {

                $cars = new Cars();
                $cars->brand = $request->brand;
                $cars->model = $request->model;
                $cars->color = $request->color;
                $cars->registration = $request->registration;
                $cars->capacity = $request->capacity;

                if ($cars->save()) {

                    return redirect()->route('cars.index');
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
        $car = Cars::where('id', $id)->first();
        return view('admin.cars.show', ["car" => $car]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $car = Cars::where('id', $id)->first();
        return view('admin.cars.edit', ["car" => $car]);
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
            'brand' => 'required',
            'model' => 'required',
            'registration' => 'required',
            'capacity' => 'required|numeric',
        ];

        $messages = [
            'brand.required' => 'El campo marca es requerido',
            'model.required' => 'El campo modelo es requerido',
            'registration.required' => 'El campo placas es requerido',
            'capacity.required' => 'El campo asientos es requerido',
            'capacity.numeric' => 'El campo asientos no es válido'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $cars = Cars::where('registration', $request->registration)->where('id', '<>', $id)->count();

            if ($cars == 0) {

                $cars = Cars::where('id', $id)->first();
                $cars->brand = $request->brand;
                $cars->model = $request->model;
                $cars->color = $request->color;
                $cars->registration = $request->registration;
                $cars->capacity = $request->capacity;

                if ($cars->save()) {
                    return redirect()->route('cars.index');
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

            $cars = Cars::where('id', $id)->first();

            if ($cars) {

                if ($cars->delete()) {

                    return redirect()->route('cars.index');
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

            $cars = Cars::where('id', $id)->first();

            if ($cars) {

                if ($cars->status == 1) {
                    $cars->status = 0;
                } else {
                    $cars->status = 1;
                }

                if ($cars->save()) {

                    return redirect()->route('cars.index');
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
