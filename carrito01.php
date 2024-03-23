<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pedido/Carrito</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<?php include("menu.php"); ?>
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

    echo "<h1 class=\"none mt-5\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Carrito de compras</h1>";
    echo "<div class=\"table-responsive\">";
    echo "<table class=\"table table-dark table-sm\" align=\"center\" style=\"max-width: 800px;color:white;\">"; // Cambio en el estilo de la tabla
    echo "<thead><tr>";
    echo "<th>Producto</th>";
    echo "<th>Cantidad</th>";
    echo "<th>C/U</th>";
    echo "<th>Subtotal</th>";
    echo "<th>Acción</th>";
    echo "</tr></thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($res)) {
        $idProducto = $row['id_producto'];
        $cantidad = $row['cantidad'];
        $precio = $row['precio'];

        $sql = "SELECT nombre, stock FROM productos WHERE id = $idProducto";
        $resultProduct = mysqli_query($con, $sql);
        $rowProduct = mysqli_fetch_assoc($resultProduct);
        $nProducto = $rowProduct['nombre'];
        $stockProducto = $rowProduct['stock'];

        $subtotal = $cantidad * $precio;
        $total += $subtotal;
        $concatenacion = 'filas' . $idProducto;

        echo "<tr id=\"$concatenacion\">";
        echo "<td>$nProducto</td>";
        echo "<td><select name=\"tabla\" data-id=\"$idProducto\" data-pedido=\"$idPedido\" onchange=\"update($idProducto, $idPedido, this.value);\">";
        echo "<option value=\"$cantidad\" selected>$cantidad</option>";
        for ($z = 1; $z <= $stockProducto; $z++) {
            echo "<option value=\"$z\">$z</option>";
        }
        echo "</select></td>";
        echo "<td>$precio</td>";
        echo "<td>$subtotal</td>";
        echo "<td><button type=\"button\" class=\"btn btn-danger\" onclick = \"eliminarFilas($idProducto, $idPedido);\">Eliminar</button></td>";
        echo "</tr>";
    }

    echo "</tbody>";
    echo "<tfoot><tr>";
    echo "<td colspan=\"3\"></td>";
    echo "<td>Total</td>";
    echo "<td>$total</td>";
    echo "</tr></tfoot>";
    echo "</table>";
    echo "</div>"; // Cierre de la clase table-responsive
    echo "<div id=\"mensaje\" style=\"color:#FFFFFF;font-size:16px;\"></div>";
    echo "<br><button type=\"button\" class=\"btn btn-primary\" onclick = \"location='carrito02.php'\">Continuar</button>";
    echo "<br><br><br><br><br><br><br><br>";
}  else {
    echo "<h1 class=\"text-center mt-5\">No hay nada en tu carrito</h1>";
    echo "<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}
?>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function update(idPd, idPdido, val) {
        $.ajax({
            url: 'updateCarrito.php',
            type: 'post',
            data: { "idProducto": idPd, "cantidad": val, "idPedido": idPdido },
            success: function(resultband) {
                if (resultband == 1) {
                    $('#mensaje').html('Modificado exitosamente').show();
                    setTimeout(function(){ $('#mensaje').html('').hide(); }, 1000);
                    location.reload(true);
                } else {
                    $('#mensaje').html('').show();
                    setTimeout(function(){ $('#mensaje').html('').hide(); }, 2000);
                }
            },
            error: function() {
                alert('Error archivo no encontrado...');
            }
        });
    }

    function eliminarFilas(idPd, idPdido, val) {
        if(confirm("¿Estás seguro?")) {
            $.ajax({
                url: 'deleteCarrito.php',
                type: 'post',
                data: { "idProducto": idPd, "idPedido": idPdido },
                success: function(resultband) {
                    if (resultband == 1) {
                        var nombreFila = "filas" + idPd;
                        var fila = document.getElementById(nombreFila);
                        $(fila).hide();
                        $('#mensaje').html('Producto eliminado').show();
                        setTimeout(function(){ $('#mensaje').html('').hide(); }, 5000);
                        location.reload(true);
                    } else {
                        $('#mensaje').html('Error en la eliminación.').show();
                        $('#mensaje').slideUp(5000);
                        alert('No se borró');
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }
    }
</script>
<?php include("piedePagina.php"); ?>
</body>
</html>
