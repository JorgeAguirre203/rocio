<?php
session_start();
require_once 'conexion_jorge.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acceso no permitido");
}

$usuario_actual_id = intval($_POST['usuario_actual_id'] ?? 0);
$otro_usuario_id = intval($_POST['otro_usuario_id'] ?? 0);
$usuario_actual_es_afiliado = intval($_POST['usuario_actual_es_afiliado'] ?? 0);

// Determinar si el remitente es afiliado o no
$remitente_es_afiliado = 1 - $usuario_actual_es_afiliado;

if ($usuario_actual_id > 0 && $otro_usuario_id > 0) {
    $sql = "UPDATE mensajes SET leido = 1 WHERE receptor_id = ? AND remitente_id = ? AND remitente_es_afiliado = ? AND leido = 0";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("iii", $usuario_actual_id, $otro_usuario_id, $remitente_es_afiliado);
    $stmt->execute();
    echo "ok";
}
?>
