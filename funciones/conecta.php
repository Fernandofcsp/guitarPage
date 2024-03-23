<?php
define("HOST",'sql300.infinityfree.com');
define("BD",'if0_36150603_sembd');
define("USER_BD",'if0_36150603');
define("PASS_BD",'B7qn43RVFF');

function conecta() {
    $con = mysqli_connect(HOST, USER_BD, PASS_BD, BD); // Usando mysqli en lugar de mysql_connect
    if (!$con) {
        echo "Error conectando al servidor de BBDD: " . mysqli_connect_error();
        exit();
    }
    return $con;
}
?>
