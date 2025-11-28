$(document).ready(function() {

	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;

	var alumnoguiap = '<a id="guiadelalumnomprivado" style="display: inline-block; float: left; margin-left: 10px;" name="matpdoc-seleccionarmatriculas" data-toggle="modal" class="btn btn-success">Guía del Alumno</a>';
	var alumnoguia = '<a id="guiadelalumnom" style="display: inline-block; float: left; margin-left: 10px;" name="matriculas" data-toggle="modal" class="btn btn-success">Guía del Alumno</a>';
	$('#infopresupuesto').popover();
	$('#infocomercial').popover();
	$('#inforeporte').popover();
	// $('#infoacuerdo').popover();
	// $(document).on('hover', '#infoacuerdo', function(event) {
	// 	$('#infoacuerdo').popover('toggle');
	// });

	function getRow(button) {
	    var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#id').html();
	}

	var sec = $(location).attr('href').split("?");

	var i=0;
	var k=0;

	$(document).on("click", "#observacionescentro", function(event) {
		$('#observacionescuadro').css('display','block');
    });

	$(document).on('click','#guiadelalumnoblancot,#guiadelalumnoblancod', function(event) {

		var mod = $(this).attr('mod');
		window.open('http://gestion.eduka-te.com/app/documentacion/guias/guiadelalumnoblanco.php?mod='+mod,'_blank');

	});

	$("#docublanco").on('click', function(event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'documentacion/documentacion_cvdocente.php',
			data: 'id_matricula='+id_matricula,
			success: function(data)
			{
				window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
				window.open('http://gestion.eduka-te.com/app/documentacion/restodocumentacion.php?id_matricula='+id_matricula,'_blank');
				for (var key in data) {
				  if (data.hasOwnProperty(key)) {
				    console.log(key + " -> " + data[key]);
				    window.open(data[key].url);
				  }
				}
			}
		});

	});

	$("#desvincularsm").on('click', function(event) {

		// console.log("ok");
		$('#id_solicitudikea').val('');
		$('#id_solicitud').val('');
		$('#solicitud').val('');

	});

	$("#docurellena_privado").on('click', function(event) {

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.eduka-te.com/app/documentacion/docu_rellena_privado.php?id_matricula='+id_matricula,'_blank');

	});

	$("#docublanco_privado").on('click', function(event) {

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.eduka-te.com/app/documentacion/docu_blanco_privado.php?id_matricula='+id_matricula,'_blank');

	});

	$("#docurellenae").on('click', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();
		//window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		window.open('http://gestion.eduka-te.com/app/documentacion/docu_fechas.php?id_matricula='+id_matricula,'_blank');

	});


	$(document).on('click','#buscarcentro', function(event) {

		event.preventDefault();
		var nombrecentroprop = $('.bloqueprop #nombrecentro').val();
		var nombrecentromat = $('.bloquemat #nombrecentro').val();
		var nombrecentro = "";

		if ( sec[1] == 'presencial' || sec[1] == 'presencial#' || sec[1] == 'mixto' || sec[1] == 'mixto#' )
			nombrecentro = $('#nombrecentro').val();

		else {

			if ( nombrecentroprop == "" || nombrecentroprop === undefined )
				nombrecentro = nombrecentromat;
			else
				nombrecentro = nombrecentroprop;

		}

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'buscarcentro=1'+'&nombrecentro='+nombrecentro,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','1000px');
				$('#mostrardatos .mostrartitulo').html("Seleccionar un centro");
				$('#mostrardatos .contenido').html(data);

			}
		});

	});


	$(document).on('click','#seleccionarcentro', function(event) {
		event.preventDefault();

		var id = getRow($(this));

		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/funciones.php',
			data: 'datoscentro=1'+'&id='+id,
			success: function(data)
			{

				$('#mostrardatos').modal('hide');

				if ( sec[1] == 'presencial' || sec[1] == 'presencial#' || sec[1] == 'mixto' || sec[1] == 'mixto#' )
					$('#nombrecentro').val(data[0].nombrecentro);
				else {
					$('.bloqueprop #nombrecentro').val(data[0].nombrecentro);
					$('.bloquemat #nombrecentro').val(data[0].nombrecentro);
				}
				$('#direccioncentro').val(data[0].direccioncentro);
				$('#costeaula').val(data[0].costeaula);
				$('#codigopostal').val(data[0].codigopostal);
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].localidad+'">'+data[0].localidad+'</option>');
	            $('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
				// $('#observaciones').val(data[0].observaciones);
				$('#id_centro').val(data[0].id);

				if ( data[0].costeaula != 0 ) {
					$('#datosrentabilidad').css('display','block');
					$('#costeaula').val(data[0].costeaula);
				}
			}
		});

	});

	$(document).on('click','#descargaexcelb', function(event) {
		event.preventDefault();

		var fichero = $(this).attr('name');
		window.open('http://gestion.eduka-te.com/app/import'+gestion+'/fin/'+fichero,'_blank');

	});

	$(document).on('click','#descargar_excel', function(event) {
		event.preventDefault();

		var fichero = $(this).attr('name');
		window.open('http://gestion.eduka-te.com/app/import'+gestion+'/doc/'+fichero,'_blank');

	});

	$(document).on('click','#descargar_excelfin', function(event) {
		event.preventDefault();

		var fichero = $(this).attr('name');
		window.open('http://gestion.eduka-te.com/app/import'+gestion+'/fin/'+fichero,'_blank');

	});

	$(document).on('click','#descargar_excelp', function(event) {
		event.preventDefault();

		var fichero = $(this).attr('name');
		window.open('http://gestion.eduka-te.com/app/import'+gestion+'/doc/'+fichero,'_blank');

	});

	$(document).on('click','#descargar_excelfinp', function(event) {
		event.preventDefault();

		var fichero = $(this).attr('name');
		window.open('http://gestion.eduka-te.com/app/import'+gestion+'/fin/'+fichero,'_blank');

	});

	$(document).on('click','#btnrentabilidad', function(event) {

		event.preventDefault();
		$('#datosrentabilidad').css('display','block');

	});

	$(document).on('click','#preacuerdo', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		if ( sec[1] == 'docente' || sec[1] == 'docente#') {
			var button = $(this);
	    	var parentTd = button.parent('td');
	    	var parentTr = parentTd.parent('tr');
	    	var id_matricula = parentTr.find('td#id').html();
		}


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'documentacion/acuerdos.php',
			data: 'id_matricula='+id_matricula+'&preacuerdo=1',
			success: function(data)
			{
				$('#mostrardatosc').modal('show');
				$('#mostrardatosc .mostrartitulo').html('Acuerdo con el Docente');
				$('#mostrardatosc .contenido').html(data);

			}
		});

	});

	$(document).on('click', '#acuerdocolaboracion', function(event) {

		event.preventDefault();

		var id_matricula = $('#id_matricula').val();
		var acuerdo = $('#acuerdo').val();
		// alert(acuerdo);
		var id_docente = $(this).attr('docente');
		var ph = $('#costehora-'+id_docente).val();
		var pa = $('#costealumno-'+id_docente).val();
		var acuerdo = $('#acuerdo-'+id_docente).val();

		if ( $("#competencia").is(':checked') )
			var competencia = 1;
		else
			var competencia = 0;


		window.open('http://gestion.eduka-te.com/app/documentacion/acuerdos.php?id_matricula='+id_matricula+'&acuerdo='+acuerdo+'&ph='+ph+'&pa='+pa+'&id_docente='+id_docente+'&competencia='+competencia,'_blank');

	});

	$(document).on("click", "#cuestionario", function(event) {
		window.open('http://gestion.eduka-te.com/app/documentacion/CuestionarioEvaluacionFormacionNObonificada.pdf');
	});

	$(document).on("click", "#diploma_bonif", function(event) {

		var id_matricula = $('#id_matricula').val();

		if ( sec[1] == 'form_matricula_doc' ) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&partesdiplomanv=1'+'&tipo=bonif'+'&mod=o',
				success: function(data)
				{
					$('#mostrardatos').modal('show');
					$('.mostrartitulo').html('Diplomas Anverso');
					$('.contenido').html(data);
				}
			});

		} else {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&partesdiplomanv=1'+'&tipo=bonif'+'&mod=p',
				success: function(data)
				{
					$('#mostrardatos').modal('show');
					$('.mostrartitulo').html('Diplomas Anverso Privado');
					$('.contenido').html(data);
				}
			});

		}

	});

	$(document).on("click", "a[id*='diplomanverso']", function(event) {

		var id_matricula = $(this).attr('id_mat');
		// var id_empresa = $(this).attr('id_emp');
		var resto = $(this).attr('resto');
		var nbotones = $(this).attr('total');
		var nboton = $(this).attr('id');
		nboton = nboton.substr(-1);
		// alert(nboton);

		if ( $(this).attr('tipo') == 'bonif' )
			window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_pre_bonif.php?id_matricula='+id_matricula+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones, '_blank');
		else
			window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_pre_nobonif.php?id_matricula='+id_matricula+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones, '_blank');

	});


	$(document).on("click", "#diploma_nobonif", function(event) {

		var id_matricula = $('#id_matricula').val();

		if ( sec[1] == 'form_matricula_doc' || sec[1] == 'form_matricula_doc#' ) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&partesdiplomanv=1'+'&tipo=privado'+'&mod=o',
				success: function(data)
				{
					$('#mostrardatos').modal('show');
					$('.mostrartitulo').html('Diplomas Anverso Privado');
					$('.contenido').html(data);
				}
			});

		} else {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&partesdiplomanv=1'+'&tipo=privado'+'&mod=p',
				success: function(data)
				{
					$('#mostrardatos').modal('show');
					$('.mostrartitulo').html('Diplomas Anverso Privado');
					$('.contenido').html(data);
				}
			});

		}

	});

	$(document).on("click", "#diploma_bonif_atras, #diploma_bonif_atrasp ", function(event) {

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_pre_bonif_atras.php?id_matricula='+id_matricula, '_blank');

	});


	$(document).on("click", "#informempresa", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_matricula+'&datosempresa=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','850px');
	        	$('.mostrartitulo').html("Datos Facturación");
	        	$('.contenido').html(data);
	        }
	    });


	});


	$(document).on("click", "#matguardarcuenta", function(event) {

		event.preventDefault();
		var id_alu = $(this).attr('id_alu');
		var id_mat = $(this).attr('id_mat');
		var numerocuenta = $('#numerocuenta[id_alu="'+id_alu+'"]').val();
		// alert(numerocuenta);

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_alu='+id_alu+'&id_mat='+id_mat+'&numerocuenta='+numerocuenta+'&matguardarcuenta=1',
	        success: function(data)
	        {
	        	if ( data.indexOf('error') != -1 )
					alert("Error al guardar cuenta cotización");
				else
					alert("Guardar correctamente.");
					// alert(data);
	        }
	    });


	});

	$(document).on("click", "#informe", function(event) {

		event.preventDefault();
		var id_empresa = $(this).attr('name');

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/mostrar_pdf.php',
	        data: 'id_empresa='+id_empresa+'&tipo=empresa',
	        success: function(data)
	        {
	        	if ( data == 'no' )
					alert("No hay PDF subido.");
				else
					window.open(data);
					// alert(data);
	        }
	    });


	});


	$(document).on("click", "#diploma_empresa,#diploma_empresap", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		if ( event.target.id == 'diploma_empresap')
			bonif = 0;
		else
			bonif = 1;

		if ( sec[1] == 'form_matricula_doc' ) {

			$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/funciones-presenciales.php',
		        data: 'id_matricula='+id_matricula+'&diploma_empresa=1'+'&bonif='+bonif+'&mod=o',
		        success: function(data)
		        {
		        	$('#mostrardatos').modal('show');
		        	$('.modal-dialog').css('width','850px');
		        	$('.mostrartitulo').html("Diplomas por Empresas");
		        	$('.contenido').html(data);
		        }
		    });

		} else {

			$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/funciones-presenciales.php',
		        data: 'id_matricula='+id_matricula+'&diploma_empresa=1'+'&bonif='+bonif+'&mod=p',
		        success: function(data)
		        {
		        	$('#mostrardatos').modal('show');
		        	$('.modal-dialog').css('width','850px');
		        	$('.mostrartitulo').html("Diplomas por Empresas");
		        	$('.contenido').html(data);
		        }
		    });
		}

	});

	$(document).on("click", "#genera_diploma_empresa", function(event) {

		event.preventDefault();

		var id_matricula = $('#id_matricula').val();
		var id_empresa = $(this).attr('name');
		var ndiplomas = $(this).attr('ndip');

		if ( ndiplomas < 10 ) {

			if ( sec[1] == 'form_matricula_doc' )
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&mod=o', '_blank');
			else
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&mod=p', '_blank');


		} else {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&id_emp='+id_empresa+'&ndiplomas='+ndiplomas+'&partesdiploma=1'+'&tipo=bonif',
				success: function(data)
				{
					// $('#mostrardatosc').modal('show');
					$('.contenido').html(data);
				}
			});
		}

	});


	$(document).on("click", "#genera_diploma_empresa_nobonif", function(event) {

		event.preventDefault();

		var id_matricula = $('#id_matricula').val();
		var id_empresa = $(this).attr('name');
		var ndiplomas = $(this).attr('ndip');

		if ( ndiplomas < 10 ) {

			if ( sec[1] == 'form_matricula_doc' )
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_nobonif_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&mod=o', '_blank');
			else
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_nobonif_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&mod=p', '_blank');

		} else {


			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-presenciales.php',
				data: 'id_mat='+id_matricula+'&id_emp='+id_empresa+'&ndiplomas='+ndiplomas+'&partesdiploma=1'+'&tipo=privado',
				success: function(data)
				{
					// $('#mostrardatosc').modal('show');
					$('.contenido').html(data);
				}
			});
		}

	});

	$(document).on("click", "a[id*='botondiploma']", function(event) {

		var id_matricula = $(this).attr('id_mat');
		var id_empresa = $(this).attr('id_emp');
		var resto = $(this).attr('resto');
		var nbotones = $(this).attr('total');
		var nboton = $(this).attr('id');
		nboton = nboton.substr(-1);
		// alert(nboton);


		if ( $(this).attr('tipo') == 'bonif' ) {

			if ( sec[1] == 'form_matricula_doc' )
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones,'&mod=o', '_blank');
			else
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones+'&mod=p', '_blank');

		} else {

			if ( sec[1] == 'form_matricula_doc' )
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_nobonif_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones+'&mod=o', '_blank');
			else
				window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_pre_nobonif_empresa.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&nboton='+nboton+'&resto='+resto+'&total='+nbotones+'&mod=p', '_blank');
		}


	});


	$("#fechasexcluir").on('click', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_matricula+'&devuelvefechasex=1'+'&tipo=p',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','400px');
				var anadir_fecha = '<div class="col-md-10 col-md-push-1" style="text-align:center"><a style="margin-top: 10px" id="anadir_fecha_ex" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Añadir Fecha</a></div>';

	        	if ( data != "" ) {
	        		$('.contenido').html(data);
	        		$('.fin_fecha_ex').after(anadir_fecha);
					$('.mostrartitulo').html("Excluir Fechas");
					$('.contenido').css('overflow','auto');
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasex');
					$('button#guardarfechasinc').attr('id','guardarfechasex');

				} else {
	        		//var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasex">Fecha A Excluir:</label><input type="date" id="fechasex" name="fechasex[]" class="form-control" /></div></div><span class="fin_fecha_ex"></span></div>';
					$('.mostrartitulo').html("Excluir Fechas");
					$('.contenido').css('overflow','auto');
					$('.contenido').html('<div style="margin-top: 10px; text-align:center" class="col-md-12" id="nofechas">No hay fechas a excluir.</div>');
					$('#nofechas').after(anadir_fecha);
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasex');
					$('button#guardarfechasinc').attr('id','guardarfechasex');
					//$('.modal-footer').html('<a id="guardarfechasex" class="btn btn-primary">Guardar</a>');
				}
	        }
    	});

	});


	$("#fechasexcluirod").on('click', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_matricula+'&devuelvefechasex=2'+'&tipo=od',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','400px');
				var anadir_fecha = '<div class="col-md-10 col-md-push-1" style="text-align:center"><a style="margin-top: 10px" id="anadir_fecha_exod" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Añadir Fecha</a></div>';

	        	if ( data != "" ) {
	        		$('.contenido').html(data);
	        		$('.fin_fecha_ex').after(anadir_fecha);
					$('.mostrartitulo').html("Excluir Fechas");
					$('.contenido').css('overflow','auto');
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasexod');
					$('button#guardarfechasinc').attr('id','guardarfechasexod');

				} else {
	        		//var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasex">Fecha A Excluir:</label><input type="date" id="fechasex" name="fechasex[]" class="form-control" /></div></div><span class="fin_fecha_ex"></span></div>';
					$('.mostrartitulo').html("Excluir Fechas");
					$('.contenido').css('overflow','auto');
					$('.contenido').html('<div style="margin-top: 10px; text-align:center" class="col-md-12" id="nofechas">No hay fechas a excluir.</div>');
					$('#nofechas').after(anadir_fecha);
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasexod');
					$('button#guardarfechasinc').attr('id','guardarfechasexod');
					//$('.modal-footer').html('<a id="guardarfechasex" class="btn btn-primary">Guardar</a>');
				}
	        }
    	});

	});

	$(document).on("click","#anadir_fecha_ex", function (event) {

		event.preventDefault();
		$('#nofechas').remove();
		var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasex">Fecha A Excluir:</label><input type="date" id="fechasex" name="fechasex[]" class="form-control" /></div></div></div>';
		$('#mostrardatos #anadir_fecha_ex').before(input_fecha);
		//window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		//window.open('http://gestion.eduka-te.com/app/documentacion/docu_fechas.php?id_matricula='+id_matricula,'_blank');

	});

	$(document).on("click","#anadir_fecha_exod", function (event) {

		event.preventDefault();
		$('#nofechas').remove();
		var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasexod">Fecha A Excluir:</label><input type="date" id="fechasexod" name="fechasexod[]" class="form-control" /></div></div></div>';
		$('#mostrardatos #anadir_fecha_exod').before(input_fecha);
		//window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		//window.open('http://gestion.eduka-te.com/app/documentacion/docu_fechas.php?id_matricula='+id_matricula,'_blank');

	});

	$(document).on("click","#guardarfechasex", function (event) {

		event.preventDefault();

		var values = '';
		var values = $('.contenido').find("#fechasex").serialize();
		var fechastr = '';
		var len = $('input#fechasex').length;
		$('input#fechasex').each( function (index) {
			fechastr += $(this).val();
			if ( index != len - 1 ) fechastr += ',';
		});

		if (fechastr.charAt(fechastr.length-1) == ',')
			fechastr = fechastr.substr(0, fechastr.length-1);

		$('button#guardarfechasex').attr('id','guardarcambios');
		$('#fechas_excluir').val(fechastr);
		// alert(fechastr);

	});

	$(document).on("click","#guardarfechasexod", function (event) {

		event.preventDefault();

		var values = '';
		var values = $('.contenido').find("#fechasexod").serialize();
		var fechastrod = '';
		var len = $('input#fechasexod').length;
		$('input#fechasexod').each( function (index) {
			fechastrod += $(this).val();
			if ( index != len - 1 ) fechastrod += ',';
		});

		if (fechastrod.charAt(fechastrod.length-1) == ',')
			fechastrod = fechastrod.substr(0, fechastrod.length-1);

		$('button#guardarfechasexod').attr('id','guardarcambios');
		$('#fechas_excluirod').val(fechastrod);
		// alert(fechastrod);

	});

	$(document).on("click","#actualizarfechasex", function (event) {

		event.preventDefault();

		var id = $(this).attr('valor');
		var fecha = $('#fechasex'+id).val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_fecha='+id+'&fecha='+fecha+'&actualizarfechasex=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('hide');
	        	$('#confirmacion').html("Fecha modificada correctamente");
	        	$('#confirmacion').show(500).delay(2000).hide('slow');
			    // setTimeout(function(){location.reload();},2200);
	        }
    	});

	});

	$(document).on("click","#actualizarfechasexod", function (event) {

		event.preventDefault();

		var id = $(this).attr('valor');
		var fecha = $('#fechasexod'+id).val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_fecha='+id+'&fecha='+fecha+'&actualizarfechasex=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('hide');
	        	$('#confirmacion').html("Fecha modificada correctamente");
	        	$('#confirmacion').show(500).delay(2000).hide('slow');
			    // setTimeout(function(){location.reload();},2200);
	        }
    	});

	});

	$(document).on("click","#actualizarfechasinc", function (event) {

		event.preventDefault();

		var id = $(this).attr('valor');
		var dia = $('#dia'+id).val();
		var horariomini = $('#horariomini'+id).val();
		var horariomfin = $('#horariomfin'+id).val();
		var horariotini = $('#horariotini'+id).val();
		var horariotfin = $('#horariotfin'+id).val();

		var sec = $(location).attr('href').split("?");

		if ( sec[1].indexOf('form_tpc') != -1 ) {
			var sec = 'tpc';
 		} else {
 			var sec = 'notpc';
 		}

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_fecha='+id+'&dia='+dia+'&horariomini='+horariomini+'&horariomfin='+horariomfin+'&horariotini='+horariotini+'&horariotfin='+horariotfin+'&tipo=p'+'&sec='+sec+'&actualizarfechasinc=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('hide');
	  			$('#confirmacion').html("Fecha modificada correctamente");
	        	$('#confirmacion').show(500).delay(2000).hide('slow');
	        }
    	});

	});

	$(document).on("click","#actualizarfechasincod", function (event) {

		event.preventDefault();

		var id = $(this).attr('valor');
		var dia = $('#dia'+id).val();
		var horariomini = $('#horariomini'+id).val();
		var horariomfin = $('#horariomfin'+id).val();
		var horariotini = $('#horariotini'+id).val();
		var horariotfin = $('#horariotfin'+id).val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_fecha='+id+'&dia='+dia+'&horariomini='+horariomini+'&horariomfin='+horariomfin+'&horariotini='+horariotini+'&horariotfin='+horariotfin+'&tipo=od'+'&actualizarfechasinc=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('hide');
	  			$('#confirmacion').html("Fecha modificada correctamente");
	        	$('#confirmacion').show(500).delay(2000).hide('slow');
	        }
    	});

	});


	$("#fechasincluir").on('click', function(event) {

		event.preventDefault();
		// console.log(sec);

		var sec = $(location).attr('href').split("?");

		if ( sec[1].indexOf('form_tpc') != -1 ) {

			var id_matricula = $('#id').val();
			var sec = 'tpc';

		} else {

			var id_matricula = $('#id_matricula').val();
			var sec = 'notpc';
		}


		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_matricula+'&tipo=p'+'&sec='+sec+'&devuelvefechasin=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','900px');
				var anadir_fecha = '<div class="col-md-12" style="text-align:center"><a style="margin-top: 10px" id="anadir_fecha_inc" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Añadir Fecha</a></div>';

	        	if ( data != "" ) {
	        		$('.contenido').html(data);
	        		$('.fin_fecha_ex').after(anadir_fecha);
					$('.mostrartitulo').html("Incluir Fechas");
					$('.contenido').css('overflow','auto');
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasinc');
					$('button#guardarfechasex').attr('id','guardarfechasinc');


				} else {
	        		//var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasex">Fecha A Excluir:</label><input type="date" id="fechasex" name="fechasex[]" class="form-control" /></div></div><span class="fin_fecha_ex"></span></div>';
					$('.mostrartitulo').html("Incluir Fechas");
					$('.contenido').css('overflow','auto');
					$('.contenido').html('<div style="margin-top: 10px; text-align:center" class="col-md-12" id="nofechas">No hay fechas a incluir.</div>');
					$('#nofechas').after(anadir_fecha);
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasinc');
					$('button#guardarfechasex').attr('id','guardarfechasinc');

					//$('.modal-footer').html('<a id="guardarfechasex" class="btn btn-primary">Guardar</a>');
				}
	        }
    	});

	});


	$("#fechasincluirod").on('click', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();
		// var tipo = 'od';


		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_matricula+'&tipo=od'+'&devuelvefechasin=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','900px');
				var anadir_fecha = '<div class="col-md-12" style="text-align:center"><a style="margin-top: 10px" id="anadir_fecha_incod" class="btn btn-default"><span class="glyphicon glyphicon-plus-sign"></span> Añadir Fecha</a></div>';

	        	if ( data != "" ) {
	        		$('.contenido').html(data);
	        		$('.fin_fecha_ex').after(anadir_fecha);
					$('.mostrartitulo').html("Incluir Fechas");
					$('.contenido').css('overflow','auto');
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasincod');
					$('button#guardarfechasex').attr('id','guardarfechasincod');


				} else {
	        		//var input_fecha = '<div style="margin-top: 15px"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="fechasex">Fecha A Excluir:</label><input type="date" id="fechasex" name="fechasex[]" class="form-control" /></div></div><span class="fin_fecha_ex"></span></div>';
					$('.mostrartitulo').html("Incluir Fechas");
					$('.contenido').css('overflow','auto');
					$('.contenido').html('<div style="margin-top: 10px; text-align:center" class="col-md-12" id="nofechas">No hay fechas a incluir.</div>');
					$('#nofechas').after(anadir_fecha);
					$('button#guardarcambios').css('display','inline-block');
					$('button#guardarcambios').attr('id','guardarfechasincod');
					$('button#guardarfechasex').attr('id','guardarfechasincod');

					//$('.modal-footer').html('<a id="guardarfechasex" class="btn btn-primary">Guardar</a>');
				}
	        }
    	});

	});

	$(document).on("click","#anadir_fecha_inc", function (event) {

		event.preventDefault();
		$('#nofechas').remove();
		var input_fecha_inc = '<div id="fechasincluir" style="margin-top: 15px; overflow: auto;"><div style="margin-bottom: 15px" class="col-md-5"><div class="form-group"><label class="control-label" for="fechasinc">Fecha a incluir:</label><input type="date" id="fechasinc" name="fechasinc[]" class="form-control"/></div></div><div class="clearfix"></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariomini">Horario Mañana (inicio):</label><input type="text" id="horariomini" name="horariomini" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariomfin">Horario Mañana (fin):</label><input type="text" id="horariomfin" name="horariomfin" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariotini">Horario Tarde (inicio):</label><input type="text" id="horariotini" name="horariotini" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariotfin">Horario Tarde (fin):</label><input type="text" id="horariotfin" name="horariotfin" class="form-control"/></div></div></div>';
		$('#mostrardatos #anadir_fecha_inc').before(input_fecha_inc);
		//window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		//window.open('http://gestion.eduka-te.com/app/documentacion/docu_fechas.php?id_matricula='+id_matricula,'_blank');

	});

