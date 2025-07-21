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
    
    .chart-container {
        position: relative;
        height: 300px;
        padding: 15px;
    }
    
    .table-prospectos th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    
    .badge {
        padding: 0.5em 0.75em;
        border-radius: 0.5rem;
        font-weight: 500;
    }
    
    .bg-primary { background-color: #3a56d4 !important; }
    .bg-info { background-color: #00c7a2 !important; }
    .bg-success { background-color: #28a745 !important; }
    .bg-danger { background-color: #dc3545 !important; }
</style>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Gestión de Prospectos</h1>
        <a href="{{ route('prospectos.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Nuevo Prospecto
        </a>
    </div>

    <!-- Gráficas -->
    <div class="row">
        <!-- Gráfica de estados -->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-chart">
                    Prospectos por Estado
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="estadosChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gráfica mensual -->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header card-header-chart">
                    Evolución Mensual
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <canvas id="mensualChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de prospectos -->
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h3 class="mb-0">Listado de Prospectos</h3>
            <div class="d-flex">
                <input type="text" class="form-control me-2" id="searchInput" placeholder="Buscar prospecto...">
                <button class="btn btn-outline-secondary" id="clearSearch">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped table-prospectos">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Teléfono</th>
                            <th>Carrera</th>
                            <th>Estado</th>
                            <th>Fecha Aceptación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prospectos as $prospecto)
                            @if($prospecto->solicitud)
                                <tr>
                                    <td>{{ $prospecto->solicitud->nombre }} {{ $prospecto->solicitud->apellidos }}</td>
                                    <td>{{ $prospecto->solicitud->correo }}</td>
                                    <td>{{ $prospecto->solicitud->telefono }}</td>
                                    <td>{{ $prospecto->solicitud->carrera }}</td>
                                    <td>
                                        <span class="badge 
                                            @if($prospecto->estado == 'evaluacion') bg-primary
                                            @elseif($prospecto->estado == 'documentacion') bg-info
                                            @elseif($prospecto->estado == 'admitido') bg-success
                                            @elseif($prospecto->estado == 'rechazado') bg-danger
                                            @endif">
                                            {{ ucfirst($prospecto->estado) }}
                                        </span>
                                    </td>
                                    <td>{{ $prospecto->fecha_aceptacion ? date('d/m/Y', strtotime($prospecto->fecha_aceptacion)) : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('prospectos.edit', $prospecto->id_prospecto) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <form action="{{ route('prospectos.destroy', $prospecto->id_prospecto) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('¿Eliminar este prospecto?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No hay prospectos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Colores para las gráficas
    const colors = ['#00c7a2', '#00FF7F', '#3a56d4', '#ff6b6b', '#f9c74f'];

    // Gráfica de estados
    const ctxEstados = document.getElementById('estadosChart').getContext('2d');
    const estadosData = {
        'evaluacion': {{ $prospectos->where('estado', 'evaluacion')->count() }},
        'documentacion': {{ $prospectos->where('estado', 'documentacion')->count() }},
        'admitido': {{ $prospectos->where('estado', 'admitido')->count() }},
        'rechazado': {{ $prospectos->where('estado', 'rechazado')->count() }}
    };
    
    new Chart(ctxEstados, {
        type: 'pie',
        data: {
            labels: Object.keys(estadosData).map(estado => {
                const estados = {
                    'evaluacion': 'Evaluación',
                    'documentacion': 'Documentación',
                    'admitido': 'Admitido',
                    'rechazado': 'Rechazado'
                };
                return estados[estado] || estado;
            }),
            datasets: [{
                data: Object.values(estadosData),
                backgroundColor: colors,
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'right',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = context.raw || 0;
                            const total = context.chart.getDatasetMeta(0).total;
                            const percentage = Math.round((value / total) * 100);
                            return `${label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Gráfica mensual
    const ctxMensual = document.getElementById('mensualChart').getContext('2d');
    
    // Agrupar por mes usando fecha_inicio_proceso
    const prospectosPorMes = @json($prospectos->groupBy(function($prospecto) {
        return $prospecto->fecha_inicio_proceso 
            ? \Carbon\Carbon::parse($prospecto->fecha_inicio_proceso)->format('Y-m') 
            : 'Sin fecha';
    })->map->count());
    
    // Ordenar por mes
    const mesesOrdenados = {};
    Object.keys(prospectosPorMes)
        .sort()
        .forEach(key => {
            mesesOrdenados[key] = prospectosPorMes[key];
        });
    
    new Chart(ctxMensual, {
        type: 'bar',
        data: {
            labels: Object.keys(mesesOrdenados).map(mes => {
                if (mes === 'Sin fecha') return mes;
                const [year, month] = mes.split('-');
                const monthNames = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
                return `${monthNames[parseInt(month)-1]} ${year}`;
            }),
            datasets: [{
                label: 'Prospectos por mes',
                data: Object.values(mesesOrdenados),
                backgroundColor: '#00c7a2',
                borderColor: '#00a383',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });

    // Búsqueda en la tabla
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchText = this.value.toLowerCase();
        const rows = document.querySelectorAll('.table-prospectos tbody tr');
        
        rows.forEach(row => {
            const rowText = row.textContent.toLowerCase();
            row.style.display = rowText.includes(searchText) ? '' : 'none';
        });
    });

    // Limpiar búsqueda
    document.getElementById('clearSearch').addEventListener('click', function() {
        document.getElementById('searchInput').value = '';
        const rows = document.querySelectorAll('.table-prospectos tbody tr');
        rows.forEach(row => row.style.display = '');
    });
</script>
@endpush
@endsection