<?php
session_start();
require_once 'conexion_jorge.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.html");
    exit;
}

$id = $_SESSION['usuario']['id'];
$nombre_actual = $_SESSION['usuario']['nombre'];
$nickname_actual = $_SESSION['usuario']['nickname'];

// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nuevo_nombre = $_POST['nombre'] ?? '';
    $nuevo_nickname = $_POST['nickname'] ?? '';

    if (!empty($nuevo_nombre) && !empty($nuevo_nickname)) {
        $stmt = $conexion->prepare("UPDATE usuarios2 SET nombre = ?, nickname = ? WHERE id = ?");
        $stmt->bind_param("ssi", $nuevo_nombre, $nuevo_nickname, $id);
        if ($stmt->execute()) {
            // Actualizar los datos de sesión
            $_SESSION['usuario']['nombre'] = $nuevo_nombre;
            $_SESSION['usuario']['nickname'] = $nuevo_nickname;

            echo "<script>alert('Datos actualizados correctamente.');
            window.location.href='bienvenida.php';</script>";
            exit;
        } else {
            $error = "Error al actualizar los datos.";
        }
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px #ccc;
        }

        h2 {
            margin-top: 0;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4a4a4a;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

    </style>
</head>
<body>
    <div class="form-container">
        <h2>Editar Perfil</h2>
        <?php if (!empty($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <label>Nombre:</label>
            <input type="text" name="nombre" value="<?php echo htmlspecialchars($nombre_actual); ?>" required>

            <label>Nickname:</label>
            <input type="text" name="nickname" value="<?php echo htmlspecialchars($nickname_actual); ?>" required>

            <button type="submit">Guardar cambios</button>
        </form>
    </div>
</body>
</html>

