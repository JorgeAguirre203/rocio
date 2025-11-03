<?php
/* Smarty version 3.1.39, created on 2025-11-03 22:19:49
  from '/var/www/html/rocio/templates/afiliados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_69092a85880d51_60912713',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9e3c827c80d82ecbc77c55cb9e143b5802dce02e' => 
    array (
      0 => '/var/www/html/rocio/templates/afiliados.tpl',
      1 => 1762207580,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_69092a85880d51_60912713 (Smarty_Internal_Template $_smarty_tpl) {
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

        .sidebar {
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
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
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            z-index: 998;
        }
        .btn-home-inicio {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #000000;
            padding: 24px 50px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            color: white;
            font-size: 2.2em;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .btn-home-inicio:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
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
        <a href="index.php" class="btn-home-inicio">
            <span>🏠</span>
            Inicio
        </a>
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
                <a href="direccion_afiliado.php" class="nav-btn">Agregar direccion</a>
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
                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados']) {?>
                                    <p><strong>Servicios solicitados:</strong> <?php echo $_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados'];?>
</p>
                                <?php }?>
                                <?php if ($_smarty_tpl->tpl_vars['peticion']->value['tipo_cobro'] == 'por_hora') {?>
                                    <p><strong>Tipo de servicio:</strong> Cobro por hora</p>
                                <?php }?>
                                <form method="post" action="aceptar_peticion.php" style="display:inline;">
                                    <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['peticion_id'];?>
">
                                    <button type="submit">Aceptar</button>
                                </form>
                                <form method="post" action="rechazar_peticion.php" style="display:inline;">
                                    <input type="hidden" name="peticion_id" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['peticion_id'];?>
">
                                    <button type="submit" style="background:#e74c3c;">Rechazar</button>
                                </form>
                                <form method="get" action="contratarAfiliado.php" style="display:inline;">
                                    <input type="hidden" name="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
">
                                    <button type="submit">Dirección</button>
                                </form>
                                            
                                <button style="background-color: #16a34a; display: flex; align-items: center; justify-content: center; gap: 8px;"
                                        onclick="abrirChat(<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
, '<?php echo strtr($_smarty_tpl->tpl_vars['peticion']->value['nombre'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
', 1)">
                                    Chatear con Cliente
                                </button>
                            </li>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    <?php } else { ?>
                        <p>No tienes peticiones pendientes.</p>
                    <?php }?>
                </section>

                <section class="peticiones-aceptadas" style="margin-top:30px;">
                    <h3>Peticiones aceptadas</h3>
                    <?php if (count($_smarty_tpl->tpl_vars['peticiones_aceptadas']->value) > 0) {?>
                        <ul>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['peticiones_aceptadas']->value, 'peticion');
$_smarty_tpl->tpl_vars['peticion']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['peticion']->value) {
$_smarty_tpl->tpl_vars['peticion']->do_else = false;
?>
                            <?php if (!$_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] || $_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] == 'pendiente') {?>
                                <li>
                                    <strong><?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nombre'])===null||$tmp==='' ? '' : $tmp);
if ($_smarty_tpl->tpl_vars['peticion']->value['nickname']) {?> (<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nickname'])===null||$tmp==='' ? '' : $tmp);?>
)<?php }?></strong><br>
                                    Email: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['email'])===null||$tmp==='' ? '' : $tmp);?>
<br>
                                    Teléfono: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['telefono'])===null||$tmp==='' ? '' : $tmp);?>
<br>
                                    <strong>Dirección:</strong>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['calle'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['numero_casa']) {?>#<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['numero_casa'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['codigo_postal']) {?>CP: <?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['codigo_postal'])===null||$tmp==='' ? '' : $tmp);?>
 <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['municipio']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['municipio'])===null||$tmp==='' ? '' : $tmp);?>
, <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {
echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['estado_dir'])===null||$tmp==='' ? '' : $tmp);
}?><br>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['indicaciones']) {?><em>Indicaciones:</em> <?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['indicaciones'])===null||$tmp==='' ? '' : $tmp);?>
<br><?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados']) {?>
                                        <p><strong>Servicios solicitados:</strong> <?php echo $_smarty_tpl->tpl_vars['peticion']->value['servicios_contratados'];?>
</p>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['tipo_cobro'] == 'por_hora') {?>
                                        <p><strong>Tipo de servicio:</strong> Cobro por hora</p>
                                    <?php }?>
                                    <?php if ($_smarty_tpl->tpl_vars['peticion']->value['calle'] || $_smarty_tpl->tpl_vars['peticion']->value['numero_casa'] || $_smarty_tpl->tpl_vars['peticion']->value['municipio'] || $_smarty_tpl->tpl_vars['peticion']->value['estado_dir']) {?>
                                        <form method="get" action="contratarAfiliado.php" style="display:inline;">
                                            <input type="hidden" name="id_usuario" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['id_usuario'])===null||$tmp==='' ? '' : $tmp);?>
">
                                            <button type="submit">Dirección</button>
                                        </form>
                                    <?php }?>
                                                                        <button style="background-color: #16a34a;"
                                    <button style="background-color: #16a34a; display: flex; align-items: center; justify-content: center; gap: 8px;"
                                            onclick="abrirChat(<?php echo $_smarty_tpl->tpl_vars['afiliado_log']->value['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['peticion']->value['id_usuario'];?>
, '<?php echo strtr((($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['nombre'])===null||$tmp==='' ? '' : $tmp), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
', 1)">
                                        Chatear con Cliente
                                        
                                    </button>

                                    <?php if (!$_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion']) {?>
                                        <form method="get" action="crear_cotizacion.php" style="display:inline;">
                                            <input type="hidden" name="peticion_id" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['peticion']->value['peticion_id'])===null||$tmp==='' ? '' : $tmp);?>
">
                                            <button type="submit">Cotizar</button>
                                        </form>
                                    <?php } elseif ($_smarty_tpl->tpl_vars['peticion']->value['estado_cotizacion'] == 'pendiente') {?>
                                        <span style="color: orange; font-weight: bold;">Pago pendiente</span>
                                        
                                    <?php }?>
                                </li>
                            <?php }?>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                    <?php } else { ?>
                        <p>No tienes peticiones aceptadas.</p>
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
    <style>
    /* Estilos para la ventana de chat flotante */
    #chat-container {
      position: fixed;
      bottom: 0;
      right: 20px;
      width: 320px;
      max-height: 450px;
      border: 1px solid #ccc;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
      display: none; /* Oculto por defecto */
      flex-direction: column;
      font-family: Arial, sans-serif;
      border-radius: 10px 10px 0 0;
      z-index: 1500;
    }
    #chat-header {
      background: #0078ff;
      color: white;
      padding: 12px;
      cursor: pointer;
      border-radius: 10px 10px 0 0;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    #chat-header button {
        background: none;
        border: none;
        color: white;
        font-size: 20px;
        cursor: pointer;
    }
    #mensajes {
      flex: 1;
      padding: 10px;
      overflow-y: auto;
      background: #f1f0f0;
      display: flex;
      flex-direction: column;
    }
    #formChat {
      display: flex;
      border-top: 1px solid #ccc;
    }
    #formChat input {
      flex: 1;
      padding: 10px;
      border: none;
    }
    #formChat button {
      padding: 10px 15px;
      border: none;
      background: #0078ff;
      color: white;
      cursor: pointer;
    }
    .mensaje-mio {
      background: #dcf8c6; padding: 8px 12px; border-radius: 15px 15px 0 15px; margin-bottom: 8px; max-width: 80%; align-self: flex-end; word-wrap: break-word;
    }
    .mensaje-otro {
      background: #fff; padding: 8px 12px; border-radius: 15px 15px 15px 0; margin-bottom: 8px; max-width: 80%; align-self: flex-start; word-wrap: break-word;
    }
    .hora { font-size: 0.7em; color: gray; margin-left: 8px; display: block; text-align: right; }
    </style>

    <div id="chat-container">
      <div id="chat-header">
        <span id="chat-con-nombre">Chat</span>
        <button onclick="cerrarChat()">×</button>
      </div>
      <div id="mensajes"></div>
      <form id="formChat">
        <input type="hidden" id="remitente_id">
        <input type="hidden" id="receptor_id">
        <input type="hidden" id="remitente_es_afiliado">
        <input type="text" id="mensaje" placeholder="Escribe un mensaje..." required autocomplete="off">
        <button type="submit">Enviar</button>
      </form>
    </div>

    <?php echo '<script'; ?>
