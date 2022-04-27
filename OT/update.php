<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    header("location:index.php");
}
?>

<main id="main">
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="text-center rounded col-md-12">
                    <h2 class="title">Editar Ordenes de Trabajo</h2>

                    <?php include_once('msn-update.php'); ?>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <input type="hidden" name="idOT" id="idOT" class='form-control' value="<?php echo $datos_ot->ID; ?>" />

                                <div class="form-row form-group">
                                    <label for="nombre" class="col-md-3 control-label">N° OT:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nroOT" id="nroOT" class='form-control' value="<?php echo $datos_ot->nroOT; ?>" required>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Presupuesto N°:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nroPresu" id="nroPresu" class='form-control' value="<?php echo $datos_ot->nroPresu; ?>">
                                    </div>
                                </div>


                                <?php 
                                $fechaAlta = $datos_ot->fechaAlta; 
                                $fechaAlta = str_replace('/', '-', $fechaAlta);
                                $fechaAlta = date('Y-m-d', strtotime($fechaAlta));
                                ?>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Fecha Alta:</label>
                                    <div class="col-md-9">
                                        <input type="date" name="fechaAlta" id="fechaAlta" class='form-control' value="<?php echo $fechaAlta; ?>" required>
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

                                                if ($datos_ot->IDCliente == $idCliente) {
                                                    echo '<option value="' . $idCliente . '" selected >' . $razonSocial . '</option>';
                                                } else {
                                                    echo '<option value="' . $idCliente . '">' . $razonSocial . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="sglv_clientesOT.php?frm=create_cl&viene_de=update_ot&id=<?php echo $datos_ot->ID; ?>" class="btn btn-info add-new"><i class="fa fa-plus"></i> Cliente</a>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Descripción del trabajo:</label>
                                    <div class="col-md-9">
                                        <textarea rows=2 type="text" name="descri" id="descri" class='form-control' required><?php echo $datos_ot->descri; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Detalle:</label>
                                    <div class="col-md-9">
                                        <textarea rows=2 type="text" name="detalle" id="detalle" class='form-control'><?php echo $datos_ot->detalle; ?></textarea>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Importe:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="importe" id="importe" class='form-control' value="<?php echo $datos_ot->importe; ?>" required>
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

                                                if ($datos_ot->IDEstado == $idEstado) {
                                                    echo '<option value="' . $idEstado . '" selected >' . $descri. '</option>';
                                                } else {
                                                    echo '<option value="' . $idEstado . '">' . $descri . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <a href="sglv_estadoOT.php?frm=create_est&viene_de=update_ot&id=<?php echo $datos_ot->ID; ?>" class="btn btn-info add-new"><i class="fa fa-plus"></i> Estado</a>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Respondable a Cargo:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="respons" id="respons" class='form-control' value="<?php echo $datos_ot->responsable; ?>">
                                    </div>
                                </div>



                                <div class="col-md-12 pull-right">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Actualizar datos</button>

                                    <a href="sglv_OT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    </section>
</main>