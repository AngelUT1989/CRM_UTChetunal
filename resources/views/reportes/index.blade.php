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
</style>

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Reportes</h2>
        <a href="{{ route('reportes.pdf') }}" class="btn btn-success">
            <i class="bi bi-file-earmark-pdf-fill"></i> Exportar PDF
        </a>
    </div>

    <!-- Tarjetas -->
    <div class="row">
        <div class="col-md-4">
            <div class="card-chart text-center">
                <div class="card-header-chart">Total comunicaciones</div>
                <div class="card-body bg-white rounded-bottom">
                    <h2>{{ $data['totalComunicaciones'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-chart text-center">
                <div class="card-header-chart">Reportes generados este mes</div>
                <div class="card-body bg-white rounded-bottom">
                    <h2>{{ $data['reportesMes'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-chart text-center">
                <div class="card-header-chart">Trámites completados</div>
                <div class="card-body bg-white rounded-bottom">
                    <h2>{{ $data['tramitesCompletados'] }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráfica -->
    <div class="card-chart">
        <div class="card-header-chart">Gráfica de trámites</div>
        <div class="chart-container bg-white rounded-bottom">
            <canvas id="tramitesChart"></canvas>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('tramitesChart');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Comunicaciones', 'Reportes', 'Trámites'],
            datasets: [{
                label: 'Estadísticas',
                data: [
                    {{ $data['totalComunicaciones'] }},
                    {{ $data['reportesMes'] }},
                    {{ $data['tramitesCompletados'] }}
                ],
                backgroundColor: ['#2e7d32', '#43a047', '#66bb6a'],
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return `${context.label}: ${context.raw}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
@endpush
@endsection
