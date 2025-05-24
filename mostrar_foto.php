<?php
require_once('conexion_jorge.php');

// Obtener el ID del usuario
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id > 0) {
    // Consulta para obtener la foto
    $query = "SELECT foto_perfil FROM usuarios WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($foto);
        $stmt->fetch();
        
        // Establecer las cabeceras adecuadas
        header("Content-Type: image/jpeg"); // Ajusta según el tipo de imagen que guardes
        echo $foto;
        exit;
    }
}

// Si no se encuentra la imagen, mostrar una por defecto
$defaultImage = file_get_contents('img/default_profile.jpg');
header("Content-Type: image/jpeg");
echo $defaultImage;
