<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_proveedores;
use Faker\Generator as Faker;

$factory->define(tbl_proveedores::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->name,
        'direccion'=>$faker->address,
        'telefono'=>$faker->e164PhoneNumber,
        'activo'=>false
    ];
});
