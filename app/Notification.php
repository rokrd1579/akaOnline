<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    public function user(){ //$usuario->notificación->??????
        return $this->belongsTo(User::class, 'user_id'); //Tiene notificaciones.
    }
    protected $fillable = [ 
        'type', 'title', 'description', 'start_date', 'end_date',
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
