<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Ride;
use App\Models\User;

class Vehiculo extends Model
{
    use HasFactory;

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
        return $this->belongsTo(User::class, 'id_chofer', 'id');
    }

    public function rides()
    {
        return $this->hasMany(Ride::class, 'id_vehiculo', 'id_vehiculo');
    }
}
