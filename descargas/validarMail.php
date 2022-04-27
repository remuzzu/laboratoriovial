<?php
	include_once('../conexion.php');

	$email=$_POST['email'];
	
	// Query to check if the email already exist
	$sql = "SELECT * FROM login WHERE email = '" . $email . "'";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();

	// If count == 1 that means the email is already on the database
	if (count($resultado) > 0) {
		echo "false";
	} else {
		echo "true";
	}
?>