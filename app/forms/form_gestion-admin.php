<?

	session_start();

	if ( $_SESSION['user'] != 'root' )
		echo "No tienes permiso en esta sección.";
	else {

		?>

		<div class="col-md-12">
			<div class="col-md-3">
		    	<div class="form-group">
			    	<label class="control-label" for="funciones-admin">Funciones Admin:</label>
			    	<select name="funciones-admin" id="funciones-admin" class="required form-control">
				    	<option value="0">Ejecuta tu orden, maestro.</option>
				    	<option value="cambiargrupo">Cambiar Grupo Matrícula</option>
				    	<option value="modificarcertificados">Modificar códigos certificados</option>
				    	<option value="anadirgrupoemp">Añadir Grupo Empresas</option>
				    	<option value="mireporte">Mi reporte</option>
				    </select>
		    	</div>  	
    		</div>
    	</div>

		<div class="clearfix"></div>
		<hr>

		<? include_once './funciones.php';

		$q = 'SELECT * 
	    FROM registro_emails
		ORDER BY fecha DESC
		LIMIT 0,50';   
		$q = mysqli_query($link, $q);

		echo 
	    	'<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Fecha</th>
                    <th>Para</th>
                    <th>CC</th>
                    <th>Título</th>
                </tr>
            </thead>
            <tbody>';

	    while ( $row = mysqli_fetch_array($q) ) {

			echo '<tr>';
			echo '<td style= "display:none">'. $row[id] .'</td>';
			echo '<td>'. formateaFechaHora( $row[fecha] ) .'</td>';
			echo '<td>'. $row[para] .'</td>';
			echo '<td>'. $row[cc] .'</td>';
			echo '<td>'. $row[titulo] .'</td>';
	        echo '</tr>';
	        
	    }

	    echo '</tbody>
	    </table>';


	}



	?>

<script type="text/javascript">

$('#funciones-admin').change(function () {

	var optionSelected = $(this).find("option:selected");
	var valueSelected  = optionSelected.val();
	// alert(valueSelected);
	if (valueSelected == 'modificarcertificados')
		window.open('http://gestion.eduka-te.com/app/functions/regcontraincen.php', '_blank');
	else if (valueSelected == 'cambiargrupo') {

		var inputgrupos = '<div style="overflow:auto; margin-top: 10px" class="col-md-12"><div class="col-md-3 col-md-push-3"><div class="form-group"><label class="control-label" for="nacciongrupoant">Acción/Grupo:</label><input type="text" id="nacciongrupoant" name="nacciongrupoant" class="form-control" /></div></div><div class="col-md-3 col-md-push-3"><div class="form-group"><label class="control-label" for="nacciongruponew">Acción/Grupo Nuevo:</label><input type="text" id="nacciongruponew" name="nacciongruponew" class="form-control" /></div></div></div>';
		$('#mostrardatos').modal('show');
		$('.mostrartitulo').html('Cambio de Grupo');
		$('.contenido').html(inputgrupos);
		$('#guardarcambios').css('display','inline-block');
		$('#guardargrupoempresas').attr('id','guardargruponuevo');
		$('#guardarcambios').attr('id','guardargruponuevo');
		
	} else if ( valueSelected == 'anadirgrupoemp' ) {

		var inputemp = '<div style="overflow:auto; margin-top: 10px" class="col-md-12"><div class="col-md-6 col-md-push-3"><div class="form-group"><label class="control-label" for="nombregrupo">Grupo de Empresas:</label><input type="text" id="nombregrupo" name="nombregrupo" class="form-control" /></div></div></div>';
		$('#mostrardatos').modal('show');
		$('.mostrartitulo').html('Añadir Grupo de Empresas');
		$('.contenido').html(inputemp);
		$('#guardarcambios').css('display','inline-block');
		$('#guardargruponuevo').attr('id','guardargrupoempresas');
		$('#guardarcambios').attr('id','guardargrupoempresas');

	} else if ( valueSelected == 'mireporte' ) {

		window.open('http://gestion.eduka-te.com/app/index.php?form_mireporte', '_blank');

	}


});


$(document).on("click", "#guardargrupoempresas", function(event){

	// alert("guardamos el grupo nuevo");
	event.preventDefault();
	var nombregrupo = $('#nombregrupo').val();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones.php',
		data: 'nombregrupo='+nombregrupo+'&anadirgrupoemp=1',
		success: function(data) 
		{
			alert(data);	
			$('#guardargrupoempresas').attr('id','guardarcambios');
		} 
	}); ajax.abort();


});

$(document).on("click", "#guardargruponuevo", function(event){

	// alert("guardamos el grupo nuevo");
	event.preventDefault();
	var grupoant = $('#nacciongrupoant').val();
	var gruponuevo = $('#nacciongruponew').val();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones.php',
		data: 'grupoant='+grupoant+'&gruponuevo='+gruponuevo+'&cambiargrupo=1',
		success: function(data) 
		{
			alert(data);	
			$('#guardargruponuevo').attr('id','guardarcambios');
		} 
	}); ajax.abort();


});

</script>