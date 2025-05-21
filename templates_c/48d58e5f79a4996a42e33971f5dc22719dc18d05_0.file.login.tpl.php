<?php
/* Smarty version 3.1.39, created on 2025-05-21 01:56:43
  from '/var/www/html/rocio/templates/login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_682d32dbae7217_64300017',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '48d58e5f79a4996a42e33971f5dc22719dc18d05' => 
    array (
      0 => '/var/www/html/rocio/templates/login.tpl',
      1 => 1747711055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682d32dbae7217_64300017 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
    <link rel="stylesheet" href="estilo_login.css" />
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
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

    <?php if ((isset($_smarty_tpl->tpl_vars['error']->value))) {?>
      <div class="error-message"><?php echo $_smarty_tpl->tpl_vars['error']->value;?>
</div>
    <?php }?>

    <form action="<?php echo $_smarty_tpl->tpl_vars['form_action']->value;?>
" method="POST">
      <label for="email">Correo Electrónico:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Contraseña</label>
      <input type="password" id="password" name="password" placeholder="Ingresa tu contraseña" required>

      <button type="submit" class="btn">Iniciar Sesión</button>
    </form>

    <p>¿No tienes cuenta? <a href="registrar_usuario.php">Regístrate</a></p>
    <a href="<?php echo $_smarty_tpl->tpl_vars['home_link']->value;?>
" class="back-link">← Volver</a>
  </div>

</body>
</html>
<?php }
}
