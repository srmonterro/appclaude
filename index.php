<!DOCTYPE html>
<html>
	<head>
	    <?
	    	// phpinfo();

	    	$web = basename($_SERVER['REQUEST_URI'], ".php");
	    	//print_r($_SERVER);
	    	//echo $web;
	       $title = explode("index.php?", $web);
	       if ($title[1] == "") $title[1] = "Inicio";
	       if ($title[1] == "inspeccionpm") $title[1] = "Inspección Presencial / Mixto";
	       if ($title[1] == "presencial_doc") $title[1] = "Documentación Presencial / Mixto";
	       if ($title[1] == "form_matricula_ini") $title[1] = "Matrícula Grupal Online / Distancia";
	       if ($title[1] == "form_matricula_doc") $title[1] = "Documentación Grupal Online / Distancia";
	       if ($title[1] == "form_matricula_fin") $title[1] = "Finalización Grupal Online / Distancia";
	       if ($title[1] == "presencial_fin") $title[1] = "Finalización Presencial / Mixto";
	       if ($title[1] == "seguimiento-empresas") $title[1] = "Seguimiento Empresas";
	       if ($title[1] == "seguimiento-comercial") $title[1] = "Seguimiento Comercial";
	       if ($title[1] == "registro-incendios") $title[1] = "Libro de Registro Formación Contra Incendios";
	       if ($title[1] == "form_acreedores") $title[1] = "Acreedores";
	       if ($title[1] == "form_control-facturacion") $title[1] = "Control Facturación";
	       if ($title[1] == "form_control-facturacion-acre") $title[1] = "Control Facturación Acreedores";
	       if ($title[1] == "form_apuntes-facturacion") $title[1] = "Añadir Factura Acreedor";
	       if ($title[1] == "form_control-facturacion-acciones") $title[1] = "Control Facturación Acciones";
		   if ($title[1] == "Fac_libre") $title[1] = "Añadir Factura Otros";
		   if ($title[1] == "dashboard") $title[1] = "Panel de bienvenida";

			session_start();
		   if ( !isset($_SESSION['anio']) ) {
		   		//echo "entra";
	        	if( date("Y") == '2014' ) $gestion = '';
	        	else $gestion = date("Y");
				//echo $gestion;
	        	$_SESSION['anio'] = date("Y");
	        	//print_r($_SESSION);
	        }
	    ?>
		<title><? echo ucfirst($title[1])." | Gestión"  ?></title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/edukate.css" rel="stylesheet">
		<link href="css/jquery-ui.min.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>

        <link rel="shortcut icon" href="logo_edu.png" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<script src="js/jquery-1.11.2.min.js"></script>
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		<script src="js/additional-methods.min.js"></script>

		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/validar-form.js"></script>
		<script src="js/matricula.js"></script>
		<script src="js/matricula-presencial.js"></script>
		<script src="js/facturacion.js"></script>
		<script src="js/tutorias.js"></script>
		<script src="js/misc.js"></script>
		<script src="js/inspeccion.js"></script>
		<script src="js/matgrupales.js"></script>
		<script src="js/modernizr.js"></script>
		<script src="js/jquery.columnizer.js"></script>
		<!-- <script src="js/jquery.fittext.js"></script> -->
		<!-- <script src="js/jquery.tablesorter.min.js"></script> -->
		<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

		<!-- Initialize the plugin Multiselect: -->
		<script type="text/javascript">
		  $(document).ready(function() {

		    $('#especialidades').multiselect({
		    	nonSelectedText: 'Selecciona especialidades',
            	nSelectedText: 'seleccionadas',
		    });

		    $('#empresasmulti').multiselect({
		    	nonSelectedText: 'Selecciona empresas',
            	nSelectedText: 'seleccionadas',
		    });

		  });
		</script>


	</head>

	<body>

	<?

	if (isset($_SESSION['user']))
		
		include_once './inicio.php';

	else { //echo "otra vez";

	?>
	<link href="css/snow.css" type="text/css" rel="stylesheet"/>
    <div id="snow"></div>
	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <img class="profile-img" src="img/logo.png"
	                    alt="">
	                <form class="form-signin">
	                <input id="user" type="text" class="form-control" placeholder="Usuario" required autofocus>
	                <input id="pass" type="password" class="form-control" placeholder="Contraseña" required>
	                <a id="login" class="btn btn-lg btn-primary btn-block" type="submit">
	                    Entrar</a>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>

	<? } ?>


</body>
</html>

<script type="text/javascript">
// $(document).ready(function() {

// 	// alert("e");
// 	$.letItSnow('body', {
// 	  stickyFlakes: 'lis-flake--js',
// 	  makeFlakes: true,
// 	  sticky: true
// 	});
// });
</script>