$(document).ready(function() {

	var gestion = parseInt($('#aniovigente').val());
	if ( gestion == '2014' ) gestion = '';
	else gestion = gestion;

	function getRow(button) {
	    var parentTd = button.parent('td');
		var parentTr = parentTd.parent('tr');
		return parentTr.find('td#id').html();
	}

	var i = 0; // contador para alumnos
	var k = 0; // contador para docentes
	var ei = 0; // contador de elementos-alumnos
	var ek = 0; // contador de elementos-docentes
	var tabla = "";
	var numalumnos = 0;
	var numdocentes = 0;

	var sec = $(location).attr('href').split("?");

	$(".abrebusqueda, #abrebusqueda").on('click', function(event) {	

		event.preventDefault();
		
		if ( $(this).attr('name') != undefined ) { //viene de matricula		
			
		 	var tabla = $(this).attr('name');
		 	
		  	if (tabla == 'empresas' && ei < 1) {			
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Añade primero un alumno y luego selecciona su empresa.");
				return false;
			}
			if ( ei >= 1 ) {
				if (tabla == 'alumnos' && $('#nombre'+i).val() != "" && $('#razonsocial'+i).val() == "") {			
					$('#alerta-error').modal('show');
					$('.mensaje-error').html("Selecciona la empresa del alumno antes de añadir uno nuevo.");
					return false;
				}
			}
			if (tabla == 'tutoria') {
				$('#datostutoria').css('display','block');
				return false;
			}
			if (tabla == 'tutoriaod') {
				$('#datostutoriaod').css('display','block');
				return false;
			}
			if (tabla == 'centros') {
				$('#datoscentro').css('display','block');
				return false;
			}
			if (tabla == 'centrosod') {
				$('#datoscentrood').css('display','block');
				return false;
			}
				
		 	var mat = '1';
		 	
		} else if ( $('#id_matricula').val() != undefined ) { // mostrar matriculas (ya la tengo cargada)
			
			if ( event.target.id == 'btnalumnose' ) 
				tabla = 'mat_alu_cta_emp';
			else 
				tabla = 'mat_doc';
				
			var id_mat = $('#id_matricula').val();
			var mat = '1';

		} else // viene de otras secciones
			var tabla = $("#tabla").val();
		
		
		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width','1020px');
		
    	var sec = $(location).attr('href').split("?");

    	if ( sec[1] == 'tutorias' ) {
    		var naccionrec = $('input#numeroaccion').data("naccion");
    		// alert(naccionrec);
    	}

    	if ( sec[1] == 'matricula' || sec[1] == 'matricula#' )
    		$('.modal-dialog').css('width','1100px');
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
    	else if (sec[1] == 'tutorias' || sec[1] == 'tutorias#') {
    		mat = '7';
    		$('.modal-dialog').css('width','1100px');
    	}
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
    	


    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tabla='+tabla+'&abre=1'+'&mat='+mat+'&id_mat='+id_mat,
	        success: function(data) 
	        {

	        	if (tabla == 'peticiones_formativas') {
	        		tabla = 'solicitudes';
	        	}
	        	if (tabla == 'mat_alu_cta_emp') {
	        		tabla = 'alumnos matriculados';
	        		$('button#guardarcambios').css('display','inline-block');
	        	}
	        	if (tabla == 'mat_doc') {
	        		tabla = 'docentes de este curso';
	        		$('button#guardarcambios').css('display','inline-block');
	        	}
	        	if (tabla == 'ikea_solicitudes') {
	        		tabla = 'solicitudes';
	        		$('.modal-dialog').css('width','1000px');
				}
	        	if (tabla == 'ikea_tiendas')
	        		tabla = 'tiendas';

	        	if ( mat == '7' ) tabla = 'tutorías';
	            $('.mostrartitulo').html("Mostrando datos de "+tabla);
	            $('.contenido').html("Cargando...");
	            $('.contenido').html(data);

	           	if ( sec[1] == 'tutorias' ) {
	           		// alert(naccionrec);
	        		$('.modal-dialog input#numeroaccion').val(naccionrec);
	        		$('#busqueda').click();
	           	}

	        } 
    	}); ajax.abort();
	});



	$(document).on("click", "#eliminarMatriculaIndBD", function(event) {

		event.preventDefault();

		var id_matricula = getRow($(this));
		$('#confirmar').modal('show');
		$('#confirmar').css('z-index','1060');
		// $('#confirmar .modal-dialog').css('z-index','9999');

		$('#aceptacambios').on('click', function(event) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_matricula='+id_matricula+'&borrarmatindbd=1',
				success: function(data) 
				{
					$('#confirmar').modal('hide');
					$('#mostrardatos').modal('hide');
					$('#confirmacion').html("Matrícula borrada correctamente.");
					$('#confirmacion').show(500).delay(2000).hide('slow');
				} 
			}); ajax.abort();

		});

	});

	$(document).on("click", "#costesfactuind", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id_matricula='+id_matricula+'&datosempresa=2',
	        success: function(data) 
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','850px');
	        	$('.mostrartitulo').html("Datos Facturación");
	        	$('.contenido').html(data);
	        }
	    }); ajax.abort();


	});


	$(document).on('click','#anadirAlumnoMoodle', function(event) { 

		var id_alu = $(this).attr('id_alu');
		var id_mat = $('input#id_matricula').val();
		
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'anadiralumnomoodle=1'+'&id_alu='+id_alu+'&id_mat='+id_mat,
			success: function(data) 
			{
				alert(data);
			} 
		}); ajax.abort();

	});


	$(document).on('click','#restablecer-matonline', function(event) {
	
		$('#form-modal')[0].reset();

	});


	$(document).on("click", "#informe-conex", function(event) {

		var ncurso = $(this).attr('ncurso');
		var user = $(this).attr('user');
		var pass = $(this).attr('pass');

		window.open('http://www.plataformateleformacion.com/Profesor/EstadisticasDescarga.php?NCurso='+ncurso+'&Login='+user+'&Pass='+pass+'&IAccesoModulo=0&IAccesoUnidadFormativa=0&IAccesoTema=0&LAccesoModulo=0&LAccesoUnidadFormativa=0&LAccesoTema=99&Mostrar=1');

	});

	$(document).on("click", "#informe-online", function(event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/mostrar_pdf.php',
	        data: 'informedesdemat=1'+'&id_mat='+id_matricula+'&tipo=empresa',
	        success: function(data) 
	        {
	        	if ( data == 'no' )
					alert("No hay PDF subido.");
				else	
					window.open(data);
					// alert(data);
	        }
	    }); ajax.abort();

	});

	$(document).on("click", "#subirpdfini", function(event) {

		event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#inifile').get(0).files[0]);
        formData.append('id_mat', $('#id_matricula').val());
        formData.append('tipo', 'inicio');
        var estasi = '<div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span></div>';
        
        if ( $('#inifile').get(0).files[0] == undefined ) {
        	
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
                	$('#mostrarpdfini').after(estasi);               	
                	$('#estado').val('Comunicada');
                }
                else
                	alert("Error en la subida.");	
                
            }
        	}); ajax.abort();
        }
        
        
	});
	
	$(document).on("click", "#subirpdffin", function(event) {
		  
		event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#finfile').get(0).files[0]);
        formData.append('id_mat', $('#id_matricula').val());
        formData.append('tipo', 'fin');
        var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';

        if ( $('#finfile').get(0).files[0] == undefined ) {
        	
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
	                
	                if ( data.indexOf('error') != 'error' ) {
	                	alert("Fichero subido correctamente.");
	                	alert(data);
	                	$('#mostrarpdffin').after(estasi);
	                	$('#estado').val('Finalizada');
	                }
	                else
	                	alert("Error en la subida.");	
	                
	            }
	        }); ajax.abort();
    	}
	});

	$(document).on("click", "#subirpdfcues", function(event) {

		event.preventDefault();
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#cuesfile').get(0).files[0]);
        formData.append('id_mat', $('#id_matricula').val());
        formData.append('tipo', 'cuestionario');
        var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';
        

        if ( $('#cuesfile').get(0).files[0] == undefined ) {
        	
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
	                	$('#mostrarpdfcues').after(estasi);
	                }
	                else
	                	alert("Error en la subida.");	
	                
	            }
	        }); ajax.abort();
    	}
	});

	
	$(document).on("click", "#mostrarpdfini", function(event) {
	
		event.preventDefault();

		var id_mat = $('#id_matricula').val();


		if ( sec[1] == 'busqueda_seguimientoikea' || sec[1] == 'busqueda_seguimientoikea#' ) {
			var id_mat = getRowID($(this),'id_mat');
			// alert(id_mat);
		}

        $.ajax({
		    cache: false,
		    type: 'POST', 
		    url: 'functions/mostrar_pdf.php',
		    data: 'id_mat='+id_mat+'&tipo=inicio',
		    success: function(data) 
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else	
					window.open(data);
		    }
    	}); ajax.abort();
		
	});
	
	$(document).on("click", "#mostrarpdffin", function(event) {
	
		event.preventDefault();
		
		var id_mat = $('#id_matricula').val();
		if ( id_mat == "" )
			id_mat = $('#id_mat').val();

        	
        $.ajax({
		    cache: false,
		    type: 'POST', 
		    url: 'functions/mostrar_pdf.php',
		    data: 'id_mat='+id_mat+'&tipo=fin',
		    success: function(data) 
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else	
					window.open(data);
		    }
    	}); ajax.abort();
		
	});
	
	$(document).on("click", "#mostrarpdfcues", function(event) {
	
		event.preventDefault();
        
        $.ajax({
		    cache: false,
		    type: 'POST', 
		    url: 'functions/mostrar_pdf.php',
		    data: 'id_mat='+$('#id_matricula').val()+'&tipo=cuestionario',
		    success: function(data) 
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else	
					window.open(data);
		    }
    	}); ajax.abort();
		
	});
	
	$(document).on("click", "#btnsubidas", function(event) {
		
		event.preventDefault();	
		
		var input_upload = '<div class="clearfix"></div><div style="margin-top:10px;" class="col-md-12"><form id="pdfinicio" action="" method="post" enctype="multipart/form-data"><label>PDF Inicio:</label><br><input style="float:left" type="file" name="inifile" id="inifile" class="btn btn-default"/><a id="subirpdfini" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF</a><a id="mostrarpdfini" style="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF</a></form></div><div class="clearfix"></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdffin" action="" method="post" enctype="multipart/form-data"><label>PDF Finalización:</label><br><input style="float:left" type="file" name="finfile" id="finfile" class="btn btn-default"/><a id="subirpdffin" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF</a><a id="mostrarpdffin" style="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF</a></form><div class="clearfix"></div></div><div style="margin-top: 10px;" class="col-md-12"><form id="pdffin" action="" method="post" enctype="multipart/form-data"><label>PDF Cuestionario:</label><br><input style="float:left" type="file" name="cuesfile" id="cuesfile" class="btn btn-default"/><a id="subirpdfcues" class="btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF</a><a id="mostrarpdfcues" style="" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF</a></form></div><div class="clearfix"></div>';
		$('#mostrardatos').modal('show');
		$('.modal-dialog').css('width','700px');
		$('.mostrartitulo').html('Subir notificaciones');
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';
		var estano = '<span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span>';
		
		$.ajax({
		    cache: false,
		    type: 'POST', 
		    url: 'functions/mostrar_pdf.php',
		    data: 'id_mat='+$('#id_matricula').val()+'&busqueda=1',
		    dataType: 'json',
		    success: function(data) 
		    {
		    	$('.contenido').html(input_upload);
		    	
				if ( data.existeini === 1 ) $('#mostrarpdfini').after(estasi); else $('#mostrarpdfini').after(estano);				
				if ( data.existefin === 1 )	$('#mostrarpdffin').after(estasi); else $('#mostrarpdffin').after(estano);
				if ( data.existecues === 1 ) $('#mostrarpdfcues').after(estasi); else $('#mostrarpdfcues').after(estano);

		    }
    	}); ajax.abort();
		
		
	});

	
	$(document).on("change","#metodo", function (event) {
		
		event.preventDefault();
	   	var sec = $(location).attr('href').split("?");
		var id_matricula = $('#id_matricula').val();
		
     	var optionSelected = $(this).find("option:selected");
	    var valueSelected  = optionSelected.val();
	    if (valueSelected == 'm1') {
	    
	    	if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' ) {
	    		
	    		var id_emp = $('#id_emp').val();
		     	$.ajax({
			        cache: false,
			        type: 'POST', 
			        url: 'functions/costes.php',
			        data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&salariominimo=1',
			        success: function(data) 
			        {
			        	$('#costes_salariales').val(data);
			        }
	    		}); ajax.abort();
	    		
	    	} else 
	    		$('#costes_salariales').val('4.42');
	    	
	    	
	    } else if (valueSelected == 'm2') {
	     	
	     	if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' ) {
	     	
	     		var id_emp = $('#id_emp').val();
	     		var input_emp = '<input type=hidden id="id_emp" />';
	     		
		     	$.ajax({
			        cache: false,
			        type: 'POST', 
			        url: 'functions/costes.php',
			        data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&comprueba=2',
			        dataType: 'json',
			        success: function(data) 
			        {
			        	var inputcostes = '<div class="datosnecesarios"><div class="col-md-4"><div class="form-group"><label class="control-label" for="horasmediasano">Horas Medias Anuales:</label><input type="text" id="horasmediasano" name="horasmediasano" class="form-control"/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="cuotaformprof">Cuota de Formación Profesional:</label><input type="text" id="cuotaformprof" name="cuotaformprof" class="form-control"/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="plantillamedia">Plantilla Media:</label><input type="text" id="plantillamedia" name="plantillamedia" class="form-control"/></div></div></div>';
			        	var btnguardar = '<a style="float:right;" id="guardardatoscostes" href="#" data-dismiss="modal" class="btn btn-primary btn-default">Guardar</a>';
			        	$('#mostrardatosc').modal('toggle');
			        	$('#mostrardatosc .mostrartitulo').html("Mostrando datos de Costes");
			        	$('#mostrardatosc .contenido').html(inputcostes);
			        	$('#mostrardatosc .contenido').append(input_emp);
			        	$('#id_emp').val(id_emp);
			        	$('#mostrardatosc .modal-footer').html(btnguardar);
			        	$('#mostrardatosc .contenido').css('overflow','auto');
			        	$('#mostrardatosc .contenido').css('padding-top','10px');
			        	$('input#plantillamedia').val(data[0].plantillamedia);
			        	$('#horasmediasano').val(data[0].horasmediasano);
			        	$('#cuotaformprof').val(data[0].cuotaformprof);
							
			        }
	    		}); ajax.abort();
	    		
	    	} else {
	    		   		
	    		$.ajax({
			        cache: false,
			        type: 'POST', 
			        url: 'functions/costes.php',
			        data: 'id_mat='+id_matricula+'&comprueba=1',
			        dataType: 'json',
			        success: function(data) 
			        {
			        	var inputcostes = '<div class="datosnecesarios"><div class="col-md-4"><div class="form-group"><label class="control-label" for="horasmediasano">Horas Medias Anuales:</label><input type="text" id="horasmediasano" name="horasmediasano" class="form-control"/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="cuotaformprof">Cuota de Formación Profesional:</label><input type="text" id="cuotaformprof" name="cuotaformprof" class="form-control"/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="plantillamedia">Plantilla Media:</label><input type="text" id="plantillamedia" name="plantillamedia" class="form-control"/></div></div></div>';
			        	var btnguardar = '<a style="float:right;" id="guardardatoscostes" href="#" data-dismiss="modal" class="btn btn-primary btn-default">Guardar</a>';
			        	$('#mostrardatos').modal('show');
			        	$('.mostrartitulo').html("Mostrando datos de Costes");
			        	$('.contenido').html(inputcostes);
			        	$('.modal-footer').html(btnguardar);
			        	$('.contenido').css('overflow','auto');
			        	$('.contenido').css('padding-top','10px');
			        	$('input#plantillamedia').val(data[0].plantillamedia);
			        	$('#horasmediasano').val(data[0].horasmediasano);
			        	$('#cuotaformprof').val(data[0].cuotaformprof);
							
			        }
	    		}); ajax.abort();
	    		
	    	}
    	}
 	});


	$('#plantillamedia').keyup(function () {
 		if ( $(this).val() >= 1 && $(this).val() <= 9  )
 			$('#porcentajecof').val('5');		
 		else if ( $(this).val() >= 10 && $(this).val() <= 49  )
 			$('#porcentajecof').val('10');		
 		else if ( $(this).val() >= 50 && $(this).val() <= 249  )
 			$('#porcentajecof').val('20');
 		else if ( $(this).val() >= 250 )	
 			$('#porcentajecof').val('40');
 	});

	$(document).on("click","#guardardatoscostes", function (event) {
		
		event.preventDefault();
		var values = $('.datosnecesarios').find("input[type='hidden'], :input:not(:hidden)").serialize();
		var id_matricula = $('#id_matricula').val();
		var id_accion = $('#id_accion').val();
		values = values + '&id_matricula='+id_matricula;
		values = values + '&id_accion='+id_accion;
		var observacionesfin = $('#observacionesfin').val();
		
		var sec = $(location).attr('href').split("?");
		if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' ) {
			
			var id_emp = $('#id_emp').val();
			values = values + '&id_emp='+id_emp;
			values = values + '&observacionesfin='+observacionesfin;

			$.ajax({
				cache: false,
			    type: 'POST', 
			    url: 'functions/costes.php',
			    data: values+'&guardardatoscostes=2',
			    success: function(data) 
			    {
					$('#costes_salariales').val(data);
			    }
	    	}); ajax.abort();
	    	
	  	} else {
	  		
	  		$.ajax({
				cache: false,
			    type: 'POST', 
			    url: 'functions/costes.php',
			    data: values+'&guardardatoscostes=1',
			    success: function(data) 
			    {
					$('#costes_salariales').val(data);
			    }
	    	}); ajax.abort();
	  		
	  	}
	});


	$(document).on("click","#guardarcostesprivado", function (event) {
		
		event.preventDefault();
		var id_emp = $('#id_emp').val();
		var values = $('#datoscostesprep').find("input[type='hidden'], :input:not(:hidden)").serialize();
		var id_matricula = $('#id_matricula').val();
		values = values + '&id_matricula='+id_matricula;							
		values = values + '&id_emp='+id_emp;
		var observacionesfin = $('#observacionesfin').val();
		if ( observacionesfin != "" )
			values = values + '&observacionesfin='+observacionesfin;
				
		$.ajax({
			cache: false,
			type: 'POST', 
			url: 'functions/costes.php',
			data: values+'&guardarcostes=3',
			success: function(data) 
			{
				$('#mostrardatos').modal('hide');
		    	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
		      	$('#confirmacion').html("Costes guardados");
		       	$('#confirmacion').show(500).delay(2000).hide('slow');
				// setTimeout(function(){location.reload();},2200);
				//alert(data);	
		    }
		}); ajax.abort();						
				
	});

	$(document).on("click","#guardarcostes", function (event) {
		
		event.preventDefault();
		
		var sec = $(location).attr('href').split("?");
		
			var maxboni = parseFloat($('#maximo_bonificable').val());
			var costesimp = parseFloat($('#costes_imparticion').val());

			// alert($('#tipofra').val());
			// alert($('#numeroaccion').val().indexOf('IKEA'));

			// if ( maxboni != '∞' && costesimp > maxboni) {
				
				// alert("El coste de impartición no puede ser mayor al máximo bonificable.");
				
			// } else if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' || sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_fin#' ) {

			if ( sec[1] == 'presencial_fin' || sec[1] == 'presencial_fin#' || sec[1] == 'form_matricula_fin' || sec[1] == 'form_matricula_fin#' ) {
				
				if ( $('#tipofra').val() == "" ) {

					alert("Debes seleccionar el tipo de factura.");
					return false;

				} else {

					var id_emp = $('#id_emp').val();
					var values = $('#datoscostespre').find("input[type='hidden'], :input:not(:hidden)").serialize();
					var id_matricula = $('#id_matricula').val();
					var observacionesfin = $('#observacionesfin').val();
					if ( observacionesfin != "" )
						values = values + '&observacionesfin='+observacionesfin;
					values = values + '&id_matricula='+id_matricula;							
					values = values + '&id_emp='+id_emp;
					
					// alert("llegó");

					$.ajax({
					    cache: false,
					    type: 'POST', 
					    url: 'functions/costes.php',
					    data: values+'&guardarcostes=2',
					    success: function(data) 
				        {
				        	$('#mostrardatos').modal('hide');
				        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				        	$('#confirmacion').html("Costes guardados");
				        	$('#confirmacion').show(500).delay(2000).hide('slow');
				        	// setTimeout(function(){location.reload();},2200);
							//alert(data);	
				        }
		    		}); ajax.abort();

				}
	    		
	    	} else {
	    		
	    		var values = $('#datoscostes').find("input[type='hidden'], :input:not(:hidden)").serialize();
				var id_matricula = $('#id_matricula').val();
				values = values + '&id_matricula='+id_matricula;
				values = values + '&tipofra='+$('#tipofra').val();	

				if ( $('#tipofra').val() == "" ) {

					alert("Debes seleccionar el tipo de factura.");
					return false;

				} else {
	    		
		    		$.ajax({
					    cache: false,
					    type: 'POST', 
					    url: 'functions/costes.php',
					    data: values+'&guardarcostes=1',
					    success: function(data) 
				        {
				        	$('#mostrardatos').modal('hide');
				        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
				        	$('#confirmacion').html("Costes guardados");
				        	$('#confirmacion').show(500).delay(2000).hide('slow');
				        	setTimeout(function(){location.reload();},2200);
							//alert(data);	
				        }
		    		}); ajax.abort();

		    	}
	    	
	    	}			
				
	});

	$(document).on("click","#btncostes", function (event) {
		
		event.preventDefault();
		$('#datoscostes').css('display','block');
		var id_mat = $('#id_matricula').val();
		
		$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/costes.php',
		        data: 'id_mat='+id_mat+'&devuelve=1',
		        dataType: 'json',
		        success: function(data) 
		        {	        
		        	if (data[1].id != undefined) 
		        		$('#id_coste').val(data[1].id);
		        	$('#empresacostes').val(data[0].razonsocial);
					$('#costes_imparticion').val(data[1].costes_imparticion);
					$('#porcentaje_cof').val(data[0].porcentajecof);
					
					if (data[1].costes_salariales == undefined)
						$('#costes_salariales').val("");
					else 
						$('#costes_salariales').val(data[1].costes_salariales);	
						
					if (data[1].maximo_bonificable == 0) {
						$('#maximo_bonificable').val('∞');
						$('#costes_salariales').val('0');
					}
					else
						$('#maximo_bonificable').val(data[1].maximo_bonificable);
					
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

					if ( $('#tipo_formacion').val() == "Privado" ) {
						$('#mes_bonificable').val("");
						$('select#mes_bonificable').attr('readonly', true);	
					}

					$('#tipofra').val(data[1].tipofra);
					$('#costes_organizacion').val(data[1].costes_organizacion);
					$('#costes_indirectos').val(data[1].costes_indirectos);
					$('#importe_a_bonificar').val(data[1].importe_a_bonificar);

				}
    		}); ajax.abort();
	});
	
	$(document).on("click","#btnCalculoMax", function (event) {
		
		var id_mat = $('#id_matricula').val();
		
		$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/costes.php',
		        data: 'id_mat='+id_mat+'&calculomax=1',
		        dataType: 'json',
		        success: function(data) 
		        {	        	
					$('#maximo_bonificable').val(data);
		        }
    		}); ajax.abort();	
			
	});

	$(document).on("click","#imprimirmat", function (event) {

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.esfocc.com/app/functions/imprimirMat.php?id_matricula='+id_matricula, '_blank');

	});
	
	$(document).on("click","#xmlinicio", function (event) {

		var id_matricula = $('#id_matricula').val();
		
		if ($('#modalidad').val() == 'A Distancia')
			window.location = 'export/xml_distancia.php?id_matricula='+id_matricula;
		else if ($('#modalidad').val() == 'Teleformación')
			window.location = 'export/xml_online.php?id_matricula='+id_matricula;

	});
	
	$(document).on("click","#xmlfin", function (event) {

		var id_matricula = $('#id_matricula').val();
		
		window.location = 'export/xml_finalizacion_pre.php?id_matricula='+id_matricula;

	});

	$(document).on("click","#xmlfin_post", function (event) {

		var id_matricula = $('#id_matricula').val();
		
		window.location = 'export/xml_finalizacion_prepost.php?id_matricula='+id_matricula;

	});

	$(document).on("click", "#vin", function(event) {

		// alert("id");
		var id_matricula = $('#id_matricula').val();
		// alert(id_matricula);
		// window.open('http://gestion.esfocc.com/app/documentacion/generar_diploma_td.php?id_matricula='+id_matricula, '_blank');


		if ( sec[1] == 'form_matricula_doc' || sec[1] == 'form_matricula_doc#' )
			window.open('http://gestion.esfocc.com/app/documentacion/diplomas/certificado_imparticion.php?id_matricula='+id_matricula, '_blank');
		
		else {
			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_matricula='+id_matricula+'&compruebavin=1',
				success: function(data) 
				{
					if (data != 0)
						window.open('http://gestion.esfocc.com/app/documentacion/diplomas/certificado_imparticion.php?id_matricula='+id_matricula, '_blank');

				} 
			}); ajax.abort();
		}

	});


	$(document).on("click", "#diplomatd", function(event) {

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.esfocc.com/app/documentacion/generar_diploma_td.php?id_matricula='+id_matricula, '_blank');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&compruebavin=1',
			success: function(data) 
			{
				if (data != 0)
					window.open('http://gestion.esfocc.com/app/documentacion/diplomas/certificado_imparticion.php?id_matricula='+id_matricula, '_blank');

			} 
		}); ajax.abort();

	});


	$(document).on("click", "#enviodiplotd", function(event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'documentacion/generar_diploma_tdn.php',
			data: 'id_matricula='+id_matricula+'&envio=1',
			success: function(data) 
			{
				if ( data == "bien" )
					alert("Email Enviado.")
				else
					alert(data);
			} 
		}); ajax.abort();

		// window.open('http://gestion.esfocc.com/app/documentacion/generar_diploma_tdn.php?id_matricula='+id_matricula+'&envio=1', '_blank');

	});

	$(document).on("click", "#diplomatdn", function(event) {

		var id_matricula = $('#id_matricula').val();
		var input_diplo = '<div style="margin-top: 15px; text-align: center; overflow: auto"><a id="diplomatdgo" style="margin-right: 20px" href="#" class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span> Ver Diploma</a><a href="#" id="enviodiplotd" class="btn btn-success disabled"><span class="glyphicon glyphicon-envelope"></span> Enviar Diploma</a></div>';
		// var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';

		$('#mostrardatos').modal('show');
		$('button#guardarcambios').css('display','none');
		$('.modal-dialog').css('width','500px');
		$('.mostrartitulo').html("Ver/Enviar Diploma");
		$('.contenido').html(input_diplo);

		var id_matricula = $('#id_matricula').val();
		var columnas = $('#contentdiv').html();
		// alert(columnas);
		var fuente = $('#fuente').val();
		var fuentereal = $('#contentdiv').css('font-size');
		var porcen = $('#first column').css('width');
		var id_accion = $('#id_accion').val();
		// var id_mat = $('#id_mat').val();

		$.ajax({
			cache: false,
			type: 'POST',
			dataType: 'json',
			url: 'functions/funciones.php',
			data: 'preparaback=1'+'&html='+encodeURI(columnas)+'&porcen='+porcen+'&fuente='+fuente+'&fuentereal='+fuentereal+'&id_accion='+id_accion+'&id_mat='+id_matricula,
			success: function(data) 
			{
				if ( data["envio"]["envio"] == 0 )
					data["envio"]["fechaenvio"] = "-";
				if ( data["recepcion"] == 0 )
					data["fecharecepcion"] = "-";

				$('div.contenido').append('<p style="margin: 20px 0 20px 0;text-align: center"><strong>Fecha envío diploma</strong>: '+data["envio"]["fechaenvio"]+'<br><strong>Fecha descarga diploma</strong>: '+data["fecharecepcion"]+'</p>');
				// alert(data);
			} 
		}); ajax.abort();

		// $.ajax({
		// 	cache: false,
		// 	type: 'POST',
		// 	url: 'functions/funciones.php',
		// 	data: 'id_matricula='+id_matricula+'&compruebaenviodiplo=1',
		// 	success: function(data) 
		// 	{
		// 		if ( data == "si" )
		// 			$('#impguia').after(estasi);
		// 	} 
		// }); ajax.abort();

		// if ( $('#modalidad').val() == 'A Distancia' )
		// 	$('#impguia').css('display','none');

	});


	$(document).on("click", "#diplomatdgo", function(event) {

		
		var id_matricula = $('#id_matricula').val();
		$('#enviodiplotd').removeClass('disabled');
		window.open('http://gestion.esfocc.com/app/documentacion/generar_diploma_tdn.php?id_matricula='+id_matricula, '_blank');
		// columnas = columnas.replace("div", "td");
		
		// alert(columnas);
		// $('.contenidotxt').html(columnas);

		// var form = $('<form action="documentacion/generar_diploma_tdn.php" target="_blank" name="diplomapdf" id="diplomapdf" method="POST"><input type="hidden" name="id_matricula" id="id_matricula" value="'+id_matricula+'"><input type="hidden" name="columnas" id="columnas" value="'+encodeURI(columnas)+'"></form>');

		// $(form).appendTo('body');
  //       form.submit();

		// window.open('http://gestion.esfocc.com/app/documentacion/generar_diploma_tdn.php?id_matricula='+id_matricula+'&fuente='+fuente, '_blank');

		// $.ajax({
		// 	cache: false,
		// 	type: 'POST',
		// 	url: 'functions/funciones.php',
		// 	data: 'id_matricula='+id_matricula+'&compruebavin=1',
		// 	success: function(data) 
		// 	{
		// 		if (data != 0)
		// 			window.open('http://gestion.esfocc.com/app/documentacion/diplomas/certificado_imparticion.php?id_matricula='+id_matricula, '_blank');

		// 	} 
		// }); ajax.abort();

	});

	$(document).on("click", "#guiadelalumno", function(event) {

		var id_matricula = $('#id_matricula').val();
		var input_guia = '<div style="margin-top: 15px; text-align: center; overflow: auto"><a id="verguia" style="margin-right: 20px" href="#" class="btn btn-success"><span class="glyphicon glyphicon-eye-open"></span> Ver Guía del Alumno</a><a href="#" id="impguia" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar Guía del Alumno</a></div>';
		var estasi = '<span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span>';

		$('#mostrardatos').modal('show');
		$('button#guardarcambios').css('display','none');
		$('.modal-dialog').css('width','500px');
		$('.mostrartitulo').html("Guía Del Alumno");
		$('.contenido').html(input_guia);

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&compruebaenvioguia=1',
			success: function(data) 
			{
				if ( data == "si" )
					$('#impguia').after(estasi);
			} 
		}); ajax.abort();

		if ( $('#modalidad').val() == 'A Distancia' )
			$('#impguia').css('display','none');

	});


	$(document).on("click", "#verguia", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		window.open('http://gestion.esfocc.com/app/documentacion/guias/guiadelalumno.php?id_matricula='+id_matricula, '_blank');


	});


	$(document).on("click", "#impguia", function(event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();

		$(this).find('span').toggleClass('glyphicon-envelope glyphicon-refresh');
		$(this).find('span').addClass('spin');

		$.ajax({
		    cache: false,
		    type: 'POST', 
		    url: 'documentacion/guias/guiadelalumno.php',
		    data: 'id_matricula='+id_matricula+'&enviomail=1',
		    success: function(data) 
		    {
		    	$('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-envelope');
		    	$('.glyphicon-envelope').removeClass('spin');
				alert(data);
		    }
    	}); ajax.abort();

	});
	
	
	$(document).on("click", "#guiadelalumnomtodos", function(event) { // SOLO FUNCIONA CON POCOS ALUMNOS - PDFS
		

		var id_matricula = $('#id_matricula').val();
		window.open('http://gestion.esfocc.com/app/documentacion/guias/guiadelalumnomixto.php?id_matricula='+id_matricula, '_blank');


	});

	$(document).on("click", "#guiadelalumnom", function(event) {

		var id_matricula = $('#id_matricula').val();
		
		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones.php',
			data: 'id_matricula='+id_matricula+'&alumnosguias=1'+'&tipo=bonificado'+'&mod=p',
			success: function(data) 
			{
				$('#mostrardatos').modal('show');
				$('.modal-dialog').css('width','900px');
				$('.mostrartitulo').html("Guía Del Alumno");
				$('.contenido').html(data);
			} 
		}); ajax.abort();


	});

	$(document).on("click", "#guiadelalumnomprivado", function(event) {

		var id_matricula = $('#id_matricula').val();
		
		if ( sec[1] == 'form_matricula_doc' ) {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_matricula='+id_matricula+'&alumnosguias=1'+'&tipo=privado'+'&mod=o',
				success: function(data) 
				{
					$('#mostrardatos').modal('show');
					$('.modal-dialog').css('width','900px');
					$('.mostrartitulo').html("Guía Del Alumno");
					$('.contenido').html(data);
				} 
			}); ajax.abort();

		} else {


			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones.php',
				data: 'id_matricula='+id_matricula+'&alumnosguias=1'+'&tipo=privado'+'&mod=p',
				success: function(data) 
				{
					$('#mostrardatos').modal('show');
					$('.modal-dialog').css('width','900px');
					$('.mostrartitulo').html("Guía Del Alumno");
					$('.contenido').html(data);
				} 
			}); ajax.abort();

		}	


	});


	$(document).on("click", "#guiadelalumnomp", function(event) {

		var id_matricula = $('#id_matricula').val();
		var id_alumno = $(this).attr('name');
		var nuser = $(this).attr('user');
		var user = $('#user'+nuser).val();;
		var pass = $('#pass'+nuser).val();;
		var tipo = $(this).attr('tipo');

		if ( sec[1] == 'form_matricula_doc' || sec[1] == 'matricula' ) {
			var mod = 'o';
			window.open('http://gestion.esfocc.com/app/documentacion/guias/guiadelalumno.php?id_matricula='+id_matricula+'&id_alumno='+id_alumno+'&user='+user+'&pass='+pass+'&mod='+mod+'&tipo='+tipo, '_blank');		
		}
		else {
			var mod = 'p';
			window.open('http://gestion.esfocc.com/app/documentacion/guias/guiadelalumnomixtoind.php?id_matricula='+id_matricula+'&id_alumno='+id_alumno+'&user='+user+'&pass='+pass+'&mod='+mod+'&tipo='+tipo, '_blank');		
		}

		

	});
	
	$(document).on("change", "#fechaini", function (event)  {

		var fechaini = $('#fechaini').val();
		fechaini = fechaini.substr(0,4);
		var anio = $('p#anio').text();

		// if ( parseInt(fechaini) > parseInt(anio) ) {
		// 	alert("La fecha de inicio de la matrícula es 2015. Estás en la base de datos de 2014.");
		// 	$('#fechaini').val('');
		// } 
		// else if ( parseInt(fechaini) < parseInt(anio) ) {
		// 	alert("La fecha de inicio de la matrícula es 2014. Estás en la base de datos de 2015.");
		// 	$('#fechaini').val('');
		// }

	});

	$(document).on("change", "#tipo_formacion", function (event)  {

		var id_accion = $('#id_accion').val();
		var numeroaccion = $('#numeroaccion').val();
		var optionSelected = $(this).find("option:selected");
	    var valueSelected  = optionSelected.val();
	    
	    if (valueSelected == 'Bonificable') {

	    	$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/grupo_accion.php',
		        data: 'id='+id_accion+'&bonificable=1',
		        success: function(data) 
		        {
					$('#grupoformativo').val(numeroaccion+'/'+data);
					$('#estado').val("Creada");
		        }
    		}); ajax.abort();

	    } else if ( valueSelected == 'Privado' ) {

	    	// if ( sec[1] == 'mixto' || sec[1] == 'mixto#' || sec[1] == 'form_matricula_ini' || sec[1] == 'presencial' || sec[1] == 'presencial#')

	    	$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/grupo_accion.php',
		        data: 'id='+id_accion+'&bonificable=0',
		        success: function(data) 
		        {
					$('#grupoformativo').val(numeroaccion+'/'+data);	
					$('#estado').val("Comunicada");
		        }
    		}); ajax.abort();

	    }

	});

	$(document).on("change", "#bonificable", function (event)  {

		if ( $("#bonificable").is(':checked') ) {

			var bonificable = '3';
			var id_accion = $('#id_accion').val();
			var numeroaccion = $('#numeroaccion').val();

			$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/funciones.php',
		        data: 'id='+id_accion+'&bonificable='+bonificable,
		        success: function(data) 
		        {
					$('#grupoformativo').val(numeroaccion+'/'+data);	
		        }
    		}); ajax.abort();
		} else {
			$('#grupoformativo').val('');
		}

	});


	$(document).on("click", "#mat-seleccionaralumno", function(event){
    	
		event.preventDefault();
		i++;
		ei++;

		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_alumno = parentTr.find('td#id').html();
    	var input_alumno = '<div class="clearfix"></div><div id="alu'+i+'"><input name="id_alumno[]" type="hidden" id="id_alumno'+i+'" value=""/><input name="id_empresa[]" type="hidden" id="id_empresa'+i+'" value=""/><div class="col-md-3"><div class="form-group"><label class="control-label" for="nombre">Nombre:</label><input type="text" id="nombre'+i+'" name="nombre[]" class="required form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="nombre">Apellido:</label><input type="text" id="apellido'+i+'" name="apellido[]" class="required form-control" readonly/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="documento">Nº Documento:</label><input type="text" id="documento'+i+'" name="documento'+i+'" class="required form-control" readonly/></div></div><div class="col-md-3"><div class="checkbox"><label><input style="text-align:center" type="checkbox" name="jornadalaboral['+i+']" value="1">¿ Jornada Laboral ?</label></div></div><div class="col-md-1"><a href="#" id="eliminaralu'+i+'" class="eliminara btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="razonsocial">Empresa:</label><input type="text" id="razonsocial'+i+'" name="razonsocial'+i+'" class=" form-control" readonly/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="cif">CIF:</label><input type="text" id="cif'+i+'" name="cif'+i+'" class=" form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="numerocuenta">Cuenta Cotización:</label><select id="numerocuenta'+i+'" name="numerocuenta[]" class="form-control" readonly></select></div></div></div>';
    	
    	$.ajax({
	        cache: false,
	        type: 'POST', 
	        url: 'functions/funciones.php',
	        data: 'id='+id_alumno+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('hide');
	            
	            if ( ei < 5 ) {
	            	$('.fin_alumno').before(input_alumno);
	            	$('body, html').animate({ scrollTop: $("#nombre"+i).offset().top }, 1000);
	            	$('#id_alumno'+i).val(data[0].id);
	            	$('#nombre'+i).val(data[0].nombre);
	            	$('#apellido'+i).val(data[0].apellido);
		      
		            $('#documento'+i).val(data[0].documento);
		            $('#razonsocial'+i).prop('required',true);
		            $('#cif'+i).prop('required',true);
		            //$('#numerocuenta'+i).prop('required',true);
	            }	            
	        }
    	});
    });
	
    
    $(document).on("click", ".eliminara", function(event){
    	var id = $(this).attr('id').replace('eliminaralu','');
    	$("#alu"+id).remove();
    	ei--;
    	$('body, html').animate({ scrollTop: $("#nombre").offset().top }, 1000);
    });

	$(document).on("click", "#mat-seleccionarempresa", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_empresa = parentTr.find('td#id').html();
    
    	
    	$.ajax({
	        cache: false,
	        type: 'POST',
	        dataType: 'json',
	        url: 'functions/funciones.php',
	        data: 'id='+id_empresa+'&cierra=1'+'&tabla='+tabla+'&mat=1',
	        success: function(data) 
	        {

	        	if ( data[0].disponible == "0" && $('select#tipo_formacion').val() == 'Bonificable' ) {
	            
	            	alert("La empresa "+data[0].razonsocial+" no dispone de crédito.");

	            } else if ( (data['aesfocc'] != 1 || data['aestra'] != 1) && $('select#tipo_formacion').val() == 'Bonificable' ) {

					alert("La empresa "+data[0].razonsocial+" no tiene subidos los dos anexos de encomienda.");	            	

	        	} else {

					$('#mostrardatos').modal('hide');

					if ( ei < 5 ) {
						$('body, html').animate({ scrollTop: $("#razonsocial"+i).offset().top }, 1000);
			         	$('#id_empresa'+i).val(data[0].id);
			            $('#razonsocial'+i).val(data[0].razonsocial);
			            $('#cif'+i).val(data[0].cif);
			            for ( var j = 1; j < data.length; j++ ) {
		            		$('#numerocuenta'+i).removeAttr('readonly').prop('required',true).append('<option value="'+data[j].numerocuenta+'">'+data[j].numerocuenta+'</option>');
		            	}
					}	
				}
		    }   
    	});
    });
    
    $(document).on("click", "#mat-seleccionardocente, #matoini-seleccionardocente", function(event){
    	
    	k++;
    	ek++;
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var input_docente = '<div class="clearfix"></div><div id="doc'+k+'"><input name="id_docente[]" type="hidden" id="id_docente'+k+'" value=""/><div class="col-md-4"><div class="form-group"><label class="control-label" for="nombred'+k+'">Nombre:</label><input type="text" id="nombred'+k+'" name="nombred'+k+'" class="required form-control" readonly/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="apellidod'+k+'">Apellido:</label><input type="text" id="apellidod'+k+'" name="apellidod'+k+'" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="documentod'+k+'">Nº Documento:</label><input type="text" id="documentod'+k+'" name="documentod'+k+'" class="required form-control" readonly/></div></div><div class="col-md-1"><a href="#" id="eliminardoc'+k+'" class="eliminard btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';
    	
    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('hide');

	            if ( ek < 5 ) {

	            	$('.fin_docente').before(input_docente);
		        	$('#id_docente'+k).val(data[0].id);
		            $('#nombred'+k).val(data[0].nombre);
		            $('#apellidod'+k).val(data[0].apellido);
		            $('#documentod'+k).val(data[0].documento);
		            $('body, html').animate({ scrollTop: $("#nombred"+k).offset().top }, 1000);

	            }
	        }
    	});
    });
    
    $(document).on("click", ".eliminard", function(event){
    	var id = $(this).attr('id').replace('eliminardoc','');
    	$("#doc"+id).remove();	
    	$('body, html').animate({ scrollTop: $("#nombred").offset().top }, 1000);
    });
    
    $(document).on("click", "#mat-seleccionaraccion, #matoini-seleccionaraccion", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_accion = parentTr.find('td#id').html();
    	var modalidad = parentTr.find('td#modalidad').html();
    	// alert(modalidad);
    	
    	// if ( modalidad == 'A Distancia' ) {
    	// 	alert("No se pueden crear matrículas de distancia.")
    	// 	return false;
    	// }

    	
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
	            if ( $('#modalidad').val() == 'Presencial' || $('#modalidad').val() == 'Mixta'  )
	            	$('#datoscentro').css('display','block');
	            else 
	            	$('#datoscentro').css('display','none');

	            
	            var precioventamat = 0;
	            var precio = 0;
	            
	            if ( data[0].modalidad == "Teleformación" ) {
	            	precio = 7.5;
	            	$('#costeaula').val(0);
	            	$('#fungibledidac').val(0);
	            } else if ( data[0].modalidad == "A Distancia" ) { 
	            	precio = 5.5;
	            	$('#costeaula').val(0);
	            }


	            precioventamat = precio*$('#horastotales').val();
	            $('#precioventamat').attr("placeholder",precioventamat+" (max. bonificable)");
	            if ( sec[1] == 'form_matricula_ini' || sec[1] == 'form_matricula_ini#' )
	            	$('#alumnosestimados').attr("placeholder","80");
	            else
	            	$('#alumnosestimados').attr("placeholder","1");
	        }
    	});
    });
    
    $(document).on("click", "#matm-seleccionaraccion", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
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
            	$('#datoscentro').css('display','block');

	        }
    	});
    });
    

    $(document).on("click", "#mat-seleccionarmat", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();
    	var btnalumno = '<a href="#" data-toggle="modal" id="btnalumnos" name="alumnos" class="mostrarMatriculados btn btn-block btn-lg btn-default"><span class="glyphicon glyphicon-pencil"></span> Alumnos</a>';

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_matricula+'&cierra=1'+'&tabla='+tabla+'&devolvermat=1',
	        dataType: 'json',
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('hide');


	            $('.back').css('display','block');

		        // alert(data[0].contenido);
		        
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
		        // 

	            if ( $('#datoscostes').is(':visible') )
	            	$('#datoscostes').css('display','none');
	            $('#datosaccion').css('display','block');    
	            $('#datostutoria').css('display','block');
	            $('.btnmatriculas').css('display','block');
	            // $('#bonificable').removeAttr('disabled');
	            $('#btnalumnose').css('display','inline-block');
				$('#btnempresase').css('display','inline-block');
				$('#btndocentese').css('display','inline-block');
				$('#informe-online').css('display','inline-block');
				$('#costesfactuind').css('display','inline-block');
				$('.formulariomatricula').get(0).reset();
	            $('#id_matricula').val(data[0].id);
	            $('#id_accion').val(data[0].id_accion);
	            $('#externo').val(data[0].externo);
	            $('#numeroaccion').val(data[0].numeroaccion);
	            $('#denominacion').val(data[0].denominacion);
	            $('#horastotales').val(data[0].horastotales);
	            $('#fechaini').val(data[0].fechaini);
	            $('#fechafin').val(data[0].fechafin);
	            $('#cobservacionesfin,#cobservacionesfinamanda').css('display','block');
				$('#observacionesfin').val(data[0].observacionesfin);
				$('#observacionesfinamanda').val(data[0].observacionesfinamanda);

	         
	            
	            var modalidad = data[0].modalidad;
	            $('#modalidad').val(modalidad);
	            	
	            numalumnos = data[1].cuentas;
	            numdocentes = data[2].cuentas;	  
	            $('.numalumnos').remove();
	            $('.numdocentes').remove();          
	            $('#btnalumnose').before('<div class="numalumnos">Alumnos matriculados: <span class="nalu">'+numalumnos+'</span></div>');
	            $('#btndocentese').before('<div class="numdocentes">Docentes asignados: <span class="ndoc">'+numdocentes+'</span></div>');
	            $('#grupoformativo').val('');

	            var grupo = data[0].ngrupo;
	            $('#tipo_formacion').attr('disabled', true);
	            $('#grupoformativo').val(data[0].numeroaccion+"/"+grupo);
	            if ( grupo.indexOf('p') == -1  ) { // bonificado
	            	$('#tipo_formacion').val('Bonificable');
	            } else {
	            	$('#tipo_formacion').val('Privado');
	            }

	            $('#btnsubidas').css('display','inline-block');
	            $('#diplomatdn').css('display','inline-block');
	            $('#diplomatd').css('display','inline-block');
	            $('#vin').css('display','inline-block');
	            $('#guiadelalumno').css('display','inline-block');
	            $('#acuerdocolaboracion').css('display','inline-block');

	            var estado = data[0].estado;
	            $('#estado').val(estado);
	            if (estado == 'Creada')        
            		$('#xmlfin').css('display','none');
            	else
            		$('#xmlfin').css('display','inline-block');

	            $('#horariomini').val(data[0].horariomini);
	            $('#horariomfin').val(data[0].horariomfin);
	            $('#horariotini').val(data[0].horariotini);
	            $('#horariotfin').val(data[0].horariotfin);
	            $('#observaciones').val(data[0].observaciones);
	            $('#observacionesfin').val(data[0].observacionesfin);
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

	            $('#cuadrocostes').css('display','block');	     
	            $('#datosrentabilidad').css('display','block');

	            // if ( data[3].precioventamat.length >0 || data[4].precioventamat.length >0 ) {

		            if ( data[3].comercialempresa == undefined ) {
		            	alert("La empresa no tiene comercial asignado.");
		            	$('#precioventamat').val(data[3].precioventamat);	        
			            $('#fungibledidac').val(data[3].fungibledidac);	        
			            $('#costeaula').val(data[3].costeaula);	        
			            $('#costedocente').val(data[3].costedocente);	        
			            $('#alumnosestimados').val(data[3].alumnosestimados);	        
			            $('#totalingresos').val(data[3].totalingresos);	        
			            $('#totalcostes').val(data[3].totalcostes);	        
			            $('#administracion').val(data[3].administracion);	        
			            $('#margenbeneficio').val(data[3].margenbeneficio);	        
			            $('#porcentajeventas').val(data[3].porcentajeventas);
			            $('#ventasrequerido').val(data[3].ventasrequerido);
			        	$('#nalumnosnecesario').val(data[3].nalumnosnecesario);
			            $('#otrosgastos').val(data[3].otrosgastos);	     
		            } else {
		            	$('#precioventamat').val(data[4].precioventamat);	        
			            $('#fungibledidac').val(data[4].fungibledidac);	        
			            $('#costeaula').val(data[4].costeaula);	        
			            $('#costedocente').val(data[4].costedocente);	        
			            $('#alumnosestimados').val(data[4].alumnosestimados);	        
			            $('#totalingresos').val(data[4].totalingresos);	        
			            $('#totalcostes').val(data[4].totalcostes);	        
			            $('#administracion').val(data[4].administracion);	        
			            $('#margenbeneficio').val(data[4].margenbeneficio);	        
			            $('#porcentajeventas').val(data[4].porcentajeventas);
			            $('#ventasrequerido').val(data[4].ventasrequerido);
			            $('#nalumnosnecesario').val(data[4].nalumnosnecesario);
			            $('#otrosgastos').val(data[4].otrosgastos);
		            }
		        // }
	            

	            if ( estado == 'Facturada' )
		        	$('input[name=submit]').css('display', 'none');
		        else
		        	$('input[name=submit]').css('display', 'inline-block'); 

		        
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

				

		        // alert("sale");

	            
	        }
    	}); ajax.abort();
    });

	
	$('#confirmar').on('hide.bs.modal', function () {
		$('#mostrardatos').css('z-index','1040');
	});


	$(document).on("click", "#btncredenciales", function(event){

		event.preventDefault();
		var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_alumno = parentTr.find('td#id').html();

    	if (id_alumno == undefined)
    		id_alumno = $("#id_alumno").val();

    	var id_matricula = $('#id_matricula').val();
    	var sec = $(location).attr('href').split("?");
		var input_guardar = '<button id="guardarcredenciales" type="button" class="btn btn-primary" data-dismiss="modal" style="display: inline-block;">Guardar</button>';
    	
		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id_alumno='+id_alumno+'&id_mat='+id_matricula+'&cuadrocredenciales=1',
	        success: function(data) 
	        {
	            $('#mostrardatosc').modal('toggle');
	            $('#mostrardatosc .mostrartitulo').html('Credenciales del alumno');
	            $('#mostrardatosc .contenido').html(data);
	            if ( sec[1] != 'tutorias' && sec[1] != 'tutorias#' )
	            	$('#mostrardatosc .modal-footer').html(input_guardar);
	            else {
	            	$('#usuario').attr('disabled','true');
	            	$('#password').attr('disabled','true');
	            }
	        }
    	});
		
	});

	$(document).on("click", "#guardarcredenciales", function(event){

		event.preventDefault();
		var user = $('#usuario').val();
		var pass = $('#pass').val(); 
		var id_alu = $('#id_alu').val();
		var id_mat = $('#id_mat').val();
		
		$.ajax({
			cache: false,
			type: 'POST', 
			url: 'functions/funciones.php',
			data: 'id_mat='+id_mat+'&id_alu='+id_alu+'&user='+user+'&pass='+pass+'&guardarcredenciales=1',
			success: function(data) 
			{
			  	$('#mostrardatosc').modal('hide');
			  	// $('#mostrardatos').modal('hide');		    
			   	// $('#confirmacion').html("Credenciales guardadas");
			  	// $('#confirmacion').show(500).delay(2000).hide('slow');
			}
	    }); ajax.abort();			    
		
	});

	$(document).on("click", "#mat-seleccionaralumnomat", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_alumno = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();
    	// alert(id_alumno+id_matricula);
    	
    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');

		$('#aceptacambios').on('click', function(event){
					
			$('#confirmar').modal('hide');
		       
		    $.ajax({
		    	cache: false,
		        url: "functions/funciones.php",
		        type: "post",
		        data: 'id_alumno='+id_alumno+'&id_matricula='+id_matricula+'&eliminardematricula=1',
		        success: function(result){
		        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');
			       	else {
			       		$(parentTr).remove();
			       		numalumnos--;
			       		$('.nalu').html(numalumnos);
			       		//$('#confirmacion').html("Alumno eliminado correctamente da la matrícula");
			       		//$('#confirmacion').show(500).delay(3000).hide('slow');
			       	}	
			    },
			    error:function(){
			        alert("failure");
			    }
    		});	ajax.abort();
		});
    });

	$(document).on("change", ".jornada", function (event)  {

		var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_alumno = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();

		if ( $(".jornada").is(':checked') ) {
			var jornadalaboral = '1';
		} else {
			var jornadalaboral = '0';
		}

			$.ajax({
		        cache: false,
		        type: 'POST', 
		        url: 'functions/funciones.php',
		        data: 'id_alumno='+id_alumno+'&id_matricula='+id_matricula+'&jornadalaboral='+jornadalaboral+'&cambiajornada=1',
		        success: function(data) 
		        {
					alert(data);	
		        }
    		}); ajax.abort();
	});

	$(document).on("click", "#btndocentesmpre", function(event) {

		event.preventDefault();
		var tabla = 'docentes';
		var mat = 'docentempre';
		var id_mat = '0';
				
		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tabla='+tabla+'&abre=1'+'&mat='+mat+'&id_mat='+id_mat,
	        success: function(data) 
	        {
	        	$('#mostrardatos').modal('show');
	            $('.mostrartitulo').html("Mostrando datos de "+tabla);
	            $('.contenido').html("Cargando...");
	            $('.contenido').html(data);
	        } 
    	}); ajax.abort();

		
	});
	
	$(document).on("click", "#btndocentesmod", function(event){
		
		event.preventDefault();
		k++;
		var tabla = 'docentes';
		var mat = 'docentemod';
		var id_mat = '0';
		
		$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tabla='+tabla+'&abre=1'+'&mat='+mat+'&id_mat='+id_mat,
	        success: function(data) 
	        {
	        	$('#mostrardatos').modal('show');
	            $('.mostrartitulo').html("Mostrando datos de "+tabla);
	            $('.contenido').html("Cargando...");
	            $('.contenido').html(data);
	        } 
    	}); ajax.abort();
	});

	$(document).on("click", "#matmpre-seleccionardocente", function(event){
		
		event.preventDefault();
		k++;
		var tabla = 'docentes';
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	// var input_docente = '<div class="clearfix"></div><div id="doc'+k+'"><input name="id_docente[]" type="hidden" id="id_docente'+k+'" value=""/><div class="col-md-2"><div class="form-group"><label class="control-label" for="nombred'+k+'">Nombre:</label><input type="text" id="nombred'+k+'" name="nombred'+k+'" class="form-control" readonly/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="fechadocini'+k+'">Fecha Inicio:</label><input type="date" id="fechadocini'+k+'" name="fechadocini'+k+'" class="form-control" /></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="fechadocfin'+k+'">Fecha Fin:</label><input type="date" id="fechadocfin'+k+'" name="fechadocfin'+k+'" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="horariodoc'+k+'">Horario:</label><input type="text" id="horariodoc'+k+'" name="horariodoc'+k+'" placeholder="08:00 - 10:30 | 15:01 - 17:00" class="form-control" /></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="numhorasdoc'+k+'">Nº Horas:</label><input type="text" id="numhorasdoc'+k+'" name="numhorasdoc'+k+'" placeholder="2" class="form-control" /></div></div><div class="col-md-1"><a id="eliminardoc'+k+'" class="eliminard btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';
    	var input_docente = '<div class="clearfix"></div><div id="predoc'+k+'"><input name="id_docentempre[]" type="hidden" id="id_docentempre'+k+'" value=""/><div class="col-md-4"><div class="form-group"><label class="control-label" for="nombrempre'+k+'">Nombre:</label><input type="text" id="nombrempre'+k+'" name="nombrempre'+k+'" class="required form-control" readonly/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="apellidompre'+k+'">Apellido:</label><input type="text" id="apellidompre'+k+'" name="apellidompre'+k+'" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="documentomod'+k+'">Nº Documento:</label><input type="text" id="documentomod'+k+'" name="documentomod'+k+'" class="required form-control" readonly/></div></div><div class="col-md-1"><a href="#" id="eliminarmpre'+k+'" class="eliminarmprep btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';
    	
    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('hide');

	            if ( ek < 5 ) {

	            	$('.fin_docentepre').before(input_docente);
		        	$('#id_docentempre'+k).val(data[0].id);
		            $('#nombrempre'+k).val(data[0].nombre);
		            $('#apellidompre'+k).val(data[0].apellido);
		            $('#documentomod'+k).val(data[0].documento);
		            $('body, html').animate({ scrollTop: $("#nombrempre"+k).offset().top }, 1000);

	            }
	        }
    	});

		
	});
	
	$(document).on("click", ".eliminarmprep", function(event){ 
		
		var id = $(this).attr('id').replace('eliminarmpre','');
    	$("#predoc"+id).remove();	
    	$('body, html').animate({ scrollTop: $("#nombrempre").offset().top }, 1000);
    	
    });
			
	$(document).on("click", ".eliminarmodp", function(event){ 
		
		var id = $(this).attr('id').replace('eliminarmod','');
    	$("#oddoc"+id).remove();	
    	$('body, html').animate({ scrollTop: $("#nombrempre").offset().top }, 1000);
		
	});
	
	$(document).on("click", "#matmpod-seleccionardocente", function(event){
		
		event.preventDefault();
		var tabla = 'docentes';
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var input_docente = '<div class="clearfix"></div><div id="oddoc'+k+'"><input name="id_docenteod[]" type="hidden" id="id_docenteod'+k+'" value=""/><div class="col-md-4"><div class="form-group"><label class="control-label" for="nombremod'+k+'">Nombre:</label><input type="text" id="nombremod'+k+'" name="nombremod'+k+'" class="required form-control" readonly/></div></div><div class="col-md-4"><div class="form-group"><label class="control-label" for="apellidomod'+k+'">Apellido:</label><input type="text" id="apellidomod'+k+'" name="apellidomod'+k+'" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="documentompre'+k+'">Nº Documento:</label><input type="text" id="documentompre'+k+'" name="documentompre'+k+'" class="required form-control" readonly/></div></div><div class="col-md-1"><a href="#" id="eliminarmod'+k+'" class="eliminarmodp btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></div></div>';
    	
    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'id='+id_docente+'&cierra=1'+'&tabla='+tabla,
	        dataType: 'json',
	        success: function(data) 
	        {
	            $('#mostrardatos').modal('hide');

	            if ( ek < 5 ) {

	            	$('.fin_docenteod').before(input_docente);
		        	$('#id_docenteod'+k).val(data[0].id);
		            $('#nombremod'+k).val(data[0].nombre);
		            $('#apellidomod'+k).val(data[0].apellido);
		            $('#documentompre'+k).val(data[0].documento);
		            $('body, html').animate({ scrollTop: $("#nombremod"+k).offset().top }, 1000);

	            }
	        }
    	});
		
	});

	$(document).on("click", "#mat-seleccionardocentemat", function(event){
    	
		event.preventDefault();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_docente = parentTr.find('td#id').html();
    	var id_matricula = $('#id_matricula').val();
    	//alert(id_docente+id_matricula);
    	
    	$('#mostrardatos').css('z-index','1030');
    	$('#confirmar').modal('show');

		$('#aceptacambios').on('click', function(event){
					
			$('#confirmar').modal('hide');
		    $('#mostrardatos').modal('hide');

		    $.ajax({
		    	cache: false,
		        url: "functions/funciones.php",
		        type: "post",
		        data: 'id_docente='+id_docente+'&id_matricula='+id_matricula+'&eliminardematricula=1',
		        success: function(result){		        
			       	if (result == '1')
			       		$('#error').show(500).delay(5000).hide('slow');		       	
			       	else {
			       		$(parentTr).remove();
			       		numdocentes--;
			       		$('.ndoc').html(numdocentes);
			       		$('#confirmacion').html("Docente eliminado correctamente da la matrícula");			 
			       		$('#confirmacion').show(500).delay(2000).hide('slow');
			       		setTimeout(function(){location.reload();},2200);
					}
			    },
			    error:function(){
			        alert("failure");
			    }
    		});	ajax.abort();
		});
    });

	$(document).on("click", "#guardarcambios", function(event){
    	
		event.preventDefault();
		$('#confirmacion').html("Matrícula modificada correctamente.");			 
		$('#confirmacion').show(500).delay(2000).hide('slow');
		setTimeout(function(){location.reload();},2200);
		
    });
    

	$('.formulariomatricula').validate({
					
		submitHandler: function(form) { 
			
			if ( comprobarHorario() === false )
				return false;

			if ( $('#id_accion').val() == "" ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes seleccionar una acción.");
				return false;
			}

			var optionSelected = $('#tipo_formacion').find("option:selected");
	    	var valueSelected  = optionSelected.val();

			if ( valueSelected == '' ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes indicar si la formación es bonificada o privada.");
				return false;
			} else {
				$('#tipo_formacion').attr('disabled',true);
			}
			

			if ( ei < 1 && $('#id_matricula').val() == "" ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes introducir al menos un alumno.");
				return false;
			}
			if ( ek < 1 && $('#id_matricula').val() == "" ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes introducir al menos un docente.");
				return false;
			}	
			if ( ek < 1 && $('#id_matricula').val() == "" ) {
				$('#alerta-error').modal('show');
				$('.mensaje-error').html("Debes introducir al menos un docente.");
				return false;
			}	

			
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
					$('#mostrardatos').modal('show');
					$('mostrartitulo').html("Matrículas coincidentes en estas fechas");
					$('.contenido').html(data);							
				} 
			});
			
			$('#confirmar').modal('show');

			var values = $(form).find("input[type='hidden'], :input:not(:hidden)").serialize();
			alert(values);
			
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
			    
		    	//alert(values);
			    $.ajax({
			    	cache: false,
			        url: "forms/procesar_forms.php",
			        type: "post",
			        data: values,
			        success: function(data){
			        	$('body, html').animate({ scrollTop: $(".navbar").offset().top }, 1000);
			        	if (data == '1')
			        		$('#error').show(500).delay(5000).hide('slow');
			        	else {
			        		$('#confirmacion').show(500).delay(2000).hide('slow');	
			        		setTimeout(function(){location.reload();},2200);
			        	}
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