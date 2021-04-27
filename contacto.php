<?php
    /*require("admin/pages/config.php");
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
		$mensaje = "Mensaje recibido desde el formulario de contacto de DeborahSosa. Nombre: ".$_POST['nombre']." - Email: ".$_POST['email']." - Asunto: ".$_POST['asunto']." - Mensaje: ".$_POST['mensaje']." - Telefono: ".$_POST['telefono']." - Motivo: ".$_POST['motivo'];
		$mail->Subject = "DeborahSosa - Formulario de Contacto"; // Este es el titulo del email.
		$mensajeHtml = nl2br($mensaje);
		$mail->Body = "{$mensajeHtml} <br /><br />"; // Texto del email en formato HTML
		$mail->AltBody = "{$mensaje} \n\n"; // Texto sin formato HTML
		//$mail->Send(); 
		
		// insert data    
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "INSERT INTO `contactos`(`nombre`, `email`, `telefono`, `asunto`, `motivo`, `mensaje`) VALUES (?,?,?,?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['nombre'],$_POST['email'],$_POST['telefono'],$_POST['asunto'],$_POST['motivo'],$_POST['mensaje']));
			
		Database::disconnect();
		
	}*/
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" ng-app="tokkoSendContact">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched" ng-controller="tokkoSendContactController">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header><!-- #header end -->

		<!-- Page Title
		============================================= -->
		<section id="page-title" class="page-title-pattern3">

			<div class="container clearfix">
				<h1><font color="white">Contactanos</font></h1>
				<span><font color="white">Escribinos y obtené el mejor asesoramiento de parte de nuestros brokers</font></span>
			</div>

		</section>
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">

					<div class="row gutter-40 col-mb-80">
						<!-- Contact Form
						============================================= -->
						<div class="postcontent col-lg-9">

							<h3>Envianos un mensaje</h3>
							
							<div class="form-widget">

								<div class="form-result"></div>

								<form class="mb-0" id="" name="template-contactform" >

									<!--<div class="form-process">
										<div class="css3-spinner">
											<div class="css3-spinner-scaler"></div>
										</div>
									</div>-->

									<div class="row">
										<div class="col-md-4 form-group">
											<label for="template-contactform-name">Nombre <small>*</small></label>
											<input type="text" id="template-contactform-name" name="nombre" value="" class="sm-form-control required" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-email">E-mail <small>*</small></label>
											<input type="email" id="template-contactform-email" name="email" value="" class="required email sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-phone">Teléfono</label>
											<input type="text" id="template-contactform-phone" name="telefono" value="" class="sm-form-control required" />
										</div>

										<div class="w-100"></div>

										<div class="col-md-8 form-group">
											<label for="template-contactform-subject">Asunto <small>*</small></label>
											<input type="text" id="template-contactform-subject" name="asunto" value="" class="required sm-form-control" />
										</div>

										<div class="col-md-4 form-group">
											<label for="template-contactform-service">Motivo</label>
											<select id="template-contactform-service" name="motivo" class="sm-form-control required">
												<option value="">-- Seleccione --</option>
												<option value="Tasaciones">Tasaciones</option>
												<option value="Inversiones">Inversiones</option>
												<option value="Administración">Administración</option>
												<option value="CV">Trabajá con nosotros</option>
											</select>
										</div>

										<div class="w-100"></div>

										<div class="col-12 form-group">
											<label for="template-contactform-message">Mensaje <small>*</small></label>
											<textarea class="required sm-form-control" id="template-contactform-message" name="mensaje" rows="6" cols="30"></textarea>
										</div>

										<div class="col-12 form-group d-none">
											<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
										</div>

										<div class="alert alert-success col-12 text-center p-0 pt-4" role="alert" id="mensajeEnviadoOK" style="display: none">
											<h4>¡Mensaje enviado!</h4>
										</div>

										<div class="col-12 form-group">
											<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0" ng-click="enviarMensajeContacto()">Enviar</button>
										</div>
									</div>

									

									<input type="hidden" name="prefix" value="template-contactform-">

								</form>
							</div>

						</div><!-- Contact Form End -->

						<div class="sidebar col-lg-3">

							<address>
								<strong>Oficina:</strong><br>
								Square Bureau Libertador<br>
								Av. Libertador 6810 - 2º E CABA<br>
							</address>
							<abbr title="Phone Number"><strong>Teléfono:</strong></abbr> (+54) 11 5263-9000<br>
							<abbr title="Email Address"><strong>E-mail:</strong></abbr> info@deborahsosa.com.ar

							<div class="widget border-0 pt-0">

								<a href="https://www.facebook.com/DEBORAHSOSAInversiones/" class="social-icon si-small si-dark si-facebook">
									<i class="icon-facebook"></i>
									<i class="icon-facebook"></i>
								</a>

								<a href="https://www.youtube.com/channel/UCRUeKm4x2OqivkFmA07ylZg" class="social-icon si-small si-dark si-youtube">
									<i class="icon-youtube"></i>
									<i class="icon-youtube"></i>
								</a>

								<a href="https://www.instagram.com/deborahsosainversiones/" class="social-icon si-small si-dark si-instagram">
									<i class="icon-instagram"></i>
									<i class="icon-instagram"></i>
								</a>

							</div>

						</div><!-- .sidebar end -->
					</div>


				</div>
			</div>
		</section><!-- #content end -->

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark">
			<?php include("footer.php"); ?>
		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>
	<script src="https://maps.google.com/maps/api/js?key=AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y"></script>

	<!--LIBRERÍA ANGULAR-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
	<script src="js/tokko/tokkoSendContact.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>