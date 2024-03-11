<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("usuariosCss/abono.Css?1.0")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />

    <title>Abonos</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("tablaClientes", ['valor' => $usuario->metodoPago])}}">Inicio</a></li>
        </ul>
      </nav>

      <br>
      {{session("abonoAplicado")}}
      {{session("abonoExcedido")}}
      {{session("abonoEliminado")}}


      <br>
      <form action="">
      <label for="nombre">Nombre completo:</label>
      <input style="background-color: cadetblue" type="tel" name="nombre" value="{{$usuario->nombre}}" readonly>
      <label for="telefono">Teléfono:</label>
      <input style="background-color: cadetblue" type="tel" name="telefono" value="{{$usuario->telefono}}" readonly>
      <label for="direccion">Dirección:</label>
      <textarea style="background-color: cadetblue" id="direccion" name="direccion" rows="4" readonly>{{$usuario->direccion}}</textarea>
      <label for="prestamo">Préstamo:</label>
      <input style="background-color: cadetblue" type="number" name="prestamo" value="{{$usuario->prestamo}}" readonly>
      <label for="intereses">Digite el % en intereses ganados:</label>
      <input style="background-color: cadetblue" type="number" name="intereses" value="{{$usuario->intereses}}" readonly>
      <label for="periodo">Selecciona el metodo de pago:</label>
      <input style="background-color: cadetblue" type="tel" name="metodoPago" value="{{$usuario->metodoPago}}" readonly>
      <label for="interesesGanados">Intereses ganados:</label>
      <input style="background-color: cadetblue" type="tel" name="interesesGanados" value="{{$usuario->interesesGanados}}" readonly>
      <label for="saldo">Saldo inicial:</label>
      <input style="background-color: cadetblue" type="tel" name="saldo" value="{{$usuario->saldo}}" readonly>
      <label for="saldoRebajado">Saldo Actual:</label>
      <input style="background-color: cadetblue" type="tel" name="saldo" value="{{$usuario->saldoRebajado}}" readonly>
      <br><br>      
    </form>

    <form action="{{route("storeAbono")}}" method="POST">
        @csrf
        <input type="hidden" name="saldoInicial" value="{{$usuario->saldo}}">
        <input type="hidden" name="cedula" value="{{$usuario->cedula}}">
        <input type="hidden" name="saldoRebajado" value="{{$usuario->saldoRebajado}}">
        <input type="hidden" name="id" value="{{$usuario->id}}">

        <label for="abono">Digite el abono:</label>
        <input type="number" name="abono" min="0" pattern="^\d+$" required inputmode="numeric">
        <button class="btnAbono" type="submit">Aplicar abono</button>
    </form>

      <br><br>
      <h1>Tabla Abonos</h1>
      <br>

      <div class="table-container">
        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Cédula</th>
                <th>Nombre</th>
                <th>Abono</th>
                <th>Saldo actual</th>
                <th colspan="2">Fecha</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($abonos as $item)
              <tr>
                <td>{{$item->cedula}}</td>
                <td>{{$usuario->nombre}}</td>
                <td>{{$item->abono}}</td>
                <td>{{$item->saldo}}</td>
                <td>{{$item->created_at}}</td>
                <td>

                  @if ($item->created_at == $abonoUltimo->created_at)
                  <form id="eliminarUsuarioForm" action="{{route("eliminarAbono")}}" method="POST">
                    @method("delete")
                    @csrf
                    <input type="hidden" value="{{$item->id}}" name="id">
                    <button class="btnEliminar" type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar este abono?')">Eliminar abono</button>
                  </form>
                  @endif

              </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <br>

          @php
            $date = date('Y-m-d', strtotime($abonoUltimo->created_at));
          @endphp

          <button class="btnAbono" onclick="location.href='https://api.whatsapp.com/send?phone=+506{{$usuario->telefono}}&text=Nombre:%20{{$usuario->nombre}}%0AAbono:%20₡{{$abonoUltimo->abono}}%0ASaldo actual:%20₡{{$abonoUltimo->saldo}}%0AFecha:%20{{$date}}'">Enviar saldo</button>
        </div>
      </div>


</body>
</html>