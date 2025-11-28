<div style="margin-top: 45px" class="container">

	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Listado Inspección</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

		<div class="col-md-1">
	    	<div class="form-group">
		        <label class="control-label" for="numeroaccion">AF:</label>
		        <input type="text" id="numeroaccion" name="numeroaccion" class="form-control"/>
	    	</div>
		</div>
<!-- 		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="comercial">Comercial:</label>
		            <select id="comercial" name="comercial" class="form-control">
		            <?
	                	echo '<option value="">Cualquiera</option>';
	                	$q = 'SELECT id, nombre, apellido
	                	FROM comerciales ORDER by id ASC';
		                $q = mysqli_query($link,$q);

		                while ($row = mysqli_fetch_array($q))
		                    echo '<option value="'.$row['id'].'">'.$row['nombre'].' '.$row['apellido'].' </option>';
		            ?>
		            </select>
		    </div>
		</div>
 -->	<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="modalidad">Modalidad:</label>
		            <select id="modalidad" name="modalidad" class="form-control">
		            <?
	                	echo '<option value="">Cualquiera</option>';
	                	echo '<option value="Teleformación">Teleformación</option>';
	                	echo '<option value="A Distancia">Distancia</option>';
	                	echo '<option value="Presencial">Presencial</option>';
	                	echo '<option value="Mixta">Mixta</option>';

		            ?>
		            </select>
		    </div>
		</div>
		<div class="col-md-3">
		    <div class="form-group">
		            <label class="control-label" for="mes_fin">Mes Finalización:</label>
		            <select id="mes_fin" name="mes_fin" class="form-control" >
		                <option value="">Cualquiera</option>
		                <option value="1">Enero</option>
		                <option value="2">Febrero</option>
		                <option value="3">Marzo</option>
		                <option value="4">Abril</option>
		                <option value="5">Mayo</option>
		                <option value="6">Junio</option>
		                <option value="7">Julio</option>
		                <option value="8">Agosto</option>
		                <option value="9">Septiembre</option>
		                <option value="10">Octubre</option>
		                <option value="11">Noviembre</option>
		                <option value="12">Diciembre</option>
		            </select>
		        </div>
		</div>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="bonificado">Bonificado:</label>
		            <select id="bonificado" name="bonificado" class="form-control">
		            <?
	                	echo '<option value="">Cualquiera</option>';
	                	echo '<option value="bonificado">Bonificado</option>';
	                	echo '<option value="privado">Privado</option>';
		            ?>
		            </select>
		    </div>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimientoi" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
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

$(document).on("click", "#busqueda-seguimientoi", function(event) {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimientoi.php',
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
