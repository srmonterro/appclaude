<form class="formulariocomisionistas" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">
	
	<div style="display:none" id="confirmacion" class="inv alert alert-success">Asesoría guardada correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El CIF introducido ya existe en la base de datos.</div>
	
    
	<div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="tipocomisionista">Tipo de Comisionista:</label>
            <select id="tipocomisionista" name="tipocomisionista" class="form-control">
                <option value="">Escoge un tipo</option>
                <option value="Asesoria">ASESORÍA</option>
                <option value="Agente">AGENTE</option>
                <option value="Colaborador">COLABORADOR</option>
            </select>
        </div>
    </div>
    <div class="col-md-5">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Nombre:</label>
		    <input type="text" id="nombre" name="nombre" class="form-control" />
	    </div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="nifcif">NIF/CIF:</label>
		    <input type="text" id="nifcif" name="nifcif" class=" form-control" />
		</div>
	</div>
    

	<div class="clearfix"></div>

	
	<div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="domiciliofiscal">Domicilio Fiscal:</label>
		    <input type="text" id="domiciliofiscal" name="domiciliofiscal" class="form-control" />
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
   	<div class="col-md-3">
   		<div class="form-group">
    		<label class="control-label" for="poblacion">Población:</label>
    		<select id="poblacion" name="poblacion" class="form-control" disabled>
		    </select>
    	</div>
    </div>
    <div class="col-md-3">
    	<div class="form-group">
    		<label class="control-label" for="provincia">Provincia:</label>
    		<select id="provincia" name="provincia" class="form-control" disabled>
		    </select>
    	</div>
   	</div>
	
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="email">Email:</label>
		    <input type="text" id="email" name="email" class=" form-control" />
		</div>
	</div>
	 <div id="cuadroasesor" style="display:none" class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="asesor">Asesor:</label>
		    <input type="text" id="asesor" name="asesor" class=" form-control" />
		</div>
	</div>

	 <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="contacto">Persona de Contacto:</label>
		    <input type="text" id="contacto" name="contacto" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
        <div class="form-group">
            <label class="control-label" for="comercial">Comercial:</label>
            <select id="comercial" name="comercial" class="form-control">
                <? 
                    $q = 'SELECT id, nombre, apellido
                    FROM comerciales ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].'</option>';
                ?>
            </select>
        </div>
    </div>

	<div class="clearfix"></div>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="telefono">Teléfono:</label>
		    <input type="text" id="telefono" name="telefono" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="fax">Fax:</label>
		    <input type="text" id="fax" name="fax" class=" form-control" />
		</div>
	</div>
	
	<div class="clearfix"></div>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="tipoacuerdo">Tipo de Acuerdo:</label>
		    <input value="Formación" type="text" id="tipoacuerdo" name="tipoacuerdo" class=" form-control" disabled />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="porcentajeformacion">% Formación:</label>
		    <input type="text" id="porcentajeformacion" name="porcentajeformacion" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="importeformacion">Importe Formación:</label>
		    <input type="text" id="importeformacion" name="importeformacion" class=" form-control" readonly />
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="formapagoformacion">Forma de Pago:</label>
		    <select id="formapagoformacion" name="formapagoformacion" class="form-control">
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option>
				<option value="Remesa">Remesa</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
	    </div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        	<label class="control-label" for="vencimientoformacion">Vencimiento (días fecha factura):</label>
        	<input type="text" id="vencimientoformacion" name="vencimientoformacion" class="form-control" />
    	</div>
	</div>

	
	<div class="clearfix"></div>
	<hr>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="tipoacuerdo">Tipo de Acuerdo:</label>
		    <input value="Contrato de Formación" type="text" id="tipoacuerdo" name="tipoacuerdo" class=" form-control" disabled />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="porcentajecontrato">% Contrato Formación:</label>
		    <input type="text" id="porcentajecontrato" name="porcentajecontrato" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="importecontrato">Importe Contrato Formación:</label>
		    <input type="text" id="importecontrato" name="importecontrato" class=" form-control" readonly />
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="formapagocontrato">Forma de Pago:</label>
		    <select id="formapagocontrato" name="formapagocontrato" class="form-control">
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option>
				<option value="Remesa">Remesa</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
	    </div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        	<label class="control-label" for="vencimientocontrato">Vencimiento (días fecha factura):</label>
        	<input type="text" id="vencimientocontrato" name="vencimientocontrato" class="form-control" />
    	</div>
	</div>

	
	<div class="clearfix"></div>
	<hr>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="otro">Tipo de Acuerdo:</label>
		    <input placeholder="Especificar otro tipo de acuerdo" type="text" id="otro" name="otro" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="porcentajeotro">%:</label>
		    <input type="text" id="porcentajeotro" name="porcentajeotro" class=" form-control" />
		</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="importeotro">Importe:</label>
		    <input type="text" id="importeotro" name="importeotro" class=" form-control" readonly/>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="formapagootro">Forma de Pago:</label>
		    <select id="formapagootro" name="formapagootro" class="form-control">
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option>
				<option value="Remesa">Remesa</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
	    </div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        	<label class="control-label" for="vencimientootro">Vencimiento (días fecha factura):</label>
        	<input type="text" id="vencimientootro" name="vencimientootro" class="form-control" />
    	</div>
	</div>

	
	<div class="clearfix"></div>
	<hr>

	<div class="col-md-4">
    	<div class="form-group">
        	<label class="control-label" for="iban">IBAN:</label>
        	<input type="text" id="iban" name="iban" class="form-control" />
    	</div>
	</div>

	<div class="clearfix"></div>

	<div style="" id="observacionescuadro" class="ta col-md-12">
		<div class="form-group">
			<label class="control-label" for="observaciones">Observaciones:</label>
			<textarea name="observaciones" id="observaciones" class="form-control" rows="3"></textarea>
		</div>
	</div>	   	

	<div class="clearfix"></div>

	<input name="tabla" type="hidden" id="tabla" value="comisionistas" />
   	<input name="id" type="hidden" id="id" value="" />
	
