<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Llamado de emergencia</title>
</head>
<body>
    <p>Hola! {{$user->name}}.</p>
    <p>Estos son los datos de acceso al sistema:</p>
    <ul>
        <li>UserName: <strong>{{ $username }}</strong> </li>
        <li>Password: <strong>{{ $password }}</strong></li>

    </ul>


</body>
</html>
