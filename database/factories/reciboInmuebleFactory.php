<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_inmueble;
use App\tbl_recibo_inmueble;
use App\tbl_status_pago;
use Faker\Generator as Faker;

$factory->define(tbl_recibo_inmueble::class, function (Faker $faker) {
    $inmueble = tbl_inmueble::all()->pluck('id_inmueble')->toArray();
    $status = tbl_status_pago::all()->pluck('id_status_pago')->toArray();
    return [
    'id_inmueble'=>$inmueble[rand(0, (count($inmueble)-1))],
    'mes'=> $faker->monthName('now'),
    'monto'=> $faker->randomNumber,
    'id_status_pago'=>$status[rand(0, (count($status)-1))],
    ];
});
