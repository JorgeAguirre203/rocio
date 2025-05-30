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
    $stmt_pago = $conexion->prepare("INSERT INTO pagos (id_cotizacion, id_orden, metodo_pago, monto, estado, detalle_pago, fecha) VALUES (?, ?, 'efectivo', ?, 'pendiente', ?, NOW())");
    $stmt_pago->bind_param("isds", $id_cotizacion, $idOrden, $total, $detalle);
    $stmt_pago->execute();
    
    // Actualizar estado de la cotización
    $stmt_cotizacion = $conexion->prepare("UPDATE cotizaciones SET estado = 'aceptada' WHERE id = ?");
    $stmt_cotizacion->bind_param("i", $id_cotizacion);
    $stmt_cotizacion->execute();
    
    $conexion->commit();
    echo "Pago en efectivo registrado. Por favor, completa el pago con el prestador.";
    header("Refresh: 3; url=dashboard_servicios.php");
} catch (Exception $e) {
    $conexion->rollback();
    echo "Error al registrar el pago: " . $e->getMessage();
}

$stmt_pago->close();
$stmt_cotizacion->close();
$conexion->close();
?>