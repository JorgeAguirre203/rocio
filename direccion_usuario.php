<?php
// filepath: /var/www/html/rocio/direccion_usuario.php
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

session_start();
if (isset($_SESSION['usuario']['id'])) {
    $id = intval($_SESSION['usuario']['id']);
} else {
    // Si no hay sesión, puedes redirigir o mostrar error
    die('No has iniciado sesión.');
}
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calle = $_POST['calle'] ?? '';
    $colonia = $_POST['colonia'] ?? '';
    $numero_casa = $_POST['numero_casa'] ?? '';
    $estado = $_POST['estado'] ?? '';
    $municipio = $_POST['municipio'] ?? '';

    $stmt = $conexion->prepare("UPDATE usuarios2 SET calle=?, colonia=?, numero_casa=?, estado=?, municipio=? WHERE id=?");
    $stmt->bind_param("sssssi", $calle, $colonia, $numero_casa, $estado, $municipio, $id);
    if ($stmt->execute()) {
        $mensaje = 'Dirección guardada correctamente';
    } else {
        $mensaje = 'Error al guardar la dirección';
    }
}

file_put_contents('debug_direccion.txt', print_r([
    'id' => $id,
    'POST' => $_POST
], true));

$smarty->assign('id', $id);
$smarty->assign('mensaje', $mensaje);
$smarty->display('direccion_usuario.tpl');