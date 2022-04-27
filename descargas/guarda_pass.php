<?php

require "../conexion.php";
require "../php/funcs.php";

$login_id = $_POST['login_id'];
$token = $_POST['token'];
$password = $_POST['password'];
$con_password = $_POST['con_password'];

//Validamos que los password coincidan
if (validaPassword($password, $con_password)) {
	//Ciframos la nueva contraseña para guardarla en la base de datos
	// Almacenar el hash de la contraseña
	$pass_hash = hashPassword($password);

	if(cambiaPassword($pass_hash, $login_id, $token))
	{
		echo "Password modificado!";
		echo "<br>";
		echo "<a href='../descarga_login.php'>Iniciar sesión</a>";
	} else {
		echo "Error al modificar el Password";
	}
} else {
	echo "Las contraseñas no coinciden!";
}

?>

