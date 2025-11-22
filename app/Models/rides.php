<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class rides extends Model
{
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
        'espacios'
    ];

    // Un ride pertenece a un chofer (usuario)
    public function chofer()
    {
        return $this->belongsTo(Usuario::class, 'id_chofer', 'id_usuario');
    }

    // Un ride pertenece a un vehículo
    public function vehiculo()
    {
        return $this->belongsTo(Vehiculo::class, 'id_vehiculo', 'id_vehiculo');
    }
}
