<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_condominio;
use App\tbl_inmueble;
use Faker\Generator as Faker;

$factory->define(tbl_inmueble::class, function (Faker $faker) {
    $condominios = tbl_condominio::all()->pluck('id_condominio')->toArray();
    return [

    ];
});
