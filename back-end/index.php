<?php
session_start();
if (isset($_SESSION['idU']) && $_SESSION['idU']) {
    echo "<script>location.href='bienvenido.php';</script>";
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>

    <script>
        function validacion() {
            var user = $('#correo').val();
            var pass = $('#pasw').val();

            $.ajax({
                url: './funciones/ValidaUsuario.php', // Verifica la ruta de ValidaUsuario.php
                type: 'post',
                data: {
                    user: user,
                    pass: pass
                },
                success: function(resultband) {

                    if (resultband == 0) { //bandera
                        window.location.href = 'bienvenido.php';
                    } else if (resultband == 1) {
                        $('#mensaje').html('Error, usuario inexistente o contraseña incorrecta').show(); //Permite que se vuelva a mostrar después de ser ocultado
                        setTimeout(function() {
                            $('#mensaje').html('').show();
                        }, 5000);
                    }
                },
                error: function() {
                    alert('Error: archivo no encontrado'); // Muestra una alerta si hay un error con la ruta del archivo
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

</head>

<body class="bg-dark">
    <div class="container mt-5">
        <div class="card mx-auto border border-secondary text-white" style="max-width: 500px; background-color: #2d3748;">
            <div class="card-header">
                <h1 class="text-center">Inicia Sesión</h1>
            </div>
            <div class="card-body">
                <form name="forma01">
                    <div class="form-group">
                        <label for="correo">Usuario (email)</label>
                        <input type="email" name="correo" id="correo" class="form-control" placeholder="Usuario (email)">
                    </div>
                    <div class="form-group">
                        <label for="pasw">Contraseña</label>
                        <input type="password" name="pasw" id="pasw" class="form-control" placeholder="Contraseña">
                    </div>
                    <div class="form-group text-center">
                        <button type="button" class="btn btn-primary" onclick="recibe(); return false;">Entrar</button>
                    </div>
                    <div class="form-group text-center" id="mensaje" style="color:#F00;font-size:16px;"></div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
