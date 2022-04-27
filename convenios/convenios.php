<script type="text/javascript">
    $(document).ready(function() {
        $('#tablaCurso').DataTable({
            "ordering": false, // false to disable sorting (or any other option)
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
            }
        });
    });
</script>

<?php include_once('conexion.php'); ?>

<main id="main">
    <section>
        <div class="container">
            <div class="row">
                <div class="left-0 text-center bg-faded p-4 rounded">
                    <h2 class="title">Convenios del Laboratorio Vial</h2>


                    <div class="table-responsive">
                        <table class="table borderless display" id="tablaCurso">
                            <thead>
                                <tr class="row-active">
                                    <th scope="col">Inicio</th>
                                    <th scope="col">Fin</th>
                                    <th scope="col">Tema</th>
                                    <th scope="col">Comitente</th>
                                    <th scope="col">Directores</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql = "SELECT * FROM convenios c ORDER BY anioFin DESC, anioIni Desc";
                                $sentencia = $conn->prepare($sql);
                                $sentencia->execute();
                                $resultado = $sentencia->fetchAll();

                                foreach ($resultado as $reg) {
                                    if ($reg['inicio'] == '') {
                                        $anioIni = $reg['anioIni'];
                                    } else {
                                        $anioIni = $reg['inicio'] . ", " . $reg['anioIni'];
                                    }

                                    if ($reg['fin'] == '') {
                                        $anioFin = $reg['anioFin'];
                                    } else {
                                        $anioFin = $reg['fin'] . ", " . $reg['anioFin'];
                                    }

                                    if ($anioFin == '') {
                                        $anioFin = "Vigente";
                                    }

                                    $tema = $reg['tema'];
                                    $comitente = $reg['comitente'];
                                    $arrayDirector = explode(", ", $reg['directores']);
                                    $countD = count($arrayDirector);

                                ?>
                                    <tr>
                                        <td class="row-transparente"><?php echo ($anioIni) ?></td>
                                        <td class="row-transparente"><?php echo ($anioFin) ?></td>
                                        <td class="row-transparente"><?php echo ($tema) ?></td>
                                        <td class="row-transparente"><?php echo ($comitente) ?></td>
                                        <td class="row-transparente">
                                            <?php

                                            for ($i = 0; $i < $countD; $i++) {
                                                echo ($arrayDirector[$i]) ?><br>
                                            <?php
                                            }
                                            ?> </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>