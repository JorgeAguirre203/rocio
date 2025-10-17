<?php
include 'conexion_jorge.php';

$id_cotizacion = $_POST['id_cotizacion'] ?? null;
$total = $_POST['total'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$detalle = $_POST['detalle'] ?? '';

if (!$id_cotizacion || !$nombre || $total <= 0) {
    die("Datos incompletos. Por favor, regresa e intenta de nuevo.");
}

// Generar idOrden único para efectivo
$idOrden = 'EFECTIVO_' . time() . rand(100, 999);

// Iniciar transacción
$conexion->begin_transaction();

try {
    // Registrar el pago
    $stmt_pago = $conexion->prepare("INSERT INTO pagos (id_cotizacion, id_orden, metodo_pago, monto, estado, detalle_pago, fecha) VALUES (?, ?, 'efectivo', ?, 'completado', ?, NOW())");
    $stmt_pago->bind_param("isds", $id_cotizacion, $idOrden, $total, $detalle);
    $stmt_pago->execute();
    
    // Actualizar estado de la cotización
    $stmt = $conexion->prepare("UPDATE cotizaciones SET estado = 'completado' WHERE id = ?");
    $stmt->bind_param("i", $input['id_cotizacion']);
    $stmt->execute();

    // Obtener id_usuario e id_afiliado de la cotización
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM cotizaciones WHERE id = ?");
    $stmt->bind_param("i", $id_cotizacion);
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
    
    $conexion->commit();
    echo "Pago en efectivo registrado. Por favor, completa el pago con el prestador.";
    header("Location: calificar_afiliado.php?id_cotizacion=$id_cotizacion");
    exit;
} catch (Exception $e) {
    $conexion->rollback();
    echo "Error al registrar el pago: " . $e->getMessage();
}

$stmt_pago->close();
$stmt_cotizacion->close();
$conexion->close();
?>