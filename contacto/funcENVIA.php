<?php

//Antes de enviar vamos a validar que los campos esten completos como corresponda
//VALIDACIONES DEL LADO DEL CLIENTE:

$errors = array();  //Variable para ir colocando todos los errores.

if (!empty($_POST)) {

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $ciudad = $_POST['ciudad'];
    $comentario = $_POST['comentario'];

    if (isset($_POST["chMailing"]) && $_POST["chMailing"] == 1){
        $comentario .= "\r\n" . "Suscripción a la lista de mailing";
    }

    $captcha = $_POST['g-recaptcha-response'];
	/* Esto se llama g-recaptcha + -response porque se agrega un nuevo elemento cuando se valide
       el captcha */
       
    $secret = '6LeETdUZAAAAAO0ocYD4eZX9OTRVOasizhPIAor8'; //'aqui va la clave secreta del captcha registrado';

    /* ----------------------------------------------------------------- */
    if (!$captcha) {
        $errors[] = "Por favor verifica el captcha";
    }

    /* VALIDAMOS POR EL LADO DEL SERVIDOR QUE LOS DATOS required NO VENGAN VACIOS
    ESTO LO PUEDE HACER UN PROGRAMADOR AVANZADO ELIMINANDO EL required CUANDO
    INSPECCIONA LA PÁGINA (F12) */
    if (isNull($nombre, $email, $ciudad)) {
        $errors[] = "Debe llenar los campos obligatorios";
    }

    if (!isEmail($email)){
        $errors[] = "Dirección de email inválida";
    }

    //TERMINAMOS CON LAS VALIDACIONES. VAMOS A MOSTRAR LOS RESULTADOS!
	if (count($errors) == 0) {
		//No tenemos errores->vamos a comenzar con el registro del usuario

		//Antes ... seguimos con la validación del captcha
		$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$captcha");

		$arr = json_decode($response, TRUE); //Leemos la respuesta que nos envía google
		if ($arr['success'])	//Si es TRUE significa que nuestro captcha se validó correctamente
		{
            //Con copia oculta
            $destinatario = "remuzzu@gmail.com, marechalmariano@gmail.com" . "\r\n";

            $asunto = "Enviado desde la página de laboratoriovial";
            $mensaje = "Nombre: " . $nombre . "\r\n";
            $mensaje .= "Email: " . $email . "\r\n";
            $mensaje .= "Ciudad: " . $ciudad . "\r\n";
            $mensaje .= "Comentario: " . $comentario;

            //Dirección del remitente 
            $remitente = $_POST['email'];

            $headers  = "MIME-Version: 1.0\n";
            $headers .= "Content-type: text/plain; charset=utf-8\n";
            $headers .= "X-Priority: 3\n";
            $headers .= "X-MSMail-Priority: Normal\n";
            $headers .= "X-Mailer: php\n";
            $headers .= "From: \"" . $_POST['nombre'] . " " . "\" <".$remitente.">\n";

            //Enviar
            mail($destinatario, $asunto, $mensaje, $headers);
            
            header("Location: contacto.php?frm=ok");  //se debe crear un html que confirma el envío
        } else {
			$errors[] = "Error al comprobar Captcha";
		}
    }
}
?>