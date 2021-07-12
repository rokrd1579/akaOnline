<?php

namespace App\Http\Controllers;

use App\Order;
use App\Product;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function allmarks(){

        auth()->user()->unreadNotifications->markAsRead();

        return redirect()->back();
    }
    
    public function ordernotification($notification_id, $order_id){

        auth()->user()->unreadNotifications->when($notification_id, function($query) use
        ($notification_id){
            return $query->where('id', $notification_id);
        })->markAsRead();
        $order = Order::find($order_id);
        return redirect()->route('history', $order);
    }
}
