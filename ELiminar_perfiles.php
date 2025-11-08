<?php
session_start();
require_once 'conexion_jorge.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id_usuario = $_SESSION['usuario']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar el formulario
    $razon = $_POST['razon'];
    if (!empty($_POST['otra_razon'])) {
        $razon = $_POST['otra_razon'];
    }

    // Insertar la razón en la base de datos
    $sql_insert = "INSERT INTO razones_eliminacion_clientes (id_usuario, razon) VALUES (?, ?)";
    $stmt_insert = $conexion->prepare($sql_insert);
    $stmt_insert->bind_param("is", $id_usuario, $razon);
    $stmt_insert->execute();
    $stmt_insert->close();

    // Eliminar la cuenta
    $sql_delete = "DELETE FROM usuarios2 WHERE id = ?";
    $stmt_delete = $conexion->prepare($sql_delete);
    $stmt_delete->bind_param("i", $id_usuario);

    if ($stmt_delete->execute()) {
        session_destroy();
        header("Location: login.html?mensaje=Cuenta eliminada exitosamente");
        exit;
    } else {
        echo "Error al eliminar la cuenta: " . $conexion->error;
    }

    $stmt_delete->close();
} else {
    // Mostrar el formulario
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Eliminar Cuenta</title>
        <style>
            body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0; display: flex; justify-content: center; align-items: center; height: 100vh; }
            .container { background-color: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); width: 400px; }
            h2 { text-align: center; color: #333; }
            label { display: block; margin-bottom: 8px; color: #555; }
            select, textarea { width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; }
            button { width: 100%; padding: 10px; background-color: #dc3545; color: white; border: none; border-radius: 4px; cursor: pointer; margin-bottom: 10px; }
            button:hover { background-color: #c82333; }
            .cancelar { background-color: #6c757d !important; }
            .cancelar:hover { background-color: #5a6268 !important; }
            .otra-razon { display: none; }
        </style>
        <script>
            function mostrarOtraRazon() {
                var select = document.getElementById('razon');
                var otra = document.getElementById('otra_razon_container');
                if (select.value === 'otros') {
                    otra.style.display = 'block';
                } else {
                    otra.style.display = 'none';
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <h2>¿Por qué deseas eliminar tu cuenta?</h2>
            <form method="POST" action="">
                <label for="razon">Selecciona una razón:</label>
                <select name="razon" id="razon" onchange="mostrarOtraRazon()" required>
                    <option value="">Selecciona una opción</option>
                    <option value="No estoy satisfecho con el servicio">No estoy satisfecho con el servicio</option>
                    <option value="Problemas de privacidad">Problemas de privacidad</option>
                    <option value="Quiero crear una nueva cuenta">Quiero crear una nueva cuenta</option>
                    <option value="No uso la aplicación">No uso la aplicación</option>
                    <option value="Problemas técnicos">Problemas técnicos</option>
                    <option value="otros">Otros</option>
                </select>

                <div id="otra_razon_container" class="otra-razon">
                    <label for="otra_razon">Especifica la razón:</label>
                    <textarea name="otra_razon" id="otra_razon" rows="4" placeholder="Describe la razón..."></textarea>
                </div>

                <button type="submit">Eliminar Cuenta</button>
                <a href="login.php"><button type="button" class="cancelar">Cancelar</button></a>
            </form>
        </div>
    </body>
    </html>
    <?php
}

$conexion->close();
?>
