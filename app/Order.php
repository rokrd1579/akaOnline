<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user(){ //$Usuario->pedido->??????
        return $this->hasOne(User::class, 'user_id'); //Pertenece a un usuario.
    }
    public function methodPayment(){ //$pago->pedido->??????
        return $this->hasOne(PaymentMethod::class, 'payment_method_id'); //Pertenece a un metododePago.
    }
    public function orderHas(){
        return $this->hasOne(OrdersHasProduct::class,'order_id');
    }

    public function users(){
        return $this->belongsTo('App\User');
    }  

    protected $fillable = [
        'order_id','user_id','address_id', 'total', 'sub_total', 'iva','payment_method_id','product', 'description', 'seller_id', 'status',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
