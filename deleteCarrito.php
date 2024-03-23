<?php
// Este script permite modificar en tiempo real las cantidades del carrito
session_start();
require "./funciones/conecta.php";
$con = conecta();

// Recibe variables
$idProducto = $_REQUEST['idProducto'];
$idPedido = $_REQUEST['idPedido'];

// Actualiza cantidad
$sql = "DELETE FROM pedidos_productos 
        WHERE id_pedido = ? AND id_producto = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $idPedido, $idProducto);
$stmt->execute();

$resultband = 1;
echo $resultband;
?>
