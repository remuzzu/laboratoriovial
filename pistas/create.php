<?php require_once '../conexion.php'; 
	//$parametro = $_POST['parametro'];
	//$pista= $_POST['pista'];
	//$huella= $_POST['huella'];
	//$anio= $_POST['anio'];
	
	$name = $_POST['name'];
	$address = $_POST['address'];
	$contact = $_POST['contact'];
	$active = $_POST['active'];

	$sql = "INSERT INTO valor_referencia (IDPista, Huella, Valor, Anio) VALUES (?,?,?,?)";
	$sentencia = $conn->prepare($sql);

	try {
		$sentencia->execute([1, $name, 2.23, 2022]);

		$validator['success'] = true;
		$validator['messages'] = "Successfully Added";      
		
		if ($sentencia) {
			return $conn->lastInsertId();
		} else {
			return 0;
		}
	} catch (PDOException $err) {
		// Mostramos un mensaje genérico de error.
		$validator['success'] = false;
		$validator['messages'] = "Error while adding the member information";
	}


	// close the database connection
	$conn->bd->close();

	echo json_encode($validator);

?>