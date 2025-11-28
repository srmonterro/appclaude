
	function nl2br(str, is_xhtml) {

	  var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

	  return (str + '')
	    .replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
	}


	$(document).ready(function() {


	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;


	var sec = $(location).attr('href').split("?");

	$(document).on("click","#exportar_users", function (event) {

		// alert($('input#tablausers').val());
		document.getElementById("form_users").submit(tablausers);

	});

	$(document).on("click","#xmlinicio_o", function (event) {

		var id_matricula = $('#id_matricula').val();

		if ( $('#modalidad').val() == 'Teleformación' )
			window.location = 'export/xml_online.php?id_matricula='+id_matricula;
		else
			window.location = 'export/xml_distancia.php?id_matricula='+id_matricula;

	});

	$(document).on("click","#xmlfin_grupo", function (event) {

		var id_matricula = $('#id_matricula').val();

		window.location = 'export/xml_finalizacion.php?id_matricula='+id_matricula;

	});

	$(document).on("click", "#guiadelalumnogrupo", function(event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&alumnosguias=1'+'&tipo=bonificado'+'&modalidad=o',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','1000px');
				$('.mostrartitulo').html("Guía Del Alumno");
				$('#mostrardatos .contenido').html(data);
			}
		}); ajax.abort();


	});

	$(document).on("click", "a[id^='diplomasalumnogrupo']", function(event) {

		var id_matricula = $('#id_matricula').val();
		var columnas = $('#contentdiv').html();
		var fuente = $('#fuente').val();
		var fuentereal = $('#contentdiv').css('font-size');
		var porcen = $('#first column').css('width');
		var id_accion = $('#id_accion').val();

		if ( $(this).attr('id') == 'diplomasalumnogrupo' )
			var tipo = "bonificado";
		else
			var tipo = "privado";

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&alumnosdiplomas=1'+'&tipo='+tipo+'&modalidad=o'+'&html='+encodeURI(columnas)+'&porcen='+porcen+'&fuente='+fuente+'&fuentereal='+fuentereal+'&id_accion='+id_accion,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','1000px');
				$('.mostrartitulo').html("Diplomas");
				$('#mostrardatos .contenido').html(data);

				// if ( data["envio"]["envio"] == 0 )
				// 	data["envio"]["fechaenvio"] = "-";
				// if ( data["recepcion"] == 0 )
				// 	data["fecharecepcion"] = "-";

			}
		}); ajax.abort();


	});

	$(document).on("click", "#verdiplomagrupo", function(event) {

		var id_matricula = $('#id_matricula').val();
		var tipo = $(this).attr('tipo');
		var id_alu = $(this).attr('name');

		window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_grupal2.php?id_matricula='+id_matricula+'&tipo='+tipo+'&id_alumno='+id_alu, '_blank');

		// $.ajax({
		// 	cache: false,
		// 	type: 'POST',
		// 	url: 'functions/funciones.php',
		// 	data: 'id_matricula='+id_matricula+'=1'+'&tipo=bonificado'+'&modalidad=o',
		// 	success: function(data)
		// 	{
		// 		$('#mostrardatos').modal('show');
		// 		$('.modal-dialog').css('width','1000px');
		// 		$('.mostrartitulo').html("Guía Del Alumno");
		// 		$('#mostrardatos .contenido').html(data);
		// 	}
		// }); ajax.abort();


	});


	// $(document).on("click", "a#anadirAlumnoSystem", function(event) {

	// 	$('a#anadirAlumnoSystem').each( function (index,el) {
	// 		$(el).click();
	// 	});

	// });


	$(document).on("click", "#enviardiplomagrupoemp", function(event) {

		var id_matricula = $('#id_matricula').val();
		var email_emp = $('#diploma_email_emp').val();
		var tipo = $(this).attr('tipo');
		// alert(tipo);
		// var id_alu = $(this).attr('name');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'documentacion/genera_diploma_grupal_envioemp.php',
			data: 'id_matricula='+id_matricula+'&tipo='+tipo+'&email_emp='+email_emp+'&anio='+gestion+'&envioemp=1',
			success: function(data)
			{
				if ( data == "bien" )
					alert("Email Enviado.")
				else
					alert(data);
			}
		});

		// var id_matricula = $('#id_matricula').val();
		// var tipo = $(this).attr('tipo');
		// var id_alu = $(this).attr('name');

		// window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_grupal.php?id_matricula='+id_matricula+'&tipo='+tipo+'&id_alu='+id_alu, '_blank');

	});

	$(document).on("click", "#enviardiplomagrupo", function(event) {

		var id_matricula = $('#id_matricula').val();
		var tipo = $(this).attr('tipo');
		// alert(tipo);
		var id_alu = $(this).attr('name');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'documentacion/generar_diploma_grupal.php',
			data: 'id_matricula='+id_matricula+'&tipo='+tipo+'&anio='+gestion+'&id_alumno='+id_alu+'&envio=1',
			success: function(data)
			{
				if ( data == "bien" )
					alert("Email Enviado.")
				else
					alert(data);
			}
		});

		// var id_matricula = $('#id_matricula').val();
		// var tipo = $(this).attr('tipo');
		// var id_alu = $(this).attr('name');

		// window.open('http://gestion.eduka-te.com/app/documentacion/generar_diploma_grupal.php?id_matricula='+id_matricula+'&tipo='+tipo+'&id_alu='+id_alu, '_blank');

	});

	$(document).on("click", "#justifcerts", function(event) {

		var id_matricula = $('#id_matricula').val();
		// var id_alumno = $(this).attr('name');
		// var nuser = $(this).attr('user');
		// var user = $('#user'+nuser).val();;
		// var pass = $('#pass'+nuser).val();;
		// var tipo = $(this).attr('tipo');

		// if ( sec[1] == 'form_matricula_doc' )
		// 	var mod = 'o';
		// else
		// 	var mod = 'p';

		window.open('http://gestion.eduka-te.com/app/documentacion/justif_certificados.php?id_matricula='+id_matricula+'&tipo=bonificado', '_blank');

	});

	$(document).on("click", "#justifcertsp", function(event) {

		var id_matricula = $('#id_matricula').val();
		// var id_alumno = $(this).attr('name');
		// var nuser = $(this).attr('user');
		// var user = $('#user'+nuser).val();;
		// var pass = $('#pass'+nuser).val();;
		// var tipo = $(this).attr('tipo');

		// if ( sec[1] == 'form_matricula_doc' )
		// 	var mod = 'o';
		// else
		// 	var mod = 'p';

		window.open('http://gestion.eduka-te.com/app/documentacion/justif_certificados.php?id_matricula='+id_matricula+'&tipo=privado', '_blank');

	});

	$(document).on("click", "#guiadidactica", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		window.open('http://gestion.eduka-te.com/app/documentacion/guias/guiadidactica.php?id_matricula='+id_matricula, '_blank');


	});

	$(document).on("click", "#guardauserpass_grupal", function(event) {

		var user = $(this).attr('user');
		var id_alu = $(this).attr('name');
		var tipo = $(this).attr('tipo');
		var id_mat = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-matgrupales.php',
			data: 'id_alu='+id_alu+'&tipo='+tipo+'&id_mat='+id_mat+'&user='+$('#user'+user).val()+'&pass='+$('#pass'+user).val()+'&guardauserpass_grupal=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert("error al guardar");
				else
					alert("User/Pass guardado correctamente.");
			}
		}); ajax.abort();


	});
