<form class="formulariocomercial" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

	<div style="display:none" id="confirmacion" class="alert alert-success">Comercial guardado correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Documento introducido ya existe en la base de datos.</div>
	
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Nombre:</label>
		    <input type="text" id="nombre" name="nombre" class="required form-control" />
	    </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Apellido:</label>
		    <input type="text" id="apellido" name="apellido" class="required form-control" />
		</div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label for="nombre">2º Apellido:</label>
		    <input type="text" id="apellido2" name="apellido2" class="form-control" />
		</div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="documento">Nº Documento:</label>
		    <input type="text" id="documento" name="documento" class="required form-control" />
	    </div>
	</div>

	<div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="email">Email:</label>
		    <input type="email" id="email" name="email" class="form-control" />
	    </div>
    </div>
    
     <div class="col-md-3">
    	<div class="form-group">		
		    <label class="control-label" for="telefono">Teléfono:</label>
		    <input type="text" id="telefono" name="telefono" class="form-control" />
	    </div>
	</div>
	<div class="col-md-5">
   		<div class="form-group">
    		<label class="control-label" for="direccion">Dirección:</label>
		    <input type="text" id="direccion" name="direccion" class="form-control" />
    	</div>
    </div>
	
	<div class="col-md-2">	
  		<div class="cp form-group">
   			<label class="control-label" for="codigopostal">C.P.:</label>
   			<div class="input-group">
		      	<input type="text" id="codigopostal" name="codigopostal" class="form-control" >
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
   	
   		

</div>
	<input name="tabla" type="hidden" id="tabla" value="comerciales" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->

   
<p style="text-align: center; margin-top: 30px;">
  <input type="submit" name="submit" value="Guardar Comercial" class="btn btn-primary btn-lg">
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Comercial</a><br>
  <!-- <a id="subirdocudocente" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Docente</a> -->
</p>
	
</form>
