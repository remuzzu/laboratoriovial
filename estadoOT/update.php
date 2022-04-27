<?php
	if (isset($_GET['id'])){
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
                    <h2 class="title">Editar <b>Estados</b> de ordenes de trabajo</h2>
                    
                    <?php include_once('msn-update.php'); ?>
                    
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <div class="form-group">
                                    <label>Descripción:</label>
                                    <input type="text" name="descri" id="descri" class='form-control' maxlength="100" required value = " <?php echo $datos_estado->descri;?>">
                                    <input type="hidden" name="idEstado" id="idEstado" class='form-control' value="<?php echo $datos_estado->ID; ?>" />
                                </div>

                                <div class="col-md-12 pull-right">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Actualizar datos</button>

                                    <a href="sglv_estadoOT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    </section>
</main>