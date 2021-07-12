<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;
use App\Product;
use App\Category;
use App\Business;
use App\Image;
use App\User;
use Illuminate\Support\Facades\File;

class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.products.index')->only('index');
        $this->middleware('can:admin.products.create')->only('create', 'store');
        $this->middleware('can:admin.products.show')->only('show');
        $this->middleware('can:admin.products.edit')->only('edit', 'update');
        $this->middleware('can:admin.products.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Condición de Asministrador (ve todos los registros) o si es Seller (ve solamente sus productos)
        if(auth()->user()->hasRole('admin')){
            $products = Product::with('images', 'Categories', 'user')->orderBy('id', 'DESC')->get();
            $categories = Category::orderBy('category_name')->get();
            $businesses = Business::orderBy('name')->get();
            return view('admin.products.index')->with(compact('products', 'categories', 'businesses'));
        }else{
            $products = Product::with('images', 'Categories', 'user')->orderBy('id', 'DESC')->get()->where('user.id','=',Auth::user()->id);
            $categories = Category::orderBy('category_name')->get();
            $businesses = Business::orderBy('name')->get();
            return view('admin.products.index')->with(compact('products', 'categories', 'businesses'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('category_name')->get();
        $businesses = Business::orderBy('name')->get();
        return view('admin.products.create')->with(compact('categories', 'businesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'characteristics' => 'required',
            'description' => 'required',
            'price' => 'required',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'state' => 'required',
            'business_id' => 'required',
            'stock' => 'required',
            'categories' => 'required',
            'price_shipping' => 'required'
        ],
        [
            'name.required' => 'El campo nombre es requerido',
            'characteristics.required' => 'El campo características es requerido',
            'categories.required' => 'El campo categoría es requerido',
            'description.required' => 'El campo descripción es requerido',
            'price.required' => 'El campo precio es requerido',
            'images.required' => 'El campo imagenes es requerido',
            'state.required' => 'El campo estado es requerido',
            'stock.required' => 'El campo existencia es requerido',
            'price_shipping.required' => 'El campo envío es requerido',
            'business_id.required' => 'El campo empresas es requerido',
        ]);

        $urlimages = [];
        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $dir = time() . '_' . $image->getClientOriginalName();
                $file=  Storage::disk('public')->putFileAs('product', $image, $dir); 
                $urlimages[]['url']= Storage::url($file);
            }
        } 
        $products = new Product();
        $products->name = $request->get('name');
        $products->user_id = Auth::id();
        $products->business_id = $request->get('business_id');
        $products->characteristics = $request->get('characteristics');
        $products->description = $request->get('description');
        $products->price = $request->get('price');
        $products->price_shipping = $request->get('price_shipping');
        $products->state = $request->get('state');
        $products->stock = $request->get('stock');
        $products->save();
        $products->categories()->attach($request->categories);
        $products->images()->createMany($urlimages);
        return redirect()->route('admin.products.index')->with('Agregar', 'Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $product = Product::with('images','promotion')->where('slug', $slug)->firstOrFail();
        $businesses = Business::orderBy('name')->get();
        $categories = Category::orderBy('category_name')->get();
        return view('admin.products.show')->with(compact('product', 'categories', 'businesses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $product = Product::with('images')->where('slug', $slug)->firstOrFail();
        $businesses = Business::orderBy('name')->get();
        $categories = Category::orderBy('category_name')->get();
        return view('admin.products.edit')->with(compact('product', 'categories', 'businesses'));
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
        $request->validate([
            'name' => 'required|min:4|max:80,'.$id,
            'characteristics' => 'required|min:10|max:1000',
            'description' => 'required|min:10|max:500',
            'price' => 'required',
            'images.*' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'price_shipping' => 'required',
            'state' => 'required',
            'stock' => 'required',
            'categories' => 'required',
            'business_id' => 'required'
        ],
        [
            'name.required' => 'El campo nombre es requerido',
            'characteristics.required' => 'El campo características es requerido',
            'categories.required' => 'El campo categoría es requerido',
            'description.required' => 'El campo descripción es requerido',
            'price.required' => 'El campo precio es requerido',
            'images.required' => 'El campo imagenes es requerido',
            'state.required' => 'El campo estado es requerido',
            'stock.required' => 'El campo existencia es requerido',
            'price_shipping.required' => 'El campo envío es requerido',
            'business_id.required' => 'El campo empresas es requerido',
        ]);
        
        $urlimages = [];
        if($request->hasFile('images')){
            $images = $request->file('images');
            foreach($images as $image){
                $dir = time() . '_' . $image->getClientOriginalName();
                $file =  Storage::disk('public')->putFileAs(
                    'product', $image, $dir
                ); 
                $urlimages[]['url']= Storage::url($file);
            }
        } 

        $product = Product::find($id);
        $product->name = $request->get('name');
        $product->business_id = $request->get('business_id');
        $product->characteristics = $request->get('characteristics');
        $product->description = $request->get('description');
        $product->price = $request->get('price');
        $product->price_shipping = $request->get('price_shipping');
        $product->state = $request->get('state');
        $product->stock = $request->get('stock');
        $product->active = $request->get('active');
        $product->discount = $request->get('discount');
        if($request->active){
            $product->active=1;
        }
        else{
            $product->active=0;
        }

        $product->save();
        $product->categories()->sync($request->categories);
        if($request->hasFile('images')){
            $product->images()->createMany($urlimages);
        }
        return redirect()->route('admin.products.index')->with('Editar', 'Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->images()->delete();
        $product->delete();
        return redirect()->route('admin.products.index')->with('Eliminar', 'Ok');
    }
}
