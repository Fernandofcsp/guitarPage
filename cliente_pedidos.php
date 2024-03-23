<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos del Cliente</title>
    <!-- Agregar Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
</head>
<body>
    <?php include("menu.php"); ?>
    <?php
    session_start();
    require "./funciones/conecta.php";
    $con = conecta();
    $ids = $_REQUEST['id'];
    $sql = "SELECT * FROM pedidos WHERE usuario = ? AND status = 1";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $ids);
    $stmt->execute();
    $res = $stmt->get_result();
    $num = $res->num_rows;
    echo "<div class=\"container\">";
    echo "<div class=\"row\">";
    echo "<div class=\"col-12\">";
    echo "<div class=\"d-grid gap-2\">";
    echo "<div align=\"left\" class=\"btn-regresar mt-4\">";
    echo "<button type=\"button\" class=\"btn btn-dark\" id=\"regresar\" onclick=\"javascript: history.go(-1)\">Regresar</button>";
    echo "</div>"; 
    echo "</div>";
    echo "<h1 class=\"none text-center text-white font-weight-thin mt-4 mb-4\">Listado de Pedidos de Cliente Cerrados</h1>";
    
    echo "<table class=\"table table-dark table-sm\">";
    echo "<thead>";
    echo "<tr>";
    echo "<th scope=\"col\">ID PEDIDO</th>";
    echo "<th scope=\"col\">FECHA</th>";
    echo "<th scope=\"col\">ID USUARIO</th>";
    echo "<th scope=\"col\">NOMBRE DEL CLIENTE</th>";
    echo "<th scope=\"col\">ACCIÓN</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    while ($row = $res->fetch_assoc()) {
        $idPedido = $row["id"];
        $fecha = $row["fecha"];
        $idusuario = $row["usuario"];

        $sql = "SELECT nombre FROM clientes WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $idusuario);
        $stmt->execute();
        $resnUser = $stmt->get_result();
        $nUser = $resnUser->fetch_assoc()["nombre"];

        echo "<tr>";
        echo "<td>$idPedido</td>";
        echo "<td>$fecha</td>";
        echo "<td>$idusuario</td>";
        echo "<td>$nUser</td>";
        echo "<td><button type=\"button\" class=\"btn btn-dark\" onclick=\"location.href='detalle_pedido.php?id_pedido=$idPedido'\">Ver Detalle</button></td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>"; // col-12
    echo "</div>"; // row
    echo "</div>"; // container
    ?>
    <?php include("piedePagina.php"); ?>
    <!-- Agregar Bootstrap JS (opcional si lo necesitas) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
