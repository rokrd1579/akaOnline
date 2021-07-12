<?php

namespace App\Http\Controllers;

use App\Notifications\CartNotification;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    

    public function back()
    {
        return redirect()->back();
       
    }

    public function cart()
    {

        $cartCollection = \Cart::getContent();
        $envio = 0;
        foreach($cartCollection as $key){
            $envio += $key->attributes->envio;
            
        }
        return view('cart.index')->with(['cartCollection'=>$cartCollection,'shipping'=>$envio ]);
    }

    public function add(Request $request)
    {
        if(count(\Cart::getContent()) > 0){
        $productStock = Product::where('id',$request->id)->value('stock');
        $contenido = \Cart::get($request->id);
        if($contenido!=null)
        {
            $valida=$contenido->toArray();
        }else{$valida=1;}

            
            if($contenido['quantity'] < $productStock){
                \Cart::add(array(
                    'id'=>$request->id,
                    'name'=>$request->name,
                    'price'=>$request->price,
                    'quantity'=>$request->quantity,
                    'attributes'=>array(
                        'image'=>$request->img,
                        'slug'=>$request->slug,
                        'envio' => $request->shipping,
                        'stock' => $request->codefull,
                        'seller' => $request->sellerId                ),
                    ));
                if(Auth::check())
                {
                    if(Auth::user()->configuration->notif_push  == 1){
                    auth()->user()->notify(new CartNotification($request->id, $request->name));
                    }
                }
            return redirect()->back()->with('agregado', 'ok')->with('cantidad', $request->quantity);
            }else{
                return redirect()->back()->with('agregado','no')->with('msg','Ya se han agregado los productos disponibles');
            }
        }else{
            \Cart::add(array(
                'id'=>$request->id,
                'name'=>$request->name,
                'price'=>$request->price,
                'quantity'=>$request->quantity,
                'attributes'=>array(
                    'image'=>$request->img,
                    'slug'=>$request->slug,
                    'envio' => $request->shipping,
                    'stock' => $request->codefull,
                    'seller' => $request->sellerId                ),
            ));
            if(Auth::check())
            {
                if(Auth::user()->configuration->notif_push  == 1){
                auth()->user()->notify(new CartNotification($request->id, $request->name));
                }
            }
            return redirect()->back()->with('agregado', 'ok')->with('cantidad', $request->quantity);
        }

    }

    public function remove(Request $request){
       \Cart::remove($request->id);
       return redirect()->route('cart')->with('success_msg', 'Item is removed!');
   }

   public function update(Request $request){
       $arrayid = explode(",", $request->v1);
       $arrayquantity = explode(",", $request->v2);    

       for ($i=0; $i < count($arrayid) ; $i++) { 
           \Cart::update($arrayid[$i],
           array(
               'quantity' => array(
                   'relative' => false,
                   'value' => $arrayquantity[$i]
               ),
            ));
       }
       return redirect()->route('cart');
   }

   public function clear(){
       \Cart::clear();
       return redirect()->route('cart')->with('success_msg', 'Car is cleared!');
   }
}