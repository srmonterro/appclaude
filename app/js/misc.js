
var gestion = parseInt($('#aniovigente').val());
if ( gestion == '2014' ) gestion = '';
else gestion = gestion;
var item = 0;

$(document).on("click", "#registro_general", function(event){

	event.preventDefault();

	$.ajax({
        cache: false,
        type: 'POST',
        url: 'functions/funciones-misc.php',
        data: 'regeneral=1',
        success: function(data)
        {
            $('#registro').html(data);
            $('#imprimirRegistro').css('display','inline-block');
        }
	}); ajax.abort();

});


$(document).on("click", "#anadirfungiblesol", function(event){

	// alert("e");
	item++;
	var input = '<div id="form_item_'+item+'"><div class="col-md-5" > <div class="form-group"> <label class="control-label" for="item">Item:</label> <input type="text" id="item" name="item" class="form-control" /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="control-label" for="cantidad">Cantidad:</label> <input type="text" id="cantidad" name="cantidad" class="form-control" /> </div> </div> <div class="col-md-2"> <div class="form-group"> <label class="control-label" for="precio">Precio:</label> <input type="text" id="precio" name="precio" class="form-control" /> </div> </div> <div class="col-md-3"> <div class="form-group"> <label class="control-label" for="subtotal">Total:</label> <input type="text" id="subtotal" name="subtotal" class="form-control" /> </div> </div></div>';

	// alert(input);
	$('.zonafungibles').prepend(input);

});

$(document).on("click", "#registro_dias", function(event){

	event.preventDefault();

	$('#mostrardatos').modal('show');
	$('.modal-dialog').width('400px');
	$('.mostrartitulo').html('Elige un día');
	$('button#guardarcambios').css('display','inline-block');
	$('button#guardarcambios').text('Mostrar Registro');
	$('button#guardarcambios').attr('id','mostrardiareg');

	var input_fecha = '<div style="margin-top: 15px; overflow: auto"><div style="margin-bottom: 15px" class="col-md-10 col-md-push-1"><div class="form-group"><label class="control-label" for="diareg">Día de Registro:</label><input type="date" id="diareg" name="diareg" class="form-control" /></div></div></div>';
	$('.contenido').html(input_fecha);


});


$(document).on("click", "#mostrardiareg", function(event){

	event.preventDefault();

	var dia = $('#diareg').val();
	// alert(dia);

	$.ajax({
        cache: false,
        type: 'POST',
        url: 'functions/funciones-misc.php',
        data: 'dia='+dia+'&regdias=1',
        success: function(data)
        {
            $('#registro').html(data);
            $('#imprimirRegistro').css('display','inline-block');
        }
	}); ajax.abort();

});


$(document).on("click", "#todoscert", function(event){

	event.preventDefault();
    var id_matricula = $(this).attr('name');

	window.open('http://gestion.eduka-te.com/app/documentacion/certificadoincendios.php?id_matricula='+id_matricula, '_blank');

});


$(document).on("click", "#cert-seleccionarmat", function(event){

	event.preventDefault();
	var button = $(this);
    var parentTd = button.parent('td');
    var parentTr = parentTd.parent('tr');
    var id_matricula = parentTr.find('td#id').html();

 	$.ajax({
	        cache: false,
	        type: 'POST',
	        url: 'functions/funciones-misc.php',
	        data: 'id_matricula='+id_matricula+'&prevcertificado=1',
	        success: function(data)
	        {
	        	$('#mostrardatos').modal('show');
	        	$('.modal-dialog').css('width','850px');
	        	$('.mostrartitulo').html("Certificados Contra Incendios");
	        	$('.contenido').html(data);
	        }
	});

});


$(document).on("click", "#cert-empresa", function(event){

	event.preventDefault();
	var id_matricula = $("#todoscert").attr('name');
    var id_empresa = $(this).attr('name');

	window.open('http://gestion.eduka-te.com/app/documentacion/certificadoincendiosemp.php?id_matricula='+id_matricula+'&id_empresa='+id_empresa, '_blank');

});

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



// ********************* //
// ********************* //
// * SOLICITUD GASTOS *  //
// ********************* //
// ********************* //


