<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin.category.index')->only('index');
        $this->middleware('can:admin.category.create')->only('create', 'store');
        $this->middleware('can:admin.category.edit')->only('edit', 'update');
        $this->middleware('can:admin.category.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('admin.category.index')->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
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
            'category_name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,svg|max:2048',
        ],
        [
            'category_name.required' => 'El campo nombre de la categoría es obligatorio',
        ]);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $url = time() . '_' . $file->getClientOriginalName();
            $photo = $request->file('image')->store('category','public');
            $url =  Storage::url($photo);
        } 
        $categories = new Category();

        $categories->category_name = $request->get('category_name');
        $categories->image = $url;

        $categories->save();
        return redirect()->route('admin.category.index')->with('Agregar', 'Ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        return view('admin.category.edit')->with(compact('category'));
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
            'category_name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,svg|max:2048',
        ],
        [
            'category_name.required' => 'El campo nombre de la categoría es obligatorio',
        ]);
        $category = Category::find($id);
        if($request->hasFile('image')){
            $file = $request->file('image');
            $url = time() . '_' . $file->getClientOriginalName();
            Storage::delete('public/'.$category->image);
            $photo = $request->file('image')->store('category','public');
            $url =  Storage::url($photo);
            $category->image = $url;
        }
        
        $category->category_name = $request->get('category_name');
        
        $category->save();
        return redirect()->route('admin.category.index')->with('Editar', 'Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('admin.category.index')->with('Eliminar', 'Ok');
    }
}
