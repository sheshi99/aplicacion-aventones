<?php

namespace App\Models;
use App\Models\Ride;
use App\Models\User;


use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = true; 

    protected $fillable = [
        'id_chofer',
        'numero_placa',
        'color',
        'marca',
        'modelo',
        'anno',
        'capacidad_asientos',
        'fotografia'
    ];

    // Un vehículo pertenece a un chofer
    public function chofer()
    {
        return $this->belongsTo(User::class, 'id_chofer', 'id');

    }

    // Un vehículo puede tener muchos rides
    public function rides()
    {
        return $this->hasMany(Ride::class, 'id_vehiculo', 'id_vehiculo');
    }
}
