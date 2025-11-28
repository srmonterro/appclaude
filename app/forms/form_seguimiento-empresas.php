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
      <li class="active">Seguimiento Empresas</li>
	</ol>

	<form role="form" action="functions/exportarvcf_seguimientoe.php" method="post" id="form-seguimientoe">

	   	<div class="col-md-2">
  		<div class="cp form-group">
   			<label class="control-label" for="codigopostal">C.P.:</label>
   			<div class="input-group">
		      	<input type="text" id="codigopostal" name="codigopostal" class="form-control" />
		      	<span class="input-group-btn">
		        	<button id="buscarpoblacion" name="buscarpoblacion" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
		      	</span>
		    </div>
   		</div>
   		</div>
   		<div class="col-md-3">
		    <div class="form-group">
		       <label class="control-label" for="zona">Zona:</label>
		            <select id="zona" name="zona" class="form-control">
		            <?
						echo '<option value="">Cualquiera</option>';
		                $q = 'SELECT id, zona
		                FROM zonas';

		                $q = mysqli_query($link,$q);

		                while ($row = mysqli_fetch_array($q))
		                    echo '<option value="'.$row['id'].'">'.$row['zona'].' </option>';
		            ?>
		            </select>
		    </div>
		</div>
		<div class="col-md-3">
   		<div class="form-group">
    		<label class="control-label" for="poblacion">Población:</label>
    		<select id="poblacion" name="poblacion" class="form-control" >
			<?
				echo '<option value="">Cualquiera</option>';
		            $q = 'SELECT DISTINCT p.poblacion
		            FROM poblaciones p, empresas e
					WHERE e.poblacion = p.poblacion';
		            $q = mysqli_query($link,$q);

		            while ($row = mysqli_fetch_array($q))
		            	echo '<option value="'.$row['poblacion'].'">'.$row['poblacion'].' </option>';
    		?>
    		</select>
    	</div>
	    </div>
	    <div class="col-md-3">
	    	<div class="form-group">
	    		<label class="control-label" for="provincia">Provincia:</label>
	    		<select id="provincia" name="provincia" class="form-control" >
	    			<?
					echo '<option value="">Cualquiera</option>';
		            $q = 'SELECT DISTINCT p.provincia
		            FROM provincias p, empresas e
					WHERE e.provincia = p.provincia';
		            $q = mysqli_query($link,$q);

		            while ($row = mysqli_fetch_array($q))
		            	echo '<option value="'.$row['provincia'].'">'.$row['provincia'].' </option>';
    				?>
			    </select>
	    	</div>
	   	</div>


	   	<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="restablecer" class="btn btn-default"><span class="glyphicon glyphicon-repeat"></span></a>
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

	    <div class="col-md-2">
	    	<div class="form-group">
	    		<label class="control-label" for="estado_revision">Estado Revisión:</label>
	    		<select id="estado_revision" name="estado_revision" class="form-control" >
	    			<option value="">Cualquiera</option>;
	    			<option value="Pendiente">Pendiente</option>
		            <option value="Revisada">Revisada</option>
		            <option value="Correo_devuelto">Correo devuelto</option>
			    </select>
	    	</div>
	   	</div>
		<div class="col-md-2">
		    <div class="form-group">
		       <label class="control-label" for="comercial">Comercial:</label>
		            <select id="comercial" name="comercial" class="form-control">
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


                    	echo '<option value="">Cualquiera</option>';
                        $q = 'SELECT nombre
                        FROM agentes';
                        $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));
                    	// echo mb_strtoupper($_SESSION[user]);
                    	// echo $q;
                        while ( $row = mysqli_fetch_array($q) )  {

                        	if ( $row[nombre] == ucfirst($_SESSION[user]) || $_SESSION[user] == 'daniel' || $_SESSION[user] == 'rmedina' || $_SESSION[user] == 'root' )
                        		echo '<option value="'.$row[nombre].'">'.$row[nombre].'</option>';

                        }


                    ?>
                    </select>
		    </div>
		</div>
		<? } ?>
		<div class="col-md-1">
			<div class="form-group">
			    <label class="control-label" for="credito">Oper:</label>
			    <select id="operador" name="operador" class="form-control">
			    	<option value="">-</option>
			    	<option value="=">IGUAL</option>
			    	<option value=">">MAYOR</option>
			    	<option value="<">MENOR</option>
			    </select>
			</div>
		</div>


		<div class="col-md-2">
		    <div class="form-group">
			    <label class="control-label" for="credito">Crédito:</label>
			    <input type="text" id="credito" name="credito" class="form-control" />
			</div>
		</div>


		<div class="clearfix"></div>
		<div class="col-md-12" style="height: 15px;"></div>
		<div class="clearfix"></div>


		<div class="col-md-5">
   		<div class="form-group">
		    <label class="control-label" for="actividad">Actividad:</label>
		    <select id="actividad" name="actividad" class="form-control">
		            <?

		                echo '<option value="">Cualquiera</option>';
		                $q = 'SELECT DISTINCT a.codigo, a.actividad
						FROM empresas e, actividadestripartita a
						WHERE e.actividad = a.codigo ';
		                $q = mysqli_query($link,$q);

		                while ($row = mysqli_fetch_array($q))
		                    echo '<option value="'.$row['codigo'].'">'.$row['actividad'].' </option>';
		            ?>
		            </select>
	    </div>
		</div>

		<div class="col-md-4">
	    	<div class="form-group">
			    <label class="control-label" for="categoria">Categoría:</label>
			    <select id="categoria" name="categoria" class="form-control">
					<?
						echo '<option value="">Sin categoría</option>';

						if ( $gestion != '' ) {

							$q = 'SELECT *
					    FROM categorias_empresa';
					    // echo $q;
					    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

					    while ( $row = mysqli_fetch_array($q) )
					        echo '<option value="'.$row[id].'">'. $row[categoria] .'</option>';

						}

					?>
		   	</select>
		    </div>
		</div>

		<div class="col-md-2">
	    	<div class="form-group">
			    <label class="control-label" for="fecha_revision">Fecha Revisión:</label>
			    <input type="date" id="fecha_revision" value="" name="fecha_revision" class="form-control"/>
			</div>
		</div>


		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="busqueda-seguimientoe" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></a>
		</div>

