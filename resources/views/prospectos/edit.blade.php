@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Editar Prospecto</h1>
        <a href="{{ route('prospectos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="card">
        <div class="card-header bg-white">
            <h3 class="card-title">Datos del Prospecto</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('prospectos.update', $prospecto->id_prospecto) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nombre & Apellidos --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Nombre</label>
                        <input name="nombre" type="text" class="form-control"
                            value="{{ old('nombre', $prospecto->solicitud->nombre) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Apellidos</label>
                        <input name="apellidos" type="text" class="form-control"
                            value="{{ old('apellidos', $prospecto->solicitud->apellidos) }}" required>
                    </div>
                </div>

                {{-- Correo & Teléfono --}}
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Correo Electrónico</label>
                        <input name="correo" type="email" class="form-control"
                            value="{{ old('correo', $prospecto->solicitud->correo) }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Teléfono</label>
                        <input name="telefono" type="text" class="form-control"
                            value="{{ old('telefono', $prospecto->solicitud->telefono) }}" required>
                    </div>
                </div>

                {{-- Carrera, Referencia & Escuela --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Carrera</label>
                        <input name="carrera" type="text" class="form-control"
                            value="{{ old('carrera', $prospecto->solicitud->carrera) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Referencia</label>
                        <input name="referencia" type="text" class="form-control"
                            value="{{ old('referencia', $prospecto->solicitud->referencia) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Escuela</label>
                        <input name="escuela" type="text" class="form-control"
                            value="{{ old('escuela', $prospecto->solicitud->escuela) }}">
                    </div>
                </div>

                {{-- Estado & Fechas --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Estado</label>
                        <select name="estado" class="form-select" required>
                            @foreach(['evaluacion'=>'Evaluación','documentacion'=>'Documentación','admitido'=>'Admitido','rechazado'=>'Rechazado'] as $val => $label)
                                <option value="{{ $val }}"
                                    {{ old('estado', $prospecto->estado) == $val ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha inicio proceso</label>
                        <input name="fecha_inicio_proceso" type="datetime-local" class="form-control"
                            value="{{ old('fecha_inicio_proceso', str_replace(' ', 'T', $prospecto->fecha_inicio_proceso)) }}">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Fecha aceptación</label>
                        <input name="fecha_aceptacion" type="date" class="form-control"
                            value="{{ old('fecha_aceptacion', $prospecto->fecha_aceptacion) }}">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Actualizar Prospecto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
