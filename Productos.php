<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Productos</title>
    <link rel="stylesheet" href="CSS/productos.css">
    <script src="JS/index.js" defer></script>
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
            session_start();
                // Comprobar si el usuario ha iniciado sesión
                if (isset($_SESSION['user_id'])) {
                    $CapturaIdUser=$_SESSION['user_id'];
                    echo "<a href='php/cerrar_Sesion.php' onclick='limpiarcarrito()'>Cerrar Sesión</a>";
                    echo "<a href='Miperfil.php' >Mi perfil</a>";
                    echo "<a href='carrito.php' class='carrito'> 
                    <img src='IMG/shopping-cart.png'> <span id='cuenta-carrito'>0</span>
                    </a>";
                } else {
                    echo "<a href='Registrarse.php'>Registrarse</a>";
                    echo "<a href='Sesion.php'>Iniciar Sesion</a>";
                }
            ?>
        </nav>
    </header> 
    <div class="divv">
        <h2 class="st"> ZAPATILLAS ADIDAS: DEPORTIVOS Y URBANOS</h2>
        <p1>Conoce todo el catálogo de calzado adidas, zapatos con diversos diseños y estilos. </p1>
    </div>

    <section class="productos">
    <?php
// Incluir el archivo de la clase de conexión a la base de datos
require 'php/conexion.php'; 

// Consulta SQL para seleccionar todos los productos
$sql = "SELECT * FROM productos";
$resultado = $conn->prepare($sql);
$resultado->execute();
$arreglo = $resultado->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as associative array
// Verificar si hay datos en el arreglo
if (count($arreglo) > 0) {
    // Mostrar los productos
    foreach ($arreglo as $fila) {
        echo '<div class="producto">';
        echo '<img class="IMAGENES" src="'.$fila["imagen"].'" alt="'.$fila["nombre"].'">';
        echo '<h3 class="Zapatillaname">'.$fila["nombre"].'</h3>';
        echo '<p>Precio: $'.$fila["precio"].'</p>';
        echo '<p class="talla">Talla: '.$fila["talla"].'</p>';
        echo '<p class="cantidad">Cantidad: '.$fila["cantidad"].'</p>';
        if (isset($_SESSION['user_id'])) {
            echo '<input type="button" value="Añadir Al carrito" 
            id="'.$fila['id'].'" onclick="capturardatos(' . $_SESSION['user_id'] . ', \'' . $fila['id'] . '\', \'' . $fila['nombre'] . '\', ' . $fila['precio'] . ', \'' . $fila['talla'] . '\', ' . $fila['cantidad'] . ', \'' . $fila['imagen'] . '\')">';
        } else {
            echo '<input type="button" value="Añadir Al carrito" onclick="alerta_Sesion()" >';
        }
        echo '</div>';
    }
} else {
    // Si no hay productos en la base de datos
    echo "No hay productos disponibles";
}

    // Cerrar la conexión a la base de datos
    $conn = null;
    ?>
    </section>

    <footer class="adicional">
        <p>&copy; 2024 Tienda de Zapatillas Adidas</p>
    </footer>
</body>
</html>
