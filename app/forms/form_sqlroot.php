<?php

include('../functions/funciones.php');

	if (isset($_POST['sql'])) { // si me viene la variable 'sql' es que estoy dentro de la llamada

		$q = $_POST['sql']; // me guardo el valor de la consulta
		$db = $_POST['db'];

		$mensaje = mysqli_select_db($link, $db);

		$condicion1 = stripos($q,'insert');
		$condicion2 = stripos($q,'update');
		$condicion3 = stripos($q,'delete');

		if ($condicion1 !== false || $condicion2 !== false || $condicion3 !== false) {
			$resul = 'consulta_no_permitida';
		} else{
			$q = mysqli_query($link, $q) or die("error select: ".mysqli_error($link)); // la ejecuto

			if(mysqli_sqlstate($link) == 00000){
				while ($row = mysqli_fetch_assoc($q)) { // guardo todos los valores en otro array

					$resul[] = $row;

				}

				$nombres_columnas = array();

				$registro = mysqli_fetch_fields($q);

				foreach ($registro as $columna) {
					$nombres_columnas[] = $columna->name;
				}

				$resul = arrayTable($nombres_columnas, $resul, true, true, '', '');
				/*$resul = 'consulta_ejecutada_sin_errores';*/
			}else{
				$resul = 'error_bd';
			}
		}

		mysqli_free_result($q); //libero la consulta
		echo json_encode($resul); // devuelvo el resultado a la llamada ajax
		/*echo $resul;*/
	}

	else if (isset($_POST['guardasql'])) {

		$id = $_POST['id'];
		$nombre_consulta = $_POST['nombre'];
		$descripcion_consulta = $_POST['descripcion'];
		$contenido_consulta = $_POST['consultaSql'];
		$nombre_bd = $_POST['nombrebd'];

		$contenido_consulta = str_replace("\"", "'", $contenido_consulta);

		$insert = 'insert';
		$update = 'update';
		$delete = 'delete';
		$condicion1 = stripos($contenido_consulta,$insert);
		$condicion2 = stripos($contenido_consulta,$update);
		$condicion3 = stripos($contenido_consulta,$delete);

		if ($condicion1 !== false || $condicion2 !== false || $condicion3 !== false) {
			echo json_encode('error');
		}else {
			if ($_POST['id'] != "") {
				$consulta = "UPDATE sqlroot SET nombre = ?, descripcion = ?, consultaSql = ? WHERE id = ?";
				$sentencia = mysqli_prepare($link, $consulta);
				mysqli_stmt_bind_param($sentencia, 'sssi', $nombre_consulta, $descripcion_consulta, $contenido_consulta, $id);
			} else {
				$consulta = "INSERT INTO sqlroot (nombre, descripcion, consultaSql, nombreDb) VALUES(?,?,?,?)";
				$sentencia = mysqli_prepare($link, $consulta);
				mysqli_stmt_bind_param($sentencia, 'ssss', $nombre_consulta, $descripcion_consulta, $contenido_consulta, $nombre_bd);
			}
			mysqli_stmt_execute($sentencia);
			mysqli_free_result($sentencia);
		}
	}

	else if(isset($_POST['tablas'])){

		$nombre_bd = $_POST['bd'];

		$consulta = "SELECT table_name FROM information_schema.TABLES WHERE TABLE_SCHEMA = '".$nombre_bd."'";

		$resultado_consulta = mysqli_query($link, $consulta) or die("error select: ".mysqli_error($link));

		echo '<select id="tablasBaseDeDatos" class="form-control" name="tablasBaseDeDatos">';

		echo '<option value=""></option>';

		while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
			echo '<option value="'.$registro['table_name'].'">'.$registro['table_name'].'</option>';
		}

		echo '</select>';

		mysqli_free_result($resultado_consulta);
	}

	else if(isset($_POST['campos'])){

		$nombre_tabla = $_POST['tabla'];
		$bd = $_POST['bd'];

		//CONSULTA PARA MOSTRAR LOS NOMBRES DE LOS CAMPOS DE UNA TABLA
		$consulta = "SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS
		WHERE table_name = '".$nombre_tabla."'
		AND table_schema = '".$bd."'";

		$resultado_consulta = mysqli_query($link, $consulta) or die("error: ".mysqli_error($link));

		echo '<select id="camposTablaSeleccionada" class="form-control" name="camposTablaSeleccionada">';

		echo '<option value=""></option>';

		while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
			echo '<option value="'.$registro['column_name'].'">'.$registro['column_name'].'</option>';
		}

		echo '</select>';
		mysqli_free_result($resultado_consultas);
	}

	else {

		?>

		<div class="container">

			<input id="id_consulta" type="hidden" name="id_consulta" value="" class="form-control"> <!-- campo para almacenar el id !-->

			<div class="col-md-12" id="alerta" style="margin-top: 20px;">
				<div style="display:none" id="confirmacion" class="alert alert-success"></div>
				<div style="display:none" id="error" class="alert alert-danger"></div>
			</div>


			<div class="clearfix"></div>

			<div class="col-md-3" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Consulta</label>
					<select id="listadoConsultas" type="text" name="listadoConsultas" class="form-control">
						<?
						$q = 'SELECT id,
						nombre,
						descripcion,
						consultaSql,
						nombreDb
						FROM sqlroot';
						$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));
						echo '<option>Selecciona una consulta</option>';
						while ( $row = mysqli_fetch_assoc($q) ) {
							echo '<option num = "'.$row['id'].'" desc = "'.$row['descripcion'].'" bd = "'.$row['nombreDb'].'" value = "'.$row['consultaSql'].'">'.$row['nombre'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-4" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Nombre</label>
					<input id="nombreConsulta" type="text" name="nombreConsulta" class="form-control">
				</div>
			</div>

			<div class="col-md-8" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Descripcion</label>
					<input id="descripcionConsulta" type="text" name="descripcionConsulta" class="form-control">
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-4" style="margin-top: 45px;">
				<button id="btnEjecutar" type="submit" class="btn btn-primary">Ejecutar consulta</button>
				<button id="btnGuardar" type="submit" class="btn btn-primary">Guardar consulta</button>
			</div>

			<div class="col-md-3" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label" for="listadoBaseDeDatos">DB</label>
					<select id="listadoBaseDeDatos" class="form-control" name="listadoBaseDeDatos">
						<?
						$consulta = 'SHOW DATABASES';
						$resultado_consulta = mysqli_query($link, $consulta) or die ("error select: ".mysqli_error($link));
						echo '<option>Seleccione una base de datos</option>';
						while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
							echo '<option value="'.$registro['Database'].'">'.$registro['Database'].'</option>';
						}
						?>
					</select>
				</div>
			</div>

			<div class="col-md-2" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Tablas:</label>
					<div id="contenedorTablas" name="contenedorTablas">
						<select class="form-control">

						</select>
					</div>
				</div>
			</div>

			<div class="col-md-3" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Campos:</label>
					<div id="camposTabla" name="camposTabla">
						<select class="form-control">

						</select>
					</div>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">SQL</label>
					<textarea id="contenidoConsulta" type="textarea" name="contenidoConsulta" class="form-control" rows="5" style="resize:none;"></textarea>
				</div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-12" style="margin-top: 20px;">
				<div class="form-group">
					<label class="control-label">Resultado</label>
					<div id="resultadoConsulta" class="control-label"></div>
				</div>
			</div>

		</div>

		<script type="text/javascript">

			$(document).on("change", "#listadoConsultas", function(event) {

				event.preventDefault();

				$("#nombreConsulta").val($(this).find('option:selected').text());
				$("#descripcionConsulta").val($(this).find('option:selected').attr('desc'));
				$("#contenidoConsulta").val($(this).find('option:selected').attr('value'));
				$("#listadoBaseDeDatos").val($(this).find('option:selected').attr('bd'));
				$("#id_consulta").val($(this).find('option:selected').attr('num')); // pongo el id de la consulta en el campo
			});

			$(document).on("click", "#btnEjecutar", function(event) {

				event.preventDefault();
				var consulta = $("#contenidoConsulta").val();
				var bd = $("#listadoBaseDeDatos").find('option:selected').val();

				// llamada ajax: codifico el contenido de la consulta para proteger los valores
				$.ajax({
					cache: false,
					type: 'POST',
					dataType: 'json', // para devolver un json (array)
					url: 'forms/form_sqlroot.php',
					data: 'sql='+encodeURI($("#contenidoConsulta").val())+'&db='+bd,
					success: function(data)
					{
						/*console.log(data);*/
						if (data != "" && data != 'error' && data != 'error_bd') {
							$("#resultadoConsulta").html(data);
							$("#confirmacion").text('Se han cargado los registros.');
							$("#confirmacion").show();
						}else if(data == 'error'){
							$("#error").text('No se puede ejecutar este tipo de consulta.');
							$("#error").show();
						}else if(data == 'error_bd'){
							$("#resultadoConsulta").hide();
						}
					}
				});
			});

			$(document).on("click", "#btnGuardar", function(event){

				event.preventDefault();
				var id = $('#id_consulta').val();
				var bd = $('#listadoBaseDeDatos').find('option:selected').val();

				if ($('#nombreConsulta').val() != "" && $('#contenidoConsulta').val() != "") {
					$.ajax({
						cache: false,
						type: 'POST',
						dataType: 'json',
						url: 'forms/form_sqlroot.php',
						data: 'id='+id+'&nombre='+encodeURI($('#nombreConsulta').val())+'&descripcion='+encodeURI($('#descripcionConsulta').val())+
						'&consultaSql='+encodeURI($('#contenidoConsulta').val())+'&nombrebd='+encodeURI(bd)+'&guardasql=1',
						success: function(data)
						{
							var mensaje;
							if (data != "" && data != 'error') {
								if (id != "") {
									mensaje = 'Consulta actualizada con exito.';
								} else {
									mensaje = 'Consulta guardada con exito.';
								}
								$("#confirmacion").text(mensaje);
								$("#confirmacion").show();
							} else {
								mensaje = 'No se puede guardar ni actualizar este tipo de consulta.';
								$("#error").text(mensaje);
								$("#error").show();
							}
							$('body, html').animate({scrollTop: $(".navbar").offset().top }, 1000);
							setTimeout(function(){location.reload();},2200);
						}
					});
				} else {
					alert('Faltan datos para almacenar o actualizar la consulta.');
				}
			});

			$(document).on("change", "#listadoBaseDeDatos", function(event){

				var bd = $(this).val();

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/form_sqlroot.php',
					data: 'bd='+bd+'&tablas=1',
					success: function(data)
					{
						$("#contenedorTablas").html(data);
					}
				});
			});

			$(document).on("change", "#tablasBaseDeDatos", function(event){

				var bd = $("#listadoBaseDeDatos").val();
				var tabla = $("#tablasBaseDeDatos").val();

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/form_sqlroot.php',
					data: 'campos=1&bd='+bd+'&tabla='+tabla,
					success : function(data){
						$("#camposTabla").html(data);
					}
				});
			});

		</script>

		<? } ?>