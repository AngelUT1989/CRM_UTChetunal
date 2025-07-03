<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Crear Cuenta</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    body {
      background: linear-gradient(to right, #00FF7F, #8affd1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .register-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 2.5rem;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .register-card:hover {
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
    }

    .register-card h2 {
      font-weight: 700;
      margin-bottom: 1.8rem;
      color: #1b1b18;
      text-align: center;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin: 0 auto 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #00FF7F, #4361ee);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .avatar i {
      color: white;
      font-size: 3.5rem;
    }

    .form-label {
      font-weight: 600;
      color: #1b1b18;
      margin-bottom: 0.5rem;
    }

    .form-control {
      border-radius: 12px;
      padding: 0.85rem 1.2rem;
      border: 1px solid #e1e1e1;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #4361ee;
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }

    .input-icon {
      position: absolute;
      right: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #888;
      cursor: pointer;
      transition: color 0.2s;
    }

    .input-icon:hover {
      color: #4361ee;
    }

    .btn-register {
      background-color: #4361ee;
      border: none;
      border-radius: 12px;
      font-weight: 600;
      padding: 0.9rem;
      font-size: 1.1rem;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-register:hover {
      background-color: #3a56d4;
      transform: translateY(-2px);
    }

    .btn-register:active {
      transform: translateY(0);
    }

    .login-link {
      display: block;
      margin-top: 1.5rem;
      text-align: center;
      color: #4361ee;
      text-decoration: none;
      font-weight: 500;
    }

    .login-link:hover {
      text-decoration: underline;
    }

    .form-check-input:checked {
      background-color: #4361ee;
      border-color: #4361ee;
    }

    .form-check-input:focus {
      box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
    }

    .form-check-label {
      color: #555;
      font-size: 0.95rem;
    }

    .terms-link {
      color: #4361ee;
      text-decoration: none;
    }

    .terms-link:hover {
      text-decoration: underline;
    }

    .input-group {
      position: relative;
    }

    @media (max-width: 576px) {
      .register-card {
        padding: 2rem 1.5rem;
      }
      
      .avatar {
        width: 85px;
        height: 85px;
      }
      
      .avatar i {
        font-size: 2.8rem;
      }
    }
  </style>
</head>
<body>
  <div class="register-card">
    <div class="avatar">
      <i class="fas fa-user-plus"></i>
    </div>
    <h2>Crear Cuenta</h2>
    
    <form method="POST" action="{{ route('register') }}">
      <div class="mb-4">
        <label for="name" class="form-label">Nombre completo</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre completo" required>
      </div>
      
      <div class="mb-4">
        <label for="email" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="tu@email.com" required>
      </div>
      
      <div class="mb-4">
        <label for="password" class="form-label">Contraseña</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password" name="password" placeholder="••••••••" required>
          <span class="input-icon" id="togglePassword">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>
      
      <div class="mb-4">
        <label for="password-confirm" class="form-label">Confirmar Contraseña</label>
        <div class="input-group">
          <input type="password" class="form-control" id="password-confirm" name="password_confirmation" placeholder="••••••••" required>
          <span class="input-icon" id="toggleConfirmPassword">
            <i class="fas fa-eye"></i>
          </span>
        </div>
      </div>
      
      <div class="form-check mb-4">
        <input class="form-check-input" type="checkbox" id="terms" required>
        <label class="form-check-label" for="terms">
          Acepto los <a href="#" class="terms-link">Términos y Condiciones</a>
        </label>
      </div>
      
      <button type="submit" class="btn btn-register">
        Registrarse
      </button>
      
      <a href="{{ route('login') }}" class="login-link">
        ¿Ya tienes cuenta? Inicia sesión
      </a>
    </form>
  </div>

  <script>
    // Funcionalidad para mostrar/ocultar contraseña
    document.getElementById('togglePassword').addEventListener('click', function() {
      const passwordInput = document.getElementById('password');
      const icon = this.querySelector('i');
      
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        passwordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
    
    document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
      const confirmPasswordInput = document.getElementById('password-confirm');
      const icon = this.querySelector('i');
      
      if (confirmPasswordInput.type === 'password') {
        confirmPasswordInput.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
      } else {
        confirmPasswordInput.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
      }
    });
  </script>
</body>
</html>