$(document).on("change", "select#motivogasto", function(event) {

	var selected = $(this).val();

	// alert(selected);

	if ( selected == 'Material Curso' ) {

		var input = '<div class="clearfix"></div><div class="zonasolmat"><div class="col-md-2"> <div class="form-group"> <label class="control-label" for="tiposolicitud">Tipo Solicitud:</label> <select id="tiposolicitud" name="tiposolicitud" class="form-control" > <option value="eduka-te">eduka-te</option> <option value="IKEA">IKEA</option> </select> </div></div><div class="col-md-10"> <div class="cp form-group"> <label class="control-label" for="solicitud">Solicitud:</label> <div class="input-group"> <input type="text" placeholder="Busqueda por denominación" id="solicitud" name="solicitud" class="form-control"/> <input type="hidden" id="id_solicitudikea" name="id_solicitudikea" class="form-control"/> <input type="hidden" id="id_solicitud" name="id_solicitud" class="form-control"/> <span class="input-group-btn"> <button id="buscarsolicitud" name="buscarsolicitud" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button> </span> </div></div></div></div><div class="clearfix"></div>';

		$('hr').after(input);


	} else if ( selected == 'Docente' ) {

		var input = '<div class="clearfix"></div><div class="zonadocmat"><div class="col-md-6"> <div class="cp form-group"> <label class="control-label" for="docente">Buscar Docente:</label> <div class="input-group"> <input type="text" placeholder="Busqueda por nombre" id="docente" name="docente" class="form-control"/><input type="hidden" id="id_docente" name="id_docente" class="form-control"/> <span class="input-group-btn"> <button tabla="docentes" id="buscardocente" name="buscardocente" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button> </span> </div></div></div></div><div class="clearfix"></div>';

		console.log("triggea docente");
		$('div.activo .motivoinput').before(input);

	}




});





// $(document).on("click", "div#peticiones_gastos input[name=submitx]", function(event) {

// 	alert("submit de form alojamiento");

// });




// ********************* //
// ********************* //
// *** RENTABILIDAD ***  //
// ********************* //
// ********************* //





$(document).on("keyup", "#precioventamat,#alumnosestimados", function(event){

 	hd = parseFloat($('#precioventamat').val());
 	hp = parseFloat($('#alumnosestimados').val());
 	if (isNaN(hd))
 		hd = 0;
 	if (isNaN(hp))
 		hp = 0;
 	total = hd*hp;
 	$('#totalingresos').val(total);

});

$(document).on("click", "#abrircosteaula", function(event){

	event.preventDefault();
	$('#mostrardatos').modal('show');


});

$(document).on("click", "#abrircostedocente", function(event){

	event.preventDefault();
	var inputdoc = '<div style="overflow:auto; margin-top: 10px;" class="col-md-12"><div class="col-md-offset-1 col-md-5"><div class="form-group"><label class="control-label" for="costehora">¿ Alta Laboral ?</label><select id="altalaboral" name="altalaboral" class="form-control"><option value="si">Sí</option><option value="no">No</option></select></div></div><div class="col-md-5"><div class="form-group"><label class="control-label" for="costehora">Coste Bruto/Hora Docente:</label><input type="text" id="costehora" name="costehora" class="form-control"/></div></div></div><div class=clearfix></div>';

	var btnguardacostedoc = '<button id="guardarcostesdoc" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';

	if ( $('#horastotales').val() == 0 || $('#horastotales').val() == undefined ) {
		alert("Selecciona primero una acción");
	} else if ( ($("input[id^='id_docente']").val() == 0 || $("input[id^='id_docente']").val() == undefined) && $('#id_matricula').val() == "" ) {
			alert("Selecciona primero un docente");
	} else {

	var id_docente = $("input[id^='id_docente']").val();
	var id_matricula = $('#id_matricula').val();

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones.php',
		data: 'id_docente='+id_docente+'&id_matricula='+id_matricula+'&costedocente=1',
		success: function(data)
		{
			$('#mostrardatosc').modal('show');
			$('#mostrardatosc .mostrartitulo').html('Coste Docente');
			// $('#guardarcambios').css('display','inline-block');
			// $('#guardarcambios').attr('id','guardarcostesdoc');
			$('#mostrardatosc .modal-footer').html(btnguardacostedoc);
			$('#mostrardatosc .contenido').html(data);
		}
		}); ajax.abort();
	}


});


