<?php 
	if(isset($_POST['Email'])) { 
		
		// Dirección de correo y asunto personalizados 
		$email_to = " zolgpe@gmail.com"; //Cambiar correo a _@bakerymach.com
		$email_subject = "Cotización"; 
		
		function died($error) { 
			// Si hay algún error, el formulario puede desplegar su mensaje de aviso 
			echo "Lo sentimos, hubo un error en sus datos y el formulario no puede ser enviado en este momento. "; 
			echo "Detalle de los errores.<br /><br />"; 
			echo $error."<br /><br />"; 
			echo "Porfavor corrija estos errores e inténtelo de nuevo.<br /><br />"; 
			die(); 
		} 

		$error_message = false; if(isset($_POST[''])){ 
			$error_message = $_POST['']; 
		}

		echo $error_message; 
		
		// Se valida que los campos del formulairo estén llenos 
		if(!isset($_POST['InputName']) || !isset($_POST['InputCompany']) || !isset($_POST['InputEmail']) || !isset($_POST['InputService']) || !isset($_POST['description'])) { 
			died('Lo sentimos pero parece haber un problema con los datos enviados.'); 
		} 
		
		// Crear las variables que recolectaran la información de cada campo 
		$name = $_POST['InputName']; // requerido 
		$company = $_POST['InputCompany']; // no requerido 
		$email_from = $_POST['InputEmail']; // requerido 
		$service = $_POST['InputService']; // extraido de BD
		$message = $_POST['description']; // requerido 
		$error = "";
		
		// En esta parte se verifica que la dirección de correo sea válida  
		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/'; 
		
		if(!preg_match($email_exp, $email_from)) { 
			$error_message .= 'La dirección de correo proporcionada no es válida.<br />'; 
		}
		
		// En esta parte se validan las cadenas de texto 
		$string_exp = "/^[A-Za-z .'-]+$/"; 
		
		if(!preg_match($string_exp, $name)) { 
			$error_message .= 'El formato del nombre no es válido<br />'; 
		}  
		
		if(strlen($message) < 2) { 
			$error_message .= 'El formato del texto no es válido.<br />'; 
		} 
		
		if(strlen($error_message) < 0) { 
			died($error_message); 
		} 
		
		// Cuerpo del mensaje tal y como llegará al correo 
		$email_message = "\n"; 
		
		function clean_string($string) { 
			$bad = array("content-type","bcc:","to:","cc:","href"); 
			return str_replace($bad,"",$string); 
		} 
		
		$email_message .= "De: ".clean_string($name). ", ".clean_string($email_from)."\n"; 
		$email_message .= "Empresa: ".clean_string($company)."\n"; 
		$email_message .= "Asunto: ".clean_string($subject)."\n\n"; 
		$email_message .= clean_string($message)."\n"; 
		
		// Se crean los encabezados del correo 
		$headers = 'From: '.$email_from."\r\n". 'Reply-To: '.$email_from."\r\n" . 'X-Mailer: PHP/' . phpversion(); 
		
		if (@mail($email_to, $email_subject, $email_message, $headers)) {
	 		// Si el mensaje se envía muestra una confirmación
	 		echo "\n Gracias, su mensaje se envio correctamente.";
	 		header("refresh:3; Servicios.html");
 		}

 		else { 
 			//Si el mensaje no se envía muestra el mensaje de error
 			echo "Error: Su información no pudo ser enviada, intente más tarde";
 			header("refresh:3; Contacto.html");
 		}
 		
 		exit(); 
?> 

<?php 
	} 
?> 