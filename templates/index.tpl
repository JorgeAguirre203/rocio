<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>{$page_title}</title>
  <link rel="stylesheet" href="index.css" />
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&family=Open+Sans&display=swap" rel="stylesheet">
</head>
<body>

<!-- Barra de navegación -->
<nav class="navbar">
  <div class="nav-container">
    <div id="logo" class="logo">{$page_title}</div>
    <button id="repairButton">Reparar</button>
    <div class="nav-links">
      <a href="#afiliate" class="nav-btn" onclick="window.location.href='registrar_jorge.php'">Afíliate aquí</a>
      <a href="#login" class="nav-btn" onclick="window.location.href='login.php'">Iniciar sesión</a>
    </div>
  </div>
</nav>

<!-- Hero principal -->
<section class="hero-principal">
  <div class="contenido-hero">
    <div class="texto-hero">
      <h2>{$hero_title}</h2>
      <p>{$hero_text}</p>
      <a href="dashboard_servicios.php" class="btn-negro">Ver Servicios</a>
    </div>
    <div class="imagen-hero">
      <img src="palacio.jpg" alt="Servicios en acción">
    </div>
  </div>
</section>

<!-- Sobre Nosotros -->
<section class="sobre-nosotros">
  <div class="contenido-nosotros">
    <h2>{$about_title}</h2>
    <p>{$about_text}</p>
  </div>
</section>

<!-- Pie de página -->
<footer class="footer">
  <p>&copy; {$current_year} {$page_title}. Todos los derechos reservados.</p>
</footer>

<script src="script.js"></script>
</body>
</html>
