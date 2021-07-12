<?php

namespace App;
use App\Category;
use App\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Promotion extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'image', 'discount', 'stard_date', 'finish_date', 'products_id',
    ];

    protected $dates = [
        'create_at', 'uploaded_at'
    ];
    public function setNameAttribute($value){
        $this->attributes['slug'] = Str::slug($this->attributes['name']=$value,'-' );
    }


    public function product(){ 
        return $this->hasOne(Product::class);
    }
    /* public function product(){
        return $this->belongsTo(Product::class, 'products_id');
    } */
}
