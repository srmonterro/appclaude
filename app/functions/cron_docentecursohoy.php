<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');


  	$fecha = date('Y-m-d');
	// $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));

    $q = 'SELECT d.email, d.nombre, m.*, a.denominacion, a.modalidad, a.numeroaccion, ga.ngrupo
    FROM matriculas m, docentes d, mat_doc md, acciones a, grupos_acciones ga
    WHERE md.id_matricula = m.id
    AND ga.id = m.id_grupo
    AND md.id_docente = d.id
    AND m.id_accion = a.id
    AND m.estado IN("Comunicada")
    AND a.modalidad IN("Teleformación", "A Distancia")
    AND m.fechaini = "'.$fecha.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    while ( $row = mysqli_fetch_array($q) ) {

        // print_r($row);

        if ( $row[horariomini] !== "" )
        $horario = $row[horariomini].' - '.$row[horariomfin];
        if ( $row[horariomini] !== "" && $row[horariotini] !== "" )
        $horario .= ' | ';
        if ( $row[horariotini] != "" )
        $horario .= $row[horariotini].' - '.$row[horariotfin];

        $mail = new PHPMailer();
        $mail->FromName = 'Gestión ESFOCC';
        $para = $row[email];
        $mail->addAddress($row[email]);
        // $mail->addAddress('mchinea@eduka-te.com');
        // $mail->addAddress('abenitez@eduka-te.com');
        $mail->addBCC('backup-gestion@eduka-te.com');
        $mail->addCC('icabrera@eduka-te.com');
        // $mail->addCC('aperojo@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $titulo = $mail->Subject = $row[nombre].', tu curso '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[denominacion].' empieza hoy '.formateaFecha($fecha);
        $mail->Body = 'Curso: '.$row[denominacion].'<br> Modalidad: '.$row[modalidad]. '<br>Horario: '.$horario.' <br>Fechas: '.formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]);
        // $mail->Body .= "<br>".$row[email];


        if (!$mail->send())
            echo "error";
        else {
            echo "bien";
            registrarMailBD($para, $titulo, $para, $link);
        }

        $mail->ClearAddresses();


    }

?>