<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;      // <-- Asegúrate de importar DB


class Solicitud extends Model
{
    use HasFactory;

    protected $table = 'solicitudes';
    protected $primaryKey = 'id_solicitudes';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'apellidos',
        'correo',
        'telefono',
        'carrera',
        'referencia',
        'escuela',
        'aceptacion_terminos',
        'fecha_registro',
        'status'    // <-- nuevo
    ];



    public function prospecto()
{
    return $this->hasOne(Prospecto::class, 'id_solicitudes', 'id_solicitudes');
}
}