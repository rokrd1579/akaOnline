<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
   // public function product(){ //$pregunta->producto->nombre
     //   return $this->belongsTo(Product::class, product_id); //Pertenece a un producto.
    //}


   // public function user(){ //$pregunta->usuario->nombre
     //   return $this->belongsTo(User::class, user_id); //Pertenece a un usuario.
    //}
        
    protected $fillable = ['question', 'user_id', 'product_id'];
    
    protected $dates = [
        'created_at', 'updated_at',
    ];

 
    
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    public function product(){return $this->belongsTo('App\Product');}

    public function response()
    {
      return $this->hasMany('App\Response');
    }

}
