<?php

namespace App\Http\Controllers;

use App\Models\Prospecto;
use App\Models\Solicitud;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ProspectoController extends Controller
{
    public function index()
    {
        $prospectos = Prospecto::with('solicitud')
            ->orderBy('id_prospecto', 'desc')
            ->get();

        return view('prospectos.index', compact('prospectos'));
    }

    public function create()
    {
        return view('prospectos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'               => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'correo'               => 'required|email|unique:solicitudes,correo',
            'telefono'             => 'required|string|max:20',
            'carrera'              => 'required|string|max:255',
            'referencia'           => 'nullable|string|max:255',
            'escuela'              => 'nullable|string|max:255',
            'estado'               => 'required|in:evaluacion,documentacion,admitido,rechazado',
            'fecha_inicio_proceso' => 'nullable|date',
            'fecha_aceptacion'     => 'nullable|date'
        ]);

        DB::transaction(function () use ($request) {
            // Crear solicitud
            $solicitud = Solicitud::create([
                'nombre'               => $request->nombre,
                'apellidos'            => $request->apellidos,
                'correo'               => $request->correo,
                'telefono'             => $request->telefono,
                'carrera'              => $request->carrera,
                'referencia'           => $request->referencia,
                'escuela'              => $request->escuela,
                'aceptacion_terminos'  => $request->get('aceptacion_terminos', false),
                'fecha_registro'       => now(),
            ]);

            // Crear prospecto asociado
            Prospecto::create([
                'id_solicitudes'       => $solicitud->id_solicitudes,
                'estado'               => $request->estado,
                'fecha_inicio_proceso' => $request->fecha_inicio_proceso,
                'fecha_aceptacion'     => $request->fecha_aceptacion,
            ]);
        });

        return redirect()->route('prospectos.index')
                         ->with('success', 'Prospecto creado exitosamente');
    }

    public function edit($id)
    {
        $prospecto = Prospecto::with('solicitud')->findOrFail($id);
        return view('prospectos.edit', compact('prospecto'));
    }

    public function update(Request $request, $id)
    {
        $prospecto = Prospecto::with('solicitud')->findOrFail($id);

        $request->validate([
            'nombre'               => 'required|string|max:255',
            'apellidos'            => 'required|string|max:255',
            'correo'               => [
                'required',
                'email',
                Rule::unique('solicitudes', 'correo')
                    ->ignore($prospecto->solicitud->id_solicitudes, 'id_solicitudes'),
            ],
            'telefono'             => 'required|string|max:20',
            'carrera'              => 'required|string|max:255',
            'referencia'           => 'nullable|string|max:255',
            'escuela'              => 'nullable|string|max:255',
            'estado'               => 'required|in:evaluacion,documentacion,admitido,rechazado',
            'fecha_inicio_proceso' => 'nullable|date',
            'fecha_aceptacion'     => 'nullable|date',
        ]);

        DB::transaction(function () use ($request, $prospecto) {
            // Actualizar datos en solicitudes
            $prospecto->solicitud->update([
                'nombre'     => $request->nombre,
                'apellidos'  => $request->apellidos,
                'correo'     => $request->correo,
                'telefono'   => $request->telefono,
                'carrera'    => $request->carrera,
                'referencia' => $request->referencia,
                'escuela'    => $request->escuela,
            ]);

            // Actualizar datos en prospectos
            $prospecto->update([
                'estado'               => $request->estado,
                'fecha_inicio_proceso' => $request->fecha_inicio_proceso,
                'fecha_aceptacion'     => $request->fecha_aceptacion,
            ]);
        });

        return redirect()->route('prospectos.index')
                         ->with('success', 'Prospecto actualizado exitosamente');
    }

    public function destroy($id)
    {
        $prospecto = Prospecto::findOrFail($id);

        DB::transaction(function () use ($prospecto) {
            // Eliminar prospecto
            $prospecto->delete();
            // Opcional: eliminar la solicitud asociada
            if ($prospecto->solicitud) {
                $prospecto->solicitud->delete();
            }
        });

        return redirect()->route('prospectos.index')
                         ->with('success', 'Prospecto eliminado exitosamente');
    }
}
