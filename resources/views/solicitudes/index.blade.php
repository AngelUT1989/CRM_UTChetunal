@extends('layouts.app')

@section('content')
<style>
    /* Estilos específicos del dashboard */
    .dashboard-header {
        background: linear-gradient(90deg, #00FF7F, #00c7a2);
        color: white;
        border-radius: 12px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 5px 20px rgb(60,179,113);
        text-align: center;
    }

    .table-responsive {
        margin-top: 1rem;
    }

    .btn-sm {
        min-width: 2.5rem;
    }
</style>

<div class="dashboard-header">
    <h2>Seguimiento de Solicitudes</h2>
        </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
    <table class="table table-dark table-hover">
        <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Carrera</th>
                            <th>Referencia</th>
                            <th>Escuela</th>
                <th>Seguimiento</th>
                            <th>Fecha Registro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($solicitudes as $s)
                            <tr>
                                <td>{{ $s->id_solicitudes }}</td>
                                <td>{{ $s->nombre }} {{ $s->apellidos }}</td>
                                <td>{{ $s->correo }}</td>
                                <td>{{ $s->telefono }}</td>
                                <td>{{ $s->carrera }}</td>
                                <td>{{ $s->referencia }}</td>
                                <td>{{ $s->escuela }}</td>
                                <td>
                        <form action="{{ route('solicitudes.updateAceptacion', $s->id_solicitudes) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button
                                            type="submit"
                                name="aceptacion"
                                value="1"
                                            class="btn btn-sm btn-success"
                                @if($s->aceptacion_terminos) disabled @endif
                            >Sí</button>
                                    </form>
                        <form action="{{ route('solicitudes.updateAceptacion', $s->id_solicitudes) }}" method="POST" class="d-inline">
                                        @csrf
                                        <button
                                            type="submit"
                                name="aceptacion"
                                value="0"
                                            class="btn btn-sm btn-danger"
                                @if(!$s->aceptacion_terminos) disabled @endif
                            >No</button>
                                    </form>
                                </td>
                    <td>{{ $s->fecha_registro }}</td>
                            </tr>
                        @empty
                            <tr>
                    <td colspan="9" class="text-center">No hay solicitudes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
@endsection
