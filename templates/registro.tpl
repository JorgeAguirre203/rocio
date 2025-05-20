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

    @media (max-width: 600px) {
      .form-container {
        margin: 120px 20px;
        padding: 20px;
      }
    }
  </style>
</head>

<body>

  <nav class="navbar">
    <div class="nav-container">
      <div id="logo" class="logo">{$logo_text}</div>
      <button id="repairButton">Reparar</button>
      <div class="nav-links">
        <a href="{$home_link}" class="nav-btn">Inicio</a>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <h2>Registro de usuario</h2>
    
    {if isset($errors)}
      {foreach $errors as $error}
        <div class="error">{$error}</div>
      {/foreach}
    {/if}
    
    <form id="registroForm" action="{$form_action}" method="POST">
      <label for="nombre">Nombre de usuario</label>
      <input type="text" id="nombre" name="nombre" value="{$form_data.nombre|default:''}" required>

      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" maxlength="15" value="{$form_data.nickname|default:''}" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="{$form_data.telefono|default:''}" required>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="{$form_data.email|default:''}" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">Confirmar Contraseña:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <button type="submit" class="btn">Registrarse</button>
    </form>
  </main>

  <footer class="footer">
    <p>&copy; 2025 {$logo_text}. Todos los derechos reservados.</p>
  </footer>

  <script src="validaciones_intento1.js"></script>
</body>
</html>
