<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frequestions extends Model
{
    protected $fillable = [ 
        'question', 'answer',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
