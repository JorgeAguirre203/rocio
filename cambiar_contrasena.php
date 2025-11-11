<?php
session_start();
require_once 'libs/Smarty.class.php';

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

$tipo = $_GET['tipo'] ?? '';
if ($tipo !== 'afiliado' && $tipo !== 'usuario') {
    header("Location: index.php");
    exit();
}

// Determinar tabla y sesión
if ($tipo === 'afiliado') {
    $table = 'usuarios';
    $session_key = 'afiliado';
    $redirect_url = 'afiliados.php';
} else {
    $table = 'usuarios2';
    $session_key = 'usuario';
    $redirect_url = 'dashboard_servicios.php';
}

// Verificar sesión
if (!isset($_SESSION[$session_key])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION[$session_key]['id'];

// Procesar formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validaciones
    $errors = [];

    if (empty($current_password) || empty($new_password) || empty($confirm_password)) {
        $errors[] = "Todos los campos son obligatorios.";
    }

    if ($new_password !== $confirm_password) {
        $errors[] = "Las contraseñas nuevas no coinciden.";
    }

    // Validar que la nueva contraseña tenga al menos 8 caracteres, una mayúscula y un carácter especial
    if (
        strlen($new_password) < 8 ||
        !preg_match('/[A-Z]/', $new_password) ||
        !preg_match('/[\W_]/', $new_password)
    ) {
        $errors[] = "La nueva contraseña debe tener al menos 8 caracteres, una mayúscula y un carácter especial.";
    }

    // Verificar contraseña actual
    if (empty($errors)) {
        $sql = "SELECT password FROM $table WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (!password_verify($current_password, $row['password'])) {
                $errors[] = "La contraseña actual es incorrecta.";
            }
        } else {
            $errors[] = "Usuario no encontrado.";
        }
    }

    // Si no hay errores, actualizar contraseña
    if (empty($errors)) {
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $sql_update = "UPDATE $table SET password = ? WHERE id = ?";
        $stmt = $conn->prepare($sql_update);
        $stmt->bind_param("si", $hashedPassword, $user_id);

        if ($stmt->execute()) {
            header("Location: $redirect_url?mensaje=Contraseña actualizada exitosamente");
            exit();
        } else {
            $errors[] = "Error al actualizar la contraseña: " . $conn->error;
        }
    }

    // Si hay errores, mostrarlos
    if (!empty($errors)) {
        $smarty->assign('errors', $errors);
    }
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Cambiar Contraseña - Servi Now',
    'tipo' => $tipo
]);

// Mostrar plantilla
$smarty->display('cambiar_contrasena.tpl');

$conn->close();
?>
