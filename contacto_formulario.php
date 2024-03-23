<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CONTACTO</title>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    function enviarCorreo() {
        var nombre = $('#nombre').val();
        var correo = $('#correo').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        if(nombre !== "" && correo !== "" && subject !== "" && message !== "") {
            $.ajax({
                url: 'contacto_envia.php',
                type: 'post',
                data: { nombre: nombre, correo: correo, subject: subject, message: message },
                success: function(resultband) {
                    if (resultband == 1) {
                        $('#mensaje').html('Correo enviado exitosamente').show();
                        setTimeout(function() { 
                            $('#mensaje').html('').show();
                        }, 5000);
                        // Limpiar los campos después del envío exitoso
                        $('#nombre').val('');
                        $('#correo').val('');
                        $('#subject').val('');
                        $('#message').val('');
                    } else {
                        $('#mensaje').html('Error al enviar el correo.').show();
                        setTimeout(function() {
                            $('#mensaje').html('').show();
                        }, 5000);
                    }
                },
                error: function() {
                    alert('Error archivo no encontrado...');
                }
            });
        } else {
            $('#mensaje').html('Faltan campos por llenar').show();
            setTimeout(function() {
                $('#mensaje').html('').show();
            }, 5000);
        }
    }
  </script>
</head>
<body>
  <?php include("menu.php"); ?>
  <br>
  <div class="text-center">
  <img class="p-4 img-fluid" src="../images/contacto2.png" width="220px" height="200px">
  </div>
  
  <form>
    <table class="table table-dark w-auto" border="1" width="800" height="200" align="center" valign="middle" bordercolor="white" style="color:white;">
      <tr>
        <td><input type="text" name="nombre" id="nombre" size="43" placeholder="Nombre" required></td>
      </tr>
      <tr>
        <td><input type="email" name="correo" id="correo" size="43" placeholder="Correo" required></td>
      </tr>
      <tr>
        <td><input type="text" name="subject" id="subject" size="43" placeholder="Asunto" required></td>
      </tr>
      <tr>
        <td><textarea cols="45" rows="8" name="message" id="message" placeholder="Mensaje" required></textarea></td>
      </tr>
    </table>
    <p><input class="btn btn-light" type="button" value="Enviar" onclick="enviarCorreo();">
    <div id="mensaje" style="color:#F00;font-size:16px;"></div>
  </form>
  <br><br><br><br>
</body>
<?php include("piedePagina.php"); ?>
</html>
