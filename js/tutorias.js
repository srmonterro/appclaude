$(document).ready(function() {

	var i = 0;


	$(document).on("change","#finalizado", function(event) {

		var id_matricula = $('#id_matricula').val();
		var id_alumno = $('#id_alumno').val();
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-tutorias.php',
			data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&finalizado='+valueSelected+'&cambiaestadofor=1',
			success: function(data)
			{
				$('#confirmacion').html("Estado actualizado.")
				$('#confirmacion').show(500).delay(2500).hide('slow');
				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000)
			}

		}); ajax.abort();

	});


	$(document).on("click","#guardarEmailTutoria", function(event) {

		var email = $('#email').val();
		var id_alumno = $('#id_alumno').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-tutorias.php',
			data: 'email='+email+'&id_alumno='+id_alumno+'&actualizaemailtutoria=1',
			success: function(data)
			{
				if ( data.indexOf("error") != -1 )
					alert("Ocurrió un error");
				else
					alert("Guardado correctamente.");
			}
		}); ajax.abort();

	});


	$(document).on("click","#imprimirListado", function(event) {

		var w = window.open();
		var cabecera = '<h4 style="text-align:center">Seguimiento | Gestión EDUKA-TE | '+dameFecha()+'</h4>';
		var l = cabecera+$('#listado-seguimiento').html();
		w.document.write('<head><meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0"><link href="css/bootstrap.css" rel="stylesheet"><link href="css/edukate.css" rel="stylesheet"><style>@media print { .success { background-color: #dff0d8 !important; } th { font-size: 12px } } </style></head>'+l);


	});

	$(document).on("keydown","#form-seguimiento",function (e){
        if(e.keyCode == 13){//Enter key pressed
            return false;//Trigger search button click event
        }
    });

	$(document).on("keydown","#numero",function (e){
        if(e.keyCode == 13){//Enter key pressed
            return false;//Trigger search button click event
        }
    });

// $(document).on("keydown","#form-seguimiento:not('#buscarempresa')",function (e){
//         if(e.keyCode == 13){//Enter key pressed
//             $('#busqueda-seguimientoc').click();//Trigger search button click event
//         }
// });

$(document).on("click", "#busqueda-seguimiento", function(event) {

	event.preventDefault();
	var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/busqueda-seguimiento.php',
		data: values+'&seg-comercial=0',
		success: function(data)
		{

			$('#listado-seguimiento').html(data);
			$('#imprimirListado').css('display','inline-block');

		}

	}); ajax.abort();

});


$(document).on("click", "a[id^=imprimirSeguimiento]", function(event) {

	var id_matricula = $('#id_matricula').val();
	var id_alumno = $('#id_alumno').val();
	var btn = $(this).attr('id');
	var alu = '';
	if ( btn.indexOf("G") == -1 )
		var alu = '&id_alumno='+id_alumno;

	// alert(id_alumno);
	//alert(btn);
	//cgutierrez
	//Para que no redireccion al sacar un seguimiento de Control de Facrturación de Clientes
	if (btn !="imprimirSeguimientoc") {
		window.open('http://gestion.eduka-te.com/app/functions/imprimirSeguimiento.php?id_matricula='+id_matricula+alu,'_blank');
	}
});

// $(document).on("click", "#imprimirSeguimiento", function(event) {

// 	var id_matricula = $('#id_matricula').val();
// 	var id_alumno = $('#id_alumno').val();
// 	// alert(id_alumno);
// 	window.open('http://gestion.eduka-te.com/app/functions/imprimirSeguimiento.php?id_matricula='+id_matricula+'&id_alumno='+id_alumno,'_blank');

// });

