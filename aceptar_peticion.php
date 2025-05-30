<?php
require_once 'conexion_jorge.php';
session_start();

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_id'])) {
    $peticion_id = intval($_POST['peticion_id']);
    $stmt = $conexion->prepare("UPDATE peticiones SET estado = 'aceptada' WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->close();
}

header("Location: afiliados.php");
exit;