<?php
require "./funciones/conecta.php";
$con = conecta();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $file_name = $_FILES['archivo']['name'];
    $file_tmp  = $_FILES['archivo']['tmp_name'];
    $cadena    = explode(".", $file_name);
    $ext       = end($cadena);
    $dir       = "../archivos/";
    $file_enc  = md5_file($file_tmp);

    if (!empty($file_name)) {
        $fileName1 = "$file_enc.$ext";
        move_uploaded_file($file_tmp, $dir . $fileName1);
    }

    // Recibe variables
    $nombre    = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $correo    = $_POST['correo'];
    $Rol       = $_POST['Rol'];
    $pasw      = $_POST['pasw'];
    $archivo_n = $file_name;
    $archivo   = $file_enc . '.' . $ext;
    $passEnc   = md5($pasw);

    // Verifica existencia y ayuda a validar que no se envíen datos al formulario si el correo ya existe
    $sql = "SELECT * FROM administradores WHERE correo = '$correo'";
    $res = mysqli_query($con, $sql);
    $num = mysqli_num_rows($res);
    if ($num < 1) {
        // Inserta en BD
        $sql = "INSERT INTO administradores VALUES 
        (0, '$nombre', '$apellidos', '$correo', '$passEnc', '$Rol', '$archivo_n', '$archivo', '1', '0')";
        mysqli_query($con, $sql);
        
        header("Location: administradores_lista.php");
        exit();
    }
}
?>
