<?php
//administradores_lista.php
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
        FROM administradores
        WHERE status = 1 AND eliminado = 0 ";
$res = mysqli_query($con, $sql);
$num = mysqli_num_rows($res);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de administradores</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
    <!-- Bootstrap JS (jQuery is already included) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.eliminar').click(function() {
                var id = $(this).data('id');
                if (confirm("¿Estás seguro?")) {
                    $.ajax({
                        url: 'administradores_elimina.php',
                        type: 'post',
                        dataType: 'text',
                        data: 'id=' + id,
                        success: function(resultband) {
                            if (resultband == 1) {
                                $('#fila_' + id).hide();
                                $('#mensaje').html('Usuario eliminado').show().delay(5000).fadeOut();
                            } else {
                                $('#mensaje').html('Error en la eliminación').show().delay(5000).fadeOut();
                                console.log('No se borró');
                            }
                        },
                        error: function() {
                            alert('Error: archivo no encontrado');
                        }
                    });
                }
            });
        });
    </script>

</head>

<body>
    <?php include("Menu.php"); ?>

    <br><br>
    <div class="container-fluid">
        <div class="card bg-dark rounded w-100">
            <div class="card-body">
                <h1 class="card-title text-center my-4">Lista de administradores</h2>
                <div class="text-right mb-3">
                    <a href="administradores_nuevo.php" class="btn btn-primary">Agregar Usuario</a>
                </div>
                <div id="mensaje" style="color:#F00;font-size:16px;"></div>
                <div class="table-responsive">
                    <table class="table text-justify">
                        <thead class="table-dark">
                            <tr>
                                <th width="1%"scope="col">#</th>
                                <th width="1%"scope="col">ID</th>
                                <th scope="col">Nombre completo</th>
                                <th scope="col">Correo</th>
                                <th scope="col">Rol</th>
                                <th width="18%" scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            for ($i = 0; $i < $num; $i++) {
                                $row = mysqli_fetch_assoc($res);
                                $id = $row['id'];
                                $nombre = $row['nombre'];
                                $apellidos = $row['apellidos'];
                                $correo = $row['correo'];
                                $rol = $row['rol'];
                                $rol_txt = ($rol == 2) ? 'Administrador' : 'Empleado';
                                $contador = $i + 1;
                                echo "<tr id='fila_$id'>
                                        <td  class=\"text-justify\">$contador</td>
                                        <td class=\"text-justify\">$id</td>
                                        <td class=\"text-justify\">$nombre $apellidos</td>
                                        <td class=\"text-justify\">$correo</td>
                                        <td class=\"text-justify\" >$rol_txt</td>
                                        <td class=\"text-justify\">
                                            <a href='administradores_detalle.php?id=$id' class='btn btn-info me-2'>Ver detalle</a>
                                            <a href='administradores_edita.php?id=$id' class='btn btn-warning me-2'>Editar</a>
                                            <button class='btn btn-danger eliminar' data-id='$id'>Eliminar</button>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php include("piedePagina.php"); ?>
</body>

</html>

