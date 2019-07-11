<?php

namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\QueryException;
use App\Models\Products_images;
use App\Models\Stock;
use App\Models\Stock_moves;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        return view('admin.products.index', ["products" => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categories::where('status', 1)->get();
        return view('admin.products.create', ["categorias" => $categorias]);
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
            'sku' => 'required|max:255',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'file' => 'required|mimes:png,jpeg,jpg',
            'initial' => 'numeric',
            'maximum' => 'numeric',
            'minimum' => 'numeric',
        ];

        $messages = [
            'sku.required' => 'El campo sku es requerido',
            'name.max:255' => 'El campo sku solo permite 255 caracteres',
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio debe ser numérico',
            'category_id.required' => 'El campo categoría es requerido',
            'category_id.numeric' => 'Debe seleccionar una categoría correcto',
            'file.required' => 'El campo imagen es requerido',
            'file.mimes' => 'El campo imagen no contiene un archvivo válido',
            'initial.numeric' => 'El campo stock inicial debe ser numérico',
            'maximum.numeric' => 'El campo stock mínimo debe ser numérico',
            'minimum.numeric' => 'El campo stock máximo debe ser numérico',
        ];

        $this->validate($request, $rules, $messages);

        try {
            
            $product = Products::where('sku', $request->sku)->count();

            if($product == 0){

                $product = new Products();
                $product->sku = strtoupper($request->sku);
                $product->name = $request->name;
                $product->slug = str_replace(' ', '-', strtolower($request->name));
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category_id;
    
                if($product->save()){
    
                    if($request->file('file')){
                        $path = Storage::disk('public')->put('images/storage/products', $request->file('file'));
                        $product->fill(['photo_url' => $path])->save();
                    }
    
                    $sotck = new Stock();
                    $sotck->product_id = $product->id;
                    $sotck->quantity = $request->initial;
                    $sotck->max_quantity = $request->maximum;
                    $sotck->min_quantity = $request->minimum;
    
                    $sotck->save();
    
                    return redirect()->route('products.index');
                }
    
                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

            }else{
    
                return back()
                ->withInput()
                ->withErrors(['sku' => 'Ya existe un producto con este SKU.']);

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
        $producto = Products::where('id', $id)->first();
        return view('admin.products.show', ["producto" => $producto]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $producto = Products::where('id', $id)->first();
        $categorias = Categories::where('status', 1)->get();
        return view('admin.products.edit', ["producto" => $producto, "categorias" => $categorias]);
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
            'sku' => 'required|max:255',
            'name' => 'required|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|numeric',
            'file' => 'mimes:png,jpeg,jpg',
            'add_stock' => 'numeric',
            'maximum' => 'numeric',
            'minimum' => 'numeric',
        ];

        $messages = [
            'sku.required' => 'El campo sku es requerido',
            'name.max:255' => 'El campo sku solo permite 255 caracteres',
            'name.required' => 'El campo nombre es requerido',
            'name.max:255' => 'El campo nombre solo permite 255 caracteres',
            'price.required' => 'El campo precio es requerido',
            'price.numeric' => 'El campo precio debe ser numérico',
            'category_id.required' => 'El campo categoría es requerido',
            'category_id.numeric' => 'Debe seleccionar una categoría correcto',
            'file.mimes' => 'El campo imagen no contiene un archvivo válido',
            'add_stock.numeric' => 'El campo stock inicial debe ser numérico',
            'maximum.numeric' => 'El campo stock mínimo debe ser numérico',
            'minimum.numeric' => 'El campo stock máximo debe ser numérico',
        ];

        $this->validate($request, $rules, $messages);

        try {

            $product = Products::where('sku', $request->sku)->where('id', '<>', $id)->count();

            if($product == 0){
            
                $product = Products::where('id', $id)->first();
                $product->sku = strtoupper($request->sku);
                $product->name = $request->name;
                $product->description = $request->description;
                $product->price = $request->price;
                $product->category_id = $request->category_id;
    
                if($product->save()){
    
                    if($request->file('file')){
    
                        if(@getimagesize(asset($product->photo_url))){
                            unlink($product->photo_url);
                        }
    
                        $path = Storage::disk('public')->put('images/storage/products', $request->file('file'));
                        $product->fill(['photo_url' => $path])->save();
                    }
    
                    $sotck = Stock::where('product_id', $id)->first();
    
                    $moves = new Stock_moves();
                    $moves->description = $request->description_move;
                    $moves->stock_old = $sotck->quantity;
                    $moves->stock_add = $request->add_stock;
                    $moves->stock_new = $sotck->quantity + $request->add_stock;
                    $moves->user = auth()->user()->id;
    
                    if($moves->save()){
    
                        $sotck->quantity = $sotck->quantity + $request->add_stock;
                        $sotck->max_quantity = $request->maximum;
                        $sotck->min_quantity = $request->minimum;
    
                        $sotck->save();
                    }
    
                    return redirect()->route('products.index');
                }
    
                return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

            }else{
    
                return back()
                ->withInput()
                ->withErrors(['sku' => 'Ya existe un producto con este SKU.']);

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
        $producto = Products::where('id', $id)->first();

        if($producto->stock->quantity > 0){

            return back()->with('status', 'No puede eliminar un producto que tenga existencias.');
        }else{

            if(@getimagesize(asset($producto->photo_url))){
                unlink($producto->photo_url);

                foreach ($producto->imagenes as $imagenes){
                    if(@getimagesize(asset($imagenes->photo_url))){
                        unlink($imagenes->photo_url);

                        Products_images::where('id', $imagenes->id)->delete();
                    }
                }

                if($producto->delete()){

                    return redirect()->route('products.index');
                }
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');
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

            $producto = Products::where('id', $id)->first();

            if ($producto->status == 1) {
                $producto->status = 0;
            } else {
                $producto->status = 1;
            }

            if($producto->save()){

                return redirect()->route('products.index');
            }

            return back()->with('error', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagesCreate($id)
    {
        return view('admin.products.imagen', ["id" => $id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imagesSave(Request $request)
    {
        $rules = [
            'position' => 'required|numeric',
            'file' => 'required|mimes:png,jpeg,jpg'
        ];

        $messages = [
            'position.required' => 'El campo posición es requerido',
            'position.numeric' => 'Debe seleccionar una opción del campo posición',
            'file.required' => 'El campo imagen es requerido',
            'file.mimes' => 'El campo imagen no contiene un archvivo válido'
        ];

        $this->validate($request, $rules, $messages);

        try {

            $productImage = new Products_images();
            $productImage->order = $request->position;
            $productImage->product_id = $request->product_id;
            $productImage->status = 1;

            if($productImage->save()){

                if($request->file('file')){
                    $path = Storage::disk('public')->put('images/storage/products', $request->file('file'));
                    $productImage->fill(['photo_url' => $path])->save();
                }

                return redirect()->route('products.show', ['id' => $request->product_id]);
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

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
    public function imagesDelete($id)
    {
        try {

            $imagen = Products_images::where('id', $id)->first();

            if(@getimagesize(asset($imagen->photo_url))){
                unlink($imagen->photo_url);

                if($imagen->delete()){

                    return redirect()->route('products.show', ['id' => $imagen->product_id]);
                }
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    /**
     * update status the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function imagesStatus($id)
    {
        try {

            $imagen = Products_images::where('id', $id)->first();

            if ($imagen->status == 1) {
                $imagen->status = 0;
            } else {
                $imagen->status = 1;
            }

            if($imagen->save()){

                return redirect()->route('products.show', ['id' => $imagen->product_id]);
            }

            return back()->with('status', 'Por el momento no se puede realizar la acción solicitada.');

        } catch (QueryException $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
