<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Pages;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = Pages::get();
        return view('admin.pages.index', ["pages" => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create');
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
            'slug' => 'required',
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo tema es requerido',
            'slug.required' => 'El campo tema es requerido',
            'content.required' => 'El campo tema es requerido',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $page = new Pages();
            $page->name = $request->name;
            $page->slug = $request->slug;
            $page->content = $request->content;

            if($page->save()){

                return redirect()->route('pages.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

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
        $page = Pages::where('id', $id)->first();
        return view('admin.pages.show', ["page" => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Pages::where('id', $id)->first();
        return view('admin.pages.edit', ["page" => $page]);
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
            'content' => 'required',
        ];

        $messages = [
            'name.required' => 'El campo titulo es requerido',
            'content.required' => 'El campo contenido es requerido',
        ];

        $this->validate($request, $rules, $messages);

        $wyswyg = strip_tags(str_replace(' ', '', $request->content));

        if($wyswyg == ''){
            return back()
                ->withInput()
                ->withErrors(['content' => 'El campo contenido no contiene información válida']);;
        }

        try {
            
            $page = Pages::where('name', $request->name)->where('id', '<>', $id)->count();

            if($page == 0){
                $page = Pages::where('id', $id)->first();
    
                $page->name = $request->name;
                $page->slug = str_replace(' ', '-', strtolower($request->name));
                $page->content = $request->content;
    
                if($page->save()){
    
                    return redirect()->route('pages.index');
                }
    
                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            }else{
    
                return back()
                ->withInput()
                ->withErrors(['name' => 'Ya existe una página con este nombre.']);

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

        $page = Pages::where('id', $id)->first();

        if($page->delete()){

            return redirect()->route('pages.index');
        }

        return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');
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

            $page = Pages::where('id', $id)->first();

            if ($page->status == 1) {
                $page->status = 0;
            } else {
                $page->status = 1;
            }

            if($page->save()){

                return redirect()->route('pages.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
