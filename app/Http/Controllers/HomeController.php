<?php

namespace App\Http\Controllers;

use App\Models\Solicitud;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // 1. Total de solicitudes
        $totalSolicitudes = Solicitud::count();

        // 2. Carreras más solicitadas
        $carreras = Solicitud::select('carrera', DB::raw('COUNT(*) as total'))
            ->groupBy('carrera')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // 3. Solicitudes por escuela
        $escuelas = Solicitud::select('escuela', DB::raw('COUNT(*) as total'))
            ->groupBy('escuela')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // 4. Solicitudes por referencia
        $referencias = Solicitud::select('referencia', DB::raw('COUNT(*) as total'))
            ->groupBy('referencia')
            ->orderByDesc('total')
            ->limit(8)
            ->get();

        return view('home', [
            'totalSolicitudes' => $totalSolicitudes,
            'carreras' => $carreras,
            'escuelas' => $escuelas,
            'referencias' => $referencias
        ]);
      
    }
}
