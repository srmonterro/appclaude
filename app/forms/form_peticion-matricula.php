
<? session_start(); ?>
<div style="margin-top: 30px" class="container" id="solicitudes">


<div style="display:none" id="confirmacion" class="alert alert-success">Petición realizada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger"></div>


	<ol class="breadcrumb">
      <li>Comerciales</li>
      <li class="active">Solicitudes</li>
	</ol>

	<div class="col-md-2" style="margin-bottom: 25px">
	<div class="form-group">
		<label class="control-label" for="tiposol">Tipo de Solicitud:</label>
		<select id="tiposol" name="tiposol" class="form-control">
			<option value="SM">Matrícula</option>
			<option value="SP">Propuesta</option>
			<? if ( !esExterno($_SESSION[user]) ) { ?>
			<option value="SC">Crédito</option>
			<? } ?>
		</select>
	</div>
	</div>


<div class="clearfix"></div>


<div class="bloquemat">

<form class="formulariosolmat" id="formulario" action="" method="post">

	<input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
	<input name="tiposol" type="hidden" id="tiposol" value="SM" />
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
	<input type="hidden" id="id_comercial" name="id_comercial" class="form-control" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->

	<div class="col-md-2 pull-right" style="margin-top: -80px">
		<a id="imprimirsm" style="width:100%;" href="#" class="btn btn-sm btn-success">Imprimir SM</a>
	</div>

	<div class="clearfix"></div>

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
				<span class="input-group-addon">SM</span>
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
		<!-- <input type="hidden" id="id_accion" name="id_accion" class="form-control"  /> -->
	</div>

	<?

		//if ( $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'ytejera' || $_SESSION['user'] == 'ysuarez' || $_SESSION['user'] == 'root' )
		if ( $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'ysuarez' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'cristina' || $_SESSION['user'] == 'ctosco' || $_SESSION['user'] == 'asantana')
		$perms = '';
		else
		$perms = 'disabled';

	?>
	<div class="col-md-2">
	    	<div class="form-group">
	        <label class="control-label" for="estado_peticion">Estado:</label>
	        <select id="estado_peticion" name="estado_peticion" class="form-control" >
				<option value="Pendiente">Pendiente</option>
				<option <? echo $perms; ?> value="Aceptada">Aceptada</option>
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
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="horasdistancia">Horas Dist. / Online:</label>
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
			<label class="control-label" for="horario">Horario:</label>
			<input type="text" id="horario" name="horario" class="sum form-control" />
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group">
			<label class="control-label" for="numalumnos">NºAlus:</label>
			<input type="text" id="numalumnos" name="numalumnos" class="sum form-control" />
		</div>
	</div>
	<div class="col-md-1">
		<div class="form-group">
			<label class="control-label" for="abierto">Abierto:</label>
			<select id="abierto" name="abierto" class="form-control">
				<option value="No">No</option>
				<option value="Si">Si</option>
			</select>
		</div>
	</div>


	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="preciomatricula">Precio por alumno:</label>
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
			<span id="fechabonif" for="fechaini" class="help-block"></span>
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
				<input type="text" id="nombrecentro" name="nombrecentro" class="required form-control" />
				<span class="input-group-btn">
					<button id="buscarcentro" name="buscarcentro" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
				</span>
			</div>
			<input type="hidden" id="id_centro" name="id_centro" class="form-control" />
		</div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label" for="formapagocred">Forma de Pago:</label>
			<select id="formapagocred" name="formapagocred" class="form-control" >
				<option value="Transferencia">Transferencia</option>
				<option value="Remesa">Remesa</option>
				<option value="Cheque">Cheque</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
		</div>
	</div>

	<div id="campoiban" class="col-md-8">
		<div class="form-group">
			<label class="control-label" for="iban">IBAN / CCC:</label>
			<input type="text" id="iban" name="iban" class="form-control" />
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
			<label class="control-label" for="observaciones">Observaciones Comercial:</label>
			<textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observacionesgestor">Observaciones Gestor:</label>
			<textarea name="observacionesgestor" id="observacionesgestor" class="form-control" rows="5"></textarea>
		</div>
		<!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
	</div>

	<div class="clearfix"></div>

	<p style="text-align: center; margin-top: 30px;">
	<input type="submit" name="submit" value="Enviar Solicitud" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
	<a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
	</p>

