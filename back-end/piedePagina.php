<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Estilos para el contenido principal */
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        /* Estilos para el footer */
        footer {
            background-color: #343a40; /* Color de fondo */
            color: #ffffff; /* Color del texto */
            padding: 20px; /* Espaciado interno */
            margin-top: 40px;
            box-sizing: border-box; /* Incluye el padding en el ancho total */
        }

        .redes-footer img {
            margin-right: 10px; /* Espacio entre íconos */
        }
    </style>
</head>
<body>
    <main>
        <!-- Tu contenido principal aquí -->
    </main>

    <footer>
        <div class="container ">
            <div class="row">
                <div class="col-md-4 text-center ">
                    <p class="text-muted small">Fernando Cesar Sandoval Padilla @2021.<br> Todos los derechos reservados.</p>
                </div>
                <div class="col-md-4 text-center mb-4">
                    <a href="../" class="text-muted small">Frontend</a> <!-- Enlace al backend -->
                </div>
                <div class="col-md-4 text-center">
                    <h6 class="text-muted small">ENCUÉNTRANOS EN LAS REDES</h6>
                    <div class="redes-footer">
                        <a href="https://www.facebook.com/"><img src="../images/FB.png" width="30px" height="30px"></a>
                        <a href="https://twitter.com/"><img src="../images/TW.png" width="30px" height="30px"></a>
                        <a href="https://www.youtube.com/"><img src="../images/YT.png" width="30px" height="30px"></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
