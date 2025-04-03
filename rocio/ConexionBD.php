<?php
// Configuración de la base de datos
define('DB_HOST', '192.168.199.137');
define('DB_USER', 'root');
define('DB_PASS', '140223');
define('DB_NAME', 'servinowbd');

class Conexion {
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        } else {
            echo "¡Conexión exitosa a la base de datos!"; // Mensaje de éxito
        }
        
        $this->conexion->set_charset("utf8");
    }

    public function getConexion() {
        return $this->conexion;
    }
}

// Prueba instantánea
$test = new Conexion(); // Esto mostrará el mensaje si la conexión es exitosa
?>