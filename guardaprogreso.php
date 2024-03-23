<?php
session_start();
require "./funciones/conecta.php";
$con = conecta();
$idTema = $_REQUEST['id'];
$idusuario = $_SESSION['usuario'];

// Verifica si el usuario ha progresado en el tema y lo registra si no lo ha hecho
$sql = "SELECT id_tema FROM progreso_tema WHERE id_usuario = ? AND id_tema = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ii", $idusuario, $idTema);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $sql = "INSERT INTO progreso_tema (id_tema, id_usuario) VALUES (?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ii", $idTema, $idusuario);
    $stmt->execute();
}

// Obtiene la cantidad de temas completados por el usuario
$sql = "SELECT COUNT(*) as num_completados FROM progreso_tema WHERE id_usuario = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("i", $idusuario);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$num_completados = $row['num_completados'];

// Verifica si el usuario ha completado todos los temas del nivel 1
$sql = "SELECT COUNT(*) as num_cursos_nivel1 FROM cursos WHERE nivel = 1";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$num_cursos_nivel1 = $row['num_cursos_nivel1'];

// Verifica si el usuario ha completado todos los cursos del nivel 2
$sql = "SELECT COUNT(*) as num_cursos_nivel2 FROM cursos WHERE nivel = 2";
$stmt = $con->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$num_cursos_nivel2 = $row['num_cursos_nivel2'];

// Verifica si el usuario ha completado todos los cursos del nivel 1 y 2
$total_cursos = $num_cursos_nivel1 + $num_cursos_nivel2;

if ($num_completados == $num_cursos_nivel1) {
    $sql = "UPDATE clientes SET nivel = 2 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
}

if ($num_completados == $total_cursos) {
    $sql = "UPDATE clientes SET nivel = 3 WHERE id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $idusuario);
    $stmt->execute();
}

echo "<script>history.go(-2)</script>";
echo "<script>window.location.reload();</script>";
die();
?>
