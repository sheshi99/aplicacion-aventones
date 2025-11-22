<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class vehiculo extends Model
{
    protected $table = 'vehiculos';
    protected $primaryKey = 'id_vehiculo';
    public $timestamps = false; 

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
}
