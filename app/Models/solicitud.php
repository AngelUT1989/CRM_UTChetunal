<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    protected $table = 'solicitudes';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function getEstadoAttribute()
    {
        return $this->aceptacion;
    }
}
