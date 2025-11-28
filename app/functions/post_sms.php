<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');


foreach ($_POST as $clave => $valor)
	$valores[$clave] = $valor;	


	$msg = urlencode(utf8_decode(quitaTildesSMS($valores[msg])));
	$sa = $valores[sa];
	$da = "(34)".$valores[da];
	$us = "icabrera@eduka-te.com";
	$pa = "cywach67";
	// PRUEBAS
	// $us = "aperojo@eduka-te.com";
	// $pa = "phiswi50";
	$PARAM = "U=$us&P=$pa&D=$da&M=$msg&S=$sa";
	// echo $PARAM."<br>";
	$resultado = send_params($PARAM);
	// echo $resultado."<BR>";
	$resul = array();

	if ( strpos($resultado, 'err_') === false ) { 
		// BIEN
		// echo "bien";
		$resul['resul'] = 'ok';
		$resul['resultado'] = 'SMS enviado correctamente.';
		// $display2 = 'none';

		$q = 'INSERT INTO registro_sms (`fecha`, `de`, `para`, `mensaje`, `resultado`, `respuesta`, `usuario`)
		VALUES ("'.date("Y-m-d H:i").'","'. $sa .'","'. $da .'","'. $valores[msg] .'","'. $resul['resultado'] .'","'. $resultado .'","'. $_SESSION[user] .'")';
		mysqli_query($link, $q);

	} else {
		// MAL

		// $daerror = $valores[da];
		// $msgerror = $msg;

		$resul['resul'] = 'error';
		if ( strpos($resultado, 'err_1094') !== false )
			$resul['resultado'] = 'ERROR: No hay saldo suficiente.';
		if ( strpos($resultado, 'err_1092') !== false )
			$resul['resultado'] = 'ERROR: El mensaje no puede estar vacío.';
		else if ( strpos($resultado, 'err_') !== false ) {
			$resul['resultado'] = 'ERROR: Mensaje no enviado.';
		}

		$q = 'INSERT INTO registro_sms (`fecha`, `de`, `para`, `mensaje`, `resultado`, `respuesta`, `usuario`)
		VALUES ("'.date("Y-m-d H:i").'","'. $sa .'","'. $da .'","'. $valores[msg] .'","'. $resul['resultado'] .'","'. $resultado .'","'. $_SESSION[user] .'")';
		mysqli_query($link, $q);

	}

	echo json_encode($resul);



?>

