<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');
include 'functions/funciones_lopd.php';

?>

<form class="formulariocuestionariolopd" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px; overflow: hidden;" class="container">

		<div id="botonesPartes">

			<div class="container col-md-offset-5">
				<a id="btnParte1" name="btnParte1" class="btn btn-primary botones">1</a>
				<a id="btnParte2" name="btnParte2" class="btn btn-primary botones">2</a>
				<a id="btnParte3" name="btnParte3" class="btn btn-primary botones">3</a>
				<a id="btnParte4" name="btnParte4" class="btn btn-primary botones">4</a>
			</div>

		</div>

		<div id="parte1" class="partes" style="display: none;">

			<div class="contaier" style="margin-top: 50px; margin-bottom: 50px;">

				<div class="col-md-5">
					<div class="form-group">
						<label class="control-label" for="nombreEmpresa">Nombre de la empresa:</label>
						<input type="text" id="nombreEmpresa" name="nombreEmpresa" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="nombreComercial">Nombre comercial:</label>
						<input type="text" id="nombreComercial" name="nombreComercial" class="form-control">
					</div>
				</div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="telefono">Teléfono:</label>
						<input type="text" id="telefono" name="telefono" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="fax">Fax:</label>
						<input type="text" id="fax" name="fax" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="email">Email:</label>
						<input type="text" id="email" name="email" class="form-control">
					</div>
				</div>
				<div class="col-md-5">
					<div class="form-group">
						<label class="control-label" for="web">Web:</label>
						<input type="text" id="web" name="web" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="personacontacto">Persona contacto:</label>
						<input type="text" id="personacontacto" name="personacontacto" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="cargo">Cargo:</label>
						<input type="text" id="cargo" name="cargo" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="actividadempresa">Actividad empresa:</label>
						<input type="text" id="actividadempresa" name="actividadempresa" class="form-control">
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label" for="telefonomovil">Teléfono móvil:</label>
						<input type="text" id="telefonomovil" name="telefonomovil" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<fieldset class="control-label" style="margin-top: 30px;"><legend>Datos fiscales</legend></fieldset>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="domiciliofiscal">Domicilio:</label>
						<input type="text" id="domiciliofiscal" name="domiciliofiscal" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="localidadfiscal">Localidad:</label>
						<input type="text" id="localidadfiscal" name="localidadfiscal" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="codpostal_fiscal">CP:</label>
						<input type="text" id="codpostal_fiscal" name="codpostal_fiscal" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="provinciaFiscal">Provincia:</label>
						<input type="text" id="provinciafiscal" name="provinciafiscal" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<fieldset class="control-label"><legend>Datos reales</legend></fieldset>

				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label" for="domicilioreal">Domicilio:</label>
						<input type="text" id="domicilioreal" name="domicilioreal" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="localidadreal">Localidad:</label>
						<input type="text" id="localidadreal" name="localidadreal" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="codpostal_real">CP:</label>
						<input type="text" id="codpostal_real" name="codpostal_real" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<fieldset class="control-label"><legend>Forma de pago</legend></fieldset>

				<div class="col-md-3">
					<div class="form-group">
						<label class="control-label">Tipo:</label>
						<select id="formapago" type="text" name="formapago" class="form-control">
							<option value="">-</option>
							<option value="recibodomiciliado">Recibo domic.</option>
							<option value="cheque">Cheque</option>
							<option value="efectivo">Efectivo</option>
							<option value="transferencia">Transferencia</option>
						</select>
					</div>
				</div>

				<div class="col-md-4 col-md-offset-1" style="margin-top: 30px;">
					<div class="col-md-5">
						<label class="control-label">Cliente esfocc:</label>
					</div>
					<div class="col-md-4">
						<?php
						opcionesRadio('clienteesfocc');
						?>
					</div>
				</div>
				<div class="col-md-4" style="margin-top: 30px;">
					<div class="col-md-6">
						<label class="control-label">Contrato firmado:</label>
					</div>
					<div class="col-md-4">
						<?php
						opcionesRadio('contratofirmado');
						?>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="numerocuenta">Número cuenta:</label>
						<input type="text" id="numerocuenta" name="numerocuenta" class="form-control">
					</div>
				</div>

			</div>

		</div>

		<div id="parte2" class="partes" style="display: none;">

			<div class="container" style="margin-top: 50px; margin-bottom: 50px;">

				<div class="col-md-3">
					<fieldset class="control-label"><legend>Nº Ordenadores</legend></fieldset>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-form" for="num_ordenadores_fijos">Fijos</label>
							<input type="number" id="num_ordenadores_fijos" name="num_ordenadores_fijos" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-form" for="num_ordenadores_portatiles">Portatiles</label>
							<input type="number" id="num_ordenadores_portatiles" name="num_ordenadores_portatiles" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-3 col-md-offset-2">
					<fieldset class="control-label"><legend>Nº Empleados</legend></fieldset>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-form" for="num_empleados_autonomos">Autónomos</label>
							<input type="number" id="num_empleados_autonomos" name="num_empleados_autonomos" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-form" for="num_empleados_reggeneral">Reg. General</label>
							<input type="number" id="num_empleados_reggeneral" name="num_empleados_reggeneral" class="form-control">
						</div>
					</div>
				</div>
				<div class="col-md-2 col-md-offset-2" style="margin-top:50px;">
					<div class="form-group">
						<label class="control-form" for="num_empleados_reggeneral">Nº Delegaciones</label>
						<input type="number" id="num_delegaciones" name="num_delegaciones" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<!-- REVISAR NOMBRES DE COLUMNAS PARA LAS PREGUNTAS -->
				<div class="col-md-10" style="margin-top: 20px;">
					<label class="control-label">¿Ha realizado la inscripción de los ficheros en el Registro General APD?:</label>
				</div>
				<div class="col-md-2" style="margin-top: 20px;">
					<?php
					opcionesRadio('inscripcion_ficheros_APD');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene una "normativa o documento de seguridad" relativa a datos de personas fisicas?:</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tienenormativa');
					?>
				</div>

				<div class="clearfix"></div>

				<fieldset class="control-label" style="margin-bottom: 30px;"><legend>Selección de personal</legend></fieldset>

				<div class="col-md-10">
					<label class="control-label">¿Recoge Currículums? ¿Tiene alguna solicitud de demanda de empleo...?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recogecurriculums');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-12">
					<label class="control-label" for="observacionesseleccion">Obervaciones:</label>
					<textarea type="text" id="observacionesseleccion" name="observacionesseleccion" class="form-control" rows="3" style="resize: none"></textarea>
				</div>

				<div class="clearfix"></div>

				<fieldset class="control-label" style="margin-top: 50px; margin-bottom: 30px;"><legend>Relaciones laborales</legend></fieldset>

				<div class="col-md-10">
					<label class="control-label">¿Tiene empleados en su empresa?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tieneempleados');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene algún tipo de control horario sobre los trabajadores de la empresa?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tiene_control_horario');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene algún control de los Riesgos Laborales en su empresa? (Hoja incidencias)</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tiene_control_riesgos');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene cámaras de seguridad en su empresa?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tiene_camaras_seguridad');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Graban?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('graban');
					?>
				</div>
				<div id="tratamiento" class="col-md-6" style="display:none;">
					<div class="form-group">
						<label class="control-label" for="sistematratamiento">Sistema de tratamiento:</label>
						<input type="text" id="sistematratamiento" name="sistematratamiento" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Las ha puesto una empresa de seguridad privada inscrita en el registro de empresas de seguridad?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('empresa_seg_registrada');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene conexión con una central de alarma?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('conexion_central_alarma');
					?>
				</div>

				<div class="clearfix"></div>

				<fieldset style="margin-bottom: 30px;"><legend>Clientes/Pacientes</legend></fieldset>

				<div class="col-md-10">
					<label class="control-label">¿Tiene página web?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tieneweb');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Recoge datos personales de sus clientes?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recoge_datos_clientes');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene algún programa de gestión de datos de clientes?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('programa_gestiondatos_clientes');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Recoge datos bancarios?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recoge_datos_bancarios');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Tiene algún programa de gestión para llevar la contabilidad de la empresa?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('tiene_programa_contabilidad');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Recoge datos personales mediante algún formulario por internet?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recoge_datos_internet');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Recoge en algún programa de correo electrónico (direcciones, teléfonos, direc.e-mail)?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recoge_datos_email');
					?>
				</div>

				<div class="clearfix"></div>

				<div class="col-md-10">
					<label class="control-label">¿Realiza presupuestos?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('realizapresupuestos');
					?>
				</div>

				<div class="clearfix"></div>

				<fieldset style="margin-bottom: 30px;"><legend>Medidas de carácter legal</legend></fieldset>

				<div class="col-md-10">
					<label class="control-label">¿Informa a sus clientes de los derechos que les confiere la Ley de Protección de Datos?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('informa_clientes_LOPD');
					?>
				</div>

				<div class="col-md-10">
					<label class="control-label">¿Realiza comunicaciones comerciales o publicitarias a sus clientes?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('realiza_comunicaciones_clientes');
					?>
				</div>

				<div class="col-md-10">
					<label class="control-label">¿Comparte datos de clientes con otras empresas? ¿Tiene el consentimiento?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('comparte_datos_clientes');
					?>
				</div>

				<div class="col-md-10">
					<label class="control-label">¿Recoge datos de menores de edad?</label>
				</div>
				<div class="col-md-2">
					<?php
					opcionesRadio('recoge_datos_menores');
					?>
				</div>

			</div>

		</div>

		<div id="parte3" class="partes" style="display: initial;">

			<div class="container" style="margin-top: 50px; margin-bottom: 50px;">

				<table id="tablaficheros" class="table table-bordered table-striped">
					<tbody id="cabeceraTablaFicheros">
						<thead>
							<th class="col-md-3" style="text-align: center;">Nombre del fichero</th>
							<th class="col-md-5" style="text-align: center;">Contenido</th>
							<th class="col-md-4" style="text-align: center;">Programa del fichero</th>
						</thead>
					</tbody>
				</table>

				<div class="clearfix"></div>

				<br><br><br><br>

				<table id="tablausuarios" class="table table-bordered table-striped">
					<thead>
						<th class="col-md-3" style="text-align: center;">Usuario (nombre y apellidos)</th>
						<th class="col-md-2" style="text-align: center;">DNI</th>
						<th class="col-md-3" style="text-align: center;">Departamento</th>
						<th class="col-md-4" style="text-align: center;">Ficheros a los que accede</th>
					</thead>
					<tbody id="campoUsuarios"></tbody>
				</table>

				<div class="col-md-2">
					<a id="btnAnadirUsuario" class="btn btn-success">
						<span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
					</a>
					<a id="btnBorrarUsuario" class="btn btn-danger">
						<span class="glyphicon glyphicon-minus-sign" aria-hidden="true"></span>
					</a>
					<a id="btnMuestraDatos" class="btn btn-warning">
						<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
					</a>
				</div>

				<div class="clearfix"></div>

				<br><br><br><br>

				<table id="tabladatos" class="table table-bordered table-striped">
					<thead>
						<th class="col-md-1"></th>
						<th class="col-md-4" style="text-align: center;">Razon social</th>
						<th class="col-md-2" style="text-align: center;">CIF</th>
						<th class="col-md-3" style="text-align: center;">Dirección</th>
						<th class="col-md-2" style="text-align: center;">Teléfono de contacto</th>
					</thead>
					<tr>
						<th class="col-md-1" style="text-align: center;">Asesoría Laboral</th>
						<td style="text-align: center;"><input type="text" id="razonsocial_asesoria_laboral" name="razonsocial_asesoria_laboral" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="cif_asesoria_laboral" name="cif_asesoria_laboral" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="direccion_asesoria_laboral" name="direccion_asesoria_laboral" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="telefono_asesoria_laboral" name="telefono_asesoria_laboral" class="form-control"></td>
					</tr>
					<tr>
						<th class="col-md-1" style="text-align: center;">Asesoría Fiscal y Contable</th>
						<td style="text-align: center;"><input type="text" id="razonsocial_asesoria_fiscal" name="razonsocial_asesoria_fiscal" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="cif_asesoria_fiscal" name="cif_asesoria_fiscal" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="direccion_asesoria_fiscal" name="direccion_asesoria_fiscal" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="telefono_asesoria_fiscal" name="telefono_asesoria_fiscal" class="form-control"></td>
					</tr>
					<tr>
						<th class="col-md-1" style="text-align: center;">Mantenimiento Informático</th>
						<td style="text-align: center;"><input type="text" id="razonsocial_mantenimiento_informatico" name="razonsocial_mantenimiento_informatico" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="cif_mantenimiento_informatico" name="cif_mantenimiento_informatico" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="direccion_mantenimiento_informatico" name="direccion_mantenimiento_informatico" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="telefono_mantenimiento_informatico" name="telefono_mantenimiento_informatico" class="form-control"></td>
					</tr>
					<tr>
						<th class="col-md-1" style="text-align: center;">Riesgos Laborales</th>
						<td style="text-align: center;"><input type="text" id="razonsocial_riesgos_laborales" name="razonsocial_riesgos_laborales" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="cif_riesgos_laborales" name="cif_riesgos_laborales" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="direccion_riesgos_laborales" name="direccion_riesgos_laborales" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="telefono_riesgos_laborales" name="telefono_riesgos_laborales" class="form-control"></td>
					</tr>
					<tr>
						<th class="col-md-1" style="text-align: center;">Otros</th>
						<td style="text-align: center;"><input type="text" id="razonsocial_otros" name="razonsocial_otros" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="cif_otros" name="cif_otros" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="direccion_otros" name="direccion_otros" class="form-control"></td>
						<td style="text-align: center;"><input type="text" id="telefono_otros" name="telefono_otros" class="form-control"></td>
					</tr>
				</table>

			</div>

		</div>

		<div id="parte4" class="partes" style="display: none;">

			<div class="container" style="margin-top: 50px; margin-bottom: 50px;">

				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="responsableseguridad">Nombre responsable seguridad:</label>
						<input type="text" id="responsableseguridad" name="responsableseguridad" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="dni_responsable_seguridad">DNI:</label>
						<input type="text" id="dni_responsable_seguridad" name="dni_responsable_seguridad" class="form-control">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label" for="representantelegal">Nombre representante legal:</label>
						<input type="text" id="representantelegal" name="representantelegal" class="form-control">
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label class="control-label" for="dni_represetante_legal">DNI:</label>
						<input type="text" id="dni_represetante_legal" name="dni_represetante_legal" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group" style="margin-top: 20px;">
					<div class="col-md-6">
						<label class="control-label" for="tiposaplicaciones">Tipos de aplicaciones o programas informáticos de gestión o propios:</label>
					</div>
					<div class="col-md-6">
						<input type="text" id="tiposaplicaciones" name="tiposaplicaciones" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label" for="sistemaoperativo">¿Qué sistema operativo utiliza? y version:</label>
					</div>
					<div class="col-md-6">
						<input type="text" id="sistemaoperativo" name="sistemaoperativo" class="form-control" placeholder="(Windows, etc)">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Los equipos estan en red?:</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('equipos_en_red');
						?>
					</div>
					<div id="cantidad" class="col-md-3" style="display: none;">
						<label class="control-label">Cantidad de equipos en red:</label>
						<input type="number" id="cantidad_equipos_red" name="cantidad_equipos_red" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Tiene servidor independiente?:</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('tieneservidor');
						?>
					</div>
					<div id="nombre" class="col-md-3" style="display: none;">
						<label class="control-label" for="nombreservidor">Nombre de servidor:</label>
						<input type="text" id="nombreservidor" name="nombreservidor" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Tienen los equipos acceso remoto?:</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('accesoremoto');
						?>
					</div>
					<div id="especificaracceso" class="col-md-3" style="display: none;">
						<label class="control-label" for="tipo_acceso_remoto">Especificar:</label>
						<input type="text" id="tipo_acceso_remoto" name="tipo_acceso_remoto" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<fieldset style="margin-bottom: 30px;"><legend>Medidas de Seguridad Informáticas</legend></fieldset>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">Para acceder al sistema informático ¿ha de introducir Usuario y contraseña?:</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('tienecredenciales');
						?>
					</div>
				</div>
				<div id="tipocredenciales" style="display: none;">
					<div class="col-md-4">
						<div class="form-group">
							<div class="col-md-8">
								<label class="control-label">En sistema operativo: caracteres contraseña</label>
							</div>
							<div class="col-md-4">
								<input type="number" id="caracteres_credenciales_so" name="caracteres_credenciales_so" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div class="col-md-8">
								<label class="control-label">En programas: caracteres</label>
							</div>
							<div class="col-md-4">
								<input type="number" id="caracteres_credenciales_programas" name="caracteres_credenciales_programas" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div class="col-md-8">
								<label class="control-label">En pantalla: caracteres</label>
							</div>
							<div class="col-md-4">
								<input type="number" id="caracteres_pantalla" name="caracteres_pantalla" class="form-control">
							</div>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<div class="col-md-4">
								<label class="control-label">¿Las cambia periódicamente?</label>
							</div>
							<div class="col-md-2">
								<?php
								opcionesRadio('cambio_credenciales_frecuente');
								?>
							</div>
							<div id="perioricidadcredenciales" class="col-md-3" style="display: none;">
								<label class="control-label" for="periodicidad_cambio_credenciales">Periodicidad:</label>
								<input type="text" id="periodicidad_cambio_credenciales" name="periodicidad_cambio_credenciales" class="form-control">
							</div>
						</div>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Cada usuario tiene contraseña?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('usuario_con_password');
						?>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-8">
						<label class="control-label" for="datos_acceso_usuarios">¿Los usuaros pueden acceder solo a los datos autorizados por sus funciones, o podrían acceder a algunos más?</label>
					</div>
					<div class="col-md-4">
						<input type="text" id="datos_acceso_usuarios" name="datos_acceso_usuarios" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Existe en el programa un registro de accesos?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('registroaccesos');
						?>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Realiza copias de seguridad?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('realiza_copia_seguridad');
						?>
					</div>
					<div class="clearfix"></div>
					<div id="perioricidadcopiaseguridad" class="col-md-12" style="display: none;">
						<div class="col-md-2">
							<label class="control-label" for="periodicidad_copia_seguridad">Periodicidad:</label>
							<input type="text" id="periodicidad_copia_seguridad" name="periodicidad_copia_seguridad" class="form-control">
						</div>
						<div class="col-md-5">
							<label class="control-label" for="encargado_copia_seguridad">Nombre y apellidos de la persona que se encarga de realizarlas</label>
							<input type="text" id="encargado_copia_seguridad" name="encargado_copia_seguridad" class="form-control">
						</div>
						<div class="col-md-4">
							<label class="control-label" for="detalles_copia_seguridad">¿Como y donde se guardan?</label>
							<input type="text" id="detalles_copia_seguridad" name="detalles_copia_seguridad" class="form-control">
						</div>
					</div>
				</div>

				<div class="clearfix"></div>

				<fieldset style="margin-bottom:30px;"><legend>Medidas de seguridad archivos papel</legend></fieldset>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Guardan la documentación en armarios, archivos, etc, con mecanismos que obstaculicen su apertura (llave)?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('guardadocumentacion');
						?>
					</div>
					<div class="guardadocumentacion" class="col-md-3">
						<div id="si" class="col-md-3" style="display:none; float:left;">
							<label class="control-label">¿Se encuentran en áreas protegidas con puertas de acceso con llave o equivalente?</label>
							<?php
							opcionesRadio('guardadocumentacionsi');
							?>
						</div>
						<div id="no" class="col-md-3" style="display:none; float:left;">
							<label class="control-label" for="guardadocumentacionno">¿Qué medidas se toman para evitar el acceso no autorizado?</label>
							<input type="text" id="medidas_acceso_no_autorizado" name="medidas_acceso_no_autorizado" class="form-control">
						</div>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Existen mecanismos para identificar el acceso realizaado cuando los documentos son utilizados por múltiples usuarios?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('identificacionacceso');
						?>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Adopta la entidad medidas de seguridad que impidan el acceso o manipulación de los datos cuando son objetos de translado físico?</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('medidas_seguridad_manipulacion');
						?>
					</div>
					<div id="manipulacion" class="col-md-3" style="display:none;">
						<label class="control-label" for="medidas_seguridad_detalles">Especificar:</label>
						<input type="text" id="medidas_seguridad_detalles" name="medidas_seguridad_detalles" class="form-control">
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<div class="col-md-6">
						<label class="control-label">¿Se destruye la documentacion desechada de forma que no se pueda acceder a la información contenida? (destructora de papel)</label>
					</div>
					<div class="col-md-2">
						<?php
						opcionesRadio('destruccioninformacion');
						?>
					</div>
				</div>

				<div class="clearfix"></div>

				<div class="form-group">
					<label class="control-label" for="observacionesgenerales">Observaciones generales:</label>
					<textarea id="observacionesgenerales" name="observacionesgenerales" class="form-control" rows="5" style="resize:none;"></textarea>
				</div>

			</div>

		</div>

	</div>
