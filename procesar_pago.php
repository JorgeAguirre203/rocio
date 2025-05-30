<?php
include 'conexion_jorge.php';
header('Content-Type: application/json');

// Leer los datos JSON del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

// Validar datos básicos
if (empty($input['id_cotizacion']) || empty($input['idOrden']) || empty($input['monto'])) {
    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);
    exit;
}

// Iniciar transacción
$conexion->begin_transaction();

try {
    // 1. Registrar el pago
    $stmt = $conexion->prepare("INSERT INTO pagos 
                              (id_cotizacion, id_orden, metodo_pago, monto, estado, detalle_pago, fecha) 
                              VALUES (?, ?, ?, ?, 'completado', ?, NOW())");
    $detalle = json_encode($input['detalles'] ?? []);
    $stmt->bind_param("issds", $input['id_cotizacion'], $input['idOrden'], 
                     $input['metodo'], $input['monto'], $detalle);
    $stmt->execute();
    $id_pago = $conexion->insert_id;
    
    // 2. Actualizar estado de la cotización
    $stmt = $conexion->prepare("UPDATE cotizaciones SET estado = 'completada' WHERE id = ?");
    $stmt->bind_param("i", $input['id_cotizacion']);
    $stmt->execute();
    
    // 3. Confirmar transacción
    $conexion->commit();
    
    echo json_encode([
        'success' => true,
        'id_pago' => $id_pago,
        'message' => 'Pago registrado correctamente'
    ]);
    
} catch (Exception $e) {
    $conexion->rollback();
    echo json_encode([
        'success' => false,
        'message' => 'Error al procesar el pago: ' . $e->getMessage()
    ]);
}
?>