<!-- 	   	<div class="col-md-4">
	   		<div class="form-group">
			    <label class="control-label" for="actividad">Actividad principal:</label>
			    <select id="actividad" name="actividad" class="form-control" disabled>
		            <?

		    //             echo '<option value="">Cualquiera</option>';
		    //             $q = 'SELECT DISTINCT a.codigo, a.actividad
						// FROM empresas e, actividadestripartita a
						// WHERE e.actividad = a.codigo ';
		    //             $q = mysqli_query($link,$q);

		    //             while ($row = mysqli_fetch_array($q))
		    //                 echo '<option value="'.$row['codigo'].'">'.$row['actividad'].' </option>';
		            ?>
		            </select>
		    </div>
		</div>
 -->


	</form>

	<div class="clearfix"></div>


	</div>
	<div id="listado-seguimiento" style="">

	</div>

	<form id="lala" action="functions/exportarexcel_seguimientoe.php" method="post" target="_blank">

		<a id="imprimirSeguimientoe" onclick="printDiv('listado-seguimiento')" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-print"></span> Imprimir</a>

<!-- 		<a id="listacorreos" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-envelope"></span> Lista de Correo</a>
 -->
		<a id="listadoExcel" style="display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-list-alt"></span> Exportar a Excel</a>

		<input type="hidden" id="datatodisplay" name="datatodisplay" />
	</form>

	<form id="lala2" action="functions/exportarvcf_seguimientoe.php" method="post" target="_blank">
		<a id="listacorreos" style="margin-bottom: 30px; display: none" class="pull-right btn btn-primary btn-default"><span class="glyphicon glyphicon-envelope"></span> Lista de Correo</a>
		<input type="hidden" id="datatodisplay2" name="datatodisplay2" />
	</form>

	<a id="mailchimp-export" style="margin-right: 15px; display: none" class="pull-right btn btn-success btn-default"><span class="glyphicon glyphicon-envelope"></span> Exportar a MailChimp</a>

