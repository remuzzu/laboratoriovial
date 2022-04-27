<?php

//o reanudar una sesión que ya está activa
//Si no colocamos esta linea no nos permite utilizar las vbles. de sesión
require "conexion.php";
require "php/funcs.php";


//Vamos a validar que el usuario haya iniciado sesión
session_start();    //Indicamos que vamos a iniciar la sesión; 


if (!isset($_SESSION['id_usuario'])) {
	header("Location: sglv_login.php");
}

$idUsuario = $_SESSION['id_usuario'];
$tipo_usuario = $_SESSION['tipo_usuario'];

$sentencia = $conn->prepare("Select p.nombre from persona p inner join login l on p.id = l.IDPersona
        WHERE l.id = :idUsuario");
$sentencia->execute(array(':idUsuario' => $idUsuario));
$rows = $sentencia->fetch();
$nombre = $rows['nombre'];

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

	<?php include("inicio/inicio_sglv.php"); ?>

	<?php include("footer.html"); ?>
</body>

</html>