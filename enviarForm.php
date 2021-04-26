<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");
	require("PHPMailer/class.phpmailer.php");
	require("PHPMailer/class.smtp.php");
    
	if ( !empty($_POST)) {
		
		$smtpHost = "";  // Dominio alternativo brindado en el email de alta 
		$smtpUsuario = "";  // Mi cuenta de correo
		$smtpClave = "";  // Mi contrasenia

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->Port = 465; 
		$mail->SMTPSecure = 'ssl';
		$mail->IsHTML(true); 
		$mail->CharSet = "utf-8";
		$mail->Host = $smtpHost; 
		$mail->Username = $smtpUsuario; 
		$mail->Password = $smtpClave;
		$mail->From = ""; // Email desde donde envío el correo.
		$mail->FromName = "DeborahSosa";
		$mail->AddAddress(""); // Esta es la dirección a donde enviamos los datos del formulario
		$mensaje = "Mensaje recibido desde el formulario de contacto de DeborahSosa. Nombre: ".$_POST['nombre']." - Email: ".$_POST['email']." - Publicacion: ".$_POST['id_publicacion']." - Mensaje: ".$_POST['mensaje']." - Telefono: ".$_POST['telefono'];
		$mail->Subject = "DeborahSosa - Formulario de Contacto"; // Este es el titulo del email.
		$mensajeHtml = nl2br($mensaje);
		$mail->Body = "{$mensajeHtml} <br /><br />"; // Texto del email en formato HTML
		$mail->AltBody = "{$mensaje} \n\n"; // Texto sin formato HTML
		//$mail->Send(); 
		
		header("Location: index.php");
		
	}
	
?>