<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Faqs;
use App\Models\Topics;
use Illuminate\Database\QueryException;

class FaqsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faqs::get();
        return view('admin.faqs.index', ["faqs" => $faqs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $faqsCategory = Topics::get();
        return view('admin.faqs.create', ['faqsCategory' => $faqsCategory]);
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
            'topic' => 'required|numeric',
            'question' => 'required|max:255',
        ];

        $messages = [
            'topic.required' => 'El campo tema es requerido',
            'topic.numeric' => 'Debe seleccionar un tema para esta pregunta',
            'question.required' => 'El campo tema es requerido',
            'question.max:255' => 'El campo tema solo permite 255 caracteres',
        ];

        $this->validate($request, $rules, $messages);

        if($request->topic == 'S'){
            return back()
                ->withInput()
                ->withErrors(['topic' => 'El campo respuesta no contiene información válida']);
        }

        $wyswyg = strip_tags(str_replace(' ', '', $request->answer));

        if($wyswyg == ''){
            return back()
                ->withInput()
                ->withErrors(['answer' => 'El campo respuesta no contiene información válida']);;
        }

        try {

            $faqs = Faqs::where('question', $request->question)->count();

            if($faqs == 0){
                $faq = new Faqs();
                $faq->question = $request->question;
                $faq->answer = $request->answer;
                $faq->topic_id = $request->topic;
                $faq->slug = str_replace(' ', '-', strtolower($request->question));
    
                if($faq->save()){
    
                    return redirect()->route('faqs.index');
                }
    
                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
            }else{
                return back()->with('status', 'Ya existe una pregunta con este nombre.');
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
        $faq = Faqs::where('id', $id)->first();
        return view('admin.faqs.show', ["faq" => $faq]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $faqsCategory = Topics::get();
        $faq = Faqs::where('id', $id)->first();
        return view('admin.faqs.edit', ["faq" => $faq, 'faqsCategory' => $faqsCategory]);
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
            'question' => 'required|max:255',
            'answer' => 'required',
            'topic' => 'required|numeric'
        ];

        $messages = [
            'question.required' => 'El campo tema es requerido',
            'question.max:255' => 'El campo tema solo permite 255 caracteres',
            'answer.required' => 'El campo tema es requerido',
            'topic.required' => 'El campo tema es requerido',
            'topic.numeric' => 'Debe seleccionar un tema para esta pregunta'
        ];

        $this->validate($request, $rules, $messages);

        if($request->topic == 'S'){
            return back()
                ->withInput()
                ->withErrors(['topic' => 'El campo respuesta no contiene información válida']);
        }

        $wyswyg = strip_tags(str_replace(' ', '', $request->answer));

        if($wyswyg == ''){
            return back()
                ->withInput()
                ->withErrors(['answer' => 'El campo respuesta no contiene información válida']);;
        }

        try {

            $faq = Faqs::where('id', $id)->first();

            $faq->question = $request->question;
            $faq->answer = $request->answer;
            $faq->topic_id = $request->topic;
            $faq->status = 1;

            if($faq->save()){

                return redirect()->route('faqs.index');
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

        $faq = Faqs::where('id', $id)->first();

        if($faq->delete()){

            return redirect()->route('faqs.index');
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

            $faq = Faqs::where('id', $id)->first();

            if ($faq->status == 1) {
                $faq->status = 0;
            } else {
                $faq->status = 1;
            }

            if($faq->save()){

                return redirect()->route('faqs.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
