<?
$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

setlocale(LC_TIME, "es_ES");

if ( $_POST[envio] == 1 )
    $id_mat = $_POST['id_matricula'];
else
    $id_mat = $_GET['id_matricula'];

$id_alu = "";


$anio = $_POST['anio'];
if ( $anio == "" ) {
    $anio = $_GET['anio'];
}

if ( $anio != "" )
    include_once '../functions/connect.php';

$existe = 0;
$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido, a.diploma,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, a.htmldiploma
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");

    while ($row = mysqli_fetch_array($sql)) {

        $existe = 1;
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $modalidad = $row[modalidad];
        $contenido = $row[contenido];
        $diploma = $row[diploma];
        $htmldiploma = $row[htmldiploma];

    }

    if ( $existe == 0 ) {

        $actual = date('Y');
        $anio = $actual - 1;

        if ( $anio != "" )
            include_once '../functions/connect.php';

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido, a.diploma,
        m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, a.htmldiploma
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id ='.$id_mat;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error");

        while ($row = mysqli_fetch_array($sql)) {

            $existe = 1;
            $naccion = $row[numeroaccion];
            $ngrupo = $row[ngrupo];
            $denominacion = $row[denominacion];
            $horastotales = $row[horastotales];
            $fechaini = $row[fechaini];
            $fechafin = $row[fechafin];
            $horariomini = $row[horariomini];
            $horariomfin = $row[horariomfin];
            $horariotini = $row[horariotini];
            $horariotfin = $row[horariotfin];
            $modalidad = $row[modalidad];
            $contenido = $row[contenido];
            $diploma = $row[diploma];
            $htmldiploma = $row[htmldiploma];

        }

    }

    $anio = explode('-', $fechafin);

    if ( date('Y') != $anio[0] ) $anio = '&anio='.$anio[0]; else $anio = "";

    $lugar = 'San Cristóbal de La Laguna';


    if ( strpos($ngrupo, "p") !== false ) {
        $nobonificado = 1;
        $clase = "../img/diplomas/dipfront_nobonif.png";
    } else
        $clase = "../img/diplomas/dipfront_bonif.png";

    // echo $clase;
    $sql = 'SELECT a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif, a.id as id_alu, a.email as email_alumno, e.id as id_empresa, e.categoria
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
    AND ma.id_empresa = e.id
    AND ma.id_matricula = '.$id_mat;
    $sql = mysqli_query($link, $sql) or die ("error".mysqli_error($link));
    $row = mysqli_fetch_array($sql);
    $alumno = $row[nombre].$row[apellido].'_'.$naccion.'-'.$ngrupo;
    $id_alu = $row[id_alu];
    $email_alumno = $row[email_alumno];

    // si es individual
    $individual = 0;
    if ( $row['cif'] == $row['documento'] || $row['categoria'] == "PERSONA FISICA" || $row['id_empresa'] == 10339 ) {
        $individual = 1;
        $clase = "../img/diplomas/dipfront_nobonif_noemp.png";
    }
    //cgutierrez: obtener código de validación del diploma
    $codigo_diploma = generarCodigos($id_mat, $id_alu, $link);


