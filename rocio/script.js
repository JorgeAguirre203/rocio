document.addEventListener("DOMContentLoaded", function () {
    
    
    let tiempoRestante = 5;

    // Obtiene el elemento donde se mostrará el contador
    const contadorElement = document.getElementById('contador');
    
    // Función para actualizar el contador cada segundo
    const intervalo = setInterval(function() {
      // Actualiza el texto con el tiempo restante
      contadorElement.textContent = `Redirigiendo en: ${tiempoRestante} segundos`;
    
      // Resta 1 al tiempo restante
      tiempoRestante--;
    
      // Si el contador llega a 0, redirige y detiene el intervalo
      if (tiempoRestante < 0) {
        clearInterval(intervalo);
        window.location.href = "index.html"; // Cambia esto por la URL que deseas
      }
    }, 1000); // Actualiza cada 1000 milisegundos (1 segundo)
    
    // Botón de búsqueda
    const searchBtn = document.getElementById("search-btn");
    if (searchBtn) {
        searchBtn.addEventListener("click", function() {
            let query = document.getElementById("search").value;
            alert("Buscando: " + query);
        });
    } else {
        console.error("El elemento con ID 'search-btn' no se encontró en el DOM.");
    }

    // Botón de inicio de sesión (si existe)
    const loginBtn = document.getElementById("login-btn");
    if (loginBtn) {
        loginBtn.addEventListener("click", function() {
            const loginModal = document.getElementById("login-modal");
            if (loginModal) {
                loginModal.style.display = "block";
            } else {
                console.error("El elemento con ID 'login-modal' no se encontró en el DOM.");
            }
        });
    } else {
        console.error("El elemento con ID 'login-btn' no se encontró en el DOM.");
    }

    // Cerrar modal de inicio de sesión (si existe)
    const closeLogin = document.getElementById("close-login");
    if (closeLogin) {
        closeLogin.addEventListener("click", function() {
            const loginModal = document.getElementById("login-modal");
            if (loginModal) {
                loginModal.style.display = "none";
            }
        });
    } else {
        console.error("El elemento con ID 'close-login' no se encontró en el DOM.");
    }

    // Confirmar inicio de sesión (si existe)
    const confirmLogin = document.getElementById("confirm-login");
    if (confirmLogin) {
        confirmLogin.addEventListener("click", function() {
            alert("Iniciando sesión...");
            const loginModal = document.getElementById("login-modal");
            if (loginModal) {
                loginModal.style.display = "none";
            }
        });
    } else {
        console.error("El elemento con ID 'confirm-login' no se encontró en el DOM.");
    }

    // Lógica del menú de filtros
    const filterToggle = document.getElementById("filter-toggle");
    const filterMenu = document.getElementById("filter-menu");
    const filterArrow = document.getElementById("filter-arrow");
    const closeFilters = document.getElementById("close-filters");
    const applyFilters = document.getElementById("apply-filters");

    if (filterToggle && filterMenu && filterArrow && closeFilters && applyFilters) {
        filterToggle.addEventListener("click", function () {
            let buttonRect = filterToggle.getBoundingClientRect();
            filterMenu.style.top = buttonRect.bottom + window.scrollY + "px";
            filterMenu.style.left = buttonRect.left + "px";

            if (filterMenu.style.display === "block") {
                filterMenu.style.display = "none";
                filterArrow.innerHTML = "▼";
            } else {
                filterMenu.style.display = "block";
                filterArrow.innerHTML = "▲";
            }
        });

        closeFilters.addEventListener("click", function () {
            filterMenu.style.display = "none";
            filterArrow.innerHTML = "▼";
        });

        applyFilters.addEventListener("click", function () {
            alert("Filtros aplicados");
            filterMenu.style.display = "none";
            filterArrow.innerHTML = "▼";
        });
    } else {
        console.error("Uno o más elementos del menú de filtros no se encontraron en el DOM.");
    }
});