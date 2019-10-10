<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblInmuebleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_inmueble', function (Blueprint $table) {
            $table->increments('id_inmueble');
            $table->integer('nro_inmueble')->unique();
            $table->string('nombre_propietario', 50);
            $table->integer('alicuota');
            $table->timestamps();
            $table->integer('id_condominio')->unsigned();
            $table->foreign('id_condominio')->references('id_condominio')->on('tbl_condominio')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_inmueble');
    }
}
