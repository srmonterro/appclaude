



	var generartodo = 0;



	function listarcursos() {

		    var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();



		    $.ajax({

		        cache: false,

		        type: 'POST',

		        url: 'functions/busqueda-seguimientof.php',

		        data: values,

		        success: function(data)

		        {



		            $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');

		    		$('.glyphicon-search').removeClass('spin');



		            $('#listado-seguimiento').html(data);

		            var sum = 0;

		            $("td#cobrado").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".",",");

		                value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                    sum += parseFloat(value);

		                }

		                // value = value.replace(".",",");

		            });



		            var sum2 = 0;

		            $("td#total_facturas").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".",",");

		                value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum2);

		                    sum2 += parseFloat(value);

		                }

		                // value = value.replace(".",",");

		            });



		            var sum3 = 0;

		            $("td#pendiente").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".",",");

		                value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum3);

		                    sum3 += parseFloat(value);

		                }

		                // value = value.replace(".",",");

		            });

		            var sum4 = 0;

		            $("td#comision").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".",",");

		                value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                    sum4 += parseFloat(value);

		                }

		                // value = value.replace(".",",");

		            });

		            $('#leyenda').css('display','inline-block');

		            $('.table').append('<tr><td colspan="11"></td><td class="info">Total Cobrado: </td><td colspan="2" style="text-align:center; font-size: 15px" class="info"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="11"></td><td class="danger">Total Pendiente: </td><td colspan="2" style="text-align:center; font-size: 15px" class="danger"><strong>'+(sum3.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="11"></td><td class="success">Total Facturado: </td><td colspan="2" style="text-align:center; font-size: 15px" class="success"><strong>'+(sum2.toFixed(2)).replace(".",",")+' €</strong></td></tr></td>');

		            $('#imprimirSeguimientoc').css('display','inline-block');

		            $('#listadoExcel').css('display','inline-block');

					$('#generar_remesa').css('display','inline-block');

		            $('#listadoExcel').css('margin-right','5px');

		            $('#mostrardatos').removeClass('onhide');

		        }



		    }); ajax.abort();

	}






	$(document).on("click", "#generar_remesa", function(event){

		// var mes = $('#mes').val();
		// var fecha = $('#fechacobro').val();
		// var entidad = $('#entidad').val();

		var sql = $('span#sql').text();
		// entidad = entidad.trim();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/remesa.php',
			data: 'sql='+sql,
			success: function(data)
			{
				if ( data.indexOf("error") != -1 ) {
					alert("Ocurrió un error "+data);
				} else {
					window.open('http://gestion.eduka-te.com/app/functions/force_download_xml.php?file='+data);
				}
			}
		}); ajax.abort();


	});


	$(document).on("click", "#busqueda-seguimientof", function (event) {



	    event.preventDefault();

	    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');

		$(this).find('span').addClass('spin');

	    listarcursos();



	});



	$(document).on("click", "#busqueda-seguimientodevol", function (event) {



	    event.preventDefault();

	    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');

		$(this).find('span').addClass('spin');

	    listardevoluciones();



	});





	$(document).on("click", "#restablecer-c", function(event){

	        $('#form-seguimiento')[0].reset();

	});



	$(document).on("click", "#listadoExcel", function(event) {



			$('td#id').remove();

			// $('td#observaciones').remove();

	        var datatodisplay = $('#listado-seguimiento').html();

	        $('#datatodisplay').val(datatodisplay);

	        document.getElementById("lala").submit(datatodisplay);



	});



	$(document).on("click", "#borrarmatacrefra", function(event) {



		var id = $(this).attr('id_facre');


		if ( confirm("¿ Estás seguro que deseas borrar ?") ) {

			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones.php',

				data: 'id='+id+'&tabla=facturacion_matriculas_acre'+'&borrar=1',

				success: function(data)

				{

					if ( data.indexOf('error') != -1 )

						alert("Error borrando gasto");

					else

						alert("Gasto borrado.");

				}

			}); ajax.abort();

		}



	});


	$(document).on("click", "#borrarFacturaAcre", function(event) {



		var id = $(this).attr('idfra');


		if( confirm("¿ Estás seguro que quieres borra la factura ?") ) {

			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'id='+id+'&borrarfacturaacre=1',

				success: function(data)

				{

					if ( data.indexOf('error') != -1 )

						alert("Error borrando factura");

					else

						alert("Factura borrada");

				}

			}); ajax.abort();

		}



	});



	$(document).on("click", "#listadoExcelAcre", function(event) {



			$('td#id').remove();

			$('td#observaciones').remove();

			$('td#observacioneslargas').css('display','grid');



			$("td#pagado").each(function() {



			    var value = $(this).text();

			    value = value.replace(".",",");

			    $(this).text(value);



			});



			$("td#importe").each(function() {



			    var value = $(this).text();

			    value = value.replace(".",",");

			    $(this).text(value);



			});



			$("td#pendiente").each(function() {



			    var value = $(this).text();

			    value = value.replace(".",",");

			    $(this).text(value);

			});



	        var datatodisplay = $('#listado-seguimiento').html();

	        $('#datatodisplay').val(datatodisplay);



	        document.getElementById("lala").submit(datatodisplay);



	});





	$(document).on("click", "#matpfac-seleccionarmat", function(event){



		event.preventDefault();



		var tabla = $(this).attr('name');

        var button = $(this);

    	var parentTd = button.parent('td');

    	var parentTr = parentTd.parent('tr');

    	var id_matricula = parentTr.find('td#id').html();



    	$.ajax({

	        cache: false,

	        type: 'POST',

	        url: 'functions/funciones-facturacion.php',

	        data: 'id='+id_matricula+'&devolvermatfac=1',

	        success: function(data)

	        {

	            $('#mostrardatos').modal('hide');

	            $('#id_matricula').val(id_matricula);

	            $('#datosaccion').html(data);

	            $('#generafacturatodo').css('display','inline-block');



	        }

    	}); ajax.abort();

    });





	$(document).on("click", "#matpfacikea-seleccionarmat", function(event){



		event.preventDefault();



		var tabla = $(this).attr('name');

        var button = $(this);

    	var parentTd = button.parent('td');

    	var parentTr = parentTd.parent('tr');

    	var id_matricula = parentTr.find('td#id').html();

    	// alert(id_matricula);



    	$.ajax({

	        cache: false,

	        type: 'POST',

	        url: 'functions/funciones-facturacion.php',

	        data: 'id='+id_matricula+'&devolvermatfacikea=1',

	        success: function(data)

	        {

	            $('#mostrardatos').modal('hide');

	            $('#id_matricula').val(id_matricula);

	            $('#datosaccion').html(data);

	            // $('#generafacturatodo').css('display','inline-block');



	        }

    	}); ajax.abort();

    });





	$(document).on("click", "#generarfacturaikea", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var impuesto = $('#impuesto'+emp).val();

		// var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var costes_imparticion = $('#costes_imparticion'+emp).val();

		var igic = $('#igic'+emp).val();

		var tipofra = $('#tipofra').val();


		if ( tipofra == 'Privado' )

			var tabla = 'facturacion_privada';

		else

			var tabla = 'facturacion_bonificada';



		var cuentacotizacion = $('#cuentacotizacion'+emp).val();

		var costes_indirectos = $('#costes_indirectos'+emp).val();

		var costes_organizacion = $('#costes_organizacion'+emp).val();

		var importe_a_bonificar = $('#importe_a_bonificar'+emp).val();

		var numalumnos = $('#numalumnos'+emp).val();

		var empresa = $(this).attr('empresa');



		var x = $(this).find('span');

		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

		x.addClass('spin');



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'facturacion/factura_ikea.php',

				data: 'mat='+mat+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&impuesto='+impuesto+'&numero='+numero+'&observaciones='+observaciones+'&tipofra='+tipofra+'&costes_imparticion='+costes_imparticion+'&costes_indirectos='+costes_indirectos+'&costes_organizacion='+costes_organizacion+'&numalumnos='+numalumnos+'&cuentacotizacion='+cuentacotizacion+'&importe_a_bonificar='+importe_a_bonificar+'&empresa='+empresa+'&igic='+igic+'&tipo=bonif'+'&genera=1',

				success: function(data)

				{



					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

		    		x.removeClass('spin');



					if ( data == 'existe' ) {

						alert("Ya existe una factura para esa matrícula y empresa.");

						return false;

					}





					if ( $('#facturartodo').val() != 1 ) {

						$('#alerta-error').modal('show');

						$('.modal-title').html("Información");

						$('.mensaje-error').html('Factura/s generada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

					}

					$('span#compmailfac'+emp).css('color','green');

					// alert(data);

					var inputdetalle = '<a style="width:100%" id="detalleFacturaFac" tabla="'+tabla+'" idfac="'+data+'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>';

					$('#huecoDetalle'+emp).css('display','inline-block');

					$('#huecoDetalle'+emp).html(inputdetalle);

					$('#previsualizarfactura'+emp).css('display','none');

						// $pre.css('display','none');



				}

			});



    });



	$(document).on("click", "#generarfactura", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var impuesto = $('#impuesto'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var costes_imparticion = $('#costes_imparticion'+emp).val();

		var costes_indirectos = $('#costes_indirectos'+emp).val();

		var costes_organizacion = $('#costes_organizacion'+emp).val();



		// $.ajax({

		// 	cache: false,

		// 	type: 'POST',

		// 	url: 'functions/funciones-facturacion.php',

		// 	data: 'emp='+emp+'&mat='+mat+'&tipo=bonif'+'&compruebafactura=1',

		// 	success: function(data)

		// 	{

		// 		// if ( data == 'existe' ) {

		// 		// 	alert("Ya existe una factura para esa empresa de ese curso.");

		// 		// 	return false;

		// 		// } else {



		var x = $(this).find('span');

		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

		x.addClass('spin');



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'facturacion/factura_bonificada.php',

				data: 'mat='+mat+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&impuesto='+impuesto+'&otro='+otro+'&numero='+numero+'&observaciones='+observaciones+'&costes_imparticion='+costes_imparticion+'&costes_indirectos='+costes_indirectos+'&costes_organizacion='+costes_organizacion+'&tipo=bonif'+'&genera=1',

				success: function(data)

				{



					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

		    		x.removeClass('spin');



					if ( data == 'existe' ) {

						alert("Ya existe una factura para esa matrícula y empresa.");

						return false;

					}





					if ( $('#facturartodo').val() != 1 ) {

						$('#alerta-error').modal('show');

						$('.modal-title').html("Información");

						$('.mensaje-error').html('Factura/s generada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

					}

					$('span#compmailfac'+emp).css('color','green');

					// alert(data);

					var inputdetalle = '<a style="width:100%" id="detalleFacturaFac" tabla="facturacion_bonificada" idfac="'+data+'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>';

					$('#huecoDetalle'+emp).css('display','inline-block');

					$('#huecoDetalle'+emp).html(inputdetalle);

					$('#previsualizarfactura'+emp).css('display','none');

						// $pre.css('display','none');



				}

			});

					// var form = $('<form action="facturacion/factura_bonificada.php" target="_blank" name="pdf" id="privado" method="POST"><input type="hidden" name="mat" id="mat" value="'+mat+'"><input type="hidden" name="emp" id="emp" value="'+emp+'"><input type="hidden" name="importefactura" id="importefactura" value="'+importefactura+'"><input type="hidden" name="fechafactura" id="fechafactura" value="'+fechafactura+'"><input type="hidden" name="vencimiento" id="vencimiento" value="'+vencimiento+'"><input type="hidden" name="formapago" id="formapago" value="'+formapago+'"><input type="hidden" name="anticipo" id="anticipo" value="'+anticipo+'"><input type="hidden" name="impuesto" id="impuesto" value="'+impuesto+'"><input type="hidden" name="otro" id="otro" value="'+otro+'"><input type="hidden" name="genera" id="genera" value="1"><input type="hidden" name="tipo" id="tipo" value="bonif"></form>');



					// $(form).appendTo('body');

     //    			form.submit();

     //    			$('span#compmailfac'+emp).css('color','green');

				// }

		// 	}

		// }); ajax.abort();



    });





    $(document).on("click", "#generarfacturap", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var empfacturar = $('#empfacturar'+emp).val();



		// $.ajax({

		// 	cache: false,

		// 	type: 'POST',

		// 	url: 'functions/funciones-facturacion.php',

		// 	data: 'emp='+emp+'&mat='+mat+'&tipo=privado'+'&compruebafactura=1',

		// 	success: function(data)

		// 	{

		// 		if ( data == 'existe' ) {

		// 			alert("Ya existe una factura para esa empresa de ese curso.");

		// 			return false;

		// 		} else {



		// 			var formp = $('<form action="facturacion/factura_privada.php" target="_blank" name="pdf" id="privado" method="POST"><input type="hidden" name="mat" id="mat" value="'+mat+'"><input type="hidden" name="emp" id="emp" value="'+emp+'"><input type="hidden" name="importefactura" id="importefactura" value="'+importefactura+'"><input type="hidden" name="fechafactura" id="fechafactura" value="'+fechafactura+'"><input type="hidden" name="vencimiento" id="vencimiento" value="'+vencimiento+'"><input type="hidden" name="formapago" id="formapago" value="'+formapago+'"><input type="hidden" name="anticipo" id="anticipo" value="'+anticipo+'"><input type="hidden" name="otro" id="otro" value="'+otro+'"><input type="hidden" name="genera" id="genera" value="1"><input type="hidden" name="tipo" id="tipo" value="privado"></form>');

		// 			$(formp).appendTo('body');

  // 				    formp.submit();

  // 				    $('span#compmailfac'+emp).css('color','green');

		// 		}



		// 	}

		// }); ajax.abort();

	    var x = $(this).find('span');

		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

		x.addClass('spin');



		$.ajax({

				cache: false,

				type: 'POST',

				url: 'facturacion/factura_privada.php',

				data: 'mat='+mat+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&otro='+otro+'&numero='+numero+'&observaciones='+observaciones+'&empfacturar='+empfacturar+'&tipo=privado'+'&genera=1',

				success: function(data)

				{



					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

		    		x.removeClass('spin');



					if ( data == 'existe' ) {

						alert("Ya existe una factura para esa matrícula y empresa.");

						return false;

					}



					if ( $('#facturartodo').val() != 1 ) {

						$('#alerta-error').modal('show');

						$('.modal-title').html("Información");

						$('.mensaje-error').html('Factura/s generada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

					}

					$('span#compmailfac'+emp).css('color','green');

					var inputdetalle = '<a style="width:100%" id="detalleFacturaFac" tabla="facturacion_privada" idfac="'+data+'" class="btn btn-primary"><span class="glyphicon glyphicon-list-alt"></span> Detalle</a>';

					$('#huecoDetalle'+emp).css('display','inline-block');

					$('#huecoDetalle'+emp).html(inputdetalle);

					$('#previsualizarfacturap'+emp).css('display','none');

				}

			});





    });



    $(document).on("click", "a[id^='previsualizarfactura']", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var impuesto = $('#impuesto'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var costes_imparticion = $('#costes_imparticion'+emp).val();

		var costes_indirectos = $('#costes_indirectos'+emp).val();

		var costes_organizacion = $('#costes_organizacion'+emp).val();





		var form = $('<form action="facturacion/factura_bonificada.php" target="_blank" name="pdf" id="privado" method="POST"><input type="hidden" name="mat" id="mat" value="'+mat+'"><input type="hidden" name="emp" id="emp" value="'+emp+'"><input type="hidden" name="numero" id="numero" value="'+numero+'"><input type="hidden" name="importefactura" id="importefactura" value="'+importefactura+'"><input type="hidden" name="fechafactura" id="fechafactura" value="'+fechafactura+'"><input type="hidden" name="vencimiento" id="vencimiento" value="'+vencimiento+'"><input type="hidden" name="formapago" id="formapago" value="'+formapago+'"><input type="hidden" name="anticipo" id="anticipo" value="'+anticipo+'"><input type="hidden" name="impuesto" id="impuesto" value="'+impuesto+'"><input type="hidden" name="observaciones" id="observaciones" value="'+observaciones+'"><input type="hidden" name="otro" id="otro" value="'+otro+'"><input type="hidden" name="costes_imparticion" id="costes_imparticion" value="'+costes_imparticion+'"><input type="hidden" name="costes_indirectos" id="costes_indirectos" value="'+costes_indirectos+'"><input type="hidden" name="costes_organizacion" id="costes_organizacion" value="'+costes_organizacion+'"><input type="hidden" name="tipo" id="tipo" value="bonif"></form>');



		$(form).appendTo('body');

        form.submit();



    });



   	$(document).on("click", "a[id^='previsualizarfacturaikea']", function(event){



    		event.preventDefault();



    		var emp = $(this).attr('emp');

    		var mat = $(this).attr('mat');

    		var importefactura = $('#importe_factura'+emp).val();

    		var fechafactura = $('#fecha_factura'+emp).val();

    		var vencimiento = $('#vencimiento'+emp).val();

    		var formapago = $('#formapago'+emp).val();

    		var anticipo = $('#anticipo'+emp).val();

    		var observaciones = $('#observaciones'+emp).val();

    		var impuesto = $('#impuesto'+emp).val();

    		// var costesformacion = $('#costes_imparticion'+emp).val();

    		var numero = $('#numero'+emp).val();

    		var costes_imparticion = $('#costes_imparticion'+emp).val();

    		var tipofra = $('#tipofra').val();

    		var tipofac = $('#tipofac').val();

    		var igic = $('#igic'+emp).val();
    		// alert(igic);

    		// alert(tipofra);

    		var cuentacotizacion = $('#cuentacotizacion'+emp).val();

    		var costes_indirectos = $('#costes_indirectos'+emp).val();

			var costes_organizacion = $('#costes_organizacion'+emp).val();

			var importe_a_bonificar = $('#importe_a_bonificar'+emp).val();

			var numalumnos = $('#numalumnos'+emp).val();

			var empresa = $(this).attr('empresa');

    		// var tipofra = 'formacion';



    		var form = $('<form action="facturacion/factura_ikea.php" target="_blank" name="pdf" id="'+tipofra+'" method="POST"><input type="hidden" name="mat" id="mat" value="'+mat+'"><input type="hidden" name="emp" id="emp" value="'+emp+'"><input type="hidden" name="numero" id="numero" value="'+numero+'"><input type="hidden" name="importefactura" id="importefactura" value="'+importefactura+'"><input type="hidden" name="fechafactura" id="fechafactura" value="'+fechafactura+'"><input type="hidden" name="vencimiento" id="vencimiento" value="'+vencimiento+'"><input type="hidden" name="formapago" id="formapago" value="'+formapago+'"><input type="hidden" name="anticipo" id="anticipo" value="'+anticipo+'"><input type="hidden" name="impuesto" id="impuesto" value="'+impuesto+'"><input type="hidden" name="tipofra" id="tipofra" value="'+tipofra+'"><input type="hidden" name="observaciones" id="observaciones" value="'+observaciones+'"><input type="hidden" name="costes_imparticion" id="costes_imparticion" value="'+costes_imparticion+'"><input type="hidden" name="costes_indirectos" id="costes_indirectos" value="'+costes_indirectos+'"><input type="hidden" name="costes_organizacion" id="costes_organizacion" value="'+costes_organizacion+'"><input type="hidden" name="importe_a_bonificar" id="importe_a_bonificar" value="'+importe_a_bonificar+'"><input type="hidden" name="numalumnos" id="numalumnos" value="'+numalumnos+'"><input type="hidden" name="empresa" id="empresa" value="'+empresa+'"><input type="hidden" name="tipofac" id="tipofac" value="'+tipofac+'"><input type="hidden" name="igic" id="igic" value="'+igic+'"><input type="hidden" name="cuentacotizacion" id="cuentacotizacion" value="'+cuentacotizacion+'"><input type="hidden" name="tipo" id="tipo" value="bonif"></form>');



    		$(form).appendTo('body');

            form.submit();



    });





	$(document).on("keyup", "textarea[name^=observaciones]", function(event){



		this.value = this.value.replace('"','');



	});



    $(document).on("click", "a[id^='previsualizarfacturap']", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var empfacturar = $('#empfacturar'+emp).val();

		// alert(empfacturar);



		var formp = $('<form action="facturacion/factura_privada.php" target="_blank" name="pdf" id="privado" method="POST"><input type="hidden" name="mat" id="mat" value="'+mat+'"><input type="hidden" name="emp" id="emp" value="'+emp+'"><input type="hidden" name="numero" id="numero" value="'+numero+'"><input type="hidden" name="importefactura" id="importefactura" value="'+importefactura+'"><input type="hidden" name="fechafactura" id="fechafactura" value="'+fechafactura+'"><input type="hidden" name="vencimiento" id="vencimiento" value="'+vencimiento+'"><input type="hidden" name="formapago" id="formapago" value="'+formapago+'"><input type="hidden" name="anticipo" id="anticipo" value="'+anticipo+'"><input type="hidden" name="otro" id="otro" value="'+otro+'"><input type="hidden" name="observaciones" id="observaciones" value="'+observaciones+'"><input type="hidden" name="empfacturar" id="empfacturar" value="'+empfacturar+'"><input type="hidden" name="tipo" id="tipo" value="privado"></form>');



		$(formp).appendTo('body');

        formp.submit();



    });







	$(document).on("click", "#previsualizarfacturar", function(event){



		event.preventDefault();



		var idfac = $('#idfac').val();

		var tabla = $('#tabla').val();



		var nuevoimporte = $('#importe_rectificar').val();

		$('input#nuevoimporte').val(nuevoimporte);

		// $('form#nuevoimporte').val(nuevoimporte);

		// alert( $('form#nuevoimporte').val() );

		var motivo = $('#motivo').val();

		$('input#motivoform').val(motivo);



		var fecha = $('#fechafacturar').val();

		$('input#fechaform').val(fecha);



		// var empfacturar = $('#empfacturar').val();

		// $('input#empfacturar').val(empfacturar);



		$('form#rectificativa').submit();

        // formr.();



    });









	$(document).on("click", "#generarfacturar", function(event){



		event.preventDefault();



		var mat = $('input#mat').val();

		var emp = $('input#emp').val();



		var idfac = $('#idfac').val();

		var tabla = $('#tabla').val();



		var nuevoimporte = $('#importe_rectificar').val();

		$('input#nuevoimporte').val(nuevoimporte);

		// $('form#nuevoimporte').val(nuevoimporte);

		// alert( $('form#nuevoimporte').val() );

		var motivo = $('#motivo').val();

		$('input#motivoform').val(motivo);

		$('input#genera').val('1'); // PARA GENERAR EL PDF EN EL SERVIDOR Y ENTRADA EN BASE DE DATOS!!

		var fecha = $('#fechafacturar').val();

		$('input#fechaform').val(fecha);



		$('form#rectificativa').submit();



    });



    $(document).on("click", "#modificarfacturaikea", function(event){



    		event.preventDefault();



    		// var emp = $(this).attr('empresa');

    		// // alert(emp);

    		// var mat = $(this).attr('mat');

    		// var importefactura = $('#importe_factura'+emp).val();

    		// var fechafactura = $('#fecha_factura'+emp).val();

    		// var vencimiento = $('#vencimiento'+emp).val();

    		// var formapago = $('#formapago'+emp).val();

    		// var anticipo = $('#anticipo'+emp).val();

    		// // alert(anticipo);

    		// var impuesto = $('#impuesto'+emp).val();

    		// var otro = $('#otro'+emp).val();

    		// var numero = $('#numero'+emp).val();

    		// var observaciones = $('#observaciones'+emp).val();

    		// // var numero = $('#numero'+emp).val();

    		// var idfac = $(this).attr('idfac');

    		// var costes_imparticion = $('#costes_imparticion'+emp).val();

    		// var tipofra = $('#tipofra').val();

    		// var cuentacotizacion = $('#cuentacotizacion'+emp).val();

    		// // alert(costes_imparticion);





    	var emp = $(this).attr('emp');

    	// alert(emp);

		var mat = $(this).attr('mat');

		var idfac = $(this).attr('idfac');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var impuesto = $('#impuesto'+emp).val();

		var numero = $('#numero'+emp).val();

		var costes_imparticion = $('#costes_imparticion'+emp).val();

		var importe_a_bonificar = $('#importe_a_bonificar'+emp).val();

		var igic = $('#igic'+emp).val();

		var tipofra = $('#tipofra').val();



		if ( tipofra == 'Privado' )

			var tabla = 'facturacion_privada';

		else

			var tabla = 'facturacion_bonificada';



		// alert(tipofra);

		var cuentacotizacion = $('#cuentacotizacion'+emp).val();

		var costes_indirectos = $('#costes_indirectos'+emp).val();

		var costes_organizacion = $('#costes_organizacion'+emp).val();

		var numalumnos = $('#numalumnos'+emp).val();

		var empresa = $(this).attr('empresa');



		// alert(empresa);

    		var x = $(this).find('span');

    		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

    		x.addClass('spin');



    			$.ajax({

    				cache: false,

    				type: 'POST',

    				url: 'facturacion/factura_ikea.php',

    				data: 'mat='+mat+'&idfac='+idfac+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&impuesto='+impuesto+'&numero='+numero+'&observaciones='+observaciones+'&tipofra='+tipofra+'&costes_imparticion='+costes_imparticion+'&costes_indirectos='+costes_indirectos+'&costes_organizacion='+costes_organizacion+'&numalumnos='+numalumnos+'&cuentacotizacion='+cuentacotizacion+'&importe_a_bonificar='+importe_a_bonificar+'&empresa='+empresa+'&igic='+igic+'&tipo=bonif'+'&modifica=1',

    				success: function(data)

    				{



    					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

    		    		x.removeClass('spin');



    					if ( $('#facturartodo').val() != 1 ) {

    						$('#alerta-error').modal('show');

    						$('.modal-title').html("Información");

    						$('.mensaje-error').html('Factura/s modificada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

    					}

    					// alert(data);

    					$('span#compmailfac'+emp).css('color','green');

    					// alert(data);

    				}

    			});



        });



	$(document).on("click", "#modificarfactura", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		// alert(anticipo);

		var impuesto = $('#impuesto'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var numero = $('#numero'+emp).val();

		var idfac = $(this).attr('idfac');

		var costes_imparticion = $('#costes_imparticion'+emp).val();

   		var costes_indirectos = $('#costes_indirectos'+emp).val();

		var costes_organizacion = $('#costes_organizacion'+emp).val();



		// alert(costes_imparticion);



		var x = $(this).find('span');

		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

		x.addClass('spin');



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'facturacion/factura_bonificada.php',

				data: 'mat='+mat+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&impuesto='+impuesto+'&otro='+otro+'&numero='+numero+'&idfac='+idfac+'&observaciones='+observaciones+'&costes_imparticion='+costes_imparticion+'&costes_indirectos='+costes_indirectos+'&costes_organizacion='+costes_organizacion+'&tipo=bonif'+'&modifica=1',

				success: function(data)

				{



					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

		    		x.removeClass('spin');



					if ( $('#facturartodo').val() != 1 ) {

						$('#alerta-error').modal('show');

						$('.modal-title').html("Información");

						$('.mensaje-error').html('Factura/s modificada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

					}

					$('span#compmailfac'+emp).css('color','green');

					// alert(data);

				}

			});



    });





		$(document).on("click", "#modificarfacturap", function(event){



		event.preventDefault();



		var emp = $(this).attr('emp');

		var mat = $(this).attr('mat');

		var importefactura = $('#importe_factura'+emp).val();

		// alert(importefactura);

		var fechafactura = $('#fecha_factura'+emp).val();

		var vencimiento = $('#vencimiento'+emp).val();

		var formapago = $('#formapago'+emp).val();

		var anticipo = $('#anticipo'+emp).val();

		// alert(anticipo);

		var impuesto = $('#impuesto'+emp).val();

		var otro = $('#otro'+emp).val();

		var numero = $('#numero'+emp).val();

		var observaciones = $('#observaciones'+emp).val();

		var idfac = $(this).attr('idfac');

		var empfacturar = $('#empfacturar'+emp).val();





		var x = $(this).find('span');

		x.toggleClass('glyphicon-list-alt glyphicon-refresh');

		x.addClass('spin');



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'facturacion/factura_privada.php',

				data: 'mat='+mat+'&emp='+emp+'&importefactura='+importefactura+'&fechafactura='+fechafactura+'&vencimiento='+vencimiento+'&formapago='+formapago+'&anticipo='+anticipo+'&impuesto='+impuesto+'&otro='+otro+'&numero='+numero+'&idfac='+idfac+'&observaciones='+observaciones+'&empfacturar='+empfacturar+'&tipo=privado'+'&modifica=1',

				success: function(data)

				{



					x.toggleClass('glyphicon-refresh glyphicon-list-alt');

		    		x.removeClass('spin');



					if ( $('#facturartodo').val() != 1 ) {

						$('#alerta-error').modal('show');

						$('.modal-title').html("Información");

						$('.mensaje-error').html('Factura/s modificada/s. Ir a <a target="_blank" href="index.php?control-facturacion">control de facturación</a>');

					}

					$('span#compmailfac'+emp).css('color','green');

					// alert(data);

				}

			});



    });

















	function getRow(button, selector) {

	    var parentTd = button.parent('td');

		var parentTr = parentTd.parent('tr');

		return parentTr.find('td#'+selector).html();

	}



    $(document).on("click", "#detalleFactura", function(event){



		event.preventDefault();



		var id_fac = getRow($(this),"id");

		// alert(id_fac);

		var tabla = $(this).attr('tabla');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_fac='+id_fac+'&tabla='+tabla+'&detallefactura=1',

			success: function(data)

			{

				$('#mostrardatos').modal('show');

				$('#mostrardatos').addClass('onhide');

				$('.modal-dialog').css('width','1150px');

				$('.mostrartitulo').html('Detalle de la Factura');

				$('.contenido').html(data);



			}

		}); ajax.abort();





    });



    $(document).on("click", "#detalleFacturaDevol", function(event){



		event.preventDefault();



		var id_fac = getRow($(this),"id");

		// alert(id_fac);

		var tabla = $(this).attr('tabla');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_fac='+id_fac+'&tabla='+tabla+'&detallefactura=1',

			success: function(data)

			{

				$('#mostrardatos').modal('show');

				$('#mostrardatos').addClass('onhidedevol');

				$('.modal-dialog').css('width','1150px');

				$('.mostrartitulo').html('Detalle de la Factura');

				$('.contenido').html(data);

			}

		}); ajax.abort();





    });





    $(document).on("click", "#detalleFacturaFac", function(event){



		event.preventDefault();



		var id_fac = $(this).attr('idfac');

		// alert(id_fac);

		var tabla = $(this).attr('tabla');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_fac='+id_fac+'&tabla='+tabla+'&detallefactura=1',

			success: function(data)

			{

				$('#mostrardatos').modal('show');

				$('#mostrardatos').addClass('onhide');

				$('.modal-dialog').css('width','1150px');

				$('.mostrartitulo').html('Detalle de la Factura');

				$('.contenido').html(data);

			}

		}); ajax.abort();



    });





    $(document).on('hidden.bs.modal','div.onhide', function (event) {

    	listarcursos();

    	// $('#mostrardatos').removeClass('onhide');

	});



	$(document).on('hidden.bs.modal','div.onhideacre', function (event) {

    	listarcursosacre();

    	// $('#mostrardatos').removeClass('onhide');

	});



	$(document).on('hidden.bs.modal','div.onhidedevol', function (event) {

    	listardevoluciones();

    	// $('#mostrardatos').removeClass('onhide');

	});



    $(document).on("click", "#emailfactura", function(event){





    	var idfac = $(this).attr('id_fac');

    	var tabla = $(this).attr('tabla');

    	var email = $('#email_facturas').val();



    	if ( email == "" ) {

    		$('#alerta-error').css('z-index','1050');

    		$('.modal-title').html("Información");

    		$('#alerta-error').modal('show');

			$('.mensaje-error').html("La factura NO se enviará al cliente, sólo a los interesados.");

    	}



    	$.ajax({

			cache: false,

			type: 'POST',

			dataType: 'json',

			url: 'facturacion/enviaMailFactura.php',

			data: 'idfac='+idfac+'&tabla='+tabla+'&email='+email,

			success: function(data)

			{

				alert(data['mensaje']);

				if ( data['resul'] == 1 )

					$('span#compmailfac').css('color','green');

			}

		}); ajax.abort();



    });





    $(document).on("change", "#estadofac", function(event){





    	var idfac = $('#idfac').val();

    	var tabla = $('#tabla').val();

    	var idmat = $('#id_mat').val();

		var optionSelected = $(this).find("option:selected");

	    var valueSelected  = optionSelected.val();





    	$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfac='+idfac+'&estado='+valueSelected+'&tabla='+tabla+'&idmat='+idmat+'&actualizaestado=1',

			success: function(data)

			{

				if ( data == 'ok' )

					alert("Estado Actualizado");

				else

					alert("Error!");

			}

		}); ajax.abort();





    });





	$(document).on("click", "#guardardetallefactura", function(event){





    	var idfac = $(this).attr('id_fac');

    	var tabla = $('input#tabla').val();

    	var cobrado = $('input#cobrado').val();

    	var total_factura = $('.modal-dialog input#total_factura').val();

    	var pendiente = $('input#pendiente').val();

    	var estado = $('select#estadofac').val();



    	$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfac='+idfac+'&cobrado='+cobrado+'&estado='+estado+'&pendiente='+pendiente+'&total_factura='+total_factura+'&tabla='+tabla+'&actualizadetallefactura=1',

			success: function(data)

			{

				if ( data == 1 )
					alert("Guardado correctamente.")
				else
					alert("Error!");

			}

		}); ajax.abort();



    });





	$(document).on("click", "#rectificarFactura", function(event){



		event.preventDefault();



		var id_fac = getRow($(this),"id");

		var tabla = $(this).attr('tabla');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_fac='+id_fac+'&tabla='+tabla+'&rectificafactura=1',

			success: function(data)

			{

				$('#mostrardatos').modal('show');

				$('#mostrardatos').addClass('onhide2');

				$('.modal-dialog').css('width','1150px');

				$('.mostrartitulo').html('Rectificar Factura');

				$('.contenido').html(data);

			}

		}); ajax.abort();





    });





	$(document).on("click", "#facturartodo", function(event){



		event.preventDefault();



		var ids = $(this).attr('ids');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idmat='+ids+'&facturartodo=1',

			success: function(data)

			{

				$('#mostrardatos').modal('hide');

	            // $('#id_matricula').val(id_matricula);

	            $('#datosaccion').html(data);

	            $('#generafacturatodo').css('display','inline-block');

			}

		}); ajax.abort();





    });





	$(document).on("click", "#generafacturatodo", function(event){



		event.preventDefault();



		$('#facturartodo').val('1');



		$("a#generarfactura").each(function() {

			$(this).trigger('click');

		});

		$("a#generarfacturap").each(function() {

			// alert($(this).attr('emp'));

			$(this).trigger('click');

		});



		// $("#generarfacturap").each(function() {

		// 	$(this).trigger('click');

		// });



		$('#alerta-error').modal('show');

		$('.modal-title').html("Información");

		$('.mensaje-error').html('Lote de facturas generado. Ir a <a href="index.php?control-facturacion">control de facturación</a>');

		$('#facturartodo').val('0');



    });





    $(document).on("click", "#anadirconciliar", function(event){



		event.preventDefault();

		var id_fac = $(this).attr('id_fac');



		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfac='+id_fac+'&anadirconciliar=1',

			success: function(data)

			{

				$('#marca_concilio').before(data);

			}

		}); ajax.abort();

    });





    $(document).on("click", "#anadirconciliaracre", function(event){



		event.preventDefault();

		var id_fac = $(this).attr('id_fac');



		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfac='+id_fac+'&anadirconciliar=2',

			success: function(data)

			{

				$('#marca_concilio').before(data);

			}

		}); ajax.abort();

    });





	$(document).on("click", "#guardarconciliar", function(event) {



		event.preventDefault();



		var tabla = $('#tabla').val();

		var nuevo = $(this).attr('nuevo');

		var cobrado = $('#cobradoconcilio'+nuevo).val();

		var fecha = $('#fechaconcilio'+nuevo).val();

		var pendiente = $('input#pendiente').val();

		var idfac = $(this).attr('id_fac');

		var total = $('input#total_factura').val();

		var cobradoya = $('input#cobrado').val();

		var totalcobrado = parseFloat(cobrado)+parseFloat(cobradoya);

		var observaciones = $('#observaciones'+nuevo).val();

		var numero = $('.modal-dialog input#numero').val();

		var tipo = numero.charAt(0);

		if ( tipo != 'P' && tipo != 'R') tipo = 'B';



		// alert(totalcobrado);



		// if ( totalcobrado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&cobrado='+cobrado+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&tabla='+tabla+'&observaciones='+observaciones+'&tipo='+tipo+'&guardarconciliar=1',

				dataType: 'json',

				success: function(data)

				{

					alert("Guardado correctamente.");

						 $('.modal-content input#pagado').val(data[0]);

						 $('.modal-content input#pendiente').val(data[1]);

				}

			}); ajax.abort();



	});





	$(document).on("click", "#guardarconciliaracre", function(event) {



		event.preventDefault();



		// var tabla = $('#tabla').val();

		var nuevo = $(this).attr('nuevo');

		var pagado = $('#pagadoconcilio'+nuevo).val();

		var fecha = $('#fechaconcilio'+nuevo).val();

		//var pendiente = $('input#pendiente').val();

		var pendiente = $('.modal-dialog input#pendiente').val();

		var idfac = $(this).attr('id_fac');

		var total = $('.modal-dialog input#importe').val();

		// var pagadoya = $('input#pagado').val();
		var pagadoya = $('.modal-dialog input#pagado').val();

		var totalpagado = parseFloat(pagado)+parseFloat(pagadoya);

		var observaciones = $('#observaciones'+nuevo).val();

		// var numero = $('.modal-dialog input#numero').val();

		// var tipo = numero.charAt(0);

		// alert(totalpagado);



		// if ( totalpagado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&pagado='+pagado+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&observaciones='+observaciones+'&guardarconciliar=2',

				dataType: 'json',

				success: function(data)

				{

					alert("Guardado correctamente.");

					 $('.modal-content input#pagado').val(data[0]);

					 $('.modal-content input#pendiente').val(data[1]);

				}

			}); ajax.abort();



	});



	$(document).on("click", "#actualizarconciliar", function(event) {



		event.preventDefault();



		// var nuevo = $(this).attr('nuevo');

		var tabla = $('#tabla').val();

		var idcon = $(this).attr('id_concilio');

		var cobrado = $('#cobradoconcilio'+idcon).val();

		var fecha = $('#fechaconcilio'+idcon).val();

		var pendiente = $('input#pendiente').val();

		var idfac = $(this).attr('id_fac');

		var cobradoya = $(this).val();

		var total = $('#total_factura').val();

		// alert(total);

		var totalcobrado = parseFloat(cobrado)+parseFloat(cobradoya);

		var observaciones = $('#observaciones'+idcon).val();

		var numero = $('.modal-dialog input#numero').val();

		var tipo = numero.charAt(0);

		if ( tipo != 'P' && tipo != 'R') tipo = 'B';

		// alert(observaciones);

		// alert(cobrado);



		// if ( totalcobrado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&idcon='+idcon+'&cobrado='+cobrado+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&tabla='+tabla+'&observaciones='+observaciones+'&tipo='+tipo+'&actualizarconciliar=1',

				dataType: 'json',

				success: function(data)

				{

					alert("Guardado correctamente.");

						// $('input#cobrado').val(data[0]);

						// $('input#pendiente').val(data[1]);

				}

			}); ajax.abort();

		// }



	});





	$(document).on("click", "#actualizarconciliaracre", function(event) {



		event.preventDefault();



		// var nuevo = $(this).attr('nuevo');

		// var tabla = $('#tabla').val();

		var idcon = $(this).attr('id_concilio');

		var pagado = $('#pagadoconcilio'+idcon).val();

		var fecha = $('#fechaconcilio'+idcon).val();

		var pendiente = $('input#pendiente').val();

		var idfac = $(this).attr('id_fac');

		var pagadoya = $(this).val();

		var total = $('input#importe').val();

		var totalpagado = parseFloat(pagado)+parseFloat(pagadoya);

		var observaciones = $('#observaciones'+idcon).val();

		// alert(totalpagado);



		// if ( totalcobrado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&idcon='+idcon+'&pagado='+pagado+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&observaciones='+observaciones+'&actualizarconciliar=2',

				dataType: 'json',

				success: function(data)

				{

					alert("Guardado correctamente.");

						// $('input#pagado').val(data[0]);

						// $('input#pendiente').val(data[1]);

				}

			}); ajax.abort();

		// }



	});





