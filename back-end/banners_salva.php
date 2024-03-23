<?php
require "./funciones/conecta.php";
$con = conecta();

$file_name = $_FILES['archivo']['name'];
$file_tmp  = $_FILES['archivo']['tmp_name'];
$cadena    = explode(".", $file_name);
$ext       = $cadena[1];
$dir       = "../archivos/";
$file_enc  = md5_file($file_tmp);

if($file_name != ''){
        $fileName1 = "$file_enc.$ext";
        copy($file_tmp, $dir.$fileName1);
}

//recibe variables
$nombre        = $_POST['nombre'];
$archivo_n     = $file_name;
$archivo       = $file_enc.'.'.$ext;

//inserta en BD
$sql = "INSERT INTO banners VALUES 
(0, '$nombre', '$archivo', '1', '0')";
$res = mysql_query($sql, $con);

echo "<script>location.href='banners_lista.php';</script>";
die();
?>