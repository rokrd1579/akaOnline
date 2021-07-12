<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    //
    protected $fillable = [
        'method_name', 'active',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
