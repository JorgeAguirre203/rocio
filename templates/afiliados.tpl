<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>{$page_title|escape:'html'}</title>
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
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: #222;
            color: #fff;
            padding: 15px 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 1.5em;
        }
        .menu-button {
            background: #444;
            color: #fff;
            border: none;
            font-size: 1.5em;
            border-radius: 5px;
            padding: 5px 12px;
            cursor: pointer;
        }
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
    </style>
    <script>
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
    </script>
</head>
<body>
    <div class="header">
        <button class="menu-button" onclick="toggleSidebar()">☰</button>
        <h1>Mi Perfil de Afiliado</h1>
        <a href="index.php"><button>Inicio</button></a>
    </div>

    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            {if $afiliado_log}
                <p><strong>Nombre:</strong> {$afiliado_log.nombre} {$afiliado_log.apellido_paterno} {$afiliado_log.apellido_materno}</p>
                <p><strong>Nickname:</strong> {$afiliado_log.nickname}</p>
                <a href="editar_perfil_afiliado.php" class="nav-btn">Editar perfil</a>
                <a href="historial_afiliado.php" class="nav-btn">Historial de trabajos</a>
                <a href="eliminar_afiliado.php" class="nav-btn" onclick="return confirmarEliminacion()">Eliminar cuenta</a>
                <a href="logout.php" class="nav-btn">Cerrar sesión</a>
            {else}
                <p>No has iniciado sesión.</p>
            {/if}
        </div>
    </div>

    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <div class="container">
        <main>
            {if $afiliado_log}


                
                <section class="afiliado-card">
                    <img src="{$afiliado_log.foto_perfil}" alt="Foto de perfil" />
                    <h2>{$afiliado_log.nombre} {$afiliado_log.apellido_paterno} {$afiliado_log.apellido_materno}</h2>
                    <p><strong>Nickname:</strong> {$afiliado_log.nickname}</p>
                    <p><strong>Email:</strong> {$afiliado_log.email}</p>
                    <p><strong>Especialidad:</strong> {$afiliado_log.especialidad}</p>
                </section>

                {* --- PETICIONES PENDIENTES --- *}
                <section class="peticiones-pendientes" style="margin-top:30px;">
                    <h3>Peticiones pendientes</h3>
                    {if $peticiones|@count > 0}
                        <ul>
                        {foreach $peticiones as $peticion}
                            <li>
                                <strong>{$peticion.nombre}{if $peticion.nickname} ({$peticion.nickname}){/if}</strong><br>
                                Email: {$peticion.email}<br>
                                Teléfono: {$peticion.telefono}<br>
                                <strong>Dirección:</strong>
                                {if $peticion.calle}{$peticion.calle} {/if}
                                {if $peticion.numero_casa}#{$peticion.numero_casa} {/if}
                                {if $peticion.codigo_postal}CP: {$peticion.codigo_postal} {/if}
                                {if $peticion.municipio}{$peticion.municipio}, {/if}
                                {if $peticion.estado_dir}{$peticion.estado_dir}{/if}<br>
                                {if $peticion.indicaciones}<em>Indicaciones:</em> {$peticion.indicaciones}<br>{/if}
                                <form method="post" action="aceptar_peticion.php" style="display:inline;">
                                    <input type="hidden" name="peticion_id" value="{$peticion.peticion_id}">
                                    <button type="submit">Aceptar</button>
                                </form>
                            </li>
                        {/foreach}
                        </ul>
                    {else}
                        <p>No tienes peticiones pendientes.</p>
                    {/if}
                </section>

                <section class="peticiones-aceptadas" style="margin-top:30px;">
                    <h3>Peticiones aceptadas</h3>
                    {if $peticiones_aceptadas|@count > 0}
                        <ul>
                        {foreach $peticiones_aceptadas as $peticion}
                            {if !$peticion.estado_cotizacion || $peticion.estado_cotizacion == 'pendiente'}
                                <li>
                                    <strong>{$peticion.nombre}{if $peticion.nickname} ({$peticion.nickname}){/if}</strong><br>
                                    Email: {$peticion.email}<br>
                                    Teléfono: {$peticion.telefono}<br>
                                    <strong>Dirección:</strong>
                                    {if $peticion.calle}{$peticion.calle} {/if}
                                    {if $peticion.numero_casa}#{$peticion.numero_casa} {/if}
                                    {if $peticion.codigo_postal}CP: {$peticion.codigo_postal} {/if}
                                    {if $peticion.municipio}{$peticion.municipio}, {/if}
                                    {if $peticion.estado_dir}{$peticion.estado_dir}{/if}<br>
                                    {if $peticion.indicaciones}<em>Indicaciones:</em> {$peticion.indicaciones}<br>{/if}
                                    {if !$peticion.estado_cotizacion}
                                        <form method="get" action="crear_cotizacion.php" style="display:inline;">
                                            <input type="hidden" name="peticion_id" value="{$peticion.peticion_id}">
                                            <button type="submit">Cotizar</button>
                                        </form>
                                    {elseif $peticion.estado_cotizacion == 'pendiente'}
                                        <span style="color: orange; font-weight: bold;">Pago pendiente</span>
                                        <form method="get" action="crear_cotizacion.php" style="display:inline;">
                                            <input type="hidden" name="id_cotizacion" value="{$peticion.id_cotizacion}">
                                            <button type="submit">Editar cotización</button>
                                        </form>
                                    {/if}
                                </li>
                            {/if}
                        {/foreach}
                        </ul>
                    {else}
                        <p>No tienes peticiones aceptadas.</p>
                    {/if}
                </section>
            {else}
                <div class="no-resultados">
                    <p>No has iniciado sesión.</p>
                </div>
            {/if}
        </main>
    </div>

    {if $solicitudes|@count > 0}
        <section>
            <h3>Solicitudes esperando cotización</h3>
            <ul>
            {foreach $solicitudes as $solicitud}
                <li>
                    Cliente: {$solicitud.nombre}<br>
                    Descripción: {$solicitud.descripcion}<br>
                    <form method="post" action="crear_cotizacion.php" style="display:inline;">
                        <input type="hidden" name="peticion_id" value="{$solicitud.id}">
                        <input type="number" step="0.01" name="monto" placeholder="Monto a cobrar" required>
                        <button type="submit">Enviar cotización</button>
                    </form>
                </li>
            {/foreach}
            </ul>
        </section>
    {/if}

    <script>
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
    </script>
</body>
</html>