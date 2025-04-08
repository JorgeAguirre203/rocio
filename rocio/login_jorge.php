<?php
session_start();
require_once 'conexion_jorge.php'; // Asegúrate de que esta ruta sea correcta

ini_set('display_errors', 1); // Muestra los errores de PHP
error_reporting(E_ALL);

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtén los datos del formulario
    $nombre = $_POST['nombre'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($nombre) || empty($password)) {
        // Si no se proporcionan los datos, muestra un error
        echo 'Por favor, ingresa nombre de usuario y contraseña.';
        exit;
    }

    // Consulta para verificar el nombre de usuario y la contraseña
    $stmt = $conexion->prepare("SELECT id, nombre, password FROM usuarios2 WHERE nombre = ?");
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica si la contraseña es correcta
        if (password_verify($password, $usuario['password'])) {
            // Si la contraseña es correcta, inicia la sesión
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre']
            ];
            // Redirige al usuario a la página de inicio
            header("Location: index.html");
            exit;
        } else {
            // Si la contraseña es incorrecta
            echo 'Contraseña incorrecta.';
        }
    } else {
        // Si no se encuentra el usuario
        echo 'Nombre de usuario incorrecto.';
    }
}
?>

