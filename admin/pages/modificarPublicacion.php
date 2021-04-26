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
		
		// insert data
		$pdo = Database::connect();
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$coordenadas = $_POST["pac-input-coordenadas"]; 
		$direccion = $_POST["pac-input"];
		
		$sql = "update `publicaciones` set `titulo`=?, `detalle`=?, `id_tipo_operacion`=?, `id_tipo_publicacion`=?, `apto_credito`=?, `nuevo_ingreso`=?, `superficie_cubierta`=?, `superficie_total`=?, `cant_habitaciones`=?, `cant_banios`=?, `precio`=?, `direccion`=?, `barrio`=?, `localidad`=?, `id_provincia`=?, `coordenadas`=?, `activa`=? where id=?";
		$q = $pdo->prepare($sql);
		$q->execute(array($_POST['titulo'],$_POST['detalle'],$_POST['id_tipo_operacion'],$_POST['id_tipo_publicacion'],$_POST['apto_credito'],$_POST['nuevo_ingreso'],$_POST['superficie_cubierta'],$_POST['superficie_total'],$_POST['cant_habitaciones'],$_POST['cant_banios'],$_POST['precio'],$direccion,$_POST['barrio'],$_POST['localidad'],$_POST['id_provincia'],$coordenadas,$_POST['activa'],$id));
				
		Database::disconnect();
		
		header("Location: publicaciones.php");
	
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
<script type="text/javascript">
	  _editor_url = "htmlarea";
	  _editor_lang = "en";
	</script>
	<script type="text/javascript" src="htmlarea/htmlarea.js"></script>
	<script type="text/javascript">
	var editor = null;
	function initEditor() {
	  editor = new HTMLArea("ta");

	  // comment the following two lines to see how customization works
	  editor.generate();
	  return false;

	  var cfg = editor.config; // this is the default configuration
	  cfg.registerButton({
		id        : "my-hilite",
		tooltip   : "Highlight text",
		image     : "ed_custom.gif",
		textMode  : false,
		action    : function(editor) {
					  editor.surroundHTML("<span class=\"hilite\">", "</span>");
					},
		context   : 'table'
	  });

	  cfg.toolbar.push(["linebreak", "my-hilite"]); // add the new button to the toolbar

	  // BEGIN: code that adds a custom button
	  // uncomment it to test
	  var cfg = editor.config; // this is the default configuration
	  /*
	  cfg.registerButton({
		id        : "my-hilite",
		tooltip   : "Highlight text",
		image     : "ed_custom.gif",
		textMode  : false,
		action    : function(editor) {
					  editor.surroundHTML("<span class=\"hilite\">", "</span>");
					}
	  });
	  */

	function clickHandler(editor, buttonId) {
	  switch (buttonId) {
		case "my-toc":
		  editor.insertHTML("<h1>Table Of Contents</h1>");
		  break;
		case "my-date":
		  editor.insertHTML((new Date()).toString());
		  break;
		case "my-bold":
		  editor.execCommand("bold");
		  editor.execCommand("italic");
		  break;
		case "my-hilite":
		  editor.surroundHTML("<span class=\"hilite\">", "</span>");
		  break;
	  }
	};
	cfg.registerButton("my-toc",  "Insert TOC", "ed_custom.gif", false, clickHandler);
	cfg.registerButton("my-date", "Insert date/time", "ed_custom.gif", false, clickHandler);
	cfg.registerButton("my-bold", "Toggle bold/italic", "ed_custom.gif", false, clickHandler);
	cfg.registerButton("my-hilite", "Hilite selection", "ed_custom.gif", false, clickHandler);

	cfg.registerButton("my-sample", "Class: sample", "ed_custom.gif", false,
	  function(editor) {
		if (HTMLArea.is_ie) {
		  editor.insertHTML("<span class=\"sample\">&nbsp;&nbsp;</span>");
		  var r = editor._doc.selection.createRange();
		  r.move("character", -2);
		  r.moveEnd("character", 2);
		  r.select();
		} else { // Gecko/W3C compliant
		  var n = editor._doc.createElement("span");
		  n.className = "sample";
		  editor.insertNodeAtSelection(n);
		  var sel = editor._iframe.contentWindow.getSelection();
		  sel.removeAllRanges();
		  var r = editor._doc.createRange();
		  r.setStart(n, 0);
		  r.setEnd(n, 0);
		  sel.addRange(r);
		}
	  }
	);


	  /*
	  cfg.registerButton("my-hilite", "Highlight text", "ed_custom.gif", false,
		function(editor) {
		  editor.surroundHTML('<span class="hilite">', '</span>');
		}
	  );
	  */
	  cfg.pageStyle = "body { background-color: #efd; } .hilite { background-color: yellow; } "+
					  ".sample { color: green; font-family: monospace; }";
	  cfg.toolbar.push(["linebreak", "my-toc", "my-date", "my-bold", "my-hilite", "my-sample"]); // add the new button to the toolbar
	  // END: code that adds a custom button

	  editor.generate();
	}
	function insertHTML() {
	  var html = prompt("Enter some HTML code here");
	  if (html) {
		editor.insertHTML(html);
	  }
	}
	function highlight() {
	  editor.surroundHTML('<span style="background-color: yellow">', '</span>');
	}

	HTMLArea.onload = initEditor;

	</script>	

