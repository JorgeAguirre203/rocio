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
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
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

    form input, form select, form textarea {
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      margin-top: 5px;
      font-size: 1rem;
    }

    form .file-input {
      padding: 5px;
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

    .success {
      color: green;
      margin: 10px 0;
      padding: 10px;
      background-color: #eeffee;
      border-radius: 5px;
    }

    .file-preview {
      max-width: 100px;
      max-height: 100px;
      margin-top: 10px;
      display: none;
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
        <a href="{$login_link}" class="nav-btn">Iniciar sesión</a>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <h2>Registro de empleado</h2>
    
    {if isset($errors)}
      {foreach $errors as $error}
        <div class="error">{$error}</div>
      {/foreach}
    {/if}
    
    {if isset($success)}
      <div class="success">{$success}</div>
    {/if}
    
    <form action="{$form_action}" method="POST" enctype="multipart/form-data" id="registroForm">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="{$form_data.nombre|default:''}" required>

      <label for="apellido_paterno">Apellido Paterno:</label>
      <input type="text" id="apellido_paterno" name="apellido_paterno" value="{$form_data.apellido_paterno|default:''}" required>

      <label for="apellido_materno">Apellido Materno:</label>
      <input type="text" id="apellido_materno" name="apellido_materno" value="{$form_data.apellido_materno|default:''}" required>

      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" value="{$form_data.nickname|default:''}" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="{$form_data.telefono|default:''}" required>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="{$form_data.email|default:''}" required>

      <label for="email_confirm">Confirmar Correo electrónico:</label>
      <input type="email" id="email_confirm" name="email_confirm" value="{$form_data.email_confirm|default:''}" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">Confirmar Contraseña:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <label for="especialidad">Especialidad:</label>
      <select id="especialidad" name="especialidad" required>
        <option value="">Seleccione una especialidad</option>
        {foreach $especialidades as $key => $value}
          <option value="{$key}" {if isset($form_data.especialidad) && $form_data.especialidad == $key}selected{/if}>{$value}</option>
        {/foreach}
      </select>

      <label for="foto_perfil">Foto de perfil:</label>
      <input type="file" id="foto_perfil" name="foto_perfil" accept="image/*" class="file-input" required>
      <img id="foto_perfil_preview" class="file-preview" src="#" alt="Vista previa de foto de perfil">

      <label for="ine_frente">INE (Frente):</label>
      <input type="file" id="ine_frente" name="ine_frente" accept="image/*,.pdf" class="file-input" required>
      <img id="ine_frente_preview" class="file-preview" src="#" alt="Vista previa de INE frente">

      <label for="ine_reverso">INE (Reverso):</label>
      <input type="file" id="ine_reverso" name="ine_reverso" accept="image/*,.pdf" class="file-input" required>
      <img id="ine_reverso_preview" class="file-preview" src="#" alt="Vista previa de INE reverso">

      <button type="submit" class="btn">Registrarse</button>
    </form>
  </main>

  <footer class="footer">
    <p>&copy; 2025 {$logo_text}. Todos los derechos reservados.</p>
  </footer>

  <script src="validaciones_intento1.js"></script>
  <script>
    // Función para mostrar vista previa de imágenes
    function mostrarVistaPrevia(input, previewId) {
      if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
          const preview = document.getElementById(previewId);
          preview.style.display = 'block';
          preview.src = e.target.result;
        }
        
        reader.readAsDataURL(input.files[0]);
      }
    }

    // Event listeners para las vistas previas
    document.getElementById('foto_perfil').addEventListener('change', function() {
      mostrarVistaPrevia(this, 'foto_perfil_preview');
    });

    document.getElementById('ine_frente').addEventListener('change', function() {
      mostrarVistaPrevia(this, 'ine_frente_preview');
    });

    document.getElementById('ine_reverso').addEventListener('change', function() {
      mostrarVistaPrevia(this, 'ine_reverso_preview');
    });
  </script>
</body>
</html>
