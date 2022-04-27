<?php

//VALIDACIONES DEL LADO DEL CLIENTE:

$errors = array();  //Variable para ir colocando todos los errores.
$message = "";		//vbles.para la inserción exitosa
$class = "";

if (!empty($_POST)) {

	$nroOT = $_POST['nroOT'];
	$nroPresu = $_POST['nroPresu'];
	//$fechaAlta = date("d/m/Y", strtotime($_POST['fechaAlta']));
	$fechaAlta = date("y/m/d", strtotime($_POST['fechaAlta']));

	$cliente = $_POST['cliente'];
	$descri = $_POST['descri'];
	$detalle = $_POST['detalle'];
	$importe = $_POST['importe'];
	$estado = $_POST['estado'];
	$respons = $_POST['respons'];

	/* VALIDAMOS POR EL LADO DEL SERVIDOR QUE LOS DATOS required NO VENGAN VACIOS
		ESTO LO PUEDE HACER UN PROGRAMADOR AVANZADO ELIMINANDO EL required CUANDO
		INSPECCIONA LA PÁGINA (con la tecla F12) */
	if (isNull($nroOT, $fechaAlta, $cliente, $descri, $importe)) {
		$errors[] = "Debe llenar los campos obligatorios";
	}
	
	if(!isMoneda($importe)){
		$errors[] = "El $importe no tiene formato numérico";
	}

	if (validaOT($nroOT)) {
		$errors[] = "La OT nro. $nroOT ya existe";
	}

	//TERMINAMOS CON LAS VALIDACIONES. VAMOS A INSERTAR LA OT!
	if (count($errors) == 0) {
		//No tenemos errores
		
		$ot = new ordenTrabajo();

		$registroOT = $ot->insert($nroOT, $nroPresu, $fechaAlta, $cliente, $descri, $detalle,
			$importe, $estado, $respons);

		if ($registroOT) {
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