<?php
require "../../conexion.php";

//Variable para ir colocando todos los errores.
$validator = array('success' => false, 'messages' => '');

//if form is submitted
if (!empty($_POST)) {
	$idPista = $_POST['idPista'];
	
	/* **************************************************************** */
	//Validamos que no se esté tratando de borrar una pista asociada a un valor de referencia
	/*$sentencia = $conn->prepare("SELECT * FROM pista WHERE nombre = :nombre");
	$sentencia->execute(array(':nombre' => $nombre));
	$resultado = $sentencia->fetchAll();*/

	// If count == 1 that means the email is already on the database
	/*if (count($resultado) > 0) {
		$validator['success'] = false;
		$validator['messages'] = "El numero de pista " . $nombre . " ya existe";
	}*/

	//No tenemos errores
	if ($validator['messages'] == "") {
		$sql = "DELETE FROM pista WHERE ID = $idPista";
		$query = $conn->prepare($sql);
        $query->execute();                           

		if ($query) {
			//Se registro correctamente porque nos devuelve el ID
			$validator['success'] = true;
			$validator['messages'] = "Successfully Deleted";
		} else {
			$validator['success'] = false;
			$validator['messages'] = "Error while delete the member information";
		}
	}
	// close the database connection
	$conn = null;

	//echo json_encode($validator);
	print json_encode($validator, JSON_UNESCAPED_UNICODE);
}
