<form class="formulariomatriculaini" id="formulario" role="form" action="" method="post">
<div style="margin-top: 45px" class="container">

	<ol class="breadcrumb">
      <li>Online-Distancia</li>
      <li>Matrículas Grupales</li>
      <li class="active">Inicio</li>
	</ol>

	<div style="display:none" id="confirmacion" class="alert alert-success">Matrícula creada correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>
	<input name="matricula" type="hidden" id="matricula" value="1" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
	<input name="externo" type="hidden" id="externo" value="" />

	<div class="col-md-8 btnmatriculas" style="float:left; min-height:70px; display:none; text-align: left">
		<a id="imprimirmat" style="float:none;" href="#" class="btn btn-sm btn-success">Imprimir Matrícula</a>
		<a id="diplomatd" style="display:none; float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-success">Diploma</a>
		<a id="guiadelalumno" style="display:none; float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-success">Guía del Alumno</a>
		<a id="informe-online" style="float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">Informe</a>
		<a id="xmlinicio" style="float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Inicio</a>
		<a id="xmlfin" style="float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">XML Finalización</a>
		<a id="btnsubidas" style="display:none; float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-warning">Notificaciones</a>
	</div>

	<div style="float:right; min-height:60px; margin-top: -5px"  class="col-md-2">
		<div class="form-group">
    		<label class="control-label" for="estado">Estado Matrícula:</label>
    		<select id="estado" name="estado" class="form-control" >
		    	<option value="Creada">Creada</option>
		    	<option value="Comunicada">Comunicada</option>
		    	<option value="Finalizada">Finalizada</option>
		    	<option value="Anulada">Anulada</option>
		    	<option value="Gratuita">Gratuita</option>
		    	<option value="Facturada">Facturada</option>
		    	<option value="Liquidada">Liquidada</option>
		   	</select>
		</div>
	</div>
<!-- 	<div style="float:right; min-height:60px; margin-top: -5px"  class="col-md-2">
		<div class="form-group">
    		<label class="control-label" for="comercial">Comercial: <span id="infocomercial" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Sólo si es distinto al comercial asignado a la empresa." style="font-size: 16px" class="glyphicon glyphicon-info-sign"></span></label>
    		<select id="comercial" name="comercial" class="form-control">
				<?
					$q = 'SELECT id,nombre,apellido,apellido2
	    			FROM comerciales ORDER by id ASC';
	    			$q = mysqli_query($link,$q);

					echo '<option value="0"> - </option>';
	    			while ($row = mysqli_fetch_array($q))
	    				echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].'</option>';
	    		?>
		   	</select>
		</div>
	</div>
 -->	<div class="clearfix"></div>


 <div class="clearfix"></div>

 	<fieldset>
     	<legend>Solicitud</legend>

     	<div class="col-md-2">
     	    <div class="form-group">
     	        <label class="control-label" for="tiposolicitud">Tipo Solicitud:</label>
     	        <select id="tiposolicitud" name="tiposolicitud" class="form-control" >
     				<option value="ESFOCC">EDUKA-TE</option>
     				<!-- <option value="IKEA">IKEA</option> -->
     			</select>
     	    </div>
     	</div>

     	<div class="col-md-9">
     	    <div class="cp form-group">
     	   			<label class="control-label" for="solicitud">Solicitud:</label>
     	   			<div class="input-group">
     			      	<input type="text" placeholder="Busqueda por denominación" id="solicitud" name="solicitud" class="form-control" />
     			      	<input type="hidden" id="id_solicitudikea" name="id_solicitudikea" class="form-control" />
     			      	<input  type="hidden" id="id_solicitud" name="id_solicitud" class="form-control" />
     			      	<span class="input-group-btn">
     			        	<button id="buscarsolicitud"  name="buscarsolicitud" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
     			      	</span>
     			    </div>
     	   	</div>
     	</div>

     	<div class="col-md-1" style="margin-top: 25px;">
     		<a href="#" id="desvincularsm" class="btn btn-default" style="display: inline-block; width: 100%">
     			<span class="glyphicon glyphicon-remove"></span>
     		</a>
     	</div>

     </fieldset>

         <div class="clearfix"></div>

     	<? if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'alago' ) { ?>
        	<div class="col-md-3">
     	   	<div class="form-group">
     		    <label class="control-label" for="grupo_dino">Grupo Dino:</label>
     		    <input type="text" id="grupo_dino" name="grupo_dino" class="form-control" />
     	    </div>
     	</div>
     	<? } ?>

     <div class="clearfix"></div>


	<fieldset>
		<legend>Datos de la Acción</legend>

		<div id="datosaccion" style="display:none">

			<div class="col-md-2">
		    	<div class="form-group">
				    <label class="control-label" for="numeroaccion">Número Acción:</label>
				    <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" readonly/>
			    </div>
			</div>
			<div class="col-md-5">
		    	<div class="form-group">
				    <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
				    <input type="text" id="denominacion" name="denominacion" class="form-control" readonly />
			    </div>
			</div>
			<div class="col-md-2">
		    	<div class="form-group">
				    <label class="control-label" for="horastotales">Horas Totales:</label>
				    <input type="text" id="horastotales" name="horastotales" class="sum form-control" disabled />
			    </div>
			</div>
			<div class="col-md-3">
		   		<div class="form-group">
		    		<label class="control-label" for="modalidad">Modalidad:</label>
				    <select id="modalidad" name="modalidad" class="form-control" disabled>
				    	<option value="Presencial">Presencial</option>
				    	<option value="A Distancia">A Distancia</option>
				    	<option value="Teleformación">Teleformación</option>
				    	<option value="Mixta">Mixta</option>
				   	</select>
		    	</div>
			</div>
			<div class="col-md-2">
		   		<div class="form-group">
		    		<label class="control-label" for="tipo_formacion">Tipo:</label>
				    <select id="tipo_formacion" name="tipo_formacion" class="form-control">
				    	<option value="">Selecciona</option>
				    	<option value="Bonificable">Bonificable</option>
				    	<option value="Privado">Privado</option>
				   	</select>
		    	</div>
			</div>
			<!-- <div class="col-md-2">
		    	<div class="checkbox">
			 		<label>
			   			<input type="checkbox" id="bonificable" name="bonificable" value="0" disabled>¿ Bonificable ?
			   		</label>
			   	</div>
			</div> -->
			<div class="col-md-2">
		    	<div class="form-group">
				    <label class="control-label" for="grupoformativo">Grupo Formativo:</label>
				    <input type="text" id="grupoformativo" name="grupoformativo" class="form-control" disabled />
			    </div>
			</div>
			<div class="col-md-4">
				<div class="form-group">
				    <label class="control-label" for="fechaini">Fecha Inicio:</label>
				    <input type="date" id="fechaini" name="fechaini" class="form-control" />
			    </div>
		   	</div>
		   	<div class="col-md-4">
				<div class="form-group">
				    <label class="control-label" for="fechafin">Fecha Fin:</label>
				    <input type="date" id="fechafin" name="fechafin" class="form-control" />
			    </div>
		   	</div>

		</div>


	</fieldset>

	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a href="#" data-toggle=modal name="acciones" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Acciones</a>
	    </div>
	</div>
	<div class="clearfix"></div>


