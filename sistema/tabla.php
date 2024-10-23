<?php
	session_start();
	require '../php/conexion.php';
	
	if(!isset($_SESSION['user_id'])){
		header("Location: principal.php");
	}
	$nombre = "ADMINISTRADOR";//$_SESSION['nombre'];
	$tipo_usuario = "administrador";//$_SESSION['tipo_usuario'];
	//$id = $_SESSION['user_id'];
	//$tipo_usuario = $_SESSION['tipo_usuario'];
	
	/*	if($tipo_usuario == 1){
		$where = "";
		} else if($tipo_usuario == 0){
		$where = "WHERE id=$id";
	}
	
	$sql = "SELECT * FROM usuarios $where";
	$resultado = $mysqli->query($sql); 	*/
?>

<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="" />
		<meta name="author" content="" />
		<title>Tables - SB Admin</title>
		<link href="css/styles.css" rel="stylesheet" />
		<link rel="stylesheet" href="css/formularios.css">
		<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
	</head>
	<body class="sb-nav-fixed">
		<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
			<a class="navbar-brand" href="principal.php">Control-Administrador</a><button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button
			><!-- Navbar Search-->
			<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

			</form>
			<!-- Navbar-->
			<ul class="navbar-nav ml-auto ml-md-0">
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
						<a class="dropdown-item" href="#">Configuración</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="../php/cerrar_Sesion.php">Salir</a>
					</div>
				</li>
			</ul>
		</nav>
		<div id="layoutSidenav">
			<div id="layoutSidenav_nav">
				<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
					<div class="sb-sidenav-menu">
						<div class="nav">
							
							<a class="nav-link" href="principal.php"
							><div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
								Gestion de productos</a>
									<div class="sb-sidenav-menu-heading">Complementos</div>
									<a class="nav-link" href="tabla.php">
										<div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
										Historial-ventas</a>
						</div>
					</div>
					<div class="sb-sidenav-footer">
						<div class="small">Logged in as:</div>
						Start Bootstrap
					</div>
				</nav>
			</div>
			<div id="layoutSidenav_content">
				<main>
					<section class="vid">
					<form action="modificar_pro_admin.php" method="post">
					<label class="imp">Modificar Producto: </label> <br>
					<label>Seleccionar Producto:</label>
						<select name="producto">
							<?php
								$consultap=$conn->prepare('SELECT * FROM productos ');
								$consultap->execute();
								$almacenados=$consultap->fetchAll(PDO::FETCH_ASSOC);
								foreach($almacenados as $pro){
									echo "<option value='".$pro['id']."'>".$pro['nombre']."</option>";
								}
							?>
						</select > <br>
						<label style="width: 80px;">Nombre:</label>
						<input type="text" name="nombre"><br>
						<label style="width: 80px;">Cantidad:</label>
						<input type="text" name="cantidad"><br>
						<label style="width: 80px;">Talla:</label>
						<input type="text" name="talla"><br>
						<label style="width: 80px;">Precio:</label>
						<input type="text" name="precio"><br>
						<input type="submit" value="Guardar Cambios">
				</form> <br>
				<form action="agregar_pro_admin.php" method="post" enctype="multipart/form-data">
						<label class="imp">Agregar Producto: </label> <br>
						<label style="width: 80px;">Nombre:</label>
						<input type="text" name="nombre"><br>
						<label style="width: 80px;">Cantidad:</label>
						<input type="text" name="cantidad"><br>
						<label style="width: 80px;">Talla:</label>
						<input type="text" name="talla"><br>
						<label style="width: 80px;">Precio:</label>
						<input type="text" name="precio"><br>
						<label style="width: 80px;">Imagen:</label>
						<input type="file" name="imagen"><br>
						<input type="submit" value="Añadir Producto">
				</form><br>
				<form action="eliminar_pro_admin.php" method="post">
					<label class="imp">Eliminar Producto</label> <br>
					<label>Nombre del Producto :</label>
					<input type="text" name="nombre"><br>
					<input type="submit" value="Eliminar">
				</form>
				</section>	
				<section class="vid">
					<img class="img_Admin" src="../IMG/Adm-curd.jpg" >
				</section>
				</main>
					<footer class="py-4 bg-light mt-auto">
						<div class="container-fluid">
						<div class="d-flex align-items-center justify-content-between small">
					<div class="text-muted">Copyright &copy; Your Website 2019</div>
					<div>
						<a href="#">Privacy Policy</a>
						&middot;
						<a href="#">Terms &amp; Conditions</a>
					</div>
					</div>
					</div>
				</footer>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
		<script src="js/scripts.js"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
		<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
		<script src="assets/demo/datatables-demo.js"></script>
	</body>
</html>
