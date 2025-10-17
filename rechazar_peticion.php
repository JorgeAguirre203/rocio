<?php
session_start();
require_once 'conexion_jorge.php';

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_id'])) {
    $peticion_id = intval($_POST['peticion_id']);

    // Cambiar estado a 'rechazado'
        $stmt = $conexion->prepare("UPDATE peticiones SET estado = 'rechazada' WHERE id = ?");
        $stmt->bind_param("i", $peticion_id);
        $stmt->execute();
        $stmt->close();

    // Obtener el id_usuario para la notificación
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM peticiones WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->bind_result($id_usuario_cliente, $id_afiliado);
    $stmt->fetch();
    $stmt->close();

    // Obtener nombre del afiliado
    $stmt = $conexion->prepare("SELECT nombre, apellido_paterno FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_afiliado);
    $stmt->execute();
    $stmt->bind_result($nombre_afiliado, $apellido_afiliado);
    $stmt->fetch();
    $stmt->close();

    $nombre_completo_afiliado = $nombre_afiliado . ' ' . $apellido_afiliado;

    // Insertar notificación
    $mensaje_actualizado = "El afiliado ($nombre_completo_afiliado) ha rechazado tu peticion.";
    $stmt = $conexion->prepare("UPDATE notificaciones SET mensaje = ? WHERE id_usuario = ? AND mensaje LIKE ?");
    $like = "%Has contratado a este afiliado ($nombre_completo_afiliado)%";
    $stmt->bind_param("sis", $mensaje_actualizado, $id_usuario_cliente, $like);
    $stmt->execute();
    $stmt->close();
}

header("Location: afiliados.php");
exit;
?>