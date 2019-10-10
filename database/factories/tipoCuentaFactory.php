<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_tipo_cuenta;
use Faker\Generator as Faker;

$factory->define(tbl_tipo_cuenta::class, function (Faker $faker) {
    $tipo_cuenta = ['por cobrar', 'por pagar'];
    return [
        'cuenta'=>$tipo_cuenta[rand(0,1)]
    ];
});
