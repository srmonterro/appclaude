$(document).ready(function() {

  //   $(document).on("click","#login", function(event) {

  //   	event.preventDefault();
  //   	var user = $('#user').val();
  //   	var pass = $('#pass').val();
		// // alert(user+' '+pass);

  //   	$.ajax({
	 //        cache: false,
	 //        type: 'POST',
	 //        url: 'functions/login.php',
	 //        data: 'user='+user+'&pass='+pass,
	 //        success: function(data)
	 //        {
	 //        	if (data == 'error')
	 //        		alert("Usuario o Contraseña incorrectos.");
	 //        	else if (data == 'vicente')
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?empresas';
	 //        	else if (data == 'esther')
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?docente';
	 //        	else if (data == 'javier' || data == 'jhony')
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?presencial_doc';
	 //        	else if (data == 'oscar')
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?seguimiento-comercial';
	 //        	else if (data == 'documentacion')
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?empresas';
	 //        	else if ( data.indexOf("tutor") != -1 )
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?tutorias';
	 //        	else if ( data.indexOf("comercial") != -1 )
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?seguimiento-comercial';
	 //        	else if ( data.indexOf("manolo") != -1 )
	 //        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?form_control-facturacion';
	 //        	else
	 //        		window.location.reload();
	 //        }
	 //    }); ajax.abort();


  //   });



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
	        		window.location.href = 'http://gestion.eduka-te.com/app/index.php?solicitudikea';
	        }
	    }); ajax.abort();


    });

});