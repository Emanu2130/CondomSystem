<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_status_pago;
use Faker\Generator as Faker;

$factory->define(tbl_status_pago::class, function (Faker $faker) {
    $descripcion = ['Cancelado', 'Pendiente', 'Vencido'];
    return [
        'descripcion'=>$descripcion[rand(0,2)]
    ];
});