//////////////////////////////////

//////////////////////////////////

//////////////////////////////////

//////////////////////////////////

//////////////////////////////////

//////////////////////////////////





    $(document).on("click", "#anadirapuntefac", function(event){



		event.preventDefault();

		// alert("añadir");





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'anadirapuntefac=1',

			success: function(data)

			{

				$('#marca_apunte').html(data);


			}

		}); ajax.abort();





    });

	//EDITADO POR OCTAVIO 11/5/2017
    $(document).on("click", "#anadirnomina", function(event){

		event.preventDefault();

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-facturacion.php',
			data: 'anadirnomina=1',
			success: function(data)
			{
				/*console.log(data);*/
				$('#marca_apunte').html(data);
			}

		}); ajax.abort();

    });
	//TERMINA EDICION




    $(document).on("click", "#subirpdfapuntefac", function(event){



		event.preventDefault();

		// alert("entra");



		var sec = $(location).attr('href').split("?");



		if ( sec[1] == 'form_apuntes-facturacion' || sec[1] == 'form_apuntes-facturacion#' ) {



			var acreedor = $('#acreedor').val();

			var numero = $('#numero').val();

			// alert(numero);



		} else {



			var acreedor = $('.contenido #acreedor').val();

			var numero = $('.contenido  #numero').val();



		}



		var formData = new FormData();

		// coge el archivo

		formData.append('file', $('#apuntefac').get(0).files[0]);

		formData.append('acreedor', acreedor);

		formData.append('numero', numero);

		formData.append('tipo', 'acreedor');

		// alert(formData);



		if ( $('#apuntefac').get(0).files[0] == undefined ) {



        	alert("Selecciona un archivo.");



        } else if ( acreedor != "" && numero != "" ) {



	        $.ajax({

	        	cache: false,

	            url: 'functions/subida_pdf.php',

	            type: 'POST',

	            data: formData,

	            processData: false,

	       		contentType: false,

	            success: function (data) {

	            	/*console.log(data);*/
	                if ( data == 'bien' ) {

	                	alert("Fichero subido correctamente.");

	                	$('#compmailfac').css('color','green');

	                }

	               	else

	               		alert("Fallo en la subida.");

	            }

	        }); ajax.abort();

    	}



	});

	//EDICION HECHA POR OCTAVIO 15/05/2017
	$(document).on("click", "#subirpdfdocentenomina", function(event){

			event.preventDefault();
			// alert("entra");
			var sec = $(location).attr('href').split("?");

			if ( sec[1] == 'form_apuntes-facturacion' || sec[1] == 'form_apuntes-facturacion#' ) {

				var fechainicio = $('#fechainicio').val();
				var fechafin = $('#fechafin').val();
				/*var docente = $('#docente').val();*/
				var docente = $('#docente').find('option:selected').attr('iden');
				// alert(numero);

			} else {

				var fechainicio = $('.contenido #fechainicio').attr('fecha');
				var fechafin = $('.contenido #fechafin').attr('fecha');
				// var mes = $('.contenido #mes').val();
				// var anio = $('.contenido  #anio').val();
				var docente = $('.contenido #docente').val();

			}

			var formData = new FormData();

			// coge el archivo

			formData.append('file', $('#apuntenomina').get(0).files[0]);

			formData.append('fechainicio', fechainicio);

			formData.append('fechafin', fechafin);

			formData.append('docente', docente);

			/*formData.append('nombredocente', docente);*/

			formData.append('tipo', 'nominadocente');

			// alert(formData);

			if ( $('#apuntenomina').get(0).files[0] == undefined ) {

	        	alert("Selecciona un archivo.");

	        	/*console.log($('#apuntenomina').val());*/

	        } else if ( fechainicio != "" && fechafin != "" && docente != "" ) {

		        $.ajax({

		        	cache: false,

		            url: 'functions/subida_pdf.php',

		            type: 'POST',

		            data: formData,

		            processData: false,

		       		contentType: false,

		            success: function (data) {

		            	/*console.log($('#apuntenomina').val());*/
		                if ( data == 'bien' ) {

		                	alert("Fichero subido correctamente.");

		                	$('#compmailfac').css('color','green');

		                }

		               	else

		               		alert("Fallo en la subida.");

		            }

		        }); ajax.abort();

	    	}

	});
	//TERMINA EDICION

	$(document).on("click", "#mostrarpdfapuntefac", function(event){



		event.preventDefault();

		// alert("entra");

		// var formData = new FormData();

		// coge el archivo

		// formData.append('file', $('#apuntefac').get(0).files[0]);

		var sec = $(location).attr('href').split("?");



		if ( sec[1] == 'form_apuntes-facturacion' || sec[1] == 'form_apuntes-facturacion#' ) {



			var acreedor = $('#acreedor').val();

			var numero = $('#numero').val();

			// alert(numero);



		} else {



			var acreedor = $('.contenido #acreedor').val();

			var numero = $('.contenido  #numero').val();



		}

		// var tipo = 'acreedor';

		// alert(formData);



		$.ajax({

		    cache: false,

		    type: 'POST',

		    url: 'functions/mostrar_pdf.php',

		    data: 'acreedor='+acreedor+'&numero='+numero+'&tipo=acreedores',

		    success: function(data)

		    {

				if ( data == 'no' )

					alert ("No hay PDF subido.");

				else

					window.open(data);

		    }

    	}); ajax.abort();

	});

	//EDICION HECHA POR OCTAVIO 15/05/2017
	$(document).on("click", "#mostrarpdfdocentenomina", function(event){



		event.preventDefault();

		// alert("entra");
		// var formData = new FormData();
		// coge el archivo
		// formData.append('file', $('#apuntefac').get(0).files[0]);

		var sec = $(location).attr('href').split("?");

		if ( sec[1] == 'form_apuntes-facturacion' || sec[1] == 'form_apuntes-facturacion#' ) {

			var fechainicio = $('#fechainicio').val();
			var fechafin = $('#fechafin').val();
			var docente = $('#docente').find('option:selected').attr('iden');

			// alert(numero);

		} else {
			var fechainicio = $('.contenido #fechainicio').attr('fecha');
			var fechafin = $('.contenido #fechafin').attr('fecha');
			var docente = $('.contenido  #docente').val();

		}

		// var tipo = 'acreedor';

		// alert(formData);



		$.ajax({

		    cache: false,

		    type: 'POST',

		    url: 'functions/mostrar_pdf.php',

		    data: 'fechainicio='+fechainicio+'&fechafin='+fechafin+'&docente='+docente+'&tipo=nominadocente',

		    success: function(data)

		    {

				if ( data == 'no' )

					alert ("No hay PDF subido.");

				else

					window.open(data);

		    }

    	}); ajax.abort();

	});
	//TERMINA EDICION


	// $(document).on("click", "#mostrarpdfapuntefac-in", function(event){



	// 	event.preventDefault();

	// 	// alert("entra");

	// 	// var formData = new FormData();

	// 	// coge el archivo

	// 	// formData.append('file', $('#apuntefac').get(0).files[0]);

	// 	var acreedor = $('#acreedor').val();

	// 	var numero = $('#numero').val();

	// 	// var tipo = 'acreedor';

	// 	// alert(formData);



	// 	$.ajax({

	// 	    cache: false,

	// 	    type: 'POST',

	// 	    url: 'functions/mostrar_pdf.php',

	// 	    data: 'acreedor='+acreedor+'&numero='+numero+'&tipo=acreedores',

	// 	    success: function(data)

	// 	    {

	// 			if ( data == 'no' )

	// 				alert ("No hay PDF subido.");

	// 			else

	// 				window.open(data);

	// 	    }

 //    	}); ajax.abort();

	// });





	$(document).on("click", "#buscaracreedor", function(event){



		// alert("busca!");

		var acreedor = $('#acreedor').val();



		$.ajax({

		    cache: false,

		    type: 'POST',

		    url: 'functions/buscaracreedor.php',

		    data: 'clave='+acreedor,

		    success: function(data)

		    {

		    	$('#mostrardatos').modal('show');

		    	$('.contenido').html(data);

		    }

    	}); ajax.abort();



	});







	$(document).on("click", "#seleccionaracreedorform", function(event){



		// alert("busca!");

		var acreedor = getRowText($(this),'nombre');

		var id_acreedor = getRow($(this),'id');

		// alert(acreedor);



		$('#acreedor').val(acreedor);

		$('#id_acreedor').val(id_acreedor);

		$('#mostrardatos').modal('hide');



	});





	$(document).on("click", "#guardaracreedorfac", function(event){



		var id_acreedor = $('#id_acreedor').val();

		var numero = $('#numero').val();

		var fecha = $('#fecha').val();

		var importe = $('#importe').val();

		var vencimiento = $('#vencimiento').val();

		var bruto = $('#bruto').val();

		var retencion = $('#retencion').val();

		var retencionpor = $('#retencionpor').val();

		var impuestos = $('#impuestos').val();

		var impuestospor = $('#impuestospor').val();

		var observaciones = $('#observaciones').val();



		if ( numero != "" && fecha != "" && importe != "" && vencimiento != "" && id_acreedor != "" && bruto != "" ) {





			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'acreedor='+id_acreedor+'&numero='+numero+'&fecha='+fecha+'&importe='+importe+'&bruto='+bruto+'&retencionpor='+retencionpor+'&retencion='+retencion+'&impuestospor='+impuestospor+'&impuestos='+impuestos+'&vencimiento='+vencimiento+'&observaciones='+observaciones+'&tipo=Factura&guardaracreedorfac=1',

				success: function(data)

				{

					if ( data.indexOf('error') != -1 ) {



						if ( data.indexOf('Duplicate') != -1 )

							alert('Factura duplicada.')

						else

							alert(data);


						return false;



					} else

						//cgutierrez
						$('#anadirmatacrefra').attr('id_fra', data);
						$('#divmatacrefra').show();

						alert("Guardado correctamente.")

				}

			}); ajax.abort();



		} else {



			alert("Completa todos los campos.")



		}



	});

