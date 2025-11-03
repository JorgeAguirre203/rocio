<?php

try {
    // Iniciar sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Redirigir si es un afiliado
    if (isset($_SESSION['afiliado'])) {
        header("Location: afiliados.php");
        exit;
    }

    // Cargar Smarty
    require_once __DIR__.'/libs/Smarty.class.php';
    $smarty = new Smarty();

    // Configuración de directorios
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

    // Conexión a la base de datos
    require_once('conexion_jorge.php');
    
    // Consulta para obtener afiliados verificados con su promedio de estrellas
    $query = "SELECT u.id, u.nombre, u.apellido_paterno, u.apellido_materno, u.nickname, u.email, u.especialidad, u.foto_perfil,
                     IFNULL(AVG(ca.estrellas), 0) AS promedio_estrellas
              FROM usuarios u
              LEFT JOIN calificaciones ca ON u.id = ca.id_afiliado
              WHERE u.verificado = 1
              GROUP BY u.id";
    $result = $conexion->query($query);

    if (!$result) {
        error_log("Error SQL: " . $query);
        error_log("MySQL Error: " . $conexion->error);
        throw new Exception("Error en la consulta: " . $conexion->error);
    }

    if (!$result) {
        throw new Exception("Error en la consulta: " . $conexion->error);
    }

    $servicios = [];
    while ($afiliado = $result->fetch_assoc()) {
        $servicios[] = [
            'id' => $afiliado['id'],
            'nombre' => $afiliado['nombre'] . ' ' . $afiliado['apellido_paterno'],
            'nickname' => $afiliado['nickname'],
            'email' => $afiliado['email'],
            'especialidad' => $afiliado['especialidad'],
            'foto_perfil' => $afiliado['foto_perfil'],
            'descripcion' => 'Profesional verificad@',
            'detalles' => 'Especialista en ' . $afiliado['especialidad'],
            'estrellas' => round($afiliado['promedio_estrellas'], 1), // Promedio real
            'precio' => 2,
            'disponibilidad' => 'hoy,semana'
        ];
    }
    $result->close();

    // --- BLOQUE DE NOTIFICACIONES ---
    $id_usuario = $_SESSION['usuario']['id'] ?? null;
    $notificaciones = [];
    $noti_count = 0;

    if ($id_usuario) {
        $sql = "SELECT id, mensaje FROM notificaciones WHERE id_usuario = ? AND leida = 0 ORDER BY id DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $id_usuario);
        $stmt->execute();
        $result_notificaciones = $stmt->get_result();
        while ($row = $result_notificaciones->fetch_assoc()) {
            $notificaciones[] = $row;
        }
        $noti_count = count($notificaciones);
        $stmt->close();
    }

    // Verificar si el usuario tiene dirección completa
    $direccion_incompleta = false;
    if ($id_usuario) {
        $sql_dir = "SELECT calle, numero_casa, estado, municipio FROM usuarios2 WHERE id = ?";
        $stmt_dir = $conexion->prepare($sql_dir);
        $stmt_dir->bind_param("i", $id_usuario);
        $stmt_dir->execute();
        $stmt_dir->bind_result($calle, $numero_casa, $estado, $municipio);
        $stmt_dir->fetch();
        $stmt_dir->close();

        if (empty($calle) || empty($estado) || empty($municipio)) {
            $direccion_incompleta = true;
        }
    }
    $smarty->assign('direccion_incompleta', $direccion_incompleta);

    // Asignar datos a Smarty
    $smarty->assign([
        'page_title' => 'Afiliados Verificados',
        'nombre' => htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Usuario'),
        'nickname' => htmlspecialchars($_SESSION['usuario']['nickname'] ?? 'Invitado'),
        'servicios' => $servicios,
        'categorias' => [
            ['id' => 'albanileria', 'nombre' => 'Albañilería', 'checked' => true],
            ['id' => 'electricidad', 'nombre' => 'Electricidad', 'checked' => true],
            ['id' => 'plomeria', 'nombre' => 'Plomería', 'checked' => true],
            ['id' => 'carpinteria', 'nombre' => 'Carpintería', 'checked' => true]
        ],
        'opciones_estrellas' => [
            0 => 'Cualquier calificación',
            3 => '3 estrellas o más',
            4 => '4 estrellas o más',
            5 => 'Solo 5 estrellas'
        ],
        'opciones_precio' => [
            0 => 'Cualquier precio',
            1 => '$ - Económico',
            2 => '$$ - Medio',
            3 => '$$$ - Alto'
        ],
        'disponibilidades' => [
            ['id' => 'hoy', 'nombre' => 'Disponible hoy', 'checked' => false],
            ['id' => 'semana', 'nombre' => 'Esta semana', 'checked' => false]
        ]
    ]);

    // Asigna las notificaciones y el contador
    $smarty->assign('notificaciones', $notificaciones);
    $smarty->assign('noti_count', $noti_count);

    // Mostrar plantilla
    $smarty->display('dashboard_servicios.tpl');

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    die("<h2>Error</h2><p>Ocurrió un problema al cargar los afiliados</p>");
}