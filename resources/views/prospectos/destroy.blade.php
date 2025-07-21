@extends('layouts.app')

@section('content')
<style>
    .card-form {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .card-header-form {
        background: linear-gradient(120deg, #f87272, #d43a3a);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Eliminar Prospecto</h1>
        <a href="{{ route('prospectos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card card-form">
        <div class="card-header card-header-form">
            <h3 class="mb-0">Confirmar Eliminación</h3>
        </div>
        <div class="card-body">
            <p>¿Estás seguro de que deseas eliminar al prospecto <strong>{{ $prospecto->solicitud->nombre }} {{ $prospecto->solicitud->apellidos }}</strong>?</p>
            <p class="text-muted">Esta acción no se puede deshacer.</p>

            <form action="{{ route('prospectos.destroy', $prospecto->id_prospecto) }}" method="POST">
                @csrf
                @method('DELETE')

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <a href="{{ route('prospectos.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-trash"></i> Eliminar Prospecto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
