<?php
session_start();
require 'conexion.php';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    
    // Consultar los datos actuales del usuario
    $stmt = $conn->prepare('SELECT nombre, apellido, dni FROM usuarios WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Obtener los datos enviados por el formulario
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $dni = $_POST['dni'];

    // Verificar si cada campo está vacío y usar el valor actual de la base de datos si es necesario
    if (empty($nombre)) {
        $nombre = $result['nombre'];
    }
    if (empty($apellido)) {
        $apellido = $result['apellido'];
    }
    if (empty($dni)) {
        $dni = $result['dni'];
    }

    // Actualizar los datos en la base de datos
    $sql = "UPDATE usuarios SET nombre = :nombre, apellido = :apellido, dni = :dni WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellido', $apellido);
    $stmt->bindParam(':dni', $dni);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['mensaje_datos'] = "Datos actualizados correctamente";
    } else {
        $_SESSION['mensaje_datos'] = "Error al actualizar los datos";
    }

    header('Location: ../Miperfil.php');
    exit();
}
?>

