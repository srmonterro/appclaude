<?

	$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    // $anio = 2015;
    // include_once($baseurl.'/functions/connect.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

    $fecha = date('Y-m-d');
    $fecha30 = date('Y-m-d', strtotime('-7 day', strtotime($fecha)));

    $mail = new PHPMailer();
    $mail->FromName = 'Gestión ESFOCC';
    $para = 'ccoll_formacion@eduka-te.com';
    $mail->addAddress($para);
    // $mail->addAddress('aperojo@eduka-te.com');
    // $mail->addCC('aperojo@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    $mail->CharSet = 'UTF-8';
    $mail->isHTML(true);
    // $mail->addAttachment($informe);

    $envia = 0;
    $titulo = 'Diplomas enviados hace más de 7 DÍAS y no recogidos';
    $mail->Subject = $titulo;

    $q = 'SELECT DISTINCT * FROM registro_emails r
    WHERE titulo
    LIKE "%Descarga de diploma%"
    AND fecha < "'. $fecha30 .'"
    AND r.id_mat NOT IN( SELECT c.id_matricula FROM confirmaciones_diplomas c)
    AND r.id_alu NOT IN( SELECT c.id_alumno FROM confirmaciones_diplomas c)';
    // echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $cuerpo = '<table cellspacing="10" id="tablamatriculas" class="table table-striped" style="font-size:12px">
                <thead>
                    <tr> <!-- AQUI UN SWITCH? !-->
                        <th>Fecha envío</th>
                        <th>Acción - Alumno</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_array($q) ) {


        $cuerpo .= "<tr>";
        $cuerpo .= "<td>". formateaFechaHora($row[fecha]) ."</td>";
        $cuerpo .= "<td>". $row[titulo] ."</td>";
        $cuerpo .= "<td>". $row[para] ."</td>";
        $cuerpo .= "</tr>";
        $envia = 1;
    }

    $cuerpo .= '</tbody></table>';

    $mail->Body = $cuerpo;


    $dia = strftime('%u', strtotime($fecha) );

    if ( $dia == 1 && $envia == 1 ) {

        if (!$mail->send())
            echo "error";
        else {

            registrarMailBD($para, $titulo, '', $link);
            echo "bien";
        }

    }

?>