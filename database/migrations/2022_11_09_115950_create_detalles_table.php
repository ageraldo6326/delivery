<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetallesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('producto_id')->unsigned();
            $table->string('producto_nombre')->nullable();
            $table->integer('cantidad')->default(0);
            $table->double('precio',8,2)->default(0.0);
            $table->integer('pedido_id')->unsigned();
            $table->string('pedido_codigo')->nullable();
            $table->integer('user_id')->unsigned();
            $table->string('user_nombre')->nullable();
            $table->integer('proveedor_id')->unsigned();
            $table->string('proveedor_nombre')->nullable();
            $table->double('subtotal',8,2)->default(0.0);
            $table->double('impuestos',8,2)->default(0.0);
            $table->double('total',8,2)->default(0.0);
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
        Schema::dropIfExists('detalles');
    }
}
