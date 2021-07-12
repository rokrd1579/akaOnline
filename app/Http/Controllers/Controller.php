<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Configuration;
use App\Image;
use Carbon\Carbon;
use App\Product;
use App\Category;
use App\Review;
use App\Tracking;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    #---------------------------------------------------------------------------------------------------------------------
    public function index()
    {
        if (Auth::user() != null) {
            $user = Auth::user();
            $verificar = Configuration::where('user_id', $user->id)->get();
            if (count($verificar) == 0) {
                Configuration::create([
                    'user_id' => $user->id,
                    'notif_push' => 1
                ]);
            }
        }

        $date = Carbon::now()->toDateTimeString();

        $products = Product::where('id', '>', 25)->take(32)->get();
        $images = Image::where('imageable_id', '>', 25)->take(342)->get();
        $categories = Category::where('id', '>=', 1)->inRandomOrder()->take(3)->get();

        $promotion = DB::table('promotions')
            ->join('products', 'promotions.products_id', '=', 'products.id')
            ->select('promotions.*', 'products.slug as productslug', 'products.name as productsname')
            ->where('promotions.id', '<=', 12)
            ->where('promotions.stard_date',  '<=', $date)
            ->where('promotions.finish_date',  '>=', $date)
            ->inRandomOrder()->take(3)->get();

        $promo = DB::table('promotions')
            ->join('products', 'promotions.products_id', '=', 'products.id')
            ->select('promotions.*', 'products.slug as productslug', 'products.name as productsname')
            ->where('promotions.id', '>=', 12)
            ->where('promotions.stard_date',  '<=', $date)
            ->where('promotions.finish_date',  '>=', $date)
            ->inRandomOrder()->take(1)->get();

        $reviews = Review::get();

        return view('index', compact('reviews', 'products', 'promotion', 'images', 'promo', 'categories'));
    }

    #---------------------------------------------------------------------------------------------------------------------

    public function menucategories()
    {
        $categories = Category::select('category_name', 'slug', 'id')->paginate(30);
        return view('products.menu_categories', compact('categories'));
    }
    #---------------------------------------------------------------------------------------------------------------------

    public function bestseller()
    {
        $products = Product::where('stock', '<', 30)->OrderBy('id', 'asc')->paginate(20);
        $images = Image::all();
        $reviews = Review::get();

        return view('products.bestseller', compact('reviews', 'products', 'images'));
    }

    public function news()
    {
        $products = Product::where('state', '=', 'Nuevo')->paginate(20);
        $images = Image::all();
        $reviews = Review::get();

        return view('products.news', compact('reviews', 'products', 'images'));
    }


    public function promotions()
    {
        $products = Product::paginate();
        $date = Carbon::now()->toDateTimeString();
        $images = Image::all();
        $reviews = Review::get();


        $promotions = DB::table('promotions')
            ->join('products', 'promotions.products_id', '=', 'products.id')
            ->select('promotions.*', 'products.slug as productslug', 'products.name as productsname')
            ->where('promotions.id', '>=', 15)
            ->where('promotions.stard_date',  '<=', $date)
            ->where('promotions.finish_date',  '>=', $date)
            ->inRandomOrder()->take(9)->get();

        return view('products.promotions', compact('reviews', 'products', 'promotions', 'images'));
    }

    #---------------------------------------------------------------------------------------------------------------------
    public function catalogue_categories($category)
    {
        $images = Image::all();

        $categname = null;
        $products = DB::table('category_product')
            ->join('products', 'category_product.product_id', '=', 'products.id')
            ->join('categories', 'category_product.category_id', '=', 'categories.id')
            ->select('category_product.category_id', 'products.id', 'products.name', 'products.slug', 'products.promotion_id', 'products.price', 'products.new_price', 'categories.category_name as categname', 'categories.slug as categSlug')
            ->where('categories.slug', $category)->paginate(20);
        $reviews = Review::get();
        $prueba = $products->pluck('id')->toArray();
        $productos = Product::whereIn('id',$prueba)->get();
       // dd();

        foreach ($products as $key) {
            $categname = $key->categname;
        }

        return view('products.catalogue_products_categories', compact('productos','reviews', 'products', 'categname', 'images'));
    }
    #---------------------------------------------------------------------------------------------------------------------



    public function cart()
    {

        return view('cart.index', compact('products'));
    }

    public function review()
    {

        return view('includes.leave_review', compact('products'));
    }

    public function product()
    {

        return view('products.show', compact('products'));
    }


    public function about()
    {

        return view("about.index");
    }

    public function help()
    {
        return view('help.index');
    }

    public function terms_conditions()
    {
        return view('terms_conditions');
    }
    
    public function notice_privacy()
    {
        return view('notice_privacy');
    }

    public function track_order(Request $request)
    {
        $search = $request->search;
        $track_order = Tracking::join("orders", "orders.order_id", "=", "trackings.order_id")
            ->join("orders_has_products", "orders_has_products.order_id", "=", "trackings.order_id")
            ->where('trackings.tracking_id', "LIKE", "%$search%")
            ->select('trackings.tracking_id', 'orders.product', 'trackings.status', 'trackings.created_at', 'orders_has_products.quantity')
            ->get();

        return view('tracking.show', compact('track_order', 'search'));
    }

    public function tracing(Request $request)
    {
        $products = Product::where('state', '=', 'Nuevo')->paginate(10);
        $reviews = Review::get();
        $images = Image::all();

        return view('tracking.index', compact("products", "reviews", "images"));
    }
}
