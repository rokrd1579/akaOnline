<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfileHasAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_has_addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('address_id')->nullable();//Relación con Dirección
            $table->unsignedBigInteger('profile_id')->nullable();//Relación con Perfil
            $table->timestamps();
            //Referencia con tabla direcciones
            $table->foreign('address_id')->references('id')->on('addresses')->onDelete('cascade');
            //Referencia con tabla perfil
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_has_addresses');
    }
}
