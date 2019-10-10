<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblReciboInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_recibo_inmueble', function (Blueprint $table) {
            $table->increments('id_recibo_inmueble');
            $table->integer('id_inmueble')->unsigned();
            $table->foreign('id_inmueble')->references('id_inmueble')->on('tbl_inmueble');
            $table->string('mes', 100);
            $table->integer('monto');
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
        Schema::dropIfExists('tbl_recibo_inmueble');
    }
}
