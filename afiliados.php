<?php
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

    // Solo mostrar el afiliado logueado
    if (!isset($_SESSION['afiliado'])) {
        header("Location: login.php");
        exit;
    }

    $afiliado_id = $_SESSION['afiliado']['id'];
    // Depuración: muestra el id del afiliado
    error_log("Afiliado id en sesión: " . $afiliado_id);

    // Obtener datos del afiliado
    $query = "SELECT id, nombre, apellido_paterno, apellido_materno, nickname, email, especialidad, foto_perfil 
              FROM usuarios 
              WHERE id = ?";
    $stmt = $conexion->prepare($query);
    $stmt->bind_param("i", $afiliado_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if (!$result) {
        die("Error en la consulta: " . $conexion->error);
    }
    $afiliado = $result->fetch_assoc();
    $stmt->close();

    if (!$afiliado) {
        die("No se encontró el afiliado con id: $afiliado_id");
    }

    // Obtener peticiones pendientes con datos completos del usuario2
    $sql_peticiones = "SELECT 
            p.id as peticion_id, 
            p.id_usuario,
            u.nombre, u.nickname, u.telefono, u.email, 
            u.calle, u.numero_casa, u.codigo_postal, u.estado as estado_dir, u.municipio, u.indicaciones
        FROM peticiones p
        INNER JOIN usuarios2 u ON p.id_usuario = u.id
        WHERE p.id_afiliado = ? AND p.estado = 'pendiente'";
    $stmt2 = $conexion->prepare($sql_peticiones);
    $stmt2->bind_param("i", $afiliado_id);
    $stmt2->execute();
    $result2 = $stmt2->get_result();
    $peticiones = [];
    while ($row = $result2->fetch_assoc()) {
        $peticiones[] = $row;
    }
    $stmt2->close();

    $smarty->assign([
        'page_title' => 'Panel de Afiliado',
        'afiliado_log' => $afiliado,
        'peticiones' => $peticiones
    ]);

    $smarty->display('afiliados.tpl');

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    die("<h2>Error</h2><p>Ocurrió un problema al cargar el afiliado</p>");
}