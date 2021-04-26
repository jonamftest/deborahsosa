<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");



?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US" ng-app="tokkoDevelopment">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched side-push-panel" ng-controller="tokkoDevController">

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">
	
		<!-- Header
		============================================= -->
		<header id="header" class="full-header transparent-header" data-sticky-class="not-dark">
			<?php include("header.php"); ?>
		</header>
		<section id="page-title" class="page-title-pattern4">

			<div class="container clearfix">
				<h1><font color="white">Oportunidades</font></h1>
				<span><font color="white">Encontrá el lugar de tus sueños</font></span>
			</div>

		</section>
		<!-- Content
		============================================= -->
		<section id="content" ng-init="iniciarTokkoDev()">
			<div class="content-wrap pt-0">

				<div class="section bg-transparent m-0 clearfix">
					<div class="container clearfix">
						<div class="row justify-content-between">
							<div class="col-12 text-right">
								<!--<div class="btn-group">
									<div class="dropdown">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tipo Operación</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2" id="tipoOperacion">

										<button onclick="document.location.href='buscador.php?tipo_operacion='" class="dropdown-item" type="button">Todas</button>
										<button onclick="document.location.href='buscador.php?tipo_operacion=1'" class="dropdown-item" type="button">Comprar</button>
										<button onclick="document.location.href='buscador.php?tipo_operacion=2'" class="dropdown-item" type="button">Alquiler</button>
							  			<button onclick="document.location.href='buscador.php?tipo_operacion=3'" class="dropdown-item" type="button">Alquiler temporario</button>
							  			<button onclick="document.location.href='buscador.php?tipo_operacion='" class="dropdown-item" type="button">Emprendimientos</button>

										</div>
									</div>&nbsp;
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tipo Propiedad</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu3" ng-repeat='tipoProp in tipoPropiedades'>

										<div ng-repeat='tipoProp in tipoPropiedades'>
											<div ng-if="tipoProp.name == 'Casa' || tipoProp.name == 'Local' || tipoProp.name == 'Departamento' || tipoProp.name == 'PH' || tipoProp.name == 'Terreno' || tipoProp.name == 'Oficina'">
												<a href="buscador.php?propiedades={{tipoProp.id}}" class="dropdown-item" type="button">{{tipoProp.name}}</a>
											</div>
										</div>	
										</div>
									</div>
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ambientes</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											<button onclick="document.location.href='buscador.php?ambientes=1'" class="dropdown-item" type="button">1</button>
											<button onclick="document.location.href='buscador.php?ambientes=2'" class="dropdown-item" type="button">2</button>
											<button onclick="document.location.href='buscador.php?ambientes=3'" class="dropdown-item" type="button">3</button>
											<button onclick="document.location.href='buscador.php?ambientes=4'" class="dropdown-item" type="button">4</button>
											<button onclick="document.location.href='buscador.php?ambientes=5'" class="dropdown-item" type="button">5+</button>
										</div>
									</div>
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Apto Crédito</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											<button onclick="document.location.href='buscador.php?apto_credito=1'" class="dropdown-item" type="button">Si</button>
											<button onclick="document.location.href='buscador.php?apto_credito=0'" class="dropdown-item" type="button">No</button>
										</div>
									</div>
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Provincia</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
										<div ng-repeat='prov in provinciasFiltros'>
											<a href="buscador.php?provincia={{prov.id}}" class="dropdown-item" type="button">{{prov.name}}</a>
										</div>
										</div>
									</div>
								</div>-->
								
							</div>
						</div>
						<div ng-if="emprendim=='buscando'">
							{{infoEstadoBusqueda}}
						</div>
						<div ng-if="emprendim==''">
							{{infoEstadoBusqueda}}
						</div>
						<div ng-if="emprendim !=''">
							
						<div class="real-estate mt-5 row portfolio gutter-20 col-mb-50" data-layout="fitRows">
							<div class="real-estate-item portfolio-item col-12 col-md-6 col-lg-4" ng-repeat="emp in emprendim">
								<div class="real-estate-item-image">
									<div class="label badge badge-danger bg-color2">
										emprendimientos
									</div>
									<div ng-if="emp.photos ==''">
										<a href="emprendimiento_detalle.php?id={{emp.id}}">
									 	<img src="images\dev.png">
									</a>
									</div>
									<div ng-if="emp.photos != ''">
										<a href="emprendimiento_detalle.php?id={{emp.id}}">
									 	<img src="{{emp.photos[0].image}}">
									</div>
									<div class="real-estate-item-price" lang="es">
										{{prop.operations[0].prices[0].currency}}  {{prop.operations[0].prices[0].price | currency: '': '0.0'}}<span>{{prop.type.name}}</span>
									</div>
								</div>

								<div class="real-estate-item-desc p-0">
									<h3><a href="emprendimiento_detalle.php?id={{emp.id}}">{{emp.name}}</a></h3>
									<span>{{emp.location.full_location}}</span>

									<a href="emprendimiento_detalle.php?id={{emp.id}}" class="real-estate-item-link"><i class="icon-eye"></i></a>

									<div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

									<div class="real-estate-item-features row font-weight-medium font-primary px-3 clearfix">
										<div class="col-12 p-0">Tipo de desarrollo: {{emp.type.name}}<span class="color"></span></div>
										<!--<div class="col-lg-6 col-6 p-0">Cant. Baños: <span class="color">{{prop.bathroom_amount}}</span></div>-->
										<br>
										<div class="col-12 p-0">
											Fecha de entrega: {{emp.construction_date | date: 'dd/MM/yyyy'}}
										</div>
										
										<br>
										
										<!--<div class="col-lg-6 col-6 p-0">Apto Crédito: <span class="text-success"><i class="icon-check-sign"></i></span></div>
										
										<div class="col-lg-6 col-6 p-0">Apto Crédito: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>-->

									</div>
								</div>
							</div>
							
						</div>
					
					</div>
					</div>
				</div>
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

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>
	<!--LIBRERÍA ANGULAR-->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.8.2/angular.min.js"></script>
    	<script src="js/tokko/angular-route.min.js"></script>
	<script src="js/tokko/tokkoDevelopment.js"></script>

	<!-- Bootstrap Select Plugin -->
	<script src="js/components/bs-select.js"></script>

	<!-- Bootstrap Switch Plugin -->
	<script src="js/components/bs-switches.js"></script>

	<!-- Range Slider Plugin -->
	<script src="js/components/rangeslider.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

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

			jQuery('.more-search').click(function(){
				jQuery('.expand-link').slideToggle(400);
			});

		});


	</script>

</body>
</html>