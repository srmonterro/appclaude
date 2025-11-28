<form class="formularioacreedores" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">
	
	<div style="display:none" id="confirmacion" class="inv alert alert-success">Acreedor guardado correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El CIF introducido ya existe en la base de datos.</div>
	
    <div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="nombrecomercial">Nombre:</label>
		    <input type="text" id="nombrecomercial" name="nombrecomercial" class="form-control" />
	    </div>
	</div>
    <div class="col-md-5">
    	<div class="form-group">
		    <label class="control-label" for="razonsocial">Razón Social:</label>
		    <input type="text" id="razonsocial" name="razonsocial" class=" form-control" />
		</div>
	</div>
	
	 <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="cif">CIF:</label>
		    <input type="text" id="cif" name="cif" class=" form-control" />
		</div>
	</div>
	
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="tipoacreedor">Tipo:</label>
		    <select id="tipoacreedor" name="tipoacreedor" class="form-control">
				<option value="">-</option>
				<option value="Docente">Docente</option>
				<option value="Acreedor">Acreedor</option>
				<option value="Proveedor">Proveedor</option>				
		   	</select>
	    </div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="cuentacontable">Cuenta Contable:</label>
		    <input type="text" id="cuentacontable" name="cuentacontable" class=" form-control" />
	    </div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="iban">IBAN / CC:</label>
		    <input type="text" id="iban" name="iban" class=" form-control" />
		</div>
	</div>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="formapago">Forma de Pago:</label>
		    <select id="formapago" name="formapago" class="form-control">
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option>
				<option value="Remesa">Remesa</option>
				<option value="Efectivo">Efectivo</option>
				<option value="Domiciliación">Domiciliación</option>
		   	</select>
	    </div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
	        <label class="control-label" for="vencimiento">Vencimiento (días):</label>
	        <input type="text" id="vencimiento" name="vencimiento" class="form-control" />
    	</div>
	</div>
	
	<div class="clearfix"></div>
	
	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="telefono">Teléfono:</label>
		    <input type="text" id="telefono" name="telefono" class="form-control" />
	    </div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="fax">Fax:</label>
		    <input type="text" id="fax" name="fax" class="form-control" />
	    </div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="email">Email:</label>
		    <input type="text" id="email" name="email" class="form-control" />
	    </div>
   	</div>
   	<div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="email_facturas">Email Contabilidad:</label>
		    <input type="text" id="email_facturas" name="email_facturas" class="form-control" />
	    </div>
   	</div>
	
    
	<div class="clearfix"></div>

	<div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="nombrecontacto">Nombre Contacto:</label>
		    <input type="text" id="nombrecontacto" name="nombrecontacto" class="form-control" />
	    </div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		    <label class="control-label" for="cargocontacto">Cargo Contacto:</label>
		    <input type="text" id="cargocontacto" name="cargocontacto" class="form-control" />
	    </div>
   	</div>
	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="tlfcontacto">Teléfono Contacto:</label>
		    <input type="text" id="tlfcontacto" name="tlfcontacto" class="form-control" />
	    </div>
	</div>
	<div class="col-md-3">
		<div class="form-group">
		    <label class="control-label" for="emailcontacto">Email Contacto:</label>
		    <input type="text" id="emailcontacto" name="emailcontacto" class="form-control" />
	    </div>
   	</div>

	<div class="clearfix"></div>

	<div class="col-md-6">
    	<div class="form-group">
		    <label class="control-label" for="domiciliosocial">Domicilio Social:</label>
		    <input type="text" id="domiciliosocial" name="domiciliosocial" class="form-control" />
		</div>
	</div>
	<div class="col-md-6">
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

   	<div style="min-height: 40px" class="col-md-3 pull-right">
	   	<a style="float: right;" href="#" data-toggle=modal id="observacionesempresa" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Observaciones</a>
	</div>
	<div class="clearfix"></div>
   	<div style="display:none" id="observaciones" class="ta col-md-12">
		<div class="form-group">
			<label class="control-label" for="observaciones">Observaciones:</label>
			<textarea name="observaciones" id="observaciones" class="form-control" rows="3"></textarea>
	   </div>
	</div>
	
   	<input name="tabla" type="hidden" id="tabla" value="acreedores" />
   	<input name="id" type="hidden" id="id" value="" />
</div>

<p style="text-align: center; margin-top: 30px;">
  <? if ( $_SESSION['user'] != 'efrencomercial') { ?>
  <input type="submit" name="submit" value="Guardar Acreedor" class="btn btn-primary btn-lg"> <? } ?>
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Acreedores</a><br>
  <!-- <a id="subirinformes" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Empresa</a> -->
  <!-- <a id="informe" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Informe Empresa</a> -->
</p>
  
	
</form>


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
   

