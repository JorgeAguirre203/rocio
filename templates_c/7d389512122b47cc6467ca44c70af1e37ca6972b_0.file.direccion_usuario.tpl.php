<?php
/* Smarty version 3.1.39, created on 2025-11-11 01:12:59
  from 'C:\xampp\htdocs\rocio\templates\direccion_usuario.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_69127f8bc67da3_45468409',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7d389512122b47cc6467ca44c70af1e37ca6972b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\direccion_usuario.tpl',
      1 => 1762469278,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69127f8bc67da3_45468409 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar dirección</title>
    <link rel="stylesheet" href="direccion_form.css">
</head>
<body>
    <div class="form-container">
        <h2>Agregar dirección</h2>
        
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <?php echo '<script'; ?>
>
                alert('<?php echo strtr($_smarty_tpl->tpl_vars['mensaje']->value, array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
                <?php if ($_smarty_tpl->tpl_vars['mensaje']->value == 'Dirección guardada correctamente') {?>
                    window.location.href = 'dashboard_servicios.php';
                <?php }?>
            <?php echo '</script'; ?>
>
        <?php }?>
        
        <form method="post" id="direccionForm" autocomplete="off">
            <div class="form-group">
                <label for="calle">Calle:</label>
                <input type="text" id="calle" name="calle" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['calle'])===null||$tmp==='' ? '' : $tmp);?>
" required>
                <span class="error-message" id="calle-error">Solo se permiten letras y espacios</span>
            </div>
            
            <div class="form-group">
                <label for="numero_casa">Número de casa (opcional):</label>
                <input type="text" id="numero_casa" name="numero_casa" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['numero_casa'])===null||$tmp==='' ? '' : $tmp);?>
">
                <span class="error-message" id="numero-error">Solo se permiten números y guiones</span>
            </div>
            
            <div class="form-group">
                <label for="codigo_postal">Código postal:</label>
                <input type="text" id="codigo_postal" name="codigo_postal" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['codigo_postal'])===null||$tmp==='' ? '' : $tmp);?>
" maxlength="5" required>
                <span class="error-message" id="cp-error">El código postal debe ser de 5 dígitos numéricos</span>
            </div>
            
            <div class="form-group">
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" value="Sinaloa" readonly>
            </div>
            
            <div class="form-group">
                <label for="municipio">Municipio:</label>
                <input type="text" id="municipio" name="municipio" value="Ahome" readonly>
            </div>
            
            <div class="form-group">
                <label for="indicaciones">Indicaciones adicionales:</label>
                <textarea id="indicaciones" name="indicaciones" required><?php echo (($tmp = @$_smarty_tpl->tpl_vars['datos_actuales']->value['indicaciones'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
                <small>Ejemplo: Casa color azul, portón rojo, coche blanco estacionado</small>
            </div>
            
            <button type="submit">Guardar dirección</button>
            <a href="dashboard_servicios.php">
                <button type="button" class="button-secondary">Cancelar y salir</button>
            </a>
        </form>
    </div>
    <?php echo '<script'; ?>
 src="direccion_form.js"><?php echo '</script'; ?>
>


</body>
</html><?php }
}
