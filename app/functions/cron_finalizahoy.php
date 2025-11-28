<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
	include_once('./funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

	// $link = connect2015();

	$fecha = date('Y-m-d');
	// $semanasig = date('Y-m-d', strtotime('+6 day', strtotime($fecha)));

	$q = 'SELECT DISTINCT m.id, ac.numeroaccion, ga.ngrupo, ac.modalidad, ac.denominacion, m.estado, m.fechaini, m.fechafin
    FROM acciones ac, matriculas m, grupos_acciones ga
    WHERE m.id_grupo = ga.id
    AND m.fechafin = "'.$fecha.'"
    AND m.id_accion = ac.id
    AND m.estado <> "Anulada"
    AND ac.modalidad IN ("Presencial","Mixta")
    ORDER BY modalidad';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error ".mysqli_error($link));


    $cuerpo = '<table id="tablamatriculas" class="table table-striped">
				<thead>
					<tr> <!-- AQUI UN SWITCH? !-->
						<th style="display:none;">ID</th>
						<th>Acción</th>
						<th>Denominación</th>
                        <th>Modalidad</th>
						<th>Estado</th>
						<th>Inicio</th>
						<th>Fin</th>
					</tr>
				</thead>
				<tbody>';

    while ( $row = mysqli_fetch_array($q) ) {

        // $cuenta = $row[cuenta];
        // print_r($row);
        	$cuerpo .= '<tr><td>';
            $cuerpo .= ($row[numeroaccion].'/'.$row[ngrupo]);
    		$cuerpo .=  "</td>";
    		$cuerpo .=  '<td style="width:35%">';
    		$cuerpo .=  ($row[denominacion]);
    		$cuerpo .=  "</td>";
            $cuerpo .=  "<td>". $row[modalidad] ."</td>";
    		$cuerpo .=  "<td>";
    		$cuerpo .= ($row[estado]);
    		$cuerpo .=  "</td>";
    		$cuerpo .=  "<td>";
    		$cuerpo .= (date("d/m/Y", strtotime($row[fechaini])));
    		$cuerpo .=  "</td>";
    		$cuerpo .=  '<td>';
    		$cuerpo .= (date("d/m/Y", strtotime($row[fechafin])));
            $cuerpo .=  "</td></tr>";
            $algo = 1;

    }


    $cuerpo .= '</tbody></table>';

    $mail = new PHPMailer;
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión ESFOCC';

    // if ( $row[modalidad] == 'Teleformación' ) {
    //     $para = 'abenitez@eduka-te.com';
    //     $mail->addAddress($para);
    // } else {
    //     $para = 'mchinea@eduka-te.com';
    //     $mail->addAddress($para);
    // }

    // $mail->addAddress('aperojo@eduka-te.com');
    $mail->addAddress('jramos@eduka-te.com');
    $mail->addCC('ccoll_formacion@eduka-te.com');
    $mail->addCC('ytejera@eduka-te.com');
    //$mail->addCC('mchinea@eduka-te.com');
    //$mail->addCC('ysuarez@eduka-te.com');
    $mail->addCC('ctosco@eduka-te.com');
    $mail->addCC('asantana@eduka-te.com');
    $mail->addBCC('icabrera@eduka-te.com');

    $mail->addBCC('aperojo@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    // $mail->addBCC('dalvarez@eduka-te.com');
    // $mail->addAttachment($nombreFicheroMail);                   // Add attachments
    // $mail->addAttachment($informeFichero);                   // Add attachments
    $mail->isHTML(true);                                    // Set email format to HTML




    $mail->Body = $cuerpo;


        $mail->CharSet = 'UTF-8';

        $r = array();

        $titulo = 'Curso/s PRESENCIAL/MIXTO que finalizan HOY: '.formateaFecha($fecha);
        $mail->Subject = $titulo;


        if ( $algo == 1 ) {
            // if ( compruebaEnvioEmail($titulo, $link) != 1 ) {

                if(!$mail->send()) {
                    $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                    $r[resul]=0;
                    exit;
                } else {
                    registrarMailBD($para, $titulo, $cc, $link);
                    $r[mensaje]='Email enviado con éxito.';
                    $r[resul]=1;
                }
            // }
        }


?>