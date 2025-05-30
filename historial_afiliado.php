<?php
include 'conexion_jorge.php';
session_start();

if (!isset($_SESSION['afiliado'])) {
    header("Location: login.php");
    exit;
}

$id_afiliado = $_SESSION['afiliado']['id'];

$stmt = $conexion->prepare("SELECT c.*, p.estado as estado_peticion, u.nombre as cliente
                            FROM cotizaciones c
                            JOIN peticiones p ON c.id = p.id_cotizacion
                            JOIN usuarios2 u ON c.id_usuario = u.id
                            WHERE c.id_afiliado = ?
                            ORDER BY c.id DESC");
$stmt->bind_param("i", $id_afiliado);
$stmt->execute();
$result = $stmt->get_result();

$trabajos = [];
while ($row = $result->fetch_assoc()) {
    $trabajos[] = $row;
}
$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Trabajos</title>
</head>
<body>
    <h2>Historial de Trabajos Realizados</h2>
    <table border="1">
        <tr>
            <th>Cliente</th>
            <th>Servicio</th>
            <th>Total</th>
            <th>Estado</th>
            <th>Fecha</th>
        </tr>
        <?php foreach ($trabajos as $trabajo): ?>
        <tr>
            <td><?= htmlspecialchars($trabajo['cliente']) ?></td>
            <td><?= htmlspecialchars($trabajo['servicio']) ?></td>
            <td>$<?= number_format($trabajo['total'], 2) ?></td>
            <td><?= htmlspecialchars($trabajo['estado_peticion']) ?></td>
            <td><?= htmlspecialchars($trabajo['fecha']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>