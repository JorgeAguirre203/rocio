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
      <input type="text" id="nombre" name="nombre" value="{$form_data.nombre|default:''}" 
             pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo letras y espacios" required>
      <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>

      <label for="apellidos">Apellidos:</label>
      <input type="text" id="apellidos" name="apellidos" value="{$form_data.apellidos|default:''}" 
            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo letras y espacios" required>
      <div id="apellidos-error" class="error-message">Solo se permiten letras y espacios</div>

      <!-- Resto de los campos del formulario se mantienen igual -->
      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" value="{$form_data.nickname|default:''}" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="{$form_data.telefono|default:''}" maxlength="10" required>
      <div id="telefono-error" class="error-message" style="display:none;color:red;font-size:0.9em;">Solo se permiten 10 dígitos</div>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="{$form_data.email|default:''}" required>
      <div id="email-error" class="error-message">Formato de correo electrónico inválido</div>

      <label for="email_confirm">Confirmar Correo electrónico:</label>
      <input type="email" id="email_confirm" name="email_confirm" value="{$form_data.email_confirm|default:''}" required>
      <div id="email-confirm-error" class="error-message">Los correos electrónicos no coinciden</div>

      <label for="password">Contraseña:</label>
      <div class="password-container">
        <input type="password" id="password" name="password" required>
        <button type="button" id="togglePassword" tabindex="-1">👁️</button>
      </div>

      <label for="confirm-password">Confirmar Contraseña:</label>
      <div class="password-container">
        <input type="password" id="confirm-password" name="confirm-password" required>
        <button type="button" id="toggleConfirmPassword" tabindex="-1">👁️</button>
      </div>

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

  {literal}
  <script>
  // Mostrar/ocultar contraseña principal
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

  // Mostrar/ocultar confirmar contraseña
  document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    const pwd = document.getElementById('confirm-password');
    if (pwd.type === 'password') {
      pwd.type = 'text';
      this.textContent = '🙈';
    } else {
      pwd.type = 'password';
      this.textContent = '👁️';
    }
  });
  document.addEventListener('DOMContentLoaded', function() {
    // Validación en tiempo real para campos de nombre y apellidos
    const nameFields = ['nombre', 'apellidos'];
    nameFields.forEach(field => {
      const input = document.getElementById(field);
      const error = document.getElementById(`${field}-error`);
      input.addEventListener('input', function() {
        const regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]*$/;
        if (!regex.test(this.value)) {
          this.classList.add('input-error');
          error.style.display = 'block';
          this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
        } else {
          this.classList.remove('input-error');
          error.style.display = 'none';
        }
      });
    });

    // Validación en tiempo real para teléfono (solo números y máximo 10 dígitos)
    const telInput = document.getElementById('telefono');
    const telError = document.getElementById('telefono-error');
    telInput.addEventListener('input', function() {
      const regex = /^[0-9]*$/;
      if (!regex.test(this.value)) {
        this.classList.add('input-error');
        telError.style.display = 'block';
        this.value = this.value.replace(/[^0-9]/g, '');
      } else if (this.value.length > 10) {
        this.classList.add('input-error');
        telError.style.display = 'block';
        this.value = this.value.slice(0, 10);
      } else {
        this.classList.remove('input-error');
        telError.style.display = 'none';
      }
    });

    // Validación de formato de email
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('email-error');
    emailInput.addEventListener('blur', function() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (this.value && !emailRegex.test(this.value)) {
        this.classList.add('input-error');
        emailError.style.display = 'block';
      } else {
        this.classList.remove('input-error');
        emailError.style.display = 'none';
      }
    });

    // Validación en tiempo real para confirmación de email
    const emailConfirmInput = document.getElementById('email_confirm');
    const emailConfirmError = document.getElementById('email-confirm-error');
    emailConfirmInput.addEventListener('input', function() {
      if (this.value !== emailInput.value) {
        this.classList.add('input-error');
        emailConfirmError.style.display = 'block';
      } else {
        this.classList.remove('input-error');
        emailConfirmError.style.display = 'none';
      }
    });

    // Función para verificar si el email está completo
    function isEmailComplete() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailInput.value && emailRegex.test(emailInput.value) && emailInput.value === emailConfirmInput.value;
    }

    // Prevenir avanzar a campos posteriores si email no está completo
    const fieldsAfterEmail = ['password', 'confirm-password', 'especialidad', 'foto_perfil', 'ine_frente', 'ine_reverso'];
    fieldsAfterEmail.forEach(fieldId => {
      document.getElementById(fieldId).addEventListener('focus', function() {
        if (!isEmailComplete()) {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (emailInput.value && !emailRegex.test(emailInput.value)) {
            emailInput.focus();
            emailInput.classList.add('input-error');
            emailError.style.display = 'block';
          } else {
            emailConfirmInput.focus();
            emailConfirmInput.classList.add('input-error');
            emailConfirmError.style.display = 'block';
          }
        }
      });
    });

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

    // Validación en submit del formulario
    document.getElementById('registroForm').addEventListener('submit', function(e) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (emailInput.value && !emailRegex.test(emailInput.value)) {
        e.preventDefault();
        emailInput.classList.add('input-error');
        emailError.style.display = 'block';
      }
      if (emailInput.value !== emailConfirmInput.value) {
        e.preventDefault();
        emailConfirmInput.classList.add('input-error');
        emailConfirmError.style.display = 'block';
      }
      if (telInput.value.length !== 10) {
        e.preventDefault();
        telInput.classList.add('input-error');
        telError.style.display = 'block';
      }
    });
  });
  </script>
  {/literal}
</body>
</html>
