<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administracion de cursos</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl"
      crossorigin="anonymous"
    />
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>
 <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
 <script>
   function asignaTema(nivel){
       if(nivel == 1){
           //alert(nivel);
        var idTema = $('#nFilas').val();
       } else if (nivel == 2){
        var idTema = $('#nFilas2').val();
       }else if (nivel == 3){
        var idTema = $('#nFilas3').val();
       }
    
    $.ajax({
			url      : 'asignatema.php',
			type     : 'post',
			data: { "idTema" : idTema, "nivel" : nivel},
			success  : function(resultband) {
				if (resultband==1){  //bandera
                if(nivel == 1){
                    $('#mensaje').html('Tema agregado correctamente').show(); //Permite que se vuelva a mostrar despues de ser ocultado
					setTimeout(function(){  location.reload();},1000);
                } else if (nivel == 2){
                    $('#mensaje2').html('Tema agregado correctamente').show(); //Permite que se vuelva a mostrar despues de ser ocultado
					setTimeout(function(){  location.reload();},1000);
                }else if (nivel == 3){
                    $('#mensaje3').html('Tema agregado correctamente').show(); //Permite que se vuelva a mostrar despues de ser ocultado
					setTimeout(function(){  location.reload();},1000);
                }
					

				} else {
                    if(nivel == 1){
                    $('#mensaje').html('No has seleccionado nada').show();
					setTimeout(function(){ $('#mensaje').html('').show();},2000);
                } else if (nivel == 2){
                    $('#mensaje2').html('No has seleccionado nada').show();
					setTimeout(function(){ $('#mensaje2').html('').show();},2000);
                }else if (nivel == 3){
                    $('#mensaje3').html('No has seleccionado nada').show();
					setTimeout(function(){ $('#mensaje3').html('').show();},2000);
                }
					
				}
			}, error: function() {
				alert('Error archivo no encontrado...');
			}
		});
        
        
  }
  function eliminarFilas(fila) {
        
				if(confirm("¿Estas seguro?")){
					$.ajax({
						url      : 'eliminatemacurso.php',
						type     : 'post',
						dataType : 'text',
						//data   : 'id=55&var2=89&var3=adios',
						data     : 'id='+fila,
						success  : function(resultband) {
							if (resultband==1){  //bandera
								nombreFila = "filas"+fila;
								fila = document.getElementById(nombreFila);  //Obtiene el nombre de la fila
								$(fila).hide();  //Oculta la fila
								
								$('#mensaje').html('Tema eliminado del curso').show(); //Permite que se vuelva a mostrar despues de ser ocultado
								setTimeout(function(){ location.reload();},1000); 
							} else {
								$('#mensaje').html('Error en la eliminacion.').show();
								$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
								alert('No se borro');
							}
						}, error: function() {
							alert('Error archivo no encontrado...');
						}
					});
				}
			}
 </script>
</head>
<body>
<?php include("Menu.php"); ?>
<table  class="table table-dark w-auto" border="1" width="800" height="200" align="center" valign="middle" bordercolor="white" style="color:white;">";
<tr>
<td colspan="8">Nivel 1: Basico</td>
</tr>
<tr>
<td>#</td>
<td>ID</td>
<td>TITULO</td>
<td>FECHA</td>	
<td>AUTOR</td>
<td colspan="3">ACCIONES</td>		
<tr>		
    <?php
    require "./funciones/conecta.php";
    $con = conecta();
    
    $sql = "SELECT *
            FROM temas
            WHERE status = 2 AND eliminado = 0 ";
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);

        for ($i = 0; $i < $num; $i++){
            $id          = mysql_result($res, $i, "id");
            $titulo      = mysql_result($res, $i, "titulo");
            $fecha   = mysql_result($res, $i, "fecha");
			$id_administrador =	mysql_result($res, $i, "id_administrador");
			$sql = "SELECT *
					FROM administradores
					WHERE id = $id_administrador";
			$resN = mysql_query($sql, $con);
			$nombre   = mysql_result($resN, 0, "nombre");
			$apellidos   = mysql_result($resN, 0, "apellidos");
			$autor = $nombre." ".$apellidos;

		$concatenacion = 'filas' . $id;
		
		$contador = $i+1;
        echo"<tr id=$concatenacion >";
        echo"<td>$contador</td>";
        echo"<td>$id</td>";
        echo"<td>$titulo</td>";
        echo"<td>$fecha</td>";
        echo"<td>$autor</td>";
        echo"<td><input type=\"button\" style=\"background-color:#00ffff;border-color:black;padding:3px;\" id =\"vdet\" value=\"Ver detalle\" onclick = \"location='temas_detalle.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#FFFFFF;border-color:black;padding:3px;\" id =\"vedit\" value=\"Editar\" onclick = \"location='temas_edita.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#ff4040;border-color:black;padding:3px;\" value=\"Eliminar del Curso\" href=\"javascript:void(0);\" onclick = \"eliminarFilas($id);\"  ></td>";
        echo"</tr>";
        }
        ?>
