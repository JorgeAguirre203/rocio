<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

try {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    require_once __DIR__.'/libs/Smarty.class.php';
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

    require_once('conexion_jorge.php');

    // Si es un cliente, redirigir a su dashboard
    if (isset($_SESSION['usuario'])) {
        header("Location: dashboard_servicios.php");
        exit;
    }

    // Ejecutar mensajes automáticos cuando el afiliado accede al panel
    if (isset($_SESSION['afiliado'])) {
        include 'enviar_mensajes_automaticos.php';
    }

    // Solo mostrar el afiliado logueado
    if (!isset($_SESSION['afiliado'])) {
        header("Location: login.php");
        exit;
    }

    $afiliado_id = $_SESSION['afiliado']['id'];
    error_log("Afiliado id en sesión: " . print_r($afiliado_id, true));

    // Obtener datos del afiliado (usa la tabla correcta)
    $query = "SELECT id, nombre, apellido_paterno, apellido_materno, nickname, email, especialidad, foto_perfil 
            FROM usuarios 
            WHERE id = ?";
    $stmt = $conexion->prepare($query);
    if (!$stmt) {
        error_log("Error al preparar la consulta de afiliado: " . $conexion->error);
        die("Error al preparar la consulta de afiliado.");
    }
    $stmt->bind_param("i", $afiliado_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        error_log("Error al obtener el resultado de afiliado: " . $conexion->error);
        die("Error al obtener el resultado de afiliado.");
    }
    $afiliado = $result->fetch_assoc();
    $stmt->close();

    if (!$afiliado) {
        error_log("DEBUG - No se encontró afiliado. ID buscado: $afiliado_id");
        error_log("DEBUG - Consulta ejecutada: $query");
        error_log("DEBUG - Error MySQL: " . $conexion->error);
        error_log("DEBUG - Sesión: " . print_r($_SESSION, true));
        die("Error: No se encontró el afiliado. ID buscado: $afiliado_id");
    }

    // --- CONSULTA CORREGIDA PARA PETICIONES PENDIENTES ---
    $sql_peticiones = "SELECT 
        p.id as peticion_id, 
        p.id_usuario,
        u.nombre, u.nickname, u.telefono, u.email, 
        u.calle, u.numero_casa, u.codigo_postal, u.estado as estado_dir, u.municipio, u.indicaciones,
        GROUP_CONCAT(DISTINCT s.nombre_servicio SEPARATOR ', ') as servicios_contratados,
        MAX(ct.tipo_cobro) as tipo_cobro
    FROM peticiones p
    INNER JOIN usuarios2 u ON p.id_usuario = u.id
    LEFT JOIN contrataciones ct ON ct.id_peticion = p.id
    LEFT JOIN servicios s ON ct.id_servicio = s.id
    WHERE p.id_afiliado = ? AND p.estado = 'pendiente'
    GROUP BY p.id";
    $stmt2 = $conexion->prepare($sql_peticiones);
    $stmt2->bind_param("i", $afiliado_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $peticiones = [];
    while ($row = $result2->fetch_assoc()) {
        $peticiones[] = $row;
    }
    $stmt2->close();
    error_log("Peticiones encontradas: " . print_r($peticiones, true));

    // Peticiones aceptadas (excluyendo las que ya tienen pago completado)
    $sql_aceptadas = "SELECT 
            p.id as peticion_id, 
            p.id_usuario,
            u.nombre, u.nickname, u.telefono, u.email, 
            u.calle, u.numero_casa, u.codigo_postal, u.estado as estado_dir, u.municipio, u.indicaciones,
            MAX(c.estado) as estado_cotizacion,
            MAX(c.id) as id_cotizacion,
            GROUP_CONCAT(DISTINCT s.nombre_servicio SEPARATOR ', ') as servicios_contratados,
            MAX(ct.tipo_cobro) as tipo_cobro
        FROM peticiones p
        INNER JOIN usuarios2 u ON p.id_usuario = u.id
        LEFT JOIN contrataciones ct ON ct.id_peticion = p.id
        LEFT JOIN servicios s ON ct.id_servicio = s.id
        LEFT JOIN cotizaciones c ON p.id = c.id_peticion
        WHERE p.id_afiliado = ? 
        AND p.estado = 'aceptada'
        AND (c.estado IS NULL OR c.estado != 'completada')
        GROUP BY p.id";
    $stmt3 = $conexion->prepare($sql_aceptadas);
    if (!$stmt3) {
        error_log("Error al preparar la consulta de aceptadas: " . $conexion->error);
        die("Error al preparar la consulta de aceptadas.");
    }
    $stmt3->bind_param("i", $afiliado_id);
    $stmt3->execute();
    $result3 = $stmt3->get_result();
    $peticiones_aceptadas = [];
    while ($row = $result3->fetch_assoc()) {
        $peticiones_aceptadas[] = $row;
    }
    $stmt3->close();
    error_log("Peticiones encontradas: " . print_r($peticiones, true));

    // Obtener mensajes no leídos de clientes para el afiliado actual
    $unread_messages = [];
    $sql_unread = "SELECT remitente_id, COUNT(*) as count FROM mensajes WHERE receptor_id = ? AND remitente_es_afiliado = 0 AND leido = 0 GROUP BY remitente_id";
    $stmt_unread = $conexion->prepare($sql_unread);
    $stmt_unread->bind_param("i", $afiliado_id);
    $stmt_unread->execute();
    $result_unread = $stmt_unread->get_result();
    while ($row = $result_unread->fetch_assoc()) {
        $unread_messages[$row['remitente_id']] = $row['count'];
    }
    $stmt_unread->close();

    // Agregar conteo de mensajes no leídos a cada petición
    foreach ($peticiones as &$peticion) {
        $peticion['unread_messages'] = $unread_messages[$peticion['id_usuario']] ?? 0;
    }
    foreach ($peticiones_aceptadas as &$peticion) {
        $peticion['unread_messages'] = $unread_messages[$peticion['id_usuario']] ?? 0;
        $peticion['link_direccion'] = "direccion.php?id=" . $peticion['id_usuario'];
    }

    // Asegura que todas las variables sean arrays para evitar errores en Smarty
    if (!isset($peticiones) || !is_array($peticiones)) $peticiones = [];
    if (!isset($peticiones_aceptadas) || !is_array($peticiones_aceptadas)) $peticiones_aceptadas = [];
    if (!isset($solicitudes) || !is_array($solicitudes)) $solicitudes = [];

    // Asignar a Smarty
    $smarty->assign([
        'page_title' => 'Panel de Afiliado',
        'afiliado_log' => $afiliado,
        'peticiones' => $peticiones,
        'peticiones_aceptadas' => $peticiones_aceptadas,
        'solicitudes' => $solicitudes
    ]);

    $smarty->display('afiliados.tpl');

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    // --- CAMBIO PARA DEPURACIÓN ---
    // Muestra el error detallado en lugar del mensaje genérico.
    echo "<h2>Error Detallado</h2>";
    echo "<p>Ocurrió un problema al cargar el afiliado. El error real es:</p>";
    echo "<pre style='background: #f8d7da; color: #721c24; padding: 15px; border-radius: 5px; border: 1px solid #f5c6cb;'>";
    echo "<strong>Mensaje:</strong> " . htmlspecialchars($e->getMessage()) . "\n";
    echo "<strong>Archivo:</strong> " . htmlspecialchars($e->getFile()) . "\n";
    echo "<strong>Línea:</strong> " . htmlspecialchars($e->getLine()) . "\n";
    echo "</pre>";
    die();
}
?>
