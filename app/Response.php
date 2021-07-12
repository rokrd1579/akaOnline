<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }
    //
    
    protected $fillable = [
    	'question_id',
    	'name',
    	'response',
    	'user_id'
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}

