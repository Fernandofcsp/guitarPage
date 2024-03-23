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
$vArchivo      = $_POST['vArchivo'];
$id            = $_POST['id'];
$nombre        = $_POST['nombre'];
$archivo_n     = $file_name;

if ($archivo_n != ''){
    $a_n   = ", archivo_n = '$archivo_n'";
    $archivo       = $file_enc.'.'.$ext;
    $ar   = ", archivo = '$archivo'";
}
//Actualiza en BD
$sql = "UPDATE banners
        SET nombre = '$nombre' $ar
        WHERE id = $id";
$res = mysql_query($sql, $con);

echo "<script>location.href='banners_lista.php';</script>";
die();

?>