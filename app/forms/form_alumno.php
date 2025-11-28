<?
// session_start();
$comercial = strpos( $_SESSION['user'], 'comercial' );
$comercial = strpos( $_SESSION['user'], 'tutor' );

if ( $externo != false ) {

	echo "not allowed.";

} else if ( strpos($_SESSION[user], 'n_') !== false ) {

	include('forms/form_vernomina.php');
		// die();

} else if ( strpos($_SESSION[user], 'cmunoz') !== false ) {

	include('forms/form_empresa.php');

} else if ( strpos($_SESSION[user], 'jhony') !== false || strpos($_SESSION[user], 'jalves') !== false ) {

	include('forms/presencial_doc.php');

} else if ( $tutor !== false && $_SESSION[user] != 'anjatutor' ) {

	include('forms/form_tutorias.php');

} else if ( $inspeccion !== false ) { ?>

	<script type="text/javascript">
		window.location.replace("http://gestion.eduka-te.com/app/index.php?inspeccionpm");
	</script> <?

} else {

?>

<form class="formularioalumno" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

	<div style="display:none" id="confirmacion" class="alert alert-success">Alumno guardado correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El Nº de Documento introducido ya existe en la base de datos.</div>

    <div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Nombre:</label>
		    <input type="text" id="nombre" name="nombre" class="required form-control" />
	    </div>
	</div>
    <div class="col-md-4">
    	<div class="form-group">
		    <label class="control-label" for="nombre">Apellido:</label>
		    <input type="text" id="apellido" name="apellido" class="required form-control" />
		</div>
	</div>
    <div class="col-md-4">
    	<div class="form-group">
		    <label for="nombre">2º Apellido:</label>
		    <input type="text" id="apellido2" name="apellido2" class="form-control" />
		</div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
    	    <label class="control-label" for="tipodocumento">Tipo Documento:</label>
		    <select name="tipodocumento" id="tipodocumento" class="required form-control">
		    	<option value="10">NIF</option>
		    	<option value="60">NIE</option>
		    </select>
	    </div>
	</div>
    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="documento">Nº Documento:</label>
		    <input type="text" id="documento" name="documento" class="required form-control" />
	    </div>
	</div>
   	<div class="col-md-2">
   		<div class="form-group">
		    <label class="control-label" for="fechanac">Fecha de Nacimiento:</label>
		    <input type="date" id="fechanac" class="required form-control" name="fechanac" />
	    </div>
	</div>
    <div class="col-md-1">
    	<div class="form-group">
		    <label class="control-label" for="sexo">Sexo:</label>
		    <select id="sexo" name="sexo" class="required form-control">
		    	<option value="M">M</option>
		    	<option value="F">F</option>
		    </select>
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
	<div class="col-md-3">
		<div class="form-group">
		    <label class="control-label" for="tlftrabajo">Teléfono trabajo:</label>
		    <input type="text" id="tlftrabajo" name="tlftrabajo" class="form-control" />
	    </div>
   	</div>
   	<div class="col-md-2">
		<div class="checkbox">
			<label>
				<input type="checkbox" id="afectadosterrorismo" name="afectadosterrorismo" value="1">
				Afectado Terrorismo </label>
		</div>
	</div>
	<div class="col-md-2">
	  	<div class="checkbox">
	   		<label>
	   			<input type="checkbox" id="afectadosviolenciagenero" name="afectadosviolenciagenero" value="1">Afectado Violencia
	   		</label>
	   	</div>
	</div>
	<div class="col-md-2">
   		<div class="checkbox">
	 		<label>
	   			<input type="checkbox" id="discapacidad" name="discapacidad" value="1">Discapacidad
	   		</label>
	   	</div>
	</div>
	<div class="clearfix"></div>
	<div class="col-md-3">
   		<div class="form-group">
	    	<label class="control-label" for="niss">Nº Seguridad Social:</label>
	    	<input type="text" id="niss" name="niss" class="required form-control" />
    	</div>
    </div>

    <div class="col-md-3">
    	<div class="form-group">
	    	<label class="control-label" for="grupocotizacion">Grupo de Cotización:</label>
	    	<select name="grupocotizacion" id="grupocotizacion" class="required form-control">
		    	<option value="1">1 - Ingenieros y Licenciados</option>
		    	<option value="2">2 - Ingenieros técnicos, Peritos y Ayudantes titulados</option>
		    	<option value="3">3 - Jefes administrativos y de taller</option>
		    	<option value="4">4 - Ayudantes no titulados</option>
		    	<option value="5">5 - Oficiales administrativos</option>
		    	<option value="6">6 - Subalternos </option>
		    	<option value="7">7 - Auxiliares administrativos</option>
		    	<option value="8">8 - Oficiales de primera y segunda</option>
		    	<option value="9">9 - Oficiales de tercera y especialistas</option>
		    	<option value="10">10 - Trabajadores mayores de 18 años no cualificados</option>
		    	<option value="11">11 - Trabajadores menores de dieciocho años</option>
		    </select>
    	</div>
    </div>
   	<div class="col-md-3">
   		<div class="form-group">
	    	<label class="control-label" for="nivelestudios">Nivel de Estudios:</label>
	    	<select id="nivelestudios" name="nivelestudios" class="required form-control">
		    	<option value="1">Sin Estudios</option>
		    	<option value="2">Estudios primarios, EGB o equivalente</option>
		    	<option value="3">FP I o Enseñanza Técnico profesional equiv., Bachillerato Superior, BUP y equiv., FP II o equiv.</option>
		    	<option value="4">Arquitecto Técnico o Ingeniero Técnico, Diplomado de otras escuelas universitarias o equiv.</option>
		    	<option value="5">Arquitecto e Ingeniero Superior o Licenciado</option>
		    	<option value="6">Otros</option>
		    </select>
    	</div>
    </div>
    <div class="col-md-3">
    	<div class="form-group">
	    	<label class="control-label" for="categoriaprofesional">Categoría:</label>
	    	<select name="categoriaprofesional" id="categoriaprofesional" class="required form-control">
		    	<option value="1">Directivo</option>
		    	<option value="2">Mando Intermedio</option>
		    	<option value="3">Técnico</option>
		    	<option value="4">Trabajador Cualificado</option>
		    	<option value="5">Trabajador con Baja Cualificación</option>
		    </select>
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
   	<div class="col-md-12">
   		<div class="form-group">
    		<label class="control-label" for="direccion">Dirección:</label>
		    <input type="text" id="direccion" name="direccion" class="form-control" />
    	</div>
    </div>

    <!-- <div class="clearfix"></div>
    <div class="col-md-4">
		<div class="form-group">
		    <label class="control-label" for="id_dino">Identificado Dinosol:</label>
		    <input type="text" id="id_dino" name="id_dino" class="form-control" />
	    </div>
    </div> -->

    <div class="clearfix"></div>
	<input name="tabla" type="hidden" id="tabla" value="alumnos" />
	<input name="id" type="hidden" id="id" value="" /> <!-- si hay value es que es UPDATE !-->
</div>


<p style="text-align: center; margin-top: 30px;">
  <input type="submit" name="submit" value="Guardar Alumno" class="btn btn-primary btn-lg">
  <a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Alumnos</a>
</p>

</form>
<? } ?>
