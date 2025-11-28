

$(document).ready(function() {


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



	if (!Modernizr.inputtypes.date) {
	    $('input[type=date]').datepicker({
	        // Consistent format with the HTML5 picker
	        dateFormat: 'yy-mm-dd'
	    });
	}

	/* Inicialización en español para la extensión 'UI date picker' para jQuery. */
	/* Traducido por Vester (xvester [en] gmail [punto] com). */
	jQuery(function($){
	   $.datepicker.regional['es'] = {
	      closeText: 'Cerrar',
	      prevText: '<Ant',
	      nextText: 'Sig>',
	      currentText: 'Hoy',
	      monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	      monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	      dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	      dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	      dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	      weekHeader: 'Sm',
	      dateFormat: 'dd/mm/yy',
	      firstDay: 1,
	      isRTL: false,
	      showMonthAfterYear: false,
	      yearSuffix: ''};
	   $.datepicker.setDefaults($.datepicker.regional['es']);
	});


	// var fecha = new Date();
	// anio = fecha.getFullYear();
	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;

	function getRow(button, selector) {
	    var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#'+selector).html();
	}

	$('#horastotales').keyup(function() {

		if ( $(this).val() >= 6 ) $('#tipoformacionikea').val('Bonificable');
		else if ( $(this).val() == "" ) $('#tipoformacionikea').val('');
		else $('#tipoformacionikea').val('Privada');

	});

	$(document).on("click","#modeloexcel", function(event) {

		window.open('http://gestion.esfocc.com/app/documentacion2015/modeloexcel.xlsx', '_blank');

	});

	$(document).on("click","#login_ikea", function(event) {

    	event.preventDefault();
    	var user = $('#user').val();
    	var pass = $('#pass').val();
		alert(user+' '+pass);

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/login_ikea.php',
	        data: 'user='+user+'&pass='+pass,
	        success: function(data)
	        {
	        	if (data == 'error')
	        		alert("Usuario o Contraseña incorrectos.");
	        	else
	        		window.location.href = 'http://gestion.esfocc.com/app/index.php?solicitudikea';
	        }
	    }); ajax.abort();


    });

	$(document).on('click','#buscarcentrosikea', function(event) {

		event.preventDefault();
		var tienda = $('#tienda').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/buscarcentroikea.php',
			data: '&tienda='+tienda,
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','1000px');
				$('#mostrardatos .mostrartitulo').html("Seleccionar un centro");
				$('#mostrardatos .contenido').html(data);

			}
		}); ajax.abort();

	});

	$(document).on('click','#seleccionarcentroikea', function(event) {
		event.preventDefault();

		var id = getRow($(this), 'id');
		var tienda = getRow($(this), 'tienda');

		$('#mostrardatos').modal('hide');
		$('#lugar').val(tienda);
		$('#id_tienda').val(id);
	});


	// function multiselect_deselectAll($el) {
	//     $('option', $el).each(function(element) {
	//       $el.multiselect('deselect', $(this).val());
	//     });
	// }


	$(document).on("click", "#ikeadocuseleccionarmat", function(event){

		event.preventDefault();

		// alert("entra");

		$('#mostrardatos').modal('hide');

		$('#datosaccion').css('display','inline-block');
		$('.uploader-docu-ikea').css('display','inline-block');

		var naccion = getRowText($(this), 'af');
		$('#numeroaccion').val(naccion);
		$('#denominacion').val(getRowID($(this), 'denominacion'));
		$('#fechaini').val(getRowText($(this), 'fechaini'));
		$('#fechafin').val(getRowText($(this), 'fechafin'));
		$('#modalidad').val(getRowText($(this), 'modalidad'));

		naccion = naccion.replace('/','-');
		var url = 'http://gestion.esfocc.com/app/ikea'+gestion+'/docufinal/'+naccion.trim()+'.pdf';
		// alert(url);


		var existe = doesFileExist(url);
		if ( existe == true )
			$('.glyphicon-ok-circle').css('color','green');
		else
			$('.glyphicon-ok-circle').css('color','red');


	});


	$(document).on("click", "#ikeacuestseleccionarmat", function(event){

		event.preventDefault();
		var id_mat = getRowID($(this),'id');

		// alert(id_mat);

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'cuestionarioikea=1'+'&id_mat='+id_mat,
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');
	         	$('#listado-seguimiento').html(data);
	        }
    	});


	});


	$(document).on("click", "#seleccionarsolicitud", function(event){

    	// alert("hey");
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
	            $('.formulariosolikea').get(0).reset();
	            $('#id').val(data[0].id);
	            $('#numero').val(data[0].numero).attr('readonly',true);
	            $('#tipoformacionikea').val(data[0].tipoformacionikea);
	            $('#denominacion').val(data[0].denominacion);
	            $('#modalidad').val(data[0].modalidad);
	            $('#tipo').val(data[0].tipo);
	            $('#nivel').val(data[0].nivel);
	            $('#lugar').val(data[0].lugar);
	            $('#id_tienda').val(data[0].id_tienda);
	            $('#interna').val(data[0].interna);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#horariomini').val(data[0].horariomini);
	            $('#horariomfin').val(data[0].horariomfin);
	            $('#horariotini').val(data[0].horariotini);
	            $('#horariotfin').val(data[0].horariotfin);
	            $('#formador').val(data[0].formador);
	            $('#numalumnos').val(data[0].numalumnos);
	            $('#datosformador').val(data[0].datosformador);
	            $('#importeformador').val(data[0].importeformador);
	            $('#tienda_asignada').val(data[0].tienda_asignada);
	            $('#materia').val(data[0].materia);

	            // multiselect_deselectAll($('#empresasmulti'));

	            // for (var i=2; i < data.length; i++) {
	            // 	// alert(i);
	            // 	$('#empresasmulti').multiselect('select', data[i].id_empresa);
	            // }

	          	$('select#usuario').prop('disabled',false).html('<option value="'+data[0].usuario+'">'+data[0].usuario+'</option>');

	            $('#estadosolikea').val(data[0].estadosolikea);



	            if (data[0].modalidad == 'A Distancia' || data[0].modalidad == 'Teleformación') {
	            	$('#horaspresenciales').prop('disabled',true);
	            	$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
	            } else if (data[0].modalidad == 'Presencial') {
	            	$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
	            	$('#horasdistancia').prop('disabled',true);
	            } else if (data[0].modalidad == 'Mixta') {
	            	$('#horaspresenciales').prop('disabled',false).val(data[0].horaspresenciales);
	            	$('#horasdistancia').prop('disabled',false).val(data[0].horasdistancia);
	            }

	            numempresas = data[1].cuentas;

	            if ( data[2] == 1 )
	            	$('.estatablaik').css('color','green');
	            else
	            	$('.estatablaik').css('color','red');

	            if ( data[3] == 1 )
	            	$('.estaconsentik').css('color','green');
	            else
	            	$('.estaconsentik').css('color','red');

        		$('#tagempresas').html('<div class="numempresas">Empresas inscritas: <span class="nemp">'+numempresas+'</span></div>');
        		$('#btnempresaseditar-ik').css('display','inline-block');

	            $('#horastotales').val(data[0].horastotales);
	            $('#objetivos').val(data[0].objetivos);
	            $('#contenido').val(data[0].contenido);
	            // alert(data[0].observacionesikea);
	            $('#observacionesikea').val(data[0].observacionesikea);
	            $('#observacionesesfocc').val(data[0].observacionesesfocc);

	            $('#uploaderikea').css('display', 'block');

	        }
    	});
    });


	$(document).on("change", "#observacionesesfocc", function(event){

		event.preventDefault();
		$('#observesfocc').val(1);

	});

	$(document).on("change", "#observacionesikea", function(event){

		event.preventDefault();
		$('#observikea').val(1);

	});


	$(document).on("click", "#seleccionartienda", function(event){

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
	            $('.formularioaltaikea').get(0).reset();
	            $('#id').val(data[0].id);

	            $('#tienda').val(data[0].tienda);
	            $('#direccion').val(data[0].direccion);
	            $('#codigopostal').val(data[0].codigopostal);
	            $('select#poblacion').prop('disabled',false).html('<option value="'+data[0].poblacion+'">'+data[0].poblacion+'</option>');
	            $('select#provincia').prop('disabled',false).html('<option value="'+data[0].provincia+'">'+data[0].provincia+'</option>');
	            $('#observaciones').val(data[0].observaciones);
	            $('#rrhh').val(data[0].rrhh);
	            $('#rrhhtlf').val(data[0].rrhhtlf);
	            $('#rrhhemail').val(data[0].rrhhemail);
	            $('#jefetienda').val(data[0].jefetienda);
	            $('#jefetiendatlf').val(data[0].jefetiendatlf);
	            $('#jefetiendaemail').val(data[0].jefetiendaemail);
	            $('#contable').val(data[0].contable);
	            $('#contabletlf').val(data[0].contabletlf);
	            $('#contableemail').val(data[0].contableemail);


	            // $('#bonificado').attr('disabled','false');
	        }
    	});
    });


	$(document).on("click","#subirtablaikea", function(event) {

    	event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#participantesikea').get(0).files[0]);
        formData.append('denominacion', $('#denominacion').val());
        formData.append('numero', $('#numero').val());
        formData.append('modalidad', $('#modalidad').val());
        formData.append('tipo', 'tablaikea');
        var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


        if ( $('#participantesikea').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else if ( $('#denominacion').val() == "" )  {

        	alert("Introduce la formación.");

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
	                	$('.estatablaik').css('color','green');
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
    	}

    });




	$(document).on("click","#guardarmediasik", function(event) {


		var id = $('#id_matricula').val();
		var mediainicial = $('#mediainicial').val();
		var mediafinal = $('#mediafinal').val();
		var valoracioncurso = $('#valoracioncurso').val();


		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id='+id+'&mediainicial='+mediainicial+'&mediafinal='+mediafinal+'&valoracioncurso='+valoracioncurso+'&guardarmediasik=1',
			success: function(data)
			{
				if ( data.indexOf("error") != -1 )
					alert("Error insertando medias");
				else
					alert("Notas guardadas correctamente");
			}
		}); ajax.abort();

	});

	$(document).on("click","#subirconsentikea", function(event) {

    	event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#consentikea').get(0).files[0]);
        formData.append('denominacion', $('#denominacion').val());
        formData.append('numero', $('#numero').val());
        formData.append('modalidad', $('#modalidad').val());
        formData.append('tipo', 'consentikea');
        var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


        if ( $('#consentikea').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else if ( $('#denominacion').val() == "" )  {

        	alert("Introduce la formación.");

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
	                	$('.estaconsentik').css('color','green');
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
    	}

    });

    $(document).on("click", "#mostrarconsentikea", function(event) {

		event.preventDefault();

        $.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/mostrar_pdf.php',
		    data: 'numero='+$('#numero').val()+'&denominacion='+$('#denominacion').val()+'&tipo=consentikea',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

	});

	    $(document).on("click", "#mostrartablaikea", function(event) {

		event.preventDefault();

        $.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/mostrar_pdf.php',
		    data: 'numero='+$('#numero').val()+'&denominacion='+$('#denominacion').val()+'&tipo=tablaikea',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

	});




	$(document).on("click","#subirdocufinalikea", function(event) {

    	event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#docufinalikea').get(0).files[0]);
        formData.append('numeroaccion', $('#numeroaccion').val());
        // formData.append('denominacion', $('#denominacion').val());
        formData.append('modalidad', $('#modalidad').val());
        formData.append('tipo', 'docufinalikea');
        var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';


        if ( $('#docufinalikea').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        // } else if ( $('#denominacion').val() == "" )  {

        // 	alert("Introduce la formación.");

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
	                	$('.glyphicon-ok-circle').css('color','green');
	                }
	                else
	                	alert("Error en la subida.");

	            }
	        }); ajax.abort();
    	}

    });

    $(document).on("click", "#mostrardocufinalikea", function(event) {

		event.preventDefault();

        $.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/mostrar_pdf.php',
		    data: 'numeroaccion='+$('#numeroaccion').val()+'&denominacion='+$('#denominacion').val()+'&tipo=docufinalikea',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

	});

    // $(document).on("click", "#enviasolicitudikea", function(event) {

    // 	event.preventDefault();
    // 	$('#uploaderikea').css('display','none');

    // });

	$('.formulariosolikea').validate({


		submitHandler: function(form) {

			// $('#uploaderikea').css('display','none');
			// $('#formparticipantesikea').css('display','none');
			// $('#formparticipantesikea #participantesikea').prop('disabled','true');
			// $('#formconsentikea').css('display','none');
			// $('#formconsentikea #consentikea').prop('disabled','true');

			$('#confirmar').modal('show');

			$('#aceptacambios').on('click', function(event){

				$('#confirmar').modal('hide');
				// $('select#tipoformacionac').attr('disabled','true');
				var values = $('.formulariosolikea').find("input[type='hidden'], :input:not(:hidden)").serialize();
				// var empresasmulti = $('#empresasmulti').val();
				// values = values+'&empresasmulti='+empresasmulti;a
				// alert(values);

			    $.ajax({
			    	cache: false,
			        url: "forms/procesar_forms.php",
			        type: "post",
			        data: values,
			        success: function(result){
			        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			            if ( result.indexOf('error') != -1 ) {
			            	// alert(result);
			        		$('#error').show(500).delay(5000).hide('slow');
			            }
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
			fechaini : {
				required : true
			},
			fechafin : {
				required : true
			},
			denominacion : {
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
			horastotales : {
				required : true
			},
			objetivos: {
				required : true
			},
			lugar: {
				required : true
			},
			contenido: {
				required : true
			},
			numalumnos: {
				required : true
			},
			importeformador: {
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


	$('.formularioaltaikea').validate({

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
			tienda : {
				required : true
			},
			direccion : {
				required : true
			},
			codigopostal : {
				required : true
			},
			modalidad : {
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

});