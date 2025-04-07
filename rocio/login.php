<?php
require_once 'conexionBD.php';
session_start();


// Correcciones básicas (mínimo para que funcione):
$telefono = $_POST['telefono']; // Cambié de 'Telefono' a 'telefono'
$password = $_POST['password']; // Cambié de 'Password' a 'password'

$db = new Conexion();
$conexion = $db->getConexion();

$sql = "SELECT id, nombre, password, rol FROM usuarios WHERE telefono = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $telefono); // Añadí esta línea faltante
$stmt->execute(); // Corregí $stmt = $execute() por $stmt->execute()
$resultado = $stmt->get_result();

if ($resultado->num_rows === 1) {
    $usuario = $resultado->fetch_assoc();
    if(password_verify($password, $usuario['password'])) {
        $_SESSION['usuario'] = [
            'id' => $usuario['id'],
            'nombre' => $usuario['nombre'],
            'rol' => $usuario['rol'], // Corregí typo de $usurario
            'telefono' => $telefono
        ];
        header("Location: index.html"); // Cambié a ruta relativa
        exit;
    }
}

header("Location: login.html?error=1");
exit;
?>