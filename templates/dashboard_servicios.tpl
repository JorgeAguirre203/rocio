{extends file='base.tpl'}

{block name='content'}

<h1>Servicios Verificados</h1>

<!-- Filtros -->
<div class="filtros">
    <label>Categoría:</label>
    <select id="filtroCategoria">
        <option value="">Todas</option>
        {foreach from=$categorias item=categoria}
            <option value="{$categoria|escape:'html'}">{$categoria|escape:'html'}</option>
        {/foreach}
    </select>

    <label>Precio máximo:</label>
    <input type="number" id="filtroPrecio" min="0">

    <label>Disponibilidad:</label>
    <select id="filtroDisponibilidad">
        <option value="">Todas</option>
        <option value="Disponible">Disponible</option>
        <option value="No disponible">No disponible</option>
    </select>

    <label>Estrellas mínimas:</label>
    <input type="number" id="filtroEstrellas" min="1" max="5">
</div>

<!-- Servicios -->
<div id="contenedorServicios">
    {foreach from=$servicios item=servicio}
        <section id="servicio_{$servicio.id|escape:'html'}"
                 class="servicio"
                 data-estrellas="{$servicio.estrellas|escape:'html'}"
                 data-precio="{$servicio.precio|escape:'html'}"
                 data-disponibilidad="{$servicio.disponibilidad|escape:'html'}"
                 data-categoria="{$servicio.especialidad|escape:'html'}">
            <img src="img/{$servicio.imagen|escape:'html'}" alt="{$servicio.descripcion|escape:'html'}">
            <div class="info">
                <h3>{$servicio.descripcion|escape:'html'}</h3>
                <p>{$servicio.detalles|escape:'html'}</p>
                <span>${$servicio.precio|escape:'html'} MXN</span>
            </div>
        </section>
    {/foreach}
</div>

{/block}

