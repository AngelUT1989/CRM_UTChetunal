<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReporteExport;

class ReportesController extends Controller
{
    public function index()
    {
        $totalComunicaciones = DB::table('comunicaciones')->count();
        $reportesMes = DB::table('reportes')
            ->whereMonth('created_at', now()->month)
            ->count();
        $tramitesCompletados = DB::table('tramites')
            ->where('estado', 'completado')
            ->count();

        $data = compact('totalComunicaciones', 'reportesMes', 'tramitesCompletados');

        return view('reportes.index', ['data' => $data]);
    }

    public function exportPDF()
    {
        $data = [
            'totalComunicaciones' => DB::table('comunicaciones')->count(),
            'reportesMes' => DB::table('reportes')->whereMonth('created_at', now()->month)->count(),
            'tramitesCompletados' => DB::table('tramites')->where('estado', 'completado')->count(),
        ];

        $pdf = Pdf::loadView('reportes.pdf', $data); 
        return $pdf->download('reporte_general.pdf');
    }

}