//EDICION HECHA POR OCTAVIO 11/5/2017

	$(document).on("click", "#guardarnomina", function(event){

		var id_acreedor = $('#id_acreedor').val();
		var id_docente = $('#docente').find('option:selected').attr('iden');
		/*var fecha = $('#fecha').val();*/
		var mes = $('#mes').val();
		var anio = $('select#anio').val();
		var importe = $('#importe').val();
		var vencimiento = $('#vencimiento').val();
		var bruto = $('#bruto').val();
		var retencion = $('#retencion').val();
		var retencionpor = $('#retencionpor').val();
		var impuestos = $('#impuestos').val();
		var impuestospor = $('#impuestospor').val();
		var observaciones = $('#observaciones').val();
		var fecha_inicio = $('#fechainicio').val();
		var fecha_fin = $('#fechafin').val();


		if ( id_docente != "" && importe != "" && vencimiento != "" && bruto != "" && fecha_inicio != "" && fecha_fin != "") {

			$.ajax({
				cache: false,
				type: 'POST',
				url: 'functions/funciones-facturacion.php',
				data: 'acreedor='+id_acreedor+'&id_docente='+id_docente+'&importe='+importe+'&bruto='+bruto+'&retencionpor='+retencionpor+'&retencion='+retencion+'&impuestospor='+impuestospor+'&impuestos='+impuestos+'&vencimiento='+vencimiento+'&observaciones='+observaciones+'&tipo=Nomina&fecha_inicio='+fecha_inicio+'&fecha_fin='+fecha_fin+'&guardarnomina=1',
				success: function(data)
				{
					/*console.log(data);*/
					if ( data.indexOf('error') != -1 ) {

						if ( data.indexOf('Duplicate') != -1 )
							alert('Nomina duplicada.')
						else
							alert(data);

						return false;

					} else

						$('#anadirmatacrefra').attr('id_fra', data);
						$('#divmatacrefra').show();

						alert("Guardado correctamente.")

				}

			}); ajax.abort();

		} else {

			alert("Completa todos los campos.")

		}

	});

