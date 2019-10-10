<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_condominio;
use Faker\Generator as Faker;

$factory->define(tbl_condominio::class, function (Faker $faker) {
    return [
        'nombre_condominio'=>$faker->secondaryAddress,
         'direccion'=> $faker->address,
         'porcentaje_reserva'=> rand(5,15),
         'activo'=> false
    ];
});
