<?php
/* Smarty version 3.1.39, created on 2025-11-08 23:45:25
  from 'C:\xampp\htdocs\rocio\templates\register_jorge.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_690fc805cf8700_70550560',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1b5c411cfd15d907f1be80fde73cc00decfd1bf6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\register_jorge.tpl',
      1 => 1762641910,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690fc805cf8700_70550560 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
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
      <div id="logo" class="logo"><?php echo $_smarty_tpl->tpl_vars['logo_text']->value;?>
</div>
      <button id="repairButton">Reparar</button>
      <div class="nav-links">
        <a href="<?php echo $_smarty_tpl->tpl_vars['home_link']->value;?>
" class="nav-btn">Inicio</a>
        <a href="<?php echo $_smarty_tpl->tpl_vars['login_link']->value;?>
" class="nav-btn">Iniciar sesión</a>
      </div>
    </div>
  </nav>

  <main class="form-container">
    <h2>Registro de empleado</h2>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['errors']->value))) {?>
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
        <div class="error"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <?php }?>
    
    <?php if ((isset($_smarty_tpl->tpl_vars['success']->value))) {?>
      <div class="success"><?php echo $_smarty_tpl->tpl_vars['success']->value;?>
</div>
    <?php }?>
    
    <form action="<?php echo $_smarty_tpl->tpl_vars['form_action']->value;?>
" method="POST" enctype="multipart/form-data" id="registroForm">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nombre'])===null||$tmp==='' ? '' : $tmp);?>
" 
             pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo letras y espacios" required>
      <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>

      <label for="apellidos">Apellidos:</label>
      <input type="text" id="apellidos" name="apellidos" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['apellidos'])===null||$tmp==='' ? '' : $tmp);?>
" 
            pattern="[A-Za-zÁÉÍÓÚáéíóúñÑ\s]+" title="Solo letras y espacios" required>
      <div id="apellidos-error" class="error-message">Solo se permiten letras y espacios</div>

      <!-- Resto de los campos del formulario se mantienen igual -->
      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nickname'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['telefono'])===null||$tmp==='' ? '' : $tmp);?>
" maxlength="10" required>
      <div id="telefono-error" class="error-message" style="display:none;color:red;font-size:0.9em;">Solo se permiten 10 dígitos</div>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
" required>
      <div id="email-error" class="error-message">Formato de correo electrónico inválido</div>

      <label for="email_confirm">Confirmar Correo electrónico:</label>
      <input type="email" id="email_confirm" name="email_confirm" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['email_confirm'])===null||$tmp==='' ? '' : $tmp);?>
" required>
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
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['especialidades']->value, 'value', false, 'key');
$_smarty_tpl->tpl_vars['value']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['value']->value) {
$_smarty_tpl->tpl_vars['value']->do_else = false;
?>
          <option value="<?php echo $_smarty_tpl->tpl_vars['key']->value;?>
" <?php if ((isset($_smarty_tpl->tpl_vars['form_data']->value['especialidad'])) && $_smarty_tpl->tpl_vars['form_data']->value['especialidad'] == $_smarty_tpl->tpl_vars['key']->value) {?>selected<?php }?>><?php echo $_smarty_tpl->tpl_vars['value']->value;?>
</option>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
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
    <p>&copy; 2025 <?php echo $_smarty_tpl->tpl_vars['logo_text']->value;?>
. Todos los derechos reservados.</p>
  </footer>

  
  <?php echo '<script'; ?>
>
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
          if (emailInput.value && !/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(emailInput.value)) {
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
  <?php echo '</script'; ?>
>
  
</body>
</html>
<?php }
}
