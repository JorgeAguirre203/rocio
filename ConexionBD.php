<?php
class Conexion {
    private $conexion;

    public function __construct() {
        // Configuración para phpMyAdmin local en Ubuntu
        $host = 'localhost';
        $user = 'phpmyadmin'; // Usuario de phpMyAdmin
        $pass = '140223';     // Tu contraseña
        $db   = 'servinowbd';
        
        $this->conexion = new mysqli($host, $user, $pass, $db);
        
        if ($this->conexion->connect_error) {
            error_log("Error de conexión: " . $this->conexion->connect_error);
            throw new Exception("No se pudo conectar a la base de datos. Verifica: 
                1. Credenciales correctas
                2. Usuario tiene privilegios
                3. Base de datos existe");
        }
        
        $this->conexion->set_charset("utf8mb4");
    }

    public function getConexion() {
        return $this->conexion;
    }
}
?>