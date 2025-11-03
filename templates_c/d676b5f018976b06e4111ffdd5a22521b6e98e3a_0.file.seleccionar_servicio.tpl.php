<?php
/* Smarty version 3.1.39, created on 2025-11-03 20:35:13
  from '/var/www/html/rocio/templates/seleccionar_servicio.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_690912018b7208_59056985',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd676b5f018976b06e4111ffdd5a22521b6e98e3a' => 
    array (
      0 => '/var/www/html/rocio/templates/seleccionar_servicio.tpl',
      1 => 1762202110,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_690912018b7208_59056985 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/rocio/libs/plugins/modifier.capitalize.php','function'=>'smarty_modifier_capitalize',),));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Seleccionar Servicio</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <style>
        /* === ESTILOS DEL NUEVO DISEÑO === */
        .service-selection {
            min-height: 100vh;
            padding: 16px;
            background: #f8fafc;
        }

        @media (min-width: 1024px) {
            .service-selection {
                padding: 32px;
            }
        }

        .service-header {
            max-width: 1152px;
            margin: 0 auto 32px;
        }

        .header-card {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        @media (min-width: 1024px) {
            .header-card {
                padding: 32px;
            }
        }

        .header-content {
            display: flex;
            align-items: flex-start;
            gap: 16px;
        }

        .header-icon {
            width: 48px;
            height: 48px;
            background-color: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .header-icon svg {
            width: 24px;
            height: 24px;
            color: white;
        }

        .worker-name {
            color: #2563eb;
            margin-top: 8px;
            font-weight: 600;
            font-size: 1.2em;
        }

        .services-container {
            max-width: 1152px;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        .services-section {
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 24px;
        }

        @media (min-width: 1024px) {
            .services-section {
                padding: 32px;
            }
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-icon {
            width: 40px;
            height: 40px;
            background-color: #dbeafe;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section-icon-orange {
            background-color: #ffedd5;
        }

        .section-icon svg {
            width: 20px;
            height: 20px;
            color: #2563eb;
        }

        .section-icon-orange svg {
            color: #ea580c;
        }

        .services-grid {
            display: grid;
            gap: 16px;
            grid-template-columns: 1fr;
        }

        @media (min-width: 768px) {
            .services-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (min-width: 1024px) {
            .services-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        /* Service Card Styles */
        .service-card {
            position: relative;
            cursor: pointer;
            border-radius: 12px;
            border: 2px solid #e2e8f0;
            padding: 20px;
            background-color: white;
            transition: all 0.2s ease;
        }

        .service-card:hover {
            transform: scale(1.02);
            border-color: #93c5fd;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }

        .service-card:active {
            transform: scale(0.98);
        }

        .service-card-selected {
            border-color: #3b82f6;
            background-color: #eff6ff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .selected-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 32px;
            height: 32px;
            background-color: #2563eb;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            animation: badge-appear 0.2s ease;
        }

        @keyframes badge-appear {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .check-icon {
            width: 20px;
            height: 20px;
            color: white;
        }

        .service-icon {
            font-size: 36px;
            margin-bottom: 12px;
        }

        .service-name {
            margin-bottom: 4px;
            color: #0f172a;
            font-weight: 600;
            font-size: 1.1em;
        }

        .service-card-selected .service-name {
            color: #1e3a8a;
        }

        .service-description {
            font-size: 14px;
            color: #64748b;
            margin-bottom: 16px;
            line-height: 1.4;
        }

        .service-price {
            font-weight: 600;
            color: #0f172a;
            font-size: 1.2em;
        }

        .service-card-selected .service-price {
            color: #2563eb;
        }

        /* Custom Service */
        .custom-service {
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
            padding: 24px;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .custom-service:hover {
            border-color: #60a5fa;
            background-color: rgba(239, 246, 255, 0.5);
        }

        .custom-service-active {
            border-color: #2563eb;
            background-color: rgba(239, 246, 255, 0.5);
        }

        .custom-checkbox {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }

        /* Info Alert */
        .info-alert {
            max-width: 1152px;
            margin: 0 auto;
            border: 1px solid #bfdbfe;
            background-color: #eff6ff;
            border-radius: 8px;
            padding: 16px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            color: #1e3a8a;
        }

        .icon-alert {
            width: 16px;
            height: 16px;
            color: #2563eb;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* Action Bar */
        .action-bar {
            position: sticky;
            bottom: 16px;
            background-color: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 24px;
            border: 1px solid #e2e8f0;
        }

        .action-content {
            display: flex;
            flex-direction: column;
            gap: 16px;
            align-items: center;
        }

        @media (min-width: 640px) {
            .action-content {
                flex-direction: row;
                justify-content: space-between;
            }
        }

        .selection-summary {
            text-align: center;
        }

        @media (min-width: 640px) {
            .selection-summary {
                text-align: left;
            }
        }

        .summary-header {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #16a34a;
            margin-bottom: 4px;
        }

        .icon-check {
            width: 20px;
            height: 20px;
        }

        .total-price {
            color: #0f172a;
        }

        .total-price span {
            font-weight: 600;
        }

        .no-selection {
            color: #64748b;
        }

        .action-buttons {
            display: flex;
            gap: 12px;
            width: 100%;
        }

        @media (min-width: 640px) {
            .action-buttons {
                width: auto;
            }
        }

        .btn {
            padding: 10px 20px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            flex: 1;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        @media (min-width: 640px) {
            .btn {
                flex: none;
            }
        }

        .btn-outline {
            background-color: white;
            border: 1px solid #e2e8f0;
            color: #0f172a;
        }

        .btn-outline:hover {
            background-color: #f8fafc;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
        }

        .btn-primary:hover:not(:disabled) {
            background-color: #1d4ed8;
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

        /* Header y Sidebar (manteniendo tu estilo actual) */
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

        /* Ajuste del contenido principal */
        .service-selection {
            margin-top: 90px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Seleccionar Servicio</h1>
        <a href="index.php" class="btn-home-inicio">
            <span>🏠</span>
            Inicio
        </a>
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
            <a href="direccion_usuario.php" class="nav-btn">Agregar direccion</a>
            <a href="logout.php" class="nav-btn">Cerrar sesión</a>
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- Contenido Principal -->
    <div class="service-selection">
        <!-- Header Card -->
        <div class="service-header">
            <div class="header-card">
                <div class="header-content">
                    <div class="header-icon">
                        <span>🔧</span>
                    </div>
                    <div>
                        <h1>Selecciona el tipo de trabajo para contratar a</h1>
                        <p class="worker-name"><?php echo $_smarty_tpl->tpl_vars['afiliado']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno'];?>
</p>
                    </div>
                </div>
            </div>
        </div>

        <form method="post" id="serviceForm">
            <div class="services-container">
                <!-- Servicios de Precio Fijo -->
                <?php if (count($_smarty_tpl->tpl_vars['servicios']->value) > 0) {?>
                <div class="services-section">
                    <div class="section-header">
                        <div class="section-icon">
                            <span>🔧</span>
                        </div>
                        <h2>Servicios y precios fijos (<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['especialidad']->value);?>
)</h2>
                    </div>

                    <div class="services-grid">
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['servicios']->value, 'servicio');
$_smarty_tpl->tpl_vars['servicio']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['servicio']->value) {
$_smarty_tpl->tpl_vars['servicio']->do_else = false;
?>
                        <div class="service-card <?php if (in_array($_smarty_tpl->tpl_vars['servicio']->value['id'],$_smarty_tpl->tpl_vars['selectedServices']->value)) {?>service-card-selected<?php }?>" 
                             onclick="toggleService(<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
)">
                            <?php if (in_array($_smarty_tpl->tpl_vars['servicio']->value['id'],$_smarty_tpl->tpl_vars['selectedServices']->value)) {?>
                            <div class="selected-badge">
                                <span class="check-icon">✓</span>
                            </div>
                            <?php }?>
                            
                            <div class="service-icon"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['servicio']->value['icon'])===null||$tmp==='' ? '🔧' : $tmp);?>
</div>
                            <h3 class="service-name"><?php echo $_smarty_tpl->tpl_vars['servicio']->value['nombre_servicio'];?>
</h3>
                            <p class="service-description"><?php echo $_smarty_tpl->tpl_vars['servicio']->value['descripcion'];?>
</p>
                            <div class="service-price">$<?php echo $_smarty_tpl->tpl_vars['servicio']->value['precio'];?>
 MXN</div>
                            
                            <input type="checkbox" 
                                   name="servicios_seleccionados[]" 
                                   value="<?php echo $_smarty_tpl->tpl_vars['servicio']->value['id'];?>
" 
                                   <?php if (in_array($_smarty_tpl->tpl_vars['servicio']->value['id'],$_smarty_tpl->tpl_vars['selectedServices']->value)) {?>checked<?php }?>
                                   style="display: none;">
                        </div>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
                <?php }?>

                <!-- Servicio Personalizado -->
                <div class="services-section">
                    <div class="section-header">
                        <div class="section-icon section-icon-orange">
                            <span>⏰</span>
                        </div>
                        <h2>Otro servicio (cobro por hora)</h2>
                    </div>

                    <div class="custom-service <?php if ($_smarty_tpl->tpl_vars['customService']->value) {?>custom-service-active<?php }?>" 
                         onclick="toggleCustomService()">
                        <input type="checkbox" 
                               name="tipo_cobro" 
                               value="por_hora" 
                               <?php if ($_smarty_tpl->tpl_vars['customService']->value) {?>checked<?php }?>
                               class="custom-checkbox">
                        <span>Solicitar cotización por hora</span>
                    </div>
                </div>

                <!-- Información Importante -->
                <div class="info-alert">
                    <span class="icon-alert">⚠️</span>
                    <div>
                        <strong>Información importante:</strong> También se cobrará la distancia que recorrerá el afiliado y la comisión de la aplicación. Todos los precios incluyen IVA.
                    </div>
                </div>

                <!-- Barra de Acción -->
                <div class="action-bar">
                    <div class="action-content">
                        <div class="selection-summary">
                            <?php if (count($_smarty_tpl->tpl_vars['selectedServices']->value) > 0 || $_smarty_tpl->tpl_vars['customService']->value) {?>
                                <div class="summary-header">
                                    <span class="icon-check">✓</span>
                                    <span>
                                        <?php echo count($_smarty_tpl->tpl_vars['selectedServices']->value);?>
 servicio<?php if (count($_smarty_tpl->tpl_vars['selectedServices']->value) != 1) {?>s<?php }?> seleccionado<?php if (count($_smarty_tpl->tpl_vars['selectedServices']->value) != 1) {?>s<?php }?>
                                    </span>
                                </div>
                                <?php if ($_smarty_tpl->tpl_vars['total']->value > 0) {?>
                                    <p class="total-price">
                                        Total: <span>$<?php echo $_smarty_tpl->tpl_vars['total']->value;?>
 MXN</span>
                                    </p>
                                <?php }?>
                            <?php } else { ?>
                                <p class="no-selection">Selecciona al menos un servicio</p>
                            <?php }?>
                        </div>

                        <div class="action-buttons">
                            <a href="dashboard_servicios.php" class="btn btn-outline">
                                ❌ Cancelar contratación
                            </a>
                            <button type="submit" class="btn btn-primary" id="confirmBtn">
                                ✅ Confirmar y continuar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <div class="mensaje success" style="max-width: 1152px; margin: 20px auto;"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
        <?php }?>
    </div>

    <?php echo '<script'; ?>
>
        // Funciones del Sidebar
        function toggleSidebar() {
            const sidebar = document.getElementById("sidebar");
            const overlay = document.getElementById("overlay");
            if (sidebar.style.left === "0px") {
                sidebar.style.left = "-300px";
                overlay.style.display = "none";
            } else {
                sidebar.style.left = "0";
                overlay.style.display = "block";
            }
        }

        function closeSidebar() {
            document.getElementById("sidebar").style.left = "-300px";
            document.getElementById("overlay").style.display = "none";
        }

        function confirmarEliminacion() {
            return confirm('¿Estás seguro que deseas eliminar tu cuenta?\n\nEsta acción es irreversible y se perderán todos tus datos.');
        }

        // Funciones de selección de servicios
        function toggleService(serviceId) {
            const checkbox = document.querySelector('input[value="' + serviceId + '"]');
            const card = checkbox.closest('.service-card');
            
            if (checkbox.checked) {
                checkbox.checked = false;
                card.classList.remove('service-card-selected');
            } else {
                checkbox.checked = true;
                card.classList.add('service-card-selected');
            }
            
            // Dispara el evento change manualmente
            checkbox.dispatchEvent(new Event('change'));

            updateSelectionSummary();
        }

        function toggleCustomService() {
            const container = document.querySelector('.custom-service');
            const checkbox = container.querySelector('input[type="checkbox"]');
            checkbox.checked = !checkbox.checked;

            if (checkbox.checked) {
                container.classList.add('custom-service-active');
            } else {
                container.classList.remove('custom-service-active');
            }

            // Dispara el evento change para actualizar el botón
            checkbox.dispatchEvent(new Event('change'));
        }

        function updateSelectionSummary() {
            // Esta función puede actualizar el resumen en tiempo real
            const selectedCount = document.querySelectorAll('input[name="servicios_seleccionados[]"]:checked').length;
            const customSelected = document.querySelector('input[name="tipo_cobro"]:checked');
            
            // Puedes agregar lógica para calcular el total en tiempo real aquí
        }

        // Cerrar sidebar al hacer clic fuera
        document.addEventListener('DOMContentLoaded', function() {
            document.addEventListener('click', function(event) {
                const sidebar = document.getElementById('sidebar');
                const overlay = document.getElementById('overlay');
                
                if (event.target === overlay) {
                    closeSidebar();
                }
            });
            
            // Cerrar sidebar con ESC
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    closeSidebar();
                }
            });
        });
    <?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
    document.addEventListener('DOMContentLoaded', function() {
        const confirmBtn = document.getElementById('confirmBtn');
        const serviceCheckboxes = document.querySelectorAll('input[name="servicios_seleccionados[]"]');
        const customCheckbox = document.querySelector('input[name="tipo_cobro"]');

        function updateButtonState() {
            const selectedCount = document.querySelectorAll('input[name="servicios_seleccionados[]"]:checked').length;
            const customSelected = customCheckbox && customCheckbox.checked;
            confirmBtn.disabled = (selectedCount === 0 && !customSelected);
        }

        serviceCheckboxes.forEach(cb => {
            cb.addEventListener('change', updateButtonState);
        });
        if (customCheckbox) {
            customCheckbox.addEventListener('change', updateButtonState);
        }

        updateButtonState();
    });
    <?php echo '</script'; ?>
>
</body>
</html><?php }
}