if ($_GET[confirmaprev] == 1) {

    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/bootstrap.css" rel="stylesheet">
    </head>
    <title>ESFOCC | Confirmación de recepción y descarga de diploma</title>
    <body>


        <? if ( $id_mat != 1303 && $id_mat != 271 ) { ?>
            <p style="text-align:center; font-family: Arial; margin-top: 30px">
                <img src="../img/logo.png" alt="">
                <br><br> <strong>CURSO</strong>: <? echo $naccion.'/'.$ngrupo. ' - '. $denominacion ?>
                <br> <strong>ALUMNO</strong>: <? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2]. ' - '. $row[documento] ?>
                <br> <strong>FECHA</strong>: <? echo formateaFecha($fechaini).' - '.formateaFecha($fechafin) ?>
                <br><br><br>Mediante la descarga del diploma en versión digital, confirmo su recepción.
                <br><br><a class="btn btn-success" href="http://gestion.esfocc.com/app/documentacion/generar_diploma_tdn.php?id_alumno=<? echo $id_alu ?>&id_matricula=<? echo $id_mat ?>&confirma=1<? echo $anio ?>">Descargar</a>
                <br><br><br><span style="text-align:center; font-size:11px">Si desea recibir una copia del diploma en papel, solicítelo a <i>diplomas@eduka-te.com</i></span>
            </p>
            <? } else { echo "Diploma no disponible."; } ?>

    </body>
    </html>
    <?


} else {

    // echo "llega";
    ob_start();

?>

<style>


table {
    width: 860px;
    height: 560px;
    position: fixed;
    margin: 110px 0px 0px 100px;

}
.alumno {
    position: relative;
    text-align: center;
    top: 195px;
    font-size: 32px;
}

.nif {
    position: absolute;
    top: 280px;
    margin-left: 150px;
    font-size: 16px;
}

.cif {
   position: absolute;
    top: 302px;
    margin-left: 150px;
    font-size: 16px;
}

.af {
    position: absolute;
    top: 323px;
    margin-left: 210px;
    font-size: 16px;
}

.razonsocial {
    position: absolute;
    top: 283px;
    width: 320px;
    margin-left: 695px;
    font-size: 16px;
}

.denominacion {
    position: relative;
    text-align: center;
    top: 160px;
    margin: 0 50px 0 50px;
    font-size: 28px;
}

.duracion {
    position: absolute;
    top: 498px;
    margin-left: 222px;
    font-size: 16px;
}

.fechaini {
    position: absolute;
    top: 521px;
    margin-left: 195px;
    font-size: 16px;
}

.fechafin {
    position: absolute;
    top: 542px;
    margin-left: 237px;
    font-size: 16px;
}

.modalidad {
    position: absolute;
    top: 561px;
    margin-left: 166px;
    font-size: 16px;
}

.lugar {
    position: absolute;
    top: 524px;
    margin-left: 620px;
    font-size: 16px;
}

.dia {
    position: absolute;
    top: 524px;
    margin-left: 865px;
    font-size: 16px;
}

.mes {
    position: absolute;
    top: 524px;
    margin-left: 910px;
    font-size: 14px;
}
.anio {
    position: absolute;
    top: 526px;
    margin-left: 1011px;
    font-size: 16px;
}

.codigo {
    position: absolute;
    top: 733px;
    margin-left: 352px;
    font-family: courier;
    font-size: 14px;
}

.titulocodigo {
    position: absolute;
    top: 735px;
    margin-left: 232px;
    font-size: 12px;
}

.urlcodigo {
    position: absolute;
    top: 735px;
    margin-left: 632px;
    font-size: 12px;
}

</style>



    <page backimg="<? echo $clase ?>">
        <div class="alumno"><? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2] ?></div>
        <div class="nif"><? echo $row[documento] ?></div>
        <div class="cif"><? echo $individual == 1 ? "" : $row[cif] ?></div>
        <div class="af"><? echo $naccion.'/'.$ngrupo ?></div>
        <div class="razonsocial"><? echo $individual == 1 ? "" : $row[razonsocial] ?></div>
        <div class="denominacion"><? echo $denominacion ?></div>
        <div class="duracion"><? echo $horastotales.' horas' ?></div>
        <div class="fechaini"><? echo date("d/m/Y",strtotime($fechaini)) ?></div>
        <div class="fechafin"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>
        <div class="modalidad"><? echo $modalidad ?></div>
        <div class="lugar"><? echo $lugar ?></div>
        <div class="dia"><? echo date("d",strtotime($fechafin)) ?></div>
        <div class="mes"><? echo ucwords(strftime("%B",strtotime($fechafin))) ?></div>
        <div class="anio"><? echo strftime("%Y",strtotime($fechafin)) ?></div>
        <? //if ( isRoot() ) { ?>
            <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
            <div class="codigo"><? echo $codigo_diploma ?></div>
            <div class="urlcodigo"><? echo 'URL de verificación: <a href="diplomas.esfocc.com">diplomas.esfocc.com</a>' ?></div>
        <? //} ?>
    </page>

    <page backimg="./diplomas/diploma_atras.png">
        <div class="contenidotxt">
            <? echo $htmldiploma ?>
        </div>
    </page>

