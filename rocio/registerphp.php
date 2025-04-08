<?php
// register.php

header('Content-Type: application/json');

// Configuración de la base de datos
$host = 'localhost';
$dbname = 'servinow_jorge';
$username = 'root';
$password = '1234';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Procesar datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar y sanitizar datos
    $name = trim($_POST['name'] ?? '');
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    $rol = 'cliente'; // Valor por defecto, puedes cambiarlo según tu lógica
    
    // Validaciones
    $errors = [];
    
    // Validar nombre completo (separar en nombre, apellido paterno y materno)
    if (empty($name)) {
        $errors['name'] = 'El nombre completo es requerido';
    } else {
        $nameParts = explode(' ', $name);
        $nombre = $nameParts[0] ?? '';
        $apellido_paterno = $nameParts[1] ?? '';
        $apellido_materno = $nameParts[2] ?? '';
        
        if (empty($nombre) || empty($apellido_paterno)) {
            $errors['name'] = 'Debe ingresar al menos nombre y apellido paterno';
        }
    }
    
    // Validar email
    if (empty($email)) {
        $errors['email'] = 'El correo electrónico es requerido';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'El correo electrónico no es válido';
    } else {
        // Verificar si el email ya existe
        $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors['email'] = 'Este correo electrónico ya está registrado';
        }
    }
    
    // Validar teléfono
    if (empty($phone)) {
        $errors['phone'] = 'El número de teléfono es requerido';
    } elseif (!preg_match('/^\+?\d{8,15}$/', $phone)) {
        $errors['phone'] = 'El número de teléfono no es válido';
    }
    
    // Validar contraseña
    if (empty($password)) {
        $errors['password'] = 'La contraseña es requerida';
    } elseif (strlen($password) < 8) {
        $errors['password'] = 'La contraseña debe tener al menos 8 caracteres';
    } elseif (!preg_match('/[A-Z]/', $password) || 
               !preg_match('/[a-z]/', $password) || 
               !preg_match('/[0-9]/', $password) || 
               !preg_match('/[^A-Za-z0-9]/', $password)) {
        $errors['password'] = 'La contraseña debe incluir mayúsculas, minúsculas, números y un carácter especial';
    }
    
    // Validar confirmación de contraseña
    if ($password !== $confirm_password) {
        $errors['confirm-password'] = 'Las contraseñas no coinciden';
    }
    
    // Si no hay errores, proceder con el registro
    if (empty($errors)) {
        try {
            // Hashear la contraseña
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            // Insertar en la base de datos
            $stmt = $conn->prepare("
                INSERT INTO usuarios 
                (nombre, apellido_paterno, apellido_materno, email, password, rol, telefono, fecha_registro) 
                VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
            ");
            
            $stmt->execute([
                $nombre,
                $apellido_paterno,
                $apellido_materno,
                $email,
                $hashed_password,
                $rol,
                $phone
            ]);
            
            echo json_encode([
                'success' => true, 
                'message' => 'Registro exitoso. Bienvenido/a ' . $nombre
            ]);
            
        } catch(PDOException $e) {
            echo json_encode([
                'success' => false, 
                'message' => 'Error al registrar el usuario: ' . $e->getMessage()
            ]);
        }
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Por favor corrige los errores en el formulario',
            'errors' => $errors
        ]);
    }
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Método no permitido'
    ]);
}
?>
