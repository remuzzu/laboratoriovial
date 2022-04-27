<?php

//Vamos a validar que el usuario haya iniciado sesión
session_start();    //Indicamos que vamos a iniciar la sesión; 


if (!isset($_SESSION['id_usuario'])) {
	header("Location: sglv_login.php");
}

$idUsuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

if (isset($_GET['frm'])) {
	$vieneDe = $_GET['frm'];
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
	<?php include("menu_sglv.php"); ?>

	<!--==========================
    Hero Section (Imagen del menú)
	============================-->
	<section id="hero" style="background: url(img/fondo-sglv.jpg) top center; 
		background-size: cover; height: 20vh;">
		<div class="hero-container">
			<!--<img src="assets/img/imae.png" alt="" title="" /></img><br>-->
			<!--<a href="#about" class="btn-get-started">Get Started</a>-->
		</div>
	</section><!-- #hero -->

	<?php
	switch ($vieneDe) {
		case "index":
			include("OT/index.php");
			break;
		case "create":
			include("OT/create.php");
			break;
		case "delete":
			include("OT/msn-delete.php");
			break;
		case "update":
			include("OT/update.php");
			break;
	}
	?>

	<?php include("footer.html"); ?>
</body>

</html>