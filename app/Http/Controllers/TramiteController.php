<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tramite;

class TramiteController extends Controller
{
    public function index()
    {
        $tramites = Tramite::all();
        return view('tramites.index', compact('tramites'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:100',
            'nombre_tramite' => 'required|string|max:255',
            'estado' => 'required|string|max:100',
            'ultimo_contacto' => 'required|date',
        ]);

        Tramite::create($request->all());

        return redirect()->route('tramites.index');
    }
    public function edit(Tramite $tramite)
{
    return view('tramites.edit', compact('tramite'));
}

public function update(Request $request, Tramite $tramite)
{
    $tramite->update($request->all());
    return redirect()->route('tramites.index');
}

public function destroy(Tramite $tramite)
{
    $tramite->delete();
    return redirect()->route('tramites.index');
}

}
