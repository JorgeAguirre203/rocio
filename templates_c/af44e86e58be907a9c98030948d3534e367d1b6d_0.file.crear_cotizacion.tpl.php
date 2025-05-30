<?php
/* Smarty version 3.1.39, created on 2025-05-30 05:33:24
  from '/var/www/html/rocio/templates/crear_cotizacion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_683943248164c8_86684928',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af44e86e58be907a9c98030948d3534e367d1b6d' => 
    array (
      0 => '/var/www/html/rocio/templates/crear_cotizacion.tpl',
      1 => 1748583157,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_683943248164c8_86684928 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cotización</title>
</head>
<body>
    <h2>Crear Cotización para <?php echo $_smarty_tpl->tpl_vars['usuario']->value['nombre'];?>
 <?php if ($_smarty_tpl->tpl_vars['usuario']->value['nickname']) {?>(<?php echo $_smarty_tpl->tpl_vars['usuario']->value['nickname'];?>
)<?php }?></h2>
    <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
        <p><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</p>
    <?php }?>
    <form method="post">
        <label>Monto: <input type="number" step="0.01" name="monto" required></label><br>
        <label>Descripción:<br>
            <textarea name="descripcion" rows="4" cols="40" required></textarea>
        </label><br>
        <button type="submit">Guardar cotización</button>
    </form>
</body>
</html><?php }
}