</form>

<script type="text/javascript">

	//EVENTOS

	$(document).on("click", "#btnParte1", function(event){

		paginaActiva('parte1', 'btnParte1');

	});

	$(document).on("click", "#btnParte2", function(event){

		paginaActiva('parte2', 'btnParte2');

	});

	$(document).on("click", "#btnParte3", function(event){

		paginaActiva('parte3', 'btnParte3');

	});

	$(document).on("click", "#btnParte4", function(event){

		paginaActiva('parte4', 'btnParte4');

	});

	//CONTROLES DE RADIO PARA GENERAR TABLA DE FICHEROS (PASO 3)

	$(document).on("change", "input[type=radio][name=tieneempleados]", function(event){

		var fila, opcion;
		var datos = ['nominas', 'personal', 'rrhh'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="nominas">\
			<td><input type=text class="form-control" value="NOMINAS" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO NOMINAS" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA NOMINAS" disabled></td>\
		</tr>\
		<tr class="personal">\
			<td><input type=text class="form-control" value="PERSONAL" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO PERSONAL" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA PERSONAL" disabled></td>\
		</tr>\
		<tr class="rrhh">\
			<td><input type=text class="form-control" value="RRHH" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO RRHH" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA RRHH" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	$(document).on("change", "input[type=radio][name=tieneweb]", function(event){

		var fila, opcion;
		var datos = ['cv'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="cv">\
			<td><input type=text class="form-control" value="PÁGINA WEB" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO PÁGINA WEB" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA PÁGINA WEB" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	$(document).on("change", "input[type=radio][name=recogecurriculums]", function(event){

		var fila, opcion;
		var datos = ['cv'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="cv">\
			<td><input type=text class="form-control" value="CV" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO CV" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA CV" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	$(document).on("change", "input[type=radio][name=tiene_camaras_seguridad]", function(event){


		var fila, opcion;
		var datos = ['videovigilancia'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="videovigilancia">\
			<td><input type=text class="form-control" value="VIDEOVIGILANCIA" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO VIDEOVIGILANCIA" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA VIDEOVIGILANCIA" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	$(document).on("change", "input[type=radio][name=recoge_datos_email]", function(event){


		var fila, opcion;
		var datos = ['correoElectronico'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="correoElectronico">\
			<td><input type=text class="form-control" value="CORREO ELECTRONICO" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO CORREO ELECTRONICO" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA CORREO ELECTRONICO" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	$(document).on("change", "input[type=radio][name=realizapresupuestos]", function(event){

		var fila, opcion;
		var datos = ['presupuestos'];

		if ($(this).val() == 'Si') {
			fila = '<tr class="presupuestos">\
			<td><input type=text class="form-control" value="PRESUPUESTOS" disabled></td>\
			<td><input type=text class="form-control" value="CONTENIDO FICHERO PRESUPUESTOS" disabled></td>\
			<td><input type=text class="form-control" value="PROGRAMA PRESUPUESTOS" disabled></td>\</tr>';
			opcion = 'Si';
		}else{
			fila = '';
			opcion = 'No';
		}

		crearTablaFicheros(fila, opcion, datos);

	});

	//OTROS CONTROLES DE RADIO

	$(document).on("change", "input[type=radio][name=graban]", function(event){

		if ($(this).val() == 'Si') {
			$("#tratamiento").css('display', 'initial');
		}else{
			$("#tratamiento").css('display', 'none');
			$("#sistematratamiento").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=equipos_en_red]", function(event){

		if ($(this).val() == 'Si') {
			$("#cantidad").css('display', 'initial');
		}else{
			$("#cantidad").css('display', 'none');
			$("#cantidad_equipos_red").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=tieneservidor]", function(event){

		if ($(this).val() == 'Si') {
			$("#nombre").css('display', 'initial');
		}else{
			$("#nombre").css('display', 'none');
			$("#nombreservidor").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=accesoremoto]", function(event){

		if ($(this).val() == 'Si') {
			$("#especificaracceso").css('display', 'initial');
		}else{
			$("#especificaracceso").css('display', 'none');
			$("#tipo_acceso_remoto").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=tienecredenciales]", function(event){

		if ($(this).val() == 'Si') {
			$("#tipocredenciales").css('display', 'initial');
		}else{
			$("#tipocredenciales").css('display', 'none');
			$("#caracteres_credenciales_so").val('');
			$("#caracteres_credenciales_programas").val('');
			$("#caracteres_pantalla").val('');
			$('input:radio[name=cambio_credenciales_frecuente]').prop('checked', false);
			$("#periodicidad_cambio_credenciales").val('');
			$("#perioricidadcredenciales").css('display', 'none');
		}

	});

	$(document).on("change", "input[type=radio][name=cambio_credenciales_frecuente]", function(event){

		if ($(this).val() == 'Si') {
			$("#perioricidadcredenciales").css('display', 'initial');
		}else{
			$("#perioricidadcredenciales").css('display', 'none');
			$("#periodicidad_cambio_credenciales").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=realiza_copia_seguridad]", function(event){

		if ($(this).val() == 'Si') {
			$("#perioricidadcopiaseguridad").css('display', 'initial');
		}else{
			$("#perioricidadcopiaseguridad").css('display', 'none');
			$("#periodicidad_copia_seguridad").val('');
			$("#encargado_copia_seguridad").val('');
			$("#detalles_copia_seguridad").val('');
		}

	});

	$(document).on("change", "input[type=radio][name=guardadocumentacion]", function(event){

		if ($(this).val() == 'Si') {
			$("#si").css('display', 'initial');
			$("#no").css('display', 'none');
			$("#medidas_acceso_no_autorizado").val('');
		}else{
			$("#no").css('display', 'initial');
			$("#si").css('display', 'none');
			$('input:radio[name=guardadocumentacionsi]').prop('checked', false);
		}

	});

	$(document).on("change", "input[type=radio][name=medidas_seguridad_manipulacion]", function(event){

		if ($(this).val() == 'Si') {
			$("#manipulacion").css('display', 'initial');
		}else{
			$("#manipulacion").css('display', 'none');
			$("#medidas_seguridad_detalles").val('');
		}

	});

	//BOTONES PARA AÑADIR O ELIMINAR FILAS DE LA TABLA DE USUARIOS

	$(document).on("click", "#btnAnadirUsuario", function(event){

		var longitud = $("#tablausuarios tr").length;

		var fila = '\
		<tr id="usuario">\
			<td><input id="nombreUsuario" type="text" class="form-control usuario"></td>\
			<td><input id="dniUsuario" type="text" class="form-control usuario"></td>\
			<td><input id="departamentoUsuario" type="text" class="form-control usuario"></td>\
			<td><input id="ficherosUsuario" type="text" class="form-control usuario"></td>\
		</tr>';

		$('#tablausuarios').append(fila);

	});

	$(document).on("click", "#btnBorrarUsuario", function(event){

		var longitud = $("#tablausuarios tr").length;

		if(longitud > 1){

			$('#tablausuarios tr:last').remove();

		}

	});

	$(document).on("click", "#btnMuestraDatos", function(event){

		var listadoUsuarios = [];
		var tabla = $("#tablausuarios tbody > tr");

		tabla.each(function(){

			//Voy recorriendo la tabla y almacenando los datos de cada fila
			/*var id = $(this).find("td[id='usuario']").text();*/
			var nombreUsuario = $(this).find("input[id='nombreUsuario']").val(),
				dniUsuario = $(this).find("input[id='dniUsuario']").val(),
				direccionUsuario = $(this).find("input[id='direccionUsuario']").val(),
				ficherosUsuario = $(this).find("input[id='ficherosUsuario']").val();

			console.log(nombreUsuario + ' ' + dniUsuario + ' ' + direccionUsuario + ' ' + ficherosUsuario);

			//Declaro un array para almacenar los datos
			lista = {};

			//Si tiene id entonces lo almaceno en el array
			if(id !== ''){

				lista ["nombreUsuario"] = nombreUsuario;
				lista ["dniUsuario"] = dniUsuario;
				lista ["direccionUsuario"] = direccionUsuario;
				lista ["ficherosUsuario"] = ficherosUsuario;


				//Guardamos el elemento en el listado
				listadoUsuarios.push(lista);

			}

		});

		/*console.log(listadoUsuarios);*/

		var formData = new FormData();
		var datos = JSON.stringify(listadoUsuarios);

		formData.append('listado', datos);

		/*console.log(formData);*/

		/*$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones_lopd.php',
			data: formData + '&prueba=1',
			success : function(data){

				console.log(data);

			}
		});*/

	});


	//FUNCIONES

	function paginaActiva(paginaActiva, btnSeleccionado){

		$(".partes").css('display','none');
		$("#"+paginaActiva).css('display','initial');
		$(".botones").css('background', '#3276B1');
		$("#"+btnSeleccionado).css('background', '#194E7C');

	}

	function crearTablaFicheros(fila, opcion, datos){

		var contenidoTabla = '<thead>\
		<th class="col-md-3">Nombre del fichero</th>\
		<th class="col-md-5">Contenido</th>\
		<th class="col-md-4">Programa del fichero</th>\</thead>';

		if (opcion == 'Si') {
			$("#tablaficheros").html($("#tablaficheros").html() + fila);
		}else{
			for(var i=0; i < datos.length; i++){
				$('tr.'+datos[i]).remove();
			}
		}

	}

</script>