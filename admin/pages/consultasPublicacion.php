<?php
    require("config.php");
    if(empty($_SESSION['user']))
    {
        header("Location: index.php");
        die("Redirecting to index.php"); 
    }
	
	require 'database.php';

	$id = null;
	if ( !empty($_GET['id'])) {
		$id = $_REQUEST['id'];
	}
	
	if ( null==$id ) {
		header("Location: publicaciones.php");
	}
	
	if ( !empty($_POST)) {
	
	} else {
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT `id`, `titulo`, `detalle`, `id_tipo_operacion`, `id_tipo_publicacion`, `apto_credito`, `destacada`, `nuevo_ingreso`, `superficie_cubierta`, `superficie_total`, `cant_habitaciones`, `cant_banios`, `precio`, `direccion`, `barrio`, `localidad`, `id_provincia`, `coordenadas`, `fecha_alta`, `activa` FROM `publicaciones` WHERE `id` = ? ";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		$data = $q->fetch(PDO::FETCH_ASSOC);
		
		Database::disconnect();
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DeborahSosa - Panel de Adminitración</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    
</head>

<body>

	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Menú Principal</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="secret.php">DeborahSosa - Panel de Adminitración</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <?php include("menu.php");?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Consultas Publicación</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <p>
								<a href="#" onclick="$('#example2').tableExport({type:'excel',escape:'false'});"><img src="img/xls.png" width="24" height="25" border="0" alt="Exportar" title="Exportar"></a>
								</p>
								<div class="col-lg-6">
                                    <form class="form-horizontal" action="#" method="post">
										<div class="form-group">
											<table id="dataTables-example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
											  <thead>
												<tr>
												  <th>ID</th>
												  <th>Fecha/Hora</th>
												  <th>Nombre</th>
												  <th>E-Mail</th>
												  <th>Teléfono</th>
												  <th>Mensaje</th>
												</tr>
											  </thead>
											 <tbody>
											  <?php 
												$pdo = Database::connect();
												$sql = " SELECT `id`, date_format(`fecha_hora`,'%d/%m/%Y H%:%i'), `nombre`, `email`, `telefono`, `mensaje` FROM `consultas_publicaciones` WHERE id_publicacion = ".$id;
											   
												foreach ($pdo->query($sql) as $row) {
													echo '<tr>';
													echo '<td>'. $row[0] . '</td>';
													echo '<td>'. $row[1] . 'hs</td>';
													echo '<td>'. $row[2] . '</td>';
													echo '<td>'. $row[3] . '</td>';
													echo '<td>'. $row[4] . '</td>';
													echo '<td>'. $row[5] . '</td>';
													echo '</tr>';
											   }
											   Database::disconnect();
											  ?>
											  </tbody>
											</table>
											<table id="example2" style="visibility:hidden;">
											<thead>
												<tr>
												  <th>ID</th>
												  <th>Fecha/Hora</th>
												  <th>Nombre</th>
												  <th>E-Mail</th>
												  <th>Teléfono</th>
												  <th>Mensaje</th>
												</tr>
											  </thead>
											 <tbody>
											  <?php 
												$pdo = Database::connect();
												$sql = " SELECT `id`, date_format(`fecha_hora`,'%d/%m/%Y H%:%i'), `nombre`, `email`, `telefono`, `mensaje` FROM `consultas_publicaciones` WHERE id_publicacion = ".$id;
											   
												foreach ($pdo->query($sql) as $row) {
													echo '<tr>';
													echo '<td>'. $row[0] . '</td>';
													echo '<td>'. $row[1] . 'hs</td>';
													echo '<td>'. $row[2] . '</td>';
													echo '<td>'. $row[3] . '</td>';
													echo '<td>'. $row[4] . '</td>';
													echo '<td>'. $row[5] . '</td>';
													echo '</tr>';
											   }
											   Database::disconnect();
											  ?>
											  </tbody>
											</table>
										</div>
                                    </form>
									<br><br>
									<button onclick="document.location.href='publicaciones.php'" class="btn btn-default">Volver</button>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
  </body>
  
  <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
	 <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../vendor/bootstrap/js/tableExport.js"></script>
	<script src="../vendor/bootstrap/js/jquery.base64.js"></script>
</html>