<?php


try {
    // Iniciar sesión
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Verificar y cargar Smarty 4
    $smartyPath = __DIR__.'/libs/Smarty.class.php';
    if (!file_exists($smartyPath)) {
        throw new Exception("Error: No se encontró la librería Smarty en $smartyPath");
    }

    require_once($smartyPath);

    // Crear instancia de Smarty
    $smarty = new Smarty();

    // Configuración de directorios
    $baseDir = __DIR__.'/';
    $dirs = [
        'template_dir' => $baseDir.'templates/',
        'compile_dir' => $baseDir.'templates_c/',
        'cache_dir' => $baseDir.'cache/',
        'config_dir' => $baseDir.'configs/'
    ];
// Asignar datos del usuario a la plantilla
$smarty->assign([
    'page_title' => 'Dashboard de Servicios',
    'nombre' => htmlspecialchars($_SESSION['usuario']['nombre']),
    'nickname' => htmlspecialchars($_SESSION['usuario']['nickname']),
    'logo_text' => 'Servi Now',
    'current_year' => date('Y'),
    'company_name' => 'Servi Now'
]);
    // Crear directorios si no existen
    foreach ($dirs as $key => $dir) {
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0755, true)) {
                throw new Exception("No se pudo crear el directorio: $dir");
            }
        }
        $smarty->{$key} = $dir;
    }

    // Configuración adicional de Smarty
    $smarty->setEscapeHtml(true);
    $smarty->setErrorReporting(E_ALL & ~E_NOTICE);
    $smarty->setDebugging(false);

    // Datos para los filtros
    $smarty->assign([
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

    // Datos de los servicios
    $smarty->assign('servicios', [
        [
            'id' => 'albanileria',
            'nombre' => 'Albañilería',
            'descripcion' => 'Construcción y remodelación con precisión profesional.',
            'detalles' => 'Muros, pisos, acabados, losas, y más.',
            'imagen' => 'albanileria.jpg',
            'estrellas' => 5,
            'precio' => 2,
            'disponibilidad' => 'hoy,semana'
        ],
        [
            'id' => 'electricidad',
            'nombre' => 'Electricidad',
            'descripcion' => 'Instalaciones eléctricas seguras y eficientes.',
            'detalles' => 'Instalación, reparación de cortos y mantenimiento general.',
            'imagen' => 'electrico.jpg',
            'estrellas' => 4,
            'precio' => 1,
            'disponibilidad' => 'semana'
        ]
    ]);

    // Variables generales
    $smarty->assign([
        'page_title' => 'Dashboard de Servicios',
        'app_name' => 'Servi now',
        'company_name' => 'Servicios Profesionales',
        'current_year' => date('Y')
    ]);

    // Mostrar la plantilla
    $template = 'dashboard_servicios.tpl';
    if (!$smarty->templateExists($template)) {
        throw new Exception("La plantilla $template no existe");
    }

    $smarty->display($template);

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    die("<h2>Error en la aplicación</h2>
        <p>Ocurrió un error al procesar su solicitud.</p>
        <p><small>Detalles técnicos: " . htmlspecialchars($e->getMessage()) . "</small></p>");
}