<!-- 	<fieldset>
		<a href="#" data-toggle=modal id="btnalumnose" class="abrebusqueda btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Alumnos</a>
		<legend>Datos del Alumno</legend>


	<span class="fin_alumno"></span>
	</fieldset>
 -->
<!-- 	<div class="clearfix"></div>

	<div style="float:right; min-height: 30px;" class="col-md-2">
		<div class="form-group botones">
    		<a href="#" data-toggle=modal id="btnempresas" name="empresas" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Empresas</a>

		</div>
	</div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
		<div class="form-group botones">
    		<a href="#" data-toggle=modal id="btnalumnos" name="alumnos" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Alumnos</a>
		</div>
	</div>

	<div class="clearfix"></div> -->

	<fieldset>
	    <span id="tagdocentes"></span>
		<a style="display:none" href="#" data-toggle=modal id="btndocenteseditaro" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Docentes</a>

		<legend>Datos del Docente</legend>

		<div class="col-md-2 pull-right imparte">
			<div class="form-group">
	    		<label class="control-label" for="tipo_docente">Imparte:</label>
	    		<select id="tipo_docente" name="tipo_docente" class="form-control" >
			    	<option value="EDUKATE">EDUKATE</option>
			    	<option value="Externo">Externo</option>
			    	<option value="Propios">Propios</option>
			   	</select>
			</div>
		</div>


	<span class="fin_docente"></span>
	</fieldset>

	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a href="#" data-toggle=modal id="btndocentes" name="docentes" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Docentes</a>
	    </div>
	</div>
	<div class="clearfix"></div>

	<fieldset>
		<legend>Horarios de Tutoría</legend>

		<div id="datostutoria" style="display:none">
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariomini">Horario mañana (inicio):</label>
				    <input placeholder="09:00" type="text" id="horariomini" name="horariomini" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariomfin">Horario mañana (fin):</label>
				    <input placeholder="11:00" type="text" id="horariomfin" name="horariomfin" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariotini">Horario tarde (inicio):</label>
				    <input placeholder="16:00" type="text" id="horariotini" name="horariotini" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariotfin">Horario tarde (fin):</label>
				    <input placeholder="18:00" type="text" id="horariotfin" name="horariotfin" class="form-control" />
			    </div>
			</div>

			<div style="" class="ta col-md-5">
			   	<div class="form-group">
				    <label class="control-label" for="observaciones">Observaciones:</label>
				    <textarea name="observaciones" id="observaciones" class="form-control" rows="3"></textarea>
			    </div>
			</div>

			<div class="col-md-6">
					<label class="diasimp" for="diasimparticion">Días Impartición:</label>
				    <div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="L">L
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="M">M
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="X">X
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="J">J
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="V">V
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="S">S
				   		</label>
				   	</div>
				   	<div class="checkbox">
				 		<label>
				   			<input type="checkbox" class="selector" value="D">D
				   		</label>
				   	</div>
			</div>
			<div class="col-md-1">
				<div class="checkbox" style="margin-top: 33px;">
					<label>
						<input type="checkbox" class="marcasemana" value="LV">L-V
					</label>
				</div>
			</div>


	   	</div>

	<span class="fin_tutoria"></span>
	</fieldset>

	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a href="#" data-toggle=modal id="btntutorias" name="tutoria" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Tutoría</a>
	    </div>
	</div>
	<div class="clearfix"></div>

	<fieldset>
		<span id="tagempresas"></span>
		<a style="display:none" href="#" data-toggle=modal id="btnempresaseditaro" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Empresas</a>
		<legend id="empre">Empresas Participantes</legend>


	<span class="fin_empresa"></span>

	<div style="float:right; min-height: 30px; " class="col-md-2">
    	<div class="form-group botones">
	    	<a href="#" data-toggle=modal id="btnempresas-pre" name="empresas" class="btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Empresas</a>
	   	</div>
	</div>
	<div style="float:right; min-height: 30px; " class="col-md-2">
    	<div class="form-group botones">
	    	<a href="#" data-toggle=modal id="rltcif" name="empresas" class="btn btn-block btn-sm btn-default"><span class="glyphicon glyphicon-list-alt"></span> RLT</a>
	   	</div>
	</div>


	<div id="paraquitar" class="clearfix"></div>

	<div class="col-md-2" id="presupuestocuadro" style="display: none">
		<div class="form-group">
		    <label class="control-label" for="presupuesto">Presupuesto  <span id="infopresupuesto" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Presupuesto total estimado para el curso" style="font-size: 16px" class="glyphicon glyphicon-info-sign"></span></label>
		   	<input type="text" id="presupuesto" name="presupuesto" class="form-control" />
		</div>
	</div>
	</fieldset>

	<div class="clearfix"></div>

	<div class="clearfix"></div>

