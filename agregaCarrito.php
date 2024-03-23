<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

// Recibe variables
$idProducto = $_REQUEST['idProducto'];
$cantidad   = $_REQUEST['cantidad'];

$fecha = date('Y-m-d\TH:i:s.uP', time());

// Validar usuario/cliente
if (isset($_SESSION['usuario'])) {
    $usuario = $_SESSION['usuario'];
} else {
    $_SESSION['usuario'] = time() + rand();
    $usuario = $_SESSION['usuario'];
    $_SESSION['nombre'] = "Sesion de invitado";
}

// Verificar si hay pedido abierto para ese usuario
$sql = "SELECT * FROM pedidos WHERE status = 0 AND usuario = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

if ($num == 1) {
    $row = mysqli_fetch_assoc($result);
    $idPedido = $row['id'];
} else {
    // Crea el pedido
    $sql = "INSERT INTO pedidos (fecha, usuario) VALUES (?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $fecha, $usuario);
    mysqli_stmt_execute($stmt);
    $idPedido = mysqli_insert_id($con);
}

// Obtener costo actual
$sql = "SELECT costo FROM productos WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $idProducto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
$costo = $row['costo'];

// Verificar si existe el producto en el pedido abierto del usuario
$sql = "SELECT * FROM pedidos_productos
        WHERE id_pedido = ? AND id_producto = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "ii", $idPedido, $idProducto);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

if ($num == 1) {
    // Actualizar cantidad
    $row = mysqli_fetch_assoc($result);
    $idPP = $row['id'];
    $cantidadTotal = $row['cantidad'] + $cantidad;
    $sql = "UPDATE pedidos_productos SET cantidad = ?, precio = ?
            WHERE id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "idi", $cantidadTotal, $costo, $idPP);
    mysqli_stmt_execute($stmt);
    $resultband = 1;
    echo $resultband;
} else {
    // Insertar producto
    $sql = "INSERT INTO pedidos_productos (id_pedido, id_producto, cantidad, precio)
            VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "iiid", $idPedido, $idProducto, $cantidad, $costo);
    mysqli_stmt_execute($stmt);
    $resultband = 1;
    echo $resultband;
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
