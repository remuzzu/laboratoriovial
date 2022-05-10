<?php

require "conexion.php";
require "php/funcs.php";   //Funciones del lado del servidor (y otras que utiliza el cliente)

//Funciones del lado del cliente
$errors = array();  //Variable para ir colocando todos los errores.

if (!empty($_POST)) {
    //Si se envian los datos vamos a iniciar la sesión
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    if (isNullLogin($usuario, $password)){
        $errors[] = "Debe llenar los campos obligatorios";
    }

    $errors[] = login($usuario, $password, true);

} else {
    session_start();

    if (isset($_SESSION['id_usuario'])) {
        header("Location: index_sglv.php");
    }
}

?>

<!-- TUVE QUE PONERLO ACA PORQUE funcs LLAMA A HEADER Y PARA QUE ÉSTA FUNCIONE
TIENE QUE ESTAR SI O SI ANTES DE LA ETIQUETA <HEADER> SINO ¡NO FUNCIONA! -->

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>
    
    <!--==========================
    Hero Section (Imagen del menú)
	============================-->
	<section id="hero" style="background: url(assets/hero/ensayos.jpg) top center; 
		background-size: cover; height: 70vh;">
		<div class="hero-container">
            <h1>Sistema de Gerenciamiento<br>del Laboratorio Vial</h1>
		</div>
    </section><!-- #hero -->

    <?php include("sglv/login.php"); ?>
    
    <?php include("footer.html"); ?>
</body>

</html>