<?php

require "conexion.php";
require "php/funcs.php";   //Funciones del lado del servidor
require "sglv/funcRegistrar.php";   //Funciones del lado del cliente

?>

<main id="main">
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <!-- Formulario de Registración -->
                    <form id="form_regis" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>

                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">
                                Registrarse
                            </span>
                        </h2>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-3 control-label">Nombre</label>
                            <div class="col-md-9">
                                <input type="nombre" class="form-control" name="nombre" placeholder="Nombre" value="<?php if (isset($nombre)) echo $nombre; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="email" class="col-md-3 control-label">Email</label>
                            <div class="col-md-9">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="password" class="col-md-3 control-label">Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="con_password" class="col-md-3 control-label">Confirmar Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="captcha" class="col-md-3 control-label"></label>
                            <div class="g-recaptcha col-md-9" data-sitekey="6LeETdUZAAAAAAPDsk4h-LVIkrAQEOi6d-Pxn61L"></div>
                        </div>

                        <!--<div class="form-group">
                            <div class="col-md-offset-3 col-md-9">
                                <button id="btn-signup" type="submit" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
                            </div>
                        </div>-->

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Registrar">
                        </div>

                        <div style="border-top: 1px solid#888;">
                            ¿Ya tienes cuenta? <a href="sglv_login.php">Iniciar Sesión</a>
                        </div>

                    </form>

                    <?php echo resultBlock($errors); ?>

                </div>
            </div>
        </div>
    </section>
</main>