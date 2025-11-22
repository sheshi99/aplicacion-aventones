<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    public $timestamps = false;

    protected $fillable = [
        'id_ride',
        'id_pasajero',
        'fecha_reserva',
        'estado',
    ];

    // Una reserva pertenece a un ride
    public function ride()
    {
        return $this->belongsTo(Ride::class, 'id_ride', 'id_ride');
    }

    // Una reserva pertenece a un pasajero
    public function pasajero()
    {
        return $this->belongsTo(Usuario::class, 'id_pasajero', 'id_usuario');
    }
}
