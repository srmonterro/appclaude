<div style="margin-top: 45px; margin-bottom: 45px;" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
	<input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
	<div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
		<li>Nóminas</li>
		<li class="active">Crear Usuario</li>
	</ol>


	<form id="crearusernomina" action="" method="post" enctype="multipart/form-data">

		<input type="hidden" id="id" name="id" class="form-control" />
		<input type="hidden" id="tabla" name="tabla" value="nominas_usuarios" class="form-control" />

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="dni">DNI:</label>
				<input type="text" id="dni" name="dni" class="form-control" />
			</div>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label" for="nombre">Nombre y Apellidos:</label>
				<input type="text" id="nombre" name="nombre" class="form-control" />
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="email">Email:</label>
				<input type="text" id="email" name="email" class="form-control" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="tipo">Tipo:</label>
				<select id="tipo" name="tipo" class="form-control" >
					<option value="Docente">Docente</option>
					<option value="Personal">Personal</option>
				</select>
			</div>
		</div>

		<div class="col-md-1">
			<div class="form-group">
				<label class="control-label" for="activo">Activo:</label>
				<select id="activo" name="activo" class="form-control" >
					<option value="0">No activo</option>
					<option value="1">Activo</option>
					<option value="2">Temporal</option>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3" style="margin-top: 20px;"	>
			<div class="form-group">
				<label class="control-label" for="iban">IBAN / CC:</label>
				<input id="iban" type="text" name="iban" class="form-control" />
			</div>
		</div>

		<div class="col-md-2" style="margin-top: 20px;">
			<div class="cp form-group">
				<label class="control-label" for="codigopostal">C.P.:</label>
				<div class="input-group">
					<input type="text" id="codigopostal" name="codigopostal" class="form-control" >
					<span class="input-group-btn">
						<button id="buscarpoblacion" name="buscarpoblacion" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</span>
				</div>
			</div>
		</div>

		<div class="col-md-4" style="margin-top: 20px;"	>
			<div class="form-group">
				<label class="control-label" for="poblacion">Población:</label>
				<select id="poblacion" name="poblacion" class="form-control" disabled>
				</select>
			</div>
		</div>

		<div class="col-md-3" style="margin-top: 20px;"	>
			<div class="form-group">
				<label class="control-label" for="provincia">Provincia:</label>
				<select id="provincia" name="provincia" class="form-control" disabled>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12" style="margin-top: 20px;"	>
			<div class="form-group">
				<label class="control-label" for="direccion">Dirección:</label>
				<input type="text" id="direccion" name="direccion" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<p style="text-align: center; margin-top: 30px;">
			<a id="guardar_usuario_nomina" href="#" class="btn btn-lg btn-primary">Guardar Usuario</a>
			<a id="abrebusqueda" name="nominas_usuarios" href="#" class="btn btn-lg btn-primary">Mostrar Usuarios</a>
			<!-- <a id="abrebusqueda" href="#" name="nominas_usuarios" class="btn btn-lg btn-primary">Mostrar Usuarios</a><br> -->
		</p>

	</form>



</div>


<script type="text/javascript">

	$(document).on("click", "#seleccionarnominasusuarios", function(event){

		event.preventDefault();

		var id = $(this).attr('iden');
		var tabla = $(this).attr('tabla');


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			dataType: 'json',
			data: 'id='+id+'&tabla='+tabla+'&cierra=1',
			success: function(data)
			{
				//Cerramos el popup
				$("#mostrardatos").modal('hide');
				//Seteo de todos los campos
				for ( key in data[0] ) {
					$('#'+key).val(data[0][key]);
				}

				if(data[0].poblacion != null){
					$('select#poblacion').prop('disabled', false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				}else{
					$('select#poblacion').prop('disabled', false).html('<option value=""></option>');
				}

				if(data[0].poblacion != null){
					$('select#provincia').prop('disabled', false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
				}else{
					$('select#provincia').prop('disabled', false).html('<option value=""></option>');
				}

				//$('select#poblacion').prop('disabled', false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				//$('select#provincia').prop('disabled', false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');

 				/*Otra forma de setear los campos
				$("#dni").val(data[0].dni);
				$("#nombre").val(data[0].nombre);
				$("#email").val(data[0].email);
				$("#tipo").val(data[0].tipo);
				$("#activo").val(data[0].activo);*/
			}
		});

	});


</script>