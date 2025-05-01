<?php
require_once 'libs/Smarty.class.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Configurar Smarty
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "servinow_jorge";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    $smarty->assign('error', "Conexión fallida: " . $conn->connect_error);
    $smarty->display('error.tpl');
    exit;
}

// Procesar formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido_paterno = $_POST['apellido_paterno'] ?? '';
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';
    
    // Validaciones
    $errors = [];
    
    // Validar campos obligatorios
    $required_fields = [
        'nombre' => 'Nombre',
        'apellido_paterno' => 'Apellido Paterno',
        'apellido_materno' => 'Apellido Materno',
        'telefono' => 'Teléfono',
        'email' => 'Correo electrónico',
        'password' => 'Contraseña',
        'confirm-password' => 'Confirmar Contraseña'
    ];
    
    foreach ($required_fields as $field => $name) {
        if (empty($_POST[$field])) {
            $errors[] = "El campo $name es obligatorio";
        }
    }
    
    // Validar coincidencia de contraseñas
    if ($password !== $confirmPassword) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    // Validar email único
    if (empty($errors)) {
        $sql_check = "SELECT email FROM usuarios2 WHERE email = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "El correo electrónico ya está registrado";
        }
    }
    
    // Si no hay errores, registrar usuario
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $nombre_completo = "$nombre $apellido_paterno $apellido_materno";
        
        $sql_insert = "INSERT INTO usuarios2 (nombre, nickname, telefono, email, password) 
                      VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("sssss", $nombre_completo, $nickname, $telefono, $email, $hashedPassword);
        
        if ($stmt->execute()) {
            $smarty->assign('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
        } else {
            $errors[] = "Error al registrar el usuario: " . $conn->error;
        }
    }
    
    // Si hay errores, mostrarlos
    if (!empty($errors)) {
        $smarty->assign('errors', $errors);
        // Mantener los valores del formulario para no perderlos
        $smarty->assign('form_data', $_POST);
    }
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Registro - Servi Now',
    'logo_text' => 'Servi Now',
    'form_action' => 'registrar_jorge.php',
    'login_link' => 'login.php',
    'home_link' => 'index.php'
]);

// Mostrar plantilla
$smarty->display('register_jorge.tpl');

$conn->close();
?>
