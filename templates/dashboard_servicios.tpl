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
            margin-bottom: 20px;
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
        <h1>Bienvenido a Servinow</h1>
    </div>

    <!-- Barra lateral de perfil (deslizable) -->
    <div id="sidebar" class="sidebar">
        <div class="sidebar-content" onclick="event.stopPropagation();">
            <h2>Perfil</h2>
            <p><strong>Nombre:</strong> {$nombre}</p>
            <p><strong>Nickname:</strong> {$nickname}</p>
            <a href="Editar_perfil.php" class="nav-btn">Editar perfil</a>
            <a href="ELiminar_perfiles.php" class="nav-btn">Eliminar cuenta</a>
            <button onclick="window.location.href='dashboard_servicios.php'" class="nav-btn">Ver servicios</button>
            <button onclick="window.location.href='logout.php'" class="nav-btn">Cerrar sesión</button>
        </div>
    </div>

    <!-- Barra lateral de filtros (estática a la derecha) -->
    <div class="sidebar-filtros">
        <h3>Filtrar servicios</h3>

        <div class="filtro-bloque">
            <h4>Categoría</h4>
            <ul>
                {foreach $categorias as $categoria}
                <li>
                    <input type="checkbox" class="filtro-categoria" 
                           id="cat_{$categoria.id|escape:'html'}" 
                           data-categoria="{$categoria.id|escape:'html'}" 
                           {if $categoria.checked}checked{/if}>
                    <label for="cat_{$categoria.id|escape:'html'}">{$categoria.nombre|escape:'html'}</label>
                </li>
                {/foreach}
            </ul>
        </div>

        <div class="filtro-bloque">
            <h4>Calificación</h4>
            <select id="filtro-estrellas">
                {html_options options=$opciones_estrellas}
            </select>
        </div>

        <div class="filtro-bloque">
            <h4>Precio estimado</h4>
            <select id="filtro-precio">
                {html_options options=$opciones_precio}
            </select>
        </div>

        <div class="filtro-bloque">
            <h4>Disponibilidad</h4>
            <ul>
                {foreach $disponibilidades as $disp}
                <li>
                    <input type="checkbox" class="filtro-disponibilidad" 
                           id="disp_{$disp.id|escape:'html'}" 
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
        {foreach $servicios as $servicio}
        <section id="{$servicio.id|escape:'html'}" class="servicio" 
                 data-estrellas="{$servicio.estrellas|escape:'html'}" 
                 data-precio="{$servicio.precio|escape:'html'}" 
                 data-disponibilidad="{$servicio.disponibilidad|escape:'html'}">
            <img src="{$servicio.imagen|escape:'html'}" alt="{$servicio.nombre|escape:'html'}">
            <h2>{$servicio.nombre|escape:'html'}</h2>
            <p>{$servicio.descripcion|escape:'html'}</p>
            <button onclick="mostrarDetalles('{$servicio.id|escape:'javascript'}')">Ver más</button>
            <div id="{$servicio.id|escape:'html'}-detalles" class="detalles">
                <p>{$servicio.detalles|escape:'html'}</p>
            </div>
        </section>
        {/foreach}
    </main>
</div>

   <!-- Contenido principal -->
<div class="  <p>&copy; {$current_year|escape:'html'} {$company_name|escape:'html'}</p>
    </footer>

    <!-- Overlay -->
    <div id="overlay" class="overlay" onclick="closeSidebar()"></div>

    <script>
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
    </script>

</body>
</html>

