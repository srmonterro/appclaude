
<?php

include('../functions/funciones.php');

function rellenaSelector($q, $columna){

	global $link;

	// echo "<p>".$q."</p>";

	$q = mysqli_query($link, $q) or die("error select: ".mysqli_error($link));

	echo '<option value="">Cualquiera</option>';

	while ($fila = mysqli_fetch_assoc($q)) {
		echo '<option value="'.$fila[$columna].'">'.$fila[$columna].'</option>';
	}

	mysqli_free_result($q);

}

?>

<div class="container" style="margin-top: 45px;">

	<ol class="breadcrumb">
		<li>Seguimiento</li>
		<li class="active">Seguimiento Gastos</li>
	</ol>

	<form id="form-seguimiento-gastos">

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="tiposol">Tipo:</label>
				<select id="tiposol" name="tiposol-in" class="form-control" >
					<?php
					rellenaSelector('SELECT DISTINCT tiposol FROM peticiones_gastos', 'tiposol');
					?>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="numero">Número:</label>
				<input type="number" id="numero" name="numero-in" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="fecha">Fecha Peticion:</label>
				<input type="date" id="fecha" name="fecha-in" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="estado">Estado:</label>
				<select id="estado" name="estado-in" class="form-control" >
					<?php
					rellenaSelector('SELECT DISTINCT estado FROM peticiones_gastos', 'estado');
					?>
				</select>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="usuario">Usuario:</label>
				<select id="usuario" name="usuario-in" class="form-control" >
					<?php
					rellenaSelector('SELECT DISTINCT usuario FROM peticiones_gastos', 'usuario');
					?>
				</select>
			</div>
		</div>
		<div class="col-md-1">
			<a id="busqueda-seguimiento-gastos" class="btn btn-default" style="margin-top: 24px; width: 100%;">
				<span class="glyphicon glyphicon-search"></span>
			</a>
		</div>

		<div class="clearfix"></div>

		<div id="resultadoBusqueda">
		</div>

	</form>

</div>


<script type="text/javascript">

	$(document).on("click", "#busqueda-seguimiento-gastos", function(event){

		var values = $('#form-seguimiento-gastos').find("input[type='hidden'], :input:not(:hidden)").serialize();

		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/nbusqueda_seguimiento.php',
			data: values + '&consulta=1',
			success : function(data){
				// console.log(data);
				$("#resultadoBusqueda").html(data);
			}
		});

	});

</script>