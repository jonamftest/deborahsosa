<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" ng-app="tokkoDevDetails">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched side-push-panel" ng-controller="tokkoDevDetailsControllers">

	<!-- CAMPO PARA ALMACENAR ID PROPIEDAD -->
	<input type="hidden" name="id_emprendimiento" id="id_emprendimiento" value="<?php echo $_GET['id']; ?>">
	
	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Top Bar
		============================================= -->

		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header><!-- #header end -->

		<!-- Content
		============================================= -->

		<!-- INICIO DIV CONTENEDOR DE INIT
		============================================= -->
		<div ng-init="iniciarTokkoDevDetails()" ng-cloak >
		<section id="page-title" class="page-title-pattern5">
			<?php
				

				//$precios = $_GET['price'];
				
				// SDK de Mercado Pago
				/*require __DIR__ .  '/vendor/autoload.php';

				// Agrega credenciales
				MercadoPago\SDK::setAccessToken('APP_USR-7166052555544855-010616-3bb6dfca66ef83d5dcf9323feddcfba2-17615168'); //CAMBIAR!!!

				// Crea un objeto de preferencia
				$preference = new MercadoPago\Preference();

				// Crea un ítem en la preferencia
				$item = new MercadoPago\Item();
				$item->title = 'Pago de reserva a Deborah Sosa';
				$item->quantity = 1;
				$item->unit_price = $precios;
				$preference->items = array($item);
				$preference->save();*/
				
				?>
			<div class="container clearfix">
				<h1><font color="white">{{emprendimiento.name}}</font></h1>
				<br>
				

				<div class="d-flex flex-shrink-1" data-lightbox="gallery">
					<a href="{{emprendimiento.photos[0].image}}" class="button button-color button-rounded nott m-0 font-weight-medium align-self-end" data-lightbox="gallery-item"><i class="icon-picture"></i> Ver galería</a>
					<div ng-repeat="fotos in emprendimiento.photos">
						<div ng-if='fotos.image != emprendimiento.photos[0].image'>
							<a href="{{fotos.image}}" class="d-none" data-lightbox="gallery-item"></a>
						</div>
					</div>


				</div>

				<!--<div class="d-flex flex-shrink-1" data-lightbox="gallery" ng-repeat="fotos in propiedades.photos">
					
					<a href="demos/real-estate/images/hero/2.jpg" class="d-none" data-lightbox="gallery-item"></a>
					<a href="demos/real-estate/images/hero/3.jpg" class="d-none" data-lightbox="gallery-item"></a>


				</div>-->

			</div>

		</section>
		<section id="content">
			<!--<div class="section mt-0" style="padding: 30px 0">
					<div class="container clearfix">
						<div class="row">
							<div class="col-md-2 col-6 center">

								<i class="icon-realestate-plan2 i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">{{propiedades.roofed_surface}} mt2</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-door i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">{{propiedades.room_amount}}</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-bathtub i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">{{propiedades.bathroom_amount}}</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-garage2 i-plain i-xlarge mx-auto mb-0"></i>

								<h5 class="my-1" ng-if="propiedades.parking_lot_amount == 0">No</h5>
								<h5 class="my-1" ng-if="propiedades.parking_lot_amount > 0">{{propiedades.parking_lot_amount}}</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-bed i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">{{propiedades.room_amount}}</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-swimming-pool i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">Si</h5>
							</div>
						</div>
					</div>
				</div>-->
			<div class="content-wrap pt-1">
				
				

				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<div class="postcontent col-lg-9">
							<h4 class="mb-0 topmargin">Descripción</h4>
							<div class="line line-sm mt-1 mb-3"></div>
							<p id="detalle"></p>

							<h4 class="mb-0 topmargin">Características</h4>
							<div class="line line-sm mt-1 mb-3"></div>
							<div class="row clearfix">
								<div class="col-12">
									<ul class="iconlist">
										<li class="mb-1"><i class="icon-line2-check"></i>Publicación: Emprendimiento</li>
										<li class="mb-1"><i class="icon-line2-check"></i>Ubicacion:  {{emprendimiento.location.full_location}}</li>
									</ul>
								</div>
							</div>

							<h4 class="mb-0 mt-3">Servicios</h4>
							<div class="line line-sm mt-1 mb-3"></div>
							<div class="row clearfix">
								<div class="col-md-12">
									<ul class="iconlist m-0" ng-repeat='amenities in emprendimiento.tags'>
										<li class="mb-0"><i class="icon-line2-check"></i>{{amenities.name}}</li>
									</ul>
								</div>
							</div>
							<div class="line"></div>
							<!--<script
							  src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
							  data-preference-id="<?php //echo $preference->id; ?>" 
							  data-button-label="Reservar">
							</script>-->

						</div>

						<div class="sidebar sticky-sidebar-wrap col-lg-3">
							<div class="sidebar-widgets-wrap">
								<div class="sticky-sidebar">

									<div class="widget clearfix">

										<div class="card bg-light">
											<div class="card-header">Consultanos</div>
											<div class="card-body">
												<form name="form1" action="enviarForm.php" method="post" class="mb-0">
													<input type="text" required class="required sm-form-control input-block-level" id="" name="nombre" value="" placeholder="Nombre" /><br>
													<input type="text" required class="required sm-form-control email input-block-level" id="" name="email" value="" placeholder="E-mail" /><br>
													<input type="number" required class="required sm-form-control number input-block-level" id="" name="telefono" value="" placeholder="Teléfono" /><br>
													<textarea required class="required sm-form-control input-block-level short-textarea" id="" name="mensaje" rows="4" cols="30" placeholder="Mensaje"></textarea><br>
													<input type="hidden" name="id_publicacion" value="<?php echo $data['id'];?>">
													<input type="submit" class="button  button-rounded btn-block m-0" value="Enviar">
												</form>
											</div>
										</div>

									</div>

									<div class="widget clearfix" id="mapas">
										<h4>Mapa</h4>
										
									</div>

								</div>
							</div>
						</div>
					</div>

				</div>

				<div class="clear topmargin"></div>
			</div><!-- .content-wrap end -->
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

	<!-- FIN DIV CONTENEDOR DE INIT
	============================================= -->
	</div>

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!--LIBRERÍA ANGULAR-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    	<script src="js/tokko/angular-route.min.js"></script>
	<script src="js/tokko/tokkoDevDetails.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>