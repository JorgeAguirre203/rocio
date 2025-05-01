<?php
/* Smarty version 3.1.39, created on 2025-05-01 12:48:53
  from '/var/www/html/mi_proyecto/templates/bienvenida.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68136db51a9937_24728137',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b511f0005b36a55778b7db2c4dbba367e44b298f' => 
    array (
      0 => '/var/www/html/mi_proyecto/templates/bienvenida.tpl',
      1 => 1746103728,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68136db51a9937_24728137 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
  <link rel="stylesheet" href="style_bienvenida.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

  <div class="header">
    <button class="menu-button" onclick="toggleSidebar()">☰</button>
    <h1>Bienvenido a <?php echo $_smarty_tpl->tpl_vars['logo_text']->value;?>
</h1>
  </div>

  <div id="sidebar" class="sidebar">
    <div class="sidebar-content" onclick="event.stopPropagation();">
      <h2>Perfil</h2>
      <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</p>
      <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
</p>
      <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
      <a href="ELiminar_perfiles.php" class="nav-btn">Eliminar cuenta</a>
      <button onclick="window.location.href='dashboard_servicios.php'" class="nav-btn">Ver servicios</button>
      <button onclick="window.location.href='logout.php'" class="nav-btn">Cerrar sesión</button>
    </div>
  </div>

  <div class="main-content">
    <h2>¡Hola <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
!</h2>
    <p>¡Bienvenido a la seleccion de servicios!</p>
  </div>

  <?php echo '<script'; ?>
>
    function toggleSidebar() {
      const sidebar = document.getElementById("sidebar");
      const overlay = document.getElementById("overlay");

      if (sidebar.style.width === "250px") {
        sidebar.style.width = "0";
        overlay.style.display = "none";
      } else {
        sidebar.style.width = "250px";
        overlay.style.display = "block";
      }
    }

    function closeSidebar() {
      document.getElementById("sidebar").style.width = "0";
      document.getElementById("overlay").style.display = "none";
    }
  <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
