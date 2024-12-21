<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model {
    protected $table = 'contratos'; // Nombre de la tabla

    // Desactivar las marcas de tiempo
    public $timestamps = false;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'fecha_inicio',
        'fecha_fin',
        'modalidad',
        'tarifa',
        'ruta_id',
    ];
}
