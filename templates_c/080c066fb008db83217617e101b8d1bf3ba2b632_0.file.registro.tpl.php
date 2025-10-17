<?php
/* Smarty version 3.1.39, created on 2025-06-12 00:21:06
  from '/var/www/html/rocio/templates/registro.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_684a1d7216a5f1_08823273',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '080c066fb008db83217617e101b8d1bf3ba2b632' => 
    array (
      0 => '/var/www/html/rocio/templates/registro.tpl',
      1 => 1749687664,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_684a1d7216a5f1_08823273 (Smarty_Internal_Template $_smarty_tpl) {
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
      </div>
    </div>
  </nav>

  <main class="form-container">
    <h2>Registro de usuario</h2>
    
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
    
    <form id="registroForm" action="<?php echo $_smarty_tpl->tpl_vars['form_action']->value;?>
" method="POST">
      <label for="nombre">Nombre de usuario</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nombre'])===null||$tmp==='' ? '' : $tmp);?>
" required>
      <div id="nombre-error" class="error-message">Solo se permiten letras y espacios</div>

      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" maxlength="15" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nickname'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['telefono'])===null||$tmp==='' ? '' : $tmp);?>
" required>
      <div id="telefono-error" class="error-message" style="display:none;color:red;font-size:0.9em;">Solo se permiten números</div>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
" required>

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
    // Validación en tiempo real para campo de nombre
    const nombreInput = document.getElementById('nombre');
    const nombreError = document.getElementById('nombre-error');
    nombreInput.addEventListener('input', function() {
      const regex = /^[A-Za-zÁÉÍÓÚáéíóúñÑ\s]*$/;
      if (!regex.test(this.value)) {
        this.classList.add('input-error');
        nombreError.style.display = 'block';
        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúñÑ\s]/g, '');
      } else {
        this.classList.remove('input-error');
        nombreError.style.display = 'none';
      }
    });

    // Validación en tiempo real para teléfono (solo números)
    const telInput = document.getElementById('telefono');
    const telError = document.getElementById('telefono-error');
    telInput.addEventListener('input', function() {
      const regex = /^[0-9]*$/;
      if (!regex.test(this.value)) {
        this.classList.add('input-error');
        telError.style.display = 'block';
        this.value = this.value.replace(/[^0-9]/g, '');
      } else {
        this.classList.remove('input-error');
        telError.style.display = 'none';
      }
    });
  });
  <?php echo '</script'; ?>
>
  
</body>
</html>
<?php }
}
