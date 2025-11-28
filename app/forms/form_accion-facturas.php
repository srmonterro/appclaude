

	<form class="formularioaccion" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">

	<div style="display:none" id="confirmacion" class="alert alert-success">Acción guardada correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>

	<?

	// $q = 'SELECT max(numeroaccion)
	// FROM acciones
	// WHERE numeroaccion < 1000';
	// $q = mysqli_query($link, $q);
	// $naccion = mysqli_fetch_row($q);
	// $naccion = $naccion[0]+1;

	?>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="tipoformacionac">Entidad:</label>
		    <select id="tipoformacionac" name="tipoformacionac" class="form-control">
				<option value="">Por asignar</option>
				<? if ( $_SESSION[user] != 'alago' ) {  ?>
				<option value="Bonificada">Bonificado</option>
				<option value="Privada">Privado</option>
				<option value="Sarton">Sarton</option>
				<option value="Cervecera">Cervecera</option>
				<? } ?>
				<option value="Dinosol">Dinosol</option>
		    </select>
	    </div>
	</div>
    <div class="col-md-1">
    	<div class="form-group">
		    <label class="control-label" for="numeroaccion">Nº AF:</label>
		    <input placeholder="<? echo $naccion ?>" type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
	    </div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
		    <input type="text" id="denominacion" name="denominacion" class="form-control" />
	    </div>
	</div>
	<div class="col-md-3">
    	<div class="form-group cp">
		    <label class="control-label" for="palabraclave">Tipo Acción Formativa:</label>
		    <div class="input-group">
		    	<input placeholder="Inserta una palabra clave..." id="palabraclave" name="id_grupo" class="form-control" />
		  	    <span class="input-group-btn">
			        <button data-toggle="modal" data-target="#myModal" name="buscargrupo" class="btn btn-default"><span id="buscar" class="glyphicon glyphicon-search"></span></button>
			    </span>
		    </div>
	    </div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="diploma">Tipo Formación:</label>
		    <select id="diplomatipo" name="diploma" class="form-control">
		    	<option value="">-</option>
		    	<option value="VIN">VIN</option>
		    	<option value="ESSSCAN">ESSSCAN</option>
		    	<option value="DESA">DESA</option>
		    	<option value="LEGIONELLA">LEGIONELLA</option>
		   	</select>
	    </div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="modalidad">Modalidad:</label>
		    <select id="modalidad" name="modalidad" class="form-control">
		    	<option value="Presencial">Presencial</option>
		    	<!-- <option value="A Distancia">A Distancia</option> -->
		    	<option value="Teleformación">Teleformación</option>
		    	<option value="Mixta">Mixta</option>
		   	</select>
	    </div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="mixta">Modalidad No Presen:</label>
		    <select id="mixta" name="mixta" class="form-control" disabled>
		    	<option value="">-</option>
		    	<option value="A Distancia">A Distancia</option>
		    	<option value="Teleformación">Teleformación</option>
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

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="nivel">Nivel:</label>
		    <select id="nivel" name="nivel" class="form-control">
		    	<option value="Superior">Superior</option>
		    	<option value="Básica">Básica</option>
		   	</select>
	    </div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="url">Plataforma:</label>
		    <select id="url" name="url" class="form-control">
		    	<option value="http://esfocc.com/aula-virtual/">System</option>
		    	<option value="http://campus.esfocc.com">Moodle</option>
		    	<option value="Externa">Externa</option>
		   	</select>
	    </div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="proveedor">Proveedor:</label>
		    <select id="proveedor" name="proveedor" class="form-control">
		    	<option value="">Selecciona</option>
		    	<option value="Contenido Propio">Contenido Propio</option>
				<option value="Vértice">Vértice</option>
				<option value="Kontinia">Kontinia</option>
				<option value="Ieditorial">Ieditorial</option>
				<option value="ADRFormación">ADRFormación</option>
				<option value="ADAMS">ADAMS</option>
				<option value="Licendo">Licendo</option>
				<option value="Otros">Otros</option>
		   	</select>
	    </div>
	</div>

	<div class="clearfix"></div>

	<div class="plataforma_externa" style="display:none">

		<fieldset><legend>Datos Plataforma Centro</legend>

		<div class="col-md-6">
	    	<div class="form-group">
			    <label class="control-label" for="url_externa">URL Plataforma:</label>
			    <input type="text" id="url_externa" name="url_externa" class="form-control" />
		    </div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="usuario_externa">Usuario:</label>
			    <input type="text" id="usuario_externa" name="usuario_externa" class="form-control" />
		    </div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="pass_externa">Contraseña:</label>
			    <input type="text" id="pass_externa" name="pass_externa" class="form-control" />
		    </div>
		</div>

		<div class="col-md-5">
	    	<div class="form-group">
			    <label class="control-label" for="nombrecentro">Nombre Centro:</label>
			    <input type="text" id="nombrecentro" name="nombrecentro" class="form-control" />
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="cifcentro">CIF:</label>
			    <input type="text" id="cifcentro" name="cifcentro" class="form-control" />
		    </div>
		</div>

		<div class="col-md-5">
	    	<div class="form-group">
			    <label class="control-label" for="direccioncentro">Dirección Centro:</label>
			    <input type="text" id="direccioncentro" name="direccioncentro" class="form-control" />
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="telefonocentro">Teléfono:</label>
			    <input type="text" id="telefonocentro" name="telefonocentro" class="form-control" />
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="cpcentro">Código Postal:</label>
			    <input type="text" id="cpcentro" name="cpcentro" class="form-control" />
		    </div>
		</div>
		<div class="col-md-8">
	    	<div class="form-group">
			    <label class="control-label" for="poblacioncentro">Población:</label>
			    <input type="text" id="poblacioncentro" name="poblacioncentro" class="form-control" />
		    </div>
		</div>

		</fieldset>

		<fieldset><legend> </legend></fieldset>

	</div>

	<div class="col-md-2">
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
		    <label class="control-label" for="incendios">Certificado ICASEL:</label>
		    <select id="incendios" name="incendios" class="form-control">
		    	<option value="">-</option>
		    	<option value="1">Si</option>
		   	</select>
	    </div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="nivel_incendios">Nivel:</label>
		    <select id="nivel_incendios" name="nivel_incendios" class="form-control">
		    	<option value="">-</option>
		    	<option value="I">I</option>
		    	<option value="II">II</option>
		   	</select>
	    </div>
	</div>



	<div class="clearfix"></div>

	<div class="ta col-md-12">
    	<div class="form-group">
		    <label class="control-label" for="denominacion">Objetivos:</label>
		    <textarea name="objetivos" id="objetivos" class="form-control" rows="3"></textarea>
	    </div>
	</div>

	<div class="ta col-md-12">
    	<div class="form-group">
		    <label class="control-label" for="denominacion">Contenido:</label>
		    <textarea name="contenido" id="contenido" class="form-control" rows="5"></textarea>
	    </div>
	</div>
	<? if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'alago' ) { ?>
	<div class="col-md-2">
    	<div class="form-group">
	        <label class="control-label" for="nacciondino">Nº Acción Dino:</label>
	        <input type="text" id="nacciondino" name="nacciondino" class="form-control" />
    	</div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
	        <label class="control-label" for="nsystem">Nº System:</label>
	        <input type="text" id="nsystem" name="nsystem" class="form-control" />
    	</div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
	        <label class="control-label" for="courseid">Moodle ID:</label>
	        <input type="text" id="courseid" name="courseid" class="form-control" />
    	</div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
	        <label class="control-label" for="denominacionsystem">Denominación en System:</label>
	        <input type="text" id="denominacionsystem" name="denominacionsystem" class="form-control" />
    	</div>
	</div> <? } ?>
	<input name="tabla" type="hidden" id="tabla" value="acciones" />


</div>
	<input name="tabla" type="hidden" id="tabla" value="acciones" />
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
  <input type="submit" name="submit" value="Guardar Acción" class="btn btn-primary btn-lg">
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Acciones</a><br>
  <a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
</p>

</div>
</form>

<div class="col-md-8 col-md-push-3" style="margin-top: 20px; margin-bottom: 50px;">

<form id="formpdfacciones" action="" method="post" enctype="multipart/form-data">
			<label> PDF Metodología Didáctica: </label><br>
			<input style="float:left" type="file" name="pdfmetodologia" id="pdfmetodologia" class="btn btn-default">
			<a id="subirpdfmetodologia" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostrarpdfmetodologia" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
</form><div class="clearfix"></div>

</div>