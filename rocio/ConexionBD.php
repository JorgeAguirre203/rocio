<?php
// conexionBD.php - Versión segura
class Conexion {
    private $conexion;
    private static $instancia = null;

    private function __construct() {
        // Configuración (mejor mover a un archivo .env o config.php)
        $host = '192.168.199.137';
        $user = 'phpmyadmin';
        $pass = '140223';
        $db   = 'servinowbd';

        $this->conexion = new mysqli($host, $user, $pass, $db);
        
        if ($this->conexion->connect_error) {
            error_log("Error de conexión BD: " . $this->conexion->connect_error);
            throw new Exception("Error al conectar con la base de datos");
        }
        
        $this->conexion->set_charset("utf8");
    }

    public static function obtenerInstancia() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
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