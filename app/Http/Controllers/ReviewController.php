<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\User;
use App\Review;
use DB;

class ReviewController extends Controller
{
    public function consulta (Request $request)
    {
        $product = Product::findOrFail($request->product_id);
       

        $review=DB::table('reviews') //condicional para saber si hay una reseña en la bd 
        ->where('product_id','=',$product->id)->where('user_id','=', Auth::id())
        ->get();
        if($review->count())
        {
            return redirect()->back();
        }
        
        
            return view ("includes.leave_review",['product_id'=>$request->product_id,'product_name'=>$request->product_name]);
        
        
    }

    public function create (Request $request)
    {
       
        $product = Product::findOrFail($request->product_id);
       if (empty($request->review)||empty($request->title)||empty($request->rating)) 
       { return redirect()->route('index.sitio.web');}
        $review = Review::create([
            'review' => $request->review,
            'title' => $request->title,
            'rating' => $request->rating,
            'user_id' => Auth::id(),
            'product_id' => $product->id
          
        ]);
        //return view ("includes.leave_review",['product_id'=>$request->product_id]); //mandar en caso de exista esa condicion
        
        return redirect()->route('history')->with('review','ok');;
    }

    public function delete(Request $request)
    {     
        $eliminar=DB::table('reviews')->select('id')->where('user_id', '=', Auth::id())->where('product_id', '=',$request->product_id)->delete();    
        return redirect()->route('history')->with('eliminar','ok');

    }





}
