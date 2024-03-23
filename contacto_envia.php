<?php

// Recibe datos
$nombre = $_POST['nombre'] ?? '';
$correo = $_POST['correo'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';
$email = "fernandocsp19@gmail.com"; // Correo al que llegarán los informes de contacto

// Filtrar y validar datos
$nombre = filter_var($nombre, FILTER_SANITIZE_STRING);
$correo = filter_var($correo, FILTER_SANITIZE_EMAIL);
$subject = filter_var($subject, FILTER_SANITIZE_STRING);
$message = filter_var($message, FILTER_SANITIZE_STRING);

// Verificar que los datos no estén vacíos
if (!empty($nombre) && !empty($correo) && !empty($subject) && !empty($message)) {
    // Enviar el correo y devolver la bandera
    if (mail($email, $subject, "De: $nombre\nCorreo: $correo\nMensaje: $message")) {
        $resultband = 1;
        echo $resultband;
    } else {
        $resultband = 2;
        echo $resultband;
    }
} else {
    // Si algún campo está vacío, devolver una bandera indicando el error
    $resultband = 0;
    echo $resultband;
}

?>
