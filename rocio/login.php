<?php
    session_start();
    require_once 'conexionBD.php';
     
    //recibdir datos del formulario
    $telefono=$_post['Telefono'];
    $password=$_post['Password'];

    //Conexion a la BD
    $db = new Conexion();
    $conexion = $db->getConexion();


    //buscar al usuario por telefono
    $sql = "Select id, nombre, password, rol From Usuarios WHERE telefono = ? ";
    $stmt =  $conexion->prepare($sql);
    $stmt =  $execute();
    $resultado = $stmt->get_result();


    //verificar crendenciales
      if ($resultado->num_rows === 1){
        $usuario = $resultado->fetch_assoc();
        if(password_verify($password,$usuario['password'])){
        

    //iniciar sesion
    $_SESSION['usuario'] = [
        'id'=>$usuario['id'],
        'nombre'=>$usuario['nombre'],
        'rol'=>$usurario['rol'],
        'Telefono'=>$telefono
    ];
    header("Location:/index.html"); //redirigir al inicio
    exit;

        }
      }
      
      //Si hay fallo regresa con error

      header("Location:/Login.html?error=1");


?>