<?php
if (isset($_GET['frm'])) {
    $vieneDe = $_GET['frm'];
}

if ($vieneDe=='contacto'){
    require "cursos/funcs.php";        //Detalle de las funciones especificadas en funcENVIA.php
    require "contacto/funcENVIA.php";   //Funciones requeridas de validaciones del lado del cliente
}
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">

<?php include("head.html"); ?>

<body>
    <?php include("menu.html"); ?>
    
	<?php
    switch ($vieneDe) {
		case "contacto":
			include("contacto/contacto.php");
			break;
		case "ok":
			include("contacto/ok.html");
			break;
	}
	?>
    
    <?php include("footer.html"); ?>
</body>

</html>