<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionsHasResponse extends Model
{
    public function questions(){ 
        return $this->belongsTo(Question::class, question_id); //Pertenece a una pregunta.
    }
    public function responses(){ 
        return $this->hasMany(Response::class, response_id); //Pertenece a una respuesta.
    }
    protected $fillable = [
       
    ];
    protected $dates = [
        'created_at', 'updated_at',
    ];
}
