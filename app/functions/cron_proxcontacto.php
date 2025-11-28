<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    // envioMailIKEA(83,'1','ikea_comunicacion',$link);

    $mail = new PHPMailer;

    $mail->FromName = 'Gestión ESFOCC';
    // $mail->addAddress('aperojo@eduka-te.com');
    $mail->isHTML(true);

    // $mail->addBCC('aperojo@eduka-te.com');
    $fecha = date('Y-m-d');
    $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));
    $manianaa = formateaFecha($maniana);

    $mail->CharSet = 'UTF-8';
    $titulo = 'Próximos contactos para mañana día '.$manianaa;
    $mail->Subject = $titulo;

    // OSCAR
    $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial, r.observaciones, r.procontacto
    FROM comerciales c, reportescomerciales r
    WHERE c.id = r.id_comercial
    AND procontacto = "'.$maniana.'"
    AND c.id = 3';

    // echo $q1."<br><br>";
    $q1 = mysqli_query($link, $q1);

    while ( $row2 = mysqli_fetch_array($q1) ) {

        // $i++;
        $para = $row2[email];
        $textofinal .= '<br><br>Comercial: '.$row2[nombre] .'<br>Empresa: '.$row2[razonsocial].'<br>Observaciones: '.$row2[observaciones];


    }

    if ( strlen($textofinal) > 5 ) {

        $mail->Body    = 'Próximos contactos para mañana: <br>'.$textofinal;
        $mail->addAddress($para);
        $mail->addBCC('backup-gestion@eduka-te.com');
        if(!$mail->send())  {
            echo "error1";
        } else {
            registrarMailBD($para, $titulo, $bcc, $link);
        }

    }

    $mail->ClearAddresses();
    $para = "";
    $textofinal = "";

        // EFREN
    $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial, r.observaciones, r.procontacto
    FROM comerciales c, reportescomerciales r
    WHERE c.id = r.id_comercial
    AND procontacto = "'.$maniana.'"
    AND c.id = 4';

    // echo $q1."<br><br>";
    $q1 = mysqli_query($link, $q1);

    while ( $row2 = mysqli_fetch_array($q1) ) {

        // $i++;
        $para = $row2[email];
        $textofinal .= '<br><br>Comercial: '.$row2[nombre] .'<br>Empresa: '.$row2[razonsocial].'<br>Observaciones: '.$row2[observaciones];


    }

    if ( strlen($textofinal) > 5 ) {

        $mail->Body    = 'Próximos contactos para mañana: <br>'.$textofinal;
        $mail->addAddress($para);
        $mail->addBCC('backup-gestion@eduka-te.com');
        if(!$mail->send()) {
            echo "error2";
        } else {
            registrarMailBD($para, $titulo, $bcc, $link);
        }
    }


    $mail->ClearAddresses();
    $para = "";
    $textofinal = "";

        // ISABEL
    $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial, r.observaciones, r.procontacto
    FROM comerciales c, reportescomerciales r
    WHERE c.id = r.id_comercial
    AND procontacto = "'.$maniana.'"
    AND c.id = 7';

    // echo $q1."<br><br>";
    $q1 = mysqli_query($link, $q1);

    while ( $row2 = mysqli_fetch_array($q1) ) {

        // $i++;
        $para = $row2[email];
        $textofinal .= '<br><br>Comercial: '.$row2[nombre] .'<br>Empresa: '.$row2[razonsocial].'<br>Observaciones: '.$row2[observaciones];


    }

    if ( strlen($textofinal) > 5 ) {

        $mail->Body    = 'Próximos contactos para mañana: <br>'.$textofinal;
        $mail->addAddress($para);
        $mail->addBCC('backup-gestion@eduka-te.com');
        $mail->addAddress('orodriguez@eduka-te.com');
        if(!$mail->send()) {
            echo "error3";
        } else {
            registrarMailBD($para, $titulo, $bcc, $link);
        }
    }


    $mail->ClearAddresses();
    $para = "";
    $textofinal = "";


            // AMPARO
    $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial, r.observaciones, r.procontacto
    FROM comerciales c, reportescomerciales r
    WHERE c.id = r.id_comercial
    AND procontacto = "'.$maniana.'"
    AND c.id = 12';

    echo $q1."<br><br>";
    $q1 = mysqli_query($link, $q1);

    while ( $row2 = mysqli_fetch_array($q1) ) {

        // $i++;
        $para = $row2[email];
        $textofinal .= '<br><br>Comercial: '.$row2[nombre] .'<br>Empresa: '.$row2[razonsocial].'<br>Observaciones: '.$row2[observaciones];


    }

    if ( strlen($textofinal) > 5 ) {

        $mail->Body    = 'Próximos contactos para mañana: <br>'.$textofinal;
        $mail->addAddress($para);
        $mail->addBCC('backup-gestion@eduka-te.com');
        $mail->addAddress('orodriguez@eduka-te.com');
        if(!$mail->send()) {
            // echo "error5";
            echo $mail->ErrorInfo;
        } else {
            registrarMailBD($para, $titulo, $bcc, $link);
        }
    }


    $mail->ClearAddresses();
    $mail->ClearCCs();
    $para = "";
    $textofinal = "";


            // AROA
    $q1 = 'SELECT DISTINCT c.id, c.nombre, c.email, r.razonsocial, r.observaciones, r.procontacto
    FROM comerciales c, reportescomerciales r
    WHERE c.id = r.id_comercial
    AND procontacto = "'.$maniana.'"
    AND c.id = 39';

    echo $q1."<br><br>";
    $q1 = mysqli_query($link, $q1);

    while ( $row2 = mysqli_fetch_array($q1) ) {

        // $i++;
        $para = $row2[email];
        $textofinal .= '<br><br>Comercial: '.$row2[nombre] .'<br>Empresa: '.$row2[razonsocial].'<br>Observaciones: '.$row2[observaciones];


    }

    if ( strlen($textofinal) > 5 ) {

        $mail->Body    = 'Próximos contactos para mañana: <br>'.$textofinal;
        $mail->addAddress($para);
        $mail->addCC('orodriguez@eduka-te.com');
        $mail->addBCC('backup-gestion@eduka-te.com');
        // $mail->addBCC('aperojo@eduka-te.com');
        if(!$mail->send()) {
            echo "error8";
        } else {
            registrarMailBD($para, $titulo, $bcc, $link);
        }
    }



    echo $textofinal;


?>

