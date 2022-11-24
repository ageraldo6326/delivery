<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {

            $table->increments('id');
            $table->string('nombre',100);
            $table->text('descripcion');
            $table->double('precio',8,2);
            $table->string('unidad',100);
            $table->string('fotourl',100)->nullable();
            $table->integer('visita')->default(0);
            $table->integer('proveedor_id')->unsigned();
            $table->integer('categoria_id')->unsigned();
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
        Schema::dropIfExists('productos');
    }
}
