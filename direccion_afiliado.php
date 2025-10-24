<?php
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

session_start();
if (isset($_SESSION['afiliado']['id'])) {
    $id = intval($_SESSION['afiliado']['id']);
} else {
    die('No has iniciado sesión.');
}

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $calle = trim($_POST['calle'] ?? '');
    $numero_casa = trim($_POST['numero_casa'] ?? '');
    $codigo_postal = trim($_POST['codigo_postal'] ?? '');
    $codigo_postal = preg_replace('/\s+/', '', $codigo_postal);
    $estado = trim($_POST['estado'] ?? '');
    $municipio = trim($_POST['municipio'] ?? '');
    $indicaciones = trim($_POST['indicaciones'] ?? '');

    // Validación básica
    if (empty($calle) || empty($indicaciones)) {
        $mensaje = 'Por favor complete todos los campos obligatorios (calle e indicaciones).';
    } elseif (!preg_match('/^\d{5}$/', $codigo_postal)) {
        $mensaje = 'El código postal debe ser de 5 dígitos numéricos.';
    }

    if (empty($mensaje)) {
        try {
            $stmt = $conexion->prepare("UPDATE usuarios SET 
                calle = ?, 
                numero_casa = ?, 
                codigo_postal = ?, 
                estado = ?, 
                municipio = ?, 
                indicaciones = ? 
                WHERE id = ?");
            $stmt->bind_param("ssssssi", 
                $calle, 
                $numero_casa, 
                $codigo_postal, 
                $estado, 
                $municipio, 
                $indicaciones, 
                $id);

            if ($stmt->execute()) {
                // --- GEOCODIFICAR DIRECCIÓN ---
                $direccion = trim($calle) . ' ' . trim($numero_casa) . ', ' . trim($codigo_postal) . ', ' . trim($municipio) . ', ' . trim($estado);
                if (trim($direccion) !== ', , , ,') {
                    $url = "https://nominatim.openstreetmap.org/search?format=json&q=" . urlencode($direccion);
                    $options = [
                        'http' => [
                            'header' => "User-Agent: MyApp/1.0\r\n"
                        ]
                    ];
                    $context = stream_context_create($options);
                    $response = @file_get_contents($url, false, $context); // El @ evita error fatal si la API falla
                    if ($response !== false) {
                        $data = json_decode($response, true);
                        if ($data && count($data) > 0) {
                            $lat = floatval($data[0]['lat']);
                            $lon = floatval($data[0]['lon']);
                            $stmt2 = $conexion->prepare("UPDATE usuarios SET latitud = ?, longitud = ? WHERE id = ?");
                            $stmt2->bind_param("ddi", $lat, $lon, $id);
                            $stmt2->execute();
                            $stmt2->close();
                        }
                    }
                }
                // --- FIN GEOCODIFICACIÓN ---
                header("Location: afiliados.php?msg=Dirección+guardada+correctamente");
                exit;
            } else {
                $mensaje = 'Error al actualizar la dirección: ' . $stmt->error;
            }
            $stmt->close();
        } catch (Exception $e) {
            $mensaje = 'Error en la base de datos: ' . $e->getMessage();
        }
    }
}

// Obtener datos actuales para prellenar el formulario
$datos_actuales = [];
$query = $conexion->prepare("SELECT calle, numero_casa, codigo_postal, estado, municipio, indicaciones 
                            FROM usuarios 
                            WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result && $result->num_rows > 0) {
    $datos_actuales = $result->fetch_assoc();
}
$smarty->assign('datos_actuales', $datos_actuales);
$smarty->assign('mensaje', $mensaje);
$smarty->display('direccion_afiliado.tpl');