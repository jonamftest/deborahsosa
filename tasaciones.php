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
		$mensaje = "Mensaje recibido desde el formulario de tasaciones de DeborahSosa. Nombre: ".$_POST['nombre']." - Email: ".$_POST['email']." - Operacion: ".$_POST['operacion']." - Comentarios: ".$_POST['comentarios']." - Telefono: ".$_POST['telefono']." - Barrio: ".$_POST['barrio']." - Propiedad: ".$_POST['propiedad'];
		$mail->Subject = "DeborahSosa - Formulario de Tasaciones"; // Este es el titulo del email.
		$mensajeHtml = nl2br($mensaje);
		$mail->Body = "{$mensajeHtml} <br /><br />"; // Texto del email en formato HTML
		$mail->AltBody = "{$mensaje} \n\n"; // Texto sin formato HTML
		//$mail->Send(); 
		
		// insert data    
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$sql = "INSERT INTO `tasaciones`(`nombre`, `telefono`, `email`, `operacion`, `propiedad`, `barrio`, `comentarios`) VALUES (?,?,?,?,?,?,?)";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['nombre'],$_POST['telefono'],$_POST['email'],$_POST['operacion'],$_POST['propiedad'],$_POST['barrio'],$_POST['comentarios']));
			
		Database::disconnect();
		
	}*/
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" ng-app="tokkoSendtasaciones">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix" ng-controller="tokkoSendTasacionesController">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header><!-- #header end -->

		<section id="page-title" class="page-title-pattern1">

			<div class="container clearfix">
				<h1><font color="white">Tasación</font></h1>
				<span><font color="white">¿Necesitás saber cuánto vale tu propiedad?</font></span>
			</div>

		</section>
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<form id="" name="billing-form" class="row mb-0">
					<div class="row col-mb-50 gutter-50">
						<div class="col-lg-6">
							<h3>Datos de Contacto</h3>

							<p>¿Necesitás saber cuanto vale tu propiedad?</p>

							
								
								<div class="col-md-12 form-group">
									<label for="shipping-form-name">Nombre:</label>
									<input type="text" id="shipping-form-name" name="nombre" value="" class="sm-form-control" required/>
								</div>

								<div class="col-12 form-group">
									<label for="shipping-form-companyname">Teléfono:</label>
									<input type="text" id="shipping-form-companyname" name="telefono" value="" class="sm-form-control" required/>
								</div>

								<div class="col-12 form-group">
									<label for="shipping-form-address">E-Mail:</label>
									<input type="email" id="shipping-form-address" name="email" value="" class="sm-form-control" required/>
								</div>

							
						</div>

						<div class="col-lg-6">
							<h3>Datos de tasación</h3>
							
							<p>Envíanos tu información. Nuestros tasadores responderán su necesidad a la brevedad. Estamos online de 10hs a 19hs.</p>

							

								<div class="col-md-12 form-group">
									<label for="template-contactform-service">Tipo de operación</label>
									<select id="template-contactform-service" name="operacion" class="sm-form-control" required>
										<option value="">-- Seleccione --</option>
										<option value="Venta">Venta</option>
										<option value="Alquiler">Alquiler</option>
										<option value="Alquiler temporario">Alquiler temporario</option>
									</select>
								</div>

								<div class="col-md-12 form-group">
									<label for="template-contactform-service">Tipo de propiedad</label>
									<select id="propiedad" name="propiedad" class="sm-form-control" required>
										<option value="">-- Seleccione --</option>
										<option value="Departamento">Departamento</option>
										<option value="Casa">Casa</option>
										<option value="PH">PH</option>
										<option value="Local comercial">Local comercial</option>
										<option value="Oficina">Oficina</option>
										<option value="Galpón">Galpón</option>
										<option value="Lote">Lote</option>
										<option value="Otro">Otro</option>
									</select>
								</div>

								<div class="col-12 form-group">
									<label for="billing-form-companyname">Barrio:</label>
									<input type="text" id="billing-form-companyname" name="barrio" value="" class="sm-form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="billing-form-address">Comentarios:</label>
									<textarea class="required sm-form-control" id="template-contactform-message" name="comentarios" rows="6" cols="30"></textarea>
								</div>

							
						</div>

						<div class="alert alert-success col-12 text-center p-0 pt-4" role="alert" id="mensajeEnviadoOK" style="display: none">
							<h4>¡Mensaje enviado!</h4>
						</div>

						<div class="w-100"></div>
						
						<div class="col-lg-12">
							
							<button name="submit" type="submit" id="submit-button" tabindex="5" class="button button-3d m-0" ng-click="enviarMensajeTasaciones()">Enviar</button>
						</div>
						
					</div>
					</form>
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

	<!--LIBRERÍA ANGULAR-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
	<script src="js/tokko/tokkoSendTasaciones.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>