$(document).on("click","#anadir_fecha_incod", function (event) {

		event.preventDefault();
		$('#nofechas').remove();
		var input_fecha_incod = '<div style="margin-top: 15px; overflow: auto;"><div style="margin-bottom: 15px" class="col-md-5"><div class="form-group"><label class="control-label" for="fechasincod">Fecha a incluir:</label><input type="date" id="fechasincod" name="fechasincod[]" class="form-control"/></div></div><div class="clearfix"></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariomini_incod">Horario Mañana (inicio):</label><input type="text" id="horariomini_incod" name="horariomini_incod" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariomfin_incod">Horario Mañana (fin):</label><input type="text" id="horariomfin_incod" name="horariomfin_incod" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariotini_incod">Horario Tarde (inicio):</label><input type="text" id="horariotini_incod" name="horariotini_incod" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariotfin_incod">Horario Tarde (fin):</label><input type="text" id="horariotfin_incod" name="horariotfin_incod" class="form-control"/></div></div></div>';
		$('#mostrardatos #anadir_fecha_incod').before(input_fecha_incod);
		console.log
		//window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		//window.open('http://gestion.eduka-te.com/app/documentacion/docu_fechas.php?id_matricula='+id_matricula,'_blank');

	});

	$(document).on("click","#guardarfechasex", function (event) {

		event.preventDefault();

		var values = $('.contenido').find("input[type='hidden'], :input:not(:hidden)").serialize();
		var fechastr = '';
		var len = $('input#fechasex').length;
		$('input#fechasex').each( function (index) {
			fechastr += $(this).val();
			if ( index != len - 1 ) fechastr += ',';
		});

		if (fechastr.charAt(fechastr.length-1) == ',')
			fechastr = fechastr.substr(0, fechastr.length-1);
//
		$('button#guardarfechasex').attr('id','guardarcambios');
		$('#fechas_excluir').val(fechastr);
		// alert(fechastr);

		// $('#guardarfechasex').data('fechas_excluir',[]);
		// $('#guardarfechasex').data('fechas_excluir').push(values);
		// var fechas = array();
		// fechas = $('#guardarfechasex').data('fechas_excluir')[0];
		// console.log($('#guardarfechasex').data('fechas_excluir')[0]);
		// alert(fechas);
		// for (var i = fechas.length - 1; i >= 0; i--) {
		// 	fechastr += fechas[i];
		// }
		// console.log(fechastr);
		//console.log(values);
		//alert(values);

		// $.ajax({
	 //        cache: false,
	 //        type: 'POST',
	 //        url: 'functions/funciones-presenciales.php',
	 //        data: values+'&id_matricula='+id_matricula+'&fechasexcluir=1',
	 //        success: function(data)
	 //        {
	 //        	alert(data);
	 //        }
  //   	});

	});

	$("#docurellena").on('click', function(event) {

		var id_matricula = $('#id_matricula').val();

		window.open('http://gestion.eduka-te.com/app/documentacion/generadoc.php?id_matricula='+id_matricula,'_blank');
		window.open('http://gestion.eduka-te.com/app/documentacion/documentacion_rellena.php?id_matricula='+id_matricula,'_blank');

		$.ajax({
			cache: false,
			dataType: 'json',
			type: 'POST',
			url: 'documentacion/documentacion_cvdocente.php',
			data: 'id_matricula='+id_matricula,
			success: function(data)
			{

				// $.each(data, function(i, item) {
				//     alert(data[i].host);
				// });​
				for (var key in data) {
				  if (data.hasOwnProperty(key)) {
				    console.log(key + " -> " + data[key]);
				    window.open(data[key].url);
				  }
				}
				// window.open(data);
			}
		});

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'documentacion/documentacion_metodologia.php',
			data: 'id_matricula='+id_matricula,
			success: function(data)
			{
				if ( data != 0 )
					window.open(data);
			}
		});


	});


	$(document).on("click","#xmlfinpre", function (event) {

		var id_matricula = $('#id_matricula').val();

		window.location = 'export/xml_finalizacion_prepost_nordotel24.php?id_matricula='+id_matricula;

	});

	$(document).on("click","#xmlfinprepost", function (event) {

		var id_matricula = $('#id_matricula').val();

		window.location = 'export/xml_finalizacion_prepost.php?id_matricula='+id_matricula;

	});

	$(document).on("click", "#seleccionargrupo", function(event) {

		event.preventDefault();
		// alert("seleccionar todo");
		var i = 0;
		var grupo = $('#grupo').val();
		var tipo = $('select#tipo_formacion').val();
		var naccion = $('#numeroaccion').val();

		// console.log(tipo);
		$.ajax({
	        cache: false,
	        type: 'POST',
	        dataType: 'json',
	        url: 'functions/funciones-presenciales.php',
	        data: 'grupo='+grupo+'&tipo='+tipo+'&naccion='+naccion,
	        success: function(data)
	        {

	        	if ( data['nope'] !== undefined ) {
	        		alert(data['nope']);
	        		$('#mostrardatos').modal('hide');

	        		$('.fin_empresa').before(data['empresas']);

	        		$('#presupuestocuadro').css('display','block');
	        			        		// alert("e");
	        		$('#btnempresas-pre').css('margin-top','15px');
					$('#paraquitar').remove();

	        	} else {
		        	$('#mostrardatos').modal('hide');

		        	$('.fin_empresa').before(data['empresas']);

		        	$('#presupuestocuadro').css('display','block');
		        		// alert("e");
		        	$('#btnempresas-pre').css('margin-top','15px');
		        	$('#paraquitar').remove();
	        	}


	        }
    	});


	});

	$(document).on("click", ".eliminaremp", function(event){
    	var id = $(this).attr('id').replace('eliminaremp','');
    	$("#emp"+id).remove();
    	$('body, html').animate({ scrollTop: $("#empre").offset().top }, 1000);
    });

	$("#leerexcel").on('click', function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		if ( sec[1] != 'form_matricula_doc' && sec[1] != 'form_matricula_doc#' ) {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel.php',
		        //url: 'plugins/PhpSpreadsheet/leerexcel.php',
						// url: 'vendor/leerexcel.php',
		        data: 'id_mat='+id_matricula+'&tipo=doc',
		        success: function(data)
		        {
		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

								// alert(data);

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1300px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
			            $('.contenido').html(data);
			            $('input#afile').css('display','none');
			            $('#docurellena').css('display','inline-block');
			            $('#diploma_bonif').css('display','inline-block');
			            $('#diploma_bonif_atras').css('display','inline-block');
			            $('#diploma_empresa').css('display','inline-block');
			            $('#leerexcel').addClass('btn-sm');
		                $('#docurellena').addClass('btn-sm');
		                $('#diploma_bonif').addClass('btn-sm');
		                $('#diploma_bonif_atras').addClass('btn-sm');
						$('#guiadelalumnoblancot','#guiadelalumnoblancod','#guiadelalumnom').addClass('btn-sm');
		                $('#docublanco').addClass('btn-sm');
		                // $('#btnsubidas').addClass('btn-sm');
		                $('#subirexcel').css('display','none');
		                $('#guiadelalumnoblancot').css('margin-left','10px');

		                if ( $('#modalidad').val() == 'Mixta' ) {

							$('#diploma_empresa').before(alumnoguia);
							$('#guiadelalumnom').addClass('btn-sm');

						} else { $('#guiadelalumnom').css('display','none'); }

		            }
		        }
	    	});

		} else {

			$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin_o.php',
		        data: 'id_mat='+id_matricula+'&tipo=doc',
		        success: function(data)
		        {
		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1300px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
			            $('.contenido').html(data);
			            $('input#afile').css('display','none');
			            $('#guiadelalumnogrupo').css('display','inline-block');
						$('#guiadelalumnogrupo').addClass('btn-sm');
			            $('#diploma_bonif').css('display','inline-block');
			            $('#diploma_bonif_atras').css('display','inline-block');
			            $('#diploma_empresa').css('display','inline-block');
			            $('#leerexcel').addClass('btn-sm');
		                $('#diploma_bonif').addClass('btn-sm');
		                $('#diploma_bonif_atras').addClass('btn-sm');
		                $('#docublanco').addClass('btn-sm');
		                // $('#btnsubidas').addClass('btn-sm');
		                $('#subirexcel').css('display','none');
		                // $('#cargardatos_o').addClass('btn-sm');

		            }
		        }
	    	});

		}

	});

	$("#leerexcel_privado").on('click', function(event) {

		event.preventDefault();

		var id_matricula = $('#id_matricula').val();


		if ( sec[1] != 'form_matricula_doc' && sec[1] != 'form_matricula_doc#' ) {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_privado.php',
		        data: 'id_mat='+id_matricula+'&tipo=doc'+'&bonificado=p',
		        success: function(data)
		        {
		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1200px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
			            $('.contenido').html(data);
			            $('input#apfile').css('display','none');
			            $('#docurellena_privado').css('display','inline-block');
			            $('#diploma_nobonif').css('display','inline-block');
			            $('#diploma_bonif_atrasp').css('display','inline-block');
			            $('#diploma_empresap').css('display','inline-block');
			            $('#leerexcel_privado').addClass('btn-sm');
		                $('#docurellena_privado').addClass('btn-sm');
		                $('#diploma_nobonif').addClass('btn-sm');
		                $('#docublanco_privado').addClass('btn-sm');
		                $('#diploma_bonif_atrasp').addClass('btn-sm');
		                $('#btnsubidas_privado').addClass('btn-sm');
		                $('#subirexcel_privado').css('display','none');
		                $('#cuestionario').addClass('btn-sm');

		                if ( $('#modalidad').val() == 'Mixta' ) {

							$('#docublanco_privado').before(alumnoguiap);
							$('#guiadelalumnomprivado').addClass('btn-sm');

						} else { $('#guiadelalumnomprivado').css('display','none'); }
		            }
		        }
	    	});

		} else {

			$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin_oprivado.php',
		        data: 'id_mat='+id_matricula+'&tipo=doc'+'&bonificado=p',
		        success: function(data)
		        {
		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1200px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
			            $('.contenido').html(data);
			            $('input#apfile').css('display','none');
			            $('#guiadelalumnogrupo_privado').css('display','inline-block');
						$('#guiadelalumnogrupo_privado').addClass('btn-sm');
			            $('#diploma_nobonif').css('display','inline-block');
			            $('#diploma_bonif_atrasp').css('display','inline-block');
			            $('#diploma_empresap').css('display','inline-block');
			            $('#leerexcel_privado').addClass('btn-sm');
		                $('#docurellena_privado').addClass('btn-sm');
		                $('#diploma_nobonif').addClass('btn-sm');
		                $('#docublanco_privado').addClass('btn-sm');
		                $('#diploma_bonif_atrasp').addClass('btn-sm');
		                $('#btnsubidas_privado').addClass('btn-sm');
		                $('#subirexcel_privado').css('display','none');
		                // $('#cargardatos_o_privado').addClass('btn-sm');

		            }
		        }
	    	});
		}

	});

	$("#leerexcel_fin").on('click', function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();
		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width','1200px');
		$('.mostrartitulo').html("Mostrando datos del Excel");
		$('.contenido').html("Cargando...");

		if ( sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_doc' ) {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin_o.php',
		        data: 'id_matricula='+id_mat+'&tipo=fin',
		        success: function(data)
		        {
		            $('.contenido').html(data);
		            $('#cargardatos').css('display','inline-block');
		        }
	    	});

	    } else {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin.php',
		        data: 'id_matricula='+id_mat+'&tipo=fin',
		        success: function(data)
		        {
		            $('.contenido').html(data);
		            $('#cargardatos').css('display','inline-block');
		        }
	    	});

	    }

	});

	$("#leerexcel_fin_privado").on('click', function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();

		if ( sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_doc' ) {

	    	$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin_oprivado.php',
		        data: 'id_mat='+id_mat+'&tipo=fin'+'&bonificado=p',
		        success: function(data)
		        {

		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1200px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
				        $('.contenido').html(data);
			            $('#cargardatos').css('display','inline-block');
		        	}
		    	}

    		});

    	} else {

    		$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'plugins/phpexcel/leerexcel_fin_privado.php',
		        data: 'id_mat='+id_mat+'&tipo=fin'+'&bonificado=p',
		        success: function(data)
		        {

		        	if (data == 'no') {

		        		alert("No existe información para esta acción.")

		        	} else {

			        	$('#mostrardatos').modal('show');
						$('.modal-dialog').css('width','1200px');
						$('.mostrartitulo').html("Mostrando datos del Excel");
				        $('.contenido').html(data);

		        	}
		    	}
		    });

    	}

	});

	$("#cargardatos").on('click', function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_mat+'&mostrarfinpresencial=1',
	        success: function(data)
	        {
	            if (data != "") {
	            	$('#matricula_fin').html(data);
	            	$('#xmlfinpre,#xmlfinprepost').css('display','inline-block');

	            	if ( sec[1] == 'form_matricula_doc' || sec[1] == 'form_matricula_doc#' ) {
	            		$('#leerexcel_fin').addClass('btn-sm');
						$('#guiadelalumnogrupo').css('display','inline-block');
						$('#guiadelalumnogrupo').addClass('btn-sm');
			            $('#diploma_bonif').css('display','inline-block');
			            $('#diploma_bonif_atras').css('display','inline-block');
			            $('#diploma_empresa').css('display','inline-block');
		                $('#diploma_bonif').addClass('btn-sm');
		                $('#diploma_bonif_atras').addClass('btn-sm');
		                $('#docublanco').addClass('btn-sm');
		                // $('#btnsubidas').addClass('btn-sm');
		                $('#subirexcel_fin').css('display','none');
		                $('#cargardatos').addClass('btn-sm');
		                $('input#afile').css('display','none');
		                $('#leerexcel_fin').css('display','none');
		                $('#leerexcel').css('display','none');
		                $('#subirexcel').css('display','none');
						$('#xmlfin_grupo').css('display','inline-block');
						$('#justifcerts, #justifcertsp').css('display','inline-block');
						$('#justifcerts, #justifcertsp').addClass('btn-sm');
						$('#diplomasalumnogrupo').addClass('btn-sm');
		            }

	            } else {
	            	alert("No hay datos cargados para este curso.");
	            }
	        }
    	});

	});

	$("#cargardatos_fin_privado").on('click', function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_mat+'&mostrarfinpresencial=2',
	        success: function(data)
	        {
	            if (data != "") {
	            	$('#matricula_fin_privado').html(data);

	            	if ( sec[1] == 'form_matricula_doc' || sec[1] == 'form_matricula_doc#' ) {
	            		$('#leerexcel_fin_privado').addClass('btn-sm');
				        $('#guiadelalumnogrupo_privado').css('display','inline-block');
						$('#guiadelalumnogrupo_privado').addClass('btn-sm');
				        $('#diploma_nobonif').css('display','inline-block');
				        $('#diploma_bonif_atrasp').css('display','inline-block');
				        $('#diploma_empresap').css('display','inline-block');
				        $('#leerexcel_privado').addClass('btn-sm');
			            $('#docurellena_privado').addClass('btn-sm');
			            $('#diploma_nobonif').addClass('btn-sm');
			            $('#docublanco_privado').addClass('btn-sm');
			            $('#diploma_bonif_atrasp').addClass('btn-sm');
			            $('#btnsubidas_privado').addClass('btn-sm');
			            $('#subirexcel_privado').css('display','none');
			            $('#leerexcel_privado').css('display','none');
			            $('input#apfile').css('display','none');
			            $('#cargardatos_fin_privado').addClass('btn-sm');
			            $('#diplomasalumnogrupop').addClass('btn-sm');
			            $('#vin').css('display','inline-block').css('margin-top','1px').css('margin-left','10px');
		        	}

	            } else {
	            	alert("No hay datos cargados para este curso.");
	            }
	        }
    	});

	});

	$(document).on("click", "#mostrarAlumnosEmpPre", function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();
		if ( id_mat == "" || id_mat == undefined )
			var id_mat = $(this).attr('id_mat');

		// alert(id_mat);

		var id_emp = $(this).attr('name');
		var tipo = $(this).attr('tipo');

		$('#mostrardatos').modal('show');
		$('.contenido').html("Cargando...");

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_mat+'&id_empresa='+id_emp+'&tipo='+tipo+'&mostraralumnosemppre=1',
	        success: function(data)
	        {

	            $('.mostrartitulo').html("Mostrando datos de alumnos");
	            $('.contenido').html(data);
	        }
    	});

	});

	// $(document).on("keydown", "#costes_indirectos", function(event) {

	// 	var plantillamedia = $('#plantillamedia').val();
	// 	// alert(plantillamedia);
	// 	var porcen = 0;

	// 	if ( plantillamedia >= 1 && plantillamedia <= 6 )
	// 		porcen = 20;
	// 	else if ( plantillamedia >= 7 && plantillamedia <= 9 )
	// 		porcen = 15;
	// 	else if ( plantillamedia >= 10 )
	// 		porcen = 10;

	// 	var calculo = ( parseFloat($('#costes_imparticion').val())+ parseFloat($('#costes_indirectos').val()) )* ( parseFloat(porcen/100) );
	// 	// alert($('#costes_imparticion').val() + $('#costes_indirectos').val());
	// 	$('#costes_organizacion').val(calculo.toFixed(2));


	// });

	$(document).on("click", "#mostrarAlumnosEmpPrePrivado", function(event) {

		event.preventDefault();

		var id_mat = $('#id_matricula').val();

		if ( id_mat == "" || id_mat == undefined )
			var id_mat = $(this).attr('id_mat');

		// alert(id_mat);
		var id_emp = $(this).attr('name');

		$('#mostrardatos').modal('show');
		$('.contenido').html("Cargando...");

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id_matricula='+id_mat+'&id_empresa='+id_emp+'&mostraralumnosemppre=2',
	        success: function(data)
	        {

	            $('.mostrartitulo').html("Mostrando datos de alumnos");
	            $('.contenido').html(data);
	        }
    	});

	});

	$(document).on("click", "#mostrarCostesPre", function(event) {

		event.preventDefault();

		if ( $('#tipofra').val() == "" ) {

			alert("Debes seleccionar el tipo de factura.");
			return false;

		} else {


		var id_emp = $(this).attr('name');
		var input_emp = '<input type=hidden id="id_emp" />';
		var costes = '<div id="datoscostespre" style="margin-top:15px;overflow:auto;"><input type="hidden" name="plantillamedia" id="plantillamedia" value="0"/><input type="hidden" name="id_coste" id="id_coste" value="0"/><div class="col-md-6"><div class="form-group"><label class="control-label" for="empresacostes"> Empresa: </label><input type="text" id="empresacostes" name="empresacostes" class="form-control" disabled/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="ntrabajadores"> Nº Alumnos: </label><input type="text" id="ntrabajadores" name="ntrabajadores" class="form-control" disabled/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="porcentaje_cof"> % Cofinanciación: </label><input type="text" id="porcentaje_cof" name="porcentaje_cof" class="form-control" disabled/></div></div><div class="clearfix"></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="metodo"> Método Cálculo: </label><select id="metodo" name="metodo" class="form-control" ><option value="m0"> Selecciona </option><option value="m1"> Salario mínimo </option><option value="m2"> Salarios medios </option></select></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="costes_salariales"> Costes Salariales: </label><input placeholder="Selecciona método..." type="text" id="costes_salariales" name="costes_salariales" class="form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="costes_ind"> Directos Individuales: </label><div class="input-group"><input type="text" id="costes_ind" name="costes_ind" class="form-control" ><span class="input-group-btn"><a id="btnCalculoCosteTotal" name="btnCalculoCosteTotal" class="btn btn-default"> Calcular </a></span></div></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="costes_imparticion">Directos Totales: </label><input type="text" id="costes_imparticion" name="costes_imparticion" class="form-control"/></div></div><div class="clearfix"></div><div class="col-md-2"><div class="cp form-group"><label class="control-label" for="max_boni_ind"> Máx. Bonif. Ind.: </label><input type="text" id="max_boni_ind" name="max_boni_ind" class="form-control" disabled></div></div><div class="col-md-2"><div class="cp form-group"><label class="control-label" for="maximo_bonificable"> Máx. Bonif. Tot.: </label><input type="text" id="maximo_bonificable" name="maximo_bonificable" class="form-control" readonly></div></div><div class="col-md-2"><div class="cp form-group"><label class="control-label" for="importe_a_bonificar"> Importe bonif.: </label><input type="text" id="importe_a_bonificar" name="importe_a_bonificar" class="form-control" ></div></div><div class="col-md-2"><div class="cp form-group"><label class="control-label" for="costes_indirectos"> Indirectos: </label><input type="text" id="costes_indirectos" name="costes_indirectos" class="form-control" ></div></div><div class="col-md-2"><div class="cp form-group"><label class="control-label" for="costes_organizacion"> Organización: </label><input type="text" id="costes_organizacion" name="costes_organizacion" class="form-control" ></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="mes_bonificable"> Meses: </label><select id="mes_bonificable" name="mes_bonificable" class="form-control" ><option value="1"> Enero </option><option value="2"> Febrero </option><option value="3"> Marzo </option><option value="4"> Abril </option><option value="5"> Mayo </option><option value="6"> Junio </option><option value="7"> Julio </option><option value="8"> Agosto </option><option value="9"> Septiembre </option><option value="10"> Octubre </option><option value="11"> Noviembre </option><option value="12"> Diciembre </option></select></div></div><div class="col-md-2" style="margin-top:15px;"><div class="cp form-group"><label class="control-label" for="igic"> IGIC: </label><input type="text" id="igic" name="igic" class="form-control" ></div></div>';


		if ( $('input#estado').val() == 'Facturada' )
			costes += '</div>';
		else
			costes += '<a id="guardarcostes" style="margin-left: 15px;margin-top:40px;" class="btn btn-sm btn-success"> Guardar Costes </a></div><div class="clearfix"></div>';


		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width','900px');
		$('.mostrartitulo').html("Mostrando datos de Costes");
		$('.contenido').html(costes);

		var id_mat = $('#id_matricula').val();

		$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/costes.php',
		        data: 'id_mat='+id_mat+'&id_emp='+id_emp+'&devuelve=2',
		        dataType: 'json',
		        success: function(data)
		        {

		        	$('#mostrardatos .contenido').append(input_emp);
		        	$('#ntrabajadores').val(data['ntrabajadores']);
		        	// alert(data['calculo']);

		        	$('#plantillamedia').val(data[0].plantillamedia);
			        $('#id_emp').val(id_emp);
		        	if (data[1].id != undefined)
		        		$('#id_coste').val(data[1].id);
		        	$('#empresacostes').val(data[0].razonsocial);
					$('#costes_imparticion').val(data[1].costes_imparticion);
					$('#porcentaje_cof').val(data[0].porcentajecof);

					$('#costes_indirectos').val(data[1].costes_indirectos);
					$('#costes_organizacion').val(data[1].costes_organizacion);

					if (data[1].costes_salariales == undefined)
						$('#costes_salariales').val("4.42");
					else
						$('#costes_salariales').val(data[1].costes_salariales);

					if (data[1].maximo_bonificable == 0) {
						$('#maximo_bonificable').val('∞');
						// $('#costes_salariales').val('0');
					}
					else {
						$('#maximo_bonificable').val(data[1].maximo_bonificable);
						$('#max_boni_ind').val( data[1].maximo_bonificable / $('#ntrabajadores').val() );
					}

					var meses = [];
					if (data[1].mes_bonificable == undefined) {
						for (var i = 1; i < data[2].mes_bonificable; i++) {
							meses[i] = i;
						};
						var i = 1;
						//console.log(meses);
						$('#mes_bonificable option').each(function () {
							if ( $(this).val() == meses[i] )
								$(this).remove();
							i++;
						});
						$('#mes_bonificable').val(data[2].mes_bonificable);
					}
					else {
						for (var i = 1; i < data[1].mes_bonificable; i++) {
							meses[i] = i;
						};
						//console.log(meses);
						var i = 1;

						$('#mes_bonificable option').each(function () {
							if ( $(this).val() == meses[i] )
								$(this).remove();
							i++;
						});
						$('#mes_bonificable').val(data[1].mes_bonificable);
					}

					$('#importe_a_bonificar').val(data[1].importe_a_bonificar);
					$('#igic').val(data[1].igic);

				}
    		});

		}

	});


	$(document).on("click", "#mostrarCostesPrePrivado", function(event) {

		event.preventDefault();

		if ( $('#tipofra').val() == "" ) {

			alert("Debes seleccionar el tipo de factura.");
			return false;

		} else {
		var id_emp = $(this).attr('name');
		var input_emp = '<input type=hidden id="id_emp" />';
		var costes = '<div id="datoscostesprep" style="margin-top:15px;"><input type="hidden" name="id_coste" id="id_coste" value="0"/><div class="col-md-8"><div class="form-group"><label class="control-label" for="empresacostes"> Empresa: </label><input type="text" id="empresacostes" name="empresacostes" class="form-control" disabled/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="ntrabajadores"> Nº Alumnos de privado: </label><input type="text" id="ntrabajadores" name="ntrabajadores" class="form-control" disabled/></div></div><div class="col-md-6"><div class="form-group"><label class="control-label" for="costes_ind"> Costes Individuales: </label><div class="input-group"><input type="text" id="costes_ind" name="costes_ind" class="form-control" ><span class="input-group-btn"><a id="btnCalculoCosteTotal" name="btnCalculoCosteTotal" class="btn btn-default"> Calcular </a></span></div></div></div><div class="col-md-6"><div class="form-group"><label class="control-label" for="costes_imparticion"> Costes Totales: </label><input type="text" id="costes_imparticion" name="costes_imparticion" class="form-control"/></div></div><div class="clearfix"></div><div style="" class="ta col-md-12"><div class="form-group"><label class="control-label" for="observaciones">Observaciones:</label><textarea name="observaciones" id="observaciones" class="form-control" rows="3"></textarea></div></div>';

		if ( $('input#estado').val() == 'Facturada' )
			costes += '</div>';
		else
			costes += '<a id="guardarcostesprivado" style="margin-left: 15px;margin-top:15px;" class="btn btn-sm btn-success"> Guardar Costes </a></div>';

		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width','700px');
		$('.mostrartitulo').html("Mostrando datos de Costes Privados");
		$('.contenido').html(costes);

		var id_mat = $('#id_matricula').val();

		$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/costes.php',
		        data: 'id_mat='+id_mat+'&id_emp='+id_emp+'&devuelve=3',
		        dataType: 'json',
		        success: function(data)
		        {

		        	$('#mostrardatos .contenido').append(input_emp);
		        	$('#ntrabajadores').val(data['ntrabajadores']);

			        $('#id_emp').val(id_emp);
			        $('#empresacostes').val(data[0].razonsocial);

	        		$('#id_coste').val(data[1].id);
					$('#costes_imparticion').val(data[1].costes_imparticion);
					$('#observaciones').val(data[1].observaciones);

				}
    		});

		}

	});


	$(document).on("click", "#btnCalculoCosteTotal", function(event) {

		event.preventDefault();

		$('#costes_imparticion').val( $('#costes_ind').val() * $('#ntrabajadores').val() );

	});

	$("#btnempresas-pre").on('click', function(event) {

		event.preventDefault();

		var tabla = $(this).attr('name');

		$('#mostrardatos').modal('show');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tabla='+tabla+'&abre=1'+'&mat=2',
	        success: function(data)
	        {
	            $('.mostrartitulo').html("Mostrando datos de "+tabla);
	            $('.modal-dialog').css('width','900px');
	            $('.contenido').html(data);
	        }
    	});
	});

	$("#btnempresas-ik").on('click', function(event) {

		event.preventDefault();

		var tabla = $(this).attr('name');

		$('#mostrardatos').modal('show');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tabla='+tabla+'&abre=1'+'&mat=2',
	        success: function(data)
	        {
	            $('.mostrartitulo').html("Mostrando datos de "+tabla);
	            $('.modal-dialog').css('width','900px');
	            $('.contenido').html(data);
	        }
    	});
	});

	$("#subirexcel").on('click', function(event) {

		event.preventDefault();

		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#afile').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('tipo', 'doc');
        formData.append('bonificado', 'si');

        $.ajax({
        	cache: false,
            url: 'functions/accept-file.php',
            type: 'POST',
            data: formData,
            processData: false,
       		contentType: false,
            success: function (data) {
                if ( data == 'bien' ) {
                	alert("Fichero subido correctamente.");
                	$('#leerexcel').css('display','inline-block');
                	$('#docublanco').css('display','inline-block');
                	$('#subirexcel').css('display','none');
                }
               	else
               		alert("Fallo en la subida.");
            }
        });
	});

	$("#subirexcel_privado").on('click', function(event) {

		event.preventDefault();

		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#apfile').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('tipo', 'doc');
        formData.append('bonificado', 'no');

        $.ajax({
        	cache: false,
            url: 'functions/accept-file.php',
            type: 'POST',
            data: formData,
            processData: false,
       		contentType: false,
            success: function (data) {
                if ( data == 'bien' ) {
                	alert("Fichero subido correctamente.");
                	$('#leerexcel_privado').css('display','inline-block');
                	$('#docublanco_privado').css('display','inline-block');
                	$('#subirexcel_privado').css('display','none');
                }
               	else
               		alert("Fallo en la subida.");
            }
        });
	});

	$("#subirexcel_fin").on('click', function(event) {

		event.preventDefault();

		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#afile').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('tipo', 'fin');
        formData.append('bonificado', 'si');

        $.ajax({
        	cache: false,
            url: 'functions/accept-file.php',
            type: 'POST',
            data: formData,
            processData: false,
       		contentType: false,
            success: function (data) {
                if ( data == 'bien' ) {
                	alert("Fichero subido correctamente.");
                	$('#leerexcel_fin').css('display','inline-block');
                	$('#subirexcel_fin').css('display','none');

                }
               	else
               		alert("Fallo en la subida.");
            }
        });
	});

	$("#subirexcel_fin_privado").on('click', function(event) {

		event.preventDefault();

		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#apfile').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('tipo', 'fin');
        formData.append('bonificado', 'no');

        $.ajax({
        	cache: false,
            url: 'functions/accept-file.php',
            type: 'POST',
            data: formData,
            processData: false,
       		contentType: false,
            success: function (data) {
                if ( data == 'bien' ) {
                	alert("Fichero subido correctamente.");
               		$('#leerexcel_fin_privado').css('display','inline-block');
               		$('#subirexcel_fin_privado').css('display','none');

                }
               	else
               		alert("Fallo en la subida.");
            }
        });
	});


	$(document).on("click", "#matp-seleccionarempresa,#matoini-seleccionarempresa", function(event) {

		event.preventDefault();
		i++;

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_empresa = parentTr.find('td#id').html();

    	if ( sec[1] == 'solicitudikea' )
    		var input_empresa = '<div class="clearfix"></div><div id="emp'+i+'"><input name="id_empresa[]" type="hidden" id="id_empresa'+i+'" value=""/><div class="col-md-6"><div class="form-group"><label class="control-label" for="razonsocial">Empresa:</label><input type="text" id="razonsocial'+i+'" name="razonsocial'+i+'" class=" form-control" disabled/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="nalus">Nº Participantes:</label><input type="text" id="nalus'+i+'" name="nalus[]" class=" form-control"/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="cif">CIF:</label><input type="text" id="cif'+i+'" name="cif'+i+'" class=" form-control" disabled/></div></div><div styl class="col-md-1"><a id="eliminaremp'+i+'" class="eliminaremp btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';
    	else
    		var input_empresa = '<div class="clearfix"></div><div id="emp'+i+'"><input name="id_empresa[]" type="hidden" id="id_empresa'+i+'" value=""/><div class="col-md-6"><div class="form-group"><label class="control-label" for="razonsocial">Empresa:</label><input type="text" id="razonsocial'+i+'" name="razonsocial'+i+'" class=" form-control" disabled/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="cif">CIF:</label><input type="text" id="cif'+i+'" name="cif'+i+'" class=" form-control" disabled/></div></div><div styl class="col-md-1"><a id="eliminaremp'+i+'" class="eliminaremp btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_empresa+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        //alert(data),
	        success: function(data)
	        {

	            	if ( $('select#tipo_formacion').val() == "" ) {
	            		alert("Selecciona primero el tipo de formación.");
	            	} else {

	            		// alert(data[0].disponible);
		            if ( (data[0].disponible == "0" || data[0].disponible === null)  && $('select#tipo_formacion').val() == 'Bonificable' && $('#numeroaccion').val() < 5000 ) {

		            	alert("La empresa "+data[0].razonsocial+" no dispone de crédito.");

		            } else if ( (data['aesfocc'] != 1 || data['aestra'] != 1) && $('select#tipo_formacion').val() == 'Bonificable' && $('#numeroaccion').val() < 5000 ) {

						alert("La empresa "+data[0].razonsocial+" no tiene subidos los dos anexos de encomienda.");

		        	} else {

		            	$('#mostrardatos').modal('hide');

		            	$('.fin_empresa').before(input_empresa);
		            	$('body, html').animate({ scrollTop: $("#razonsocial"+i).offset().top }, 1000);
		            	$('#id_empresa'+i).val(data[0].id);
		            	// $('#nalus'+i).val(data[0].nalus);
			            $('#razonsocial'+i).val(data[0].razonsocial);
			            $('#cif'+i).val(data[0].cif);
			            $('#presupuestocuadro').css('display','block');
			            $('#btnempresas-pre').css('margin-top','15px');
			            $('#paraquitar').remove();
		        	}
		        }

	        }
    	});

	});

	$(document).on("click", "#matm-seleccionarempresa", function(event) {

		event.preventDefault();
		i++;

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_empresa = parentTr.find('td#id').html();
    	var input_empresa = '<div class="clearfix"></div><div id="emp'+i+'"><input name="id_empresa[]" type="hidden" id="id_empresa'+i+'" value=""/><div class="col-md-8"><div class="form-group"><label class="control-label" for="razonsocial">Empresa:</label><input type="text" id="razonsocial'+i+'" name="razonsocial'+i+'" class=" form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="cif">CIF:</label><input type="text" id="cif'+i+'" name="cif'+i+'" class=" form-control" readonly/></div></div><div styl class="col-md-1"><a id="eliminaremp'+i+'" class="eliminaremp btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_empresa+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data)
	        {


		        	if ( (data[0].disponible == "0" || data[0].disponible === null) && $('select#tipo_formacion').val() == 'Bonificable'  && $('#numeroaccion').val() < 5000 ) {

		            	alert("La empresa "+data[0].razonsocial+" no dispone de crédito.");

		            } else if ( (data['aeduka-te'] != 1 || data['aestra'] != 1) && $('select#tipo_formacion').val() == 'Bonificable'  && $('#numeroaccion').val() < 5000 ) {

						alert("La empresa "+data[0].razonsocial+" no tiene subidos los dos anexos de encomienda.");

		        	} else {

			            $('#mostrardatos').modal('hide');

		            	$('.fin_empresa').before(input_empresa);
		            	$('body, html').animate({ scrollTop: $("#razonsocial"+i).offset().top }, 1000);
		            	$('#id_empresa'+i).val(data[0].id);
			            $('#razonsocial'+i).val(data[0].razonsocial);
			            $('#cif'+i).val(data[0].cif);

			        }

	        }
    	});

	});


	$(document).on("click", "#matp-seleccionaraccion", function(event){

		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_accion = parentTr.find('td#id').html();
    	var rand = Math.round(Math.random()*10000);

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_accion+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');
	            $('#datosaccion').css('display','block');
	            $('#grupoformativo').val('');
	            $('#bonificable').removeAttr('disabled');
	            if ( $("#bonificable").is(':checked') ) {
	            	$("#bonificable").removeAttr('checked');
	            }
	            $('#id_accion').val(data[0].id);
	            $('#numeroaccion').val(data[0].numeroaccion);
	            $('#denominacion').val(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#modalidad').val(data[0].modalidad);
	            // resetear valores de fechas
	            $('#fechafin').val('');
	            $('#fechaini').val('');
	            // numero aleatorio para los fungibles y otros gastos
	            $('#id_temp').val(rand);

	            var precioventamat = 0;
	            precioventamat = 13*$('#horastotales').val();
	            $('#precioventamat').attr("placeholder",precioventamat+" (max. bonificable)");
	        }
    	});
    });

	$(document).on("click", "a#matp-seleccionardocente", function(event){

		k++;
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var input_docente = '<div class="clearfix"></div><div id="doc'+k+'"><input name="id_docente[]" type="hidden" id="id_docente'+k+'" value=""/><div class="col-md-3"><div class="form-group"><label class="control-label" for="nombred'+k+'">Nombre:</label><input type="text" id="nombred'+k+'" name="nombred'+k+'" class="form-control" readonly/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="fechadocini'+k+'">Fecha Inicio:</label><input type="date" id="fechadocini'+k+'" name="fechadocini'+k+'" class="form-control" /></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="fechadocfin'+k+'">Fecha Fin:</label><input type="date" id="fechadocfin'+k+'" name="fechadocfin'+k+'" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariodoc'+k+'">Horario:</label><input type="text" id="horariodoc'+k+'" name="horariodoc'+k+'" placeholder="08:00 - 10:30 | 15:01 - 17:00" class="form-control" /></div></div><div class="col-md-1"><div class="form-group"><label class="control-label" for="numhorasdoc'+k+'">Nº Horas:</label><input type="text" id="numhorasdoc'+k+'" name="numhorasdoc'+k+'" placeholder="2" class="form-control" /></div></div><div class="col-md-1"><a id="eliminardoc'+k+'" class="eliminard btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';


    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');

            	$('.fin_docente').before(input_docente);
	        	$('#id_docente'+k).val(data[0].id);
	            $('#nombred'+k).val(data[0].nombre+' '+data[0].apellido);
	            $('#apellidod'+k).val(data[0].apellido);
	            $('#documentod'+k).val(data[0].documento);
	            $('body, html').animate({ scrollTop: $("#nombred"+k).offset().top }, 1000);

	        }
    	});
    });


	$(document).on("click", "#matp-seleccionarmat", function(event){

		event.preventDefault();

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&devolvermatpre=1',
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');
	            $('#datosaccion').css('display','block');
	            $('#datostutoria').css('display','block');
	            $('#datosrentabilidad').css('display','block');

				$('.formulariopresencial').get(0).reset();
	            $('#id_matricula').val(data[0].id);
	            $('#id_accion').val(data[0].id_accion);
	            $('#externo').val(data[0].externo);
	            $('.btnmatriculas').css('display','block');
	            $('#numeroaccion').val(data[0].numeroaccion);
	            $('#btndocenteseditar').css('display','inline-block');
	            $('#denominacion').val(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#modalidad').val(data[0].modalidad);
				$('#observacionescuadro').css('display','block');
	            $('#observaciones').css('display','block');
	            $('#presupuesto').val(data[0].presupuesto);
	            $('#presupuestocuadro').css('display','block');
	            $('#presupuestocuadro').css('margin-top','5px');

				// Recuperar el valor del checkbox "AULA VIRTUAL"
				if (data[0].aulavirtual == 1) {
					$('#aulavirtual').prop('checked', true);
				} else {
					$('#aulavirtual').prop('checked', false);
				}
				
	            numempresas = data[1].cuentas;

	            $('#btnempresas').before('<div class="numempresas">Alumnos matriculados: <span class="nemp">'+numempresas+'</span></div>');
	            $('#grupoformativo').val('');

	            var grupo = data[0].ngrupo;
	            $('#tipo_formacion').attr('disabled', true);
	            $('#grupoformativo').val(data[0].numeroaccion+"/"+grupo);
	            if ( grupo.indexOf('p') == -1  ) { // bonificado
	            	$('.fieldbonif').css('display','none');
	            	$('#tipo_formacion').val('Bonificable');
	            } else {
	            	$('.fieldbonif').css('display','block');
	            	$('#tipo_formacion').val('Privado');
	            }

	            var estado = data[0].estado;
	            $('#estado').val(estado);
	            if (estado == 'Creada')
            		$('#xmlfinpre').css('display','none');
            	else
            		$('#xmlfinpre').css('display','inline-block');

	            $('#horariomini').val(data[0].horariomini);
	            $('#horariomfin').val(data[0].horariomfin);
	            $('#horariotini').val(data[0].horariotini);
	            $('#horariotfin').val(data[0].horariotfin);
	            $("input[class^='selector']:checkbox").each(function () {
	            	$(this).prop('checked', false);
	            });

	            var diascheck = data[0].diascheck;
	            $("input[class^='selector']:checkbox").each(function () {
	    			for (var i = 0, len = diascheck.length; i < len; i++) {
						//alert("valor check: "+$(this).val()+" valor array: "+diascheck[i]);
						if ($(this).val() == diascheck[i]) {

							$(this).prop('checked', true);
						}

					}
	            });


		        // if ( estado == 'Facturada' )
		        // 	$('input[name=submit]').css('display', 'none');
		        // else
		        $('input[name=submit]').css('display', 'inline-block');

		        var solicitud = data[0].solicitud;

		        if ( solicitud.indexOf('IK') != -1 ) {
		        	$('#tiposolicitud').val('IKEA');
		        	$('#id_solicitudikea').val(data[0].id_solicitudikea);
		        	$('#formacionikea').css('display','inline-block');
		        } else {
		        	$('#tiposolicitud').val('eduka-te');
		        	$('#id_solicitud').val(data[0].id_solicitud);
		        	$('#id_solicitudikea').val('0');
		        	$('#formacionikea').css('display','none');
		        }

		        $('#solicitud').val(solicitud);
		        $('#grupo_dino').val(data[0].grupo_dino);


		        $('#incidencias').val(data[0].incidencias);
		        $('#observacioneslogistica').val(data[0].observacioneslogistica);


	            numdocentes = data[2].cuentas;
	            $('#btnempresaseditar').css('display','inline-block');
	            $('#btndocenteseditar').css('display','inline-block');

        		$('#tagempresas').html('<div class="numempresas">Empresas inscritas: <span class="nemp">'+numempresas+'</span></div>');
				$('#tagdocentes').html('<div class="numdocentes">Docentes inscritos: <span class="ndoc">'+numdocentes+'</span></div>');

	            $('#datoscentro').css('display','block');
	            $('#id_centro').val(data[3].id);
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[3].localidad+'">'+data[3].localidad+'</option>');
	            $('select#provincia').prop('disabled',false).html('<option value="'+data[3].provincia+'">'+data[3].provincia+'</option>');
	            $('#nombrecentro').val(data[3].nombrecentro);
	            $('#direccioncentro').val(data[3].direccioncentro);
	            $('#codigopostal').val(data[3].codigopostal);

	            var observacionescentro = data[3].observaciones;
	            var observacionesmat = data[0].observaciones;
	            if (observacionesmat != "" || data[0].nuevo == 1) {
	            	// $('#observacionescentro').css('display','block');
	            	$('#observaciones').val(observacionesmat);
	            } else {
	            	$('#observaciones').val(observacionescentro);
	            }

	            var tipo_docente = data[0].tipo_docente;
	            // alert(tipo_docente);
	            if ( tipo_docente !== null && tipo_docente != "" ) {
	            	$('#tipo_docente').val(tipo_docente);
	            	// alert("entra1");
	            }
	            else {
	            	// alert("entra2");
	            	$('#tipo_docente').val("EDUKATE");
	            }

	            $('#justificacion').val(data['rentabilidad'].justificacion);
	            $('#precioventamat').val(data['rentabilidad'].precioventamat);
	            $('#fungibledidac').val(data['rentabilidad'].fungibledidac);
	            $('#costeaula').val(data['rentabilidad'].costeaula);
	            $('#costedocente').val(data['rentabilidad'].costedocente);
	            $('#alumnosestimados').val(data['rentabilidad'].alumnosestimados);
	            $('#totalingresos').val(data['rentabilidad'].totalingresos);
	            $('#totalcostes').val(data['rentabilidad'].totalcostes);
	            $('#administracion').val(data['rentabilidad'].administracion);
	            $('#margenbeneficio').val(data['rentabilidad'].margenbeneficio);
	            $('#porcentajeventas').val(data['rentabilidad'].porcentajeventas);
	            $('#ventasrequerido').val(data['rentabilidad'].ventasrequerido);
	            $('#nalumnosnecesario').val(data['rentabilidad'].nalumnosnecesario);
	            $('#otrosgastos').val(data['rentabilidad'].otrosgastos);



	        }
    	});
    });

    $(document).on("click", "#guardartipofra", function(event){

    	var id_mat = $('#id_matricula').val();

    	$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'tipofra='+$('#tipofra').val()+'&id_mat='+id_mat+'&guardatipofra=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert('Error al guardar');
				else
					alert("Guardado correctamente");

			}
		});

    });

    $(document).on("click", "#matpdoc-seleccionarmat", function(event){

		event.preventDefault();

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&devolvermatpre=1',
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');

	            $('#matricula_fin div').remove();
				$('#matricula_fin_privado div').remove();
	            $('#datosaccion').css('display','block');
	            $('#id_matricula').val(data[0].id);
	            $('#id_accion').val(data[0].id_accion);
	            $('#tipofra').val(data[0].tipofra);


	            if ( gestion == "" ) {
	            	$('#numeroaccion').val(data[0].numeroaccion+"/"+data[0].ngrupo);
	            } else {


		            if ( data[0].solicitud != null && data[0].solicitud.indexOf('IK') != -1 ) {
		            	var ikea = 'IKEA ';
		            	$('#esikea').val('IKEA');
		            	$('#numeroaccion').val(ikea+data[0].numeroaccion+"/"+data[0].ngrupo);
		            } else {
		            	// alert("entra no ikea");
		            	var ikea = '';
		            	$('#esikea').val('');
		            	$('#numeroaccion').val(data[0].numeroaccion+"/"+data[0].ngrupo);
		            	// $('#formacionikea').css('display','none');
		            }

	        	}


	            $('#denominacion').val(data[0].denominacion);
	            // alert(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#modalidad').val(data[0].modalidad);
	            $('#excel').css('display','block');
	            $('#excel_privado').css('display','block');
	            $('#informecuadro').css('display','inline-block');
	            $('input[name=afile]').css('display','inline-block');
				$('input[name=apfile]').css('display','inline-block');
				$('#subirexcel, #subirexcel_privado, #leerexcel, #leerexcel_privado').css('display','inline-block');
				$('#docurellena, #diploma_bonif, #diploma_bonif_atras, #diploma_bonif_atrasp, #diploma_empresa').css('display','inline-block');
				$('#docurellena_privado, #diploma_nobonif, #diploma_nobonif_atrasp, #diploma_empresap').css('display','inline-block');
				$('#btnsubidas').css('display','inline-block');
				// $('#inspec_premix').css('display','block');
				// $('#docublanco').after(alumnoguia);

				var grupo = data[0].ngrupo;

	            if ( data[0].estado == 'Finalizada' || data[0].estado == 'Facturada' ) {
		            $('#alerta-error').modal('show');
		            $('.modal-title').html("Información");
					$('.mensaje-error').html('<span style="font-size: 18px; color: red" class="glyphicon glyphicon-exclamation-sign"></span> Curso ya finalizado.');

					// if ( grupo.indexOf("p") != -1 )
					// 	$('#excel').css('display', 'none');
				}

				if ( grupo.indexOf('p') == -1  ) { // bonificado
	            	$('.fieldbonif').css('display','block');
	            	$('#tipo_formacion').val('Bonificable');
	            } else {
	            	// alert("entra priv");
	            	$('.fieldbonif').css('display','none');
	            	$('#tipo_formacion').val('Privado');
	            }

				if ( grupo.indexOf("p") != -1 ) grupo = grupo.slice(0, -1);
				else grupo = grupo;

				var descexcel = data[0].numeroaccion+"-"+grupo+"doc.xlsx";
				var descexcelfin = data[0].numeroaccion+"-"+grupo+"fin.xlsx";
	            var descexcelp = data[0].numeroaccion+"-"+grupo+"docp.xlsx";
	            var descexcelfinp = data[0].numeroaccion+"-"+grupo+"finp.xlsx";

	            $('#descargar_excel').prop('name', descexcel);
	            $('#descargar_excelfin').prop('name', descexcelfin);
	            $('#descargar_excelp').prop('name', descexcelp);
	            $('#descargar_excelfinp').prop('name', descexcelfinp);

	            // console.log("llega1");
				if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' ) {
					var fechaActual = dameFechaPHP();
					if ( new Date(fechaActual) <= new Date(data[0].fechafin) ) {
			            $('#alerta-error').modal('show');
			            $('.modal-title').html("Información");
						$('.mensaje-error').html('<span style="font-size: 18px; color: red" class="glyphicon glyphicon-exclamation-sign"></span> Cuidado! No puedes finalizar un curso que no se ha celebrado.');
					}
				} else {

					if ( data[0].estado == 'Finalizada' || data[0].estado == 'Facturada' ) {
						$('input[name=afile]').css('display','none');
						$('input[name=apfile]').css('display','none');
						$('#subirexcel, #subirexcel_privado, #leerexcel, #leerexcel_privado').addClass('btn-sm');
						$('#docurellena, #docublanco, #diploma_bonif, #diploma_bonif_atras, #diploma_bonif_atrasp, #diploma_empresa').css('display','inline-block').addClass('btn-sm');
						$('#docurellena_privado, #docublanco_privado, #diploma_nobonif, #diploma_nobonif_atrasp, #diploma_empresap').css('display','inline-block').addClass('btn-sm');
						// $('#diploma_empresa, #diploma_empresap').removeClass('btn-sm');

						if ( data[0].modalidad == 'Mixta' ) {

							$('#diploma_empresa').after(alumnoguia);

						} else { $('#guiadelalumnom').css('display','none'); }

					}
				}

				if ( data[0].modalidad == 'Mixta' && (sec[1] == 'presencial_docm' || sec[1] == 'presencial_docm#') ) {
					var guiaenblanco = '<div style="margin-top: 5px; class="clearfix"></div><a id="guiadelalumnoblancot" mod="online" style="" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-inbox"></span> Guia en Blanco Online</a><a id="guiadelalumnoblancod" mod="distancia" style="margin-left: 5px" class="btn btn-sm btn-success"><span class="glyphicon glyphicon-inbox"></span> Guia en Blanco Distancia</a>';

					$('form#excel').after(guiaenblanco);
					// $('#btnsubidas').after(guiaenblancod);

				}

				// console.log("llega2");
				// $('#ctipofra').css('display','block');
				$('#cobservacionesfin,#cobservacionesfinamanda,#ctipofra,#divaf_factura').css('display','block');
				$('input#af_factura').val(data[0].af_factura);
				$('#observacionesfin').val(data[0].observacionesfin);
				$('#observacionesfinamanda').val(data[0].observacionesfinamanda);

				$('#cincidenciasfinamanda').css('display','block');
				$('#incidenciasfinamanda').val(data[0].incidenciasfinamanda);


				if ( data[0].estado == 'Facturada' ) {

					$('#estado').val('Facturada');
					// $('#alerta-error').modal('show');
			        // $('.modal-title').html("Información");
					// $('.mensaje-error').html('<span style="font-size: 18px; color: red" class="glyphicon glyphicon-exclamation-sign"></span> Curso ya facturado. No se puede modificar nada.');

					$('input[name=afile],input[name=apfile]').css('display','none');
					$('#subirexcel_fin,#subirexcel_fin_privado').css('display','none');
					$('#subirexcel,#leerexcel').css('display','none');
					$('#subirexcel_privado,#leerexcel_privado').css('display','none');
					$('#leerexcel_fin,#leerexcel_fin_privado').css('display','none');

				} else {

					$('#estado').val('');
					$('input[name=afile],input[name=apfile]').css('display','inline-block');
					$('#subirexcel_fin,#subirexcel_fin_privado').css('display','inline-block');
					$('#leerexcel_fin,#leerexcel_fin_privado').css('display','inline-block');

				}


				if ( $('#modalidad').val() == 'Mixta' ) {

						$('#diploma_empresa').before(alumnoguia);
						$('#guiadelalumnom').css('display','inline-block').addClass('btn-sm');

				} else { $('#guiadelalumnom').css('display','none'); }

				// $('input[name=afile],input[name=apfile]').css('display','inline-block');
				// $('#subirexcel_fin,#subirexcel_fin_privado').css('display','inline-block');
				// $('#leerexcel_fin,#leerexcel_fin_privado').css('display','inline-block');



	        }
    	});
    });

    $(document).on("click", "#matm-seleccionarmat", function(event){

		event.preventDefault();

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-mixto.php',
	        data: 'id='+id_matricula+'&devolvermatmix=1',
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');
	            $('#datosaccion').css('display','block');
	            $('#datostutoria').css('display','block');
	            $('#datostutoriaod').css('display','block');
	            $('#datosrentabilidad').css('display','block');
				$('.formulariomixto').get(0).reset();
	            $('#id_matricula').val(data[0].id);
	            $('#id_accion').val(data[0].id_accion);
	            $('#externo').val(data[0].externo);
	            $('.btnmatriculas').css('display','block');
	            $('#numeroaccion').val(data[0].numeroaccion);
	            $('#btndocenteseditarpre').css('display','inline-block');
	            $('#btndocenteseditarod').css('display','inline-block');
	            $('#denominacion').val(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#fechaini_nop').val(data[0].fechaini_nop);
	            $('#fechafin_nop').val(data[0].fechafin_nop);
	            $('#modalidad').val(data[0].modalidad);
	            $('#observacionescuadro').css('display','block');
	            $('#observaciones').css('display','block');
	            $('#observacionesmat').val(data[0].observaciones);
	            $('#observacionesmat').css('display','block');
	            $('#presupuesto').val(data[0].presupuesto);
	            $('#presupuestocuadro').css('display','block');
	            $('#presupuestocuadro').css('margin-top','5px');

	            if ( data[0].comercial != '0' )
	            	$('#comercial').val(data[0].comercial);
	            else
	            	$('#comercial').val(0);

	            var grupo = data[0].ngrupo;
	            $('#tipo_formacion').attr('disabled', true);
	            $('#grupoformativo').val(data[0].numeroaccion+"/"+grupo);
	            if ( grupo.indexOf('p') == -1  ) { // bonificado
	            	$('#tipo_formacion').val('Bonificable');
	            } else {
	            	$('#tipo_formacion').val('Privado');
	            }


	            var estado = data[0].estado;
	            $('#estado').val(estado);
	            if (estado == 'Creada')
            		$('#xmlfinpre').css('display','none');
            	else
            		$('#xmlfinpre').css('display','inline-block');

	            $('#horariomini').val(data[0].horariomini);
	            $('#horariomfin').val(data[0].horariomfin);
	            $('#horariotini').val(data[0].horariotini);
	            $('#horariotfin').val(data[0].horariotfin);

	            $('#horariomini_nop').val(data[0].horariomini_nop);
	            $('#horariomfin_nop').val(data[0].horariomfin_nop);
	            $('#horariotini_nop').val(data[0].horariotini_nop);
	            $('#horariotfin_nop').val(data[0].horariotfin_nop);
	            $('#observacionesmatod').val(data[0].observacionesmatod);

	            $("input[class^='selector']:checkbox").each(function () {
	            	$(this).prop('checked', false);
	            });
	            var diascheck = data[0].diascheck;
	            $("input[class^='selector']:checkbox").each(function () {
	    			for (var i = 0, len = diascheck.length; i < len; i++) {
						//alert("valor check: "+$(this).val()+" valor array: "+diascheck[i]);
						if ($(this).val() == diascheck[i]) {

							$(this).prop('checked', true);
						}

					}
	            });

	            $("input[class^='selectorod']:checkbox").each(function () {
	            	$(this).prop('checked', false);
	            });
	            var diascheckod = data[0].diascheckod;
	            $("input[class^='selectorod']:checkbox").each(function () {
	    			for (var i = 0, len = diascheckod.length; i < len; i++) {
						//alert("valor check: "+$(this).val()+" valor array: "+diascheckod[i]);
						if ($(this).val() == diascheckod[i]) {

							$(this).prop('checked', true);
						}

					}
	            });

	            numempresas = data[1].cuentas;
	            numdocentespre = data[2].cuentas;
	            numdocentesod = data[3].cuentas;
	            $('#btnempresaseditar').css('display','inline-block');
	            $('#btndocenteseditar').css('display','inline-block');
           		$('#tagempresas').html('<div class="numempresas">Empresas inscritas: <span class="nemp">'+numempresas+'</span></div>');
				$('#tagdocentespre').html('<div class="numdocentespre">Docentes inscritos: <span class="ndoc">'+numdocentespre+'</span></div>');
				$('#tagdocentesod').html('<div class="numdocentesod">Docentes inscritos: <span class="ndoc">'+numdocentesod+'</span></div>');

    //     		$('#btnempresaseditar').before('<div class="numempresas">Empresas inscritas: <span class="nemp">'+numempresas+'</span></div>');
				// $('#btndocenteseditarpre').before('<div class="numdocentespre">Docentes inscritos: <span class="ndocpre">'+numdocentespre+'</span></div>');
				// $('#btndocenteseditarod').before('<div class="numdocentesod">Docentes inscritos: <span class="ndocod">'+numdocentesod+'</span></div>');

	            $('#datoscentro').css('display','block');
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[4].localidad+'">'+data[4].localidad+'</option>');
	            $('select#provincia').prop('disabled',false).html('<option value="'+data[4].provincia+'">'+data[4].provincia+'</option>');
	            $('#id_centro').val(data[4].id);
	            $('#nombrecentro').val(data[4].nombrecentro);
	            $('#direccioncentro').val(data[4].direccioncentro);
	            $('#codigopostal').val(data[4].codigopostal);
	            var observaciones = data[4].observaciones;
	            if (observaciones != "") {
	            	$('#observacionescentro').css('display','block');
	            	$('#observaciones').val(observaciones);
	            }


	            var tipo_docente = data[0].tipo_docente;
	            // alert(tipo_docente);
	            if ( tipo_docente !== null && tipo_docente != "" ) {
	            	$('#tipo_docente').val(tipo_docente);
	            	// alert("entra1");
	            }
	            else {
	            	// alert("entra2");
	            	$('#tipo_docente').val("EDUKATE");
	            }

	            $('#precioventamat').val(data['rentabilidad'].precioventamat);
		        $('#fungibledidac').val(data['rentabilidad'].fungibledidac);
		        $('#costeaula').val(data['rentabilidad'].costeaula);
		        $('#costedocente').val(data['rentabilidad'].costedocente);
		        $('#alumnosestimados').val(data['rentabilidad'].alumnosestimados);
		        $('#totalingresos').val(data['rentabilidad'].totalingresos);
		        $('#totalcostes').val(data['rentabilidad'].totalcostes);
		        $('#administracion').val(data['rentabilidad'].administracion);
		        $('#margenbeneficio').val(data['rentabilidad'].margenbeneficio);
		        $('#porcentajeventas').val(data['rentabilidad'].porcentajeventas);
		        $('#otrosgastos').val(data['rentabilidad'].otrosgastos);
		        $('#presupuesto').val(data[0].presupuesto);

		        // if ( estado == 'Facturada' )
		        // 	$('input[name=submit]').css('display', 'none');
		        // else
		        	$('input[name=submit]').css('display', 'inline-block');

		        	var solicitud = data[0].solicitud;

		        if ( solicitud.indexOf('IK') != -1 ) {
		        	$('#tiposolicitud').val('IKEA');
		        	$('#id_solicitudikea').val(data[0].id_solicitudikea);
		        	$('#formacionikea').css('display','inline-block');
		        } else {
		        	$('#tiposolicitud').val('eduka-te');
		        	$('#id_solicitud').val(data[0].id_solicitud);
		        	$('#id_solicitudikea').val('0');
		        	$('#formacionikea').css('display','none');
		        }


		        $('#solicitud').val(solicitud);
		        $('#grupo_dino').val(data[0].grupo_dino);
		        $('#incidencias').val(data[0].incidencias);



	        }
    	});
    });


	$(document).on("keyup", "#acuerdo", function(event) {

		this.value = this.value.replace(/[^0-9\.]/g,'');

	});

    $(document).on("click", "#btnempresaseditar", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').modal('show');
    	$('.modal-dialog').css('width','900px');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&verempresaspre=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de empresas inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });


    $(document).on("click", "#borrarEmpresaIK", function(event) {

		event.preventDefault();
    	var idsol = $(this).attr('idsol');
    	var idemp = $(this).attr('idemp');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'idsol='+idsol+'&idemp='+idemp+'&borrarempresaik=1',
	        success: function(data)
	        {
	        	if ( data.indexOf('error') != -1 )
	        		alert("ERROR");
	        	else {
	        		$(parentTr).remove();
	        		alert("Empresa borrada");
	        	}
	        }
	    });

    });

    $(document).on("click", "#btnempresaseditar-ik", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id').val();

    	$('#mostrardatos').modal('show');
    	$('.modal-dialog').css('width','900px');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&verempresaspre=2',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de empresas inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });

    $(document).on("click", "#btndocenteseditar", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').modal('show');
    	$('.modal-dialog').css('width','900px');
    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&verdocentespre=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de docentes inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });

    $(document).on("click", "#btndocenteseditarpre", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();
    	var tipo = $(this).attr('name');

    	$('#mostrardatos').modal('show');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&tipo='+tipo+'&verdocentesmix=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de docentes inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });

    $(document).on("click", "#btndocenteseditarod", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();
    	var tipo = $(this).attr('name');

    	$('#mostrardatos').modal('show');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-presenciales.php',
	        data: 'id='+id_matricula+'&tipo='+tipo+'&verdocentesmix=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de docentes inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });

    var idalu;
    $(document).on("click", "#matpreborraralumnomat", function(event) {

		event.preventDefault();

    	var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	idalu = parentTr.find('td#id').html();

    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');

		$('#aceptacambios').on('click', function(event){

			$('#confirmar').modal('hide');

			// alert(idalu);

			$.ajax({
		        cache: false,
		        type: 'POST',
		        url: 'functions/funciones-presenciales.php',
		        data: 'id_alumno='+idalu+'&id_matricula='+id_matricula+'&eliminaralumnopre=1',
		        success: function(result){

		        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');
			       	else {
			       		alert(result);
			       		$(parentTr).remove();
			       		$('#mostrardatos').modal('hide');
			       		// numalumnos--;
			       		// $('.nemp').html(numalumnos);
			       		$('#confirmacion').html("Alumno eliminado correctamente de la matrícula");
			       		$('#confirmacion').show(500).delay(2000).hide('slow');
			       		// setTimeout(function(){location.reload();},2200);
			       	}
			    },
			    error:function(){
			        alert("failure");
			    }
    		});

		});

	});


	$(document).on("click", "#guardaraf_factura", function(event) {

		// alert("guarda");
		var id_matricula = $('#id_matricula').val();
		var af_factura = $('#af_factura').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'forms/procesar_forms.php',
			data: 'id='+id_matricula+'&af_factura='+af_factura+'&tabla=matriculas',
			success: function(data)
			{

				if ( data.indexOf("error") != -1 )
					alert("Error al guardar");
				else
					alert("AF guardada.");
			}
		});

	});

	$(document).on("click", "#guardarobservacionesfin", function(event) {

		// alert("guarda");
		var id_matricula = $('#id_matricula').val();
		var observacionesfin = $('#observacionesfin').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-presenciales.php',
			data: 'idmat='+id_matricula+'&observacionesfin='+observacionesfin+'&guardarobservacionesfin=1',
			success: function(data)
			{

				if ( data.indexOf("error") != -1 )
					alert("Error al guardar");
				else
					alert("Observaciones guardadas.");
			}
		});

	});

	$(document).on("click", "#guardarobservacionesfinamanda", function(event) {

		// alert("guarda");
		var id_matricula = $('#id_matricula').val();
		var observacionesfin = $('#observacionesfinamanda').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-presenciales.php',
			data: 'idmat='+id_matricula+'&observacionesfin='+observacionesfin+'&guardarobservacionesfinamanda=1',
			success: function(data)
			{

				if ( data.indexOf("error") != -1 )
					alert("Error al guardar");
				else
					alert("Observaciones guardadas.");
			}
		});

	});

	$(document).on("click", "#guardarincidenciasfinamanda", function(event) {

		// alert("guarda");
		var id_matricula = $('#id_matricula').val();
		var incidenciasfin = $('#incidenciasfinamanda').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-presenciales.php',
			data: 'idmat='+id_matricula+'&incidenciasfin='+incidenciasfin+'&guardarincidenciasfinamanda=1',
			success: function(data)
			{

				if ( data.indexOf("error") != -1 )
					alert("Error al guardar");
				else
					alert("Incidencias guardadas.");
			}
		});

	});

    $(document).on("click", "#matpborraralumnomat", function(event) {

		event.preventDefault();
    	var id = $('#id_matricula').val();

    	var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_empresa = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');

		$('#aceptacambios').on('click', function(event){

			$('#confirmar').modal('hide');

		    $.ajax({
		    	cache: false,
		        url: "functions/funciones-presenciales.php",
		        type: "post",
		        data: 'id_empresa='+id_empresa+'&id_matricula='+id_matricula+'&eliminardematriculapre=1',
		        success: function(result){
		        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');
			       	else {
			       		// alert(result);
			       		$(parentTr).remove();
			       		$('#mostrardatos').modal('hide');
			       		// numalumnos--;
			       		// $('.nemp').html(numalumnos);
			       		$('#confirmacion').html("Empresa eliminada correctamente de la matrícula");
			       		$('#confirmacion').show(500).delay(2000).hide('slow');
			       		setTimeout(function(){location.reload();},2200);
			       	}
			    },
			    error:function(){
			        alert("failure");
			    }
    		});
		});

    });


    $(document).on("click", "#matoborraralumnomat", function(event) {

		event.preventDefault();
    	var id = $('#id_matricula').val();

    	var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_empresa = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');

		$('#aceptacambios').on('click', function(event){

			$('#confirmar').modal('hide');

		    $.ajax({
		    	cache: false,
		        url: "functions/funciones-presenciales.php",
		        type: "post",
		        data: 'id_empresa='+id_empresa+'&id_matricula='+id_matricula+'&eliminardematriculagrup=1',
		        success: function(result){
		        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');
			       	else {
			       		// alert(result);
			       		$(parentTr).remove();
			       		$('#mostrardatos').modal('hide');
			       		// numalumnos--;
			       		// $('.nemp').html(numalumnos);
			       		$('#confirmacion').html("Empresa eliminada correctamente de la matrícula");
			       		$('#confirmacion').show(500).delay(2000).hide('slow');
			       		setTimeout(function(){location.reload();},2200);
			       	}
			    },
			    error:function(){
			        alert("failure");
			    }
    		});
		});

    });

    $(document).on("click", "#matpborrardocentemat", function(event) {

		event.preventDefault();
    	var id = $('#id_matricula').val();

    	var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');
    	$('#confirmar #otromensaje').html('<strong>ATENCIÓN!</strong> Comprobar recepción de email/s de <strong>ALTA y/o BAJA</strong> laboral (si procede).');

		$('#aceptacambios').on('click', function(event){

			$('#confirmar').modal('hide');
			$('#confirmar #otromensaje').html('');

		    $.ajax({
		    	cache: false,
		        url: "functions/funciones-presenciales.php",
		        type: "post",
		        data: 'id_matricula='+id_matricula+'&id_docente='+id_docente+'&eliminardematriculapre=1',
		        success: function(result){
		        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');
			       	else {
			       		// alert(result);
			       		$(parentTr).remove();
			       		$('#mostrardatos').modal('hide');
			       		// numalumnos--;
			       		// $('.nemp').html(numalumnos);
			       		$('#confirmacion').html("Docente eliminado correctamente da la matrícula");
			       		$('#confirmacion').show(500).delay(2000).hide('slow');
			       		// $('#mostrardatos').modal('show');
			       		// $('#mostrardatos .contenido').html('ATENCIÓN! Comprobar recepción de email ALTA/BAJA laboral (si procede).');
			       		setTimeout(function(){location.reload();},2200);
			       	}
			    },
			    error:function(){
			        alert("failure");
			    }
    		});
		});

    });


    $(document).on("click","#xmliniciopre", function (event) {

		var id_matricula = $('#id_matricula').val();
		window.location = 'export/xml_presencial_inicio.php?id_matricula='+id_matricula;

	});

	$(document).on("click","#xmliniciomixto", function (event) {

		var id_matricula = $('#id_matricula').val();
		window.location = 'export/xml_mixto.php?id_matricula='+id_matricula;

	});



	$(document).on("click","#guardarfechasinc", function (event) {

		// console.log(sec);
		var sec = seccion();

		if ( sec.indexOf('tpc') != -1 ) {
			console.log('tpc');
			var f = new Array();
			var i = 0;
			var values = $('.contenido :input').serializeArray();
			$('#fechasincluir').data('fechasinc', []);
			$('#fechasincluir').data('fechasinc').push(values);
			console.log($('#fechasincluir').data('fechasinc'));

		} else {

			var values = $('.contenido :input').serializeArray();
			$('#datostutoria').data('fechasinc', []);
			$('#datostutoria').data('fechasinc').push(values);

		}


 	});

 	$(document).on("click","#guardarfechasincod", function (event) {

		var values = $('.contenido :input').serializeArray();
 		$('#datostutoria').data('fechasincod', []);
 		$('#datostutoria').data('fechasincod').push(values);
 		// console.log($('#datostutoria').data('fechasinc')[0]);

 	});



	function insertaFechasInc(id) {

		// alert(id);

		if ( $('#datostutoria').data('fechasinc') == undefined && $('#datostutoria').data('fechasincod') == undefined ) {

			$('#confirmacion').show(500).delay(2000).hide('slow');
			setTimeout(function(){location.reload();},2200);

		} else {

			if ( $('#datostutoria').data('fechasinc') != undefined ) {

				var fechasinc = $('#datostutoria').data('fechasinc')[0];

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/insertafechasinc.php',
					data: {'fechasinc':fechasinc, 'idmat': id, 'tipo': 'p' },
					success: function(data)
					{
						$('#confirmacion').show(500).delay(2000).hide('slow');
					    setTimeout(function(){location.reload();},2200);
					}
				});

			}

			if ( $('#datostutoria').data('fechasincod') != undefined ) {

				var fechasincod = $('#datostutoria').data('fechasincod')[0];

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/insertafechasinc.php',
					data: {'fechasincod':fechasincod, 'idmat': id, 'tipo': 'od' },
					success: function(data)
					{
						$('#confirmacion').show(500).delay(2000).hide('slow');
					    setTimeout(function(){location.reload();},2200);
					}
				});

			}

		}
	}

	$('.formulariopresencial').validate({

		submitHandler: function(form) {

			if ( comprobarHorario() === false )
				return false;

			var optionSelected = $('#tipo_formacion').find("option:selected");
	    	var valueSelected  = optionSelected.val();

			if ( valueSelected == '' ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes indicar si la formación es bonificada o privada.");
				return false;
			} else {
				$('#tipo_formacion').attr('disabled',true);
			}

			//if ( $('#margenbeneficio').val() == "" ) {
			//	$('#alerta-error').modal('show');
				//$('.mensaje-error').html("Sección rentabilidad obligatoria.");
				//return false;
				//return true;
			//}

			//if ( ( $('#margenbeneficio').val() != "" ) && ( $('#porcentajeventas').val() < 0 && $('#justificacion').val() == "" ) ) {

			//	$('#alerta-error').modal('show');
			//	$('.mensaje-error').html("La rentabilidad del curso debe ser mayor del 40% o estar justificada.");
				//return false;
			//	return true;

			//}


			$('#confirmar').modal('show');
			$('#confirmar #otromensaje').html('<strong>ATENCIÓN!</strong> Comprobar recepción de email/s de <strong>ALTA y/o BAJA</strong> laboral (si procede).');
			$('.modal-dialog').css('width','700px');


			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				$('#confirmar #otromensaje').html('');
				// var values = {};
				// values = $(form).find("input[type='hidden'], :input:not(:hidden)").serializeArray();
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

				var diascheck = '';
	            $('.selector:checked').each(function(){
	                diascheck +=  $(this).val();
	            });

				values = values +'&diascheck='+diascheck;

				var grupo = $('#grupoformativo').val().split("/");
				values = values + '&ngrupo='+grupo[1];


				var fechas = $('#fechas_excluir').val();
				if ( fechas != "" )
					values = values + '&fechas='+fechas;

		    	// alert(values);
		    	// var fechasinc = { dia: '2014-06-12', horariomfin: '16:00' };

			    $.ajax({
			    	cache: false,
			        url: "functions/funciones-presenciales.php",
			        type: "post",
			        // data: {'valores': values, 'fechasinc': fechasinc},
			        data: values,
			        success: function(result){
			        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			        	if (result == '1')
			        		$('#error').show(500).delay(5000).hide('slow');
			        	else {
			        		// alert(result);
			        		insertaFechasInc(result);
			        		//insertarFungibles(result);
			        		//insertarOtrosGastos(result);
			        		$('#confirmacion').show(500).delay(2000).hide('slow');
			    			setTimeout(function(){location.reload();},2200);
			        	}
			        },
			        error:function(){
			            alert("failure");
			        }
    			});

			});
		},

		rules : {
			fechaini : {
				required : true
			},
			fechafin : {
				required : true
			},
			numeroaccion : {
				required : true
			},
			denominacion : {
				required : true
			},

		},
		messages : {
			fechaini : {
				required : "Introduce la fecha de inicio del curso",
			},
			fechafin : {
				required : "Introduce la fecha de finalización del curso",
			}
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


	$('.formulariomixto').validate({


		submitHandler: function(form) {

			if ( comprobarHorario() === false )
				return false;


			var optionSelected = $('#tipo_formacion').find("option:selected");
	    	var valueSelected  = optionSelected.val();
			if ( valueSelected == '' ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes indicar si la formación es bonificada o privada.");
				return false;
			} else {
				$('#tipo_formacion').attr('disabled',true);
			}


			$('#confirmar').modal('show');
			$('.modal-dialog').css('width','700px');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

				var diascheck = '';
	            $('.selector:checked').each(function(){
	                diascheck +=  $(this).val();
	            });

	            var diascheckod = '';
	            $('.selectorod:checked').each(function(){
	                diascheckod +=  $(this).val();
	            });
	            // alert(diascheckod);

				values = values +'&diascheck='+diascheck+'&diascheckod='+diascheckod;;

				var grupo = $('#grupoformativo').val().split("/");
				values = values + '&ngrupo='+grupo[1];


				var fechas = $('#fechas_excluir').val();
				if ( fechas != "" )
					values = values + '&fechas='+fechas;

				var fechasod = $('#fechas_excluirod').val();
				if ( fechasod != "" )
					values = values + '&fechasod='+fechasod;


		    	// alert(values);
			    $.ajax({
			    	cache: 'false',
			        url: "functions/funciones-mixto.php",
			        type: "post",
			        data: values,
			        success: function(result){
			        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			        	if (result == '1')
			        		$('#error').show(500).delay(5000).hide('slow');
			        	else {

			        		insertaFechasInc(result);
			        		$('#confirmacion').show(500).delay(2000).hide('slow');
			        		// setTimeout(function(){location.reload();},2200);
			        	}
			        },
			        error:function(){
			            alert("failure");
			        }
    			});
			});
		},

		rules : {
			fechaini : {
				required : true
			},
			fechafin : {
				required : true
			},
			numeroaccion : {
				required : true
			},
			denominacion : {
				required : true
			},

		},
		messages : {
			fechaini : {
				required : "Introduce la fecha de inicio del curso",
			},
			fechafin : {
				required : "Introduce la fecha de finalización del curso",
			}
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


});
