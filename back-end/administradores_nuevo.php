<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario agregar</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
    <!-- Bootstrap JS (jQuery is already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        function validacion(mail) {
            if (mail != '') {
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
            var Rol = document.forma01.Rol.value;
            var pasw = document.forma01.pasw.value;
            var archivo = document.forma01.archivo.file;
            var vArchivo = document.getElementById('archivo').value;
            var valide = $('#destino').val();

            if (nombre != "" && apellidos != "" && pasw != "" && Rol != "0" && correo != "" && vArchivo != 0 && valide == 0) {
                document.forma01.method = 'post';
                document.forma01.enctype = 'multipart/form-data';
                document.forma01.action = 'administradores_salva.php';
                document.forma01.submit();

            } else if (nombre == "" || apellidos == "" || pasw == "" || Rol == "0" || correo == "" || vArchivo == 0 || valide == 1) {
                if (nombre != "" && apellidos != "" && pasw != "" && Rol != "0" && correo != "" && vArchivo != 0 && valide == 1) {
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

    <meta charset="utf-8" /> <!--elimina el ï»¿ al inicio-->
</head>

<body>
    <?php include("Menu.php"); ?>
    <br><br>
    <div class="container">
        <div class="card bg-dark">
            <div class="card-body">
                <form name="forma01">
                    <div class="text-left mb-3 ml-4">
                        <a href="administradores_lista.php" class="btn btn-light">Regresar al listado</a>
                    </div>
                    <h1 class="text-center mt-4">Registro de Usuarios</h1>
                    <div class="row justify-content-left text-justify">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-white" for="nombre">Nombre(s)</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombres" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="text-white" for="apellidos">Apellido(s)</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for="correo">Correo</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo" onBlur="validacion(value);" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for="pasw">Contraseña</label>
                                <input type="password" class="form-control" id="pasw" name="pasw" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for="Rol">Rol</label>
                                <select class="form-control" id="Rol" name="Rol" required>
                                    <option value="0" selected>-Selecciona Rol-</option>
                                    <option value="1">Empleado</option>
                                    <option value="2">Administrador</option>
                                </select>
                            </div>
                        </div>
                        
                        
                        
                    </div>
                    <div class="col-12">
                            <div class="form-group">
                                <label class="text-white" for="archivo">Foto de perfil</label>
                                <input class="btn btn-light" type="file" class="form-control-file" id="archivo" name="archivo" required>
                            </div>
                        </div>
                    <div class="col-12">
                            <button type="submit" class="btn btn-primary text-center" onclick="recibe(); return false;">Registrar Usuario</button>
                        </div>
                            <div id="mensaje" style="color:#F00;font-size:16px;"></div>
                            <input type="hidden" id="destino" style="color:#F00;font-size:16px;">
                </form>
            </div>
        </div>
    </div>
    <?php include("piedePagina.php"); ?>
</body>

</html>
