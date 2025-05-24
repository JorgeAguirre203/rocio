<?php
try {
    // Iniciar sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
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
    
    // Consulta para obtener afiliados verificados
    $query = "SELECT id, nombre, apellido_paterno, apellido_materno, nickname, email, especialidad, foto_perfil 
              FROM usuarios 
              WHERE verificado = 1";
    $result = $conexion->query($query);

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
            'foto_perfil' => 'uploads/' . $afiliado['foto_perfil'],
            'descripcion' => 'Profesional verificad@',
            'detalles' => 'Especialista en ' . $afiliado['especialidad'],
            'estrellas' => 5,
            'precio' => 2,
            'disponibilidad' => 'hoy,semana'
        ];
    }
    $result->close();

    // Asignar datos a Smarty (CON LOS FILTROS COMPLETOS)
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

    // Mostrar plantilla
    $smarty->display('dashboard_servicios.tpl');

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    die("<h2>Error</h2><p>Ocurrió un problema al cargar los afiliados</p>");
}