$(document).on("click", "#guardauserbon_grupal", function(event) {

		var user = $(this).attr('user');
		var id_alu = $(this).attr('name');
		var tipo = $(this).attr('tipo');
		var id_mat = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-matgrupales.php',
			data: 'id_alu='+id_alu+'&tipo='+tipo+'&id_mat='+id_mat+'&user='+$('#user'+user).val()+'&pass='+$('#pass'+user).val()+'&finalizado=1&guardauserbon_grupal=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert("error al guardar");
				else
					alert("Usuario pasado a FINALIZADO BONIFICADO correctamente.");
			}
		}); ajax.abort();


	});

	$(document).on("click", "#guiadelalumnogrupo_privado", function(event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&alumnosguias=1'+'&tipo=privado'+'&modalidad=o',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','1000px');
				$('.mostrartitulo').html("Guía Del Alumno");
				$('#mostrardatos .contenido').html(data);
				// alert($('a[user=7]').attr('user'));
			}
		}); ajax.abort();


	});


	$(document).on("click", "#enviaguiagrupoindv", function(event) {

		// event.preventDefault();
		var id_matricula = $('#id_matricula').val();
		var id_alumno = $(this).attr('name');
		var nuser = $(this).attr('user');
		var user = $('#user'+nuser).val();
		var pass = $('#pass'+nuser).val();
		var tipo = $(this).attr('tipo');


		if ( sec[1] == 'presencial_docm' ) {


			window.open('http://gestion.eduka-te.com/app/documentacion/guias/guiadelalumnomixtoind.php?id_matricula='+id_matricula+'&enviomail=1'+'&id_alumno='+id_alumno+'&user='+user+'&pass='+pass+'&tipo='+tipo+'&mod=p');

		} else {

			$(this).find('span').toggleClass('glyphicon-envelope glyphicon-refresh');
			$(this).find('span').addClass('spin');


			$.ajax({
			    cache: false,
			    type: 'POST',
			    url: 'documentacion/guias/guiadelalumno.php',
			    data: 'id_matricula='+id_matricula+'&enviomail=1'+'&id_alumno='+id_alumno+'&user='+user+'&pass='+pass+'&tipo='+tipo,
			    success: function(data)
			    {
			    	$('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-envelope');
			    	$('.glyphicon-envelope').removeClass('spin');
					// alert(data);
					if ( data == 'Email enviado con éxito.' ) {
						// alert($('#enviaguiagrupoindv').attr('class'));
						$('a[user='+user+']').toggleClass('btn-warning btn-success');

						if ( sec[1] == 'tutorias' )
							alert("Guía del alumno enviada.");
					}

			    }
	    	});

		}

	});


	$(document).on("click", "#enviartodasguias", function(event) {

		// event.preventDefault();
		// alert("hola")

			$("a#enviaguiagrupoindv").each(function() {
				// event.preventDefault();
				$(this).click();
				// setTimeout(function() {  },2000);
			});



	});

	$(document).on("click", "#enviartodosdiplos", function(event) {

		// event.preventDefault();
		// alert("hola");

			$("a#enviardiplomagrupo").each(function() {
				// event.preventDefault();
				$(this).click();
				// setTimeout(function() {  },2000);
			});



	});

	$(document).on("click", "#verdiplomagrupo", function(event) {

		$('#enviartodosdiplos').removeClass('disabled');
		$('#enviardiplomagrupoemp').removeClass('disabled');

		$('a#enviardiplomagrupo').each( function (index,el) {
			$(el).removeClass('disabled');
		});

	});


    $(document).on("click", "#btnempresaseditaro", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();

    	$('#mostrardatos').modal('show');
    	$('.modal-dialog').css('width','900px');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-matgrupales.php',
	        data: 'id='+id_matricula+'&verempresaso=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de empresas inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });

    $(document).on("click", "#btndocenteseditaro", function(event) {

		event.preventDefault();
    	var id_matricula = $('#id_matricula').val();
    	// console.log("aquii");

    	$('#mostrardatos').modal('show');
    	$('.modal-dialog').css('width','900px');

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-matgrupales.php',
	        data: 'id='+id_matricula+'&verdocenteso=1',
	        success: function(data)
	        {
				$('.mostrartitulo').html("Mostrando datos de docentes inscritas");
	            $('.contenido').html(data);
	        }
	    });

    });


	$(document).on("click", "#matodoc-seleccionarmat", function(event) {

		event.preventDefault();

		var tabla = $(this).attr('name');
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_matricula = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-matgrupales.php',
			data: 'id='+id_matricula+'&devolvermatonline=1',
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
				$('#matricula_fin div').remove();
				$('#matricula_fin_privado div').remove();

				$('#datosaccion').css('display','block');
					// $('#excel').remove();
					// $('#excel_privado').remove();
					$('#id_matricula').val(data[0].id);
					$('#id_accion').val(data[0].id_accion);
					$('#numeroaccion').val(data[0].numeroaccion+"/"+data[0].ngrupo);
					$('#denominacion').val(data[0].denominacion);
					$('#horastotales').val(data[0].horastotales);
					$('#fechaini').val(data[0].fechaini);
					$('#fechafin').val(data[0].fechafin);
					$('#modalidad').val(data[0].modalidad);
					$('#excel').css('display','block');
					$('#excel_privado').css('display','block');
					$('#informesss').css('display','inline-block');
					// $('#subirexcel_fin, #subirexcel_fin_privado, #leerexcel_fin, #leerexcel_fin_privado, #btnsubidas').css('display','inline-block');
					$('#guiadelalumnogrupo, #diploma_bonif, #diploma_bonif_atras, #diploma_empresa').css('display','none');
					$('#guiadelalumnogrupo_privado, #diploma_nobonif, #diploma_nobonif_atrasp, #diploma_empresap').css('display','none');
					// $('#btnsubidas').css('display','inline-block');
					// $('#inspec_premix').css('display','block');
					// $('#docublanco').after(alumnoguia);

						var grupo = data[0].ngrupo;
					if ( grupo.indexOf('p') == -1  ) { // bonificado
		            	$('.fieldbonif').css('display','block');
		            } else {
		            	// alert("entra priv");
		            	$('.fieldbonif').css('display','none');
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



					if ( data[0].estado == 'Finalizada' ) {
						$('#alerta-error').modal('show');
						$('.modal-title').html("Información");
						$('.mensaje-error').html('<span style="font-size: 18px; color: red" class="glyphicon glyphicon-exclamation-sign"></span> Curso ya finalizado.');
					}

					var fechaActual = dameFechaPHP();
					if ( sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_fin#' ) {

						if ( new Date(fechaActual) <= new Date(data[0].fechafin) ) {
							$('#alerta-error').modal('show');
							$('.modal-title').html("Información");
							$('.mensaje-error').html('<span style="font-size: 18px; color: red" class="glyphicon glyphicon-exclamation-sign"></span> Cuidado! No puedes finalizar un curso que no se ha celebrado.');
						}

						$('#subirexcel_fin, #subirexcel_fin_privado, #leerexcel_fin, #leerexcel_fin_privado, #btnsubidas').css('display','none');
						$('input[name=afile]').css('display','none');
						$('input[name=apfile]').css('display','none');
						//$('input[name=afile]').css('display','inline-block');
						//$('input[name=apfile]').css('display','inline-block');
					} else {

						// alert("aqui");
						$('#subirexcel_fin, #subirexcel_fin_privado, #leerexcel_fin, #leerexcel_fin_privado, #btnsubidas').css('display','inline-block');
						$('input[name=afile]').css('display','inline-block');
						$('input[name=apfile]').css('display','inline-block');

						if ( data[0].estado == 'Finalizada' || data[0].estado == 'Facturada' || data[0].estado == 'Gratuita' ) {
							// alert("entra");
							$('input[name=afile]').css('display','none');
							$('input[name=apfile]').css('display','none');
							$('#subirexcel, #subirexcel_privado, #leerexcel, #leerexcel_privado').css('display','none');
							$('#docurellena, #diploma_bonif, #diploma_bonif_atras, #diploma_empresa, #btnsubidas').css('display','inline-block');
							$('#docurellena_privado, #diploma_nobonif, #diploma_nobonif_atrasp, #diploma_empresap').css('display','inline-block');
							$('#diploma_empresa, #diploma_empresap').removeClass('btn-sm');
							$('#justifcerts, #justifcertsp').css('display','inline-block');
							// $('#justifcerts, #justifcertsp').addClass('btn-sm');
						}
						// $('#vin').css('display','inline-block');
					}

					var dateString = $('#fechaini').val();
					var myDate = new Date(dateString);

					//add a day to the date
					// var fechaini = myDate.setDate(myDate.getDate() + 1);

					if ( fechaActual > dateString ) {
						$('#subirexcel,#leerexcel,#afile').css('display','inline-block');
						$('#subirexcel_privado,#leerexcel_privado,#apfile').css('display','inline-block');
					} else {
						$('#subirexcel,#leerexcel,#afile').css('display','inline-block');
						$('#subirexcel_privado,#leerexcel_privado,#apfile').css('display','inline-block');
					}

					$('#cobservacionesfin,#cobservacionesfinamanda').css('display','block');
					$('#observacionesfin').val(data[0].observacionesfin);
					$('#observacionesfinamanda').val(data[0].observacionesfinamanda);

					$('#cincidenciasfinamanda').css('display','block');
					$('#incidenciasfinamanda').val(data[0].incidenciasfinamanda);

					$('#ctipofra, #divaf_factura').css('display','inline-block');
					$('#tipofra').val(data[0].tipofra);
					$('input#af_factura').val(data[0].af_factura);
					// $('.contenidotxt').remove();
					// $('.back').html('<div<div class="contenidotxt"><div id="contentdiv"></div></div>');


					$('.back').css('display','block');

					$('.contenidotxt div').html(nl2br(data[0].contenido));
					$('.contenidotxt div').css('font-size', '1em');
					var fuente = 16;
					while( $('.contenidotxt div').height() > $('.contenidotxt').height() ) {

						fuente = parseInt($('.contenidotxt div').css('font-size')) - 1;
						$('.contenidotxt div').css('font-size', fuente + "px" );

					}

					if (fuente == 1) {
						$('.contenidotxt div').css('font-size', "8" + "px" );
						$('.contenidotxt div').columnize({columns: 8});
					}
					else if (fuente == 2) {
						$('.contenidotxt div').css('font-size', "9" + "px" );
						$('.contenidotxt div').columnize({columns: 4});
					}
					else if (fuente == 3) {
						$('.contenidotxt div').css('font-size', "9" + "px" );
						$('.contenidotxt div').columnize({columns: 4});
					}
					else if (fuente == 4) {
						$('.contenidotxt div').css('font-size', "12" + "px" );
						$('.contenidotxt div').columnize({columns: 3});
					}
					else if (fuente == 5) {
						$('.contenidotxt div').css('font-size', "11" + "px" );
						$('.contenidotxt div').columnize({columns: 2});
					}
					else if (fuente == 6) {
						$('.contenidotxt div').css('font-size', "12" + "px" );
						$('.contenidotxt div').columnize({columns: 2});
					}
					else if (fuente == 7) {
						$('.contenidotxt div').css('font-size', "12" + "px" );
						$('.contenidotxt div').columnize({columns: 2});
					}
					else if (fuente == 8) {
						$('.contenidotxt div').css('font-size', "12" + "px" );
						$('.contenidotxt div').columnize({columns: 2});
					}
					else {
						$('.contenidotxt div').css('font-size', fuente + "px" );
					}

					$('#fuente').val(fuente);
					$('.back').css('display','none');

				}
			}); ajax.abort();

	});

	$(document).on("click", "#matoini-seleccionarmat", function(event) {

		event.preventDefault();

		var tabla = $(this).attr('name');
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_matricula = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-matgrupales.php',
			data: 'id='+id_matricula+'&devolvermatonline=1',
			dataType: 'json',
			success: function(data)
			{

				$('#mostrardatos').modal('hide');
	            $('#datosaccion').css('display','block');
	            $('#datostutoria').css('display','block');
				$('.formulariomatriculaini').get(0).reset();
	            $('#id_matricula').val(data[0].id);
	            $('#id_accion').val(data[0].id_accion);
	            $('#externo').val(data[0].externo);
	            $('#datosrentabilidad').css('display','block');
	            // $('.btnmatriculas').css('display','block');
	            $('#numeroaccion').val(data[0].numeroaccion);
	            $('#denominacion').val(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#modalidad').val(data[0].modalidad);
	            $('#observaciones').val(data[0].observaciones);
	            $('#presupuestocuadro').css('display','inline-block');
	            $('#presupuestocuadro').css('margin-top','-20px');
	            $('#presupuesto').val(data[0].presupuesto);

	            var grupo = data[0].ngrupo;
	            $('#tipo_formacion').attr('disabled', true);
	            $('#grupoformativo').val(data[0].numeroaccion+"/"+grupo);
	            if ( grupo.indexOf('p') == -1  ) { // bonificado
	            	$('#tipo_formacion').val('Bonificable');
	            } else {
	            	$('#tipo_formacion').val('Privado');
	            }


	            // if ( data[0].comercial != '0' )
	            // 	$('#comercial').val(data[0].comercial);
	            // else
	            // 	$('#comercial').val(0);
	            // else if ( data[3].comercialempresa != '0' )
	            // 	$('#comercial').val(data[3].comercialempresa);

	            numempresas = data[1].cuentas;


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

	            numdocentes = data[2].cuentas;
	            $('#btnempresaseditaro').css('display','inline-block');
	            $('#btndocenteseditaro').css('display','inline-block');

        		$('#tagempresas').html('<div class="numempresas">Empresas inscritas: <span class="nemp">'+numempresas+'</span></div>');
				$('#tagdocentes').html('<div class="numdocentes">Docentes inscritos: <span class="ndoc">'+numdocentes+'</span></div>');

	            $('#xmlinicio_o').css('display','inline-block');

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
		        $('#justificacion').val(data['rentabilidad'].justificacion);



		        var solicitud = data[0].solicitud;

		        if ( solicitud.indexOf('IK') != -1 ) {
		        	$('#tiposolicitud').val('IKEA');
		        	$('#id_solicitudikea').val(data[0].id_solicitudikea);
		        	$('#formacionikea').css('display','inline-block');
		        } else {
		        	$('#tiposolicitud').val('ESFOCC');
		        	$('#id_solicitud').val(data[0].id_solicitud);
		        	$('#id_solicitudikea').val('0');
		        	$('#formacionikea').css('display','none');
		        }

		        $('#solicitud').val(solicitud);
		        $('#grupo_dino').val(data[0].grupo_dino);

		        var tipo_docente = data[0].tipo_docente;
		        // alert(tipo_docente);
		        if ( tipo_docente != null ) {
		        	$('#tipo_docente').val(tipo_docente);
		        	// alert("entra1");
		        }
		        else {
		        	// alert("entra2");
		        	$('#tipo_docente').val("EDUKATE");
		        }


	        }
    	}); ajax.abort();
    });



	$('.formulariomatriculaini').validate({

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
				//$('#alerta-error').modal('show');
				//$('.mensaje-error').html("Sección rentabilidad obligatoria.");
				//return false;
				//}

				//if ( ( $('#margenbeneficio').val() != "" ) && ( $('#porcentajeventas').val() < 40 && $('#justificacion').val() == "" ) ) {

				//$('#alerta-error').modal('show');
				//$('.mensaje-error').html("La rentabilidad del curso debe ser mayor del 40% o estar justificada.");
				//return false;

				//}

					var fechaini = $('#fechaini').val();
					var fechafin = $('#fechafin').val();
					var id_docente = $('#id_docente1').val();

					$.ajax({
						cache: false,
						type: 'POST',
						url: 'functions/funciones.php',
						data: 'id_docente='+id_docente+'&fechaini='+fechaini+'&fechafin='+fechafin+'&limiteAlu=1',
						success: function(data)
						{
							// alert(data);
							$('#mostrardatos').modal('show');
							$('mostrartitulo').html("Matrículas coincidentes en estas fechas");
							$('.contenido').html(data);
						}
					});


				$('#confirmar').modal('show');
				$('#aceptacambios').on('click', function(event){

					$('#confirmar').modal('hide');

					$('input.marcasemana').attr('disabled', true);
					var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

					var diascheck = '';
		            $('.selector:checked').each(function(){
		                diascheck +=  $(this).val();
		            });

					values = values +'&diascheck='+diascheck;

					var grupo = $('#grupoformativo').val().split("/");
					values = values + '&ngrupo='+grupo[1];

					// var fechas = $('#fechas_excluir').val();
					// if ( fechas != "" )
					// 	values = values + '&fechas='+fechas;

			    	// alert(values);

				    $.ajax({
				    	cache: false,
				        url: "functions/funciones-matgrupales.php",
				        type: "post",
				        data: values,
				        success: function(result){
				        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				        	if (result == '1')
				        		$('#error').show(500).delay(5000).hide('slow');
				        	else {
				        		//insertarFungibles(result);
			        			//insertarOtrosGastos(result);
				        		$('#confirmacion').show(500).delay(2000).hide('slow');
				        		setTimeout(function(){location.reload();},2200);
				        	}
				        },
				        error:function(){
				            alert("failure");
				        }
	    			});	ajax.abort();
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
