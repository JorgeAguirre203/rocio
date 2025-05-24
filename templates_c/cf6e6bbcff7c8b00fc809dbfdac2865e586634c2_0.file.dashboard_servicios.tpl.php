<?php
/* Smarty version 3.1.39, created on 2025-05-21 04:59:51
  from '/var/www/html/rocio/templates/dashboard_servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_682d5dc7dc63d2_63978279',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf6e6bbcff7c8b00fc809dbfdac2865e586634c2' => 
    array (
      0 => '/var/www/html/rocio/templates/dashboard_servicios.tpl',
      1 => 1747803583,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682d5dc7dc63d2_63978279 (Smarty_Internal_Template $_smarty_tpl) {
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
            height: calc(100% - 100px); /* Corrección aquí (faltaba espacio) */
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
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Afiliados Verificados</h1>
        <a href="index.php"><button>Inicio</button></a>
    </div>

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
                    <img src="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['imagen'], ENT_QUOTES, 'UTF-8', true);?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
">
                         alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
">
                    <h2><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</h2>
                    <p><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['especialidad'], ENT_QUOTES, 'UTF-8', true);?>
</p>
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
                        <p><strong>Nickname:</strong> @<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nickname'], ENT_QUOTES, 'UTF-8', true);?>
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
</body>
</html>
<?php }
}
