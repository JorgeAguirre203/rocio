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

// Eliminar afiliado
if (isset($_POST['eliminar_id'])) {
    $eliminar_id = intval($_POST['eliminar_id']);
    $stmt = $conexion->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $eliminar_id);
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

// Obtener todos los afiliados
$query = "SELECT * FROM usuarios";
$result = $conexion->query($query);

$afiliados_no_verificados = [];
$afiliados_verificados = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        if ($row['verificado'] == 1) {
            $afiliados_verificados[] = $row;
        } else {
            $afiliados_no_verificados[] = $row;
        }
    }
    $result->close();
}

$smarty->assign('afiliados_no_verificados', $afiliados_no_verificados);
$smarty->assign('afiliados_verificados', $afiliados_verificados);
$smarty->assign('page_title', 'Afiliados No Verificados');
$smarty->assign('admin_nombre', $_SESSION['admin']['nombre']);
$smarty->display('loginAfiliados.tpl');
?>