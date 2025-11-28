
<form class="formularioreporte" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

<div style="display:none" id="confirmacion" class="alert alert-success">Información de tienda guardada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>


<fieldset>
	<legend>Añadir nuevo reporte</legend>
<input type="hidden" id="id" name="id" value="" class="form-control" />
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="fecha">Fecha Contacto:</label>
        <input type="date" value="<? echo date("Y-m-d") ?>" id="fecha" name="fecha" class="form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="tipocontacto">Tipo Contacto:</label>
        <select name="tipocontacto" id="tipocontacto" class="form-control">
        	<option value="Email">Email</option>
        	<option value="Teléfono">Teléfono</option>
        	<option value="Presencial">Visita Presencial</option>
        </select>
	</div>
</div>
<div class="clearfix"></div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="comercial">Comercial:</label>
		<? 
				$q = 'SELECT c.id
			    FROM comerciales c, usuarios u
			    WHERE  c.id = u.id_comercial
			    AND user = "'.$_SESSION[user].'"';
			    // echo $q;
			    $q = mysqli_query($link, $q);

			    $row = mysqli_fetch_array($q);
			    $id = $row[id];

    		?>
			<select name="comercial" id="comercial" class="form-control" readonly>
				<option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
			</select>
			<input type="hidden" id="id_comercial" name="id_comercial" value="<? echo $id ?>" class="form-control" />
	</div>
</div>
<div class="col-md-3">
            <div class="cp form-group">
            <label class="control-label" for="razonsocial">Empresa: <span id="inforeporte" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Añade la empresa o búscala en la lista si ya existe" style="font-size: 16px" class="glyphicon glyphicon-info-sign"></span></label>
            <div class="input-group">
            	<span class="input-group-btn">
				<button id="anadirempresa" name="anadirempresa" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
				</span>
                <input placeholder="Busca la empresa" type="text" id="razonsocial" name="razonsocial" class="form-control" />
                <span class="input-group-btn">
                    <button id="buscarempresareporte" name="buscarempresareporte" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                
            </div>
            </div>
            <input type="hidden" id="id_empresa" name="id_empresa" class="form-control" />
        </div>

<div class="col-md-3">	
	<div class="cp form-group">
		<label class="control-label" for="formacion">Proyecto/Formación:</label>
		<div class="input-group">
			<input type="text" id="formacion" name="formacion" class="form-control" />
			<span class="input-group-btn">
				<button id="buscaraccion" name="buscaraccion" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</div>
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="prioridad">Prioridad:</label>
		<select id="prioridad" name="prioridad" class="form-control" >
			<option value="Alta">Alta</option>
			<option value="Media">Media</option>
			<option value="Baja">Baja</option>
		</select>
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="procontacto">Próximo Contacto:</label>
        <input type="date" id="procontacto" name="procontacto" class="form-control" />
	</div>
</div>

</fieldset>

<div class="clearfix"></div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="observaciones">Observaciones:</label>
		<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
	</div>
</div>

<a id="guardar_reporte" style="margin-left: 15px; margin-bottom: 30px" class="btn btn-default btn-success">Guardar</a>

</form>

<div class="clearfix"></div>

<fieldset>
	<legend>Seguimiento de Reportes </legend><a id="listarreporteprox" style="cursor:pointer">Ordenar por Próximo Contacto</a>
</fieldset> 
<div id="listadoreportes" class="col-md-12">
	<? listarReporte($_SESSION['user'], $link); ?>
</div>
<form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

		<a id="imprimirSeguimientoe" onclick="printDiv('listadoreportes')" style="margin-left: 5px; margin-bottom: 30px; " class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

<!-- 		<a id="listacorreos" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-envelope"></span> Lista de Correo</a>
 -->
		<a id="listadoExcel" style="" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>

		<input type="hidden" id="datatodisplay" name="datatodisplay" disabled/>
</form>
<input name="tabla" type="hidden" id="tabla" value="reportescomerciales" />

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




