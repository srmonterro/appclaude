<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $envia = 0;
  	$fecha = date('Y-m-d');
    // $fecha = '2015-03-27';
	// $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));

    $q = 'SELECT m.id, a.numeroaccion, ga.ngrupo, COUNT(ma.id_alumno) as numalumnos
    FROM matriculas m, mat_alu_cta_emp ma, grupos_acciones ga, acciones a
    WHERE ma.id_matricula = m.id
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.grupo = 1
    AND m.tipo_docente <> "Externo"
    AND a.modalidad IN("Teleformación")
    AND m.estado <> "Anulada"
    AND m.fechaini = "'.$fecha.'"
    GROUP BY m.id';
    echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    while ( $row = mysqli_fetch_array($q) ) {

        echo "<pre>";
        print_r($row);
        echo "</pre>";

        $q1 = 'SELECT DISTINCT count(*) as numguias, titulo
        FROM registro_emails
        WHERE titulo LIKE "Guía del alumno y datos de acceso acción formativa '.$row[numeroaccion].'.'.$row[ngrupo].' - %"
        AND para != "" ';
        echo "<br>".$q1."<br>";
        $q1 = mysqli_query($link, $q1) or die("error:" .mysqli_error($link));

        while ( $row1 = mysqli_fetch_array($q1) ) {

            print_r($row1);

            echo $row1[numguias].'-'.$row1[titulo];

            if ( $row1[numguias] < $row[numalumnos] ) {
                $texto .= "<br>". $row[numeroaccion].'/'.$row[ngrupo]. ": ".$row[numalumnos]." alumnos - ".$row1[numguias]." guías enviadas.<br>";
                $envia = 1;
            }

        }
    }

    $mail = new PHPMailer();
    $mail->FromName = 'Gestión ESFOCC';
    $para = 'icabrera@eduka-te.com';
    $mail->addAddress($para);
    // $mail->addAddress('icabrera@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    // // $mail->addAddress('abenitez@eduka-te.com');
    // $mail->addCC('icabrera@eduka-te.com');
    // $mail->addCC('aperojo@eduka-te.com');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $titulo = $mail->Subject = 'Guías del alumno no enviadas hoy '.formateaFecha($fecha);
    $mail->Body = 'Cursos: <br>'. $texto;
    // $mail->Body .= "<br>".$row[email];


    if ( $envia == 1 ) {
        if (!$mail->send())
            echo "error";
        else {
            echo "bien";
            registrarMailBD($para, $titulo, $para, $link);
        }
    }
    // $mail->ClearAddresses();


?>