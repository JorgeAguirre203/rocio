<?php
/* Smarty version 3.1.39, created on 2025-06-13 23:42:32
  from '/var/www/html/rocio/templates/contratarAfiliado.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.39',
  'unifunc' => 'content_684cb76871a4c0_33336472',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '26612a5dc4bf31007cbbb807adad7d73c360c78a' => 
    array (
      0 => '/var/www/html/rocio/templates/contratarAfiliado.tpl',
      1 => 1749858146,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_684cb76871a4c0_33336472 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/var/www/html/rocio/libs/plugins/modifier.escape.php','function'=>'smarty_modifier_escape',),));
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contratar Afiliado</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 20px; }
        .container { max-width: 800px; margin: 0 auto; }
        .card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        h1 { color: #333; }
        .info-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
        .map-container { height: 400px; margin-top: 20px; }
        .direccion-form { margin-top: 20px; }
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
        }
        button:hover, .btn-link:hover {
            background: #217dbb;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Información del Usuario</h1>
        <?php if ($_smarty_tpl->tpl_vars['mensaje']->value) {?>
            <?php echo '<script'; ?>
>alert('<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['mensaje']->value, "js");?>
');<?php echo '</script'; ?>
>
        <?php }?>
        <?php if ($_smarty_tpl->tpl_vars['usuario']->value) {?>
            <div class="card">
                <div class="info-grid">
                    <div>
                        <h2>Datos Personales</h2>
                        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['nombre'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p><strong>Nickname:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['nickname'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['telefono'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                        <p><strong>Email:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['email'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    </div>
                    <div>
                        <h2>Dirección</h2>
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
                        <p><strong>Indicaciones:</strong> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usuario']->value['indicaciones'], ENT_QUOTES, 'UTF-8', true);?>
</p>
                    </div>
                </div>
                <div class="direccion-form">
                    <h2>Geocodificar Dirección</h2>
                    <form method="post">
                        <input type="hidden" name="direccion_completa" value="<?php echo $_smarty_tpl->tpl_vars['usuario']->value['calle'];?>
 <?php echo $_smarty_tpl->tpl_vars['usuario']->value['numero_casa'];?>
, <?php echo $_smarty_tpl->tpl_vars['usuario']->value['codigo_postal'];?>
, <?php echo $_smarty_tpl->tpl_vars['usuario']->value['municipio'];?>
, <?php echo $_smarty_tpl->tpl_vars['usuario']->value['estado'];?>
">
                        <button type="submit" name="geocodificar">Geocodificar Dirección</button>
                    </form>
                </div>
                <?php if ($_smarty_tpl->tpl_vars['usuario']->value['latitud'] && $_smarty_tpl->tpl_vars['usuario']->value['longitud']) {?>
                    <div class="map-container" id="map"></div>
                    <div style="margin-top: 10px;">
                        <button onclick="mostrarRuta()">¿Cómo llegar desde tu ubicación?</button>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=<?php echo $_smarty_tpl->tpl_vars['usuario']->value['latitud'];?>
,<?php echo $_smarty_tpl->tpl_vars['usuario']->value['longitud'];?>
" target="_blank" class="btn-link">Abrir en Google Maps</a><br>
                        <a href="afiliados.php" class="btn-link">← Volver</a>
                    </div>
                <?php } else { ?>
                    <p>La dirección aún no ha sido geocodificada.</p>
                <?php }?>
            </div>
        <?php } else { ?>
            <p>No se encontró el usuario.</p>
        <?php }?>
    </div>

    <?php if ($_smarty_tpl->tpl_vars['usuario']->value['latitud'] && $_smarty_tpl->tpl_vars['usuario']->value['longitud']) {?>
    <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        const destino = [<?php echo $_smarty_tpl->tpl_vars['usuario']->value['latitud'];?>
, <?php echo $_smarty_tpl->tpl_vars['usuario']->value['longitud'];?>
];
        const map = L.map('map').setView(destino, 15);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker(destino).addTo(map)
            .bindPopup("<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['usuario']->value['nombre'], 'js');?>
")
            .openPopup();

        let routingControl;

        function mostrarRuta() {
            if (!navigator.geolocation) {
                alert('Tu navegador no soporta geolocalización.');
                return;
            }

            navigator.geolocation.getCurrentPosition(function(position) {
                const origen = [position.coords.latitude, position.coords.longitude];

                if (routingControl) {
                    map.removeControl(routingControl);
                }

                routingControl = L.Routing.control({
                    waypoints: [
                        L.latLng(origen[0], origen[1]),
                        L.latLng(destino[0], destino[1])
                    ],
                    routeWhileDragging: false,
                    language: 'es',
                    showAlternatives: false
                }).addTo(map);
            }, function() {
                alert('No se pudo obtener tu ubicación.');
            });
        }
    <?php echo '</script'; ?>
>
    <?php }?>
</body>
</html><?php }
}
