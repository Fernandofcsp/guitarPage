<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();
$usuario = $_SESSION['usuario'];
$idPedido = $_POST['idPedido'];

// Extraigo los datos del pedido
$sql = "SELECT * FROM pedidos_productos WHERE id_pedido = '$idPedido'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

$id = array();
$cantidad = array();
for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_assoc($res);
    $idProducto = $row['id_producto'];
    $cantidad[$i] = $row['cantidad'];
    $id[$i] = $idProducto;
}

// Extrae el stock
$stock = array();
for ($a = 0; $a < $num; $a++) {
    $idProducto = $id[$a];
    $sql = "SELECT stock FROM productos WHERE id = $idProducto";
    $resn = mysqli_query($con, $sql);
    $stockProducto = mysqli_fetch_assoc($resn)['stock'];
    $stock[$a] = $stockProducto;
}

// Actualiza el stock
for ($b = 0; $b < $num; $b++) {
    $idProducto = $id[$b];
    $stockProducto = $stock[$b];
    $cantidad3 = $cantidad[$b];
    $updatestock = $stockProducto - $cantidad3;
    $sql = "UPDATE productos SET stock = $updatestock WHERE id = $idProducto";
    $res = mysqli_query($con, $sql);
}

// Cambia status a cerrado
$sql = "UPDATE pedidos SET status = 1 WHERE id = $idPedido AND usuario = $usuario";
$res = mysqli_query($con, $sql);

if ($res) {
    $resultband = 1;
    echo $resultband;
} else {
    $resultband = 0;
    echo $resultband;
}
?>
