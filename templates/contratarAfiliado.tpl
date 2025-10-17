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
        {if $mensaje}
            <script>alert('{$mensaje|escape:"js"}');</script>
        {/if}
        {if $usuario}
            <div class="card">
                <div class="info-grid">
                    <div>
                        <h2>Datos Personales</h2>
                        <p><strong>Nombre:</strong> {$usuario.nombre|escape:'html'}</p>
                        <p><strong>Nickname:</strong> {$usuario.nickname|escape:'html'}</p>
                        <p><strong>Teléfono:</strong> {$usuario.telefono|escape:'html'}</p>
                        <p><strong>Email:</strong> {$usuario.email|escape:'html'}</p>
                    </div>
                    <div>
                        <h2>Dirección</h2>
                        <p><strong>Calle:</strong> {$usuario.calle|escape:'html'}</p>
                        <p><strong>Número de casa:</strong> {$usuario.numero_casa|escape:'html'}</p>
                        <p><strong>Código postal:</strong> {$usuario.codigo_postal|escape:'html'}</p>
                        <p><strong>Municipio:</strong> {$usuario.municipio|escape:'html'}</p>
                        <p><strong>Estado:</strong> {$usuario.estado|escape:'html'}</p>
                        <p><strong>Indicaciones:</strong> {$usuario.indicaciones|escape:'html'}</p>
                    </div>
                </div>
                <div class="direccion-form">
                    <h2>Geocodificar Dirección</h2>
                    <form method="post">
                        <input type="hidden" name="direccion_completa" value="{$usuario.calle} {$usuario.numero_casa}, {$usuario.codigo_postal}, {$usuario.municipio}, {$usuario.estado}">
                        <button type="submit" name="geocodificar">Geocodificar Dirección</button>
                    </form>
                </div>
                {if $usuario.latitud && $usuario.longitud}
                    <div class="map-container" id="map"></div>
                    <div style="margin-top: 10px;">
                        <button onclick="mostrarRuta()">¿Cómo llegar desde tu ubicación?</button>
                        <a href="https://www.google.com/maps/dir/?api=1&destination={$usuario.latitud},{$usuario.longitud}" target="_blank" class="btn-link">Abrir en Google Maps</a><br>
                        <a href="afiliados.php" class="btn-link">← Volver</a>
                    </div>
                {else}
                    <p>La dirección aún no ha sido geocodificada.</p>
                {/if}
            </div>
        {else}
            <p>No se encontró el usuario.</p>
        {/if}
    </div>

    {if $usuario.latitud && $usuario.longitud}
    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@3.2.12/dist/leaflet-routing-machine.min.js"></script>
    <script>
        const destino = [{$usuario.latitud}, {$usuario.longitud}];
        const map = L.map('map').setView(destino, 15);

        L.tileLayer("https://{literal}{s}.tile.openstreetmap.org/{z}/{x}/{y}.png{/literal}", {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker(destino).addTo(map)
            .bindPopup("{$usuario.nombre|escape:'js'}")
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
    </script>
    {/if}
</body>
</html>