<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
	include_once('./funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once $baseurl.'/plugins/phpexcel/Classes/PHPExcel.php';
	require_once $baseurl.'/plugins/phpexcel/Classes/PHPExcel/IOFactory.php';

    $hoy = date('Y-m-d');

    	$q = 'SELECT DISTINCT CONCAT(a.numeroaccion, "/", ga.ngrupo), a.denominacion, m.estado, m.fechafin
		FROM matriculas m, acciones a, grupos_acciones ga
		WHERE m.id_accion = a.id
		AND ga.id = m.id_grupo
		AND fechafin < "'.$hoy.'"
		AND estado IN ("Comunicada", "Creada")
		AND a.numeroaccion < 7000
		ORDER BY fechafin ASC';
		$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

		while ( $row = mysqli_fetch_assoc($q) ) {

			$mats_vencidas[] = $row;

		}

		$headers1 = array('Acción/Grupo', 'Curso', 'Estado', 'Fecha Fin');
		// arrayTable($headers, $mats_vencidas);


    	$q = 'SELECT DISTINCT f.numero, CONCAT(a.numeroaccion, "/", ga.ngrupo), a.denominacion, e.razonsocial, f.fecha, f.fecha_vencimiento, f.total_factura, f.estado
		FROM facturacion_bonificada f, empresas e, matriculas m, acciones a, grupos_acciones ga
		WHERE f.empresa = e.id
		AND f.matricula = m.id
		AND m.id_accion = a.id
		AND ga.id = m.id_grupo
		AND fecha_vencimiento < "'.$hoy.'"
		AND f.estado <> "Pagada" AND f.estado <> "Rectificativa"
		UNION
		SELECT DISTINCT f.numero, CONCAT(a.numeroaccion, "/", ga.ngrupo), a.denominacion, e.razonsocial, f.fecha, f.fecha_vencimiento, f.total_factura, f.estado
		FROM facturacion_privada f, empresas e, matriculas m, acciones a, grupos_acciones ga
		WHERE f.empresa = e.id
		AND f.matricula = m.id
		AND m.id_accion = a.id
		AND ga.id = m.id_grupo
		AND fecha_vencimiento < "'.$hoy.'"
		AND f.estado <> "Pagada" AND f.estado <> "Rectificada"
		ORDER BY fecha_vencimiento ASC';
		// echo $q;
		$q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

		while ( $row = mysqli_fetch_assoc($q) ) {

			$fras_vencidas[] = $row;

		}

		$headers2 = array('Nº Factura', 'Acción/Grupo', 'Curso', 'Empresa', 'Fecha', 'Fecha Vcto', 'Importe', 'Estado');
		// arrayTable($headers, $fras_vencidas);



		$mail = new PHPMailer();
	    $mail->FromName = 'Gestión ESFOCC';
	    $para = 'gestion@eduka-te.com';
	    $mail->addCC('aperojo@eduka-te.com');
	    $mail->addCC('icabrera@eduka-te.com');
	    $mail->addAddress('dalvarez@eduka-te.com');
	    // anadeMails($destinatarios,$mail);
	    // $mail->addBCC('backup-gestion@eduka-te.com');
	    $mail->CharSet = 'UTF-8';
	    $mail->isHTML(true);
	    // $mail->addAttachment($informe);

	    $titulo = 'Matrículas / Facturas vencidas y pendientes a día '.formateaFecha($hoy);
	    $mail->Subject = $titulo;
	    $mail->Body = arrayTable($headers1, $mats_vencidas, true)."<br><br><br>".arrayTable($headers2, $fras_vencidas, true);
	    // $tele = "Hola, \n\n".$quedia." sale de vacaciones: \n".$nombrestele."\n\nSaludos.";


	    // Put the html into a temporary file
	    // $html = arrayTable($headers1, $mats_vencidas, true).arrayTable($headers2, $fras_vencidas, true);
	    $tmpfile = 'tmp1.html';
	    $html = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>'.arrayTable($headers1, $mats_vencidas, true).'</html>';
	    file_put_contents($tmpfile, $html);

	    $tmpfile2 = 'tmp2.html';
	    $html2 = '<!DOCTYPE html><html><head><meta charset="UTF-8"></head>'.arrayTable($headers2, $fras_vencidas, true).'</html>';
	    file_put_contents($tmpfile2, $html2);

	    // Read the contents of the file into PHPExcel Reader class
	    $reader = new PHPExcel_Reader_HTML;
	    $content = $reader->load($tmpfile);

	    // Pass to writer and output as needed
	    $objWriter = PHPExcel_IOFactory::createWriter($content, 'Excel2007');
	    $objWriter->save('excelfile.xlsx');

	    // Read the contents of the file into PHPExcel Reader class
	    // $reader = new PHPExcel_Reader_HTML;
	    $content2 = $reader->load($tmpfile2);

	    // Pass to writer and output as needed
	    $objWriter = PHPExcel_IOFactory::createWriter($content2, 'Excel2007');
	    $objWriter->save('excelfile2.xlsx');

	    $mail->addAttachment('excelfile.xlsx');
	    $mail->addAttachment('excelfile2.xlsx');
	    // $mail->addAttachment($informe);

	    // Delete temporary file
	    unlink($tmpfile);
	    unlink($tmpfile2);


	    if ( !$mail->send() ) {
	    	echo "error";
	    	echo $mail->errorInfo;
	    }
	    else {
	    	echo "enviado";
	    	// enviaTelegram($t, $tele, 'todos');
	    }




?>