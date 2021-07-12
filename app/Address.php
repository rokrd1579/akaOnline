<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'street_name', 'business_id', 'number_home', 'postal_code', 'state', 'city', 'suburb', 'references',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
    public function Profiles()
    {
        return $this->belongsToMany(Profile::class, 'profile_has_addresses', 'address_id', 'profile_id')->withTimestamps();
    }
    public function business()
    {
        return $this->belongsTo(Business::class,'id', 'business_id');
    } 
}
