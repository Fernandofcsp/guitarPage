<?php
require "./funciones/conecta.php";
$con = conecta();

// Verificar si se ha subido un archivo
if(isset($_FILES['archivo']) && !empty($_FILES['archivo']['name'])) {
    $file_name = $_FILES['archivo']['name'];
    $file_tmp  = $_FILES['archivo']['tmp_name'];
    $cadena    = explode(".", $file_name);
    $ext       = end($cadena); // Obtenemos la extensión del archivo
    $dir       = "../archivos/";
    $file_enc  = md5_file($file_tmp);
    
    // Mover el archivo al directorio destino
    $fileName1 = "$file_enc.$ext";
    move_uploaded_file($file_tmp, $dir.$fileName1);
}

// Recibir variables
$id            = $_POST['id'] ?? '';
$correoexcep   = $_POST['correoexception'] ?? '';
$nombre        = $_POST['nombre'] ?? '';
$apellidos     = $_POST['apellidos'] ?? '';
$correo        = $_POST['correo'] ?? '';
$pasw          = $_POST['pasw'] ?? '';
$archivo_n     = $file_name ?? '';

$tx = '';
$ar = '';
$a_n = '';

// Verificar si se proporcionó una contraseña
if (!empty($pasw)) {
    $pasw = md5($pasw);
    $tx   = ", pass = '$pasw'";
}

// Verificar si se proporcionó un archivo
if (!empty($archivo_n)) {
    $a_n     = ", archivo_n = '$archivo_n'";
    $archivo = $file_enc.'.'.$ext;
    $ar      = ", archivo = '$archivo'";
}

// Consultar si el correo ya existe
$sql = "SELECT * FROM clientes WHERE correo = '$correo'";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

// Actualizar si el correo no existe o si es el mismo que el correo excepción
if ($num < 1 || $correo == $correoexcep) {
    $sql = "UPDATE clientes
            SET nombre = '$nombre', apellidos = '$apellidos',
            correo = '$correo' $tx $a_n $ar
            WHERE id = $id";
    $res = mysqli_query($con, $sql);

        session_start();
        $_SESSION['nombre2']    = $nombre.' '.$apellidos;
}

// Redireccionar a la página de perfil
echo "<script>location.href='perfil.php';</script>";
die();
?>
