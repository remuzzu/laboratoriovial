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

	$errors[] = login($usuario, $password, false);

} else {
	session_start();

	if (isset($_SESSION['id_usuario'])) {
        header("Location: descarga.php");
	}
}	
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>
	
    <?php include("descargas/login.php"); ?>
    
    <?php include("footer.html"); ?>
</body>

</html>