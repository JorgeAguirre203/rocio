<?php
// Script para enviar mensajes automáticos cuando el afiliado no responde en 5 minutos
require_once 'conexion_jorge.php';

try {
    // Buscar mensajes no leídos del cliente al afiliado que tengan más de 5 minutos
    $sql = "SELECT m.id, m.remitente_id, m.receptor_id, m.fecha_envio
            FROM mensajes m
            WHERE m.remitente_es_afiliado = 0
            AND m.leido = 0
            AND m.fecha_envio < DATE_SUB(NOW(), INTERVAL 5 MINUTE)
            AND NOT EXISTS (
                SELECT 1 FROM mensajes m2
                WHERE m2.remitente_id = m.receptor_id
                AND m2.receptor_id = m.remitente_id
                AND m2.fecha_envio > m.fecha_envio
            )";

    $result = $conexion->query($sql);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $cliente_id = $row['remitente_id']; // Cliente que envió el mensaje
            $afiliado_id = $row['receptor_id']; // Afiliado que debe responder

            // Verificar que no se haya enviado ya un mensaje automático para esta conversación en las últimas 5 minutos
            $sql_check_auto = "SELECT COUNT(*) as count FROM mensajes
                              WHERE remitente_id = ?
                              AND receptor_id = ?
                              AND remitente_es_afiliado = 1
                              AND mensaje LIKE 'Disculpe la demora%'
                              AND fecha_envio > DATE_SUB(NOW(), INTERVAL 5 MINUTE)";

            $stmt_check = $conexion->prepare($sql_check_auto);
            $stmt_check->bind_param("ii", $afiliado_id, $cliente_id);
            $stmt_check->execute();
            $check_result = $stmt_check->get_result();
            $check_row = $check_result->fetch_assoc();

            if ($check_row['count'] == 0) {
                // Enviar mensaje automático
                $mensaje_auto = "Disculpe la demora en mi respuesta. Estoy atendiendo otros trabajos en este momento. Le responderé en los próximos 10-15 minutos. Gracias por su paciencia.";

                $sql_insert = "INSERT INTO mensajes (remitente_id, receptor_id, mensaje, remitente_es_afiliado, fecha_envio, leido)
                              VALUES (?, ?, ?, 1, NOW(), 0)";

                $stmt_insert = $conexion->prepare($sql_insert);
                $stmt_insert->bind_param("iis", $afiliado_id, $cliente_id, $mensaje_auto);
                $stmt_insert->execute();
                $stmt_insert->close();

                echo "Mensaje automático enviado de afiliado $afiliado_id a cliente $cliente_id\n";
            }

            $stmt_check->close();
        }
    }

    $result->close();

} catch (Exception $e) {
    error_log("Error en mensajes automáticos: " . $e->getMessage());
}
?>
