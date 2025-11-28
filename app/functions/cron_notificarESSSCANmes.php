<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once('./funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');

	// $link = connect2015();

$fecha = date('Y-m-d');
$mesant = date('Y-m-d', strtotime('-1 month', strtotime($fecha)));

$q = '
SELECT DISTINCT m.id, ac.numeroaccion, ga.ngrupo, ac.modalidad, ac.denominacion, m.estado, m.fechaini, m.fechafin
FROM acciones ac, matriculas m, grupos_acciones ga, mat_alu_cta_emp ma
WHERE m.id_grupo = ga.id
AND ma.id_matricula = m.id
AND m.estado != "Anulada"
AND m.fechaini = "'.$mesant.'"
AND m.id_accion = ac.id
AND ac.diploma = "ESSSCAN"
';

$q = mysqli_query($link, $q) or die("error ".mysqli_error($link));


$headers = array("Acción", "Grupo", "Modalidad", "Denominación", "Estado", "Fecha<br>Inicio", "Fecha<br>Fin");

while ( $row = mysqli_fetch_assoc($q) ) {
    $datos[] = $row;
    $algo = 1;
}

$cuerpo = arrayTable($headers, $datos, true);
// echo $cuerpo;
$mail = new PHPMailer;
$mail->From = 'gestion@eduka-te.com';
$mail->FromName = 'Gestión ESFOCC';
$mail->addAddress('ytejera@eduka-te.com');
$mail->addAddress('ccoll_formacion@eduka-te.com');

$mail->addAddress('aperojo@eduka-te.com');
$mail->addBCC('backup-gestion@eduka-te.com');
$mail->isHTML(true);

$mail->Body = $cuerpo;

$mail->CharSet = 'UTF-8';

$r = array();

$titulo = 'Curso/s ESSSCAN pasados un mes';
$mail->Subject = $titulo;


if ( $algo == 1 ) {

    if(!$mail->send()) {
        $r[mensaje]='Error. Email no enviado: ' . $mail->ErrorInfo;
        $r[resul]=0;
        exit;
    } else {
        registrarMailBD($para, $titulo, $cc, $link);
        $r[mensaje]='Email enviado con éxito.';
        $r[resul]=1;
    }

}


?>