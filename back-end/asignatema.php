<?php
session_start();
require "./funciones/conecta.php";
    $con = conecta();
    $idTema        = $_POST['idTema'];
    $nivel         = $_POST['nivel'];
    if($nivel == 1 && $idTema !=0){
    $sql	  ="INSERT INTO cursos (nivel,id_tema) VALUES ('1', '$idTema')";
	$res	  = mysql_query($sql, $con);
    $sql  = "UPDATE temas SET status = '2' 
			 WHERE id = $idTema";
	$res  = mysql_query($sql, $con);
    $resultband = 1;
    echo"$resultband";
    }
    else if ($nivel == 2 && $idTema !=0){
    $sql	  ="INSERT INTO cursos (nivel,id_tema) VALUES ('2', '$idTema')";
	$res	  = mysql_query($sql, $con);
    $sql  = "UPDATE temas SET status = '3' 
			 WHERE id = $idTema";
	$res  = mysql_query($sql, $con);
    $resultband = 1;
    echo"$resultband";
    }
    else if ($nivel == 3 && $idTema !=0){
        $sql	  ="INSERT INTO cursos (nivel,id_tema) VALUES ('3', '$idTema')";
        $res	  = mysql_query($sql, $con);
        $sql  = "UPDATE temas SET status = '4' 
                 WHERE id = $idTema";
        $res  = mysql_query($sql, $con);
        $resultband = 1;
        echo"$resultband";
        }
?>
