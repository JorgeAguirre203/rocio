<?php
/* Smarty version 3.1.39, created on 2025-10-24 16:27:16
  from '/var/www/html/rocio/templates/contratarAfiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_68fba8e4d0a819_88430364',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26612a5dc4bf31007cbbb807adad7d73c360c78a' => 
    array (
      0 => '/var/www/html/rocio/templates/contratarAfiliado.tpl',
      1 => 1761323227,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_68fba8e4d0a819_88430364 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratar Afiliado</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; background-color: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        h1 { color: #333; text-align: center; margin-bottom: 30px; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
        .map-container { height: 500px; margin-top: 20px; border: 1px solid #ddd; border-radius: 8px; overflow: hidden; }
        .direccion-form { margin-top: 20px; padding: 15px; background: #f9f9f9; border-radius: 5px; }
        .geocodificar-section { margin: 15px 0; }
        button, .btn-link {
            background: #217dbb;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            margin-right: 10px;
        }
        button:hover, .btn-link:hover {
            background: #1a6ca3;
        }
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
        @media (max-width: 768px) {
            .info-grid { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
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
    <p>Cliente: <?php echo $_smarty_tpl->tpl_vars['usuario']->value['latitud'];?>
, <?php echo $_smarty_tpl->tpl_vars['usuario']->value['longitud'];?>
</p>
    <p>Afiliado: <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['latitud'];?>
, <?php echo $_smarty_tpl->tpl_vars['afiliado']->value['longitud'];?>
</p>
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
        const clienteCoords = [{$usuario.latitud}, {$usuario.longitud}];
        const afiliadoCoords = [{$afiliado.latitud}, {$afiliado.longitud}];
        const map = L.map('map').setView(clienteCoords, 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        const clienteMarker = L.marker(clienteCoords)
            .addTo(map)
            .bindPopup('Cliente').openPopup();

        const afiliadoMarker = L.marker(afiliadoCoords)
            .addTo(map)
            .bindPopup('Afiliado');

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
            }
        }).on('routesfound', function(e) {
            const routes = e.routes;
            const distanciaKm = routes[0].summary.totalDistance / 1000;
            const distanciaMillas = distanciaKm * 0.621371;
            document.getElementById('distancia').innerHTML =
                '<strong>📏 Distancia: </strong>' +
                distanciaKm.toFixed(2) + ' km (' + distanciaMillas.toFixed(2) + ' millas) - ' +
                '<strong>⏱️ Tiempo estimado: </strong>' +
                (routes[0].summary.totalTime / 60).toFixed(0) + ' minutos';
        }).addTo(map);
    <?php echo '</script'; ?>
>
    
<?php }?>
        </div>
    </div>
</body>
</html><?php }
}
