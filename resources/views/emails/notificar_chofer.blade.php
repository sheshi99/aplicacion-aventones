<html>
<body style="font-family: Arial; background:#f2f4f7; padding:20px;">

<div style="max-width:600px;margin:auto;background:#ffffff;padding:30px;border-radius:12px;box-shadow:0 2px 8px rgba(0,0,0,0.1);">

    <div style="text-align: center; margin-bottom: 25px;">
    <div style="font-size: 60px; line-height: 1;">🚗</div>
    <h2 style="color: #1976D2; margin: 0; font-size: 28px;">Reservas Pendientes</h2>
    </div>

    <p>Hola <strong>{{ $reserva->ride->chofer->name }} {{ $reserva->ride->chofer->apellido }}</strong>,</p>

    <p>
        Tienes una reserva que lleva más de 
        <strong>{{ $reserva->minutos }} minutos</strong> sin respuesta.
    </p>

    <hr style="margin:25px 0; border:0; border-top:1px solid #e1e1e1;">

    <h3 style="color:#1976D2; margin-bottom:10px;">Detalles del Ride</h3>

    <p><strong>Nombre:</strong> {{ $reserva->ride->nombre }}</p>
    <p><strong>Salida:</strong> {{ $reserva->ride->salida }}</p>
    <p><strong>Llegada:</strong> {{ $reserva->ride->llegada }}</p>
    <p><strong>Fecha y hora:</strong> {{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</p>

    <h3 style="color:#1976D2; margin:25px 0 10px;">Pasajero</h3>
    <p><strong>Nombre:</strong> {{ $reserva->pasajero->name }} {{ $reserva->pasajero->apellido }}</p>

    <hr style="margin:25px 0; border:0; border-top:1px solid #e1e1e1;">

    <p>
        Por favor ingresa al sistema y revisa tus solicitudes en la sección de reservas.
    </p>

</div>

</body>
</html>

