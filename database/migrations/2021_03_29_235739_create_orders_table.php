<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('order_id'); //Relacion con orders has products
            $table->unsignedInteger('user_id');//Relacion con Usuario
            $table->integer('address_id');
            $table->double('total');
            $table->double('sub_total');
            $table->double('iva');
            $table->unsignedInteger('payment_method_id');//Relación con Método de Pago
            $table->string('product');
            $table->text('description')->nullable();
            $table->integer('seller_id')->nullable();
            $table->string('status');
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
        Schema::dropIfExists('orders');
    }
}
