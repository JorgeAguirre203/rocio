<?php


include 'conexion_jorge.php';





$nombre = $_POST['nombre'] ?? '';


$detalle = $_POST['detalle'] ?? '';


$total = $_POST['total'] ?? 0;





if (!$nombre || $total <= 0) {


    die("Datos incompletos. Por favor, regresa e intenta de nuevo.");


}





// Generar un idOrden único para efectivo


$idOrden = 'EFECTIVO_'.time().rand(100,999);





$stmt = $conexion->prepare("INSERT INTO pagos (id_orden, metodo_pago, monto, estado, detalle_pago, fecha) VALUES (?, 'efectivo', ?, 'pendiente', ?, NOW())");


$stmt->bind_param("sds", $idOrden, $total, $detalle);





if ($stmt->execute()) {


    echo "Pago en efectivo registrado. Por favor, completa el pago con el prestador.";


} else {


    echo "Error al registrar el pago. Intenta nuevamente.";


}


$stmt->close();


$conexion->close();


?>