<?php

//DETALLE DE LAS FUNCIONES


/* RECUPERAR VARIABLES CON REQUEST */

/* POST: consiste en datos "ocultos" (porque el cliente no los ve)
   GET: lleva los datos de forma "visible" al cliente (se pasan en las url con ?)
   REQUEST permite capturar variables enviadas desde formularios con los métodos GET o POST (no es recomendable usarlo).
*/


//Validamos que los datos obligatorios sean ingresados (en registro.php)
function isNull($nombre, $email, $ciudad)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($email)) < 1 || strlen(trim($ciudad)) < 1) {
		return true;
	} else {
		return false;
	}
}

//Validamos que el dato EMAIL tenga formato email
function isEmail($email)
{
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
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

?>