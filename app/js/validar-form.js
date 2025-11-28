	var z = 0;

	$(document).on("keyup", "#horariomini,#horariotini,#horariomfin,#horariotfin,#horariomini_nop,#horariotini_nop,#horariomfin_nop,#horariotfin_nop", function(event) {

		this.value = this.value.replace('.',':');

	});

	$(document).on("keyup", "#email,#email_facturas,input[id^=email_envio]", function(event) {

		this.value = this.value.replace(';',',');

	});


	function seccion() {

		var sec = $(location).attr('href').split("?");

		if ( sec[1] !== undefined ) {
			if ( sec[1].substr(0, -1) == '#' ) {
				console.log("tiene #");
				var sec = sec[1].substr(0, sec[1].length - 1);
			}
			else {
				console.log("no tiene #");
				var sec = sec[1];
			}

			console.log(sec);
		} else {
			var sec = 'index';
		}
		return sec;
	}

	function doesFileExist(urlToFile)
	{
		// alert(urlToFile);
		var xhr = new XMLHttpRequest();
		xhr.open('HEAD', urlToFile, false);
		xhr.send();

		if (xhr.status == "404" || xhr.status == "500") {
			return false;
		} else {
			return true;
		}
	}

	function sleep(milliseconds) {
		var start = new Date().getTime();
		for (var i = 0; i < 1e7; i++) {
			if ((new Date().getTime() - start) > milliseconds){
				break;
			}
		}

	}


	function comprobarAnio() {

		var gestion = parseInt($('#aniovigente').val());
		var fechaini = $('#fechaini').val();
		var ano = fechaini.split("-");

		if ( fechaini != "" ) {
			if ( ano[0] != gestion ) {
				alert("La solicitud debe crearse en el año que corresponde");
				return false;
			}
		}
	}

	function comprobarHorario() {

		var gestion = parseInt($('#aniovigente').val());

		var min_initarde = aSegs('08:01');
		var max_finman = aSegs('20:00');

		var fechaini = $('#fechaini').val();
		var ano = fechaini.split("-");

		if ( ano[0] != gestion ) {
			alert("La matrícula debe crearse en el año que corresponde");
			return false;
		}

		if ( $('#fechaini').val() > $('#fechafin').val() ) {
			alert("La fecha de inicio no puede ser mayor que la de fin");
			return false;
		}

		if ( $('#horariotini').val() == "" && $('#horariomini').val() == "" ) {
			alert("Debes rellenar el horario de mañana y/o fin");
			return false;
		}

		if ( $('#horariomfin').val() != "" && $('#horariomini').val() == "" || $('#horariomfin').val() == "" && $('#horariomini').val() != "" ) {
			alert("Debes rellenar el horario de inicio si rellenas el de fin y viceversa.");
			return false;
		}

		if ( $('#horariotfin').val() != "" && $('#horariotini').val() == "" || $('#horariotfin').val() == "" && $('#horariotini').val() != "" ) {
			alert("Debes rellenar el horario de inicio si rellenas el de fin y viceversa.");
			return false;
		}

		if ( aSegs($('#horariotini').val()) < min_initarde ) {
			alert("El horario de inicio de tarde tiene que ser mayor que 15:01");
			return false;
		}

		if ( aSegs($('#horariomfin').val()) > max_finman ) {
			alert("El horario de fin de mañana no puede ser mayor que las 15:00");
			return false;
		}

		if ( aSegs($('#horariotini').val()) >= aSegs($('#horariotfin').val()) ) {
			alert("El horario de fin debe ser mayor al de inicio");
			return false;
		}

		if ( aSegs($('#horariomini').val()) >= aSegs($('#horariomfin').val()) ) {
			alert("El horario de fin debe ser mayor al de inicio");
			return false;
		}


		var sec = $(location).attr('href').split("?");

		if ( sec[1] == 'mixto' ) {

			if ( $('#fechaini_nop').val() > $('#fechafin_nop').val() ) {
				alert("La fecha de inicio no puede ser mayor que la de fin");
				return false;
			}

			if ( $('#horariotini_nop').val() == "" && $('#horariomini_nop').val() == "" ) {
				alert("Debes rellenar el horario de mañana y/o fin");
				return false;
			}

			if ( $('#horariotini_nop').val() == "" && $('#horariomini_nop').val() == "" ) {
				alert("Debes rellenar el horario de mañana y/o fin");
				return false;
			}

			if ( $('#horariomfin_nop').val() != "" && $('#horariomini_nop').val() == "" || $('#horariomfin_nop').val() == "" && $('#horariomini_nop').val() != "" ) {
				alert("Debes rellenar el horario de inicio si rellenas el de fin y viceversa.");
				return false;
			}

			if ( $('#horariotfin_nop').val() != "" && $('#horariotini_nop').val() == "" || $('#horariotfin_nop').val() == "" && $('#horariotini_nop').val() != "" ) {
				alert("Debes rellenar el horario de inicio si rellenas el de fin y viceversa.");
				return false;
			}

			if ( aSegs($('#horariotini_nop').val()) < min_initarde ) {
				alert("El horario de inicio de tarde tiene que ser mayor que 15:01");
				return false;
			}

			if ( aSegs($('#horariomfin_nop').val()) > max_finman ) {
				alert("El horario de fin de mañana no puede ser mayor que las 15:00");
				return false;
			}

			if ( aSegs($('#horariotini_nop').val()) >= aSegs($('#horariotfin_nop').val()) ) {
				alert("El horario de fin debe ser mayor al de inicio");
				return false;
			}

			if ( aSegs($('#horariomini_nop').val()) >= aSegs($('#horariomfin_nop').val()) ) {
				alert("El horario de fin debe ser mayor al de inicio");
				return false;
			}

		}


	}

	function aSegs(t) {
		var bits = t.split(':');
		return bits[0]*3600 + bits[1]*60;
	}

	function multiselect_deselectAll($el) {
		$('option', $el).each(function(element) {
			$el.multiselect('deselect', $(this).val());
		});
	}


	var user = $('#userapp').val();


	function getRow(button) {
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#id').html();
	}

	function getRowNombre(button) {
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#nombre').html();
	}

	function getRowID(button, selector) {
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#'+selector).html();
	}
	function getRowText(button, selector) {
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#'+selector).text();
	}

	function checkTime(fecha) {

		if (fecha<10) { fecha="0" + fecha; }
		return fecha;
	}

	function dameFecha() {

		var dNow = new Date();
		var dia = dNow.getDate();
		var mes = dNow.getMonth()+ 1;
		var hora = dNow.getHours();
		var min = dNow.getMinutes();
		dia = checkTime(dia);
		mes = checkTime(mes);
		hora = checkTime(hora);
		min = checkTime(min);
		//var utcdate = dia + '/' + mes + '/' + dNow.getFullYear() + ' ' + hora + ':'+ min;
		var utcdate = dia + '/' + mes + '/' + dNow.getFullYear();
		return utcdate;
	}

	function dameFechaPHP() {

		var dNow = new Date();
		var dia = dNow.getDate();
		var mes = dNow.getMonth()+ 1;
		var hora = dNow.getHours();
		var min = dNow.getMinutes();
		dia = checkTime(dia);
		mes = checkTime(mes);
		hora = checkTime(hora);
		min = checkTime(min);
		//var utcdate = dia + '/' + mes + '/' + dNow.getFullYear() + ' ' + hora + ':'+ min;
		var utcdate = dNow.getFullYear() + '-' + mes + '-' + dia;
		return utcdate;
	}


	$(document).ready(function() {

	// $.letItSnow('SELECTOR', {
	//   stickyFlakes: 'lis-flake--js',
	//   makeFlakes: true,
	//   sticky: true
	// });

	var sec = seccion();

	// if ( sec.indexOf("")  )
	var user = $('#userapp').val();

	if ( user != "" && user !== undefined ) {

		if (
			( user == 'isabel' || user == 'oscar' || user == 'amparo' || user.indexOf("comercial") != -1 )
			&&
			( sec.indexOf("reportecomercial") == -1 && sec.indexOf("index") == -1 )
		   )
		{

			$.ajax({
				cache: false,
				type: 'POST',
				dataType: 'json',
				url: 'functions/funciones.php',
				data: 'user='+user+'&acceso=1',
				success: function(data)
				{
					console.log(data);
					if ( data['acceso'] != 1 ) {

						alert("ACCESO DENEGADO. CONTACTA CON EL COORDINADOR DE  OPERACIONES.");
						window.location.href = 'http://gestion.eduka-te.com/app/index.php?reportecomercial';

					}
				}
			});
		}
	}

	var sec = $(location).attr('href').split("?");
	var safari = navigator.vendor && navigator.vendor.indexOf('Apple') > -1 &&
	navigator.userAgent && !navigator.userAgent.match('CriOS');

	// alert(safari);
	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;
	// alert(gestion);
	// var fecha = new Date();
	// anio = fecha.getFullYear();


	// $(document).on("change", "select[id^=tipogasto]", function(event){

	// 	event.preventDefault();

	// 	if ( $(this).val() == 'Comercial' ) {
	// 		$('.tipogastocomercial').css('display', 'inline-block');
	// 	} else {
	// 		$('.tipogastocomercial').css('display', 'none');
	// 	}

	// });


	$(document).on("change", ".bloqueprop #observaciones", function(event){

		event.preventDefault();
		$('.bloqueprop #observpropuesta').val(1);

	});

	$(document).on("change", ".bloqueprop #observacionesgestor", function(event){

		event.preventDefault();
		$('.bloqueprop #observgestor').val(1);

	});

	// $(document).on("change", "#observacionesamanda", function(event){

	// 	event.preventDefault();
	// 	$('#observamanda').val(1);

	// });


	$(document).on("click", "#imprimirsn", function(event) {

		var id = $('div.activo #id').val();
		// var numero = $('#numero').val();

		window.open('http://gestion.eduka-te.com/app/documentacion/imprimirSN.php?id='+id, '_blank');


	});


	$(document).on("click", "#rltcif", function(event) {

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'rltcif=1',
			success: function(data) {

				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','500px');
				$('#mostrardatos .mostrartitulo').html("RLT por CIF");
				$('#mostrardatos .contenido').html(data);
			}

		});


	});


	$(document).on("click", "#rltcifgo", function(event) {

		window.open('http://gestion.eduka-te.com/app/documentacion/rltcif.php?cif='+$('#CIF').val()+'&mat='+$('#id_matricula').val(), '_blank');


	});




	$(document).on("click", ".marcasemana", function(event) {

		if ( $('input.marcasemana').prop('checked') ) {
			$('.selector[value=L]').prop('checked', true);
			$('.selector[value=M]').prop('checked', true);
			$('.selector[value=X]').prop('checked', true);
			$('.selector[value=J]').prop('checked', true);
			$('.selector[value=V]').prop('checked', true);
			// $('input.marcasemana').attr('disabled', true);
		} else {
			$('.selector[value=L]').prop('checked', false);
			$('.selector[value=M]').prop('checked', false);
			$('.selector[value=X]').prop('checked', false);
			$('.selector[value=J]').prop('checked', false);
			$('.selector[value=V]').prop('checked', false);
		}

	});


	$(document).on("click", "#buscarsolicitud", function(event){

		event.preventDefault();


		if ( sec[1] == 'propuesta') {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/buscarsolicitud.php',
				data: 'solicitud='+$('#solicitud').val()+'&tiposolicitud=PETICION',
				success: function(data)
				{
					$('#alerta-error').modal('hide');
					$('#confirmar').modal('hide');
					$('#mostrardatos').modal('show');
					$('.modal-dialog').css('width','1000px');
					$('#mostrardatos .mostrartitulo').html("Seleccionar solicitud");
					$('#mostrardatos .contenido').html(data);
				}
			}); ajax.abort();


		} else {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/buscarsolicitud.php',
				data: 'solicitud='+$('#solicitud').val()+'&tiposolicitud='+$('#tiposolicitud').val(),
				success: function(data)
				{
					$('#alerta-error').modal('hide');
					$('#confirmar').modal('hide');
					$('#mostrardatos').modal('show');
					$('.modal-dialog').css('width','1000px');
					$('#mostrardatos .mostrartitulo').html("Seleccionar solicitud");
					$('#mostrardatos .contenido').html(data);
				}
			}); ajax.abort();

		}

	});


	$(document).on("click","#guardar_usuario_nomina", function (event) {

		if ( $('#dni').val() == "" || $('#nombre').val() == "" || $('#tipo').val() == "") {
			alert("Todos los campos son obligatorios.");
			return false;
		}

		var values = $('#crearusernomina').find("input[type='hidden'], :input:not(:hidden)").serialize();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: values+'&guardar_usuario_nomina=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert("Error");
				else if ( data.indexOf('existe') != -1 )
					alert("El usuario ya existe");
				else if ( data.indexOf('not') != -1 )
					alert("No se encuentra el docente en la aplicación.");
				else if ( data.indexOf('nodni') != -1 )
					alert("Introduce un DNI");
				else
					alert("Usuario guardado.");
			}
		}); ajax.abort();


	});


	$(document).on("change","#formapagocred", function (event) {

		if ( $(this).find("option:selected").val() == 'Remesa' ) {
			$('#campoiban').css('display','inline-block');
			$('#campoiban input#iban').attr('required', true);
		}
		else {
			$('#campoiban').css('display','none');
			$('#campoiban input#iban').removeAttr('required');
		}

	});

	// $(document).on("change","#formapagocred", function (event) {



	// });

	$(document).on("change","#personalp", function (event) {

		// alert("sale");
		var dni = $('#personalp').val();

		if ( dni != "" )
			$('#personald').val("");


		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/funciones.php',
			data: 'dni='+dni+'&devuelvenominas=1',
			success: function(data)
			{


				for ( var i = 1; i <= 12; i++ ) {

					$('form').get(i-1).reset();

					if ( data['nominas'][i] == 1 )
						$('#esta'+i+' span').css('color','green');
					else
						$('#esta'+i+' span').css('color','red');

				}


			}
		}); ajax.abort();


	});

	$(document).on("change","#personald", function (event) {

		var dni = $('#personald').val();

		if ( dni != "" )
			$('#personalp').val("");


		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/funciones.php',
			data: 'dni='+dni+'&devuelvenominas=1',
			success: function(data)
			{
				// alert("asda");

				for ( var i = 1; i <= 12; i++ ) {

					$('form').get(i-1).reset();

					if ( data['nominas'][i] == 1 )
						$('#esta'+i+' span').css('color','green');
					else
						$('#esta'+i+' span').css('color','red');

				}


			}
		}); ajax.abort();


	});


	$(document).on("click","#mostrarmatsol", function (event) {

		var tiposol = $(this).attr('numero');
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=matsol'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else
		    		window.open(data);
		    }
		}); ajax.abort();

	});

	$(document).on("click","#subirmatsol", function (event) {

		var formData = new FormData();
		formData.append('file', $('#matriculasol').get(0).files[0]);
		formData.append('numero', $(this).attr('numero'));
		formData.append('tipo', 'matsol');

		if ( $('#matriculasol').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estamat').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estamat').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});

	$(document).on("click","#subirrecibosol", function (event) {

		var formData = new FormData();
		formData.append('file', $('#recibosol').get(0).files[0]);
		formData.append('numero', $(this).attr('numero'));
		formData.append('tipo', 'recibosol');

		if ( $('#recibosol').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estarecibo').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estarecibo').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});

	$(document).on("click","#mostrarrecibosol", function (event) {

		var tiposol = $(this).attr('numero');
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=recibosol'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else
		    		window.open(data);
		    }
		}); ajax.abort();

	});



	$(document).on("change","#metodologianum", function (event) {

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

	    //var presencial = 'Metodología dinámica y participativa, cuyo objetivo es la construcción de un aprendizaje significativo, partiendo de las expectativas y las necesidades formativas del alumno, y orientada a la aplicación de los conocimientos adquiridos en la práctica profesional del alumnado.\nEn el proceso de enseñanza-aprendizaje se combinará el método expositivo con la realización de actividades prácticas y dinámicas que contribuyan a consolidar los conocimientos adquiridos, utilizando los recursos y materiales adecuados para la consecución de los objetivos previstos.El lugar de impartición será a determinar por el cliente.\n\nEl número máximo de alumnos será 25.';

 		//var presenciali = 'La metodología se basa en el enfoque comunicativo, potenciando la expresión oral y escrita de los alumnos.\nEl proceso de enseñanza- aprendizaje se centrara en la capacitación personalizada, proporcionando los contenidos, adecuados a las necesidades particulares del alumnado y el área de negocios donde se desempeña.	Se combinará el método expositivo con la realización de actividades prácticas y dinámicas que contribuyan a consolidar los conocimientos adquiridos, utilizando los recursos y materiales adecuados para la consecución de los objetivos previstos.\n\nEl lugar de impartición será a determinar por el cliente. El número máximo de alumnos será 25.';

   		//var teleformacion = 'La metodología de formación online destaca por su flexibilidad, adaptándose el proceso de enseñanza- aprendizaje totalmente a los intereses, las expectativas, necesidades, ritmos y tiempos del alumnado; y, se orienta a la aplicación de los conocimientos adquiridos en la práctica profesional del alumnado. A través de la plataforma virtual se realizarán las actividades que integran el curso (contenido teórico, casos prácticos y/o ejercicios, realización de evaluaciones).';

   		//var practicos = 'La metodología se centra en los intereses, expectativas y necesidades de formación del alumnado y, está orientada a la adquisición de conocimientos,destrezas y habilidades y su aplicación la práctica profesional del alumnado.\nEn el proceso de enseñanza-aprendizaje se combinará el método expositivo con la realización de actividades prácticas, guiadas y supervisadas por el docente, que contribuyan a consolidar los conocimientos adquiridos, utilizando los recursos y materiales adecuados para la consecución de los objetivos previstos.';

   		var presencial = 'La metodología de la formación presencial es flexible y adaptable  al contexto del aula, adecuando  las sesiones a las necesidades formativas de los participantes.\nEn el proceso de enseñanza-aprendizaje se combinará el método expositivo con la realización de actividades prácticas y dinámicas que contribuyan a la consolidación de los conocimientos.\nEl objetivo es la construcción de un aprendizaje significativo,  para que los nuevos conceptos  conecten con los conocimientos adquiridos con anterioridad, para potenciar su aplicación en la práctica profesional del alumnado.\nEl lugar de impartición será a determinar por el cliente.\nEl número máximo de alumnos será 25.';

   		var presenciali = 'La metodología se apoya en el enfoque comunicativo y dinámico,  potenciando la expresión oral y escrita de los alumnos. La comunicación y el diálogo constituyen la base del aprendizaje y del intercambio.\nEl proceso de enseñanza- aprendizaje se centrara en la capacitación personalizada, proporcionando los contenidos, adecuados a las necesidades particulares del alumnado y el área de negocios donde se desempeña.\nEl lugar de impartición será a determinar por el cliente.\nEl número máximo de alumnos será 25.';

   		var habilidades = 'La metodología utiliza un enfoque centrado en las cualidades personales y profesionales de los alumnos con el fin de propiciar una mayor sensación de control y de competencia personal.\nLas actividades diseñadas implican participación, la mayor parte de las veces en equipo, y en ocasiones en debates de participación directa de todo el grupo.\nSe utilizarán estrategias de dinámica grupal y de role-playing, enfocadas a trabajar cada uno de los contenidos, haciendo de la formación una experiencia integral.\nSe incorporarán técnicas de participación activa, permitiendo al alumno la resolución de las cuestiones y supuestos prácticos.\nEl lugar de impartición será a determinar por el cliente.\nEl número máximo de alumnos será 25.';

   		var teleformacion = 'La metodología de formación online destaca por su flexibilidad, adaptándose el proceso de enseñanza- aprendizaje totalmente a los intereses, necesidades y ritmos  del alumnado.\nLos contenidos interactivos se complementan con ejercicios, casos prácticos, tareas y pruebas de autoevaluación, que facilitan la comprensión y favorecen el aprendizaje.\nPara  el  desarrollo  de  las acciones  formativas  se  cuenta  con  tutores de  reconocida  valía, que  guiaran el alumno durante todo el proceso formativo.\nEl número máximo de alumnos será 80.';

   		var cursosDESA = 'El curso está basado en las recomendaciones vigentes elaboradas por la comunidad científica internacional encabezada por el European Resuscitation Council (ERC) y por la American Heart Association (AHA) y adaptadas a nuestro entorno por el Consejo Español de Resucitación (CERCP).\nEn el proceso de enseñanza-aprendizaje se combinará el método expositivo con la realización de prácticas, guiadas y supervisadas por el docente, que contribuyan a consolidar los conocimientos adquiridos, utilizando los recursos y materiales adecuados para la consecución de los objetivos previstos.\nEl lugar de impartición será a determinar por el cliente.\nEl número máximo de alumnos será 8.';

   		if ( valueSelected == 'Presencial' )
   			$('#metodologia').val(presencial);
   		else if ( valueSelected == 'Presenciali' )
   			$('#metodologia').val(presenciali);
   		else if ( valueSelected == 'Habilidades' )
   			$('#metodologia').val(habilidades);
   		else if ( valueSelected == 'Teleformación' )
   			$('#metodologia').val(teleformacion);
   		else if ( valueSelected == 'DESA' )
   			$('#metodologia').val(cursosDESA);

   	});


	$(document).on("change","#incluyenum", function (event) {

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		var teleformacion = '- Docente.\n- Certificado de aprovechamiento.\n- Gestión telemática en la Fundación Estatal para la Formación en el Empleo si el cliente lo requiere.';

		var bonificado = '- Manual didáctico de acuerdo con las necesidades de los alumnos.\n- Material fungible: portadocumentos o mochila, block de notas, bolígrafo.\n- Docente.\n- Certificado de aprovechamiento.\n- Gestión telemática en la Fundación Estatal para la Formación en el Empleo si el cliente lo requiere.';

		var bonificadoe = '- Manual didáctico de acuerdo con las necesidades de los alumnos.\n- Material fungible: portadocumentos o mochila, block de notas, bolígrafo.\n- Docente.\n- Certificado de aprovechamiento.\n- Reconocimiento ESSSCAN\n- Gestión telemática en la Fundación Estatal para la Formación en el Empleo si el cliente lo requiere.\n\n* La propuesta no incluye el precio del carnet.';

		var privado = '- Manual didáctico de acuerdo con las necesidades de los alumnos.\n- Material fungible: portadocumentos o mochila, block de notas, bolígrafo.\n- Docente.\n- Certificado de aprovechamiento.';


		if ( valueSelected == 'Teleformación' )
			$('#incluye').val(teleformacion);
		else if ( valueSelected == 'Bonificado' )
			$('#incluye').val(bonificado);
		else if ( valueSelected == 'BonificadoE' )
			$('#incluye').val(bonificadoe);
		else
			$('#incluye').val(privado);

	});

	$(document).on("change","#url", function (event) {

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		if ( valueSelected == 'Externa' )
			$('.plataforma_externa').css('display','block');
		else
			$('.plataforma_externa').css('display','none');

	});

	$(document).on("click","#subiranexosol", function (event) {

		// alert("ss");
		var formData = new FormData();
		formData.append('file', $('.bloquemat #anexosol').get(0).files[0]);
		formData.append('numero', $(this).attr('numero'));
		formData.append('tipo', 'anexosol');
		// alert(formData);
		if ( $('.bloquemat #anexosol').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estaanexo').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estaanexo').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});

	$(document).on("click","#subirnotagastos", function (event) {

		if ( $('.bloquenotagastos #notagastos').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$('#mostrardatos').modal('show');
			$('#mostrardatos .mostrartitulo').html('Tickets/Facturas');
			$('.contenido').css('overflow', 'auto').html('<div style="margin: 15px;" class="col-md-10"><div class="form-group"><label class="control-label" for="nombreticket">Nombre Ticket/Factura:</label><input placeholder="Referencia. Ej: ticket aparcamiento" type="text" id="nombreticket" name="nombreticket" class="form-control" /></div></div><div class="col-md-2"><a style="margin-left: 15px;" id="enviarnotagasto" class="boton btn btn-primary"> Guardar </a></div>');
		}

	});

	$(document).on("click","a#enviarnotagasto", function (event) {
		enviarnotagasto($('#nombreticket').val());
	});

	function enviarnotagasto(nombre) {

		var formData = new FormData();
		formData.append('file', $('.bloquenotagastos #notagastos').get(0).files[0]);
		formData.append('numero', $('.bloquenotagastos input#numero').val());
		formData.append('tipo', 'notagastos');
		formData.append('nombre', nombre);

		// console.log(formData);

		$.ajax({
			cache: false,
			url: 'functions/subida_pdf.php',
			type: 'POST',
			data: formData,
			processData: false,
			contentType: false,
			success: function (data) {
				if ( data == 'bien' ) {
					$('span#estanotagasto').css('color','green');
					alert("Fichero subido correctamente.\n\nAcuérdate de ENVIAR SOLICITUD cuando acabes.");
					$('#mostrardatos').modal('hide');
					$('#tickets').val(1);
				}
				else {
					alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estanotagasto').css('color','red');
	               	}
	               }
	           });

	}

	$(document).on("click","#subiranexosol-esf", function (event) {

		if ( $('.bloquecred #anexosol-esf').get(0).files[0].type != "application/pdf" ) {
			alert("El archivo no está en formato PDF!");
			return false;
		}

		// alert($('.bloquecred #anexosol-esf').get(0).files[0].type);
		// console.log($('.bloquecred #anexosol-esf').get(0).files[0]);

		if ( $('.bloquecred #cif').val().length != 9 || $('.bloquecred #cif').val() == "" ) {

			alert("Introduce un CIF correcto.");
			return false;
		}


		var formData = new FormData();
		formData.append('file', $('.bloquecred #anexosol-esf').get(0).files[0]);
		formData.append('numero', $('.bloquecred #cif').val());
		formData.append('tipo', 'anexoenc_esfocc');

		if ( sec[1] == 'peticion-matricula' &&  $('#bloquecred #id').val() != "" ) {
			formData.append('email', '1');
			formData.append('solicitud', $('.bloquecred #numero').val());

		}
		// alert(formData);
		if ( $('.bloquecred #anexosol-esf').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estaanexo-esf').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estaanexo-esf').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});

	$(document).on("click","#subiranexosol-est", function (event) {

		if ( $('.bloquecred #anexosol-est').get(0).files[0].type != "application/pdf" ) {
			alert("El archivo no está en formato PDF!");
			return false;
		}

		if ( $('.bloquecred #cif').val().length != 9 || $('.bloquecred #cif').val() == "" ) {

			alert("Introduce un CIF correcto.");
			return false;
		}

		var formData = new FormData();
		formData.append('file', $('.bloquecred #anexosol-est').get(0).files[0]);
		formData.append('numero', $('.bloquecred #cif').val());
		formData.append('tipo', 'anexoenc_estrateg');

		if ( sec[1] == 'peticion-matricula' &&  $('#bloquecred #id').val() != "" ) {
			formData.append('email', '1');
			formData.append('solicitud', $('.bloquecred #numero').val());

		}

		if ( $('.bloquecred #anexosol-est').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estaanexo-est').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estaanexo-est').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});



	$(document).on("click","#mostraranexosol", function (event) {

		var tiposol = $(this).attr('numero');


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=anexosol'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else {

		    		$('#mostrardatos').modal('show');
		    		$('.contenido').html(data);
		    	}
		    }
		}); ajax.abort();

	});

	$(document).on("click","#mostrarnotagastos", function (event) {

		var tiposol = $('.bloquenotagastos input#numero').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=notagastos'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else {

		    		$('#mostrardatos').modal('show');
		    		$('#mostrardatos .mostrartitulo').html('Tickets/Facturas');
		    		$('.contenido').html(data);
		    	}
		    }
		}); ajax.abort();

	});

	$(document).on("click","#mostraranexosol-esf", function (event) {

		var cif = $('.bloquecred #cif').val();
		// alert(tiposol);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: 'tipo=anexoenc_esfocc'+'&numero='+cif,
			success: function(data)
			{
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);

			}
		}); ajax.abort();

	});


	$(document).on("click","#mostraranexosol-est", function (event) {

		var cif = $('.bloquecred #cif').val();
		// alert(tiposol);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: 'tipo=anexoenc_estrateg'+'&numero='+cif,
			success: function(data)
			{
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);

			}
		}); ajax.abort();

	});

	$(document).on("click","#mostrartablasolb", function (event) {

		var tiposol = $(this).attr('numero');
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=tablasolb'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else
		    		window.open(data);
		    }
		}); ajax.abort();

	});

	$(document).on("click","#mostrartablasolp", function (event) {

		var tiposol = $(this).attr('numero');
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=tablasolp'+'&numero='+tiposol,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay PDF subido.");
		    	else
		    		window.open(data);
		    }
		}); ajax.abort();

	});

	$(document).on("click","#subirtablasolb", function (event) {

		var formData = new FormData();
		formData.append('file', $('#participantesolb').get(0).files[0]);
		formData.append('numero', $(this).attr('numero'));
		formData.append('tipo', 'tablasolb');

		if ( $('#participantesolb').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estatabla').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
	               		// alert(data);
	               		$('span#estatablab').css('color','red');
	               	}
	               }
	           }); ajax.abort();
		}

	});

	$(document).on("click","#subirtablatpc", function(event) {

		event.preventDefault();
		var formData = new FormData();
			// coge el archivo
			formData.append('file', $('#tablatpc').get(0).files[0]);
			formData.append('numero', $('#numcurso').val());
			formData.append('tipo', 'tablatpc');
			var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


			if ( $('#tablatpc').get(0).files[0] == undefined ) {

				alert("Selecciona un archivo.");

			} else if ( $('#numcurso').val() == "" )  {

				alert("Introduce el numero del curso.");

			} else {

				$.ajax({
					cache: false,
					url: 'functions/subida_pdf.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {

						if ( data != 'error' ) {
							alert("Fichero subido correctamente.");
							$('#estatablatpc').css('color','green');
						}
						else
							alert("Error en la subida.");

					}
				}); ajax.abort();
			}

		});

	$(document).on("click","#mostrartablatpc", function (event) {

		var numero = $('#numcurso').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: 'tipo=tablatpc'+'&numero='+numero,
			success: function(data)
			{
			    	// alert(data);
			    	if ( data == 'no' )
			    		alert ("No hay Excel subido.");
			    	else
			    		window.open(data);
			    }
			}); ajax.abort();

	});


	$(document).on("click","#subirtablasolp", function (event) {

		var formData = new FormData();
		formData.append('file', $('#participantesolp').get(0).files[0]);
		formData.append('numero', $(this).attr('numero'));
		formData.append('tipo', 'tablasolp');

		if ( $('#participantesolp').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#estatabla').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
		               		// alert(data);
		               		$('span#estatablap').css('color','red');
		               	}
		               }
		           }); ajax.abort();
		}

	});

	$(document).on("click","[id^=subirpdfnomina]", function (event) {

		var fecha = $(this).attr('fecha');
		var id = $(this).attr('iden');

		if ( $('#personald').val() == "" )
			var dni = $('#personalp').val();
		else
			var dni = $('#personald').val();

		var formData = new FormData();
		formData.append('file', $('#empfile'+id).get(0).files[0]);
		formData.append('fecha', fecha);
		formData.append('dni', dni);
		formData.append('tipo', 'nomina');
        // formData.append('accion', 'subir');

        if ( $('#personald').val() == "" && $('#personalp').val() == "" ) {
        	alert("Selecciona una persona para subir la nómina.");
        	return false;
        }

        if ( $('#empfile'+id).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
        		cache: false,
        		url: 'functions/subida_pdf.php',
        		type: 'POST',
        		data: formData,
        		processData: false,
        		contentType: false,
        		success: function (data) {
        			if ( data == 'bien' ) {
        				$('#esta'+id+' span').css('color','green');
        				alert("Fichero subido correctamente.");
        			}
        			else {
        				alert("Fallo en la subida.");
	               		// alert(data);
	               		$('#esta'+id+' span').css('color','red');
	               	}
	               }
	           }); ajax.abort();
        }

    });



	$(document).on("click","[id^=mostrarpdfnomina]", function (event) {


		var fecha = $(this).attr('fecha');

		if ( sec[1] == 'form_subirnomina' ) {

			if ( $('#personald').val() == "" )
				var dni = $('#personalp').val();
			else
				var dni = $('#personald').val();

		} else
		var dni = $('#dni').val();


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=nomina'+'&dni='+dni+'&fecha='+fecha,
			success: function(data)
			{
		    	// alert(data);
		    	if ( data == 'no' )
		    		alert ("No hay nómina subida.");
		    	else {
					// alert(safari);
					window.open(data);
				}
			}
		}); ajax.abort();

	});


	$(document).on("click","#subirpdfpropuestafirmada", function (event) {

		var formData = new FormData();
		formData.append('file', $('#propuestafirmada').get(0).files[0]);
		formData.append('id_propuesta', $(this).attr('id_propuesta'));
		formData.append('tipo', 'propuestafirmada');

		if ( $('#propuestafirmada').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {
					if ( data == 'bien' ) {
						$('span#propuestafirmada').css('color','green');
						alert("Fichero subido correctamente.");
					}
					else {
						alert("Fallo en la subida.");
    	               		// alert(data);
    	               		$('span#propuestafirmada').css('color','red');
    	               	}
    	               }
    	           }); ajax.abort();
		}

	});

	$(document).on("click","#mostrarpdfpropuestafirmada", function (event) {

		var id_propuesta = $(this).attr('id_propuesta');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/mostrar_pdf.php',
			data: '&tipo=propuestafirmada'+'&id_propuesta='+id_propuesta,
			success: function(data)
			{
    		    	// alert(data);
    		    	if ( data == 'no' )
    		    		alert ("No hay PDF subido.");
    		    	else
    		    		window.open(data);
    		    }
    		}); ajax.abort();

	});


	$(document).on("click", "#seleccionargasto", function(event) {

		event.preventDefault();

		var id = $(this).attr('iden');
		var tabla = $(this).attr('tabla');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id+'&tabla='+tabla+'&mat=1'+'&cierra=1',
			dataType: 'json',
			success: function(data) {

				$('#mostrardatos').modal('hide');
				$('.formulariofungible').get(0).reset();
				$('.formularioalojamiento').get(0).reset();
				$('.formularioviaje').get(0).reset();
				$('div.fungibles').remove();
				$('div.zonasolmat').remove();
				$('div.zonadocmat').remove();

				if ( data[0].tiposol == "SA" )
					var tiposol = '.bloquealojamiento';
				else if ( data[0].tiposol == "SV" )
					var tiposol = '.bloqueviaje';
				else if ( data[0].tiposol == "SF" )
					var tiposol = '.bloquefungible';
				else if ( data[0].tiposol == "SN" )
					var tiposol = '.bloquenotagastos';

				$('#tiposolgastos').val(data[0].tiposol).trigger('change');
				$('div.activo #motivogasto').val(data[0].motivogasto).trigger('change');


				for ( key in data[0] ) {
					$(tiposol+' #'+key).val(data[0][key]);
				}


				$(tiposol+ ' select#usuario').empty();
				$(tiposol+ ' select#usuario').html('<option value="'+ data[0].usuario +'">'+ data[0].usuario +'</option>');

				$(tiposol+ 'select#usuario').empty();
				$(tiposol+ 'select#usuario').text(data[0].usuario);

				if ( tiposol == '.bloqueviaje' ) {
					$('#anadeviajeflag').val(1);
				}

				if ( data[0].tickets == 1 ) {
					$('#estanotagasto').css('color', 'green');
				} else {
					$('#estanotagasto').css('color', 'red');
				}

				$('#divnuevoitemrentabilidad').before(data['fungibles']);
				$('div.nuevoviaje').html(data['viajes']);

			}
		});

	});

	$(document).on("click", "#seleccionartpc", function(event) {

		event.preventDefault();

		var id = $(this).attr('iden');
		var tabla = $(this).attr('tabla');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id+'&tabla='+tabla+'&mat=1'+'&cierra=1',
			dataType: 'json',
			success: function(data) {

				$('#mostrardatos').modal('hide');
				$('.formulariotpc').get(0).reset();

				for ( key in data[0] ) {
					$('#'+key).val(data[0][key]);
				}

				$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');

				multiselect_deselectAll($('#docentestpc'));

				for (var i=0; i < data['docentestpc'].length; i++) {
					$('#docentestpc').multiselect('select', data['docentestpc'][i]);
				}

				$('.diplomastpc, .listadostpc, .tablatpc').css('display', 'inline-block');

				$('#id_mat').val(data[0].id_matricula);

				if ( data['existetablatpc'] == 1 )
					$('#estatablatpc').css('color', 'green');
				else
					$('#estatablatpc').css('color', 'red');

			}
		});

	});


	$(document).on("click", "#diplomastpc", function(event) {

		var n = $('#numcurso').val();


		if ( n != "" )
			window.open('http://gestion.eduka-te.com/app/documentacion/generar_diplomas_tpc.php?numero='+n, '_blank');

	});

	$(document).on("click", "#listadostpc", function(event) {

		var n = $('#numcurso').val();


		if ( n != "" )
			window.open('http://gestion.eduka-te.com/app/documentacion/generar_listados_tpc.php?numero='+n, '_blank');

	});


	$(document).on("click", "div.activo #buscardocente", function(event) {

		event.preventDefault();
		var tabla = $(this).attr('tabla');
		var values = 'nombre='+$('div.activo #docente').val();

		// console.log($('select#tiposolgastos').text());
		// console.log(values);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda.php',
			data: values+'&tabla='+tabla+'&mat=gasto',
			success: function(dato)
			{
				$('#mostrardatos').modal('show');
				$('#mostrardatos .contenido').html(dato);
			}
		});

	});



	$(document).on('click','#seleccionarsolmat', function(event) {
		event.preventDefault();

		var numero = getRowText($(this),'numero');
		var formacion = getRowText($(this),'denominacion');
		var modalidad = getRowText($(this),'modalidad');
		var lugar = getRowText($(this),'nombrecentro');
		var fechaini = getRowID($(this),'fechaini');
		var fechafin = getRowID($(this),'fechafin');
		var horaspresenciales = getRowID($(this),'horaspresenciales');
		var horasdistancia = getRowID($(this),'horasdistancia');
		var horastotales = getRowID($(this),'horastotales');
		var numalumnos = getRowID($(this),'numalumnos');
		var id_comercial = getRowID($(this),'id_comercial');
		var presupuesto = getRowID($(this),'presupuesto');
		var observaciones = getRowID($(this),'observaciones');
		var tipoformacion = getRowID($(this),'tipoformacionpropuesta');
		var id = getRowID($(this), 'id');

		$('#mostrardatos').modal('hide');

		if ( sec[1] == 'propuesta') {
			$('#numsolicitud').val(numero.substr(1,4));
			$('#solicitud').val(formacion).attr('disabled', true);
			$('#observaciones').val(observaciones);
			$('#tipoformacionpropuesta').val(tipoformacion);
			// $('#horasdistancia').val(horasdistancia);
			// $('#horastotales').val(horastotales);
			$('#numalumnos').val(numalumnos);
			$('#id_comercial').val(id_comercial);
			$('#nombrecentro').val(lugar);
			$('#fechaini').val(fechaini);
			$('#fechafin').val(fechafin);
			$('#presupuesto').val(presupuesto);
		} else {

			$('#solicitud').val(numero);

			if ( $('#tiposolicitud').val() == 'IKEA' )
				$('#id_solicitudikea').val(id);
			else {

				$('#id_solicitud').val(id);


				// var tabla = 'peticiones_formativas';

				// $.ajax({
				// 	cache: false,
				// 	type: 'POST',
				// 	url: 'functions/funciones.php',
				// 	data: 'id='+id+'&cierra=1'+'&tabla='+tabla+'&mat=x',
				// 	dataType: 'json',
				// 	success: function(data)
				// 	{
				// 		if ( data[1].numeroaccion != undefined ) {

				// 			$('#datosaccion').css('display','block');

				// 			$('#id_accion').val(data[1].id);
				// 			$('#numeroaccion').val(data[1].numeroaccion);
				// 			$('#denominacion').val(data[1].denominacion);
				// 			$('#horastotales').val(data[1].horastotales);
				// 			$('#modalidad').val(data[1].modalidad);

				// 			$('#fechaini').val(data[0].fechaini);
				// 			$('#fechafin').val(data[0].fechafin);

				// 			$('#presupuesto').val(data[0].presupuesto);
				// 			$('#alumnosestimados').val(data[0].numalumnos);
				// 			$('#precioventamat').val(data[0].preciomatricula);

				// 		}

				// 		if ( data[2].nombrecentro != undefined ) {

				// 			$('#datoscentro').css('display','block');

				// 			$('#id_centro').val(data[2].id);
				// 			$('#nombrecentro').val(data[2].nombrecentro);
				// 			$('#direccioncentro').val(data[2].direccioncentro);
				// 			$('#costeaula').val(data[2].costeaula);
				// 			$('#codigopostal').val(data[2].codigopostal);
				// 			$('select#poblacion').prop('disabled',false).html('<option value="'+data[2].localidad+'">'+data[2].localidad+'</option>');
				// 			$('select#provincia').prop('disabled',false).html('<option value="'+data[2].provincia+'">'+data[2].provincia+'</option>');
				// 			// $('#observaciones').val(data[2].observaciones);
				// 			$('#id_centro').val(data[2].id);


				// 		}

				// 		$('#externo').val(data[3].nombre);

				// 		$("#tipo_formacion").val(data[0].tipoformacionpropuesta).trigger('change');

				// 	}
				// }); ajax.abort();

			}


		}




		// $('#id_tienda').val(id);
	});





	$(document).on("click", "#exportar_propuesta", function(event){

		$('#exportar').val("1");

		var idprop = $(this).attr('idprop');

		$('input[name=submitx]').trigger('click');

		// sleep(1000);

		// window.open('http://gestion.eduka-te.com/app/documentacion'+gestion+'/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');




	});

	$(document).on("click", "#duplicardocente", function(event){

		var id = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id+'&duplicardocente=1',
			success: function(data)
			{
				alert("Proveedor duplicado.");
			}
		}); ajax.abort();

		// window.open('http://gestion.eduka-te.com/app/documentacion'+gestion+'/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');

	});

	$(document).on("click", "#duplicar_propuesta", function(event){

		// var idprop = $(this).attr('idprop');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'devuelve_comerciales_prop=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('#mostrardatos .mostrartitulo').html('Duplicar Solicitud');
				$('#mostrardatos .contenido').html(data);
			}
		}); ajax.abort();

		// window.open('http://gestion.eduka-te.com/app/documentacion'+gestion+'/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');

	});


	$(document).on("click", "#mostrardatos #duplicar_propuesta_go", function(event){

		alert("ey");
		var idc = $('#mostrardatos select#comercial').val();
		var idprop = $('.bloqueprop #id').val();
		// alert(idprop);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'idprop='+idprop+'&id_comercial='+idc+'&duplicar_propuesta=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert(data);
				else {
					alert("Propuesta Duplicada.");
					setTimeout(function(){location.reload();},2200);
				}
			}
		}); ajax.abort();

	});


	$(document).on("click", "#duplicar_propuesta_mat", function(event){

		var idprop = $(this).attr('idprop');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'idprop='+idprop+'&duplicar_propuesta_mat=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert(data);
				else {
					alert("Propuesta Duplicada a Matrícula.");
					setTimeout(function(){location.reload();},2200);
				}
			}
		}); ajax.abort();

		// window.open('http://gestion.eduka-te.com/app/documentacion'+gestion+'/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');

	});

	$(document).on("click", "#seleccionarreporte", function(event){

		$("html, body").animate({ scrollTop: 0 }, "slow");
		$('#id').val(getRowID($(this),'idrepor'));
		$('#fecha').val(getRowID($(this),'fechacontacto'));
		$('#procontacto').val(getRowID($(this),'procontacto'));
		$('#razonsocial').val(getRowText($(this),'razonsocial'));
		$('#prioridad').val(getRowID($(this),'prioridad'));
		$('#tipocontacto').val(getRowID($(this),'tipocontacto'));
		$('#observaciones').val(getRowID($(this),'observacioneslarga'));
		$('#id_empresa').val(getRowID($(this),'id_empresa'));
		$('#formacion').val(getRowID($(this),'formacion'));
		$('#id_accion').val(getRowID($(this),'id_accion'));


	});

	$(document).on("click", "#seleccionarmireporte", function(event){

		$("html, body").animate({ scrollTop: 0 });
		$('#id').val(getRowID($(this),'id'));
		$('#fecha').val(getRowID($(this),'fechax'));
		$('#fechaini').val(getRowID($(this),'fechainix'));
		$('#fechafin').val(getRowID($(this),'fechafinx'));
		$('#tipotarea').val(getRowText($(this),'tipotarea'));
		$('#persona').val(getRowText($(this),'persona'));
		$('#descripcion').val(getRowText($(this),'descripcionlarga'));
		var progre = getRowText($(this),'progreso');
		$('#progreso').val(progre);

		var antiprogre = 100-progre;
		$('.progress-bar-success').css('width', progre+'%');
		$('.progress-bar-danger').css('width', antiprogre+'%');

	});

	$(document).on("click", "#anadirempresa", function(event){

		event.preventDefault();

		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width', '1020px');
		$('.mostrartitulo').html('Añadir Empresa');
		$('.contenido').html('<div style="margin: 10px 0"; class="container"><div id="formempresareporte" class="col-md-12"><div class="col-md-10"><div class="form-group"><label class="control-label" for="empresa">Razón Social:</label><input type="text" id="empresa" name="empresa" class="form-control" /></div></div><div class="clearfix"></div><div style="overflow:auto; margin-top:10px"></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="contacto">Contacto:</label><input type="text" id="contacto" name="contacto" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="telefono">Teléfono:</label><input type="text" placeholder="Sólo números" id="telefono" name="telefono" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="email">Email:</label><input type="text" id="email" name="email" class="form-control" /></div></div><div class="clearfix"></div><a id="guardarempresareporte" style="margin-left: 15px; margin-top: 15px" class="btn btn-default btn-success">Guardar</a></div></div>');


	});


	$('#escogeanio').change(function() {

		// alert($(this).val());

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'launcher=1'+'&gestion='+$(this).val(),
			success: function(data)
			{
				location.reload();
			}
		}); ajax.abort();

	});


	$('.bloquecred #estado_peticion').change(function() {

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();
	    // alert(valueSelected);
	    if (valueSelected == 'Resuelta') {

	    	$.ajax({
	    		cache: false,
	    		type: 'POST',
	    		url: 'functions/funciones.php',
	    		data: 'solcredresulta=1'+'&cif='+$('.bloquecred #cif').val()+'&id_comercial='+$('.bloquecred #id_comercial').val()+'&numero='+$('.bloquecred #numero').val(),
	    		success: function(data)
	    		{
	    			if ( data.indexOf('error') != -1 )
	    				alert("error");
	    			else
	    				alert("Solicitud resuelta - email enviado.");
	    		}
	    	}); ajax.abort();

	    }

	});


	$(document).on("click", "#seleccionarsolicitudpeti", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_accion = parentTr.find('td#id').html();


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_accion+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
	            // alert(data[0].tipoformacionikea);

	            $('#tiposol').val(data[0].tiposol);

	            if ( data[0].tiposol == "SM" ) {

	            	$('.bloquemat').css('display','block');
	            	$('.bloqueprop').css('display','none');
	            	$('.bloquecred').css('display','none');
					// $('#objetivos').css('display','none');
					// $('#contenidos').css('display','none');

					$('.formulariosolmat').get(0).reset();

					$('.bloquemat #id').val(data[0].id);
					$('.bloquemat #id_accion').val(data[0].id_accion);
					$('.bloquemat #id_comercial').val(data[0].id_comercial);

					$('.bloquemat #comercial').html('<option>'+data[0].nombrecomercial+'</option>');
					$('.bloquemat #id_comercial').val(data[0].id_comercial);
					$('.bloquemat #tipoformacionpropuesta').val(data[0].tipoformacionpropuesta);
					$('.bloquemat #numero').val(data[0].numero);
					$('.bloquemat #numero').attr('value',data[0].numero);
					$('.bloquemat #formacion').val(data[0].formacion);
					$('.bloquemat #estado_peticion').val(data[0].estado_peticion);
		            // $('.bloquemat #estado_peticion').html(data[0].estado_peticion);
		            $('.bloquemat #id_accion').val(data[0].id_accion);
		            $('.bloquemat #modalidad').val(data[0].modalidad);
		            $('.bloquemat #nombrecentro').val(data[0].nombrecentro);
		            $('.bloquemat #id_centro').val(data[0].id_centro);
		            $('.bloquemat #presupuesto').val(data[0].presupuesto);
		            $('.bloquemat #empresas').val(data[0].empresas);
		            $('.bloquemat #numalumnos').val(data[0].numalumnos);
		            $('.bloquemat #preciomatricula').val(data[0].preciomatricula);
		            $('.bloquemat #fechaini').val(data[0].fechaini);
		            $('.bloquemat #fechafin').val(data[0].fechafin);
		            $('.bloquemat #usuario').val(data[0].usuario);
		            $('.bloquemat #abierto').val(data[0].abierto);
		            $('.bloquemat #formapagocred').val(data[0].formapagocred);
		            $('.bloquemat #iban').val(data[0].iban);


		            if (data[0].modalidad == 'A Distancia' || data[0].modalidad == 'Teleformación') {
		            	$('.bloquemat #horaspresenciales').prop('disabled',true);
		            	$('.bloquemat #horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
		            } else if (data[0].modalidad == 'Presencial') {
		            	$('.bloquemat #horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
		            	$('.bloquemat #horasdistancia').prop('disabled',true);
		            } else if (data[0].modalidad == 'Mixta') {

		            	$('.bloquemat #horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
		            	$('.bloquemat #horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
		            }
		            $('.bloquemat #horastotales').val(data[0].horastotales);
		            $('.bloquemat #horario').val(data[0].horario);
		            $('.bloquemat #observaciones').val(data[0].observaciones);
		            $('.bloquemat #observacionesgestor').val(data[0].observacionesgestor);

		            $('.bloquemat #uploaderapp').css('display','inline-block');

		            $('.bloquemat #mostraranexosol').attr('numero',data[0].numero);
		            $('.bloquemat #subiranexosol').attr('numero',data[0].numero);

		            $('.bloquemat #mostrartablasolb').attr('numero',data[0].numero);
		            $('.bloquemat #subirtablasolb').attr('numero',data[0].numero);
		            $('.bloquemat #mostrartablasolp').attr('numero',data[0].numero);
		            $('.bloquemat #subirtablasolp').attr('numero',data[0].numero);

		            $('.bloquemat #mostrarmatsol').attr('numero',data[0].numero);
		            $('.bloquemat #subirmatsol').attr('numero',data[0].numero);

		            $('.bloquemat #mostrarrecibosol').attr('numero',data[0].numero);
		            $('.bloquemat #subirrecibosol').attr('numero',data[0].numero);

		            if ( data[1] == 1 )
		            	$('span#estatablab').css('color','green');
		            else
		            	$('span#estatablab').css('color','red');

		            if ( data[2] == 1 )
		            	$('span#estatablap').css('color','green');
		            else
		            	$('span#estatablap').css('color','red');


		            if ( data[3] == 1 )
		            	$('span#estamat').css('color','green');
		            else
		            	$('span#estamat').css('color','red');

		            if ( data[4] == 1 )
		            	$('span#estaanexo-esfocc').css('color','green');
		            else
		            	$('span#estaanexo-esfocc').css('color','red');

		            if ( data[5] == 1 )
		            	$('span#estaanexo-esfocc').css('color','green');
		            else
		            	$('span#estaanexo-esfocc').css('color','red');

		            if ( data[6] == 1 )
		            	$('span#estarecibo').css('color','green');
		            else
		            	$('span#estarecibo').css('color','red');



		        } else if ( data[0].tiposol == "SC" ) {


		        	$('.bloquemat').css('display','none');
		        	$('.bloqueprop').css('display','none');
		        	$('.bloquecred').css('display','block');
					// $('#objetivos').css('display','none');

					$('.formulariosolcred').get(0).reset();

					$('.bloquecred #id').val(data[0].id);
					$('.bloquecred #id_accion').val(data[0].id_accion);
					$('.bloquecred #id_comercial').val(data[0].id_comercial);
					$('.bloquecred #cif').val(data[0].cif);
					$('.bloquecred #estado_peticion').val(data[0].estado_peticion);

					$('.bloquecred #comercial').html('<option>'+data[0].nombrecomercial+'</option>');
					$('.bloquecred #id_comercial').val(data[0].id_comercial);
					$('.bloquecred #numero').val(data[0].numero);
					$('.bloquecred #numero').attr('value',data[0].numero);
					$('.bloquecred #observaciones').val(data[0].observaciones);
					$('.bloquecred #observacionesgestor').val(data[0].observacionesgestor);
					$('.bloquecred #comisionistatxt').val(data[0].comisionistatxt);
					$('.bloquecred #comisionista').val(data[0].comisionista);


					if ( data[4] == 1 )
						$('.bloquecred span#estaanexo-esf').css('color','green');
					else
						$('.bloquecred span#estaanexo-esf').css('color','red');

					if ( data[5] == 1 )
						$('.bloquecred span#estaanexo-est').css('color','green');
					else
						$('.bloquecred span#estaanexo-est').css('color','red');


					$('.bloquecred #mostraranexosol').attr('numero',data[0].numero);
					$('.bloquecred #subiranexosol').attr('numero',data[0].numero);

					if ( data[0].estado_peticion == "Resuelta" || data[0].estado_peticion == "Anulada" ) {
						$('.bloquecred #subiranexosol-esf').css('display', 'none');
						$('.bloquecred #subiranexosol-est').css('display', 'none');
					} else {
						$('.bloquecred #subiranexosol-esf').css('display', 'block');
						$('.bloquecred #subiranexosol-est').css('display', 'block');
					}


				} else if ( data[0].tiposol == "SP" ) {

					$('.bloquemat').css('display','none');
					$('.bloqueprop').css('display','block');
					$('.bloquecred').css('display','none');

					$('.formulariosolprop').get(0).reset();


					$('.bloqueprop #id').val(data[0].id);
					$('.bloqueprop #id_accion').val(data[0].id_accion);
					$('.bloqueprop #id_comercial').val(data[0].id_comercial);

					$('.bloqueprop #comercial').html('<option>'+data[0].nombrecomercial+'</option>');
					$('.bloqueprop #id_comercial').val(data[0].id_comercial);
					$('.bloqueprop #tipoformacionpropuesta').val(data[0].tipoformacionpropuesta);
					$('.bloqueprop #numero').val(data[0].numero);
					$('.bloqueprop #numero').attr('value',data[0].numero);
					$('.bloqueprop #formacion').val(data[0].formacion);
					$('.bloqueprop #estado_peticion').val(data[0].estado_peticion);
					$('.bloqueprop #id_accion').val(data[0].id_accion);
					$('.bloqueprop #modalidad').val(data[0].modalidad);
					$('.bloqueprop #nombrecentro').val(data[0].nombrecentro);
					$('.bloqueprop #id_centro').val(data[0].id_centro);
					$('.bloqueprop #presupuesto').val(data[0].presupuesto);
					$('.bloqueprop #empresas').val(data[0].empresas);
					$('.bloqueprop #numalumnos').val(data[0].numalumnos);
					$('.bloqueprop #preciomatricula').val(data[0].preciomatricula);
					$('.bloqueprop #fechaini').val(data[0].fechaini);
					$('.bloqueprop #fechafin').val(data[0].fechafin);
					$('.bloqueprop #usuario').val(data[0].usuario);
					$('.bloqueprop #abierto').val(data[0].abierto);

					if (data[0].modalidad == 'A Distancia' || data[0].modalidad == 'Teleformación') {
						$('.bloqueprop #horaspresenciales').prop('disabled',true);
						$('.bloqueprop #horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
						$('.bloqueprop #requisitosbonificacion').val('Para ello, el alumno debe permanecer conectado mínimo el 25% de la duración total del curso, visualizar mínimo el 75% del temario y  obtener una puntuación igual o superior a 50% en las pruebas de evaluación.');
					} else if (data[0].modalidad == 'Presencial') {
						$('.bloqueprop #horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
						$('.bloqueprop #horasdistancia').prop('disabled',true);
						$('.bloqueprop #requisitosbonificacion').val('');
					} else if (data[0].modalidad == 'Mixta') {
						$('.bloqueprop #horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
						$('.bloqueprop #horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
						$('.bloqueprop #requisitosbonificacion').val('');
					}
					$('.bloqueprop #horastotales').val(data[0].horastotales);
					$('.bloqueprop #observaciones').val(data[0].observaciones);
					$('.bloqueprop #observacionesgestor').val(data[0].observacionesgestor);
					$('.bloqueprop #contenidos').val(data[0].contenidos);
					$('.bloqueprop #objetivos').val(data[0].objetivos);

					$('.bloqueprop #uploaderapp').css('display','inline-block');

					$('.bloqueprop #mostraranexosol').attr('numero',data[0].numero);
					$('.bloqueprop #subiranexosol').attr('numero',data[0].numero);

					$('.bloqueprop #mostrartablasol').attr('numero',data[0].numero);
					$('.bloqueprop #subirtablasol').attr('numero',data[0].numero);

					$('.bloqueprop #mostrarmatsol').attr('numero',data[0].numero);
					$('.bloqueprop #subirmatsol').attr('numero',data[0].numero);

					$('.bloqueprop #metodologianum').val(data[0].metodologianum);
					$('.bloqueprop #metodologia').val(data[0].metodologia);
					$('.bloqueprop #presufrase').val(data[0].presufrase);


					$('.bloqueprop #tablaprecios').val(data[0].tablaprecios);
					$('.bloqueprop #incluye').val(data[0].incluye);
					$('.bloqueprop #textobonificable').val(data[0].textobonificable);

					$('.bloqueprop #empresareal').val(data[0].empresareal);
					$('.bloqueprop #ESSSCAN').val(data[0].ESSSCAN);

					$('.bloqueprop #exportar_propuesta').css('display', 'inline-block');
					$('.bloqueprop #exportar_propuesta').attr('idprop', data[0].id);
					$('.bloqueprop #duplicar_propuesta').attr('idprop', data[0].id);
					$('.bloqueprop #duplicar_propuesta_mat').attr('idprop', data[0].id);

					if ( data[1] == 1 )
						$('span#estatabla').css('color','green');
					else
						$('span#estatabla').css('color','red');

					if ( data[2] == 1 )
						$('span#estamat').css('color','green');
					else
						$('span#estamat').css('color','red');

					if ( data[3] == 1 )
						$('span#estaanexo-esfocc').css('color','green');
					else
						$('span#estaanexo-esfocc').css('color','red');

					if ( data[4] == 1 )
						$('span#estaanexo-estrat').css('color','green');
					else
						$('span#estaanexo-estrat').css('color','red');

					if ( data[0].estado_peticion == "Aceptada" ) {
		            	// console.log(data[0].estado_peticion);
		            	$('.propuestafirmada').css('display', 'inline-block');
		            	$('#subirpdfpropuestafirmada, #mostrarpdfpropuestafirmada').attr('id_propuesta', data[0].id);
		            } else {
		            	$('.propuestafirmada').css('display', 'none');
		            }


		        }

		    }
		});
});

	$(document).on("click", "#seleccionarsolicitudprop", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_accion = parentTr.find('td#id').html();


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_accion+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
	            // alert(data[0].tipoformacionikea);
	            $('.formulariopropuesta').get(0).reset();
	            $('#id').val(data[0].id);

	            $('#numsolicitud').val(data[0].numsolicitud);
	            $('#camposolicitud').css('display', 'none');
	            $('#formacion').val(data[0].formacion);
	            $('#tipoformacionpropuesta').val(data[0].tipoformacionpropuesta);
	            $('#formacion').val(data[0].formacion);
	            $('#id_accion').val(data[0].id_accion);
	            $('#id_empresa').val(data[0].id_empresa);
	            $('#modalidad').val(data[0].modalidad);
	            $('#nombrecentro').val(data[0].nombrecentro);
	            $('#id_centro').val(data[0].id_centro);
	            $('#presupuesto').val(data[0].presupuesto);
	            $('#razonsocial').val(data[0].razonsocial);
	            $('#numalumnos').val(data[0].numalumnos);
	            // $('#fecha_firma').val(data[0].fecha_firma);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#estado_propuesta').val(data[0].estado_propuesta);
	            $('#tablaprecios').val(data[0].tablaprecios);
	            $('#id_comercial').val(data[0].id_comercial);

	            if (data[0].modalidad == 'A Distancia' || data[0].modalidad == 'Teleformación') {
	            	$('#horaspresenciales').prop('disabled',true);
	            	$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
	            	$('.bloqueprop #requisitosbonificacion').val('Para ello, el alumno debe permanecer conectado mínimo el 25% de la duración total del curso, visualizar mínimo el 75% del temario y  obtener una puntuación igual o superior a 50% en las pruebas de evaluación.');
	            } else if (data[0].modalidad == 'Presencial') {
	            	$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
	            	$('#horasdistancia').prop('disabled',true);
	            	$('.bloqueprop #requisitosbonificacion').val('');
	            } else if (data[0].modalidad == 'Mixta') {
	            	$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
	            	$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
	            	$('.bloqueprop #requisitosbonificacion').val('');
	            }
	            $('#horastotales').val(data[0].horastotales);
	            $('#objetivos').val(data[0].objetivos);
	            $('#contenido').val(data[0].contenido);
	            $('#observaciones').val(data[0].observaciones);
	            $('#observacionesgestor').val(data[0].observacionesgestor);

	            $('#exportar_propuesta').attr('idprop', data[0].id);
	            $('#duplicar_propuesta').attr('idprop', data[0].id);
	            $('#exportar_propuesta').css('display','inline-block');

	            $('#fecha_firma').val(fecha_firma);
	            $('#fecha_aceptacion').val(fecha_aceptacion);


	        }
	    });
	});


	// $(document).on("click", "#guardar_peticion", function(event){

		$('.formulariosolmat').validate({

			submitHandler: function(form) {

				if ( comprobarAnio() === false )
					return false;


				$('#confirmar').modal('show');

				$('#aceptacambios').on('click', function(event){

					$('#confirmar').modal('hide');

					var values = $('.formulariosolmat').find("input[type='hidden'], :input:not(:hidden)").serialize();
				// values = values + $('#tiposol').val();
				 alert(values);

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/funciones.php',
					data: values+'&guardar_peticion=1',
					success: function(data)
					{
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

						if ( data.indexOf('error') != -1 ) {
			        		$('#error').show(500).delay(2000).hide('slow');
			        	} else {
						   	$('#confirmacion').show(500).delay(2000).hide('slow');
						   	setTimeout(function(){location.reload();},2200);
					    }
					}
				}); ajax.abort();
			});
			},

			rules : {
				formacion : {
					minlength : 2,
					required : true
				},
				modalidad : {
					required : true
				},
				tipoformacionpropuesta : {
					required : true
				},
				horastotales : {
					required : true
				},
				formacion : {
					minlength : 2,
					required : true
				},
				numalumnos : {
					required : true
				},
				empresas : {
					required : true
				}
			},
			messages : {
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


		$('.formulariosolprop').validate({

			submitHandler: function(form) {

				if ( comprobarAnio() === false )
					return false;


				$('#confirmar').modal('show');

				$('#aceptacambios').on('click', function(event){

					$('#confirmar').modal('hide');
					var values = $('.formulariosolprop').find("input[type='hidden'], :input:not(:hidden)").serialize();
				// alert(values);

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/funciones.php',
					data: values+'&guardar_peticion=1',
					success: function(data)
					{
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

						// if ( data.indexOf('error') != -1 ) {
			   //      		$('#error').show(500).delay(2000).hide('slow');
			   //      	} else {

			   	var idprop = $('.bloqueprop input#id').val();
			        		// alert($('.bloqueprop select#estado_peticion').val());

			        		if ( $('.bloqueprop select#estado_peticion').val() == 'Realizada' ) {
			        			// alert("realizada");

			        			// window.open('http://gestion.eduka-te.com/app/documentacion'+gestion+'/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');

			        			$.ajax({
			        				cache: false,
			        				type: 'POST',
			        				url: 'documentacion2015/propuestas/doc_propuesta.php',
			        				data: 'idprop='+idprop+'&final=1',
			        				success: function(data)
			        				{
			        					$('#confirmacion').show(500).delay(2000).hide('slow');
			        					setTimeout(function(){location.reload();},2200);
			        				}
			        			});

			        		}

			        		if ( $('.bloqueprop input#exportar').val() == '1' ) {
			        			window.open('http://gestion.eduka-te.com/app/documentacion2015/propuestas/doc_propuesta.php?idprop='+idprop, '_blank');
			        			$('.bloqueprop input#exportar').val("0");
			        		}

			        		$('#confirmacion').show(500).delay(2000).hide('slow');
			        		setTimeout(function(){location.reload();},2200);
					    // }
					}
				}); ajax.abort();


			});

			},

			rules : {
				formacion : {
					minlength : 2,
					required : true
				},
				modalidad : {
					required : true
				},
				tipoformacionpropuesta : {
					required : true
				},
				horastotales : {
					required : true
				},
				formacion : {
					minlength : 2,
					required : true
				},
				numalumnos : {
					required : true
				},
				objetivos : {
					minlength : 2,
					required : true
				},
				empresas : {
					required : true
				}
			},
			messages : {
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


		$('.formulariosolcred').validate({

			submitHandler: function(form) {

				$('#confirmar').modal('show');

				$('#aceptacambios').on('click', function(event){

					$('#confirmar').modal('hide');
					var values = $('.formulariosolcred').find("input[type='hidden'], :input:not(:hidden)").serialize();

					if ( $('.bloquecred #cif').val().length != 9 || $('.bloquecred #cif').val() == "" ) {

						alert("Introduce un CIF correcto.");
						return false;
					}

					$.ajax({
						cache: false,
						type: 'POST',
						url: 'functions/funciones.php',
						data: values+'&guardar_peticion=1',
						success: function(data)
						{
							$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

						// if ( data.indexOf('error') != -1 ) {
			   //      		$('#error').show(500).delay(2000).hide('slow');
			   //      	} else {
			   	$('#confirmacion').show(500).delay(2000).hide('slow');
			   	setTimeout(function(){location.reload();},2200);
					    // }
					}
				}); ajax.abort();
				});
			},

			rules : {
				formacion : {
					minlength : 2,
					required : true
				},
				modalidad : {
					required : true
				},
				tipoformacionpropuesta : {
					required : true
				},
				horastotales : {
					required : true
				},
				formacion : {
					minlength : 2,
					required : true
				},
				numalumnos : {
					required : true
				},
				empresas : {
					required : true
				}
			},
			messages : {
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



		$('.formularioviaje').validate({

		// event.preventDefault();

		submitHandler: function(form) {

			if ( $('#anadeviajeflag').val() != 1 ) {
				alert("Añade un trayecto antes de guardar.");
				return false;
			}

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');

				$( "div.nuevoviaje div.linea_viaje" ).each(function(i,e) {
					$(this).find('input,select').attr('disabled', true);
				});

				$('#anadeviajeflag').attr('disabled', true);

				var values = $('.formularioviaje').find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/procesar_forms.php',
					dataType: 'json',
					data: values,
					success: function(data)
					{

						if ( data['error'] !== undefined ) {
							alert("Ocurrio un error " + data[0].error);
						} else {


							var v = new Array();
							var i = 0;
							$( "div.nuevoviaje div.linea_viaje" ).each(function(index, el) {

								i++;

								v[i] = {
									'tipoviaje': $('select#tipoviaje'+i).val(),
									'origen': $('input#origen'+i).val(),
									'horario': $('input#horario'+i).val(),
									'fechaini': $('input#fechaini'+i).val(),
									'fechafin': $('input#fechafin'+i).val(),
									'idavuelta': $('select#idavuelta'+i).val(),
									'importeviaje': $('input#importeviaje'+i).val(),
									'id_peticion': data['id']
								};

								// alert(i);

							});


							$.ajax({
								cache: false,
								type: 'POST',
								url: 'functions/insertaitemsrentabilidad.php',
								data: { viajes : v },
								success: function(data)
								{
									if ( data.indexOf('error') != -1 ) {
										alert("Ocurrio un error " + data);
									} else {
										$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
										$('#confirmacion').show(500).delay(2000).hide('slow');
										setTimeout(function(){location.reload();},2200);
									}

								}
							}); ajax.abort();

							$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
							$('#confirmacion').show(500).delay(2000).hide('slow');
							setTimeout(function(){location.reload();},2200);
						}


					}
				}); ajax.abort();
			});
		},

		rules : {
			origen : {
				minlength : 2,
				required : true
			},
			tipoviaje : {
				required : true
			},
			idavuelta : {
				required : true
			},
			fechaini : {
				required : true
			},
			motivogasto : {
				required : true
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


		$('.formulariofungible').validate({

			// console.log("entra");

			submitHandler: function(form) {

				$('#confirmar').modal('show');

				$('#aceptacambios').on('click', function(event){

					$('#confirmar').modal('hide');
					$('select#listafun').attr('disabled', true);
					$('select#tiposolicitud').attr('disabled', true);

					$( "div.fungibles #fungiblerow" ).each(function() {
						$(this).find('input').attr('disabled', true);
					});


					var values = $('.formulariofungible').find("input[type='hidden'], :input:not(:hidden)").serialize();


					$( "div.fungibles #fungiblerow" ).each(function() {
						$(this).find('input').attr('disabled', false);
					});


					var f = new Array();
					var i = 0;

				// return false;
				$('select#listafun').attr('disabled', false);
				$('select#tiposolicitud').attr('disabled', true);


				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/procesar_forms.php',
					dataType: 'json',
					data: values,
					success: function(data)
					{

						if ( data['error'] !== undefined ) {
							alert("Ocurrio un error " + data[0].error);
						} else {

							$( "div.fungibles #fungiblerow" ).each(function() {

								var id_item = $(this).find('input#nuevoitem').attr('iden');

								f[i] = {
									'id_item': id_item,
									'cantidad': $('input#cantidaditem'+id_item).val(),
									'id_solicitud': $('input#id_solicitud').val(),
									'id_solicitudikea': $('input#id_solicitudikea').val(),
									'id_peticion': data['id']
								};

								i++;

							});


							console.log(f);

							$.ajax({
								cache: false,
								type: 'POST',
								url: 'functions/insertaitemsrentabilidad.php',
								data: { fungibles : f },
								success: function(data)
								{
									if ( data.indexOf('error') != -1 ) {
										alert("Ocurrio un error " + data);
									} else {
										$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
										$('#confirmacion').show(500).delay(2000).hide('slow');
										setTimeout(function(){location.reload();},2200);
									}

								}
							}); ajax.abort();

						}


					}
				}); ajax.abort();
			});
			},

			rules : {

				motivogasto : {
					required : true
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


		$('.formularioalojamiento').validate({

		// event.preventDefault();

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $('.formularioalojamiento').find("input[type='hidden'], :input:not(:hidden)").serialize();


				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/procesar_forms.php',
					data: values,
					success: function(data)
					{

						if ( data.indexOf('error') != -1 ) {
							alert("Ocurrio un error " + data);
						} else {
							$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
							$('#confirmacion').show(500).delay(2000).hide('slow');
							setTimeout(function(){location.reload();},2200);
						}


					}
				}); ajax.abort();
			});
		},

		rules : {
			lugar : {
				minlength : 2,
				required : true
			},
			fechaini : {
				required : true
			},
			fechafin : {
				required : true
			},
			personas : {
				required : true
			},
			motivogasto : {
				required : true
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


		$('.formularionotagastos').validate({

		// event.preventDefault();

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $('.formularionotagastos').find("input[type='hidden'], :input:not(:hidden)").serialize();


				$.ajax({
					cache: false,
					type: 'POST',
					url: 'forms/procesar_forms.php',
					data: values,
					success: function(data)
					{

						if ( data.indexOf('error') != -1 ) {
							alert("Ocurrio un error " + data);
						} else {
							$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
							$('#confirmacion').show(500).delay(2000).hide('slow');
							setTimeout(function(){location.reload();},2200);
						}


					}
				}); ajax.abort();
			});
		},

		rules : {
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



		$('.formulariopropuesta').validate({

			submitHandler: function(form) {

			// alert("hola");
			// if ( $('#id_empresa').val() == "" ) {
			// 	alert("Selecciona una empresa de lista o añádela si no está.");
			// 	return false;
			// }

			// var optionSelected = $('#tipoacreedor').find("option:selected");
	  //   	var valueSelected  = optionSelected.val();
			// if ( valueSelected == '' ) {
			// 	$('#alerta-error').modal('show');
			// 	$('.mensaje-error').html("Debes seleccionar el tipo de acreedor.");
			// 	return false;
			// }

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $('.formulariopropuesta').find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/funciones.php',
					data: values+'&guardar_peticion=1',
					success: function(data)
					{
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

						// if ( data.indexOf('error') != -1 ) {
			   //      		$('#error').show(500).delay(5000).hide('slow');
			   //      	} else {
			   	$('#confirmacion').show(500).delay(2000).hide('slow');
			   	setTimeout(function(){location.reload();},2200);
					    // }
					}
				}); ajax.abort();
			});
		},

		rules : {
			formacion : {
				minlength : 2,
				required : true
			},
			modalidad : {
				required : true
			},
			tipoformacionpropuesta : {
				required : true
			},
			horastotales : {
				required : true
			},
			formacion : {
				minlength : 2,
				required : true
			},
			numalumnos : {
				required : true
			},
			nombrecentro : {
				required : true
			},
			empresas : {
				required : true
			},
			estado_propuesta : {
				required : true
			},
			objetivos : {
				required : true
			},
			contenido : {
				required : true
			}
		},
		messages : {

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




	// $(document).on("click", "#guardar_peticion", function(event){

	// 	event.preventDefault();

	// 	// alert("values");
	// 	var values = $('.formulariopeticion').find("input[type='hidden'], :input:not(:hidden)").serialize();
	// 	alert(values);


	// 	$.ajax({
	// 		cache: false,
	// 		type: 'POST',
	// 		url: 'functions/funciones.php',
	// 		data: values+'&guardar_peticion=1',
	// 		success: function(data)
	// 		{
	// 			$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

	// 			if ( data.indexOf('error') != -1 ) {
	//         		$('#error').show(500).delay(5000).hide('slow');
	//         	} else {
	// 		        $('#confirmacion').show(500).delay(2000).hide('slow');
	// 		        setTimeout(function(){location.reload();},2200);
	// 		    }
	// 		}
	// 	}); ajax.abort();

	// });

	$(document).on("click", "#guardarempresareporte", function(event){

		event.preventDefault();

		// alert("values");
		var empresa = $('#empresa').val();

		var values = $('#formempresareporte').find("input[type='hidden'], :input:not(:hidden)").serialize();
		// alert(values);


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: values+'&guardarempresareporte=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert(data);
				else {
					alert("Empresa guardada.");
					$('#mostrardatos').modal('hide');
					$('#razonsocial').val(empresa);
					$('#id_empresa').val(data);
					// alert(empresa);
				}
			}
		}); ajax.abort();

	});

	$(document).on("click", "#listarreporteprox", function(event){

		// alert("a listar");
		listarReportesProx();

	});

	function listarReportesProx() {


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'listarreportesprox=1',
			success: function(data)
			{
				$('#listadoreportes').html(data);
			}
		}); ajax.abort();


	}

	function listarReportes() {


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'listarreportes=1',
			success: function(data)
			{
				$('#listadoreportes').html(data);
			}
		}); ajax.abort();


	}


	$(document).on("click", "#buscarcomisionista", function(event){

		event.preventDefault();

		if (sec[1] == 'empresas' || sec[1] == 'empresas#' || sec[1] == 'peticiones-matriculas' || sec[1] == 'peticion-matricula' )
			var clave = $('#comisionistatxt').val();
		else
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
		// alert("llama");
		var row = getRowText($(this), 'nombre');
		var id = getRow($(this),'id');
		// alert(row);
		$('#mostrardatos').modal('hide');
		if (sec[1] == 'empresas' || sec[1] == 'empresas#' || sec[1] == 'peticiones-matriculas' || sec[1] == 'peticion-matricula' ) {
			$('#comisionistatxt').val(row);
			$('#comisionista').val(id);
		} else
		$('#nombre').val(row);

	});



	$(document).on("click", "#pregenerarcomisionistacontinua", function(event){

		var id_comisionista = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_comisionista='+id_comisionista+'&precomisionistacontinua=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html('Acuerdo Comisionista Formación Continua');
				$('.contenido').html(data);
			}
		}); ajax.abort();
		// window.open('http://gestion.eduka-te.com/app/documentacion/acuerdocontinua.php?id_comisionista='+$('#id').val(), '_blank');
	});

	$(document).on("click", "#generarcomisionistacontinua", function(event){
		window.open('http://gestion.eduka-te.com/app/documentacion/acuerdocontinua.php?id_comisionista='+$('#id').val()+'&formapago='+$('#formapago').val()+'&vencimiento='+$('#vencimiento').val(), '_blank');
	});

	$(document).on("click", "#pregenerarcomisionistacontrato", function(event){

		var id_comisionista = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_comisionista='+id_comisionista+'&precomisionistacontrato=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html('Acuerdo Comisionista Contrato de Formación');
				$('.contenido').html(data);
			}
		}); ajax.abort();
		// window.open('http://gestion.eduka-te.com/app/documentacion/acuerdocontinua.php?id_comisionista='+$('#id').val(), '_blank');
	});

	$(document).on("click", "#generarcomisionistacontrato", function(event){
		window.open('http://gestion.eduka-te.com/app/documentacion/acuerdocontrato.php?id_comisionista='+$('#id').val()+'&formapago='+$('#formapago').val()+'&vencimiento='+$('#vencimiento').val(), '_blank');
	});


	$(document).on("click", "#pregenerarcomisionistaotro", function(event){

		var id_comisionista = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_comisionista='+id_comisionista+'&precomisionistaotro=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html('Acuerdo Comisionista otro tipo de acuerdo');
				$('.contenido').html(data);
			}
		}); ajax.abort();
		// window.open('http://gestion.eduka-te.com/app/documentacion/acuerdocontinua.php?id_comisionista='+$('#id').val(), '_blank');
	});

	$(document).on("click", "#generarcomisionistaotro", function(event){

		var id_comisionista = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'estipulaciones='+$('#estipulaciones').val()+'&id_comisionista='+id_comisionista+'&guardaestipulaciones=1',
			success: function(data)
			{
				window.open('http://gestion.eduka-te.com/app/documentacion/acuerdootro.php?id_comisionista='+id_comisionista+'&formapago='+$('#formapago').val()+'&vencimiento='+$('#vencimiento').val(), '_blank');
			}
		}); ajax.abort();

	});


	// $('#porcentajeformacion').keyup(function() {

	// 	if ( $(this).val() == "" ) $('#importeformacion').prop('disabled',false);
	// 	else $('#importeformacion').prop('disabled',true);

	// });

	// $('#importeformacion').keyup(function() {

	// 	if ( $(this).val() == "" )$('#porcentajeformacion').prop('disabled',false);
	// 	else $('#porcentajeformacion').prop('disabled',true);

	// });

	// $('#porcentajecontrato').keyup(function() {

	// 	if ( $(this).val() == "" )$('#importecontrato').prop('disabled',false);
	// 	else $('#importecontrato').prop('disabled',true);

	// });

	// $('#importecontrato').keyup(function() {

	// 	if ( $(this).val() == "" )$('#porcentajecontrato').prop('disabled',false);
	// 	else $('#porcentajecontrato').prop('disabled',true);

	// });

	// $('#porcentajeotro').keyup(function() {

	// 	if ( $(this).val() == "" )$('#importeotro').prop('disabled',false);
	// 	else $('#importeotro').prop('disabled',true);

	// });

	// $('#importeotro').keyup(function() {

	// 	if ( $(this).val() == "" )$('#porcentajeotro').prop('disabled',false);
	// 	else $('#porcentajeotro').prop('disabled',true);

	// });



	$(document).on("click","#eliminarAlumnoBD", function(event) {

		event.preventDefault();
		var id_alumno = getRow($(this));
		// alert(id_alumno);

		$('#confirmar').modal('show');
		$('#confirmar').css('z-index','1060');
		// $('#confirmar .modal-dialog').css('z-index','9999');

		$('#aceptacambios').on('click', function(event) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_alumno='+id_alumno+'&borraralumnobd=1',
				success: function(data)
				{
					$('#confirmar').modal('hide');
					$('#mostrardatos').modal('hide');
					$('#confirmacion').html("Alumno borrado correctamente.");
					$('#confirmacion').show(500).delay(2000).hide('slow');
				}
			}); ajax.abort();

		});

	});

	$(document).on("click","#eliminarEmpresaBD", function(event) {

		event.preventDefault();
		var id_empresa = getRow($(this));
		// alert(id_empresa);

		$('#confirmar').modal('show');
		$('#confirmar').css('z-index','1060');
		// $('#confirmar .modal-dialog').css('z-index','9999');

		$('#aceptacambios').on('click', function(event) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_empresa='+id_empresa+'&borrarempresabd=1',
				success: function(data)
				{
					$('#confirmar').modal('hide');
					$('#mostrardatos').modal('hide');
					$('#confirmacion').html("Empresa borrada correctamente.");
					$('#confirmacion').show(500).delay(2000).hide('slow');
				}
			}); ajax.abort();

		});

	});

	var modifespecialidad = '0';

	$('#empresacreada').on('click', function() {
		if ( $(this).prop('checked') )
			$('#fechacreacion').prop('disabled',false);
		else
			$('#fechacreacion').prop('disabled',true);
	});


	$("#buscarpoblacion").on('click', function (event) {

		event.preventDefault();

		var cp = $("#codigopostal").val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/poblaciones.php',
			data: 'cp='+cp,
			success: function(data)
			{
				$("#poblacion").html(data).prop('disabled',false);
			}
		});

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/provincias.php',
			data: 'cp='+cp,
			success: function(data)
			{
				$("#provincia").html(data).prop('disabled',false);
			}
		});
	});

	$(document).on("click","#formacionesAlumno", function(event) {

		event.preventDefault();
		// alert("aa");
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_alumno = parentTr.find('td#id').html();
		var alumno = parentTr.find('td#nombre').html()+' '+parentTr.find('td#apellido').html();
    	// alert(id_alumno);

    	$.ajax({
    		cache: false,
    		type: 'POST',
    		url: 'functions/funciones.php',
    		data: 'id_alumno='+id_alumno+'&formacionalumno=1'+'&alumno='+alumno,
    		success: function(data)
    		{
    			$('#mostrardatosc').modal('show');
    			$('#mostrardatosc .modal-dialog').css('width','900px');
    			$('#mostrardatosc .mostrartitulo').html('Formaciones de Alumnos');
    			$('#mostrardatosc .contenido').html(data);
    		}
    	}); ajax.abort();

    });

	$(document).on("click","#formacionesEmpresa", function(event) {

		event.preventDefault();
		// alert("aa");
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_empresa = parentTr.find('td#id').html();
		var empresa = parentTr.find('td#empresa').html();
    	// alert(id_alumno);

    	$.ajax({
    		cache: false,
    		type: 'POST',
    		url: 'functions/funciones.php',
    		data: 'id_empresa='+id_empresa+'&formacionempresa=1'+'&empresa='+empresa,
    		success: function(data)
    		{
    			$('#mostrardatosc').modal('show');
    			$('#mostrardatosc .modal-dialog').css('width','900px');
    			$('#mostrardatosc .mostrartitulo').html('Formaciones de Empresas');
    			$('#mostrardatosc .contenido').html(data);
    		}
    	}); ajax.abort();

    });


	// $(document).on("keydown","#numero",function (e){
 //        if(e.keyCode == 13){//Enter key pressed
 //            $('#busqueda').click();//Trigger search button click event
 //        }
 //    });

 $(document).on("keydown","#pass",function (e){
        if(e.keyCode == 13){//Enter key pressed
            $('#login').click();//Trigger search button click event
        }
    });

 $(document).on("click","#logout", function(event) {

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/logout.php',
 		data: 'salir=1',
 		success: function(data)
 		{
 			window.location.href = 'http://eduka-te.com/gestion/';
 		}
 	}); ajax.abort();

 });


 $(document).on("click","#docentesacuerdos", function(event) {

 	event.preventDefault();
    	// alert("listar formaciones");
    	var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var docente = parentTr.find('td#nombre').html()+' '+parentTr.find('td#apellido').html();

    	$.ajax({
    		cache: false,
    		type: 'POST',
    		url: 'functions/funciones.php',
    		data: 'id='+id_docente+'&docente='+docente+'&docentesacuerdos=1',
    		success: function(data)
    		{
				// $('.mostrartitulo').html(");
				$('#mostrardatosc').modal('show');
				$('#mostrardatosc .mostrartitulo').html("Acuerdo con el docente");
				$('#mostrardatosc .contenido').html(data);
			}
		}); ajax.abort();

    });

 $(document).on("click","#subirinformes", function(event) {

 	event.preventDefault();
 	var id_empresa = $('#id').val();
 	var input_upload = '<div class="clearfix"></div><div style="margin-top:10px;" class="col-md-12"><form id="pdfinforme" action="" method="post" enctype="multipart/form-data"><label> PDF Informe de Empresa: </label><br><input style="float:left" type="file" name="empfile" id="empfile" class="btn btn-default"/><a id="subirpdfinforme" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfinforme" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form></div><div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfanexo" action="" method="post" enctype="multipart/form-data"><label> PDF Anexo de Adhesión: </label><br><input style="float:left" type="file" name="anexofile" id="anexofile" class="btn btn-default"/><a id="subirpdfanexo" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfanexo" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfanexoenc" action="" method="post" enctype="multipart/form-data"><label> PDF Anexo Encomienda ESFOCC: </label><br><input style="float:left" type="file" name="anexofilenc" id="anexofilenc" class="btn btn-default"/><a id="subirpdfanexoenc" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfanexoenc" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div><div class="clearfix"></div></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfanexoencestra" action="" method="post" enctype="multipart/form-data"><label> PDF Anexo Encomienda ESFOCC Estrategias: </label><br><input style="float:left" type="file" name="anexofilencestra" id="anexofilencestra" class="btn btn-default"/><a id="subirpdfanexoencestra" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfanexoencestra" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div>';
 	var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';
 	var estano = '<span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>';

 	$('#mostrardatos').modal('show');
 	$('.modal-dialog').css('width','700px');
 	$('.mostrartitulo').html('Documentación de Empresa');

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_empresa='+id_empresa+'&busqueda=2',
 		dataType: 'json',
 		success: function(data)
 		{
 			$('.contenido').html(input_upload);

		    	// alert(data.user);
		    	if ( data.user != "cristina" && data.user != "ytejera" && data.user != "root" && data.user != "alago" ) {
		    		$('#subirpdfinforme,#subirpdfanexo,#subirpdfanexoenc,#subirpdfanexoencestra').css('display', 'none');
		    	}

		    	if ( data.existeanexo === 1 ) $('#mostrarpdfanexo').after(estasi); else $('#mostrarpdfanexo').after(estano);
		    	if ( data.existeinforme === 1 ) $('#mostrarpdfinforme').after(estasi); else $('#mostrarpdfinforme').after(estano);
		    	if ( data.existeanexoenc_esfocc === 1 ) $('#mostrarpdfanexoenc').after(estasi); else $('#mostrarpdfanexoenc').after(estano);
		    	if ( data.existeanexoenc_estrateg === 1 ) $('#mostrarpdfanexoencestra').after(estasi); else $('#mostrarpdfanexoencestra').after(estano);

		    }
		}); ajax.abort();

 });


 $(document).on("click","#subirpdfinforme", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#empfile').get(0).files[0]);
		formData.append('id_empresa', $('#id').val());
		formData.append('tipo', 'informe');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#empfile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				dataType : 'json',
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfinforme').after(estasi);
	                	// alert("1 "+data['asignado']);
	                	// alert("2 "+data['asignado'].asignado);
	                	// alert("3 "+data.asignado);
	                	$('#asignado').val(data.asignado);
	                	$('#dispuesto_acciones').val(data.dispuesto_acciones);
	                	$('#dispuesto_pif').val(data.dispuesto_pif);
	                	$('#disponible').val(data.disponible);
	                	$('#actualizado_a').val(data.actualizado_a);

	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfanexo", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#anexofile').get(0).files[0]);
		formData.append('id_empresa', $('#id').val());
		formData.append('tipo', 'anexo');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#anexofile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfanexo').after(estasi);
					}
					else
						alert("Error en la subida.");

				}
			}); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfanexoenc", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#anexofilenc').get(0).files[0]);
		formData.append('id_empresa', $('#id').val());
		formData.append('tipo', 'anexoenc_esfocc');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#anexofilenc').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfanexoenc').after(estasi);
					}
					else
						alert("Error en la subida.");

				}
			}); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfanexoencestra", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#anexofilencestra').get(0).files[0]);
		formData.append('id_empresa', $('#id').val());
		formData.append('tipo', 'anexoenc_estrateg');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#anexofilencestra').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfanexoencestra').after(estasi);
					}
					else
						alert("Error en la subida.");

				}
			}); ajax.abort();
		}

	});

 $(document).on("click", "#mostrarpdfinforme", function(event) {

 	event.preventDefault();

 	var id_empresa = $('#id').val();

 	if ( sec[1] == 'empresasikea' || sec[1] == 'empresasikea#' || sec[1] == 'empresas_externas' || sec[1] == 'empresas_externas#' ) {
 		var id_empresa = $(this).attr('id_empresa');
 	}

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_empresa='+id_empresa+'&tipo=empresa',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfanexo", function(event) {

 	event.preventDefault();

 	var id_empresa = $('#id').val();

 	if ( sec[1] == 'empresasikea' || sec[1] == 'empresasikea#' || sec[1] == 'empresas_externas' || sec[1] == 'empresas_externas#' ) {
 		var id_empresa = $(this).attr('id_empresa');
 	}

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_empresa='+id_empresa+'&tipo=anexo',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfanexoenc", function(event) {

 	event.preventDefault();

 	var id_empresa = $('#id').val();

 	if ( sec[1] == 'empresasikea' || sec[1] == 'empresasikea#' || sec[1] == 'empresas_externas' || sec[1] == 'empresas_externas#' ) {
 		var id_empresa = $(this).attr('id_empresa');
 	}

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_empresa='+id_empresa+'&tipo=anexoenc_esfocc',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfanexoencestra", function(event) {

 	event.preventDefault();

 	var id_empresa = $('#id').val();

 	if ( sec[1] == 'empresasikea' || sec[1] == 'empresasikea#' || sec[1] == 'empresas_externas' || sec[1] == 'empresas_externas#' ) {
 		var id_empresa = $(this).attr('id_empresa');
 	}

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_empresa='+id_empresa+'&tipo=anexoenc_estrateg',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });


 $(document).on("click","a#subirdocudocente", function(event) {

 	event.preventDefault();
 	var id_docente = $('#id').val();
 	var input_upload = '<div class="clearfix"></div><div style="margin-top:10px;" class="col-md-12"><form id="pdfcv" action="" method="post" enctype="multipart/form-data"><label> PDF Currículum: </label><br><input style="float:left" type="file" name="cvfile" id="cvfile" class="btn btn-default"/><a id="subirpdfcv" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfcv" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form></div><div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfcontrato" action="" method="post" enctype="multipart/form-data"><label> PDF Contrato: </label><br><input style="float:left" type="file" name="contratofile" id="contratofile" class="btn btn-default"/><a id="subirpdfcontrato" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfcontrato" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfnifdocente" action="" method="post" enctype="multipart/form-data"><label> PDF NIF: </label><br><input style="float:left" type="file" name="niffile" id="niffile" class="btn btn-default"/><a id="subirpdfnifdocente" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfnifdocente" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfnissdocente" action="" method="post" enctype="multipart/form-data"><label> PDF NISS: </label><br><input style="float:left" type="file" name="nissfile" id="nissfile" class="btn btn-default"/><a id="subirpdfnissdocente" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfnissdocente" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div></div>';
 	var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';
 	var estano = '<span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>';

 	$('#mostrardatos').modal('show');
 	$('.modal-dialog').css('width','700px');
 	$('.mostrartitulo').html('Documentación del Docente');

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+id_docente+'&busqueda=3',
 		dataType: 'json',
 		success: function(data)
 		{
 			$('.contenido').html(input_upload);

 			if ( data.existecv === 1 ) $('#mostrarpdfcv').after(estasi); else $('#mostrarpdfcv').after(estano);
 			if ( data.existecontrato === 1 ) $('#mostrarpdfcontrato').after(estasi); else $('#mostrarpdfcontrato').after(estano);
 			if ( data.existenif === 1 ) $('#mostrarpdfnifdocente').after(estasi); else $('#mostrarpdfnifdocente').after(estano);
 			if ( data.existeniss === 1 ) $('#mostrarpdfnissdocente').after(estasi); else $('#mostrarpdfnissdocente').after(estano);

 		}
 	}); ajax.abort();

 });

 $(document).on("click","a#subirdocuentidad", function(event) {

 	event.preventDefault();
 	var id_docente = $('#id').val();
 	var input_upload = '<div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdfresponsableins" action="" method="post" enctype="multipart/form-data"><label> PDF Declaración Responsable Inscripción: </label><br><input style="float:left" type="file" name="respfile" id="respfile" class="btn btn-default"/><a id="subirpdfresponsableins" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfresponsableins" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div class="clearfix"></div></div>';
 	var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';
 	var estano = '<span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>';

 	$('#mostrardatos').modal('show');
 	$('.modal-dialog').css('width','700px');
 	$('.mostrartitulo').html('Documentación de la Entidad');

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+id_docente+'&busqueda=3',
 		dataType: 'json',
 		success: function(data)
 		{
 			$('.contenido').html(input_upload);

 			if ( data.existeresp === 1 ) $('#mostrarpdfresponsableins').after(estasi); else $('#mostrarpdfresponsableins').after(estano);

 		}
 	}); ajax.abort();

 });


 $(document).on("click","#subirpdfcv", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#cvfile').get(0).files[0]);
		formData.append('id_docente', $('#id').val());
		formData.append('tipo', 'cv');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#cvfile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
	                	$('span.glyphicon glyphicon-ok-circle').html(estasi);
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfcontrato", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#contratofile').get(0).files[0]);
		formData.append('id_docente', $('#id').val());
		formData.append('tipo', 'contrato');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#contratofile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
	                	// $('#mostrarpdfcontrato').after(estasi);
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfnifdocente", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#niffile').get(0).files[0]);
		formData.append('id_docente', $('#id').val());
		formData.append('tipo', 'nif');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#niffile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
	                	// $('#mostrarpdfnifdocente').after(estasi);
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfnissdocente", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#nissfile').get(0).files[0]);
		formData.append('id_docente', $('#id').val());
		formData.append('tipo', 'niss');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#nissfile').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
	                	// $('#mostrarpdfnissdocente').after(estasi);
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
		}

	});

 $(document).on("click","#subirpdfresponsableins", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
			// coge el archivo
			formData.append('file', $('#respfile').get(0).files[0]);
			formData.append('id_docente', $('#id').val());
			formData.append('tipo', 'responsable');
			var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


			if ( $('#respfile').get(0).files[0] == undefined ) {

				alert("Selecciona un archivo.");

			} else {

				$.ajax({
					cache: false,
					url: 'functions/subida_pdf.php',
					type: 'POST',
					data: formData,
					processData: false,
					contentType: false,
					success: function (data) {

						if ( data != 'error' ) {
							alert("Fichero subido correctamente.");
		                	// $('#mostrarpdfnissdocente').after(estasi);
		                }
		                else
		                	alert("Error en la subida.");

		            }
		        }); ajax.abort();
			}

		});

 $(document).on("click", "#mostrarpdfresponsableins", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+$('#id').val()+'&tipo=responsable',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfcv", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+$('#id').val()+'&tipo=cv',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfcontrato", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+$('#id').val()+'&tipo=contrato',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfnifdocente", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+$('#id').val()+'&tipo=nif',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });

 $(document).on("click", "#mostrarpdfnissdocente", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_docente='+$('#id').val()+'&tipo=niss',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
 			else
 				window.open(data);
 		}
 	}); ajax.abort();

 });



 $(document).on("click","#subirpdfcomisionista", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#pdfcomisionista').get(0).files[0]);
		formData.append('id_comisionista', $('#id').val());
		formData.append('tipo', 'comisionista');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#pdfcomisionista').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfcomisionista').after(estasi);
					}
					else
						alert("Error en la subida.");

				}
			}); ajax.abort();
		}

	});

 $(document).on("click", "#mostrarpdfcomisionista", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_comisionista='+$('#id').val()+'&tipo=comisionista',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
				// alert(data);
				else
					window.open(data);
				// alert(data);
			}
		}); ajax.abort();

 });

 $(document).on("click","#subirpdfmetodologia", function(event) {

 	event.preventDefault();
 	var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#pdfmetodologia').get(0).files[0]);
		formData.append('id_accion', $('#id').val());
		formData.append('tipo', 'metodologia');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


		if ( $('#pdfmetodologia').get(0).files[0] == undefined ) {

			alert("Selecciona un archivo.");

		} else {

			$.ajax({
				cache: false,
				url: 'functions/subida_pdf.php',
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				success: function (data) {

					if ( data != 'error' ) {
						alert("Fichero subido correctamente.");
						$('#mostrarpdfmetodologia').after(estasi);
					}
					else
						alert("Error en la subida.");

				}
			}); ajax.abort();
		}

	});

 $(document).on("click", "#mostrarpdfmetodologia", function(event) {

 	event.preventDefault();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/mostrar_pdf.php',
 		data: 'id_accion='+$('#id').val()+'&tipo=metodologia',
 		success: function(data)
 		{
 			if ( data == 'no' )
 				alert ("No hay PDF subido.");
				// alert(data);
				else
					window.open(data);
				// alert(data);
			}
		}); ajax.abort();

 });


 $(document).on("click","#login", function(event) {

 	event.preventDefault();
 	var user = $('#user').val();
 	var pass = $('#pass').val();
		 //alert(user+' '+pass);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/login.php',
			data: 'user='+user+'&pass='+pass,
			success: function(data)
			{
				if (data == 'error')
					
					alert("Usuario y/o Contraseña incorrectos.");
				else 
					window.location.href = 'http://gestion.eduka-te.com/app/index.php?dashboard';
				
				
			}
		}); ajax.abort();


	});




 $(document).on("click", "#observacionesempresa", function(event) {
 	if ( $('#observaciones').is(':visible') )
 		$('#observaciones').css('display','none');
 	else
 		$('#observaciones').css('display','block');
 });

 $(document).on("keydown","#form-modal",function (e){
        if(e.keyCode == 13){//Enter key pressed
            $('#busqueda').click();//Trigger search button click event
        }
    });


 $(document).on("click", "#busqueda", function(event){

		//event.preventDefault();
		if ( $('#matricula').val() != undefined && $('#matricula').val() == '1' )
			var mat = '1';

		if ( sec[1] == 'presencial' || sec[1] == 'presencial#' )
			mat = '2';
		else if (sec[1] == 'presencial_doc' || sec[1] == 'presencial_doc#' || sec[1] == 'presencial_docm' || sec[1] == 'presencial_docm#')
			mat = '3';
		else if (sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#')
			mat = '4';
		else if (sec[1] == 'facturacion' || sec[1] == 'facturacion#')
			mat = '5';
		else if (sec[1] == 'mixto' || sec[1] == 'mixto#')
			mat = '6';
		else if (sec[1] == 'tutorias' || sec[1] == 'tutorias#')
			mat = '7';
		else if (sec[1] == 'registro-incendios' || sec[1] == 'registro-incendios#')
			mat = '8';
		else if (sec[1] == 'inspeccion' || sec[1] == 'inspeccion#')
			mat = '9';
		else if (sec[1] == 'inspeccionpm' || sec[1] == 'inspeccionpm#')
			mat = '10';
		else if (sec[1] == 'form_matricula_doc' || sec[1] == 'form_matricula_doc#' || sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_fin#' )
			mat = '11';
		else if ( sec[1] == 'form_matricula_ini' || sec[1] == 'form_matricula_ini#' )
			mat = '12';

		if ( sec[1] == 'tutorias' ) {
			var naccion = $('.modal-dialog input#numeroaccion').val();
    		// alert(naccion);
    		if (naccion != "")
    			$('input#numeroaccion').data("naccion", naccion);
    	}

    	var tabla = $("#tabla").val();
    	var values = $('#form-modal').find("input[type='hidden'], :input:not(:hidden)").serialize();

    	$.ajax({
    		cache: false,
    		type: 'POST',
    		url: 'functions/busqueda.php',
    		data: values+'&tabla='+tabla+'&mat='+mat,
    		success: function(dato)
    		{
    			$('.mostrartabla').html(dato);
    		}
    	});
    });

 $(document).on("click", "#seleccionaralumno", function(event){

 	event.preventDefault();
 	var tabla = $("#tabla").val();
 	var button = $(this);
 	var parentTd = button.parent('td');
 	var parentTr = parentTd.parent('tr');
 	var iden = parentTr.find('td#id').html();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/funciones.php',
 		data: 'id='+iden+'&cierra=1'+'&tabla='+tabla,
 		dataType: 'json',
 		success: function(data)
 		{
 			$('#mostrardatos').modal('hide');
 			$('.formularioalumno').get(0).reset();
 			if (data[0].afectadosterrorismo === '1') $('#afectadosterrorismo').prop('checked', true);
 			else $('#afectadosterrorismo').prop('checked', false);
 			if (data[0].afectadosviolenciagenero === '1') $('#afectadosviolenciagenero').prop('checked', true);
 			else $('#afectadosviolenciagenero').prop('checked', false);
 			if (data[0].discapacidad === '1') $('#discapacidad').prop('checked', true);
 			else $('#discapacidad').prop('checked', false);
 			$('#id').val(data[0].id);
 			$('#nombre').val(data[0].nombre);
 			$('#apellido').val(data[0].apellido);
 			$('#apellido2').val(data[0].apellido2);
 			$('#email').val(data[0].email);
 			$('#documento').val(data[0].documento);
 			$('#telefono').val(data[0].telefono);
 			$('#tlftrabajo').val(data[0].tlftrabajo);
 			$('#categoriaprofesional').val(data[0].categoriaprofesional);
 			$('#nivelestudios').val(data[0].nivelestudios);
 			$('#grupocotizacion').val(data[0].grupocotizacion);
 			$('#niss').val(data[0].niss);
 			$('#direccion').val(data[0].direccion);
 			$('#codigopostal').val(data[0].codigopostal);
 			$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
 			$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
 			$('#sexo').val(data[0].sexo);
 			$('#tipodocumento').val(data[0].tipodocumento);
 			$('#fechanac').val(data[0].fechanac);
 			$('#id_dino').val(data[0].id_dino);
 		}
 	});
 });


 $(document).on("click", "#buscaractividad", function(event){

 	event.preventDefault();
 	var clave = $("#actividad").val();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/actividades.php',
 		data: 'clave='+clave,
 		success: function(data)
 		{
 			$('#actividades').modal('show');
 			$('.listactividades').show().html(data);
 		}
 	});
 });