<!--

	<fieldset>
		<legend>Rentabilidad</legend>

		<div id="datosrentabilidad" style="display:none;">
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="precioventamat">Precio Venta (matrícula):</label>
				    <input type="text" id="precioventamat" name="precioventamat" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="alumnosestimados">Nº Alumnos (estimado):</label>
				    <input type="text" placeholder="25" id="alumnosestimados" name="alumnosestimados" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="totalingresos">Total INGRESOS:</label>
				    <input type="text" id="totalingresos" name="totalingresos" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="totalcostes">Total COSTES:</label>
				    <input type="text" id="totalcostes" name="totalcostes" class="form-control" />
			    </div>
			</div>

			<div class="col-md-2">
		  		<div class="cp form-group">
		   			<label class="control-label" for="costeaula">Coste Aula:</label>
		   			<div class="input-group">
				      	<input type="text" id="costeaula" name="costeaula" class="form-control" />
 				      	<span class="input-group-btn">
				        	<button id="abrircosteaula" name="abrircosteaula" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span></button>
				      	</span>
 				    </div>
		   		</div>
		   	</div>
		   	<div class="col-md-2">
		  		<div class="cp form-group">
		   			<label class="control-label" for="costedocente">Coste Docente:</label>
		   			<div class="input-group">
				      	<input type="text" id="costedocente" name="costedocente" class="form-control" />
				      	<span class="input-group-btn">
				        	<button id="abrircostedocente" name="abrircosteaula" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span></button>
				      	</span>
				    </div>
		   		</div>
		   	</div>
		   	<div class="col-md-2">
		  		<div class="cp form-group">
		   			<label class="control-label" for="fungibledidac">Fungible y Didáctico:</label>
		   			<div class="input-group">
				      	<input type="text" id="fungibledidac" name="fungibledidac" class="form-control" />
				      	<span class="input-group-btn">
				        	<button id="abrirfungibledidac" name="abrircosteaula" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span></button>
				      	</span>
				    </div>
		   		</div>
		   	</div>
		   	<div class="col-md-2">
		  		<div class="cp form-group">
		   			<label class="control-label" for="administracion">Administración:</label>
		   			<div class="input-group">
				      	<input type="text" id="administracion" name="administracion" class="form-control" />
 				      	<span class="input-group-btn">
				        	<button id="abriradministracion" name="abrircosteaula" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span></button>
				      	</span>
 				    </div>
		   		</div>
		   	</div>
		   	<div class="col-md-2">
		  		<div class="cp form-group">
		   			<label class="control-label" for="otrosgastos">Otros Gastos:</label>
		   			<div class="input-group">
				      	<input type="text" id="otrosgastos" name="otrosgastos" class="form-control" />
				      	<span class="input-group-btn">
				        	<button id="abrirotrosgastos" name="abrircosteaula" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span></button>
				      	</span>
				    </div>
		   		</div>
		   	</div>
		   	<div class="col-md-2">
				<a id="btncalculocostes" style="margin-top: 25px; width:100%" name="rentabilidad" class="btn btn-default"><span class="glyphicon glyphicon-euro"></span> Calcular Costes</a>
		   	</div>

		   	<div class="col-md-3 col-md-offset-2">
			   	<div class="form-group">
				    <label class="control-label" for="margenbeneficio">Margen de Beneficio:</label>
				    <input type="text" id="margenbeneficio" name="margenbeneficio" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="porcentajeventas">%s / Ventas:</label>
				    <input type="text" id="porcentajeventas" name="porcentajeventas" class="form-control" />
			    </div>
			</div>
			<div class="col-md-2">
				<a id="btncalculobeneficios" style="margin-top: 25px; width:100%" name="rentabilidad" class="btn btn-default"><span class="glyphicon glyphicon-euro"></span> Calcular Beneficio</a>
		   	</div>
		   	<div class="clearfix"></div>

		   	<div class="col-md-3 col-md-offset-2">
			   	<div class="form-group">
				    <label class="control-label" for="ventasrequerido">% Ventas Requerido:</label>
				    <input type="text" id="ventasrequerido" name="ventasrequerido" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="nalumnosnecesario">Número de Alumnos necesario:</label>
				    <input type="text" id="nalumnosnecesario" name="nalumnosnecesario" class="form-control" />
			    </div>
			</div>
			<div class="col-md-2">
				<a id="btncalculoalumnos" style="margin-top: 25px; width:100%" name="rentabilidad" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Calcular Alumnos</a>
		   	</div>
		   	<div class="clearfix"></div>

	   	</div>

	<span class="fin_renta"></span>
	</fieldset>
		
	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a id="btnrentabilidad" name="rentabilidad" class="btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Rentabilidad</a>
	    </div>
	</div>
	<div class="clearfix"></div>
