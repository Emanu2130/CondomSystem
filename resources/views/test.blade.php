<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>

        @foreach ($cuentas as $cuenta)
            <tr>
                @foreach ($proveedores as $proveedor)
                    @if ($proveedor['id_proveedor'] == $cuenta['id_proveedor'])
                        <td>{{$proveedor['nombre']}}</td>
                    @endif
                @endforeach
                @foreach ($tipos_de_cuentas as $tipo)
                    @if ($tipo['id_tipo_cuenta'] == $cuenta['id_tipo_cuenta'])
                        <td>{{$tipo['cuenta']}}</td>
                    @endif
                @endforeach
                <td>{{$cuenta['nro_factura']}}</td>
                <td>{{$cuenta['monto']}}</td>
                <td>{{$cuenta['created_at']}}</td>
                <td>{{$cuenta['pago_abono']}}</td>
                <td>{{$cuenta['fecha_pago']}}</td>
                <td>{{$cuenta['monto_pagado']}}</td>
                <td>{{$cuenta['tipo_nota']}}</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
