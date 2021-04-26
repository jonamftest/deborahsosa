<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");
	require("PHPMailer/class.phpmailer.php");
	require("PHPMailer/class.smtp.php");
    
	if ( !empty($_POST)) {
		/* copia de tasaciones - hacer bien para cv y con el adjunto al mail
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
		$mensaje = "Mensaje recibido desde el formulario de CV de DeborahSosa. Nombre: ".$_POST['nombre']." - Email: ".$_POST['email']." - Operacion: ".$_POST['operacion']." - Comentarios: ".$_POST['comentarios']." - Telefono: ".$_POST['telefono']." - Barrio: ".$_POST['barrio']." - Propiedad: ".$_POST['propiedad'];
		$mail->Subject = "DeborahSosa - Formulario de CV"; // Este es el titulo del email.
		$mensajeHtml = nl2br($mensaje);
		$mail->Body = "{$mensajeHtml} <br /><br />"; // Texto del email en formato HTML
		$mail->AltBody = "{$mensaje} \n\n"; // Texto sin formato HTML
		*/
		//$mail->Send(); 
		
		Database::disconnect();
		
	}
	
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header><!-- #header end -->

		<section id="page-title" class="page-title-pattern2">

			<div class="container clearfix">
				<h1><font color="white">Trabajá con nosotros</font></h1>
				<span><font color="white">¿Querés formar parte de nuestro equipo?</font></span>
			</div>

		</section>
		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">
					<form id="" name="billing-form" class="row mb-0" action="cv.php" method="post">
					<div class="row col-mb-50 gutter-50">
						<div class="col-lg-12">
							<h3>Datos de Contacto</h3>

							<p>Formá parte de nuestro equipo</p>

							
								
								<div class="col-md-12 form-group">
									<label for="shipping-form-name">Nombre:</label>
									<input type="text" id="shipping-form-name" name="nombre" value="" class="sm-form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="shipping-form-companyname">Teléfono:</label>
									<input type="text" id="shipping-form-companyname" name="telefono" value="" class="sm-form-control" />
								</div>

								<div class="col-12 form-group">
									<label for="shipping-form-address">E-Mail:</label>
									<input type="email" id="shipping-form-address" name="email" value="" class="sm-form-control" />
								</div>
								
								<div class="col-12 form-group">
									<label for="shipping-form-name">Barrio de residencia:</label>
									<input type="text" id="shipping-form-name" name="barrio" value="" class="sm-form-control" />
								</div>
								
								<div class="col-12 form-group">
									<label for="shipping-form-name">CV:</label>
									<input type="file" id="shipping-form-name" name="cv" value="" class="sm-form-control" />
								</div>

							
						</div>

						
						<div class="w-100"></div>
						
						<div class="col-lg-12">
							
							<button name="submit" type="submit" id="submit-button" tabindex="5" value="Submit" class="button button-3d m-0">Enviar</button>
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

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>