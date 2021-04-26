<?php
    require("admin/pages/config.php");
	require("admin/pages/database.php");
?>
<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<?php include("head.php"); ?>
</head>

<body class="stretched side-push-panel">

	
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
		<section id="page-title" class="page-title-pattern5">
			<?php
				$pdo = Database::connect();
				$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				
				$sql = "SELECT p.`id`, p.`titulo`, p.`detalle`, p.`coordenadas`, p.`id_tipo_operacion`, ope.tipo opetipo, p.`id_tipo_publicacion`, pub.tipo pubtipo, p.`apto_credito`, p.`superficie_cubierta`, p.`superficie_total`, p.`cant_habitaciones`, p.`cant_banios`, p.`precio`, p.`barrio`, p.`localidad`, p.`id_provincia`, pr.provincia, p.precio_reserva FROM `publicaciones` p INNER JOIN tipos_operacion ope on ope.id = p.`id_tipo_operacion` INNER JOIN tipos_publicacion pub on pub.id = p.`id_tipo_publicacion` INNER JOIN provincias pr on pr.id = p.`id_provincia` WHERE p.`id` = ? ";
				$q = $pdo->prepare($sql);
				$q->execute(array($_GET['id']));
				$data = $q->fetch(PDO::FETCH_ASSOC);
				
				// SDK de Mercado Pago
				require __DIR__ .  '/vendor/autoload.php';

				// Agrega credenciales
				MercadoPago\SDK::setAccessToken('APP_USR-7166052555544855-010616-3bb6dfca66ef83d5dcf9323feddcfba2-17615168'); //CAMBIAR!!!

				// Crea un objeto de preferencia
				$preference = new MercadoPago\Preference();

				// Crea un ítem en la preferencia
				$item = new MercadoPago\Item();
				$item->title = 'Pago de reserva a Deborah Sosa';
				$item->quantity = 1;
				$item->unit_price = $data['precio_reserva'];
				$preference->items = array($item);
				$preference->save();
				
				?>
			<div class="container clearfix">
				<h1><font color="white"><?php echo $data['titulo'];?></font></h1>
				<br>
				<div class="d-flex flex-shrink-1" data-lightbox="gallery">
					<a href="demos/real-estate/images/hero/4.jpg" class="button button-color button-rounded nott m-0 font-weight-medium align-self-end" data-lightbox="gallery-item"><i class="icon-picture"></i> Ver galería</a>
					<a href="demos/real-estate/images/hero/2.jpg" class="d-none" data-lightbox="gallery-item"></a>
					<a href="demos/real-estate/images/hero/3.jpg" class="d-none" data-lightbox="gallery-item"></a>
				</div>
			</div>

		</section>
		<section id="content">
			<div class="section mt-0" style="padding: 30px 0">
					<div class="container clearfix">
						<div class="row">
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-plan2 i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1"><?php echo $data['superficie_cubierta'];?>mt2</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-door i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1"><?php echo $data['cant_habitaciones'];?></h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-bathtub i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1"><?php echo $data['cant_banios'];?></h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-garage2 i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">Si</h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-bed i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1"><?php echo $data['cant_habitaciones'];?></h5>
							</div>
							<div class="col-md-2 col-6 center">
								<i class="icon-realestate-swimming-pool i-plain i-xlarge mx-auto mb-0"></i>
								<h5 class="my-1">Si</h5>
							</div>
						</div>
					</div>
				</div>
			<div class="content-wrap pt-0">
				
				

				<div class="container clearfix">

					<div class="row gutter-40 col-mb-80">
						<div class="postcontent col-lg-9">
							<p><?php echo $data['detalle'];?></p>

							<h4 class="mb-0 topmargin">Características</h4>
							<div class="line line-sm mt-1 mb-3"></div>
							<div class="row clearfix">
								<div class="col-md-4">
									<ul class="iconlist">
										<li class="mb-1"><i class="icon-line2-check"></i>Operación: <?php echo $data['opetipo'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Publicación: <?php echo $data['pubtipo'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Apto Crédito: <?php if ($data['apto_credito']==1) echo "Si"; else echo "No";?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Superficie Cubierta: <?php echo $data['superficie_cubierta'];?>mt2</li>
									</ul>
								</div>
								<div class="col-md-4">
									<ul class="iconlist">
										<li class="mb-1"><i class="icon-line2-check"></i>Superficie Total: <?php echo $data['superficie_total'];?>mt2</li>
										<li class="mb-1"><i class="icon-line2-check"></i>Cantidad Habitaciones: <?php echo $data['cant_habitaciones'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Cantidad Baños: <?php echo $data['cant_banios'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Precio: u$<?php echo number_format($data['precio'],0);?></li>
									</ul>
								</div>
								<div class="col-md-4">
									<ul class="iconlist">
										<li class="mb-1"><i class="icon-line2-check"></i>Barrio: <?php echo $data['barrio'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Localidad: <?php echo $data['localidad'];?></li>
										<li class="mb-1"><i class="icon-line2-check"></i>Provincia: <?php echo $data['provincia'];?></li>
									</ul>
								</div>
							</div>

							<h4 class="mb-0 mt-3">Amenities</h4>
							<div class="line line-sm mt-1 mb-3"></div>
							<div class="row clearfix">
								<div class="col-md-12">
									<ul class="iconlist">
										<?php 
										$sql2 = " SELECT c.`id`, c.caracteristica,cp.comentario FROM `caracteristicas_publicaciones` cp inner join caracteristicas c on c.id = cp.id_caracteristica WHERE cp.`id_publicacion` = ".$data['id'];
										$q2 = $pdo->prepare($sql2);
										$q2->execute();
										while ($fila2 = $q2->fetch(PDO::FETCH_ASSOC)) {
										?>
										<li class="mb-1"><i class="icon-realestate-realtor"></i><?php echo $fila2['caracteristica'];?>: <?php echo $fila2['comentario'];?></li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
							<div class="line"></div>
							<script
							  src="https://www.mercadopago.com.ar/integrations/v1/web-payment-checkout.js"
							  data-preference-id="<?php echo $preference->id; ?>" data-button-label="Reservar">
							</script>

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

									<div class="widget clearfix">
										<h4>Mapa</h4>
										<iframe src="https://www.google.com/maps?q=<?php echo $data['coordenadas'];?>&#038;z=14&#038;t=&#038;ie=UTF8&#038;output=embed" width="500" height="500"></iframe>
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

	<!-- JavaScripts
	============================================= -->
	<script src="js/jquery.js"></script>
	<script src="js/plugins.min.js"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="js/functions.js"></script>

</body>
</html>