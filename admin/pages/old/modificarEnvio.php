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
		header("Location: envios.php");
	}
	
	if ( !empty($_POST)) {
		
		// insert data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "update `envios` set `tipo`=?, `desde`=?, `hasta`=?, `es_fijo`=?, `valor`=? where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['tipo'],$_POST['desde'],$_POST['hasta'],$_POST['es_fijo'],$_POST['valor'],$id));
		
		Database::disconnect();
		
		header("Location: envios.php");
	
	} else {
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT `id`, `tipo`, `desde`, `hasta`, `es_fijo`, valor FROM `envios` WHERE  `id` = ? ";
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

    <title>MINI - Sistema Remarcador de Precios</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"></head>

<body>

	<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Men?? Principal</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="secret.php">MINI - Sistema Remarcador de Precios</a>
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
                    <h1 class="page-header">Modificar Tipo de Env??o</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form class="form-horizontal" action="modificarEnvio.php?id=<?php echo $id?>" method="post">
										<div class="form-group">
                                            <label>Tipo</label>
											<input name="tipo" type="text" maxlength="99" class="form-control" value="<?php echo $data['tipo']; ?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Desde</label>
											<input name="desde" type="number" step="0.01" maxlength="99" class="form-control" value="<?php echo $data['desde']; ?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Hasta</label>
											<input name="hasta" type="number" step="0.01" maxlength="99" class="form-control" value="<?php echo $data['hasta']; ?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Tipo Monto</label>
											<div class="controls">
											<select name="es_fijo" id="es_fijo" class="form-control" required="required">
											<option value="">Seleccione...</option>
											<option value="1" <?php if ($data['es_fijo']==1) echo " selected ";?>>Fijo</option>
											<option value="0" <?php if ($data['es_fijo']==0) echo " selected ";?>>Porcentaje</option>
											</select>
											</div>
										</div>
										<div class="form-group">
                                            <label>Valor</label>
											<input name="valor" type="number" step="0.01" maxlength="99" class="form-control" value="<?php echo $data['valor']; ?>" required="required">
										</div>
                                        <button type="submit" class="btn btn-default">Modificar</button>
                                    </form>
									<br><br>
									<button onclick="document.location.href='envios.php'" class="btn btn-default">Volver</button>
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
</html>