</form>


	<div id="uploaderapp" class="col-md-12" style="display:none">
		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formparticipantessolb" action="" method="post" enctype="multipart/form-data">
			<label> Tabla de participantes Bonif.: </label><br>
			<input style="float:left" type="file" name="participantesolb" id="participantesolb" class="btn btn-default">
			<a id="subirtablasolb" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel </a>
			<a id="mostrartablasolb" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estatablab" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formparticipantessolp" action="" method="post" enctype="multipart/form-data">
			<label> Tabla de participantes Priv.: </label><br>
			<input style="float:left" type="file" name="participantesolp" id="participantesolp" class="btn btn-default">
			<a id="subirtablasolp" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel </a>
			<a id="mostrartablasolp" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estatablap" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

		<div class="clearfix"></div>

			<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formaxenosol" action="" method="post" enctype="multipart/form-data">
			<label> Anexo: </label><br>
			<input style="float:left" type="file" name="anexosol" id="anexosol" class="btn btn-default">
			<a id="subiranexosol" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostraranexosol" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estaanexo" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>




		<div class="clearfix"></div>

		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formmatriculasol" action="" method="post" enctype="multipart/form-data">
			<label> Matrícula: </label><br>
			<input style="float:left" type="file" name="matriculasol" id="matriculasol" class="btn btn-default">
			<a id="subirmatsol" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostrarmatsol" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estamat" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px; ">
		<form id="formrecibosol" action="" method="post" enctype="multipart/form-data">
			<label> Justificante de pago: </label><br>
			<input style="float:left" type="file" name="recibosol" id="recibosol" class="btn btn-default">
			<a id="subirrecibosol" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostrarrecibosol" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estarecibo" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

	</div>



</div>



