<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
$sql = "SELECT *
		FROM productos
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
	  function validacion(codigo){
		var codigoexception = $('#codigoexception').val();
		if (codigo != ''){
		$.ajax({
			url      : './funciones/VerificaCodigo.php',
			type     : 'post',
			dataType : 'text',
			data     : 'codigo='+codigo,
			success  : function(resultband) {
				if (resultband==1 && codigoexception!=codigo){  //bandera
					$('#mensaje').html('Error, el codigo '+codigo+' ya existe').show(); //Permite que se vuelva a mostrar despues de ser ocultado
					setTimeout(function(){ $('#mensaje').html('').show();},5000);
					$('#destino').val(resultband);
					//document.forma01.codigo.value = ''; //elimina el holder si el codigo ya existe
				} else {
					$('#mensaje').html('').show();
					setTimeout(function(){ $('#mensaje').html('').show();},5000);
					$('#destino').val(resultband);
					//alert(resultband);
				}
			}, error: function() {
				alert('Error archivo no encontrado...');
			}
		});	
	  }	  
	  }
      function recibe() {
		  var nombre = document.forma01.nombre.value;
          var codigo		= document.forma01.codigo.value;
          var descripcion	= document.forma01.descripcion.value;
          var costo 		= document.forma01.costo.value;
          var stock 		= document.forma01.stock.value;
		  var codigoexception = document.forma01.codigoexception.value;
		  var id = document.forma01.id.value;
          var archivo = document.forma01.archivo.file; 
		  var vArchivo = document.getElementById('archivo').value;
		  var valide = $('#destino').val();

         if(nombre!="" && codigo!="" && descripcion!="" && costo!="" && stock!="" && valide ==0){
            document.forma01.method = 'post';
			document.forma01.enctype = 'multipart/form-data';
			document.forma01.action = 'productos_actualiza.php';
			document.forma01.submit();
					
				}
		  else if(nombre=="" || codigo=="" || descripcion=="" || costo=="" || stock=="" || valide == 1){
			if(codigoexception==codigo){
				document.forma01.method = 'post';
				document.forma01.enctype = 'multipart/form-data';
				document.forma01.action = 'productos_actualiza.php';
				document.forma01.submit();
			}
			else if(nombre!="" && codigo!="" && descripcion!="" && costo!="" && stock!="" && valide == 1){
				validacion(codigo);
			}else{
				$('#mensaje').html('Faltan campos por llenar').show(); 		
				setTimeout(function(){ $('#mensaje').html('').show();},5000);
			}
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
    $codigo      = mysql_result($res, $i, "codigo");
    $descripcion = mysql_result($res, $i, "descripcion");
    $costo       = mysql_result($res, $i, "costo");
    $stock       = mysql_result($res, $i, "stock");
    $status      = mysql_result($res, $i, "status");
    $eliminado   = mysql_result($res, $i, "eliminado");
    $status_txt  = ($status == $eliminado) ? 'Inactivo' : 'Activo';
    

if($ids == $id){
    $nombrec      = mysql_result($res, $i, "nombre");
    $codigoc   = mysql_result($res, $i, "codigo");
    $descripcionc      = mysql_result($res, $i, "descripcion");
    $costoc        = mysql_result($res, $i, "costo");
    $stockc        = mysql_result($res, $i, "stock");
    $idc          = mysql_result($res, $i, "id");
    
}       
}
?>
	<?php include("Menu.php"); ?>
	<br>
	<form name="forma01">
	<div style="font-size: 30px;margin:0 135 40px;" align="left" ><input type="button" id ="regresar" value="Regresar al Listado" onclick = "location='productos_lista.php'"></div>
	<h1 class="div2" style="text-align:center;color:white;font-weight:thin;margin:0 0 40px;">Actualizar Datos</h1>
	<table border="2" bordercolor="black" bgcolor="white" width="1000" height="50"style="margin: 0 auto;" >
	<tr>
	<td colspan="3" style="background-color:#85929E;height:25px;">Nombre</td>
	</tr>
	<tr>
	<td colspan="3"><input size="120" id="campo1" type="text" name="nombre" placeholder="Nombre" value="<?php echo $nombrec; ?>" required></td>
	</tr>
	<tr>
	<td style="background-color:#85929E;height:25px;">Codigo</td>
	<td style="background-color:#85929E;height:25px;">Costo</td>
	<td style="background-color:#85929E;height:25px;">Stock</td>
	</tr>
	<tr>
	<td><input size="25" id="campo2" type="text" name="codigo" placeholder="Codigo" value="<?php echo $codigoc; ?>" onBlur="validacion(value);"></td>
	<td><input size="25" type="text" name="costo" placeholder="Costo" value="<?php echo $costoc; ?>" ></td>
	<td><input size="25" type="text" name="stock" placeholder="Stock" value="<?php echo $stockc; ?>"></td>
	</tr>
	<tr>
	<td colspan="3" style="background-color:#85929E;height:25px;">Descripcion</td>
	</tr>
	<tr>
	<td colspan="3"><textarea  type="text" name="descripcion" rows="10" cols="140" placeholder="Descripcion del producto"><?php echo $descripcionc; ?></textarea></td>
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
<div class="1" ><input type="hidden" name="codigoexception" id="codigoexception" value="<?php echo $codigoc; ?>"></div>
<div class="2" ><input type="hidden" name="id" id="id" value="<?php echo $ids; ?>"></div>
<div id="destino" style="color:#F00;font-size:16px;"></div>
		
	</form>
	
 </body>

</html>