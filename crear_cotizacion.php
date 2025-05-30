<?php

require_once 'conexion_jorge.php';
require_once __DIR__.'/libs/Smarty.class.php';
session_start();

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

$smarty = new Smarty();
$baseDir = __DIR__.'/';
$dirs = [
    'template_dir' => $baseDir.'templates/',
    'compile_dir' => $baseDir.'templates_c/',
    'cache_dir' => $baseDir.'cache/',
    'config_dir' => $baseDir.'configs/'
];
foreach ($dirs as $key => $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $smarty->{$key} = $dir;
}

// --- EDICIÓN: Cargar datos si viene id_cotizacion por GET ---
$editando = false;
if (isset($_GET['id_cotizacion'])) {
    $id_cotizacion = intval($_GET['id_cotizacion']);
    $stmt = $conexion->prepare("SELECT * FROM cotizaciones WHERE id = ?");
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $datos_cotizacion = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($datos_cotizacion) {
        $editando = true;
        $smarty->assign('cotizacion', $datos_cotizacion);
        $smarty->assign('peticion_id', $datos_cotizacion['id_peticion'] ?? 0); // Si tienes id_peticion en cotizaciones
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peticion_id = intval($_POST['peticion_id']);
    $servicio = $_POST['servicio'];
    $horas = floatval($_POST['horas']);
    $detalles = $_POST['detalles'];
    $precio_hora = floatval($_POST['precio_hora']);
    $total = $horas * $precio_hora;

    // Validar servicio
    if (!in_array($servicio, ['plomeria','electricidad','carpinteria','albanileria'])) {
        die("Error: El servicio '$servicio' no es válido.");
    }

    // --- Si es edición, actualiza la cotización ---
    if (isset($_POST['id_cotizacion']) && $_POST['id_cotizacion']) {
        $id_cotizacion = intval($_POST['id_cotizacion']);
        $stmt = $conexion->prepare("UPDATE cotizaciones SET servicio=?, horas=?, detalles=?, precio_hora=?, total=? WHERE id=?");
        $stmt->bind_param("sdssdi", $servicio, $horas, $detalles, $precio_hora, $total, $id_cotizacion);
        $stmt->execute();
        $stmt->close();
        header("Location: afiliados.php");
        exit;
    }

    // --- Si es nueva cotización, crea normalmente ---
    // Obtener id_usuario e id_afiliado de la petición
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM peticiones WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->bind_result($id_usuario, $id_afiliado);
    $stmt->fetch();
    $stmt->close();

    // Insertar cotización
    $stmt = $conexion->prepare("INSERT INTO cotizaciones (id_usuario, id_afiliado, servicio, horas, detalles, precio_hora, total, estado) VALUES (?, ?, ?, ?, ?, ?, ?, 'pendiente')");
    $stmt->bind_param("iisdssd", $id_usuario, $id_afiliado, $servicio, $horas, $detalles, $precio_hora, $total);
    $stmt->execute();
    if ($stmt->error) {
        die("Error MySQL: " . $stmt->error);
    }
    $id_cotizacion = $stmt->insert_id;
    $stmt->close();

    // Relacionar cotización con la petición
    $stmt = $conexion->prepare("UPDATE peticiones SET id_cotizacion = ?, estado = 'pendiente' WHERE id = ?");
    $stmt->bind_param("ii", $id_cotizacion, $peticion_id);
    $stmt->execute();
    $stmt->close();

    header("Location: afiliados.php");
    exit;
}

// Si no es edición, asigna peticion_id desde GET
if (!$editando) {
    $peticion_id = isset($_GET['peticion_id']) ? intval($_GET['peticion_id']) : 0;
    $smarty->assign('peticion_id', $peticion_id);
}

$smarty->display('crear_cotizacion.tpl');