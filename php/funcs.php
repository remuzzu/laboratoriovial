<?php

//VALIDACIONES DEL LADO DEL SERVIDOR:


/* RECUPERAR VARIABLES CON REQUEST */

/* POST: consiste en datos "ocultos" (porque el cliente no los ve)
   GET: lleva los datos de forma "visible" al cliente (se pasan en las url con ?)
   REQUEST permite capturar variables enviadas desde formularios con los métodos GET o POST (no es recomendable usarlo).
*/


//Validamos que los datos obligatorios sean ingresados (en registro.php de sglv)
function isNull_registro($nombre, $email, $password, $con_password)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($password)) < 1 || strlen(trim($con_password)) < 1 || strlen(trim($email)) < 1) {
		return true;
	} else {
		return false;
	}
}

//Validamos que los datos obligatorios sean ingresados (en registro.php de descargas)
function isNull_descarga($nombre, $email, $password, $con_password, $organismo, $pais)
{
	if (strlen(trim($nombre)) < 1 || strlen(trim($password)) < 1 || strlen(trim($con_password)) < 1 || 
		strlen(trim($email)) < 1 || strlen(trim($organismo)) < 1 || strlen(trim($pais)) < 1) {
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

//Validamos que la contraseña y la repetición de contraseña sean iguales
function validaPassword($var1, $var2)
{
	if (strcmp($var1, $var2) != 0) {
		return false;
	} else {
		return true;
	}
}

//Validamos que la logitud min/max de ciertos campos (como por ejemplo la contraseña)
function minMax($min, $max, $valor)
{
	if (strlen(trim($valor)) < $min) {
		return true;
	} else if (strlen(trim($valor)) > $max) {
		return true;
	} else {
		return false;
	}
}

function validaUsuarioImae($email)
{
	switch ($email) {
		case "ogiovanon@gmail.com":
		case "remuzzu@gmail.com":
			$IDTipo = 1;	//Usuario Administrador-Programador
			break;

		case "martabpagola@gmail.com":
		case "marechalmariano@gmail.com":
		case "gabrielulisesmacedo@hotmail.com":
		case "andreo26@hotmail.com":
			//case "sangelon@fceia.unr.edu.ar":
			//case "fermar@fceia.unr.edu.ar":
			//case "marina_cc@hotmail.com":
			//case "juanpraffaelli@gmail.com":
			//case "luis.zorzutti@hotmail.com":
			
			$IDTipo = 2;	//Acceso a lo relacionado a las OT (también puede Descargar)
			break;

		case "marina_cc@hotmail.com":
		case "sangelon@fceia.unr.edu.ar":
			$IDTipo = 2;	//Acceso al relacionado a Cursos e Inicio (también puede Descargar)
			break;

		default:
			//usuario descarga
			$IDTipo = 0;
			break;
	}
	return $IDTipo;
}

//Verificamos que el usuario exista
function usuarioExiste($email)
{
	global $conn; //Esta función la HEREDAMOS DE conexion.php

	$sentencia = $conn->prepare("SELECT * FROM login WHERE email = :email");
	$sentencia->execute(array(':email' => $email));
	$resultado = $sentencia->fetchAll();

	// If count == 1 that means the email is already on the database
	if (count($resultado) > 0) {
		return true;
	} else {
		return false;
	}
}

function generateToken()
{
	/* Nos genera un valor dependiendo de la hora y la fecha de nuestro sistema: mt_rand()
		...despues a eso le saca un identificador: uniqid(mt_rand(), false)
		...y de ahí lo pasa a md5 */

	/* Lo usamos para que cuando el usuario se registre le envíe este token y 
	   sea único para todos los usuarios,
	   y así no pueda utilizar el token de otra persona para activar mi cuenta */

	$gen = md5(uniqid(mt_rand(), false));
	return $gen;
}

function generaTokenPass($login_id)
{
	global $conn;
	
	$token = generateToken();
	
	//password_request = 1 significa que el usuario solicitó un password (o sea: recuperación de contraseña)
	$sentencia = $conn->prepare("UPDATE login SET token_password = :token_password, 
		password_request = 1 WHERE id = :id");
	$sentencia->execute(array(':token_password' => $token, ':id' => $login_id));
	$conn = null;
	
	return $token;
}

function hashPassword($password)
{
	$hash = password_hash($password, PASSWORD_DEFAULT);
	return $hash;
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

function registraUsuario($nombre, $email, $organismo, $pais, $pass_hash, $IDTipo, $activacion, $token)
{
	global $conn;

	$sql = "Insert into persona (nombre, organismo, pais) values (?,?,?)";

	try {
		$sentencia = $conn->prepare($sql);
		$sentencia->execute([$nombre, $organismo, $pais]);
		$IDPersona = $conn->lastInsertId();	//Nos devuelve el ID del registro que se acaba de insertar

		$sql = "Insert into login(email, password, IDTipo, IDPersona, activacion, token) values (?,?,?,?,?,?)";
	
		try {
			$sentencia = $conn->prepare($sql);

			if ($sentencia->execute([$email, $pass_hash, $IDTipo, $IDPersona, $activacion, $token])) {
				return $conn->lastInsertId();
			} else {
				//Antes de salir, eliminamos el registro recién insertado
				$sqlLogin = "DELETE FROM persona WHERE ID = $IDPersona";
				$conn->query($sqlLogin);

				return 0;
			}
		} catch (PDOException $err) {
            // Mostramos un mensaje genérico de error.
			echo $err;
			
			//Antes de salir, eliminamos el registro recién insertado
			$sqlLogin = "DELETE FROM persona WHERE ID = $IDPersona";
			$conn->query($sqlLogin);
		}
	} catch (PDOException $err) {
		// Mostramos un mensaje genérico de error.
		echo $err;
	}
}

// Vamos a crear la función en la que se le mandará el mail para recuperación de contraseña
function enviarEmail($email, $nombre, $asunto, $cuerpo)
{
	/* 
	https://codigosdeprogramacion.com/2017/02/08/curso-de-php-y-mysql-13-envio-de-correo-electronico/
	*/
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer();

	$mail->isSMTP();	//Se va a autentificar mediante protocolo SMTP
	$mail->SMTPAuth = true;		//Acá decimos que se va a autentificar

	// Lo siguiente depende del correo de donde se enviaran los mail (en este caso es gmail)
	$mail->SMTPSecure = 'tls'; 	//Tipo de seguridad
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = '587';

	$correoEmisor = 'noreply.laboratoriovial@gmail.com';
	$mail->Username = $correoEmisor; //correo electronico de donde se mandarán los mails
	$mail->Password = 'viaLab2006'; //Modificar

	//Vamos a definir el contenido que va a llevar nuestro correo electronico
	$mail->setFrom($correoEmisor, 'Laboratorio Vial'); //Nombre del emisor
	$mail->addAddress($email, $nombre);	//A quien enviaremos nuestro correo


	//Se pueden enviar documentos o archivos adjuntos
	//$file = 'examen2.pdf';	//ubicación del archivo que vamos a enviar: convienve que esté dentro de
	//la carpeta donde esta función así no nos equivocamos el camino
	//$mail->addAttachment($file, 'Archivo PDF');	//el 2do.atributo es como se va a mostrar el archivo

	//Podríamos también mandar un mail por correo masivo
	/* En cuyo caso convendría tener una tabla en la base de datos con los datos que necesitamos
	   en [configuracion] estarian los datos del mail del emisor
	   id - host - port - email_emisor - password - asunto - cuerpo
	   y en [contacto] estarían los mailing a los que queremos enviar el mail
	   id - nombre - email 
	   Lo que faltaría sería adaptar el código accediendo a la base de datos y con 
	   el while correspondiente */

	//$mail->Subject = 'Recuperar Password - No responder'; //$asunto;
	$mail->Subject = $asunto;

	//En el cuerpo se puede utilizar texto plano o HTML
	$mail->Body    = $cuerpo;
	$mail->IsHTML(true);	//Habilitamos que se pueda enviar contenido en HTML

	$err = $mail->send();

	if ($mail->send()) {
		return "ok";
	} else {
		/* El tema es que si llegamos hasta acá, tenemos que volver para atras lo que se
		   hizo hasta ahora */
		return $mail->ErrorInfo;
	}

	/* Tenemos que realizar ahora una "configuración" en nuestra cuenta de gmail 
		imaelaboratoriovial@gmail.com:
		1. Vamos a Configuración \ Cuentas e Importación
		2. Cambiar la configuración de la cuenta: seleccionamos "Otra configuración de la cuenta de Google"
		3. Seleccionamos del panel izquierdo "Seguridad"
		4. Buscamos "Acceso de apps menos seguras"
		5. Seleccionamos el link "Activar el acceso (no se recomienda)"
		https://myaccount.google.com/lesssecureapps
		6. Activar "Permitir el acceso de apps menos segura"
	*/
}

function validaIdToken($id, $token)
{
	global $conn;

	/* Inicialmente activacion = 0
	   lo que significa que el usuario se dio de alta pero falta validar su email 
	   Luego de que valida su email (haciendo clic en el enlace que se le manda por correo)
	   activación pasa a valer 1 (activacion = 1) */
	$sentencia = $conn->prepare("SELECT activacion FROM login WHERE id = :id and token = :token LIMIT 1");
	$sentencia->execute(array(':id' => $id, ':token' => $token));
	$rows = $sentencia->fetch();

	if ($rows > 0) {
		$activacion = $rows['activacion'];

		if ($activacion == 1) {
			$msg = "La cuenta ya se activo anteriormente.";
		} else {
			if (activarUsuario($id)) {
				$msg = 'Cuenta activada.';
			} else {
				$msg = 'Error al Activar Cuenta';
			}
		}
	} else {
		$msg = 'No existe el registro para activar.';
	}
	return $msg;
}

function verificaTokenPass($login_id, $token){
	//Verifica que el id y el token sean de un registro valido
	//y además que password_request=1 lo que significa que el usuario quiere restaurar su pass
	global $conn;
	
	$sentencia = $conn->prepare("SELECT activacion FROM login WHERE id = :login_id AND 
		token_password = :token AND password_request = 1 LIMIT 1");
	$sentencia->execute(array(':login_id' => $login_id, 'token' => $token));
	$rows = $sentencia->fetch();

	if ($rows > 0)
	{
		$activacion = $rows['activacion'];
		if($activacion == 1)
		{
			return true;
		}
		else 
		{
			return false;
		}
	}
	else
	{
		return false;	
	}
}

function activarUsuario($id)
{
	global $conn;

	$sentencia = $conn->prepare("UPDATE login SET activacion = 1 WHERE id = :id");
	$result = $sentencia->execute(array(':id' => $id));

	return $result;
}

function mensajeActivacion($url, $sglv)
{
	if ($sglv){
		$mens = 'el sistema de gerenciamiento del Laboratorio Vial.';
	} else {
		$mens = 'la descarga de archivos.';
	}

	$msg = '
		<section id="about">
        	<div class="container">
            	<div class="row about-container">
                	<div class="col-lg-12 content order-lg-1 order-2" style="text-align: justify;">
						<h2 class="title" style="text-align: left;">Solo un paso más...</h2>
						<div style="border-top: 1px solid#888;">
                        </div>
						
						<h3 class="title" style="text-align: left;">
							Hemos creado su perfil de usuario para ' . $mens . '
						</h3>
						<h3 class="title" style="text-align: left;">
							Haga clic en el enlace a continuacion para activarla:
							<a href="' . $url . '">Activar cuenta</a>
						</h3>
					</div>
				</div>
        	</div>
		</section>
		';
	return $msg;
}

function mensajeRegistracion($email)
{
	$msg = '
	<section id="about">
		<div class="container wow fadeInUp">
			<div class="row justify-content-center">
				<div class="col-md-10 text-center">	
					<div class="col-lg-12 content order-lg-1 order-2" style="text-align: justify;">
						<h5 class="title">
							Para terminar el proceso de registro siga las instrucciones que le hemos
							enviado a su dirección de correo electrónico registrado: ' . $email . '
						</h5>
						<div style="border-top: 1px solid#888;">
						</div>
						</br>
						
						<form action="' . 'sglv_login.php' . '" style="text-align: center;">
							<input type="submit" class="btn btn-info btn-md" value="Iniciar Sesión" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	';
	return $msg;
}

function mensajeRecuperacion($url, $nombre)
{
	$msg = '
		<section id="about">
        	<div class="container">
            	<div class="row about-container">
                	<div class="col-lg-12 content order-lg-1 order-2" style="text-align: justify;">
						<h3 class="title" style="text-align: left;">
							Hola ' . $nombre . ',
						</h3>
						<h3 class="title" style="text-align: left;">
							se ha solicitado un reinicio de contrase&ntilde;a
						</h3>
						<h3 class="title" style="text-align: left;">
							Haga clic en el enlace a continuacion para restaurarla:
							<a href="' . $url . '">Recuperar contrase&ntilde;a</a>
						</h3>
					</div>
				</div>
        	</div>
		</section>
		';
	return $msg;
}

function mensajeReActivacion($email)
{
	$msg = '
	<section id="about">
		<div class="container wow fadeInUp">
			<div class="row justify-content-center">
				<div class="col-md-10 text-center">	
					<div class="col-lg-12 content order-lg-1 order-2" style="text-align: justify;">
						<h5 class="title">
							Para terminar el proceso de recuperacion de contrase&ntilde;a
							siga las instrucciones que les hemos
							enviado a su dirección de correo electrónico registrado: ' . $email . '
						</h5>
						<div style="border-top: 1px solid#888;">
						</div>
						</br>
						
						<form action="' . 'sglv_login.php' . '" style="text-align: center;">
							<input type="submit" class="btn btn-info btn-md" value="Iniciar Sesión" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	';
	return $msg;
}

/* ------------------------------------------------------------ */
/* FUNCIONES UTILIZADAS EN LOGIN.PHP (tanto desde sglv como de descargas) */
function isNullLogin($usuario, $password)
{
	if (strlen(trim($usuario)) < 1 || strlen(trim($password)) < 1) {
		return true;
	} else {
		return false;
	}
}

function login($usuario, $password, $sglv)
{
	global $conn;
	
	$sentencia = $conn->prepare("SELECT l.ID, l.IDTipo, l.password FROM login l WHERE l.email = :usuario  LIMIT 1");
	$sentencia->execute(array(':usuario' => $usuario));
	$rows = $sentencia->fetch();

	if ($rows > 0) {

		if (isActivo($usuario)) {
			$id = $rows['ID'];
			$id_tipo = $rows['IDTipo'];
			$passwd = $rows['password'];

			$validaPassw = password_verify($password, $passwd);

			if ($validaPassw) {
				lastSession($id);
				session_start();
				
				$_SESSION['id_usuario'] = $id;
				$_SESSION['tipo_usuario'] = $id_tipo;

				/* IMPORTANTE: para usar HEADER es necesario utilizarlo antes de las equiquetas
					<header> SI O SI -> SINO NO FUNCIONA 
					es por esto que tuvimos que ponerlo en el .php principal
					en este caso: sglv_login.php */

				if ($sglv){
					header('Location: index_sglv.php');
				} else {
					header('Location: descarga.php');
				}

				/* if (headers_sent()) {
					var_dump("las cabeceras ya se han enviado, no intentar añadir una nueva");
				}
				else {
					var_dump("es posible añadir nuevas cabeceras HTTP");
				} */

			} else {

				$errors = "La contrase&ntilde;a es incorrecta";
			}
		} else {
			$errors = 'El usuario no esta activo';
		}
	} else {
		$errors = "El nombre de usuario o correo electr&oacute;nico no existe";
	}
	return $errors;
}

function isActivo($usuario)
{
	global $conn;
	
	$sentencia = $conn->prepare("SELECT l.activacion FROM login l WHERE l.email = :usuario  LIMIT 1");
	$sentencia->execute(array(':usuario' => $usuario));
	$rows = $sentencia->fetch();
	$activacion = $rows['activacion'];
	
	if ($activacion == 1)
	{
		return true;
	}
	else
	{
		return false;	
	}
}

function lastSession($id)
{
	global $conn;
	
	$sentencia = $conn->prepare("UPDATE login SET last_session = NOW(),
		token_password = '', password_request = 0  WHERE id = :id");
	$sentencia->execute(array(':id' => $id));
	$conn = null;
}

function emailExiste($email)
{
	global $conn;
	
	$sentencia = $conn->prepare("SELECT id FROM login WHERE email = :email");
	$sentencia->execute(array(':email' => $email));

	$rows = $sentencia->fetch();

	if ($rows > 0) {
		return true;
	} else {
		return false;	
	}
}

function getId($email)
{
	global $conn;
	
	$sentencia = $conn->prepare("SELECT id FROM login WHERE email = :email");
	$sentencia->execute(array(':email' => $email));
	$rows = $sentencia->fetch();
	return $rows['id'];
}

function getNombre($email)
{
	global $conn;
	
	$sentencia = $conn->prepare("SELECT p.nombre FROM persona p inner join login l on
		l.IDPersona = p.id WHERE l.email = :email");
	$sentencia->execute(array(':email' => $email));
	$rows = $sentencia->fetch();
	return $rows['nombre'];
}

function cambiaPassword($pass_hash, $login_id, $token){
		
	global $conn;
	
	$sentencia = $conn->prepare("UPDATE login SET password = :pass_hash, 
		token_password = '', password_request = 0 WHERE 
		id = :login_id AND token_password = :token");
	$rta = $sentencia->execute(array(':pass_hash' => $pass_hash, ':token' => $token, ':login_id' => $login_id));
	
	if($rta){
		return true;
	} else {
		return false;		
	}
}

function eliminaUsuario($id)
{
	global $conn;

	$sentencia = $conn->prepare("SELECT IDPersona, email FROM login WHERE ID = :ID");
	$sentencia->execute(array(':ID' => $id));
	$rows = $sentencia->fetch();
	$IDPersona = $rows['IDPersona'];
	$usuario = $rows['email'];

	$sqlPersona = "DELETE FROM persona WHERE ID = $IDPersona";
	$conn->query($sqlPersona);

	$sqlLogin = "DELETE FROM login WHERE ID = $id";
	$conn->query($sqlLogin);

	return $usuario;
	
}

function enviarMailError($rta, $usuario)
{
	$destinatario = "remuzzu@gmail.com";

	$asunto = "Error en el registro de SGLV";
	$mensaje = "Error en el registro de nuevo usuario de SGLV con el usuario: " . $usuario . "\r\n";
	$mensaje = $mensaje . "Error: " . $rta;

	//Enviar
	try {
		mail($destinatario, $asunto, $mensaje);
	} catch (PDOException $err) {
		// Mostramos un mensaje genérico de error.
		echo $err;
	}
}

?>