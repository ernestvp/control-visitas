<?php

namespace App\Models;

use CodeIgniter\Model;

class VisitaModel extends Model
{
    protected $table      = 'visitas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre', 'apellidos', 'dni',
        'motivo', 'persona_visitada', 'entrada', 'salida'
    ];
}