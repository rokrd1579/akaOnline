<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    public function Products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id', 'product_id')->withTimestamps();
    }
    /*public function product()
    {
        return $this->hasMany(Product::class);
    } */
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }
    
    protected $fillable = [
        'category_name', 'slug', 'image',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function setCategoryNameAttribute($value){
        $this->attributes['slug'] = Str::slug($this->attributes['category_name']=$value,'-' );
    }
}
