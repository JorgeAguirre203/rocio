<?php
class Conexion {
    private $conexion;

    public function __construct() {
        // Configuración para conectar a Windows
        $host = '192.168.199.137';
        $user = 'root';
        $pass = '140223';
        $db   = 'servinowbd';
        $port = 3306;

        $this->conexion = new mysqli($host, $user, $pass, $db, $port);
        
        if ($this->conexion->connect_error) {
            error_log("Error de conexión: " . $this->conexion->connect_error);
            throw new Exception("No se pudo conectar a la base de datos");
        }
        
        $this->conexion->set_charset("utf8mb4");
    }

    public function getConexion() {
        return $this->conexion;
    }

    public function __destruct() {
        if ($this->conexion) {
            $this->conexion->close();
        }
    }
}
?>