<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banners;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;

class BannersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banners::latest()->paginate(10);
        return view('admin.banners.index', ["banners" => $banners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [];
        $messages = [];
        if($request->type == 'image'){            

            $wyswyg = strip_tags(str_replace(' ', '', $request->content));

            if($wyswyg == ''){
                return back()
                    ->withInput()
                    ->withErrors(['content' => 'El campo contenido no contiene información válida']);;
            }
            
            $rules = [
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'file' => 'required|mimes:png,jpeg,jpg',
                'button_text' => 'required',
                'url_button' => 'required|url',
                'position' => 'required'
            ];
    
            $messages = [
                'title.required' => 'El campo titulo es requerido',
                'title.max' => 'El campo titulo solo permite 255 caracteres',
                'subtitle.required' => 'El campo subtitulo es requerido',
                'subtitle.max' => 'El campo subtitulo solo permite 255 caracteres',
                'file.required' => 'El campo imagen es requerido',
                'file.mimes' => 'El campo imagen solo acepta los siguientes formatos; png, jpeg y jpg',
                'button_text.required' => 'El campo texto del botón es requerido',
                'url_button.required' => 'El campo enlace del botón es requerido',
                'url_button.url' => 'El campo enlace del botón no contiene una url válida',
                'position.required' => 'El campo posición es requerido',
            ];
        }

        if($request->type == 'video'){
            $rules = [
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'video_link' => 'required|url',
            ];
    
            $messages = [
                'title.required' => 'El campo titulo es requerido',
                'title.max' => 'El campo titulo solo permite 255 caracteres',
                'subtitle.required' => 'El campo subtitulo es requerido',
                'subtitle.max' => 'El campo subtitulo solo permite 255 caracteres',
                'video_link.required' => 'El campo enlace del video es requerido',
                'video_link.url' => 'El campo enlace del video no contiene una url válida',
            ];
        }

        $this->validate($request, $rules, $messages);

        try {

            $Banner = new Banners();
            $Banner->title = $request->title;
            $Banner->subtitle = $request->subtitle;
            $Banner->description = $request->description;
            $Banner->type = $request->type;
            $Banner->status = 1;

            if($request->type == 'image'){
                $Banner->button_text = $request->button_text;
                $Banner->button_link = $request->url_button;
                $Banner->content = $request->content;
                $Banner->position = $request->position;
            }

            if($request->type == 'video'){
                $Banner->video_link = $request->video_link;
            }

            if($Banner->save()){

                if($request->file('file')){
                    $path = Storage::disk('public')->put('images/storage/banner', $request->file('file'));
                    $Banner->fill(['photo_url' => $path])->save();
                }

                return redirect()->route('banners.index');
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
        $banner = Banners::where('id', $id)->first();
        return view('admin.banners.show', ["banner" => $banner]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banners::where('id', $id)->first();
        return view('admin.banners.edit', ["banner" => $banner]);
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
        $rules = [];
        $messages = [];
        if($request->type == 'image'){            

            $wyswyg = strip_tags(str_replace(' ', '', $request->content));

            if($wyswyg == ''){
                return back()
                    ->withInput()
                    ->withErrors(['content' => 'El campo contenido no contiene información válida']);;
            }
            
            $rules = [
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'file' => 'required|mimes:png,jpeg,jpg',
                'button_text' => 'required',
                'url_button' => 'required|url',
                'position' => 'required'
            ];
    
            $messages = [
                'title.required' => 'El campo titulo es requerido',
                'title.max' => 'El campo titulo solo permite 255 caracteres',
                'subtitle.required' => 'El campo subtitulo es requerido',
                'subtitle.max' => 'El campo subtitulo solo permite 255 caracteres',
                'file.required' => 'El campo imagen es requerido',
                'file.mimes' => 'El campo imagen solo acepta los siguientes formatos; png, jpeg y jpg',
                'button_text.required' => 'El campo texto del botón es requerido',
                'url_button.required' => 'El campo enlace del botón es requerido',
                'url_button.url' => 'El campo enlace del botón no contiene una url válida',
                'position.required' => 'El campo posición es requerido',
            ];
        }

        if($request->type == 'video'){
            $rules = [
                'title' => 'required|max:255',
                'subtitle' => 'required|max:255',
                'video_link' => 'required|url',
            ];
    
            $messages = [
                'title.required' => 'El campo titulo es requerido',
                'title.max' => 'El campo titulo solo permite 255 caracteres',
                'subtitle.required' => 'El campo subtitulo es requerido',
                'subtitle.max' => 'El campo subtitulo solo permite 255 caracteres',
                'video_link.required' => 'El campo enlace del video es requerido',
                'video_link.url' => 'El campo enlace del video no contiene una url válida',
            ];
        }

        $this->validate($request, $rules, $messages);

        try {

            $Banner = Banners::where('id', $id)->first();
            $Banner->title = $request->title;
            $Banner->subtitle = $request->subtitle;
            $Banner->description = $request->description;
            $Banner->type = $request->type;
            $Banner->status = 1;

            if($request->type == 'image'){
                $Banner->button_text = $request->button_text;
                $Banner->button_link = $request->url_button;
                $Banner->content = $request->content;
                $Banner->position = $request->position;
            }

            if($request->type == 'video'){
                $Banner->video_link = $request->video_link;
            }

            if($Banner->save()){

                if($request->file('file')){

                    if(@getimagesize(asset($Banner->photo_url))){
                        unlink($Banner->photo_url);
                    }

                    $path = Storage::disk('public')->put('images/storage/banner', $request->file('file'));
                    $Banner->fill(['photo_url' => $path])->save();
                }

                return redirect()->route('banners.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

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
        //
    }
}
