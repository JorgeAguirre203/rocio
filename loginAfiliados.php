<?php
session_start();
require_once 'libs/Smarty.class.php';
require_once 'conexion_jorge.php';

// Solo permitir acceso a admins
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Verificar afiliado
if (isset($_POST['verificar_id'])) {
    $verificar_id = intval($_POST['verificar_id']);
    $stmt = $conexion->prepare("UPDATE usuarios SET verificado = 1 WHERE id = ?");
    $stmt->bind_param("i", $verificar_id);
    $stmt->execute();
    $stmt->close();
    header("Location: loginAfiliados.php");
    exit;
}

// Cerrar sesión admin
if (isset($_POST['cerrar_sesion'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Obtener afiliados no verificados
$query = "SELECT * FROM usuarios WHERE verificado = 0";
$result = $conexion->query($query);

$afiliados = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $afiliados[] = $row;
    }
    $result->close();
}

$smarty->assign('afiliados', $afiliados);
$smarty->assign('page_title', 'Afiliados No Verificados');
$smarty->assign('admin_nombre', $_SESSION['admin']['nombre']);
$smarty->display('loginAfiliados.tpl');
?>