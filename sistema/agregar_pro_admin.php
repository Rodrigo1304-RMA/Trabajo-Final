<?php
session_start();
include '../php/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $talla = $_POST['talla'];
    $precio = $_POST['precio'];
    $imagen = $_FILES['imagen'];

    // Validar y limpiar datos aquí (opcional, pero recomendado)
    // Ejemplo de validación básica
    if (empty($nombre) || empty($cantidad) || empty($talla) || empty($precio) || empty($imagen['name'])) {
        die('Por favor, complete todos los campos.');
    }

    // Validar la imagen
    $target_dir = "../IMG/"; // Carpeta donde se guardarán las imágenes
    $target_file = $target_dir . basename($imagen["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Verificar si el archivo es una imagen real
    $check = getimagesize($imagen["tmp_name"]);
    if($check === false) {
        die("El archivo no es una imagen.");
    }

    // Verificar tamaño del archivo
    if ($imagen["size"] > 5000000) { // 5MB
        die("Lo sentimos, su archivo es demasiado grande.");
    }

    // Permitir ciertos formatos de archivo
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array($imageFileType, $allowed_types)) {
        die("Lo sentimos, solo se permiten archivos JPG, JPEG, PNG y GIF.");
    }

    // Intentar subir el archivo
    if (!move_uploaded_file($imagen["tmp_name"], $target_file)) {
        die("Lo sentimos, hubo un error al subir su archivo.");
    }

    // Construir la ruta relativa para la base de datos
    $ruta_db = "IMG/" . basename($imagen["name"]);

    // Preparar la consulta de inserción
    $consulta = $conn->prepare("INSERT INTO productos (nombre, cantidad, talla, precio, imagen) VALUES (?, ?, ?, ?, ?)");
    $consulta->bindParam(1, $nombre);
    $consulta->bindParam(2, $cantidad);
    $consulta->bindParam(3, $talla);
    $consulta->bindParam(4, $precio);
    $consulta->bindParam(5, $ruta_db); // Guardar solo la parte relativa a IMG/nombre.jpg

    // Ejecutar la consulta
    if ($consulta->execute()) {
        header("Location: principal.php");
    } else {
        echo "Error al añadir el producto.";
    }
} else {
    echo "Método no permitido";
}
?>

