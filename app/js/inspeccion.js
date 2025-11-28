
	var estasi = '<div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: green;" class="glyphicon glyphicon-ok-circle"></span></div>';
	var estano = '<div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: red;" class="glyphicon glyphicon-ok-circle"></span></div>';


$(document).ready(function() {

	$(document).on("click", "#inspec-seleccionarmat", function (event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();

    	var btnpremix = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form style="overflow:auto;" id="req1" action="" method="post" enctype="multipart/form-data"><label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><div style="float:left;margin-bottom:20px" id="comprequerimiento"></div></form><div class="clearfix"></div>';

    	var btnonline = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="online" action="" method="post" enctype="multipart/form-data"><label> Justificante entrega de certificado: </label><br><input style="float:left" type="file" name="onlinecert" id="onlinecert" class="btn btn-default"/><a id="subirpdfonlinecert" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfonlinecert" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp"></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="online1" action="" method="post" enctype="multipart/form-data"><label> RLT: </label><br><input style="float:left" type="file" name="onlinerlt" id="onlinerlt" class="btn btn-default"/><a id="subirpdfonlinerlt" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfonlinerlt" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comprlt1"></div><div class="clearfix"></div></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="req1" action="" method="post" enctype="multipart/form-data"><label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><div style="float:left;" id="comprequerimiento"></div></form><div class="clearfix"></div></div>';

    	var btnonlineEmps = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="req1" action="" method="post" enctype="multipart/form-data"><label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comprequerimiento"></div><div class="clearfix"></div></div><hr></div>';

    	var btndist = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="distancia1" action="" method="post" enctype="multipart/form-data"><label> Justificante entrega de certificado: </label><br><input style="float:left" type="file" name="distcert" id="distcert" class="btn btn-default"/><a id="subirpdfdistcert" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistcert" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp1"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia2" action="" method="post" enctype="multipart/form-data"><label> Retorno: </label><br><input style="float:left" type="file" name="distretorno" id="distretorno" class="btn btn-default"/><a id="subirpdfdistretorno" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistretorno" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp2"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia3" action="" method="post" enctype="multipart/form-data"><label> Examen: </label><br><input style="float:left" type="file" name="distexamen" id="distexamen" class="btn btn-default"/><a id="subirpdfdistexamen" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistexamen" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp3"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia4" action="" method="post" enctype="multipart/form-data"><label> Cuestionario: </label><br><input style="float:left" type="file" name="distcuest" id="distcuest" class="btn btn-default"/><a id="subirpdfdistcuest" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistcuest" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp4"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia5" action="" method="post" enctype="multipart/form-data"><label> RLT: </label><br><input style="float:left" type="file" name="distrlt" id="distrlt" class="btn btn-default"/><a id="subirpdfdistrlt" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistrlt" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp5"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="req1" action="" method="post" enctype="multipart/form-data"><label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><div style="float:left;" id="comprequerimiento"></div></form><div class="clearfix"></div>';

    	var btndistEmps = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia2" action="" method="post" enctype="multipart/form-data"><label> Retorno: </label><br><input style="float:left" type="file" name="distretorno" id="distretorno" class="btn btn-default"/><a id="subirpdfdistretorno" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistretorno" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp2"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia3" action="" method="post" enctype="multipart/form-data"><label> Examen: </label><br><input style="float:left" type="file" name="distexamen" id="distexamen" class="btn btn-default"/><a id="subirpdfdistexamen" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistexamen" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp3"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia4" action="" method="post" enctype="multipart/form-data"><label> Cuestionario: </label><br><input style="float:left" type="file" name="distcuest" id="distcuest" class="btn btn-default"/><a id="subirpdfdistcuest" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistcuest" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp4"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px" class="col-md-12"><form id="distancia5" action="" method="post" enctype="multipart/form-data"><label> RLT: </label><br><input style="float:left" type="file" name="distrlt" id="distrlt" class="btn btn-default"/><a id="subirpdfdistrlt" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfdistrlt" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp5"></div></div><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="req1" action="" method="post" enctype="multipart/form-data"><label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a><div style="float:left;" id="comprequerimiento"></div></form><div class="clearfix"></div>';

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones_inspeccion.php',
	        data: 'id_mat='+id_matricula+'&accion=obtener',
	        dataType: 'json',
	        success: function(data)
	        {
	            $('#mostrardatos').modal('hide');
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
	            var modalidad = data[0].modalidad;
	            $('#modalidad').val(data[0].modalidad);
	            var grupo = data[0].grupo;

	            if ( modalidad == 'Teleformación' ) {

	            	if ( grupo == 0 ) {

		            	$('.inspec-upload').html(btnonline);

		            	if ( data.existe_onlinecert == 1 )
		            		$('#comp').html(estasi);
		            	else
		            		$('#comp').html(estano);

	            	} else {

						$('.inspec-upload').html(btnpremix);
	            		$('form#req1').after(data.inputsemp);
	            		// $('.inspec-upload').before(data.inputsemp);
	            		// $('#descargarexpedienteonline').before(data.inputsemp);

	            	}

	            	if ( data.existe_onlinerlt == 1 )
	            		$('#comprlt1').html(estasi);
	            	else
	            		$('#comprlt1').html(estano);


	            } else {

	            	if ( grupo == 0 ) {

		            	$('.inspec-upload').html(btndist);

		            	if ( data.existe_distcert == 1 )
		            		$('#comp1').html(estasi);
		            	else
		            		$('#comp1').html(estano);

	            	} else {

	            		$('.inspec-upload').html(btndistEmps);

		            	$('#descargarexpedientedist').before(data.inputsemp);

		            }

		            	if ( data.existe_distretorno == 1 )
		            		$('#comp2').html(estasi);
		            	else
		            		$('#comp2').html(estano);

		            	if ( data.existe_distexamen == 1 )
		            		$('#comp3').html(estasi);
		            	else
		            		$('#comp3').html(estano);

		            	if ( data.existe_distcuest == 1 )
		            		$('#comp4').html(estasi);
		            	else
		            		$('#comp4').html(estano);

		            	if ( data.existe_distrlt == 1 )
		            		$('#comp5').html(estasi);
		            	else
		            		$('#comp5').html(estano);

	            }

	            if ( data.existe_requerimiento == 1 )
	            	$('#comprequerimiento').html(estasi);
	            else
	            	$('#comprequerimiento').html(estano);


	        }
    	}); ajax.abort();

  	});


	$(document).on("click", "#inspecpm-seleccionarmat", function (event) {

		event.preventDefault();
		var id_matricula = $('#id_matricula').val();
		var tabla = $(this).attr('name');
        var button = $(this);
    	var parentTd = button.parent('td');
    	var parentTr = parentTd.parent('tr');
    	var id_matricula = parentTr.find('td#id').html();

    	var btnpremix = '<div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form style="overflow:auto;" id="req1" action="" method="post" enctype="multipart/form-data"> <label> Requerimiento: </label><br><input style="float:left" type="file" name="requerimiento" id="requerimiento" class="btn btn-default"/><a id="subirpdfrequerimiento" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfrequerimiento" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a> <div style="float:left;margin-bottom:20px" id="comprequerimiento"></div></form><div class="clearfix"></div><div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form style="overflow:auto;" id="formlistadoessscan" action="" method="post" enctype="multipart/form-data"> <label> Listado ESSSCAN: </label><br><input style="float:left" type="file" name="listadoessscan" id="listadoessscan" class="btn btn-default"/><a id="subirpdflistadoessscan" class="boton btn btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdflistadoessscan" style="" class="boton btn btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a> <div style="float:left;margin-bottom:20px" id="complistadoessscan"></div></form><div class="clearfix"></div>';

    	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones_inspeccion.php',
	        data: 'id_mat='+id_matricula+'&accion=obtener',
	        dataType: 'json',
	        success: function(data)
	        {

	            $('#mostrardatos').modal('hide');
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
	            var modalidad = data[0].modalidad;
	            $('#modalidad').val(data[0].modalidad);
	            // alert(btnpremix);
	            // alert(data.inputsemp);
	            $('.inspec-premix').html(btnpremix);
	            $('#formlistadoessscan').after(data.inputsemp);
	            // alert(data.inputsemp);
	            // if ( data.existe_pmcert == 1 )
	            // 	$('#comp1').html(estasi);
	            // else
	            // 	$('#comp1').html(estano);
	            // if ( data.existe_pmmaterial == 1 )
	            // 	$('#comp2').html(estasi);
	            // else
	            // 	$('#comp2').html(estano);
	            // if ( data.existe_pmlistasist == 1 )
	            // 	$('#comp3').html(estasi);
	            // else
	            // 	$('#comp3').html(estano);
	            if ( data.existe_pmfichasist == 1 )
	            	$('#comp4').html(estasi);
	            else
		            $('#comp4').html(estano);
		        if ( data.existe_pmexamen == 1 )
	            	$('#comp5').html(estasi);
	            else
		            $('#comp5').html(estano);
		        if ( data.existe_pmcuest == 1 )
	            	$('#comp6').html(estasi);
	            else
		            $('#comp6').html(estano);
		        if ( data.existe_pmrlt == 1 )
	            	$('#comp7').html(estasi);
	            else
		            $('#comp7').html(estano);

		        if ( data.existe_requerimiento == 1 )
	            	$('#comprequerimiento').html(estasi);
	            else
	            	$('#comprequerimiento').html(estano);

	            if ( data.existe_listadoessscan == 1 )
	            	$('#complistadoessscan').html(estasi);
	            else
	            	$('#complistadoessscan').html(estano);

	            $('#mediainicial').val(data[0].mediainicial);
	            $('#mediafinal').val(data[0].mediafinal);
	            $('#valoracioncurso').val(data[0].valoracioncurso);

	            console.log($('#userapp').val());
	            if ( $('#userapp').val() == 'inspeccion' ) {
	            	console.log("inspeccion");
	            	$('a[id^=subirpdf]').css('display', 'none');
	            } else {
	            	$('a[id^=subirpdf]').css('display', 'inline-block');
	            }


	        }
    	}); ajax.abort();

  	});


	$(document).on("click","[id^=subirpdfpmemps]", function (event) {


		var valor = $(this).attr('id');
		// alert(valor);
		valor = valor.split("-");
		var id_emp = valor[1];

		var formData = new FormData();
		formData.append('file', $('#pmemps-'+id_emp).get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('id_emp', id_emp);
        formData.append('doc', 'pmemps');
        formData.append('accion', 'subir');

        if ( $('#pmemps-'+id_emp).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp-'+id_emp+'-asist').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp-'+id_emp+'-asist').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdfpmemps]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=pmemps',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

	$(document).on("click","#subirpdfonlinecert", function (event) {

		// alert("hey");
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#onlinecert').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'onlinecert');
        formData.append('accion', 'subir');

        if ( $('#onlinecert').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });


	$(document).on("click","#mostrarpdfonlinecert", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=onlinecert',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


	$(document).on("click","#descargarexpedienteonline", function (event) {

    	var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=zip',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay ningún PDF subido u ocurrió algún error.");
				else
					window.location.href = data;
		    }
    	}); ajax.abort();

    });


	$(document).on("click","#subirpdfonlinerlt", function (event) {

		// alert("hey");
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#onlinerlt').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'onlinerlt');
        formData.append('accion', 'subir');

        if ( $('#onlinerlt').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comprlt1').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comprlt1').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfonlinerlt", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=onlinerlt',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


    $(document).on("click","#subirpdfdistcert", function (event) {

		var formData = new FormData();
		formData.append('file', $('#distcert').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'distcert');
        formData.append('accion', 'subir');

        if ( $('#distcert').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp1').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp1').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfdistcert", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=distcert',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

	$(document).on("click","#subirpdfdistretorno", function (event) {

		var formData = new FormData();
		formData.append('file', $('#distretorno').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'distretorno');
        formData.append('accion', 'subir');

        if ( $('#distretorno').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp2').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp2').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfdistretorno", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=distretorno',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    $(document).on("click","#subirpdfdistexamen", function (event) {

		var formData = new FormData();
		formData.append('file', $('#distexamen').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'distexamen');
        formData.append('accion', 'subir');

        if ( $('#distexamen').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp3').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp3').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfdistexamen", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=distexamen',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


	$(document).on("click","#subirpdfdistcuest", function (event) {

		var formData = new FormData();
		formData.append('file', $('#distcuest').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'distcuest');
        formData.append('accion', 'subir');

        if ( $('#distcuest').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp4').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp4').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfdistcuest", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=distcuest',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });



	$(document).on("click","#subirpdfdistrlt", function (event) {

		var formData = new FormData();
		formData.append('file', $('#distrlt').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'distrlt');
        formData.append('accion', 'subir');

        if ( $('#distrlt').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp5').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp5').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfdistrlt", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=distrlt',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    $(document).on("click","#descargarexpedientedist", function (event) {

    	var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=zip',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay ningún PDF subido u ocurrió algún error.");
				else
					window.location.href = data;
		    }
    	}); ajax.abort();

    });



    /**********************
    *
    * PRESENCIAL / MIXTO
	*
	***********************/


	$(document).on("click","[id^=subirpdfpmrlts]", function (event) {

		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		var formData = new FormData();
		formData.append('file', $('#pmrlts-'+id_emp).get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('id_emp', id_emp);
        formData.append('doc', 'pmrlts');
        formData.append('accion', 'subir');

        if ( $('#pmrlts-'+id_emp).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp-'+id_emp+'-rlt').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp-'+id_emp+'-rlt').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdfpmrlts]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=pmrlts',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

	$(document).on("click","[id^=subirpdfpmfichas]", function (event) {

		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		var formData = new FormData();
		formData.append('file', $('#pmfichas-'+id_emp).get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('id_emp', id_emp);
        formData.append('doc', 'pmfichas');
        formData.append('accion', 'subir');

        if ( $('#pmfichas-'+id_emp).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp-'+id_emp+'-fichas').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp-'+id_emp+'-fichas').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdfpmfichas]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=pmfichas',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


	$(document).on("click","[id^=subirpdfpmexamenes]", function (event) {

		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		var formData = new FormData();
		formData.append('file', $('#pmexamenes-'+id_emp).get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('id_emp', id_emp);
        formData.append('doc', 'pmexamenes');
        formData.append('accion', 'subir');

        if ( $('#pmexamenes-'+id_emp).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp-'+id_emp+'-exam').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp-'+id_emp+'-exam').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdfpmexamenes]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=pmexamenes',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


	$(document).on("click","[id^=subirpdffacturagastos]", function (event) {

		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];
		// alert(id_emp);

		var formData = new FormData();
		formData.append('file', $('#facturagastos-'+id_emp).get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		formData.append('id_emp', id_emp);
        formData.append('doc', 'facturagastos');
        formData.append('accion', 'subir');

        if ( $('#facturagastos-'+id_emp).get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data.indexOf('error') != -1 ) {
	                	alert("Fallo en la subida.");
	                	$('#comp-'+id_emp+'-fra').html(estano);
	                }
	               	else {
	                	alert("Fichero subido correctamente.");
	                	$('#comp-'+id_emp+'-fra').html(estasi);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdffacturagastos]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=facturagastos',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


    $(document).on("click","#subirpdflistadoessscan", function (event) {

		// var valor = $(this).attr('id');
		// valor = valor.split("-");
		// var id_emp = valor[1];
		// alert(id_emp);

		var formData = new FormData();
		formData.append('file', $('#listadoessscan').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
		// formData.append('id_emp', id_emp);
        formData.append('doc', 'listadoessscan');
        formData.append('accion', 'subir');

        if ( $('#listadoessscan').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data.indexOf('error') != -1 ) {
	                	alert("Fallo en la subida.");
	                	$('#comp-'+id_emp+'-fra').html(estano);
	                }
	               	else {
	                	alert("Fichero subido correctamente.");
	                	$('#complistadoessscan').html(estasi);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","[id^=mostrarpdflistadoessscan]", function (event) {

		var id_matricula = $('#id_matricula').val();
		var valor = $(this).attr('id');
		valor = valor.split("-");
		var id_emp = valor[1];

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=listadoessscan',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    	$(document).on("click","[id^=subirpdfpmcuestionarios]", function (event) {

    		var valor = $(this).attr('id');
    		valor = valor.split("-");
    		var id_emp = valor[1];

    		var formData = new FormData();
    		formData.append('file', $('#pmcuestionarios-'+id_emp).get(0).files[0]);
    		formData.append('id_mat', $('#id_matricula').val());
    		formData.append('id_emp', id_emp);
            formData.append('doc', 'pmcuestionarios');
            formData.append('accion', 'subir');

            if ( $('#pmcuestionarios-'+id_emp).get(0).files[0] == undefined ) {

            	alert("Selecciona un archivo.");

            } else {

            	$.ajax({
    	        	cache: false,
    	            url: 'functions/funciones_inspeccion.php',
    	            type: 'POST',
    	            data: formData,
    	            processData: false,
    	       		contentType: false,
    	            success: function (data) {
    	                if ( data == 'bien' ) {
    	                	alert("Fichero subido correctamente.");
    	                	$('#comp-'+id_emp+'-cuest').html(estasi);
    	                }
    	               	else {
    	               		alert("Fallo en la subida.");
    	               		$('#comp-'+id_emp+'-cuest').html(estano);
    	               	}
    	            }
    	        }); ajax.abort();
            }

        });

    	$(document).on("click","[id^=mostrarpdfpmcuestionarios]", function (event) {

    		var id_matricula = $('#id_matricula').val();
    		var valor = $(this).attr('id');
    		valor = valor.split("-");
    		var id_emp = valor[1];

    		$.ajax({
    		    cache: false,
    		    type: 'POST',
    		    url: 'functions/funciones_inspeccion.php',
    		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&accion=mostrar'+'&doc=pmcuestionarios',
    		    success: function(data)
    		    {
    				if ( data == 'no' )
    					alert ("No hay PDF subido.");
    				else
    					window.open(data);
    		    }
        	}); ajax.abort();

        });



    $(document).on("click","#subirpdfpmcert", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmcert').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmcert');
        formData.append('accion', 'subir');

        if ( $('#pmcert').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp1').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp1').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmcert", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmcert',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

	$(document).on("click","#subirpdfpmmaterial", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmmaterial').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmmaterial');
        formData.append('accion', 'subir');

        if ( $('#pmmaterial').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp2').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp2').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmmaterial", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmmaterial',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    $(document).on("click","#subirpdfpmlistasist", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmlistasist').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmlistasist');
        formData.append('accion', 'subir');

        if ( $('#pmlistasist').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp3').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp3').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmlistasist", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmlistasist',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


	$(document).on("click","#subirpdfpmfichasist", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmfichasist').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmfichasist');
        formData.append('accion', 'subir');

        if ( $('#pmfichasist').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp4').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp4').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmfichasist", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmfichasist',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    $(document).on("click","#subirpdfpmexamen", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmexamen').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmexamen');
        formData.append('accion', 'subir');

        if ( $('#pmexamen').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp5').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp5').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmexamen", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmexamen',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });

    $(document).on("click","#subirpdfpmcuest", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmcuest').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmcuest');
        formData.append('accion', 'subir');

        if ( $('#pmcuest').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp6').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp6').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmcuest", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmcuest',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


    $(document).on("click","#subirpdfpmrlt", function (event) {

		var formData = new FormData();
		formData.append('file', $('#pmrlt').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'pmrlt');
        formData.append('accion', 'subir');

        if ( $('#pmrlt').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comp7').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comp7').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });

	$(document).on("click","#mostrarpdfpmrlt", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=pmrlt',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


    $(document).on("click","#descargarexpedientepm", function (event) {

    	var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=zip',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay ningún PDF subido u ocurrió algún error.");
				else
					window.location.href = data;
		    }
    	}); ajax.abort();

    });


});


	$(document).on("click","#subirpdfrequerimiento", function (event) {

		// alert("hey");
		var formData = new FormData();
		// coge el archivo
		formData.append('file', $('#requerimiento').get(0).files[0]);
		formData.append('id_mat', $('#id_matricula').val());
        formData.append('doc', 'requerimiento');
        formData.append('accion', 'subir');

        if ( $('#requerimiento').get(0).files[0] == undefined ) {

        	alert("Selecciona un archivo.");

        } else {

        	$.ajax({
	        	cache: false,
	            url: 'functions/funciones_inspeccion.php',
	            type: 'POST',
	            data: formData,
	            processData: false,
	       		contentType: false,
	            success: function (data) {
	                if ( data == 'bien' ) {
	                	alert("Fichero subido correctamente.");
	                	$('#comprequerimiento').html(estasi);
	                }
	               	else {
	               		alert("Fallo en la subida.");
	               		$('#comprequerimiento').html(estano);
	               	}
	            }
	        }); ajax.abort();
        }

    });


	$(document).on("click","#mostrarpdfrequerimiento", function (event) {

		var id_matricula = $('#id_matricula').val();

		$.ajax({
		    cache: false,
		    type: 'POST',
		    url: 'functions/funciones_inspeccion.php',
		    data: 'id_mat='+id_matricula+'&accion=mostrar'+'&doc=requerimiento',
		    success: function(data)
		    {
				if ( data == 'no' )
					alert ("No hay PDF subido.");
				else
					window.open(data);
		    }
    	}); ajax.abort();

    });


    $(document).on("click","#emailexpediente", function (event) {

		var id_matricula = $('#id_matricula').val();
		// alert(id_matricula);
		var id_emp = $(this).attr('idemp');
		// alert(id_emp);
		var email_envio = $('input#email_envio'+id_emp).val();
		// alert(email_envio);

		$.ajax({
		    cache: false,
		    type: 'POST',
		    dataType: 'json',
		    url: 'functions/enviar_expediente.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&email_envio='+email_envio,
		    success: function(data)
		    {
				alert(data['mensaje']);
			}
    	}); ajax.abort();

    });

    $(document).on("click","#emailobservaciones", function (event) {

		var id_matricula = $('#id_matricula').val();
		// alert(id_matricula);
		var id_emp = $(this).attr('idemp');
		// alert(id_emp);
		var cuerpoCorreo = $('textarea#observaciones'+id_emp).val();
		 // alert(cuerpoCorreo);

		$.ajax({
		    cache: false,
		    type: 'POST',
		    dataType: 'json',
		    url: 'functions/enviar_observaciones.php',
		    data: 'id_mat='+id_matricula+'&id_emp='+id_emp+'&cuerpoCorreo='+cuerpoCorreo+'&tipo_doc=observacionesExp',
		    success: function(data)
		    {
				alert(data['mensaje']);
			}
    	}); ajax.abort();

    });