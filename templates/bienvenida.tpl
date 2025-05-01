<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>{$page_title}</title>
  <link rel="stylesheet" href="style_bienvenida.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

  <div class="header">
    <button class="menu-button" onclick="toggleSidebar()">☰</button>
    <h1>Bienvenido a {$logo_text}</h1>
  </div>

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

  <div class="main-content">
    <h2>¡Hola {$nombre}!</h2>
    <p>¡Bienvenido a la seleccion de servicios!</p>
  </div>

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
  </script>
</body>
</html>
