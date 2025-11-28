<?

error_reporting(E_ALL);

    header('Content-Type: text/html; charset=UTF-8');
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    include_once($baseurl.'/plugins/pdfparser/vendor/autoload.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $gestion = devuelveAnio();
    $ruta = '../pdf_tripartita'.$gestion.'/inicio/';
    // echo $ruta;
    $fecha = date('Y-m-d');
    // $fecha = '2016-12-27';
    // $maniana = date('Y-m-d');
    $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));

    $q = 'SELECT DISTINCT  m.id, a.numeroaccion, ga.ngrupo
    FROM matriculas m, grupos_acciones ga, acciones a
    WHERE m.id_grupo = ga.id
    AND ga.ngrupo NOT LIKE "%p"
    AND m.estado = "Comunicada"
    AND m.id_accion = a.id
    AND numeroaccion < "5000"
    AND m.fechaini = "'.$maniana.'"';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $cuerpo = '<table id="tablamatriculas" class="table table-striped">
    <thead>
        <tr> <!-- AQUI UN SWITCH? !-->
            <th style="display:none;">ID</th>
            <th style="width:90px; text-align:left ">Acción</th>
            <th>Empresa/s no coincidente/s </th>
        </tr>
    </thead>
    <tbody>';


    if ( mysqli_num_rows($q) > 0 ) {

        while ( $row = mysqli_fetch_array($q) ) {

            // $envio = 0;
            $pdf = $row[numeroaccion].'-'.$row[ngrupo].'ini.pdf';
            echo $row[id];

            $message = '';
            $texts   = array();
            $lines = array();
            $cadena = '';
            $texto = '';

            try {

                $content = '';
                $content = file_get_contents($ruta.$pdf);
                echo "<br>".$ruta.$pdf."<br>";

                if ($content) {
                    $parser = new \Smalot\PdfParser\Parser();
                    $pdf    = $parser->parseContent($content);
                    $pages  = $pdf->getPages();
                    // echo $pages;
                    foreach ($pages as $page) {
                        $texts[] = $page->getText();
                    }
                } else {
                    throw new Exception('Unable to retrieve content. Check if it is really a pdf file.');
                }
            } catch(Exception $e) {
                $message = $e->getMessage();
            }


            echo "<pre>";
            print_r($texts);
            echo "</pre>";


            foreach ($texts as $key => $value) {
                $texto .= $value;
            }

            // echo "<br><br>";
            $posini = 0;
            $posini = strpos($texto, "Razón social");
            if ( $posini !== FALSE ) echo "<br>".$posini.' siii'; else echo "<br>no";

            $pos = 0;
            $posfin = strrpos($texto, "Participantes");
            if ( $posfin !== FALSE ) echo "<br>".$posfin.' siii'; else echo "<br>no";

            $cadena = substr($texto, ($posini+13), ( ($posfin-13)-($posini)) );
            $cadena = nl2br($cadena);
            $lines = explode(PHP_EOL, str_replace(' ', '', $cadena));


            for ($i=0; $i < count($lines); $i++) {
                $lines[$i] = substr($lines[$i], 0, 9);
                $lines[$i] = strtoupper($lines[$i]);
            }


            echo "<br><BR>";
            $lines = array_filter($lines);
            print_r($lines);


            $q2 = 'SELECT DISTINCT cif
            FROM ptemp_mat_emp pt, empresas e
            WHERE pt.id_matricula = '.$row[id].'
            AND pt.id_empresa = e.id';
            $q2 = mysqli_query($link, $q2) or die("error:" .mysqli_error($link));

            // print_r($lines);
            while ( $rowx = mysqli_fetch_array($q2) ) {
                // echo "<br>".$rowx[cif];
                if ( !in_array($rowx[cif], $lines) ) {
                    $cifs .= $rowx[cif]. '  ';
                    $envio = 1;
                    $enviaMail = 1;
                }

            }

            if ($envio == 1) {
                $cuerpo .= "<tr>";
                $cuerpo .= "<td>".$row[numeroaccion].'/'.$row[ngrupo]."</td>";
                $cuerpo .= "<td>".$cifs."</td>";
                $cuerpo .= "</tr>";
                $cifs = "";
            }
            $envio = 0;

            echo ($cifs);

        }

        $cuerpo .= '</tbody></table>';
    }


    $mail = new PHPMailer();
    $mail->FromName = 'Gestión ESFOCC';
    $para = $mail->addAddress('aperojo@eduka-te.com');
    // $mail->addAddress('mchinea@eduka-te.com');
    // $mail->addAddress('abenitez@eduka-te.com');
    // $mail->addAddress('icabrera@eduka-te.com');
    // $mail->addAddress('abenitez@eduka-te.com');
    // $mail->addCC('ytejera@eduka-te.com');
    // $mail->addBCC('backup-gestion@eduka-te.com');
    // $para = 'mchinea@eduka-te.com,abenitez@eduka-te.com,icabrera@eduka-te.com,abenitez@eduka-te.com';
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);

    $titulo = $mail->Subject = 'ATENCIÓN! Empresas no coincidentes con la notificación de INICIO';
    $mail->Body = $cuerpo;

    if ( $enviaMail == 1 ) {
        if (!$mail->send())
            echo "error";
        else {
            echo "bien";
            registrarMailBD($para, $titulo, $para, $link);
        }
    }


    ?>