<div class="bloqueprop" style="display:none">

	<form class="formulariosolprop" id="formulario" action="" method="post">

	<input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
	<input name="tiposol" type="hidden" id="tiposol" value="SP" />
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
	<input type="hidden" id="id_comercial" name="id_comercial" class="form-control" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


	<div class="clearfix"></div>


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
				<span class="input-group-addon">SP</span>
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
	</div>

	<?

		//if ( $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'ytejera' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'ysuarez' )
		if ( $_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'root' || $_SESSION['user'] == 'ysuarez' || $_SESSION['user'] == 'ctosco' || $_SESSION['user'] == 'asantana')
		$perms = '';
		else
		$perms = 'disabled';

	?>
	<div class="col-md-2">
	    	<div class="form-group">
	        <label class="control-label" for="estado_peticion">Estado:</label>
	        <select id="estado_peticion" name="estado_peticion" class="form-control">
				<option value="Pendiente">Pendiente</option>
				<option <? echo $perms ?> value="Realizada">Realizada</option>
				<option value="Aceptada">Aceptada</option>
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
			<label class="control-label" for="abierto">Abierto:</label>
			<select id="abierto" name="abierto" class="form-control">
				<option value="No">No</option>
				<option value="Si">Si</option>
			</select>
		</div>
	</div>


	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="preciomatricula">Precio por alumno:</label>
			<input type="text" id="preciomatricula" name="preciomatricula" class="sum form-control" />
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="fechaini">Fecha Inicio:</label>
			<input type="date" id="fechaini" name="fechaini" class="form-control" />
			<span id="fechabonif" for="fechaini" class="help-block"></span>
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
			<label class="control-label" for="nombrecentro">Lugar de Impartición:</label>
			<div class="input-group">
				<input type="text" id="nombrecentro" name="nombrecentro" class="required form-control" />
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
			<label class="control-label" for="presupuesto">Presupuesto total:</label>
			<textarea type="text" id="presupuesto" name="presupuesto" class="sum form-control" rows="5" <? if ( $_SESSION[user] == 'ysuarez' || $_SESSION[user] == 'javier' || $_SESSION['user'] == 'ctosco' || $_SESSION['user'] == 'asantana') echo 'required'; ?> /></textarea>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="empresas">Empresas Participantes:</label>
			<textarea name="empresas" id="empresas" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observaciones">Observaciones Comercial:</label>
			<textarea name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
			<input type="hidden" id="observpropuesta" value="0" />
		</div>
	</div>
	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observacionesgestor">Observaciones Gestor:</label>
			<textarea name="observacionesgestor" id="observacionesgestor" class="form-control" rows="5"></textarea>
		</div>
		<input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" />
	</div>
	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="objetivos">Objetivos:</label>
			<textarea name="objetivos" id="objetivos" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="contenidos">Contenidos:</label>
			<textarea name="contenidos" id="contenidos" class="form-control" rows="5"></textarea>
		</div>
	</div>


	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="textobonificable">Texto Bonificable/Privado:</label>
			<?

			if ( $_SESSION['user'] == 'oscar' || $_SESSION['user'] == 'isabel' || $_SESSION['user'] == 'amparo' )
				$textobonificable = 'Es 100% bonificable para aquellas empresas que dispongan el crédito asignado para la formación establecido por la Fundación Estatal para la Formación en el Empleo y estén al corriente de la seguridad social.<br><b>* EN EL CASO DE ASISTIR MENOS ALUMNOS DEL GRUPO MÍNIMO ESTABLECIDO EN LA PROPUESTA, EL RESTO DEL IMPORTE POR LA FORMACIÓN SE ABONARÁ DE FORMA PRIVADA.</b>';
			else
				$textobonificable = 'Es 100% bonificable para aquellas empresas que dispongan el crédito asignado para la formación establecido por la Fundación Estatal para la Formación en el Empleo y estén al corriente de la seguridad social.';

			?>

			<textarea <? if ( $_SESSION[user] != 'root' && $_SESSION[user] != 'ysuarez' && $_SESSION[user] != 'ctosco' && $_SESSION[user] != 'asantana') echo "readonly" ?> name="textobonificable" id="textobonificable" class="form-control" rows="3"><? echo $textobonificable ?></textarea>

		</div>
	</div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="requisitosbonificacion">Requisitos Bonificación:</label>
			<textarea <? if ( $_SESSION[user] != 'root' && $_SESSION[user] != 'ysuarez' && $_SESSION[user] != 'ctosco' && $_SESSION[user] != 'asantana') echo "readonly" ?> name="requisitosbonificacion" id="requisitosbonificacion" class="form-control" rows="3"></textarea>

		</div>
	</div>


	<div class="clearfix"></div>


	<div id="marga-prop" <? if ( $_SESSION[user] != 'root' && $_SESSION[user] != 'ysuarez' && $_SESSION[user] != 'javier' && $_SESSION[user] != 'ctosco' && $_SESSION[user] != 'asantana') echo 'style="display:none"' ?> >


		<div class="col-md-10">
			<div class="form-group">
				<label class="control-label" for="empresareal">Nombre Empresa:</label>
				<input type="text" id="empresareal" name="empresareal" class="sum form-control" />
			</div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="ESSSCAN">ESSSCAN:</label>
				<select id="ESSSCAN" name="ESSSCAN" class="form-control">
					<option value="No">No</option>
					<option value="Si">Si</option>
				</select>
			</div>
		</div>


		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="metodologianum">Escoge Metodología:</label>
				<select id="metodologianum" name="metodologianum" class="form-control">
					<option value="">Selecciona</option>
					<option value="Presencial">Presencial</option>
					<option value="Presenciali">Presencial Idiomas</option>
					<option value="Habilidades">Habilidades</option>
					<option value="Teleformación">Teleformación</option>
					<option value="DESA">Cursos DESA</option>
				</select>
			</div>
		</div>

		<div class="col-md-9" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="metodologia">Metodología:</label>
			<textarea name="metodologia" id="metodologia" class="form-control" rows="8">
			</textarea>
		</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="presufrase">Alumnos:</label>
			<input placeholder="El coste para la acción formativa con una duración de X horas [...] es:" type="text" name="presufrase" id="presufrase" class="form-control" />
		</div>
		</div>


		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="incluyenum">Escoge Incluye:</label>
				<select id="incluyenum" name="incluyenum" class="form-control">
					<option value="">Selecciona</option>
					<option value="Bonificado">Bonificado</option>
					<option value="BonificadoE">Bonificado ESSSCAN</option>
					<option value="Teleformación">Teleformación</option>
					<option value="Privado">Privado</option>
				</select>
			</div>
		</div>

		<div class="col-md-9" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="incluye">Incluye:</label>
			<textarea name="incluye" id="incluye" class="form-control" rows="5">
			</textarea>
		</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="tablaprecios">Tabla de Precios (Contra Incendios):</label>
				<select id="tablaprecios" name="tablaprecios" class="form-control">
					<option value="Nada">Nada</option>
					<option value="I">I</option>
					<option value="II">II</option>
					<option value="Ambos">Ambos</option>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

		<? if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'ysuarez' || $_SESSION[user] == 'javier' || $_SESSION[user] == 'ctosco' || $_SESSION[user] == 'asantana') { ?>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="fecha_firma">Fecha Firma:</label>
				<input type="date" id="fecha_firma" name="fecha_firma" class="form-control" />
				<span id="fechabonif" for="fechaini" class="help-block"></span>
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="fecha_aceptacion">Fecha Aceptación:</label>
				<input type="date" id="fecha_aceptacion" name="fecha_aceptacion" class="form-control" />
			</div>
		</div>

		<? } ?>

	</div>


	<div class="clearfix"></div>

	<p style="text-align: center; margin-top: 30px;">
	<input type="submit" name="submitx" value="Enviar Solicitud" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a>
	<? if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'ysuarez' || $_SESSION[user] == 'amanda' || $_SESSION[user] == 'cristina' || $_SESSION[user] == 'ctosco' || $_SESSION[user] == 'asantana' ) { ?>
	<a id="exportar_propuesta" idprop="" style="display" href="#" data-toggle=modal class="btn btn-lg btn-success">Exportar a PDF</a>
	<input type="hidden" id="exportar" value="0" disabled />
	<a id="duplicar_propuesta" idprop="" style="display" href="#" data-toggle=modal class="btn btn-lg btn-success">Duplicar</a><? } ?>
	<a id="duplicar_propuesta_mat" idprop="" style="" href="#" data-toggle=modal class="btn btn-lg btn-success">Solicitud de Matrícula</a>

	</p>

	</form>

	<div class="clearfix"></div>

	<div class="propuestafirmada col-md-7 col-md-offset-3" style="display:none;margin-bottom: 15px">
	<form id="pdfpropuestafirmada" action="" method="post" enctype="multipart/form-data">
		<label> Propuesta Firmada: </label><br>
		<input style="float:left" type="file" name="propuestafirmada" id="propuestafirmada" class="btn btn-default">
		<a id="subirpdfpropuestafirmada" id_propuesta="" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
		<a id="mostrarpdfpropuestafirmada" id_propuesta="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a>
	</form>
	</div>


