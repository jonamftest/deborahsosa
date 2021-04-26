<?php 
session_start(); 
if(empty($_SESSION['user']))
{
	header("Location: index.php");
	die("Redirecting to index.php"); 
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

    <!-- DataTables CSS -->
    <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }
	</style>
	
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
                    <h1 class="page-header">Publicaciones</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
				<p>
				<a href="#" onclick="alert('en desarrollo');"><img src="img/import.png" width="24" height="25" border="0" alt="Importar desde CRM" title="Importar desde CRM"></a>&nbsp;
				<a href="#" onclick="$('#example2').tableExport({type:'excel',escape:'false'});"><img src="img/xls.png" width="24" height="25" border="0" alt="Exportar" title="Exportar"></a>
				</p>
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                    <table id="dataTables-example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
		              <thead>
		                <tr>
		                  <th>ID</th>
						  <th>Titulo</th>
						  <th>Operación</th>
						  <th>Publicación</th>
						  <th>Destacada</th>
						  <th>Nuevo Ingreso</th>
						  <th>Precio</th>
						  <th>Localidad</th>
						  <th>Provincia</th>
						  <th>Activa</th>
						  <th>Opciones</th>
		                </tr>
		              </thead>
		             <tbody>
		              <?php 
						include 'database.php';
						$pdo = Database::connect();
						$sql = " SELECT p.`id`, p.`titulo`, top.`tipo`, tp.tipo, p.`destacada`, p.`nuevo_ingreso`, p.`precio`, p.`localidad`, pr.`provincia`, p.`activa` FROM `publicaciones` p inner join tipos_operacion top on top.id = p.`id_tipo_operacion` inner join tipos_publicacion tp on tp.id = p.`id_tipo_publicacion` inner join provincias pr on pr.id = p.id_provincia WHERE 1 ";
					   
						foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row[0] . '</td>';
								echo '<td>'. $row[1] . '</td>';
								echo '<td>'. $row[2] . '</td>';
								echo '<td>'. $row[3] . '</td>';
								if ($row[4] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
								if ($row[5] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
								echo '<td>u$s'. number_format($row[6],2) . '</td>';
								echo '<td>'. $row[7] . '</td>';
								echo '<td>'. $row[8] . '</td>';
								if ($row[9] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
							   	echo '<td>';
								echo '<a href="marcarDestacada.php?id='.$row[0].'"><img src="img/icon_ejecutar.png" width="24" height="25" border="0" alt="Destacada" title="Destacada"></a>';
								echo '&nbsp;';
							   	echo '<a href="modificarPublicacion.php?id='.$row[0].'"><img src="img/icon_modificar.png" width="24" height="25" border="0" alt="Información Básica" title="Información Básica"></a>';
								echo '&nbsp;';
							   	echo '<a href="caracteristicasPublicacion.php?id='.$row[0].'"><img src="img/venc.jpg" width="24" height="25" border="0" alt="Caracteristicas" title="Caracteristicas"></a>';
								echo '&nbsp;';
							   	echo '<a href="imagenesPublicacion.php?id='.$row[0].'"><img src="img/eye.png" width="24" height="25" border="0" alt="Imagenes" title="Imagenes"></a>';
								echo '&nbsp;';
							   	echo '<a href="consultasPublicacion.php?id='.$row[0].'"><img src="img/search.png" width="24" height="25" border="0" alt="Consultas" title="Consultas"></a>';
								echo '&nbsp;';
							   	echo '</td>';
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
						  <th>Titulo</th>
						  <th>Operación</th>
						  <th>Publicación</th>
						  <th>Destacada</th>
						  <th>Nuevo Ingreso</th>
						  <th>Precio</th>
						  <th>Localidad</th>
						  <th>Provincia</th>
						  <th>Activa</th>
		                </tr>
		              </thead>
		             <tbody>
		              <?php 
						$pdo = Database::connect();
						$sql = " SELECT p.`id`, p.`titulo`, top.`tipo`, tp.tipo, p.`destacada`, p.`nuevo_ingreso`, p.`precio`, p.`localidad`, pr.`provincia`, p.`activa` FROM `publicaciones` p inner join tipos_operacion top on top.id = p.`id_tipo_operacion` inner join tipos_publicacion tp on tp.id = p.`id_tipo_publicacion` inner join provincias pr on pr.id = p.id_provincia WHERE 1 ";
					   
						foreach ($pdo->query($sql) as $row) {
						   		echo '<tr>';
						   		echo '<td>'. $row[0] . '</td>';
								echo '<td>'. $row[1] . '</td>';
								echo '<td>'. $row[2] . '</td>';
								echo '<td>'. $row[3] . '</td>';
								if ($row[4] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
								if ($row[5] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
								echo '<td>u$s'. number_format($row[6],2) . '</td>';
								echo '<td>'. $row[7] . '</td>';
								echo '<td>'. $row[8] . '</td>';
								if ($row[9] == 1) {
									echo '<td>Si</td>';
								} else {
									echo '<td>No</td>';
								}
							   	echo '</tr>';
					   }
					   Database::disconnect();
					  ?>
				      </tbody>
					</table>
				</div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
	<script src="../vendor/bootstrap/js/tableExport.js"></script>
	<script src="../vendor/bootstrap/js/jquery.base64.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
			stateSave: true,
            responsive: true
        });
    });
	
    </script>

</body>

</html>
