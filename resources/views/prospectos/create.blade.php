@extends('layouts.app')

@section('content')
<style>
    .card-form {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    .card-header-form {
        background: linear-gradient(120deg, #00c7a2, #3a56d4);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
        font-weight: 600;
    }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Crear Nuevo Prospecto</h1>
        <a href="{{ route('prospectos.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Volver
        </a>
    </div>

    <div class="card card-form">
        <div class="card-header card-header-form">
            <h3 class="mb-0">Datos del Prospecto</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('prospectos.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                               id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                        @error('nombre')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="apellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control @error('apellidos') is-invalid @enderror" 
                               id="apellidos" name="apellidos" value="{{ old('apellidos') }}" required>
                        @error('apellidos')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="correo" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control @error('correo') is-invalid @enderror" 
                               id="correo" name="correo" value="{{ old('correo') }}" required>
                        @error('correo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="telefono" class="form-label">Teléfono</label>
                        <input type="text" class="form-control @error('telefono') is-invalid @enderror" 
                               id="telefono" name="telefono" value="{{ old('telefono') }}" required>
                        @error('telefono')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="carrera" class="form-label">Carrera</label>
                        <select class="form-select @error('carrera') is-invalid @enderror" id="carrera" name="carrera" required>
                            <option value="">Seleccione una carrera</option>
                            <option value="Ingeniería en Desarrollo y gestión de software" {{ old('carrera') == 'Ingeniería en Desarrollo y gestión de software' ? 'selected' : '' }}>Ingeniería en Desarrollo y gestión de software</option>
                            <option value="Ingeniería en Mecatrónica" {{ old('carrera') == 'Ingeniería en Mecatrónica' ? 'selected' : '' }}>Ingeniería en Mecatrónica</option>
                            <option value="Licenciatura en Gastronomía" {{ old('carrera') == 'Licenciatura en Gastronomía' ? 'selected' : '' }}>Licenciatura en Gastronomía</option>
                            <option value="Licenciatura en Innovación de negocios" {{ old('carrera') == 'Licenciatura en Innovación de negocios' ? 'selected' : '' }}>Licenciatura en Innovación de negocios</option>
                        </select>
                        @error('carrera')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select @error('estado') is-invalid @enderror" 
                                id="estado" name="estado" required>
                            <option value="">Seleccione un estado</option>
                            <option value="evaluacion" {{ old('estado') == 'evaluacion' ? 'selected' : '' }}>Evaluación</option>
                            <option value="documentacion" {{ old('estado') == 'documentacion' ? 'selected' : '' }}>Documentación</option>
                            <option value="admitido" {{ old('estado') == 'admitido' ? 'selected' : '' }}>Admitido</option>
                            <option value="rechazado" {{ old('estado') == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                        </select>
                        @error('estado')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fecha_inicio_proceso" class="form-label">Fecha Inicio Proceso</label>
                        <input type="date" class="form-control @error('fecha_inicio_proceso') is-invalid @enderror" 
                               id="fecha_inicio_proceso" name="fecha_inicio_proceso" 
                               value="{{ old('fecha_inicio_proceso') }}">
                        @error('fecha_inicio_proceso')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="fecha_aceptacion" class="form-label">Fecha Aceptación</label>
                        <input type="date" class="form-control @error('fecha_aceptacion') is-invalid @enderror" 
                               id="fecha_aceptacion" name="fecha_aceptacion" 
                               value="{{ old('fecha_aceptacion') }}">
                        <div class="form-text">Solo para prospectos admitidos</div>
                        @error('fecha_aceptacion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Crear Prospecto
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