</head>

<body onload="HTMLArea.init();">

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
                    <h1 class="page-header">Modificar Publicación</h1>
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
                                    <form class="form-horizontal" action="modificarPublicacion.php?id=<?php echo $id?>" method="post">
										<div class="form-group">
                                            <label>Título</label>
											<input name="titulo" type="text" maxlength="99" class="form-control" placeholder="Título" value="<?php echo $data['titulo'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Detalle</label>
											<textarea id="ta" name="ta" class="form-control" style="width:100%" rows="20" cols="80"><?php echo $data['detalle'];?></textarea>
										</div>
										<div class="form-group">
                                            <label>Tipo Operación</label>
											<select name="id_tipo_operacion" id="id_tipo_operacion" class="form-control" required="required">
											<option value="">Seleccione...</option>
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `tipo` FROM `tipos_operacion` ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												if ($fila['id'] == $data['id_tipo_operacion']) {
													echo " selected ";
												}
												echo ">".$fila['tipo']."</option>";
											}
											Database::disconnect();
											?>
											</select>
										</div>
										<div class="form-group">
                                            <label>Tipo Publicación</label>
											<select name="id_tipo_publicacion" id="id_tipo_publicacion" class="form-control" required="required">
											<option value="">Seleccione...</option>
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `tipo` FROM `tipos_publicacion` ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												if ($fila['id'] == $data['id_tipo_publicacion']) {
													echo " selected ";
												}
												echo ">".$fila['tipo']."</option>";
											}
											Database::disconnect();
											?>
											</select>
										</div>
										<div class="form-group">
                                            <label>Apto Crédito?</label>
											<select class="form-control" name="apto_credito">
											<option value="1" <?php if ($data['apto_credito']==1) echo "selected" ?>>Si</option>
											<option value="0" <?php if ($data['apto_credito']==0) echo "selected" ?>>No</option>
											</select>
										</div>
										<div class="form-group">
                                            <label>Nuevo Ingreso?</label>
											<select class="form-control" name="nuevo_ingreso">
											<option value="1" <?php if ($data['nuevo_ingreso']==1) echo "selected" ?>>Si</option>
											<option value="0" <?php if ($data['nuevo_ingreso']==0) echo "selected" ?>>No</option>
											</select>
										</div>
										<div class="form-group">
                                            <label>Superficie Cubierta (mts2)</label>
											<input name="superficie_cubierta" type="number" maxlength="99" min="0" class="form-control" placeholder="Superficie" value="<?php echo $data['superficie_cubierta'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Superficie Total (mts2)</label>
											<input name="superficie_total" type="number" maxlength="99" min="0" class="form-control" placeholder="Superficie" value="<?php echo $data['superficie_total'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Habitaciones</label>
											<input name="cant_habitaciones" type="number" min="0" maxlength="99" class="form-control" placeholder="Habitaciones" value="<?php echo $data['cant_habitaciones'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Baños</label>
											<input name="cant_banios" type="text" maxlength="99" class="form-control" placeholder="Baños" value="<?php echo $data['cant_banios'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Precio (u$s)</label>
											<input name="precio" type="number" maxlength="99" class="form-control" min="0" step="0.01" placeholder="Precio U$S" value="<?php echo $data['precio'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Provincia</label>
											<select name="id_provincia" id="id_provincia" class="form-control" required="required">
											<option value="">Seleccione...</option>
											<?php 
											$pdo = Database::connect();
											$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
											$sqlZon = "SELECT `id`, `provincia` FROM `provincias` ";
											$q = $pdo->prepare($sqlZon);
											$q->execute();
											while ($fila = $q->fetch(PDO::FETCH_ASSOC)) {
												echo "<option value='".$fila['id']."'";
												if ($fila['id'] == $data['id_provincia']) {
													echo " selected ";
												}
												echo ">".$fila['provincia']."</option>";
											}
											Database::disconnect();
											?>
											</select>
										</div>
										<div class="form-group">
                                            <label>Localidad</label>
											<input name="localidad" type="text" maxlength="99" class="form-control" placeholder="Localidad" value="<?php echo $data['localidad'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Barrio o Comuna</label>
											<input name="barrio" type="text" maxlength="99" class="form-control" placeholder="Barrio" value="<?php echo $data['barrio'];?>" required="required">
										</div>
										<div class="form-group">
                                            <label>Dirección</label>
											<input name="pac-input" id="pac-input" class="form-control" type="text" placeholder="Ingrese su dirección..." autocomplete="off" value="<?php echo $data['direccion'];?>"><div id="map" style="width:100%; height:500px;" ></div><input name="pac-input-coordenadas" value="<?php echo $data['coordenadas'];?>" id="pac-input-coordenadas" type="hidden">
										</div>
										<div class="form-group">
                                            <label>Activo</label>
											<select class="form-control" name="activa">
											<option value="1" <?php if ($data['activa']==1) echo "selected" ?>>Si</option>
											<option value="0" <?php if ($data['activa']==0) echo "selected" ?>>No</option>
											</select>
										</div>
                                        <button type="submit" class="btn btn-default">Modificar</button>
                                    </form>
									<br><br>
									<button onclick="document.location.href='inmuebles.php'" class="btn btn-default">Volver</button>
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
	<script>
		function initAutocomplete() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -33.8688, lng: 151.2195},
          zoom: 13,
          mapTypeId: 'roadmap',
		  disableDefaultUI: true
        });

        // Create the search box and link it to the UI element.
        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP].push(input);

        // Bias the SearchBox results towards current map's viewport.
        map.addListener('bounds_changed', function() {
          searchBox.setBounds(map.getBounds());
        });
		
        var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
          var places = searchBox.getPlaces();

          if (places.length == 0) {
            return;
          }

          // Clear out the old markers.
          markers.forEach(function(marker) {
            marker.setMap(null);
          });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds();
          places.forEach(function(place) {
            if (!place.geometry) {
              console.log("Returned place contains no geometry");
              return;
            }
            var icon = {
              url: place.icon,
              size: new google.maps.Size(71, 71),
              origin: new google.maps.Point(0, 0),
              anchor: new google.maps.Point(17, 34),
              scaledSize: new google.maps.Size(25, 25)
            };

            // Create a marker for each place.
            markers.push(new google.maps.Marker({
              map: map,
              icon: icon,
              title: place.name,
              position: place.geometry.location
            }));

            if (place.geometry.viewport) {
              // Only geocodes have viewport.
              bounds.union(place.geometry.viewport);
            } else {
              bounds.extend(place.geometry.location);
            }
			document.getElementById("pac-input-coordenadas").value = place.geometry.location.lat() + ',' + place.geometry.location.lng();
          });
          map.fitBounds(bounds);
        });
      }
	</script>
	<script>
	$("#imgInp").change(function() {
		readURL(this);
	});
	</script>
	<script>
	$("#pac-input").click(function () {
    $("html, body").animate({ scrollTop: $("#imgInp").offset().top }, 300);
    return true;
	});
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBcg5Y2D1fpGI12T8wcbtPIsyGdw-_NV1Y&libraries=places&callback=initAutocomplete" async defer></script>
</html>