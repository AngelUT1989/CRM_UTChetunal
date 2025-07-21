<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solicitud;
use App\Models\Prospecto;
use App\Mail\Bienvenido;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;        // <-- Importa la fachada DB aquí
use Carbon\Carbon;

class SolicitudController extends Controller
{
    /**
     * Mostrar listado de solicitudes pendientes (o ajusta el filtro como necesites)
     */
    public function index()
    {
        // Si quieres mostrar solo las solicitudes que aún no han sido convertidas:
        $solicitudes = Solicitud::where('aceptacion_terminos', 0)
                                ->orderBy('fecha_registro', 'desc')
                                ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    /**
     * Actualizar aceptación de términos y, si aplica, crear prospecto y enviar correo
     */
    public function updateAceptacion(Request $request, $id)
    {
        $request->validate([
            'aceptacion' => 'required|in:0,1',
        ]);

        $sol = Solicitud::findOrFail($id);
        $sol->aceptacion_terminos = $request->aceptacion;
        $sol->save();

        if ($sol->aceptacion_terminos == 1) {
            Prospecto::firstOrCreate(
                ['id_solicitudes' => $sol->id_solicitudes],
                [
                    'fecha_aceptacion'     => Carbon::now()->toDateString(),
                    'estado'               => 'evaluacion',
                    'fecha_inicio_proceso' => Carbon::now()->toDateTimeString(),
                ]
            );

            Mail::to($sol->correo)
                ->send(new Bienvenido($sol));
        }

        return redirect()
            ->route('solicitudes.index')
            ->with('success', 'Seguimiento actualizado correctamente.');
    }

    /**
     * Actualizar el status: seguir, pendiente o eliminar
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pendiente,en_seguimiento,eliminar',
        ]);

        $sol = Solicitud::findOrFail($id);

        if ($request->status === 'eliminar') {
            $sol->delete();
            return redirect()
                ->route('solicitudes.index')
                ->with('success', 'Solicitud eliminada correctamente.');
        }

        // Ahora sí puedes usar DB::transaction sin errores
        DB::transaction(function () use ($sol, $request) {
            $sol->update(['status' => $request->status]);

            if ($request->status === 'en_seguimiento') {
                Prospecto::firstOrCreate(
                    ['id_solicitudes' => $sol->id_solicitudes],
                    [
                        'fecha_aceptacion'     => now()->toDateString(),
                        'estado'               => 'evaluacion',
                        'fecha_inicio_proceso' => now()->toDateTimeString(),
                    ]
                );
            }
        });

        return redirect()
            ->route('solicitudes.index')
            ->with('success', 'Estado actualizado correctamente.');
    }
}
