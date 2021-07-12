<?php

namespace App\Http\Controllers;

use App\Address;
use App\Notifications\OrderNotification;
use App\Order;
use App\Product;
use App\OrdersHasProduct;
use App\Profile;
use App\Tracking;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use MercadoPago;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\Environment\Console;

class CheckoutController extends Controller
{
    public function __construct()  
   {
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));  
   }  
    public function createCookies(Request $request){
        //dd($request->all());
        Cookie::queue('nP',$request->name,30);
        Cookie::queue('qP',$request->quantity,30);
        Cookie::queue('pP',$request->price,30);
        Cookie::queue('iP',$request->id,30);
        Cookie::queue('pS',$request->shipping,30);
        Cookie::queue('pSeller', $request->sellerId,30);
        return redirect(route('checkout'));
    }

    public function deleteCookies(){
        Cookie::queue('nP','',0.01);
        Cookie::queue('qP','',0.01);
        Cookie::queue('pP','',0.01);
        Cookie::queue('iP','',0.01);
        Cookie::queue('pS','',0.01);
        Cookie::queue('pSeller','',0.01);
        return redirect(route('index.sitio.web'));
    }

    public function checkout(Request $request){
        $idProds = array();
       // dd(date_format(Carbon::now(),"ymd00"));
        foreach (\Cart::getContent() as $key => $id) {
            array_push($idProds, $id['id']);
        }
        $addresses = Profile::join('profile_has_addresses','profile_has_addresses.profile_id','=','profiles.id')
        ->join('addresses','addresses.id','=','profile_has_addresses.address_id')
        ->select('profiles.user_id','addresses.*')
        ->where('user_id',Auth::user()->id)
        ->get();
        
        if(Cookie::get('iP') != null){
            $productoUser = Product::where('id',Cookie::get('iP'))->value('business_id');
            $selleraddress = Address::where('business_id',$productoUser)->get();
        }else if(count(\Cart::getContent()) < 2){
            $carrito = Product::whereIn('id',$idProds)->value('business_id');
            $selleraddress = Address::where('business_id',$carrito)->get();
        }else{
            $selleraddress = [];
        }
        
       
        if(Cookie::get('nP') != null || count(\Cart::getContent()) > 0){
            $msgVerificador=null;
            $verifica = Product::where('id',Cookie::get('iP'))->value('stock');
            //dd(Cookie::get('qP'), $verifica);
            if(Cookie::get('qP') > $verifica){
                Cookie::queue('qP',$verifica,30);
                $msgVerificador = "La cantidad seleccionada supera el stock del producto";
                return redirect()->to(route('checkout')); 
            }
            $porciones = explode(",", $request->entrega);
            $precioEnvio = Cookie::get('pS');
            $calle = substr(preg_replace('/[0-9]+/', '', $porciones[0]),0,strlen(preg_replace('/[0-9]+/', '', $porciones[0]))-1);

            $cartCollection = \Cart::getContent();
            $envio = 0;
            foreach($cartCollection as $key){
                $envio += $key->attributes->envio;
            }
            
            if(count($selleraddress) != 0){
                if($selleraddress->toArray()[0]['street_name'] == $calle){
                    $envio = 0;
                    $precioEnvio = 0;
                }
            }
            
            $cartTotal = \Cart::getTotal();
            $preference = new MercadoPago\Preference(); 
            $preference->back_urls = array(
                "success" => route('confirmation',['cshipping' => $envio,'shipping' => $precioEnvio,'k'=> $request->entrega,'ent' => $request->direction, 'idProd' => Cookie::get('iP'),'title'=>Cookie::get('nP'), 'quantity'=>Cookie::get('qP'), 'price'=>Cookie::get('pP'), 'idAddressSeller' => $request->idAddressSeller, 'idAddress' => $request->idAddress, 'idSeller' => Cookie::get('pSeller')]),
                "failure" => route('confirmation',['status'=>'failed']),
                "pending" => route('confirmation',['cshipping' => $envio,'shipping' => $precioEnvio,'k'=> $request->entrega,'ent' => $request->direction, 'idProd' => Cookie::get('iP'),'title'=>Cookie::get('nP'), 'quantity'=>Cookie::get('qP'), 'price'=>Cookie::get('pP'), 'idAddressSeller' => $request->idAddressSeller, 'idAddress' => $request->idAddress, 'idSeller' => Cookie::get('pSeller')])
            );          
            $preference->payment_methods = array(
                "excluded_payment_methods" => array(
                    array("id" => "paypal")
                ),
                "excluded_payment_types" => array(
                  array("id" => "ticket"),
                  array("id" => "atm")
                ),
                "installments" => 12
            );

            $item = new MercadoPago\Item();
            
            if((Cookie::get('nP') != null))
            {
                $item->title = Cookie::get('nP');
                $item->quantity = Cookie::get('qP');
                $item->unit_price = (Cookie::get('pP') + $precioEnvio );
            }else{
                $item->title = 'Varios productos';
                $item->quantity = 1;
                $item->unit_price = ($cartTotal + $envio);
            }

            $preference->items = array($item);
            $preference->save();
            $cant = Cookie::get('qP');
            $price = Cookie::get('pP');
            $total = $price * $cant;
           // dd($preference);
            return view ("cart.checkout", [
                'cartCollection' => \Cart::getContent(),
                'preference' => $preference,
                'entrega' => $request->entrega,
                'nameP' => Cookie::get('nP'),
                'quantityP' => $cant,
                'priceP' => $price,
                'total' => $total,
                'addresses' => $addresses,
                'shipping' => $precioEnvio,
                'cartshipping' => $envio,
                'selleraddress' => $selleraddress,
                'idAddress' => $request->idAddress,
                'idAddressSeller' => $request->idAddressSeller,
                'msgVerificador' => $msgVerificador
            ]);
        }else{
            return redirect(route('index.sitio.web'));
        }
    } 

    public function confirmation(Request $request){
        
        $porciones = explode(",", $request->k);
        $calle = substr(preg_replace('/[0-9]+/', '', $porciones[0]),0,strlen(preg_replace('/[0-9]+/', '', $porciones[0]))-1);

        $cart = \Cart::getContent();
        $cartTotal = \Cart::getTotal();
        $id_usuario = Auth::user()->id;
       
        $validate = Order::latest('payment_method_id')->first();
        $idAddress = Address::where('street_name','LIKE',"%$calle%")->value('id');   
        
        
        if(is_null($validate) || intval($validate->payment_method_id) != intval($request->payment_id)){
            $orderIdGenerated = date_format(Carbon::now(),"ymd00");
            $lastOrderId = Order::latest('id')->value('order_id');
            if($lastOrderId == null){
                $lastOrderId += ($orderIdGenerated + 1);
            }else{
                $lastOrderId += 1;
            }
            
            if(isset($request->title))
            {
                $direccion = null;
                if(isset($request->idAddressSeller)){
                    $direccion += $request->idAddressSeller;
                }else{
                    $direccion += $request->idAddress;
                }
                //dd($direccion);
                
                $order = Order::create([
                    'order_id' => intval($lastOrderId),
                    'user_id' => $id_usuario,
                    'address_id' => $idAddress,
                    'total' => (($request->price * $request->quantity) + ($request->shipping)),
                    'sub_total' => $request->price,
                    'iva' => "0",
                    'payment_method_id' => $request->payment_id,
                    'product' => $request->title,
                    'seller_id' => $request->idSeller,
                    'status' => $request->status
                ]);
                $data = Order::latest('id')->first();
                $stock = Product::where('id',$request->idProd)->first();

                $orderHas = OrdersHasProduct::create([
                    'order_id' => intval($lastOrderId),
                    'product_id' => $request->idProd,
                    'quantity' => $request->quantity,
                    'total' => (($request->price * $request->quantity) + ($request->shipping))
                ]);
                $resta = intval($stock->stock) - $request->quantity;
                Product::where('id',intval($stock->id))->update(['stock'=>$resta]);
                
                if($request->status == "approved"){
                    $tracking = Tracking::create([
                    'tracking_id' => $order->order_id,
                    'order_id' => $order->order_id,
                    'user_id' => $id_usuario,
                    'address_id' => $idAddress,
                    'status' => "Preparando"
                    ]);
                }
                
                if(Auth::user()->configuration->notif_push == 1){
                auth()->user()->notify(new OrderNotification($order));
                }
            }elseif(count($cart) > 0){
                $order ='';
                \Cart::clear();
                foreach ($cart as $key ){
                    
                    $order = Order::create([
                        'order_id' => intval($lastOrderId),
                        'user_id' => $id_usuario,
                        'address_id' => $idAddress,
                        'total' => (($key->price * $key->quantity) + ($key->attributes->envio)),
                        'sub_total' => $key->price * $key->quantity,
                        'iva' => "0",
                        'payment_method_id' => $request->payment_id,
                        'product' => $key->name,
                        'seller_id' => $key->attributes->seller,
                        'status' => $request->status
                    ]);
                    $data = Order::latest('id')->first();
                    $stock = Product::where('id',$key->id)->first();
                
                    $orderHas = OrdersHasProduct::create([
                        'order_id' => intval($lastOrderId),
                        'product_id' => $key->id,
                        'quantity' => $key->quantity,
                        'total' => (($key->price * $key->quantity) + ($key->attributes->envio))
                    ]);
                    $resta = intval($stock->stock) - $key->quantity;
                    Product::where('id',intval($key->id))->update(['stock'=>$resta]);
                    
                }
                if(Auth::user()->configuration->notif_push == 1){
                    auth()->user()->notify(new OrderNotification($order));
                    }
                if($request->status == "approved"){
                    $tracking = Tracking::create([
                    'tracking_id' => $order->order_id,
                    'order_id' => $order->order_id,
                    'user_id' => $id_usuario,
                    'address_id' => $idAddress,
                    'status' => "Preparando"
                    ]);
                }
            }
            
            $data = [
            'idProd' => $request->id,
            'title'=>$request->title, 
            'quantity'=>$request->quantity, 
            'price'=>$request->price + $request->shipping,
            'cart' => $cart,
            'cartTotal' => $cartTotal + $request->scshipping,
            'payment_type' => $request->payment_type,
            'k' => $request->k,
            'ent' => $request->ent,
            'status' => $request->status,
            'cshipping' => $request->cshipping,
            'shipping' => $request->shipping,
            'link' => 'http://acaonline.mx'
            ];
            
            \Mail::send('emails.notificacion', $data, function ($message) {
                $message->from(env('MAIL_FROM_ADDRESS'), 'AcaOnline');
                $message->to(Auth::user()->email)->subject('Notificación de compra');
            });

        }else{
            return redirect()->route('index.sitio.web');
        }
        // Creo cookies para que se eliminen en 10 segundos (son las mismas que creo anteriormente)
        Cookie::queue('nP','',0.01);
        Cookie::queue('qP','',0.01);
        Cookie::queue('pP','',0.01);
        Cookie::queue('iP','',0.01);
        Cookie::queue('pS','',0.01);
        Cookie::queue('pSeller','',0.01);

        return view('cart.confirmation',[
            'idProd' => $request->id,
            'title'=>$request->title, 
            'quantity'=>$request->quantity, 
            'price'=>$request->price + $request->shipping,
            'cart' => $cart,
            'cartTotal' => $cartTotal + $request->scshipping,
            'payment_type' => $request->payment_type,
            'k' => $request->k,
            'ent' => $request->ent,
            'status' => $request->status,
            'cshipping' => $request->cshipping,
            'shipping' => $request->shipping
        ]);
    }
}
