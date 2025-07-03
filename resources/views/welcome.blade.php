<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Autenticación</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        :root {
            --light-bg: #FDFDFC;
            --light-text: #1b1b18;
            --light-border: #19140035;
            --dark-bg: #0a0a0a;
            --dark-text: #ffffff;
            --dark-border: #3E3E3A;
            --primary: #4361ee;
            --primary-hover: #3a56d4;
        }

        body {
            background-color: var(--light-bg);
            color: var(--light-text);
            min-height: 100vh;
            transition: background-color 0.3s, color 0.3s;
        }

        body.dark-mode {
            background-color: var(--dark-bg);
            color: var(--dark-text);
        }

        .card {
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.05);
            border: none;
            transition: all 0.3s ease;
        }

        .dark-mode .card {
            background: #1a1a1a;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
        }

        .auth-btn {
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .btn-login {
            background: transparent;
            border: 1px solid var(--light-border);
            color: var(--light-text);
        }

        .dark-mode .btn-login {
            border-color: var(--dark-border);
            color: var(--dark-text);
        }

        .btn-login:hover {
            border-color: #1915014a;
        }

        .dark-mode .btn-login:hover {
            border-color: #62605b;
        }

        .btn-register {
            background: var(--primary);
            border: 1px solid var(--primary);
            color: white;
        }

        .btn-register:hover {
            background: var(--primary-hover);
            border-color: var(--primary-hover);
            color: white;
        }

        .theme-toggle {
            position: fixed;
            top: 20px;
            right: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            background: rgba(255, 255, 255, 0.8);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .dark-mode .theme-toggle {
            background: rgba(30, 30, 30, 0.8);
        }

        .hero-section {
            background: #58d68d



;  /* CAMBIO REALIZADO AQUÍ */
            border-radius: 0 0 50px 50px;
            padding: 4rem 0;
            margin-bottom: 3rem;
        }

        .dark-mode .hero-section {
            background: linear-gradient(135deg, #3a0ca3, #7209b7);
        }

        .feature-card {
            transition: transform 0.3s;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary);
        }

        .dark-mode .feature-icon {
            color: #9d4edd;
        }

        .auth-container {
            max-width: 400px;
            width: 100%;
        }

        .app-logo {
            font-weight: 700;
            font-size: 1.8rem;
            letter-spacing: -0.5px;
            color: white;
        }

        .dark-mode .app-logo {
            color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Botón para cambiar tema -->
    <div class="theme-toggle" id="themeToggle">
        <i class="bi bi-sun-fill"></i>
    </div>

    <!-- Hero Section -->
    <section class="hero-section text-center text-white">
        <div class="container">
            <h1 class="app-logo mb-3"> StudyHub CRM</h1>
            <p class="lead">Sistema de gestión de alumnos</p>
        </div>
    </section>

    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <!-- Tarjeta de bienvenida -->
                <div class="card mb-5">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold mb-3">Bienvenido</h2>
                            <p class="text-muted">Accede a tu cuenta</p>
                        </div>

                        <!-- Sección de autenticación -->
                        <div class="auth-container mx-auto">
                            <header class="mb-5">
                                @if (Route::has('login'))
                                    <nav class="d-flex justify-content-center gap-3">
                                        @auth
                                            <a href="{{ url('/dashboard') }}" class="btn btn-primary auth-btn">
                                                Dashboard <i class="bi bi-speedometer2 ms-1"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('login') }}" class="btn btn-login auth-btn">
                                                Iniciar Sesión
                                            </a>

                                            @if (Route::has('register'))
                                                <a href="{{ route('register') }}" class="btn btn-register auth-btn">
                                                    Registrarse
                                                </a>
                                            @endif
                                        @endauth
                                    </nav>
                                @endif
                            </header>
                        </div>
                    </div>
                </div>

      
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="py-4 text-center text-muted">
        <div class="container">
            <p class="mb-0">© 2025 StudyHub. Todos los derechos reservados.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Toggle de modo oscuro/claro
        const themeToggle = document.getElementById('themeToggle');
        const body = document.body;
        const sunIcon = '<i class="bi bi-sun-fill"></i>';
        const moonIcon = '<i class="bi bi-moon-fill"></i>';

        // Establecer tema inicial (modo claro por defecto)
        body.classList.remove('dark-mode');
        themeToggle.innerHTML = moonIcon;

        // Alternar tema manualmente
        themeToggle.addEventListener('click', () => {
            body.classList.toggle('dark-mode');

            if (body.classList.contains('dark-mode')) {
                themeToggle.innerHTML = sunIcon;
            } else {
                themeToggle.innerHTML = moonIcon;
            }
        });
    </script>
</body>
</html>