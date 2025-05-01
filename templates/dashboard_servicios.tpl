<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{$page_title|escape:'html'}</title>
    <link rel="stylesheet" href="diseño_dashboardservicios.css">
</head>
<body>
    <header>
        <h1>{$app_name|escape:'html'}</h1>
    </header>

    <div class="container">
        <!-- Barra lateral de filtros -->
        <aside class="sidebar">
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
        </aside>

        <!-- Contenido principal -->
        <main class="servicios">
            {foreach $servicios as $servicio}
            <section id="{$servicio.id|escape:'html'}" class="servicio" 
                     data-estrellas="{$servicio.estrellas|escape:'html'}" 
                     data-precio="{$servicio.precio|escape:'html'}" 
                     data-disponibilidad="{$servicio.disponibilidad|escape:'html'}">
                <img src="{$servicio.imagen|escape:'html'}" alt="{$servicio.nombre|escape:'html'}">
                <div>
                    <h2>{$servicio.nombre|escape:'html'}</h2>
                    <p>{$servicio.descripcion|escape:'html'}</p>
                    <button onclick="mostrarDetalles('{$servicio.id|escape:'javascript'}')">Ver más</button>
                    <div id="{$servicio.id|escape:'html'}-detalles" class="detalles">
                        <p>{$servicio.detalles|escape:'html'}</p>
                    </div>
                </div>
            </section>
            {/foreach}
        </main>
    </div>

    <footer>
        <p>&copy; {$current_year|escape:'html'} {$company_name|escape:'html'}</p>
    </footer>

    {literal}
    <script>
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
    </script>
    {/literal}
</body>
</html>