</div>


<div class="clearfix"></div>


<div class="bloquecred" style="display:none">

	<form class="formulariosolcred" id="formulario" action="" method="post">

	<input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
	<input name="tiposol" type="hidden" id="tiposol" value="SC" />
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
	<!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


	<div class="clearfix"></div>


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
				<span class="input-group-addon">SC</span>
					<input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
			</div>

		</div>
	</div>

	<div class="col-md-2">
	<div class="form-group">
			<label class="control-label" for="comercial">Comercial:</label>
			<?
					if ( $_SESSION[user] == 'melody' )
						$q = 'SELECT c.id
					    FROM comerciales c
					    WHERE c.id = 1';
					else
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
					<option value="<? echo $_SESSION[user] ?>"</option>
				</select>
				<input type="hidden" id="id_comercial" name="id_comercial" value="<? echo $id ?>" class="form-control" />
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="cif">CIF:</label>
			<input type="text" id="cif" name="cif" style="" class="sum form-control" />
		</div>
	</div>

	<div class="col-md-4">
   		<div class="form-group">
		    <label class="control-label" for="comisionistatxt">Comisionista:</label>
		    <div class="input-group">
		    	<input placeholder="Búsqueda por nombre" id="comisionistatxt" name="comisionistatxt" class="form-control" />
		  	    <span class="input-group-btn">
			        <a id="buscarcomisionista" class="btn btn-default"><span id="buscarcomisionista" class="glyphicon glyphicon-search"></span></a>
			    </span>
		    </div>
	        <input type="hidden" id="comisionista" name="comisionista" class="form-control" />
    </div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="estado_peticion">Estado:</label>
				<select name="estado_peticion" id="estado_peticion" class="form-control" <? if ( $_SESSION[user] != 'amanda' && $_SESSION[user] != 'root' && $_SESSION[user] != 'ytejera' ) echo 'disabled' ?> >
					<option value="Pendiente">Pendiente</option>
					<option value="Resuelta">Resuelta</option>
					<option value="Anulada">Anulada</option>
				</select>
		</div>
	</div>

