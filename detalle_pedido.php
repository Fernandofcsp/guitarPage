<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del pedido</title>
    <!-- Enlaces a Bootstrap CSS y JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>

<body>
    <?php include("menu.php"); ?>
    <br>

    <?php
    session_start();
    require "./funciones/conecta.php";
    $con = conecta();
    $idPedido = $_REQUEST['id_pedido'];

    $sql = "SELECT pp.id_producto, pp.cantidad, pp.precio, p.nombre FROM pedidos_productos pp
            JOIN productos p ON pp.id_producto = p.id
            WHERE pp.id_pedido = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $idPedido);
    $stmt->execute();
    $result = $stmt->get_result();
    $num = $result->num_rows;

    echo "<div align=\"left\" style=\"margin-left:5.5%;\"><button type=\"button\" class=\"btn btn-dark\" id=\"regresar\" value=\"Regresar\" onclick=\"javascript: history.go(-1)\">Regresar</button></div>";
    ?>

    <div class="container">
        <div class="row">
    
            <div class="col">
                
                <h1 class="none text-center text-white font-weight-thin mt-4 mb-4">Detalles del pedido</h1>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Costo Unitario</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        $total = 0;
                        while ($row = $result->fetch_assoc()) {
                            $idProducto = $row['id_producto'];
                            $nombreProducto = $row['nombre'];
                            $cantidad = $row['cantidad'];
                            $precio = $row['precio'];

                            $subtotal = $cantidad * $precio;
                            $total += $subtotal;

                            echo "<tr>";
                            echo "<td>$nombreProducto</td>";
                            echo "<td>$cantidad</td>";
                            echo "<td>$precio</td>";
                            echo "<td>$subtotal</td>";
                            echo "</tr>";
                        }

                        echo "<tr>";
                        echo "<td colspan=\"3\">Total</td>";
                        echo "<td>$total</td>";
                        echo "</tr>";

                        ?>

                    </tbody>
                </table>
            </div> <!-- col -->
        </div> <!-- row -->
    </div> <!-- container -->

    <!-- Scripts de Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>

</html>
