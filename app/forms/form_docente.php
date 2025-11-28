
<form class="formulariodocente" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

	<div style="display:none" id="confirmacion" class="alert alert-success">Docente guardado correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Documento introducido ya existe en la base de datos.</div>


	<div class="col-md-2">
		<div class="form-group">
			<label class="control-label" for="tipodoc">Tipo Docente:</label>
			<select id="tipodoc" name="tipodoc" class="form-control">
				<option value="">-</option>
				<option value="Persona">Persona</option>
				<option value="Empresa">Empresa</option>
			</select>
		</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-4 proveedores" style="display:none">
    	<div class="form-group">
		    <label class="control-label" for="proveedores">Selecciona un proveedor:</label>
		    <select id="proveedores" name="proveedores" class="form-control">
		    	<?

		    	$q = 'SELECT nombre, documento
				FROM docentes d
				WHERE d.tipodoc = "Empresa"
				GROUP BY documento
				ORDER BY nombre ASC';
				$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

				echo '<option value="">Seleciona un proveedor o crea uno nuevo</option>';
				while ( $row = mysqli_fetch_assoc($q) ) {
					echo '<option value="" documento="'.$row['documento'].'" nombre="'.$row['nombre'].'">'.$row['nombre'].' - '.$row['documento'].'</option>';
				}

		    	?>
		   	</select>
	    </div>
	</div>

	<div class="clearfix"></div>

    <div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Nombre:</label>
		    <input type="text" id="nombre" name="nombre" class="required form-control" />
	    </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="apellido">Apellido:</label>
		    <input type="text" id="apellido" name="apellido" class="form-control" />
		</div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label for="apellido2">2º Apellido:</label>
		    <input type="text" id="apellido2" name="apellido2" class="form-control" />
		</div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="documento">Nº Documento:</label>
		    <input type="text" id="documento" name="documento" class="required form-control" />
	    </div>
	</div>

	<fieldset class="esempresa" style="display:none">
		<legend style="font-size: 16px">Si es empresa, rellenar datos del docente</legend>
	<div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="nombredocente">Nombre docente:</label>
		    <input type="text" id="nombredocente" name="nombredocente" class="required form-control" />
	    </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="apellidodocente">Apellido docente:</label>
		    <input type="text" id="apellidodocente" name="apellidodocente" class="required form-control" />
		</div>
	</div>
    <div class="col-md-2">
    	<div class="form-group">
		    <label for="apellido2docente">2º Apellido docente:</label>
		    <input type="text" id="apellido2docente" name="apellido2docente" class="form-control" />
		</div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="documentodocente">Nº Documento:</label>
		    <input type="text" id="documentodocente" name="documentodocente" class="required form-control" />
	    </div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="telefonodocente">Tlf docente:</label>
		    <input type="text" id="telefonodocente" name="telefonodocente" class="required form-control" />
	    </div>
	</div>
	</fieldset>

	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="dmodalidad">Modalidad:</label>
		    <select id="dmodalidad" name="dmodalidad" class="form-control">
				<option value="Presencial">Presencial</option>
				<option value="Distancia">Distancia</option>
				<option value="Teleformación">Teleformación</option>
				<option value="Todas">Todas</option>
		   	</select>
	    </div>
	</div>


	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="email">Email Corporativo:</label>
		    <input type="text" id="email" name="email" class="form-control" />
	    </div>
    </div>
    <div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="email2">Email Personal:</label>
		    <input type="text" id="email2" name="email2" class="form-control" />
	    </div>
    </div>

     <div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="telefono">Teléfono:</label>
		    <input type="text" id="telefono" name="telefono" class="form-control" />
	    </div>
	</div>
	<div class="col-md-2">
        <div class="form-group">
            <label class="control-label" for="telefono2">Teléfono 2:</label>
            <input type="text" id="telefono2" name="telefono2" class="form-control" />
        </div>
    </div>

	<div class="col-md-2">
   		<div class="checkbox">
	 		<label>
	   			<input type="checkbox" id="docenteinterno" name="docenteinterno" value="1">Docente interno
	   		</label>
	   	</div>
	</div>

	<div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="situacionlaboral">Situación Laboral:</label>
		    <select id="situacionlaboral" name="situacionlaboral" class="required form-control">
				<option value="">Seleccionar</option>
				<option value="Autonomo">Autónomo</option>
				<option value="Otro">Otra situación (trabaja por cuenta ajena en otra empresa)</option>
				<option value="Generar">Generar Alta Laboral</option>
				<option value="Nomina">En Nómina</option>
		   	</select>
	    </div>
	</div>
    <div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="niss">Nº SS:</label>
		    <input type="text" id="niss" name="niss" class="form-control" />
	    </div>
    </div>
    <div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="numcuenta">Número de Cuenta:</label>
		    <input type="text" id="numcuenta" name="numcuenta" class="form-control" />
	    </div>
    </div>

    <div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="preciohora">Precio / Hora:</label>
		    <input type="text" id="preciohora" name="preciohora" class="form-control" />
	    </div>
    </div>
    <div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="preciohora">Precio / Alumno:</label>
		    <input type="text" id="precioalumno" name="precioalumno" class="form-control" />
	    </div>
    </div>
    <div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="titulacion">Titulación:</label>
		    <input type="text" id="titulacion" name="titulacion" class="form-control" />
	    </div>
    </div>
    <div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="acuerdopago">Acuerdo de Pago:</label>
		    <input type="text" id="acuerdopago" required name="acuerdopago" class="form-control" />
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

   	<div class="clearfix"></div>

   	<div class="col-md-9">
   		<div class="form-group">
    		<label class="control-label" for="direccion">Dirección:</label>
		    <input type="text" id="direccion" name="direccion" class="form-control" />
    	</div>
    </div>

    <div class="col-md-3">
    	<label class="control-label" for="especialidades">Especialidades:</label><br>
    		<input type="hidden" id="modifespecialidad" name="modifespecialidad" value="" />
	    	<select class="multiselect" id="especialidades" name="especialidades" multiple="multiple" style="display: none;">
	    		<?
	    			$q = 'SELECT id,especialidad FROM especialidades';
	    			$q = mysqli_query($link,$q);

	    			while ($row = mysqli_fetch_array($q))
	    				echo '<option style="font-size:10px;" value="'.$row['id'].'">'.$row['especialidad'].'</option>';
	    		?>
	    	</select>
	</div>


	<div class="col-md-3">
    	<div class="form-group">
	        <label class="control-label" for="porcentajediscapacidad">% Discapacidad:</label>
	        <input type="text" id="porcentajediscapacidad" name="porcentajediscapacidad" class="form-control" />
    	</div>
	</div>

	<div class="clearfix"></div>

</div>
	<input name="tabla" type="hidden" id="tabla" value="docentes" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->


<p style="text-align: center; margin-top: 30px;">
  <input type="submit" name="submit" value="Guardar Docente" class="btn btn-primary btn-lg">
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Docentes</a><br>
  <p style="text-align: center">
  <a  id="subirdocudocente" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Docente</a>
  <a  id="subirdocuentidad" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Entidad</a>
  <? if ($_SESSION['user'] == 'root' || $_SESSION['user'] == 'margarita') { ?>
	<a id="crearuserdocente" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span> Crear usuario</a>
	<a id="duplicardocente" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-danger"><span class="glyphicon glyphicon-user"></span> Duplicar Proveedor</a>
	<? } ?>
	</p>
</p>

</form>
