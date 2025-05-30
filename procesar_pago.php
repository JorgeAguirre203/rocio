<?php
include 'conexion_jorge.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents('php://input'), true);

$id_cotizacion = $data['id_cotizacion'] ?? null;
$idOrden = $data['idOrden'] ?? null;
$metodo = $data['metodo'] ?? null;
$monto = $data['monto'] ?? null;

if (!$id_cotizacion || !$idOrden || !$metodo || !$monto) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Registrar el pago
    $stmt_pago = $conexion->prepare("INSERT INTO pagos (id_cotizacion, id_orden, metodo_pago, monto, estado, fecha) VALUES (?, ?, ?, ?, 'completado', NOW())");
    $stmt_pago->bind_param("issd", $id_cotizacion, $idOrden, $metodo, $monto);
    $stmt_pago->execute();
    
    // Actualizar estado de la cotización
    $stmt_cotizacion = $conexion->prepare("UPDATE cotizaciones SET estado = 'completada' WHERE id = ?");
    $stmt_cotizacion->bind_param("i", $id_cotizacion);
    $stmt_cotizacion->execute();
    
    $conexion->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode(['success' => false, 'message' => 'Error al procesar el pago: ' . $e->getMessage()]);
}

$stmt_pago->close();
$stmt_cotizacion->close();
$conexion->close();
?>