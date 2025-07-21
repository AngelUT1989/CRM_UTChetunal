@extends('layouts.app')

@section('content')
<style>
    .card-chart {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    .card-header-chart {
        background: linear-gradient(120deg, #00c7a2, #3a56d4);
        color: white;
        border-radius: 10px 10px 0 0 !important;
        padding: 15px 20px;
        font-weight: 600;
    }

    .table-tramites th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .badge {
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
        font-weight: 500;
        color: white;
    }

    .bg-success { background-color: #28a745 !important; }
    .bg-warning { background-color: #ffc107 !important; }
    .bg-danger { background-color: #dc3545 !important; }
    .bg-secondary { background-color: #6c757d !important; }
</style>

<div class="container py-4">
    <!-- Formulario -->
    <div class="card-chart mb-4">
        <div class="card-header-chart">Agregar nuevo trámite</div>
        <div class="p-4 bg-white rounded-b-lg">
            <form action="{{ route('tramites.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-6">
                    <label class="form-label">Nombre</label>
                    <input type="text" name="nombre" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tipo</label>
                    <select name="tipo" class="form-select" required>
                        <option value="">Selecciona</option>
                        <option value="Tipo A">Tipo A</option>
                        <option value="Tipo B">Tipo B</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Trámite</label>
                    <input type="text" name="nombre_tramite" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Estado</label>
                    <select name="estado" class="form-select" required>
                        <option value="">Selecciona</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Finalizado">Finalizado</option>
                        <option value="Completado">Completado</option>
                    </select>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Último contacto</label>
                    <input type="date" name="ultimo_contacto" class="form-control" required>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-success">
                        Guardar trámite
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tabla -->
    <div class="card-chart">
        <div class="card-header-chart">Listado de Trámites</div>
        <div class="table-responsive p-3 bg-white rounded-b-lg">
            <table class="table table-hover table-striped table-tramites">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Trámite</th>
                        <th>Estado</th>
                        <th>Último contacto</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tramites as $tramite)
                        <tr onclick="mostrarVistaPrevia('{{ $tramite->nombre }}', '{{ $tramite->tipo }}', '{{ $tramite->nombre_tramite }}', '{{ $tramite->estado }}', '{{ $tramite->ultimo_contacto }}')">
                            <td>{{ $tramite->nombre }}</td>
                            <td>{{ $tramite->tipo }}</td>
                            <td>{{ $tramite->nombre_tramite }}</td>
                            <td>
                                @php
                                    $estadoClass = match($tramite->estado) {
                                        'Completado' => 'bg-success',
                                        'En proceso' => 'bg-warning',
                                        'Finalizado' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="badge {{ $estadoClass }}">
                                    {{ $tramite->estado }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($tramite->ultimo_contacto)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('tramites.edit', $tramite->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form action="{{ route('tramites.destroy', $tramite->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Eliminar este trámite?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Sin trámites registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Vista previa -->
    <div id="vista-previa" class="card-chart d-none">
        <div class="card-header-chart">Vista previa del trámite</div>
        <div class="p-4 bg-white rounded-b-lg">
            <p><strong>Nombre:</strong> <span id="vp-nombre"></span></p>
            <p><strong>Tipo:</strong> <span id="vp-tipo"></span></p>
            <p><strong>Trámite:</strong> <span id="vp-tramite"></span></p>
            <p><strong>Estado:</strong> <span id="vp-estado"></span></p>
            <p><strong>Último contacto:</strong> <span id="vp-contacto"></span></p>
        </div>
    </div>
</div>

<script>
    function mostrarVistaPrevia(nombre, tipo, tramite, estado, contacto) {
        document.getElementById('vista-previa').classList.remove('d-none');
        document.getElementById('vp-nombre').textContent = nombre;
        document.getElementById('vp-tipo').textContent = tipo;
        document.getElementById('vp-tramite').textContent = tramite;
        document.getElementById('vp-estado').textContent = estado;
        document.getElementById('vp-contacto').textContent = new Date(contacto).toLocaleDateString('es-ES');
    }
</script>
@endsection