$(document).on("click", "#guardarcostesdoc", function(event){

	event.preventDefault();

		if ( $('#altalaboral').val() == 'si' )
			var costedoc = $('#horastotales').val()*($('#costehora').val()*1.35);
		else
			var costedoc = $('#horastotales').val()*$('#costehora').val();

		$('#costedocente').val(costedoc);
		// $('#guardarcostesdoc').attr('id','guardarcambios');


});


$(document).on("click", "#abrirfungibledidac", function(event){

	event.preventDefault();
	var btnguardarcostesfundic = '<button id="guardarcostesfundic" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones.php',
		data: 'costefungibles=1',
		success: function(data)
		{
			$('#mostrardatosc').modal('show');
			$('#mostrardatosc .mostrartitulo').html('Coste Fungibles - Didáctico');
			// $('#guardarcambios').css('display','inline-block');
			$('#mostrardatosc .modal-footer').html(btnguardarcostesfundic);
			$('#mostrardatosc .contenido').html(data);
		}
	}); ajax.abort();

});

$(document).on("change", "#listafun", function(event){

	event.preventDefault();

	var nalumnos = 1;
	nalumnos = $('#alumnosestimados').val();
	if ( nalumnos == "" || nalumnos == undefined )
		nalumnos = 1;

	var nuevoitem = '<div class="fungibles"><div id="fungiblerow" class="col-md-12" style="margin-top: 15px;"><div class="col-md-4"><div class="form-group"><label class="control-label" for="nuevoitem">Item:</label><input type="text" value="'+$("#listafun option:selected").val()+'" iden="'+$("#listafun option:selected").attr('iden')+'" id="nuevoitem" name="nuevoitem" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="precioitem">Precio:</label><input value="'+$("#listafun option:selected").attr('precio')+'" type="text" id="precioitem'+$("#listafun option:selected").attr('iden')+'" name="precioitem" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="cantidaditem">Cantidad:</label><input type="text" value="'+nalumnos+'" id="cantidaditem'+$("#listafun option:selected").attr('iden')+'" name="cantidaditem" class="form-control"/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="totalitem">Total:</label><input type="text" value="'+(nalumnos*$("#listafun option:selected").attr('precio')).toFixed(2)+'" id="totalitem'+$("#listafun option:selected").attr('iden')+'" name="totalitem" class="form-control"/></div></div></div></div><div class="clearfix"></div>';

	$('#fin_listafun').after(nuevoitem);

});

$(document).on("change", "#listaotros", function(event){

	event.preventDefault();

	var nuevoitem = '<div class="col-md-12" style="margin-top: 15px;"><div class="col-md-4"><div class="form-group"><label class="control-label" for="nuevoitem">Item:</label><input type="text" value="'+$("#listaotros option:selected").val()+'" iden="'+$("#listaotros option:selected").attr('iden')+'" id="nuevoitem" name="nuevoitem" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="precioitem">Precio:</label><input value="'+$("#listaotros option:selected").attr('precio')+'" type="text" id="precioitem'+$("#listaotros option:selected").attr('iden')+'" name="precioitem" class="form-control" readonly/></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="cantidaditem">Cantidad:</label><input type="text" value="1" id="cantidaditem'+$("#listaotros option:selected").attr('iden')+'" name="cantidaditem" class="form-control"/></div></div><div class="col-md-2"><div class="form-group"><label class="control-label" for="totalitem">Total:</label><input type="text" value="'+$("#listaotros option:selected").attr('precio')+'" id="totalitem'+$("#listaotros option:selected").attr('iden')+'" name="totalitem" class="form-control"/></div></div></div><div class="clearfix"></div>';

	$('#fin_listafun').after(nuevoitem);

});

$(document).on("keyup", "[id^='precioitem']", function(event){

	var id = $(this).attr('id');
	id = id.split("precioitem");
	// alert(id[1]);
 	hd = parseFloat($('#precioitem'+id[1]).val());
 	hp = parseFloat($('#cantidaditem'+id[1]).val());
 	if (isNaN(hd))
 		hd = 0;
 	if (isNaN(hp))
 		hp = 0;
 	total = hd*hp;
 	$('#totalitem'+id[1]).val(total);

});

$(document).on("keyup", "[id^='cantidaditem']", function(event){

	var id = $(this).attr('id');
	id = id.split("cantidaditem");
	// alert(id[1]);
 	hd = parseFloat($('#precioitem'+id[1]).val());
 	hp = parseFloat($('#cantidaditem'+id[1]).val());
 	if (isNaN(hd))
 		hd = 0;
 	if (isNaN(hp))
 		hp = 0;
 	total = (hd*hp).toFixed(2);
 	$('#totalitem'+id[1]).val(total);

});


