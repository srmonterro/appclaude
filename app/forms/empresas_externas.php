<div style="margin-top: 45px" class="container">
	
	<input name="matricula" type="hidden" id="matricula" value="" />
	<input name="id_matricula" type="hidden" id="id_matricula" value="" />	
	<input name="id_accion" type="hidden" id="id_accion" value="" />
    <input name="id_alumno" type="hidden" id="id_alumno" value="" />
<!--     <div style="display:none" id="confirmacion" class="inv alert alert-success">Progreso guardado. Acuérdate de ir actualizándolo a medida que el alumno va avanzando en la formación.</div>
    <div style="display:none" id="error" class="alert alert-danger">Error.</div> -->


	<ol class="breadcrumb">
      <li>Información Empresas</li>
      <li class="active"><? echo $_SESSION[empresa] ?></li>
	</ol>

	<?

	$q = 'SELECT id, razonsocial, cif, asignado, dispuesto_acciones, disponible, actualizado_a
	FROM empresas e
	WHERE e.grupo = '.$_SESSION[grupo];
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Razón Social</th>
                        <th>CIF</th>                           
                        <th>Crédito Asignado</th>
                        <th>Crédito Consumido</th>
                        <th>Crédito Disponible</th>                          
                        <th>Actualizado</th>                                 
                        <th>Informe Empresa</th>
                        <th>Anexo Encomienda<br>ESFOCC</th>
                        <th>Anexo Encomienda<br>ESFOCC Estrategias</th>
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_array($q) ) {

    	$id_emp = $row[id];
    	// $creditoinicial = $row[credito];
    	echo '<tr>';
		echo '<td>'.$row[razonsocial].'</td>';
		echo '<td>'.$row[cif].'</td>';
		echo '<td>'.$row[asignado].'</td>';
		echo '<td>'.$row[dispuesto_acciones].'</td>';
		echo '<td>'.$row[disponible].'</td>';
		echo '<td style="font-size:12px">'.$row[actualizado_a].'</td>';

		// $q1 = 'SELECT SUM(mc.costes_imparticion) as creditobonificado
	 //    FROM mat_costes mc, empresas e
	 //    WHERE mc.id_empresa = e.id
	 //    AND e.id = '.$id_emp;
	 //    // echo $q1."<br>";
	 //    $q1 = mysqli_query($link, $q1) or die("error1:" .mysqli_error($link));

	 //    $row = mysqli_fetch_array($q1);
	 //    $creditobonificado = $row[creditobonificado];
		// echo '<td>'.$creditobonificado.'</td>';

		// $q2 = 'SELECT SUM(m.presupuesto) as creditopreinvertido
	 //    FROM matriculas m, ptemp_mat_emp ma, empresas e
	 //    WHERE ma.id_matricula = m.id
	 //    AND ma.id_empresa = e.id
	 //    AND e.id = '.$id_emp;


		$q2 = 'SELECT GROUP_CONCAT(a.denominacion, " - ", m.presupuesto, " €" SEPARATOR "<br>") as creditopreinvertido
        FROM matriculas m, temp_empresas ma, empresas e, acciones a
        WHERE ma.id_matricula = m.id
        AND m.id_accion = a.id
        AND ma.cif = e.cif
        AND m.estado IN ("Comunicada")
        AND e.id = '.$id_emp;

    	// $q2 = 'SELECT SUM(m.presupuesto) as creditopreinvertido
     //    FROM matriculas m, temp_empresas ma, empresas e
     //    WHERE ma.id_matricula = m.id
     //    AND ma.cif = e.cif
     //    AND m.estado IN ("Comunicada")
     //    AND e.id = '.$id_emp;
	 //    // echo $q2."<br><br>";
	    $q2 = mysqli_query($link, $q2) or die("error2:" .mysqli_error($link));

	    $row = mysqli_fetch_array($q2);
	    $creditopreinvertido = $row[creditopreinvertido];
		// echo '<td style="font-size:12px">'.$creditopreinvertido.'</td>';

		// echo '<td>'.($creditoinicial-$creditobonificado-$creditopreinvertido).'</td>';
		echo '<td><a href="#" style="width:100%" class="btn-sm btn-success" id_empresa="'.$id_emp.'" id="mostrarpdfinforme"><span class="glyphicon glyphicon-list">  </span></a></td>';
		echo '<td><a href="#" style="width:100%" class="btn-sm btn-info" id_empresa="'.$id_emp.'" id="mostrarpdfanexoenc"><span class="glyphicon glyphicon-list">  </span></a></td>';  
		echo '<td><a href="#" style="width:100%" class="btn-sm btn-info" id_empresa="'.$id_emp.'" id="mostrarpdfanexoencestra"><span class="glyphicon glyphicon-list">  </span></a></td>';  
        echo '</tr>';

    }
    echo '</tbody></table>';
    

	?>

</div>

<script type="text/javascript">

function getRowNombre(button) {
	    var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#nombre').html();
	}

$(document).on("click", "#busqueda-seguimientoco", function(event) {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimientocl.php',
		data: values,
		success: function(data) 
		{
		    
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
