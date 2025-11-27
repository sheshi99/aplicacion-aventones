<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
     protected $table = 'rides';
    protected $primaryKey = 'id_ride';
    public $timestamps = false; // No tiene created_at ni updated_at

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

}
