<?php
require_once 'libs/Smarty.class.php';
error_reporting(E_ALL & ~E_DEPRECATED);

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    exit();
}

// Procesar formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';
    
    // Validaciones
    $errors = [];
    
    if (empty($nombre) || empty($telefono) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errors[] = "Todos los campos son obligatorios.";
    }
    
    if ($password !== $confirmPassword) {
        $errors[] = "Las contraseñas no coinciden.";
    }
    
    // Verificar existencia en BD
    if (empty($errors)) {
        $sql_check = "SELECT * FROM usuarios2 WHERE email = ? OR nickname = ? OR telefono = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("sss", $email, $nickname, $telefono);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['email'] === $email) $errors[] = "El correo electrónico ya está registrado.";
                if ($row['nickname'] === $nickname) $errors[] = "El nickname ya está registrado.";
                if ($row['telefono'] === $telefono) $errors[] = "El teléfono ya está registrado.";
            }
        }
    }
    
    // Si no hay errores, registrar usuario
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO usuarios2 (nombre, telefono, email, password, nickname) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param("sssss", $nombre, $telefono, $email, $hashedPassword, $nickname);
        
        if ($stmt->execute()) {
            header("Location: login.php?registro=exitoso");
            exit();
        } else {
            $errors[] = "Error al registrar el usuario: " . $conn->error;
        }
    }
    
    // Si hay errores, mostrarlos
    if (!empty($errors)) {
        $smarty->assign('errors', $errors);
        $smarty->assign('form_data', $_POST);
    }
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Registro - Servi Now',
    'logo_text' => 'Servi Now',
    'form_action' => 'registrar_usuario.php',
    'login_link' => 'login.php',
    'home_link' => 'index.php'
]);

// Mostrar plantilla
$smarty->display('registro.tpl');

$conn->close();
?>
