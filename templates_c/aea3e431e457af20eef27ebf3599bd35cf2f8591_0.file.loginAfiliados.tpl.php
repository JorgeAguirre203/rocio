<?php
/* Smarty version 3.1.39, created on 2025-06-08 00:18:13
  from '/var/www/html/rocio/templates/loginAfiliados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6844d6c5c149b3_46449715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'aea3e431e457af20eef27ebf3599bd35cf2f8591' => 
    array (
      0 => '/var/www/html/rocio/templates/loginAfiliados.tpl',
      1 => 1749341888,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6844d6c5c149b3_46449715 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</title>
    <link rel="stylesheet" href="loginAfiliados.css" />
</head>
<body>
    <div class="header">
        <h2><?php echo $_smarty_tpl->tpl_vars['page_title']->value;?>
</h2>
        <form method="post" style="display:inline;">
            <button type="submit" name="cerrar_sesion" class="btn-cerrar">Cerrar sesión</button>
        </form>
    </div>

<!-- Afiliados NO verificados -->
<h3>Afiliados no verificados</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Nickname</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Especialidad</th>
            <th>Foto perfil</th>
            <th>INE frente</th>
            <th>INE reverso</th>
            <th>Fecha registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['afiliados_no_verificados']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_materno'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nickname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['email'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['telefono'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['especialidad'];?>
</td>
            <td>
                <img src="<?php echo $_smarty_tpl->tpl_vars['a']->value['foto_perfil'];?>
" alt="Foto perfil" />
            </td>
            <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_frente'];?>
" target="_blank">Ver INE frente</a>
            </td>
            <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_reverso'];?>
" target="_blank">Ver INE reverso</a>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['fecha_registro'];?>
</td>
            <td>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="verificar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                    <button type="submit" class="btn-verificar">Verificar</button>
                </form>
                <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                    <input type="hidden" name="eliminar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>

<!-- Afiliados verificados -->
<h3>Afiliados verificados</h3>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre completo</th>
            <th>Nickname</th>
            <th>Email</th>
            <th>Teléfono</th>
            <th>Especialidad</th>
            <th>Foto perfil</th>
            <th>INE frente</th>
            <th>INE reverso</th>
            <th>Fecha registro</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['afiliados_verificados']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_materno'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nickname'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['email'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['telefono'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['especialidad'];?>
</td>
            <td>
                <img src="<?php echo $_smarty_tpl->tpl_vars['a']->value['foto_perfil'];?>
" alt="Foto perfil" />
            </td>
            <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_frente'];?>
" target="_blank">Ver INE frente</a>
            </td>
            <td>
                <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_reverso'];?>
" target="_blank">Ver INE reverso</a>
            </td>
            <td><?php echo $_smarty_tpl->tpl_vars['a']->value['fecha_registro'];?>
</td>
            <td>
                <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                    <input type="hidden" name="eliminar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                    <button type="submit" class="btn-eliminar">Eliminar</button>
                </form>
            </td>
        </tr>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </tbody>
</table>
    <div class="container">
        <div class="admin-info">
            Bienvenido, admin: <strong><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['admin_nombre']->value, ENT_QUOTES, 'UTF-8', true);?>
</strong>
        </div>
        <?php if (count($_smarty_tpl->tpl_vars['afiliados']->value) > 0) {?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre completo</th>
                        <th>Nickname</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>Especialidad</th>
                        <th>Foto perfil</th>
                        <th>INE frente</th>
                        <th>INE reverso</th>
                        <th>Fecha registro</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['afiliados']->value, 'a');
$_smarty_tpl->tpl_vars['a']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['a']->value) {
$_smarty_tpl->tpl_vars['a']->do_else = false;
?>
                    <tr>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['a']->value['apellido_materno'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['nickname'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['email'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['telefono'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['especialidad'];?>
</td>
                        <td>
                            <img src="<?php echo $_smarty_tpl->tpl_vars['a']->value['foto_perfil'];?>
" alt="Foto perfil" />
                        </td>
                        <td>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_frente'];?>
" target="_blank">Ver INE frente</a>
                        </td>
                        <td>
                            <a href="<?php echo $_smarty_tpl->tpl_vars['a']->value['ine_reverso'];?>
" target="_blank">Ver INE reverso</a>
                        </td>
                        <td><?php echo $_smarty_tpl->tpl_vars['a']->value['fecha_registro'];?>
</td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="verificar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                                <button type="submit" class="btn-verificar">Verificar</button>
                            </form>
                            <form method="post" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este afiliado?');">
                                <input type="hidden" name="eliminar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                                <button type="submit" class="btn-eliminar">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="verificar_id" value="<?php echo $_smarty_tpl->tpl_vars['a']->value['id'];?>
">
                                <button type="submit" class="btn-verificar">Verificar</button>
                            </form>
                        </td>
                    </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>No hay afiliados pendientes de verificación.</p>
        <?php }?>
    </div>
</body>
</html><?php }
}
