<?php
// Habilitar errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "servinow_jorge";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Variables iniciales
$error = '';
$success = '';
$usuario = [];

// 1. Cargar datos del usuario al abrir el formulario (GET)
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();
    $stmt->close();
}

// 2. Procesar actualización (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellido_paterno'];
    $apellidoMaterno = $_POST['apellido_materno'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    // Validaciones
    if (empty($nombre) || empty($apellidoPaterno) || empty($email) || empty($telefono)) {
        $error = "Todos los campos obligatorios deben llenarse";
    } elseif (!empty($password) && $password !== $confirmPassword) {
        $error = "Las contraseñas no coinciden";
    } else {
        // Actualizar con/sin contraseña
        if (!empty($password)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $sql = "UPDATE usuarios SET 
                    nombre=?, apellido_paterno=?, apellido_materno=?, 
                    email=?, telefono=?, password=? 
                    WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nombre, $apellidoPaterno, $apellidoMaterno, 
                             $email, $telefono, $hashedPassword, $id);
        } else {
            $sql = "UPDATE usuarios SET 
                    nombre=?, apellido_paterno=?, apellido_materno=?, 
                    email=?, telefono=? 
                    WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $nombre, $apellidoPaterno, $apellidoMaterno, 
                             $email, $telefono, $id);
        }

        if ($stmt->execute()) {
            $success = "Usuario actualizado correctamente";
            // Recargar datos actualizados
            $sql = "SELECT * FROM usuarios WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
        } else {
            $error = "Error al actualizar: " . $stmt->error;
        }
        $stmt->close();
    }
}

// Incluir la vista HTML
require 'editar_usuario_view.php';

$conn->close();
?>