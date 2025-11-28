
<form class="formulariopresencial" id="formulario" role="form" action="" method="post">
<div style="margin-top: 45px" class="container">

	<div style="display:none" id="confirmacion" class="alert alert-success">Matrícula creada correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Acción introducido ya existe en la base de datos.</div>
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
	<input name="externo" type="hidden" id="externo" value="" />

	<input name="id_temp" type="hidden" id="id_temp" value="" />

	<ol class="breadcrumb">
      <li>Presencial</li>
      <li class="active">Inicio</li>
    </ol>

	<div id="formacionikea" style="float:left; display:none; min-height:60px;" class="col-md-2">
		<img style="width: 40%; margin-top: 10px;" src="img/ikea_menu.png">
	</div>

	<div style="float:right; min-height:60px;"  class="col-md-2">
		<div class="form-group">
    		<label class="control-label" for="estado">Estado Matrícula:</label>
    		<select id="estado" name="estado" class="form-control" >
		    	<option value="Creada">Creada</option>
		    	<option value="Comunicada">Comunicada</option>
		    	<option value="Finalizada">Finalizada</option>
		    	<option value="Anulada">Anulada</option>
		    	<option value="Facturada">Facturada</option>
		    	<option value="Gratuita">Gratuita</option>
				<option value="Liquidada">Liquidada</option>
		   	</select>
		</div>
	</div>
<!-- 	<div style="float:right; min-height:60px; margin-top: -5px"  class="col-md-2">
		<div class="form-group">
    		<label class="control-label" for="comercial">Comercial: <span id="infocomercial" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Sólo si es distinto al comercial asignado a la empresa." style="font-size: 16px" class="glyphicon glyphicon-info-sign"></span></label>
    		<select id="comercial" name="comercial" class="form-control">
				<?
	    		?>
		   	</select>
		</div>
	</div>
 -->

 	<div class="clearfix"></div>

 	<!-- <fieldset>
     	<legend>Solicitud</legend>

     	<div class="col-md-2">
     	    <div class="form-group">
     	        <label class="control-label" for="tiposolicitud">Tipo Solicitud:</label>
     	        <select id="tiposolicitud" name="tiposolicitud" class="form-control" >
     				<option value="ESFOCC">EDUKA-TE</option>
     				 <option value="IKEA">IKEA</option>
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

     </fieldset>-->

       <!--  <div class="clearfix"></div>

     	 <? //if ( $_SESSION[user] == 'root' || $_SESSION[user] == 'alago' ) { ?>
        	<div class="col-md-3">
     	   	<div class="form-group">
     		    <label class="control-label" for="grupo_dino">Grupo Dino:</label>
     		    <input type="text" id="grupo_dino" name="grupo_dino" class="form-control" />
     	    </div>
     	</div>
     	<?// } ?> -->

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
			<div class="col-md-1">
		    	<div class="form-group">
				    <label class="control-label" for="horastotales">Horas:</label>
				    <input type="text" id="horastotales" name="horastotales" class="sum form-control" disabled />
			    </div>
			</div>
			<div class="col-md-2">
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
    			<div class="checkbox">
        		<label class="control-label" for="aulavirtual"> Aula Virtual
            		<input type="hidden" name="aulavirtual" value="0">
            		<input type="checkbox" id="aulavirtual" name="aulavirtual" value="1">  
        		</label>
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



	<fieldset>
		<span id="tagdocentes"></span>
	    <a href="#" data-toggle=modal id="btndocenteseditar" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Docentes</a>
		<legend>Datos del Docente</legend>

		<div class="col-md-2 pull-right imparte">
			<div class="form-group">
	    		<label class="control-label" for="tipo_docente">Imparte:</label>
	    		<select id="tipo_docente" name="tipo_docente" class="form-control"  >
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
		<legend>Horarios</legend>

		<div id="datostutoria" style="display:none">
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariomini">Horario mañana (inicio):</label>
				    <input placeholder="00:00" type="text" id="horariomini" name="horariomini" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariomfin">Horario mañana (fin):</label>
				    <input placeholder="15:00" type="text" id="horariomfin" name="horariomfin" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariotini">Horario tarde (inicio):</label>
				    <input placeholder="15:01" type="text" id="horariotini" name="horariotini" class="form-control" />
			    </div>
			</div>
			<div class="col-md-3">
			   	<div class="form-group">
				    <label class="control-label" for="horariotfin">Horario tarde (fin):</label>
				    <input placeholder="23:59" type="text" id="horariotfin" name="horariotfin" class="form-control" />
			    </div>
			</div>

			<div class="clearfix"></div>

			<div class="col-md-8" style="min-height: 40px;">
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
			<input type="hidden" id="fechas_excluir">
			<div style="margin-top: 5px; min-height: 50px !important;" class="col-md-2 ">
				<a style="width: 100%" href="#" id="fechasexcluir" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Excluir fechas</a>
			</div>
			<div style="margin-top: 5px; min-height: 50px !important;" class="col-md-2">
				<a style="width: 100%" href="#" id="fechasincluir" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Incluir fechas</a>
			</div>
			<div class="clearfix"></div>
			<div style="" id="observacionescuadro" class="ta col-md-12">
				<div class="form-group">
					<label class="control-label" for="observaciones">Observaciones:</label>
					<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
			   </div>
			</div>
			</div>


	   	<!-- </div> -->

	<span class="fin_tutoria"></span>
	</fieldset>

	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a href="#" data-toggle=modal id="btntutorias" name="tutoria" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Horarios</a>
	    </div>
	</div>
	<div class="clearfix"></div>


	<div class="clearfix"></div>

	<fieldset>
		<legend>Centro</legend>

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

			<!-- <div class="col-md-2">
			   	<div class="form-group">
				    <label class="control-label" for="costeaula">Coste:</label>
				    <input type="text" id="costeaula" name="costeaula" class="form-control" disabled/>
			    </div>
			</div> -->
			<div class="clearfix"></div>
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

		   	<!-- <div style="" id="observacionescuadro" class="ta col-md-12">
				<div class="form-group">
					<label class="control-label" for="observaciones">Observaciones:</label>
					<textarea name="observaciones" id="observaciones" class="form-control" rows="2"></textarea>
			   </div>
			</div> -->


	   	</div>

	<span class="fin_tutoria"></span>
	</fieldset>

	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a href="#" data-toggle=modal id="btncentro" name="centros" class="abrebusqueda btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Centro</a>
	    </div>
	</div>
	<div class="clearfix"></div>

	<fieldset>
		<span id="tagempresas"></span>
		<a style="display:none" href="#" data-toggle=modal id="btnempresaseditar" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> Empresas</a>
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
		    <label class="control-label" for="presupuesto">Presupuesto  <span id="infopresupuesto" data-trigger="hover" data-container="body" data-toggle="popover" data-placement="right" data-content="Presupuesto estimado por empresa" style="font-size: 16px" class="glyphicon glyphicon-info-sign"></span></label>
		   	<input type="text" id="presupuesto" name="presupuesto" class="form-control" />
		</div>
	</div>
	</fieldset>

	<div class="clearfix"></div>
