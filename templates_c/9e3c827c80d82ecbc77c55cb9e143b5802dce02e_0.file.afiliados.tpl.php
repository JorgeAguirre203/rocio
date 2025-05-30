<?php
/* Smarty version 3.1.39, created on 2025-05-30 06:14:29
  from '/var/www/html/rocio/templates/afiliados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68394cc5481892_81613328',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e3c827c80d82ecbc77c55cb9e143b5802dce02e' => 
    array (
      0 => '/var/www/html/rocio/templates/afiliados.tpl',
      1 => 1748585662,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68394cc5481892_81613328 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <style>
        .container {
            margin: 40px auto;
            max-width: 700px;
        }
        .afiliado-card {
            background: #fff;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 30px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.07);
            text-align: center;
        }
        .afiliado-card img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #eee;
        }
        .peticiones-pendientes {
            background: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .peticiones-pendientes h3 {
            margin-top: 0;
        }
        .peticiones-pendientes ul {
            list-style: none;
            padding: 0;
        }
        .peticiones-pendientes li {
            background: #fff;
            border-radius: 6px;
            padding: 15px;
            margin-bottom: 12px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
        }
        .peticiones-pendientes button {
            background: #3498db;
            color: #fff;
            border: none;
            padding: 7px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 8px;
        }
        .peticiones-pendientes button:hover {
            background: #217dbb;
        }
        .no-resultados {
            text-align: center;
            color: #888;
            margin-top: 40px;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #222;
            color: #fff;
            padding: 15px 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5em;
        }
        .menu-button {
            background: #444;
            color: #fff;
            border: none;
            font-size: 1.5em;
            border-radius: 5px;
            padding: 5px 12px;
            cursor: pointer;
        }
        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            height: 100%;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            z-index: 999;
        }
        .sidebar-content {
            position: relative;
            padding: 20px;
            color: #fff;
        }
        .nav-btn {
            display: block;
            margin: 10px 0;
            background: #444;
            color: #fff;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
        }
        .nav-btn:hover {
            background: #217dbb;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.3);
            z-index: 998;
        }
    </style>
    <?php echo '<script'; ?>
>
        // Funciones definidas en el head para estar disponibles inmediatamente
        function confirmarEliminacion() {
            return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
        }
        
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-250px";
                overlay.style.display = "none";
            } else {
                sidebar.style.left = "0";
                overlay.style.display = "block";
            }
        }
        
        function closeSidebar() {
            document.getElementById("sidebar").style.left = "-250px";
            document.getElementById("overlay").style.display = "none";
        }
    <?php echo '</script'; ?>
>
</head>
<body>
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Mi Perfil de Afiliado</h1>
        <a href="index.php"><button>Inicio</button></a>
    </div>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <?php if ($_smarty_tpl->tpl_vars['afiliado_log']->value) {?>
                <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_materno'];?>
</p>
                <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nickname'];?>
</p>
                <a href="editar_perfil_afiliado.php" class="nav-btn">Editar perfil</a>
                <a href="historial_afiliado.php" class="nav-btn">Historial de trabajos</a>
                <a href="eliminar_afiliado.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
                <a href="logout.php" class="nav-btn">Cerrar sesión</a>
            <?php } else { ?>
                <p>No has iniciado sesión.</p>
            <?php }?>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <div class="container">
        <main>
            <?php if ($_smarty_tpl->tpl_vars['afiliado_log']->value) {?>


                
                <section class="afiliado-card">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['foto_perfil'];?>
" alt="Foto de perfil" />
                    <h2><?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['apellido_materno'];?>
</h2>
                    <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['nickname'];?>
</p>
                    <p><strong>Email:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['email'];?>
</p>
                    <p><strong>Especialidad:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['especialidad'];?>
</p>
                </section>

                                <section class="peticiones-pendientes" style="margin-top:30px;">
                    <h3>Peticiones pendientes</h3>
                    <?php if (count($_smarty_tpl->tpl_vars['peticiones']->value) > 0) {?>
                        <section class="peticiones-pendientes">
                            <h3>Peticiones pendientes</h3>
                            <ul>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['peticiones']->value, 'peticion');
$_smarty_tpl->tpl_vars['peticion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['peticion']->value) {
$_smarty_tpl->tpl_vars['peticion']->do_else = false;
?>
                                <li>
                                    <strong><?php echo $_smarty_tpl->tpl_vars['peticion']->value['nombre'];
if ($_smarty_tpl->tpl_vars['peticion']->value['nickname']) {?> (<?php echo $_smarty_tpl->tpl_vars['peticion']->value['nickname'];?>
)<?php }?></strong><br>
                                    Email: <?php echo $_smarty_tpl->tpl_vars['peticion']->value['email'];?>
<br>
                                    Teléfono: <?php echo $_smarty_tpl->tpl_vars['peticion']->value['telefono'];?>
<br>
                                    <strong>Dirección:</strong>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['calle'];?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['numero_casa']) {?>#<?php echo $_smarty_tpl->tpl_vars['peticion']->value['numero_casa'];?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['codigo_postal']) {?>CP: <?php echo $_smarty_tpl->tpl_vars['peticion']->value['codigo_postal'];?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['municipio']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['municipio'];?>
, <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {
echo $_smarty_tpl->tpl_vars['peticion']->value['estado_dir'];
}?><br>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['indicaciones']) {?><em>Indicaciones:</em> <?php echo $_smarty_tpl->tpl_vars['peticion']->value['indicaciones'];?>
<br><?php }?>
                                    <form method="post" action="aceptar_peticion.php" style="display:inline;">
                                        <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['peticion_id'];?>
">
                                        <button type="submit">Aceptar</button>
                                    </form>
                                    <form method="get" action="contratarAfiliado.php" style="display:inline;">
                                        <input type="hidden" name="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
">
                                        <button type="submit">Ver ubicación</button>
                                    </form>
                                </li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                            </ul>
                        </section>
                    <?php } else { ?>
                        <p>No tienes peticiones pendientes.</p>
                    <?php }?>
                </section>
            <?php } else { ?>
                <div class="no-resultados">
                    <p>No has iniciado sesión.</p>
                </div>
            <?php }?>
        </main>
    </div>

    <?php if (count($_smarty_tpl->tpl_vars['solicitudes']->value) > 0) {?>
        <section>
            <h3>Solicitudes esperando cotización</h3>
            <ul>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['solicitudes']->value, 'solicitud');
$_smarty_tpl->tpl_vars['solicitud']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['solicitud']->value) {
$_smarty_tpl->tpl_vars['solicitud']->do_else = false;
?>
                <li>
                    Cliente: <?php echo $_smarty_tpl->tpl_vars['solicitud']->value['nombre'];?>
<br>
                    Descripción: <?php echo $_smarty_tpl->tpl_vars['solicitud']->value['descripcion'];?>
<br>
                    <form method="post" action="crear_cotizacion.php" style="display:inline;">
                        <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['solicitud']->value['id'];?>
">
                        <input type="number" step="0.01" name="monto" placeholder="Monto a cobrar" required>
                        <button type="submit">Enviar cotización</button>
                    </form>
                </li>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </section>
    <?php }?>

    <?php echo '<script'; ?>
>
        // Configuración adicional cuando el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function() {
            // Cerrar sidebar al hacer clic fuera de él
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                if (event.target === overlay) {
                    closeSidebar();
                }
            });
        });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
