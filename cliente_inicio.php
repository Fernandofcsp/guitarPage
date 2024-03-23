<?php
session_start();
if (isset($_SESSION['usuario'])) {
    echo "<script>location.href='index.php';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-wVeN2CKY0ShI94ijCyCPvLV+PbMnbNAEsXwg2TjHrM5LbZtCjI0C0wG+QWrpwkR" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-FcXg25KPjLq6Db0Vr+02pzlXOeWFKxx3/b2rsb9iBEKwbjE2F8sMymcwO2G2a4Jp" crossorigin="anonymous"></script>
</head>

<body>
    <?php include("menu.php"); ?>
    <br><br>
    <div class="container">
        <form name="forma01">
            <div class="text-center">
                <img src="../images/logo2.png" width="370px" height="230px">
                <h1 class="mb-3">Inicia Sesión</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <td class="bg-dark text-white">Correo</td>
                            </tr>
                            <tr>
                                <td><input type="email" name="correo" id="correo" class="form-control" placeholder="Usuario (email)" size="30"></td>
                            </tr>
                            <tr>
                                <td class="bg-dark text-white">Contraseña</td>
                            </tr>
                            <tr>
                                <td><input type="password" name="pasw" id="pasw" class="form-control" placeholder="Password" size="30"></td>
                            </tr>
                        </table>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-secondary btn-lg" onClick="recibe(); return false;" type="submit">Entrar</button>
                    </div>
                    <br>
                    <div class="text-center" id="mensaje" style="color:#F00;font-size:16px;"></div>
                </div>
            </div>
        </form>
        <div class="text-center mt-3">
            <p class="text-white">¿No tienes una cuenta? <a href="cliente_registro.php" class="text-decoration-none">Crear cuenta</a></p>
        </div>
    </div>

    <script>
        function validacion() {
            var user = $('#correo').val();
            var pass = $('#pasw').val();

            $.ajax({
                url: './funciones/ValidaUsuario.php',
                type: 'post',
                data: {
                    user: user,
                    pass: pass
                },
                success: function(resultband) {
                    if (resultband == 0) {
                        window.location.href = 'index.php';
                    } else if (resultband == 1) {
                        $('#mensaje').html('Error, usuario inexistente o contraseña incorrecta').show();
                        setTimeout(function() {
                            $('#mensaje').html('').show();
                        }, 5000);
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        }

        function recibe() {
            var correo = $('#correo').val();
            var pasw = $('#pasw').val();

            if (pasw == "" || correo == "") {
                $('#mensaje').html('Faltan campos por llenar').show();
                setTimeout(function() {
                    $('#mensaje').html('').show();
                }, 5000);
            } else {
                validacion();
            }
        }
    </script>
    <?php include("piedePagina.php"); ?>
</body>

</html>
