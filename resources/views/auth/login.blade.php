<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar Sesión</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #00FF7F, #8affd1);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      font-family: 'Segoe UI', sans-serif;
    }

    .login-card {
      background: #ffffff;
      border-radius: 20px;
      padding: 2.5rem;
      max-width: 450px;
      width: 100%;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .login-card h2 {
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #1b1b18;
    }

    .form-control {
      border-radius: 12px;
      padding: 0.75rem 1rem;
    }

    .btn-primary {
      background-color: #4361ee;
      border: none;
      border-radius: 12px;
      font-weight: 600;
    }

    .btn-primary:hover {
      background-color: #3a56d4;
    }

    .forgot-password {
      display: block;
      margin-top: 1rem;
      text-align: center;
      color: #4361ee;
      text-decoration: none;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .avatar {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      margin: 0 auto 1rem;
      display: block;
    }
  </style>
</head>
<body>
  <div class="login-card text-center">
    <img src="https://ssl.gstatic.com/accounts/ui/avatar_2x.png" alt="Avatar" class="avatar">
    <h2>Bienvenido</h2>
    <form {{ route('login') }} method="POST">
      @csrf
      <div class="mb-3 text-start">
        <label for="inputEmail" class="form-label">Correo Electrónico</label>
        <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email address" required autofocus>
      </div>
      <div class="mb-3 text-start">
        <label for="inputPassword" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="inputPassword" name="password" placeholder="Password" required>
      </div>
      <div class="form-check mb-3 text-start">
        <input class="form-check-input" type="checkbox" id="rememberMe">
        <label class="form-check-label" for="rememberMe">
          Recuérdame
        </label>
      </div>
      <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
    </form>
    <a href="#" class="forgot-password">¿Olvidaste tu contraseña?</a>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>