<?

include ('funciones.php');
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

$q = 'SELECT a.numeroaccion, ga.ngrupo, a.denominacion, m.fechaini, m.fechafin, m.estado, m.id as id_mat
FROM matriculas m, acciones a, grupos_acciones ga
WHERE m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.solicitud LIKE "IK%"';
$q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

$gestion = devuelveAnio();


while ( $row = mysqli_fetch_assoc($q) ) {

	$estado = $row[estado];
	$naccion = $row[numeroaccion];
	$ngrupo = $row[ngrupo];
	$id_mat = $row[id_mat];

	if ( date('Y-m-d') > $row[fechafin] ) {

		$fecha_fin = new DateTime($row[fechafin]);
		$fecha_act = new DateTime(date('Y-m-d'));


		if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' )

			$q2 = 'SELECT DISTINCT e.id, e.razonsocial, e.email_facturas, e.email
			FROM mat_alu_cta_emp ma, empresas e
			WHERE ma.id_empresa = e.id
			AND ma.id_matricula = '.$id_mat;

		else

			$q2 = 'SELECT DISTINCT e.id, e.razonsocial, e.email_facturas, e.email
			FROM temp_empresas ma, empresas e
			WHERE ma.cif = e.cif
			AND ma.id_matricula = '.$id_mat;


		$q2 = mysqli_query($link, $q2) or die("error" . mysqli_error($link));

		$i = 0;
		while ( $r2 = mysqli_fetch_assoc($q2) ) {

			$ruta = dirname(__DIR__).'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';
			$emp = quitaTildesConComas(str_replace(' ', '', $r2[razonsocial]));

			$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

			if ( file_exists($archivo) ) $i++; else array_push($row, $color = 'Falta listas de asistencia');

			$archivo = $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

			if ( file_exists($archivo) ) $i++; else array_push($row, $color = 'Falta fichas de participantes');

			$archivo = $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

			if ( file_exists($archivo) ) $i++; else array_push($row, $color = 'Falta examenes');

			$archivo = $ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

			if ( file_exists($archivo) ) $i++; else array_push($row, $color = 'Falta cuestionarios');


			// echo $i;
			if ( $i != 4 ) {

				$interval = date_diff($fecha_act, $fecha_fin);
				print_r($interval);
				if ( $interval->days == 7 ) {
					// array_push($row, $interval);

				   	$cuerpo .= "<pre>";
				    $cuerpo .= print_r($row, true);
				    $cuerpo .= "</pre>";

				}
			}

		}

	}

}


	$mail = new PHPMailer();
    $mail->FromName = 'Gestión ESFOCC';
    $para = 'ccoll_formacion@eduka-te.com';
    // $para = 'mchinea@eduka-te.com';
    // $para = 'aperojo@eduka-te.com';
    $mail->addAddress($para);
    //$cc = 'abenitez@eduka-te.com';
    //$mail->addAddress($cc);
    //$mail->addCC('abenitez@eduka-te.com');
    // $mail->addAttachment($informe);
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';

    $titulo = $mail->Subject = '[IKEA] Cursos SIN documentación finalizados hace 7 días';
    $mail->Body = $cuerpo;


    if ( strlen($cuerpo) > 20 ) {

	    if (!$mail->send()) {
	        echo "error";
	        print_r($mail);
	    }
	    else {
	        echo "bien";
	    	registrarMailBD($para, $titulo, $cc, $link);
	    }

    }


?>