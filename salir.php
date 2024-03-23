<?php
session_start();
unset($_SESSION["usuario"]);
unset($_SESSION["nombre2"]);
//session_destroy();
echo "<script>location.href='index.php';</script>";
?>
