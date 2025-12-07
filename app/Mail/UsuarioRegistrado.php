<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class UsuarioRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    // Define cómo se construye el correo
    public function build()
    {
        return $this->subject('Activa tu cuenta en Aventones App')
                    ->view('emails.usuario_registrado')
                    ->with([
                        'user' => $this->user,
                        'token' => $this->user->token_activacion,
                    ]);
    }
}
