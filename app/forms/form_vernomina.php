<div style="margin-top: 45px; margin-bottom: 45px;" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Nóminas</li>
      <li class="active">Ver Nómina</li>
	</ol>


	<div class="col-md-12" id="listadonomina">
		
		

	</div>

</div>


<script type="text/javascript">
	
	$(document).ready(function() {

		var user = $('#userapp').val();
		// alert(user);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'user='+user+'&vernomina=1',
			success: function(data) 
			{
				$('#listadonomina').html(data);
			} 
		}); ajax.abort();					

	});

</script>