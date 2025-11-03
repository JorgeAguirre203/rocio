<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title}</title>
    <link rel="stylesheet" href="estilo_login.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
    <style>
    .password-container {
      position: relative;
      width: 100%;
      margin-bottom: 0;
    }
    .password-container input[type="password"],
    .password-container input[type="text"] {
      width: 100%;
      box-sizing: border-box;
      padding-right: 40px;
      height: 40px;
      line-height: 40px;
      font-size: 1rem;
    }
    .password-container button {
      position: absolute;
      right: 8px;
      top: 0;
      height: 15px;
      width: 36px;
      border: none;
      background: none;
      cursor: pointer;
      font-size: 1.2em;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 0;
    }

    .email-container {
      position: relative;
      width: 100%;
      margin-bottom: 0;
    }
    .email-container input[type="email"] {
      width: 100%;
      box-sizing: border-box;
      padding-right: 40px; /* Igual que el de password para que se vean iguales */
      height: 40px;
      line-height: 40px;
      font-size: 1rem;
    }

    </style>
</head>
<body>

  <nav class="navbar">
    <div class="nav-container">
      <div id="logo" class="logo">{$logo_text}</div>
      <div class="nav-links">
        <a href="{$home_link}" class="nav-btn">Inicio</a>
      </div>
    </div>
  </nav>

  <div class="auth-container">
    <h2>{$page_title}</h2>

{if $error}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        alert('{$error|escape:"javascript"}');
    });
</script>
{/if}


    <form action="{$form_action}" method="POST">
      <label for="email">Correo Electrónico:</label>
      <div class="email-container">
        <input type="email" id="email" name="email" value="{$email_value|escape:'html'}" required>
      </div>
      <label for="password">Contraseña</label>
      <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
        <button type="button" id="togglePassword" tabindex="-1">👁️</button>
      </div>
      <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <p>¿No tienes cuenta? <a href="registrar_usuario.php">Regístrate</a></p>
    <a href="{$home_link}" class="back-link">← Volver</a>
  </div>

  <script>
  document.getElementById('togglePassword').addEventListener('click', function() {
    const pwd = document.getElementById('password');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      this.textContent = '🙈';
    } else {
      pwd.type = 'password';
      this.textContent = '👁️';
    }
  });
  </script>

</body>
</html>