$(document).on("click", "#guardarcostesfundic", function(event){

	event.preventDefault();

	var totalfundic = 0;
	$('[id^=totalitem]').each( function (index) {
		var value = Number($(this).val());
    	if (!isNaN(value)) totalfundic += value;
	});

	$('#fungibledidac').val(totalfundic);
	// $('#guardarcostesfundic').attr('id','guardarcambios');


	// guardamos en Arrays los ids y las camtidades de los items añadidos
	var items =[];
	$('[id^=nuevoitem]').each( function (index) {
		if ($(this).attr('id') != 'nuevoitemrentabilidad'){
			var value = Number($(this).attr('iden'));
	    	items[index] = value;
    	}
	});

	var cantidades = [];
	$('[id^=cantidaditem]').each( function (index) {
		var value = Number($(this).val());
    	cantidades[index] = value;
	});

	// asignamos esos Arrays a dos hiddens del formulario principal
	$('#fungibleitems').data('iden', []);
	$('#fungibleitems').data('iden').push(items);
	$('#fungibleitems').data('cantidad', []);
	$('#fungibleitems').data('cantidad').push(cantidades);

	console.log($('#fungibleitems').data('iden')[0]);
	console.log($('#fungibleitems').data('cantidad')[0]);

	insertarFungibles();

});

$(document).on("click", "#guardarotrosgastos", function(event){

	event.preventDefault();

	var totalotros = 0;
	var items = [];

	$('[id^=totalitem]').each( function (index) {
		var value = Number($(this).val());
    	if (!isNaN(value)) totalotros += value;
	});

	// $('[id^=cantidaditem]').each( function (index) {

	// 	var id = $(this).attr('id');
	// 	id = id.split("cantidaditem");

	// 	var precio = $('#precioitem'+id[1]).val();
	// 	var cantidad = Number($(this).val());
	// 	var total = $('#totalitem'+id[1]).val();

 //    	var valores = id[1]+'-'+precio+'-'+cantidad+'-'+total;

	// 	items.push(valores);

	// });

	// $.ajax({
	// 	cache: false,
	// 	type: 'POST',
	// 	url: 'functions/guardadetalleotros.php',
	// 	data: { items : items },
	// 	success: function(data)
	// 	{
	// 		alert(data);
	// 	}
	// }); ajax.abort();

	$('#otrosgastos').val(totalotros);
	// $('#guardarotrosgastos').attr('id','guardarcambios');

	// guardamos en Arrays los ids y las camtidades de los items añadidos
	var items =[];
	$('[id^=nuevoitem]').each( function (index) {
		if ($(this).attr('id') != 'nuevoitemrentabilidad'){
			var value = Number($(this).attr('iden'));
	    	items[index] = value;
    	}
	});

	var cantidades = [];
	$('[id^=cantidaditem]').each( function (index) {
		var value = Number($(this).val());
    	cantidades[index] = value;
	});

	// asignamos esos Arrays a dos hiddens del formulario principal
	$('#otrosgastositems').data('iden', []);
	$('#otrosgastositems').data('iden').push(items);
	$('#otrosgastositems').data('cantidad', []);
	$('#otrosgastositems').data('cantidad').push(cantidades);

	console.log($('#otrosgastositems').data('iden')[0]);
	console.log($('#otrosgastositems').data('cantidad')[0]);

	insertarOtrosGastos();


});

