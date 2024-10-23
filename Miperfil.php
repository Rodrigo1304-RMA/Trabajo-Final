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
    <title>Mi perfil</title>
    <link rel="stylesheet" href="CSS/perfil.css">
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
            echo "<a href='php/cerrar_Sesion.php'>Cerrar Sesión</a>";
        }
        ?>
            <a href="Miperfil.php">Mi perfil</a>
        </nav>
    </header> 

    <div class="container">
        <div class="sub">
            <div class="cont" >
            <h2>Mi perfil</h2>
            <h3>Datos actuales:</h3>
                    <p>Nombre: <?= $user['nombre']; ?> </p>
                    <p>Apellido: <?= $user['apellido']; ?></p>
                    <p>Correo electrónico: <?= $user['correo']; ?></p>
                    <p>DNI: <?= $user['dni']; ?></p>                   
            </div>
            <img class="imagenesf" src="IMG/icon ver datos.jpg" alt="">
        </div>

        <div class="sub">
            <div class="cont"><h3>Modificar datos:</h3>
        <form action="php/modificar_datos.php" method="POST">
            <label for="nombre">Nombre  :</label>
            <input type="text" id="nombre" name="nombre" value=""><br><br>

            <label for="apellido">Apellido:</label>
            <input type="text" id="apellido" name="apellido" value=""><br><br>

            <label for="dni">DNI   :</label>
            <input type="text" id="dni" name="dni" maxlength="8" pattern="[0-9]{8}" ><br><br>
            <input type="submit" value="Guardar cambios"><br>
            
        </form>
        <?php
                if (isset($_SESSION['mensaje_datos'])) {
                    echo "<p>" . $_SESSION['mensaje_datos'] . "</p>";
                    unset($_SESSION['mensaje_datos']); // Eliminar mensaje después de mostrarlo
                }
                ?>
        </div>        
            <img class="imagenesf" src="IMG/modif dat icon.jpg">
        </div>

        <div class="sub">
                <div class="cont" ><h3>Modificar contraseña</h3>
                <form action="php/modificar_contrasena.php" method="POST">
                <label for="old_password">Contraseña actual:</label>
                <input type="password" id="old_password" name="old_password" required><br><br>
                <label for="new_password">Nueva contraseña:</label>
                <input type="password" id="new_password" name="new_password" required><br><br>
                <input type="submit" value="Guardar cambios"><br>
                
            </form>
            <?php
                if (isset($_SESSION['mensaje_contrasena'])) {
                    echo "<p>" . $_SESSION['mensaje_contrasena'] . "</p>";
                    unset($_SESSION['mensaje_contrasena']); // Eliminar mensaje después de mostrarlo
                }
                ?>
            </div>    
            <img  class="imagenesf" src="IMG/mod contra.jpg" alt="ICONO">
        </div>

    </div>
    <footer class="adicional">
        <p>&copy; 2024 Tienda de Zapatillas Adidas</p>
    </footer>
</body>
</html>