$(document).on("click", "#buscaraccion", function(event){

 	event.preventDefault();
 	var clave = $("#accion_formativa").val();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/acciones.php',
 		data: 'clave='+clave,
 		success: function(data)
 		{
 			$('#acciones').modal('show');
 			$('.listacciones').show().html(data);
 		}
 	});
 });
 $(document).on("click", "#anadiractividad", function(event){
 	event.preventDefault();

 	var button = $(this);
 	var parentTd = button.parent('td');
 	var parentTr = parentTd.parent('tr');
 	var actividad = parentTr.find('td#codigo').html();
 	$('#actividades').modal('hide');
 	$('#actividad').val(actividad);

 });

 $(document).on("click", "#xmlaccion", function(event){
 	//window.open('http://gestion.eduka-te.com/app/export/xml_accion.php?id_accion='+$('#id').val(), '_blank');
	 var id_accion = $('#id').val();
	 window.location = 'export/xml_accion.php?id_accion='+id_accion;
 });

 $(document).on("click","#xmliniciopre", function (event) {

	var id_matricula = $('#id_matricula').val();
	window.location = 'export/xml_presencial_inicio.php?id_matricula='+id_matricula;

});

 $(document).on("click", "#seleccionarempresa", function(event){
 	event.preventDefault();
 	var tabla = $("#tabla").val();
 	var button = $(this);
 	var parentTd = button.parent('td');
 	var parentTr = parentTd.parent('tr');
 	var id_empresa = parentTr.find('td#id').html();

 	$.ajax({
 		cache: false,
 		type: 'POST',
 		url: 'functions/funciones.php',
 		data: 'id='+id_empresa+'&cierra=1'+'&tabla='+tabla,
 		dataType: 'json',
 		success: function(data)
 		{

 			var id_emp = data[0].id;
	        	// var autogestion = ["9740","6348","15","5630"];
	        	// alert($('#userapp').val());
	        	if ( $('#userapp').val() != 'amanda' && $('#userapp').val() != 'root' ) {
	        		$('#asignado').attr('disabled', 'disabled');
	        		$('#dispuesto_acciones').attr('disabled', 'disabled');
	        		$('#dispuesto_pif').attr('disabled', 'disabled');
	        		$('#disponible').attr('disabled', 'disabled');
	        		$('#actualizado_a').attr('disabled', 'disabled');
	        	} else {
	        		// alert("autog")
	        		$('#asignado').removeAttr('disabled');
	        		$('#dispuesto_acciones').removeAttr('disabled');
	        		$('#dispuesto_pif').removeAttr('disabled');
	        		$('#disponible').removeAttr('disabled');
	        		$('#actualizado_a').removeAttr('disabled');
	        	}

	        	$('#mostrardatos').modal('hide');
	        	$('.formularioempresa').get(0).reset();
	        	$('#estado_revision').val(data[0].estado_revision);
	        	$('#fecha_revision').val(data[0].fecha_revision);
	        	$('#categoria').val(data[0].categoria);
	        	$('#grupo').val(data[0].grupo);
	            // alert(data[len].nombre);
	            // $('#comisionistatxt').val(data[len].nombre);
	            // $('#comisionista').val(data[len].id);
	            $('#iban').val(data[0].iban);
	            $('#iban-ant').val(data[0].iban);
	            $('#domiciliofiscal').val(data[0].domiciliofiscal);
	            $('#comercial').val(data[0].comercial);
	            $('#formapago').val(data[0].formapago);
	            $('#id').val(data[0].id);
	            $('#nombrecomercial').val(data[0].nombrecomercial);
	            $('#razonsocial').val(data[0].razonsocial);
	            if ( $('#userapp').val() != 'ytejera' && $('#userapp').val() != 'amanda' && $('#userapp').val() != 'root' )
	            	$('#razonsocial').attr('readonly', true);

	            $('#telefono').val(data[0].telefono);
	            $('#email').val(data[0].email);
	            $('#email_facturas').val(data[0].email_facturas);
	            $('#porcentajecof').val(data[0].porcentajecof);
	            $('#agente').val(data[0].agente);
	            $('#cif').val(data[0].cif);
	            $('#domiciliosocial').val(data[0].domiciliosocial);
	            $('#representacionlegal').val(data[0].representacionlegal);
	            $('#firmanexo').val(data[0].firmanexo);
	            $('#vencimiento').val(data[0].vencimiento);


	            if ( data[0].mailing == "1" )
	            	$('#mailing').prop('checked', true);

	            if (data[0].empresacreada === '1') {
	            	$('#empresacreada').prop('checked', true);
	            	$('#fechacreacion').prop('disabled',false).val(data[0].fechacreacion);
	            } else $('#empresacreada').prop('checked', false);


	            $('#subirinformes').css('display','inline-block');
	            $('#informe').css('display','inline-block');
	            $('#informe').attr('name',data[0].id);
	            $('#convenio').val(data[0].convenio);
	            $('#plantillamedia').val(data[0].plantillamedia);
	            $('#credito').val(data[0].credito);
	            $('#tipocredito').val(data[0].tipocredito);
	            $('#actividad').val(data[0].actividad);
	            $('#importecuenta640').val(data[0].importecuenta640);
	            $('#importecuenta642').val(data[0].importecuenta642);
	            $('#numhorasanuales').val(data[0].numhorasanuales);
	            $('#fechanac').val(data[0].fechanac);



	            $('#codigopostal').val(data[0].codigopostal);
	            $('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
	            $('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');


	            $('#asignado').val(data[0].asignado);
	            $('#dispuesto_acciones').val(data[0].dispuesto_acciones);
	            $('#dispuesto_pif').val(data[0].dispuesto_pif);
	            $('#disponible').val(data[0].disponible);
	            $('#actualizado_a').val(data[0].actualizado_a);

	            if (data[0].observaciones != '') {
	            	$('#observaciones').css('display','block');
	            	$('textarea#observaciones').val(data[0].observaciones);
	            } else
	            $('#observaciones').css('display','none');

	            $('#comisionistatxt').val(data[1].nombre);
	            $('#comisionista').val(data[1].id);


	            $('select#cuadrocuentas option').each (function() {
	            	$('select#cuadrocuentas option').remove();
	            });
	            $('#hcuentacotizacion').val('');
				//

				var datos = [];
				// alert(data.length);
				for (var i=0; i < data['numerocuenta'].length; i++) {
					datos[i] = data['numerocuenta'][i].numerocuenta;
	            	// alert(data[i].numerocuenta);
	            	// alert(i);
	            	// if ( i == data.length-1 ) {
	            	// } else
	            	$('select#cuadrocuentas').append('<option value='+data['numerocuenta'][i].numerocuenta+'>'+data['numerocuenta'][i].numerocuenta+'</option>');
	            }
	            $('#hcuentacotizacion').val(datos);


	        }
	    });
});


	$(document).on("click", "#seleccionaracreedor", function(event){
		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_empresa = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_empresa+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
				$('.formularioacreedores').get(0).reset();
				$('#iban').val(data[0].iban);
				$('#domiciliofiscal').val(data[0].domiciliofiscal);
				$('#comercial').val(data[0].comercial);
				$('#formapago').val(data[0].formapago);
				$('#id').val(data[0].id);
				$('#nombrecomercial').val(data[0].nombrecomercial);
				$('#razonsocial').val(data[0].razonsocial);
				$('#telefono').val(data[0].telefono);
				$('#email').val(data[0].email);
				$('#email_facturas').val(data[0].email_facturas);
				$('#fax').val(data[0].fax);
				$('#cif').val(data[0].cif);
				$('#domiciliosocial').val(data[0].domiciliosocial);
				$('#vencimiento').val(data[0].vencimiento);
				$('#tipoacreedor').val(data[0].tipoacreedor);
				$('#cuentacontable').val(data[0].cuentacontable);
				$('#nombrecontacto').val(data[0].nombrecontacto);
				$('#cargocontacto').val(data[0].cargocontacto);
				$('#tlfcontacto').val(data[0].tlfcontacto);
				$('#emailcontacto').val(data[0].emailcontacto);


				$('#codigopostal').val(data[0].codigopostal);
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');

				if (data[0].observaciones != '') {
					$('#observaciones').css('display','block');
					$('textarea#observaciones').val(data[0].observaciones);
				} else
				$('#observaciones').css('display','none');

			}
		});
	});


	$(document).on("click", "#seleccionaraccion", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_accion = parentTr.find('td#id').html();


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_accion+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				if ( sec[1] != 'form_control-facturacion-acciones' ) {
					$('#mostrardatos').modal('hide');
					$('.formularioaccion').get(0).reset();
					$('#id').val(data[0].id);
					$('#numeroaccion').val(data[0].numeroaccion);

					$('#denominacion').val(data[0].denominacion);
					$('#palabraclave').val(data[0].id_grupo);
					$('#modalidad').val(data[0].modalidad);
					$('#tipo').val(data[0].tipo);
					$('#nivel').val(data[0].nivel);
					$('#diplomatipo').val(data[0].diploma);
					if (data[0].modalidad == 'A Distancia' || data[0].modalidad == 'Teleformación') {
						$('#horaspresenciales').prop('disabled',true);
						$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
						$('#mixta').prop('disabled',true);
						$('#url').addClass('required');
					} else if (data[0].modalidad == 'Presencial') {
						$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
						$('#horasdistancia').prop('disabled',true);
						$('#mixta').prop('disabled',true);
						$('#url').removeClass('required');
					} else if (data[0].modalidad == 'Mixta') {
						$('#mixta').prop('disabled',false).val(data[0].mixta);
						$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
						$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
						$('#mixta').attr('required',true);
						$('#url').addClass('required');
					}
					$('#horastotales').val(data[0].horastotales);
					$('#especialidad').val(data[0].especialidad);
					$('#objetivos').val(data[0].objetivos);
					$('#contenido').val(data[0].contenido);
					$('#url').val(data[0].url);
					$('#proveedor').val(data[0].proveedor);

					if ( $('#url').val() == 'Externa' ) {
						$('.plataforma_externa').css('display','block');
						$('#url_externa').val(data[0].url_externa);
						$('#usuario_externa').val(data[0].usuario_externa);
						$('#pass_externa').val(data[0].pass_externa);
						$('#nombrecentro').val(data[0].nombrecentro);
						$('#cifcentro').val(data[0].cifcentro);
						$('#direccioncentro').val(data[0].direccioncentro);
						$('#telefonocentro').val(data[0].telefonocentro);
						$('#poblacioncentro').val(data[0].poblacioncentro);
						$('#cpcentro').val(data[0].cpcentro);
					} else {
						$('.plataforma_externa').css('display','none');
					}

					$('#courseid').val(data[0].courseid);
					$('#nsystem').val(data[0].nsystem);
					$('#nacciondino').val(data[0].nacciondino);
					$('#denominacionsystem').val(data[0].denominacionsystem);
					$('#xmlaccion').css('display','inline-block');

					if ( data.existemetodologia == 1 )
						$('.glyphicon-ok-circle').css('color','green');
					else
						$('.glyphicon-ok-circle').css('color','red');

					$('#tipoformacionac').val(data[0].tipoformacionac);

					$('#denominacionsystem').val(data[0].denominacionsystem);
					$('#incendios').val(data[0].incendios);
					$('#nivel_incendios').val(data[0].nivel_incendios);

		            // if ( data[0].numeroaccion < 1000 )
		            // 	$('#area_profesional').css('display', 'block');
		            // else
		            // 	$('#area_profesional').css('display', 'none');

		            $('#area_profesional').val(data[0].area_profesional);

		            if ( data[0].numeroaccion < 1000 )
		            	$('#area_profesional').attr('required', 'required');
		            else
		            	$('#area_profesional').removeAttr('required');

		        } else {
	            	// $('#mostrardatos').modal('hide');
	            	// $('#datosaccion').css('display','block');

		            // $('.formularioaccion').get(0).reset();

		            // $('#id').val(data[0].id);
		            // $('#numeroaccion').val(data[0].numeroaccion);
		            // $('#denominacion').val(data[0].denominacion);

		            // cargarFacturasAcciones();
		        }


		    }
		});
});

	$(document).on("click", "#seleccionarmat", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_matricula = parentTr.find('td#id').html();
		var str = parentTr.find('td#af').html();
    	//Eliminamos la negrita del número de acción
    	str = str.replace('<strong>', '');
    	var numeroaccion = str.replace('</strong>', '');
    	var denominacion = parentTr.find('td#denominacion').html();
    	var fechainicio = parentTr.find('td#fechaini').html().replace('<br>', '') ;
    	var fechafin = parentTr.find('td#fechafin').html().replace('<br>', '');

    	$.ajax({
    		cache: false,
    		type: 'POST',
    		url: 'functions/funciones.php',
    		data: 'id='+id_matricula+'&cierra=1'+'&tabla='+tabla,
    		dataType: 'json',
    		success: function(data)
    		{

    			$('#mostrardatos').modal('hide');
    			$('#datosaccion').css('display','block');

    			$('.formularioaccion').get(0).reset();

    			$('#id').val(data[0].id);
    			$('#numeroaccion').val(numeroaccion);
    			$('#denominacion').val(denominacion);
    			$('#fechainicio').val(fechainicio);
    			$('#fechafin').val(fechafin);

    			cargarFacturasAcciones();

    		}
    	});

    });

	function cargarFacturasAcciones(){

		var id_matricula = $('#id').val();

		// alert(id_accion);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&cargarFacturasAcciones=1',
			success: function(data)
			{
				if (data){
					$('#listado-facturas').css('display','block');
					$('#listado-facturas').html(data);
				}

			}
    	}); //ajax.abort();
	}

	$(document).on("click", "#seleccionardocente", function(event){

		event.preventDefault();
		var mat = $(this).attr('mat');
		// console.log(mat);
		var tabla = $("#tabla").val();
		if ( mat != undefined && mat != "" )
			tabla = 'docentes';
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_docente = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{


				$('#mostrardatos').modal('hide');
				if ( mat != undefined && mat != "" ) {

					$('div.activo #docente').val(data[0].nombre+' '+data[0].apellido);
					$('div.activo #id_docente').val(data[0].id);

				} else {


					$('.formulariodocente').get(0).reset();
					$('#id').val(data[0].id);
					$('#dmodalidad').val(data[0].dmodalidad);
					$('#situacionlaboral').val(data[0].situacionlaboral);
					$('#acuerdopago').val(data[0].acuerdopago);
					$('#niss').val(data[0].niss);
					$('#numcuenta').val(data[0].numcuenta);
					$('#preciohora').val(data[0].preciohora);
					$('#precioalumno').val(data[0].precioalumno);
					$('#titulacion').val(data[0].titulacion);
					$('#nombre').val(data[0].nombre);
					$('#apellido').val(data[0].apellido);
					$('#apellido2').val(data[0].apellido2);
					$('#documento').val(data[0].documento);

					var tipodoc = data[0].tipodoc;

					if (tipodoc == null)
						$('#tipodoc').val("Persona");
					else
						$('#tipodoc').val(tipodoc);

					if ( tipodoc == "Empresa" ) {

						$('.esempresa').css('display','block');
						$('#nombredocente').val(data[0].nombredocente);
						$('#apellidodocente').val(data[0].apellidodocente);
						$('#apellido2docente').val(data[0].apellido2docente);
						$('#documentodocente').val(data[0].documentodocente);
						$('#telefonodocente').val(data[0].telefonodocente);

					} else {
						$('.esempresa').css('display','none');
					}

					$('#email').val(data[0].email);
					$('#email2').val(data[0].email2);
					$('#telefono').val(data[0].telefono);
					$('#telefono2').val(data[0].telefono2);
					$('#porcentajediscapacidad').val(data[0].porcentajediscapacidad);
					$('#direccion').val(data[0].direccion);
					$('#codigopostal').val(data[0].codigopostal);
					$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
					$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
					if (data[0].docenteinterno === '1') $('#docenteinterno').prop('checked', true);
					else $('#docenteinterno').prop('checked', false);
					multiselect_deselectAll($('#especialidades'));
					for (var i=1; i < data.length; i++) {
						$('#especialidades').multiselect('select', data[i].id_especialidad);
					}
	            $('#modifespecialidad').val('0'); // reestablecer el modificar a 0
	            $('#subirdocudocente').css('display','inline-block');
	            $('#subirdocuentidad').css('display','inline-block');

	            $('#crearuserdocente').css('display','inline-block');
	            $('#duplicardocente').css('display','inline-block');
	        }
	    }
	});
	});


	$('#tiposol').change(function() {

		// alert("hjola");
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

	    // var currentDate = dameFechaPHP();

	    if (valueSelected == 'SM') {

	    	$('.bloquemat').css('display','block');
	    	$('input#tiposol').val('SM');
	    	$('.bloqueprop').css('display','none');
	    	$('.bloquecred').css('display','none');
			// $('#objetivos').css('display','none');

		} else if ( valueSelected == 'SP' ) {

			$('.bloquemat').css('display','none');
			$('.bloqueprop').css('display','block');
			$('input#tiposol').val('SP');
	    	// $('#objetivos').css('display','block');
	    	// $('.input-group-addon').text('SP');
	    	$('.bloquecred').css('display','none');

	    } else if ( valueSelected == 'SC' ){

	    	$('.bloquemat').css('display','none');
	    	$('.bloqueprop').css('display','none');
	    	$('.bloquecred').css('display','block');
	    	$('input#tiposol').val('SC');
			// $('#objetivos').css('display','none');
			// $('.input-group-addon').text('SC');

		}


	});


	$('#tiposolgastos').change(function() {

		// alert("hjola");
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		if ( valueSelected == "SA" )
			var tiposol = '.bloquealojamiento';
		else if ( valueSelected == "SV" )
			var tiposol = '.bloqueviaje';
		else if ( valueSelected == "SF" )
			var tiposol = '.bloquefungible';
		else if ( valueSelected == "SN" )
			var tiposol = '.bloquenotagastos';

	    // console.log(tiposol);

	    $('div[class^="bloque"]:not('+tiposol+')').removeClass('activo').css('display', 'none');
	    $(tiposol).css('display','block').addClass('activo');


	});


	$('.formularioempresa #estado_revision').change(function() {

		// alert("hjola");
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		var currentDate = dameFechaPHP();

		if (valueSelected == 'Revisada')
			$('input#fecha_revision').val(currentDate);
		else {
			$('input#fecha_revision').val('');
		}


	});

	$('#abierto').change(function() {
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();
	    // alert(valueSelected);
	    if (valueSelected == 'Si')
	    	$('#fechaini,#fechafin').attr('readonly', true);
	    else
	    	$('#fechaini,#fechafin').attr('readonly', false);
	});

	$('#tipocomisionista').change(function() {
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();
	    // alert(valueSelected);
	    if (valueSelected == 'Si')
	    	$('#presupuesto').css('display', 'inline-block');
	    else
	    	$('#cuadroasesor').css('display', 'none');
	});

	$('#tablaprecios').change(function() {
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();
	    // alert(valueSelected);
	    if (valueSelected == 'No')
	    	$('#presupuesto').attr('disabled', false);
	    else
	    	$('#presupuesto').attr('disabled', true);
	});

	$(document).on("change", "#tipodoc", function(event){

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		if (valueSelected == 'Empresa') {
			$('.esempresa').css('display','block');
			$('.proveedores').css('display','block');
			$("label[for='nombre']").text('Razón Social:');
			$("label[for='documento']").text('CIF:').removeClass('required');
			$('#apellido,#apellido2').attr('readonly', true);
		} else {
			$('.esempresa').css('display','none');
			$('.proveedores').css('display','none');
			$("label[for='nombre']").text('Nombre:');
			$("label[for='documento']").text('Nº Documento:');
			$('#nombre, #documento').attr('readonly', false);
			$('#apellido,#apellido2').attr('readonly', false);
		}


	});

	$(document).on("change", "#proveedores", function(event){

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		$('#nombre').attr('readonly', true).val(optionSelected.attr('nombre'));
		$('#documento').attr('readonly', true).val(optionSelected.attr('documento'));

	});

	$(document).on("click", "#seleccionarcomisionista", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var id_docente = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
				$('.formulariocomisionistas').get(0).reset();
				$('#id').val(data[0].id);
				$('#tipocomisionista').val(data[0].tipocomisionista);
				$('#nombre').val(data[0].nombre);
				$('#telefono').val(data[0].telefono);
				$('#fax').val(data[0].fax);
				$('#nifcif').val(data[0].nifcif);
				$('#domiciliofiscal').val(data[0].domiciliofiscal);
				$('#codigopostal').val(data[0].codigopostal);
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
				$('#email').val(data[0].email);
				$('#contacto').val(data[0].contacto);
				$('#porcentajeformacion').val(data[0].porcentajeformacion);
				$('#porcentajecontrato').val(data[0].porcentajecontrato);
				$('#porcentajeotro').val(data[0].porcentajeotro);
				$('#importeformacion').val(data[0].importeformacion);
				$('#importecontrato').val(data[0].importecontrato);
				$('#importeotro').val(data[0].importeotro);
				$('#otro').val(data[0].otro);
				$('#observaciones').val(data[0].observaciones);
				$('#formapagocontrato').val(data[0].formapagocontrato);
				$('#formapagoformacion').val(data[0].formapagoformacion);
				$('#formapagootro').val(data[0].formapagootro);
				$('#vencimientocontrato').val(data[0].vencimientocontrato);
				$('#vencimientoformacion').val(data[0].vencimientoformacion);
				$('#vencimientootro').val(data[0].vencimientootro);
				$('#iban').val(data[0].iban);


				$('#comercial').val(data[0].comercial);
				if ( data[0].asesor != "" || data[0].asesor != undefined ) {
					$('#cuadroasesor').css('display','inline-block');
					$('#asesor').val(data[0].asesor);
				} else
				$('#cuadroasesor').css('display','none');

				if ( data.existecomisionista == 1 )
					$('.glyphicon-ok-circle').css('color','green');
				else
					$('.glyphicon-ok-circle').css('color','red');
			}
		});
	});


	$(document).on("click", "#seleccionarcomercial", function(event){

		event.preventDefault();
		var tabla = $("#tabla").val();
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var comercial = parentTr.find('td#id').html();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+comercial+'&cierra=1'+'&tabla='+tabla,
			dataType: 'json',
			success: function(data)
			{
				$('#mostrardatos').modal('hide');
				$('.formulariocomercial').get(0).reset();
				$('#id').val(data[0].id);
				$('#nombre').val(data[0].nombre);
				$('#apellido').val(data[0].apellido);
				$('#apellido2').val(data[0].apellido2);
				$('#telefono').val(data[0].telefono);
				$('#documento').val(data[0].documento);
				$('#direccion').val(data[0].direccion);
				$('#codigopostal').val(data[0].codigopostal);
				$('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
				$('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
				$('#email').val(data[0].email);

			}
		});
	});

	$("button[data-toggle=modal]").on('click', function() {

		event.preventDefault();
		var clave = $("#palabraclave").val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/gruposacciones.php',
			data: 'clave='+clave,
			success: function(data)
			{
				$('#myModal').modal('show');
				$('.listagrupos').show().html(data);
			}
		});
	});

	$(document).on("click", "#anadirgrupo", function(event){
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var grupo = parentTr.find('td#codigo').html();
		$('#myModal').modal('hide');
		$('#palabraclave').val(grupo);
	});

	$('#tipo').change(function () {
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();
		if (valueSelected == 'Genérica')
			$('#nivel').val('Básica');
		if (valueSelected == 'Específica')
			$('#nivel').val('Superior');
	});


	$('select#url').change(function () {
		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		if (valueSelected == 'http://www.eduka-te.com/ecampus/login/index.php')
			$('select#proveedor').prop('required', true);
		else
			$('select#proveedor').removeAttr('required');
	});

	$('#fecha_firma').change(function () {

		$('#estado_propuesta').val('Aceptada');

	});


	$('.formularioaccion #modalidad').change(function () {
 		// alert("s");
 		var optionSelected = $(this).find("option:selected");
 		var valueSelected  = optionSelected.val();
 		if (valueSelected == 'Teleformación' || valueSelected == 'A Distancia') {
 			$('#horaspresenciales').prop('disabled',true).val('');
 			$('#horasdistancia').prop('disabled',false);
 			$('#mixta').prop('disabled',true);
 			$('#url').addClass('required', true);
 		} else if (valueSelected == 'Presencial') {
 			$('#horaspresenciales').prop('disabled',false);
 			$('#horasdistancia').prop('disabled',true).val('');
 			$('#mixta').prop('disabled',true);
 			$('#url').removeClass('required');
 		} else {
 			$('#mixta').prop('disabled',false);
 			$('#horaspresenciales').prop('disabled',false);
 			$('#horasdistancia').prop('disabled',false);
 			$('#url').addClass('required', true);
 		}
 	});

	$('.bloqueprop #modalidad, .bloquemat #modalidad').change(function () {
		var optionSelected = $(this).find("option:selected");
 		// console.log(optionSelected);
 		var valueSelected  = optionSelected.val();
 		if (valueSelected == 'Teleformación' || valueSelected == 'A Distancia') {
 			$('.bloqueprop #horaspresenciales, .bloquemat #horaspresenciales').prop('disabled',true).val('');
 			$('.bloqueprop #horasdistancia, .bloquemat #horasdistancia').prop('disabled',false);
 			$('.bloqueprop #mixta, .bloquemat #mixta').prop('disabled',true);
 			$('.bloqueprop #nombrecentro, .bloquemat #nombrecentro').prop('disabled', true);
 			$('.bloqueprop #requisitosbonificacion').val('Para ello, el alumno debe permanecer conectado mínimo el 25% de la duración total del curso, visualizar mínimo el 75% del temario y  obtener una puntuación igual o superior a 50% en las pruebas de evaluación.');
 		} else if (valueSelected == 'Presencial') {
 			$('.bloqueprop #horaspresenciales, .bloquemat #horaspresenciales').prop('disabled',false);
 			$('.bloqueprop #horasdistancia, .bloquemat #horasdistancia').prop('disabled',true).val('');
 			$('.bloqueprop #mixta, .bloquemat #mixta').prop('disabled',true);
 			$('.bloqueprop #nombrecentro, .bloquemat #nombrecentro').prop('disabled', false);
 			$('.bloqueprop #requisitosbonificacion').val('');
 		} else {
 			$('.bloqueprop #mixta, .bloquemat #mixta').prop('disabled',false);
 			$('.bloqueprop #horaspresenciales, .bloquemat #horaspresenciales').prop('disabled',false);
 			$('.bloqueprop #horasdistancia, .bloquemat #horasdistancia').prop('disabled',false);
 			$('.bloqueprop #nombrecentro, .bloquemat #nombrecentro').prop('disabled', true);
 			$('.bloqueprop #requisitosbonificacion').val('');
 		}
 	});

	$('#horaspresenciales').keyup(function () {
		var hd;
		var hp;
		hd = parseFloat($('#horasdistancia').val());
		hp = parseFloat($('#horaspresenciales').val());
		if (isNaN(hd))
			hd = 0;
		if (isNaN(hp))
			hp = 0;
		total = hd + hp;
		$('#horastotales').val(total);
		if (total >= 6) $('#tipoformacionikea').val('Bonificable');
		else $('#tipoformacionikea').val('Privada');
	});

	$('#horasdistancia').keyup(function () {
		var hd;
		var hp;
		hd = parseFloat($('#horasdistancia').val());
		hp = parseFloat($('#horaspresenciales').val());
		if (isNaN(hd))
			hd = 0;
		if (isNaN(hp))
			hp = 0;
		total = hd + hp;
		$('#horastotales').val(total);
		if (total >= 6) $('#tipoformacionikea').val('Bonificable');
		else $('#tipoformacionikea').val('Privada');
	});

	$('#denominacion').keyup(function () {
		$('#palabraclave').val($(this).val());
	});

	$(document).on("click", "#agregarcontactos", function(event){


		var id_empresa = $('#id').val();

		$('#contactos').modal('show');
		$('.modal-dialog').css('width','900px');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_emp='+id_empresa+'&contactos=1',
			success: function(data)
			{
				$('.listacontactos').html('');
				$('.listacontactos').remove();
				$('.contactos').html('');
				$('.contactos').remove();
				$('.contacto').after(data);
			}
		});

	});

	$(document).on('click', "#anadircontacto" , function() {

 		//$('a#seleccionarcontacto').unbind("click");
 		$('a#seleccionarcontacto').each(function () {
 			$(this).remove();
 		});
 		$('#insertarcontacto').val('1');
 		var contacto = '<div class="contactos" style="overflow:auto; margin-top:15px;"><div class="col-md-4"><div class="form-group"> <label class="control-label" for="nombre">Nombre:</label> <input type="text" id="nombre" name="nombre" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="apellido">Apellido:</label> <input type="text" id="apellido" name="apellido" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="apellido2">2º Apellido:</label> <input type="text" id="apellido2" name="apellido2" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="telefono">Teléfono:</label> <input type="text" id="telefonoc" name="telefono" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="email">Email:</label> <input type="text" id="emailc" name="email" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="cargo">Cargo:</label> <input type="text" id="cargo" name="cargo" class="required form-control" /></div></div></div>';
 		$('.contacto').after(contacto);

 	});

	$(document).on('click', "#anadeviaje" , function() {

		if ( $('#countlineas').val() != "" && $('#countlineas').val() != undefined ) {
			z = eval($('#countlineas').val())+1;
			$('#countlineas').val(z);
		}
		else
			z++;

		$('#anadeviajeflag').val(1);

		var input = '<div class="linea_viaje"><div class="col-md-1 col-xs-12"><div class="form-group"><label class="control-label" for="tipoviaje">Medio:</label><select id="tipoviaje'+z+'" name="tipoviaje" class="form-control" ><option value="">Selecciona</option><option value="Avión">Avión</option><option value="Barco">Barco</option><option value="Coche">Coche</option></select></div></div><div class="col-md-3 col-xs-12"> <div class="form-group"> <label class="control-label" for="origen">Origen - Destino:</label> <input type="text" id="origen'+z+'" name="origen" class="form-control"/> </div></div><div class="col-md-2 col-xs-12"> <div class="form-group"> <label class="control-label" for="fechaini">Fecha Inicio:</label> <input type="date" id="fechaini'+z+'" name="fechaini" class="form-control"/> </div></div><div class="col-md-2 col-xs-12"> <div class="form-group"> <label class="control-label" for="fechafin">Fecha Fin:</label> <input type="date" id="fechafin'+z+'" name="fechafin" class="form-control"/> </div></div><div class="col-md-1 col-xs-12"> <div class="form-group"> <label class="control-label" for="idavuelta">Vuelta:</label> <select id="idavuelta'+z+'" name="idavuelta" class="form-control" > <option value="">Selecciona</option> <option value="Si">Si</option> <option value="No">No</option> </select> </div></div><div class="col-md-2 col-xs-12"> <div class="form-group"> <label class="control-label" for="horario">Horario:</label> <input type="text" id="horario'+z+'" name="horario" class="form-control"/> </div></div><div class="col-md-1 col-xs-12"> <div class="form-group"> <label class="control-label" for="importeviaje">Precio:</label> <input type="text" id="importeviaje'+z+'" name="importeviaje" class="form-control"/> </div></div></div>';

		$('.nuevoviaje').prepend(input);

	});

	$(document).on('click', "#guardarcontactos" , function() {

		var guardar = $('#insertarcontacto').val();
		var id_contacto = $('#actualizarcontacto').val();
		var values = $('form#formulariocontacto :input').serialize();
		var id_emp = $('#id').val();

		if (id_emp != undefined && id_emp != 0) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: values+'&actualizarContactos='+id_contacto+'&guardarContactos='+guardar+'&id_contacto='+id_contacto+'&id_emp='+id_emp,
				success: function(data)
				{
					$('.contacto').after(data);
					$('.contactos').remove();
					$('#actualizarcontacto').val('0');
					$('#insertarcontacto').val('0');
					$('#confirmacion').html("Contacto guardado correctamente");
					$('#confirmacion').show(500).delay(2000).hide('slow');
					setTimeout(function(){location.reload();},2200);
				}
			});

		}

		var values = $('form#formulariocontacto :input').serializeArray();
		$('#agregarcontactos').data('contactos',[]);
		$('#agregarcontactos').data('contactos').push(values);


	});

	$(document).on("click", "#guardar_reporte", function(event){

		event.preventDefault();

		// alert("values");
		var values = $('.formularioreporte').find("input[type='hidden'], :input:not(:hidden)").serialize();
		// alert(values);

		if ( $('#id_empresa').val() == "" ) {
			alert("Selecciona una empresa de lista o aÃ±Ã¡dela si no estÃ¡.");
			return false;
		}

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: values+'&guardar_reporte=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert(data);
				else {
					alert("Reporte guardado.");
					// listarReportes();
					setTimeout(function(){location.reload();},2000);
				}
			}
		}); ajax.abort();

	});


 // 	$(document).on("keydown", "#cif", function(event){

 // 	    var regex = new RegExp("^[a-zA-Z0-9]+$");
 //    	var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
 //    	if (!regex.test(key)) {
 //       		event.preventDefault();
 //       		return false;
 //    	}

	// });


	$(document).on("click", "#guardar_mireporte", function(event){

		event.preventDefault();

		// alert("values");
		var values = $('.formularioreporte').find("input[type='hidden'], :input:not(:hidden)").serialize();
		// alert(values);

		if ( $('#descripcion').val() == "" ) {
			alert("Selecciona una empresa de la lista o insertala si no esta.");
			return false;
		}

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: values+'&guardar_mireporte=1',
			success: function(data)
			{
				if ( data.indexOf('error') != -1 )
					alert(data);
				else {
					alert("Reporte guardado.");
					// listarMiReportes();
					setTimeout(function(){location.reload();},500);
				}
			}
		}); ajax.abort();

	});



	$(document).on('click', "#seleccionarcontacto" , function() {

     	// $('#anadircontacto').unbind();
     	$('#anadircontacto').css('display','none');
     	var button = $(this);
     	var parentTd = button.parent('td');
     	var parentTr = parentTd.parent('tr');
     	var id_contacto = parentTr.find('td#id').text();
    	//alert(id_contacto);

    	$('#actualizarcontacto').val(id_contacto);

    	var contacto = '<div class="contactos" style="overflow:auto; margin-top:15px;"><div class="col-md-4"><div class="form-group"> <label class="control-label" for="nombre">Nombre:</label> <input type="text" id="nombre" name="nombre" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="apellido">Apellido:</label> <input type="text" id="apellido" name="apellido" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="apellido2">2º Apellido:</label> <input type="text" id="apellido2" name="apellido2" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="telefono">Teléfono:</label> <input type="text" id="telefonoc" name="telefono" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="email">Email:</label> <input type="text" id="emailc" name="email" class="required form-control" /></div></div><div class="col-md-4"><div class="form-group"> <label class="control-label" for="cargo">Cargo:</label> <input type="text" id="cargo" name="cargo" class="required form-control" /></div></div></div>';
    	$('.contacto').after(contacto);

    	$('#cargo').val( parentTr.find('td#cargo').text() );
    	$('#nombre').val( parentTr.find('td#nombre').text() );
    	$('#apellido').val( parentTr.find('td#apellido').text() );
    	$('#apellido2').val( parentTr.find('td#apellido2').text() );
    	$('#telefonoc').val( parentTr.find('td#telefonoc').text() );
    	$('#emailc').val( parentTr.find('td#emailc').text() );
    });

	$(document).on("click", "#agregarcuentas", function(event){
		$('#cuentascotizacion').modal('show');
	});

	$(document).on("click", "#anadircuenta", function(event){
		event.preventDefault();
		if ($('#cuentacot').val() != "" ) {

			if ( $('#cuentacot').val().length >= 9 && $('#cuentacot').val().length <= 11 ) {

				$('#cuadrocuentas').append('<option value='+$('#cuentacot').val()+'>'+$('#cuentacot').val()+'</option>');
				$('#modifcuentas').val('1');
				$('#cuentacot').val('');

			} else
			alert("Introduce una cuenta de cotización correcta.");
		}

	});

	$(document).on("click", "#eliminarcuenta", function(event){
		$('#cuadrocuentas :selected').empty().remove();
		$('#modifcuentas').val('1');
	});

	$(document).on("click", "#guardarcuentas", function(event){
		var datos = [];
		var cuentas;
		$('#cuadrocuentas option').each (function() {
			datos.push( $(this).val() );
		});
		$('#hcuentacotizacion').val("");
		$('#hcuentacotizacion').val(datos);
		$('#cuentascotizacion').modal('hide');
	});

	$('.formularioalumno').validate({

		submitHandler: function(form) {

			if ( $('#id').val() == "" || $('#id').val() == undefined ) {

				var documento = $('#documento').val();
				var resp;
				var alu;

				$.ajax({
					async : false,
					cache: false,
					type: 'POST',
					dataType: 'json',
					url: 'functions/funciones.php',
					data: 'documento='+documento+'&checkalu=1',
					success: function(data)
					{
						resp = data[0];
						alu = data[1];
					}
				});

				if (resp == 'si') {
					alert("Ya existe un alumno con ese NIF/NIE:\n"+alu);
					return false;
				}

			}

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();
				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
						if (result == '1')
							$('#error').show(500).delay(5000).hide('slow');
						else {
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
			nombre : {
				minlength : 2,
				maxlength : 25,
				required : true
			},
			apellido : {
				minlength : 2,
				maxlength : 25,
				required : true
			},
			documento : {
				minlength : 9,
				maxlength : 9,
				required : true,
				alphanumeric : true,
			},
			fechanac : {
				required : true
			},
			niss : {
				required : true,
				minlength : 12,
				maxlength : 12,
			}
		},
		messages : {
			nombre : {
				required : "Obligatorio",
				minlength : "Introduce al menos 2 carácteres"
			},
			apellido : {
				required : "Obligatorio",
				minlength : "Introduce al menos 2 carácteres"
			},
			documento : {
				required : "Obligatorio",
				minlength : "Introduzca su NIF/NIE correctamente",
				maxlength : "Introduzca su NIF/NIE correctamente"
			},
			fechanac : {
				required : "Obligatorio"
			},
			codigopostal : {
				required : "Obligatorio",
				minlength : "Introduce un CP válido",
				maxlength : "Introduce un CP válido"
			},
			niss : {
				required : "Obligatorio",
				minlength : "Introduce un NISS válido ({0} dígitos)",
				maxlength : "Introduce un NISS válido ({0} dígitos)"
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

	$('.formularioempresa').validate({

		submitHandler: function(form) {


			if ( $('#id').val() == "" || $('#id').val() == undefined ) {

				var cif = $('#cif').val();

				var data = [];
				var resp = "";
				var razonsocial = "";

				$.ajax({
					async : false,
					cache: false,
					type: 'POST',
					dataType: 'json',
					url: 'functions/funciones.php',
					data: 'cif='+cif+'&checkcif=1',
					success: function(data)
					{
						resp = data[0];
						razonsocial = data[1];
					}
				});

				if (resp == 'si') {
					alert("Esa empresa ya existe en la base de datos con ese CIF:\n"+razonsocial);
					return false;
				}

			}

			// if ( $('#representacionlegal').val() == '-' ) {
			// 		alert("Debes rellenar el campo RLT.");
			// 		return false;
			// }

			// var credito = $('#credito').val();
			// if ( credito == "" ) {
			// 	alert("Debes rellenar el campo crédito.");
			// 	return false;
			// }

			// if ( credito.indexOf(".") != -1 ) {
			// 	credito = credito.split(".");

			// 	if (credito[1].length >= 3) {
			// 		alert("Formato de crédito no válido. Ej: 2300.45");
			// 		return false;
			// 	}
			// }

			// var actividad = $('#actividad').val();
			// if ( actividad == "" || actividad.length != 4 ) {
			// 		alert("Escoge una actividad de la lista.");
			// 		return false;
			// }


			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');

				var id_emp = $('#id').val();
				$('#comisionistatxt').attr('disabled', true);

				$.ajax({
					cache: false,
					type: 'POST',
					dataType: 'json',
					url: 'functions/funciones.php',
					data: 'iban='+$('#iban').val()+'&compruebaiban=1',
					success: function(data)
					{
						if ( data['resul'] === true || $('#formapago').val() != "Remesa" ) {
							console.log('IBAN correcto');

							if (id_emp == undefined || id_emp == 0) {


								var values = $('.formularioempresa').find("input[type='hidden'], :input:not(:hidden)").serializeArray();
								var numeroscuenta = $('#hcuentacotizacion').val();
								values.push({"name":"numeroscuenta","value": numeroscuenta});

								if ( $('#agregarcontactos').data('contactos') == undefined ) {
									var contactos = {};
								} else
								var contactos =	$('#agregarcontactos').data('contactos')[0];

								console.log(contactos);
								$.ajax({
									cache: false,
									url: "forms/procesar_forms.php",
									type: "post",
									data: {'values' : values, 'contactos' : contactos },
									success: function(result){
										$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
										if (result == '1')
											$('#error').show(500).delay(5000).hide('slow');
										else {
											$('#confirmacion').show(500).delay(2000).hide('slow');
											setTimeout(function(){location.reload();},2200);

										}
									},
									error:function(){
										alert("failure");
									}
								});

							} else {

								var values = $('.formularioempresa').find("input[type='hidden'], :input:not(:hidden)").serialize();
								var numeroscuenta = $('#hcuentacotizacion').val();
								values = values+'&numeroscuenta='+numeroscuenta;

								$.ajax({
									url: "forms/procesar_forms.php",
									type: "post",
									data: values,
									success: function(result){
										$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
										if (result == '1')
											$('#error').show(500).delay(5000).hide('slow');
										else {
											$('#confirmacion').show(500).delay(2000).hide('slow');
											setTimeout(function(){location.reload();},2200);
										}
									},
									error:function(){
										alert("failure");
									}
								});

							}

						} else {
							console.log('IBAN incorrecto');
							alert('IBAN Incorrecto');
							return false;
						}
					}
				});

			});
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

	$.validator.messages.required = "Obligatorio";

	$('.formularioaccion').validate({

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				// $('select#tipoformacionac').attr('disabled','true');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
						if (result == '1')
							$('#error').show(500).delay(5000).hide('slow');
						else {
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
			numeroaccion : {
				required : true
			},
			denominacion : {
				required : true
			},
			palabraclave : {
				required : true
			},
			modalidad : {
				required : true
			},
			tipo : {
				required : true
			},
			nivel : {
				required : true
			},
			horaspresenciales : {
				required : true
			},
			horasdistancia : {
				required : true
			},
			horastotales : {
				required : true
			},
			objetivos: {
				required : true
			},
			contenido: {
				required : true
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



	$(document).on('change', '#especialidades', function() {
		$('#modifespecialidad').val('1');
	});

	$(document).on('change', 'select[id^=tipogasto]', function() {

		// console.log($(this).val());
		var rand = $(this).attr('id');
		rand = rand.split('tipogasto');
		rand = rand[1];

		// console.log(rand);

		if ( $(this).val() == 'Comercial' ) {
			$('.tipogastocomercial').css('display', 'inline-block');
		} else {
			$('.tipogastocomercial').css('display', 'none');
		}

		if ( $(this).val() == 'Formación' ) {

			var s = '<div id="grupoTipoGastoFormacion" class="col-md-2"><div class="form-group"><label class="control-label" for="gastoformacion">Gasto Formación:</label><select id="gastoformacion'+rand+'" name="gastoformacion" class="form-control"><option value="">Selecciona</option><option value="Alojamiento">Alojamiento</option><option value="Traslado">Traslado</option><option value="Docente">Docente</option><option value="Aula">Aula</option><option value="Fungible">Fungible</option><option value="Dieta">Dieta</option><option value="Otros">Otros</option><option value="Material Didáctico">Material Didáctico</option></select></div></div>';
			$('#grupoTipoGasto'+rand).after(s);

		} else {
			$('#grupoTipoGastoFormacion').remove();
		}



	});

	$('.formulariodocente').validate({

		submitHandler: function(form) {

			if ( $('#tipodoc').val() == "" ) {
				alert("Selecciona el tipo de docente");
				return false;
			}

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');

				$('select#proveedores').attr('disabled', true);

				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();
				var especialidades = $('#especialidades').val();
				values = values+'&especialidades='+especialidades;
				// alert(values);

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);

						if (result.indexOf('error') != -1)
							alert(result);
						else {
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
			email : {
				required : true
			},
			nombre : {
				minlength : 2,
				maxlength : 100,
				required : true
			},
			documento : {
				minlength : 9,
				maxlength : 9,
				required : true,
				alphanumeric:true,
			},
			telefono : {
				minlength : 9,
				maxlength : 9,
				required : true
			},
			codigopostal : {
				required : true,
				minlength : 5,
				maxlength : 5,
			}
		},
		messages : {
			nombre : {
				required : "Obligatorio",
				minlength : "Introduce al menos 2 carácteres"
			},
			documento : {
				required : "Obligatorio",
				minlength : "Introduzca su NIF/NIE correctamente",
				maxlength : "Introduzca su NIF/NIE correctamente"
			},
			telefono : {
				required : "Obligatorio",
				minlength : "Introduzca un nº de teléfono correcto",
				maxlength : "Introduzca un nº de teléfono correcto"
			},
			codigopostal : {
				required : "Obligatorio",
				minlength : "Introduce un CP válido",
				maxlength : "Introduce un CP válido"
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



	$('.formulariocomisionistas').validate({

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();
				// var especialidades = $('#especialidades').val();
				// values = values+'&especialidades='+especialidades;

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
						if (result == '1')
							$('#error').show(500).delay(5000).hide('slow');
						else {
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
			nombre : {
				minlength : 2,
				required : true
			},
			email : {
				minlength : 2,
				required : true
			},
			telefono : {
				minlength : 9,
				maxlength : 9,
				required : true
			},
			nifcif : {
				minlength : 9,
				maxlength : 9,
				required : true,
				alphanumeric:true,
			},
			domiciliofiscal : {
				minlength : 2,
				required : true
			}
		},
		messages : {
			nombre : {
				required : "Obligatorio",
				minlength : "Introduzca al menos 2 carácteres."
			},
			email : {
				required : "Obligatorio",
				minlength : "Introduzca un email válido."
			},
			telefono : {
				required : "Obligatorio",
				minlength : "Introduzca un nº de teléfono correcto.",
				maxlength : "Introduzca un nº de teléfono correcto."
			},
			nifcif : {
				required : "Obligatorio",
				minlength : "Introduzca un DNI/CIF correcto.",
				maxlength : "Introduzca un DNI/CIF correcto."
			},
			domiciliofiscal : {
				required : "Obligatorio",
				minlength : "Introduzca al menos 2 carácteres."
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

	$('.formulariotpc').validate({

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				event.preventDefault();

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();


				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					dataType: "json",
					data: values,
					success: function(result){

			        	// console.log(result);
			        	// $('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			        	if ( result['id'] !== undefined ) {

			        		console.log("ok!");
			        		var id = result['id'];

			        		var docentes = $('#docentestpc').val();
			        		var horario = $('#fechasincluir').data('fechasinc');
			        		// console.log(horario);
			        		// horarios = horario.splice(0,5);
			        		// console.log(horarios);

			        		$.ajax({
			        			cache: false,
			        			type: 'POST',
			        			url: 'functions/funciones.php',
			        			data: { docentes : docentes, horario : horario, id: id, cursos_tpc : 1 },
			        			success: function(data)
			        			{
									// alert(data);
									$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000)
									$('#confirmacion').show(500).delay(2000).hide('slow');
									setTimeout(function(){location.reload();},2200);
								}
							});

			        	} else {

			        		alert(result);

			        	}
			        	// $('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			         //    if (result == '1')
			        	// 	$('#error').show(500).delay(5000).hide('slow');
			        	// else {
			        	// 	$('#confirmacion').show(500).delay(2000).hide('slow');
			        	// 	setTimeout(function(){location.reload();},2200);
			        	// }
			        },
			        error:function(){
			        	alert("failure ");
			        },
			    });
			});
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


	$('.formulariocomercial').validate({

		submitHandler: function(form) {

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
						if (result == '1')
							$('#error').show(500).delay(5000).hide('slow');
						else {
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
			nombre : {
				minlength : 2,
				required : true
			},
			email : {
				minlength : 2,
				required : true
			},
			telefono : {
				minlength : 9,
				maxlength : 9,
				required : true
			},
			documento : {
				minlength : 9,
				maxlength : 9,
				required : true,
				alphanumeric : true,
			}
		},
		messages : {
			nombre : {
				required : "Obligatorio",
				minlength : "Introduzca al menos 2 carácteres."
			},
			email : {
				required : "Obligatorio",
				minlength : "Introduzca un email válido."
			},
			telefono : {
				required : "Obligatorio",
				minlength : "Introduzca un nº de teléfono correcto.",
				maxlength : "Introduzca un nº de teléfono correcto."
			},
			documento : {
				required : "Obligatorio",
				minlength : "Introduzca un DNI/CIF correcto.",
				maxlength : "Introduzca un DNI/CIF correcto."
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

	$('.formularioacreedores').validate({

		submitHandler: function(form) {

			var optionSelected = $('#tipoacreedor').find("option:selected");
			var valueSelected  = optionSelected.val();
			if ( valueSelected == '' ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes seleccionar el tipo de acreedor.");
				return false;
			}

			// var optionSelected = $('#tipoacreedor').find("option:selected");
	  //   	var valueSelected  = optionSelected.val();
			// if ( valueSelected == '' ) {
			// 	$('#alerta-error').modal('show');
			// 	$('.mensaje-error').html("Debes seleccionar el tipo de acreedor.");
			// 	return false;
			// }

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();

				$.ajax({
					cache: false,
					url: "forms/procesar_forms.php",
					type: "post",
					data: values,
					success: function(result){
						$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
						if (result == '1')
							$('#error').show(500).delay(5000).hide('slow');
						else {
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
			razonsocial : {
				minlength : 2,
				required : true
			},
			email : {
				minlength : 2,
				required : true
			}
		},
		messages : {
			razonsocial : {
				required : "Obligatorio",
				minlength : "Introduzca al menos 2 carácteres."
			},
			email : {
				required : "Obligatorio",
				minlength : "Introduzca un email válido."
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

	// function printDivCalendar(divID) {
	//     //Get the HTML of div
	//     var divElements = document.getElementById(divID).innerHTML;
	//     //Get the HTML of whole page
	//     var oldPage = document.body.innerHTML;

	//     //Reset the page's HTML with div's HTML only
	//     document.body.innerHTML =
	//     "<html><head><title></title></head><body>" +
	//     divElements + "</body>";

	//     //Print Page
	//     window.print();

	//     //Restore orignal HTML
	//     // document.body.innerHTML = oldPage;
	// }

	function printDiv(divID) {
	    //Get the HTML of div
	    var divElements = document.getElementById(divID).innerHTML;
	    //Get the HTML of whole page
	    var oldPage = document.body.innerHTML;

	    //Reset the page's HTML with div's HTML only
	    document.body.innerHTML =
	    "<html><head><title></title></head><body>" +
	    divElements + "</body>";

	    //Print Page
	    window.print();

	    //Restore orignal HTML
	    document.body.innerHTML = oldPage;
	}

	$(document).on("click", "#buscarempresa", function(event) {

		event.preventDefault();
		var empresa = $('#razonsocial').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda-seguimiento.php',
			data: 'razonsocial='+empresa+'&buscarempresa=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});

	$(document).on("click", "#buscarempresacomercial", function(event) {

		event.preventDefault();
		var empresa = $('#razonsocial').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda-seguimiento.php',
			data: 'razonsocial='+empresa+'&buscarempresa=2',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.contenido').html(data);
			}

		}); ajax.abort();

	});


	$(document).on("click", "#buscarempresanombre", function(event) {

		event.preventDefault();
		var empresa = $('#nombrecomercial').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/buscarempresanombre.php',
			data: 'nombrecomercial='+empresa,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});


	$(document).on("click", "#buscarempresareporte", function(event) {

		event.preventDefault();
		var empresa = $('#razonsocial').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda-empresa-reporte.php',
			data: 'razonsocial='+empresa,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});

	$(document).on("click", "#buscaraccion", function(event) {

		event.preventDefault();
		var formacion = $('#formacion').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/buscaraccion.php',
			data: 'clave='+formacion,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html("Acciones");
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});

	$(document).on("click", "#buscaraccionikea", function(event) {

		event.preventDefault();
		var formacion = $('#denominacion').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/buscaraccionikea.php',
			data: 'clave='+formacion,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.mostrartitulo').html("Acciones");
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});

	$(document).on("click", "#obscuest", function(event){

		var obs = $(this).attr('obs');
		$('#mostrardatosc').modal('show');
		// $('#mostrardatosc .modal-title').html('Observaciones');
		$('#mostrardatosc .contenido').css('text-align','left').html(obs);
	});

	$(document).on("click", "#incidenciasikea", function(event){

		var obs = $(this).attr('incidencias');
		$('#alerta-error').modal('show');
		$('.modal-title').html('Incidencias');
		$('.mensaje-error').css('text-align','left').html(obs);
	});

	$(document).on("click", "#datosempresarepor", function(event){

		var tlf = $(this).attr('tlf');
		var email = $(this).attr('email');
		var contacto = $(this).attr('contacto');
		var empresa = $(this).attr('empresa');
		// $('#alerta-error').modal('show');
		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width', '1020px');
		$('.mostrartitulo').html('Añadir Empresa');
		$('.contenido').html('<div style="margin: 10px 0"; class="container"><div id="formempresareporte" class="col-md-12"><div class="col-md-10"><div class="form-group"><label class="control-label" for="empresa">Razón Social:</label><input type="text" id="empresa" value="'+empresa+'" name="empresa" class="form-control" /></div></div><div class="clearfix"></div><div style="overflow:auto; margin-top:10px"></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="contacto">Contacto:</label><input type="text" value="'+contacto+'" id="contacto" name="contacto" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="telefono">Teléfono:</label><input type="text" value="'+tlf+'" id="telefono" name="telefono" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="email">Email:</label><input type="text" id="email" value="'+email+'" name="email" class="form-control" /></div></div><div class="clearfix"></div><a id="guardarempresareporte" style="margin-left: 15px; margin-top: 15px" class="btn btn-default btn-success">Guardar</a></div></div>');
	});


	$(document).on("click", "#segseleccionarempresa", function(event) {

		event.preventDefault();
		$('#mostrardatos').modal('hide');
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var empresa = parentTr.find('td#razonsocial').text();
		var id_emp = parentTr.find('td#id').text();
	    // alert(id_emp);
	    var idempfac = parentTr.find('td#idempfac').text();
	    var vencimiento = parentTr.find('td#vencimiento').text();

	    if( sec[1] == 'facturacion' ) {
			// alert(id_emp);
			$('#facturar_a'+id_emp).val(empresa);
			$('#empfacturar'+id_emp).val(idempfac);
			$('#vencimiento'+id_emp).val(vencimiento);

		} else if ( sec[1] == 'reportecomercial' || sec[1] == 'reportecomercial#' ) {

			$('#razonsocial').val(empresa);
	    	// alert(id_emp);
	    	$('#id_empresa').val(id_emp);

	    } else if ( sec[1] == 'propuesta#' || sec[1] == 'propuesta' ) {

	    	$('#razonsocial').val(empresa);
	    	$('#id_empresa').val(idempfac);

	    } else
	    $('#razonsocial').val(empresa);

	});


	$(document).on("change", ".formulariopeticion #tipoformacionpropuesta", function(event) {

		var optionSelected = $(this).find("option:selected");
		var valueSelected  = optionSelected.val();

		if ( valueSelected == "Bonificable" ) {

			var someDate = new Date();
			var numberOfDaysToAdd = 6;
			someDate.setDate(someDate.getDate() + numberOfDaysToAdd);

			var dd = someDate.getDate();
			var mm = someDate.getMonth() + 1;
			var y = someDate.getFullYear();

			var formato1 = y + '-'+ mm + '-'+ dd;
			var formato2 = dd + '/'+ mm + '/'+ y;

			$('span#fechabonif').html('<strong>Mínimo: '+formato2+'</strong>');
			// alert(formato1);
			// $('#fechaini').attr('value', formato1);
			// alert(formato2);
			// $('#fechaini').attr('value', formato2);


		}


	});

	// $(document).on("keyup", ".formulariosolprop #preciomatricula, .formulariosolprop #numalumnos", function(event) {

	// 	$('.formulariosolprop #presupuesto').val( parseFloat( $('.formulariosolprop #numalumnos').val()) * parseFloat($('.formulariosolprop #preciomatricula').val()) );
	// });

	// $(document).on("keyup", ".formulariosolmat #preciomatricula, .formulariosolmat #numalumnos", function(event) {

	// 	$('.formulariosolmat #presupuesto').val( parseFloat( $('.formulariosolmat #numalumnos').val()) * parseFloat($('.formulariosolmat #preciomatricula').val()) );
	// });

	// $(document).on("change", ".formulariosolmat #modalidad, .formulariosolprop #modalidad", function(event) {

	// 	var optionSelected = $(this).find("option:selected");
	//     var valueSelected  = optionSelected.val();



	// });

	$(document).on("click", "#anadiraccion", function(event) {

		event.preventDefault();
		$('#mostrardatos').modal('hide');
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var denominacion = parentTr.find('td#denominacion').text();
		var id_ac = parentTr.find('td#id').text();
		var horastotales = parentTr.find('td#horastotales').text();
		var modalidad = parentTr.find('td#modalidad').text();
		var objetivos = parentTr.find('td#objetivos').html();
		var contenidos = parentTr.find('td#contenidos').html();

		if ( sec[1] == 'propuesta' ) {
			$('#formacion').val(denominacion);
			$('#id_accion').val(id_ac);
			$('#horastotales').val(horastotales);
			$('#modalidad').val(modalidad);

			if ( modalidad == 'Teleformación' || modalidad == 'A Distancia' ) {
				$('#nombrecentro').removeClass('required');
				$('#nombrecentro').attr('readonly', true);
			}

			$('#objetivos').val(objetivos);
			$('#contenidos').val(contenidos);

		} else if ( sec[1] == 'peticion-matricula' || sec[1] == 'peticiones-matriculas' ) {

			var tiposol = $('#tiposol').val();

			if ( tiposol == "SM" ) {
				$('.bloquemat #formacion').val(denominacion);
				$('.bloquemat #id_accion').val(id_ac);
				$('.bloquemat #horastotales').val(horastotales);
				$('.bloquemat #modalidad').val(modalidad);

				if ( modalidad == 'Teleformación' || modalidad == 'A Distancia' ) {
					$('.bloquemat #nombrecentro').removeClass('required');
					$('.bloquemat #nombrecentro').attr('readonly', true);
					$('.bloquemat #fechaini').attr('readonly', true);
					$('.bloquemat #fechafin').attr('readonly', true);
					$('.bloquemat #horaspresenciales').attr('readonly', true);
					$('.bloquemat #horasdistancia').val(horastotales).attr('disabled', false);
				} else {
					if ( modalidad == 'Mixta' )
						$('.bloquemat #horasdistancia').attr('disabled', false);

					$('.bloquemat #horaspresenciales').val(horastotales);
				}

				$('.bloquemat #objetivos').val(objetivos);
				$('.bloquemat #contenidos').val(contenidos);
			} else {
				$('.bloqueprop #formacion').val(denominacion);
				$('.bloqueprop #id_accion').val(id_ac);
				$('.bloqueprop #horastotales').val(horastotales);
				$('.bloqueprop #modalidad').val(modalidad);

				if ( modalidad == 'Teleformación' || modalidad == 'A Distancia' ) {
					$('.bloqueprop #nombrecentro').removeClass('required');
					$('.bloqueprop #nombrecentro').attr('readonly', true);
					$('.bloqueprop #fechaini').attr('readonly', true);
					$('.bloqueprop #fechafin').attr('readonly', true);
					$('.bloqueprop #horaspresenciales').attr('readonly', true);
					$('.bloqueprop #horasdistancia').val(horastotales).attr('disabled', false);
				} else {

					if ( modalidad == 'Mixta' )
						$('.bloqueprop #horasdistancia').attr('disabled', false);

					$('.bloqueprop #horaspresenciales').val(horastotales);
				}

				$('.bloqueprop #objetivos').val(objetivos);
				$('.bloqueprop #contenidos').val(contenidos);
			}

		} else {
			$('#denominacion').val(denominacion);
			$('#id_accion').val(id_ac);
			$('#horastotales').val(horastotales);
			$('#modalidad').val(modalidad);
			$('#objetivos').val(objetivos);
			$('#contenido').val(contenidos);
		}

	});

	// $(document).on("click", "#anadirsolicitud", function(event) {

	// 	event.preventDefault();
	// 	$('#mostrardatos').modal('hide');
	// 	var button = $(this);
	//     var parentTd = button.parent('td');
	//     var parentTr = parentTd.parent('tr');
	//     var denominacion = parentTr.find('td#denominacion').text();
	//     // var id_ac = parentTr.find('td#id').text();
	//     var horastotales = parentTr.find('td#horastotales').text();
	//     var modalidad = parentTr.find('td#modalidad').text();
	//     var objetivos = parentTr.find('td#objetivos').html();
	//     var contenidos = parentTr.find('td#contenidos').html();

	//     $('#formacion').val(denominacion);
	// 	$('#id_accion').val(id_ac);
	// 	$('#horastotales').val(horastotales);
	// 	$('#modalidad').val(modalidad);
	// 	$('#objetivos').val(objetivos);
	// 	$('#contenido').val(contenidos);

	// });

	$(document).on("click", "#anadiraccionikea", function(event) {

		event.preventDefault();
		$('#mostrardatos').modal('hide');
		var button = $(this);
		var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		var denominacion = parentTr.find('td#denominacion').text();
		var id_ac = parentTr.find('td#id').text();
		var horastotales = parentTr.find('td#horastotales').text();
		var modalidad = parentTr.find('td#modalidad').text();
		var objetivos = parentTr.find('td#objetivos').html();
		var contenidos = parentTr.find('td#contenidos').html();

		$('#denominacion').val(denominacion);
		$('#id_accion').val(id_ac);
		$('#horastotales').val(horastotales);
		$('#modalidad').val(modalidad);
		$('#objetivos').val(objetivos);
		$('#contenido').val(contenidos);

	});


	$(document).on("click", "button[id^='buscarempresafac']", function(event) {

		event.preventDefault();
		var id_emp = $(this).attr('id_emp');
		// alert(id_emp);
		var empresa = $('#facturar_a'+id_emp).val();
		// alert(empresa);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/busqueda-seguimiento.php',
			data: 'id='+id_emp+'&razonsocial='+empresa+'&buscarempresa=1',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.contenido').html(data);

			}

		}); ajax.abort();

	});

	$(document).on("click", "#crearuserdocente", function(event) {

		var id_docente = $('#id').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id_docente+'&crearuserdocente=1',
			success: function(data)
			{
				alert("Usuario creado");
			}
		}); ajax.abort();

	});

	$(document).on("change", "#tipoformacionac", function(event) {

		// var optionSelected = $(this).find("option:selected");
		var valueSelected  = $(this).val();
	    // alert(valueSelected);
		var valueModalidad = $('#modalidad').val();
		//alert(valueModalidad);
	    $.ajax({
	    	cache: false,
	    	type: 'POST',
	    	url: 'functions/tipo_formacion.php',
	    	data: 'tipo='+valueSelected+'&modalidad='+valueModalidad,
			
	    	success: function(data)
	    	{
					// alert(data);
					$('#numeroaccion').val(data);
					$('#numeroaccion').attr('readonly','true');
				}
			}); ajax.abort();


	});
$(document).on("change", "#modalidad", function(event) {

		// var optionSelected = $(this).find("option:selected");
		var valueSelected  = $(this).val();
	    // alert(valueSelected);
		var valueTipo = $('#tipoformacionac').val();
	    $.ajax({
	    	cache: false,
	    	type: 'POST',
	    	url: 'functions/modalidad.php',
	    	data: 'modalidad='+valueSelected+'&tipo='+valueTipo,
	    	success: function(data)
	    	{
					// alert(data);
					$('#numeroaccion').val(data);
					$('#numeroaccion').attr('readonly','true');
				}
			}); ajax.abort();
	});    
	// $(document).on("click", "#recarga_progreso_tarea", function(event) {

	// 	event.preventDefault();
	// 	// var id_matricula = $('#id_matricula').val();
	// 	// var id_alumno = $('#id_alumno').val();
	// 	var progre = $('#progreso').val();
	// 	var antiprogre = 100-progre;
	// 	$('.progress-bar-success').css('width', progre+'%');
	// 	$('.progress-bar-danger').css('width', antiprogre+'%');

	// 	// $.ajax({
	// 	//         cache: false,
	// 	//         type: 'POST',
	// 	//         url: 'functions/funciones-tutorias.php',
	// 	//         data: 'id_mat='+id_matricula+'&id_alu='+id_alumno+'&progreso='+progre+'&actualizaprogre=1',
	// 	//         success: function(data)
	// 	//         {

	// 	//             if (data != 'error') {
	// 	//             	$('#confirmacion').show(500).delay(3000).hide('slow');
	// 	//             	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
	// 	//             }
	// 	//             else
	// 	//             	alert("Error");

	// 	//         }
	//  //    }); ajax.abort();

	// });





});

