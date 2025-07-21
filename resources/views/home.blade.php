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
        box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }

    .card-custom {
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.06);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    .dark-mode .card-custom {
        background-color: var(--dark-card);
        color: var(--dark-text);
    }

    .chart-container {
        position: relative;
        height: 250px;
        margin-top: 15px;
    }

    .row.g-4 {
        margin-bottom: 1.5rem;
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    .total-solicitudes {
        font-size: 4rem;
        font-weight: 700;
        color: #00c7a2;
        text-align: center;
        margin: 1rem 0;
    }
    
    .dark-mode .total-solicitudes {
        color: #00FF7F;
    }
</style>

<div class="dashboard-header text-center">
    <h2>Panel de Administración del CRM</h2>
    <p class="mb-0">Bienvenido administrador.</p>
</div>

@if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

<div class="row g-4">
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title">Total de Prospectos/Solicitudes</h5>
                <div class="total-solicitudes">
                    {{ $totalSolicitudes }}
                </div>
                <p class="text-center mb-0">Solicitudes registradas en el sistema</p>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title">Carreras más solicitadas</h5>
                <div class="chart-container">
                    <canvas id="carrerasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title">Solicitudes por escuela</h5>
                <div class="chart-container">
                    <canvas id="escuelasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card card-custom">
            <div class="card-body">
                <h5 class="card-title">Solicitudes por referencia</h5>
                <div class="chart-container">
                    <canvas id="referenciasChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Scripts específicos del dashboard
    const colors = [
        '#00c7a2', '#00FF7F', '#3a56d4', '#ff6b6b', '#f9c74f',
        '#9d4edd', '#4361ee', '#7209b7', '#f8961e', '#90be6d',
        '#577590', '#f94144', '#43aa8b', '#4d908e', '#277da1'
    ];

    // ===== GRÁFICA DE CARRERAS =====
    const ctxCarreras = document.getElementById('carrerasChart').getContext('2d');
    const carrerasLabels = [];
    const carrerasData = [];
    
    @isset($carreras)
        @foreach($carreras as $index => $carrera)
            carrerasLabels.push("{{ $carrera->carrera }}");
            carrerasData.push({{ $carrera->total }});
        @endforeach
    @else
        carrerasLabels.push('Sin datos');
        carrerasData.push(1);
    @endisset
    
    new Chart(ctxCarreras, {
        type: 'bar',
        data: {
            labels: carrerasLabels,
            datasets: [{
                label: 'Solicitudes por carrera',
                data: carrerasData,
                backgroundColor: colors.slice(0, carrerasData.length)
            }]
        },
        options: {
            
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }


           



        }

        
    });

    // ===== GRÁFICA DE ESCUELAS =====
    const ctx3 = document.getElementById('escuelasChart').getContext('2d');
    const escuelasLabels = [];
    const escuelasData = [];
    
    @isset($escuelas)
        @foreach($escuelas as $index => $escuela)
            escuelasLabels.push("{{ $escuela->escuela }}");
            escuelasData.push({{ $escuela->total }});
        @endforeach
    @else
        escuelasLabels.push('Sin datos');
        escuelasData.push(1);
    @endisset
    
    new Chart(ctx3, {
        type: 'bar',
        data: {
            labels: escuelasLabels,
            datasets: [{
                label: 'Solicitudes por escuela',
                data: escuelasData,
                backgroundColor: colors.slice(0, escuelasData.length)
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // ===== GRÁFICA DE REFERENCIAS =====
    const ctx4 = document.getElementById('referenciasChart').getContext('2d');
    const referenciasLabels = [];
    const referenciasData = [];
    
    @isset($referencias)
        @foreach($referencias as $index => $referencia)
            referenciasLabels.push("{{ $referencia->referencia }}");
            referenciasData.push({{ $referencia->total }});
        @endforeach
    @else
        referenciasLabels.push('Sin datos');
        referenciasData.push(1);
    @endisset
    
    new Chart(ctx4, {
        type: 'pie',
        data: {
            labels: referenciasLabels,
            datasets: [{
                label: 'Solicitudes por referencia',
                data: referenciasData,
                backgroundColor: colors.slice(0, referenciasData.length)
            }]
        }
    });
</script>
@endpush
@endsection