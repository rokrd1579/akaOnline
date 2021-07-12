<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    protected $fillable = [
        'tracking_id', 'order_id', 'user_id', 'address_id', 'status',
    ];

    protected $dates = [
        'created_at', 'updated_at',
    ];
}
