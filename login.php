<?php
session_start();
require_once 'libs/Smarty.class.php';
require_once 'conexion_jorge.php';

$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');
$smarty->setCacheDir('cache/');

// Verificar si ya está logueado
if (isset($_SESSION['usuario'])) {
    header("Location: dashboard_servicios.php");
    exit;
}

// Procesar formulario de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (empty($email) || empty($password)) {
        $smarty->assign('error', 'Por favor ingresa ambos campos');
    } else {
        // 1. Verificar si es admin
        $stmt_admin = $conexion->prepare("SELECT id, nombre, contrasena FROM admins WHERE nombre = ?");
        $stmt_admin->bind_param("s", $email);
        $stmt_admin->execute();
        $resultado_admin = $stmt_admin->get_result();

        if ($resultado_admin->num_rows === 1) {
            $admin = $resultado_admin->fetch_assoc();
            if (
                password_verify($password, $admin['contrasena']) ||
                $password === $admin['contrasena']
            ) {
                $_SESSION['admin'] = [
                    'id' => $admin['id'],
                    'nombre' => $admin['nombre']
                ];
                header("Location: loginAfiliados.php");
                exit;
            } else {
                $smarty->assign('error', 'Usuario no encontrado o contraseña incorrecta');
            }
        } else {
            // 2. Si no es admin, buscar en usuarios2
            $stmt = $conexion->prepare("SELECT id, nombre, email, password, nickname FROM usuarios2 WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $resultado = $stmt->get_result();

            if ($resultado->num_rows === 1) {
                $usuario = $resultado->fetch_assoc();

                if (password_verify($password, $usuario['password'])) {
                    $_SESSION['usuario'] = [
                        'id' => $usuario['id'],
                        'nombre' => $usuario['nombre'],
                        'nickname' => $usuario['nickname'],
                        'email' => $usuario['email']
                    ];
                    header("Location: dashboard_servicios.php");
                    exit;
                } else {
                    $smarty->assign('error', 'Contraseña incorrecta');
                }
            } else {
                // 3. Si no está en usuarios2, buscar en usuarios (afiliados)
                $stmt_afiliado = $conexion->prepare("SELECT id, nombre, apellido_paterno, apellido_materno, email, password, nickname FROM usuarios WHERE email = ?");
                $stmt_afiliado->bind_param("s", $email);
                $stmt_afiliado->execute();
                $resultado_afiliado = $stmt_afiliado->get_result();

                if ($resultado_afiliado->num_rows === 1) {
                    $afiliado = $resultado_afiliado->fetch_assoc();

                    if (password_verify($password, $afiliado['password'])) {
                        $_SESSION['afiliado'] = [
                            'id' => $afiliado['id'],
                            'nombre' => $afiliado['nombre'],
                            'apellido_paterno' => $afiliado['apellido_paterno'],
                            'apellido_materno' => $afiliado['apellido_materno'],
                            'nickname' => $afiliado['nickname'],
                            'email' => $afiliado['email']
                        ];
                        // Depuración: loguea el id del afiliado
                        error_log("Login afiliado: id=" . $afiliado['id']);
                        header("Location: afiliados.php");
                        exit;
                    } else {
                        $smarty->assign('error', 'Contraseña incorrecta');
                    }
                } else {
                    $smarty->assign('error', 'Usuario no encontrado');
                }
            }
        }
    }
}

// Asignar variables para la plantilla
$smarty->assign([
    'page_title' => 'Iniciar Sesión',
    'logo_text' => 'Servi Now',
    'form_action' => 'login.php',
    'register_link' => 'registrar_usuario.php',
    'home_link' => 'index.php'
]);

// Mostrar plantilla
$smarty->display('login.tpl');
?>