<?php
header('Content-Type: application/json');

$config = [
    'host' => 'localhost',
    'dbname' => 'servinowbd',
    'user' => 'phpmyadmin',
    'pass' => '140223'
];

try {
    $conn = new PDO(
        "mysql:host={$config['host']};dbname={$config['dbname']}",
        $config['user'],
        $config['pass']
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo json_encode([
        'success' => true,
        'message' => '✅ Conexión a la base de datos exitosa'
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'success' => false,
        'message' => '❌ Error de conexión: ' . $e->getMessage()
    ]);
}
?>