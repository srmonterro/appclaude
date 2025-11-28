<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');
$anio = devuelveAnioReal();

?>

<div style="margin-top: 45px" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Seguimiento Diplomas</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="numeroaccion">Acción Formativa:</label>
	            <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
	        </div>
	    </div>
	    <div class="col-md-5">
	        <div class="form-group">
	            <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
	            <input type="text" id="denominacion" name="denominacion" class="form-control"  />
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
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimientodiplo" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
		</div>

		<div class="clearfix"></div>
		<div class="col-md-12" style="height: 15px;"></div>
		<div class="clearfix"></div>

		<div class="col-md-3">
	        <div class="cp form-group">
   			<label class="control-label" for="nombre">Nombre:</label>
   			<input type="text" id="nombre" name="nombre" class="form-control"  />
   			</div>
	    </div>
	    <div class="col-md-3">
	        <div class="cp form-group">
   			<label class="control-label" for="apellido">Apellido:</label>
   			<input type="text" id="apellido" name="apellido" class="form-control"  />
   			</div>
	    </div>
	    <div class="col-md-3">
	        <div class="cp form-group">
   			<label class="control-label" for="apellido2">Apellido 2:</label>
   			<input type="text" id="apellido2" name="apellido2" class="form-control"  />
   			</div>
	    </div>
	    <div class="col-md-3">
		    <div class="form-group">
		       <label class="control-label" for="modalidad">Modalidad:</label>
		            <select id="modalidad" name="modalidad" class="form-control">
		            	<option value="">Cualquiera</option>
		            	<option value="Teleformación">Teleformación</option>
		          		<option value="A Distancia">A Distancia</option>
		          		<option value="Mixta">Mixta</option>
		            </select>
		    </div>
		</div>

	</form>	

	<div class="clearfix"></div>

	<div id="listado-seguimiento" style="">

	</div>
	<form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

		<a id="imprimirSeguimientoc" onclick="printDiv('listado-seguimiento')" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

		<a id="listadoExcel" style="display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>

		<input type="hidden" id="datatodisplay" name="datatodisplay" />
	</form>

</div>

<script type="text/javascript">

function getRowNombre(button) {
	    var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#nombre').html();
	}

$(document).on("click", "#busqueda-seguimientodiplo", function(event) {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');
	$(this).find('span').addClass('spin');


	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimientodiplo.php',
		data: values,
		success: function(data) 
		{
		    
		    $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');
		    $('.glyphicon-search').removeClass('spin')
		    
			$('#listado-seguimiento').html(data);
			// var sum = 0;
			// $("td#importecomision").each(function() {

			//     var value = $(this).text();
			//     value = value.split(" €");
			//     value = value[0].replace(".","");
			//     value = value.replace(",",".");

			//     // add only if the value is number
			//     if(!isNaN(value) && value.length != 0) {
			//         sum += parseFloat(value);
			//     }
			// });
			// $('.table').append('<tr><td colspan="6"></td><td class="success">Total Comisión: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr>');
			// $('#imprimirSeguimientoc').css('display','inline-block');
			// $('#listadoExcel').css('display','inline-block');
			// $('#listadoExcel').css('margin-right','5px');
		    
		}

	}); ajax.abort();	

});


$(document).on("click", "#restablecer-c", function(event){
		$('#form-seguimiento')[0].reset();
});

$(document).on("click", "#listadoExcel", function(event) {

		var datatodisplay = $('#listado-seguimiento').html();
		$('#datatodisplay').val(datatodisplay);
		document.getElementById("lala").submit(datatodisplay);

});

$(document).on("click", "#buscarcomisionista", function(event){

		event.preventDefault();
    	var clave = $("#nombre").val();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/buscarcomisionista.php',
	        data: 'clave='+clave,
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('show');
	            $('.contenido').html(data);
	        }
    	});

	});

$(document).on("click", "#anadircomisionista", function(event){

	event.preventDefault();
	var row = getRowNombre($(this));
	$('#mostrardatos').modal('hide');
	$('#nombre').val(row);

});


</script>
