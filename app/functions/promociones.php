<?
	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    require_once($baseurl. '/plugins/PHPMailer/PHPMailerAutoload.php'); 
    include ('./funciones.php');

    $link = connect($_SESSION['anio']);

    if( $_POST['accion'] == "registrarinv") {

    	registrarUsuario($_POST['nombre'], $_POST['apellido'], $_POST['apellido2'], $_POST['codigo_inv'], $_POST['promocion'], $link);
    }


    function registrarUsuario($nombre, $apellido, $apellido2, $codigo_inv, $promocion, $link){
    
    	$q = 'SELECT codigo_inv FROM promociones 
    		WHERE nombre LIKE "'.$nombre.'"
    		AND apellido LIKE "'.$apellido.'"
    		AND apellido2 LIKE "'.$apellido2.'"
    		AND codigo_inv LIKE "'.$codigo_inv.'"
    		AND promocion LIKE "'.$promocion.'"';

    	$q = mysqli_query($link, $q) or die("error numcuenta:" .mysqli_error($link));

    	if ( mysqli_num_rows($q) > 0 ) {
		    
		    echo 'duplicado';

		} else {

			$q = 'INSERT INTO promociones (nombre, apellido, apellido2, codigo_inv, promocion)
		    	VALUES ("'.$nombre.'", "'.$apellido.'", "'.$apellido2.'", "'.$codigo_inv.'", "'.$promocion.'" ) ';

		    $resul = mysqli_query($link, $q) or die('error');

		    echo 'insertado';
			
		}

    }

?>