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
		header("Location: formulas.php");
	}
	
	if ( !empty($_POST)) {
		
		// insert data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$sql = "update `formulas` set `nombre`=?, `formula`=?, `activa`=? where id = ?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['nombre'],$_POST['formula'],$_POST['activa'],$id));
		
		Database::disconnect();
		
		header("Location: formulas.php");
	
	} else {
		
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "SELECT `id`, `nombre`, `formula`, activa FROM `formulas` WHERE  `id` = ? ";
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
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<script>
	function jsAgregarImpuesto() {
		document.getElementById("formula").value += "{I"+document.getElementById("impuesto").value+"}";
	}
	
	function jsAgregarEnvio() {
		document.getElementById("formula").value += "{E"+document.getElementById("envio").value+"}";
	}
	
	function jsAgregarComision() {
		document.getElementById("formula").value += "{C"+document.getElementById("comision").value+"}";
	}
	function jsAgregarVariable() {
		document.getElementById("formula").value += document.getElementById("variable").value;
	}
	</script>
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
                    <h1 class="page-header">Modificar Fórmula</h1>
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
                                    <form class="form-horizontal" action="modificarFormula.php?id=<?php echo $id?>" method="post">
										<div class="form-group">
                                            <label>Nombre</label>
											<input name="nombre" type="text" maxlength="99" class="form-control" value="<?php echo $data['nombre']; ?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Fórmula</label>
											<textarea class="form-control" required="required" name="formula" id="formula"><?php echo $data['formula']; ?></textarea>
											<br>
											Agregar Impuesto: 
											<select name="impuesto" id="impuesto">
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT id, nombre from impuestos order by nombre ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												echo ">".$fila['nombre']."</option>";
											}
											Database::disconnect();
											?>
											</select>
											&nbsp;<a href="#" onclick="jsAgregarImpuesto()"><img src="img/icon_ejecutar.png" width="24" height="25" border="0" alt="Agregar" title="Agregar"></a><br>
											Agregar Costo de Envío: 
											<select name="envio" id="envio">
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT id, tipo from envios order by tipo ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												echo ">".$fila['tipo']."</option>";
											}
											Database::disconnect();
											?>
											</select>
											&nbsp;<a href="#" onclick="jsAgregarEnvio()"><img src="img/icon_ejecutar.png" width="24" height="25" border="0" alt="Agregar" title="Agregar"></a><br>
											Agregar Comisión: 
											<select name="comision" id="comision">
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT id, comision from comisiones order by comision ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												echo ">".$fila['comision']."</option>";
											}
											Database::disconnect();
											?>
											</select>
											&nbsp;<a href="#" onclick="jsAgregarComision()"><img src="img/icon_ejecutar.png" width="24" height="25" border="0" alt="Agregar" title="Agregar"></a><br>
											Agregar Variable: 
											<select name="variable" id="variable">
											<option value="{Precio}">Precio</option>
											<option value="{Costo}">Costo</option>
											<option value="{Stock}">Stock</option>
											<option value="{Envio}">Envío</option>
											</select>
											&nbsp;<a href="#" onclick="jsAgregarVariable()"><img src="img/icon_ejecutar.png" width="24" height="25" border="0" alt="Agregar" title="Agregar"></a><br>
										</div>
										<div class="form-group">
                                            <label>Activa</label>
											<div class="controls">
											<select name="activa" id="activa" class="form-control" required="required">
											<option value="">Seleccione...</option>
											<option value="1" <?php if ($data['activa']==1) echo " selected ";?>>Si</option>
											<option value="0" <?php if ($data['activa']==0) echo " selected ";?>>No</option>
											</select>
											</div>
										</div>
										
                                        <button type="submit" class="btn btn-default">Modificar</button>
                                    </form>
									<br><br>
									<button onclick="document.location.href='formulas.php'" class="btn btn-default">Volver</button>
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