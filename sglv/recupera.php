<?php
require "conexion.php";
require "php/funcs.php";   //Funciones del lado del servidor (también estan definidas algunas del cliente)

$errors = array();  //Variable para ir colocando todos los errores.

if (!empty($_POST)) {
    $email = $_POST['email'];

    if (!isEmail($email)) {
        $errors = "Debe ingresar un correo electrónico válido";
    }

    //Vamos a validar que exista este correo electrónico en nuestra base de datos
    if (emailExiste($email)) {
        //Necesitamos: id_usuario; nombre_usuario
        $nombre = getNombre($email);
        $login_id = getId($email);

        /* Es necesario generar un token para que se envíe mediante el correo electrónico
            como lo hicimos al registrar una cuenta.*/
        $token = generaTokenPass($login_id);

        //fceia
        $url = 'http://' . $_SERVER['SERVER_NAME'] .
            '/laboratoriovial/sglv/cambia_pass.php?login_id=' . $login_id . '&token=' . $token;

        $asunto = 'Recuperar Password - Sistema de Usuarios';
        $cuerpo = mensajeRecuperacion($url, $nombre);

        if (enviarEmail($email, $nombre, $asunto, $cuerpo)) {

            $cuerpoRegistro = mensajeReActivacion($email);
            echo $cuerpoRegistro;

            exit;    //Acá se corta el scrip y sale para que no muestre nuevamente el formulario.
        } else {
            $errors[] = "Error al enviar Email";
        }
    } else {
        $errors[] = "No existe el correo electrónico ingresado";
    }
}

?>

<main id="main">
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <!-- Formulario de Recuperación -->
                    <form id="form_recup" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">
                                Recuperar contraseña
                            </span>
                        </h2>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="email" type="email" class="form-control" name="email" value="" data-rule="email" placeholder="email" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Enviar">
                        </div>

                        <div style="border-top: 1px solid#888;">
                            ¿No tienes cuenta? <a href="sglv_registro.php">Registrarse aqui</a>
                        </div>
                    </form>

                    <?php echo resultBlock($errors); ?>
                    
                </div>
            </div>
        </div>
    </section>
</main>