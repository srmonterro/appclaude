<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'functions/funciones.php');
$anio = devuelveAnioReal();
// echo $gestion;
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
      <li class="active">Seguimiento Comercial</li>
	</ol>

	<form role="form" action="" method="post" id="form-seguimiento">

	    <div class="col-md-1">
	        <div class="form-group">
	            <label class="control-label" for="numeroaccion">AF:</label>
	            <input type="text" id="numeroaccion" name="numeroaccion" class="form-control" />
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="denominacion">Denominación:</label>
	            <input type="text" id="denominacion" name="denominacion" class="form-control"  />
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="fechaini">Fecha Inicio:</label>
	            <input type="date" id="fechaini" name="fechaini" class="form-control" value=<? echo $anio.'-01-01' ?> />
	        </div>
	    </div>
	    <div class="col-md-2">
	        <div class="form-group">
	            <label class="control-label" for="fechafin">Fecha Fin:</label>
	            <input type="date" id="fechafin" name="fechafin" class="form-control" value=<? echo $anio.'-12-31' ?> />
	        </div>
	    </div>
	    <div class="col-md-2">
            <div class="form-group">
                    <label class="control-label" for="mes_fin">Mes Finalización:</label>
                    <select id="mes_fin" name="mes_fin" class="form-control" >
                        <option value="">Cualquiera</option>
                        <option value="01">Enero</option>
                        <option value="02">Febrero</option>
                        <option value="03">Marzo</option>
                        <option value="04">Abril</option>
                        <option value="05">Mayo</option>
                        <option value="06">Junio</option>
                        <option value="07">Julio</option>
                        <option value="08">Agosto</option>
                        <option value="09">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                    </select>
                </div>
        </div>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="estado">Estado:</label>
		            <select id="estado" name="estado" class="form-control" >
				    	<option value="">Cualquiera</option>
				    	<option value="Creada">Creada</option>
				    	<option value="Comunicada">Comunicada</option>
				    	<option value="Finalizada">Finalizada</option>
				    	<option value="Gratuita">Gratuita</option>
				    	<option value="Facturada">Facturada</option>
				    	<option value="Liquidada">Liquidada</option>
				    	<option value="Anulada">Anulada</option>
		   			</select>
		    </div>
		</div>
	    <div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="restablecer-c" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
		</div>

		<div class="clearfix"></div>
		<div class="col-md-12" style="height: 15px;"></div>
		<div class="clearfix"></div>

		<div class="col-md-3">
	        <div class="cp form-group">
   			<label class="control-label" for="razonsocial">Empresa:</label>
   			<div class="input-group">
		      	<? //if ( $_SESSION[user] == 'alago' ) $value = 'value = "DINOSOL SUPERMERCADOS S.L." readonly' ?>
		      	<input type="text" id="razonsocial" <? echo $value ?> name="razonsocial" class="form-control" />
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

		                devuelveComercialesBusqueda($_SESSION[user], $link);
		            ?>
		            </select>
		    </div>
		</div>
		<? if ( $gestion != "" ) { ?>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="agente">Agente:</label>
		            <select id="agente" name="agente" class="form-control">
		            <?
		             	$q = 'SELECT nombre
                        FROM agentes';
                        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));
                        // echo mb_strtoupper($_SESSION[user]);
                        // echo $q;
                        if ( $_SESSION[user] == 'amparo' ) {

                        	echo '<option value="">Cualquiera</option>';
                            echo '<option value="Amparo">Amparo</option>';
							echo '<option value="Pedro (no activo)">Pedro (no activo)</option>';

                        } else {

                            echo '<option value="">Cualquiera</option>';

                            while ( $row = mysqli_fetch_array($q) )  {

                                if ( $row[nombre] == ucfirst($_SESSION[user]) || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'root' ) {
                                    echo '<option value="'.$row[nombre].'">'.$row[nombre].'</option>';
                                }
                            }
                        }

		            ?>
		            </select>
		    </div>
		</div>
		<? } ?>
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
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="modalidad">Modalidad:</label>
		            <select id="modalidad" name="modalidad" class="form-control">
		            	<option value="">Cualquiera</option>
		            	<option value="Teleformación">Teleformación</option>
		          		<option value="A Distancia">A Distancia</option>
		          		<option value="Presencial">Presencial</option>
		          		<option value="Mixta">Mixta</option>
		            </select>
		    </div>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimientoc" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
		</div>

<!-- 		<div class="col-md-12" style="height: 15px;"></div>
		<div class="clearfix"></div>


		 <div class="col-md-4">
	        <div class="form-group">
	            <label class="control-label" for="iban">IBAN:</label>
	            <input type="text" id="iban" name="iban" class="form-control" />
	        </div>
	    </div>

		<div class="col-md-2">
    	<div class="form-group">
		    <label class="control-label" for="formapago">Forma de Pago:</label>
		    <select id="formapago" name="formapago" class="form-control">
				<option value="">Cualquiera</option>
				<option value="Transferencia">Transferencia</option>
				<option value="Cheque">Cheque</option>
				<option value="Remesa">Remesa</option>
				<option value="Efectivo">Efectivo</option>
		   	</select>
	    </div>
 -->
	<div class="clearfix"></div>

	</form>

	</div>
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

	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;


	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');
	$(this).find('span').addClass('spin');

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimiento.php',
		data: values+'&seg-comercial=1',
		success: function(data)
		{

			$('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');
		    $('.glyphicon-search').removeClass('spin')

			$('#listado-seguimiento').html(data);

			if ( gestion == '' ) {

				var sum = 0;
				var sumc = 0;
				var sump = 0;

				$("td#coste").each(function() {

				    var value = $(this).text();
				    value = value.split(" €");
				    value = value[0].replace(".","");
				    value = value.replace(",",".");
				    // alert(value);
				    // add only if the value is number
				    if(!isNaN(value) && value.length != 0) {
				        sum += parseFloat(value);
				    }
				});

				$('.table').append('<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr>');
				$('#imprimirSeguimientoc').css('display','inline-block');
			}
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
