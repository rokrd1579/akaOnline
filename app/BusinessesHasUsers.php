<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessesHasUsers extends Model
{
    protected $table = 'businesses_has_users';

    protected $fillable = [
        'business_id','user_id'
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];

    public function product()
    { 
        return $this->hasMany(Product::class);
    }
}
