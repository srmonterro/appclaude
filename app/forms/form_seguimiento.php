<?

//session_start();
$anio = devuelveAnio();
//if ( $_SESSION['user'] == 'root' ) {  ?>

<div style="margin-top: 45px" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
    <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div>


	<ol class="breadcrumb">
      <li>Online</li>
      <li class="active">Seguimiento Tutorías</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="numeroaccion">Acción Formativa:</label>
	            <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
	        </div>
	    </div>
	    <div class="col-md-3">
	        <div class="form-group">
	            <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
	            <input type="text" id="denominacion" name="denominacion" class="form-control"  />
	        </div>
	    </div>
	    <div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="modalidad">Modalidad:</label>
		            <select id="modalidad" name="modalidad" class="form-control">
		            	<option value="">Cualquiera</option>
		            	<option value="Teleformación">Teleformación</option>
		            	<option value="A Distancia">A Distancia</option>
		          		<option value="Presencial">Presencial</option>
		          		<option value="Mixto">Mixto</option>
		            </select>
		    </div>
		</div>
	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="fechaini">Fecha Inicio:</label>
	            <input type="date" id="fechaini" name="fechaini" class="form-control" value="<? echo $anio ?>-01-01"/>
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="fechafin">Fecha Fin:</label>
	            <input type="date" id="fechafin" name="fechafin" class="form-control" value="<? echo $anio ?>-12-31"/>
	        </div>
	    </div>
	    <div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimiento" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
		</div>

		<div class="clearfix"></div>
		<div class="col-md-12" style="height: 15px;"></div>
		<div class="clearfix"></div>

		<div class="col-md-3">
	        <div class="cp form-group">
   			<label class="control-label" for="razonsocial">Empresa:</label>
   			<div class="input-group">
		      	<input type="text" id="razonsocial" name="razonsocial" class="form-control" />
		      	<span class="input-group-btn">
		        	<button id="buscarempresa" name="buscarempresa" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		      	</span>
		    </div>
   			</div>
	    </div>
		<div class="col-md-3">
		    <div class="form-group">
		       <label class="control-label" for="docente">Docente:</label>
		            <select id='docente' name='docente' class="form-control">
		            <?
		                $q = 'SELECT id, nombre, apellido
		                FROM docentes
		                ORDER by nombre ASC';
		                $q = mysqli_query($link,$q);
		                echo '<option value="">Cualquiera</option>';
		                while ($row = mysqli_fetch_array($q))
		                    echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' </option>';
		            ?>
		            </select>
		    </div>
		</div>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="progreso">Progreso:</label>
		            <select id="progreso" name="progreso" class="form-control">
		            	<option value="">Cualquiera</option>
		            	<option value="0-25">0% - 25%</option>
		          		<option value="25-50">25% - 50%</option>
		          		<option value="50-75">50% - 75%</option>
		          		<option value="75-100">75% - 100%</option>
		            </select>
		    </div>
		</div>

		<div class="col-md-2">
		        <div class="form-group">
		            <label class="control-label" for="bfinalizado">Estado:</label>
		            <select id="bfinalizado" name="bfinalizado" class="form-control">
		                <option value="">Cualquiera</option>
		                <option value="0">En progreso</option>
		                <option value="1">Finalizado</option>
		                <option value="2">NO Finalizado</option>
		            </select>
		        </div>
		        </div>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="bonificado">Tipo:</label>
		            <select id="bonificado" name="bonificado" class="form-control">
		            	<option value="">Cualquiera</option>
		            	<option value="bonificado">Bonificado</option>
		          		<option value="privado">Privado</option>
		            </select>
		    </div>
		</div>

	</form>

	<div class="clearfix"></div>
	<div class="col-md-6">
        <table id="leyenda" style="">
            <tr>
                <td class="text-warning">En Progreso</td>
                <td> | </td>
                <td class="text-success">Finalizado</td>
                <td> | </td>
                <td class="text-danger">No Finalizado</td>
            </tr>
        </table>
    </div>
    </div>
	<div id="listado-seguimiento" style="">

	</div>
	<a id="imprimirListado" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>


<!-- </div> -->

<? //} ?>