<div style="margin-top: 45px" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Seguimiento Comercial</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="nombre">Comisionista:</label>
	            <input type="text" id="nombre" name="nombre" class="form-control" />
	        </div>
	    </div>
	    <div class="col-md-3">
	        <div class="form-group">
	            <label class="control-label" for="denominacion">Denominación Acción Formativa:</label>
	            <input type="text" id="denominacion" name="denominacion" class="form-control"  />
	        </div>
	    </div>
		<div class="col-md-2">
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
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="comercial">Comercial:</label>
		            <select id="comercial" name="comercial" class="form-control" <? if ( $_SESSION['user'] == 'efrencomercial' ) echo 'readonly' ?> >
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
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="mes">Mes:</label>
		            <select id="mes" name="mes" class="form-control" >
				    	<option value="">Cualquiera</option>
				    	<option value="Creada">Creada</option>
				    	<option value="Comunicada">Comunicada</option>
				    	<option value="Finalizada">Finalizada</option>
				    	<option value="Anulada">Anulada</option>
		   			</select>
		    </div>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimientoc" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
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

$(document).on("click", "#busqueda-seguimientoc", function(event) {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimiento.php',
		data: values+'&seg-comercial=1',
		success: function(data) 
		{
		    
			$('#listado-seguimiento').html(data);
			var sum = 0;
			$("td#coste").each(function() {

			    var value = $(this).text();
			    value = value.split(" €");
			    value = value[0].replace(".","");
			    value = value.replace(",",".");

			    // add only if the value is number
			    if(!isNaN(value) && value.length != 0) {
			        sum += parseFloat(value);
			    }
			});
			$('.table').append('<tr><td colspan="7"></td><td class="success">Total: </td><td colspan="2" style="text-align:center; font-size: 16px" class="success"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr>');
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
