<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HOME</title>
</head>
<body>
<?php include("menu.php"); ?>

<?php
require "./funciones/conecta.php";
$con = conecta();

$sql = "SELECT *
        FROM banners
        WHERE status = 1 AND eliminado = 0 ";
$res = $con->query($sql);

$numbanners = $res->num_rows; // Número de banners que se rotarán

if ($numbanners > 0) {
    $random = rand(0, $numbanners - 1);
    $img = array();

    while ($row = $res->fetch_assoc()) {
        $archivo = $row['archivo'];
        $img[] = "../archivos/$archivo";
    }

    $selectedImg = $img[$random];
    echo "<br>";
    echo "<img class=\"rounded\"src='$selectedImg' style=\"margin-left:.5%;margin-right:.5%;\" width=\"99%\" height=\"auto\" border='0'></a>";
    echo "<br><br><br>";
}

?>
<?php include("piedePagina.php"); ?>
</body>
</html>
