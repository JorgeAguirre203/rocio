<?php
/* Smarty version 3.1.39, created on 2025-11-09 00:37:21
  from 'C:\xampp\htdocs\rocio\templates\eliminar_afiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_690fd431cd8dc5_68920872',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b07dae92b7e5d0a88844a0e57feb93a08d07b6c4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\eliminar_afiliado.tpl',
      1 => 1762644731,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690fd431cd8dc5_68920872 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Cuenta Afiliado</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <style>
        .otra-razon { display: none; }
    </style>
    <?php echo '<script'; ?>
>
        function mostrarOtraRazon() {
            var select = document.getElementById('razon');
            var otra = document.getElementById('otra_razon_container');
            if (select.value === 'otros') {
                otra.style.display = 'block';
            } else {
                otra.style.display = 'none';
            }
        }
    <?php echo '</script'; ?>
>
</head>
<body>
    <div class="form-container">
        <h2>Eliminar Cuenta</h2>
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <div class="alert"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['mostrar_formulario']->value) {?>
        <h3>¿Por qué deseas eliminar tu cuenta?</h3>
        <form method="post">
            <label for="razon">Selecciona una razón:</label>
            <select name="razon" id="razon" onchange="mostrarOtraRazon()" required>
                <option value="">Selecciona una opción</option>
                <option value="No estoy satisfecho con el servicio">No estoy satisfecho con el servicio</option>
                <option value="Problemas de privacidad">Problemas de privacidad</option>
                <option value="Quiero crear una nueva cuenta">Quiero crear una nueva cuenta</option>
                <option value="No uso la aplicación">No uso la aplicación</option>
                <option value="Problemas técnicos">Problemas técnicos</option>
                <option value="otros">Otros</option>
            </select>

            <div id="otra_razon_container" class="otra-razon">
                <label for="otra_razon">Especifica la razón:</label>
                <textarea name="otra_razon" id="otra_razon" rows="4" placeholder="Describe la razón..."></textarea>
            </div>

            <p>¿Estás seguro que deseas eliminar tu cuenta, <strong><?php echo $_smarty_tpl->tpl_vars['afiliado']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno'];?>
</strong>?<br>
            Esta acción es irreversible.</p>
            <button type="submit" class="danger">Sí, eliminar mi cuenta</button>
            <a href="afiliados.php"><button type="button" class="button-secondary">Cancelar</button></a>
        </form>
        <?php }?>
    </div>
</body>
</html>
<?php }
}
