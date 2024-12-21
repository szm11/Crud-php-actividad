<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rutas extends Model {
    protected $table = 'rutas_escolares'; // Nombre de la tabla

    // Desactivar las marcas de tiempo
    public $timestamps = false;

    // Definir los campos que se pueden asignar masivamente
    protected $fillable = [
        'capacidad',
        'estado',
        'kilometraje'
    ];
}
