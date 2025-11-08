<?php
require_once 'conexion_jorge.php';
session_start();

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_id'])) {
    $peticion_id = intval($_POST['peticion_id']);

    // 1. Cambiar el estado de la petición a 'aceptada'
    $stmt = $conexion->prepare("UPDATE peticiones SET estado = 'aceptada' WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->close();

    // 2. Obtener el id_usuario de la petición
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM peticiones WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->bind_result($id_usuario_cliente, $id_afiliado);
    $stmt->fetch();
    $stmt->close();

    // 3. Obtener el nombre del afiliado
    $stmt = $conexion->prepare("SELECT nombre, apellido_paterno FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_afiliado);
    $stmt->execute();
    $stmt->bind_result($nombre_afiliado, $apellido_afiliado);
    $stmt->fetch();
    $stmt->close();

    $nombre_completo_afiliado = $nombre_afiliado . ' ' . $apellido_afiliado;

    // 4. Actualizar la notificación existente para este cliente y afiliado
    $mensaje_actualizado = "El afiliado ($nombre_completo_afiliado) aceptó el trabajo.";
    $stmt = $conexion->prepare("UPDATE notificaciones SET mensaje = ? WHERE id_usuario = ? AND id_peticion = ?");
    $stmt->bind_param("sii", $mensaje_actualizado, $id_usuario_cliente, $peticion_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: afiliados.php");
exit;