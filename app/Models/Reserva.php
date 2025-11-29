<?php

namespace App\Models;
use App\Models\User;
use App\Models\Ride;

use Illuminate\Database\Eloquent\Model;

class Reserva extends Model
{
    protected $table = 'reservas';
    protected $primaryKey = 'id_reserva';
    public $timestamps = true;

    protected $fillable = [
        'id_ride',
        'id_pasajero',
        'estado',
    ];

     public function ride()
    {
        return $this->belongsTo(Ride::class, 'id_ride', 'id_ride');
    }

    public function pasajero()
    {
        return $this->belongsTo(User::class, 'id_pasajero', 'id');
    }

}
