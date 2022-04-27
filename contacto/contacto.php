<main id="main">
    <section id="about">
        <div class="container wow fadeInUp">
            <div>
                <div class="left-0 text-center bg-faded p-4 rounded">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <p class="float-right d-md-none">
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="offcanvas">Toggle
                                    nav</button>
                            </p>

                            <div class="gmcont">
                                <div class="embed-responsive embed-responsive-16by9">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2366.948111727921!2d-60.62372292171128!3d-32.96763560713795!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95b7aa53b6a3f3fb%3A0xc1d7d44e88833847!2sIMAE%20-%20Instituto%20de%20Mec%C3%A1nica%20Aplicada%20y%20Estructuras!5e0!3m2!1ses-419!2sar!4v1572622270933!5m2!1ses-419!2sar" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <section id="contact">
                        <div class="container">
                            <h2 class="section-heading mb-4">
                                <span class="section-heading-lower" style="font-size:2.5rem;">
                                    Contacto
                                </span>
                            </h2>

                            <div class="row justify-content-center">
                                <div class="col-lg-3 col-md-4">
                                    <div class="info">
                                        <div>
                                            <i class="fa fa-map-marker"></i>
                                            <p>Riobamba y Berutti<br>(Centro Universitario Rosario)</p>
                                        </div>

                                        <div>
                                            <i class="fa fa-envelope"></i>
                                            <p>labvial@fceia.unr.edu.ar</p>
                                        </div>

                                        <div>
                                            <i class="fa fa-phone"></i>
                                            <p>54 0341 4808538/39<br>Fax: 54 0341 4808540<br>
                                                Horarios: de 8 a 14 hs</p>
                                        </div>

                                    </div>
                                </div>

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
                                                <textarea class="form-control" name="comentario" rows="5" placeholder="Mensaje" value="<?php if (isset($comentario)) echo $comentario; ?>" required></textarea>
                                                <div class="validation"></div>
                                            </div>

                                            <div class="form-group text-left">
                                                <label class="checkbox-inline">    
                                                    <input type="checkbox" value="1" id="chMailing" name="chMailing">
                                                    <strong> Suscribirse a la lista del Laboratorio Vial para
                                                    recibir información general y de los cursos de posgrado </strong>
                                                </label>
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