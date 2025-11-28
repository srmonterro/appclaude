<?

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

include_once($baseurl.'/functions/funciones.php');
require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

setlocale(LC_TIME, "es_ES");

    $id_comi = $_GET['id_comisionista'];
    $sql = 'SELECT DISTINCT c.*
        FROM comisionistas c
        WHERE c.id = '.$id_comi;

        // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error");

        $row = mysqli_fetch_array($sql);

// $fecha = date("Y-m-d");
    $nombreFichero = "AcuerdoContratoFormacion_".$row[nombre].".pdf";
    ob_start();

?>

<style type="text/Css">

* {
    margin:0;
    padding:0;
    /*font-family: 'Conv_estre',Sans-Serif;*/
}

.page-hor {
    position: relative;
    height: 28.5cm;
    width: 19.6cm;
}


p {
    font-size: 14px;
    line-height: 1.3;
    margin-bottom: 10px;
    text-align: justify;
}

ul li {
    font-size: 14px;
    padding-bottom: 25px;
}

table.accion {
    width: 100%;
    margin: 0;
    border-collapse: collapse;
}
.accion th {
    border: 1px solid #ccc;
    padding: 5px;
}
.accion td {
    border: 1px solid #ccc;
    padding: 5px;
}
.sinmargen li {
    margin-left: 0;
}
.letracabecera {
    color: #fff;
    font-size: 20px;
    margin: 15px 0 0 45px;
    /*font-family: "Calibri";*/
}
.letrafooter {
    color: #fff;
    font-size: 18px;
    margin: 15px 0 0 90px;
    /*font-family: "Calibri";*/
}

