<?php

require "../conexion.php";
require "../php/funcs.php";

//Validamos que nos estén enviando correctamente los valores por GET
if (empty(isset($_GET['login_id'])) or empty(isset($_GET['token']))) {
    header('Location: descarga.php');
}

$login_id = $_GET['login_id'];
$token = $_GET['token'];

//Vamos a verificar que estos datos estén correctamente en su registro
if (!verificaTokenPass($login_id, $token)) {
    echo "No se pudo verificar los Datos";
    exit;
}


?>

<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cambiar Password</title>

    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap-theme.min.css">
    <script src="../vendor/js/bootstrap.min.js"></script>

</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <!-- Formulario de Cambio de Password -->
                <form id="form_cambiapass" class="form-horizontal" role="form" action="guarda_pass.php" method="post" autocomplete="off">
                    
                    <input type="hidden" id="login_id" name="login_id" value="<?php echo $login_id; ?>" />
                    <input type="hidden" id="token" name="token" value="<?php echo $token; ?>" />

                    <div class="form-group">
                        <label for="password" class="col-md-9 control-label">Nuevo Password</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="con_password" class="col-md-9 control-label">Confirmar Password</label>
                        <div class="col-md-12">
                            <input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
                        </div>
                    </div>

                    <div style="margin-top:10px" class="form-group">
                        <div class="col-sm-12 controls">
                            <button id="btn-login" type="submit" class="btn btn-success">Modificar</a>
                        </div>
                    </div>


                    <div style="border-top: 1px solid#888;">
                        <a href="../descarga_login.php">Iniciar sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>