<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Detalle de Cliente</title>
</head>
<body>
<?php include("menu.php"); ?>
<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
//--------------------------------
$sql = "SELECT *
		FROM progreso_tema
		WHERE id_usuario = $ids AND eliminado = 0";
$res = mysql_query($sql, $con);
$num2 = mysql_num_rows($res);
//---------------------------------
$sql = "SELECT *
		FROM temas
        WHERE status != 1 AND eliminado = 0";
$res = mysql_query($sql, $con);
$num3 = mysql_num_rows($res);
$tema = ($num2*100)/$num3;
//-----------------------------

//--------------------------------
$sql = "SELECT *
		FROM clientes
		WHERE id = $ids";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
//------------------------------

echo"<br>";
for ($i = 0; $i < $num; $i++){
    $archivo    = mysql_result($res, $i, "archivo");
    $id          = mysql_result($res, $i, "id");
    $nombre      = mysql_result($res, $i, "nombre");
    $apellidos   = mysql_result($res, $i, "apellidos");
    $correo      = mysql_result($res, $i, "correo");
    $nivel       = mysql_result($res, $i, "nivel");
    if ($nivel == 1){$nivel_txt  = 'Básico';}
    else if ($nivel == 2){$nivel_txt  = 'Intermedio';}
    else if ($nivel == 3){$nivel_txt  = 'Avanzado';}
    echo"<div  align=\"left\" style=\"margin-left:4%;\"><button type=\"button\" class=\"btn btn-dark\" id =\"regresar\" value=\"Regresar\" onclick = \"javascript: history.go(-1)\">Regresar</button></div>";
    echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Foto de Usuario</h1>";
    echo"<img src=\"../archivos/$archivo\" width=\"150\" height=\"150\"><br><br>";
	echo"<h1 class=\"none\" style=\"text-align:center;color:white;font-weight:thin;margin:0 0 40px;\">Detalle de Usuario</h1>";
    echo"<table class=\"table table-dark\" align=\"center\" style=\"width:30%\">";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;height:25px;\">NOMBRE:</td>";
            echo"<td>$nombre $apellidos</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;height:25px;\">CORREO:</td>";
            echo"<td>$correo</td>";
		echo"</tr>";
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;height:25px;\">Nivel/Curso:</td>";
            echo"<td>$nivel_txt</td>";
		
        echo"<tr height=\"50\" align=\"left\" valign=\"middle\">";
			echo"<td style=\"background-color:#85929E;height:25px;\">Progreso de Temas: </td>";
            echo"<td>";
            echo round($tema, 2);
            echo"% o $num2 de $num3</td>";
		echo"</tr>";
	echo"</table>";
}
?>
</body>
</html>