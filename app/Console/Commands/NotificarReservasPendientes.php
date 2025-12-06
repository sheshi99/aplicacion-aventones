<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Reserva;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotificarChoferReservaPendiente;

class NotificarReservasPendientes extends Command
{
    protected $signature = 'notificar:reservas {minutos?}';
    protected $description = 'Notifica reservas pendientes con más de X minutos';

    public function handle()
    {
        // --- Obtener o preguntar minutos ---
       $minutos = $this->argument('minutos');

        if (!is_numeric($minutos) || $minutos <= 0) {
            $this->error("Ingrese un número válido.");
            return;
        }

        $this->info("⏳ Buscando reservas pendientes con más de $minutos minutos...");

         // --- Limite de creación ---
        $limite = Carbon::now()->subMinutes($minutos);
        $ahora = Carbon::now();

        // --- Consulta Eloquent ---
        $reservas = Reserva::where('estado', 'Pendiente')
            ->where('created_at', '<=', $limite)
            ->whereHas('ride', function ($q) use ($ahora) {
                // Solo rides futuros (combinando día y hora)
                $q->whereRaw("CONCAT(dia, ' ', hora) >= ?", [$ahora->format('Y-m-d H:i:s')]);
            })
            ->get();

        if ($reservas->isEmpty()) {
            $this->info("✅ No hay reservas pendientes.");
            return;
        }

        $total = 0;

        // --- Enviar correos ---
        foreach ($reservas as $reserva) {

            $chofer = $reserva->ride->chofer;

            $this->info("📩 Enviando a: {$chofer->nombre} ({$chofer->email})...");

            $reserva->minutos = $minutos; // Igual que tu script

            try {
                Mail::to($chofer->email)
                    ->send(new NotificarChoferReservaPendiente($reserva));

                $this->info("✅ Enviado");
                $total++;
            } catch (\Exception $e) {
                $this->error("❌ Error: " . $e->getMessage());
            }
        }

        $this->info("\n🎉 Total de correos enviados: $total");
    }
}
