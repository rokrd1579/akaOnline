<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name_business', 'name', 'email', 'phone', 'description', 'rfc'
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
    public function address()
    {
        return $this->hasOne(address::class, 'business_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany(Users::class, 'businesses_has_users', 'business_id', 'users_id')->withTimestamps();
    }
    public function product()
    { 
        return $this->hasMany(Product::class);
    } 
    /* public function product()
    {
        return $this->belongsTo(Product::class, 'business_id', 'id');
    } */
}
