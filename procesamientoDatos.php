<?php
require 'php/conexion.php';
session_start();
echo 'hola';
if (isset($_SESSION['user_id'])) {
    echo 'paso una cadena';
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo 'no llego a entrar';
                // Debug: Mostrar el contenido del carrito recibido
                echo '<pre>';
                var_dump($_POST['carrito']);
                echo '</pre>';
        // Decodificar JSON string recibido desde JavaScript
        $carrito = json_decode($_POST['carrito'], true);
        // Verificar que el carrito no esté vacío y que sea un array
        if (is_array($carrito) && !empty($carrito)) {
            try {
                // Comenzar una transacción
                $conn->beginTransaction();

                // Insertar una nueva venta
                $sqlVenta = "INSERT INTO ventas (id_usuarios) VALUES (:id_usuarios)";
                $stmt = $conn->prepare($sqlVenta); 
                $stmt->bindParam(':id_usuarios', $_SESSION['user_id']);
                $stmt->execute();

                // Obtener el ID de la última venta insertada
                $ConsultaIdVenta = $conn->prepare("SELECT MAX(id) AS 'ID_ULTIMA_VENTA' FROM ventas");
                $ConsultaIdVenta->execute();
                $resultadoConsultaVenta = $ConsultaIdVenta->fetch(PDO::FETCH_ASSOC);
                $id_ultima_venta = $resultadoConsultaVenta['ID_ULTIMA_VENTA'];

                // Procesar cada producto en el carrito
                foreach ($carrito as $producto) {
                    $id = $producto['id'];
                    $precio = $producto['precio'];
                    $cantidad = $producto['cantidad'];
                    $unidades = $producto['unidades'];

                    // Insertar en detalle_ventas
                    $sqlDetalleVenta = "INSERT INTO detalle_venta (precio, cantidad, Ventas_id, producto_id) 
                                        VALUES (:precio, :cantidad, :Ventas_id, :producto_id)";
                    $stmt = $conn->prepare($sqlDetalleVenta); 
                    $stmt->bindParam(':precio', $precio);
                    $stmt->bindParam(':cantidad', $unidades);
                    $stmt->bindParam(':Ventas_id', $id_ultima_venta);
                    $stmt->bindParam(':producto_id', $id);
                    $stmt->execute();

                    // Actualizar stock
                    $sqlActualizarStock = "UPDATE productos SET cantidad = cantidad - :cantidad WHERE id = :id";
                    $stmt = $conn->prepare($sqlActualizarStock); 
                    $stmt->bindParam(':cantidad', $unidades);
                    $stmt->bindParam(':id', $id);
                    $stmt->execute();
                }

                // Confirmar la transacción
                $conn->commit();
            } catch (Exception $e) {
                // Revertir la transacción en caso de error
                $conn->rollBack();
                echo "Fallo: " . $e->getMessage();
            }
        }
    }
}

?>
