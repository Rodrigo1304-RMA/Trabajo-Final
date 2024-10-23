<?php

session_start(); //crea una variable sesion
    //si la sesion esta activa nos redirecciona a la ruta inicla de la aplicacion para que no podemoas registrarnos
    //pues eso seria extraño y no tendria sentido
    if (isset($_SESSION['user_id'])) { // si la variable SeSion esta vacio entonces nos redirecciona a la
    header('Location: inicio.php'); //  carpeta raiz para que podemos hacer las cosas en orden
    }
    require 'php/conexion.php'; 

    if (!empty($_POST['email_login']) && !empty($_POST['password_login'])) { // si no esta vacio esos campos entonces
    $registros = $conn->prepare('SELECT id, correo, contrasena, tipo_usuario FROM usuarios WHERE correo = :correo'); 
    //el where indica que el extraiga el email que sea igual al parametro que se creara en la siguiente linea
    $registros->bindParam(':correo', $_POST['email_login']); //se vincula el parametro email, pues el parametro email
    //se va a reemplazar por lo que estemos obteniendo del metodo post
    $registros->execute(); //se ejecuta la consulta
    $resultados = $registros->fetch(PDO::FETCH_ASSOC); // se crea una variable la cual almacenara solo esa fila 
    //el cual contendra los datos de Este USUARIO traidos de la BD
    $mensaje = '';
    //validamos si ese resultado no esta vacia , count es un metodo que me permite contar
    //ademas usamos el metodo paswordverify la cual nos facilita comparar el campo password con el CIFRADO de la BD
    if (count($resultados) > 0 && password_verify($_POST['password_login'], $resultados['contrasena'])) { //se compara el password
        $_SESSION['user_id'] = $resultados['id']; //traemos de la base de datos el id a travez de la variable result
        //la cual contiene un conjunto de datos y lo almacenamos en la variable SESION
        if($resultados['tipo_usuario']==0){ //si el tipo de usuario es igual a 0 entonces dirige al inicio de cliente
        header("Location: inicio.php");}    else{ //si es de tipo admin lo DIRECCIONA al panel dashboard
            header("Location: sistema/principal.php"); //CAMBIAR DIRECCION
        } 
    } else {
        $mensaje = 'Las credenciales no son correctas'; //en caso falle se muestra este mensaje
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="CSS/sesion.css">
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
            <a href="Sesion.php">Iniciar Sesion</a>
        </nav>
    </header> 
<section>
    <div class="inicio-sesion">
                <img class="imgs" src="IMG/perfil-del-usuario-last.png">
                    <h2>Inicio de sesión </h2>
                        <form action="Sesion.php" method="post">
                            <div class="form-group">
                                <img class="edz" src="IMG/acceso_the.png">
                                <input type="email" id="email_login" name="email_login" placeholder="Correo electrónico" required>
                            </div><br>
                            <div class="form-group">
                                <img class="edz" src="IMG/acceso.png">
                                <input type="password" id="password_login" name="password_login" placeholder="Contraseña" required>
                            </div><br>
                            <div class="form-group">
                                <input type="submit" value="Iniciar Sesión">
                            </div><br>
                        </form>
        <?php if(!empty($mensaje)): //si el mensaje no esta vacio nos muestra un mensaje?>
            <h2><?= $mensaje ?></h2>
        <?php endif  ?>
    </div>
</section>
</body>
</html>