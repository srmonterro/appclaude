<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

 $gestion = devuelveAnioReal();

setlocale(LC_TIME, "es_ES");
$sec = explode("?",$_SERVER['HTTP_REFERER']);

 $anio = $_GET[anio];
$anio = $_POST['anio'];
if ( $anio == "" ) {
    $anio = $_GET['anio'];
}
//echo $anio;
//echo $gestion;
//include_once '../functions/connect.php';




// $_POST[envioemp] = 1;
// $_POST['id_matricula'] = 56;
// $_POST[tipo] = 'bonificado';
//echo "post-connect";
if ( $_POST[envioemp] == 1 ) {
    $id_mat = $_POST['id_matricula'];
    $tipo = $_POST['tipo'];
    $email_emp = $_POST['email_emp'];
}

$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido, a.htmldiploma,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id_mat;
     echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error" . mysqli_error($link) );

    $existe = 0;
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
        $estado = $row[estado];
        $incendios = $row[incendios];
        $nivel_incendios = $row[nivel_incendios];
        $htmldiploma = $row[htmldiploma];
    }

    // echo $existe;
    $actual = date('Y');
    while ( $existe == 0 ) {

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


    $lugar = 'Costa Adeje';


    if ( $tipo != 'bonificado' ) {

        $sqltipo = "Privado";
        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "../img/diplomas/dipfront_nobonif_incen1.png";
            else $clase = "../img/diplomas/dipfront_nobonif_incen2.png";

        } else $clase = "../img/diplomas/dipfront_nobonif.png";

    } else {

        $sqltipo = "";
        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "../img/diplomas/dipfront_bonif_incen1.png";
            else $clase = "../img/diplomas/dipfront_bonif_incen2.png";
        } else $clase = "../img/diplomas/dipfront_bonif.png";

    }

    $clase = "../img/diplomas/dipfrontb.png";

    $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif,a.email as email_alumno
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
    AND ma.tipo = "'.$sqltipo.'"
    AND ma.id_matricula = '.$id_mat.'
    AND ma.finalizado = 1
    AND ma.id_empresa = e.id';
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error1" . mysqli_error($link));

    while ( $row = mysqli_fetch_array($sql) ) {

        // $codigo_diploma = generarCodigos($id_mat, $row[id], $link);


        ob_start();

?>

<style>

table {
    width: 860px;
    height: 560px;
    position: fixed;
    margin: 80px 0px 0px 100px;

}
.alumno {
    position: relative;
    text-align: justify;
    top: 220px;
    margin-left: 100px;
    margin-right: 150px;
    font-size: 20px;
    line-height : 32px;
}
.alumno2 {
    position: relative;
    text-align: justify;
    top: 30px;
    margin-left: 100px;
    margin-right: 150px;
    font-size: 20px;
    line-height : 32px;
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
    position: relative;
    top: 30px;
    text-align: center;
    font-size: 22px;
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
    top: 35px;
    margin-left: 100px;
    margin-right:100px;
    font-weight: bold;
    font-size: 28px;
}

.duracion {
    position: absolute;
    top: 498px;
    margin-left: 222px;
    font-size: 16px;
    width: 800px;
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
    top: 620px;
    margin-left: 455px;
    font-size: 24px;
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
    top: 770px;
    margin-left: 352px;
    font-family: courier;
    font-size: 14px;
}

.titulocodigo {
    position: absolute;
    top: 770px;
    margin-left: 232px;
    font-size: 12px;
}

.urlcodigo {
    position: absolute;
    top: 770px;
    margin-left: 632px;
    font-size: 12px;
}
.contenidotxt {
    width: 860px;
    height: 560px;
    position: absolute;
    margin: 100px 0px 0px 100px;

}



</style>



        <page backimg="<? echo $clase ?>">
            <div class="alumno"><? echo 'D/Dña. '.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'  con NIF '.$row[documento].' que presta  sus servicios en la Empresa '.$row[razonsocial].' con CIF '.$row[cif].' ha realizado la acción formativa '?></div>   
            <div class="denominacion"><? echo $denominacion ?></div> 
            <div class="af"><? echo 'GRUPO '.$ngrupo.' - CÓDIGO AF '.$naccion ?></div> 
            <div class="alumno2"><? echo 'Durante  los días  '.date("d/m/Y",strtotime($fechaini)).' al  '.date("d/m/Y",strtotime($fechafin)).' con una  duración total  de  '.$horastotales.' horas  en la modalidad formativa '.$modalidad.'.' ?></div>
            <div class="dia"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>   
                <? //if ( isRoot() ) { ?>
            <div class="titulocodigo"><? echo 'Código de validación: ' ?></div>
            <div class="codigo"><? echo $codigo_diploma ?></div>
            <div class="urlcodigo"><? echo 'URL de verificación: diplomas.eduka-te.com' ?></div>
            <? //} ?>
        </page>

        <page backimg="../img/diplomas/dip_trasb.png">
            <div class="contenidotxt">
                <? echo $htmldiploma; ?>
            </div>
        </page>


    <?


    $content .= ob_get_clean();
    $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);

    }

    $html2pdf->Output('diplomas.pdf', 'F');

    if ( $_POST[envioemp] == 1 ) {

        $mail = new PHPMailer();
        $mail->FromName = 'Soporte EDUKA-TE SOLUTIONS';
        $mail->addReplyTo('soporte@eduka-te.com');
        $para = $email_emp;
        
        $mail->addAddress($para);
        $mail->addBCC('soporte@eduka-te.com');
        $mail->addAttachment('diplomas.pdf');
        
        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);

        $titulo = $mail->Subject = 'Diplomas acción formativa '.$naccion.'/'.$ngrupo. ' - '.strtoupper($tipo).' - '.$denominacion;
        $mail->Body = 'Hola,<br><br>
        Adjunto a este correo enviamos los diplomas y certificados de asistencia de la formación especificada en el asunto. <br>
        Para cualquier duda o consulta no dude en contactar con nosotros.<br><br>';

        $mail->Body .= '-------------- <br>
                <img src="http://gestion.eduka-te.com/app/documentacion/guias/img/footermailgesti.png"><br>
                 <span style="font-size: 10px">Eduka-te Solutions<br>
                Calle Londres, 11, 38660 Costa Adeje, Santa Cruz de Tenerife<br><br>
               La información contenida en este mensaje y/o archivo(s) adjunto(s) es confidencial/privilegiada y está destinada a ser leída sólo por la(s) persona(s) a la(s) que va dirigida.<br>

                AVISO LEGAL y PROTECCIÓN DE DATOS en <a href="http://eduka-te.avisolegal.info/" style="box-sizing: border-box; background-color: transparent; color: rgb(0, 160, 205); text-decoration: none" target="_blank" rel="noreferrer"><strong style="box-sizing: border-box; font-weight: 700"><em style="box-sizing: border-box">PINCHE AQUÍ</em></strong></a></span>';

            echo "<pre>";
            print_r($mail);
            echo "</pre>";
        if (!$mail->send()) {
            echo "ERROR : Email no enviado.";
            return false;
        } else {

            registrarMailBDparams($para, $titulo, $cc, $id_mat, $id_alu, $link);
            echo "bien";

        }


    }



?>
