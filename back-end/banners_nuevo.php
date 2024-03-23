<html>

 <head>
  <title>Formulario Agregar</title>
  <script src="./js/jquery-3.3.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="./css/Estilos.css">


  <script>
      function recibe() {
          var nombre = document.forma01.nombre.value;
		  var archivo 		= document.forma01.archivo.file;
		  var vArchivo 		= document.getElementById('archivo').value;

          if(nombre!="" && vArchivo!=0){
			document.forma01.method = 'post';
			document.forma01.enctype = 'multipart/form-data';
			document.forma01.action = 'banners_salva.php';
			document.forma01.submit();
		  }
		  else if(nombre=="" || vArchivo==0){
			$('#mensaje').html('Faltan campos por llenar').show(); 		
			setTimeout(function(){ $('#mensaje').html('').show();},5000);
		  }
	  }

  </script>
	<meta charset="utf-8"/> <!--elimina el ï»¿ al inicio-->
 </head>

 <body>
 	<?php include("Menu.php"); ?>
	<br><br>
	<form name="forma01">
	<div style="font-size: 30px;margin:0 135 40px;" align="left" ><input type="button" id ="regresar" value="Regresar al Listado" onclick = "location='banners_lista.php'"></div>
	<h1 class="div2" style="text-align:center;color:white;font-weight:thin;margin:0 0 40px;">Agregar Banner</h1>
	<table border="2" bordercolor="black" bgcolor="white" width="1000" height="50"style="margin: 0 auto;" >
	<tr>
	<td colspan="3" style="background-color:#85929E;height:25px;">Nombre del banner</td>
	</tr>
	<tr>
	<td colspan="3"><input size="120" id="campo1" type="text" name="nombre" placeholder="Nombre"></td>
	</tr>
  </table>
<div class="rejilla">
 
  <h1 class="div2">Agregar imagen (Banner)</h1>
	<div></div>
	<h1 class="div2"><input type="file"  id="archivo" name="archivo" id="archivo"></h1>
	<div></div>
  <div></div>
  <div></div>
  <div class="div2"><input onClick="recibe(); return false;" type="submit" value="Guardar Banner"></div>
  <div></div>
  <div class="div2" id="mensaje" style="color:#F00;font-size:16px;" ></div>
</div>
	
	
 </body>

</html>