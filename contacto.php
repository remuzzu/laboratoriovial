<?php
if (isset($_GET['frm'])) {
    $vieneDe = $_GET['frm'];
}

if ($vieneDe=='contacto'){
    require "cursos/funcs.php";        //Detalle de las funciones especificadas en funcENVIA.php
    require "contacto/funcENVIA.php";   //Funciones requeridas de validaciones del lado del cliente
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>
    
    <!--==========================
    Hero Section (Imagen del menú)
	============================-->
	<section id="hero" style="background: url(img/hero-bg.jpg) top center; 
		background-size: cover; height: 70vh;">
		<div class="hero-container">
			<!--<img src="assets/img/imae.png" alt="" title="" /></img><br>-->
			<h2>Facultad de Ciencias Exactas Ingeniería y Agrimensura</h2>
			<h2>Universidad Nacional de Rosario</h2>
			<!--<a href="#about" class="btn-get-started">Get Started</a>-->
		</div>
    </section><!-- #hero -->

	<?php
    switch ($vieneDe) {
		case "contacto":
			include("contacto/contacto.php");
			break;
		case "ok":
			include("contacto/ok.html");
			break;
	}
	?>
    
    <?php include("footer.html"); ?>
</body>

</html>