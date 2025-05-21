<?php
/* Smarty version 3.1.39, created on 2025-05-21 01:49:12
  from '/var/www/html/rocio/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_682d311895f6c0_59852787',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e738e0b40d5c4ca1e5b70d3397e1a6ba570bfd29' => 
    array (
      0 => '/var/www/html/rocio/templates/index.tpl',
      1 => 1747711055,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682d311895f6c0_59852787 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
  <link rel="stylesheet" href="index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar">
  <div class="nav-container">
    <div id="logo" class="logo"><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</div>
    <button id="repairButton">Reparar</button>
    <div class="nav-links">
      <a href="#afiliate" class="nav-btn" onclick="window.location.href='registrar_jorge.php'">Afíliate aquí</a>
      <a href="#login" class="nav-btn" onclick="window.location.href='login.php'">Iniciar sesión</a>
    </div>
  </div>
</nav>

<!-- Hero principal -->
<section class="hero-principal">
  <div class="contenido-hero">
    <div class="texto-hero">
      <h2><?php echo $_smarty_tpl->tpl_vars['hero_title']->value;?>
</h2>
      <p><?php echo $_smarty_tpl->tpl_vars['hero_text']->value;?>
</p>
      <a href="dashboard_servicios.php" class="btn-negro">Ver Servicios</a>
    </div>
    <div class="imagen-hero">
      <img src="palacio.jpg" alt="Servicios en acción">
    </div>
  </div>
</section>

<!-- Sobre Nosotros -->
<section class="sobre-nosotros">
  <div class="contenido-nosotros">
    <h2><?php echo $_smarty_tpl->tpl_vars['about_title']->value;?>
</h2>
    <p><?php echo $_smarty_tpl->tpl_vars['about_text']->value;?>
</p>
  </div>
</section>

<!-- Pie de página -->
<footer class="footer">
  <p>&copy; <?php echo $_smarty_tpl->tpl_vars['current_year']->value;?>
 <?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
. Todos los derechos reservados.</p>
</footer>

<?php echo '<script'; ?>
 src="script.js"><?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