//TERMINA EDICION

//AÑADIDO BOTON OCTAVIO 23/5/2017

	$(document).on("click", "#btnLiquidar", function(event){

		/*console.log($(this).attr('id_mat'));*/
		var id_matricula = $(this).attr('id_mat');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-facturacion.php',
			data: 'matricula=' + id_matricula + '&liquidar=1',
			success : function(data){
				alert('Estado de factura cambiado con exito.');
			}
		});

	});

//TERMINA AÑADIDO


	$(document).on("click", "#actualizardetalleacre", function(event){



		var values = $('.contenidofra').find("input[type='hidden'], :input:not(:hidden)").serialize();

		var idfac = $(this).attr('id_fac');

		values = values+'&actualizardetalleacre=1'+'&id_fac='+idfac;



		alert(values);



		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: values,

			success: function(data)

			{



				if ( data.indexOf('error') != -1 ) {

					alert("ERROR: "+data);

				} else {

					// alert(data);

					alert("Actualizado correctamente");

				}



			}

		}); ajax.abort();



	});



	$(document).on("click", "#busqueda-seguimientofacre", function (event) {



	    event.preventDefault();

	    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');

		$(this).find('span').addClass('spin');

	    listarcursosacre('');



	});

	$(document).on("click", "#busqueda-nominadocente", function (event) {



	    event.preventDefault();

	    $(this).find('span').toggleClass('glyphicon-search glyphicon-refresh');

		$(this).find('span').addClass('spin');

	    listarcursosacre('1');



	});





	function listarcursosacre(tipo) {

		    var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();
		    values += '&opcionFacturacionSeleccionada='+$('select#opcionFacturacionSeleccionada').val();
		    console.log(values);

		    $.ajax({

		        cache: false,

		        type: 'POST',

		        url: 'functions/busqueda-seguimiento-facre.php',

		        data: values + '&docente='+tipo,

		        success: function(data)

		        {



		            $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');

		    		$('.glyphicon-search').removeClass('spin');



		            $('#listado-seguimiento').html(data);

		            var sum = 0;

		            $("td#pagado").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                    sum += parseFloat(value);

		                }

		            });



		            var sum2 = 0;

		            $("td#importe").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum2);

		                    sum2 += parseFloat(value);

		                }

		            });



		            var sum3 = 0;

		            $("td#pendiente").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum3);

		                    sum3 += parseFloat(value);

		                }

		            });

		            $('.table').append('<tr><td colspan="7"></td><td class="info">Total Pagado: </td><td colspan="2" style="text-align:center; font-size: 15px" class="info"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="7"></td><td class="danger">Total Pendiente: </td><td colspan="2" style="text-align:center; font-size: 15px" class="danger"><strong>'+(sum3.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="7"></td><td class="success">Total Facturas: </td><td colspan="2" style="text-align:center; font-size: 15px" class="success"><strong>'+(sum2.toFixed(2)).replace(".",",")+' €</strong></td></tr>');

		            $('#imprimirSeguimientoc').css('display','inline-block');

		            $('#listadoExcelAcre').css('display','inline-block');

		            $('#listadoExcelAcre').css('margin-right','5px');

		            $('#mostrardatos').removeClass('onhideacre');

		        }



		    }); ajax.abort();

	}





	function listardevoluciones() {

		    var values = $('#form-seguimiento').find("input[type='hidden'], :input:not(:hidden)").serialize();



		    $.ajax({

		        cache: false,

		        type: 'POST',

		        url: 'functions/busqueda-seguimientodevol.php',

		        data: values,

		        success: function(data)

		        {



		            $('.glyphicon-refresh').toggleClass('glyphicon-refresh glyphicon-search');

		    		$('.glyphicon-search').removeClass('spin');



		            $('#listado-seguimiento').html(data);

		            var sum = 0;

		            $("td#pagado").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                    sum += parseFloat(value);

		                }

		            });



		            var sum2 = 0;

		            $("td#importe").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum2);

		                    sum2 += parseFloat(value);

		                }

		            });



		            var sum3 = 0;

		            $("td#pendiente").each(function() {



		                var value = $(this).text();

		                // value = value.split(" €");

		                // value = value.replace(".","");

		                // value = value.replace(",",".");



		                // add only if the value is number

		                if(!isNaN(value) && value.length != 0) {

		                	// alert(sum3);

		                    sum3 += parseFloat(value);

		                }

		            });

		            $('.table').append('<tr><td colspan="7"></td><td class="info">Total Pagado: </td><td colspan="2" style="text-align:center; font-size: 15px" class="info"><strong>'+(sum.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="7"></td><td class="danger">Total Pendiente: </td><td colspan="2" style="text-align:center; font-size: 15px" class="danger"><strong>'+(sum3.toFixed(2)).replace(".",",")+' €</strong></td></tr><tr><td style="border:0px" colspan="7"></td><td class="success">Total Facturas: </td><td colspan="2" style="text-align:center; font-size: 15px" class="success"><strong>'+(sum2.toFixed(2)).replace(".",",")+' €</strong></td></tr>');

		            $('#imprimirSeguimientoc').css('display','inline-block');

		            $('#listadoExcel').css('display','inline-block');

		            $('#listadoExcel').css('margin-right','5px');

		            $('#mostrardatos').removeClass('onhideacre');

		        }



		    }); ajax.abort();

	}





	$(document).on("click", "#detalleFacturaAcre", function(event){



		event.preventDefault();



		var id_fac = getRow($(this),"id");

		// alert(id_fac);

		// var tabla = $(this).attr('tabla');





		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_fac='+id_fac+'&detallefacturaacre=1&tipo=factura',

			success: function(data)

			{

				$('#mostrardatos').modal('show');

				$('#mostrardatos').addClass('onhideacre');

				$('.modal-dialog').css('width','1150px');

				$('.mostrartitulo').html('Detalle de la Factura');

				$('.contenido').html(data);

			}

		}); ajax.abort();





    });


    //EVENTO HECHO POR OCTAVIO 17/05/2017

	$(document).on("click", "#detalleNomina", function(event){

		event.preventDefault();

		var idNomina = getRow($(this),"id");

		//console.log(idNomina);

		// var tabla = $(this).attr('tabla');

		$.ajax({
			cache: false,
			type: 'POST',
			url: 'functions/funciones-facturacion.php',
			data: 'id_fac='+idNomina+'&detallenomina=1&tipo=nomina',
			success: function(data)
			{
				$('#mostrardatos').modal('show');
				$('#mostrardatos').addClass('onhideacre');
				$('.modal-dialog').css('width','1150px');
				$('.mostrartitulo').html('Detalle de la Nomina');
				$('.contenido').html(data);
			}

		}); ajax.abort();

	});

    //TERMINA EVENTO





	$(document).on("click", "#anadirdevolucion", function(event){



		event.preventDefault();

		var id_fac = $(this).attr('id_fac');



		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfac='+id_fac+'&anadirdevolucion=1',

			success: function(data)

			{

				$('#marca_concilio').before(data);

			}

		}); ajax.abort();

    });





    $(document).on("click", "#guardardevolucion", function(event) {



		event.preventDefault();



		var numerofra = $('input#numero').val();

		var btn = $(this);

		var tabla = $('#tabla').val();

		var nuevo = $(this).attr('nuevo');

		var devolucion = $('#devolucionconcilio'+nuevo).val();

		var gastodevolucion = $('#gastodevolucion'+nuevo).val();

		var pendiente = $('input#pendiente').val();

		var fecha = $('#fechadevolucion'+nuevo).val();

		var idfac = $(this).attr('id_fac');

		var total = $('input#total_factura').val();

		var email_facturas = $('input#email_facturas').val();

		var cobradoya = $('input#cobrado').val();

		// var totalcobrado = parseFloat(cobradoya)-parseFloat(devuelto);

		// var totalpendiente = parseFloat(pendiente)+parseFloat(gastodevolucion);

		var observaciones = $('#observaciones'+nuevo).val();

		var numero = $('.modal-dialog input#numero').val();

		var tipo = numero.charAt(0);



		if ( tipo != 'P' && tipo != 'R') tipo = 'B';

		// alert(totalcobrado);



		// if ( totalcobrado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {




			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&devolucion='+devolucion+'&gastodevolucion='+gastodevolucion+'&cobrado='+cobradoya+'&tabla='+tabla+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&observaciones='+observaciones+'&tipo='+tipo+'&email_facturas='+email_facturas+'&numerofra='+numerofra+'&fecha='+$('#fecha').val()+'&guardardevolucion=1',

				dataType: 'json',

				success: function(data)

				{

					alert("Guardado correctamente.");

					$('input#cobrado').val(data[0]);

					$('input#pendiente').val(data[1]);

					// btn.attr('id', 'actualizardevolucion');

				}

			}); ajax.abort();



	});



	$(document).on("click", "#actualizardevolucion", function(event) {



		event.preventDefault();



		var tabla = $('#tabla').val();

		var iddevol = $(this).attr('id_concilio');

		var devolucion = $('#devolucionconcilio'+iddevol).val();

		var gastodevolucion = $('#gastodevolucion'+iddevol).val();

		var pendiente = $('input#pendiente').val();

		var fecha = $('#fechadevolucion'+iddevol).val();

		var idfac = $(this).attr('id_fac');

		var total = $('input#total_factura').val();

		var cobradoya = $('input#cobrado').val();

		// var totalcobrado = parseFloat(cobradoya)-parseFloat(devuelto);

		// var totalpendiente = parseFloat(pendiente)+parseFloat(gastodevolucion);

		var observaciones = $('#observaciones'+iddevol).val();

		var numero = $('.modal-dialog input#numero').val();

		var tipo = numero.charAt(0);

		if ( tipo != 'P' && tipo != 'R') tipo = 'B';

		// alert(totalcobrado);



		// if ( totalcobrado > total )

		// 	alert("Las cantidades suman más que el total.");



		// else {



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&iddevol='+iddevol+'&devolucion='+devolucion+'&gastodevolucion='+gastodevolucion+'&cobrado='+cobradoya+'&tabla='+tabla+'&fecha='+fecha+'&total='+total+'&pendiente='+pendiente+'&observaciones='+observaciones+'&tipo='+tipo+'&actualizardevolucion=1',

				dataType: 'json',

				success: function(data)

				{



						alert("Guardado correctamente.");

						$('input#cobrado').val(data[0]);

						$('input#pendiente').val(data[1]);



				}

			}); ajax.abort();



	});





	$(document).on("click", "#actualizarvencimiento", function(event) {



		event.preventDefault();



		var tabla = $('#tabla').val();

		var idfac = $(this).attr('id_fac');

		var idemp = $(this).attr('id_emp');

		var observacionesfra = $('textarea#observacionesfra').val();

		// alert(observacionesfra);

		var vencimiento = $('input#vencimiento').val();

		var fecha = $('input#fecha').val();

		// var idemp = $('input#fecha').val();



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&vencimiento='+vencimiento+'&fecha='+fecha+'&idemp='+idemp+'&tabla='+tabla+'&observacionesfra='+observacionesfra+'&actualizarvencimiento=1',

				success: function(data)

				{



					alert("Vencimiento/Observaciones actualizado.");

					$('input#fecha_vencimiento').prop('disabled', false).val(data);

					$('input#fecha_vencimiento').prop('disabled', true);



				}

			}); ajax.abort();



	});



	$(document).on("click", "#actualizarvencimientofaca", function(event) {



		event.preventDefault();



		var tabla = $('#tabla').val();

		var idfac = $(this).attr('id_fac');

		var idemp = $(this).attr('id_emp');

		var observacionesfra = $('textarea#observacionesfra').val();

		var vencimiento = $('input#vencimientofaca').val();

		var fecha = $('input#fecha').val();

		// var idemp = $('input#fecha').val();



			$.ajax({

				cache: false,

				type: 'POST',

				url: 'functions/funciones-facturacion.php',

				data: 'idfac='+idfac+'&vencimiento='+vencimiento+'&fecha='+fecha+'&idemp='+idemp+'&tabla='+tabla+'&observacionesfra='+observacionesfra+'&actualizarvencimiento=1',

				success: function(data)

				{



					alert("Vencimiento actualizado/Observaciones actualizado.");

					$('input#fecha_vencimientofaca').prop('disabled', false).val(data);

					$('input#fecha_vencimientofaca').prop('disabled', true);



				}

			}); ajax.abort();



	});

