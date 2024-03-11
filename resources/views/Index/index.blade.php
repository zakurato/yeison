<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset("indexCss/index.Css?1.0")}}">
    <title>Login</title>
</head>
<body>
    <div class="container">
		<h1>Jason</h1>
		<form action="{{route("verificarLogin")}}" method="GET">
			@csrf
			<label for="username">Correo:</label>
			<input type="text"  name="email" placeholder="Correo..." required>
			<label for="password">Contraseña:</label>
			<input type="password"  name="password" placeholder="Contraseña..." required>
            {{session("errorLogueo")}}
			<button type="submit">Login</button>
		</form>
	</div>
</body>
</html>