<?php


include 'conexion_jorge.php';


header('Content-Type: application/json');





$data = json_decode(file_get_contents('php://input'), true);





$idOrden = $data['idOrden'] ?? null;


$metodo = $data['metodo'] ?? null;


$monto = $data['monto'] ?? null;





if (!$idOrden || !$metodo || !$monto) {


    echo json_encode(['success' => false, 'message' => 'Datos incompletos']);


    exit;


}





$stmt = $conexion->prepare("INSERT INTO pagos (id_orden, metodo_pago, monto, estado, fecha) VALUES (?, ?, ?, 'completado', NOW())");


$stmt->bind_param("ssd", $idOrden, $metodo, $monto);





if ($stmt->execute()) {


    echo json_encode(['success' => true]);


} else {


    echo json_encode(['success' => false, 'message' => 'Error al guardar pago']);


}


$stmt->close();


$conexion->close();


?>