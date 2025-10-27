<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

$mensaje = '';
$usuario = null;
$afiliado = null;

// Obtener el id_usuario desde GET o POST (para cliente)
if (isset($_GET['id_usuario'])) {
    $id_usuario = intval($_GET['id_usuario']);
} elseif (isset($_POST['id_usuario'])) {
    $id_usuario = intval($_POST['id_usuario']);
} elseif (isset($_SESSION['usuario']['id'])) {
    $id_usuario = intval($_SESSION['usuario']['id']);
} else {
    die('No se proporcionó el usuario.');
}
$smarty->assign('id_usuario', $id_usuario);

// Obtener los datos del usuario (cliente)
$stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
$stmt->close();

if (!$usuario) {
    $mensaje = 'No se encontró el usuario.';
}

// Obtener datos del afiliado (desde GET o POST)
if (isset($_GET['id_afiliado'])) {
    $id_afiliado = intval($_GET['id_afiliado']);
} elseif (isset($_POST['id_afiliado'])) {
    $id_afiliado = intval($_POST['id_afiliado']);
} elseif (isset($_SESSION['afiliado']['id'])) {
    $id_afiliado = intval($_SESSION['afiliado']['id']);
} else {
    $mensaje .= ' No se proporcionó el afiliado.';
}

if (isset($id_afiliado)) {
    // Verificar en ambas tablas (usuarios y usuarios2)
    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_afiliado);
    $stmt->execute();
    $result = $stmt->get_result();
    $afiliado = $result->fetch_assoc();
    $stmt->close();
    
    // Si no se encuentra en usuarios, buscar en usuarios2
    if (!$afiliado) {
        $stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
        $stmt->bind_param("i", $id_afiliado);
        $stmt->execute();
        $result = $stmt->get_result();
        $afiliado = $result->fetch_assoc();
        $stmt->close();
    }
}

// Función para geocodificar una dirección
function geocodificarDireccion($direccion, $conexion, $id, $tabla = 'usuarios2') {
    if (trim($direccion) === '' || trim($direccion) === ', , , ,') {
        return 'La dirección está incompleta. No se puede geocodificar.';
    }
    
    $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($direccion);
    $options = [
        'http' => [
            'header' => "User-Agent: MyApp/1.0\r\n",
            'timeout' => 10
        ]
    ];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    if ($response === FALSE) {
        return 'Error al conectar con el servicio de geocodificación.';
    }
    
    $data = json_decode($response, true);

    if ($data && count($data) > 0) {
        $lat = floatval($data[0]['lat']);
        $lon = floatval($data[0]['lon']);
        
        $stmt = $conexion->prepare("UPDATE $tabla SET latitud = ?, longitud = ? WHERE id = ?");
        $stmt->bind_param("ddi", $lat, $lon, $id);
        $stmt->execute();
        $stmt->close();
        
        return 'Dirección geocodificada correctamente.';
    } else {
        return 'Dirección no encontrada: ' . $direccion;
    }
}

// Procesar geocodificación
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['geocodificar_cliente']) && $usuario) {
        $direccion_cliente = trim($usuario['calle']) . ' ' . trim($usuario['numero_casa']) . ', ' . 
                           trim($usuario['codigo_postal']) . ', ' . trim($usuario['municipio']) . ', ' . 
                           trim($usuario['estado']);
        
        $mensaje_geo = geocodificarDireccion($direccion_cliente, $conexion, $id_usuario, 'usuarios2');
        $mensaje = $mensaje_geo;
        
        // Actualizar datos del cliente
        $stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();
        $stmt->close();
    }
    
    if (isset($_POST['geocodificar_afiliado']) && $afiliado) {
        $direccion_afiliado = trim($afiliado['calle']) . ' ' . trim($afiliado['numero_casa']) . ', ' . 
                            trim($afiliado['codigo_postal']) . ', ' . trim($afiliado['municipio']) . ', ' . 
                            trim($afiliado['estado']);
        
        $tabla_afiliado = (isset($afiliado['id']) && $afiliado['id'] == $id_afiliado) ? 'usuarios' : 'usuarios2';
        $mensaje_geo = geocodificarDireccion($direccion_afiliado, $conexion, $id_afiliado, $tabla_afiliado);
        $mensaje .= ' ' . $mensaje_geo;
        
        // Actualizar datos del afiliado
        if ($tabla_afiliado === 'usuarios') {
            $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id = ?");
        } else {
            $stmt = $conexion->prepare("SELECT * FROM usuarios2 WHERE id = ?");
        }
        $stmt->bind_param("i", $id_afiliado);
        $stmt->execute();
        $result = $stmt->get_result();
        $afiliado = $result->fetch_assoc();
        $stmt->close();
    }
}

// Debug: verificar coordenadas
if ($usuario && $afiliado) {
    error_log("Cliente coords: " . $usuario['latitud'] . ", " . $usuario['longitud']);
    error_log("Afiliado coords: " . $afiliado['latitud'] . ", " . $afiliado['longitud']);
}

$smarty->assign('usuario', $usuario);
$smarty->assign('afiliado', $afiliado);
$smarty->assign('mensaje', $mensaje);
$smarty->display('contratarAfiliado.tpl');

$conexion->close();
?>