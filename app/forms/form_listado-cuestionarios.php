<div style="margin-top: 45px" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Listado Cuestionarios</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

		<div class="col-md-2">
	    	<div class="form-group">
	        <label class="control-label" for="fecha">Año:</label>
	        <select id="fecha" name="fecha" class="form-control">	        	
	        	<option value="2016">2016</option>
	        	<option value="2015">2015</option>
	        	<option value="2014">2014</option>
	        </select>
	    	</div>
		</div>
		</form>	
</div>
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

	function listarCuestionariosEmp() {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimientocuest.php',
		data: values,
		success: function(data) 
		{
		    
			$('#listado-seguimiento').html(data);
			var sum = 0;
			var i = 0;
			// $("td#porcentajeventas").each(function() {

				
			// 	// alert(value);
			//     var value = $(this).text();
			//     if ( parseInt(value) != 0 ) i++; // PARA QUITAR LOS QUE NO SON 0, HAY QUE PENSAR SI SE INCLUYEN O NO.
			//     value = value.split(" %");
			//     value = value[0];
			//     // value = value[0].replace(".","");
			//     // value = value.replace(",",".");

			// //     // add only if the value is number
			//     if(!isNaN(value) && value.length != 0) {
			//     	// alert(parseFloat(value));
			//         sum += (parseFloat(value));

			//     }
			// });
			// alert(i);
			// var resul = sum/i;
			// $('.table').append('<tr><td colspan="8"></td><td class="success">% Medio: </td><td colspan="2" style="text-align:center; font-size: 16px" class="success"><strong>'+resul.toFixed(2)+' %</strong></td></tr>');
			$('#imprimirSeguimientoc').css('display','inline-block');
			$('#listadoExcel').css('display','inline-block');
			$('#listadoExcel').css('margin-right','5px');
		    
		}

	}); ajax.abort();	

	}


	$(document).ready(function() {

		listarCuestionariosEmp();

	});

	$(document).on("change", "select#fecha", function(event){
		// alert("s");
		listarCuestionariosEmp();
	});


$(document).ready(function() {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimientocuest.php',
		data: values,
		success: function(data) 
		{
		    
			$('#listado-seguimiento').html(data);
			var sum = 0;
			var i = 0;
			// $("td#porcentajeventas").each(function() {

				
			// 	// alert(value);
			//     var value = $(this).text();
			//     if ( parseInt(value) != 0 ) i++; // PARA QUITAR LOS QUE NO SON 0, HAY QUE PENSAR SI SE INCLUYEN O NO.
			//     value = value.split(" %");
			//     value = value[0];
			//     // value = value[0].replace(".","");
			//     // value = value.replace(",",".");

			// //     // add only if the value is number
			//     if(!isNaN(value) && value.length != 0) {
			//     	// alert(parseFloat(value));
			//         sum += (parseFloat(value));

			//     }
			// });
			// alert(i);
			// var resul = sum/i;
			// $('.table').append('<tr><td colspan="8"></td><td class="success">% Medio: </td><td colspan="2" style="text-align:center; font-size: 16px" class="success"><strong>'+resul.toFixed(2)+' %</strong></td></tr>');
			$('#imprimirSeguimientoc').css('display','inline-block');
			$('#listadoExcel').css('display','inline-block');
			$('#listadoExcel').css('margin-right','5px');
		    
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


</script>
