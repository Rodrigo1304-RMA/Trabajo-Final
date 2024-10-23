<?php
include('php/conexion.php');
header("Content-type: application/xls");
header("Content-Disposition: attacchment; filename=reporte.xls");
?>
<?php
    $sql = "SELECT u.nombre, u.apellido, u.dni, u.correo, dt.precio, dt.cantidad, dt.Ventas_id, v.fecha,
    p.nombre as 'Zapatilla', p.talla, (dt.precio * dt.cantidad) as 'SubTotal'
    FROM detalle_venta dt
    INNER JOIN ventas v ON dt.Ventas_id = v.id
    INNER JOIN usuarios u ON v.id_usuarios = u.id
    INNER JOIN productos p ON dt.producto_id = p.id
    WHERE dt.Ventas_id = (
        SELECT MAX(Ventas_id) FROM detalle_venta
    )
";

// Ejecutar la consulta
$stmt = $conn->query($sql);

// Obtener los resultados
$resultado = $stmt->fetchAll();
?>
<div class="card mt-4" style="margin-left: 20px;margin-right: 20px;">
        <br>
    <p style="font-family: 'Times New Roman', Times, serif; font-weight: bold;">Reporte de Compra:</p>
    <p style="font-weight: bold;">Listado de productos</p>
        <div class="card-body">
            <table class="table table-hover striped">
                <tr style="background-color: yellowgreen; border: 1px solid black;"> 
                    <thead>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>CORREO</th>
                        <th>PRECIO</th>
                        <th>CANTIDAD</th>
                        <th>N Venta</th>
                        <th>FECHA</th>
                        <th>ZAPATILLA</th>
                        <th>TALLA</th>
                        <th>SUBTOTAL</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($resultado as $fila) { ?>
            <tr style="border: 1px solid black;">
            <td> <?php echo htmlspecialchars($fila['nombre']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['apellido']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['dni']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['correo']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['precio']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['cantidad']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['Ventas_id']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['fecha']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['Zapatilla']); ?> </td>
            <td> <?php echo htmlspecialchars($fila['talla']); ?> </td>
            <td> <?php echo "$" . htmlspecialchars($fila['SubTotal']) . ".00"; ?> </td>
        </tr>
                </tbody>
            <?php } ?>
            </table>
    <!-- Total Final -->
            <div class="row mt-4">
                <div class="col-12 text-right">
            <?php
                $totalFinal = 0;
                // No necesitamos reiniciar el puntero del resultado ya que estamos usando fetchAll
                foreach ($resultado as $fila) {
                $totalFinal += $fila['SubTotal'];
                }
            ?>

                    <h4 style="color: red;">Total a pagar:</h4> <h4><?php echo "$" . $totalFinal . ".00"; ?></h4>
                </div>
            </div>
            <!-- Mensaje de agradecimiento -->
            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p style="font-family: 'Times New Roman', Times, serif; font-weight: bold;"> Gracias por su compra!</p>
                </div>
            </div>
</div>
</div>