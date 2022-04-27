<?php

//VALIDACIONES DEL LADO DEL CLIENTE:

$errors = array();  //Variable para ir colocando todos los errores.
$message = "";		//vbles.para la inserción exitosa
$class = "";

if (!empty($_POST)) {

	$nombre = $_POST['nombre'];
	$ubicacion = $_POST['ubicacion'];
	$idSup = $_POST['superficie'];

	/* VALIDAMOS POR EL LADO DEL SERVIDOR QUE LOS DATOS required NO VENGAN VACIOS
		ESTO LO PUEDE HACER UN PROGRAMADOR AVANZADO ELIMINANDO EL required CUANDO
		INSPECCIONA LA PÁGINA (con la tecla F12) */
	if (isNull($nombre, $ubicacion)) {
		$errors[] = "Debe llenar los campos obligatorios";
	}
	
	if (validaPista($nombre)) {
		$errors[] = "El numero de pista " . $nombre . " ya existe";
	}

	//TERMINAMOS CON LAS VALIDACIONES. VAMOS A INSERTAR LA OT!
	if (count($errors) == 0) {
		//No tenemos errores
		
		$pista = new pista();

		$registroPista = $pista->insert($nombre, $ubicacion, $idSup);

		if ($registroPista) {
			//Se registro correctamente porque nos devuelve el ID
			$message = "Datos insertados con éxito!";
			$class = "alert alert-success";
			
			//echo "<div id='mydiv' class='" . $class . "'>" . $message . "></div>";

			//exit;	//Acá se corta el scrip y sale para que no muestre nuevamente el formulario.
		} else {
			$errors[] = "Error al Registrar";
		}
	}
}
?>