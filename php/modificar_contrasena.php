<?php
session_start();
require 'conexion.php';

if (isset($_SESSION['user_id'])) {
    $id = $_SESSION['user_id'];
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    // Verificar la contraseña actual
    $stmt = $conn->prepare('SELECT contrasena FROM usuarios WHERE id = :id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($old_password, $result['contrasena'])) {
        // Actualizar con la nueva contraseña
        $new_password_hash = password_hash($new_password, PASSWORD_BCRYPT);
        $sql = "UPDATE usuarios SET contrasena = :contrasena WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':contrasena', $new_password_hash);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            $_SESSION['mensaje_contrasena'] = "Contraseña actualizada correctamente";
        } else {
            $_SESSION['mensaje_contrasena'] = "Error al actualizar la contraseña";
        }
    } else {
        $_SESSION['mensaje_contrasena'] = "La contraseña actual no es correcta";
    }

    header('Location: ../Miperfil.php');
    exit();
}
?>
