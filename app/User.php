<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function products() {
        return $this->hasMany(Product::class);//Relación con producto
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }
    public function profile(){
        return $this->hasOne(Profile::class, 'user_id'); //Relacion con perfil
    }
    public function configuration(){ 
        return $this->hasOne(Configuration::class, 'user_id');
    } 
    public function businesses()
    {
        return $this->belongsToMany(Business::class, 'businesses_has_users', 'user_id', 'business_id')->withTimestamps();
    }
}
