<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categories::latest()->paginate(10);
        return view('admin.categories.index', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Categories::get();
        return view('admin.categories.create', [
            "categories" => $categories
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
            'name' => 'required|max:255',
            //'parent_id' => 'not_in:S',
            'file' => 'required|mimes:png,jpeg,jpg'
        ];

        $messages = [
            'name.max:255' => 'El campo sku solo permite 255 caracteres',
            'name.required' => 'El campo nombre es requerido',
            'file.required' => 'El campo imagen es requerido',
            'file.mimes' => 'El campo imagen no contiene un archvivo válido'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $category = Categories::where('name', $request->name)->first();

            if (!$category) {
                $category = new Categories();
                $category->parent_id = ($request->parent_id == 'S') ? null : $request->parent_id;
                $category->name = $request->name;
                $category->description = $request->description;
                $category->status = 1;

                if ($category->save()) {

                    if ($request->file('file')) {
                        $path = Storage::disk('public')->put('images/storage/categories', $request->file('file'));
                        $category->fill(['photo_url' => $path])->save();
                    }

                    return redirect()->route('categories.index');
                } else {

                    return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
                }
            } else {
                return back()->withErrors(['name' => 'Ya existe un registro con el nombre que ingreso']);
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
        $category = Categories::where('id', $id)->first();
        return view('admin.categories.show', ["category" => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Categories::where('id', $id)->first();
        $categories = Categories::where('id', '<>', $id)->get();
        return view('admin.categories.edit', [
            "category" => $category,
            "categories" => $categories
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
            'name' => 'required|max:255',
            'file' => 'mimes:png,jpeg,jpg'
        ];

        $messages = [
            'name.max:255' => 'El campo sku solo permite 255 caracteres',
            'name.required' => 'El campo nombre es requerido',
            'file.mimes' => 'El campo imagen no contiene un archvivo válido'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $category = Categories::where('id', '<>', $id)->where('name', $request->name)->first();

            if (!$category) {
                $category = Categories::where('id', $id)->first();
                $category->parent_id = ($request->parent_id == 'S') ? null : $request->parent_id;
                $category->name = $request->name;
                $category->description = $request->description;

                if ($category->save()) {

                    if ($request->file('file')) {
                        if (@getimagesize(asset($category->photo_url))) {
                            unlink($category->photo_url);
                        }

                        $path = Storage::disk('public')->put('images/storage/categories', $request->file('file'));
                        $category->fill(['photo_url' => $path])->save();
                    }

                    return redirect()->route('categories.index');
                } else {

                    return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
                }
            } else {
                return back()->withErrors(['name' => 'Ya existe un registro con el nombre que ingreso']);
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
            $parent = Categories::where('parent_id', $id)->count();

            if ($parent == 0) {
                $category = Categories::where('id', $id)->first();

                if ($category->productos->count() > 0) {

                    return back()->with('status', 'No puede eliminar una categoría que contenga productos.');
                } else {

                    if ($category->delete()) {
                        if (@getimagesize(asset($category->photo_url))) {
                            unlink($category->photo_url);
                        }

                        return redirect()->route('categories.index');
                    }

                    return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
                }
            } else {
                return back()->with('status', 'No puede elimiar una categoría padre hasta quitar todas las categorías relacionadas.');
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

            $parent = Categories::where('parent_id', $id)->count();

            if ($parent == 0) {

                $category = Categories::where('id', $id)->first();

                if ($category->productos->count() > 0) {

                    return back()->with('status', 'No puede desactivar una categoría que contenga productos.');
                } else {

                    if ($category->status == 1) {
                        $category->status = 0;
                    } else {
                        $category->status = 1;
                    }

                    if ($category->save()) {

                        return redirect()->route('categories.index');
                    }

                    return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
                }
            } else {
                return back()->with('status', 'No puede desactivar una categoría padre hasta quitar todas las categorías relacionadas.');
            }
        } catch (QueryException $e) {
            return back()->with('status', $e->getMessage());
        }
    }
}
