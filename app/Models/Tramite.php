<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'tipo',
        'nombre_tramite',
        'estado',
        'ultimo_contacto',
    ];
}
