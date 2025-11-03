<?php
/* Smarty version 3.1.39, created on 2025-11-03 21:45:31
  from '/var/www/html/rocio/templates/dashboard_servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_6909227ba06062_60897693',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf6e6bbcff7c8b00fc809dbfdac2865e586634c2' => 
    array (
      0 => '/var/www/html/rocio/templates/dashboard_servicios.tpl',
      1 => 1762206329,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6909227ba06062_60897693 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/rocio/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'UTF-8', true);?>
</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">

    <style>
        /* Aseguramos que la barra lateral deslizante no se superponga al contenido */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            z-index: 999; /* Barra lateral deslizante en primer plano */
        }

        .sidebar-content {
            position: relative;
            padding: 20px;
            color: #fff;
        }

        .sidebar-filtros {
            position: fixed;
            right: 0;
            top: 65px;
            width: 300px;
            height: calc(100 - 65px); /* Corrección aquí (faltaba espacio) */
            background-color: #f4f4f4;
            padding: 20px;
            box-shadow: -2px 0 5px rgba(0,0,0,0.5);
            z-index: 998;
            overflow-y: auto;
        }

        /* Filtros */
        .filtro-bloque {
            margin-bottom: 15px;
        }

        .filtro-bloque h4 {
            margin-bottom: 10px;
            color: #333;
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

        /* Estilos para los servicios/afiliados */
        .servicios {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
            margin-right: 320px;
        }

        .servicio {
            background: #fff;
            border-radius: 8px;
            padding: 15px;
            width: 280px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .servicio:hover {
            transform: translateY(-5px);
        }

        .servicio img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .servicio h2 {
            margin: 0 0 10px;
            color: #2c3e50;
        }

        .servicio button {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
        }

        .detalles {
            display: none;
            margin-top: 15px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 4px;
        }

        .no-resultados {
            text-align: center;
            padding: 40px;
            color: #666;
            width: 100%;
        }

        /* estilo de la bara lateral de la campanita*/
        /* Campanita de notificaciones */
        .notificaciones-icono {
            position: absolute;
            top: 18px;
            right: 30px;
            cursor: pointer;
            z-index: 1100;
            font-size: 28px;
            display: flex;
            align-items: center;
        }
        .bell {
            font-size: 28px;
            color: #3498db;
        }
        .noti-badge {
            background: #e74c3c;
            color: #fff;
            border-radius: 50%;
            font-size: 13px;
            padding: 2px 7px;
            margin-left: -10px;
            margin-top: -15px;
            position: absolute;
            right: -8px;
            top: -5px;
            z-index: 1101;
        }

        /* Barra lateral de notificaciones */
        .notificaciones-barra {
            position: fixed;
            top: 0;
            right: -350px;
            width: 320px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 8px rgba(0,0,0,0.15);
            z-index: 1200;
            transition: right 0.4s;
            display: flex;
            flex-direction: column;
        }
        .notificaciones-barra.abierta {
            right: 0;
        }
        .noti-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.2);
            z-index: 1199;
        }
        .notificaciones-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 18px 20px 10px 20px;
            border-bottom: 1px solid #eee;
        }
        .close-noti {
            background: none;
            border: none;
            font-size: 28px;
            color: #888;
            cursor: pointer;
        }
        .notificaciones-lista {
            padding: 20px;
            flex: 1;
            overflow-y: auto;
        }

        /* estilo para que no se vea e boton de inicio sobre el de la campana de notificacioens*/

        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            position: absolute;
            right: 30px;
            top: 10px;
        }

        .notificaciones-icono {
            position: relative;
            top: 0;
            right: 0;
        }
        .servicio-btn {
            background: #3498db;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            text-decoration: none;
        }
        .btn-primary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
