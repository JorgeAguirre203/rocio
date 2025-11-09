<?php
session_start();
require_once 'conexion_jorge.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acceso no permitido");
}

$remitente_id = intval($_POST['remitente_id'] ?? 0);
$receptor_id = intval($_POST['receptor_id'] ?? 0);
$mensaje = trim($_POST['mensaje'] ?? '');
$remitente_es_afiliado = intval($_POST['remitente_es_afiliado'] ?? 0);

if ($remitente_id > 0 && $receptor_id > 0 && !empty($mensaje)) {
    $sql = "INSERT INTO mensajes (remitente_id, receptor_id, mensaje, remitente_es_afiliado) VALUES (?, ?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iisi", $remitente_id, $receptor_id, $mensaje, $remitente_es_afiliado);
    $stmt->execute();



    echo "ok";
}
?>
