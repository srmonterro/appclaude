<!DOCTYPE html>
<html>
	<head>
	    <? $web = basename($_SERVER['REQUEST_URI'], ".php"); 
	       $title = explode("index.php?", $web);
	       if ($title[1] == "") $title[1] = "Inicio";	       
			
	    ?>
		<title><? echo ucfirst($title[1])." | Gestión ESFOCC"  ?></title>
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv='cache-control' content='no-cache'>
		<meta http-equiv='expires' content='0'>
		<meta http-equiv='pragma' content='no-cache'>
		<!-- Bootstrap -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/esfocc.css" rel="stylesheet">
		<link rel="stylesheet" href="css/bootstrap-multiselect.css" type="text/css"/>
        <link rel="shortcut icon" href="esfocc.png" />
        
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->
		<script src="js/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		
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
		<!-- <script src="js/jquery.fittext.js"></script> -->
		<!-- <script src="js/jquery.tablesorter.min.js"></script> -->
		<script type="text/javascript" src="js/bootstrap-multiselect.js"></script>

		<!-- Initialize the plugin Multiselect: -->
		<script type="text/javascript">
		  $(document).ready(function() {

		    $('.multiselect').multiselect({		    	
		    	nonSelectedText: 'Selecciona especialidades',
            	nSelectedText: 'seleccionadas',	
		    });		    

		  });
		</script>


	</head>

	<body>
		
	<?
	session_start();

	if (isset($_SESSION['user']))

		include_once './inicio.php';

	else {

	?>

	<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <img class="profile-img" src="img/logo.png"
	                    alt="">
	                <form class="form-signin">
	                <input id="user" type="text" class="form-control" placeholder="Usuario" required autofocus>
	                <input id="pass" type="password" class="form-control" placeholder="Contraseña" required>
	                <a id="login_ikea" class="btn btn-lg btn-primary btn-block" type="submit">
	                    Entrar</a>
	                </form>
	            </div>
	        </div>
	    </div>
	</div>
	
	<? } ?>

	    
</body>
</html>
