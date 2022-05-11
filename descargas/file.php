<!-- Nos conectamos para controlar si es usuario logueado -->

<?php
include_once('conexion.php');
?>

<!-- El protocolo HTTP es un protocolo sin estado, lo que significa que no hay forma de que un servidor 
     recuerde a un usuario específico entre múltiples peticiones -->
<!-- Si las credenciales introducidas por el usuario son válidas, el servidor crea una nueva sesión. 
     El servidor genera un número aleatorio único, que es llamado identificador de sesión 
     (session id en inglés). 
     También crea un nuevo fichero en el servidor que es usado para almacenar información específica
     para dicha sesión.-->


<main id="main">
    <section id="about" style="margin-top: 50px;">
        <div class="container wow fadeInUp">
            <div class="row about-container">
                <h2 class="col-12">
                    <?php
                    //isset comprueba si una variable está definida o no
                    if (isset($_SESSION['id_usuario'])) {
                    ?>
                        <form action="descargas/closesession.php" class="text-center">
                            <?php
                            echo 'Bienvenid@ ' . utf8_decode($nombre) . ", ahora puedes descargar"; ?>
                            <input type="submit" class="btn btn-primary btn-lm" value="Cerrar Sesión" />
                        </form>
                    <?php
                    } else {
                        $idUsuario = 0;
                    ?>
                        Para la descarga de archivos es necesario loguearse <a href="descarga_login.php">aqui</a>
                    <?php
                    }
                    ?>
                </h2>
            </div>

            <form action="" method="post" id="frm_file" style="display:block">
                <input type="hidden" id="idUsuario" value="<?php echo ($idUsuario); ?>" />

                <div class="table-responsive">
                    <table id="tablaCurso" class="table borderless display">
                        <thead>
                            <tr class="row-active">
                                <th scope="col" style="width: 5%"></th>
                                <th scope="col" style="width: 30%"></th>
                                <th scope="col" style="width: 10%"></th>
                            </tr>
                        </thead>

                        <tbody>
                            <!-- Se eliminó el 06/08/21
                            <tr>
                                <td>1</td>
                                <td>Cálculo del IRI a partir del perfil topográfico (IRI.xls)</td>
                                <td>
                                    <a href="descarga_login.php" onclick="to('1')">
                                        <img src="assets/img/notas.png" class="imag" title="IRI.xls"></a>
                                </td>
                            </tr>
                            -->
                            <tr>
                                <td>1</td>
                                <td>Programa para modelización, diseño y verificación de estructuras, empírico mecanicista (BackViDe2021.zip)</td>
                                <td>
                                    <a href="descarga_login.php" onclick="to('1')">
                                        <img src="assets/img/notas.png" class="imag" title="BackViDe2021.rar"></a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Conferencia Autódromos IMAE - Ing. Jorge Páramo (04-12-13)</td>
                                <td>
                                    <a href="descarga_login.php" onclick="to('2')">
                                        <img src="assets/img/notas.png" class="imag" title="13-12-04_Autodromos Conf IMAE.pdf"></a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>ESR-PAQ, Cálculo de Estructuras de Suelos Reforzados</td>
                                <td>
                                    <a href="descarga_login.php" onclick="to('3')">
                                        <img src="assets/img/notas.png" class="imag" title="ESR-PAQ.zip"></a>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </section>
</main>

<script>
    function to(IDFile) {
        var x;
        x = $("#idUsuario");
        if (x.val() != 0) {
            $.ajax({
                type: "POST",
                url: "descargas/updateDonw.php",
                data: "idUsuario=" + x.val() + "&IDFile=" + IDFile + "&accion=1",
                success: function(respuesta) {
                    if (respuesta != '') {
                        //alert(respuesta);
                    }
                }
            });
            switch (IDFile) {
                case "1":
                    //window.open('descargas/IMAE 2018.ZIP'); Modificado el 06/08/21 por la sgte.versión
                    window.open('descargas/IMAE2021.rar');
                    break;
                case "2":
                    window.open('descargas/13-12-04_Autodromos Conf IMAE.pdf');
                    break;
                case "3":
                    window.open('descargas/ESR-PAQ.zip');
                    break;
            }

        }
    }
</script>