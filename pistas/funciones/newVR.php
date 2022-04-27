<?php
/* La proxima función la usamos para cargar los valores de referencia en pista/index.php */
function newVR(){
	$parametro = $_POST['parametro'];
	$pista= $_POST['pista'];
	$huella= $_POST['huella'];
	$anio= $_POST['anio'];

	

	//Guardamos los datos en un array
	$datos = array(
		'estado' => 'ok',
		'nombre' => $parametro, 
		'apellido' => $pista, 
		'edad' => $huella
	);
	//Devolvemos el array pasado a JSON como objeto
	echo json_encode($datos);
}
?>