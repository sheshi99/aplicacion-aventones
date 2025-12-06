<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Activación de cuenta</title>
</head>
<body>
    <h1>¡Bienvenido a Aventones App!</h1>

    <p>Hola {{ $user->name }} {{ $user->apellido }},</p>

    <p>Tu cuenta ha sido registrada exitosamente con el rol <strong>{{ $user->rol }}</strong>.</p>

    <p>Para activar tu cuenta, haz clic en el siguiente enlace:</p>

    <p>
        <a href="{{ url('/activar-cuenta/' . $token) }}">
            Activar cuenta
        </a>
    </p>

    <p>Gracias por unirte a nuestra aplicación.</p>
    <p>Saludos,<br>Aventones App</p>
</body>
</html>