</head>
<body>

    <?php if ($_smarty_tpl->tpl_vars['direccion_incompleta']->value) {?>
        <div style="position:fixed;top:10px;left:10px;z-index:1000;background:#ffeeba;color:#856404;padding:10px 20px;border-radius:5px;">
            <strong>¡Atención!</strong> Primero agrega tu dirección antes de contratar un afiliado.
            <a href="direccion_usuario.php" style="color:#007bff;text-decoration:underline;">Agregar dirección</a>
        </div>
    <?php }?>
    <!-- Header -->

    <!-- codigo de campana de notificaciones -->

    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Afiliados Verificados</h1>
        <div class="header-actions">
            <a href="index.php" class="btn-home-inicio">
                <span>🏠</span>
                Inicio
            </a>
            <!-- Campanita de notificaciones -->
            <div class="notificaciones-icono" onclick="toggleNotificaciones()" title="Notificaciones">
                <span class="bell">&#128276;</span>
                <span class="noti-badge" id="noti-badge" <?php if ($_smarty_tpl->tpl_vars['noti_count']->value == 0) {?>style="display:none;"<?php }?>><?php echo $_smarty_tpl->tpl_vars['noti_count']->value;?>
</span>
            </div>
        </div>
    </div>

    <!-- Barra lateral de notificaciones -->
    <div id="notificaciones-barra" class="notificaciones-barra">
        <div class="notificaciones-header">
            <h2>Notificaciones</h2>
            <button onclick="closeNotificaciones()" class="close-noti">&times;</button>
        </div>
        <div class="notificaciones-lista" id="notificaciones-lista">
            <?php if ($_smarty_tpl->tpl_vars['noti_count']->value > 0) {?>
                <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['notificaciones']->value, 'noti');
$_smarty_tpl->tpl_vars['noti']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['noti']->value) {
$_smarty_tpl->tpl_vars['noti']->do_else = false;
?>
                    <li>
                        <?php echo $_smarty_tpl->tpl_vars['noti']->value['mensaje'];?>

                        <form method="post" action="eliminar_notificacion.php" style="display:inline;">
                            <input type="hidden" name="id_notificacion" value="<?php echo $_smarty_tpl->tpl_vars['noti']->value['id'];?>
">
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;" title="Eliminar notificación">&#10006;</button>
                        </form>
                    </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            <?php } else { ?>
                <p>No tienes notificaciones.</p>
            <?php }?>
        </div>
    </div>
    <div id="noti-overlay" class="noti-overlay" onclick="closeNotificaciones()"></div>




    <!-- Sidebar de perfil -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['nombre']->value;?>
</p>
            <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['nickname']->value;?>
