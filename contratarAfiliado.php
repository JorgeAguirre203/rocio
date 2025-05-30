<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

session_start();

require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

$mensaje = '';
$usuario = null;

// Obtener el id_usuario desde GET o POST (para afiliados)
if (isset($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']);
} elseif (isset($_POST['id_usuario'])) {
    $id_usuario = intval($_POST['id_usuario']);
} elseif (isset($_SESSION['usuario']['id'])) {
    // Para usuarios logueados viendo su propia ubicación
    $id_usuario = intval($_SESSION['usuario']['id']);
} else {
    die('No se proporcionó el usuario.');
}

$smarty->assign('id_usuario', $id_usuario);

// Obtener los datos del usuario (usuarios2)
$stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

if (!$usuario) {
    $mensaje = 'No se encontró el usuario.';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['geocodificar'])) {
    // Armar la dirección solo con los campos requeridos
    $direccion = trim($usuario['calle']) . ' ' . trim($usuario['numero_casa']) . ', ' . trim($usuario['codigo_postal']) . ', ' . trim($usuario['municipio']) . ', ' . trim($usuario['estado']);

    // Validar que la dirección no esté vacía
    if (trim($direccion) !== ', , , ,') {
        $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($direccion);
        $options = [
            'http' => [
                'header' => "User-Agent: MyApp/1.0\r\n"
            ]
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);
        $data = json_decode($response, true);

        if ($data && count($data) > 0) {
            $lat = floatval($data[0]['lat']);
            $lon = floatval($data[0]['lon']);
            $stmt = $conexion->prepare("UPDATE usuarios2 SET latitud = ?, longitud = ? WHERE id = ?");
            $stmt->bind_param("ddi", $lat, $lon, $id_usuario);
            $stmt->execute();
            $stmt->close();
            $mensaje = 'Dirección geocodificada correctamente.';
            // Refresca los datos del usuario
            $stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
            $stmt->bind_param("i", $id_usuario);
            $stmt->execute();
            $result = $stmt->get_result();
            $usuario = $result->fetch_assoc();
            $stmt->close();
        } else {
            $mensaje = 'Dirección no encontrada.';
        }
    } else {
        $mensaje = 'La dirección está incompleta. No se puede geocodificar.';
    }
}

$smarty->assign('usuario', $usuario);
$smarty->assign('mensaje', $mensaje);
$smarty->display('contratarAfiliado.tpl');

$conexion->close();