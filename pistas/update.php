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
                    <h2 class="title">Editar Pistas/Tramos</h2>

                    <?php include_once('msn-update.php'); ?>

                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <input type="hidden" name="idPista" id="idPista" class='form-control' value="<?php echo $datos_pista->ID; ?>" />

                                <div class="form-row form-group">
                                    <label for="nombre" class="col-md-3 control-label">N°:</label>
                                    <div class="col-md-9">
                                        <input type="text" name="nombre" id="nombre" class='form-control' value="<?php echo $datos_pista->nombre; ?>" required>
                                    </div>
                                </div>

                                <div class="form-row form-group">
                                    <label class="col-md-3 control-label">Ubicación:</label>
                                    <div class="col-md-9">
                                        <textarea rows=2 type="text" name="ubicacion" id="ubicacion" class='form-control'><?php echo $datos_pista->ubicacion; ?></textarea>
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
                                                
                                                if ($datos_pista->IDSuperficie == $idSup) {
                                                    echo '<option value="' . $idSup . '" selected >' . $descri . '</option>';
                                                } else {
                                                    echo '<option value="' . $idSup . '">' . $descri . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 pull-right">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Actualizar datos</button>

                                    <a href="sglv_general.php?frm=abmPista" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    </section>
</main>