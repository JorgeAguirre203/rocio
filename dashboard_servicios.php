<?php
try {
    // Iniciar sesión
    session_start();

    // Verificar y cargar Smarty
    require_once(__DIR__ . '/libs/Smarty.class.php');

    // Crear instancia de Smarty
    $smarty = new Smarty();

    // Configuración de directorios
    $smarty->setTemplateDir(__DIR__ . '/templates/');
    $smarty->setCompileDir(__DIR__ . '/templates_c/');
    $smarty->setCacheDir(__DIR__ . '/cache/');
    $smarty->setConfigDir(__DIR__ . '/configs/');

    // Configuración adicional
    $smarty->setEscapeHtml(true);
    $smarty->setErrorReporting(E_ALL & ~E_NOTICE);
    $smarty->setDebugging(false);

    // Conexión a la base de datos
    require_once('conexion_jorge.php');

    // Consulta para obtener afiliados verificados
    $query = "SELECT id, nombre, apellido_paterno, apellido_materno, nickname, especialidad, foto_perfil 
              FROM usuarios 
              WHERE verificado = 1";
    $result = $conexion->query($query);

    if (!$result) {
        throw new Exception("Error en la consulta: " . $conexion->error);
    }

    $afiliados = [];
    while ($row = $result->fetch_assoc()) {
        $afiliados[] = $row;
    }
    $result->close();

    // Procesar los datos de los afiliados para la vista
    $servicios = [];
    foreach ($afiliados as $afiliado) {
        $especialidad = $afiliado['especialidad'];
        
        // Mapear especialidades a datos de servicio
        $servicioData = [
            'id' => 'afiliado_' . $afiliado['id'],
            'nombre' => $afiliado['nombre'] . ' ' . $afiliado['apellido_paterno'],
            'nickname' => $afiliado['nickname'],
            'especialidad' => $especialidad,
            'foto_perfil' => $afiliado['foto_perfil'],
            'tipo' => 'afiliado',
            'estrellas' => 5, // Valor predeterminado
            'precio' => 2,     // Valor predeterminado
            'disponibilidad' => 'hoy' // Valor predeterminado
        ];
        
        // Añadir detalles específicos según la especialidad
        switch ($especialidad) {
            case 'albanileria':
                $servicioData['descripcion'] = 'Albañil profesional';
                $servicioData['detalles'] = 'Servicios de construcción y remodelación';
                $servicioData['imagen'] = 'albanileria.jpg';
                break;
            case 'electricidad':
                $servicioData['descripcion'] = 'Electricista certificado';
                $servicioData['detalles'] = 'Instalaciones y reparaciones eléctricas';
                $servicioData['imagen'] = 'electrico.jpg';
                break;
            case 'plomeria':
                $servicioData['descripcion'] = 'Plomero experto';
                $servicioData['detalles'] = 'Reparación e instalación de sistemas de plomería';
                $servicioData['imagen'] = 'plomero.jpg';
                break;
            case 'carpinteria':
                $servicioData['descripcion'] = 'Carpintero especializado';
                $servicioData['detalles'] = 'Trabajos en madera y muebles a medida';
                $servicioData['imagen'] = 'carpinteria.jpg';
                break;
            default:
                $servicioData['descripcion'] = 'Especialista';
                $servicioData['detalles'] = 'Servicios generales';
                $servicioData['imagen'] = 'default.jpg';
                break;
        }
        
        $servicios[] = $servicioData;
    }

    // Asignar datos del usuario a la plantilla
    $smarty->assign([
        'page_title' => 'Dashboard de Servicios',
        'nombre' => htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Usuario'),
        'nickname' => htmlspecialchars($_SESSION['usuario']['nickname'] ?? 'Invitado'),
        'logo_text' => 'Servi Now',
        'current_year' => date('Y'),
        'company_name' => 'Servi Now',
        'servicios' => $servicios
    ]);

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
?>

