<?php
require "./funciones/conecta.php";
$con = conecta();

//Recibe variables
$id = $_REQUEST['id'];

if ($id > 0) {
	//$sql = "DELETE FROM administradores WHERE id = $id";
	$sql = "UPDATE banners
			SET eliminado = 1 WHERE id= $id";
	$res = mysql_query($sql, $con);
	$resultband = 1;
	echo $resultband;
}

//echo "<script>location.href='administradores_lista.php';</script>";
//die();

?>