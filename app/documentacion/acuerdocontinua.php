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
	$nombreFichero = "AcuerdoFormacionContinua_".$row[nombre].".pdf";    
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
            <div style="margin-top: 20px; margin-bottom: 20px;"><h3 style="text-decoration: underline; text-align:center;">ACUERDO COLABORACIÓN DE SERVICIOS</h3></div>
            <p style="text-align:center">En Santa Cruz de Tenerife, a <? echo(date("d")) ?>  de <? echo ucfirst((strftime("%B"))) ?> de <? echo(date("Y")) ?></p>
        </div>
        
        <div style="margin-top: 40px; margin-bottom: 40px;"><p style="text-align: center;"><strong>REUNIDOS:</strong></p></div>
        <p>De una parte, D. <strong>José Daniel Álvarez Benítez</strong>, con DNI 78565562T, en representación <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN, S.L.U.</strong> con C.I.F.:B76567718 y domicilio en C/El Sol 10, 38204 – San Cristóbal de La Laguna, en adelante <strong>ESFOCC</strong>.</p><br>
        <p>Y de otra parte, el D. <? echo $row[nombre] ?>, con NIF <? echo $row[nifcif] ?>, y domicilio a efectos de este compromiso, en la <? echo ( ucwords(mb_strtolower($row[domiciliofiscal])) .', '. $row[codigopostal] .', '. ucwords(mb_strtolower($row[poblacion])) . ', '. ucwords(mb_strtolower($row[provincia])).'.' ) ?></p><br>

        <div style="margin-top: 40px; margin-bottom: 20px;"><p style="text-align: center;"><strong>MANIFIESTAN:</strong></p></div>
        
            <p>I.- Que ESFOCC. es una entidad mercantil dedicada a la enseñanza, formación y cualquier tipo de docencia.</p><br>
            <p>II.- Que la ASESORÍA es una empresa dedicada a la gestión y el asesoramiento laboral de otras empresas.</p><br>
            <p>III.- Que el AGENTE es personal perteneciente a la ASESORIA y cuenta con la organización y los medios suficientes para llevar a cabo el objeto del presente acuerdo, reconociendo y manifestando expresamente  no tener ningún tipo de vinculación laboral, mercantil o de otra índole con ESFOCC.</p><br>
        <br>
        <p>A tal fin, y reconociéndose la mutua capacidad legal, libre y voluntariamente formalizan el presente <strong>ACUERDO DE PRESTACIÓN DE SERVICIOS</strong>, que se regirá con sujeción a las siguientes:</p>

  
        
    </page>

    <page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">
	
	<div style="margin-top: 40px; margin-bottom: 40px;"><p style="text-align: center;"><strong>ESTIPULACIONES:</strong></p></div>
	
	<p>	<strong>PRIMERA</strong>.- Que ESFOCC dispone de los medios necesarios, tanto técnicos como humanos, para prestar a las empresas dependientes de la ASESORÍA, servicios de asesoramiento en formación.
	</p><BR>
	<p><strong>SEGUNDA</strong>.- La ASESORÍA, dentro del desarrollo de su actividad profesional, puede necesitar para sus clientes concertar servicios que ESFOCC le puede proporcionar como Centro de Formación.
	</p><BR>
	<p><strong>TERCERA</strong>.- ESFOCC ofrecerá entre los clientes de la asesoría todos  aquellos cursos de Formación Continua, en la modalidad presencial, distancia y on-line, que las empresas necesiten con cargo a su crédito de formación, servicio que actualmente presta ESFOCC. como Centro de Formación.
 	</p><BR><BR>
	<p> Para ello, la Asesoría enviará al correo electrónico info@eduka-te.com, los documentos necesarios para la correcta gestión del curso totalmente cumplimentados, firmado y debidamente identificados, como son: 
	</p><br>
  	
	<p style="margin-left: 20px">1.	ANEXO DE ADHESION</p>
	<p style="margin-left: 20px">2.	HOJA DE MATRÍCULA</p><br>

	<p>ESFOCC., remitirá acuse de aceptación, indicando fecha prevista de inicio,  fecha de formalización del curso, crédito destinado a la formación continua e informará del crédito pendiente.</p><br>

	<p><strong>CUARTA</strong>.- ESFOCC. abonará a la ASESORIA en concepto de honorarios por la gestión de captación y administración de los cursos un <span style="font-weight: bold; text-decoration: underline;">15% del importe facturado y cobrado por cada curso</span>.</p>

	<p><strong>QUINTA</strong>.- La forma de pago de dichos honorarios será mediante <? echo $_GET[formapago] ?> con un plazo de pago de <? echo $_GET[vencimiento] ?> días fecha factura.</p><br><br>

	<p>La ASESORÍA, podrá contactar con ESFOCC., para cualquier tema referente a Formación Continua: </p><br>

	<p>Persona de Contacto: <? echo $row[contacto] ?> </p>
	<p>Tfno.: <? echo $row[telefono] ?></p>


        
    </page>

        <page backimg="./fondo_doc.jpg" backimgx="center" backimgy="bottom" backimgw="100%" backleft="60px" backright="60px" backtop="50px" backbottom="60px">
	
	
	<p style="margin-top: 60px"><strong>SEXTA</strong>.- La duración de este acuerdo de colaboración será de un año a partir de la fecha, prorrogable  por igual periodo,  sino se mediara denuncia entre las partes con dos meses de antelación.</p><br>

	<p><strong>SEPTIMA</strong>.- Los datos de carácter personal que sean recabados por ESFOCC de los clientes de la ASESORÍA, serán incorporados a un fichero automatizado, con la finalidad de realizar acuerdos de formación, pudiendo ejercitar los derechos de acceso, rectificación, oposición y cancelación de los mismos de acuerdo con la legislación vigente.</p><br>

	<p><strong>OCTAVA</strong>.-Para cualquier duda o divergencia sobre este contrato, las partes se someten al Fuero de los Tribunales de Santa Cruz de Tenerife.</p><br>

	<p>Y en prueba de total conformidad con lo que antecede, las partes firman el presente documento, por duplicado ejemplar a un solo efecto, en el lugar y fecha expresados en el encabezamiento.
	</p>

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