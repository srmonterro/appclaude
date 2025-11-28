<?

	$i = 0;
	$j = 0;
	$files = array();

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $gestion = devuelveAnio();

	$id_mat = $_POST[id_mat];
	$id_emp = $_POST[id_emp];
	$email_envio = $_POST[email_envio];


	$q = 'SELECT DISTINCT e.id, e.razonsocial, a.numeroaccion, ga.ngrupo, a.denominacion, a.incendios, ma.tipo, m.fechafin
		    FROM empresas e, mat_alu_cta_emp ma, grupos_acciones ga, acciones a, matriculas m
		    WHERE ma.id_empresa = e.id
		    AND m.id = ma.id_matricula
		    AND ga.id = m.id_grupo
		    AND m.id_accion = a.id
		    AND ma.id_matricula = '.$id_mat.'
		    AND ma.id_empresa = '.$id_emp;
		    // echo $q;
		    $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

		    $row = mysqli_fetch_array($q);

		    $fechafin = $row[fechafin];
		    $naccion = $row[numeroaccion];
		    $ngrupo = $row[ngrupo];
		    $denominacion = $row[denominacion];
		    $incendios = $row[incendios];
		    $tipo = $row[tipo];

		$ruta = dirname(__DIR__).'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';
		$rutabase = $basepath.'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';

	   	$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));

	   	// echo $emp;

	    $archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
		  	array_push($files, $archivo);
		  	$i++;
	    }

	    $archivo = $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
			array_push($files, $archivo);
			$i++;
		}

		$archivo = $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
			array_push($files, $archivo);
			$i++;
		}

		$archivo = $ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
			array_push($files, $archivo);
			$i++;
		}

		$archivo = $ruta . 'facturagastos-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
			array_push($files, $archivo);
			$i++;
		}

		$archivo = $ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		if ( file_exists($archivo) ) {
			array_push($files, $archivo);
			$i++;
		}

		// DIPLOMAS

		// include_once($baseurl.'/documentacion/genera_diploma_zip.php');
		// $archivo = $ruta . "Diplomas".$naccion."-".$ngrupo."_".$emp.".pdf";
		// if ( file_exists($archivo) ) {
		// 	array_push($files, $archivo);
		// 	$i++;
		// }

		// print_r($files);
		// echo $i;
	$r = array();
	if ( $i > 0 ) {
		$emp = str_replace('.', '', $emp);
		$resul = create_zip($files, $ruta.$naccion.'_'.$ngrupo.'-'.$emp.'.zip');
	}

	// echo $resul;
	if ( $resul == 1 ) {

		$zipadjunto = $ruta.$naccion.'_'.$ngrupo.'-'.$emp.'.zip';
		// echo $zipadjunto;

		// echo $resul;
		$mail = new PHPMailer;

    	if ( $email_envio != "" )  {

    		$para = $email_envio;
	        if ( strpos($email_envio, ',') === FALSE )  $mail->addAddress($email_envio);
	        else {

	            $emails = explode(",", $email_envio);

	            for ($i=0; $i < count($emails); $i++)
	                $mail->addAddress($emails[$i]);
	        }

    	} else {

    		// echo "aqui";
    		$r[resul]=0;
    		$r[mensaje]='ERROR: Campo email vacío.';
    		echo json_encode($r);

    		return false;
    	}

    	// echo "llega1";
    	$mail->SMTPDebug  = 2;
        $mail->From = 'gestion@eduka-te.com';
    	$mail->FromName = 'Gestión ESFOCC';
    	//$cc = 'mchinea@eduka-te.com';
    	$cc = 'ccoll_formacion@eduka-te.com';
	    //$mail->addReplyTo('mchinea@eduka-te.com');
	    $mail->addReplyTo('ccoll_formacion@eduka-te.com');
	    $mail->addBCC('backup-gestion@eduka-te.com');
	    $mail->addCC($cc);
	    // $mail->addCC('abenitez@eduka-te.com');
	    // $mail->addCC('aperojo@eduka-te.com');
	    // $mail->addBCC('dalvarez@eduka-te.com');
	    // $mail->addAttachment($zipadjunto);                   	// Add attachments
	    // echo "llega2";
	    $mail->isHTML(true);                                    // Set email format to HTML


	    $anio = explode('-', $fechafin);

	    if ( date('Y') != $anio[0] ) $anio = '&anio='.$anio[0]; else $anio = "";

	    $linkdocumentacion = '<a href="http://gestion.esfocc.com/app/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/'.$naccion.'_'.$ngrupo.'-'.$emp.'.zip">Descarga documentación</a>';

	    // if ( $tipo == '' )
	    	$linkdiplomas = '<a href="http://gestion.esfocc.com/app/documentacion/generar_diplomas_pre_empresa.php?id_matricula='.$id_mat.'&id_empresa='.$id_emp.'&mod=p'.$anio.'">Diplomas Frontal</a>';
	    // else
	    	$linkdiplomas .= ' - <a href="http://gestion.esfocc.com/app/documentacion/generar_diplomas_pre_nobonif_empresa.php?id_matricula='.$id_mat.'&id_empresa='.$id_emp.'&mod=p'.$anio.'">Diplomas Frontal (Parte privada, si hubiera)</a>';

	    $linkdiplomasatras = '<a href="http://gestion.esfocc.com/app/documentacion/generar_diploma_pre_bonif_atras.php?id_matricula='.$id_mat.$anio.'">Diplomas Trasera</a>';

	    if ( $incendios == 1 )
	    	$linkcertificados = '<a href="http://gestion.esfocc.com/app/documentacion/certificadoincendiosemp.php?id_matricula='.$id_mat.'&id_empresa='.$id_emp.'">Certificados ICASEL</a>';

    	$cuerpoEmail = ' Adjunto a este correo enviamos el expediente digital de la siguiente formación: '.$naccion.'/'.$ngrupo.': '.$denominacion.'<br><br>Puede descargarse estos documentos desde los siguientes enlaces:<br>'.$linkdocumentacion.'<br>'.$linkdiplomas.'<br>'.$linkdiplomasatras.'<br>'.$linkcertificados.'<br><br><br>Para guardarlo en PDF: con <a href="https://www.google.es/chrome/browser/desktop/index.html" target="_blank">Google Chrome</a>, simplemente cambiar el destino a "Guardar como PDF" en la ventana de impresión.<br>* Es necesario activar la opción de "Gráficos de fondo"';

    	$mail->Body    = 'Buenos días, <br><br>

                '.$cuerpoEmail.'<br><br>

                Un saludo.<br>
            -------------- <br>
            <img src="http://gestion.esfocc.com/app/documentacion/guias/img/footermailgesti.png"><br>
            <span style="font-size: 10px">Confidencialidad<br>
            Este correo electrónico y, en su caso, cualquier fichero anexo al mismo, contiene información de carácter confidencial exclusivamente dirigida a su destinatario o destinatarios y propiedad de ESFOCC S.L.U. Queda prohibida su divulgación, copia o distribución a terceros sin la previa autorización escrita de ESFOCC S.L, en virtud de la legislación vigente. En el caso de haber recibido este correo electrónico por error, se ruega notificar inmediatamente esta circunstancia mediante reenvío a la dirección electrónica del remitente y la destrucción del mismo.
            <br>Confidentiality<br>
            The information in this e-mail and in any attachments is classified as ESFOCC S.L.U. Confidential and Proprietary Information and solely for the attention and use of the named addressee(s). You are hereby notified that any dissemination, distribution or copy of this communication is prohibited without the prior written consent of ESFOCC S.L.U. and is s strictly prohibited by law. If you have received this communication in error, please, notify the sender by reply e-mail.</span>';


        $mail->CharSet = 'UTF-8';
        $titulo = 'Expediente Digital '.$naccion.'/'.$ngrupo.': '.$denominacion.' - '.$row[razonsocial];
        $mail->Subject = $titulo;

        // echo "llega3";

            if(!$mail->send()) {
            	// echo "llega-error";
                $r[mensaje]='ERROR: Email no enviado: ' . $mail->ErrorInfo;
                $r[resul]=0;
                exit;
            } else {
            	// echo "llega-bien";
                registrarMailBD($para, $titulo, $cc, $link);

                $r[mensaje]='Email enviado con éxito.';
                $r[resul]=1;
            }



	} else {
		$r[resul]=0;
		$r[mensaje]='ERROR: No hay ningún PDF subido u ocurrió algún error.';
	}

	// print_r($r);
	echo json_encode($r);

	?>