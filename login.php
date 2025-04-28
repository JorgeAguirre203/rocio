<?php
session_start();
require_once 'conexion_jorge.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        echo 'Por favor, ingresa correo electrónico y contraseña.';
        exit;
    }

    $stmt = $conexion->prepare("SELECT id, nombre, email, password, nickname FROM usuarios2 WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($password, $usuario['password'])) {
           $_SESSION['usuario'] = [
    'id' => $usuario['id'],
    'nombre' => $usuario['nombre'],
    'nickname' => $usuario['nickname'], // ✅ ahora sí
    'email' => $usuario['email']
];


            // Mostrar mensaje de éxito
            echo '<script>
                    alert("¡Inicio de sesión exitoso!");
                    window.location.href = "index.html";
                  </script>';
            exit;
        } else {
            echo 'Contraseña incorrecta.';
        }
    } else {
        echo 'Correo electrónico no encontrado.';
    }
}
?>

