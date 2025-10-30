<?php
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';
session_start();


$id_afiliado = intval($_GET['id_afiliado'] ?? 0);
$id_usuario = intval($_SESSION['usuario']['id'] ?? 0);

// Obtener datos del afiliado
$stmt = $conexion->prepare("SELECT especialidad, nombre, apellido_paterno, apellido_materno FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_afiliado);
$stmt->execute();
$result = $stmt->get_result();
$afiliado = $result->fetch_assoc();
$stmt->close();

$especialidad = $afiliado['especialidad'] ?? '';

// Obtener id_especialidad
$stmt = $conexion->prepare("SELECT id FROM especialidades WHERE nombre = ?");
$stmt->bind_param("s", $especialidad);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$id_especialidad = $row['id'] ?? 0;
$stmt->close();

// Obtener servicios fijos de la especialidad
$servicios = [];
if ($id_especialidad) {
    $stmt = $conexion->prepare("SELECT * FROM servicios WHERE id_especialidad = ?");
    $stmt->bind_param("i", $id_especialidad);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $servicios[] = $row;
    }
    $stmt->close();
}

$smarty = new Smarty();
$smarty->assign('id_afiliado', $id_afiliado);
$smarty->assign('id_usuario', $id_usuario);
$smarty->assign('afiliado', $afiliado);
$smarty->assign('especialidad', $especialidad);
$smarty->assign('servicios', $servicios);

$mensaje = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servicios_seleccionados = $_POST['servicios_seleccionados'] ?? [];
    $tipo_cobro = $_POST['tipo_cobro'] ?? null;

    // Contratación por servicios fijos
    if (!empty($servicios_seleccionados)) {
        foreach ($servicios_seleccionados as $servicio_id) {
            $stmt = $conexion->prepare("INSERT INTO contrataciones (id_usuario, id_afiliado, id_servicio, tipo_cobro, fecha) VALUES (?, ?, ?, 'fijo', NOW())");
            $stmt->bind_param("iii", $id_usuario, $id_afiliado, $servicio_id);
            $stmt->execute();
            $stmt->close();
        }
        $notificacion = "Has contratado a este afiliado ({$afiliado['nombre']} {$afiliado['apellido_paterno']}), esperando a que el afiliado le cotice.";
    }
    // Contratación por hora
    elseif ($tipo_cobro === 'por_hora') {
        $stmt = $conexion->prepare("INSERT INTO contrataciones (id_usuario, id_afiliado, tipo_cobro, fecha) VALUES (?, ?, 'por_hora', NOW())");
        $stmt->bind_param("ii", $id_usuario, $id_afiliado);
        $stmt->execute();
        $stmt->close();
        $notificacion = "Has solicitado cotización por hora a este afiliado ({$afiliado['nombre']} {$afiliado['apellido_paterno']}).";
    }

    // Guarda la notificación
    if (isset($notificacion)) {
        $stmt = $conexion->prepare("INSERT INTO notificaciones (id_usuario, mensaje, fecha) VALUES (?, ?, NOW())");
        $stmt->bind_param("is", $id_usuario, $notificacion);
        $stmt->execute();
        $stmt->close();
    }

    // Redirige al dashboard
    header("Location: dashboard_servicios.php");
    exit;
}

$smarty->assign('id_afiliado', $id_afiliado);
$smarty->assign('id_usuario', $id_usuario);
$smarty->assign('afiliado', $afiliado);
$smarty->assign('especialidad', $especialidad);
$smarty->assign('servicios', $servicios);

// ASIGNA ESTAS DOS LÍNEAS:
$smarty->assign('nombre', $_SESSION['usuario']['nombre'] ?? '');
$smarty->assign('nickname', $_SESSION['usuario']['nickname'] ?? '');

// Si tienes $mensaje, también:
$smarty->assign('selectedServices', []);
$smarty->assign('customService', false);
$smarty->assign('total', 0);
$smarty->assign('mensaje', $mensaje ?? '');
$smarty->display('seleccionar_servicio.tpl');
$conexion->close();
?>