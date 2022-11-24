<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {

            $table->increments("id");
            $table->string('codigo',25);
            $table->double('subtotal',8,2);
            $table->double('impuestos',8,2);
            $table->double('total',8,2);
            $table->integer('user_id')->unsigned();
            $table->string('user_nombre')->nullable();
            $table->boolean('estado');
            $table->double('credito',8,2)->default(0.0);
            $table->double('subsidio',8,2)->default(0.0);
            $table->double('nosubsidio',8,2)->default(0.0);
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
        Schema::dropIfExists('pedidos');
    }
}
