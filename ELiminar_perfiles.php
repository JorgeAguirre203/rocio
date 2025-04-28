<?php
session_start();
require_once 'conexion_jorge.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$id_usuario = $_SESSION['usuario']['id']; // ahora sí el id es correcto

// Ahora sí, eliminamos de la tabla correcta: usuarios2
$sql = "DELETE FROM usuarios2 WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id_usuario);

if ($stmt->execute()) {
    session_destroy();
    header("Location: login.html?mensaje=Cuenta eliminada exitosamente");
    exit;
} else {
    echo "Error al eliminar la cuenta: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

