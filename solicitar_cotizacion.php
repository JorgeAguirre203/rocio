<?php
require_once 'conexion_jorge.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['peticion_id'], $_POST['descripcion'])) {
    $peticion_id = intval($_POST['peticion_id']);
    $descripcion = trim($_POST['descripcion']);
    // Guarda la descripción y cambia el estado
    $stmt = $conexion->prepare("UPDATE peticiones SET descripcion = ?, estado = 'esperando_cotizacion' WHERE id = ?");
    $stmt->bind_param("si", $descripcion, $peticion_id);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard_servicios.php?msg=Solicitud enviada");
    exit;
}

$peticion_id = isset($_GET['peticion_id']) ? intval($_GET['peticion_id']) : 0;
?>
<form method="post">
    <input type="hidden" name="peticion_id" value="<?php echo $peticion_id; ?>">
    <label>Describe tu necesidad:</label>
    <textarea name="descripcion" required></textarea>
    <button type="submit">Enviar solicitud</button>
</form>