>
    
    let chatInterval;
    function abrirChat(remitenteId, receptorId, receptorNombre, esAfiliado) {
        document.getElementById('chat-container').style.display = 'flex';
        document.getElementById('chat-con-nombre').innerText = 'Chat con ' + receptorNombre;
        document.getElementById('remitente_id').value = remitenteId;
        document.getElementById('receptor_id').value = receptorId;
        document.getElementById('remitente_es_afiliado').value = esAfiliado;
        cargarMensajes();
        if (chatInterval) clearInterval(chatInterval);
        chatInterval = setInterval(cargarMensajes, 3000);
    }
    function cerrarChat() { document.getElementById('chat-container').style.display = 'none'; if (chatInterval) clearInterval(chatInterval); }
    function cargarMensajes() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value, n = document.getElementById('mensajes'); if (!r || !t) return; fetch(`obtener_mensajes.php?usuario_actual_id=${r}&otro_usuario_id=${t}&usuario_actual_es_afiliado=${e}`).then(e => e.text()).then(e => { n.innerHTML = e, n.scrollTop = n.scrollHeight }) }
    document.getElementById('formChat').addEventListener('submit', e => { e.preventDefault(); const t = new FormData; t.append('remitente_id', document.getElementById('remitente_id').value), t.append('receptor_id', document.getElementById('receptor_id').value), t.append('mensaje', document.getElementById('mensaje').value), t.append('remitente_es_afiliado', document.getElementById('remitente_es_afiliado').value), fetch('enviar_mensaje.php', { method: 'POST', body: t }).then(() => { document.getElementById('mensaje').value = '', cargarMensajes() }) });
    
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
