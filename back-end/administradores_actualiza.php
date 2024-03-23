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
$correoexcep   = $_POST['correoexception'];
$nombre        = $_POST['nombre'];
$apellidos     = $_POST['apellidos'];
$correo        = $_POST['correo'];
$Rol           = $_POST['Rol'];
$pasw          = $_POST['pasw'];
$archivo_n     = $file_name;

$tx            = '';
if ($pasw != ''){
    $pasw = md5($pasw);
    $tx   = ", pass = '$pasw'";
}
if ($archivo_n != ''){
    $a_n   = ", archivo_n = '$archivo_n'";
    $archivo       = $file_enc.'.'.$ext;
    $ar   = ", archivo = '$archivo'";
}




$sql = "SELECT * FROM administradores
WHERE correo = '$correo'";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);

//Permite actualizar sin cambiar el correo, utilizar el que es por defecto.
if($correo == $correoexcep){
    $sql = "UPDATE administradores
		SET nombre = '$nombre', apellidos = '$apellidos',
        correo = '$correo', rol = $Rol $tx $a_n $ar
        WHERE id = $id";
    $res = mysql_query($sql, $con);
}
//verifica existencia y ayuda a validar que no se envien datos al formulario si el correo ya existe
if ($num < 1){
//Actualiza en BD
    $sql = "UPDATE administradores
		    SET nombre = '$nombre', apellidos = '$apellidos',
            correo = '$correo', rol = $Rol $tx $a_n $ar 
            WHERE id = $id";
    $res = mysql_query($sql, $con);
}

echo "<script>location.href='administradores_lista.php';</script>";
die();

?>