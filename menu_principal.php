<?php
session_start();
require 'conexion_jorge.php';

if (!isset($_SESSION['usuario_id'])) {
    header("Location: login_jorge.php");
    exit;
}

// Datos del usuario
$usuario = $conexion->query("
    SELECT nombre, foto_perfil 
    FROM usuarios 
    WHERE id = " . intval($_SESSION['usuario_id'])
)->fetch_assoc();

// Primeros 10 servicios
$servicios = $conexion->query("
    SELECT s.*, u.nombre 
    FROM servicios s
    JOIN usuarios u ON s.usuario_id = u.id
    ORDER BY s.fecha_publicacion DESC
    LIMIT 10
");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Muro de Servicios</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <aside class="sidebar">
        <img src="<?= htmlspecialchars($usuario['foto_perfil']) ?>" 
             alt="Foto perfil" class="profile-img">
        <h2><?= htmlspecialchars($usuario['nombre']) ?></h2>
        <nav>
            <a href="modifcar_perfil.html" class="nav-link">✏️ Modificar perfil</a>
            <a href="logout.php" class="nav-link">🚪 Cerrar sesión</a>
        </nav>
    </aside>

    <main class="muro" id="muro">
        <?php while ($serv = $servicios->fetch_assoc()): ?>
            <article class="servicio">
                <h3><?= htmlspecialchars($serv['titulo']) ?></h3>
                <p><?= htmlspecialchars($serv['descripcion']) ?></p>
                <small>Publicado por: <?= htmlspecialchars($serv['nombre']) ?></small>
            </article>
        <?php endwhile; ?>
    </main>

    <script src="muro.js"></script>
</body>
</html>

