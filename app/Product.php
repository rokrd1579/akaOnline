<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    //Relaciòn con tabla Image
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
    public function Categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->withTimestamps();
    }
    public function category(){ //$producto->categoria->??????
        return $this->belongsTo(Category::class, 'category_id'); //Pertenece a una categoría.//Llave foranea
    }
    public function user(){
        return $this->belongsTo(User::class);//Relación con usuario
    }
    public function promotion(){
        return $this->belongsTo(Promotion::class, 'id', 'products_id');
    }
    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id', 'id');
    }

    public function businessesHasUsers()
    {
      
        return $this->belongsTo(BusinessesHasUsers::class);
    }
    /* public function getDiscountAttribute()
    {
        $total_procentaje=0;
        $new_price=0;
        if($product->promotion){
        $total_procentaje = $promotion->discount;
        }
        $new_price = ($this->price-($this->price*($total_procentaje/100)));
    } */
    protected $fillable = [
        'name', 'slug', 'characteristics', 'description', 'price', 'new_price', 'priceshipping',
        'state', 'user_id', 'category_id', 'stock', 'active', 'discount',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
    public function scopeSearch($query,$search){
        return $query->where('name','LIKE',"%$search%");
    }
    public function scopeFilterCategory($query,$cat){
        return $query->join("category_product","category_product.id", "=","products.id")
        ->join("categories","categories.id","=","category_id")
        ->where('category_product.category_id',$cat)->select('products.*');
    }
    public function scopeFilterPrice($query, $price1, $price2){
        return $query->whereBetween('price',[$price1,$price2]);
    }
    public function setNameAttribute($value){
        $this->attributes['slug'] = Str::slug($this->attributes['name']=$value,'-' );//Holis 1 => Holis-1
        //$this->attribute['name'] = $value;
    }
    public function question ()
    {
        return $this->hasMany('App\Question');
    }
    public function scopeSimilar($query,$category_id){
        return $query->join('category_product','category_product.product_id','=','products.id')
        ->where('category_product.category_id',$category_id)
        ->distinct('category_id')
        ->inRandomOrder()
        ->take(8);
        //return $query->where('category_id',$cid)->where('id','!=',$pid);
    }
    public function review()
    {
        return $this->hasMany('App\Review');
    }
}
