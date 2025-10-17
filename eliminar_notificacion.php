<?php
// filepath: /var/www/html/rocio/eliminar_notificacion.php
session_start();
require_once 'conexion_jorge.php';

if (isset($_POST['id_notificacion']) && isset($_SESSION['usuario']['id'])) {
    $id = intval($_POST['id_notificacion']);
    $id_usuario = $_SESSION['usuario']['id'];
    $stmt = $conexion->prepare("DELETE FROM notificaciones WHERE id = ? AND id_usuario = ?");
    $stmt->bind_param("ii", $id, $id_usuario);
    $stmt->execute();
    $stmt->close();
}
header("Location: dashboard_servicios.php");
exit;