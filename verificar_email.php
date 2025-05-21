<?php
header('Content-Type: application/json');

require_once 'libs/Smarty.class.php';
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "servinow_jorge";

// Obtener email del parámetro GET
$email = $_GET['email'] ?? '';

// Validar email
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['existe' => false]);
    exit;
}

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(['error' => 'Error de conexión']);
    exit;
}

// Consultar si el email existe
$sql = "SELECT email FROM usuarios2 WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

echo json_encode(['existe' => $result->num_rows > 0]);

$conn->close();
?>
