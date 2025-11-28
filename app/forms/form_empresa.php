
<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');

 ?>

<form class="formularioempresa" id="formulario" role="form" action="" method="post">
<div style="margin-top: 30px" class="container">

	<div style="display:none" id="confirmacion" class="inv alert alert-success">Empresa guardada correctamente.</div>
	<div style="display:none" id="error" class="alert alert-danger">El CIF introducido ya existe en la base de datos.</div>


	<div class="clearfix"></div>

		<div class="col-md-3">
	    	<div class="form-group">
			    <label class="control-label" for="estado_revision">Estado:</label>
			    <select id="estado_revision" name="estado_revision" class="form-control">
					<option value="Pendiente">Pendiente de revisión</option>
					<option value="Revisada">Revisada</option>
					<option value="Correo_devuelto">Correo devuelto</option>
			   	</select>
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="fecha_revision">Fecha Revisión:</label>
			    <input type="date" id="fecha_revision" name="fecha_revision" class=" form-control" />
		    </div>
		</div>

		<div class="col-md-2" style="margin-top:30px">
	    	<div class="form-group">
			    <label class="control-label" for="mailing">Mailing  </label>
			    <input type="checkbox" id="mailing" value="1" name="mailing" />
		    </div>
		</div>

		<div class="col-md-3 pull-right">
	    	<div class="form-group">
			    <label class="control-label" for="categoria">Categoría:</label>
			    <select id="categoria" name="categoria" class="required form-control">
					<?

						if ( $gestion != '' ) {

							echo '<option value="">Sin categoría</option>';

							$q = 'SELECT *
					    FROM categorias_empresa
					    ORDER By id ASC';
					    echo $q;
					    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

					    while ( $row = mysqli_fetch_array($q) )
					        echo '<option value="'.$row[id].'">'. $row[categoria] .'</option>';

						}

						echo '<option value="-">Sin categoría</option>';


					?>
		   	</select>
		    </div>
		</div>


	<div class="clearfix"></div>


    <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="nombrecomercial">Nombre:</label>
		    <input type="text" id="nombrecomercial" name="nombrecomercial" class="form-control" />
	    </div>
	</div>
    <div class="col-md-5">
    	<div class="form-group">
		    <label class="control-label" for="razonsocial">Razón Social:</label>
		    <input type="text" id="razonsocial" name="razonsocial" class="form-control required" />
		</div>
	</div>
	<div class="col-md-2">
        <div class="form-group">
            <label class="control-label" for="grupo">Grupo:</label>
            <select id="grupo" name="grupo" class="form-control">
                <?
                    $q = 'SELECT id, grupo
                    FROM grupos_empresas ORDER by id ASC';
                    $q = mysqli_query($link,$q);
                    while ($row = mysqli_fetch_array($q))
                        echo '<option value="'.$row['id'].'">'.$row['grupo'].'</option>';
                ?>
            </select>
        </div>
    </div>
    <div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="firmanexo">Firma Anexo:</label>
		    <input type="date" id="firmanexo" name="firmanexo" class="form-control" />
	    </div>
   	</div>

	 <div class="col-md-3">
    	<div class="form-group">
		    <label class="control-label" for="cif">CIF:</label>
		    <input type="text" id="cif" name="cif" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
		</div>
	</div>

	<div class="col-md-3">
		<input type="hidden" disabled id="iban-ant" name="iban-ant" class=" form-control" />
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
				<!-- <option value="Domiciliación">Domiciliación</option> -->
		   	</select>
	    </div>
	</div>
	<div class="col-md-2">
    	<div class="form-group">
	        <label class="control-label" for="vencimiento">Vencimiento (días):</label>
	        <input type="text" id="vencimiento" name="vencimiento" class="form-control" />
    	</div>
	</div>

	<div class="col-md-2 pull-right">
		<div style="width: 100%;" class="pull-right">
			<a style="margin-top: 25px; width: 100%;" href="#" data-toggle=modal id="agregarcontactos" class="btn btn-default"><span class="glyphicon glyphicon-user"></span> Contactos</a>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="telefono">Teléfono:</label>
		    <input type="text" id="telefono" name="telefono" class="form-control" />
	    </div>
	</div>

	<div class="col-md-3">
		<div class="form-group">
		    <label class="control-label" for="email">Email:</label>
		    <input type="text" id="email" name="email" class="form-control" />
	    </div>
   	</div>
   	<div class="col-md-3">
		<div class="form-group">
		    <label class="control-label" for="email_facturas">Email Contabilidad:</label>
		    <input type="text" id="email_facturas" name="email_facturas" class="form-control" />
	    </div>
   	</div>
   	<? if ( $gestion != "" ) { ?>
	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="agente">Agente:</label>
		    	<select id="agente" name="agente" class="form-control">
		    		<option value="">No asignado</option> <?

		    		$q = 'SELECT nombre
					    FROM agentes';
					    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

					    while ( $row = mysqli_fetch_array($q) ) {
					    	echo '<option value="'.$row[nombre].'">'.$row[nombre].'</option>';
					    }

					?>
		    	</select>
	    </div>
	</div>
	<? } ?>
	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="comercial">Comercial:</label>
		    <select id="comercial" name="comercial" class="form-control" <? if ( $_SESSION[user] != 'cristina' ) echo 'required'; ?>>
				<?
					echo '<option value="">No asignado</option>';
	    			$q = 'SELECT id,nombre,apellido,apellido2
	    			FROM comerciales ORDER by id ASC';
	    			$q = mysqli_query($link,$q);

	    			while ($row = mysqli_fetch_array($q))
	    				echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' '.$row['apellido2'].'</option>';
	    		?>
		   	</select>
	    </div>
	</div>

	<div class="col-md-3">
   		<div class="form-group">
		    <label class="control-label" for="comisionistatxt">Comisionista:</label>
		    <div class="input-group">
		    	<input placeholder="Búsqueda por nombre" id="comisionistatxt" name="comisionistatxt" class="form-control" />
		  	    <span class="input-group-btn">
			        <a id="buscarcomisionista" class="btn btn-default"><span id="buscarcomisionista" class="glyphicon glyphicon-search"></span></a>
			    </span>
		    </div>
	        <input type="hidden" id="comisionista" name="comisionista" class="form-control" />
    </div>
	</div>


	<div class="col-md-3">
   		<div class="form-group">
		    <label class="control-label" for="convenio">Convenio colectivo de referencia:</label>
		    <input type="text" id="convenio" name="convenio" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
	    </div>
	</div>
   	<div class="col-md-3">
   		<div class="form-group">
		    <label class="control-label" for="actividad">Actividad principal:</label>
		    <div class="input-group">
		    	<input placeholder="Inserta el nombre de la actividad (aproximado) y busca" id="actividad" name="actividad" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
		  	    <span class="input-group-btn">
			        <a id="buscaractividad" class="btn btn-default"><span id="buscar" class="glyphicon glyphicon-search"></span></a>
			    </span>
		    </div>
	    </div>
	</div>

	<div class="col-md-3 pull-right">
		<input type="hidden" name="modifcuentas" id="modifcuentas" value="0" />
		<input type="hidden" name="numerocuenta" id="hcuentacotizacion" value="" disabled/>
		<div style="margin-top: 25px; width: 100%;" class="pull-right">
			<a style="width: 100%;" href="#" data-toggle=modal id="agregarcuentas" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Cuentas de Cotización </a>
		</div>
	</div>

	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="plantillamedia">Plantilla Media <? echo date('Y')-1; ?>:</label>
		    <input type="text" id="plantillamedia" name="plantillamedia" class="form-control" />
	    </div>
   	</div>

   	<div class="col-md-1">
		<div class="form-group">
		    <label class="control-label" for="porcentajecof">% Cof.:</label>
		    <input type="text" id="porcentajecof" name="porcentajecof" class="form-control" readonly />
	    </div>
   	</div>


   	<div class="col-md-2">
   		<div class="checkbox">
	 		<label>
	   			<input id="empresacreada" type="checkbox" name="empresacreada" value="1">¿ Creada este año ?
	   		</label>
	   	</div>
	</div>

   	<div class="col-md-2">
		<div class="form-group">
		    <label class="control-label" for="fechacreacion">Fecha de Creación:</label>
		    <input type="date" id="fechacreacion" name="fechacreacion" class="form-control" disabled/>
	    </div>
   	</div>

   	<!-- <div class="col-md-1">
   		<div style="margin-top: 30px;" class="checkbox">
	 		<label>
	   			<input type="checkbox" id="representacionlegal" name="representacionlegal" value="1">¿RLT?
	   		</label>
	   	</div>
	</div> -->
	<div class="col-md-1">
    	<div class="form-group">
		    <label class="control-label" for="representacionlegal">RLT:</label>
    		<select id="representacionlegal" name="representacionlegal" class="form-control" <? if ( $_SESSION[user] != 'cristina' ) echo 'required'; ?>>
    			<option value="">-</option>
    			<option value="0">No</option>
    			<option value="1">Sí</option>
		    </select>
		</div>
	</div>
   	<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="credito">Crédito:</label>
		    <input type="text" id="credito" name="credito" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
		</div>
	</div>
   	<div class="col-md-2">
   		<div class="form-group">
    		<label class="control-label" for="tipocredito">Tipo:</label>
    		<select id="tipocredito" name="tipocredito" class="form-control">
    			<option value="Provisional">Provisional</option>
    			<option value="Definitivo">Definitivo</option>
		    </select>
    	</div>
    </div>

	<div class="clearfix"></div>

	<div class="col-md-4">
    	<div class="form-group">
        <label class="control-label" for="importecuenta640">Importe Cuenta 640:</label>
        <input type="text" id="importecuenta640" name="importecuenta640" class="form-control" />
    	</div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
        <label class="control-label" for="importecuenta642">Importe Cuenta 642:</label>
        <input type="text" id="importecuenta642" name="importecuenta642" class="form-control" />
    	</div>
	</div>
	<div class="col-md-4">
    	<div class="form-group">
        <label class="control-label" for="numhorasanuales">Nº Horas Trabajo Anuales:</label>
        <input type="text" id="numhorasanuales" name="numhorasanuales" class="form-control" />
    	</div>
	</div>

	<div class="col-md-6">
    	<div class="form-group">
		    <label class="control-label" for="domiciliosocial">Domicilio Social:</label>
		    <input type="text" id="domiciliosocial" name="domiciliosocial" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
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
		      	<input type="text" id="codigopostal" name="codigopostal" <? if ( $_SESSION[user] == 'cristina' || $_SESSION['user'] == 'rmedina') echo 'class="form-control"'; else echo 'class="required form-control"'; ?> />
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

   	<fieldset><legend>Crédito</legend>

   	<?

   	// $autogestion = array(9740,6348,15,5630);

   	if ( ($_SESSION['user'] == 'amanda' || $_SESSION['user'] == 'root') )
   		$disabled = '';
   	else
   		$disabled = ' disabled ';

   	?>

	<div class="col-md-3">
    	<div class="form-group">
        <label class="control-label" for="asignado">Asignado:</label>
        <input type="text" id="asignado" name="asignado" class="form-control"  <? echo $disabled ?> />
    	</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        <label class="control-label" for="dispuesto_acciones">Dispuesto Acciones:</label>
        <input type="text" id="dispuesto_acciones" name="dispuesto_acciones" class="form-control" <? echo $disabled ?> />
    	</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        <label class="control-label" for="dispuesto_pif">Dispuesto PIF:</label>
        <input type="text" id="dispuesto_pif" name="dispuesto_pif" class="form-control" <? echo $disabled ?> />
    	</div>
	</div>
	<div class="col-md-3">
    	<div class="form-group">
        <label class="control-label" for="disponible">Disponible:</label>
        <input type="text" id="disponible" name="disponible" class="form-control" <? echo $disabled ?> />
    	</div>
	</div>

	<div class="clearfix"></div>

	<div class="col-md-12">
    	<div class="form-group">
        <label class="control-label" for="actualizado_a">Actualizado a:</label>
        <input type="text" id="actualizado_a" name="actualizado_a" class="form-control" <? echo $disabled ?> />
    	</div>
	</div>

	</fieldset>

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

   	<input name="tabla" type="hidden" id="tabla" value="empresas" />
   	<input name="id" type="hidden" id="id" value="" />
</div>

<p style="text-align: center; margin-top: 30px;">

	<? if ( $comercial === false ) { ?>
	<input type="submit" name="submit" value="Guardar Empresa" class="btn btn-primary btn-lg">
	<? } ?>
	<a id="abrebusqueda" href="#" data-toggle=modal class="btn btn-lg btn-primary">Mostrar Empresas</a><br>
	<a id="subirinformes" style="display:none; margin-top: 15px; text-align: center" name="" class="btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Documentación Empresa</a>
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


