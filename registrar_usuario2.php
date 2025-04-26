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
    
    // Validar campos obligatorios
    if (empty($nombre) || empty($telefono) || empty($email) || empty($password) || empty($confirmPassword)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    // Comprobar si las contraseñas coinciden
    if ($password !== $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Verificar si el correo ya está registrado en usuarios2
    $sql_check_email = "SELECT * FROM usuarios2 WHERE email = ?";
    $stmt = $conn->prepare($sql_check_email);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit();
    }

    // Verificar si el nickname ya está registrado en usuarios2
    $sql_check_nickname = "SELECT * FROM usuarios2 WHERE nickname = ?";
    $stmt = $conn->prepare($sql_check_nickname);
    $stmt->bind_param("s", $nickname);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "El nickname ya está registrado.";
        exit();
    }

    // Verificar si el telefono ya está registrado en usuarios2
    $sql_check_telefono = "SELECT * FROM usuarios2 WHERE telefono = ?";
    $stmt = $conn->prepare($sql_check_telefono);
    $stmt->bind_param("s", $telefono);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        echo "El teléfono ya está registrado.";
        exit();
    }

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario en usuarios2
    $sql_insert = "INSERT INTO usuarios2 (nombre, telefono, email, password, nickname) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("sssss", $nombre, $telefono, $email, $hashedPassword, $nickname);

    if ($stmt->execute()) {
        // Redireccionar al login si el registro fue exitoso
        header("Location: login.html?registro=exitoso");
        exit();
    } else {
        echo "Error al registrar el usuario: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>

