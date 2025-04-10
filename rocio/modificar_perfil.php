<?php
session_start();
require_once 'conexion_jorge.php';

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Habilitar errores (solo para desarrollo)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Variables iniciales
$error = '';
$success = '';
$usuario = [];

// Obtener ID del usuario desde la sesión
$id = $_SESSION['usuario']['id'];

// Cargar datos del usuario actual
$sql = "SELECT * FROM usuarios2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

// Procesar actualización (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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
            $sql = "UPDATE usuarios2 SET 
                    nombre=?, apellido_paterno=?, apellido_materno=?, 
                    email=?, telefono=?, password=? 
                    WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssssi", $nombre, $apellidoPaterno, $apellidoMaterno, 
                             $email, $telefono, $hashedPassword, $id);
        } else {
            $sql = "UPDATE usuarios2 SET 
                    nombre=?, apellido_paterno=?, apellido_materno=?, 
                    email=?, telefono=? 
                    WHERE id=?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssssi", $nombre, $apellidoPaterno, $apellidoMaterno, 
                             $email, $telefono, $id);
        }

        if ($stmt->execute()) {
            $success = "Perfil actualizado correctamente";
            // Actualizar datos en sesión
            $_SESSION['usuario']['nombre'] = $nombre;
            // Recargar datos actualizados
            $sql = "SELECT * FROM usuarios2 WHERE id = ?";
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
?>