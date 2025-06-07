<?php
/* Smarty version 3.1.39, created on 2025-05-30 15:41:55
  from '/var/www/html/rocio/templates/eliminar_afiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6839d1c3bead09_98195115',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8cad14fc346a6b336fed6d57b6aad839cf1ba7f0' => 
    array (
      0 => '/var/www/html/rocio/templates/eliminar_afiliado.tpl',
      1 => 1748571935,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6839d1c3bead09_98195115 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cuenta Afiliado</title>
    <link rel="stylesheet" href="style_bienvenida.css">
</head>
<body>
    <div class="form-container">
        <h2>Eliminar Cuenta</h2>
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <div class="alert"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
        <?php }?>
        <form method="post">
            <p>¿Estás seguro que deseas eliminar tu cuenta, <strong><?php echo $_smarty_tpl->tpl_vars['afiliado']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno'];?>
</strong>?<br>
            Esta acción es irreversible.</p>
            <button type="submit" class="danger">Sí, eliminar mi cuenta</button>
            <a href="afiliados.php"><button type="button" class="button-secondary">Cancelar</button></a>
        </form>
    </div>
</body>
</html><?php }
}
