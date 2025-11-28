
<script src="js/ikea.js"></script>
<form class="formularioaltaikea" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

<div style="display:none" id="confirmacion" class="alert alert-success">Información de tienda guardada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>

	
<div class="col-md-4">
	<div class="form-group">
		<label class="control-label" for="tienda">Nombre Tienda:</label>
			<input placeholder="IKEA Gran Canaria" type="text" id="tienda" name="tienda" class="form-control" />
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label" for="direccion">Dirección:</label>
		<input type="text" id="direccion" name="direccion" class="form-control" />
	</div>
</div>

<div class="col-md-2">	
	<div class="cp form-group">
		<label class="control-label" for="codigopostal">C.P.:</label>
		<div class="input-group">
			<input type="text" id="codigopostal" name="codigopostal" class="form-control" />
			<span class="input-group-btn">
				<button id="buscarpoblacion" name="buscarpoblacion" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label" for="poblacion">Población:</label>
		<select id="poblacion" name="poblacion" class="form-control" disabled>
		</select>
	</div>
</div>
<div class="col-md-6">
	<div class="form-group">
		<label class="control-label" for="provincia">Provincia:</label>
		<select id="provincia" name="provincia" class="form-control" disabled>
		</select>
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="tipo">Tipo:</label>
		<select id="tipo" name="tipo" class="form-control">
			<option value="Específica">Específica</option>
			<option value="Genérica">Genérica</option>
		</select>
	</div>
</div>

<div class="col-md-3">
	<div class="form-group">
		<label class="control-label" for="nivel">Nivel:</label>
		<select id="nivel" name="nivel" class="form-control">
			<option value="Superior">Superior</option>
			<option value="Básica">Básica</option>
		</select>
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label class="control-label" for="horaspresenciales">Horas Presenciales:</label>
		<input type="text" id="horaspresenciales" name="horaspresenciales" class="form-control" />
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label class="control-label" for="horasdistancia">Horas Distancia / Teleformación:</label>
		<input type="text" id="horasdistancia" name="horasdistancia" class="sum form-control" disabled />
	</div>
</div>
<div class="col-md-3">
	<div class="form-group">
		<label class="control-label" for="horastotales">Horas Totales:</label>
		<input type="text" id="horastotales" name="horastotales" class="sum form-control" />
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="interna">Formación interna:</label>
		<select id="interna" name="interna" class="form-control">
			<option value="Si">Si</option>
			<option value="No">No</option>
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
<div class="col-md-6">	
	<div class="cp form-group">
		<label class="control-label" for="lugar">Lugar de Impartición:</label>
		<div class="input-group">
			<input type="text" id="lugar" name="lugar" class="form-control" />
			<span class="input-group-btn">
				<button id="buscarcentrosikea" name="buscarcentrosikea" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="objetivos">Objetivos:</label>
		<textarea name="objetivos" id="objetivos" class="form-control" rows="3"></textarea>
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="contenido">Contenido:</label>
		<textarea name="contenido" id="contenido" class="form-control" rows="5"></textarea>
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="observaciones">Observaciones:</label>
		<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
	</div>
</div>

<div class="clearfix"></div>


</div>
<input name="tabla" type="hidden" id="tabla" value="ikea_solicitudes" />
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
	<input type="submit" name="submit" value="Enviar Solicitud" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
	<a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
</p>

</form>

