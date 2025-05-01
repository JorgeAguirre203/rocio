<?php
/* Smarty version 3.1.39, created on 2025-05-01 07:52:22
  from '/var/www/html/mi_proyecto/templates/register_jorge.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68132836ae10b1_25884013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c4bef0e6e97a2a7f3e04219f0cf4a34a8272d9db' => 
    array (
      0 => '/var/www/html/mi_proyecto/templates/register_jorge.tpl',
      1 => 1746085779,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68132836ae10b1_25884013 (Smarty_Internal_Template $_smarty_tpl) {
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

    form input, form select {
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

    .success {
      color: green;
      margin: 10px 0;
      padding: 10px;
      background-color: #eeffee;
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
" method="POST">
      <label for="nombre">Nombre:</label>
      <input type="text" id="nombre" name="nombre" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nombre'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="apellido_paterno">Apellido Paterno:</label>
      <input type="text" id="apellido_paterno" name="apellido_paterno" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['apellido_paterno'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="apellido_materno">Apellido Materno:</label>
      <input type="text" id="apellido_materno" name="apellido_materno" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['apellido_materno'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="nickname">Nickname:</label>
      <input type="text" id="nickname" name="nickname" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['nickname'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="telefono">Teléfono:</label>
      <input type="text" id="telefono" name="telefono" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['telefono'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="email">Correo electrónico:</label>
      <input type="email" id="email" name="email" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['form_data']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
" required>

      <label for="password">Contraseña:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">Confirmar Contraseña:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <button type="submit" class="btn">Registrarse</button>
    </form>
  </main>

  <footer class="footer">
    <p>&copy; 2025 <?php echo $_smarty_tpl->tpl_vars['logo_text']->value;?>
. Todos los derechos reservados.</p>
  </footer>

  <?php echo '<script'; ?>
 src="validaciones_intento1.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
