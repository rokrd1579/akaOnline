<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsHasResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions_has_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('questions_id');//Relación con Preguntas
            $table->unsignedInteger('responses_id');//Relación con Respuestas
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('questions_has_responses');
    }
}
