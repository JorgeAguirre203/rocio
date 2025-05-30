<?php
include 'conexion_jorge.php';

// Obtener datos del formulario
$servicio = $_POST['servicio'] ?? '';
$horas = floatval($_POST['horas'] ?? 0);
$detalles = $_POST['detalles'] ?? '';
$precio_hora = floatval($_POST['precio_hora'] ?? 0);

// Obtener IDs de usuario y afiliado desde la sesión
session_start();
$id_usuario = $_SESSION['usuario']['id'] ?? null;
$id_afiliado = $_SESSION['afiliado']['id'] ?? null;

if (!$servicio || $horas <= 0 || $precio_hora <= 0 || !$id_usuario || !$id_afiliado) {
    die("Datos inválidos o sesión no iniciada. Por favor, regresa e intenta de nuevo.");
}

$total = $horas * $precio_hora;

// Guardar cotización
$stmt = $conexion->prepare("INSERT INTO cotizaciones (id_usuario, id_afiliado, servicio, horas, detalles, precio_hora, total) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iisdsdd", $id_usuario, $id_afiliado, $servicio, $horas, $detalles, $precio_hora, $total);

if ($stmt->execute()) {
    $id_cotizacion = $conexion->insert_id;
    
    // Actualizar la petición relacionada si existe
    if (isset($_SESSION['id_peticion'])) {
        $stmt_update = $conexion->prepare("UPDATE peticiones SET id_cotizacion = ? WHERE id = ?");
        $stmt_update->bind_param("ii", $id_cotizacion, $_SESSION['id_peticion']);
        $stmt_update->execute();
        $stmt_update->close();
    }
    
    header("Location: pago.php?id_cotizacion=$id_cotizacion");
} else {
    echo "Error al guardar la cotización. Intenta nuevamente.";
}

$stmt->close();
$conexion->close();
?>