<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tbl_condominio;
use App\tbl_inmueble;
use Faker\Generator as Faker;

function get_alicuota($id_condominio){
    $gasto_total = 0;
    $alicuota = 0;
    foreach ($_SESSION['gastos_condominio'] as $gasto) {
        if($gasto['id'] == $id_condominio){
            $gasto_total += $gasto['monto'];
        }
    }
    $alicuota = $gasto_total / 100;
    return $alicuota;
}

$factory->define(tbl_inmueble::class, function (Faker $faker) {
    $condominios = tbl_condominio::all()->pluck('id_condominio')->toArray();
    $_SESSION['gastos_condominio'] = array();
    $_SESSION['aux'] = 1;
    foreach ($condominios as $condo) {
        $gastos_condominio_aux = DB::table('tbl_gastos_condominio')->where('id_condominio', '=', $condo)->get('monto_gasto');
        $gastos_condo_total = 0;
        foreach ($gastos_condominio_aux as $gasto) {
            $gastos_condo_total += $gasto->monto_gasto;
        }
        array_push($_SESSION['gastos_condominio'], ['monto' => $gastos_condo_total, 'id'=>$condo]);
    }

    return [
        'id_condominio'=>$_SESSION['aux']++,
        'nro_inmueble' => rand(1,100) . $faker->randomLetter,
        'nombre_propietario'=>$faker->name,
        'alicuota'=>5
    ];
});