<!--
	<fieldset>
		<legend>Rentabilidad</legend>

		<input type="hidden" name="id_renta" id="id_renta" value=""> 
		<input type="hidden" name="detalleotros" id="detalleotros" value="">
		 <input type="hidden" name="detallefungibledidac" id="detallefungibledidac" value=""> 

		 
		<input type="hidden" name="fungibleitems" id="fungibleitems" value="">
		<input type="hidden" name="otrosgastositems" id="otrosgastositems" value="">

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
				      	<input type="text" id="administracion" name="administracion"  class="form-control" />
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

		   	<div style="" id="observacionescuadro" class="ta col-md-12">
				<div class="form-group">
					<label class="control-label" for="justificacion">Justificación:</label>
					<textarea name="justificacion" id="justificacion" class="form-control" rows="2"></textarea>
			   </div>
			</div>

	   	</div>

	<span class="fin_renta"></span>
	</fieldset>
		
	<div class="clearfix"></div>
	<div style="float:right; min-height: 30px;" class="col-md-2">
    	<div class="form-group botones">
		    <a id="btnrentabilidad" name="rentabilidad" class="btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Rentabilidad</a>
	    </div>
	</div>
	<div class="clearfix"></div>-->
		


	<fieldset>
		<legend>Incidencias</legend>
		<div style="" class="ta col-md-12">
			<div class="form-group">
				<label class="control-label" for="incidencias">Incidencias:</label>
				<textarea name="incidencias" id="incidencias" class="form-control" rows="2"></textarea>
		   </div>
		</div>
		<div style="" class="ta col-md-12">
			<div class="form-group">
				<label class="control-label" for="observacioneslogistica">Observaciones Logística:</label>
				<textarea name="observacioneslogistica" id="observacioneslogistica" class="form-control" rows="2"></textarea>
		   </div>
		</div>
	</fieldset>

	<div class="col-md-5 center-block btnmatriculas" style="min-height:70px;">
		<input type="submit" name="submit" value="Guardar Matrícula" class="btn btn-primary btn-lg">
		<a id="abrebusqueda" href="#" name="matriculas" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Matrículas</a>
	</div>

	<div class="col-md-5 center-block btnmatriculas" style="min-height:70px; display:none; ">
		<!-- <a id="imprimirmat" style="float:none;" href="#" class="btn btn-sm btn-info">Imprimir Matrícula</a> -->
		<a id="xmliniciopre" style="float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-info">XML Inicio</a>
		<a id="xmlfinpre" style="float:none; margin-left:5px;" href="#" name="matriculas" data-toggle=modal class="btn btn-sm btn-info">XML Finalización</a>
	</div>
	<div class="clearfix"></div>

</div>
</form>

