<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_condominio;
use App\tbl_gastos_condominio;
use Faker\Generator as Faker;

$factory->define(tbl_gastos_condominio::class, function (Faker $faker) {
    $condominios = tbl_condominio::all()->pluck('id_condominio')->toArray();
    return [
        'id_condominio'=>$condominios[rand(0, (count($condominios)-1))],
        'descripcion_gasto'=>$faker->sentence(),
        'monto_gasto'=> rand(0, 1000000)

    ];
});
