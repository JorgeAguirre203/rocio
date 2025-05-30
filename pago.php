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
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            box-sizing: border-box;
            color: #333;
        }

        .payment-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        h1 {
            margin-top: 0;
            color: #2c3e50;
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .payment-details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        .payment-details h2 {
            margin-top: 0;
            color: #2c3e50;
        }

        .payment-details p {
            margin: 8px 0;
        }

        .payment-details strong {
            color: #4a4a4a;
            min-width: 120px;
            display: inline-block;
        }

        .payment-option {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 8px;
            background-color: #fff;
            border: 1px solid #eee;
        }

        .payment-option h3 {
            margin-top: 0;
            color: #2c3e50;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        #paypal-button-container {
            min-height: 150px;
            margin: 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px dashed #eee;
            border-radius: 8px;
            padding: 20px;
        }

        .cash-form {
            margin-top: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: 500;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 15px;
            transition: border 0.3s;
        }

        .form-group textarea {
            min-height: 100px;
            resize: vertical;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4a4a4a;
            box-shadow: 0 0 0 2px rgba(74, 74, 74, 0.1);
        }

        .btn {
            background-color: #4a4a4a;
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn:hover {
            background-color: #333;
        }

        .btn-cash {
            background-color: #28a745;
        }

        .btn-cash:hover {
            background-color: #218838;
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
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .info-note {
            background-color: #e7f5fe;
            color: #0c5460;
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #bee5eb;
            margin-top: 15px;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .payment-container {
                padding: 20px;
            }
            
            .payment-details p {
                display: flex;
                flex-direction: column;
            }
            
            .payment-details strong {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <div class="payment-container">
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
                <p>Cargando opciones de pago...</p>
            </div>
        </div>
        
        <div class="payment-option">
            <h3>Pago en efectivo</h3>
            <div class="cash-form">
                <form action="procesar_pago_efectivo.php" method="post">
                    <input type="hidden" name="id_cotizacion" value="<?= htmlspecialchars($cotizacion['id']) ?>">
                    <input type="hidden" name="total" value="<?= htmlspecialchars($cotizacion['total']) ?>">
                    
                    <div class="form-group">
                        <label for="nombre">Tu nombre completo:</label>
                        <input type="text" name="nombre" id="nombre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="detalle">Comentarios adicionales:</label>
                        <textarea name="detalle" id="detalle" placeholder="Ej. Horario preferido para el pago, instrucciones especiales, etc."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-cash">Confirmar Pago en Efectivo</button>
                </form>
            </div>
            <div class="info-note">
                <strong>Nota:</strong> Al seleccionar pago en efectivo, deberás coordinar directamente con el prestador del servicio la forma y momento del pago.
            </div>
        </div>

        <div id="payment-status" class="status-message"></div>
    </div>

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
                                    window.location.href = 'calificar_afiliado.php?id_cotizacion=<?= $id_cotizacion ?>';
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