<?php
session_start();
require "./funciones/conecta.php";
    $con = conecta();
    $idTema        = $_POST['id'];

	$sql  = "DELETE FROM cursos 
			 WHERE id_tema = $idTema";
	$res  = mysql_query($sql, $con);
    
    $sql  = "UPDATE temas SET status = '1' 
			 WHERE id = $idTema";
	$res  = mysql_query($sql, $con);
    $resultband = 1;
    echo"$resultband";
?>
