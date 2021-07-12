<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $guarded =['id'];
    protected $fillable = ['review', 'user_id', 'product_id','product_name', 'rating', 'title'];
    public function product()
    {
        return $this->belongsTo('App\Product');
    }

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
