<?php

namespace App\Mail;

use Illuminate\Bus\Queueable; // Trait que permite poner el correo en cola
use Illuminate\Mail\Mailable; // Clase base de Laravel para crear correos
use Illuminate\Queue\SerializesModels; // Trait que serializa modelos al enviarlos en correos
use App\Models\Reserva;


class NotificarChoferReservaPendiente extends Mailable
{
    use Queueable, SerializesModels;

    public $reserva;

    public function __construct(Reserva $reserva)
    {
        $this->reserva = $reserva; // Guarda la reserva para usarla en la vista del correo
    }

    // Define cómo se construye el correo
    public function build()
    {
        return $this->subject("🚗 Tienes reservas pendientes")
                    ->view('emails.notificar_chofer');
    }
}
