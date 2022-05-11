<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php
if (isset($_GET['frm'])) {
    $vieneDe = $_GET['frm'];
}

if ($vieneDe=='mailing'){
    require "cursos/funcs.php";        //Detalle de las funciones especificadas en funcCREATE.php
    require "cursos/funcENVIA.php";   //Funciones requeridas de validaciones del lado del cliente
}
?>

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>

    <?php
    switch ($vieneDe) {
        case "cursos":
            include("cursos/cursos.html");
            break;
        case "maestria":
            include("cursos/maestria.html");
            break;
        case "mailing":
            include("cursos/mailing.php");
            break;
        case "ok":
            include("cursos/ok.html");
            break;
    }
    ?>

    <?php include("footer.html"); ?>
</body>

</html>

<?php include("cursos/infoAdicional.php"); ?>
<?php include("cursos/modal.php"); ?>