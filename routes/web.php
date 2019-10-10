<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\tbl_proveedores;
Route::get('/', function () {
    var_dump(tbl_proveedores::all()->pluck('id_proveedor')->toArray());
});
