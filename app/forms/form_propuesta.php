

<form class="formulariopropuesta" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

<div style="display:none" id="confirmacion" class="alert alert-success">Propuesta realizada correctamente.</div>
<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>

	
<fieldset>
	<legend>Datos Petición</legend>

	<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="numsolicitud">Nº Solicitud:</label>
		<div class="input-group">
			<span class="input-group-addon">S</span>
				<input type="text" id="numsolicitud" value="<? echo str_pad($max, 4, '0', STR_PAD_LEFT) ?>" name="numsolicitud" class="form-control" readonly />			
		</div>
		
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
<div class="col-md-6" id="camposolicitud">	
	<div class="cp form-group">
		<label class="control-label" for="solicitud">Buscar solicitud por acción:</label>
		<div class="input-group">
			<input type="text" id="solicitud" name="solicitud" class="form-control" />
			<span class="input-group-btn">
				<button id="buscarsolicitud" name="buscarsolicitud" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
	</div>
	<input type="hidden" id="id_accion" name="id_accion" class="form-control" />
</div>


<div class="clearfix"></div>

</fieldset>

<fieldset>
	<legend>Datos Propuesta</legend>


<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="numero">Nº Propuesta:</label>

		<? 
			$q = 'SELECT max(numero) as maximo
    		FROM propuestas_formativas';
    		$q = mysqli_query($link, $q);

    		$row = mysqli_fetch_array($q);
    		$max = $row[maximo]+1;
		?>

		<div class="input-group">
			<span class="input-group-addon">P</span>
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
			<option value="Privada">Privada</option>
		</select>
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="id_comercial">Comercial:</label>
		<select name="id_comercial" id="id_comercial" class="form-control">
		<? 
				
				$q = 'SELECT c.id, c.nombre
			    FROM comerciales c
			    ORDER BY id ASC';
			    $q = mysqli_query($link, $q);
			    
			    while ( $row = mysqli_fetch_array($q) )
			    	echo '<option value="'.$row[id].'">'.$row[nombre].'</option>';

    		?>				
			</select>
			<!-- <input type="hidden" id="id_comercial" name="id_comercial" value="<? echo $id ?>" class="form-control" /> -->
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
<div class="col-md-6">	
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
		<label class="control-label" for="horastotales">Horas Totales:</label>
		<input type="text" id="horastotales" name="horastotales" class="sum form-control" />
	</div>
</div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="numalumnos">Nº Alumnos:</label>
		<input type="text" id="numalumnos" name="numalumnos" class="sum form-control" />
	</div>
</div>
<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="presupuesto">Presupuesto:</label>
		<input type="text" id="presupuesto" name="presupuesto" class="sum form-control" />
	</div>
</div>
<div class="col-md-2">
    	<div class="form-group">
        <label class="control-label" for="fecha_firma">Fecha Firma:</label>
        <input type="date" id="fecha_firma" name="fecha_firma" class="form-control" />
    </div>
</div>
<div class="col-md-2">
    	<div class="form-group">
        <label class="control-label" for="estado_propuesta">Estado:</label>
        <select id="estado_propuesta" name="estado_propuesta" class="form-control">
			<option value="Pendiente">Pendiente</option>
			<option value="Aceptada">Aceptada</option>
			<option value="Rechazada">Rechazada</option>
			<option value="Revisada">Revisada</option>
		</select>
    </div>
</div>


<div class="clearfix"></div>

<div class="col-md-2">
	<div class="form-group">
		<label class="control-label" for="tablaprecios">Tabla de Precios:</label>
		<select id="tablaprecios" name="tablaprecios" class="form-control">
			<option value="No">No</option>
			<option value="Si">Si</option>
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


<div class="col-md-12">	
	<div class="cp form-group">
		<label class="control-label" for="razonsocial">Empresa:</label>
		<div class="input-group">
			<input type="text" id="razonsocial" name="razonsocial" class="form-control" />
			<span class="input-group-btn">
				<button id="buscarempresa" name="buscarempresa" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
			</span>
		</div>
		<input type="hidden" id="id_empresa" name="id_empresa" class="form-control" />
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="observaciones">Observaciones:</label>
		<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
	</div>
</div>

<div class="clearfix"></div>

<fieldset>
	<legend>Contenido Propuesta</legend>
</fieldset>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="objetivos">Objetivos:</label>
		<textarea name="objetivos" id="objetivos" class="form-control" rows="4"></textarea>
	</div>
</div>

<div class="col-md-12" style="margin-bottom: 15px">
	<div class="form-group">
		<label class="control-label" for="contenido">Contenido:</label>
		<textarea name="contenido" id="contenido" class="form-control" rows="4"></textarea>
	</div>
</div>
</fieldset>

</div>
<input name="tabla" type="hidden" id="tabla" value="propuestas_formativas" />
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

<p style="text-align: center; margin: 30px 0 50px 0;">
	<input type="submit" name="submit" value="Guardar propuesta" class="btn btn-primary btn-lg">
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Propuestas</a>
	<a id="exportar_propuesta" idprop="" style="display:none" href="#" data-toggle=modal class="btn btn-lg btn-success">Exportar a PDF</a>
</p>

</form>