<!-- 	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label" for="formapagocred">Forma de Pago:</label>
			<select id="formapagocred" name="formapagocred" class="form-control required" >
				<option value="Remesa">Remesa</option>
				<option value="Cheque">Cheque</option>
				<option value="Transferencia">Transferencia</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
		</div>
	</div>

	<div id="campoiban" class="col-md-8">
		<div class="form-group">
			<label class="control-label" for="iban">IBAN / CCC:</label>
			<input type="text" id="iban" name="iban" class="form-control"  />
		</div>
	</div>
 -->
	<div class="clearfix"></div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observaciones">Observaciones:</label>
			<textarea placeholder="Observaciones para Amanda. Incluir email y tlf de la empresa." name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observacionesgestor">Observaciones Amanda:</label>
			<textarea placeholder="Observaciones de Amanda." name="observacionesgestor" id="observacionesgestor" class="form-control" rows="5"></textarea>
		</div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
	</div>

	<div class="clearfix"></div>

	<p style="text-align: center; margin-top: 30px;">
	<input type="submit" name="submity" value="Enviar Solicitud" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
	<a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
	</p>

</form>


		<div class="clearfix"></div>

		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formaxenosol-est" action="" method="post" enctype="multipart/form-data">
			<label> Anexo ESFOCC: </label><br>
			<input style="float:left" type="file" name="anexosol-esf" id="anexosol-esf" class="btn btn-default">
			<a id="subiranexosol-esf" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostraranexosol-esf" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estaanexo-esf" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
		<form id="formaxenosol-est" action="" method="post" enctype="multipart/form-data">
			<label> Anexo ESTRATEGIAS: </label><br>
			<input style="float:left" type="file" name="anexosol-est" id="anexosol-est" class="btn btn-default">
			<a id="subiranexosol-est" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostraranexosol-est" style="" numero="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span id="estaanexo-est" style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form>
		</div>

		<div class="clearfix"></div>



</div>

<div class="clearfix"></div>


