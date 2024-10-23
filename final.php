<?php 
session_start(); // con esto podre ver si la variable sesion existe o esta null
require 'php/conexion.php';
if(isset($_SESSION['user_id'])){ // se accede a la variable sesion para ver si esta vacio
    //además recordemos que sesion ahora contiene el valor del id pues se le ASIGNO en el login desde la BD
    $registros= $conn->prepare('SELECT id, nombre, apellido, correo, dni, contrasena FROM usuarios
    WHERE id= :id');
    $registros->bindParam(':id',$_SESSION['user_id']);  
    $registros->execute();
    $resultado=$registros->fetch(PDO::FETCH_ASSOC); // obtenemos solo esa fila que buscamos y se almacena en results
    $user=null; 
    if(count($resultado)>0){ // se verifica si no esta vacia esos campos de la base de datos
        $user=$resultado; // si ya se realizo la consulta entonces user se llenara con todos los datos del usuario
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Previsualizacion</title>
    <link rel="stylesheet" href="CSS/carrito.css">
</head>
<body>
    <header> 
        <div class="logotipo">
            <img src="IMG/z tipo.jpg" alt="Logo de la compañia">
            <h2 class="Nombre_compañia">Adidas</h2>
        </div>
        <nav>
            <a href="Inicio.php">Inicio</a>
            <a href="Productos.php">Productos</a>
            <a href="Acerca de Nosotros.php">Acerca de Nosotros</a>
            <?php
        // Comprobar si el usuario ha iniciado sesión
        if (isset($_SESSION['user_id'])) {
            echo "<a href='Miperfil.php' >Mi perfil</a>";
            echo "<a href='php/cerrar_Sesion.php' onclick='limpiarcarrito()'>Cerrar Sesión</a>";
        }
        ?>
        </nav>
    </header>
    <script src="JS/venta.js" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    </body>
    </html>
