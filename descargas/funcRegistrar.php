<?php

/* 
https://codigosdeprogramacion.com/2017/02/27/curso-de-php-y-mysql-19-registro-de-usuarios/
*/

//VALIDACIONES DEL LADO DEL CLIENTE:

$errors = array();  //Variable para ir colocando todos los errores.

if (!empty($_POST)) {

	$nombre = $_POST['nombre'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$con_password = $_POST['con_password'];
	$organismo = $_POST['empresa'];
	$pais = $_POST['pais'];

	//$mysqli->real_escape_string($_POST['g-recaptcha-response']);
	$captcha = $_POST['g-recaptcha-response'];
	/* Esto se llama g-recaptcha + -response porque se agrega un nuevo elemento cuando se valide
	   el captcha */

	$activo = 0; 	//Para cuando validemos el usuario esté desactivado.
	//El usuario inicialmente esta en 0, y pasa a 1 cuando valida el usuario
	//a traves del link que se le envía al mail para activar su email-usuario
	$secret = '6LeETdUZAAAAAO0ocYD4eZX9OTRVOasizhPIAor8'; //'aqui va la clave secreta del captcha registrado';

	/* ----------------------------------------------------------------- */
	if (!$captcha) {
		$errors[] = "Por favor verifica el captcha";
	}

	/* VALIDAMOS POR EL LADO DEL SERVIDOR QUE LOS DATOS required NO VENGAN VACIOS
		   ESTO LO PUEDE HACER UN PROGRAMADOR AVANZADO ELIMINANDO EL required CUANDO
		   INSPECCIONA LA PÁGINA (F12) */
	if (isNull_descarga($nombre, $email, $password, $con_password, $organismo, $pais)) {
		$errors[] = "Debe llenar los campos obligatorios";
	}
	if (!isEmail($email)) {
		$errors[] = "Dirección de email inválida";
	}
	if (!validaPassword($password, $con_password)) {
		$errors[] = "Las contraseñas no coinciden";
	}

	$IDTipo = validaUsuarioImae($email);
	//Integrantes del laboratorio vial tienen permisos para descargar archivos
	
	if (usuarioExiste($email)) {
		$errors[] = "El usuario $email ya existe";
	}

	//TERMINAMOS CON LAS VALIDACIONES. VAMOS A MOSTRAR LOS RESULTADOS!
	if (count($errors) == 0) {
		//No tenemos errores->vamos a comenzar con el registro del usuario

		//Antes ... seguimos con la validación del captcha
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

		$arr = json_decode($response, TRUE); //Leemos la respuesta que nos envía google
		if ($arr['success'])	//Si es TRUE significa que nuestro captcha se validó correctamente
		{
			//REGISTRAMOS EL USUARIO

			//Ciframos la contraseña para guardarla en la base de datos
			// Almacenar el hash de la contraseña
			$pass_hash = hashPassword($password);
			$token = generateToken();

			$registro = registraUsuario($nombre, $email, $organismo, $pais, $pass_hash, $IDTipo, $activo, $token);
			if ($registro > 0) {
				//Se registro correctamente porque nos devuelve el ID

				//La siguiente acción será enviar el correo electrónico para avisar que está registrado
				//$_SERVER['SERVER_NAME'] = Nombre del servidor en el cual estoy
				
				//fceia
				$url = 'http://' . $_SERVER['SERVER_NAME'] .
					'/laboratoriovial/descargas/activar.php?id=' . $registro . '&val=' . $token;
				$asunto = 'Activar Cuenta - Sistema de Descarga';
				$cuerpo = mensajeActivacion($url, false);

				$rta = enviarEmail($email, $nombre, $asunto, $cuerpo); 
				if ($rta=="ok"){
					$cuerpoRegistro = mensajeRegistracion($email);
					/* echo "Para terminar el proceso de registro siga las instrucciones que les hemos
						enviado a su dirección de correo electrónico registrado: $email";
					*/
					echo $cuerpoRegistro;

					//Dejamos el link para iniciar sesión
					
					exit;	//Acá se corta el scrip y sale para que no muestre nuevamente el formulario.
				} else {
					//$errors[] = "Error al enviar Email" ;
					$errors[] = $rta;

					/* En $registro se encuentra el ID del registro en login para eliminar */
					$usuario = eliminaUsuario($registro);

					/* Para este tipo de error nos vamos a avisar porque es cambio de PHP
					   o un error que lo tengo que analizar en detalle ...
					   Por esta razón nos vamos a mandar un mail avisandonos */
					enviarMailError($rta, $usuario);
					
				}
			} else {
				$errors[] = "Error al Registrar";
			}
		} else {
			$errors[] = "Error al comprobar Captcha";
		}
	}
}



/* ¿Por qué debo usar hash en las contraseñas de los usuarios de mi aplicación? */
/* Si aplicamos un algoritmo hash a las contraseñas antes de almacenarlas en la base de datos,
dificultamos al atacante el determinar la contraseña original,
pese a que en un futuro podrá comparar el hash resultante con la contraseña original.*/

/* PHP 5.5 proporciona una API de hash de contraseñas nativa que maneja cuidadosamente el
empleo de hash y la verificación de contraseñas de una manera segura.*/



/* RECUPERAR VARIABLES CON REQUEST */

/* <form action="descargas/control_account.php" method="post" id="form_regis" style="display:none"> */

	/* POST: consiste en datos "ocultos" (porque el cliente no los ve)
	GET: lleva los datos de forma "visible" al cliente
	REQUEST permite capturar variables enviadas desde formularios con los métodos GET o POST (no es recomendable usarlo).
	*/

?>

