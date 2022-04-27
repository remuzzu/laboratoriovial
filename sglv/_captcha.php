<?php
/* VALIDAMOS DENTRO DEL MISMO FORMULARIO LOS DATOS ENVIADOS POR ÉL MISMO
	ESTO LO PODEMOS HACER PORQUE USAMOS action="<?php $_SERVER['PHP_SELF']; ?>" */

if (!empty($_POST)) {

	$name = $_POST['name'];
	$password = $_POST['password'];
	$captcha = $_POST['g-recaptcha-response'];
	/* Esto se llama g-recaptcha + -response porque se agrega un nuevo elemento cuando se valide
		el captcha */

	//localhost y fceia
	//clave secreta: 6LeETdUZAAAAAO0ocYD4eZX9OTRVOasizhPIAor8
	//clave de sitio: 6LeETdUZAAAAAAPDsk4h-LVIkrAQEOi6d-Pxn61L
	$secret = '6LeETdUZAAAAAO0ocYD4eZX9OTRVOasizhPIAor8'; //'aqui va la clave secreta';

	// Validamos que el captcha esté correcto
	if (!$captcha) {
		echo "Por favor verifica el captcha";
	} else {
		/* Ahora validamos del lado del "google" para que nos diga que nuestro capctha es correcto */

		// Le pasamos la URL que aparece en la configuración del registro de nuestro captcha
		/* Como le estamos pasando por método GET recordemos que los datos
				se los pasamos utilizando el "?" 
				y para agregar otro parámetro lo concatenamos con el "&" */
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

		/* $response nos devuelve un archivo en formato JSON */
		//var_dump($response);

		$arr = json_decode($response, TRUE); //Leemos la respuesta que nos envía google
		if ($arr['success'])	//Si es TRUE significa que nuestro captcha se validó correctamente
		{
			echo '<h2>Thanks</h2>';
		} else {
			echo '<h3>Error al comprobar Captcha </h3>';
		}
	}
}
?>

<html>

<head>
	<title>Google Recapcha</title>

	<script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>
	<!-- $_SERVER['PHP_SELF'] significa que envia los datos (mediante metodo POST) al mismo archivo
		 es decir, a si mismo -->

	<form id="form" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
		Usuario: <input type="text" name="name">
		<br><br>
		Password: <input type="password" name="password">
		<br><br>

		<!-- aqui va la clave del sitio -->
		<div class="g-recaptcha" data-sitekey="6LeETdUZAAAAAAPDsk4h-LVIkrAQEOi6d-Pxn61L"></div>

		<br>
		<input type="submit" name="login" value="Login">

	</form>
</body>

</html>