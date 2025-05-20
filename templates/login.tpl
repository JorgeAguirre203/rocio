<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title}</title>
    <link rel="stylesheet" href="estilo_login.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
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

    {if isset($error)}
      <div class="error-message">{$error}</div>
    {/if}

    <form action="{$form_action}" method="POST">
      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

      <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <p>¿No tienes cuenta? <a href="registrar_usuario.php">Regístrate</a></p>
    <a href="{$home_link}" class="back-link">← Volver</a>
  </div>

</body>
</html>