</p>
            <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
            <a href="ELiminar_perfiles.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
            <a href="direccion_usuario.php" class="nav-btn">Agregar direccion</a>
            <a href="logout.php" class="nav-btn">Cerrar sesión</a>
        </div>
    </div>

    <!-- Sidebar de filtros -->

    <div class="sidebar-filtros">
        <h3>Filtrar afiliados</h3>
        
        <div class="filtro-bloque">
            <h4>Especialidad</h4>
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categorias']->value, 'categoria');
$_smarty_tpl->tpl_vars['categoria']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->value) {
$_smarty_tpl->tpl_vars['categoria']->do_else = false;
?>
                <li>
                    <input type="checkbox" id="cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" 
                           class="filtro-categoria"
                           data-categoria="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" 
                           <?php if ($_smarty_tpl->tpl_vars['categoria']->value['checked']) {?>checked<?php }?>>
                    <label for="cat_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</label>
                </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </div>
        
        <div class="filtro-bloque">
            <h4>Calificación</h4>
            <select id="filtro-estrellas" class="filtro-select">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opciones_estrellas']->value),$_smarty_tpl);?>

            </select>
        </div>
        
        <div class="filtro-bloque">
            <h4>Precio estimado</h4>
            <select id="filtro-precio" class="filtro-select">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opciones_precio']->value),$_smarty_tpl);?>

            </select>
        </div>
        
        <div class="filtro-bloque">
            <h4>Disponibilidad</h4>
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['disponibilidades']->value, 'disp');
$_smarty_tpl->tpl_vars['disp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['disp']->value) {
$_smarty_tpl->tpl_vars['disp']->do_else = false;
?>
                <li>
                    <input type="checkbox" id="disp_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
" 
                           class="filtro-disponibilidad"
                           data-dia="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"
                           <?php if ($_smarty_tpl->tpl_vars['disp']->value['checked']) {?>checked<?php }?>>
                    <label for="disp_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</label>
                </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </div>
    </div>
    <!-- Contenido principal -->
    <div class="container">
        <main class="servicios">
            <?php if (count($_smarty_tpl->tpl_vars['servicios']->value) > 0) {?>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
                <section class="servicio" 
                         id="afiliado_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
"
                         data-estrellas="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['estrellas'], ENT_QUOTES, 'UTF-8', true);?>
"
                         data-precio="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['precio'], ENT_QUOTES, 'UTF-8', true);?>
"
                         data-disponibilidad="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['disponibilidad'], ENT_QUOTES, 'UTF-8', true);?>
"
                         data-especialidad="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['especialidad'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <img src="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['foto_perfil'];?>
" alt="Foto de perfil" />
                    <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
                    <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p>
                        <strong>Calificación:</strong>
                        <?php echo $_smarty_tpl->tpl_vars['servicio']->value['estrellas'];?>
 
                        <?php
$_smarty_tpl->tpl_vars['__smarty_section_star'] = new Smarty_Variable(array());
if (true) {
for ($__section_star_0_iteration = 1, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] = 0; $__section_star_0_iteration <= 5; $__section_star_0_iteration++, $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']++){
?>
                            <?php if ($_smarty_tpl->tpl_vars['servicio']->value['estrellas'] >= (isset($_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] : null)+1) {?>
                                <span style="color:gold;">&#9733;</span>
                            <?php } elseif ($_smarty_tpl->tpl_vars['servicio']->value['estrellas'] > (isset($_smarty_tpl->tpl_vars['__smarty_section_star']->value['index']) ? $_smarty_tpl->tpl_vars['__smarty_section_star']->value['index'] : null)) {?>
                                <span style="color:gold;">&#9733;</span>
                            <?php } else { ?>
                                <span style="color:#ccc;">&#9733;</span>
                            <?php }?>
                        <?php
}
}
?>
                    </p>
                    <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['especialidad'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <form method="post" action="contratar_afiliado.php" style="display:inline;">
                        <input type="hidden" name="id_afiliado" value="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
">
                        <a href="seleccionar_servicio.php?id_afiliado=<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
&id_usuario=<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
" class="servicio-btn">Contratar</a>
                    </form>
                                        <button class="servicio-btn" style="background-color: #16a34a; margin-top: 5px;"
                            onclick="abrirChat(<?php echo $_SESSION['usuario']['id'];?>
, <?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
, '<?php echo strtr($_smarty_tpl->tpl_vars['servicio']->value['nombre'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
', 0)">
                        Chatear con Afiliado
                    </button>

                    <button onclick="mostrarDetalles('afiliado_<?php echo strtr($_smarty_tpl->tpl_vars['servicio']->value['id'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
')">
                        Ver detalles
                    </button> 
                    <div class="detalles" id="afiliado_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'UTF-8', true);?>
_detalles">
                        <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['detalles'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p><strong>Contacto:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p><strong>Nickname:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nickname'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    </div>
                </section>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php } else { ?>
                <div class="no-resultados">
                    <p>No hay afiliados verificados disponibles</p>
                </div>
            <?php }?>
        </main>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- JavaScript -->
        <?php echo '<script'; ?>
>
        // Función de confirmación para eliminar cuenta
        function confirmarEliminacion() {
            return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
        }

        // Control de sidebars
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
        
        // ... (resto del código JavaScript se mantiene igual) ...
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        // Control de sidebars
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
        
        // Mostrar/ocultar detalles
        function mostrarDetalles(id) {
            const detalles = document.getElementById(id + '_detalles');
            if (detalles) {
                detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
            }
        }
        
        // Sistema de filtros
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar eventos para los filtros
            document.querySelectorAll('.filtro-categoria, .filtro-disponibilidad').forEach(checkbox => {
                checkbox.addEventListener('change', aplicarFiltros);
            });
            
            document.getElementById('filtro-estrellas').addEventListener('change', aplicarFiltros);
            document.getElementById('filtro-precio').addEventListener('change', aplicarFiltros);
        });
        
        function aplicarFiltros() {
            const categoriasActivas = Array.from(document.querySelectorAll('.filtro-categoria:checked'))
                .map(cb => cb.dataset.categoria);
            const estrellasMin = parseInt(document.getElementById('filtro-estrellas').value);
            const precioNivel = parseInt(document.getElementById('filtro-precio').value);
            const disponibilidadDias = Array.from(document.querySelectorAll('.filtro-disponibilidad:checked'))
                .map(cb => cb.dataset.dia);
            
            document.querySelectorAll('.servicio').forEach(servicio => {
                const especialidad = servicio.dataset.especialidad;
                const estrellas = parseInt(servicio.dataset.estrellas);
                const precio = parseInt(servicio.dataset.precio);
                const disponibilidad = servicio.dataset.disponibilidad;
                
                const cumpleCategoria = categoriasActivas.length === 0 || categoriasActivas.includes(especialidad);
                const cumpleEstrellas = estrellas >= estrellasMin;
                const cumplePrecio = precioNivel === 0 || precio === precioNivel;
                const cumpleDisponibilidad = disponibilidadDias.length === 0 || 
                    disponibilidadDias.some(d => disponibilidad.includes(d));
                
                servicio.style.display = (cumpleCategoria && cumpleEstrellas && cumplePrecio && cumpleDisponibilidad) 
                    ? 'flex' : 'none';
            });
        }
    <?php echo '</script'; ?>
