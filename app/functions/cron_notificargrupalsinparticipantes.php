<?


$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once('./funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

	// $link = connect2015();

$fecha = date('Y-m-d');

if ( date('N') != 6 && date('N') != 7 ) {

    if ( date('N') == 5 ) {
        $maniana = date('Y-m-d', strtotime('+3 day', strtotime($fecha)));
    } else {
        $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));
    }

    $ruta = dirname(__DIR__).'/import'.$gestion.'/doc/';

    $q = 'SELECT DISTINCT @mat:=m.id, ac.numeroaccion, ga.ngrupo, ac.modalidad, ac.denominacion, m.estado, m.fechaini, m.fechafin
    FROM alumnos a, acciones ac, matriculas m, grupos_acciones ga
    WHERE m.id_grupo = ga.id
    AND m.fechaini = "'.$maniana.'"
    AND m.estado NOT IN ("Anulada")
    AND ac.modalidad IN ("Teleformación")
    AND m.grupo = 1
    AND m.id_accion = ac.id';

    echo $q;
    $q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

    // $error = "";
    while ( $row = mysqli_fetch_array($q) ) {

        if (
            strpos($row['ngrupo'], 'p') !== false && !file_exists($ruta . $row['numeroaccion'] . '-' . substr($row['ngrupo'], 0, -1).'docp.xlsx')
            ||
            strpos($row['ngrupo'], 'p') === false && !file_exists($ruta . $row['numeroaccion'] . '-' .  $row['ngrupo'].'doc.xlsx') ) {


            $error .= '<br><br>La acción '.$row['numeroaccion'].'/'.$row['ngrupo'].' - '.$row['denominacion'].' NO tiene tabla de participantes subida.';

            $algo = 1;
        }

    }


    $mail = new PHPMailer;
    $mail->From = 'gestion@eduka-te.com';
    $mail->FromName = 'Gestión ESFOCC';


    $cc = 'ccoll_formacion@eduka-te.com';
    $mail->addAddress('ccoll_formacion@eduka-te.com');
    $mail->addBCC('aperojo@eduka-te.com');
    $mail->addBCC('backup-gestion@eduka-te.com');
    // $mail->addBCC('aperojo@eduka-te.com');

    $mail->isHTML(true);                                    // Set email format to HTML



    $mail->Body = $error;
    $mail->CharSet = 'UTF-8';

    $r = array();

    $titulo = 'Matrículas Online Grupal para mañana sin participantes: '.formateaFecha($maniana);
    $mail->Subject = $titulo;


    if ( $algo == 1 ) {
        if(!$mail->send()) {
            $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
            $r[resul]=0;
                // exit;
        } else {
            registrarMailBD($para, $titulo, $cc, $link);
            $r[mensaje]='Email enviado con éxito.';
            $r[resul]=1;
        }
    }

    arrayText($r);
}


?>
