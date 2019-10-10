<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblPagosInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_pagos_inmueble', function (Blueprint $table) {
            $table->integer('id_recibo_inmueble')->unsigned();
            $table->foreign('id_recibo_inmueble')->references('id_recibo_inmueble')->on('tbl_recibo_inmueble');
            $table->string('mes', 100);
            $table->integer('monto_mes');
            $table->integer('monto_pegado');
            $table->integer('id_status_pago')->unsigned();
            $table->foreign('id_status_pago')->references('id_status_pago')->on('tbl_status_pago');
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
        Schema::dropIfExists('tbl_pagos_inmueble');
    }
}
