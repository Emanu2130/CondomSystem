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

        @foreach ($recibos as $recibo)
            <tr>
                @foreach ($status as $estado)
                    @if ($estado['descripcion'] == 'Pendiente')
                        @if ($estado['id_status_pago'] == $recibo['id_status_pago'])
                            @foreach ($inmuebles as $inmueble)
                                @if ($inmueble['id_inmueble'] == $recibo['id_inmueble'])
                                    <td>{{$inmueble['nro_inmueble']}}</td>
                                    <td>{{$inmueble['nombre_propietario']}}</td>
                                    <td>{{$recibo['mes']}}</td>
                                    <td>{{$recibo['monto']}} $</td>
                                    <td>{{$estado['descripcion']}}</td>
                                @endif
                            @endforeach
                        @endif
                    @endif
                @endforeach
            </tr>
        @endforeach
    </table>
</body>
</html>
