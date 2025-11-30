<p>Hola {{ $reserva->ride->chofer->nombre }},</p>

<p>Tienes una solicitud de reserva pendiente por más de  {{ $reserva->minutos }} minutos.</p>

<p><strong>Ride:</strong> {{ $reserva->ride->nombre }}</p>
<p><strong>Pasajero:</strong> {{ $reserva->pasajero->nombre }}</p>

<p>Por favor ingresa al sistema y revisa tus solicitudes.</p>
