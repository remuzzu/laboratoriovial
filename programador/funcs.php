<?php

require "../conexion.php";

switch ($_POST['action']) {
	case "convertFecha":
		echo "Entramos a convertFecha";
		convertFecha();
		break;
	case "convertFechaDescargas":
		echo "Entramos convertFechaDescargas";
		convertFechaDescargas();
		break;
	default:
		echo "Error";
		break;
}


function convertFecha()
{
	global $conn; //Esta función la HEREDAMOS DE conexion.php

	//UPDATE ordentrabajo set fechaAlta = STR_TO_DATE(fechaAlta, '%d/%m/%Y')
	//Arreglar OT n° 5891 y 29303 en el original

	$sql = "SELECT ID, CONVERT(date, fechaAlta) FROM ordentrabajo";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();

	foreach ($resultado as $reg) {
		$id = $reg['ID'];
		$fechaAlta = $reg['fechaAlta'];
		//$fechaAlta = date("m/d/Y", strtotime($reg['fechaAlta']));

		var_dump($id . " - " . $fechaAlta);
		//$sqlUpdate = $conn->prepare("UPDATE ordentrabajo SET fechaalta = :fechaAlta where id = :id");
		//$sqlUpdate->execute(array(':fechaAlta' => $fechaAlta, ':id' => $id));
	}

	$conn = null;
}

function convertFechaDescargas()
{
	global $conn; //Esta función la HEREDAMOS DE conexion.php

	$sql = "SELECT ID, STR_TO_DATE(fecha, '%d/%m/%Y') as fecha FROM descargas";
	$sentencia = $conn->prepare($sql);
	$sentencia->execute();
	$resultado = $sentencia->fetchAll();

	foreach ($resultado as $reg) {
		$id = $reg['ID'];
		$fecha = $reg['fecha'];
		//$fecha = date("m/d/Y", strtotime($reg['fecha']));
		
		var_dump($id . " - " . $fecha);
		$sqlUpdate = $conn->prepare("UPDATE descargas SET fecha = :fecha where id = :id");
		$sqlUpdate->execute(array(':fecha' => $fecha, ':id' => $id));
	}

	$conn = null;
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

?>