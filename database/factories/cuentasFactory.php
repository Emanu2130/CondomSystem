<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_cuentas;
use App\tbl_proveedores;
use App\tbl_tipo_cuenta;
use Faker\Generator as Faker;

$factory->define(tbl_cuentas::class, function (Faker $faker) {
    $proveedores = tbl_proveedores::all()->pluck('id_proveedor')->toArray();
    $tipos_de_cuenta = tbl_tipo_cuenta::all()->pluck('id_tipo_cuenta')->toArray();
    return [
        'id_proveedor'=>$proveedores[rand(0, (count($proveedores)-1))],
        'id_tipo_cuenta'=>$tipos_de_cuenta[rand(0, (count($tipos_de_cuenta)-1))],
        'nro_factura'=>$faker->swiftBicNumber,
        'monto'=>$faker->randomNumber,
        'pago_abono'=>$faker->randomNumber,
        'fecha_pago'=>$faker->date('Y-m-d', (rand(1, 20) . 'weeks ago')),
        'monto_pagado'=>$faker->randomNumber,
        'tipo_nota'=>$faker->sentence()
    ];
});
