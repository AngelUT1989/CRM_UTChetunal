<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Solicitud;
use App\Models\Prospecto;

class ProspectosSeeder extends Seeder
{
    public function run()
    {
        $solicitudes = Solicitud::all();

        foreach ($solicitudes as $solicitud) {
            Prospecto::create([
                'nombre' => $solicitud->nombre,
                'correo' => $solicitud->correo,
                'telefono' => $solicitud->telefono,
                'fecha_aceptacion' => $solicitud->fecha_registro,
                'estado' => 'Nuevo', // Estado por defecto
                'fecha_inicio_proceso' => now(),
                'id_solicitud' => $solicitud->id_solicitudes
            ]);
        }
    }
}