</style>



    <!--  -->
    <!--  -->
    <!-- ACUERDO COLABORACIÓN FORMACIÓN CONTINUA -->
    <!--  -->
    <!--  -->

    <page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">
        <div style="margin-top: 20px">
            <div style="margin-top: 20px; margin-bottom: 20px;"><h3 style="text-decoration: underline; text-align:center;">ACUERDO COLABORACIÓN DE SERVICIOS<br><br>Contratos para la Formación</h3></div>
            <p style="text-align:center">En Santa Cruz de Tenerife, a <? echo(date("d")) ?>  de <? echo ucfirst((strftime("%B"))) ?> de <? echo(date("Y")) ?></p>
        </div>

        <div style="margin-top: 40px; margin-bottom: 40px;"><p style="text-align: center;"><strong>REUNIDOS:</strong></p></div>
        <p>De una parte, D. <strong>José Daniel Álvarez Benítez</strong>, con DNI 78565562T, en representación <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN, S.L.U.</strong> con C.I.F.:B76567718 y domicilio en C/El Sol 10, 38204 – San Cristóbal de La Laguna, en adelante <strong>ESFOCC</strong>.</p><br>
        <p>Y de otra parte, D. <? echo $row[asesor] ?>, como representante legal de la sociedad <? echo $row[nombre] ?> con CIF <? echo $row[nifcif] ?>, y teléfono <?echo $row[telefono] ?>, y domiciliada en <? echo ( ucwords(mb_strtolower($row[domiciliofiscal])) .', '. $row[codigopostal] .', '. ucwords(mb_strtolower($row[poblacion])) . ', '. ucwords(mb_strtolower($row[provincia]))).', en adelante ASESORÍA.' ?></p><br>

        <div style="margin-top: 40px; margin-bottom: 20px;"><p style="text-align: center;"><strong>MANIFIESTAN:</strong></p></div>

            <p>I.- Que ESFOCC se dedica a la tramitación de la Formación teórica de Contratos de  Formación, ya sea con titulo o para la obtención del titulo de Graduado en ESO.</p><br>
            <p>II.- Que la ASESORÍA es una empresa dedicada a la gestión y el asesoramiento laboral de otras empresas.</p><br>
            <p>III.- Que ambas partes, respecto a las mencionadas prestaciones de servicios, acuerdan regular su colaboración.</p><br>
        <br>
        <p>A tal fin, y reconociéndose la mutua capacidad legal, libre y voluntariamente formalizan el presente <strong>CONTRATO DE PRESTACIÓN DE SERVICIOS</strong>, que se regirá con sujeción a las siguientes:</p>



    </page>

    <page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">

    <div style="margin-top: 40px; margin-bottom: 40px;"><p style="text-align: center;"><strong>ESTIPULACIONES:</strong></p></div>

    <p> <strong>PRIMERA</strong>.- Que ESFOCC dispone de los medios necesarios, tanto técnicos como humanos, para prestar a las empresas dependientes de la ASESORÍA, servicios de asesoramiento en formación.
    </p><BR>
    <p><strong>SEGUNDA</strong>.- La ASESORÍA, dentro del desarrollo de su actividad profesional, necesita para sus clientes concertar los servicios que actualmente presta ESFOCC en las siguientes materias:
    </p><BR>
    <p style="margin-left: 30px;">Contratos de formación que tramite de sus empresas-clientes, ya sean de alumnos con título de Graduado como aquellos que no lo tienen.</p><br>
    <p><strong>TERCERA</strong>.- ESFOCC. abonará a la ASESORIA en concepto de honorarios por la gestión de captación y administración de los cursos,  el 15%(IGIC incluido) sobre los costes de la formación de los contratos con o sin Graduado en ESO.
    </p><BR><BR>

    <p>A partir del día 16 de cada mes, ESFOCC enviará informe a la ASESORÍA, que detallará los contratos finalizados y cobrados, y que hayan transcurrido <? echo $_GET[vencimiento] ?> días de la fecha de cobro del último recibo.</p>

    <p>La ASESORÍA,  emitirá su factura en la cuantía correspondiente, y será abonada mediante <? echo $_GET[formapago] ?> una vez recibida por ESFOCC y una vez finalizado el contrato de trabajo en formación.</p><br><br>


    <p><strong>CUARTA</strong>.- La duración de este acuerdo de colaboración será de un año a partir de la fecha, prorrogable  por igual periodo,  sino se mediara denuncia entre las partes con dos meses de antelación.</p>


    <p><strong>QUINTA</strong>.- Los datos de carácter personal que sean recabados por ESFOCC de la ASESORÍA, serán incorporados a un fichero automatizado, con la finalidad de realizar acuerdos de formación, pudiendo ejercitar los derechos de acceso, rectificación, oposición y cancelación de los mismos de acuerdo con la legislación vigente y se le facilitará a las entidades correspondientes para dar fin al servicio contratado.</p>

    <p><strong>SEXTA</strong>.- Cualquier duda, cuestión o divergencia que pudiese surgir en la interpretación y cumplimiento de las estipulaciones del presente documento privado, se someterá a arbitraje conforma a la legislación correspondiente.</p>



    </page>

        <page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">


    <p style="margin-top: 60px">Asimismo, para tales cuestiones, las partes con renuncia a cualquier otro fuero que pudiera corresponderle, se someten expresamente a los Juzgados y Tribunales de Santa Cruz de Tenerife.</p><br>

    <p>Y en prueba de total conformidad con lo que antecede, las partes firman el presente documento, por duplicado ejemplar a un solo efecto, en el lugar y fecha expresados en el encabezamiento.</p>


    <div style="margin-top: 350px">
                <table>
                    <tr>
                        <td style="width:77px"></td>
                        <td style="margin-left:0;"><strong>ESFOCC</strong></td>
                        <td style="width:380px"></td>
                        <td align="right" style=""><strong>LA ASESORÍA</strong></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td><img style="margin-top" style="margin-left:-50px; width: 250px;" src="../img/firma_admin_esfocc.png"></td>
                    </tr>
                </table>
                <table>
                    <tr>
                        <td style="width:20px"></td>
                        <td style="margin-left:0;"><strong>Fdo.: José Daniel Álvarez Benítez</strong></td>
                        <td style="width:210px"></td>
                        <td align="right" style=""><strong>Fdo.: </strong></td>
                    </tr>
                </table>

        </div>
    <!-- <div style="margin-top: 400px; margin-right: 300px">ESFOCC</div> <div>LA ASESORÍA</div> -->





    </page>

    <?

    $content = ob_get_clean();

        // $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'D');
        $html2pdf->Output($nombreFichero);

    ?>