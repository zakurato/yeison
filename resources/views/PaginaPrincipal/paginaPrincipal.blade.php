<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("paginaPrincipalCss/paginaPrincipal.Css")}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <title>Pagina principal</title>
</head>
<body>
    <nav>
        <ul>
          <li><a href="{{route("paginaPrincipal")}}">Inicio</a></li>
          <li><a href="{{route("formRegistrarUsuario")}}">Registrar usuario</a></li>
          <form action="{{route("deslogueo")}}" method="POST">
            @csrf
            <li><a href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a></li>
          </form>
        </ul>
      </nav>
      <br>
      {{session("guardadoCorrectamente")}}
      {{session("eliminadoCorrectamente")}}
      {{session("actualizadoCorrectamente")}}

      <br><br>
      <label for="total">Clientes</label>
      <input id="total-input" type="text" value="{{$clientes}}" readonly>
      <br><br>
      <label for="total">Total a cobrar a clientes</label>
      <input id="total-input" type="text" value="₡{{$sumaAcobrar}}" readonly>

      <br><br>


      <div class="container">
        <a href="{{route("tablaClientes", ['valor' => "Diario"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Diario</h3>
          </button>
        </a>

        <br><br>
      
        <a href="{{route("tablaClientes", ['valor' => "Semanal"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Semanal</h3>
          </button>
        </a>
        <br><br>

        <a href="{{route("tablaClientes", ['valor' => "Quincenal"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Quincenal</h3>
          </button>
        </a>
        <br><br>

        <a href="{{route("tablaClientes", ['valor' => "Mensual"])}}">
          <button class="btnActualizar">
            <h3>Clientes de pago Mensual</h3>
          </button>
        </a>
      </div>

      <div>
        <h4>Dia actual: {{$diaActual}}</h4>
        <h4>Dia de la semana: {{$diaSemana}}</h4>
        <h4>Hora actual: {{$horaActual}}</h4>
      </div>

      <div>
        <p>
          //SEMANAL
          <br>
          //si el dia de la semana es miercoles(3) pasar todos los estados "0" a "-1"
          <br>
          //si el dia de la semana es miercoles(3) los estados "-1" quedan en "-1"
          <br>
          //si el dia de la semana es jueves(4) y la hora actual esta entre las (1am hasta las 8pm) pasar todos los estados "1" a color negro o estado "0"
        </p>
      </div>

      <div>
        <p>
          //QUINCENAL
          <br>
          //si el dia actual es (5) y el estado es (0) || si el dia actual es (20) y el estado es (0) pasan a (-1)
          <br>
          //si el dia actual es (5) y el estado es (-1) || si el dia actual es (20) y el estado es (-1) pasan a (-1)
          <br>
          //si el dia actual es (6) y el estado es (1) || si el dia actual es (21) y el estado es (1)  y la hora actual esta entre las (1am hasta las 8pm) pasan a (0)
        </p>
      </div>

</body>
</html>