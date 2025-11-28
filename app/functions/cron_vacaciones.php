<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
	include_once('./funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

if ( date('N') != 7 ) {

    if ( date('N') == 5 ) {
    	$maniana = strtotime('+3 days', strtotime(date('Y-m-d')));
    	$quedia = 'El Lunes ';
    } else {
    	$maniana = strtotime('+1days', strtotime(date('Y-m-d')));
    	$quedia = 'Mañana ';
    }

    $maniana = date('Y-m-d', $maniana);


	$destinatarios = array();

	$consulta = "SELECT email FROM nominas_usuarios WHERE activo = 1 AND email is not null AND email != '' AND tipo = 'Personal'";

	$resultado_consulta = mysqli_query($link, $consulta) or die("error select: ".mysqli_error($link));

	echo $consulta;

	while ($registro = mysqli_fetch_assoc($resultado_consulta)) {
		$destinatarios[] = $registro['email'];
	}
	array_push($destinatarios, 'backup-gestion@eduka-te.com');

	echo arrayText($destinatarios);


    // $destinatarios = array(
    // 'ccoll@eduka-te.com',
    // 'aperojo@eduka-te.com');


    // SALIDA
    $t = iniciaTelegram();


    $q = 'SELECT *
	FROM dias_vacaciones v, nominas_usuarios n
	WHERE v.id_usuario = n.id
	AND v.dia_salida = "'.$maniana.'"
	AND n.activo = 1';
	// echo $q;
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$i = 0;
	while ( $row = mysqli_fetch_assoc($q) ) {

		$coma = '- ';

		$nombres .= $coma.$row[nombre].' ('.$row[dias].' día/s)<br>';
		$nombrestele .= $coma.$row[nombre].' ('.$row[dias].' día/s)'."\n";
		$i++;

	}


	// LLEGADA

	$q = 'SELECT *
	FROM dias_vacaciones v, nominas_usuarios n
	WHERE v.id_usuario = n.id
	AND v.dia_entrada = "'.$maniana.'"
	AND n.activo = 1';
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$i = 0;
	while ( $row2 = mysqli_fetch_assoc($q) ) {

		$coma = '- ';

		$nombres2 .= $coma.$row2[nombre]."<br>";
		$nombres2tele .= $coma.$row2[nombre]."\n";
		$i++;

	}


	$anio_ant = date('Y') - 1;
	$link = connectAnio($anio_ant);

	$q = 'SELECT *
	FROM dias_vacaciones v, nominas_usuarios n
	WHERE v.id_usuario = n.id
	AND v.dia_salida = "'.$maniana.'"
	AND n.activo = 1';
	// echo $q;
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$i = 0;
	while ( $row = mysqli_fetch_assoc($q) ) {

		$coma = '- ';

		$nombres .= $coma.$row[nombre].' ('.$row[dias].' día/s)<br>';
		$nombrestele .= $coma.$row[nombre].' ('.$row[dias].' día/s)'."\n";
		$i++;

	}


	$q = 'SELECT *
	FROM dias_vacaciones v, nominas_usuarios n
	WHERE v.id_usuario = n.id
	AND v.dia_entrada = "'.$maniana.'"
	AND n.activo = 1';
	$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

	$i = 0;
	while ( $row2 = mysqli_fetch_assoc($q) ) {

		$coma = '- ';

		$nombres2 .= $coma.$row2[nombre]."<br>";
		$nombres2tele .= $coma.$row2[nombre]."\n";
		$i++;

	}



	if ( strlen($nombres) > 1 ) {

		$mail = new PHPMailer();
	    $mail->FromName = 'Gestión ESFOCC';
	    $para = 'gestion@eduka-te.com';
	    // $mail->addAddress('aperojo@eduka-te.com');
	    anadeMails($destinatarios,$mail);
	    // $mail->addBCC('backup-gestion@eduka-te.com');
	    $mail->CharSet = 'UTF-8';
	    $mail->isHTML(true);
	    // $mail->addAttachment($informe);

	    $titulo = 'Salida Vacaciones '.formateaFecha($maniana);
	    $mail->Subject = $titulo;
	    $mail->Body = "Hola, <br><br>".$quedia." sale de vacaciones: <br>".$nombres."<br><br>Saludos.";
	    $tele = "Hola, \n\n".$quedia." sale de vacaciones: \n".$nombrestele."\n\nSaludos.";


	    // print_r($mail);
	    if ( !$mail->send() ) {
	    	echo "error";
	    	echo $mail->errorInfo;
	    }
	    else {
	    	echo "enviado";

	    	enviaTelegram($t, $tele, 'todos');
	    }


	} else {
		echo "nadie";
	}



	if ( strlen($nombres2) > 1 ) {

		$mail = new PHPMailer();
	    $mail->FromName = 'Gestión ESFOCC';
	    $para = 'gestion@eduka-te.com';
	    anadeMails($destinatarios,$mail);
	    // $mail->addAddress('aperojo@eduka-te.com');
	    // $mail->addBCC('backup-gestion@eduka-te.com');
	    $mail->CharSet = 'UTF-8';
	    $mail->isHTML(true);
	    // $mail->addAttachment($informe);

	    $titulo = 'Entrada Vacaciones '.formateaFecha($maniana);
	    $mail->Subject = $titulo;
	    $mail->Body = "Hola, <br><br>".$quedia." vuelve de vacaciones: <br>".$nombres2."<br><br>Saludos.";
	    $tele = "Hola, \n\n".$quedia." vuelve de vacaciones: \n".$nombres2tele."\n\nSaludos.";

	    // print_r($mail);
	    if ( !$mail->send() ) {
	    	echo "error";
	    	echo $mail->errorInfo;
	    }
	    else {
	    	echo "enviado";

	    	enviaTelegram($t, $tele, 'todos');
	    }


	} else {
		echo "nadie";
	}

}

?>