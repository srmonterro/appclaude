<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Charlas Contratos Formativos</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha256-7s5uDGW3AHqw6xtJmNNtr+OBRJUlgkNJEo78P4b0yRw= sha512-nNo+yCHEyn0smMxSswnf/OnX6/KwJuZTlNZBjauKhTK0c+zT+q5JOCx0UFhXQ6rJR9jg6Es8gPuD2uZcYDLqSw==" crossorigin="anonymous">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>	
	<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
</head>
<body>

	
	<div id="formulario" class="col-md-6" style="border: 1px solid #ccc; float:none !important; padding: 10px; margin:50px auto">

		<img style="margin-bottom: 40px; max-width:100%" src="../img/charlas_cabecera.png" alt="">

		<div style="display:none" id="confirmacion" class="alert alert-success">Datos enviados correctamente.</div>
		
		<div class="col-md-4">
	    	<div class="form-group">
		        <label class="control-label" for="nombre">Nombre:</label>
		        <input type="text" id="f_nombre" name="nombre" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-4">
	    	<div class="form-group">
		        <label class="control-label" for="apellido1">Primer Apellido:</label>
		        <input type="text" id="f_apellido1" name="apellido1" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-4">
	    	<div class="form-group">
		        <label class="control-label" for="apellido2">Segundo Apellido:</label>
		        <input type="text" id="f_apellido2" name="apellido2" class="form-control" />
	    	</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3">
	    	<div class="form-group">
		        <label class="control-label" for="tlf">Teléfono:</label>
		        <input type="text" id="f_tlf" name="tlf" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-4">
	    	<div class="form-group">
		        <label class="control-label" for="email">Email:</label>
		        <input type="text" id="f_email" name="email" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-5">
	    	<div class="form-group">
		        <label class="control-label" for="empresa">Empresa:</label>
		        <input type="text" id="f_empresa" name="empresa" class="form-control" />
	    	</div>
		</div>

		<div class="clearfix"></div>

		<p class="text-center" style="margin-top: 30px">
			<a id="guardacuestionarioikea" class="btn btn-primary btn-lg">Enviar</a>
		</p>

		<img style="margin-top: 40px; max-width:100%" src="../img/charlas_pie.png" alt="">
	
	</div>


</body>
</html>

<script>

	$(document).on("click", "a#guardacuestionarioikea", function(event){

		var values = $('#formulario').find("input[type='hidden'], :input:not(:hidden)").serialize();		

		if ( $('#f_nombre').val() == "" || $('#f_apellido1').val() == "" || $('#f_apellido2').val() == "" || $('#f_empresa').val() == "" || $('#f_tlf').val() == "" || $('#f_email').val() == "" ) {
			alert("Por favor, rellene todos los campos.");
			return false;
		}


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'post.php',
			data: values,
			success: function(data) 
			{
				if (data.indexOf('error') != -1)
		        	alert("Ocurrió un error");
		        else {
		        	$('body, html').animate({ scrollTop: $("#formulario").offset().top }, 1000);
		        	$('#confirmacion').show(500).delay(2000).hide('slow');
		        	setTimeout(function(){location.reload();},2200);
		        }
			} 
		}); ajax.abort();


	});

</script>
