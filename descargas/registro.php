<?php

require "conexion.php";
require "php/funcs.php";   //Funciones del lado del servidor
require "descargas/funcRegistrar.php";   //Funciones del lado del cliente

?>

<main id="main">
    <section id="about" style="margin-top: 50px;">
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
                                Registrarse para descargar
                            </span>
                        </h2>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-4 control-label">Nombre completo</label>
                            <div class="col-md-8">
                                <input type="nombre" class="form-control" name="nombre" placeholder="Nombre" value="<?php if (isset($nombre)) echo $nombre; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-4 control-label">Empresa/Organismo</label>
                            <div class="col-md-8">
                                <input type="nombre" class="form-control" name="empresa" placeholder="Empresa" value="<?php if (isset($empresa)) echo $empresa; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-4 control-label">Pais</label>    
                            <div class="col-md-8">
                                <input type="nombre" class="form-control" name="pais" placeholder="Pais" value="<?php if (isset($pais)) echo $pais; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="email" class="col-md-4 control-label">Email (usuario)</label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="password" placeholder="Password" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="con_password" class="col-md-4 control-label">Confirmar Password</label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" name="con_password" placeholder="Confirmar Password" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label for="captcha" class="col-md-4 control-label"></label>
                            <div class="g-recaptcha col-md-8" data-sitekey="6LeETdUZAAAAAAPDsk4h-LVIkrAQEOi6d-Pxn61L"></div>
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
                            ¿Ya tienes cuenta? <a href="descarga_login.php">Iniciar Sesión</a>
                        </div>

                    </form>

                    <?php echo resultBlock($errors); ?>

                </div>
            </div>
        </div>
    </section>
</main>