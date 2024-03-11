<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("usuariosCss/usuarioFormulario.Css?1.0")}}">
    <title>Formulario actualizar usuario</title>
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

      <h1>Formulario de actualizar usuario</h1>
      <form action="{{route("storeActualizarUsuario")}}" method="GET">
        @csrf
        <input type="hidden" value="{{$usuario->id}}" name="id">
        <input type="hidden" value="{{$usuario->cedula}}" name="oldCedula">

        <label for="cedula">Cédula:</label>
        <input type="text" name="cedula" value="{{$usuario->cedula}}" required>
        <label for="nombre">Nombre completo:</label>
        <input type="text" name="nombre" value="{{$usuario->nombre}}" required>
        <label for="telefono">Teléfono:</label>
        <input type="tel" name="telefono" value="{{$usuario->telefono}}" required inputmode="numeric">
        <label for="direccion">Dirección:</label>
        <textarea id="direccion" name="direccion" rows="4" required>{{$usuario->direccion}}</textarea>
        <label for="prestamo">Préstamo:</label>
        <input style="background-color: cadetblue" type="number" name="prestamo" value="{{$usuario->prestamo}}" readonly>
        <label for="intereses">Monto en intereses ganados:</label>
        <input style="background-color: cadetblue" type="number" name="intereses" value="{{$usuario->intereses}}" readonly>
        <label for="periodo">Selecciona el metodo de pago:</label>
        <select name="metodoPago" required>
          <option value="{{$usuario->metodoPago}}">{{$usuario->metodoPago}}</option>
          <option value="Diario">Diario</option>
          <option value="Semanal">Semanal</option>
          <option value="Quincenal">Quincenal</option>
          <option value="Mensual">Mensual</option>
        </select>
        <br><br>
        <input type="submit" value="Actualizar datos">
      </form>
</body>
</html>