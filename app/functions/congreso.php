<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    require_once($baseurl. '/plugins/PHPMailer/PHPMailerAutoload.php'); 
    include ('./funciones.php');

    $link = connectCongreso();
        
    $registro = $_POST['registro'];
    $email = $_POST['email'];
    $nombre = $_POST['nombreApellidos'];
    $tipoEntrada = $_POST['tipoEntrada'];

    $fotoCodigoAttr = htmlentities($baseurl. '/img/img_codigo.png');
    $fotoLogoAttr = htmlentities($baseurl. '/img/logo_congreso_color.png');
    $fotoPDFAttr = htmlentities($baseurl. '/img/img_descargarpdf.png');

    $fotoCodigo = htmlentities('http://gestion.esfocc.com/app/img/img_codigo.png');
    $fotoLogo = htmlentities('http://gestion.esfocc.com/app/img/logo_congreso_color.png');
    $fotoPDF = htmlentities('http://gestion.esfocc.com/app/img/img_descargarpdf.png');

    //FECHA TOPE PARA LA APLICACIÓN DE LOS DESCUENTOS EN LAS ENTRADAS
    $fechaTope = strtotime('15-08-2016 00:00:00');

    if(isset($_POST['accion']) && $_POST['accion']=="confirmar"){
        
        $sql = 'UPDATE wp_cf7dbplugin_submits
                 SET estado=1
                 WHERE submit_time='.$registro.'';    

        mysqli_query($link, $sql) or die('error');
        
        $fechaRegistro = strtotime(date('d-m-Y', $registro));
        //$fechaRegistro = date('16/08/2016');

        if ( $tipoEntrada == 'Estudiante' || $tipoEntrada == 'Desempleado' ) {
            $codigo = 'ESTUDES15';
            $descuento = '5 €';
        } else {
            $codigo = 'PROF30';
            $descuento = '10 €';
        }
        
        if ($fechaRegistro <= $fechaTope)
        {
            $aplicarDescuento = '<p><strong>Por haberse inscrito antes del 15 de Agosto tiene disponible un código de descuento de '.$descuento.'. Para utilizarlo introduzca el código '.$codigo.' antes de realizar el pago, como se muestra en la imagen a continuación:</strong></p>';

            $aplicarDescuento .= '<p><img style="width: 600px" src="'.$fotoCodigo.'"></p>';
    
            
        }else{
            $aplicarDescuento = '';
        }
        
        $cuerpoCorreo = '<img src="'.$fotoLogo.'">';

        $cuerpoCorreo .= '<p>Estimado/a ' . $nombre .',</p>';

        $cuerpoCorreo .= '<p>Su preinscripción al II Congreso de Recursos de Canarias ha sido confirmada.</p>';

        $cuerpoCorreo .= '<p>Para completar el registro debe cumplimentar el formulario en la página web que le proporcionamos a continuación y realizar el pago:</p>';

        $cuerpoCorreo .= '<p><a href="http://www.ticketea.com/entradas-congreso-ii-congreso-de-recursos-humanos-de-canarias/">Click aquí para completar la inscripción</a></p>';

        $cuerpoCorreo .= '<br>
        <p style="font-size: 0.8em"><strong>El pago de la entrada deberá realizarse en un plazo máximo de 48horas a partir de la recepción de este correo.</p>
        <br>
        <p style="font-size: 0.8em"><strong>IMPORTANTE: <br>CAMBIO DE LUGAR para la celebración del II Congreso RRHH Canarias. Se ha cerrado de manera definitiva un acuerdo con INFECAR (Institución Ferial de Canarias) también ubicado en Las Palmas de Gran Canaria, para la celebración del congreso, manteniéndose la misma fecha, 20-sep.</strong></p> 
        <p style="font-size: 0.8em"><strong>Debido a las facilidades y comodidades que nos ofrece INFECAR para la organización del evento, tanto a nivel organizativo como logístico, se ha considerado la mejor opción para celebrar nuestro congreso. Recordar que en la web congresorrhhcanarias.com dispone de toda la información actualizada del congreso; programa, ponentes, horarios, etc...</strong></p>
        <br>';

        $cuerpoCorreo .= '<p>Una vez se verifique el pago le llegará un email con un enlace para descargar la acreditación en PDF (ver imagen).                             </p>';

        $cuerpoCorreo .= '<p><img style="width: 600px" src="'.$fotoPDF.'" ></p>';

        $cuerpoCorreo .= '<p><strong>Es necesario que imprima dicha acreditación para poder acceder al congreso.</strong></p>';

        //$cuerpoCorreo .= $aplicarDescuento;
            
        $cuerpoCorreo .= '<p>Para cualquier duda o comentario puede escribirnos a esta <a href="mailto:info@congresorrhhcanarias.com">dirección de correo</a>.</p>';

        $cuerpoCorreo .= '<br>Un saludo.</p><br>-';
        
        $cuerpoCorreo .= '<p>II Congreso de Recursos Humanos de Canarias</p>';
        
        $cuerpoCorreo .= '<p><a href="http://facebook.com/esfocc">Facebook</a> · <a href="http://twitter.com/esfocc">Twitter</a> · <a href="https://es.linkedin.com/pub/esfocc-escuela-superior-de-formaci%C3%B3n/58/7bb/918">Linkedin</a></p>';

        //$cuerpoCorreo .= '<p>Fecha Registro: '.$fechaRegistro.'</p>';
        //$cuerpoCorreo .= '<p>Fecha Tope: '.$fechaTope.'</p>';
        
        // $email = 'cgutierrez@eduka-te.com';
        // $email = 'aperojo@eduka-te.com';
        
        $mail = new PHPMailer();
        $mail->FromName = 'II Congreso RRHH Canarias';
        $mail->addReplyTo('info@congresorrhhcanarias.com');
        $mail->addAddress($email);
        $mail->addBCC('aperojo@eduka-te.com');
        $mail->addBCC('cgutierrez@eduka-te.com');
        $mail->addBCC('aalves@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);                                      
        $mail->Subject = 'II Congreso RRHH Canarias - Preinscripción confirmada';
        $mail->Body = $cuerpoCorreo;
        $mail->AddAttachment($fotoPDFAttr);
        $mail->AddAttachment($fotoCodigoAttr);
        
        if (!$mail->send()) {
            echo 'ERROR : Email no enviado.';
        } else {
            echo 'enviado';
        }
        
    }

    if(isset($_POST['accion']) && $_POST['accion']=="rechazar"){
        
        $sql = 'UPDATE wp_cf7dbplugin_submits
                 SET estado=2
                 WHERE submit_time='.$registro.'';    

        mysqli_query($link, $sql) or die('error');
        
        $fechaRegistro = date('d/m/Y', $registro);
        //$fechaRegistro = date('16/08/2016');      
        
        $cuerpoCorreo = '<img src="'.$fotoLogo.'">';
        
        $cuerpoCorreo .= '<p>Estimado/a ' . $nombre .',</p>';

        $cuerpoCorreo .= '<p>Lamentamos comunicarle que por razones organizativas no podemos confirmar su inscripción al II Congreso de Recursos Humanos de Canarias.</p>';

        $cuerpoCorreo .= '<p>Le agradecemos el interés mostrado y le instamos a seguir el desarrollo del congreso a través de las redes sociales.</p>';

        $cuerpoCorreo .= '<p>Esperamos poder contar con su asistencia en la próxima edición.</p>';

        $cuerpoCorreo .= '<p>Un saludo.</p><br>-';
        
        $cuerpoCorreo .= '<p>II Congreso de Recursos Humanos de Canarias</p>';
        
        $cuerpoCorreo .= '<p><a href="http://facebook.com/esfocc">Facebook</a> · <a href="http://twitter.com/esfocc">Twitter</a> · <a href="https://es.linkedin.com/pub/esfocc-escuela-superior-de-formaci%C3%B3n/58/7bb/918">Linkedin</a></p>';
        
        // $email = 'cgutierrez@eduka-te.com';
        // $email = 'aperojo@eduka-te.com';
        
        $mail = new PHPMailer();
        $mail->FromName = 'II Congreso RRHH Canarias';
        $mail->addReplyTo('info@congresorrhhcanarias.com');
        $mail->addAddress($email);
        $mail->addBCC('aperojo@eduka-te.com');
        $mail->addBCC('cgutierrez@eduka-te.com');
        $mail->addBCC('aalves@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);                                      
        $mail->Subject = 'II Congreso RRHH Canarias - Preinscripción rechazada';
        $mail->Body = $cuerpoCorreo;
        
        if (!$mail->send()) {
            echo 'ERROR : Email no enviado.';
        } else {
            echo 'enviado';
        }
        
    }

?>