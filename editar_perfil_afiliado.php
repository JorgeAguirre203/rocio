<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require_once 'conexion_jorge.php';
require_once 'libs/Smarty.class.php';

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['afiliado']['id'];
$mensaje = '';

// Obtener datos actuales
$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$afiliado = $result->fetch_assoc();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger datos del formulario
    $nombre = trim($_POST['nombre']);
    $apellido_paterno = trim($_POST['apellido_paterno']);
    $apellido_materno = trim($_POST['apellido_materno']);
    $nickname = trim($_POST['nickname']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $especialidad = trim($_POST['especialidad']);

    // Configurar rutas de archivos
    $base_dir = "uploads/usuarios/$id/";
    $perfil_dir = $base_dir . "perfil/";
    
    // Crear directorios si no existen
    if (!is_dir($perfil_dir)) {
        mkdir($perfil_dir, 0755, true);
    }

    // Manejo de la foto de perfil
    $ruta_foto = $afiliado['foto_perfil'] ?? ''; // Mantener la existente por defecto
    
    if (!empty($_FILES['foto_perfil']['name'])) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['foto_perfil']['type'];
        
        if (!in_array($file_type, $allowed_types)) {
            $mensaje = "Error: Solo se permiten imágenes JPEG, PNG o GIF";
        } else {
            // Eliminar foto anterior si existe
            if (!empty($afiliado['foto_perfil']) && file_exists($afiliado['foto_perfil'])) {
                @unlink($afiliado['foto_perfil']);
            }
            
            // Generar nuevo nombre de archivo
            $file_ext = strtolower(pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION));
            $new_filename = 'perfil_' . uniqid() . '.' . $file_ext;
            $ruta_foto = $perfil_dir . $new_filename;
            
            // Mover el archivo subido
            if (move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $ruta_foto)) {
                // Éxito al subir
            } else {
                $mensaje = "Error al subir la nueva imagen de perfil";
                $ruta_foto = $afiliado['foto_perfil']; // Revertir a la anterior
            }
        }
    }

    // Actualizar en base de datos
    $sql = "UPDATE usuarios SET 
            nombre = ?, 
            apellido_paterno = ?, 
            apellido_materno = ?, 
            nickname = ?, 
            email = ?, 
            telefono = ?, 
            especialidad = ?, 
            foto_perfil = ? 
            WHERE id = ?";
    
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssssssi", 
        $nombre,
        $apellido_paterno,
        $apellido_materno,
        $nickname,
        $email,
        $telefono,
        $especialidad,
        $ruta_foto,
        $id
    );

    if ($stmt->execute()) {
        $mensaje = "Perfil actualizado correctamente";
        // Actualizar datos en sesión
        $_SESSION['afiliado'] = array_merge($_SESSION['afiliado'], [
            'nombre' => $nombre,
            'apellido_paterno' => $apellido_paterno,
            'apellido_materno' => $apellido_materno,
            'nickname' => $nickname,
            'email' => $email,
            'foto_perfil' => $ruta_foto
        ]);
        
        // Refrescar datos para la vista
        $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $afiliado = $result->fetch_assoc();
        $stmt->close();
    } else {
        $mensaje = "Error al actualizar el perfil: " . $stmt->error;
    }
}

// Configurar Smarty y mostrar template
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');
$smarty->assign('afiliado', $afiliado);
$smarty->assign('mensaje', $mensaje);
$smarty->display('editar_perfil_afiliado.tpl');
?>