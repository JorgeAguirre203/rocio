<?php
require_once 'conexion_jorge.php';
require_once __DIR__.'/libs/Smarty.class.php';
session_start();

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

// Obtener el servicio del afiliado desde la base de datos
$id_afiliado = $_SESSION['afiliado']['id'];
$stmt = $conexion->prepare("SELECT especialidad FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id_afiliado);
$stmt->execute();
$stmt->bind_result($servicio_afiliado); // El nombre de la variable puede quedarse igual, pero ahora contendrá la especialidad
$stmt->fetch();
$stmt->close();
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
$smarty->assign('servicio_afiliado', $servicio_afiliado);

// --- SOLUCIÓN: Inicializar variables para evitar errores en la plantilla ---
$smarty->assign('cotizacion', []);
$smarty->assign('servicios_solicitados', []);

// --- EDICIÓN: Cargar datos si viene id_cotizacion por GET ---
$editando = false;
if (isset($_GET['id_cotizacion'])) {
    $id_cotizacion = intval($_GET['id_cotizacion']);
    $stmt = $conexion->prepare("SELECT * FROM cotizaciones WHERE id = ?");
    $stmt->bind_param("i", $id_cotizacion);
    $stmt->execute();
    $datos_cotizacion = $stmt->get_result()->fetch_assoc();
    $stmt->close();
    if ($datos_cotizacion) {
        $editando = true;
        $smarty->assign('cotizacion', $datos_cotizacion);
        $smarty->assign('peticion_id', $datos_cotizacion['id_peticion'] ?? 0); // Si tienes id_peticion en cotizaciones
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $peticion_id = intval($_POST['peticion_id']);
    $servicio = $servicio_afiliado;
    $horas = floatval($_POST['horas']);
    $detalles = $_POST['detalles'];
    $precio_hora = floatval($_POST['precio_hora']);
    
    // --- NUEVO: Determinar si es por hora o por servicios ---
    $es_por_hora = false;
    $stmt = $conexion->prepare("SELECT tipo_cobro FROM contrataciones WHERE id_peticion = ? LIMIT 1");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->bind_result($tipo_cobro);
    $stmt->fetch();
    $stmt->close();
    
    $total = 0; // Inicializar el total

    if ($tipo_cobro === 'por_hora') {
        $es_por_hora = true;
        $total = $horas * $precio_hora;
    } else {
        $sql = "SELECT s.nombre_servicio, s.precio
                FROM contrataciones c
                INNER JOIN servicios s ON c.id_servicio = s.id
                WHERE c.id_peticion = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("i", $peticion_id);
        $stmt->execute();
        $result_servicios = $stmt->get_result();
        while ($row_servicio = $result_servicios->fetch_assoc()) {
            $total += $row_servicio['precio'];
        }
        $stmt->close();
    }

    // --- CÁLCULO DE DISTANCIA (se ejecuta para ambos tipos de cobro) ---
    $sql_dist = "SELECT u2.latitud as lat_cliente, u2.longitud as lon_cliente, u.latitud as lat_afiliado, u.longitud as lon_afiliado
            FROM peticiones p
            INNER JOIN usuarios2 u2 ON p.id_usuario = u2.id
            INNER JOIN usuarios u ON p.id_afiliado = u.id
            WHERE p.id = ?";
    $stmt_dist = $conexion->prepare($sql_dist);
    $stmt_dist->bind_param("i", $peticion_id);
    $stmt_dist->execute();
    $stmt_dist->bind_result($lat_cliente, $lon_cliente, $lat_afiliado, $lon_afiliado);
    $stmt_dist->fetch();
    $stmt_dist->close();

    // Función Haversine para calcular distancia
    function haversine($lat1, $lon1, $lat2, $lon2) {
        $R = 6371; // Radio de la Tierra en km
        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);
        $a = sin($dLat/2) * sin($dLat/2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($dLon/2) * sin($dLon/2);
        $c = 2 * atan2(sqrt($a), sqrt(1-$a));
        return $R * $c;
    }

    $distancia_km = 0;
    if ($lat_cliente && $lon_cliente && $lat_afiliado && $lon_afiliado) {
        $distancia_km = haversine($lat_cliente, $lon_cliente, $lat_afiliado, $lon_afiliado);
    }
    $costo_km = 20; // Costo por kilómetro
    $total_distancia = $distancia_km * $costo_km;

    // Sumar el costo de la distancia al total
    $total += $total_distancia; // <-- Esta línea ya está, pero la movemos de lugar mentalmente. La clave es la siguiente.

    // --- Si es edición, actualiza la cotización ---
    if (isset($_POST['id_cotizacion']) && $_POST['id_cotizacion']) {
        $id_cotizacion = intval($_POST['id_cotizacion']);
        $stmt = $conexion->prepare("UPDATE cotizaciones SET servicio = ?, horas = ?, detalles = ?, precio_hora = ?, total = ? WHERE id = ?");
        $stmt->bind_param("sdsddi", $servicio, $horas, $detalles, $precio_hora, $total, $id_cotizacion);
        $stmt->execute();
        $stmt->close();

        header("Location: afiliados.php");
        exit;
    }

    // --- Si es nueva cotización, crea normalmente ---
    // Obtener id_usuario e id_afiliado de la petición
    $stmt = $conexion->prepare("SELECT id_usuario, id_afiliado FROM peticiones WHERE id = ?");
    $stmt->bind_param("i", $peticion_id);
    $stmt->execute();
    $stmt->bind_result($id_usuario, $id_afiliado);
    $stmt->fetch();
    $stmt->close();

    // Insertar cotización
    $stmt = $conexion->prepare("INSERT INTO cotizaciones (id_usuario, id_afiliado, id_peticion, servicio, horas, detalles, precio_hora, total, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'pendiente')");
    $stmt->bind_param("iiisdsdd", $id_usuario, $id_afiliado, $peticion_id, $servicio, $horas, $detalles, $precio_hora, $total);
    $stmt->execute();
    if ($stmt->error) {
        die("Error MySQL: " . $stmt->error);
    }
    $id_cotizacion = $stmt->insert_id;
    $stmt->close();

    // Relacionar cotización con la petición y poner estado 'aceptada'
    $stmt = $conexion->prepare("UPDATE peticiones SET id_cotizacion = ?, estado = 'aceptada' WHERE id = ?");
    $stmt->bind_param("ii", $id_cotizacion, $peticion_id);
    $stmt->execute();
    $stmt->close();

    // --- Actualizar notificación del cliente ---
    // Obtener nombre del afiliado
    $stmt = $conexion->prepare("SELECT nombre, apellido_paterno FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id_afiliado);
    $stmt->execute();
    $stmt->bind_result($nombre_afiliado, $apellido_afiliado);
    $stmt->fetch();
    $stmt->close();

    $nombre_completo_afiliado = $nombre_afiliado . ' ' . $apellido_afiliado;
    $mensaje_pago = "El afiliado ($nombre_completo_afiliado) ya cotizó tu servicio. <a href='pago.php?id_cotizacion=$id_cotizacion'>Procede al pago</a>.";

    // Corrección Definitiva: Actualizar la notificación usando el id_peticion para ser específicos.
    // Buscar la notificación original que contiene el mensaje de contratación
    // y actualizarla con el enlace de pago
    $stmt = $conexion->prepare("UPDATE notificaciones SET mensaje = ? WHERE id_usuario = ? AND id_peticion = ? AND mensaje LIKE '%Has contratado a este afiliado%'");
    $stmt->bind_param("sii", $mensaje_pago, $id_usuario, $peticion_id);
    $stmt->execute();
    
    // Si no se encontró la notificación original, insertar una nueva
    if ($stmt->affected_rows === 0) {
        $stmt->close();
        $stmt = $conexion->prepare("INSERT INTO notificaciones (id_usuario, mensaje, leida, id_peticion) VALUES (?, ?, 0, ?)");
        $stmt->bind_param("isi", $id_usuario, $mensaje_pago, $peticion_id);
        $stmt->execute();
    }
    $stmt->close();
    

    header("Location: afiliados.php");
    exit;
}

// --- LÓGICA PARA MOSTRAR EL FORMULARIO (GET REQUEST) ---

$peticion_id = 0;
if ($editando) {
    // Si estamos editando, el peticion_id viene de la cotización guardada
    $peticion_id = $datos_cotizacion['id_peticion'] ?? 0;
} else {
    // Si es nuevo, viene del URL
    $peticion_id = isset($_GET['peticion_id']) ? intval($_GET['peticion_id']) : 0;
}
$smarty->assign('peticion_id', $peticion_id);

// --- LÓGICA PARA MOSTRAR EL FORMULARIO (GET REQUEST) ---

$es_por_hora = false; // Por defecto, no es por hora

if ($editando) {
    // Si estamos editando, es por hora si la cotización tiene un precio_hora > 0
    if (isset($datos_cotizacion['precio_hora']) && $datos_cotizacion['precio_hora'] > 0) {
        $es_por_hora = true;
    }
} elseif ($peticion_id > 0) {
    // Si es una nueva cotización, verificamos el tipo de cobro de la petición
    $stmt_tipo = $conexion->prepare("SELECT tipo_cobro FROM contrataciones WHERE id_peticion = ? LIMIT 1");
    $stmt_tipo->bind_param("i", $peticion_id);
    $stmt_tipo->execute();
    $stmt_tipo->bind_result($tipo_cobro);
    if ($stmt_tipo->fetch() && $tipo_cobro === 'por_hora') {
        $es_por_hora = true;
    }
    $stmt_tipo->close();
}

// Si es por hora (nuevo o editando), obtenemos el precio de la especialidad
if ($es_por_hora && !$editando) {
    $stmt_precio = $conexion->prepare("SELECT ph.precio_hora FROM precios_hora ph JOIN especialidades e ON ph.id_especialidad = e.id WHERE e.nombre = ?");
    $stmt_precio->bind_param("s", $servicio_afiliado);
    $stmt_precio->execute();
    $stmt_precio->bind_result($precio_hora_especialidad);
    $stmt_precio->fetch();
    $stmt_precio->close();
    $smarty->assign('precio_hora_especialidad', $precio_hora_especialidad);
}

// Lógica de desglose si hay una petición válida
if ($peticion_id > 0) {
    $total_servicios = 0;
    // Si NO es por hora, obtenemos el desglose de servicios fijos
    if (!$es_por_hora) {
        $sql_serv = "SELECT s.nombre_servicio, s.precio
                     FROM contrataciones c
                     INNER JOIN servicios s ON c.id_servicio = s.id
                     WHERE c.id_peticion = ?";
        $stmt_serv = $conexion->prepare($sql_serv);
        $stmt_serv->bind_param("i", $peticion_id);
        $stmt_serv->execute();
        $result_serv = $stmt_serv->get_result();
        $servicios_solicitados = [];
        while ($row = $result_serv->fetch_assoc()) {
            $servicios_solicitados[] = $row;
            $total_servicios += $row['precio'];
        }
        $stmt_serv->close();
        $smarty->assign('servicios_solicitados', $servicios_solicitados);
        $smarty->assign('total_servicios', $total_servicios);
    }

    // Calcular distancia (se ejecuta para AMBOS casos, por hora y fijo)
    $sql_dist = "SELECT u2.latitud as lat_cliente, u2.longitud as lon_cliente, u.latitud as lat_afiliado, u.longitud as lon_afiliado
             FROM peticiones p
             INNER JOIN usuarios2 u2 ON p.id_usuario = u2.id
             INNER JOIN usuarios u ON p.id_afiliado = u.id
             WHERE p.id = ?";
    $stmt_dist = $conexion->prepare($sql_dist);
    $stmt_dist->bind_param("i", $peticion_id);
    $stmt_dist->execute();
    $stmt_dist->bind_result($lat_cliente, $lon_cliente, $lat_afiliado, $lon_afiliado);
    $stmt_dist->fetch();
    $stmt_dist->close();

    // Definir Haversine si no existe para evitar errores
    if (!function_exists('haversine')) {
        function haversine($lat1, $lon1, $lat2, $lon2) {
             $R = 6371; // Radio de la tierra en km
             $dLat = deg2rad($lat2 - $lat1);
             $dLon = deg2rad($lon2 - $lon1);
             $a = sin($dLat/2) * sin($dLat/2) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * sin($dLon/2) * sin($dLon/2);
             $c = 2 * atan2(sqrt($a), sqrt(1-$a));
             return $R * $c;
        }
    }

        $distancia_km = 0;
        if ($lat_cliente && $lon_cliente && $lat_afiliado && $lon_afiliado) {
            $distancia_km = haversine($lat_cliente, $lon_cliente, $lat_afiliado, $lon_afiliado);
        }
        $costo_km = 20; // Puedes cambiar el costo por km aquí
        $total_distancia = $distancia_km * $costo_km;

        $total_automatico = $total_servicios + $total_distancia;

        $smarty->assign('distancia_km', round($distancia_km, 2));
        $smarty->assign('total_distancia', round($total_distancia, 2));
        $smarty->assign('total_automatico', round($total_automatico, 2));
}
$smarty->assign('es_por_hora', $es_por_hora);

$smarty->display('crear_cotizacion.tpl');