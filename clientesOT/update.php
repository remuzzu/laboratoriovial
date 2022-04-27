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
                    <h2 class="title">Editar <b>Clientes</b></h2>
                    
                    <?php include_once('clientesOT/msn-update.php'); ?>
                    
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <div class="form-group">
                                    <label>Razón Social:</label>
                                    <input type="text" name="razonSocial" id="razonSocial" class='form-control' maxlength="100" required value = " <?php echo $datos_cliente->razonSocial;?>">

                                    <label>Cuit:</label>
                                    <input type="text" name="cuit" id="cuit" class='form-control' maxlength="100" required value = " <?php echo $datos_cliente->cuit;?>">
                                    
                                    <input type="hidden" name="idCliente" id="idCliente" class='form-control' pattern=".{13,13}" value="<?php echo $datos_cliente->ID; ?>" required title="Cuit inválido" />
                                </div>

                                <div class="col-md-12 pull-right">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Actualizar datos</button>

                                    <a href="sglv_clientesOT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    </section>
</main>