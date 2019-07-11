<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use App\Models\Configurations;

class ConfigurationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $configurations = Configurations::get();
        return view('admin.configurations.index', ['configurations' => $configurations]);
    }

    /**
     * Show the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $configuration = Configurations::where('id', $id)->first();
        return view('admin.configurations.show', ["configuration" => $configuration]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $configuration = Configurations::where('id', $id)->first();
        return view('admin.configurations.edit', ["configuration" => $configuration]);
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
            'value' => 'required|max:255',
        ];

        $messages = [
            'value.required' => 'El campo valor es requerido',
            'value.max:255' => 'El campo valor solo permite 255 caracteres',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $configuration = Configurations::where('id', $id)->first();

            $configuration->value = $request->value;

            if($configuration->save()){

                return redirect()->route('configuration.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status($id)
    {
        try {

            $configuration = Configurations::where('id', $id)->first();

            if ($configuration->status == 1) {
                $configuration->status = 0;
            } else {
                $configuration->status = 1;
            }

            if($configuration->save()){

                return redirect()->route('configuration.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
