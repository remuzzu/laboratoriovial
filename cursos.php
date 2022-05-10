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

    <!--==========================
    Hero Section (Imagen del menú) -- 
    Solo aparece en el INICIO, con el resto del menu no hay nada
	============================-->
    <section id="hero" style="background: url(assets/hero/curso.jpg) top center; 
            background-size: cover;
            height: 70vh;">
        <div class="hero-container">
            <!--<img src="assets/img/imae.png" alt="" title="" /></img><br>-->
            <h1>Cursos de Posgrado en Ingeniería Vial<br>Acreditables para la Maestría en
                Ingeniería Vial</h1>
            <!--<h2>Facultad de Ciencias Exactas Ingeniería y Agrimensura</h2>
            <h2>Escuela de Posgrado y Educación Continua</h2>
            <h2>Universidad Nacional de Rosario</h2>-->
            <!--<a href="#about" class="btn-get-started">Get Started</a>-->
        </div>
    </section><!-- #hero -->

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