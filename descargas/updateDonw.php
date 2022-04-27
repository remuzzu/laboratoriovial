<?php
	include_once('../conexion.php');

	$IDLogin=$_POST['idUsuario'];
	$IDFile=$_POST['IDFile'];
	$accion=$_POST['accion'];
	$fecha=date("y/m/d");
	//$fecha=date("d/m/y");
	
	$sql = "Insert into descargas (IDLogin, IDFile, Fecha) values (?,?,?)";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute([$IDLogin, $IDFile, $fecha]);

	//echo "Hola " . $IDLogin;
?>