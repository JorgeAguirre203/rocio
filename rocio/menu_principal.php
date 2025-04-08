<?php
require 'conexion_jorge.php';
session_start();


if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit;
}

// Datos del usuario
$usuario = $conn->query("
    SELECT nombre, foto_perfil 
    FROM usuarios 
    WHERE id = " . intval($_SESSION['usuario_id'])
)->fetch();

// Primeros 10 servicios
$servicios = $conn->query("
    SELECT s.*, u.nombre 
    FROM servicios s
    JOIN usuarios u ON s.usuario_id = u.id
    ORDER BY s.fecha_publicacion DESC
    LIMIT 10
")->fetchAll();
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
        <?php foreach ($servicios as $serv): ?>
            <article class="servicio">
                <h3><?= htmlspecialchars($serv['titulo']) ?></h3>
                <p><?= htmlspecialchars($serv['descripcion']) ?></p>
                <small>Publicado por: <?= htmlspecialchars($serv['nombre']) ?></small>
            </article>
        <?php endforeach; ?>
    </main>

    <script src="muro.js"></script>
</body>
</html>