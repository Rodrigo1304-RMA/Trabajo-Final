<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="CSS/carrito.css">
    <script src="JS/carrito.js" defer></script>
</head>
<body>
    <header> <!---Encabezado--->
        <div class="logotipo">
            <img src="IMG/z tipo.jpg" alt="Logo de la compañia" class="logito">
            <h2 class="Nombre_compañia">Adidas</h2>
        </div>
        <nav>
        <a href="Inicio.php">Inicio</a>
        <a href="Productos.php">Productos</a>
        <a href="Acerca de Nosotros.php">Acerca de Nosotros</a>
        <?php
                session_start();
                    // Comprobar si el usuario ha iniciado sesión
                    if (isset($_SESSION['user_id'])) {
                        echo "<a href='php/cerrar_Sesion.php' onclick='limpiarcarritos()'>Cerrar Sesión</a>";
                        echo "<a href='Miperfil.php'>Mi perfil</a>";
                } else {
                        echo "<a href='Registrarse.php'>Registrarse</a>";
                        echo "<a href='Sesion.php'>Iniciar Sesion</a>";
                }
                ?>
        </nav>
    </header> 
        <section id="mi-seccion" class="princip">
            <!---->
        </section>
        <section id="Detalle" class="det">
            <!---->
        </section>
        <br>
        <h3 id="totalfinal">
            <!----->
        </h3>

    <button id="Ejecutar" onclick="irAMomentaneo()">Continuar</button>
    <script>
        // Función para redirigir al usuario a final.php
        function irAMomentaneo() {
            window.location.href = 'final.php';
        } //en dicha pagina estara el jquery y todo que sea instantaneo
    </script>           

<br>
</body>
</html>