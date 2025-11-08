<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'conexion_jorge.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['usuario']['id'];
$id_afiliado = isset($_POST['id_afiliado']) ? intval($_POST['id_afiliado']) : 0;

if ($id_afiliado > 0) {
    // Evitar duplicados: solo una petición pendiente por usuario-afiliado
    $stmt = $conexion->prepare("SELECT id FROM peticiones WHERE id_usuario=? AND id_afiliado=? AND estado='pendiente'");
    $stmt->bind_param("ii", $id_usuario, $id_afiliado);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $stmt->close();
        $stmt = $conexion->prepare("INSERT INTO peticiones (id_usuario, id_afiliado, estado) VALUES (?, ?, 'pendiente')");
        $stmt->bind_param("ii", $id_usuario, $id_afiliado);
        $stmt->execute();
        $peticion_id = $stmt->insert_id; // <-- OBTENER EL ID DE LA PETICIÓN
        $stmt->close();

        // Obtener el nombre del afiliado
        $stmt = $conexion->prepare("SELECT nombre, apellido_paterno FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $id_afiliado);
        $stmt->execute();
        $stmt->bind_result($nombre_afiliado, $apellido_afiliado);
        if ($stmt->fetch()) {
            $nombre_completo_afiliado = trim($nombre_afiliado . ' ' . $apellido_afiliado);
        } else {
            $nombre_completo_afiliado = "Desconocido";
        }
        $stmt->close();
        // Insertar notificación para el cliente
        $mensaje = "Has contratado a este afiliado ($nombre_completo_afiliado), esperando a que el afiliado le cotice.";
        $stmt = $conexion->prepare("INSERT INTO notificaciones (id_usuario, mensaje, leida, id_peticion) VALUES (?, ?, 0, ?)");
        $stmt->bind_param("isi", $id_usuario, $mensaje, $peticion_id); // <-- AÑADIR EL ID DE LA PETICIÓN
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            error_log("Notificación insertada correctamente para usuario $id_usuario");
        } else {
            error_log("No se insertó la notificación para usuario $id_usuario. Error: " . $stmt->error);
        }
        $stmt->close();
    }
}

header("Location: dashboard_servicios.php?msg=Petición enviada");
exit;