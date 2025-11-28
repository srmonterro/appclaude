
<form class="formularioreporte" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

<div style="display:none" id="confirmacion" class="alert alert-success">Información de tienda guardada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>


<fieldset>
	<legend>Añadir Tarea</legend>
<input type="hidden" id="id" name="id" value="" class="form-control" />
<input name="tabla" type="hidden" id="tabla" value="mireporte" />

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="fecha">Fecha Tarea:</label>
        <input type="date" value="<? echo date("Y-m-d") ?>" id="fecha" name="fecha" class="form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="fechaini">Fecha Inicio:</label>
        <input type="date" value="<? echo date("Y-m-d") ?>" id="fechaini" name="fechaini" class="form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="fechafin">Fecha Fin:</label>
        <input type="date" value="<? echo date("Y-m-d") ?>" id="fechafin" name="fechafin" class="form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="tipotarea">Tipo de Tarea:</label>
        <select name="tipotarea" id="tipotarea" class="form-control">
        	<option value="Desarrollo">Desarrollo</option>
        	<option value="Peticion">Petición</option>        	
        	<option value="Correccion">Corrección</option>
        </select>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="persona">Persona:</label>
        <select name="persona" id="persona" class="form-control">
        	<option value="Alberto">Alberto</option>
        	<option value="Javier">Javier</option>
        	<option value="Vicente">Vicente</option>
        	<option value="Shirley">Shirley</option>
        	<option value="Daniel">Daniel</option>
        	<option value="Ana">Ana</option>
        	<option value="Margarita">Margarita</option>
        	<option value="Fran">Fran</option>
        	<option value="Oscar">Oscar</option>
        	<option value="Efren">Efren</option>
        	<option value="Ivan">Ivan</option>    
        	<option value="Isabel">Isabel</option>    
        	<option value="Amanda">Amanda</option>
        	<option value="Anja">Anja</option>
        	<option value="Amparo">Amparo</option>
        	<option value="IKEA">IKEA</option>        	
        </select>
	</div>
</div>

<div class="col-md-2">  
    <div class="cp form-group">
        <label class="control-label" for="progreso">Progreso:</label>
        <div class="input-group">
            <span class="input-group-btn">
                <button id="recarga_progreso_tarea" name="recarga_progreso_tarea" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></button>
            </span>
            <input type="text" id="progreso" value="100" name="progreso" class="form-control" />
            <span class="input-group-addon">%</span>
        </div>
    </div>
</div>
<div class="col-md-10 col-md-push-1">
    <div style="margin-top: 30px;" class="progress progress-striped active">
        <div class="progress-bar progress-bar-success"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 0%">
            <span class="sr-only">1% Complete</span>
        </div>
        <div class="progress-bar progress-bar-danger"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
            <span class="sr-only">1% Complete</span>
        </div>
    </div>
</div>
<div class="clearfix"></div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="descripcion">Descripción de la tarea:</label>
		<textarea name="descripcion" id="descripcion" class="form-control" rows="4"></textarea>
	</div>
</div>

<a id="guardar_mireporte" style="margin-left: 15px; margin-bottom: 30px" class="btn btn-default btn-success">Guardar</a>

</form>
</fieldset>

<div class="clearfix"></div>

<fieldset>
	<legend>Seguimiento de Tareas </legend>
</fieldset> 
<div id="listadoreportes" class="col-md-12">
	<? listarMiReporte($link); ?>
</div>
<form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

		<a id="imprimirSeguimientoe" onclick="printDiv('listadoreportes')" style="margin-left: 5px; margin-bottom: 30px; " class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

<!-- 		<a id="listacorreos" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-envelope"></span> Lista de Correo</a>
 -->
		<a id="listadoExcel" style="" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>

		<input type="hidden" id="datatodisplay" name="datatodisplay" disabled/>
</form>

</div>
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

<script>
	
	$(document).on("click", "#listadoExcel", function(event) {


		var datatodisplay = $('#listadoreportes').html();
		$('#datatodisplay').val(datatodisplay);
		// alert(datatodisplay);
		document.getElementById("lala").submit(datatodisplay);


	});
</script>




