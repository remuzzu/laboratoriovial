<main id="main">
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="text-center rounded col-md-12">
                    <h2 class="title">Pistas/Tramos</h2>

                    <?php
                    include_once('entity/pista.php');
                    $pista = new pista();

                    if (isset($_GET['id'])) {
                        $id = intval($_GET['id']);
                        $res = $pista->delete($id);

                        if ($res) {
                            $message = "Registro eliminado con éxito!";
                            $class = "alert alert-success";
                        } else {
                            $message = "Error al eliminar el registro";
                            $class = "alert alert-danger";
                        }

                    ?>
                        <div id="mydiv" class="<?php echo $class ?>">
                            <?php echo $message; ?>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="col-sm-2">
                        <a href="sglv_general.php?frm=abmPista" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i> Regresar</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>