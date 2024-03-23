<?php
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
		FROM banners
		WHERE status = 1 AND eliminado = 0 ";
$res = mysql_query($sql, $con);
$num = mysql_num_rows($res);

?>
<html>

	<head>
		<title>Listado Banners</title>
        <script src="./js/jquery-3.3.1.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/Estilos.css">
		  <script>
			function eliminarFilas(fila) {
				if(confirm("¿Estas seguro?")){
					$.ajax({
						url      : 'banners_elimina.php',
						type     : 'post',
						dataType : 'text',
						//data   : 'id=55&var2=89&var3=adios',
						data     : 'id='+fila,
						success  : function(resultband) {
							if (resultband==1){  //bandera
								nombreFila = "filas"+fila;
								fila = document.getElementById(nombreFila);  //Obtiene el nombre de la fila
								$(fila).hide();  //Oculta la fila
								//$('#mensaje').slideUp(5000); //oculta de abajo hacia arriba
								$('#mensaje').html('Banner eliminado').show(); //Permite que se vuelva a mostrar despues de ser ocultado
								setTimeout(function(){ //INICIO UN RELOJ 
								$('#mensaje').html('').show();//OCULTO EL MENSAJE
								},5000);
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

	<body bgcolor= "gray">
	<?php include("Menu.php"); ?>
		<br><br>
        <div class=contenedor-tabla id = "dsTable" border="1" width="960" height="800" align="center" valign="middle">
        <div class=contenedor-fila height="50" align="center">
			<div class=contenedor-cabecera colspan="6" style="font-size: 25px">Lista de Banners</div>
		</div>
		<div style="background-color:#E3E4E5; vertical-align:middle;height:20px;">
			<div ><a href="banners_nuevo.php">Agregar Banner</a></div>
		</div>
		<div id="mensaje" style="color:#F00;font-size:16px;"></div>
		<div class=contenedor-fila id="filacampos" height="200" align="center" valign="middle">
			<div class=contenedor-contador>#</div>
			<div class=contenedor-id >ID</div>
			<div class=contenedor-nombre >Nombre</div>
            <div class=contenedor-boton >Acciones</div>
        </div>

        <?php
        for ($i = 0; $i < $num; $i++){
            $id          = mysql_result($res, $i, "id");
            $nombre      = mysql_result($res, $i, "nombre");
		$concatenacion = 'filas' . $id;
		
		$contador = $i+1;
        echo "<div class=contenedor-fila id=$concatenacion height=\"200\" align=\"center\" valign=\"middle\">";
		echo "<div class=contenedor-contadornumeros width=\"100px\">$contador</div>";
        echo "<div class=contenedor-iddatos width=\"100px\">$id</div>";
        echo "<div class=contenedor-columna width=\"33.33%\">$nombre</div>";
		echo "<div class=contenedor-botondatos width=\"50%\"><input type=\"button\" style=\"background-color:#00ffff;border-color:black;padding:3px;\" id =\"vdet\" value=\"Ver detalle\" onclick = \"location='banners_detalle.php?id=$id'\" ></div>";
		echo "<div class=contenedor-botondatos width=\"50%\"><input type=\"button\" style=\"background-color:#FFFFFF;border-color:black;padding:3px;\" id =\"vedit\" value=\"Editar\" onclick = \"location='banners_edita.php?id=$id'\" ></div>";
        echo "<div class=contenedor-botondatos width=\"50%\"> <input type=\"button\" style=\"background-color:#ff4040;border-color:black;padding:3px;\" value=\"Eliminar\" href=\"javascript:void(0);\" onclick = \"eliminarFilas($id);\"  ></div>";
        echo "</div>";
        }
        ?>

        <div class=contenedor-fila height="50" align="center">
			<div class=contenedor-cabecera></div>
		</div>
	</div>
	</body>

</html>