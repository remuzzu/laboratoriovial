<?php

//DETALLE DE LAS FUNCIONES


/* RECUPERAR VARIABLES CON REQUEST */

/* POST: consiste en datos "ocultos" (porque el cliente no los ve)
   GET: lleva los datos de forma "visible" al cliente (se pasan en las url con ?)
   REQUEST permite capturar variables enviadas desde formularios con los métodos GET o POST (no es recomendable usarlo).
*/


//Validamos que los datos obligatorios sean ingresados (en registro.php)
function isNull($nombre, $ubicacion)
{
	if (
		strlen(trim($nombre)) < 1 || strlen(trim($ubicacion)) < 1) {
		return true;
	} else {
		return false;
	}
}

function validaPista($nombre)
{
	global $conn; //Esta función la HEREDAMOS DE conexion.php
	
	$sentencia = $conn->prepare("SELECT * FROM pista WHERE nombre = :nombre");
	$sentencia->execute(array(':nombre' => $nombre));
	$resultado = $sentencia->fetchAll();

	// If count == 1 that means the email is already on the database
	if (count($resultado) > 0) {
		return true;
	} else {
		return false;
	}
}

function resultBlock($errors)
{
	if (count($errors) > 0) {
		echo "<div id='error' class='alert alert-danger' role='alert'>
			<a href='#' onclick=\"showHide('error');\">[X]</a>
			<ul>";

		//Recorremos todo el array para mostrar TODOS los errores
		foreach ($errors as $error) {
			echo "<li>" . $error . "</li>";
		}
		echo "</ul>";
		echo "</div>";
	}
}

function resultBlockOK($message, $class)
{
	echo "<div id='mydiv' class='" . $class . "'>" . $message . "</div>";
}
?>

<script>
    setTimeout(function() {
        $('#mydiv').fadeOut('fast');
    }, 2000); // <-- time in milliseconds
</script>