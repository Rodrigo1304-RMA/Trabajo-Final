<?php
session_start();
include '../php/conexion.php'; // Archivo que contiene la conexión a la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar si todos los campos se enviaron
    if (isset($_POST['producto'], $_POST['nombre'], $_POST['cantidad'], $_POST['talla'], $_POST['precio'])) {
        $producto_id = $_POST['producto'];
        $nombre = $_POST['nombre'];
        $cantidad = $_POST['cantidad'];
        $talla = $_POST['talla'];
        $precio = $_POST['precio'];

        // Validar y limpiar datos aquí (opcional, pero recomendado)
        // Ejemplo de validación básica
        if (empty($producto_id)) {
            die('Por favor, seleccione un producto.');
        }

        // Preparar la consulta de actualización
        $consulta = $conn->prepare("UPDATE productos SET nombre = ?, cantidad = ?, talla = ?, precio = ? WHERE id = ?");
        $consulta->bindParam(1, $nombre);
        $consulta->bindParam(2, $cantidad);
        $consulta->bindParam(3, $talla);
        $consulta->bindParam(4, $precio);
        $consulta->bindParam(5, $producto_id);
        $consulta->execute();
        // Ejecutar la consulta
        if ($consulta->execute()) {
            header("Location: principal.php");
        } else {
            echo "Error al actualizar el producto.";
        }
    } else {
        echo "Por favor, complete todos los campos.";
    }
} 
?>

