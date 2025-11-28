
<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    // require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    $gestion = devuelveAnio();

    $idfac = $_POST['idfac'];
    $tabla = $_POST['tabla'];
    $email_envio = $_POST['email'];
    // $email_envio = 'aperojo@eduka-te.com'; // QUITAAAAAAR
    $para = $email_envio;



    $q1 = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, e.email as emailnormal, e.cif, f.*, f.id as idfac, c.email as email_comercial, e.id as idemp, facturar_a, e.agente, e.email_facturas
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, '.$tabla.' f, comerciales c
        WHERE ac.id = m.id_accion
        AND e.id = ma.id_empresa
        AND ga.id = m.id_grupo
        AND m.id = ma.id_matricula
        AND ma.id_empresa = e.id
        AND f.matricula = m.id
        AND f.empresa = e.id
        AND e.comercial = c.id
        AND f.id = '.$idfac;
        // $sql=$q;
    $q1 = mysqli_query($link, $q1);

    $mail = new PHPMailer;

    while ( $row = mysqli_fetch_array($q1) ) {

        $prefijo = $row[prefijo];
        if ( $prefijo == 'R') $rectificativa = ' rectificativa '; else $rectificativa = ' ';
        $numero = $row[numero];
        $numerof = $prefijo.$numero;
        $agente = $row[agente];

        if ( $row[facturar_a] != 0 ) {

            $q4 = 'SELECT e.id as idemp, e.razonsocial as razonsocialfac, e.cif as ciffac, e.agente, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, e.email as emailnormal, c.nombre, c.email as email_comercial
            FROM empresas e, comerciales c
            WHERE e.comercial = c.id
            AND e.id = '.$row[facturar_a];
            // echo $q4;
            $q4 = mysqli_query($link, $q4);
            $r4 = mysqli_fetch_array($q4);

            $empresa = quitaTildesConComas($r4[razonsocialfac]);
            // $nombreFichero = 'facturacion/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
            $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

            if ( $r4[email_facturas] == "" ) $emailfac = $r4[emailnormal];
            else $emailfac = $r4[email_facturas];

            $email_comercial = $r4[email_comercial];
            $agente = $r4[agente];

            $razonsocial = $r4[razonsocialfac];
            $cif = $r4[ciffac];
            $idemp = $r4[idemp];

        } else {

            $empresa = quitaTildesConComas($row[razonsocial]);
            // $nombreFichero = 'facturacion/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
            $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
            $email_comercial = $row[email_comercial];
            $razonsocial = $row[razonsocial];
            $cif = $row[cif];
            $idemp = $row[idemp];

            if ( $row[email_facturas] == "" ) $emailfac = $row[emailnormal];
            else $emailfac = $row[email_facturas];
        }

        $denominacion = $row[denominacion];
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $modalidad = $row[modalidad];


        $cc = "";
        if ( $email_comercial == 'orodriguez@eduka-te.com' || $email_comercial == 'pbrito@eduka-te.com' ) {

            $mail->addCC('irivero@eduka-te.com');
            $mail->addCC('avalle@eduka-te.com');
            $mail->addCC('orodriguez@eduka-te.com');

            // if ( $agente == 'Amparo' )
            //     $mail->addCC('avalle@eduka-te.com');

        } //if ( $email_comercial == 'aalves@eduka-te.com' ) $mail->addCC('mchinea@eduka-te.com');

    }



    if ( $prefijo == 'P' ) {

        $cuerpoEmail = 'Se adjunta la factura correspondiente al curso “'.$denominacion.'” (acción '.$naccion.' grupo '.$ngrupo.' privado). Se ruega confirmación de la recepción del presente email. Muchas gracias.';

    } else if ( $prefijo == 'R') {

        if ( strpos($ngrupo, 'p') ) $privado = ' privado';
        $cuerpoEmail = 'Se adjunta la factura rectificativa correspondiente al curso “'.$denominacion.'” (acción '.$naccion.' grupo '.$ngrupo.$privado.'). Se ruega confirmación de la recepción del presente email. Muchas gracias.';
        $rectificativa = 'Rectificativa';
        // $informeFichero = '../pdf_tripartita/empresa/'.$cif.'-informe.pdf';

    } else {

        $cuerpoEmail = 'Se adjunta la factura correspondiente al curso “'.$denominacion.'” (acción '.$naccion.' grupo '.$ngrupo.'), junto con el informe correspondiente de la Fundación Estatal para la Formación en el Empleo. Se ruega confirmación de la recepción del presente email. Muchas gracias.';
        $informeFichero = '../pdf_tripartita'.$gestion.'/empresa/'.$cif.'-informe.pdf';


    }



    $titulo = 'Factura'.$rectificativa.'acción formativa '.$naccion.'/'.$ngrupo.' - '.$razonsocial.' - '.$modalidad;

    // $para = $emailalumno;


    if ( $email_envio != "" )  {

        if ( strpos($email_envio, ',') === FALSE )  $mail->addAddress($email_envio);
        else {

            $emails = explode(",", $email_envio);

            for ($i=0; $i < count($emails); $i++) {
                $mail->addAddress($emails[$i]);
            }
        }

        if ( $para != "" ) {
            $q = 'UPDATE empresas SET email_facturas = "'.$para.'" WHERE id = '.$idemp;
            mysqli_query($link, $q) or die ('error');
        }


    } else {

        $titulo = '(NO LLEGA A CLIENTE) Factura '.$rectificativa.' acción formativa '.$naccion.'/'.$ngrupo.' - '.$razonsocial.' - '.$modalidad;
        $mail->addAddress('cmunoz@eduka-te.com'); // SUSTITUIR POR VICENTE.
        $para = 'sin cliente';
    }


    $mail->From = 'cmunoz@eduka-te.com';
    $mail->FromName = 'Gestión ESFOCC';

    $mail->addReplyTo('cmunoz@eduka-te.com');
    $mail->addCC('cmunoz@eduka-te.com');
    // $mail->addCC('cmunoz@eduka-te.com');
    // $mail->addCC($cc);
    if ( $email_comercial != 'aalves@eduka-te.com') $mail->addCC($email_comercial);
    $mail->addBCC('ccoll_formacion@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    // $mail->addBCC('irivero@eduka-te.com');
    // $mail->addBCC('aperojo@eduka-te.com');
    // $mail->addBCC('dalvarez@eduka-te.com');
    // $mail->addBCC('aperojo@eduka-te.com');
    $mail->addAttachment($nombreFicheroMail);                   // Add attachments
    $mail->addAttachment($informeFichero);                   // Add attachments
    $mail->isHTML(true);                                    // Set email format to HTML




    $mail->Body    = 'Buenos días, <br><br>

                '.$cuerpoEmail.'<br><br>

                Un saludo. <br><br>';


        $mail->CharSet = 'UTF-8';

        $r = array();

        $mail->Subject = $numerof.' '.$titulo;
        if ( compruebaEnvioEmail($titulo, $link) != 1 ) {


            if(!$mail->send()) {
                $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                $r[resul]=0;
                exit;
            } else {
                registrarMailBD($para, $titulo, $cc.','.$email_comercial, $link);
                $r[mensaje]='Email enviado con éxito.';
                $r[resul]=1;
            }

        } else {

            if(!$mail->send()) {
                $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                $r[resul]=0;
                exit;
            } else {
                registrarMailBD($para, $titulo, $cc.','.$email_comercial, $link);
                $r[mensaje]='Email enviado con éxito.';
                $r[resul]=1;
            }
        }

        echo json_encode($r);


?>