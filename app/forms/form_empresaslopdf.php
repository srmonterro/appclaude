<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');
include 'functions/funciones_lopd.php';

?>

<!-- Funciones PHP -->
<?php
//ESTA FUNCIONANDO DESDE EL ARCHIVO funciones_lopd.php
/*function opcionesRadio($name){

	echo '<label class="radio-inline"><input type="radio" name="'.$name.'" value="Si" required>Si</label>';
	echo '<label class="radio-inline"><input type="radio" name="'.$name.'" value="No">No</label>';

}*/

?>


<form class="formularioempresaslopd" id="formulario" role="form" action="" method="post">
	<div style="margin-top: 30px" class="container">

		<input type="hidden" id="id" name="id" class="form-control" />
		<input type="hidden" id="tabla" name="tabla" value="empresas_lopd" class="form-control" />

		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="razonsocial">Razón Social:</label>
				<input type="text" id="razonsocial" name="razonsocial" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="cif">CIF:</label>
				<input type="text" id="cif" name="cif" class="form-control" />
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<label class="control-label" for="direccion">Dirección:</label>
				<input type="text" id="direccion" name="direccion" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="representantelegal">Representante legal:</label>
				<input type="text" id="representantelegal" name="representantelegal" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="nombrecomercial">Nombre Comercial:</label>
				<input type="text" id="nombrecomercial" name="nombrecomercial" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="telefonofijo">Teléfono:</label>
				<input type="text" id="telefonofijo" name="telefonofijo" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="telefonomovil">Móvil:</label>
				<input type="text" id="telefonomovil" name="telefonomovil" class="form-control"  />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="telefonofax">FAX:</label>
				<input type="text" id="telefonofax" name="telefonofax" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="email">E-mail:</label>
				<input type="text" id="email" name="email" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="paginaweb">Página web:</label>
				<input type="text" id="paginaweb" name="paginaweb" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="actividadempresa">Actividad de la empresa:</label>
				<input type="text" id="actividadempresa" name="actividadempresa" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="num_ordenadores">Nº Ordenadores fijos y portatiles:</label>
				<input type="number" id="num_ordenadores" name="num_ordenadores" class="form-control" />
			</div>
		</div>
		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="num_trabajadores">Nº Trabajadores aut y rég gral:</label>
				<input type="number" id="num_trabajadores" name="num_trabajadores" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12" style="margin-top: 30px;">
			<div class="form-group">
				<fieldset class="control-label"><legend>Datos de la asesoria laboral, fiscal y contable</legend></fieldset>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="razonsocial_asesoria">Razon Social:</label>
				<input type="text" id="razonsocial_asesoria" name="razonsocial_asesoria" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="cif_asesoria">CIF:</label>
				<input type="text" id="cif_asesoria" name="cif_asesoria" class="form-control" />
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<label class="control-label" for="direccion_asesoria">Dirección:</label>
				<input type="text" id="direccion_asesoria" name="direccion_asesoria" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12" style="margin-top: 30px;">
			<div class="form-group">
				<fieldset class="control-label"><legend>Datos de la empresa de mantenimiento informático</legend></fieldset>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="razonsocial_mantenimiento">Razon Social:</label>
				<input type="text" id="razonsocial_mantenimiento" name="razonsocial_mantenimiento" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="cif_mantenimiento">CIF:</label>
				<input type="text" id="cif_mantenimiento" name="cif_mantenimiento" class="form-control" />
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<label class="control-label" for="direccion_mantenimiento">Dirección:</label>
				<input type="text" id="direccion_mantenimiento" name="direccion_mantenimiento" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="col-md-12" style="margin-top: 30px;">
			<div class="form-group">
				<fieldset class="control-label"><legend>Datos de la empresa de prevención de riesgos</legend></fieldset>
			</div>
		</div>

		<div class="col-md-3">
			<div class="form-group">
				<label class="control-label" for="razonsocial_prevencion">Razon Social:</label>
				<input type="text" id="razonsocial_prevencion" name="razonsocial_prevencion" class="form-control" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label class="control-label" for="cif_prevencion">CIF:</label>
				<input type="text" id="cif_prevencion" name="cif_prevencion" class="form-control" />
			</div>
		</div>
		<div class="col-md-7">
			<div class="form-group">
				<label class="control-label" for="direccion_prevencion">Dirección:</label>
				<input type="text" id="direccion_prevencion" name="direccion_prevencion" class="form-control" />
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-md-4" style="margin-top: 30px;">
				<label class="control-label" for="recogecurriculums">Recoge currículums:</label>
			</div>
			<div class="col-md-2" style="margin-top: 30px;">
				<?php
				opcionesRadio('recogecurriculums');
				?>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="camarasseguridad">Camaras de seguridad:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('camarasseguridad');
				?>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="alarma">Tiene alarma:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('alarma');
				?>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="datos_personales_clientes">Recoge datos personales de clientes:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('datos_personales_clientes');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="datos_bancarios_clientes">Recoge datos bancarios de clientes:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('datos_bancarios_clientes');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="datos_personales_internet">Recoge datos personales por internet:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('datos_personales_internet');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="realizapresupuestos">Realiza presupuestos:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('realizapresupuestos');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="realizacomunicaciones">Realiza o realizara comunicaciones comerciales a sus clientes:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('realizacomunicaciones');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="tieneservidor">Tiene servidor:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('tieneservidor');
				?>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="credencialesequipos">Tiene usuario y contraseña en los equipos:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('credencialesequipos');
				?>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="sistemaoperativo">Sistema operativo de los ordenadores:</label>
					<input type="text" id="sistemaoperativo" name="sistemaoperativo" class="form-control" />
				</div>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="copiasseguridad">Realiza copias de seguridad:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('copiasseguridad');
				?>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="autor_copias_seguridad">Quien las realiza:</label>
					<input type="text" id="autor_copias_seguridad" name="autor_copias_seguridad" class="form-control" required />
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="ubicacioncopias">Donde las guarda:</label>
					<input type="text" id="ubicacioncopias" name="ubicacioncopias" class="form-control" required />
				</div>
			</div>
		</div>


		<div class="clearfix"></div>


		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="destructorapapel">Tiene destructora de papel:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('destructorapapel');
				?>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label" for="documentacionpapel">Como guarda la documentacion en papel:</label>
					<input type="text" id="documentacionpapel" name="documentacionpapel" class="form-control" required />
				</div>
			</div>
		</div>


		<div class="clearfix"></div>

		<div class="form-group">
			<div class="col-md-4">
				<label class="control-label" for="tpv">Tiene TPV:</label>
			</div>
			<div class="col-md-2">
				<?php
				opcionesRadio('tpv');
				?>
			</div>
		</div>


		<div class="clearfix"></div>

		<input type="hidden" name="tabla" id="tabla" value="empresas_lopd">

		<div class="col-md-6 col-md-offset-3">
			<button id="btnGuardarEmpresaLopd" name="btnGuardarEmpresaLopd" type="submit" class="btn btn-primary">Guardar Empresa</button>
			<a id="abrebusqueda" href="#" data-toggle="modal" class="btn btn-primary">Mostrar Empresas</a>
			<!-- <a id="prueba" name="prueba" type="submit" class="btn btn-primary">Prueba</a> -->
		</div>

	</div>
