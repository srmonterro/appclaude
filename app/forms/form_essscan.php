
<form class="formularioessscan" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">

		<div style="display:none" id="confirmacion" class="alert alert-success">TPC guardado correctamente.</div>
		<div style="display:none" id="error" class="alert alert-danger">TPC ya existe en la base de datos.</div>

		<div class="diplomasessscan col-md-2" style="display:none">
			<a id="diplomasessscan" style="float:left; width:100%"  class="btn btn-sm btn-warning">Diplomas</a>
		</div>
		<div class="listadosessscan col-md-2" style="display:none">
			<a id="listadosessscan" style="float:left; width:100%"  name="matriculas" data-toggle=modal class="btn btn-sm btn-success">Listados</a>
		</div>

		<div class="clearfix"></div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="numcurso">Nº Curso:</label>
				<input type="text" id="numcurso" name="numcurso" class="form-control" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label" for="id_accion">Acción:</label>
				<select id="id_accion" name="id_accion" class="form-control">
					<option value="">-</option>

					<?

					$q = 'SELECT id, denominacion
					FROM acciones a
					WHERE diploma = "TPCF"';
					$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

					while ( $row = mysqli_fetch_assoc($q) ) {

						echo '<option value="'.$row['id'].'">'.$row['denominacion'].'</option>';

					}

					?>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="modalidad">Modalidad:</label>
				<select  id="modalidad" name="modalidad" class="form-control" />
					<option value="">-</option>
					<option value="Teleformación">Teleformación</option>
					<option value="Presencial">Presencial</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="fechaini">Fecha Inicio:</label>
				<input type="date" id="fechaini" name="fechaini" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="fechafin">Fecha Fin:</label>
				<input type="date" id="fechafin" name="fechafin" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label" for="contacto">Persona de Contacto:</label>
				<input value="Fernando Socorro Granados" type="text" id="contacto" name="contacto" class="form-control" disabled />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="contactotlf">Teléfono:</label>
				<input value="620263010" type="text" id="contactotlf" name="contactotlf" class="form-control" disabled />
			</div>
		</div>
		<div class="col-md-3">
			<div class="from-group">
				<label class="control-label" for="centrosessscan">Centro:</label>
				<select id="centrosessscan" name="centrosessscan" class="form-control">
					<option value="">-</option>
					<option value="Calle SEGUIDILLAS 9 SAN MIGUEL DE ABONA (Sta. Cruz de Tenerife)">Calle SEGUIDILLAS 9 SAN MIGUEL DE ABONA (Sta. Cruz de Tenerife)</option>
					<option value="Calle VOLCAN ELENA 24 San Cristóbal de La Laguna (Sta. Cruz de Tenerife)">Calle VOLCAN ELENA 24 San Cristóbal de La Laguna (Sta. Cruz de Tenerife)</option>
				</select>
			</div>
		</div>
		<div class="col-md-1">
			<div class="form-group">
				<label class="control-label" for="numalumnos">Nº Alus:</label>
				<input value="25" type="text" id="numalumnos" name="numalumnos" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<a id="fechasincluir" style="margin-top:25px;width:100%" class="btn btn-primary">Añadir Fechas</a>
		</div>


		<div class="clearfix"></div>

		<div class="col-md-2">
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
		<div class="col-md-5">
			<div class="form-group">
				<label class="control-label" for="poblacion">Población:</label>
				<select id="poblacion" name="poblacion" class="form-control" disabled>
				</select>
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">
				<label class="control-label" for="provincia">Provincia:</label>
				<select id="provincia" name="provincia" class="form-control" disabled>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-6">
			<label class="control-label" for="docentesessscan">Docentes:</label>
			<select class="multiselect" id="docentesessscan" name="docentesessscan" multiple="multiple" style="display: none;">
				<option value="">-</option>

				<?

				$q = 'SELECT d.*
				FROM docentes d
				WHERE d.documento = "B76571140"';
				$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

				while ( $row = mysqli_fetch_assoc($q) ) {

					echo '<option value="'.$row['id'].'">'.$row['nombredocente'].' '.$row['apellidodocente'].'</option>';

				}

				?>
			</select>
		</div>



	</div>

	<div class="clearfix"></div>

	<input name="tabla" type="hidden" id="tabla" value="cursos_essscan" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->

	<div  class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						&times;
					</button>
					<h4 class="modal-title" id="myModalLabel">Escoge Grupo Formativo</h4>
				</div>
				<div class="modal-body listagrupos">


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">
						Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>

	<p style="text-align: center; margin-top: 30px;">
		<input type="submit" name="submit" value="Guardar Curso" class="btn btn-primary btn-lg">
		<a id="abrebusqueda"  data-toggle=modal class="btn btn-lg btn-primary">Mostrar Curso</a><br>
		<a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;"  name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
	</p>

</div>
</form>

<div class="col-md-7 col-md-offset-3 tablaessscan" style="margin-bottom: 15px; display:none;">
	<form id="formtablaessscan" action="" method="post" enctype="multipart/form-data">
		<label> Tabla TPC: </label><br>
		<input style="float:left" type="file" name="tablaessscan" id="tablaessscan" class="btn btn-default">
		<a id="subirtablaessscan" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel </a>
		<a id="mostrartablaessscan" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar Excel </a><span id="estatablaessscan" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
	</form>
</div>


<script type="text/javascript">
	$(document).ready(function() {

		$('#docentestpc').multiselect({
			nonSelectedText: 'Selecciona docentes',
			nSelectedText: 'seleccionadas',
		});

	});
</script>