<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Topics;
use Illuminate\Database\QueryException;
use App\Models\Faqs;

class TopicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$faqs = Faq::count();
        $topics = Topics::latest()->paginate(10);
        return view('admin.topics.index', ["temas" => $topics]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.topics.create');
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
            'title' => 'required|max:255'
        ];

        $messages = [
            'title.required' => 'El campo tema es requerido',
            'title.max:255' => 'El campo tema solo permite 255 caracteres'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $topic = Topics::where('title', $request->title)->first();

            if ($topic) {

                return back()->withErrors(['title' => 'Ya existe un tema con este nombre.']);
            } else {

                $topics = new Topics();
                $topics->title = $request->title;
                $topics->slug = str_replace(' ', '-', strtolower($request->title));
                $topics->description = $request->description;
                $topics->status = 1;
            }

            if ($topics->save()) {

                return redirect()->route('topics.index');
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
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
        $tema = Topics::where('id', $id)->first();
        return view('admin.topics.show', ["tema" => $tema]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tema = Topics::where('id', $id)->first();
        return view('admin.topics.edit', ["tema" => $tema]);
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
            'title' => 'required|max:255',
        ];

        $messages = [
            'title.required' => 'El campo tema es requerido',
            'title.max:255' => 'El campo tema solo permite 255 caracteres',
        ];

        $this->validate($request, $rules, $messages);

        try {
            $topic = Topics::where('title', $request->title)->where('id', '<>', $id)->first();

            if ($topic) {

                return back()->withErrors(['title' => 'Ya existe un tema con este nombre.']);
            } else {

                $topics = Topics::where('id', $id)->first();

                $topics->title = $request->title;
                $topics->slug = str_replace(' ', '-', strtolower($request->title));
                $topics->description = $request->description;

                if ($topics->save()) {

                    return redirect()->route('topics.index');
                }
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
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
            $faqs = Faqs::where('topic_id', $id)->count();

            if ($faqs == 0) {
                $topics = Topics::where('id', $id)->first();

                if ($topics->delete()) {

                    return redirect()->route('topics.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            } else {
                return back()->with('status', 'Este tema contiene preguntas y debido a eso no es posible eliminarlo.');
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
            
            $faqs = Faqs::where('topic_id', $id)->count();

            if ($faqs == 0) {

                $topics = Topics::where('id', $id)->first();
    
                if ($topics->status == 1) {
                    $topics->status = 0;
                } else {
                    $topics->status = 1;
                }
    
                if ($topics->save()) {
    
                    return redirect()->route('topics.index');
                }

                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            }else{
                return back()->with('status', 'Este tema contiene preguntas y debido a eso no es posible desactivarlo.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }
}
