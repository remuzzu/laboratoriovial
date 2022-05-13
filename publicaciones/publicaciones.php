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
                    <h2 class="title">Publicaciones del Laboratorio Vial</h2>

                    <div class="table-responsive">
                        <table class="table borderless display" id="tablaCurso">
                            <thead>
                                <tr class="row-active">
                                    <th scope="col">Año</th>
                                    <th scope="col">Titulo</th>
                                    <th scope="col">Lugar</th>
                                    <th scope="col">Autores</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                $sql_publi = "SELECT a.nombre, pt.anio, pt.lugar, p.titulo, p.otrosAutores 
                                FROM publicaciones p inner join publitodas pt on pt.idPublicacion = p.id 
                                inner JOIN publi_x_autor pa ON p.id=pa.idPublicacion 
                                INNER JOIN personal a ON a.id=pa.idAutor
                                ORDER BY anio desc, lugar, titulo";
                                $sentencia_publi = $conn->prepare($sql_publi);
                                $sentencia_publi->execute();
                                $resultado_publi = $sentencia_publi->fetchAll();

                                $anio = "";    //Vble.que usamos para colocar una unica etiqueta por año
                                $titulo = "";    //Vble.que usamos para colocar una unica etiqueta por titulo
                                //$lugar="";	//Vble.que usamos para colocar una unica etiqueta por lugar (usada para todos los autores)
                                $nombre = "";
                                $autor = "";
                                $firts = True;
                                $iLugar = 0;

                                foreach ($resultado_publi as $reg) {
                                    if ($firts) {
                                        $anio = $reg['anio'];
                                        $titulo = $reg['titulo'];
                                        $lugar[$iLugar] = $reg['lugar'];
                                        $otrosAutores = $reg['otrosAutores'];
                                        $firts = False;
                                    }

                                    if ($anio <> $reg['anio']) {
                                        colocaEtiquetaAnio($anio, "anio", $firts);

                                        colocaEtiqueta($titulo, "titulo", $firts);

                                        $aa = "";
                                        for ($j = 0; $j <= $iLugar; $j++) {
                                            switch ($j) {
                                                case 0:
                                                    $aa = $lugar[$j];
                                                    break;
                                                default:
                                                    $aa = $aa . '<br><br>' . $lugar[$j];
                                                    break;
                                            }
                                        }
                                        colocaEtiqueta($aa, "lugar", $iLugar);

                                        if ($otrosAutores <> "") {
                                            $autor = $autor . ", " . $otrosAutores;
                                        }
                                        colocaEtiqueta($autor, "autores", $firts);

                                        $iLugar = 0;
                                        $anio = $reg['anio'];
                                        $titulo = $reg['titulo'];
                                        $lugar[$iLugar] = $reg['lugar'];
                                        $otrosAutores = $reg['otrosAutores'];
                                        $autor = "";
                                    } else {
                                        if ($titulo <> $reg['titulo']) {
                                            colocaEtiquetaAnio($anio, "anio", $firts);

                                            colocaEtiqueta($titulo, "titulo", $firts);

                                            $aa = "";
                                            for ($j = 0; $j <= $iLugar; $j++) {
                                                switch ($j) {
                                                    case 0:
                                                        $aa = $lugar[$j];
                                                        break;
                                                    default:
                                                        $aa = $aa . '<br><br>' . $lugar[$j];
                                                        break;
                                                }
                                            }
                                            colocaEtiqueta($aa, "lugar", $iLugar);

                                            if ($otrosAutores <> "") {
                                                $autor = $autor . ", " . $otrosAutores;
                                            }
                                            colocaEtiqueta($autor, "autores", $firts);

                                            $iLugar = 0;
                                            $anio = $reg['anio'];
                                            $titulo = $reg['titulo'];
                                            $lugar[$iLugar] = $reg['lugar'];
                                            $otrosAutores = $reg['otrosAutores'];
                                            $autor = "";
                                        } else {
                                            if ($lugar[$iLugar] <> $reg['lugar']) {
                                                $iLugar += 1;
                                                $lugar[$iLugar] = $reg['lugar'];
                                                $autor = "";
                                            }
                                        }
                                    }


                                    if ($autor == "") {
                                        $autor =  $reg['nombre'];
                                    } else {
                                        $autor = $autor . ", " . $reg['nombre'];
                                    }
                                }

                                //Colocamos la ultima etiqueta
                                colocaEtiquetaAnio($anio, "anio", $firts);

                                colocaEtiqueta($titulo, "titulo", $firts);

                                if ($otrosAutores <> "") {
                                    $autor = $autor . ", " . $otrosAutores;
                                }

                                $aa = "";
                                $aa = "";
                                for ($j = 0; $j <= $iLugar; $j++) {
                                    switch ($j) {
                                        case 0:
                                            $aa = $lugar[$j];
                                            break;
                                        default:
                                            $aa = $aa . '<br><br>' . $lugar[$j];
                                            break;
                                    }
                                }
                                colocaEtiqueta($aa, "lugar", $iLugar);

                                colocaEtiqueta($autor, "autores", $firts);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>


<?php
function colocaEtiquetaAnio($etiqueta, $opcion, $firts)
{
    if ($firts) {
?>
        <tr>
            <td>
                <h3 class="post-title"><?php echo ($etiqueta) ?></h3>
            </td>
        <?php
    } else {
        ?>
        </tr>
        <tr>
            <td class="row-transparente">
                <h3 class="post-title"><?php echo ($etiqueta) ?></h3>
            </td>
            <?php
        }
    }

    function colocaEtiqueta($etiqueta, $opcion, $firts)
    {

        switch ($opcion) {
            case "titulo":
            ?>
                <td class="row-transparente">
                    <h6><?php echo ($etiqueta) ?></h6>
                </td>
            <?php
                break;

            case "lugar":
            ?>
                <td class="row-transparente"><?php echo ($etiqueta) ?></td>
            <?php
                break;

            case "autores":
            ?>
                <td class="row-transparente"><?php echo ($etiqueta) ?></td>
        </tr>
<?php
                break;
        }
    }

    function search($autor, $autor_anio, $ind)
    {
        for ($j = 0; $j < $ind; $j++) {
            if ($autor_anio[$j] == $autor) {
                return true;
                exit;
            }
        }
        return false;
    }
?>