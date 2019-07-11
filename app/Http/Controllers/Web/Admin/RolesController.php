<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Roles;
use Illuminate\Database\QueryException;
use App\Models\Permissions;
use App\Models\Relation_rol_permission;
use App\User;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::get();
        //return view('admin.roles.index-server');
        return view('admin.roles.index', ["roles" => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|max:255',
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $rol = Roles::where('name', $request->name)->first();

            if ($rol) {
                return back()->withErrors(['name' => 'Ya existe un rol con este nombre.']);
            } else {
                $rol = new Roles;

                $rol->name = $request->name;
                $rol->description = $request->description;

                $rol->save();

                return redirect()->route('roles.index');
            }
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
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
        $rol = Roles::where('id', $id)->first();
        return view('admin.roles.show', ["rol" => $rol]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Roles::where('id', $id)->first();
        return view('admin.roles.edit', ["rol" => $rol]);
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
            'name' => 'required|max:255',
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $rol = Roles::where('name', $request->name)->where('id', '<>', $id)->first();

            if ($rol) {
                return back()->withErrors(['name' => 'Ya existe un rol con este nombre.']);
            } else {
                $rol = Roles::where('id', $id)->first();

                $rol->name = $request->name;
                $rol->description = $request->description;

                $rol->save();

                return redirect()->route('roles.index');
            }
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
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

            $users = User::where('rol_id', $id)->count();

            if($users == 0){

                $rol = Roles::where('id', '<>', $id)->first();

                if ($rol) {
                    $rol = Roles::where('id', $id)->first();

                    if($rol->delete()){
                        return redirect()->route('roles.index');
                    }else{
                        return back()->with('status', 'No se puede eliminar este usuario.');
                    }

                } else {
                    return back()->with('status', 'No existe el usuario que desea eliminar.');
                }

            }else{
                return back()->with('status', 'No puede elimiar un rol que tenga usuarios relacionadas.');
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

            $users = User::where('rol_id', $id)->count();

            if($users == 0){

                $rol = Roles::where('id', '<>', $id)->first();

                if ($rol) {
                    $rol = Roles::where('id', $id)->first();

                    if ($rol->status == 1) {
                        $rol->status = 0;
                    } else {
                        $rol->status = 1;
                    }

                    $rol->save();

                    return redirect()->route('roles.index');
                } else {
                    return back()->with('status', 'No se puede cambiar el estatus de este usuario.');
                }

            }else{
                return back()->with('status', 'No puede desactivar un rol que tenga usuarios relacionadas.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }

    /**
     * view permission the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function permission($id)
    {
        $permissions = Permissions::get();

        $permisos = ['grupos' => [], 'permisos' => [], 'relacion' => []];

        foreach ($permissions as $permission) {
            if (!in_array($permission->controller, $permisos["grupos"])) {
                array_push($permisos["grupos"], $permission->controller);
            }
        }

        $relacion = Relation_rol_permission::where('rol_id', $id)->pluck('permission_id');
        if($relacion){
            $permisos["relacion"] = $relacion->toArray();
        }

        $permisos["permisos"] = $permissions->toArray();

        return view('admin.roles.permission', ['permisos' => $permisos, 'id' => $id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function save_permission(Request $request, $id)
    {
        $array = request()->all();

        Relation_rol_permission::where('rol_id', $id)->delete();

        try {

            foreach ($array as $permisos) {
                if (is_array($permisos)) {
                    foreach ($permisos as $permiso) {

                        $addPermiso = new Relation_rol_permission();

                        $addPermiso->rol_id = $id;
                        $addPermiso->permission_id = $permiso;

                        $addPermiso->save();
                    }
                }
            }

            return redirect()->route('roles.index');
        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
