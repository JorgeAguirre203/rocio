<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    $target_dir = "uploads/"; // Carpeta donde se guardarán las imágenes
    $target_file = $target_dir . basename($_FILES["file"]["name"]);
    
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "La imagen se subió correctamente.";
    } else {
        echo "Error al subir la imagen.";
    }
}
?>