//**************************************************//
//**************************************************//
// Autor: 		cgutierrez							//
// Fecha: 		06/10/2016							//
// Descripción: Muesta los controles para añadir 	//
//				una matrícula a una factura para su //
//				imputación 							//
//**************************************************//
//**************************************************//
$(document).on("click", "#anadirmatacrefra", function(event){

	event.preventDefault();

	var id_fra = $(this).attr('id_fra');
	if ( $(this).attr('existe') == 1 ) var existe = '&existe=1';

	if ( ( id_fra != undefined ) ) {

		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'idfra='+id_fra+existe+'&anadirmatacrefra=1',

			success: function(data)

			{

				//$('#marca_matacrefra').before(data);
				var sec = seccion();
				// console.log(sec);
				if ( sec.indexOf("form_control-facturacion-acre") != -1  ) {
					console.log('entra ' + data);
					$('.divmatacrefra').after(data);
				}
				else
					$('#divmatacrefra').after(data);

			}

		}); ajax.abort();

	} else {

	 	alert("Guarde primero la factura.");

	}

});

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       03/10/2016                          //
// Descripción: Muestra buscador de matrícula 		//
//**************************************************//
//**************************************************//
$(document).on("click", "#buscarmatricula", function(event){


	event.preventDefault();

	var nuevo = $(this).attr('nuevo');

	var matricula = $('#numeroaccion'+nuevo).val();

	$.ajax({

	    cache: false,

	    type: 'POST',

	    url: 'functions/buscarmatricula.php',

	    data: 'clave='+matricula+'&nuevo='+nuevo,

	    success: function(data)

	    {

	    	$('#mostrardatosc').modal('show');

	    	$('#mostrardatosc .contenido').html(data);

	    }

	}); ajax.abort();

});



