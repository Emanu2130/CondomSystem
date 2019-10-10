<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblGastosCondominioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_gastos_condominio', function (Blueprint $table) {
            $table->increments('id_gasto_condominio');
            $table->integer('id_condominio')->unsigned();
            $table->foreign('id_condominio')->references('id_condominio')->on('tbl_condominio');
            $table->string('descripcion_gasto',100);
            $table->integer('monto_gasto');
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
        Schema::dropIfExists('tbl_gastos_condominio');
    }
}
