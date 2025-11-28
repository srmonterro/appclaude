<!DOCTYPE html>
<html>
	<head>
		<title>ESFOCC | SMS</title>
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/esfocc.css" rel="stylesheet">
		<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="js/jquery-1.10.2.js"></script>
		<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<script src="js/jquery.validate.min.js"></script>
		
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="js/bootstrap.min.js"></script>
	</head>
<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');

$display1 = 'none';
$display2 = 'none';

// $permitidos = array("root","admin");

session_start();

?>



<div style="margin-top: 45px" class="container">

	<? if ( !isset($_SESSION[user]) ) { ?>

		<div class="container">
	    <div class="row">
	        <div class="col-sm-6 col-md-4 col-md-offset-4">
	            <div class="account-wall">
	                <img class="profile-img" src="img/logo.png"
	                    alt="">
	                <form class="form-signin">
	                <input id="user" type="text" class="form-control" placeholder="Usuario" required autofocus>
	                <input id="pass" type="password" class="form-control" placeholder="Contraseña" required>
	                <a id="login-sms" class="btn btn-lg btn-primary btn-block" type="submit">
	                    Entrar</a>
	                </form>
	            </div>
	        </div>
		    </div>
		</div>

	<? } else { ?>
	
    <div style="display: none" id="confirmacion" class="inv alert alert-success"></div>
    <div style="display: none" id="error" class="alert alert-danger"></div>


	<ol class="breadcrumb">
      <li class="active">Envío SMS</li>
      <p style="margin-top: 0px;" class="navbar-text navbar-right"><span class="glyphicon glyphicon-user"></span>&nbsp;<? echo $_SESSION['user'] ?>&nbsp;&nbsp; <span class="glyphicon glyphicon-off"></span>&nbsp;<a href="#" id="logout" class="navbar-link">Salir</a></p>
	</ol>

	<form role="form" action="" method="post" id="form-enviosms">

		<div class="col-md-2">
    		<div class="form-group">
        		<label class="control-label" for="sa">De:</label>
        		<input type="text" value="ESFOCC" id="sa" name="sa" class="form-control" />
    		</div>
		</div>

		<div class="col-md-2">
    		<div class="form-group">
        		<label class="control-label" for="da">Para:</label>
        		<input type="text" placeholder="666123456" value="<? echo $daerror ?>" id="da" name="da" class="form-control" required/>
    		</div>
		</div>

		<div class="col-md-6">
    		<div class="form-group">
        		<label class="control-label" for="msg">Mensaje:</label>
        		<textarea placeholder="160 caracteres máximo" maxlength="160" rows="3" id="msg" name="msg" class="form-control" required><? echo $msgerror ?></textarea>
    		</div>
		</div>

		<div class="col-md-2">
			<a id="enviarsms" name="enviarsms" style="width:100%; margin-top: 25px;" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-send"></span>&nbsp; Enviar SMS</a>
 		</div>

	</form>	

	<div class="clearfix"></div>

	<div class="tablasms">
	<?

		listarSMS($link);

    ?>
    </div>

    <? } ?>

</div>

<script>
	
	$(document).ready(function() {

		$(document).on("click","#logout", function(event) {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/logout.php',
		        data: 'salir=1',
		        success: function(data) 
		        {
		        	window.location.href = 'http://sms.esfocc.com';
		        } 
		    }); ajax.abort();

	    });

		$(document).on("click","#login-sms", function(event) {

	    	event.preventDefault();
	    	var user = $('#user').val();
	    	var pass = $('#pass').val();
			// alert(user+' '+pass);

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/login-sms.php',
		        data: 'user='+user+'&pass='+pass,
		        success: function(data) 
		        {		        
		        	if (data == 'error')
		        		alert("Usuario y/o Contraseña incorrectos.");
		        	else 
		        		window.location.reload();
		        } 
		    }); ajax.abort();

    
    	});

    	$(document).on("keydown","#pass",function (e){

	        if(e.keyCode == 13){//Enter key pressed
	            $('#login-sms').click();//Trigger search button click event
	        }
	    });

	    $(document).on("keydown","#user",function (e){

	        if(e.keyCode == 13){//Enter key pressed
	            $('#login-sms').click();//Trigger search button click event
	        }
	    });

		function listarSMS() {
			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'listarsms=1',
				success: function(data) 
				{
					$('.tablasms').html(data);
				} 
			}); ajax.abort();
		}

		$('#enviarsms').on('click', function(event) {	

			// alert("manda");
			var values = $('#form-enviosms').find("input[type='hidden'], :input:not(:hidden)").serialize();
			// alert(values);

			if ( $('#da').val().length < 9 ) { 
				alert("Inserta un nº de teléfono válido.");
				return false;
			}
			if ( $('#msg').val().length == 0 ) { 
				alert("Inserta un texto para el mensaje.");
				return false;
			}

			$("#enviarsms").css("pointer-events", "none");


			$.ajax({

				cache: false,
				type: 'POST',
				dataType: 'json',
				url: 'functions/post_sms.php',
				data: values,
				success: function(data) 
				{

					if ( data['resul'] == 'ok' ) {
						$('#confirmacion').show(500).delay(5000).hide('slow');
						$('#error').css('display','none');	
						$('#confirmacion').html(data['resultado']);
					} else {
						$('#error').show(500).delay(5000).hide('slow');
						$('#confirmacion').css('display','none');	
						$('#error').html(data['resultado']);
					}

					$("#enviarsms").css("pointer-events", "auto");
					listarSMS();

				} 
			}); ajax.abort();

		});


	});


</script>

</html>

