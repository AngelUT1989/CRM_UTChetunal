<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospecto extends Model
{
    use HasFactory;

    protected $table = 'prospectos';
    protected $primaryKey = 'id_prospecto';
    public $timestamps = false;

    protected $fillable = [
        'id_solicitudes',
        'fecha_aceptacion',
        'estado',
        'fecha_inicio_proceso'
    ];

 
    public function solicitud()
{
    return $this->belongsTo(Solicitud::class, 'id_solicitudes', 'id_solicitudes');
}
}