<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
$sql = "SELECT *
		FROM banners
		WHERE status = 1 AND eliminado = 0";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);
?>
<html>
 <head>
  <title>Formulario Actualizar</title>
  <script src="./js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/Estilos.css">

  <script>
      function recibe() {
		  var nombre = document.forma01.nombre.value;
		  var id = document.forma01.id.value;
          var archivo = document.forma01.archivo.file; 
		  var vArchivo = document.getElementById('archivo').value;

         if(nombre!=""){
            document.forma01.method = 'post';
			document.forma01.enctype = 'multipart/form-data';
			document.forma01.action = 'banners_actualiza.php';
			document.forma01.submit();
					
		  }
		  else if(nombre==""){
			$('#mensaje').html('Faltan campos por llenar').show(); 		
			setTimeout(function(){ $('#mensaje').html('').show();},5000);
		  } 
	  }
  </script>
 </head>

 <body>
 <?php
for ($i = 0; $i < $num; $i++){
    $archivo     = mysql_result($res, $i, "archivo");
    $id          = mysql_result($res, $i, "id");
    $nombre      = mysql_result($res, $i, "nombre");
    $status      = mysql_result($res, $i, "status");
    $eliminado   = mysql_result($res, $i, "eliminado");
    $status_txt  = ($status == $eliminado) ? 'Inactivo' : 'Activo';
    

if($ids == $id){
    $nombrec      = mysql_result($res, $i, "nombre");
    $idc          = mysql_result($res, $i, "id");
}       
}
?>
	<?php include("Menu.php"); ?>
	<br>
	<form name="forma01">
	<div style="font-size: 30px;margin:0 135 40px;" align="left" ><input type="button" id ="regresar" value="Regresar al Listado" onclick = "location='banners_lista.php'"></div>
	<h1 class="div2" style="text-align:center;color:white;font-weight:thin;margin:0 0 40px;">Actualizar Banner</h1>
	<table border="2" bordercolor="black" bgcolor="white" width="1000" height="50"style="margin: 0 auto;" >
	<tr>
	<td colspan="3" style="background-color:#85929E;height:25px;">Nombre</td>
	</tr>
	<tr>
	<td colspan="3"><input size="120" id="campo1" type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombrec; ?>" required></td>
	</tr>
  </table>
	
  <div class="rejilla">
  <h1 class="div2">Cambiar imagen (opcional)</h1>
	<div></div>
	<h1 class="div2"><input type="file"  id="archivo" name="archivo" required></h1>
	<div></div>
	<div></div>
  <div></div>
  <div class="div2"><input onClick="recibe(); return false;" type="submit" value="Actualizar"></div>
  <div></div>
  <div class="div2" id="mensaje" style="color:#F00;font-size:16px;" ></div>
</div>
<div class="2" ><input type="hidden" name="id" id="id" value="<?php echo $ids; ?>"></div>
	</form>
	
 </body>

</html>