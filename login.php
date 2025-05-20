<?php
session_start();
require_once 'libs/Smarty.class.php';
require_once 'conexion_jorge.php'; // Asegúrate de incluir tu archivo de conexión

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Verificar si ya está logueado
if (isset($_SESSION['usuario'])) {
    // Si ya está logueado, redirigir al dashboard_servicios.php
    header("Location: dashboard_servicios.php");
    exit;
}

// Procesar formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Verificar si los campos no están vacíos
    if (empty($email) || empty($password)) {
        $smarty->assign('error', 'Por favor ingresa ambos campos');
    } else {
        // Consulta a la base de datos para buscar el usuario
        $stmt = $conexion->prepare("SELECT id, nombre, email, password, nickname FROM usuarios2 WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();
        
        // Verificar si se encontró el usuario
        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            
            // Verificar la contraseña
            if (password_verify($password, $usuario['password'])) {
                // Guardar la información del usuario en la sesión
                $_SESSION['usuario'] = [
                    'id' => $usuario['id'],
                    'nombre' => $usuario['nombre'],
                    'nickname' => $usuario['nickname'],
                    'email' => $usuario['email']
                ];
                
                // Redirigir a la página dashboard_servicios.php
                header("Location: dashboard_servicios.php");
                exit;
            } else {
                $smarty->assign('error', 'Contraseña incorrecta');
            }
        } else {
            $smarty->assign('error', 'Usuario no encontrado');
        }
    }
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Iniciar Sesión',
    'logo_text' => 'Servi Now',
    'form_action' => 'login.php',
    'register_link' => 'registrar_usuario.php',
    'home_link' => 'index.php'
]);

// Mostrar plantilla
$smarty->display('login.tpl');
?>