</tr>
<tr>
<td colspan="2">Asignacion de temas:</td>
<td colspan="3">
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM temas WHERE status = 1 AND eliminado = 0";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
$titulo = array();
$id = array();
for ($i = 0; $i < $num; $i++){
    $titulo2[$i]      = mysql_result($res, $i, "titulo");
    $id2[$i]      = mysql_result($res, $i, "id");
}
echo"<select name=\"tabla\" id=\"nFilas\">";
echo"<option value=\"0\" selected>Selecciona un tema a asignar</option>";
for ($z = 0; $z < $num; $z++){
    $titulo = $titulo2[$z];
    $id = $id2[$z];
  echo"<option value=\"$id\">$titulo</option>";
  }
echo"</select>";

?>
</td>
<td colspan="3"><button id="botonGuardar" type="button" class="btn btn-light" onclick = "asignaTema(1);">Asignar Tema al Curso</button></td>
</tr>
<tr><td id="mensaje" style="color:#FFFFFF;font-size:16px;" colspan="8"></td></tr>

</table>
<?php

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------Tabla 2
?> 
<table  class="table table-dark w-auto" border="1" width="800" height="200" align="center" valign="middle" bordercolor="white" style="color:white;">";
<tr>
<td colspan="8">Nivel 2: Intermedio</td>
</tr>
<tr>
<td>#</td>
<td>ID</td>
<td>TITULO</td>
<td>FECHA</td>	
<td>AUTOR</td>
<td colspan="3">ACCIONES</td>		
<tr>		
    <?php
    require "./funciones/conecta.php";
    $con = conecta();
    
    $sql = "SELECT *
            FROM temas
            WHERE status = 3 AND eliminado = 0 ";
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);

        for ($i = 0; $i < $num; $i++){
            $id          = mysql_result($res, $i, "id");
            $titulo      = mysql_result($res, $i, "titulo");
            $fecha   = mysql_result($res, $i, "fecha");
			$id_administrador =	mysql_result($res, $i, "id_administrador");
			$sql = "SELECT *
					FROM administradores
					WHERE id = $id_administrador";
			$resN = mysql_query($sql, $con);
			$nombre   = mysql_result($resN, 0, "nombre");
			$apellidos   = mysql_result($resN, 0, "apellidos");
			$autor = $nombre." ".$apellidos;

		$concatenacion = 'filas' . $id;
		
		$contador = $i+1;
        echo"<tr id=$concatenacion >";
        echo"<td>$contador</td>";
        echo"<td>$id</td>";
        echo"<td>$titulo</td>";
        echo"<td>$fecha</td>";
        echo"<td>$autor</td>";
        echo"<td><input type=\"button\" style=\"background-color:#00ffff;border-color:black;padding:3px;\" id =\"vdet\" value=\"Ver detalle\" onclick = \"location='temas_detalle.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#FFFFFF;border-color:black;padding:3px;\" id =\"vedit\" value=\"Editar\" onclick = \"location='temas_edita.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#ff4040;border-color:black;padding:3px;\" value=\"Eliminar del Curso\" href=\"javascript:void(0);\" onclick = \"eliminarFilas($id);\"  ></td>";
        echo"</tr>";
        }
        ?>
