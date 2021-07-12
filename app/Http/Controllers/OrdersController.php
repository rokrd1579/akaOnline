<?php

namespace App\Http\Controllers;

use App\Address;
use App\Business;
use App\Order;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\OrdersHasProduct;
use App\Product;
use App\Profile;
use App\Review;

class OrdersController extends Controller
{

    public function history(){

        $orderHasProducts = Order::join('orders_has_products','orders_has_products.id', '=', 'orders.id')
        ->select('orders.total as ototal','orders.description','orders.user_id','orders.sub_total as stotal','orders.payment_method_id','orders.id as oid','orders.address_id as oadid','orders.status','orders_has_products.*','orders_has_products.product_id as ohppid','orders_has_products.id as ohpid')
        ->where('orders.user_id',Auth::user()->id)
        ->orderBy('id','desc')
        ->get();

        $selleraddress = Profile::join('profile_has_addresses','profile_has_addresses.profile_id','=','profiles.id')
            ->join('addresses','addresses.id','=','profile_has_addresses.address_id')
            ->select('profiles.user_id','profiles.name_profile')
            ->get();

        $productos = Product::select('id','products.name as pname','products.slug as pslug','products.user_id')->get();
        $address = Address::select('id','street_name','number_home','city','state','postal_code')->get();
        $businesses = Business::select('id','name_business')->get();
        //dd($orderHasProducts);
        $review = Review::all();

            return view('orders.index',compact('productos', 'address','orderHasProducts','review','selleraddress','businesses'));
    }
    
    public function receipts(Request $request){
        //dd($request->all());
        if($request->ordenid){
        $total = $request->total;
        $subtotal = $request->subtotal;
        $ordenId = $request->ordenid;
        $fecha = $request->fecha;
        $envio = $request->envio;
        $direccion = $request->direccion;

        $address = Address::where('id',$direccion)->get();
        $orderProducts = Order::join('orders_has_products','orders_has_products.id','=','orders.id')
        ->where('user_id',Auth::user()->id)->where('orders.order_id',$ordenId)->get();
       //dd($orderProducts);

        $pdf = \PDF::loadView('orders.pdf', compact('address','total','subtotal','ordenId','fecha','envio','orderProducts'));
        $pdf->setPaper('letter');
        return $pdf->stream('receipts.pdf');
        }
        else{
            return redirect(route('index.sitio.web'));
        }
   }
}