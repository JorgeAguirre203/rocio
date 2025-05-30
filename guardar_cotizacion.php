
<?php


include 'conexion_jorge.php';





$servicio = $_POST['servicio'] ?? '';


$horas = floatval($_POST['horas'] ?? 0);


$detalles = $_POST['detalles'] ?? '';


$precio_hora = floatval($_POST['precio_hora'] ?? 0);





if (!$servicio || $horas <= 0 || $precio_hora <= 0) {


    die("Datos inválidos. Por favor, regresa e intenta de nuevo.");


}





$total = $horas * $precio_hora;





$stmt = $conexion->prepare("INSERT INTO cotizaciones (servicio, horas, detalles, precio_hora, total, fecha) VALUES (?, ?, ?, ?, ?, NOW())");


$stmt->bind_param("sisd", $servicio, $horas, $detalles, $precio_hora, $total);





if ($stmt->execute()) {


    // Puedes redirigir a la página de pago con id o mostrar mensaje


    header("Location: pago.html");


} else {


    echo "Error al guardar la cotización. Intenta nuevamente.";


}





$stmt->close();


$conexion->close();


?>