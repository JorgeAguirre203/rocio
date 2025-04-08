<?php
session_start();
require_once 'conexion_jorge.php';

// Habilitar la visualización de errores para depuración
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // 1. Verificar método POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Acceso inválido");
    }

    // 2. Validar entradas
    $nombre = filter_var($_POST['nombre'] ?? '', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    
    if (empty($nombre) || empty($password)) {
        throw new Exception("Nombre de usuario y contraseña son requeridos");
    }

    // 3. Conexión a BD
    $db = new Conexion();
    $con = $db->getConexion();

    // 4. Consulta preparada
    $stmt = $con->prepare("SELECT id, nombre, password, rol FROM usuarios2 WHERE nombre = ?");
    if (!$stmt) {
        throw new Exception("Error en preparación: " . $con->error);
    }
    
    $stmt->bind_param("s", $nombre);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // 5. Verificar usuario
    if ($resultado->num_rows !== 1) {
        throw new Exception("Credenciales inválidas");
    }

    $usuario = $resultado->fetch_assoc();

    // 6. Verificar contraseña
    if (!password_verify($password, $usuario['password'])) {
        throw new Exception("Contraseña incorrecta");
    }

    // 7. Crear sesión
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'rol' => $usuario['rol']
    ];

    // 8. Redirección
    header("Location: index.html");
    exit;

} catch (Exception $e) {
    // Mostrar error
    error_log("Login Error: " . $e->getMessage());
    echo "<h3>Error: " . $e->getMessage() . "</h3>";
    exit;
}
?>

