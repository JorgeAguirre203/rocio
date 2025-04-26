<?php
// Habilitar la visualización de errores
ini_set('display_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";  // Asegúrate de que este usuario tenga acceso
$password = "1234";  // Asegúrate de que esta contraseña sea la correcta
$dbname = "servinow_jorge";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validar que el formulario se haya enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST['nombre'];
    $nickname = $_POST['nickname'];  // Asegurarnos de que se obtiene el 'nickname'
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];
    
    // Validar que los campos requeridos no estén vacíos
    if (empty($nombre) || empty($nickname) || empty($telefono) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Todos los campos son obligatorios.";
        exit;
    }

    // Validar que las contraseñas coincidan
    if ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden";
        exit;
    }

    // Hashear la contraseña antes de guardarla
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta para insertar los datos (incluyendo el 'nickname')
    $sql = "INSERT INTO usuarios2 (nombre, nickname, telefono, email, password) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparando la consulta: " . $conn->error;
        exit;
    }

    // Vincular los parámetros a la consulta
    $stmt->bind_param("sssss", $nombre, $nickname, $telefono, $email, $hashedPassword);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Registro exitoso";
    } else {
        echo "Error en el registro: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>

