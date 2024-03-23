<!DOCTYPE html>
<html>

<head>
    <title>Formulario Registro</title>
    <script src="./js/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">

    <script>
        function validacion(mail) {
            if (mail !== '') {
                $.ajax({
                    url: './funciones/VerificaCorreo.php',
                    type: 'post',
                    dataType: 'text',
                    data: 'correo=' + mail,
                    success: function(resultband) {
                        if (resultband == 1) {
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
            var pasw = document.forma01.pasw.value;

            if (nombre !== '' && apellidos !== '' && pasw !== '' && correo !== '') {
                document.forma01.method = 'post';
                document.forma01.enctype = 'multipart/form-data';
                document.forma01.action = 'cliente_salva.php';
                document.forma01.submit();
            } else {
                $('#mensaje').html('Faltan campos por llenar').show();
                setTimeout(function() {
                    $('#mensaje').html('').show();
                }, 5000);
                if (nombre === '') {
                    $('#campo1').focus();
                } else if (apellidos === '') {
                    $('#campo2').focus();
                } else if (correo === '') {
                    $('#correo').focus();
                } else if (pasw === '') {
                    $('#pasw').focus();
                } else {
                    validacion(correo);
                }
            }
        }
    </script>
    <meta charset="utf-8" /> <!--elimina el ï»¿ al inicio-->
</head>

<body>
    <?php include("menu.php"); ?>
    <br><br>
    <form name="forma01">
        <img src="../images/registro.png" width="220px" height="200px">
        <h1 class="text-center">Registro de Usuarios</h1>
        <table class="table table-dark w-auto" border="2" bordercolor="black" bgcolor="white" width="100" height="50" style="margin: 0 auto;">
            <tr>
                <td style="background-color:#85929E;height:25px;">Nombre(s)</td>
                <td style="background-color:#85929E;height:25px;">Apellido(s)</td>
            </tr>
            <tr>
                <td><input size="19" id="campo1" type="text" name="nombre" placeholder="Nombres" required></td>
                <td><input size="19" id="campo2" type="text" name="apellidos" placeholder="Apellidos" required></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#85929E;height:25px;">Correo</td>
            </tr>
            <tr>
                <td colspan="2"><input size="40" type="email" name="correo" placeholder="Correo" onBlur="validacion(value);"></td>
            </tr>
            <tr>
                <td colspan="2" style="background-color:#85929E;height:25px;">Contraseña</td>
            </tr>
            <tr>
                <td colspan="2"><input size="40" type="password" name="pasw" placeholder="Contraseña"></td>
            </tr>
        </table>
        <br>
        <button class="btn btn-secondary btn-lg" onClick="recibe(); return false;" type="submit">Registrarse</button>
        <br><br>
        <div class="text-center" id="mensaje" style="color:#F00;font-size:16px;"></div>
    </form>
    <?php include("piedePagina.php"); ?>
</body>

</html>
