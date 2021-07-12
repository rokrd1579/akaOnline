<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileHasAddresses extends Model
{
    /* public function profile(){ //$perfil->dirección->??????
        return $this->hasOne(Profile::class, 'profile_id'); //Pertenece a un perfil.
    }
    public function address(){ //$direccion->perfil->??????
        return $this->hasOne(Address::class, 'address_id'); //Pertenece a una direccion.
    } */
    protected $table = 'profile_has_addresses';

    protected $fillable = [
        'profile_id', 'address_id', 
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
