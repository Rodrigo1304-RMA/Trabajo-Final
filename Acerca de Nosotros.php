<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nosotros</title>
    <link rel="stylesheet" href="CSS/Nosotros.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
                  echo "<a href='php/cerrar_Sesion.php'>Cerrar Sesión</a>";
                  echo "<a href='Miperfil.php'>Mi perfil</a>";
              } else {
                  echo "<a href='Registrarse.php'>Registrarse</a>";
                  echo "<a href='Sesion.php'>Iniciar Sesion</a>";
              }
            ?>
    </nav>
</header> 

    <div class="contenedor">
        <div class="imagen">
            <img src="IMG/nosotros1.jpg" alt="" style="height: 400px; width: 400px;">
        </div>
        <div class="descripcion">
            <p>Somos una empresa con más de 20 años de trayectoria en el mercado peruano. La innovación
                constante en nuestros procesos y servicio, nos caracterizan y permiten ofrecer la mayor diversidad de
                calzados y accesorios en marcas nacionales e internacionales. Productos reconocidos por su calidad,
                moda, confort y diseños para cada momento.</p>
        </div>
    </div>

    <div class="container">
      <div class="vision">
        <div class="vision-content">
          <img src="IMG/img-vision.svg" alt="">
          <div class="text-container">
            <h2>Visión</h2>
            <p>Somos una empresa dedicada a la comercialización y distribución de calzados de calidad, moda y tecnología nacionales e importados, buscando satisfacer las necesidades del cliente.</p>
          </div>
        </div>
      </div>
      <div class="mision">
        <div class="mision-content">
          <img src="IMG/img-mision.svg" alt="">
          <div class="text-container">
            <h2>Misión</h2>
            <p>Queremos ser una empresa líder y reconocida en la comercialización y distribución de calzados, en tiendas, catálogo y ventas online a nivel nacional.</p>
          </div>
        </div>
      </div>
    </div>

      <div class="valores-contenido">
        <h2>NUESTROS VALORES</h2>
        <div class="valores-grid">
          <div class="valor">
            <div class="valor-icon">
              <img src="IMG/honestidad.svg" alt="">
            </div>
            <div class="valor-texto">
              <h3>HONESTIDAD</h3>
              <p>Trabajamos de forma integra con transparencia y coherencia.</p>
            </div>
          </div>
          <div class="valor">
            <div class="valor-icon">
              <img src="IMG/compromiso.svg" alt="">
            </div>
            <div class="valor-texto">
              <h3>COMPROMISO</h3>
              <p>Un compromiso común reconocido por todos los miembros de la familia ADIDAS, para garantizar a nuestros clientes el mejor servicio.</p>
            </div>
          </div>
          <div class="valor">
            <div class="valor-icon">
              <img src="IMG/innovacion.svg" alt="">
            </div>
            <div class="valor-texto">
              <h3>INNOVACIÓN</h3>
              <p>Pensamos desde una perspectiva diferente para anticipar cambios y desarrollar nuevas propuestas, en un servicio diferenciado para todos nuestros clientes.</p>
            </div>
          </div>
          <div class="valor">
            <div class="valor-icon">
              <img src="IMG/calidad.svg" alt="">
            </div>
            <div class="valor-texto">
              <h3>CALIDAD EN EL SERVICIO</h3>
              <p>Nos esforzamos constantemente por dar lo mejor de nosotros en todas nuestras actividades y procesos.</p>
            </div>
          </div>
        </div>
      </div>

      <div class="feature-container">
        <div class="feature">
          <div class="feature-icon">
            <span class="icon-hexagon">
              <i class="bi bi-globe-americas"></i>
            </span>
          </div>
          <h3>ENVÍOS A NIVEL NACIONAL</h3>
          <p>Llegamos a todo el Perú, puedes realizar tu pedido ahora.</p>
        </div>
      
        <div class="feature">
          <div class="feature-icon">
            <span class="icon-hexagon">
              <i class="bi bi-truck"></i>
            </span>
          </div>
          <h3>COMPRA HOY, RECIBE HOY</h3>
          <p>Con nuestro delivery express, puedes recibir tu pedido al instante.</p>
        </div>
      
        <div class="feature">
          <div class="feature-icon">
            <span class="icon-hexagon">
              <i class="bi bi-shop"></i>
            </span>
          </div>
          <h3>RETIRO GRATIS EN TIENDAS ADIDAS</h3>
          <p>Puedes recoger tu pedido sin costo, en todas las tiendas ADIDAS.</p>
        </div>
      
        <div class="feature">
          <div class="feature-icon">
            <span class="icon-hexagon">
              <i class="bi bi-person-circle"></i>
            </span>
          </div>
          <h3>REGÍSTRATE EN ADIDAS</h3>
          <p>Ten beneficios exclusivos por ser miembro de la familia ADIDAS.</p>
        </div>
      </div>
</body>

</html>