<?php
include 'conexion_jorge.php';
session_start();

$id_cotizacion = $_GET['id_cotizacion'] ?? null;

if (!$id_cotizacion) {
    die("Cotización no especificada.");
}

// Obtener datos de la cotización
$stmt = $conexion->prepare("SELECT c.*, u.nombre as afiliado_nombre 
                           FROM cotizaciones c
                           JOIN usuarios u ON c.id_afiliado = u.id
                           WHERE c.id = ?");
$stmt->bind_param("i", $id_cotizacion);
$stmt->execute();
$cotizacion = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$cotizacion) {
    die("Cotización no encontrada.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pagar Servicio</title>
    <script src="https://www.paypal.com/sdk/js?client-id=TU_CLIENT_ID&currency=MXN"></script>
</head>
<body>
    <h2>Detalles de la Cotización</h2>
    <p>Servicio: <?= htmlspecialchars($cotizacion['servicio']) ?></p>
    <p>Prestador: <?= htmlspecialchars($cotizacion['afiliado_nombre']) ?></p>
    <p>Horas estimadas: <?= $cotizacion['horas'] ?></p>
    <p>Precio por hora: $<?= number_format($cotizacion['precio_hora'], 2) ?> MXN</p>
    <h3>Total a pagar: $<span id="totalPago"><?= number_format($cotizacion['total'], 2) ?></span> MXN</h3>

    <div id="paypal-button-container"></div>

    <hr>
    <button onclick="mostrarPagoEfectivo()">Pagar en efectivo</button>

    <div id="pagoEfectivo" style="display:none;">
        <form id="formPagoEfectivo" method="POST" action="procesar_pago_efectivo.php">
            <input type="hidden" name="id_cotizacion" value="<?= $id_cotizacion ?>">
            <input type="hidden" name="total" value="<?= $cotizacion['total'] ?>">
            <label>Nombre:</label>
            <input type="text" name="nombre" required><br><br>
            <label>Comentarios:</label><br>
            <textarea name="detalle" rows="3"></textarea><br>
            <button type="submit">Confirmar Pago en Efectivo</button>
        </form>
    </div>

    <div id="mensaje" style="margin-top:20px; font-weight:bold;"></div>

    <script>
    const total = <?= $cotizacion['total'] ?>;
    
    paypal.Buttons({
        createOrder: (data, actions) => {
            return actions.order.create({
                purchase_units: [{
                    amount: { 
                        value: total.toFixed(2),
                        breakdown: {
                            item_total: {
                                value: total.toFixed(2),
                                currency_code: 'MXN'
                            }
                        }
                    },
                    items: [{
                        name: 'Servicio de <?= $cotizacion['servicio'] ?>',
                        unit_amount: {
                            value: total.toFixed(2),
                            currency_code: 'MXN'
                        },
                        quantity: '1'
                    }]
                }]
            });
        },
        onApprove: (data, actions) => {
            return actions.order.capture().then(details => {
                fetch('procesar_pago.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({
                        id_cotizacion: <?= $id_cotizacion ?>,
                        idOrden: details.id,
                        metodo: 'paypal',
                        monto: total
                    })
                })
                .then(res => res.json())
                .then(resp => {
                    if (resp.success) {
                        document.getElementById('mensaje').style.color = 'green';
                        document.getElementById('mensaje').textContent = 'Pago registrado exitosamente.';
                        setTimeout(() => {
                            window.location.href = 'dashboard_servicios.php';
                        }, 2000);
                    } else {
                        document.getElementById('mensaje').style.color = 'red';
                        document.getElementById('mensaje').textContent = 'Error: ' + resp.message;
                    }
                });
            });
        },
        onError: err => {
            document.getElementById('mensaje').style.color = 'red';
            document.getElementById('mensaje').textContent = 'Error en el pago: ' + err.message;
        }
    }).render('#paypal-button-container');

    function mostrarPagoEfectivo() {
        document.getElementById('pagoEfectivo').style.display = 'block';
    }
    </script>
</body>
</html>