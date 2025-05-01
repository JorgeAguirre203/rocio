<?php
session_start();
require_once 'libs/Smarty.class.php';
require_once 'conexion_jorge.php';

// Configurar Smarty
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Obtener datos actuales del usuario
$id = $_SESSION['usuario']['id'];
$nombre_actual = $_SESSION['usuario']['nombre'];
$nickname_actual = $_SESSION['usuario']['nickname'];

// Inicializar variables
$error = '';
$success = false;

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_nombre = $_POST['nombre'] ?? '';
    $nuevo_nickname = $_POST['nickname'] ?? '';

    if (!empty($nuevo_nombre) && !empty($nuevo_nickname)) {
        $stmt = $conexion->prepare("UPDATE usuarios2 SET nombre = ?, nickname = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nuevo_nombre, $nuevo_nickname, $id);
        
        if ($stmt->execute()) {
            // Actualizar datos de sesión
            $_SESSION['usuario']['nombre'] = $nuevo_nombre;
            $_SESSION['usuario']['nickname'] = $nuevo_nickname;
            $success = true;
        } else {
            $error = "Error al actualizar los datos.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}

// Asignar variables a Smarty
$smarty->assign([
    'page_title' => 'Editar Perfil',
    'nombre_actual' => htmlspecialchars($nombre_actual),
    'nickname_actual' => htmlspecialchars($nickname_actual),
    'error' => $error,
    'success' => $success
]);

// Mostrar plantilla
$smarty->display('editar_perfil.tpl');
?>