</tr>
<tr>
<td colspan="2">Asignacion de temas:</td>
<td colspan="3">
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM temas WHERE status = 1 AND eliminado = 0";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
$titulo = array();
$id = array();
for ($i = 0; $i < $num; $i++){
    $titulo2[$i]      = mysql_result($res, $i, "titulo");
    $id2[$i]      = mysql_result($res, $i, "id");
}
echo"<select name=\"tabla\" id=\"nFilas2\">";
echo"<option value=\"0\" selected>Selecciona un tema a asignar</option>";
for ($z = 0; $z < $num; $z++){
    $titulo = $titulo2[$z];
    $id = $id2[$z];
  echo"<option value=\"$id\">$titulo</option>";
  }
echo"</select>";

?>
</td>
<td colspan="3"><button id="botonGuardar" type="button" class="btn btn-light" onclick = "asignaTema(2);">Asignar Tema al Curso</button></td>
</tr>
<tr><td id="mensaje2" style="color:#FFFFFF;font-size:16px;" colspan="8"></td></tr>

</table>
<?php 
//----------------------------------------------------------------------------------------------------------------------------------------------------------------------Tabla 3
?>
<table  class="table table-dark w-auto" border="1" width="800" height="200" align="center" valign="middle" bordercolor="white" style="color:white;">";
<tr>
<td colspan="8">Nivel 3: Avanzado</td>
</tr>
<tr>
<td>#</td>
<td>ID</td>
<td>TITULO</td>
<td>FECHA</td>	
<td>AUTOR</td>
<td colspan="3">ACCIONES</td>		
<tr>		
    <?php
    require "./funciones/conecta.php";
    $con = conecta();
    
    $sql = "SELECT *
            FROM temas
            WHERE status = 4 AND eliminado = 0 ";
    $res = mysql_query($sql, $con);
    $num = mysql_num_rows($res);

        for ($i = 0; $i < $num; $i++){
            $id          = mysql_result($res, $i, "id");
            $titulo      = mysql_result($res, $i, "titulo");
            $fecha   = mysql_result($res, $i, "fecha");
			$id_administrador =	mysql_result($res, $i, "id_administrador");
			$sql = "SELECT *
					FROM administradores
					WHERE id = $id_administrador";
			$resN = mysql_query($sql, $con);
			$nombre   = mysql_result($resN, 0, "nombre");
			$apellidos   = mysql_result($resN, 0, "apellidos");
			$autor = $nombre." ".$apellidos;

		$concatenacion = 'filas' . $id;
		
		$contador = $i+1;
        echo"<tr id=$concatenacion >";
        echo"<td>$contador</td>";
        echo"<td>$id</td>";
        echo"<td>$titulo</td>";
        echo"<td>$fecha</td>";
        echo"<td>$autor</td>";
        echo"<td><input type=\"button\" style=\"background-color:#00ffff;border-color:black;padding:3px;\" id =\"vdet\" value=\"Ver detalle\" onclick = \"location='temas_detalle.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#FFFFFF;border-color:black;padding:3px;\" id =\"vedit\" value=\"Editar\" onclick = \"location='temas_edita.php?id=$id'\" ></td>";
        echo"<td><input type=\"button\" style=\"background-color:#ff4040;border-color:black;padding:3px;\" value=\"Eliminar del Curso\" href=\"javascript:void(0);\" onclick = \"eliminarFilas($id);\"  ></td>";
        echo"</tr>";
        }
        ?>
</tr>
<tr>
<td colspan="2">Asignacion de temas:</td>
<td colspan="3">
<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT * FROM temas WHERE status = 1 AND eliminado = 0";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
$titulo = array();
$id = array();
for ($i = 0; $i < $num; $i++){
    $titulo2[$i]      = mysql_result($res, $i, "titulo");
    $id2[$i]      = mysql_result($res, $i, "id");
}
echo"<select name=\"tabla\" id=\"nFilas3\">";
echo"<option value=\"0\" selected>Selecciona un tema a asignar</option>";
for ($z = 0; $z < $num; $z++){
    $titulo = $titulo2[$z];
    $id = $id2[$z];
  echo"<option value=\"$id\">$titulo</option>";
  }
echo"</select>";

?>
</td>
<td colspan="3"><button id="botonGuardar" type="button" class="btn btn-light" onclick = "asignaTema(3);">Asignar Tema al Curso</button></td>
</tr>
<tr><td id="mensaje3" style="color:#FFFFFF;font-size:16px;" colspan="8"></td></tr>

</table>
</body>
</html>


