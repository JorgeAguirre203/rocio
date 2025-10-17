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
    $comentario = isset($input['comentario']) ? trim($input['comentario']) : '';
    $detalle = json_encode([
        'paypal' => $input['detalles'] ?? [],
        'comentario' => $comentario
    ]);

    $stmt = $conexion->prepare("INSERT INTO pagos 
                            (id_cotizacion, id_orden, metodo_pago, monto, estado, detalle_pago, fecha) 
                            VALUES (?, ?, ?, ?, 'completado', ?, NOW())");
    $stmt->bind_param("issds", $input['id_cotizacion'], $input['idOrden'], 
                    $input['metodo'], $input['monto'], $detalle);
    $stmt->execute();
    $id_pago = $conexion->insert_id;
    
    // Obtener id_usuario e id_afiliado de la cotización
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM cotizaciones WHERE id = ?");
    $stmt->bind_param("i", $input['id_cotizacion']);
    $stmt->execute();
    $stmt->bind_result($id_usuario, $id_afiliado);
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

    // Actualizar la notificación
    $mensaje_pagado = "Has pagado el servicio del afiliado ($nombre_completo_afiliado).";
    $stmt = $conexion->prepare("UPDATE notificaciones SET mensaje = ? WHERE id_usuario = ? AND mensaje LIKE ?");
    $like = "%cotizó tu servicio%";
    $stmt->bind_param("sis", $mensaje_pagado, $id_usuario, $like);
    $stmt->execute();
    $stmt->close();
    
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