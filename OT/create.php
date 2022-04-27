<?php

require "conexion.php";
require "entity/OT.php";       //Tiene definida las funciones basicas de insertar, read, delete, edit
require "OT/funcs.php";        //Detalle de las funciones especificadas en funcCREATE.php
require "OT/funcCREATE.php";   //Funciones requeridas de validaciones del lado del cliente

?>

<main id="main">
    <section id="about">
        <div class="container wow fadeInUp">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center">
                    <!-- Formulario de Alta de OT -->
                    <form id="form_createOT" class="form-horizontal" role="form" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <div id="signupalert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>

                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower">
                                Insertar ordenes de trabajo
                            </span>
                        </h2>

                        <?php echo resultBlockOK($message, $class); ?>

                        <div class="form-row form-group">
                            <label for="nombre" class="col-md-3 control-label">N° OT:</label>
                            <div class="col-md-9">
                                <input type="text" name="nroOT" id="nroOT" class='form-control' value="<?php if (isset($nroOT)) echo $nroOT; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Presupuesto N°:</label>
                            <div class="col-md-9">
                                <input type="text" name="nroPresu" id="nroPresu" class='form-control' value="<?php if (isset($nroPresu)) echo $nroPresu; ?>">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Fecha Alta:</label>
                            <div class="col-md-9">
                                <input type="date" name="fechaAlta" id="fechaAlta" class='form-control' value="<?php if (isset($fechaAlta)) echo $fechaAlta; ?>" required>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Cliente:</label>
                            <div class="col-md-6">
                                <select class="col-md-12" name="cliente" id="cliente">;

                                    <?php
                                    include_once('entity/clientesOT.php');
                                    $ot = new Cliente();
                                    $resultado = $ot->read();


                                    foreach ($resultado as $reg) {
                                        $idCliente = $reg['ID'];
                                        $razonSocial = $reg['razonSocial'];

                                        if (isset($cliente) and $cliente==$idCliente){
                                            echo '<option value="' . $idCliente . '" selected >' . $razonSocial . '</option>';
                                        } else{
                                            echo '<option value="' . $idCliente . '">' . $razonSocial . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="sglv_clientesOT.php?frm=create_cl&viene_de=create_ot" class="btn btn-info add-new"><i class="fa fa-plus"></i> Cliente</a>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Descripción del trabajo:</label>
                            <div class="col-md-9">
                                <textarea rows=2 type="text" name="descri" id="descri" class='form-control' required><?php if (isset($descri)) echo $descri; ?></textarea>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Detalle:</label>
                            <div class="col-md-9">
                                <textarea rows=2 type="text" name="detalle" id="detalle" class='form-control'><?php if (isset($detalle)) echo $detalle; ?></textarea>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Importe:</label>
                            <div class="col-md-9">
                                <input type="text" name="importe" id="importe" class='form-control' value="<?php if (isset($importe)) echo $importe; ?>" required>
                            </div>
                        </div>
                        
                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Estado:</label>
                            <div class="col-md-6">
                                <select class="col-md-12" name="estado" id="estado">;
                                    <option value='-1'></option>

                                    <?php
                                    include_once('entity/estadosOT.php');
                                    $ot = new Estado();
                                    $resultado = $ot->read();

                                    foreach ($resultado as $reg) {
                                        $idEstado = $reg['ID'];
                                        $descri = $reg['descri'];
                                        
                                        if (isset($estado) and $estado==$idEstado){
                                            echo '<option value="' . $idEstado . '" selected >' . $descri . '</option>';
                                        } else{
                                            echo '<option value="' . $idEstado . '">' . $descri . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <a href="sglv_estadoOT.php?frm=create_est&viene_de=create_ot" class="btn btn-info add-new"><i class="fa fa-plus"></i> Estado</a>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <label class="col-md-3 control-label">Respondable a Cargo:</label>
                            <div class="col-md-9">
                                <input type="text" name="respons" id="respons" class='form-control' value="<?php if (isset($respons)) echo $respons; ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Guardar datos</button>
                            <a href="sglv_OT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                        </div>
                    </form>

                    <?php echo resultBlock($errors); ?>

                </div>
            </div>
    </section>
</main>