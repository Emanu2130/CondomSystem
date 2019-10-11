<?php

namespace App\Http\Controllers;

use App\tbl_cuentas;
use App\tbl_inmueble;
use App\tbl_proveedores;
use App\tbl_recibo_inmueble;
use App\tbl_status_pago;
use App\tbl_tipo_cuenta;
use Illuminate\Http\Request;

class proveedoresController extends Controller
{
    /* TODO LO QUE DIGA TEST EN VIEW "view('test') CAMBIELO POR EL NOMBRE DE LA VISTA QUE UD VAYA A CREAR" */
    public function listado(){
        $proveedores = tbl_proveedores::all()->toArray();
        return view('test')->with('proveedores', $proveedores);
    }

    public function estado_de_cuentas(){
        $cuentas = tbl_cuentas::all()->toArray();
        $proveedores = tbl_proveedores::all()->toArray();
        $tipos_de_cuentas = tbl_tipo_cuenta::all()->toArray();

        return view('test')->with(['cuentas'=>$cuentas, 'proveedores'=>$proveedores, 'tipos_de_cuentas'=>$tipos_de_cuentas]);
    }

    public function historico_de_cuentas(){
        $proveedores = tbl_proveedores::all()->toArray();
        return view('test')->with('proveedores', $proveedores);
    }

    public function pagos_del_mes(){
        $proveedores = tbl_proveedores::all()->toArray();
        return view('test')->with('proveedores', $proveedores);
    }

    public function pendientes(){
        $recibos = tbl_recibo_inmueble::all()->toArray();
        $status = tbl_status_pago::all()->toArray();
        $inmuebles = tbl_inmueble::all()->toArray();
        return view('testPendientes')->with(['status'=>$status, 'recibos'=>$recibos, 'inmuebles'=>$inmuebles]);
    }
}
