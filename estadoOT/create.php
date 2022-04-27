<?php
if (isset($_GET['viene_de'])) {
    $vieneDe = $_GET['viene_de'];

    if ($vieneDe == 'update_ot'){
        $idOT = $_GET['id'];
    }
}
?>

<main id="main">
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="text-center rounded col-md-12">
                    <h2 class="title">Insertar <b>Estados</b> de ordenes de trabajo</h2>
                    
                    <?php include_once('estadoOT/msn-create.php'); ?>
                    
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <form method="post">
                                <div class="form-group">
                                    <label>Descripción:</label>
                                    <input type="text" name="descri" id="descri" class='form-control' maxlength="100" required>
                                </div>

                                <div class="col-md-12 pull-right">
                                    <hr>
                                    <button type="submit" class="btn btn-success">Guardar datos</button>

                                    <?php 
                                    switch ($vieneDe) {
                                        case 'create_ot':
                                            echo'<a href="sglv_OT.php?frm=create" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>';
                                            break;
                                        case "create_est":
                                            echo'<a href="sglv_estadoOT.php?frm=index" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>';
                                            break;
                                        case 'update_ot':
                                            echo'<a href="sglv_OT.php?frm=update&id=' . $idOT . '" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>';
                                            break;
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </div>
            </div>
    </section>
</main>