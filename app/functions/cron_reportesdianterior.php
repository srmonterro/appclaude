<html><head><meta charset="UTF-8">
</head></html>
<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    if ( date('N') != 6 && date('N') != 7 ) {

        $q = 'SELECT id, nombre, email
        FROM comerciales c
        WHERE c.id IN (3,7,12)';
        // echo $q;
        $q = mysqli_query($link, $q);

        while ( $row = mysqli_fetch_array($q) ) {

        	$comerciales[] = $row[nombre];

        }
        // $comerciales = array("Efren", "Oscar", "Yanira", "Amparo", "Isabel");

        echo "<pre>"; print_r($comerciales); echo "</pre>";


        if ( date('N') == 1 ) {
            $fecha = 'DATE(r.fecha) = DATE_ADD(CURDATE(), INTERVAL -3 DAY)';
        } else {
            $fecha = 'DATE(r.fecha) = DATE_ADD(CURDATE(), INTERVAL -1 DAY)';
        }

        $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial
    	FROM comerciales c, reportescomerciales r
    	WHERE '.$fecha.'
    	AND c.id = r.id_comercial';
    	    echo $q1;
    	    $q1 = mysqli_query($link, $q1);

    	    while ( $row2 = mysqli_fetch_array($q1) ) {

    	        $comercialesreporte[] = $row2[nombre];

    	    }

    	    echo "<pre>"; print_r($comercialesreporte); echo "</pre>";


    	echo "Comerciales que no han enviado su reporte hoy día ".date('d/m/Y')." :";

    	if ( count($comercialesreporte) == 0 )
    		$comercialesquefaltan = $comerciales;
    	else {
    		$comercialesquefaltan = array_diff($comerciales, $comercialesreporte);
    		$comercialesquefaltan = array_values($comercialesquefaltan);
    	}
    		echo "<pre>";
    		print_r( $comercialesquefaltan );
    		echo "</pre>";



    	$coma = ", ";

    	$mail = new PHPMailer;

    	$comercialesno = "";
    	for ($i=0; $i < count($comercialesquefaltan) ; $i++) {

    		$q = 'SELECT c.nombre, c.email, u.id as id_user
    	    FROM comerciales c, usuarios u
    	    WHERE u.id_comercial = c.id
            AND c.nombre = "'.$comercialesquefaltan[$i].'"';
    	    echo $q;
    	    $q = mysqli_query($link, $q);

    	    while ( $row = mysqli_fetch_array($q) ) {

                $sql = 'UPDATE usuarios SET acceso = 0 WHERE id = "'.$row['id_user'].'" AND id != 246';
                // echo $sql;
                $sql = mysqli_query($link, $sql) or die("error".mysqli_error($link));

    	    	if ($i == count($comercialesquefaltan)-1) $coma = "";
    	        $comercialesno .= $row[nombre].$coma;

    	        // $mail->addBCC($row[email]);

    	    }
    	}

    	echo "<br>".$comercialesno;


    	$mail->From = 'gestion@eduka-te.com';
        $mail->FromName = 'Gestión ESFOCC';
        $mail->addAddress('gestion@eduka-te.com');
        // $mail->addBCC('aperojo@eduka-te.com');
        // $mail->addBCC('icabrera@eduka-te.com');
        // $mail->addBCC('dalvarez@eduka-te.com');
        $mail->addBCC('backup-gestion@eduka-te.com');
        // $mail->addBCC('aalves@eduka-te.com');
        $mail->addBCC('dalvarez@eduka-te.com');
        $para = 'dalvarez@eduka-te.com';
    	$mail->isHTML(true);

        	$mail->Body = 'Buenos días, <br><br>

    				Estos son los comerciales que no enviaron el reporte ayer: '.$comercialesno;


            $mail->CharSet = 'UTF-8';

            $r = array();

            $titulo = $mail->Subject = "Reportes diarios NO enviados ayer";
            // // if ( compruebaEnvioEmail($titulo, $link) != 1 ) {

            if ( strlen($comercialesno) > 0 && ( date('N') != 7 ) ) {

            	// echo "envia!";
                if(!$mail->send()) {
                    $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                    $r[resul]=0;
                    exit;
                } else {
                    registrarMailBD($para, $titulo, $bcc, $link);
                    $r[mensaje]='Email enviado con éxito.';
                    $r[resul]=1;
                }

            }

    }
        // echo $mail->Body;

  ?>