// cgutierrez - guardar los items fungibles para imputarlos a la matrícula
	function insertarFungibles(){

		if ( $('#fungibleitems').data('items') == undefined && $('#fungibleitems').data('cantidad') == undefined ) {

			$('#confirmacion').show(500).delay(2000).hide('slow');
			setTimeout(function(){location.reload();},2200);

		} else {

			//if ( $('#fungibleitems').data('items') != undefined ) {

				// Arrays con los ides y las cantidades de los items
				var items = $('#fungibleitems').data('iden')[0];
				var cantidades = $('#fungibleitems').data('cantidad')[0];
				var random = $('#id_temp').val();
				var id_matricula = $('#id_matricula').val();

				// combinamos ambos arrays para obtener uno solo
				var valores = [];
				for (i = 0; i < items.length; i++){
					valores.push([items[i], cantidades[i], id_matricula, random, 0]);
				}

				//alert(valores);

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/insertaitemsrentabilidad.php',
					data: {'valores': valores },
					success: function(data)
					{
						// $('#confirmacion').show(500).delay(2000).hide('slow');
					 //    setTimeout(function(){location.reload();},2200);
					    //alert(data);
					}
				}); ajax.abort();

			//}
		}

	}

	function insertarOtrosGastos(){

		if ( $('#otrosgastositems').data('items') == undefined && $('#otrosgastositems').data('cantidad') == undefined ) {

			$('#confirmacion').show(500).delay(2000).hide('slow');
			setTimeout(function(){location.reload();},2200);

		} else {

			//if ( $('#otrosgastositems').data('items') != undefined ) {

				// Arrays con los ides y las cantidades de los items
				var items = $('#otrosgastositems').data('iden')[0];
				var cantidades = $('#otrosgastositems').data('cantidad')[0];
				var random = $('#id_temp').val();
				var id_matricula = $('#id_matricula').val();

				// combinamos ambos arrays para obtener uno solo
				var valores = [];
				for (i = 0; i < items.length; i++){
					valores.push([items[i], cantidades[i], id_matricula, random, 1]);
				}

				// // combinamos ambos arrays para obtener uno solo
				// var valores = [];
				// for (i = 0; i < items.length; i++){
				// 	valores.push([items[i], cantidades[i]]);
				// }

				$.ajax({
					cache: false,
					type: 'POST',
					url: 'functions/insertaitemsrentabilidad.php',
					data: {'valores': valores},
					success: function(data)
					{
						// $('#confirmacion').show(500).delay(2000).hide('slow');
					 //    setTimeout(function(){location.reload();},2200);
					 //    alert(data);
					}
				}); ajax.abort();

			//}
		}


	}

$(document).on("click", "#abrirotrosgastos", function(event){

	event.preventDefault();

	var btnguardarotrosgastos = '<button id="guardarotrosgastos" type="button" class="btn btn-primary" data-dismiss="modal">Guardar</button><button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>';

	$.ajax({
		cache: false,
		type: 'POST',
		url: 'functions/funciones.php',
		data: 'costeotrosgastos=1',
		success: function(data)
		{
			$('#mostrardatosc').modal('show');
			$('#mostrardatosc .mostrartitulo').html('Coste Otros Gastos');
			// $('#guardarcambios').css('display','inline-block');
			// $('#guardarcambios').attr('id','guardarotrosgastos');
			$('#mostrardatosc .modal-footer').html(btnguardarotrosgastos);
			$('#mostrardatosc .contenido').html(data);
		}
	}); ajax.abort();

});


$(document).on("click", "#btncalculocostes", function(event){
	event.preventDefault();
	var totalcostes = 0;
	totalcostes = Number($('#costeaula').val())+Number($('#costedocente').val())+Number($('#fungibledidac').val())+Number($('#administracion').val())+Number($('#otrosgastos').val());
	$('#totalcostes').val(totalcostes);

});

$(document).on("click", "#btncalculobeneficios", function(event){
	event.preventDefault();

	var totalcostes = 0;
	var totalventas = 0;
	var percent = 100;
	totalbeneficio = Number($('#totalingresos').val())-Number($('#totalcostes').val());
	totalventas = (Number(totalbeneficio)) / Number($('#totalingresos').val()) * 100;
	// alert(totalventas);
	// alert(totalventas);
	// alert(totalventas);
	$('#margenbeneficio').val(totalbeneficio);
	if ( totalventas == -Infinity ) $('#porcentajeventas').val("-100");
	else $('#porcentajeventas').val((totalventas).toFixed(2));
});

$(document).on("click", "#btncalculoalumnos", function(event){
	event.preventDefault();

	var nalumnos = 0;
	var costes = Number($('#totalcostes').val());
	var mat = Number($('#precioventamat').val());
	var benef = Number($('#ventasrequerido').val());

	nalumnos = costes / ( mat*(1-(benef/100)) );
	// alert(nalumnos);
	$('#nalumnosnecesario').val(Math.ceil(nalumnos));

});

$(document).on("click", "#abriradministracion", function(event){
	event.preventDefault();
});

$(document).on("click", "#abrirotrosgastos", function(event){
	event.preventDefault();
});


