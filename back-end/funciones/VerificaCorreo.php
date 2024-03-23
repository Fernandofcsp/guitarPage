<?php
require "conecta.php";
$con = conecta();

// Recibir variables
$correo = $_POST['correo'];

// Verificar existencia
$sql = "SELECT * FROM clientes WHERE correo = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "s", $correo);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($result);

if ($num >= 1) {
    $resultband = 1;
    echo $resultband;
} else {
    $resultband = 0;
    echo $resultband;
}

// Cerrar la conexión
mysqli_stmt_close($stmt);
mysqli_close($con);
?>
