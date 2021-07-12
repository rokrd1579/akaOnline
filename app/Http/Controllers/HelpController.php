<?php

namespace App\Http\Controllers;

use App\Address;
use App\Frequestions;
use App\Notifications\CancelNotification;
use App\Notifications\ReturnNotification;
use App\Order;
use App\OrdersHasProduct;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MercadoPago;

class HelpController extends Controller
{
    public function __construct()  
    {  
        MercadoPago\SDK::setAccessToken(config('services.mercadopago.access_token'));  
    }  

    public function help(){
      $frequentQuestions = Frequestions::inRandomOrder()->get();
      return view('help.index', compact('frequentQuestions'));
    }

    public function freq(Request $request){
      $search = $request->search;
      if(isset($request->search)){
        $frequentQuestions = Frequestions::where('question', "LIKE", "%$request->search%")->paginate(15);
      }else{$frequentQuestions = Frequestions::paginate(15);}
      $id = Frequestions::where('id',$request->q)->get();
      return view('help.frequentQuestion', compact('frequentQuestions','id','search'));
    }

    public function operacion(Request $request)
    {
      $idMercadoPago = $request->idMercadoPago; $msg='';
      $idOrden = $request->idOrden;
     
      if(isset($request->idOper)){
        if($request->idOper == "cancelConfirm"){
          $ch = curl_init();

          curl_setopt($ch, CURLOPT_URL, 'https://api.mercadopago.com/v1/payments/'.$idMercadoPago);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');

          curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"status\":\"cancelled\"}");

          $headers = array();
          $headers[] = 'Content-Type: application/json';
          $headers[] = 'Authorization: Bearer '.config('services.mercadopago.access_token');
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

          $result = curl_exec($ch);
          if (curl_errno($ch)) {
              echo 'Error al realizar la solicitud:' . curl_error($ch);
          }
          curl_close($ch);

          $orden = OrdersHasProduct::where('order_id',$idOrden)->get();
          foreach ($orden as $key) {
              $stock = Product::where('id',$key->product_id)->value('stock');
              Product::where('id',$key->product_id)->update(['stock'=>$stock + $key->quantity]);
          }
          Order::where('order_id',$idOrden)->update(['status'=>'cancelled', 'description'=>'La orden se canceló']);
          $msg ="La orden se canceló correctamente";
          if(Auth::user()->configuration->notif_push == 1){
          auth()->user()->notify(new CancelNotification($idOrden));
          }
        }else if($request->idOper == "refundConfirm"){
          $payment = MercadoPago\Payment::find_by_id($idMercadoPago);
          $payment->refund();
          
          $orden = OrdersHasProduct::where('order_id',$idOrden)->get();
          foreach ($orden as $key) {
              $stock = Product::where('id',$key->product_id)->value('stock');
              Product::where('id',$key->product_id)->update(['stock'=>$stock + $key->quantity]);
          }
          Order::where('order_id',$idOrden)->update(['status'=>'cancelled', 'description'=>'La orden se devolvió']);
          $msg = "Se ha iniciado el proceso de devolución correctamente";
          auth()->user()->notify(new ReturnNotification($idOrden));
        }
      }
      return redirect()->route('history')->with('msj',$msg);
    }

    public function returns(Request $request){
      
      $idOrden = $request->idOrden;
      $idMercadoPago = decrypt($request->idMP);
      $ordenes = Order::where('user_id',Auth::user()->id)->get();
      $proc = null;
      
      $total = $request->total;
      $fecha = $request->fecha;
      $direccion = $request->direccion;

//////////////////////////////// PARA VER EL STATUS DE LA ORDEN
      $url = "https://api.mercadopago.com/v1/payments/".decrypt($request->idMP);

      $curl = curl_init($url);
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

      $headers = array(
      "Authorization: Bearer ".config('services.mercadopago.access_token'),
      );
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      //for debug only!
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

      $resp = curl_exec($curl);
      curl_close($curl);
      $array = json_decode($resp, true);

      $metodoPago = $array['payment_type_id'];
      $texto = null;

      if($array['status'] == "approved")
      {
       $texto = "Pago aprobado";
       $proc = "refund";
      }else if($array['status'] == "pending" || $array['status'] == "in_process"){
        $texto = "Pago pendiente de acreditación";
        $proc = "cancel";
      }else if($array['status'] == "cancelled"){
        $texto = "Orden cancelada";
        $proc = "cancel";
      }else if($array['status'] == "refunded"){
        $texto = "Orden en proceso de devolución";
        $proc = "refund";
      }

       $address = Address::where('id',$request->direccion)->get();
        $orderProducts = Order::join('orders_has_products','orders_has_products.id','=','orders.id')
        ->where('user_id',Auth::user()->id)->where('orders.order_id',$idOrden)->get();
        $productos = Product::get();

        return view("help.return",compact('idMercadoPago','array','texto','orderProducts','ordenes','proc','total','fecha','direccion','idOrden','address','metodoPago','productos'));
    }
}
