<?php
require "./funciones/conecta.php";
session_start();

$con = conecta();

$lvl = $_POST['lvl']; // Cambiamos $_REQUEST por $_POST ya que es más seguro y adecuado para este caso
$nivel = $_POST['nivel']; // Cambiamos $_REQUEST por $_POST
$id    = $_SESSION['usuario'];

$resultband = 0; // Inicializamos $resultband con 0 por defecto

if ($nivel >= 3 && $lvl == 3) {
    $resultband = 1;
} elseif ($nivel >= 2 && $lvl == 2) {
    $resultband = 2;
}

echo $resultband; // Devolvemos el resultado
?>
