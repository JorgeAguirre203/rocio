<?php
/* Smarty version 3.1.39, created on 2025-05-01 12:42:59
  from '/var/www/html/mi_proyecto/templates/dashboard_servicios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68136c53984ae0_55834275',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '51784f5cb7910742929a7052ec195b659005810a' => 
    array (
      0 => '/var/www/html/mi_proyecto/templates/dashboard_servicios.tpl',
      1 => 1746103375,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68136c53984ae0_55834275 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/mi_proyecto/libs/plugins/function.html_options.php','function'=>'smarty_function_html_options',),));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['page_title']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</title>
    <link rel="stylesheet" href="diseño_dashboardservicios.css">
</head>
<body>
    <header>
        <h1><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['app_name']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</h1>
    </header>

    <div class="container">
        <!-- Barra lateral de filtros -->
        <aside class="sidebar">
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
                               id="cat_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" 
                               data-categoria="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" 
                               <?php if ($_smarty_tpl->tpl_vars['categoria']->value['checked']) {?>checked<?php }?>>
                        <label for="cat_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['categoria']->value['nombre'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
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
                               id="disp_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" 
                               data-dia="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"
                               <?php if ($_smarty_tpl->tpl_vars['disp']->value['checked']) {?>checked<?php }?>>
                        <label for="disp_<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['disp']->value['nombre'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</label>
                    </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </ul>
            </div>
        </aside>

        <!-- Contenido principal -->
        <main class="servicios">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
            <section id="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" class="servicio" 
                     data-estrellas="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['estrellas'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" 
                     data-precio="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['precio'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" 
                     data-disponibilidad="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['disponibilidad'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
">
                <img src="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['imagen'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
">
                <div>
                    <h2><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['nombre'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</h2>
                    <p><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['descripcion'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</p>
                    <button onclick="mostrarDetalles('<?php echo htmlspecialchars(strtr($_smarty_tpl->tpl_vars['servicio']->value['id'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" )), ENT_QUOTES, 'UTF-8');?>
')">Ver más</button>
                    <div id="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['id'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
-detalles" class="detalles">
                        <p><?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['servicio']->value['detalles'], ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</p>
                    </div>
                </div>
            </section>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </main>
    </div>

    <footer>
        <p>&copy; <?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['current_year']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
 <?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
</p>
    </footer>

    
    <?php echo '<script'; ?>
>
    function mostrarDetalles(servicioId) {
        const detalles = document.getElementById(servicioId + '-detalles');
        if (detalles) {
            detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
        }
    }

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

    // Configurar event listeners cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function() {
        // Aplicar filtros al cargar
        aplicarFiltros();
        
        // Asignar eventos a los filtros
        document.querySelectorAll('.filtro-categoria, .filtro-disponibilidad').forEach(cb => {
            cb.addEventListener('change', aplicarFiltros);
        });
        
        document.getElementById('filtro-estrellas').addEventListener('change', aplicarFiltros);
        document.getElementById('filtro-precio').addEventListener('change', aplicarFiltros);
    });
    <?php echo '</script'; ?>
>
    
</body>
</html>
<?php }
}
