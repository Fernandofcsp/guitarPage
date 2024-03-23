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
$codigoexception   = $_POST['codigoexception'];
$nombre        = $_POST['nombre'];
$codigo     = $_POST['codigo'];
$descripcion        = $_POST['descripcion'];
$costo          = $_POST['costo'];
$stock          = $_POST['stock'];
$archivo_n     = $file_name;


if ($archivo_n != ''){
    $a_n   = ", archivo_n = '$archivo_n'";
    $archivo       = $file_enc.'.'.$ext;
    $ar   = ", archivo = '$archivo'";
}




$sql = "SELECT * FROM productos
WHERE codigo = '$codigo'";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);

//Permite actualizar sin cambiar el correo, utilizar el que es por defecto.
if($codigo == $codigoexception){
    $sql = "UPDATE productos
		SET nombre = '$nombre', codigo = '$codigo',
        descripcion = '$descripcion', costo = '$costo', stock= '$stock' $a_n $ar
        WHERE id = $id";
    $res = mysql_query($sql, $con);
}
//verifica existencia y ayuda a validar que no se envien datos al formulario si el correo ya existe
if ($num < 1){
//Actualiza en BD
    $sql = "UPDATE productos
            SET nombre = '$nombre', codigo = '$codigo',
            descripcion = '$descripcion', costo = '$costo', stock= '$stock' $a_n $ar
            WHERE id = $id";
    $res = mysql_query($sql, $con);
}

echo "<script>location.href='productos_lista.php';</script>";
die();

?>