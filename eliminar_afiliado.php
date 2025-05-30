<?php
session_start();
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['afiliado']['id'];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Eliminar afiliado
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        session_destroy();
        header("Location: index.php?msg=Cuenta eliminada");
        exit;
    } else {
        $mensaje = "Error al eliminar la cuenta.";
    }
    $stmt->close();
}

// Obtener datos para mostrar confirmación
$stmt = $conexion->prepare("SELECT nombre, apellido_paterno, apellido_materno FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$afiliado = $result->fetch_assoc();
$stmt->close();

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');
$smarty->assign('afiliado', $afiliado);
$smarty->assign('mensaje', $mensaje);
$smarty->display('eliminar_afiliado.tpl');
?>