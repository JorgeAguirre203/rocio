<?php
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

session_start();
if (isset($_SESSION['usuario']['id'])) {
    $id = intval($_SESSION['usuario']['id']);
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
    error_log("CP recibido: >" . $codigo_postal . "<"); // <-- AQUÍ
    $estado = 'Sinaloa'; // Estado fijo
    $municipio = 'Ahome'; // Municipio fijo
    $indicaciones = trim($_POST['indicaciones'] ?? '');

    // Validación básica
    if (empty($calle) || empty($indicaciones)) {
        $mensaje = 'Por favor complete todos los campos obligatorios (calle e indicaciones).';
    } elseif (!preg_match('/^\d{5}$/', $codigo_postal)) {
        $mensaje = 'El código postal debe ser de 5 dígitos numéricos.';
    }

    if (empty($mensaje)) {
        try {
            $stmt = $conexion->prepare("UPDATE usuarios2 SET 
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
                header("Location: dashboard_servicios.php?msg=Dirección+guardada+correctamente");
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
                            FROM usuarios2 
                            WHERE id = ?");
$query->bind_param("i", $id);
$query->execute();
$result = $query->get_result();

if ($result->num_rows > 0) {
    $datos_actuales = $result->fetch_assoc();
}
$query->close();

$smarty->assign('id', $id);
$smarty->assign('mensaje', $mensaje);
$smarty->assign('datos_actuales', $datos_actuales);
$smarty->display('direccion_usuario.tpl');
?>