//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       03/10/2016                          //
// Descripción: Envía matrícula seleccionada en 	//
// 				forlumario modal al formulario 		//
//				principal 							//
//**************************************************//
//**************************************************//
$(document).on("click", "#seleccionamatriculaform", function(event){

	var nuevo = $(this).attr('nuevo');

	var id_matricula = getRow($(this),'id');
	var accion = getRow($(this),'accion'+nuevo);

	var sec = seccion();
	// console.log(sec);
	if ( sec.indexOf("tpc") != -1  )
		$('#id_mat').val(id_matricula);
	else
		$('#id_matricula'+nuevo).val(id_matricula);
	$('#numeroaccion'+nuevo).val(accion);

	$('#mostrardatosc').modal('hide');

});

//**************************************************//
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       03/10/2016                          //
// Descripción: Abrir Modal con las búsqueda de 	//
//				Matrículas 							//
//**************************************************//
//**************************************************//
$(document).on("click", "#guardarmatacrefra", function(event){

	var nuevo = $(this).attr('nuevo');

	var id_factura =$(this).attr('id_fra');

	var id_matricula = $('#id_matricula'+nuevo).val();

	var importe = $('#importe'+nuevo).val();

	var porcentaje = $('#porcentaje'+nuevo).val();

	var tipogasto = $('#tipogasto'+nuevo).val();

	var gastoformacion = $('#gastoformacion'+nuevo).val();

	var id_comercial = $('#id_comercial'+nuevo).val();

	var id_facre = $(this).attr('id_facre');


	if ( importe != "" || porcentaje != "" ) {

		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'id_factura='+id_factura+'&id_matricula='+id_matricula+'&importe='+importe+'&porcentaje='+porcentaje+'&tipogasto='+tipogasto+'&gastoformacion='+gastoformacion+'&id_comercial='+id_comercial+'&id_facre='+id_facre+'&guardarmatacrefra=1',

			dataType: 'json',

			success: function(data)

			{

				if ( data.indexOf('error') != -1 ) {

					if ( data.indexOf('Duplicate') != -1 )

						alert('Factura duplicada.')

					else

						alert(data);

					return false;

				} else if ( data.indexOf('aviso') != -1 ) {

					var aviso = data;

					alert(aviso.substring(6));

					//$('#anadirmatacrefra').prop("disabled", true);

					return false;

				} else

					alert("Guardado correctamente.")

					$importe = data[0];
					$porcentaje = data[1];

					$('input#importe'+nuevo).val($importe);
					$('input#porcentaje'+nuevo).val($porcentaje);

			}

		}); ajax.abort();

	} else {

		alert("Completa todos los campos.")

	}

});

