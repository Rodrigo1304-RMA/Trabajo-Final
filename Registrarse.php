<?php
require 'php/conexion.php';
$mensaje = ''; //se declara esta variable global sin nada 
//verifica si los campos email y password no estan vacios entonces:
if (!empty($_POST['nombre']) && !empty($_POST['apellido']) && !empty($_POST['email']) 
&& !empty($_POST['dni']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO usuarios (nombre, apellido, correo, dni, contrasena) 
    VALUES (:nombre, :apellido, :correo, :dni, :contrasena)"; //se crea una consulta
    $stmt = $conn->prepare($sql); //variable llamda stament aunque puede ser cualquier nombre, se ejecuta el metodo prepare para ejecutar una consulta sql
    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':apellido', $_POST['apellido']);
    $stmt->bindParam(':correo', $_POST['email']);
    $stmt->bindParam(':dni', $_POST['dni']); 
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); //se guarda el password y se CIFRA
    $stmt->bindParam(':contrasena', $password); //se le pasa la variable contraseña cifrada en el segundo parametro
//recordar que el stmt en realidad tambien es como un array pues directamente se le pudo haber pasado un array
    if ($stmt->execute()) {  //se usa el metodo execute 
    $mensaje = 'Nuevo usuario creado exitosamente';
    } else {
    $mensaje = 'Lo sentimos, hubo un problema al crear tu cuenta';
    }
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="CSS/registrarse.css">
</head>
<body>

    <header> <!---Encabezado--->
        <div class="logotipo">
            <img src="IMG/z tipo.jpg" alt="Logo de la compañia">
            <h2 class="Nombre_compañia">Adidas</h2>
        </div>
        <nav>
            <a href="Inicio.php">Inicio</a>
            <a href="Productos.php">Productos</a>
            <a href="Acerca de Nosotros.php">Acerca de Nosotros</a>
            <a href="Registrarse.php">Registrarse</a>
            <a href='Sesion.php'>Iniciar Sesion</a>
        </nav>
    </header> 

    <section> <!---Contenedor para el contenido relevante de la pagina----->
        <div class="container">
            <div class="registro">
                <h2>Registrarse</h2>
                <form action="Registrarse.php" method="POST">
                    <div class="form-group">
                        <input type="text" id="nombre" name="nombre" placeholder="Nombre" required>
                    </div><br>
                    <div class="form-group">
                        <input type="text" id="apellido" name="apellido" placeholder="Apellidos" required>
                    </div><br>
                    <div class="form-group">
                        <input type="email" id="email" name="email" placeholder="Correo electrónico" required> 
                    </div><br>
                    <div class="form-group">
                        <input type="text" id="dni" name="dni" maxlength="8" pattern="[0-9]{8}" placeholder="DNI" required>
                    </div><br>
                    <div class="form-group">
                        <input type="password" id="password" name="password" placeholder="Contraseña" required>
                    </div><br>
                    <div class="form-group">
                        <input type="submit" value="Registrarse">
                    </div><br>
                </form>
                <?php if (!empty($mensaje)) : //si no esta vacio el mensaje es porque ha ocurrido algo ya sea bueno o malo?>
                        <p><?= $mensaje ?></p>
                <?php endif?>
            </div>    
        </div>
        
    </section>

    <footer class="adicional">
        <p>&copy; 2024 Tienda de Zapatillas Adidas</p>
    </footer>
</body>
</html>