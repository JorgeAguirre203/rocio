<?php
session_start();
require_once 'conexion_jorge.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos completos del usuario
$stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
$stmt->bind_param("i", $_SESSION['usuario']['id']);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .profile-container {
            max-width: 800px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .profile-info {
            margin-bottom: 20px;
        }
        .info-label {
            font-weight: bold;
            display: inline-block;
            width: 150px;
        }
        .btn-edit {
            display: inline-block;
            background: #4CAF50;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 4px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <div class="profile-header">
            <h1>Mi Perfil</h1>
        </div>
        
        <div class="profile-info">
            <p><span class="info-label">Nombre:</span> <?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?></p>
            <p><span class="info-label">Apellido Paterno:</span> <?php echo htmlspecialchars($usuario['apellido_paterno'] ?? ''); ?></p>
            <p><span class="info-label">Apellido Materno:</span> <?php echo htmlspecialchars($usuario['apellido_materno'] ?? ''); ?></p>
            <p><span class="info-label">Email:</span> <?php echo htmlspecialchars($usuario['email'] ?? ''); ?></p>
            <p><span class="info-label">Teléfono:</span> <?php echo htmlspecialchars($usuario['telefono'] ?? ''); ?></p>
            
            <a href="modificar_perfil.php" class="btn-edit">Editar Perfil</a>
        </div>
    </div>
</body>
</html>