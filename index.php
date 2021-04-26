<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");
?>
<!DOCTYPE >
<html dir="ltr" lang="en-US" html ng-app="tokkoIndex">
<head>
	<?php include("head.php"); ?>
</head>

<body class="stretched" ng-controller="tokkoIndexController">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header><!-- #header end -->

		<section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100 include-header">
			<div class="slider-inner">

				<div class="swiper-container swiper-parent">
					<div class="swiper-wrapper">
						<div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
									<h2 data-animate="fadeInUp">HACE COMO ELLA... ANIMATE!</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Encontrá el lugar de tus sueños, nosotros te ayudamos.</p>
								</div>
							</div>
							<div class="video-wrap">
								<video id="slide-video" poster="images/videos/explore-poster.jpg" preload="auto" loop autoplay muted>
									<source src='images/videos/25607273-sd.mov' type='video/webm' />
									<source src='images/videos/25607273-sd.mov' type='video/mp4' />
								</video>
								<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
							</div>
						</div>
						<div class="swiper-slide dark">
							<div class="container">
								<div class="slider-caption slider-caption-center">
									<h2 data-animate="fadeInUp">TIEMPO DE CAMBIOS... NECESITAS MUDARTE!</h2>
									<p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Animate a cambiar vos también, nosotros te ayudamos!</p>
								</div>
							</div>
							<div class="video-wrap">
								<video id="slide-video" poster="images/videos/explore-poster.jpg" preload="auto" loop autoplay muted>
									<source src='images/videos/1056243143-sd.mov' type='video/webm' />
									<source src='images/videos/1056243143-sd.mov' type='video/mp4' />
								</video>
								<div class="video-overlay" style="background-color: rgba(0,0,0,0.55);"></div>
							</div>
						</div>
					</div>
					<div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
					<div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
				</div>

				<a href="#" data-scrollto="#content" data-offset="100" class="one-page-arrow dark"><i class="icon-angle-down infinite animated fadeInDown"></i></a>

			</div>
		</section>
		<div class="tabs advanced-real-estate-tabs clearfix">

			<div class="tab-container">
				<div class="container clearfix">
					<div class="tab-content clearfix" id="tab-properties">
						<form action="buscador.php" method="get" class="mb-0" id="buscador">
							<div class="row">
								<div class="col-lg-3 col-md-6 col-12 bottommargin-sm">
									<label for="">Operación</label>
									<select name="tipo_operacion" id="tipoOperacion"class="selectpicker form-control" data-size="6" style="width:100%; line-height: 30px;">
										<option value="">Todas</option>
							  			<option value="1">Comprar</option>
							  			<option value="2">Alquiler</option>
							  			<option value="3">Alquiler temporario</option>
							  			<option value="4">Emprendimientos</option>
									</select>
								</div>
								<div class="col-lg-3 col-md-6 col-12 bottommargin-sm">
									<label for="">Propiedad</label>
									<select name="propiedades" class="selectpicker form-control" id="propiedades" data-size="6" style="width:100%; line-height: 30px;">
										<option value="">Todas</option>

									</select>
								</div>
								<div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
									<label for="">Ambientes</label>
									<select name="ambientes" class="selectpicker form-control" data-size="6" style="width:100%; line-height: 30px;" id="ambientes">
										<option value="">Todos</option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5+</option>
									</select>
								</div>
								<div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
									<label for="">Provincia</label>
									<select name="provincia" class="selectpicker form-control" data-size="6" style="width:100%; line-height: 30px;" id="provincias">
										<option value="">Todos</option>
									</select>
								</div>
								<!--<div class="col-lg-2 col-md-6 col-6 bottommargin-sm">
									<label for="">Apto Crédito</label>
									<select name="apto_credito" class="selectpicker form-control" data-size="6" style="width:100%; line-height: 30px;">
										<option value="">Todos</option>
										<option value="1">Si</option>
										<option value="2">No</option>
									</select>
								</div>-->
								
								<div class="w-100"></div>
								<div class="col-lg-2 col-md-6 col-6">
									<label for="" style="margin-bottom: 20px !important;">Zona</label>
									<select name="zonas" class="selectpicker form-control" data-size="6" style="width:100%; line-height: 30px;" id="zonas">
										<option value="">Todos</option>
									</select>
								</div>
								<div class="col-lg-2 col-md-12 clearfix">
									<button class="button button-3d button-rounded btn-block m-0" style="margin-top: 35px !important;">Buscar</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

		</div>

		<!-- Content
		============================================= -->
		<section id="content">
			<div class="content-wrap">
				<div class="container">
					<div class="row align-items-center">
						<?php
						$pdo = Database::connect();
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						
						$sql = "SELECT `id`, `detalle` FROM `publicaciones` WHERE `activa` = 1 and `destacada` = 1  ";
						$q = $pdo->prepare($sql);
						$q->execute();
						$data = $q->fetch(PDO::FETCH_ASSOC);
						?>
						<div class="col-lg-5">
							<div class="heading-block">
								<h1>DESTACADA DEL MES</h1>
							</div>
							<p class="lead"><?php echo $data['detalle'];?></p>
						</div>

						<div class="col-lg-7 align-self-end">
							<div class="position-relative overflow-hidden">
								<img src="images/services/main-fbrowser.png" data-animate="fadeInUp" data-delay="100" alt="Chrome">
								<img src="images/services/main-fmobile.png" style="top: 0; left: 0; min-width: 100%; min-height: 100%;" data-animate="fadeInUp" data-delay="400" alt="iPhone" class="position-absolute">
							</div>

						</div>

					</div>
				</div>
				
				<div class="section topmargin mb-0 border-bottom-0">
					<div class="container clearfix">
						<div class="heading-block center m-0">
							<h3>Nuevos Ingresos</h3>
						</div>
					</div>
				</div>
				<!-- INICIAMOS TOKKENINDEX-->
				<div ng-init="iniciarTokkoIndex()">
				<div id="portfolio" class="portfolio row no-gutters portfolio-reveal grid-container">
					<article class="portfolio-item col-6 col-md-4 col-lg-3 p-2 pf-icons pf-illustrations" ng-repeat='nvIngresos in NuevasPropiedades'>
						<div class="grid-inner">
							<div class="portfolio-image">
								<img src="{{nvIngresos.photos[0].image}}">
								<div class="bg-overlay" data-lightbox="gallery">
									<div class="bg-overlay-content dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item">
										<!-- CONTENIDO NUEVOS INGRESOS-->

										<a href="{{nvIngresos.photos[0].image}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>

										<div ng-repeat="fotos in nvIngresos.photos">
											<div ng-if='fotos.image != nvIngresos.photos[0].image'>
												<a href="{{fotos.image}}" class="d-none" data-lightbox="gallery-item"></a>
											</div>
										</div>

										<a href="detalle.php?id={{nvIngresos.id}}&price={{nvIngresos.operations[0].prices[0].price}}" class="overlay-trigger-icon bg-light text-dark" data-hover-animate="fadeInDownSmall" data-hover-animate-out="fadeOutUpSmall" data-hover-speed="350" data-hover-parent=".portfolio-item"><i class="icon-line-ellipsis"></i></a>

										
									</div>
									<div class="bg-overlay-bg dark" data-hover-animate="fadeIn" data-hover-parent=".portfolio-item"></div>
								</div>
							</div>
							<div class="portfolio-desc">
								<a href="detalle.php?id={{nvIngresos.id}}&price={{nvIngresos.operations[0].prices[0].price}}">
									<h3>{{nvIngresos.publication_title}}</h3>
									<span>{{nvIngresos.location.full_location}}</span>
								</a>
							</div>
						</div>
					</article>
				</div>
				</div>
				<div class="container clearfix">

					<div class="heading-block topmargin-lg center">
						<h2>¿Qué hacemos y cómo?</h2>
					</div>

					<div class="row col-mb-50 mb-4">
						<div class="col-lg-4 col-md-6">

							<div class="feature-box flex-md-row-reverse text-md-right" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-exchange"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Operaciones simultáneas</h3>
									<p>Compra y Vende en forma simultánea, somos especialistas en Operaciones Simultáneas!</p>
								</div>
							</div>

							<div class="feature-box flex-md-row-reverse text-md-right mt-5" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-moneybox"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Invertir de forma inteligente</h3>
									<p>Contamos con diferentes tipos de Inversiones. Consultanos!</p>
								</div>
							</div>

							<div class="feature-box flex-md-row-reverse text-md-right mt-5" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-doc"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Tasaciones sin compromiso</h3>
									<p>Nuestros tasadores responderán tu necesidad a la brevedad. Contanos los detalles de tu propiedad para que podamos realizar la mejor tasación del mercado.</p>
								</div>
							</div>

						</div>

						<div class="col-lg-4 d-md-none d-lg-block text-center">
							<img src="images/services/home_cover_mobile_3.jpg" alt="iphone 2">
						</div>

						<div class="col-lg-4 col-md-6">

							<div class="feature-box" data-animate="fadeIn">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-my-house"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Asesoramiento general</h3>
									<p>Consultoría y Asesoramiento personalizado. Contarás con la mejor asesoría del mercado, nuestros agentes estarán dispuestos a ayudarte y mejorar tu experiencia.</p>
								</div>
							</div>

							<div class="feature-box mt-5" data-animate="fadeIn" data-delay="200">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-building"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Proyectos y desarrollos</h3>
									<p>Desarrollamos todo tipo de propiedades. Contanos cual es tu proyecto!</p>
								</div>
							</div>

							<div class="feature-box mt-5" data-animate="fadeIn" data-delay="400">
								<div class="fbox-icon">
									<a href="#"><i class="icon-realestate-key"></i></a>
								</div>
								<div class="fbox-content">
									<h3>Administración de alquileres</h3>
									<p>Administramos el alquiler de su propiedad de forma profesional, haciendo rendir al máximo su rentabilidad. Control exhaustivo de todas las obligaciones que el inquilino debe cumplir.</p>
								</div>
							</div>

						</div>
					</div>

				</div>
				
				<div class="heading-block topmargin-lg center">
						<h2>NUESTRAS MÉTRICAS HASTA HOY</h2>
				</div>
				
				<div class="row clearfix align-items-stretch bottommargin-lg">

					<div class="col-lg-3 col-md-6 dark center col-padding" style="background-color: #0B6121;">
						<i class="i-plain i-xlarge mx-auto icon-line2-directions"></i>
						<div class="counter counter-lined"><span data-from="100" data-to="9647" data-refresh-interval="50" data-speed="2000"></span>K</div>
						<h5>Tasaciones realizadas</h5>
					</div>

					<div class="col-lg-3 col-md-6 dark center col-padding" style="background-color: #088A29;">
						<i class="i-plain i-xlarge mx-auto icon-line2-graph"></i>
						<div class="counter counter-lined"><span data-from="3000" data-to="89344" data-refresh-interval="100" data-speed="2500"></span></div>
						<h5>Visitas concretadas</h5>
					</div>

					<div class="col-lg-3 col-md-6 dark center col-padding" style="background-color: #04B404;">
						<i class="i-plain i-xlarge mx-auto icon-line2-layers"></i>
						<div class="counter counter-lined"><span data-from="10" data-to="25765" data-refresh-interval="25" data-speed="3500"></span></div>
						<h5>Metros vendidos</h5>
					</div>

					<div class="col-lg-3 col-md-6 dark center col-padding" style="background-color: #01DF01;">
						<i class="i-plain i-xlarge mx-auto icon-line2-clock"></i>
						<div class="counter counter-lined"><span data-from="60" data-to="53432" data-refresh-interval="30" data-speed="2700"></span></div>
						<h5>Metros alquilados</h5>
					</div>

				</div>
				
				<div class="row clearfix align-items-stretch">

					<div class="col-lg-6 center col-padding" style="background: url('images/services/main-fbrowser.png') center center no-repeat; background-size: cover;">
					</div>

					<div class="col-lg-6 center col-padding" style="background-color: #F5F5F5;">
						<div class="heading-block border-bottom-0">
							<h3>Construimos todo tipo de propiedades.</h3><p class="lead mb-0">Contanos cual es tu proyecto!</p>
						</div>
						
						

						<div class="center bottommargin">
							<a class="d-block position-relative" href="https://www.youtube.com/watch?v=k64c-vp2b4s" data-lightbox="iframe">
								<img src="images/services/video.png" alt="Video">
								<div class="bg-overlay">
									<div class="bg-overlay-content dark">
										<span class="overlay-trigger-icon size-lg op-ts op-07 bg-light text-dark" data-hover-animate="op-1" data-hover-animate-out="op-07" data-hover-parent=".row"><i class="icon-line-play"></i></span>
									</div>
								</div>
							</a>
						</div>
						
						<p class="lead mb-0">Junto a TBC hacemos tus sueños realidad. Con mas de 25.765 mts construidos y 45 proyectos en curso.</p>
					</div>

				</div>
				
				<div class="section parallax dark mb-0" style="background-image: url('images/services/home-testi-bg.jpg'); padding: 100px 0;" data-bottom-top="background-position:0px 300px;" data-top-bottom="background-position:0px -300px;">

					<div class="heading-block center">
						<h3>TESTIMONIOS</h3>
					</div>

					<div class="fslider testimonial testimonial-full" data-animation="fade" data-arrows="false">
						<div class="flexslider">
							<div class="slider-wrap">
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/3.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Lo más importante en una operación es la información. DEBORAH SOSA trabaja con un CRM que nos permite realizar un seguimiento constante de las propiedades que le confiamos, y eso es un excelente servicio.</p>
										<div class="testi-meta">
											Estudio BJC
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/2.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Luego de evaluar varias alternativas de empresas inmobiliarias que nos den soporte en la nueva estrategia de negocio, optamos por elegir a DEBORAH SOSA. Fue una muy buena elección y supo entender siempre nuestras necesidades.</p>
										<div class="testi-meta">
											Estudio NW
										</div>
									</div>
								</div>
								<div class="slide">
									<div class="testi-image">
										<a href="#"><img src="images/testimonials/1.jpg" alt="Customer Testimonails"></a>
									</div>
									<div class="testi-content">
										<p>Tenemos la suerte de trabajar con DEBORAH SOSA desde sus comienzos, gracias al servicio prestado, hemos notado una baja en los tiempos de los negocios que llevamos adelante y redunda en mayor rentabilidad.</p>
										<div class="testi-meta">
											Estudio Mesch
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				

				<div class="section">
					<div class="container clearfix">

						<div class="heading-block topmargin-sm center">
							<h3>Nuestros agentes</h3>
							<p>Si querés formar parte de nuestro equipo, <a href="contacto.php?opcion=cv">dejanos un mensaje</a> y agendamos una entrevista.</p>
						</div>

						<div class="row">
						
							<div class="col-lg-3 col-md-6 bottommargin">

								<div class="team">
									<div class="team-image">
										<img src="images/pers2.png" alt="Deborah Sosa">
									</div>
									<div class="team-desc team-desc-bg">
										<div class="team-title"><h4>Deborah Sosa</h4><span>CEO</span></div>
										<a href="mailto:info@deborahsosa.com.ar" class="social-icon inline-block si-small si-light si-rounded si-gplus">
											<i class="icon-mail"></i>
											<i class="icon-mail"></i>
										</a>
									</div>
								</div>

							</div>

							<div class="col-lg-3 col-md-6 bottommargin">

								<div class="team">
									<div class="team-image">
										<img src="images/pers1.png" alt="Juan Florez">
									</div>
									<div class="team-desc team-desc-bg">
										<div class="team-title"><h4>Juan I. Florez</h4><span>Co-Founder</span></div>
										<a href="mailto:juan@deborahsosa.com.ar" class="social-icon inline-block si-small si-light si-rounded si-gplus">
											<i class="icon-mail"></i>
											<i class="icon-mail"></i>
										</a>
									</div>
								</div>

							</div>

							<div class="col-lg-3 col-md-6 bottommargin">

								<div class="team">
									<div class="team-image">
										<img src="images/pers4.png" alt="Fabiola Garcia">
									</div>
									<div class="team-desc team-desc-bg">
										<div class="team-title"><h4>Fabiola García</h4><span>Gerente Gral</span></div>
										<a href="mailto:info@deborahsosa.com.ar" class="social-icon inline-block si-small si-light si-rounded si-gplus">
											<i class="icon-mail"></i>
											<i class="icon-mail"></i>
										</a>
									</div>
								</div>

							</div>

							<div class="col-lg-3 col-md-6 bottommargin">

								<div class="team">
									<div class="team-image">
										<img src="images/pers5.png" alt="Jazmin Cabrera Agostino">
									</div>
									<div class="team-desc team-desc-bg">
										<div class="team-title"><h4>Jazmín Agostino</h4><span>Back office</span></div>
										<a href="mailto:jazmin@deborahsosa.com.ar" class="social-icon inline-block si-small si-light si-rounded si-gplus">
											<i class="icon-mail"></i>
											<i class="icon-mail"></i>
										</a>
									</div>
								</div>

							</div>

						</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12 col-md-12" align="center">
								<button class="button button-3d button-rounded m-0" onclick="document.location.href='cv.php'">Trabajá con nosotros</button>
							</div>
						</div>
					</div>
				</div>

				<div class="container clearfix">
				
					<div class="heading-block topmargin-sm center">
						<h3>Algunos de nuestros clientes</h3>
					</div>

					<div id="oc-clients" class="owl-carousel image-carousel carousel-widget" data-margin="60" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">

						<div class="oc-item"><a href="#"><img src="images/clients/1.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="images/clients/2.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="images/clients/3.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="images/clients/4.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="images/clients/5.png" alt="Clients"></a></div>
						<div class="oc-item"><a href="#"><img src="images/clients/6.png" alt="Clients"></a></div>
					</div>

					<div class="row">
						<div class="col-lg-12 col-md-12" align="center">
							&nbsp;<br><br>
						</div>
					</div>
				</div>


		</section>
		<!-- #content end -->
		

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
    <!--CONTROLADORES DE ANGULAR-->
	<script src="js/tokko/tokko.js"></script>
	<script src="js/tokko/tokkoIndex.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<a href="https://api.whatsapp.com/send?phone=541139163404" class="float" target="_blank">
	<i class="fa fa-whatsapp my-float"></i>
	</a>
	<!-- Range Slider Plugin -->
	<script src="js/components/rangeslider.min.js"></script>
	<!-- Bootstrap Select Plugin -->
	<script src="js/components/bs-select.js"></script>

	<!-- Bootstrap Switch Plugin -->
	<script src="js/components/bs-switches.js"></script>

	<script>

		jQuery(document).ready(function(){

			$(".price-range-slider").ionRangeSlider({
				type: "double",
				prefix: "$",
				min: 200,
				max: 10000,
				max_postfix: "+"
			});

			$(".area-range-slider").ionRangeSlider({
				type: "double",
				min: 50,
				max: 20000,
				from: 50,
				to: 20000,
				postfix: " sqm.",
				max_postfix: "+"
			});

			jQuery(".bt-switch").bootstrapSwitch();

		});

	</script>
</body>
</html>