-->
<!-- 			<div class="clearfix"></div>

		<fieldset>
			<legend>Centro Gestor Plataforma Teleformación ( si es distinto a ESFOCC )</legend>

			<input name="id_centro" type="hidden" id="id_centro" value="">
			<div id="datoscentro" style="display:none;">
				<div class="col-md-2">
					<div class="form-group">
			    		<label class="control-label" for="centronuevo">¿Centro Nuevo?</label>
					    <select id="centronuevo" name="centronuevo" class="form-control" >
					    	<option value="No">No</option>
					    	<option value="Sí">Sí</option>
					   	</select>
			    	</div>
				</div>
				<div class="col-md-5">
			  		<div class="cp form-group">
			   			<label class="control-label" for="nombrecentro">Nombre del Centro:</label>
			   			<div class="input-group">
					      	<input type="text" id="nombrecentro" name="nombrecentro" class="form-control" />
					      	<span class="input-group-btn">
					        	<button id="buscarcentro" name="buscarcentro" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					      	</span>
					    </div>
			   		</div>
			   	</div>
				<div class="col-md-5">
				   	<div class="form-group">
					    <label class="control-label" for="direccioncentro">Dirección del Centro:</label>
					    <input type="text" id="direccioncentro" name="direccioncentro" class="form-control" />
				    </div>
				</div>

				<div class="col-md-2">
				   	<div class="form-group">
					    <label class="control-label" for="costeaula">Coste:</label>
					    <input type="text" id="costeaula" name="costeaula" class="form-control" disabled/>
				    </div>
				</div> -->
