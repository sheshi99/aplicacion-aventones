<?php

namespace App\Models;
use App\Models\Ride;

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


    public function chofer()
    {
        return $this->belongsTo(Usuario::class, 'id_chofer', 'id_usuario');
    }

    public function rides()
    {
        return $this->hasMany(Ride::class, 'id_vehiculo', 'id_vehiculo');
    }
}
