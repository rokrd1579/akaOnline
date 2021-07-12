<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Promotion;
use App\Product;
use App\Category;
use App\Notifications\PromotionNotification;
use App\Notifications\PromotionsNotification;
use App\User;

class PromotionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.promotions.index')->only('index');
        $this->middleware('can:admin.promotions.create')->only('create', 'store');
        $this->middleware('can:admin.promotions.show')->only('show');
        $this->middleware('can:admin.promotions.edit')->only('edit', 'update');
        $this->middleware('can:admin.promotions.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotions = Promotion::orderBy('id', 'DESC')->get();
        return view('admin.promotions.index', compact('promotions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::orderby('name')->get();
        return view ('admin.promotions.create',compact('products'));
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
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
            'products_id' => 'required',
            'discount' => 'required',
            'stard_date' => 'required|date', 
            'finish_date' => 'required|date|after:stard_date',
        ],
        [
            'name.required' => 'El campo nombre es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'products_id.required' => 'El campo productos es obligatorio',
            'discount.required' => 'El campo descuento es obligatorio',
            'stard_date.required' => 'El campo inicio de promoción es obligatorio',
            'finish_date.required' => 'El campo fin de promoción es obligatorio',
            'finish_date.after' => 'El campo fin de promoción debe ser una fecha posterior al inicio de promoción',

        ]);
        $promotions = new Promotion();

        if($request->hasFile('image')){
            $file = $request->file('image');
            $url = time() . '_' . $file->getClientOriginalName();
            $photo = $request->file('image')->store('promotion','public');
            $url =  Storage::url($photo);
        } 
        $promotions->name = $request->get('name');
        $promotions->products_id = $request->get('products_id');
        $promotions->discount = $request->get('discount');
        $promotions->stard_date = $request->get('stard_date');
        $promotions->finish_date = $request->get('finish_date');
        $promotions->description = $request->get('description');
        $promotions->image = $url;
        $promotions->save();

        User::role(['buyer'])
        ->each(function(User $user) use ($promotions){
            $user->notify(new PromotionNotification($promotions));
        });
        return redirect()->route('admin.promotions.index')->with('Agregar', 'Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $promotion = Promotion::find($id);
        $products = Product::orderby('name')->get();
        return view('admin.promotions.show')->with(compact('promotion', 'products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $promotion = Promotion::find($id);
        $categories = Category::orderby('category_name')->get();
        $products = Product::orderby('name')->get();
        return view('admin.promotions.edit', compact('categories', 'products', 'promotion'));
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
            'products_id' => 'required',
            'discount' => 'required',
            'stard_date' => 'date', 
            'finish_date' => 'required|date|after:stard_date',
        ],
        [
            'name.required' => 'El campo nombre es obligatorio',
            'description.required' => 'El campo descripción es obligatorio',
            'products_id.required' => 'El campo productos es obligatorio',
            'discount.required' => 'El campo descuento es obligatorio',
            'stard_date.required' => 'El campo inicio de promoción es obligatorio',
            'finish_date.required' => 'El campo fin de promoción es obligatorio',
            'finish_date.after' => 'El campo fin de promoción debe ser una fecha posterior al inicio de promoción',

        ]);
        $promotion = Promotion::find($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $url = time() . '_' . $file->getClientOriginalName();
            $photo = $request->file('image')->store('promotion','public');
            $url =  Storage::url($photo);
            $promotion->image = $url;
        }
        $promotion->name = $request->get('name');
        $promotion->products_id = $request->get('products_id');
        $promotion->discount = $request->get('discount');
        $promotion->stard_date = $request->get('stard_date');
        $promotion->finish_date = $request->get('finish_date');
        $promotion->description = $request->get('description');
        $promotion->save();

        User::role(['buyer'])
        ->each(function(User $user) use ($promotion){
            $user->notify(new PromotionsNotification($promotion));
        });

        return redirect()->route('admin.promotions.index')->with('Editar', 'Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::find($id);
        $promotion->delete($id);
        return redirect()->route('admin.promotions.index')->with('Eliminar', 'Ok');
    }
}
