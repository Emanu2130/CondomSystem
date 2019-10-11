<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_pagos_inmueble;
use App\tbl_recibo_inmueble;
use App\tbl_status_pago;
use Faker\Generator as Faker;

$factory->define(tbl_pagos_inmueble::class, function (Faker $faker) {
    $recibos = tbl_recibo_inmueble::all()->pluck('id_recibo_inmueble')->toArray();
    $status = tbl_status_pago::all()->pluck('id_status_pago')->toArray();

    return [
        'id_recibo_inmueble'=>$recibos[rand(0, (count($recibos
        )-1))],
        'mes'=>$faker->monthName('now'),
        'monto_mes'=>$faker->numberBetween(1000, 100000),
        'monto_pegado'=>$faker->numberBetween(1000, 100000),
        'id_status_pago'=>$status[rand(0, (count($status
        )-1))],
    ];
});