</form>

<!-- JQuery y Ajax -->
<script type="text/javascript">

	$('.formularioempresaslopd').validate({

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');

				var datos = $('#formulario').find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "POST",
					data: datos,
					success: function(result){
						console.log(result);
					},
					error:function(){
						alert("failure");
					}
				});
			});
		},

		highlight : function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight : function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement : 'span',
		errorClass : 'help-block',
		errorPlacement : function(error, element) {

			if (element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		}
	});

	$(document).on("click", "#abrebusqueda", function(event){

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'abre=1&tabla=empresas_lopd',
			success : function(data){
				$(".empresaslopd").html(data);
			}
		});

	});

	$(document).on("click", "#seleccionarempresaslopd", function(event){

		event.preventDefault();

		var id = $(this).attr('iden');
		var tabla = $(this).attr('tabla');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			dataType: 'json',
			data: 'id='+id+'&tabla='+tabla+'&cierra=1',
			success: function(data)
			{
				/*console.log(data[0]);*/

				$("#mostrardatos").modal('hide');

				for ( key in data[0] ) {
					$('#'+key).val(data[0][key]);
					//Compruebo por name porque el radio no tiene id
					if ( $('input[name='+key+']').attr('type') == 'radio' ) {
						$('input:radio[name='+key+'][value='+data[0][key]+']').click();
					}
					// if ( $('#'+key).attr('type') == 'radio' ) {
					// // 	$('input:radio[name='+key+'][value='+data[0][key]+']').click();
					// 	console.log("radiooo");
					// }
				}

				//PARA SETEAR UN RADIOBUTTON
				/*$('input:radio[name='+nombre+'][value='+data[0][nombre]+']').click();*/

			}
		});

	});

</script>