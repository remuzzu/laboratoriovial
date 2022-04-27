<?php
require "../../conexion.php";

//Variable para ir colocando todos los errores.
$validator = array('success' => false, 'messages' => '');

//if form is submitted
if (!empty($_POST)) {
	$nombre = $_POST['nombre'];
	$ubicacion = $_POST['ubicacion'];
	$idSup = $_POST['superficie'];

	/* **************************************************************** */
	//Validamos que no se esté tratando de insertar una pista ya existente
	$sentencia = $conn->prepare("SELECT * FROM pista WHERE nombre = :nombre");
	$sentencia->execute(array(':nombre' => $nombre));
	$resultado = $sentencia->fetchAll();

	// If count == 1 that means the email is already on the database
	if (count($resultado) > 0) {
		$validator['success'] = false;
		$validator['messages'] = "El numero de pista " . $nombre . " ya existe";
		//$errors[] = "El numero de pista " . $nombre . " ya existe";
	}

	//TERMINAMOS CON LAS VALIDACIONES. VAMOS A INSERTAR LA OT!
	//	if (count($validator) == 0) {
	//No tenemos errores
	if ($validator['messages'] == "") {
		$sql = "INSERT INTO pista (nombre, ubicacion, IDSuperficie) VALUES ('$nombre','$ubicacion',$idSup)";
		$query = $conn->query($sql);

		if ($query) {
			//Se registro correctamente porque nos devuelve el ID
			$validator['success'] = true;
			$validator['messages'] = "Successfully Added";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while adding the member information";
		}
	}
	// close the database connection
	$conn = null;

	//echo json_encode($validator);
	print json_encode($validator, JSON_UNESCAPED_UNICODE);
}
