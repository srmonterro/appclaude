<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once('./funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');


$fecha = date('Y-m-d');
$semanant = date('Y-m-d', strtotime('-7 day', strtotime($fecha)));
// $semanat = '2017-03-09';
// $s = 'AND DATE_FORMAT(p.fecha_peticion, "%Y-%m-%d") = "'.$semanant.'"';


$q = 'SELECT DISTINCT p.numero, p.modalidad, p.tipoformacionpropuesta, p.formacion, p.empresas, p.presupuesto, p.observacionesgestor, p.observaciones, p.id_comercial, c.email, c.nombre, @cid := c.id as id_com,

(SELECT count(c.id)
    FROM peticiones_formativas p, comerciales c
    WHERE estado_peticion IN ("Pendiente")
    AND p.id_comercial = c.id
    AND tiposol = "SM"
    AND c.id = @cid
    AND DATE_FORMAT(p.fecha_peticion, "%Y-%m-%d") = "'.$semanant.'"
    AND c.nombre NOT LIKE "%ext_%") as cuenta

FROM peticiones_formativas p, comerciales c
WHERE estado_peticion IN ("Pendiente")
AND p.id_comercial = c.id
AND tiposol = "SM"
AND c.nombre NOT LIKE "%ext_%"
AND DATE_FORMAT(p.fecha_peticion, "%Y-%m-%d") = "'.$semanant.'"
ORDER BY c.id ASC';


$q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

if ( mysqli_num_rows($q) > 0 ) {

    $cuerpo = "";

    while ( $row = mysqli_fetch_assoc($q) ) {
        $propuestas[] = $row;
    }


    $i = 0;
    $c = 0;


    // MAIL INDIVIDUAL COMERCIALES

    foreach ($propuestas as $value) {

        arrayText($value);

        $id_comercial = $value['id_comercial'];
        $emailcomercial = $value['email'];
        $comercial = $value['nombre'];
        $cuenta = $value['cuenta'];

        unset($value['id_comercial']);
        unset($value['id_com']);
        unset($value['cuenta']);
        unset($value['email']);
        unset($value['nombre']);

        if ( $id_comercial != $id_comercial_ant || $i == 0 ) {

            $c = 0;
            $c++;
            echo "ENTRA".$i." - ".$id_comercial." | ".$id_comercial_ant."<br><br><br>";

            $headers = array('Nº', 'Modalidad', 'Tipo', 'Curso', 'Empresas', 'Presupuesto', 'Observ.<br>Gestor', 'Observ.<br>'.$comercial);

            $mail = new PHPMailer;
            $mail->From = 'gestion@eduka-te.com';
            $mail->FromName = 'Gestión ESFOCC';

            $mail->addAddress($emailcomercial);
            $mail->addBCC('aperojo@eduka-te.com');


            $mail->isHTML(true);                                    // Set email format to HTML


            $cuerpo = "";

            if ( $cuenta == 1 ) {
                $cuerpo .= arrayTable($headers, $value, true);
                $mail->Body = $cuerpo;
            }
            // }

            $mail->CharSet = 'UTF-8';

            $r = array();

            $titulo = 'Recordatorio a comerciales - Solicitudes de matrícula pendientes del '.formateaFecha($semanant);

            $mail->Subject = $titulo;

            //     // if ( compruebaEnvioEmail($titulo, $link) != 1 ) {
            if ( $cuenta == 1 ) {
                if(!$mail->send()) {
                    $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                    $r[resul]=0;
                    echo $mail->ErrorInfo;
                    exit;
                } else {
                        // registrarMailBD($para, $titulo, $cc, $link);
                    $r[mensaje]='Email enviado con éxito.';
                    $r[resul]=1;
                    echo "OK";
                }
            }


        } else {

            // $cuerpo = array();
            echo "SALE".$i." - ".$id_comercial." | ".$id_comercial_ant."<br><br><br>";
            $cuerpo .= arrayTable($headers, $value, true);


            if ( $cuenta == $c ) {

                $mail->Body = $cuerpo;

                if(!$mail->send()) {
                    $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
                    $r[resul]=0;
                    echo $mail->ErrorInfo;
                    exit;
                } else {
                        // registrarMailBD($para, $titulo, $cc, $link);
                    $r[mensaje]='Email enviado con éxito.';
                    $r[resul]=1;
                    echo "OK";
                }
            }

        }

        $i++;
        $c++;

        $id_comercial_ant = $id_comercial;
    }


    // MAIL GRUPAL GESTORES

    $cuerpo = array();

    foreach ($propuestas as $value) {
        unset($value['id_comercial']);
        unset($value['id_com']);
        unset($value['cuenta']);
        unset($value['email']);
        unset($value['nombre']);

        $p[] = $value;
    }

    arrayText($p);


    $headers = array('Nº', 'Modalidad', 'Tipo', 'Curso', 'Empresas', 'Presupuesto', 'Observ.<br>Gestor', 'Observ.<br>Comercial');
    $cuerpo = arrayTable($headers, $p, true);

    $mail = new PHPMailer;
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión ESFOCC';
    $mail->addAddress('ccoll_formacion@eduka-te.com');
    //$mail->addAddress('mchinea@eduka-te.com');
    $mail->addBCC('aperojo@eduka-te.com');


    $mail->isHTML(true);                                    // Set email format to HTML

    $mail->Body = $cuerpo;

    $mail->CharSet = 'UTF-8';

    $titulo = 'Recordatorio a gestores - Solicitudes de matrícula pendientes del '.formateaFecha($semanant);

    $mail->Subject = $titulo;

        // if ( compruebaEnvioEmail($titulo, $link) != 1 ) {
    if(!$mail->send()) {

        echo $mail->ErrorInfo;
        exit;

    } else {

        echo "OK";
    }



}

?>