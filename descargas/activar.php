<?php

require "../conexion.php";
require "../php/funcs.php";   //Funciones del lado del servidor

//Validamos que nos estén enviando correctamente los valores por GET
if (isset($_GET['id']) and isset($_GET['val'])) {
    $idUsuario = $_GET['id'];
    $token = $_GET['val'];

    $mensaje = validaIdToken($idUsuario, $token);
}

?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <script src="js/bootstrap.min.js"></script>

</head>

<body>
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-10 text-center">
                    <div class="col-lg-12 content order-lg-1 order-2" style="text-align: justify;">
                        <h1 class="title">
                            <?php echo $mensaje; ?>
                        </h1>
                        <div style="border-top: 1px solid#888;">
                        </div>
                        </br>

                        <form action="../descarga_login.php">
                            <input type="submit" class="btn btn-info btn-md" value="Iniciar Sesión" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>