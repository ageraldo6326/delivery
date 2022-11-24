<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->date('fecha');
            $table->double('limite_diario');
            $table->double('limite_subsidio',8,2);
            $table->double('consumo_del_dia',8,2);
            $table->double('balance_del_dia',8,2);
            $table->double('consumo_del_mes',8,2);
            $table->double('balance_del_mes',8,2);
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
        Schema::dropIfExists('balances');
    }
}
