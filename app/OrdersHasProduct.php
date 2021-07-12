<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersHasProduct extends Model
{
    public function order(){ //pedido->producto->??????
        return $this->belongsTo(Order::class, 'order_id'); //Pertenece a un pedido.
    }
    public function product(){ //pedido->producto->??????
        return $this->hasMany(Product::class, 'product_id'); //Pertenece a un producto.
    }
    protected $fillable = [
        'order_id','product_id','quantity', 'total',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