</div>

<p style="text-align: center; margin-top: 30px;">

  <input type="submit" name="submit" value="Guardar Comisionista" class="btn btn-primary btn-lg">
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Comisionista</a><br>
<!--   <a id="subirinformes" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Empresa</a>
 -->
</p>
 
</form>
	

<div class="col-md-8 col-md-push-3" style="margin-top: 20px; margin-bottom: 50px;">

		<form id="formpdfcomisionista" action="" method="post" enctype="multipart/form-data">
			<label> PDF Acuerdo: </label><br>
			<input style="float:left" type="file" name="pdfcomisionista" id="pdfcomisionista" class="btn btn-default">
			<a id="subirpdfcomisionista" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a>
			<a id="mostrarpdfcomisionista" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>
		</form><div class="clearfix"></div>
		<a style="margin-top: 10px;text-align:center" id="pregenerarcomisionistacontinua" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Acuerdo formación continua</a>
		<a style="margin-top: 10px;text-align:center" id="pregenerarcomisionistacontrato" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Acuerdo contrato de formación</a>
		<a style="margin-top: 10px;text-align:center" id="pregenerarcomisionistaotro" data-toggle=modal class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Otro tipo de acuerdo</a>

	</div>



<div  class="modal fade" id="actividades" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h4 class="modal-title" id="myModalLabel">Escoge Actividad Principal</h4>
					</div>
					<div class="modal-body listactividades">
						
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cerrar
						</button>
					</div>
				</div>
			</div>
	</div>

<div class="modal fade" id="cuentascotizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h3 class="modal-title" id="myModalLabel">Añadir cuentas de cotización</h3>
					</div>
					<div class="modal-body">
						<div class="col-md-6">	
					  		<div class="cp form-group">
					   			<label class="control-label" for="cuentacot">Cuenta de Cotización:</label>
					   			<div class="input-group">
					   				
							      	<input type="text" id="cuentacot" name="cuentacot" class="form-control" />
							      	<span class="input-group-btn">
							        	<button id="anadircuenta" name="anadircuenta" class="btn btn-default"><span class="glyphicon glyphicon-plus"></span></button>
							      	</span>
							    </div>
					   		</div>
					   	</div>
					   	<div class="col-md-6 cuadrocuentas">
					   		<select id="cuadrocuentas" name="cuadrocuentas" class="form-control" multiple="multiple">
						    </select>
					   	</div>
					   	<div class="col-md-3 pull-right">
					   		<a href="#" id="eliminarcuenta" class="pull-right btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> Eliminar cuenta</a>
					   	</div>
					</div>
					<div class="modal-footer">
						<button type="button" id="guardarcuentas" class="btn btn-primary" >
							Guardar
						</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cerrar
						</button>
					</div>
				</div>
			</div>
	</div>
	
<div class="modal fade" id="contactos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
							&times;
						</button>
						<h3 class="modal-title" id="myModalLabel">Contactos de la Empresa</h3>
					</div>
					<div class="content">
					
					<form id="formulariocontacto">
						<span class="contacto"></span>
					</form>	
							
					</div>
					<input type="hidden" id="actualizarcontacto" value="0" />
					<input type="hidden" id="insertarcontacto" value="0" />
					<div class="pull-right" style="margin-right: 20px; margin-top: 15px;">
						<a href="#" id="anadircontacto" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Añadir</a>
					</div>
					<div class="clearfix"></div>
					
					<div class="modal-footer">
						<button type="button" id="guardarcontactos" data-dismiss="modal" class="btn btn-primary" >
							Guardar
						</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">
							Cerrar
						</button>
					</div>
				</div>
			</div>
			
	</div>