$(document).on("click", "#matt-seleccionarmat", function(event) {

	event.preventDefault();

	var tabla = $(this).attr('name');
	var button = $(this);
	var parentTd = button.parent('td');
	var parentTr = parentTd.parent('tr');
	var id_matricula = parentTr.find('td#id').html();
	var id_alu = $(this).attr('id_alu');

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: 'id_mat='+id_matricula+'&devolvermatt=1'+'&id_alu='+id_alu,
		dataType: 'json',
		success: function(data)
		{
			$('#mostrardatos').modal('hide');
			$('.seguimiento').css('display','block');
			$('#datostutoria').css('display','block');
			$('.formulariotutoria').get(0).reset();
			$('#id_matricula').val(data[0].id_matricula);
			$('#id_accion').val(data[0].id_accion);
			$('#id_alumno').val(data[0].id_alumno);
			$('#finalizado').val(data[0].finalizado);

			if ( data[0].tipo != "Privado" ) {
				$('#tipo').val('bonificado');
				if ( $('#finalizado option[value="1"]').val() === undefined ) {
					$('#finalizado option[value="3"]').before('<option value="1">Finalizado - Bonificado</option>');
				}
			} else {
				$('#tipo').val('');
				$('select#finalizado option[value="1"]').remove();
				if ( data[0].finalizado == 1 ) {
					$('#finalizado').val(3);
				}
			}

			$('#numeroaccion').val(data[0].numeroaccion+"/"+data[0].ngrupo);
			$('#denominacion').val(data[0].denominacion);

			var horariomini = data[0].horariomini;
			var horariomfin = data[0].horariomfin;
			var horariotini = data[0].horariotini;
			var horariotfin = data[0].horariotfin;
			var horario = '';

			if ( horariomini !== "" )
				horario = horariomini+' - '+horariomfin;
			if ( horariomini !== "" && horariotini !== "" )
				horario += ' | ';
			if ( horariotini != "" )
				horario += horariotini+' - '+horariotfin;

			$('#horario').val(horario);

			$('#horastotales').val(data[0].horastotales);

			if ( data[0].modalidad == 'Mixta' ) {
				$('#fechaini').val(data[0].fechaini_nop);
				$('#fechafin').val(data[0].fechafin_nop);
			} else {
				$('#fechaini').val(data[0].fechaini);
				$('#fechafin').val(data[0].fechafin);
			}

			$('#telefono1').val(data[0].telefono);
			$('#telefono2').val(data[0].tlftrabajo);
			$('#email').val(data[0].email);
			$('#alumno').val(data[0].nombre+' '+data[0].apellido+' '+data[0].apellido2);




			var progreso = data[0].progreso;
	            // alert(progreso);
	            $('#progreso').val(progreso);
	            var antiprogre = 100-progreso;

	            $('div#progresobar.progress-bar.progress-bar-success').css('width', progreso+'%');
	            $('div#progresobar.progress-bar.progress-bar-danger').css('width', antiprogre+'%');

	            var progreso2 = data[0].progreso2;
				// alert(progreso2);
				$('#progreso2').val(progreso2);
				var antiprogre2 = 100-progreso2;

				$('div#progresobar2.progress-bar.progress-bar-success').css('width', progreso2+'%');
				$('div#progresobar2.progress-bar.progress-bar-danger').css('width', antiprogre2+'%');


				var dedicacion = data[0].dedicacion;
				// console.log(dedicacion);
				// if ( dedicacion == "" )
				// 	$('#dedicacion').val(0);
				// else
				$('#dedicacion').val(dedicacion);

				var antidedicacion = 100-dedicacion;

				$('div#dedicacionbar.progress-bar.progress-bar-success').css('width', dedicacion+'%');
				$('div#dedicacionbar.progress-bar.progress-bar-danger').css('width', antidedicacion+'%');

				cargarContactos();


			}
		}); ajax.abort();

});

$(document).on("click", "#tutorias_contactos", function(event) {

	event.preventDefault();
	//POP UP PARA AÑADIR CONTACTO.

	$('#mostrardatos a#guardarcontactotutotodos').remove();

	var id_alumno = $('#id_alumno').val();
	var id_matricula = $('#id_matricula').val();

	$('#mostrardatos').modal('show');
	$('.modal-dialog').css('width','700px');
	$('.mostrartitulo').html("Añadir un contacto");
	$('.contenido').html("Cargando...");


	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&devuelvenumcontacto=1',
		success: function(data)
		{

			var i = data;

			var input_contacto = '<div id="contactostutoria" class="contactot" style="overflow: auto; margin-bottom: 20px; margin-top: 15px;"><div class="col-md-3"><div class="form-group"><label class="control-label" for="numcontacto">Nº Contacto:</label><input type="text" id="numcontacto" name="numcontacto" class="form-control" readonly/></div></div><div class="col-md-5"><div class="form-group"><label class="control-label" for="fechacontacto">Fecha:</label><input type="text" id="fechacontacto" name="fechacontacto" class="form-control"/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="tipocontacto">Contacto:</label><select name="tipocontacto" id="tipocontacto" class="form-control"><option value="correopla">Correo (plataforma)</option><option value="correoper">Correo (personal)</option><option value="telefono">Teléfono</option><option value="sms">SMS</option><option value="seguimiento">Seguimiento</option><option value="foro">Foro</option><option value="whatsapp">WhatsApp</option></select></div></div><div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><div class="form-group"><label class="control-label" for="contenido">Contenido Tutorización:</label><textarea rows="3" class="form-control" id="contenido" name="contenido"></textarea></div></div><div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><div class="form-group"><label class="control-label" for="respuesta">Respuesta:</label><textarea rows="3" class="form-control" id="respuesta" name="respuesta"></textarea></div></div></div>';
			var input_guardar = '<a id="guardarcontactotutotodos" class="btn btn-danger">Guardar todos</a>';
			$('.contenido').html(input_contacto);

			$("#mostrardatos #numcontacto").val(i);
			var dNow = new Date();
			var dia = dNow.getDate();
			var mes = dNow.getMonth()+ 1;
			var hora = dNow.getHours();
			var min = dNow.getMinutes();
			dia = checkTime(dia);
			mes = checkTime(mes);
			hora = checkTime(hora);
			min = checkTime(min);
			var utcdate = dia + '/' + mes + '/' + dNow.getFullYear() + ' ' + hora + ':'+ min;

			$('#mostrardatos #fechacontacto').val(utcdate);
			$('#guardarcambios').css('display','inline-block');
			$('#guardarcambios').attr('id','guardarcontactotuto');
			$('#guardarcontactotuto').before(input_guardar);
			//$('#mostrardatos .modal-footer').prepend(input_guardar);

		}

	}); ajax.abort();

});



