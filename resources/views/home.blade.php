@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
<style>
    /* Mantén todo el CSS anterior sin cambios */
    :root {
        --light-bg: #f5f7fa;
        --dark-bg: #0a0a0a;
        --dark-card: #1a1a1a;
        --light-text: #212529;
        --dark-text: #ffffff;
    }

    body {
        background: var(--light-bg);
        color: var(--light-text);
        transition: background-color 0.3s ease, color 0.3s ease;
    }

    body.dark-mode {
        background: var(--dark-bg);
        color: var(--dark-text);
    }

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

    .theme-toggle {
        position: fixed;
        top: 60px;
        right: 20px;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.8);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        z-index: 1000;
        transition: background 0.3s ease;
    }

    body.dark-mode .theme-toggle {
        background: rgba(30, 30, 30, 0.8);
    }

    .theme-toggle img {
        width: 24px;
        height: 24px;
        user-select: none;
        pointer-events: none;
    }

    .sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        width: 220px;
        background: linear-gradient(135deg, #00FF7F, #00c7a2);
        color: white;
        padding-top: 4rem;
        display: flex;
        flex-direction: column;
        gap: 1rem;
        box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        z-index: 1050;
        transition: transform 0.3s ease;
    }

    .sidebar.hidden {
        transform: translateX(-100%);
    }

    .sidebar .list-group-item {
        background: transparent;
        border: none;
        color: white;
        font-weight: 500;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: background-color 0.2s ease;
    }

    .sidebar .list-group-item:hover {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
    }

    .sidebar .list-group-item i {
        font-size: 1.3rem;
    }

    .main-content {
        margin-left: 240px;
        transition: margin-left 0.3s ease;
    }

    .main-content.shifted {
        margin-left: 20px;
    }

    #sidebarToggleBtn {
        position: fixed;
        top: 20px;
        left: 240px;
        background: linear-gradient(135deg, #00FF7F, #00c7a2);
        border: none;
        border-radius: 50%;
        width: 45px;
        height: 45px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        z-index: 1100;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: left 0.3s ease, background 0.3s ease;
    }

    #sidebarToggleBtn:hover {
        background: linear-gradient(135deg, #00c7a2, #00FF7F);
    }

    .sidebar.hidden + #sidebarToggleBtn {
        left: 20px;
    }

    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }
        .sidebar.hidden {
            transform: translateX(-100%);
        }
        .main-content {
            margin-left: 20px;
        }
        #sidebarToggleBtn {
            left: 20px !important;
        }
    }

    .row.g-4 {
        margin-bottom: 1.5rem;
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
    }

    /* Nuevo estilo para el total de solicitudes */
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

<div class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode" role="button" tabindex="0">
    <img id="themeIcon" src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="Modo Claro" />
</div>

<nav class="sidebar" id="sidebar">
    <ul class="list-group list-group-flush">
        <a href="{{ route('prospectos.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill"></i> Gestionar prospectos
          </a>        <li class="list-group-item"><i class="bi bi-bar-chart-fill"></i> Revisar estadísticas</li>
        <li class="list-group-item"><i class="bi bi-envelope-fill"></i> Enviar comunicaciones</li>
        <li class="list-group-item"><i class="bi bi-person-fill-gear"></i> Administrar usuarios</li>
    </ul>
</nav>

<button id="sidebarToggleBtn" aria-label="Toggle sidebar">
    <i id="sidebarToggleIcon" class="bi bi-list"></i>
</button>

<div class="container main-content py-4" id="mainContent">
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
        <!-- Cambio 1: Total de prospectos/solicitudes -->
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

        <!-- Cambio 2: Carreras más solicitadas -->
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
        
        <!-- Mantener gráficas existentes -->
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
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.js"></script>
<script>
    // Colores para gráficas
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

    // ===== TEMA OSCURO Y SIDEBAR =====
    const themeToggle = document.getElementById('themeToggle');
    const body = document.body;
    const themeIcon = document.getElementById('themeIcon');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('mainContent');
    const sidebarToggleBtn = document.getElementById('sidebarToggleBtn');
    const sidebarToggleIcon = document.getElementById('sidebarToggleIcon');

    const sunIcon = 'https://cdn-icons-png.flaticon.com/512/869/869869.png';
    const moonIcon = 'https://cdn-icons-png.flaticon.com/512/869/869868.png';

    themeIcon.src = sunIcon;
    themeIcon.alt = 'Modo Claro';

    themeToggle.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        if(body.classList.contains('dark-mode')) {
            themeIcon.src = moonIcon;
            themeIcon.alt = 'Modo Oscuro';
        } else {
            themeIcon.src = sunIcon;
            themeIcon.alt = 'Modo Claro';
        }
    });

    sidebarToggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
        mainContent.classList.toggle('shifted');

        if(sidebar.classList.contains('hidden')) {
            sidebarToggleIcon.classList.remove('bi-list');
            sidebarToggleIcon.classList.add('bi-x-lg');
        } else {
            sidebarToggleIcon.classList.remove('bi-x-lg');
            sidebarToggleIcon.classList.add('bi-list');
        }
    });
</script>

@endsection