<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reserva;
use App\Models\Vehiculo;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ride extends Model
{
    use HasFactory;
    protected $table = 'rides';
    protected $primaryKey = 'id_ride';
    public $timestamps = false; 

    protected $fillable = [
        'id_chofer',
        'id_vehiculo',
        'nombre',
        'salida',
        'llegada',
        'dia',
        'hora',
        'costo',
        'espacios',
        'vehiculo_placa',
        'vehiculo_marca',
        'vehiculo_modelo',
        'vehiculo_anio'
    ];

    // ========= RELACIONES =========

    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }

    public function chofer()
    {
        return $this->belongsTo(User::class, 'id_chofer', 'id');
    }

    public function reservas()
    {
        return $this->hasMany(Reserva::class, 'id_ride', 'id_ride');
    }

}
