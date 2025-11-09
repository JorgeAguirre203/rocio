<?php
/* Smarty version 3.1.39, created on 2025-11-09 22:26:31
  from 'C:\xampp\htdocs\rocio\templates\contratarAfiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_691107073f7e93_07286421',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5948503c08fd8656ac38ef10e73d382b9edf5dc' => 
    array (
      0 => 'C:\\xampp\\htdocs\\rocio\\templates\\contratarAfiliado.tpl',
      1 => 1762469278,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_691107073f7e93_07286421 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratar Afiliado</title>
    <link rel="stylesheet" href="style_bienvenida.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <style>
        .container {
            margin: 40px auto;
            max-width: 700px;
        }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .map-container { height: 500px; margin-top: 20px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; position: relative; z-index: 1; }
        .direccion-form { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .geocodificar-section { margin: 15px 0; }
        .mensaje { 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 4px; 
            text-align: center;
        }
        .mensaje.error { background: #ffebee; color: #c62828; border: 1px solid #ffcdd2; }
        .mensaje.success { background: #e8f5e8; color: #2e7d32; border: 1px solid #c8e6c9; }
        .coordenadas { 
            background: #f0f8ff; 
            padding: 10px; 
            border-radius: 4px; 
            margin: 10px 0;
            font-family: monospace;
        }
        .debug-info {
            background: #fff3cd; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            border: 1px solid #ffeaa7;
            font-size: 14px;
        }
        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
        }
/* Encabezado y menú lateral afiliado */

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
        <h1>Direccion del Cliente</h1>
        <a href="index.php" class="btn-home-inicio">
            <span>🏠</span>
            Inicio
        </a>
    </div>
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Dirección del Cliente</h2>
            <?php if ($_smarty_tpl->tpl_vars['afiliado']->value) {?>
                <p><strong>Nombre:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['nombre'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_paterno'];?>
 <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['apellido_materno'];?>
</p>
                <p><strong>Nickname:</strong> <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['nickname'];?>
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
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <div class="mensaje <?php if (strpos($_smarty_tpl->tpl_vars['mensaje']->value,'correctamente') !== false) {?>success<?php } else { ?>error<?php }?>"><?php echo $_smarty_tpl->tpl_vars['mensaje']->value;?>
</div>
        <?php }?>
        
        <div class="card">
            <h1>Contratar Servicios de Afiliado</h1>
            
            <?php if ($_smarty_tpl->tpl_vars['usuario']->value) {?>
            <div class="info-grid">
                <div>
                    <h2>📋 Dirección del Cliente</h2>
                    <p><strong>Calle:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['calle'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Número de casa:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['numero_casa'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Código postal:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['codigo_postal'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Municipio:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['municipio'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['estado'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <?php if ($_smarty_tpl->tpl_vars['usuario']->value['latitud'] && $_smarty_tpl->tpl_vars['usuario']->value['longitud']) {?>
                        <div class="coordenadas">
                            <strong>Coordenadas:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['latitud'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['longitud'], ENT_QUOTES, 'UTF-8', true);?>

                        </div>
                    <?php }?>
                    
                    <div class="geocodificar-section">
                        <h3>Geocodificar Dirección del Cliente</h3>
                        <form method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">
                            <?php if ($_smarty_tpl->tpl_vars['afiliado']->value) {?>
                                <input type="hidden" name="id_afiliado" value="<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['id'];?>
">
                            <?php }?>
                            <button type="submit" name="geocodificar_cliente">📍 Geocodificar Cliente</button>
                        </form>
                    </div>
                </div>
                
                <?php if ($_smarty_tpl->tpl_vars['afiliado']->value) {?>
                <div>
                    <h2>👤 Dirección del Afiliado</h2>
                    <p><strong>Calle:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['calle'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Número de casa:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['numero_casa'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Código postal:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['codigo_postal'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Municipio:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['municipio'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <p><strong>Estado:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['estado'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    <?php if ($_smarty_tpl->tpl_vars['afiliado']->value['latitud'] && $_smarty_tpl->tpl_vars['afiliado']->value['longitud']) {?>
                        <div class="coordenadas">
                            <strong>Coordenadas:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['latitud'], ENT_QUOTES, 'UTF-8', true);?>
, <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['afiliado']->value['longitud'], ENT_QUOTES, 'UTF-8', true);?>

                        </div>
                    <?php }?>
                    
                    <div class="geocodificar-section">
                        <h3>Geocodificar Dirección del Afiliado</h3>
                        <form method="post">
                            <input type="hidden" name="id_usuario" value="<?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
">
                            <input type="hidden" name="id_afiliado" value="<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['id'];?>
">
                            <button type="submit" name="geocodificar_afiliado">📍 Geocodificar Afiliado</button>
                        </form>
                    </div>
                </div>
                <?php } else { ?>
                <div>
                    <h2>👤 Información del Afiliado</h2>
                    <p style="color: #666;">No se ha seleccionado un afiliado o no se encontró la información.</p>
                </div>
                <?php }?>
            </div>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['usuario']->value && $_smarty_tpl->tpl_vars['afiliado']->value && $_smarty_tpl->tpl_vars['usuario']->value['latitud'] && $_smarty_tpl->tpl_vars['usuario']->value['longitud'] && $_smarty_tpl->tpl_vars['afiliado']->value['latitud'] && $_smarty_tpl->tpl_vars['afiliado']->value['longitud']) {?>
                <!-- Debug información -->
                <div class="debug-info">
                    <h3>🔍 Información de Coordenadas:</h3>
                    <p><strong>Cliente:</strong> Lat: <?php echo $_smarty_tpl->tpl_vars['usuario']->value['latitud'];?>
, Lon: <?php echo $_smarty_tpl->tpl_vars['usuario']->value['longitud'];?>
</p>
                    <p><strong>Afiliado:</strong> Lat: <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['latitud'];?>
, Lon: <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['longitud'];?>
</p>
                </div>
                
                <div class="map-container" id="map"></div>
                <div style="margin-top: 15px; text-align: center;">
                    <span id="distancia" style="font-size: 16px; font-weight: bold; color: #217dbb;"></span>
                </div>
                
                <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"><?php echo '</script'; ?>
>
                <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.js"><?php echo '</script'; ?>
>
                
                <?php echo '<script'; ?>
>
                    // Coordenadas con verificación - fuera del bloque literal
                    const clienteLat = parseFloat(<?php echo $_smarty_tpl->tpl_vars['usuario']->value['latitud'];?>
);
                    const clienteLon = parseFloat(<?php echo $_smarty_tpl->tpl_vars['usuario']->value['longitud'];?>
);
                    const afiliadoLat = parseFloat(<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['latitud'];?>
);
                    const afiliadoLon = parseFloat(<?php echo $_smarty_tpl->tpl_vars['afiliado']->value['longitud'];?>
);
                    
                    const clienteCoords = [clienteLat, clienteLon];
                    const afiliadoCoords = [afiliadoLat, afiliadoLon];
                    
                    console.log('Coordenadas Cliente:', clienteCoords);
                    console.log('Coordenadas Afiliado:', afiliadoCoords);
                    
                    // Verificar que las coordenadas sean válidas
                    if (isNaN(clienteLat) || isNaN(clienteLon) || isNaN(afiliadoLat) || isNaN(afiliadoLon)) {
                        console.error('Coordenadas inválidas');
                        document.getElementById('distancia').innerHTML = 'Error: Coordenadas inválidas';
                    } else {
                        
                        try {
                            // Inicializar mapa
                            const map = L.map('map').setView(clienteCoords, 13);
                            
                            // Capa de tiles
                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                subdomains: ['a', 'b', 'c']
                            }).addTo(map);
                            
                            // Marcadores con íconos personalizados
                            const clienteIcon = L.divIcon({
                                className: 'custom-div-icon',
                                html: '<div style="background-color: #217dbb; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-weight: bold;">C</div>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 15]
                            });
                            
                            const afiliadoIcon = L.divIcon({
                                className: 'custom-div-icon',
                                html: '<div style="background-color: #28a745; color: white; border-radius: 50%; width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; font-weight: bold;">A</div>',
                                iconSize: [30, 30],
                                iconAnchor: [15, 15]
                            });
                            
                            // Marcadores en el mapa
                            L.marker(clienteCoords, {icon: clienteIcon})
                                .addTo(map)
                                .bindPopup('<b>📍 Cliente</b><br>' + 'Dirección del cliente')
                                .openPopup();
                            
                            L.marker(afiliadoCoords, {icon: afiliadoIcon})
                                .addTo(map)
                                .bindPopup('<b>👤 Afiliado</b><br>' + 'Dirección del afiliado');
                            
                            // Sistema de ruteo
                            L.Routing.control({
                                waypoints: [
                                    L.latLng(afiliadoCoords[0], afiliadoCoords[1]),
                                    L.latLng(clienteCoords[0], clienteCoords[1])
                                ],
                                routeWhileDragging: false,
                                language: 'es',
                                showAlternatives: false,
                                addWaypoints: false,
                                draggableWaypoints: false,
                                fitSelectedRoutes: true,
                                lineOptions: {
                                    styles: [{color: '#217dbb', opacity: 0.7, weight: 5}]
                                },
                                createMarker: function(i, wp, nWps) {
                                    if (i === 0) {
                                        return L.marker(wp.latLng, {icon: afiliadoIcon}).bindPopup('Afiliado');
                                    } else {
                                        return L.marker(wp.latLng, {icon: clienteIcon}).bindPopup('Cliente');
                                    }
                                }
                            }).on('routesfound', function(e) {
                                const routes = e.routes;
                                if (routes && routes[0]) {
                                    const distanciaKm = routes[0].summary.totalDistance / 1000;
                                    const distanciaMillas = distanciaKm * 0.621371;
                                    const tiempoMinutos = (routes[0].summary.totalTime / 60).toFixed(0);
                                    
                                    document.getElementById('distancia').innerHTML = 
                                        '<strong>📏 Distancia: </strong>' +
                                        distanciaKm.toFixed(2) + ' km (' + distanciaMillas.toFixed(2) + ' millas) - ' +
                                        '<strong>⏱️ Tiempo estimado: </strong>' +
                                        tiempoMinutos + ' minutos';
                                }
                            }).addTo(map);
                            
                        } catch (error) {
                            console.error('Error al cargar el mapa:', error);
                            document.getElementById('distancia').innerHTML = 'Error al cargar el mapa: ' + error.message;
                        }
                        
                    }
                <?php echo '</script'; ?>
>
            <?php } elseif ($_smarty_tpl->tpl_vars['usuario']->value && $_smarty_tpl->tpl_vars['afiliado']->value) {?>
                <div style="text-align: center; padding: 20px; color: #666;">
                    <p>❌ Para mostrar el mapa y calcular la ruta, necesitas geocodificar ambas direcciones.</p>
                    <p>Haz clic en los botones "Geocodificar" arriba para obtener las coordenadas.</p>
                </div>
            <?php }?>
        </div>
    </div>
</body>
</html><?php }
}
