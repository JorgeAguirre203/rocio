<?php
require_once 'conexionBD.php';
session_start();

// 1. Validar método de solicitud
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.html?error=1");
    exit;
}

// 2. Obtener y sanitizar datos
$telefono = filter_var($_POST['telefono'] ?? '', FILTER_SANITIZE_STRING);
$password = $_POST['password'] ?? '';

// 3. Validar campos vacíos
if (empty($telefono) || empty($password)) {
    header("Location: login.html?error=1");
    exit;
}

try {
    // 4. Conexión a BD
    $db = new Conexion();
    $conexion = $db->getConexion();

    // 5. Consulta CORREGIDA (incluyendo 'nombre')
    $sql = "SELECT id, nombre, telefono, password, rol FROM usuarios WHERE telefono = ?";
    $stmt = $conexion->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("Error en preparación: ".$conexion->error);
    }
    
    $stmt->bind_param("s", $telefono);
    $stmt->execute();
    $resultado = $stmt->get_result();

    // 6. Verificar usuario
    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        
        // 7. Verificar contraseña
        if (password_verify($password, $usuario['password'])) {
            $_SESSION['usuario'] = [
                'id' => $usuario['id'],
                'nombre' => $usuario['nombre'],
                'rol' => $usuario['rol'],
                'telefono' => $usuario['telefono']
            ];
            header("Location: index.html");
            exit;
        }
    }
    
    // 8. Credenciales incorrectas
    header("Location: login.html?error=1");
    exit;

} catch (Exception $e) {
    // 9. Manejo de errores
    error_log("Error en login: ".$e->getMessage());
    header("Location: login.html?error=1");
    exit;
}
?>