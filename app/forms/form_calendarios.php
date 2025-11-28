<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<link href='plugins/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='plugins/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<link href='css/calendar-print.css' rel='stylesheet' media='print' />
<script src='plugins/fullcalendar/lib/moment.min.js'></script>
<script src='plugins/fullcalendar/lib/jquery.min.js'></script>
<script src='plugins/fullcalendar/fullcalendar.min.js'></script>
<script src='plugins/fullcalendar/lang-all.js'></script>

<script>

	$(document).ready(function() {



		// $(document).on("click", "#captura_calendario", function(event){

		// 	$.ajax({
		// 		cache: false,
		// 		type: 'POST',
		// 		url: 'functions/contratos-funciones.php',
		// 		data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
		// 		success: function(data) 
		// 		{

		// 		} 
		// 	}); ajax.abort();

		// });

		$(document).on("click", "#impr_calendario", function(event){

			// var bg = '<div id="bg_calendario"><p id="bg-text">Background</p></div>';
			$('ol.breadcrumb').css('display','none');
			// $('.fc-view-container').prepend(bg);
			$('.fc-view-container').append('<span id="fecha" style="font-size:8px; margin: -40px 0 0 20px">Fecha Impresión: '+dameFecha()+'</span>');
			$('#form-calendario').css('display','none');
			$('#calendar').css('margin-top','-75px');
			$('h2').css('display','none');
			// $('.fc-event').css('font-size','.7em !important');
			// $('.fc-event').css('line-height:','1 !important');
			window.print();
			// $('.fc-event').css('font-size', '10px !important');
			$('#fecha').remove();
			$('#calendar').css('margin-top','50px');
			$('ol.breadcrumb').css('display','block');
			$('#form-calendario').css('display','block');


		});

		function renderCalendar(fechas, mes) {

			var anio = $('#aniovigente').val();
			$('#calendar').fullCalendar({
				header: {
					left: 'prev,next today',
					center: 'title',
					right: 'month,agendaWeek,agendaDay'
				},
				lang: 'es',
				editable: true,
				defaultDate: anio+'-'+mes+'-01',
				// eventLimit: true,
				events: fechas
			});
		}

		$(document).on("click", "#mostrar_calendario", function(event){

			if ( $('#denominaciones').prop('checked') )
				var denominaciones = 1;
			else
				var denominaciones = 0;


			$.ajax({
				cache: false,
				type: 'POST',
				dataType: 'json',
				url: 'functions/calendarios.php',
				data: 'modalidad='+$('#modalidad').val()+'&tipo='+$('#tipo').val()+'&mes='+$('#mes').val()+'&denominaciones='+denominaciones,
				success: function(data) 
				{
					$('#calendar').fullCalendar('destroy');
					renderCalendar(data, $('#mes').val());
					// alert(data);
					// console.log(data);
				} 
			}); 

		});

						
		
	});

</script>
<style>

	#calendar {
		max-width: 100%;
		margin: 0 auto;
	}

</style>
</head>
<body>

	<div style="margin-top: 45px" class="container">
	<ol class="breadcrumb">
      <li>Seguimiento</li>
      <li class="active">Calendarios</li>
	</ol>

	<form style="margin-bottom: 50px" role="form" action="" method="post" id="form-calendario">

		<div class="col-md-2">
			    <div class="form-group">
			       <label class="control-label" for="modalidad">Modalidad:</label>
			            <select id="modalidad" name="modalidad" class="form-control">
			            	<option value='"Presencial","Mixto","Teleformación"'>Todas</option>
			            	<option value='"Presencial","Mixto"'>Presencial</option>
			          		<option value='"Teleformación"'>Teleformación</option>
			            </select>
			    </div>
		</div>

		<div class="col-md-2">
			    <div class="form-group">
			       <label class="control-label" for="tipo">Fechas:</label>
			            <select id="tipo" name="tipo" class="form-control">
			            	<option value="">Todas</option>
			            	<option value="Inicio">Inicio</option>
			          		<option value="Fin">Fin</option>
			            </select>
			    </div>
		</div>
		<div class="col-md-2">
            <div class="form-group">
                    <label class="control-label" for="mes">Mes:</label>
                    <select id="mes" name="mes" class="form-control" >
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

        <div class="col-md-2" style="margin-top: 20px;">
            <div class="checkbox">
            <label>
            	<input value="1" id="denominaciones" name="denominaciones" type="checkbox"> Denominaciones
            </label>
            </div>
        </div>

		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" id="mostrar_calendario" class="btn btn-default btn-success"><span class="glyphicon glyphicon-calendar"></span></a>
		</div>
		<div class="col-md-1">
			<a style="margin-top: 24px; width:100%;" onclick="printDivCalendar('calendar')" id="impr_calendario" class="btn btn-default btn-warning"><span class="glyphicon glyphicon-print"></span></a>
		</div>

	</form>
	</div>

	<div class="clearfix"></div>

	<div style="margin-top: 50px" id='calendar'></div>


</body>
</html>
