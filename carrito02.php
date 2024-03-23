<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido/Finalizar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function enviarPedido(idPedido) {
            $.ajax({
                url: 'cierraPedido.php',
                type: 'post',
                data: { "idPedido": idPedido },
                success: function(resultband) {
                    if (resultband == 1) {
                        $('#mensaje').html('Pedido registrado correctamente').show();
                        setTimeout(function(){ location.href='cliente_pedido.php?id_pedido='+idPedido }, 2000);
                        fila = document.getElementById('botonfin');
                        $(fila).hide();
                    } else {
                        $('#mensaje').html('').show();
                        setTimeout(function(){ $('#mensaje').html('').show(); }, 2000);
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }
    </script>
    <style>
        .none {
            text-align: center;
            color: white;
            font-weight: thin;
            margin: 0 0 40px;
        }

        .btn-regresar {
            margin-left: 2%;
        }
    </style>
</head>

<body>
    <?php include("menu.php"); ?>
    <br>
    <div align="left" class="btn-regresar">
        <button type="button" class="btn btn-dark mb-4" id="regresar" value="Regresar" onclick="javascript: history.go(-1)">Regresar</button>
    </div>
    <form name="forma01">
        <?php
        session_start();
        require "./funciones/conecta.php";
        $con = conecta();

        if ($_SESSION['usuario']) {
            $usuario = $_SESSION['usuario'];
        }

        $sql = "SELECT * FROM pedidos WHERE status = 0 AND usuario = $usuario";
        $res = mysqli_query($con, $sql);
        $num = mysqli_num_rows($res);
        if ($num == 1) {
            $idPedido = mysqli_fetch_assoc($res)['id'];

            $sql = "SELECT * FROM pedidos_productos WHERE id_pedido = $idPedido";
            $res = mysqli_query($con, $sql);
            $total = 0;

            echo "<h1 class=\"none\">Carrito de compras</h1>";
            echo "<div class=\"container\">";
            echo "<table class=\"table table-dark w-auto mx-auto\">";
            echo "<tr>";
            echo "<td>Producto</td>";
            echo "<td>Cantidad</td>";
            echo "<td>Costo Unitario</td>";
            echo "<td>Subtotal</td>";
            echo "</tr>";

            while ($row = mysqli_fetch_assoc($res)) {
                $idProducto = $row['id_producto'];
                $cantidad = $row['cantidad'];
                $precio = $row['precio'];

                $sql = "SELECT nombre FROM productos WHERE id = $idProducto";
                $resultProduct = mysqli_query($con, $sql);
                $rowProduct = mysqli_fetch_assoc($resultProduct);
                $nProducto = $rowProduct['nombre'];

                $subtotal = $cantidad * $precio;
                $total += $subtotal;
                $concatenacion = 'filas' . $idProducto;

                echo "<tr id=\"$concatenacion\">";
                echo "<td>$nProducto</td>";
                echo "<td>$cantidad</td>";
                echo "<td>$precio</td>";
                echo "<td>$subtotal</td>";
                echo "</tr>";
            }

            echo "<tr>";
            echo "<td>Total</td>";
            echo "<td colspan=\"3\">$total</td>";
            echo "</tr>";
            echo "</table>";
            echo "</div>";
            echo "<div id=\"mensaje\"></div>";
            echo "<button type=\"button\" class=\"btn btn-light mb-4\" onclick=\"enviarPedido($idPedido);\">Finalizar</button>";
        } else {
            echo "<h1 class=\"text-center\">No Hay Ningún Pedido Abierto en Tu Carrito</h1>";
        }
        ?>
    </form>
    <?php include("piedePagina.php"); ?>
    <!-- Scripts de Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js"></script>
</body>

</html>