>
    <!-- script de la campanita de notificaciones-->
    <?php echo '<script'; ?>
>
    // Notificaciones: abrir/cerrar barra lateral
    function toggleNotificaciones() {
        document.getElementById('notificaciones-barra').classList.toggle('abierta');
        document.getElementById('noti-overlay').style.display = 
            document.getElementById('notificaciones-barra').classList.contains('abierta') ? 'block' : 'none';
    }
    function closeNotificaciones() {
        document.getElementById('notificaciones-barra').classList.remove('abierta');
        document.getElementById('noti-overlay').style.display = 'none';
    }

    // Ejemplo: mostrar badge si hay notificaciones (puedes hacerlo dinámico)
    document.addEventListener('DOMContentLoaded', function() {
        // Si tienes notificaciones, muestra el badge
        // document.getElementById('noti-badge').style.display = 'inline';
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
    #chat-header button { background: none; border: none; color: white; font-size: 20px; cursor: pointer; }
    #mensajes { flex: 1; padding: 10px; overflow-y: auto; background: #f1f0f0; display: flex; flex-direction: column; }
    #formChat { display: flex; border-top: 1px solid #ccc; }
    #formChat input { flex: 1; padding: 10px; border: none; }
    #formChat button { padding: 10px 15px; border: none; background: #0078ff; color: white; cursor: pointer; }
    .mensaje-mio { background: #dcf8c6; padding: 8px 12px; border-radius: 15px 15px 0 15px; margin-bottom: 8px; max-width: 80%; align-self: flex-end; word-wrap: break-word; }
    .mensaje-otro { background: #fff; padding: 8px 12px; border-radius: 15px 15px 15px 0; margin-bottom: 8px; max-width: 80%; align-self: flex-start; word-wrap: break-word; }
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
    function abrirChat(remitenteId, receptorId, receptorNombre, esAfiliado) { document.getElementById('chat-container').style.display = 'flex'; document.getElementById('chat-con-nombre').innerText = 'Chat con ' + receptorNombre; document.getElementById('remitente_id').value = remitenteId; document.getElementById('receptor_id').value = receptorId; document.getElementById('remitente_es_afiliado').value = esAfiliado; cargarMensajes(); if (chatInterval) clearInterval(chatInterval); chatInterval = setInterval(cargarMensajes, 3000); }
    function cerrarChat() { document.getElementById('chat-container').style.display = 'none'; if (chatInterval) clearInterval(chatInterval); }
    function cargarMensajes() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value, n = document.getElementById('mensajes'); if (!r || !t) return; fetch(`obtener_mensajes.php?usuario_actual_id=${r}&otro_usuario_id=${t}&usuario_actual_es_afiliado=${e}`).then(e => e.text()).then(e => { n.innerHTML = e, n.scrollTop = n.scrollHeight }) }
    document.getElementById('formChat').addEventListener('submit', e => { e.preventDefault(); const t = new FormData; t.append('remitente_id', document.getElementById('remitente_id').value), t.append('receptor_id', document.getElementById('receptor_id').value), t.append('mensaje', document.getElementById('mensaje').value), t.append('remitente_es_afiliado', document.getElementById('remitente_es_afiliado').value), fetch('enviar_mensaje.php', { method: 'POST', body: t }).then(() => { document.getElementById('mensaje').value = '', cargarMensajes() }) });
    
    <?php echo '</script'; ?>
>
    </body>
</html>
<?php }
}
