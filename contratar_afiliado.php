<?php

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
    } else {
        // Ya existe una petición pendiente
        $stmt->close();
    }
}

header("Location: dashboard_servicios.php?msg=Petición enviada");
exit;