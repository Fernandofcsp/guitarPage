<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
$sql = "SELECT *
        FROM administradores
        WHERE status = 1 AND eliminado = 0";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualizar administradores</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
    <!-- Bootstrap JS (jQuery is already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validacion(mail) {
            var correoexception = $('#correoexception').val();

            if (mail != '') {
                $.ajax({
                    url: './funciones/VerificaCorreo.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'correo=' + mail,
                    success: function(resultband) {
                        if (resultband == 1 && correoexception != mail) {
                            $('#mensaje').html('Error, el correo ' + mail + ' ya existe').show();
                            setTimeout(function() {
                                $('#mensaje').html('').show();
                            }, 5000);
                            $('#destino').val(resultband);
                        } else {
                            $('#mensaje').html('').show();
                            setTimeout(function() {
                                $('#mensaje').html('').show();
                            }, 5000);
                            $('#destino').val(resultband);
                        }
                    },
                    error: function() {
                        alert('Error archivo no encontrado...');
                    }
                });
            }
        }

        function recibe() {
            var nombre = document.forma01.nombre.value;
            var apellidos = document.forma01.apellidos.value;
            var correo = document.forma01.correo.value;
            var Rol = document.forma01.Rol.value;
            var pasw = document.forma01.pasw.value;
            var correoexception = document.forma01.correoexception.value;
            var id = document.forma01.id.value;
            var archivo = document.forma01.archivo.file;
            var vArchivo = document.getElementById('archivo').value;
            var valide = $('#destino').val();

            if (nombre != "" && apellidos != "" && Rol != "0" && correo != "" && valide == 0) {
                document.forma01.method = 'post';
                document.forma01.enctype = 'multipart/form-data';
                document.forma01.action = 'administradores_actualiza.php';
                document.forma01.submit();
            } else if (nombre == "" || apellidos == "" || Rol == "0" || correo == "" || valide == 1) {
                if (correoexception == correo) {
                    document.forma01.method = 'post';
                    document.forma01.enctype = 'multipart/form-data';
                    document.forma01.action = 'administradores_actualiza.php';
                    document.forma01.submit();
                } else if (nombre != "" && apellidos != "" && Rol != "0" && correo != "" && valide == 1) {
                    validacion(correo);
                } else {
                    $('#mensaje').html('Faltan campos por llenar').show();
                    setTimeout(function() {
                        $('#mensaje').html('').show();
                    }, 5000);
                }
            }
        }
    </script>
</head>

<body>
    <?php
    for ($i = 0; $i < $num; $i++) {
        $id          = mysqli_result($res, $i, "id");
        $nombre      = mysqli_result($res, $i, "nombre");
        $apellidos   = mysqli_result($res, $i, "apellidos");
        $correo      = mysqli_result($res, $i, "correo");
        $rol         = mysqli_result($res, $i, "rol");
        $rol_txt  = ($rol == 1) ? 'Empleado' : 'Administrador';

        if ($ids == $id) {
            $nombrec      = mysqli_result($res, $i, "nombre");
            $apellidosc   = mysqli_result($res, $i, "apellidos");
            $correoc      = mysqli_result($res, $i, "correo");
            $rolc        = mysqli_result($res, $i, "rol");
            $rol_txtc  = ($rol == 1) ? 'Empleado' : 'Administrador';
            $idc          = mysqli_result($res, $i, "id");
        }
    }
    ?>
    <?php include("Menu.php"); ?>
    <br><br>
    <form name="forma01">
        <div style="font-size: 30px;margin:0 135 40px;" align="left"><input type="button" id="regresar" value="Regresar al Listado" onclick="location='administradores_lista.php'"></div>
        <h1 class="div2" style="text-align:center;color:white;font-weight:thin;margin:0 0 40px;">Actualizar Datos</h1>
        <table border="2" bordercolor="black" bgcolor="white" width="1000" height="50" style="margin: 0 auto;">
            <tr>
                <td style="background-color:#85929E;height:25px;">Nombre(s)</td>
                <td style="background-color:#85929E;height:25px;">Apellido(s)</td>
            </tr>
            <tr>
                <td><input size="55" id="campo1" type="text" name="nombre" placeholder="Nombres" value="<?php echo $nombrec; ?>" required></td>
                <td><input size="55" id="campo2" type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidosc; ?>" required></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#85929E;height:25px;">Correo</td>
            </tr>
            <tr>
                <td colspan="2"><input size="116" type="email" name="correo" placeholder="Correo" value="<?php echo $correoc; ?>" onBlur="validacion(value);"></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#85929E;height:25px;">Contraseña</td>
            </tr>
            <tr>
                <td colspan="2"><input size="116" type="password" name="pasw" placeholder="Pass(solo si desea cambiar)" value=""></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#85929E;height:25px;">Rol</td>
            </tr>
            <tr>
                <td colspan="2">
                    <select style="width:990px" name="Rol">
                        <option value="1" <?php if ($rolc == 1) echo 'selected'; ?>>Empleado</option>
                        <option value="2" <?php if ($rolc == 2) echo 'selected'; ?>>Administrador</option>
                    </select>
                </td>
            </tr>
        </table>
        <div class="rejilla">
            <h1 class="div2">Cambiar imagen (opcional)</h1>
            <div></div>
            <h1 class="div2"><input type="file" id="archivo" name="archivo" required></h1>
            <div></div>
            <div></div>
            <div></div>
            <div class="div2"><input onClick="recibe(); return false;" type="submit" value="Actualizar"></div>
            <div></div>
            <div class="div2" id="mensaje" style="color:#F00;font-size:16px;"></div>
        </div>
        <input type="hidden" name="correoexception" id="correoexception" value="<?php echo $correoc; ?>">
        <input type="hidden" name="id" value="<?php echo $ids; ?>">
        <div id="destino" style="color:#F00;font-size:16px;"></div>
    </form>
    <?php include("piedePagina.php"); ?>
</body>

</html>
