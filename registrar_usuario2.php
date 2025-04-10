<?php
// Mostrar errores (solo durante desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "1234";
$base_datos = "servinow_jorge";

// Establecer la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verifica si el formulario fue enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpiar y escapar entradas
    $nombre = trim(mysqli_real_escape_string($conn, $_POST['nombre'] ?? ''));
    $telefono = trim(mysqli_real_escape_string($conn, $_POST['telefono'] ?? ''));
    $email = trim(mysqli_real_escape_string($conn, $_POST['email'] ?? ''));
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';

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

    // Encriptar la contraseña
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insertar nuevo usuario en usuarios2
    $sql_insert = "INSERT INTO usuarios2 (nombre, telefono, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssss", $nombre, $telefono, $email, $hashedPassword);

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

