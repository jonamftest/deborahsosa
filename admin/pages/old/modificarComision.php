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
		header("Location: comisiones.php");
	}
	
	if ( !empty($_POST)) {
		
		// insert data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "delete from comisiones_categorias where id_comision = ? ";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		$sql = "delete from comisiones_tipos_publicacion where id_comision = ? ";
		$q = $pdo->prepare($sql);
		$q->execute(array($id));
		
		$sql = "update `comisiones` set `comision`=?, `valor`=?, `es_fijo`=? where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['comision'],$_POST['valor'],$_POST['es_fijo'],$id));
		
		foreach($_POST['id_categoria'] as $item) {
			$sql = "INSERT INTO `comisiones_categorias`(`id_comision`,`id_categoria`) VALUES (?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($id,$item));
		}
		
		foreach($_POST['id_tipo_publicacion'] as $item) {
			$sql = "INSERT INTO `comisiones_tipos_publicacion`(`id_comision`,`id_tipo_publicacion`) VALUES (?,?)";
			$q = $pdo->prepare($sql);
			$q->execute(array($id,$item));
		}
		
		Database::disconnect();
		
		header("Location: comisiones.php");
	
	} else {
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT `id`, `comision`, `valor`, `es_fijo` FROM `comisiones` WHERE `id` = ? ";
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
                    <h1 class="page-header">Modificar Comisi??n</h1>
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
                                    <form class="form-horizontal" action="modificarComision.php?id=<?php echo $id?>" method="post">
										<div class="form-group">
                                            <label>Comisi??n</label>
											<input name="comision" type="text" maxlength="99" class="form-control" value="<?php echo $data['comision']; ?>"" required="required">
										</div>
										<div class="form-group">
                                            <label>Categor??a</label>
											<div class="controls">
											<select name="id_categoria[]" id="id_categoria" class="form-control" multiple>
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT id, categoria from categorias order by categoria ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												$sql2 = " SELECT id from comisiones_categorias where id_comision = ? and id_categoria = ? ";
												$q2 = $pdo->prepare($sql2);
												$q2->execute(array($id, $fila['id']));
												$data2 = $q2->fetch(PDO::FETCH_ASSOC);
												if (!empty($data2)) {
													echo " selected ";	
												}
												echo ">".$fila['categoria']."</option>";
											}
											Database::disconnect();
											?>
											</select>
											</div>
										</div>
										<div class="form-group">
                                            <label>Tipo de Publicaci??n</label>
											<div class="controls">
											<select name="id_tipo_publicacion[]" id="id_tipo_publicacion" class="form-control" multiple>
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT id, tipo from tipos_publicacion order by tipo ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												$sql2 = " SELECT id from comisiones_tipos_publicacion where id_comision = ? and id_tipo_publicacion = ? ";
												$q2 = $pdo->prepare($sql2);
												$q2->execute(array($id, $fila['id']));
												$data2 = $q2->fetch(PDO::FETCH_ASSOC);
												if (!empty($data2)) {
													echo " selected ";	
												}
												echo ">".$fila['tipo']."</option>";
											}
											Database::disconnect();
											?>
											</select>
											</div>
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
									<button onclick="document.location.href='comisiones.php'" class="btn btn-default">Volver</button>
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