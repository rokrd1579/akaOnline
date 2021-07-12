<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryProduct;
use App\Image;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Profile;
use App\Review;
use App\User;
use App\BusinessesHasUsers;

class ProductsController extends Controller
{
    public function show($slug, Request $request)
    {
        $cart_stock = \Cart::getContent();
       // dd($cart_stock);
        $allusers = User::all();
        $categoryproduct = CategoryProduct::all();
        $categs = null;
        $products = Product::where('slug', "{$slug}")->get();
       // dd($products);
        $allcateg = Category::all();
        foreach ($products as $key) {
            $categs = CategoryProduct::where('product_id',$key->id)->inRandomOrder()->value('category_id');
        }

        $seller = Profile::join('profile_has_addresses','profile_has_addresses.profile_id','=','profiles.id')
            ->join('addresses','addresses.id','=','profile_has_addresses.address_id')
            ->select('profiles.user_id','profiles.name_profile')
            ->get();
        
        $images = Image::all();
        $similar = Product::Similar($categs)->select('products.*')->get();
        $reviews = Review::get();
        $businessesHasUsers = BusinessesHasUsers::all();

        return view("products.show", compact("cart_stock","seller", "reviews","products", "categoryproduct", "allusers", "allcateg", "images", "similar", "businessesHasUsers"));
    }

    public function search(Request $request)
    {

        $buscar = $request->search;
        $categorias = Product::join("category_product", "category_product.id", "=", "products.id")
            ->join("categories", "categories.id", "=", "category_id")
            ->where('products.name', "LIKE", "%$buscar%")
            ->select('categories.id', 'categories.category_name')
            ->distinct('categories.id')
            ->get();

        if (isset($request->cat)) {
            $categoryname = Product::join("category_product", "category_product.id", "=", "products.id")->join("categories", "categories.id", "=", "category_id")->where('products.name', "LIKE", "%$buscar%")->where('category_product.category_id', $request->cat)->select('category_name')->get();
            foreach ($categoryname as $key) {
                $text = $key->category_name;
            }
        }

        if ($request->cat == null and $request->price1 == null) {
            return view('includes.filters', [
                'products' => Product::Search($buscar)->paginate(15),
                'busqueda' => $request->input('search'),
                'categorias' => $categorias
            ]);
        } else if ($request->cat != null) {
            return view('includes.filters', [
                'products' => Product::Search($buscar)->FilterCategory($request->cat)->paginate(15),

                'busqueda' => $request->input('search'),
                'categorias' => $categorias,
                'text' => 'en la categoría ' . strtolower($text)
            ]);
        } else {
            return view('includes.filters', [
                'products' => Product::Search($buscar)->FilterPrice($request->price1, $request->price2)->paginate(15),
                'busqueda' => $request->input('search'),
                'categorias' => $categorias,
                'text' => 'con precios desde $' . $request->price1 . ' hasta $' . $request->price2
            ]);
        }
}
}