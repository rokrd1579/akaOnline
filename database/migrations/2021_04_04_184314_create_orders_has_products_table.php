<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersHasProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders_has_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');//Relación con Producto
            $table->unsignedInteger('order_id');//Relación con Pedido
            $table->integer('quantity');
            $table->double('total', 8,2);
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
        Schema::dropIfExists('orders_has_products');
    }
}
