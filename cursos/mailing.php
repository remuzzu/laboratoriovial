<main id="main">
    <section id="about" style="margin-top: 50px;">
        <div class="container wow fadeInUp">
            <div>
                <div class="left-0 text-center bg-faded p-4 rounded">
                    <section id="contact">
                        <div class="container">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-lower" style="font-size:2.5rem;">
                                    Contacto
                                </span>
                            </h2>

                            <div class="row justify-content-center">
                                <div class="col-lg-5 col-md-8">
                                    <div class="form">
                                        <form method="post" role="form" class="contactForm" action="<?php $_SERVER['PHP_SELF'] ?>">
                                            <div class="form-group">
                                                <input type="text" name="nombre" class="form-control" placeholder="Nombre" value="<?php if (isset($nombre)) echo $nombre; ?>" required />
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="email" class="form-control" name="email" placeholder="Email" value="<?php if (isset($email)) echo $email; ?>" required />
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="ciudad" placeholder="Ciudad" value="<?php if (isset($ciudad)) echo $ciudad; ?>" required />
                                                <div class="validation"></div>
                                            </div>
                                            <div class="form-group">
                                                <textarea class="form-control" name="comentario" rows="5" disabled>Deseo recibir información actualizada de los cursos de la Maestría Vial.
                                                </textarea>
                                                <div class="validation"></div>
                                            </div>

                                            <div class="form-group">
                                                <label for="captcha" class="col-md-3 control-label"></label>
                                                <div class="g-recaptcha col-md-9" data-sitekey="6LeETdUZAAAAAAPDsk4h-LVIkrAQEOi6d-Pxn61L"></div>
                                            </div>

                                            <br>
                                            
                                            <div class="text-center"><button type="submit">Enviar</button></div>
                                        </form>
                                        <br>
                                        <?php echo resultBlock($errors); ?>

                                    </div>
                                </div>

                                <!-- Para insertar el catchap ... pero debemos REGISTRARLO ANTES
                                <script src='https://www.google.com/recaptcha/api.js?hl=es'></script>
                                -->
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
</main>