@extends('layouts.app')

@section('content')
<style>
    .card-chart {
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-top: 2rem;
        margin-bottom: 2rem;
    }

    .card-header-chart {
        background: linear-gradient(120deg, #00c7a2, #3a56d4);
        color: white;
        border-radius: 12px 12px 0 0;
        padding: 1.25rem 1.5rem;
        font-weight: 600;
        font-size: 1.25rem;
    }

    .form-control[readonly] {
        background-color: #f3f4f6;
    }
</style>

<div class="container py-4">
    <div class="card-chart max-w-xl mx-auto">
        <div class="card-header-chart text-center">
            Editar estado del trámite
        </div>

        <div class="bg-white p-4 rounded-bottom">
            <form action="{{ route('tramites.update', $tramite->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label text-emerald-800">Nombre</label>
                    <input type="text" value="{{ $tramite->nombre }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label text-emerald-800">Trámite</label>
                    <input type="text" value="{{ $tramite->nombre_tramite }}" class="form-control" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label text-emerald-800">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="En proceso" {{ $tramite->estado === 'En proceso' ? 'selected' : '' }}>En proceso</option>
                        <option value="Finalizado" {{ $tramite->estado === 'Finalizado' ? 'selected' : '' }}>Finalizado</option>
                        <option value="Completado" {{ $tramite->estado === 'Completado' ? 'selected' : '' }}>Completado</option>
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('tramites.index') }}" class="text-emerald-700 fw-semibold text-decoration-underline">
                        Cancelar
                    </a>
                    <button type="submit" class="btn btn-success shadow">
                        Actualizar estado
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