$(document).on("click", "#actcontactotuto", function(event) {

	event.preventDefault();

	var id_alumno = $('#id_alumno').val();
	var id_matricula = $('#id_matricula').val();
	var numcontacto = $(this).attr('name');
	var values = $('#contactostutoria'+numcontacto).find("input[type='hidden'], :input:not(:hidden)").serialize();
	var id = $('#id_contacto'+numcontacto).val();

	values = values + '&id_alumno='+id_alumno;
	values = values + '&id_matricula='+id_matricula;
	values = values + '&id='+id;

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: values + '&actcontactost=1',
		success: function(data)
		{

			if (data != 'error') {
				$('#confirmacion').html("Contacto guardado.")
				$('#confirmacion').show(500).delay(2000).hide('slow');
				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			}
			else
				alert("Error");

		}
	}); ajax.abort();

});



$(document).on("click", "#guardarcontactotuto", function(event) {

	event.preventDefault();

	var id_alumno = $('#id_alumno').val();
	var id_matricula = $('#id_matricula').val();
	var values = $('#mostrardatos #contactostutoria').find(":input:not(:hidden)").serialize();
	values = values + '&id_alumno='+id_alumno;
	values = values + '&id_matricula='+id_matricula;

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: values + '&guardarcontactot=1',
		success: function(data)
		{

			if (data != 'error') {
				$('#mostrardatos').modal('hide');
				$('#confirmacion').html("Contacto guardado.")
				$('#confirmacion').show(500).delay(2000).hide('slow');
				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				cargarContactos();
			}
			else
				alert("Error");

		}
	}); ajax.abort();

});


$(document).on("click", "#guardarcontactotutotodos", function(event) {

	event.preventDefault();

	// alert("guarda todos");

	var id_alumno = $('#id_alumno').val();
	var id_matricula = $('#id_matricula').val();
	var values = $('#mostrardatos #contactostutoria').find(":input:not(:hidden)").serialize();
	// values = values + '&id_alumno='+id_alumno;
	values = values + '&id_matricula='+id_matricula;

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: values + '&guardarcontactotodos=1',
		success: function(data)
		{

			if (data != 'error') {
				$('#mostrardatos').modal('hide');
				$('#confirmacion').html("Contacto guardado.");
				$('#confirmacion').show(500).delay(2000).hide('slow');
				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				cargarContactos();
			}
			else
				alert("Error");

		}
	}); ajax.abort();

});



function cargarContactos() {

	var id_matricula = $('#id_matricula').val();
	var id_alumno = $('#id_alumno').val();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&cargarcontactost=1',
		success: function(data)
		{

			$('#fin_tutoria').html(data);

		}
	}); ajax.abort();

}

$(document).on("click", "#cargar_contactos", function(event) {

	event.preventDefault();
	var id_matricula = $('#id_matricula').val();
	var id_alumno = $('#id_alumno').val();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&cargarcontactost=1',
		success: function(data)
		{

			$('#fin_tutoria').html(data);

		}
	}); ajax.abort();

});

// function recarga_progreso() {
// 	var id_matricula = $('#id_matricula').val();
// 	var id_alumno = $('#id_alumno').val();
// 	var progre = $('#progreso').val();
// 	var antiprogre = 100-progre;
// 	$('div#progresobar.progress-bar.progress-bar-success').css('width', progre+'%');
// 	$('div#progresobar.progress-bar.progress-bar-danger').css('width', antiprogre+'%');

// 	$.ajax({
// 		cache: false,
// 		type: 'POST',
// 		url: 'functions/funciones-tutorias.php',
// 		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&progreso='+progre+'&actualizaprogre=1',
// 		success: function(data)
// 		{

