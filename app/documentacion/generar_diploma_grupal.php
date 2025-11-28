<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
//echo $baseurl;
$gestion = devuelveAnioReal();
//echo "gestión:".$gestion;
setlocale(LC_TIME, "es_ES");
$sec = explode("?",$_SERVER['HTTP_REFERER']);

// $anio = $_GET[anio];
//echo "prev-if-post-anio";
$anio = $_POST['anio'];
//$envio = $_POST['envio'];
//echo "sigue";
//echo "anio-post:".$anio;
//echo $envio;
if ( $anio == "" ) {
    $anio = $_GET['anio'];
}
//echo "anio-get:".$anio;
$gestion=$anio;
//if ( $anio != "" )
   // include_once '../functions/connect.php';
//echo $gestion;
$gestion=2024;

if ( $_POST[envio] == 1 ) {
    $id_mat = $_POST['id_matricula'];
    $tipo = $_POST['tipo'];
    $id_alu = $_POST['id_alumno'];
    $envio = $_POST['envio'];
    //echo "entra envio post";
    //echo $id_mat;
} else {
    $id_mat = $_GET['id_matricula'];
    $tipo = $_GET['tipo'];
    $id_alu = $_GET['id_alumno'];
    $envio = $_GET['envio'];

    //echo "entra get";
    //echo $id_mat;
    //echo $envio;

}
$link = mysqli_connect("edukateccxgs".$gestion.".mysql.db","edukateccxgs".$gestion,"Solutions".$gestion,"edukateccxgs".$gestion);
//$link = mysqli_connect("edukateccxgs2023.mysql.db","edukateccxgs2023","Solutions2023","edukateccxgs2023");
mysqli_set_charset($link,"utf8");
$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido, a.htmldiploma,
    m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.estado, a.incendios, a.nivel_incendios
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id_mat;
     //echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error en base" . mysqli_error($link) );

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

     //echo $existe;
    $actual = date('Y');
    while ( $existe == 0 ) {

        $anio = $actual - 1;
//echo $anio;
        if ( $anio != "" )
            include_once '../functions/connect.php';

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, a.contenido, a.diploma,
        m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, a.htmldiploma
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND m.id ='.$id_mat;
         //echo $sql;
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
//echo $anio;
    if ( date('Y') != $anio[0] ) $anio = '&anio='.$anio[0]; else $anio = "";


    $lugar = 'Costa Adeje';


    if ( $tipo != 'bonificado' ) {

        $sqltipo = "Privado";
        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "../img/diplomas/dipfront.png";
            else $clase = "../img/diplomas/dipfront.png";

        } else $clase = "../img/diplomas/dipfront.png";

    } else {

        $sqltipo = "";
        if ( $incendios == 1 ) {

            if ( $nivel_incendios == "I" ) $clase = "../img/diplomas/dipfront.png";
            else $clase = "../img/diplomas/dipfront.png";
        } else $clase = "../img/diplomas/dipfront.png";

    }


    $sql = 'SELECT DISTINCT a.id, a.nombre,a.apellido,a.apellido2,a.documento,e.razonsocial,e.cif,a.email as email_alumno
    FROM mat_alu_cta_emp ma, alumnos a, empresas e
    WHERE ma.id_alumno = a.id
    AND ma.tipo = "'.$sqltipo.'"
    AND ma.id_matricula = '.$id_mat.'
    AND a.id = '.$id_alu.'
    AND ma.id_empresa = e.id';
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error1" . mysqli_error($link));

    $row = mysqli_fetch_array($sql);
    $email_alumno = $row[email_alumno];
    //echo $email_alumno;
    if ($_GET[confirmaprev] == 1) {
         //print_r($row);

        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
            <link href="../css/bootstrap.css" rel="stylesheet">
        </head>
       
        <title>EDUKA-TE | Confirmación de recepción y descarga de diploma</title>
        <body>

            <p style="text-align:center; font-family: Arial; margin-top: 30px">
                <img src="../img/logo.png" width="400" height="200" alt="">
                <br><br> <strong>CURSO</strong>: <? echo $naccion.'/'.$ngrupo. ' - '. $denominacion ?>
                <br> <strong>ALUMNO</strong>: <? echo $row[nombre].' '.$row[apellido].' '.$row[apellido2]. ' - '. $row[documento] ?>
                <br> <strong>FECHA</strong>: <? echo formateaFecha($fechaini).' - '.formateaFecha($fechafin) ?>
                <br><br><br>Mediante la descarga del diploma en versión digital, confirmo su recepción.
                <br><br><a class="btn btn-success" href="http://gestion.eduka-te.com/app/documentacion/generar_diploma_grupal.php?tipo=<? echo $tipo ?>&id_alumno=<? echo $id_alu ?>&id_matricula=<? echo $id_mat ?>&confirma=1<? echo $anio ?>">Descargar</a>
                <!--<br><br><br><span style="text-align:center; font-size:11px">Si desea recibir una copia del diploma en papel, solicítelo a <i>soporte@eduka-te.com</i></span>-->
            </p>

        </body>
        </html>
        <?

    
    } else if ( $envio == 1 ) {

    //} else if ( isset($_POST[envio]) ) {
        //echo "entra envio2";
        $para = $email_alumno;
        $mail = new PHPMailer;
        $mail->From = 'soporte@eduka-te.com';
        $mail->FromName = 'Diplomas Eduka-te Solutions';
        $mail->addAddress($email_alumno);
        //$mail->addCC('ivan.cabrera@eduka-te.com');
        //$mail->addBCC('soporte@eduka-te.com');
        $mail->addBCC('diplomas@eduka-te.com');
        $mail->addReplyTo('soporte@eduka-te.com');
        
        $mail->isHTML(true);

        $titulo = $mail->Subject = 'Descarga de diploma acción formativa '.$naccion.'/'.$ngrupo.' - '.$row[nombre].' '.$row[apellido].' '.$row[apellido2];
        $mail->Body = 'Hola,<br><br>

        Tras haber finalizado de forma satisfactoria la formación que ha realizado con nosotros, puede descargar el diploma en formato PDF a través del siguiente enlace:<br><br>

        <a href="http://gestion.eduka-te.com/app/documentacion/generar_diploma_grupal.php?id_matricula='.$id_mat.'&id_alumno='.$id_alu.'&tipo='.$tipo.$anio.'&confirmaprev=1">Descargar Diploma</a><br><br>

        Para cualquier duda o consulta no dude en contactar con nosotros.<br>';

          $mail->Body .= '-------------- <br>
                <img src="http://gestion.eduka-te.com/app/documentacion/guias/img/footermailgesti.png"><br>
                 <span style="font-size: 10px">Eduka-te Solutions<br>
                Calle Londres, 11, 38660 Costa Adeje, Santa Cruz de Tenerife<br><br>
               La información contenida en este mensaje y/o archivo(s) adjunto(s) es confidencial/privilegiada y está destinada a ser leída sólo por la(s) persona(s) a la(s) que va dirigida.<br>

                AVISO LEGAL y PROTECCIÓN DE DATOS en <a href="http://eduka-te.avisolegal.info/" style="box-sizing: border-box; background-color: transparent; color: rgb(0, 160, 205); text-decoration: none" target="_blank" rel="noreferrer"><strong style="box-sizing: border-box; font-weight: 700"><em style="box-sizing: border-box">PINCHE AQUÍ</em></strong></a></span>';

        $mail->CharSet = 'UTF-8';
        echo "<pre>";
            print_r($mail);
            echo "</pre>";
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


    } else {

        //cgutierrez: obtener código de validación del diploma
        //if ( isRoot() ) {
           // $codigo_diploma = generarCodigos($id_mat, $row[id], $link);
        //}

        ob_start();

?>


<style>

table {
    width: 860px;
    height: 560px;
    position: fixed;
    margin: 80px 0px 0px 100px;

}
.contenidotxt {
    width: 860px;
    height: 560px;
    position: absolute;
    margin: 115px 0px 0px 20px;

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
    top: 292px;
    margin-left: 150px;
    font-size: 16px;
}

.cif {
   position: absolute;
    top: 315px;
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
    top: 295px;
    margin-left: 720px;
    width: 315px !important;
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
    top: 515px;
    margin-left: 240px;
    font-size: 16px;
}

.fechaini {
    position: absolute;
    top: 540px;
    margin-left: 205px;
    font-size: 16px;
}

.fechafin {
    position: absolute;
    top: 560px;
    margin-left: 245px;
    font-size: 16px;
}

.modalidad {
    position: absolute;
    top: 580px;
    margin-left: 168px;
    font-size: 16px;
}

.lugar {
    position: absolute;
    top: 543px;
    margin-left: 640px;
    font-size: 16px;
}

/*.dia {
    position: absolute;
    top: 543px;
    margin-left: 890px;
    font-size: 16px;
}*/
.dia {
    position: absolute;
    top: 620px;
    margin-left: 455px;
    font-size: 24px;
}
.mes {
    position: absolute;
    top: 543px;
    margin-left: 947px;
    font-size: 16px;
}

.anio {
    position: absolute;
    top: 543px;
    margin-left: 1050px;
    font-size: 16px;
}

.legionella {
    position: absolute;
    top: 550px;
    margin-left: 275px;
    font-size: 11px;
    text-align: center;
    width: 510px;
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

.back {
    overflow: auto;
    position: relative;
    display: block;
    /*background-image: url('../img/diplomas/diploma_atras.png');*/
    background-image: url('../img/diplomas/dip_tras.png');
    background-repeat:no-repeat;
    background-size: 30.8cm 21.7cm ;
    width: 100%;
    height: 100%;
    page-break-after: always;
}



.prueba {
    border: 1px solid red;
    line-height: auto;
    width: 20px;
    height: 30px;

}


.doscolumnas {
    -moz-column-count: 2;
    -moz-column-gap: 1em;
    -webkit-column-count: 2;
    -webkit-column-gap: 1em;
}

.trescolumnas {
    -moz-column-count: 3;
    -moz-column-gap: 1em;
    -webkit-column-count: 3;
    -webkit-column-gap: 1em;
}

.cuatrocolumnas {
    -moz-column-count: 4;
    -moz-column-gap: 1em;
    -webkit-column-count: 4;
    -webkit-column-gap: 1em;
}
.cincocolumnas {
    -moz-column-count: 5;
    -moz-column-gap: 1em;
    -webkit-column-count: 5;
    -webkit-column-gap: 1em;
}
.seiscolumnas {
    -moz-column-count: 6;
    -moz-column-gap: 1em;
    -webkit-column-count: 6;
    -webkit-column-gap: 1em;
}
</style>




        <page backimg="<? echo $clase ?>">
           
                <div class="alumno"><? echo 'D/Dña. '.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'  con NIF '.$row[documento].' que presta  sus servicios en la Empresa '.$row[razonsocial].' con CIF '.$row[cif].' ha realizado la acción formativa '?></div>   <div class="denominacion"><? echo $denominacion ?></div> 
                <div class="af"><? echo 'GRUPO '.$ngrupo.' - CÓDIGO AF '.$naccion ?></div> 
                <div class="alumno2"><? echo 'Durante  los días  '.date("d/m/Y",strtotime($fechaini)).' al  '.date("d/m/Y",strtotime($fechafin)).' con una  duración total  de  '.$horastotales.' horas  en la modalidad formativa '.$modalidad.'.' ?></div>
                 <div class="dia"><? echo date("d/m/Y",strtotime($fechafin)) ?></div>   
               
                
              
        </page>
        <page backimg="../img/diplomas/dip_tras.png">
           
            <div class="contenidotxt">
               <? echo nl2br($contenido) ?> 
                
            </div>
           
        </page>

    <?


    $content = ob_get_clean();
    $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    $html2pdf->writeHTML($content);



    if ($_GET[confirma] == 1) {

        $ip = getenv('HTTP_CLIENT_IP')?:
        getenv('HTTP_X_FORWARDED_FOR')?:
        getenv('HTTP_X_FORWARDED')?:
        getenv('HTTP_FORWARDED_FOR')?:
        getenv('HTTP_FORWARDED')?:
        getenv('REMOTE_ADDR');

        $q = 'INSERT IGNORE INTO confirmaciones_diplomas (id_alumno, id_matricula, fechahora, ip)
        VALUES ('.$id_alu.','.$_GET[id_matricula].', "'.date("Y-m-d H:i").'", "'. $ip .'")';
        mysqli_query($link, $q) or die("error" . mysqli_query($link));

        $html2pdf->Output($nombreFichero);

    } else {
        $html2pdf->Output($nombreFichero);
    }

}

 ?>
