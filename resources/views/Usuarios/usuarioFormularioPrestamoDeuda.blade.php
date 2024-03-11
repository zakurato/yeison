<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("usuariosCss/usuarioFormulario.Css?1.0")}}">
    <title>Formulario prestamo con Deuda</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("tablaClientes", ['valor' => $usuario->metodoPago])}}">Inicio</a></li>
        </ul>
      </nav>
      <br>
      {{session("usuarioRepite")}}
      {{session("usuarioNoExiste")}}

      <h1>Formulario prestamo con Deuda</h1>
      <form action="{{route("storeActualizarUsuarioPrestamoDeuda",["valor" => $usuario->metodoPago])}}" method="GET">
        @csrf
        <input type="hidden" value="{{$usuario->id}}" name="id">
        <input type="hidden" value="{{$usuario->cedula}}" name="oldCedula">

        <label for="cedula">Cédula:</label>
        <input style="background-color: cadetblue" type="text" name="cedula" value="{{$usuario->cedula}}" readonly>
        <label for="nombre">Nombre completo:</label>
        <input style="background-color: cadetblue" type="text" name="nombre" value="{{$usuario->nombre}}" readonly>
        <label for="telefono">Teléfono:</label>
        <input style="background-color: cadetblue" type="tel" name="telefono" value="{{$usuario->telefono}}" readonly>
        <label for="direccion">Dirección:</label>
        <textarea style="background-color: cadetblue" id="direccion" name="direccion" rows="4" readonly>{{$usuario->direccion}}</textarea>
        <label for="prestamo">Préstamo:</label>
        <input type="number" name="prestamo"  required inputmode="numeric">
        <label for="intereses">Digite el % en intereses ganados:</label>
        <input type="number" name="intereses" required inputmode="numeric">
        <label for="periodo">Metodo de pago:</label>
        <select name="metodoPago" required >
          <option value="{{$usuario->metodoPago}}">{{$usuario->metodoPago}}</option>
        </select>
        <br><br>
        <input type="submit" value="Actualizar prestamo">
      </form>
</body>
</html>