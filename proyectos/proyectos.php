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
    <section style="margin-top: 50px;">
        <div class="container">
            <div class="row">
                <div class="left-0 text-center bg-faded p-4 rounded">
                    <h2 class="title">Proyectos del Laboratorio Vial</h2>

                    <div class="table-responsive">
                        <table class="table borderless display" id="tablaCurso">
                            <thead>
                                <tr class="row-active">
                                    <th scope="col">Inicio</th>
                                    <th scope="col">Fin</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Director/es</th>
                                    <th scope="col" style="width: 20%">Integrantes</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                /*$sql = "(SELECT * FROM proyectos p WHERE ISNULL(anioFin) 
                                    ORDER BY anioFin DESC)
                                    UNION
                                    (SELECT * FROM proyectos p ORDER BY anioFin desc, anioIni DESC)";*/

                                $sql = "SELECT * FROM proyectos p ORDER BY anioIni desc, anioFin desc";

                                $sentencia = $conn->prepare($sql);
                                $sentencia->execute();
                                $resultado = $sentencia->fetchAll();

                                foreach ($resultado as $reg) {
                                    $anioIni = $reg['anioIni'];
                                    $anioFin = $reg['anioFin'];
                                    if ($anioFin == '') {
                                        $anioFin = "Vigente";
                                    }
                                    $titulo = $reg['Titulo'];
                                    $arrayDirector = explode(", ", $reg['Directores']);
                                    $countD = count($arrayDirector);
                                    $arrayIntegrantes = explode(", ", $reg['Integrantes']);
                                    $countI = count($arrayIntegrantes);

                                ?>
                                    <tr>
                                        <td class="row-transparente"><?php echo ($anioIni) ?></td>
                                        <td class="row-transparente"><?php echo ($anioFin) ?></td>
                                        <td class="row-transparente"><?php echo ($titulo) ?></td>
                                        <td class="row-transparente">
                                            <?php

                                            for ($i = 0; $i < $countD; $i++) {
                                                echo ($arrayDirector[$i]) ?><br>
                                            <?php
                                            }
                                            ?> </td>
                                        <td class="row-transparente">
                                            <?php
                                            for ($j = 0; $j < $countI; $j++) {
                                                echo ($arrayIntegrantes[$j]) ?><br>
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