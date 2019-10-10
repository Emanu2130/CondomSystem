<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblCuentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_cuentas', function (Blueprint $table) {
            $table->increments('id_cuenta');
            $table->integer('id_proveedor')->unsigned();
            $table->integer('id_tipo_cuenta')->unsigned();
            $table->foreign('id_proveedor')->references('id_proveedor')->on('tbl_proveedores');
            $table->foreign('id_tipo_cuenta')->references('id_tipo_cuenta')->on('tbl_tipo_cuenta');
            $table->string('nro_factura', 100);
            $table->integer('monto');
            $table->integer('pago_abono');
            $table->date('fecha_pago');
            $table->integer('monto_pagado');
            $table->string('tipo_nota', 100);
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
        Schema::dropIfExists('tbl_cuentas');
    }
}
