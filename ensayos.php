<?php
if (isset($_GET['frm'])) {
    $vieneDe = $_GET['frm'];
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>

    <?php
    switch ($vieneDe) {
        case "saer":
            include("ensayos/saer.html");
            break;

        case "agregados":
            include("ensayos/agregados.html");
            break;

        case "asfaltos":
            include("ensayos/asfaltos.html");
            break;

        case "mezclas":
            include("ensayos/mezclas.html");
            break;

        case "pavimentos":
            include("ensayos/pavimentos.html");
            break;

        case "suelos":
            include("ensayos/suelos.html");
            break;
    }
    ?>

    <?php include("footer.html"); ?>
</body>

</html>