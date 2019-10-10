<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_usuarios;
use Faker\Generator as Faker;

$factory->define(tbl_usuarios::class, function (Faker $faker) {
    return [
        'tipo_usuario' => 'inquilino',
        'usuario' => $faker->userName,
        'password' => $faker->password,
        'nombre' => $faker->name,
        'telefono' => $faker->phoneNumber,
        'activo' => false
    ];
});
