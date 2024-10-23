<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="CSS/inicio.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="JS/index.js" defer></script>
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
            <?php
                session_start();
                // Comprobar si el usuario ha iniciado sesión
                if (isset($_SESSION['user_id'])) {
                    echo "<a href='php/cerrar_Sesion.php' onclick='limpiarcarrito()'>Cerrar Sesión</a>";
                    echo "<a href='Miperfil.php'>Mi perfil</a>";
                } else {
                    echo "<a href='Registrarse.php'>Registrarse</a>";
                    echo "<a href='Sesion.php'>Iniciar Sesion</a>";
                }
            ?>
        </nav>
    </header> 

    <section class="dos">
        <h2>¡Bienvenido a la casa del rendimiento, la innovación y el estilo! En nuestra plataforma, explorarás el mundo de Adidas, donde cada paso es una declaración de confianza 
            y determinación. Desde nuestras icónicas zapatillas hasta las colecciones más vanguardistas, te invitamos a descubrir cómo fusionamos
            tecnología de vanguardia con el legado de la marca para inspirar tu próximo movimiento. ¡Únete a la comunidad que desafía lo convencional 
            y define el futuro del deporte y la moda!</h2>
    </section>
    <section class="uno">
        <img src="IMG/MODELO_8.jpg" alt="">
        <img src="IMG/MODELO_1.jpg" alt="">
        <img src="IMG/MODELO_2.jpg" alt="">
        <img src="IMG/MODELO_3.jpg" alt="">
        <img src="IMG/MODELO_4.jpg" alt="">
        <img src="IMG/MODELO_5.jpg" alt="">
        <img src="IMG/MODELO_6.jpg" alt="">
        <img src="IMG/MODELO_7.jpg" alt="">
    </section>
    <section class="tres">
        <h2>Sigue explorando, sigue creando y sigue desafiando los límites. Desde las canchas hasta las calles, estamos aquí para impulsar tu pasión y celebrar tu espíritu 
            imparable. ¡Únete a nosotros mientras escribimos juntos el próximo capítulo en la historia del deporte y la moda</h2>
    </section>
    <footer class="adicional">
        <p>&copy; 2024 Tienda de Zapatillas Adidas</p>
    </footer>
</body>
</html>