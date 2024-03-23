<?php
require "conecta.php";
$con = conecta();

//recibe variables
$codigo             = $_REQUEST['codigo'];


//verifica existencia
    $sql = "SELECT * FROM productos
    WHERE status = 1 AND eliminado = 0 AND codigo = '$codigo'"; //NO debe de permitir continuar si el código ya existe (activo y no eliminado)
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);
    if ($num >= 1){
        $resultband = 1;
        echo $resultband;
    }
	else if($num <= 0){
        $resultband = 0;
        echo $resultband;
    }
?>