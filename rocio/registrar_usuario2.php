<?php
// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "1234";
$base_datos = "servinow_jorge";

// Establecer la conexión
$conn = new mysqli($servidor, $usuario, $contrasena, $base_datos);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validación de datos (por ejemplo, comprobar si ya existe el correo)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $telefono = mysqli_real_escape_string($conn, $_POST['telefono']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);

    // Comprobar si las contraseñas coinciden
    if ($password != $confirmPassword) {
        echo "Las contraseñas no coinciden.";
        exit();
    }

    // Verificar si el correo ya existe en la base de datos
    $sql_check_email = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql_check_email);

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
        exit();
    }

    // Insertar el nuevo usuario en la tabla (puedes modificar la tabla según el tipo de usuario)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);  // Encriptamos la contraseña

    $sql_insert = "INSERT INTO usuarios2 (nombre, telefono, email, password) 
                   VALUES ('$nombre', '$telefono', '$email', '$hashedPassword')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "Usuario registrado exitosamente.";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
