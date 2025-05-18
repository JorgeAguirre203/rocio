<?php
/* Smarty version 3.1.39, created on 2025-05-16 09:29:08
  from '/var/www/html/rocio/rocio/templates/dashboard_servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_682705642c73f5_07926363',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8ce11a17c6121c1f751cbaec1a2c0b94039f144' => 
    array (
      0 => '/var/www/html/rocio/rocio/templates/dashboard_servicios.tpl',
      1 => 1747387746,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_682705642c73f5_07926363 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/rocio/rocio/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
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
    top: 65px; /* Ajusta este valor para que no se sobreponga con la cabecera */
    width: 300px;
    height: calc(100%- 100px); /* Asegura que la altura de la barra lateral de filtros se ajuste al espadisponible  */
    background-color: #f4f4f4;
    padding: 20px;
    box-shadow: -2px 0 5px rgba(0,0,0,0.5);
    z-index: 998; /* Barra lateral de filtros detrás de la deslizante */
}

        /* Filtros */
        .filtro-bloque {
            margin-bottom: 5px;
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
    </style>
</head>
<body>

   <!-- Cabecera -->
<div class="header">
    <button class="menu-button" onclick="toggleSidebar()">☰</button>

    <!-- Logo con animación -->
    <h1 class="logo" id="logoText">Bienvenido a Servinow</h1>

    <!-- Botón de reparación (oculto al inicio) -->
    <button id="repairButton" style="display: none;">Reparar</button>

    <!-- Botón de inicio funcional -->
    <a href="index.php">
        <button>Inicio</button>
    </a>
</div>



    <!-- Barra lateral de perfil (deslizable) -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['nombre']->value, ENT_QUOTES, 'ISO-8859-1');?>
</p>
            <p><strong>Nickname:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['nickname']->value, ENT_QUOTES, 'ISO-8859-1');?>
</p>
            <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
            <a href="ELiminar_perfiles.php" class="nav-btn">Historial de pedidos</a>
             <a onclick="window.location.href='logout.php'" class="nav-btn">Cerrar sesión</a>
            <a href="ELiminar_perfiles.php" class="nav-btn">Eliminar cuenta</a>
             
             
           
           
        </div>
    </div>

    <!-- Barra lateral de filtros (estática a la derecha) -->
    <div class="sidebar-filtros">
        <h3>Filtrar servicios</h3>

        <div class="filtro-bloque">
            <h4>Categoría</h4>
            <ul>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['categorias']->value, 'categoria');
$_smarty_tpl->tpl_vars['categoria']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['categoria']->value) {
$_smarty_tpl->tpl_vars['categoria']->do_else = false;
?>
                <li>
                    <input type="checkbox" class="filtro-categoria" 
                           id="cat_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" 
                           data-categoria="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" 
                           <?php if ($_smarty_tpl->tpl_vars['categoria']->value['checked']) {?>checked<?php }?>>
                    <label for="cat_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
"><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['nombre'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
</label>
                </li>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </ul>
        </div>

        <div class="filtro-bloque">
            <h4>Calificación</h4>
            <select id="filtro-estrellas">
                <?php echo smarty_function_html_options(array('options'=>$_smarty_tpl->tpl_vars['opciones_estrellas']->value),$_smarty_tpl);?>

            </select>
        </div>

        <div class="filtro-bloque">
            <h4>Precio estimado</h4>
            <select id="filtro-precio">
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
                    <input type="checkbox" class="filtro-disponibilidad" 
                           id="disp_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" 
                           data-dia="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
"
                           <?php if ($_smarty_tpl->tpl_vars['disp']->value['checked']) {?>checked<?php }?>>
                    <label for="disp_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
"><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['nombre'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
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
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
        <section id="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" class="servicio" 
                 data-estrellas="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['estrellas'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" 
                 data-precio="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['precio'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" 
                 data-disponibilidad="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['disponibilidad'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
">
            <img src="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['imagen'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
" alt="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
">
            <h2><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
</h2>
            <p><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
</p>
            <button onclick="mostrarDetalles('<?php echo htmlspecialchars(strtr($_smarty_tpl->tpl_vars['servicio']->value['id'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )), ENT_QUOTES, 'ISO-8859-1');?>
')">Ver más</button>
            <div id="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
-detalles" class="detalles">
                <p><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['detalles'], ENT_QUOTES, 'ISO-8859-1', true), ENT_QUOTES, 'ISO-8859-1');?>
</p>
            </div>
        </section>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </main>
</div>

  
    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <?php echo '<script'; ?>
>
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

        function mostrarDetalles(servicioId) {
            const detalles = document.getElementById(servicioId + '-detalles');
            if (detalles) {
                detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
            }
        }

        // Aplicar filtros al cargar
        document.addEventListener('DOMContentLoaded', function() {
            aplicarFiltros();
            document.querySelectorAll('.filtro-categoria, .filtro-disponibilidad').forEach(cb => {
                cb.addEventListener('change', aplicarFiltros);
            });

            document.getElementById('filtro-estrellas').addEventListener('change', aplicarFiltros);
            document.getElementById('filtro-precio').addEventListener('change', aplicarFiltros);
        });

        function aplicarFiltros() {
            const categoriasActivas = Array.from(document.querySelectorAll('.filtro-categoria:checked')).map(cb => cb.dataset.categoria);
            const estrellasMin = parseInt(document.getElementById('filtro-estrellas').value);
            const precioNivel = parseInt(document.getElementById('filtro-precio').value);
            const disponibilidadDias = Array.from(document.querySelectorAll('.filtro-disponibilidad:checked')).map(cb => cb.dataset.dia);

            document.querySelectorAll('.servicio').forEach(servicio => {
                const categoria = servicio.id;
                const estrellas = parseInt(servicio.dataset.estrellas);
                const precio = parseInt(servicio.dataset.precio);
                const disponibilidad = servicio.dataset.disponibilidad;

                const cumpleCategoria = categoriasActivas.includes(categoria);
                const cumpleEstrellas = estrellas >= estrellasMin;
                const cumplePrecio = precioNivel === 0 || precio === precioNivel;
                const cumpleDisponibilidad = disponibilidadDias.length === 0 || disponibilidadDias.some(d => disponibilidad.includes(d));

                servicio.style.display = (cumpleCategoria && cumpleEstrellas && cumplePrecio && cumpleDisponibilidad) ? 'flex' : 'none';
            });
        }
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
  const logo = document.getElementById("logoText");
  const repairBtn = document.getElementById("repairButton");

  logo.addEventListener("click", () => {
    logo.classList.add("fall");
    repairBtn.style.display = "inline-block";
  });

  repairBtn.addEventListener("click", () => {
    logo.classList.remove("fall");

    // Para "reaparecer" el texto después de la animación
    logo.style.opacity = "1";
    logo.style.transform = "none";
    repairBtn.style.display = "none";
  });
<?php echo '</script'; ?>
>

<?php echo '<script'; ?>
 src="script.js"><?php echo '</script'; ?>
>
</body>
</html>

<?php }
}
