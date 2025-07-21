<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
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
    </style>
    @stack('styles')
</head>
<body>
    <div class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode" role="button" tabindex="0">
        <img id="themeIcon" src="https://cdn-icons-png.flaticon.com/512/869/869869.png" alt="Modo Claro" />
    </div>

    @include('components.sidebar')

    <button id="sidebarToggleBtn" aria-label="Toggle sidebar">
        <i id="sidebarToggleIcon" class="bi bi-list"></i>
    </button>

    <div class="container main-content py-4" id="mainContent">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.js"></script>
    <script>
        // Scripts globales
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
    @stack('scripts')
</body>
</html>