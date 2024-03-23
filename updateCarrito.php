<?php
session_start();
require "./funciones/conecta.php"; // Asumiendo que conecta.php contiene la configuración de la conexión a la base de datos

// Establecer conexión a la base de datos utilizando MySQLi
$con = conecta();

// Verificar la conexión
if ($con->connect_error) {
    die("Error de conexión: " . $con->connect_error);
}

// Recibir variables
$idProducto = $_POST['idProducto'];
$cantidad = $_POST['cantidad'];
$idPedido = $_POST['idPedido'];

// Actualizar cantidad
$sql = "UPDATE pedidos_productos SET cantidad = ? WHERE id_pedido = ? AND id_producto = ?";
if ($stmt = $con->prepare($sql)) {
    $stmt->bind_param("iii", $cantidad, $idPedido, $idProducto);
    if ($stmt->execute()) {
        $resultband = 1; // Éxito
    } else {
        $resultband = 0; // Error
    }
    $stmt->close();
} else {
    $resultband = 0; // Error
}

// Cerrar la conexión
$con->close();

// Devolver el resultado al cliente
echo $resultband;
?>
