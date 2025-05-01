<?php
session_start();
require_once 'libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Verificar sesión
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

// Asignar variables de sesión
$smarty->assign([
    'page_title' => 'Bienvenido',
    'nombre' => htmlspecialchars($_SESSION['usuario']['nombre']),
    'nickname' => htmlspecialchars($_SESSION['usuario']['nickname']),
    'logo_text' => 'Servi Now'
]);

// Mostrar plantilla
$smarty->display('bienvenida.tpl');
?>
