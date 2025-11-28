
<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');

 ?>

<form class="formularioinventario" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">

		<div style="display:none" id="confirmacion" class="inv alert alert-success">Equipo guardado correctamente.</div>
		
		<div class="clearfix"></div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="tipo_equipo">Tipo:</label>
			    <select id="tipo_equipo" name="tipo_equipo" class="form-control">
					<option value="Portátil">Portátil</option>
					<option value="Sobremesa">Sobremesa</option>
					<option value="AllInOne">AllInOne</option>
					<option value="Proyector">Proyector</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="marca">Marca:</label>
			    <select id="marca" name="marca" class="form-control">
					<option value="Acer">Acer</option>
					<option value="Gigabyte">Gigabyte</option>
					<option value="Lenovo">Lenovo</option>
					<option value="Compaq">Compaq</option>
					<option value="MSI">MSI</option>
					<option value="OneWay">OneWay</option>
					<option value="OneWay">OneWay</option>
					<option value="Packard Bell">Packard Bell</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="modelo">Modelo:</label>
			    <select id="modelo" name="modelo" class="form-control">
					<option value="Acer">Acer</option>
					<option value="Gigabyte">Gigabyte</option>
					<option value="Lenovo">Lenovo</option>
					<option value="Compaq">Compaq</option>
					<option value="MSI">MSI</option>
					<option value="OneWay">OneWay</option>
					<option value="OneWay">OneWay</option>
					<option value="Packard Bell">Packard Bell</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-2">
			<div class="form-group">
		    	<label class="control-label" for="procesador">Procesador:</label>
		    	<input type="text" id="procesador" name="procesador" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-1">
			<div class="form-group">
		    	<label class="control-label" for="ram">RAM:</label>
		    	<input type="text" id="ram" name="ram" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="so">Sistema Operativo:</label>
			    <select id="so" name="so" class="form-control">
					<option value="W7">Windows 7</option>
					<option value="W8">Windows 8</option>
					<option value="W10">Windows 10</option>
					<option value="Linux">Linux</option>
					<option value="Mac">Mac</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="localizacion">Localización:</label>
			    <select id="localizacion" name="localizacion" class="form-control">
					<option value="Chafiras">Chafiras</option>
					<option value="Majuelos">Majuelos</option>
					<option value="Formacion">Formación</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-3">
	   		<div class="form-group">
			    <label class="control-label" for="accion_formativa">Acción formativa:</label>
			    <div class="input-group">
			    	<input placeholder="Inserta el código de la acción y busca" id="accion" name="accion" class="form-control" />
			  	    <span class="input-group-btn">
				        <a id="buscaraccion" class="btn btn-default"><span id="buscar" class="glyphicon glyphicon-search"></span></a>
				    </span>
			    </div>
		    </div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
		    	<label class="control-label" for="asignado">Asignado a:</label>
		    	<input type="text" id="asignado" name="asignado" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
		    	<label class="control-label" for="etiqueta">Etiqueta:</label>
		    	<input type="text" id="etiqueta" name="etiqueta" class="form-control" />
	    	</div>
		</div>

		<div class="col-md-2" style="margin-top:30px">
	    	<div class="form-group">
			    <label class="control-label" for="monitor">Monitor  </label>
			    <input type="checkbox" id="monitor" value="1" name="monitor" />
		    </div>
		</div>

		<div class="col-md-2" style="margin-top:30px">
	    	<div class="form-group">
			    <label class="control-label" for="raton">Raton: </label>
			    <input type="checkbox" id="raton" value="1" name="raton" />
		    </div>
		</div>

		<div class="col-md-10">
			<div class="form-group">
		    	<label class="control-label" for="observaciones">Observaciones:</label>
		    	<input type="text" id="observaciones" name="observaciones" class="form-control" />
	    	</div>
		</div>

	</div>

	<p style="text-align: center; margin-top: 30px;">
		<input type="submit" name="submit" value="Guardar" class="btn btn-primary btn-lg">
	</p>

</form>