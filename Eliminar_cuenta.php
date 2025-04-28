<?php
session_start();
include 'conexion.php'; // Asegúrate de que tienes este archivo para conectarte a MySQL

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$id_usuario = $_SESSION['usuario']['id']; // asegúrate de que cuando se guarda el usuario en sesión tengas el 'id'

// Primero eliminamos el usuario
$sql = "DELETE FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
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

