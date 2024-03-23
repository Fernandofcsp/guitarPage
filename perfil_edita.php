<!DOCTYPE html>
<html>
<head>
  <title>Formulario Actualizar</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilos personalizados */
        .rounded-img {
            border-radius: 10px; /* Bordes redondeados */
            border: 2px solid #ddd; /* Borde gris */
            padding: 5px; /* Espaciado interior */
        }
    </style>
  <script>
      //function limpiaCampo(){
        //document.forma01.correo.value = '';
      //}
      function validacion(mail){
        var correoexception = $('#correoexception').val();
        
        if (mail != ''){
        $.ajax({
            url      : './funciones/VerificaCorreo.php',
            type     : 'post',
            dataType : 'text',
            data     : 'correo='+mail,
            success  : function(resultband) {
                if (resultband==1 && correoexception != mail){  //bandera
                    $('#mensaje').html('Error, el correo '+mail+' ya existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
                    //$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
                    setTimeout(function(){ //INICIO UN RELOJ 
                       $('#mensaje').html('').show();//OCULTO EL MENSAJE
                    },5000);
                    $('#destino').val(resultband);
                } else {
                    $('#mensaje').html('').show();
                    //$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
                    setTimeout(function(){ //INICIO UN RELOJ 
                       $('#mensaje').html('').show();//OCULTO EL MENSAJE
                    },5000);
                    $('#destino').val(3);
                }
            }, error: function() {
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
          var correoexception = document.forma01.correoexception.value;
          var id = document.forma01.id.value;
          var archivo = document.forma01.archivo.files; 
          var valide = $('#destino').val();

          if(nombre!="" && apellidos!=""  && correo!="" && valide ==3){
            document.forma01.method = 'post';
            document.forma01.enctype = 'multipart/form-data';
            document.forma01.action = 'perfil_actualiza.php';
            document.forma01.submit();
                    
          }
          else if(nombre=="" || apellidos==""  || correo=="" || valide == 0){
            if(correoexception==correo && nombre!="" && apellidos!=""  && correo!=""){
                document.forma01.method = 'post';
                document.forma01.enctype = 'multipart/form-data';
                document.forma01.action = 'perfil_actualiza.php';
                document.forma01.submit();
            }
            else if(nombre!="" && apellidos!=""  && correo!="" && valide ==1){
                validacion(correo);
            }else{
                $('#mensaje').html('Faltan campos por llenar').show(); //Permite que se vuelva a mostrar despues de ser ocultado        
                //$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
                setTimeout(function(){ //INICIO UN RELOJ 
                $('#mensaje').html('').show();//OCULTO EL MENSAJE
                },5000);
            }       
          }
      }

  </script>
</head>

<body>
<?php
require "./funciones/conecta.php";
$con = conecta();
 
session_start();
$ids = $_SESSION['usuario'];
$sql = "SELECT *
         FROM clientes
         WHERE id = $ids";
$res = mysqli_query($con, $sql); // Utilizando mysqli_query para realizar consultas
$num = mysqli_num_rows($res); // Utilizando mysqli_num_rows para obtener el número de filas
 
for ($i = 0; $i < $num; $i++){
    
    $row = mysqli_fetch_assoc($res); // Utilizando mysqli_fetch_assoc para obtener una fila como un array asociativo
    
    $nombrec      = $row['nombre'];
    $apellidosc   = $row['apellidos'];
    $correoc      = $row['correo'];
    $archivo      = $row['archivo'];
}
?>

<?php include("menu.php"); ?>
<br><br>
<form name="forma01" method="post" enctype="multipart/form-data" action="perfil_actualiza.php">
<div class="container">
    <div class="row">
        <div align="left" class="btn-regresar mt-1 mb-4">
            <button type="button" class="btn btn-dark " id="regresar" value="Regresar" onclick="javascript: history.go(-1)">Regresar</button>
        </div>
    </div>
    <div class="row mt-2">
    
        <div class="col-12 text-center">
            <h1 class="text-white fw-light">Foto de Usuario</h1>
           
            <div class="image-container rounded mb-4 "> <!-- Nuevo contenedor con clase image-container -->
                <img src="../archivos/<?php echo $archivo; ?>" width="150" height="150" class="rounded-img mx-auto d-block mb-4"><br><br>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-white fw-light">Actualizar Datos</h1>
        </div>
    </div>
    
    <div class="row justify-content-center mt-4 rounded">
        <div class="col-md-7 ">
            <table class="table table-dark rounded">
                <tr>
                    <td>Nombre(s)</td>
                    <td>Apellido(s)</td>
                </tr>
                <tr>
                    <td ><input class="placeholder col-12 bg-dark text-white rounded p-1" size="20" id="campo1" type="text" name="nombre" placeholder="Nombres" value="<?php echo $nombrec; ?>" required></td>
                    <td><input class="placeholder col-12 bg-dark text-white rounded p-1" size="20" id="campo2" type="text" name="apellidos" placeholder="Apellidos" value="<?php echo $apellidosc; ?>" required></td>
                </tr>
                <tr>
                    <td colspan="2">Correo</td>
                </tr>
                <tr>
                    <td colspan="2"><input class="placeholder col-12 bg-dark text-white rounded p-1" size="50" type="email" name="correo" placeholder="Correo" value="<?php echo $correoc; ?>" onBlur="validacion(value);"></td>
                </tr>
                <tr>
                    <td colspan="2">Contraseña</td>
                </tr>
                <tr>
                    <td colspan="2"><input class="placeholder col-12 bg-dark text-white rounded p-1" size="50" type="password" name="pasw" placeholder="Pass(solo si desea cambiar)" value=""></td>
                </tr>
            </table>
            <p class="text-center text-white">Agregar imagen (opcional)</p>
            <input type="file" id="archivo" name="archivo" class="form-control">
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="text-center">
                <button type="submit" class="btn btn-primary mb-4" onClick="recibe(); return false;" value="Actualizar">Actualizar</button>
            </div>
            <div id="mensaje" class="text-center mt-2" style="color:#F00;font-size:16px;"></div>
            <input type="hidden" name="correoexception" id="correoexception" value="<?php echo $correoc; ?>">
            <input type="hidden" name="id" value="<?php echo $ids; ?>">
            <div id="destino" class="text-center mt-2" style="color:#F00;font-size:16px;"></div>
        </div>
    </div>
</div>
</form>
<?php include("piedePagina.php"); ?>
</body>
</html>
