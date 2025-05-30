<?php
include 'conexion_jorge.php';
session_start();

// Verificar autenticación
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$id_cotizacion = $_GET['id_cotizacion'] ?? null;

if (!$id_cotizacion) {
    die("Cotización no especificada.");
}

// Obtener datos de la cotización
$stmt = $conexion->prepare("SELECT c.*, u.nombre as afiliado_nombre 
                           FROM cotizaciones c
                           JOIN usuarios u ON c.id_afiliado = u.id
                           WHERE c.id = ? AND c.id_usuario = ?");
$stmt->bind_param("ii", $id_cotizacion, $_SESSION['usuario']['id']);
$stmt->execute();
$cotizacion = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$cotizacion) {
    die("Cotización no encontrada o no tienes permiso para verla.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagar Servicio</title>
    <meta http-equiv="Content-Security-Policy" content="script-src 'self' https://www.paypal.com https://www.paypalobjects.com 'unsafe-inline'">
    <!-- SDK PayPal con tu Client ID real -->
    <script src="https://www.paypal.com/sdk/js?client-id=AUcZh8X69tSFeppD0hTuPaPR-hquMLqHIVtlqWzmJsM68KCIx20SsoiLJwVEyuauLHIfcetpEKxC77bP&currency=MXN&intent=capture&commit=true&components=buttons"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        #paypal-button-container {
            min-height: 200px;
            margin: 30px 0;
            border: 1px solid #eee;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .payment-option {
            margin: 20px 0;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        .status-message {
            padding: 15px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
    <h1>Completar Pago</h1>
    
    <div class="payment-details">
        <h2>Detalles del Servicio</h2>
        <p><strong>Tipo:</strong> <?= htmlspecialchars(ucfirst($cotizacion['servicio'])) ?></p>
        <p><strong>Proveedor:</strong> <?= htmlspecialchars($cotizacion['afiliado_nombre']) ?></p>
        <p><strong>Total:</strong> $<?= number_format($cotizacion['total'], 2) ?> MXN</p>
    </div>

    <div class="payment-option">
        <h3>Pago con PayPal</h3>
        <div id="paypal-button-container">
            
        </div>
    </div>
    
    <div class="payment-option">
        <h3>Pago en efectivo</h3>
        <form action="procesar_pago_efectivo.php" method="post">
            <input type="hidden" name="id_cotizacion" value="<?= htmlspecialchars($cotizacion['id']) ?>">
            <input type="hidden" name="total" value="<?= htmlspecialchars($cotizacion['total']) ?>">
            <label>Tu nombre:</label>
            <input type="text" name="nombre" required>
            <label>Comentario:</label>
            <input type="text" name="detalle">
            <button type="submit">Pagar en efectivo</button>
        </form>
        <p>Por favor, completa el pago con el prestador del servicio.</p>
    </div>

    <div id="payment-status" class="status-message"></div>

    <script>
    // Configuración de PayPal
    function initPayPal() {
        try {
            if (typeof paypal === 'undefined') {
                throw new Error('El SDK de PayPal no se cargó correctamente');
            }

            const totalAmount = Number(<?= json_encode($cotizacion['total']) ?>);
            
            paypal.Buttons({
                style: {
                    layout: 'vertical',
                    color: 'blue',
                    shape: 'rect',
                    label: 'paypal'
                },
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: {
                                value: totalAmount.toFixed(2),
                                currency_code: 'MXN',
                                breakdown: {
                                    item_total: {
                                        value: totalAmount.toFixed(2),
                                        currency_code: 'MXN'
                                    }
                                }
                            },
                            items: [{
                                name: 'Servicio de <?= $cotizacion['servicio'] ?>',
                                unit_amount: {
                                    value: totalAmount.toFixed(2),
                                    currency_code: 'MXN'
                                },
                                quantity: '1'
                            }]
                        }],
                        application_context: {
                            shipping_preference: 'NO_SHIPPING'
                        }
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        // Mostrar mensaje de procesamiento
                        document.getElementById('payment-status').className = 'status-message';
                        document.getElementById('payment-status').textContent = 'Procesando pago...';
                        
                        // Enviar datos al servidor
                        return fetch('procesar_pago.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                id_cotizacion: <?= $id_cotizacion ?>,
                                idOrden: data.orderID,
                                metodo: 'paypal',
                                monto: totalAmount,
                                detalles: details
                            })
                        })
                        .then(function(res) {
                            return res.json();
                        })
                        .then(function(data) {
                            if (data.success) {
                                document.getElementById('payment-status').className = 'status-message success';
                                document.getElementById('payment-status').textContent = '¡Pago completado con éxito! Redirigiendo...';
                                setTimeout(function() {
                                    window.location.href = 'comprobante.php?id=' + data.id_pago;
                                }, 2000);
                            } else {
                                throw new Error(data.message || 'Error al procesar el pago');
                            }
                        });
                    });
                },
                onError: function(err) {
                    console.error('Error PayPal:', err);
                    document.getElementById('payment-status').className = 'status-message error';
                    document.getElementById('payment-status').textContent = 'Error en el pago: ' + err.message;
                },
                onCancel: function(data) {
                    document.getElementById('payment-status').className = 'status-message';
                    document.getElementById('payment-status').textContent = 'Pago cancelado por el usuario';
                }
            }).render('#paypal-button-container');
            
        } catch (error) {
            console.error('Error inicializando PayPal:', error);
            document.getElementById('paypal-button-container').innerHTML = `
                <div class="status-message error">
                    <p>Error al cargar PayPal: ${error.message}</p>
                    <p>Por favor intenta:</p>
                    <ul>
                        <li>Recargar la página</li>
                        <li>Usar otro navegador</li>
                        <li>Verificar tu conexión a internet</li>
                    </ul>
                </div>`;
        }
    }

    // Inicializar PayPal cuando el SDK esté listo
    if (typeof paypal !== 'undefined') {
        initPayPal();
    } else {
        // Si no está cargado, esperar y reintentar
        let paypalRetries = 0;
        const paypalInterval = setInterval(function() {
            if (typeof paypal !== 'undefined') {
                clearInterval(paypalInterval);
                initPayPal();
            } else if (paypalRetries > 10) {
                clearInterval(paypalInterval);
                document.getElementById('paypal-button-container').innerHTML = `
                    <div class="status-message error">
                        No se pudo cargar PayPal después de varios intentos
                    </div>`;
            }
            paypalRetries++;
        }, 500);
    }
    </script>
</body>
</html>