<!-- 				<div class="clearfix"></div>
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
 -->
			   	<!-- <div style="" id="observacionescuadro" class="ta col-md-12">
					<div class="form-group">
						<label class="control-label" for="observaciones">Observaciones:</label>
						<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
				   </div>
				</div> -->


<!-- 		   	</div>

		<span class="fin_tutoria"></span>
		</fieldset>

		<div class="clearfix"></div>
		<div style="float:right; min-height: 30px;" class="col-md-2">
	    	<div class="form-group botones">
			    <a href="#" data-toggle=modal id="btncentro" name="centros" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Centro</a>
		    </div>
		</div>
 -->		<div class="clearfix"></div>

	<div id="cuadrocostes" style="display:none;">
	<fieldset>
		<legend>Costes</legend>


		<div id="datoscostes" style="display: none;">
		<input type="hidden" name="id_coste" id="id_coste" value="0" />
		<div class="col-md-8">
		    	<div class="form-group">
				    <label class="control-label" for="empresacostes">Empresa:</label>
				    <input type="text" id="empresacostes" name="empresacostes" class="form-control" disabled/>
			    </div>
		</div>
		<div class="col-md-2">
		    	<div class="form-group">
				    <label class="control-label" for="costes_imparticion">Costes Impartición:</label>
				    <input type="text" id="costes_imparticion" name="costes_imparticion" class="form-control" />
			    </div>
		</div>
		<div class="col-md-2">
		    	<div class="form-group">
				    <label class="control-label" for="porcentaje_cof">% Cofinanciación:</label>
				    <input type="text" id="porcentaje_cof" name="porcentaje_cof" class="form-control" disabled/>
			    </div>
		</div>
		<div class="col-md-3">
		   		<div class="form-group">
		    		<label class="control-label" for="metodo">Método Cálculo:</label>
				    <select id="metodo" name="metodo" class="form-control" >
				    	<option value="m1">Salario mínimo</option>
				    	<option value="m2">Salarios medios</option>
				   	</select>
		    	</div>
		</div>
		<div class="col-md-3">
		    	<div class="form-group">
				    <label class="control-label" for="costes_salariales">Costes Salariales:</label>
				    <input type="text" id="costes_salariales" name="costes_salariales" class="form-control" />
			    </div>
		</div>
		<div class="col-md-3">
  		<div class="cp form-group">
   			<label class="control-label" for="maximo_bonificable">Máximo Bonificable:</label>
   			<div class="input-group">
		      	<input type="text" id="maximo_bonificable" name="maximo_bonificable" class="form-control" readonly>
		      	<span class="input-group-btn">
		        	<a id="btnCalculoMax" name="btnCalculoMax" class="btn btn-default"><span class="glyphicon glyphicon-euro"></span></a>
		      	</span>
		    </div>
   		</div>
   		</div>
		<div class="col-md-3">
		   		<div class="form-group">
		    		<label class="control-label" for="mes_bonificable">Meses Bonificables:</label>
				    <select id="mes_bonificable" name="mes_bonificable" class="form-control" >
				    	<option value="1">Enero</option>
				    	<option value="2">Febrero</option>
				    	<option value="3">Marzo</option>
				    	<option value="4">Abril</option>
				    	<option value="5">Mayo</option>
				    	<option value="6">Junio</option>
				    	<option value="7">Julio</option>
				    	<option value="8">Agosto</option>
				    	<option value="9">Septiembre</option>
				    	<option value="10">Octubre</option>
				    	<option value="11">Noviembre</option>
				    	<option value="12">Diciembre</option>
				   	</select>
		    	</div>
		</div>

		<a id="guardarcostes" style="margin-left: 15px;" href="#" class="btn btn-sm btn-success"> Guardar Costes</a>
		</div>

	<span class="fin_costes"></span>
    </fieldset>


    <div class="clearfix"></div>
    <div style="float:right; min-height: 30px;" class="col-md-2">
        <div class="form-group botones">
            <a href="#" data-toggle=modal id="btncostes" name="mat_costes" class="btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Costes</a>
        </div>
    </div>
    </div>

    	<div class="clearfix"></div>


	<div class="col-md-6 center-block btnmatriculas" style="min-height:70px;">
		<input type="submit" name="submit" value="Guardar Matrícula" class="btn btn-primary btn-lg">
		<a id="abrebusqueda" href="#" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Matrículas</a><br>
		<a id="xmlinicio_o" style="float:none; display: none; margin:15px 0 30px 0;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-info">XML Inicio</a>

	</div>

	<div class="clearfix"></div>

</div>
</form>
<input type="hidden" id="fungibleitems" name="fungibleitems" class="form-control" />
<input type="hidden" id="otrosgastositems" name="otrosgastositems" class="form-control" />