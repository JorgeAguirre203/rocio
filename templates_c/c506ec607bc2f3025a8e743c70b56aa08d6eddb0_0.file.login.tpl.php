<?php
/* Smarty version 3.1.39, created on 2025-11-08 04:38:09
  from 'C:\xampp\htdocs\rocio\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_690ebb216bc319_47933151',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c506ec607bc2f3025a8e743c70b56aa08d6eddb0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\login.tpl',
      1 => 1762469278,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690ebb216bc319_47933151 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
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
      <div id="logo" class="logo"><?php echo $_smarty_tpl->tpl_vars['logo_text']->value;?>
</div>
      <div class="nav-links">
        <a href="<?php echo $_smarty_tpl->tpl_vars['home_link']->value;?>
" class="nav-btn">Inicio</a>
      </div>
    </div>
  </nav>

  <div class="auth-container">
    <h2><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h2>

<?php if ($_smarty_tpl->tpl_vars['error']->value) {
echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function() {
        alert('<?php echo strtr($_smarty_tpl->tpl_vars['error']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
    });
<?php echo '</script'; ?>
>
<?php }?>


    <form action="<?php echo $_smarty_tpl->tpl_vars['form_action']->value;?>
" method="POST">
      <label for="email">Correo Electrónico:</label>
      <div class="email-container">
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['email_value']->value, ENT_QUOTES, 'UTF-8', true);?>
" required>
      </div>
      <label for="password">Contraseña</label>
      <div class="password-container">
        <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>
        <button type="button" id="togglePassword" tabindex="-1">👁️</button>
      </div>
      <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <p>¿No tienes cuenta? <a href="registrar_usuario.php">Regístrate</a></p>
    <a href="<?php echo $_smarty_tpl->tpl_vars['home_link']->value;?>
" class="back-link">← Volver</a>
  </div>

  <?php echo '<script'; ?>
>
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
  <?php echo '</script'; ?>
>

</body>
</html><?php }
}
