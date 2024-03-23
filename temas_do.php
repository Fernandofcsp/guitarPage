<?php include("menu.php"); ?>
<?php
require "./funciones/conecta.php";
$con = conecta();

$ids = $_REQUEST['id'];
$sql = "SELECT *
        FROM temas
        WHERE id = ?";
$stmt = mysqli_prepare($con, $sql);
mysqli_stmt_bind_param($stmt, "i", $ids);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$num = mysqli_num_rows($res);

echo "<br>";

for ($i = 0; $i < $num; $i++) {
    $row = mysqli_fetch_assoc($res);

    $archivo = $row["archivo"];
    $id = $row["id"];
    $titulo = $row["titulo"];
    $descripcion = $row["descripcion"];
    $id_administrador = $row["id_administrador"];
    $contenido = $row["contenido"];
    $fecha = $row["fecha"];
    $status = $row["status"];
    $eliminado = $row["eliminado"];
    $status_txt = ($status == $eliminado) ? 'Inactivo' : 'Activo';

    $sql = "SELECT nombre, apellidos
            FROM administradores
            WHERE id = ?";
    $stmt_admin = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt_admin, "i", $id_administrador);
    mysqli_stmt_execute($stmt_admin);
    $resN = mysqli_stmt_get_result($stmt_admin);
    $admin_row = mysqli_fetch_assoc($resN);
    $nombre = $admin_row["nombre"];
    $apellidos = $admin_row["apellidos"];

    echo "<div align=\"left\" style=\"margin-left:4.6%;\"><button type=\"button\" class=\"btn btn-dark\" id=\"regresar\" value=\"Regresar\" onclick=\"javascript: history.go(-1)\">Regresar</button></div>";
}

?>
<br>
<div class="container bg-dark text-white rounded p-5">
    <div class="row">
        <div class="col">
            <h1 class="text-primary"><?php echo $titulo; ?></h1>
            <p class="text-danger"><?php echo $nombre . ' ' . $apellidos; ?> <span class="text-warning"><?php echo $fecha; ?></span></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-justify"><?php echo $descripcion; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php echo "<img src=\"../archivos/$archivo\" class=\"img-fluid mt-3 mb-3\">"; ?>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <p class="text-justify"><?php echo $contenido; ?></p>
        </div>
    </div>
    <div class="row">
        <div class="col text-right">
            <button type="button" class="btn btn-primary mt-3 mb-3" onclick="location='guardaprogreso.php?id=<?php echo $ids; ?>'">Marcar como completado</button>
        </div>
    </div>
</div>
<html>
<head>
    <title>Detalle del Tema</title>
    <!-- Scripts de Bootstrap (jQuery y Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <!-- Scripts de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</head>
<body>
</body>
</html>
