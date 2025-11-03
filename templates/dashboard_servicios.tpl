<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title|escape:'html'}</title>
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

    {if $direccion_incompleta}
        <div style="position:fixed;top:10px;left:10px;z-index:1000;background:#ffeeba;color:#856404;padding:10px 20px;border-radius:5px;">
            <strong>¡Atención!</strong> Primero agrega tu dirección antes de contratar un afiliado.
            <a href="direccion_usuario.php" style="color:#007bff;text-decoration:underline;">Agregar dirección</a>
        </div>
    {/if}
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
                <span class="noti-badge" id="noti-badge" {if $noti_count == 0}style="display:none;"{/if}>{$noti_count}</span>
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
            {if $noti_count > 0}
                <ul>
                {foreach $notificaciones as $noti}
                    <li>
                        {$noti.mensaje nofilter}
                        <form method="post" action="eliminar_notificacion.php" style="display:inline;">
                            <input type="hidden" name="id_notificacion" value="{$noti.id}">
                            <button type="submit" style="background:none;border:none;color:red;cursor:pointer;" title="Eliminar notificación">&#10006;</button>
                        </form>
                    </li>
                {/foreach}
                </ul>
            {else}
                <p>No tienes notificaciones.</p>
            {/if}
        </div>
    </div>
    <div id="noti-overlay" class="noti-overlay" onclick="closeNotificaciones()"></div>




    <!-- Sidebar de perfil -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Nickname:</strong> {$nickname}</p>
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
                {foreach $categorias as $categoria}
                <li>
                    <input type="checkbox" id="cat_{$categoria.id|escape:'html'}" 
                           class="filtro-categoria"
                           data-categoria="{$categoria.id|escape:'html'}" 
                           {if $categoria.checked}checked{/if}>
                    <label for="cat_{$categoria.id|escape:'html'}">{$categoria.nombre|escape:'html'}</label>
                </li>
                {/foreach}
            </ul>
        </div>
        
        <div class="filtro-bloque">
            <h4>Calificación</h4>
            <select id="filtro-estrellas" class="filtro-select">
                {html_options options=$opciones_estrellas}
            </select>
        </div>
        
        <div class="filtro-bloque">
            <h4>Precio estimado</h4>
            <select id="filtro-precio" class="filtro-select">
                {html_options options=$opciones_precio}
            </select>
        </div>
        
        <div class="filtro-bloque">
            <h4>Disponibilidad</h4>
            <ul>
                {foreach $disponibilidades as $disp}
                <li>
                    <input type="checkbox" id="disp_{$disp.id|escape:'html'}" 
                           class="filtro-disponibilidad"
                           data-dia="{$disp.id|escape:'html'}"
                           {if $disp.checked}checked{/if}>
                    <label for="disp_{$disp.id|escape:'html'}">{$disp.nombre|escape:'html'}</label>
                </li>
                {/foreach}
            </ul>
        </div>
    </div>
    <!-- Contenido principal -->
    <div class="container">
        <main class="servicios">
            {if count($servicios) > 0}
                {foreach $servicios as $servicio}
                <section class="servicio" 
                         id="afiliado_{$servicio.id|escape:'html'}"
                         data-estrellas="{$servicio.estrellas|escape:'html'}"
                         data-precio="{$servicio.precio|escape:'html'}"
                         data-disponibilidad="{$servicio.disponibilidad|escape:'html'}"
                         data-especialidad="{$servicio.especialidad|escape:'html'}">
                    <img src="{$servicio.foto_perfil}" alt="Foto de perfil" />
                    <h2>{$servicio.nombre|escape:'html'}</h2>
                    <p>{$servicio.descripcion|escape:'html'}</p>
                    <p>
                        <strong>Calificación:</strong>
                        {$servicio.estrellas} 
                        {section name=star loop=5}
                            {if $servicio.estrellas >= $smarty.section.star.index+1}
                                <span style="color:gold;">&#9733;</span>
                            {elseif $servicio.estrellas > $smarty.section.star.index}
                                <span style="color:gold;">&#9733;</span>
                            {else}
                                <span style="color:#ccc;">&#9733;</span>
                            {/if}
                        {/section}
                    </p>
                    <p><strong>Especialidad:</strong> {$servicio.especialidad|escape:'html'}</p>
                    <form method="post" action="contratar_afiliado.php" style="display:inline;">
                        <input type="hidden" name="id_afiliado" value="{$servicio.id}">
                        <a href="seleccionar_servicio.php?id_afiliado={$servicio.id}&id_usuario={$id_usuario}" class="servicio-btn">Contratar</a>
                    </form>
                    {* Botón para iniciar el chat *}
                    <button class="servicio-btn" style="background-color: #16a34a; margin-top: 5px;"
                            onclick="abrirChat({$smarty.session.usuario.id}, {$servicio.id}, '{$servicio.nombre|escape:'javascript'}', 0)">
                        Chatear con Afiliado
                    </button>

                    <button onclick="mostrarDetalles('afiliado_{$servicio.id|escape:'javascript'}')">
                        Ver detalles
                    </button> 
                    <div class="detalles" id="afiliado_{$servicio.id|escape:'html'}_detalles">
                        <p>{$servicio.detalles|escape:'html'}</p>
                        <p><strong>Contacto:</strong> {$servicio.email|escape:'html'}</p>
                        <p><strong>Nickname:</strong> {$servicio.nickname|escape:'html'}</p>
                    </div>
                </section>
                {/foreach}
            {else}
                <div class="no-resultados">
                    <p>No hay afiliados verificados disponibles</p>
                </div>
            {/if}
        </main>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <!-- JavaScript -->
        <script>
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
    </script>
    <script>
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
    </script>
    <!-- script de la campanita de notificaciones-->
    <script>
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
    </script>

    {* --- INICIO DEL CÓDIGO DEL CHAT --- *}
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

    <script>
    {literal}
    let chatInterval;
    function abrirChat(remitenteId, receptorId, receptorNombre, esAfiliado) { document.getElementById('chat-container').style.display = 'flex'; document.getElementById('chat-con-nombre').innerText = 'Chat con ' + receptorNombre; document.getElementById('remitente_id').value = remitenteId; document.getElementById('receptor_id').value = receptorId; document.getElementById('remitente_es_afiliado').value = esAfiliado; cargarMensajes(); if (chatInterval) clearInterval(chatInterval); chatInterval = setInterval(cargarMensajes, 3000); }
    function cerrarChat() { document.getElementById('chat-container').style.display = 'none'; if (chatInterval) clearInterval(chatInterval); }
    function cargarMensajes() { const r = document.getElementById('remitente_id').value, t = document.getElementById('receptor_id').value, e = document.getElementById('remitente_es_afiliado').value, n = document.getElementById('mensajes'); if (!r || !t) return; fetch(`obtener_mensajes.php?usuario_actual_id=${r}&otro_usuario_id=${t}&usuario_actual_es_afiliado=${e}`).then(e => e.text()).then(e => { n.innerHTML = e, n.scrollTop = n.scrollHeight }) }
    document.getElementById('formChat').addEventListener('submit', e => { e.preventDefault(); const t = new FormData; t.append('remitente_id', document.getElementById('remitente_id').value), t.append('receptor_id', document.getElementById('receptor_id').value), t.append('mensaje', document.getElementById('mensaje').value), t.append('remitente_es_afiliado', document.getElementById('remitente_es_afiliado').value), fetch('enviar_mensaje.php', { method: 'POST', body: t }).then(() => { document.getElementById('mensaje').value = '', cargarMensajes() }) });
    {/literal}
    </script>
    {* --- FIN DEL CÓDIGO DEL CHAT --- *}
</body>
</html>
