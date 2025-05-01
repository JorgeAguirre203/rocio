<?php
session_start();
<<<<<<< HEAD
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

=======
require_once 'libs/Smarty.class.php';
require_once 'conexion_jorge.php'; // Asegúrate de incluir tu archivo de conexión

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Verificar si ya está logueado
if (isset($_SESSION['usuario'])) {
    header("Location: bienvenida.php");
    exit;
}

// Procesar formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if (empty($email) || empty($password)) {
        $smarty->assign('error', 'Por favor ingresa ambos campos');
    } else {
        // Consulta a la base de datos
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
                    'nickname' => $usuario['nickname'],
                    'email' => $usuario['email']
                ];
                
                header("Location: bienvenida.php");
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
>>>>>>> a2844ff (smarty template edgar)
