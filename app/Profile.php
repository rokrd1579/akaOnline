<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /* public function address(){
        return $this->belongsTo(Address::class, 'profile_has_address', 'profile_id', 'address_id')->withTimestamps(); //Pertenece a un usuario.
    } */

    public function profile(){ //$usuario->perfil->??????
        return $this->hasOne(User::class, 'user_id'); //Pertenece a un usuario.
    }
    public function address(){
        return $this->hasOne(ProfileHasAddresses::class, 'profile_id');
    }

    public function Addresses()
    {
        return $this->belongsToMany(Address::class, 'profile_has_addresses', 'profile_id', 'address_id')->withTimestamps();
    }
    protected $fillable = [
        'user_id', 'name_profile', 'last_name', 'primary_phone', 'secondary_phone', 'gender',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
