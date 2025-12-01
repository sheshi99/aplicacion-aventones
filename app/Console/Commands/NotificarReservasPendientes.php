<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reserva;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificarChoferReservaPendiente;

class NotificarReservasPendientes extends Command
{
    protected $signature = 'notificar:reservas {minutos}';
    protected $description = 'Notifica a los choferes sobre reservas pendientes por más de X minutos';

    public function handle()
    {
        $minutos = $this->argument('minutos');

        $this->info("Buscando reservas con más de $minutos minutos...");

        $limite = Carbon::now()->subMinutes($minutos);

        $reservas = Reserva::where('estado', 'Pendiente')
            ->where('created_at', '<=', $limite)
            ->get();

        if ($reservas->isEmpty()) {
            $this->info("No hay reservas pendientes.");
            return;
        }

        foreach ($reservas as $reserva) {

            // Guardar minutos para usar en el correo
            $reserva->minutos = $minutos;

            // Importante: el atributo correcto es ->email
            $correoChofer = $reserva->ride->chofer->email;

            Mail::to($correoChofer)
                ->send(new NotificarChoferReservaPendiente($reserva));
        }

        $this->info("Correos enviados correctamente.");
    }
}