</div>

<script>


	$(document).on("click", "#restablecer", function(event){
		$('#form-seguimientoe')[0].reset();

	});


	$(document).on("click", "#busqueda-seguimientoe", function(event){

		event.preventDefault();
		var values = $('#form-seguimientoe').find("input[type='hidden'], :input:not(:hidden)").serialize();

		$(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');
		$(this).find('span').addClass('spin');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda-seguimientoe.php',
			data: values,
			success: function(data)
			{

			    $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');
		    	$('.glyphicon-search').removeClass('spin');

				$('#listado-seguimiento').html(data);
				$('#imprimirSeguimientoe').css('display','inline-block');
				$('#listacorreos').css('display','inline-block');
				$('#listacorreos').css('margin-right','10px');
				$('#listadoExcel').css('display','inline-block');
				$('#listadoExcel').css('margin-right','10px');
				$('#mailchimp-export').css('display','inline-block');

			}

		}); ajax.abort();

	});

	$(document).on("click", "#listadoExcel", function(event) {

		var datatodisplay = $('#listado-seguimiento').html();
		$('#datatodisplay').val(datatodisplay);
		// alert(datatodisplay);
		document.getElementById("lala").submit(datatodisplay);


	});


	$(document).on("click", "#listacorreos", function(event) {

		var values = $('#form-seguimientoe').find("input[type='hidden'], :input:not(:hidden)").serialize();
		$('#form-seguimientoe').submit();


	});


	$(document).on("click", "#mailchimp-export", function(event) {

		var accion = [];
		accion[0] = 'listar_segmentos';

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mchimp-funciones.php',
			data: { accion: accion },
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html('Crear grupo en MailChimp');
				$('.contenido').html('<div class="clearfix"></div><div class="col-md-8" style="margin: 20px"><div class="form-group"><label class="control-label" for="campaign">Nombre Campaña:</label><input type="text" id="campaign" name="campaign" class="form-control" /></div></div><div class="col-md-3" style="margin-top:45px"><a id="mailchimp-connect" style="margin-right: 15px; width:100%; display: inline-block;" class="pull-right btn btn-success btn-default"><span class="glyphicon glyphicon-envelope"></span> Crear Campaña</a></div><div class="clearfix"></div><div style="margin: 0 0 15px 35px;"><a href="https://us10.admin.mailchimp.com/" target="_blank">Ir a MailChimp.com</a></div><div class="clearfix"></div>');

				$('.contenido').prepend(data);
			}
		}); ajax.abort();


	});


	$(document).on("click", "#mailchimp-agregar", function(event) {

		var email = [];
		var MERGE1 = [];
		var campana = [];
		var accion = [];

		campana[0] = $('#segmentos').val();
		accion[0] = "agregar";

		var i = 0;
		$("td#email").each(function() {
			email[i] = $(this).text();
			i++;
		});

		var i = 0;
		$("td#razonsocial").each(function() {
			MERGE1[i] = $(this).text();
			i++;
		});

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mchimp-funciones.php',
			data: { 'email' : email, 'MERGE1' : MERGE1, 'campana' : campana, 'accion' : accion },
			success: function(data)
			{
				alert("Contactos enviados. Revisa la lista en mailchimp.com");
			}
		}); ajax.abort();

	});


	$(document).on("click", "#mailchimp-connect", function(event) {

		var email = [];
		var MERGE1 = [];

		var campana = [];
		campana[0] = $('#campaign').val();

		var i = 0;
		$("td#email").each(function() {
			email[i] = $(this).text();
			i++;
		});

		var i = 0;
		$("td#razonsocial").each(function() {
			MERGE1[i] = $(this).text();
			i++;
		});

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mchimp-funciones.php',
			data: { 'email' : email, 'MERGE1' : MERGE1, 'campana' : campana },
			success: function(data)
			{
				alert("Contactos enviados. Revisa la lista en mailchimp.com");
			}
		}); ajax.abort();

	});

</script>
