
<?php


include 'conexion_jorge.php';


header('Content-Type: application/json');





$result = $conexion->query("SELECT total FROM cotizaciones ORDER BY id DESC LIMIT 1");





if ($result && $row = $result->fetch_assoc()) {


    echo json_encode(['success' => true, 'total' => $row['total']]);


} else {


    echo json_encode(['success' => false, 'message' => 'No se encontró cotización']);


}


?>