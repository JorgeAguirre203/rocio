<?php
session_start();
require_once 'conexionBD.php';

// Solo para desarrollo
ini_set('display_errors', 1);
error_reporting(E_ALL);

try {
    // 1. Verificar método POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Acceso inválido");
    }

    // 2. Validar entradas
    $telefono = filter_var($_POST['telefono'] ?? '', FILTER_SANITIZE_STRING);
    $password = $_POST['password'] ?? '';
    
    if (empty($telefono) || empty($password)) {
        throw new Exception("Teléfono y contraseña requeridos");
    }

    // 3. Conexión a BD
    $db = new Conexion();
    $con = $db->getConexion();

    // 4. Consulta preparada
    $stmt = $con->prepare("SELECT id, nombre, password, rol FROM usuarios WHERE telefono = ?");
    if (!$stmt) {
        throw new Exception("Error en preparación: " . $con->error);
    }
    
    $stmt->bind_param("s", $telefono);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // 5. Verificar usuario
    if ($resultado->num_rows !== 1) {
        throw new Exception("Credenciales inválidas");
    }

    $usuario = $resultado->fetch_assoc();

    // 6. Verificar contraseña (2 métodos)
    $auth_success = false;
    
    // Método 1: password_verify (recomendado)
    if (password_verify($password, $usuario['password'])) {
        $auth_success = true;
    } 
    // Método 2: Comparación directa (solo para emergencias)
    elseif ($password === $usuario['password']) {
        $auth_success = true;
        error_log("AVISO: Contraseña en texto plano para usuario " . $usuario['id']);
    }

    if (!$auth_success) {
        throw new Exception("Contraseña incorrecta");
    }

    // 7. Crear sesión
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'rol' => $usuario['rol'],
        'telefono' => $telefono
    ];

    // 8. Redirección
    header("Location: index.html");
    exit;

} catch (Exception $e) {
    error_log("Login Error: " . $e->getMessage());
    header("Location: login.html?error=1");
    exit;
}
?>