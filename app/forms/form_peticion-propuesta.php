
<div style="margin-top: 30px" class="container">
<form class="formulariopeticion" id="formulario" role="form" action="" method="post">


<div style="display:none" id="confirmacion" class="alert alert-success">Petición realizada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger"></div>


	<ol class="breadcrumb">
      <li>Comerciales</li>
      <li class="active">Solicitud de matrícula</li>
	</ol>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="numero">Nº Solicitud:</label>
		<? 
			$q = 'SELECT max(numero) as maximo
    		FROM peticiones_formativas';
    		$q = mysqli_query($link, $q);

    		$row = mysqli_fetch_array($q);
    		$max = $row[maximo]+1;
		?>
		<div class="input-group">
			<span class="input-group-addon">S</span>
				<input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />			
		</div>
		
	</div>
</div>

	
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="tipoformacionpropuesta">Tipo de Formación:</label>
		<select id="tipoformacionpropuesta" name="tipoformacionpropuesta" class="form-control">
			<option value="">Por asignar</option>
			<option value="Bonificable">Bonificable</option>
			<option value="Privado">Privado</option>
		</select>
	</div>
</div>

<div class="col-md-2">
<div class="form-group">
		<label class="control-label" for="comercial">Comercial:</label>
		<? 

				// if ( $_SESSION['user'] == 'javier' || $_SESSION['user'] == 'shirley' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'daniel' || $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'margarita' )

				$q = 'SELECT c.id
			    FROM comerciales c, usuarios u
			    WHERE  c.id = u.id_comercial
			    AND user = "'.$_SESSION[user].'"';
			    // echo $q;
			    $q = mysqli_query($link, $q);

			    $row = mysqli_fetch_array($q);
			    $id = $row[id];

    		?>
			<select name="comercial" id="comercial" class="form-control" disabled>
				<option value="<? echo $_SESSION[user] ?>"><? echo $_SESSION[user] ?></option>
			</select>
			<input type="hidden" id="id_comercial" name="id_comercial" value="<? echo $id ?>" class="form-control" />
	</div>
</div>
<!-- <div class="col-md-5">
            <div class="cp form-group">
            <label class="control-label" for="razonsocial">Empresa:</label>
            <div class="input-group">
            	<span class="input-group-btn">
				<button id="anadirempresa" name="anadirempresa" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
				</span>
                <input type="text" id="razonsocial" name="razonsocial" class="form-control" />
                <span class="input-group-btn">
                    <button id="buscarempresa" name="buscarempresa" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
                </span>
                
            </div>
            </div>
            <input type="hidden" id="id_empresa" name="id_empresa" class="form-control" />
        </div>
 -->
<div class="col-md-4">	
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
        <label class="control-label" for="estado_peticion">Estado:</label>
        <select id="estado_peticion" name="estado_peticion" class="form-control" disabled>
			<option value="Pendiente">Pendiente</option>
			<option value="Realizada">Realizada</option>
			<option value="Anulada">Anulada</option>			
		</select>
    </div>
</div>


<div class="clearfix"></div>


<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="modalidad">Modalidad:</label>
		<select id="modalidad" name="modalidad" class="form-control">
			<option value="Presencial">Presencial</option>
			<option value="A Distancia">A Distancia</option>
			<option value="Teleformación">Teleformación</option>
			<option value="Mixta">Mixta</option>
		</select>
	</div>
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
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="horastotales">Horas Totales:</label>
		<input type="text" id="horastotales" name="horastotales" class="sum form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="numalumnos">Número de Alumnos:</label>
		<input type="text" id="numalumnos" name="numalumnos" class="sum form-control" />
	</div>
</div>
<div class="col-md-1">
	<div class="form-group">
		<label class="control-label" for="abierto">Abierta:</label>
		<select id="modalidad" name="modalidad" class="form-control">
			<option value="No">No</option>
			<option value="Si">Si</option>
		</select>
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="preciomatricula">Precio por matrícula:</label>
		<input type="text" id="preciomatricula" name="preciomatricula" class="sum form-control" />
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="presupuesto">Presupuesto total:</label>
		<input type="text" id="presupuesto" name="presupuesto" class="sum form-control" />
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
<div class="col-md-4">	
	<div class="cp form-group">
		<label class="control-label" for="nombrecentro">Lugar de Impartición:</label>
		<div class="input-group">
			<input type="text" id="nombrecentro" name="nombrecentro" class="form-control" />
			<span class="input-group-btn">
				<button id="buscarcentro" name="buscarcentro" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
		<input type="hidden" id="id_centro" name="id_centro" class="form-control" />
	</div>
</div>

<div class="clearfix"></div>


<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="empresas">Empresas Participantes:</label>
		<textarea name="empresas" id="empresas" class="form-control" rows="5"></textarea>
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="observaciones">Observaciones:</label>
		<textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
	</div>
</div>

<div class="clearfix"></div>


<input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
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

<div id="uploaderapp" class="col-md-12" style="text-align:center; display:none; margin-top:20px ">


	<div class="clearfix"></div>
	<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
	<form id="formparticipantessol" action="" method="post" enctype="multipart/form-data">
		<label> Tabla de participantes: </label><br>
		<input style="float:left" type="file" name="participantesol" id="participantesol" class="btn btn-default">
		<a id="subirtablasol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
		<a id="mostrartablasol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estatabla" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
	</form>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
	<form id="formaxenosol" action="" method="post" enctype="multipart/form-data">
		<label> Anexo: </label><br>
		<input style="float:left" type="file" name="anexosol" id="anexosol" class="btn btn-default">
		<a id="subiranexosol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
		<a id="mostraranexosol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estaanexo" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
	</form>
	</div>


	<div class="clearfix"></div>

	<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
	<form id="formmatriculasol" action="" method="post" enctype="multipart/form-data">
		<label> Matrícula: </label><br>
		<input style="float:left" type="file" name="matriculasol" id="matriculasol" class="btn btn-default">
		<a id="subirmatsol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
		<a id="mostrarmatsol" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estamat" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
	</form>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-6 col-md-offset-3" style="text-align:center">
	<a style=" margin-top: 10px " id="modeloexcel" class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Plantilla Excel </a>
	</div>


</div>



</div>