// 			if (data != 'error') {
// 				$('#confirmacion').show(500).delay(3000).hide('slow');
// 				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
// 			}
// 			else
// 				alert("Error");

// 		}
// 	}); ajax.abort();

// }


$('#recarga_progreso2').on('click', function(event) {

	event.preventDefault();

	var id_matricula = $('#id_matricula').val();
	var id_alumno = $('#id_alumno').val();
	var progre = $('#progreso2').val();
	var antiprogre = 100-progre;
	$('div#progresobar2.progress-bar.progress-bar-success').css('width', progre+'%');
	$('div#progresobar2.progress-bar.progress-bar-danger').css('width', antiprogre+'%');

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones-tutorias.php',
		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&progreso='+progre+'&actualizaprogre=2',
		success: function(data)
		{

			if (data != 'error') {
				$('#confirmacion').show(500).delay(3000).hide('slow');
				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			}
			else
				alert("Error");

		}
	}); ajax.abort();

});


$('#recarga_progreso').on('click', function(event) {

	event.preventDefault();

		// if(event.keyCode == 13){
		// 	alert("viene por enter");
		// }
		var id_matricula = $('#id_matricula').val();
		var id_alumno = $('#id_alumno').val();
		var progre = $('#progreso').val();
		var antiprogre = 100-progre;
		$('div#progresobar.progress-bar.progress-bar-success').css('width', progre+'%');
		$('div#progresobar.progress-bar.progress-bar-danger').css('width', antiprogre+'%');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-tutorias.php',
			data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&progreso='+progre+'&actualizaprogre=1',
			success: function(data)
			{

				if (data != 'error') {
					$('#confirmacion').show(500).delay(3000).hide('slow');
					$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				}
				else
					alert("Error");

			}
		}); ajax.abort();

	});

$('#recarga_dedicacion').on('click', function(event) {

	event.preventDefault();

		// if(event.keyCode == 13){
		// 	alert("viene por enter");
		// }
		var id_matricula = $('#id_matricula').val();
		var id_alumno = $('#id_alumno').val();
		var dedicacion = $('#dedicacion').val();
		var antidedicacion = 100-dedicacion;
		$('div#dedicacionbar.progress-bar.progress-bar-success').css('width', dedicacion+'%');
		$('div#dedicacionbar.progress-bar.progress-bar-danger').css('width', antidedicacion+'%');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-tutorias.php',
			data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&dedicacion='+dedicacion+'&actualizadedicacion=1',
			success: function(data)
			{

				if (data != 'error') {
					$('#confirmacion').show(500).delay(3000).hide('slow');
					$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				}
				else
					alert("Error");

			}
		}); ajax.abort();

	});



$('input#progreso').keyup(function(event) {

		// alert(event.keyCode);
		if(event.keyCode == 13){
			// alert("progreso1");
			// $('#recarga_progreso').click();
			return false;

		}
	});

$('input#progreso2').keyup(function(event) {
		// alert("progreso2");

		// alert(event.keyCode);
		if(event.keyCode == 13){
			// alert("progreso2");
			$('#recarga_progreso2').click();
			return false;
		}
	});

$('input#dedicacion').keyup(function(event) {
		// alert("dedicacion");

		// alert(event.keyCode);
		if(event.keyCode == 13){
			// alert("dedicacion");
			$('#recarga_dedicacion').click();
			return false;
		}
	});

});
// $("#progreso").keypress(function(event){
// 	alert("progreso1");
//     if(event.keyCode == 13){
//         $("#recarga_progreso").click();
//     }
// });

// $("#progreso2").keypress(function(event){

// 	alert("progreso2");
//     if(event.keyCode == 13){
//         $("#recarga_progreso2").click();
//     }
// });



// $(document).on("click", "#recarga_progreso2", function(event) {

// 	event.preventDefault();

// 	var id_matricula = $('#id_matricula').val();
// 	var id_alumno = $('#id_alumno').val();
// 	var progre = $('#progreso2').val();
// 	var antiprogre = 100-progre;
// 	$('div#progresobar2.progress-bar.progress-bar-success').css('width', progre+'%');
// 	$('div#progresobar2.progress-bar.progress-bar-danger').css('width', antiprogre+'%');

// 	$.ajax({
// 		cache: false,
// 		type: 'POST',
// 		url: 'functions/funciones-tutorias.php',
// 		data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&progreso='+progre+'&actualizaprogre=2',
// 		success: function(data)
// 		{

// 			if (data != 'error') {
// 				$('#confirmacion').show(500).delay(3000).hide('slow');
// 				$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
// 			}
// 			else
// 				alert("Error");

// 		}
// 	}); ajax.abort();

// });