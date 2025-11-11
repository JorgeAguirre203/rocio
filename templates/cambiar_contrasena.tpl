<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{$page_title}</title>
  <link rel="stylesheet" href="styles.css">
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
  <style>
    .form-container {
      max-width: 500px;
      margin: 160px auto 50px;
      background: white;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .form-container h2 {
      text-align: center;
      font-family: 'Playfair Display', serif;
      margin-bottom: 20px;
    }

    form label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    form input,
    form select {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-top: 5px;
      font-size: 1rem;
    }

    form .btn {
      margin-top: 20px;
      width: 100%;
    }

    .error {
      color: red;
      margin: 10px 0;
      padding: 10px;
      background-color: #ffeeee;
      border-radius: 5px;
    }

    .input-error {
      border-color: red !important;
    }

    .error-message {
      color: red;
      font-size: 0.8rem;
      margin-top: 5px;
      display: none;
    }

    @media (max-width: 600px) {
      .form-container {
        margin: 120px 20px;
        padding: 20px;
      }
    }

    .password-container {
      position: relative;
      width: 105%;
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
      height: 40px;
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

    .password-requirements {
      margin-top: 10px;
    }

    .password-requirements ul {
      list-style: none;
      padding: 0;
    }

    .password-requirements li {
      font-size: 0.9rem;
    }

    .valid {
      color: green;
    }

    .invalid {
      color: red;
    }
  </style>
</head>

<body>

  <nav class="navbar">
    <div class="nav-container">
      <div id="logo" class="logo">Servi Now</div>
      <button id="repairButton">Reparar</button>
      <div class="nav-links">
        <a href="index.php" class="nav-btn">Inicio</a>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <h2>Cambiar Contraseña</h2>

    {if isset($errors)}
      {foreach $errors as $error}
        <div class="error">{$error}</div>
      {/foreach}
    {/if}

    <form id="cambiarContrasenaForm" action="cambiar_contrasena.php?tipo={$tipo}" method="POST">
      <label for="current_password">Contraseña Actual:</label>
      <div class="password-container">
        <input type="password" id="current_password" name="current_password" required>
        <button type="button" id="toggleCurrentPassword" tabindex="-1">👁️</button>
      </div>

      <label for="new_password">Nueva Contraseña:</label>
      <div class="password-container">
        <input type="password" id="new_password" name="new_password" required>
        <button type="button" id="toggleNewPassword" tabindex="-1">👁️</button>
      </div>
      <div id="password-requirements">
        <ul>
          <li id="length">Al menos 8 caracteres</li>
          <li id="uppercase">Una letra mayúscula</li>
          <li id="special">Un carácter especial</li>
        </ul>
      </div>

      <label for="confirm_password">Confirmar Nueva Contraseña:</label>
      <div class="password-container">
        <input type="password" id="confirm_password" name="confirm_password" required>
        <button type="button" id="toggleConfirmPassword" tabindex="-1">👁️</button>
      </div>

      <button type="submit" class="btn">Cambiar Contraseña</button>
    </form>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Servi Now. Todos los derechos reservados.</p>
  </footer>

  {literal}
  <script>
  // Mostrar/ocultar contraseña actual
  document.getElementById('toggleCurrentPassword').addEventListener('click', function() {
    const pwd = document.getElementById('current_password');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      this.textContent = '🙈';
    } else {
      pwd.type = 'password';
      this.textContent = '👁️';
    }
  });

  // Mostrar/ocultar nueva contraseña
  document.getElementById('toggleNewPassword').addEventListener('click', function() {
    const pwd = document.getElementById('new_password');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      this.textContent = '🙈';
    } else {
      pwd.type = 'password';
      this.textContent = '👁️';
    }
  });

  // Mostrar/ocultar confirmar nueva contraseña
  document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    const pwd = document.getElementById('confirm_password');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      this.textContent = '🙈';
    } else {
      pwd.type = 'password';
      this.textContent = '👁️';
    }
  });

  // Validación en tiempo real de la nueva contraseña
  document.getElementById('new_password').addEventListener('input', function() {
    const password = this.value;
    const length = password.length >= 8;
    const uppercase = /[A-Z]/.test(password);
    const special = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);

    document.getElementById('length').className = length ? 'valid' : 'invalid';
    document.getElementById('uppercase').className = uppercase ? 'valid' : 'invalid';
    document.getElementById('special').className = special ? 'valid' : 'invalid';
  });
  </script>
  {/literal}
</body>
</html>
