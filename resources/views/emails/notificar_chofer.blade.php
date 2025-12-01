<p>Hola {{ $reserva->ride->chofer->name }},</p>

<p>Tienes una solicitud de reserva pendiente por más de  {{ $reserva->minutos }} minutos.</p>

<p><strong>Ride:</strong> {{ $reserva->ride->nombre }}</p>
<p><strong>Salida:</strong> {{ $reserva->ride->salida }}</p>
<p><strong>Llegada:</strong> {{ $reserva->ride->llegada }}</p>
<p><strong>Fecha y hora:</strong> {{ $reserva->ride->dia }} {{ $reserva->ride->hora }}</p>
<p><strong>Pasajero:</strong> {{ $reserva->pasajero->name }}</p>

<p>Por favor ingresa al sistema y revisa tus solicitudes.</p>