<div class="bloquemailing" style="display:none">

	<form class="formulariosolmailing" id="formulario" action="" method="post">

	<input name="tabla" type="hidden" id="tabla" value="peticiones_formativas" />
	<input name="tiposol" type="hidden" id="tiposol" value="SE" />
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
	<!-- <input type="hidden" id="id_comercial" name="id_comercial" class="form-control" /> -->
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


	<div class="clearfix"></div>


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
				<span class="input-group-addon">SC</span>
					<input type="text" id="numero" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numero" class="form-control" readonly />
			</div>

		</div>
	</div>

	<div class="col-md-2">
	<div class="form-group">
			<label class="control-label" for="comercial">Comercial:</label>
			<?
					if ( $_SESSION[user] == 'melody' )
						$q = 'SELECT c.id
					    FROM comerciales c
					    WHERE c.id = 1';
					else
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
					<option value="<? echo $_SESSION[user] ?>"</option>
				</select>
				<input type="hidden" id="id_comercial" name="id_comercial" value="<? echo $id ?>" class="form-control" />
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="cif">CIF:</label>
			<input type="text" id="cif" name="cif" style="" class="sum form-control" />
		</div>
	</div>

	<div class="col-md-4">
   		<div class="form-group">
		    <label class="control-label" for="comisionistatxt">Comisionista:</label>
		    <div class="input-group">
		    	<input placeholder="Búsqueda por nombre" id="comisionistatxt" name="comisionistatxt" class="form-control" />
		  	    <span class="input-group-btn">
			        <a id="buscarcomisionista" class="btn btn-default"><span id="buscarcomisionista" class="glyphicon glyphicon-search"></span></a>
			    </span>
		    </div>
	        <input type="hidden" id="comisionista" name="comisionista" class="form-control" />
    </div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="estado_peticion">Estado:</label>
				<select name="estado_peticion" id="estado_peticion" class="form-control" <? if ( $_SESSION[user] != 'amanda' && $_SESSION[user] != 'root' && $_SESSION[user] != 'ytejera' ) echo 'disabled' ?> >
					<option value="Pendiente">Pendiente</option>
					<option value="Resuelta">Resuelta</option>
					<option value="Anulada">Anulada</option>
				</select>
		</div>
	</div>

<!-- 	<div class="col-md-4">
		<div class="form-group">
			<label class="control-label" for="formapagocred">Forma de Pago:</label>
			<select id="formapagocred" name="formapagocred" class="form-control" required>
				<option value="Remesa">Remesa</option>
				<option value="Cheque">Cheque</option>
				<option value="Transferencia">Transferencia</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
		</div>
	</div>

	<div id="campoiban" class="col-md-8">
		<div class="form-group">
			<label class="control-label" for="iban">IBAN / CCC:</label>
			<input type="text" id="iban" name="iban" class="form-control" required />
		</div>
	</div>
 -->
	<div class="clearfix"></div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observaciones">Observaciones:</label>
			<textarea placeholder="Observaciones para Amanda. Incluir email y tlf de la empresa." name="observaciones" id="observaciones" class="form-control" rows="5"></textarea>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-12" style="margin-bottom: 15px">
		<div class="form-group">
			<label class="control-label" for="observacionesgestor">Observaciones Amanda:</label>
			<textarea placeholder="Observaciones de Amanda." name="observacionesgestor" id="observacionesgestor" class="form-control" rows="5"></textarea>
		</div>
        <!-- <input type="hidden" id="observgestor" name="observgestor" class="form-control" value="0" /> -->
	</div>

	<div class="clearfix"></div>

	<p style="text-align: center; margin-top: 30px;">
	<input type="submit" name="submity" value="Enviar Solicitud" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Solicitud</a><br>
	<a id="xmlaccion" style="float:none; display:none; margin-top: 10px; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Acción</a>
	</p>

</form>



		<div class="clearfix"></div>



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





<!-- <div id="uploaderapp" class="col-md-12" style="text-align:center; display:none; margin-top:20px ">


	<div class="clearfix"></div>
	<div class="col-md-8 col-md-offset-2" style="margin-bottom: 15px">
	<form id="formparticipantessol" action="" method="post" enctype="multipart/form-data">
		<label> Tabla de participantes: </label><br>
		<input style="float:left" type="file" name="participantesol" id="participantesol" class="btn btn-default">
		<a id="subirtablasol" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir Excel </a>
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
 -->


</div>

