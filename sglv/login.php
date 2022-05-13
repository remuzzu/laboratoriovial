<!-- HAY TODO UN CODIGO PHP QUE TUVE QUE COLOCARLO EN EL FORMULARIO PRINCIPAL
sglv_login.php PORQUE LLAMABA A UN header 
Y PARA ESTO TIENE QUE ESTAR SI O SI ANTES DE LA ETIQUETA <HEADER> SINO ¡NO FUNCIONA! -->
    
<main id="main">
    <section id="about" style="margin-top: 50px;">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <!-- Formulario de LogIn -->
                    <form id="form_login" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post" autocomplete="off"> 

                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">
                                Iniciar Sesión
                            </span>
                        </h2>

                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input id="usuario" type="text" class="form-control" name="usuario" value="" data-rule="email" placeholder="email" required>                                        
                        </div>
                                                
                        <div style="margin-bottom: 25px" class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input id="password" type="password" class="form-control" name="password" placeholder="contraseña" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-info btn-md" value="Aceptar">
                        </div>

                        <div style="border-top: 1px solid#888;" >
                            ¿No te has registrado todavia? <a href="sglv_registro.php">Registrarse aquí</a>
                        </div>

                        <div id="register-link" class="text-center">
                            <p class="change_link">
                                <a href="sglv_recupera.php">¿Se te olvidó la contraseña?</a>
                            </p>
                        </div>
                    </form>

                    <?php echo resultBlock($errors); ?>
                </div>
            </div>
        </div>
    </section>
</main>