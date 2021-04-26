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
		<section id="content">
			<div class="content-wrap pt-0">

				<div class="section bg-transparent m-0 clearfix">
					<div class="container clearfix">
						<div class="row justify-content-between">
							<div class="col-12 text-right">
								<div class="btn-group">
									<div class="dropdown">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tipo Operación</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `tipo` FROM `tipos_operacion` WHERE 1";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo '<button onclick="document.location.href=\'buscador.php?tipo_operacion='.$fila['id'].'\'" class="dropdown-item" type="button">'.$fila['tipo'].'</button>';
											}
											Database::disconnect();
											?>
										</div>
									</div>&nbsp;
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tipo Propiedad</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `tipo` FROM `tipos_publicacion` WHERE 1";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo '<button onclick="document.location.href=\'buscador.php?tipo_publicacion='.$fila['id'].'\'" class="dropdown-item" type="button">'.$fila['tipo'].'</button>';
											}
											Database::disconnect();
											?>
										</div>
									</div>&nbsp;
									<div class="dropdown ml-2">
										<button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Ambientes</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu2">
											<button onclick="document.location.href='buscador.php?ambientes=1'" class="dropdown-item" type="button">1</button>
											<button onclick="document.location.href='buscador.php?ambientes=2'" class="dropdown-item" type="button">2</button>
											<button onclick="document.location.href='buscador.php?ambientes=3'" class="dropdown-item" type="button">3</button>
											<button onclick="document.location.href='buscador.php?ambientes=4'" class="dropdown-item" type="button">4</button>
											<button onclick="document.location.href='buscador.php?ambientes=5'" class="dropdown-item" type="button">5+</button>
										</div>
									</div>&nbsp;
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
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `provincia` tipo FROM `provincias` WHERE 1";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo '<button onclick="document.location.href=\'buscador.php?id_provincia='.$fila['id'].'\'" class="dropdown-item" type="button">'.$fila['tipo'].'</button>';
											}
											Database::disconnect();
											?>
										</div>
									</div>
								</div>
								
							</div>
						</div>

						<div class="real-estate mt-5 grid-container row portfolio gutter-20 col-mb-50" data-layout="fitRows">

							<?php 
							$pdo = Database::connect();
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sqlZon = " SELECT p.`id`, p.`titulo`, p.`id_tipo_operacion`, ope.tipo opetipo, p.`id_tipo_publicacion`, pub.tipo pubtipo, p.`apto_credito`, p.`superficie_cubierta`, p.`superficie_total`, p.`cant_habitaciones`, p.`cant_banios`, p.`precio`, p.`barrio`, p.`localidad`, p.`id_provincia`, pr.provincia FROM `publicaciones` p INNER JOIN tipos_operacion ope on ope.id = p.`id_tipo_operacion` INNER JOIN tipos_publicacion pub on pub.id = p.`id_tipo_publicacion` INNER JOIN provincias pr on pr.id = p.`id_provincia` WHERE p.`activa` = 1 ";
							
							if (!empty($_GET['id_provincia'])) {
								$sqlZon .= " and p.`id_provincia` = ".$_GET['id_provincia']." ";
							}
							
							if (!empty($_GET['barrio'])) {
								$sqlZon .= " and p.`barrio` = ".$_GET['barrio']." ";
							}
							
							if (!empty($_GET['localidad'])) {
								$sqlZon .= " and p.`localidad` = ".$_GET['localidad']." ";
							}
							
							if (!empty($_GET['tipo_operacion'])) {
								$sqlZon .= " and p.`id_tipo_operacion` = ".$_GET['tipo_operacion']." ";
							}
							
							if (!empty($_GET['tipo_publicacion'])) {
								$sqlZon .= " and p.`id_tipo_publicacion` = ".$_GET['tipo_publicacion']." ";
							}
							
							if (!empty($_GET['ambientes'])) {
								$sqlZon .= " and p.`cant_habitaciones` = ".$_GET['ambientes']." ";
							}
							
							if (!empty($_GET['apto_credito'])) {
								$sqlZon .= " and p.`apto_credito` = ".$_GET['apto_credito']." ";
							}
							
							if (!empty($_GET['zona'])) {
								$sqlZon .= " and p.`barrio` = ".$_GET['zona']." ";
							}
							
							$sqlZon .= " order by p.`fecha_alta` desc ";
							$q = $pdo->prepare($sqlZon);
							$q->execute();
							while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
							?>
							
							<div class="real-estate-item portfolio-item col-12 col-md-6 col-lg-4">
								<div class="real-estate-item-image">
									<div class="label badge badge-danger bg-color2"><?php echo $fila['opetipo'];?></div>
									<a href="#">
										<?php 
										$sql3 = " SELECT `imagen` FROM `imagenes_publicaciones` WHERE id_publicacion = ".$fila['id']." limit 0,1";
										$q3 = $pdo->prepare($sql3);
										$q3->execute();
										$fila3 = $q3->fetch(PDO::FETCH_ASSOC);
										echo '<img src="admin/pages/publicaciones/'.$fila3['imagen'].'" alt="">';
										?>
									</a>
									<div class="real-estate-item-price">
										u$s<?php echo number_format($fila['precio'],0);?><span><?php echo $fila['pubtipo'];?></span>
									</div>
									<div class="real-estate-item-info clearfix" data-lightbox="gallery">
										<?php 
										$sql2 = " SELECT `imagen` FROM `imagenes_publicaciones` WHERE id_publicacion = ".$fila['id'];
										$q2 = $pdo->prepare($sql2);
										$q2->execute();
										$i = 0;
										while ($fila2 = $q2->fetch(PDO::FETCH_ASSOC)) {
											if ($i == 0) {
												echo '<a href="admin/pages/publicaciones/'.$fila2['imagen'].'" data-toggle="tooltip" title="Galeria" data-lightbox="gallery-item"><i class="icon-line-stack-2"></i></a>';
											} else {
												echo '<a href="admin/pages/publicaciones/'.$fila2['imagen'].'" class="d-none" data-lightbox="gallery-item"></a>';
											}
											$i++;
										}
										?>
										
										
									</div>
								</div>

								<div class="real-estate-item-desc p-0">
									<h3><a href="detalle.php?id=<?php echo $fila['id'];?>"><?php echo $fila['titulo'];?></a></h3>
									<span><?php echo $fila['barrio'];?>, <?php echo $fila['localidad'];?>, <?php echo $fila['provincia'];?></span>

									<a href="detalle.php?id=<?php echo $fila['id'];?>" class="real-estate-item-link"><i class="icon-eye"></i></a>

									<div class="line" style="margin-top: 15px; margin-bottom: 15px;"></div>

									<div class="real-estate-item-features row font-weight-medium font-primary px-3 clearfix">
										<div class="col-lg-6 col-6 p-0">Cant. Habitaciones: <span class="color"><?php echo $fila['cant_habitaciones'];?></span></div>
										<div class="col-lg-6 col-6 p-0">Cant. Baños: <span class="color"><?php echo $fila['cant_banios'];?></span></div>
										<br>
										<div class="col-lg-6 col-6 p-0">Sup. Cubierta: <span class="color"><?php echo $fila['superficie_cubierta'];?> mt2</span></div>
										<div class="col-lg-6 col-6 p-0">Sup. Total: <span class="color"><?php echo $fila['superficie_total'];?> mt2</span></div>
										<br>
										<?php if ($fila['apto_credito']==1) {?>
										<div class="col-lg-6 col-6 p-0">Apto Crédito: <span class="text-success"><i class="icon-check-sign"></i></span></div>
										<?php }else{?>
										<div class="col-lg-6 col-6 p-0">Apto Crédito: <span class="text-danger"><i class="icon-minus-sign-alt"></i></span></div>
										<?php }?>
									</div>
								</div>
							</div>
							
							<?php
							}
							Database::disconnect();
							?>

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