//**************************************************//
//**************************************************//
// Autor: 		cgutierrez							//
// Fecha: 		07/11/2016							//
// Descripción: Muesta los controles para añadir 	//
//				un nuevo Iten de Otros Gastos       //
//**************************************************//
//**************************************************//
$(document).on("click", "#nuevoitemrentabilidad", function(event){

	event.preventDefault();

	var tipoGasto =$(this).attr('tipoGasto');

	$.ajax({

		cache: false,

		type: 'POST',

		url: 'functions/funciones-facturacion.php',

		data: 'tipoGasto='+tipoGasto+'&nuevoitemrentabilidad=1',

		success: function(data)

		{

			$('#divnuevoitemrentabilidad').after(data);

		}

	}); ajax.abort();

});

//**************************************************//
//**************************************************//
// Autor: 		cgutierrez							//
// Fecha: 		07/11/2016							//
// Descripción: Muesta los controles para añadir 	//
//				un nuevo Iten de Otros Gastos       //
//**************************************************//
//**************************************************//
$(document).on("click", "#guardaritemrentabilidad", function(event){

	var itemdescripcion = $('#itemdescripcion').val();

	var tipoGasto =$(this).attr('tipoGasto');

	var itemprecio = $('#itemprecio').val();

	var select = '';

	event.preventDefault();

	if ( itemdescripcion != '' || itemprecio != '' ) {

		$.ajax({

			cache: false,

			type: 'POST',

			url: 'functions/funciones-facturacion.php',

			data: 'tipoGasto='+tipoGasto+'&itemdescripcion='+itemdescripcion+'&itemprecio='+itemprecio+'&guardaritemrentabilidad=1',

			success: function(data)

			{

				alert("Item añadido correctamente.");

			}

		});


		if ( tipoGasto == 0 ) {
	        select = '#listafun';
	    } else if ( tipoGasto == 1 ) {
	        select = '#listaotros';
	    }

	    $.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones.php',
	        data: 'tipoGasto='+tipoGasto+'&cargarSelectRentabilidad=1',
	        success: function(data)
	        {
	            $(select).html(data);
	        }
	    });

		$('#itemdescripcion').val('');
		$('#itemprecio').val('');

		ajax.abort();

	} else {

		alert("Completa todos los campos");
	}

});

//Modal para el detalle de Seguimiento de Facturación (rentabilidad)
$(document).on("click", "#detalleSeguimientoFacturacion", function(event){

	event.preventDefault();

	var id_matricula = getRow($(this),"id_mat");
	var id_empresa = getRow($(this),"id_emp");

	$.ajax({

		cache: false,
		type: 'POST',
		url: 'functions/funciones-facturacion.php',
		data : 'id_matricula='+id_matricula+'&id_empresa='+id_empresa+'&detalleSeguimientoFacturacion=1',

		success: function(data)
		{
			$('#mostrardatos').modal('show');
			//$('#mostrardatos').addClass('onhideacre');
			$('.modal-dialog').css('width','1200px');
			$('.mostrartitulo').html('Detalle Seguimiento Facturación');
			$('.contenido').html(data);
		}

	}); ajax.abort();

});

$(document).on("change", "#opcionFacturacionSeleccionada", function(event){

	var opcion = $(this).find('option:selected').val();

	if (opcion == "Acreedor") {
		$('#factura').css('display', 'initial');
		$('#nomina').css('display', 'none');
	}else{
		$('#factura').css('display', 'none');
		$('#nomina').css('display', 'initial');
	}

});