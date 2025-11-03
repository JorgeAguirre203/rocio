<?php
session_start();
require_once 'conexion_jorge.php';

$usuario_actual_id = intval($_GET['usuario_actual_id'] ?? 0);
$otro_usuario_id = intval($_GET['otro_usuario_id'] ?? 0);
$usuario_actual_es_afiliado = intval($_GET['usuario_actual_es_afiliado'] ?? 0);

$sql = "SELECT mensaje, remitente_id, fecha_envio 
        FROM mensajes 
        WHERE (remitente_id = ? AND receptor_id = ?) 
           OR (remitente_id = ? AND receptor_id = ?)
        ORDER BY fecha_envio ASC";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("iiii", $usuario_actual_id, $otro_usuario_id, $otro_usuario_id, $usuario_actual_id);
$stmt->execute();
$resultado = $stmt->get_result();

while ($fila = $resultado->fetch_assoc()) {
    $clase_mensaje = ($fila['remitente_id'] == $usuario_actual_id) ? 'mensaje-mio' : 'mensaje-otro';
    $hora = date('h:i A', strtotime($fila['fecha_envio']));

    echo "<div class='{$clase_mensaje}'>";
    echo htmlspecialchars($fila['mensaje']);
    echo "<span class='hora'>{$hora}</span>";
    echo "</div>";
}
?>