<?

    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);
    // $html2pdf->createIndex('indice', 25, 12, false, true, 2);


    if ( $_POST[envio] == 1 ) {

        // $anio = $_GET[anio];

        // if ( $anio != "" )
        //     include_once '../functions/connect.php';

        $mail = new PHPMailer();
        $mail->FromName = 'Gestión ESFOCC';
        $mail->addReplyTo('diplomas@eduka-te.com');
        $para = $email_alumno;
        $mail->addAddress($para);
        // $mail->addBCC('aperojo@eduka-te.com');
        // $mail->addBCC('icabrera@eduka-te.com');
        $mail->addBCC('backup-gestion@eduka-te.com');
        //$mail->addBCC('abenitez@eduka-te.com');
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $titulo = $mail->Subject = 'Descarga de diploma acción formativa '.$naccion.'/'.$ngrupo.' - '.$row[nombre].' '.$row[apellido].' '.$row[apellido2];
        $mail->Body = 'Buenos días,<br><br>

        Tras haber finalizado de forma satisfactoria la formación que ha realizado con nosotros, puede descargar el diploma en formato PDF a través del siguiente enlace:<br><br>

        <a href="http://gestion.esfocc.com/app/documentacion/generar_diploma_tdn.php?id_matricula='.$id_mat.'&confirmaprev=1'.$anio.'">Descargar Diploma</a><br><br>

        Para cualquier duda o consulta no dude en contactar con nosotros.<br>';
        $mail->Body .= '-------------- <br>
                <img src="http://gestion.esfocc.com/app/documentacion/guias/img/footermailgesti.png"><br>
                <span style="font-size: 10px">Confidencialidad<br>
                Este correo electrónico y, en su caso, cualquier fichero anexo al mismo, contiene información de carácter confidencial exclusivamente dirigida a su destinatario o destinatarios y propiedad de ESFOCC S.L.U. Queda prohibida su divulgación, copia o distribución a terceros sin la previa autorización escrita de ESFOCC S.L, en virtud de la legislación vigente. En el caso de haber recibido este correo electrónico por error, se ruega notificar inmediatamente esta circunstancia mediante reenvío a la dirección electrónica del remitente y la destrucción del mismo.
                <br>Confidentiality<br>
                The information in this e-mail and in any attachments is classified as ESFOCC S.L.U. Confidential and Proprietary Information and solely for the attention and use of the named addressee(s). You are hereby notified that any dissemination, distribution or copy of this communication is prohibited without the prior written consent of ESFOCC S.L.U. and is s strictly prohibited by law. If you have received this communication in error, please, notify the sender by reply e-mail.</span>';


        if ( $email_alumno == "" || $email_alumno == NULL ) {
            echo "ERROR : El alumno no tiene email.";
            return false;
        } else if (!$mail->send()) {
            echo "ERROR : Email no enviado.";
            return false;
        } else {

            registrarMailBDparams($para, $titulo, $cc, $id_mat, $id_alu, $link);
            echo "bien";

        }


    } else if ($_GET[confirma] == 1) {

        // $anio = $_GET[anio];

        // if ( $anio != "" )
        //     include_once '../functions/connect.php';


        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');

        $q = 'INSERT IGNORE INTO confirmaciones_diplomas (id_alumno, id_matricula, fechahora, ip)
        VALUES ('.$_GET[id_alumno].','.$_GET[id_matricula].', "'.date("Y-m-d H:i").'", "'. $ip .'")';
        mysqli_query($link, $q) or die("error" . mysqli_query($link));

        $html2pdf->Output($nombreFichero);

    } else {
        $html2pdf->Output($nombreFichero);
    }

}

?>
