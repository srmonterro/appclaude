<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $gestion = devuelveAnio();

	$id_mat = $_POST[id_mat];
	$id_emp = $_POST[id_emp];
	$cuerpo = $_POST[cuerpoCorreo];
	$tipo_doc = $_POST[tipo_doc];

	$q = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.denominacion, a.incendios, m.fechafin
	FROM grupos_acciones ga, acciones a, matriculas m
	WHERE ga.id = m.id_grupo
	AND m.id_accion = a.id
	AND m.id = '.$id_mat;

    //echo $q.'<br>';
    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

    $row = mysqli_fetch_array($q);

    $fechafin = $row[fechafin];
    $naccion = $row[numeroaccion];
    $ngrupo = $row[ngrupo];
    $denominacion = $row[denominacion];
    $incendios = $row[incendios];
    $tipo = $row[tipo];

	switch ($tipo_doc) {
		case 'observacionesExp':

			$cuerpoCorreo = $cuerpo;
			//$destinatario = 'mchinea@eduka-te.com';
			$destinatario = 'ccoll_formacion@eduka-te.com';
			//$destinatarioCopia = 'abenitez@eduka-te.com';
			//$destinatario = $destinatarioCopia ='cgutierrez@eduka-te.com';
			$remitente = 'gestion@eduka-te.com';
			$remitenteNombre = 'Gestión ESFOCC';
			$titulo = 'DOCUMENTACIÓN '.$naccion.'/'.$ngrupo;

			$qU = 'UPDATE matriculas SET observacionesinspeccion="'.addslashes($cuerpo).'" WHERE id = '.$id_mat;

			//echo $qU;

			mysqli_query($link, $qU) or die('error');

			break;

		default:

			$cuerpoCorreo = '';
			break;
	}


	$mail = new PHPMailer;

	$mail->addAddress($destinatario);
	$mail->SMTPDebug  = 2;
    $mail->From = $remitente;
	$mail->FromName = $remitenteNombre;
    $mail->addReplyTo($remitente);
    //$mail->addBCC($destinatarioCopia);
    $mail->isHTML(true);                                    // Set email format to HTML
    $mail->Body = $cuerpoCorreo;

    $mail->CharSet = 'UTF-8';
    $mail->Subject = $titulo;

    if(!$mail->send()) {
    	//echo "llega-error";
        $r[mensaje]='ERROR: Email no enviado: ' . $mail->ErrorInfo;
        $r[resul]=0;
        exit;
    } else {
    	//echo "llega-bien";
        registrarMailBD($destinatario, $titulo, $destinatarioCopia, $link, $cuerpoCorreo);

        $r[mensaje]='Email enviado con éxito.';
        $r[resul]=1;
    }

	// print_r($r);
	echo json_encode($r);

?>