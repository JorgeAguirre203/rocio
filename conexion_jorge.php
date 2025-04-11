<?php
$host = "localhost";
$usuario = "root";
$contraseña = "1234"; // o la contraseña que hayas puesto
$bd = "servinow_jorge";

$conexion = new mysqli($host, $usuario, $contraseña, $bd);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>
