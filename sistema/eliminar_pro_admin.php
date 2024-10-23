<?php
session_start();
include '../php/conexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    if (empty($nombre)) {
        die('Por favor, complete todos los campos.');
    }
    // Preparar la consulta de eliminación
    $consulta = $conn->prepare("DELETE FROM productos WHERE nombre = ?");
    $consulta->bindParam(1, $nombre);

    // Ejecutar la consulta
    if ($consulta->execute()) {
        if ($consulta->rowCount() > 0) {
            header("Location: principal.php");
        }
}

}