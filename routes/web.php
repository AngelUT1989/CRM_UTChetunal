<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;



Route::get('/', function () {
    return view('welcome'); 
});
Route::get('/home', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('home');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



//ruta para ver los prospectos
use App\Http\Controllers\ProspectoController;

//Route::get('/prospectos', [ProspectoController::class, 'index'])->name('prospectos.index');




Route::resource('prospectos', ProspectoController::class);




use App\Http\Controllers\SolicitudController;




     Route::post('/solicitudes/{id}/aceptacion', [SolicitudController::class, 'updateAceptacion'])
     ->name('solicitudes.updateAceptacion');



// Listado y seguimiento de Solicitudes
Route::get('/solicitudes', [SolicitudController::class, 'index'])
     ->name('solicitudes.index');
Route::post('/solicitudes/{id}/aceptacion', [SolicitudController::class, 'updateAceptacion'])
     ->name('solicitudes.updateAceptacion');



 Route::resource('prospectos', ProspectoController::class);






 use App\Http\Controllers\TramiteController;

Route::get('/tramites', [TramiteController::class, 'index'])->name('tramites.index');
Route::post('/tramites', [TramiteController::class, 'store'])->name('tramites.store');

Route::get('/tramites/{tramite}/edit', [TramiteController::class, 'edit'])->name('tramites.edit');
Route::put('/tramites/{tramite}', [TramiteController::class, 'update'])->name('tramites.update');
Route::delete('/tramites/{tramite}', [TramiteController::class, 'destroy'])->name('tramites.destroy');

use App\Http\Controllers\ReportesController;

Route::get('/reportes', [ReportesController::class, 'index'])->name('reportes.index');
Route::get('/reportes/export/pdf', [ReportesController::class, 'exportPDF'])->name('reportes.pdf');
Route::get('/reportes/export/excel', [ReportesController::class, 'exportExcel'])->name('reportes.excel');


Route::post('/solicitudes/{id}/aceptacion', [SolicitudController::class, 'updateAceptacion'])->name('solicitudes.updateAceptacion');

Route::post('/solicitudes/{id}/status', [SolicitudController::class, 'updateStatus'])
     ->name('solicitudes.updateStatus');
