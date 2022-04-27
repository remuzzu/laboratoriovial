<?php

require "conexion.php";
require "entity/pista.php";       //Tiene definida las funciones basicas de insertar, read, delete, edit
require "pistas/funcs.php";        //Detalle de las funciones especificadas en funcCREATE.php
require "pistas/funcCREATE.php";   //Funciones requeridas de validaciones del lado del cliente

?>

<main id="main">
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <!-- Formulario de Alta de OT -->
                    <form id="form_createPista" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>

                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">
                                Insertar Pistas/Tramos
                            </span>
                        </h2>

                        <?php echo resultBlockOK($message, $class); ?>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-3 control-label">Nombre:</label>
                            <div class="col-md-9">
                                <input type="text" name="nombre" id="nombre" class='form-control' value="<?php if (isset($nombre)) echo $nombre; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Ubicacion:</label>
                            <div class="col-md-9">
                                <input type="text" name="ubicacion" id="ubicacion" class='form-control' value="<?php if (isset($ubicacion)) echo $ubicacion; ?>">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Superficie:</label>
                            <div class="col-md-9">
                                <select class="col-md-12" name="superficie" id="superficie">

                                    <?php
                                    include_once('entity/superficie.php');
                                    $superficie = new Superficie();
                                    $resultado = $superficie->read();

                                    foreach ($resultado as $reg) {
                                        $idSup = $reg['ID'];
                                        $descri = $reg['descripcion'];
                                        echo ($idSup . " - ");
                                        if (isset($idSup)) {
                                            echo '<option value="' . $idSup . '" selected >' . $descri . '</option>';
                                        } else {
                                            echo '<option value="' . $idSup . '">' . $descri . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                            <a href="sglv_general.php?frm=abmPista" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                        </div>

                        <button type="reset" id="limpiar" hidden=""></button>
                    </form>

                    <?php echo resultBlock($errors); ?>

                </div>
            </div>
    </section>
</main>