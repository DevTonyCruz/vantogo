<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Drivers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use SebastianBergmann\CodeCoverage\Driver\Driver;

class DriversController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drivers = Drivers::get();
        return view('admin.drivers.index',["drivers" => $drivers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.drivers.create');
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
            'name' => 'required',
            'first_last_name' => 'required',
            'second_last_name' => 'required',
            'file_driver' => 'required|mimes:png,jpeg,jpg',
            'email' => 'required|email',
            'license' => 'required',
            'file_license' => 'required|mimes:png,jpeg,jpg',
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'first_last_name.required' => 'El campo apellido paterno es requerido',
            'second_last_name.required' => 'El campo apellido materno es requerido',
            'file_license.required' => 'El campo imagen del chofer es requerida',
            'file_license.mimes' => 'El campo imagen del chofer solo acepta los siguientes formatos; png, jpeg y jpg',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.email' => 'El campo correo electrónico no es válido',
            'license.required' => 'El campo licencia es requerida',
            'file_license.required' => 'El campo imagen de la licecia es requerido',
            'file_license.mimes' => 'El campo imagen de la licecia solo acepta los siguientes formatos; png, jpeg y jpg',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $driver = Drivers::where('license', $request->license)->count();

            if ($driver == 0) {

                $driver = new Drivers();
                $driver->name = $request->name;
                $driver->first_last_name = $request->first_last_name;
                $driver->second_last_name = $request->second_last_name;
                $driver->email = $request->email;
                $driver->phone = $request->phone;
                $driver->direction = $request->direction;
                $driver->license = $request->license;

                if ($driver->save()) {

                    if ($request->file('file_driver')) {
                        $path = Storage::disk('public')->put('images/storage/drivers/' . $driver->id, $request->file('file_driver'));
                        $driver->fill(['file_driver' => $path])->save();
                    }

                    if ($request->file('file_license')) {
                        $path = Storage::disk('public')->put('images/storage/drivers/' . $driver->id, $request->file('file_license'));
                        $driver->fill(['file_license' => $path])->save();
                    }

                    return redirect()->route('drivers.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            } else {
                return back()->with('status', 'Ya existe un registro con estos datos.')->withInput();
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
        $driver = Drivers::where('id', $id)->first();
        return view('admin.drivers.show', ["driver" => $driver]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = Drivers::where('id', $id)->first();
        return view('admin.drivers.edit', ["driver" => $driver]);
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
            'name' => 'required',
            'first_last_name' => 'required',
            'second_last_name' => 'required',
            'file_driver' => 'mimes:png,jpeg,jpg',
            'email' => 'required|email',
            'license' => 'required',
            'file_license' => 'mimes:png,jpeg,jpg',
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'first_last_name.required' => 'El campo apellido paterno es requerido',
            'second_last_name.required' => 'El campo apellido materno es requerido',
            'file_driver.mimes' => 'El campo imagen del chofer solo acepta los siguientes formatos; png, jpeg y jpg',
            'email.required' => 'El campo correo electrónico es requerido',
            'email.email' => 'El campo correo electrónico no es válido',
            'license.required' => 'El campo licencia es requerida',
            'file_license.mimes' => 'El campo imagen de la licecia solo acepta los siguientes formatos; png, jpeg y jpg',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $driver = Drivers::where('license', $request->license)->where('id', '<>', $id)->count();

            if ($driver == 0) {

                $driver = Drivers::where('id', $id)->first();
                $driver->name = $request->name;
                $driver->first_last_name = $request->first_last_name;
                $driver->second_last_name = $request->second_last_name;
                $driver->email = $request->email;
                $driver->phone = $request->phone;
                $driver->direction = $request->direction;
                $driver->license = $request->license;

                if ($driver->save()) {

                    if ($request->file('file_driver')) {

                        if (@getimagesize(asset($driver->file_driver))) {
                            unlink($driver->file_driver);
                        }

                        $path = Storage::disk('public')->put('images/storage/drivers/' . $driver->id, $request->file('file_driver'));
                        $driver->fill(['file_driver' => $path])->save();
                    }

                    if ($request->file('file_license')) {

                        if (@getimagesize(asset($driver->file_license))) {
                            unlink($driver->file_license);
                        }

                        $path = Storage::disk('public')->put('images/storage/drivers/' . $driver->id, $request->file('file_license'));
                        $driver->fill(['file_license' => $path])->save();
                    }

                    return redirect()->route('drivers.index');
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

            $driver = Drivers::where('id', $id)->first();

            if ($driver) {

                if ($driver->delete()) {

                    return redirect()->route('drivers.index');
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

            $driver = Drivers::where('id', $id)->first();

            if ($driver) {

                if ($driver->status == 1) {
                    $driver->status = 0;
                } else {
                    $driver->status = 1;
                }

                if ($driver->save()) {

                    return redirect()->route('drivers.index');
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
