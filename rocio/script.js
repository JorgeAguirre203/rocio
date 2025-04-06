document.addEventListener("DOMContentLoaded", function () {
    // ============================
    // Contador de redirección
    // ============================
    let tiempoRestante = 5;
    const contadorElement = document.getElementById("contador");
    const contadorInterval = setInterval(function () {
      contadorElement.textContent = `Redirigiendo en: ${tiempoRestante} segundos`;
      tiempoRestante--;
      if (tiempoRestante < 0) {
        clearInterval(contadorInterval);
        window.location.href = "index.html"; // Cambia esto por la URL deseada
      }
    }, 1000);
  
    // ============================
    // Botón de búsqueda
    // ============================
    const searchBtn = document.getElementById("search-btn");
    if (searchBtn) {
      searchBtn.addEventListener("click", function () {
        let query = document.getElementById("search").value;
        alert("Buscando: " + query);
      });
    } else {
      console.error("El elemento con ID 'search-btn' no se encontró en el DOM.");
    }
  
    // ============================
    // Modal de inicio de sesión
    // ============================
    const loginBtn = document.getElementById("login-btn");
    if (loginBtn) {
      loginBtn.addEventListener("click", function () {
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
  
    const closeLogin = document.getElementById("close-login");
    if (closeLogin) {
      closeLogin.addEventListener("click", function () {
        const loginModal = document.getElementById("login-modal");
        if (loginModal) {
          loginModal.style.display = "none";
        }
      });
    } else {
      console.error("El elemento con ID 'close-login' no se encontró en el DOM.");
    }
  
    const confirmLogin = document.getElementById("confirm-login");
    if (confirmLogin) {
      confirmLogin.addEventListener("click", function () {
        alert("Iniciando sesión...");
        const loginModal = document.getElementById("login-modal");
        if (loginModal) {
          loginModal.style.display = "none";
        }
      });
    } else {
      console.error("El elemento con ID 'confirm-login' no se encontró en el DOM.");
    }
  
    // ============================
    // Menú de filtros
    // ============================
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
  
    // ============================
    // Animación del logo y botón Reparar
    // ============================
    const logo = document.getElementById("logo");
    const repairButton = document.getElementById("repairButton");
  
    if (logo && repairButton) {
      logo.addEventListener("click", () => {
        logo.classList.remove("fall"); // Reinicia la animación si se vuelve a hacer clic
        void logo.offsetWidth; // Forzar reflow para reiniciar la animación
        logo.classList.add("fall");
      });
  
      logo.addEventListener("animationend", () => {
        repairButton.style.display = "inline-block";
      });
  
      repairButton.addEventListener("click", () => {
        logo.classList.remove("fall");
        repairButton.style.display = "none";
      });
    } else {
      console.error("El logo o el botón de reparación no se encontraron en el DOM.");
    }
  
    // ============================
    // Menú lateral (Sidebar)
    // ============================
    const sidebar = document.getElementById("sidebar");
    const menuToggle = document.getElementById("menu-toggle");
    const closeSidebar = document.getElementById("close-sidebar");
  
    if (sidebar && menuToggle && closeSidebar) {
      // Abrir menú
      menuToggle.addEventListener("click", function (e) {
        e.stopPropagation();
        sidebar.classList.add("active");
      });
  
      // Cerrar menú con el botón
      closeSidebar.addEventListener("click", function () {
        sidebar.classList.remove("active");
      });
  
      // Cerrar menú al hacer clic fuera
      document.addEventListener("click", function () {
        sidebar.classList.remove("active");
      });
  
      // Evitar que el clic dentro del sidebar lo cierre
      sidebar.addEventListener("click", function (e) {
        e.stopPropagation();
      });
    } else {
      console.error("Uno o más elementos del menú lateral no se encontraron en el DOM.");
    }
  
    // ============================
    // Formulario de modificación
    // ============================
    const guardarCambiosBtn = document.getElementById("guardar-cambios");
    if (guardarCambiosBtn) {
      guardarCambiosBtn.addEventListener("click", function () {
        const telefono = document.getElementById("telefono").value;
        if (!telefono || telefono.length < 10) {
          alert("Por favor ingresa un número de teléfono válido");
          return;
        }
        // Simular guardado (en un caso real, aquí se haría una petición AJAX)
        alert("Cambios guardados exitosamente");
        window.location.href = "index.html";
      });
    } else {
      console.error("El elemento con ID 'guardar-cambios' no se encontró en el DOM.");
    }
  });
  