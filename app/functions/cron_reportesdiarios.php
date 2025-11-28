<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

// $q = 'SELECT CAST(COUNT(ma.id_alumno) as char)
// 			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
// 			WHERE ma.id_alumno = a.id
// 			AND m.id = ma.id_matricula
// 			AND m.id_accion = ac.id
// 			AND modalidad IN("A Distancia")
// 			AND m.estado NOT IN ("Anulada")';
// 		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

// 		    // echo mysqli_num_rows($q);
// 		    $row = mysqli_fetch_assoc($q);
// 		    print_r($row);

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



     $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial
	FROM comerciales c, reportescomerciales r
	WHERE DATE(r.fecha) = CURDATE()
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

	for ($i=0; $i < count($comercialesquefaltan) ; $i++) {

		$q = 'SELECT email
	    FROM comerciales c
	    WHERE c.nombre = "'.$comercialesquefaltan[$i].'"';
	    echo $q;
	    $q = mysqli_query($link, $q);

	    while ( $row = mysqli_fetch_array($q) ) {

	    	if ($i == count($comercialesquefaltan)-1) $coma = "";
	        $bcc .= $row[email].$coma;

	        $mail->addBCC($row[email]);

	    }
	}

	echo "<br>".$bcc;


	$mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión ESFOCC';
    $mail->addAddress('gestion-esfocc@eduka-te.com');
    // $mail->addBCC('aperojo@eduka-te.com');
    // $mail->addBCC('icabrera@eduka-te.com');
    $mail->addBCC('dalvarez@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
	$mail->isHTML(true);

    	$mail->Body = 'Buenas tardes, <br><br>

                No has rellenado tu reporte comercial diario. Puedes hacerlo <a href="http://gestion.esfocc.com/app/index.php?reportecomercial">aquí</a>.<br><br>

                Un saludo.';


        $mail->CharSet = 'UTF-8';

        $r = array();

        $titulo = $mail->Subject = "Reporte diario no enviado";
        // if ( compruebaEnvioEmail($titulo, $link) != 1 ) {
        // echo "<br>".$comercialesquefaltan;


        if ( count($comercialesquefaltan) > 0 && ( date('N') != 6 && date('N') != 7 ) ) {
        	// echo "envia";
        	// print_r($comercialesquefaltan);
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




  ?>