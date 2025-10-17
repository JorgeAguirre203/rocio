<?php
require_once 'conexion_jorge.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$id_cotizacion = $_GET['id_cotizacion'] ?? null;
if (!$id_cotizacion) {
    die("Cotización no especificada.");
}

// Obtener afiliado y cliente de la cotización
$stmt = $conexion->prepare("SELECT c.id_usuario, c.id_afiliado, u.nombre as nombre_afiliado 
                           FROM cotizaciones c
                           JOIN usuarios u ON c.id_afiliado = u.id
                           WHERE c.id = ?");
$stmt->bind_param("i", $id_cotizacion);
$stmt->execute();
$stmt->bind_result($id_cliente, $id_afiliado, $nombre_afiliado);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['estrellas'])) {
    $estrellas = intval($_POST['estrellas']);
    
    if ($estrellas < 1 || $estrellas > 5) {
        die("Calificación inválida.");
    }
    
    $stmt = $conexion->prepare("INSERT INTO calificaciones (id_cliente, id_afiliado, estrellas) VALUES (?, ?, ?)");
    $stmt->bind_param("iii", $id_cliente, $id_afiliado, $estrellas);
    $stmt->execute();
    $stmt->close();
    header("Location: dashboard_servicios.php?msg=¡Gracias por tu calificación!");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calificar Afiliado</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
        }

        .rating-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-top: 0;
            margin-bottom: 20px;
        }

        .afiliado-info {
            font-size: 18px;
            margin-bottom: 30px;
            color: #4a4a4a;
        }

        .rating-title {
            font-size: 16px;
            color: #555;
            margin-bottom: 15px;
        }

        .star-rating {
            direction: rtl;
            unicode-bidi: bidi-override;
            display: inline-block;
            margin-bottom: 30px;
        }
        .star-rating input {
            display: none;
        }
        .star-rating label {
            font-size: 2.5em;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
            padding: 0 5px;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f5b301;
        }
        .star-rating input:checked ~ label {
            color: #f5b301;
        }

        .submit-btn {
            background-color: #4a4a4a;
            color: white;
            border: none;
            padding: 12px 25px;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        .submit-btn:hover {
            background-color: #333;
        }

        .rating-description {
            margin-top: 15px;
            font-size: 14px;
            color: #777;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="rating-container">
        <h2>Califica al Afiliado</h2>
        <div class="afiliado-info">
            Estás calificando a: <strong><?= htmlspecialchars($nombre_afiliado) ?></strong>
        </div>
        
        <form method="post">
            <div class="rating-title">Selecciona la cantidad de estrellas:</div>
            
            <div class="star-rating">
                <input type="radio" id="5-stars" name="estrellas" value="5" required>
                <label for="5-stars" title="5 estrellas">★</label>
                <input type="radio" id="4-stars" name="estrellas" value="4">
                <label for="4-stars" title="4 estrellas">★</label>
                <input type="radio" id="3-stars" name="estrellas" value="3">
                <label for="3-stars" title="3 estrellas">★</label>
                <input type="radio" id="2-stars" name="estrellas" value="2">
                <label for="2-stars" title="2 estrellas">★</label>
                <input type="radio" id="1-star" name="estrellas" value="1">
                <label for="1-star" title="1 estrella">★</label>
            </div>
            
            <div class="rating-description">
                1 = Muy malo, 5 = Excelente
            </div>
            
            <button type="submit" class="submit-btn">Enviar Calificación</button>
        </form>
    </div>
</body>
</html>