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

// Agregar comentarios de pagos a cada trabajo
foreach ($trabajos as $k => $trabajo) {
    $stmt_com = $conexion->prepare("SELECT detalle_pago, fecha FROM pagos WHERE id_cotizacion = ? AND detalle_pago IS NOT NULL AND detalle_pago != '' ORDER BY fecha DESC");
    $stmt_com->bind_param("i", $trabajo['id']);
    $stmt_com->execute();
    $res_com = $stmt_com->get_result();
    $comentarios = [];
    while ($row_com = $res_com->fetch_assoc()) {
        $comentarios[] = $row_com;
    }
    $trabajos[$k]['comentarios_pago'] = $comentarios;
    $stmt_com->close();
}

$stmt->close();
$conexion->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Trabajos</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            box-sizing: border-box;
            color: #333;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            padding: 25px 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }

        h2 {
            margin-top: 0;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .work-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .work-table th {
            background-color: #000;
            color: white;
            padding: 12px 15px;
            text-align: left;
        }

        .work-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
            vertical-align: top;
        }

        .work-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .work-table tr:hover {
            background-color: #f1f1f1;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 12px;
            font-weight: 500;
        }

        .status-pendiente {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-completado {
            background-color: #d4edda;
            color: #155724;
        }

        .status-rechazado {
            background-color: #f8d7da;
            color: #721c24;
        }

        .comments-list {
            margin: 0;
            padding-left: 15px;
        }

        .comments-list li {
            margin-bottom: 8px;
            padding-bottom: 8px;
            border-bottom: 1px dashed #ddd;
        }

        .comment-date {
            font-weight: bold;
            color: #4a4a4a;
            font-size: 13px;
        }

        .comment-text {
            color: #555;
            font-size: 14px;
        }

        .no-comments {
            color: #888;
            font-style: italic;
            font-size: 14px;
        }

        .service-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 12px;
            background-color: #e3f2fd;
            color: #1976d2;
            font-size: 13px;
            font-weight: 500;
        }

        .total-amount {
            font-weight: 600;
            color: #2e7d32;
        }

        .back-button {
            display: inline-block;
            margin-bottom: 20px;
            padding: 8px 15px;
            background-color: #000;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #5a6268;
        }

        @media (max-width: 768px) {
            .container {
                padding: 15px;
            }
            
            .work-table {
                display: block;
                overflow-x: auto;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="afiliados.php" class="back-button">← Volver</a>
        <h2>Historial de Trabajos Realizados</h2>
        
        <table class="work-table">
            <thead>
                <tr>
                    <th>Cliente</th>
                    <th>Servicio</th>
                    <th>Total</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Comentarios</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($trabajos as $trabajo): ?>
                <tr>
                    <td><?= htmlspecialchars($trabajo['cliente']) ?></td>
                    <td><span class="service-badge"><?= htmlspecialchars(ucfirst($trabajo['servicio'])) ?></span></td>
                    <td class="total-amount">$<?= number_format($trabajo['total'], 2) ?></td>
                    <td>
                        <?php 
                        $statusClass = '';
                        switch(strtolower($trabajo['estado_peticion'])) {
                            case 'completado':
                                $statusClass = 'status-completado';
                                break;
                            case 'rechazado':
                                $statusClass = 'status-rechazado';
                                break;
                            default:
                                $statusClass = 'status-pendiente';
                        }
                        ?>
                        <span class="status <?= $statusClass ?>"><?= htmlspecialchars($trabajo['estado_peticion']) ?></span>
                    </td>
                    <td><?= date('d/m/Y H:i', strtotime($trabajo['fecha'])) ?></td>
                        <td>
                            <?php if (!empty($trabajo['comentarios_pago'])): ?>
                                <ul class="comments-list">
                                <?php foreach ($trabajo['comentarios_pago'] as $comentario): ?>
                                    <?php
                                        $detalle = json_decode($comentario['detalle_pago'], true);
                                        $texto_comentario = '';
                                        if (is_array($detalle)) {
                                            // Si es pago PayPal, el comentario está en 'comentario'
                                            $texto_comentario = $detalle['comentario'] ?? '';
                                            // Si es pago en efectivo antiguo, puede estar en 'detalle'
                                            if (!$texto_comentario && isset($detalle['detalle'])) {
                                                $texto_comentario = $detalle['detalle'];
                                            }
                                        }
                                        // Si sigue vacío, mostrar el texto plano (casos antiguos)
                                        if (!$texto_comentario && is_string($comentario['detalle_pago'])) {
                                            $texto_comentario = $comentario['detalle_pago'];
                                        }
                                    ?>
                                    <li>
                                        <span class="comment-text"><?= htmlspecialchars($texto_comentario) ?></span>
                                    </li>
                                <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="no-comments">Sin comentarios</span>
                            <?php endif; ?>
                        </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
