<?php
require_once 'libs/Smarty.class.php';

// Configurar Smarty
$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "servinow_jorge";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    $smarty->assign('error', "Conexión fallida: " . $conn->connect_error);
    $smarty->display('error.tpl');
    exit;
}

// Procesar formulario si se envió
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $apellido_paterno = $_POST['apellido_paterno'] ?? '';
    $apellido_materno = $_POST['apellido_materno'] ?? '';
    $nickname = $_POST['nickname'] ?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email = $_POST['email'] ?? '';
    $email_confirm = $_POST['email_confirm'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm-password'] ?? '';
    $especialidad = $_POST['especialidad'] ?? '';
    
    // Validaciones
    $errors = [];
    
    // Validar campos obligatorios
    $required_fields = [
        'nombre' => 'Nombre',
        'apellido_paterno' => 'Apellido Paterno',
        'apellido_materno' => 'Apellido Materno',
        'nickname' => 'Nickname',
        'telefono' => 'Teléfono',
        'email' => 'Correo electrónico',
        'email_confirm' => 'Confirmación de correo',
        'password' => 'Contraseña',
        'confirm-password' => 'Confirmar Contraseña',
        'especialidad' => 'Especialidad'
    ];
    
    foreach ($required_fields as $field => $name) {
        if (empty($_POST[$field])) {
            $errors[] = "El campo $name es obligatorio";
        }
    }
    
    // Validar coincidencia de correos
    if ($email !== $email_confirm) {
        $errors[] = "Los correos electrónicos no coinciden";
    }
    
    // Validar coincidencia de contraseñas
    if ($password !== $confirmPassword) {
        $errors[] = "Las contraseñas no coinciden";
    }
    
    // Validar email único
    if (empty($errors)) {
        $sql_check = "SELECT email FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($sql_check);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "El correo electrónico ya está registrado";
        }
    }

    // Si no hay errores, registrar usuario (sin archivos aún)
    $id_usuario = null;
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        $sql_insert = "INSERT INTO usuarios (
            nombre, 
            apellido_paterno, 
            apellido_materno, 
            nickname, 
            email, 
            telefono, 
            password, 
            especialidad, 
            foto_perfil, 
            ine_frente, 
            ine_reverso
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, '', '', '')";

        $stmt = $conn->prepare($sql_insert);
        $stmt->bind_param(
            "ssssssss", 
            $nombre, 
            $apellido_paterno, 
            $apellido_materno, 
            $nickname, 
            $email, 
            $telefono, 
            $hashedPassword, 
            $especialidad
        );
        
        if ($stmt->execute()) {
            $id_usuario = $stmt->insert_id;
        } else {
            $errors[] = "Error al registrar el usuario: " . $conn->error;
        }
    }

    // Procesar archivos subidos y actualizar rutas en la base de datos
    if (empty($errors) && $id_usuario) {
        // Crear estructura de carpetas
        $base_dir = "uploads/usuarios/$id_usuario/";
        $perfil_dir = $base_dir . "perfil/";
        $ine_frente_dir = $base_dir . "ine_frente/";
        $ine_reverso_dir = $base_dir . "ine_reverso/";

        foreach ([$perfil_dir, $ine_frente_dir, $ine_reverso_dir] as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }

        // Procesar foto de perfil
        $foto_perfil = '';
        if (!empty($_FILES['foto_perfil']['name'])) {
            $foto_perfil = procesarArchivo('foto_perfil', $perfil_dir, ['jpg', 'jpeg', 'png'], 5000000);
            if ($foto_perfil === false) {
                $errors[] = "Error al subir la foto de perfil (solo JPG/JPEG/PNG, máximo 5MB)";
            }
        } else {
            $errors[] = "La foto de perfil es requerida";
        }

        // Procesar INE frente
        $ine_frente = '';
        if (!empty($_FILES['ine_frente']['name'])) {
            $ine_frente = procesarArchivo('ine_frente', $ine_frente_dir, ['jpg', 'jpeg', 'png', 'pdf'], 6000000);
            if ($ine_frente === false) {
                $errors[] = "Error al subir el INE (frente) (solo JPG/JPEG/PNG/PDF, máximo 6MB)";
            }
        } else {
            $errors[] = "El INE (frente) es requerido";
        }

        // Procesar INE reverso
        $ine_reverso = '';
        if (!empty($_FILES['ine_reverso']['name'])) {
            $ine_reverso = procesarArchivo('ine_reverso', $ine_reverso_dir, ['jpg', 'jpeg', 'png', 'pdf'], 6000000);
            if ($ine_reverso === false) {
                $errors[] = "Error al subir el INE (reverso) (solo JPG/JPEG/PNG/PDF, máximo 6MB)";
            }
        } else {
            $errors[] = "El INE (reverso) es requerido";
        }

        // Si no hubo errores de archivos, actualiza las rutas en la base de datos
        if (empty($errors)) {
            $sql_update = "UPDATE usuarios SET foto_perfil=?, ine_frente=?, ine_reverso=? WHERE id=?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("sssi", $foto_perfil, $ine_frente, $ine_reverso, $id_usuario);
            $stmt_update->execute();
            $stmt_update->close();

            header("Location: login.php?msg=Registro exitoso. Ahora puedes iniciar sesión.");
            exit;
        }
    }

    // Si hay errores, mostrarlos
    if (!empty($errors)) {
        $smarty->assign('errors', $errors);
        $smarty->assign('form_data', $_POST);
    }
}

// Función para procesar archivos subidos
function procesarArchivo($field_name, $upload_dir, $allowed_types, $max_size) {
    $file = $_FILES[$field_name];
    $file_ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    // Validar tipo de archivo
    if (!in_array($file_ext, $allowed_types)) {
        return false;
    }
    
    // Validar tamaño
    if ($file['size'] > $max_size) {
        return false;
    }
    
    // Generar nombre único
    $new_filename = uniqid() . '.' . $file_ext;
    $destination = $upload_dir . $new_filename;
    
    // Mover archivo
    if (move_uploaded_file($file['tmp_name'], $destination)) {
        return $destination;
    }
    
    return false;
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Registro - Servi Now',
    'logo_text' => 'Servi Now',
    'form_action' => 'registrar_jorge.php',
    'login_link' => 'login.php',
    'home_link' => 'index.php',
    'especialidades' => [
        'albanileria' => 'Albañilería',
        'plomeria' => 'Plomería',
        'carpinteria' => 'Carpintería',
        'electricidad' => 'Electricidad'
    ]
]);

// Mostrar plantilla
$smarty->display('register_jorge.tpl');

$conn->close();
?>