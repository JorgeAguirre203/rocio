function mostrarDetalles(servicio) {
    const detalles = document.getElementById(`${servicio}-detalles`);
    detalles.style.display = detalles.style.display === 'block' ? 'none' : 'block';
}

// Aplicar todos los filtros
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

// Escuchar eventos
document.querySelectorAll('.filtro-categoria, .filtro-disponibilidad').forEach(cb => {
    cb.addEventListener('change', aplicarFiltros);
});
document.getElementById('filtro-estrellas').addEventListener('change', aplicarFiltros);
document.getElementById('filtro-precio').addEventListener('change', aplicarFiltros);

// Ejecutar al cargar
window.addEventListener('load', aplicarFiltros);
