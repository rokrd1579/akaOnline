<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = "configurations";
     
    protected $fillable = [
        'user_id', 'notif_push'
    ];

    protected $dates = [
        'create_at', 'uploaded_at'
    ];
}
