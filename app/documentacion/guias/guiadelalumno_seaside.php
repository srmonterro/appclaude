<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    setlocale(LC_TIME, "es_ES");

    $VIN_ingles = array('1003','1018','1006','1004','1019','1037');

    if ( !isset($_POST[enviomail]) )
        $id_mat = $_GET['id_matricula'];
    else
        $id_mat = $_POST['id_matricula'];

    if (isset($_POST[id_alumno]) || isset($_GET[id_alumno])) {

        if (isset($_POST[id_alumno]))
            $id_alu = $_POST['id_alumno'];
        else
            $id_alu = $_GET['id_alumno'];
        // $alu = ' AND ma.id_alumno = '.$id_alu;

        $user = $_POST[user];
        $pass = $_POST[pass];

        $q = 'UPDATE mat_alu_cta_emp SET user = "'.$user.'", pass = "'.$pass.'" WHERE id_matricula = '.$id_mat.'
        AND id_alumno = '.$id_alu;
        $q = mysqli_query($link, $q);


        if ( $_POST[tipo] == 'bonificado' || $_GET[tipo] == 'bonificado')
            $tipo = ' AND ma.tipo = "" ';
        else
            $tipo = ' AND ma.tipo = "Privado" ';

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo,
        a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin,
        CONCAT(d.nombre," ",d.apellido," ",d.apellido2) as docente, d.email as emailtutor, a.url, ma.user, ma.pass, al.documento as documentoal,
        CONCAT(al.nombre," ", al.apellido," ", al.apellido2) as alumno, e.razonsocial, a.objetivos, al.email as emailalumno, d.telefono, m.diascheck, e.agente, d.*, m.observaciones
        FROM matriculas m, acciones a, grupos_acciones ga, mat_doc md,
        docentes d, mat_alu_cta_emp ma, alumnos al, empresas e
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND md.id_matricula = m.id
        AND md.id_docente = d.id
        AND ma.id_matricula = m.id
        AND ma.id_alumno = al.id
        AND ma.id_empresa = e.id
        '.$tipo.'
        AND ma.id_alumno = '.$id_alu.'
        AND m.id ='.$id_mat;

    } else {

    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo,
        a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin,
        CONCAT(d.nombre," ",d.apellido," ",d.apellido2) as docente, d.email as emailtutor, a.url, ma.user, ma.pass, al.documento as documentoal,
        CONCAT(al.nombre," ", al.apellido," ", al.apellido2) as alumno, e.razonsocial, a.objetivos, al.email as emailalumno, d.telefono, m.diascheck, e.agente, d.*, m.observaciones
        FROM matriculas m, acciones a, grupos_acciones ga, mat_doc md,
        docentes d, mat_alu_cta_emp ma, alumnos al, empresas e
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND md.id_matricula = m.id
        AND md.id_docente = d.id
        AND ma.id_matricula = m.id
        AND ma.id_alumno = al.id
        AND ma.id_empresa = e.id
        AND m.id ='.$id_mat;

    }
        // echo $sql;
    $sql = mysqli_query($link, $sql) or die ("error");
    while ($row = mysqli_fetch_array($sql)) {
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $fechaini = date("d/m/Y",strtotime($row[fechaini]));
        $fechafin = date("d/m/Y",strtotime($row[fechafin]));
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $modalidad = $row[modalidad];
        $contenido = $row[contenido];
        $observaciones = $row[observaciones];
        // $docente = $row[docente];
        $alumno = $row[alumno];
        $razonsocial = $row[razonsocial];
        $url = '<a href="'.$row[url].'">'.$row[url].'</a>';
        $url2 =$row[url];
        $emailtutor = $row[emailtutor];
        $user = $row[user];
        $pass = $row[pass];
        $objetivos = $row[objetivos];
        $emailalumno = $row[emailalumno];
        $tlftutor = $row[telefono];
        $documento = $row[documentoal];
        $diascheck = $row[diascheck];
        $agente = $row[agente];

        if ( $row[tipodoc] == "Empresa" ) {
            $docente = $row[nombredocente]. ' '.$row[apellidodocente].' '.$row[apellido2docente];
        } else {
            $docente = $row[docente];
        }



    }

    if ( isset($_POST[id_alumno]) || isset($_GET[id_alumno]) ) {

        if ( isset($_POST[user]) )
            $user = $_POST[user];
        else
            $user = $_GET[user];

        if ( isset($_POST[pass]) )
            $pass = $_POST[pass];
        else
            $pass = $_GET[pass];

    }

    $guion = ' - ';
    if ( $diascheck == "LMXJV" )
        $dias = "Lunes a Viernes";
    else {
        for ($i=0; $i < strlen($diascheck); $i++) {

            if ( $i == strlen($diascheck)-1 )
                $guion = '';
            $dias .= $diascheck[$i].$guion;
        }
    }

    if ( $horariomini !== "" )
        $horario = $horariomini.' - '.$horariomfin;
    if ( $horariomini !== "" && $horariotini !== "" )
        $horario .= ' | ';
    if ( $horariotini != "" )
        $horario .= $horariotini.' - '.$horariotfin;


    $nombreFichero = "pdf/GuiaDelAlumno_".$naccion."-".$ngrupo."_".str_replace(' ', '-', $alumno).".pdf";

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


.encabezado {
    margin: auto;
}

.tituloguia {
    color: #87BE5E;
    margin-top: 200px;
    text-align: center;
}

.indice {
    color: #87BE5E;
    border-bottom: 1px solid #ccc;
}

.cuadroindice {
    width: 490px;
    margin: 120px 115px;
}

ol { list-style-type: decimal }
ol.listaindice li {
    font-weight: bold;
    padding: 10px 10px 10px 0px;
    font-size: 14px;
    text-align: justify;
}

ol.listaindice li ol li {
    padding-bottom: 0px;
    font-weight: normal;
}

ol.listaindice li ol li:first {
    padding-top: 5px;
}

.listadatos { width: 100%; border-collapse: collapse; }
.listadatos td {
    border-bottom: 1px solid #ccc;
    width: 50%;
    padding: 5px;
    font-size: 14px;
}
.listadatos td:nth-child(odd) {
    font-weight: bold;
}


.datosportada {
    margin-top: 20px;
    text-align: center;
}

.tituloseccion {
    page-break-before: always;
    color: #87BE5E;
    margin: 15px 0 10px 0;
}

p {
    font-size: 15px;
    line-height: 1.3;
    margin-bottom: 10px;
}

.listatexto {
    list-style-type: disc;
}

.listatexto li {
    padding: 3px;
    font-size: 15px;
}

.circulo {
    right: 5px;
    text-align: center;
    margin: 0 10px 10px 0;
    position: relative;
    display: inline-block;
    width: 30px;
    height: 30px;
    /*padding: 5px;*/
    border-radius: 15px;
    border: 1px solid #87BE5E;
}

.pie {
    color: black;
    font-weight: bold;
    margin-top: 7px;
}

/*th, td { padding: 5px; }
table { font-size: 12px; border-collapse: collapse; }
td {border: 1px solid #FF0000; height: 25px;}
th {border: 3px solid #FF0000}
*/
table.sinborde { margin-bottom: 10px; }
table.sinborde td { border: 0px; }

table.bordegris td { border: 1px solid #ccc; padding-top: 5px; }
table.bordegris th { border: 1px solid #ccc}

table.bordegris { border: 3px solid #ccc; color: #1B0085; font-weight: bold;}

.controlasist {
    color: #1B0085;
}


.tablacert {
    border-collapse: collapse;
}

.tablacert td {
    border: 1px solid #87BE5E;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}

.tablacert th {
    border: 2px solid #87BE5E;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}
.center {
  display: block;
  margin-top: 30px;
  margin-left: 170px;
  margin-right: auto;
  width: 50%;
}

</style>


<?



    if ( ($modalidad == 'Teleformación' || $modalidad == 'A Distancia') && $id != "idspring" ) {

    if ( !isset($_POST[enviomail]) ) { ?>
    <!--  -->
    <!--  -->
    <!-- JUSTIFICANTE DE CERTIFICADO -->
    <!--  -->
    <!--  -->

    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/logo.png" alt=""></div>
        </page_header>

        <div style="">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">JUSTIFICANTE ENTREGA DE CERTIFICADO</h2></div>
        </div>


        <table class="sinborde" style="margin-top: 40px; width: 100%">

            <tr>
                <td style="width:70%">DENOMINACIÓN A.F.: <strong><? echo ($denominacion) ?></strong></td><td style="width:15%">A.F.: <strong><? echo ($naccion) ?></strong></td><td style="width:15%">GRUPO: <strong><? echo ($ngrupo) ?></strong></td>
            </tr>

        </table>

        <table class="sinborde" style="margin-top: 15px; width:100%;">
            <tr>
                <td style="width:33.33%">FECHA INICIO: <strong><? echo($fechaini); ?></strong></td><td style="width:33.33%">FECHA FIN: <strong><? echo($fechafin); ?></strong></td><td style="width:33.33%">FECHA: <strong><? echo($fechafin) ?></strong></td>
            </tr>
        </table>
        <table class="sinborde" style="margin-top: 15px; width:100%;">
            <tr>
                <td>EMPRESA: <strong><? echo $razonsocial; ?></strong></td>
            </tr>
        </table>

        <table class="tablacert" style="width:100%; margin-top: 25px;" >

            <tr>
                <th style="width: 5%;">Nº</th>
                <th style="width: 45%;">NOMBRE</th>
                <th style="width: 25%;">NIF</th>
                <th style="width: 25%;">FIRMA</th>
            </tr>

            <?

            $i = 1; ?>
            <tr><td><? echo $i++ ?></td><td><? echo( $alumno ) ?></td><td><? echo($documento) ?></td><td></td></tr>

        </table>

    </page>

    <? } ?>


    <? if ($modalidad == 'A Distancia' && $id != "idspring") { ?>
    <!--  -->
    <!-- PRIMERA HOJA. RETORNO. -->
    <!--  -->

    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/logo.png" alt=""></div>
        </page_header>

        <h4 class="datosportada">EMPRESA: <? echo $razonsocial ?></h4>
        <h4 class="datosportada">ALUMNO: <? echo $alumno ?></h4>

        <h3 style="margin-top: 30px" class="tituloseccion">1. Datos del Curso</h3>
            <table class="listadatos">

                <tr><td>Denominación de la Acción Formativa:</td> <td style="font-weight: bold"><? echo $denominacion ?></td></tr>
                <tr><td>Acción Formativa: </td><td style="font-weight: bold"><? echo $naccion ?></td></tr>
                <tr><td>Grupo: </td><td style="font-weight: bold"><? echo $ngrupo ?></td></tr>
                <tr><td>Modalidad: </td><td style="font-weight: bold"><? echo $modalidad ?></td></tr>
                <tr><td>Fecha de inicio: </td><td style="font-weight: bold"><? echo $fechaini ?></td></tr>
                <tr><td>Fecha de finalización: </td><td style="font-weight: bold"><? echo $fechafin ?></td></tr>
                <tr><td>Número de horas: </td><td style="font-weight: bold"><? echo $horastotales ?></td></tr>
                <tr><td>Datos del tutor: </td><td style="font-weight: bold"><? echo $docente ?></td></tr>
                <tr><td>Email tutor: </td><td style="font-weight: bold"><? echo $emailtutor ?></td></tr>
                <tr><td>Teléfono: </td><td style="font-weight: bold"><? echo $tlftutor ?></td></tr>
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold"><? echo $dias .' de '. $horario ?></td></tr>

        </table>
        <br>

        <h3 class="tituloseccion">4. Material entregado</h3>
            <ul class="listatexto">
                <li>Manual de la especialidad</li>
                <li>Guía didáctica</li>
                <li>Cuestionario de calidad</li>
                <li>Bloc de notas</li>
                <li>Cd (en los cursos que corresponda)</li>
                <li>Bolígrafo</li>
                <li>Carpeta</li>
                <li>Maletín</li>
            </ul>


        <p style="margin: 60px 0 30px 0">Recibí: <div style="display: inline-block; margin: 15px 0 0 10px; border-bottom: 1px solid #000; width: 600px"></div></p><br>
        <p style="text-align: center">Firma</p>

    </page>

    <page></page>

    <? } ?>

   <page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">
            <div>
                <img class="center" src="img/logo.png" alt=""></div>
        </page_header>

            <h1 class="tituloguia">CLAVES DE ACCESO</h1>
            <h4 class="datosportada"> <? echo $denominacion ?></h4>
            <h4 class="datosportada">ALUMNO: <? echo $alumno ?></h4>

        <page_footer>
            
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>
    </page>



     <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/logo.png" alt=""></div>
        </page_header>
        <page_footer>
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>
            <p>Estimado alumn@, </p>
            <p>Desde Eduka-te Solutions queremos darte la bienvenida al curso que vas a realizar como parte de la formación programada por tu empresa.</p>
            <p>Dispones de un tutor, que te guiará durante todo el curso, realizando actividades de apoyo y seguimiento, dando respuesta a los problemas y las consultas.</p>
            <p>El tutor también subirá actividades y recursos adicionales en el curso, y planteara preguntas,  con el fin de enriquecer la experiencia del aprendizaje y comprobar el nivel de los contenidos adquiridos. </p>
            <p>En la plataforma encontrarás la guía didáctica de tu curso, como también la guía de la plataforma, que te ayudara a conocer todas las utilidades del campus virtual.</p>
            <p>A continuación te facilitamos tus claves de acceso y los datos del tutor:</p>
            <h3 style="margin-top: 10px" class="tituloseccion">Datos del Curso</h3>
            <table class="listadatos">

                <tr><td>Denominación de la Acción Formativa:</td> <td style="font-weight: bold"><? echo $denominacion ?></td></tr>
                <? if ($id != "idspring") { ?>
                <tr><td>Acción Formativa: </td><td style="font-weight: bold"><? echo $naccion ?></td></tr>
                <tr><td>Grupo: </td><td style="font-weight: bold"><? echo $ngrupo ?></td></tr>
                <tr><td>Modalidad: </td><td style="font-weight: bold"><? echo $modalidad ?></td></tr><? } ?>
                <tr><td>Fecha de inicio: </td><td style="font-weight: bold"><? echo $fechaini ?></td></tr>
                <tr><td>Fecha de finalización: </td><td style="font-weight: bold"><? echo $fechafin ?></td></tr>
                <tr><td>Número de horas: </td><td style="font-weight: bold"><? echo $horastotales ?></td></tr>
                <? if ($id != "idspring") { ?>
                <tr><td>Datos del tutor: </td><td style="font-weight: bold"><? echo $docente ?></td></tr>
                <tr><td>Email tutor: </td><td style="font-weight: bold"><? echo $emailtutor ?></td></tr>
                <tr><td>Teléfono: </td><td style="font-weight: bold"><? echo $tlftutor ?></td></tr>
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold"><? echo $dias .' de '. $horario ?></td></tr>
                <tr><td>Observaciones: </td><td style="font-weight: bold"><? echo $observaciones ?></td></tr>
                <? if ($modalidad == "Teleformación") { ?>
                <tr><td>Enlace: </td><td style="font-weight: bold"><? echo $url ?></td></tr>
                <tr><td>Usuario: </td><td style="font-weight: bold">
                    <? echo $user ?>
                </td></tr>
                <tr><td>Contraseña: </td><td style="font-weight: bold"><? echo $pass ?></td></tr><? } } ?>

            </table>
            <br>

            
    </page>

    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/logo.png" alt=""></div>
        </page_header>
        <page_footer>
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>

            <h3 style="margin-top: 10px" class="tituloseccion">Requisitos para la correcta realización del curso</h3>
           
            <ol class="listaindice">
                <li>Visualizar un mínimo del 75% del temario del curso. Toda la formación- temario, autoevaluación, evaluación final,  se realiza a través de la plataforma.<br> NO SE CONSIDERA TELEFORMACIÓN LA MERA DESCARGA DE CONTENIDOS EN PDF. </li>
                <li>Participar activamente en las actividades propuestas por el tutor.</li>
                <li>Superar las pruebas de evaluación del curso (obtener puntuación igual o superior al 50 puntos).</li>
                <li>Tiempo de dedicación al curso: mínimo 50% de la duración total del curso (17 horas y 30 minutos). </li>
                <li>Cumplimentar y enviar el cuestionario de evaluación de la calidad de las acciones formativas.</li>
            </ol>
            
            <p style="margin-top: 40px;text-align: center; font-size: 16px; font-weight: bold;color: #87BE5E">Para cualquier aclaración, sugerencia o mejora podrá enviar un correo a la siguiente dirección:</p>
            <p style="margin-top: 20px; font-size: 16px; font-weight: bold; text-align: center">
                <a href="mailto:soporte@eduka-te.com">soporte@eduka-te.com</a></p>

    </page>


    <? }


    $content = ob_get_clean();

        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        $html2pdf->Output($nombreFichero,'F');

        if ( !isset($_POST[enviomail]) )

            $html2pdf->Output($nombreFichero);

        else {

            $cc = "-";
            $para = $emailalumno;
            $mail = new PHPMailer;
            $mail->From = 'soporte@eduka-te.com';
            $mail->FromName = 'SOPORTE EDUKA-TE SOLUTIONS';
            $mail->addAddress($emailalumno);
            $mail->addBCC('soporte@eduka-te.com');               // Name is optional
            $mail->addReplyTo('soporte@eduka-te.com');
           
            

            // if ( in_array($naccion, $VIN_ingles) )
            //     $mail->addCC('ivan.cabrera@eduka-te.com');
            // $mail->addCC('ivan.cabrera@eduka-te.com');

            if ( $agente == "Isabel" )
                //$mail->addBCC('ivan.cabrera@eduka-te.com');
            if ( $naccion != '1008' ) {
                // $mail->addBCC($emailtutor); PENDIENTE!!
                //$mail->addAttachment($nombreFichero);
            }


            //$mail->ConfirmReadingTo('icabrera@eduka-te.com');
            // $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
                              // Add attachments


            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
            $mail->isHTML(true);                                    // Set email format to HTML

            if ( $naccion != '1008' ) {
                $mail->addAttachment($nombreFichero);
                $titulo = $mail->Subject = 'Claves de acceso acceso acción formativa '.$naccion.'.'.$ngrupo.' - '.$alumno;
                $mail->Body = 'Estimado alumn@, <br><br>
                Adjunto a este correo le enviamos las claves de acceso al curso online que comenzará en breve con nosotros.<br><br>
                *Si estas copiando y pegando tus claves para acceder, asegúrate que copias solo los caracteres de  usuario y contraseña, y no los espacios en blanco, si las escribes a mano, respeta las mayúsculas y las minúsculas.<br><br>
                <b><span style="color:#87BE5E">Le agradeceríamos nos respondiese a este correo confirmando que ha recibido correctamente la GUÍA DEL ALUMNO adjunta con los DATOS DE ACCESO.</span></b><br><br><br>
                <h3><span><strong>IMPORTANTE - REQUISITOS PARA LA CORRECTA REALIZACIÓN DEL CURSO:</strong></span><br>
                <ul>
                 <li>Visualizar un mínimo del 75% del temario del curso. Toda la formación- temario, autoevaluación, evaluación final,  se realiza a través de la plataforma.<br> NO SE CONSIDERA TELEFORMACIÓN LA MERA DESCARGA DE CONTENIDOS EN PDF. </li>
                <li>Participar activamente en las actividades propuestas por el tutor.</li>
                <li>Superar las pruebas de evaluación del curso (obtener puntuación igual o superior al 50 puntos).</li>
                <li>Tiempo de dedicación al curso: mínimo 50% de la duración total del curso (17 horas y 30 minutos). </li>
                <li>Cumplimentar y enviar el cuestionario de evaluación de la calidad de las acciones formativas.</li>
                </ul></h3><br><br>';
            if ($url == "http://campus2.eduka-te.com/") {
                    $mail->Body   .= '<b><span style="color:#87BE5E">Importante:</span></b><br><br>
                    Si solo se dispone  de tablet o teléfono móvil, descargando esta App 
                https://download.moodle.org/mobile/    podrán  visualizar el contenido del temario correctamente. <br><br>
                Si se elige esta opción, antes de introducir las claves, la aplicación solicitará la 
                URL:  https://www.trainingeduka-te.com/ y a continuación, el usuario y contraseña de los que ya disponéis.<br><br>';
                }
                $mail->Body .= '
                <h3 style="margin-top: 15px" class="tituloseccion">Datos del Curso</h3>
                <table class="listadatos">
                <tr><td>Denominación de la Acción Formativa:</td> <td style="font-weight: bold">'. $denominacion .'</td></tr>
                <tr><td>Acción Formativa: </td><td style="font-weight: bold">'. $naccion .'</td></tr>
                <tr><td>Grupo: </td><td style="font-weight: bold">'. $ngrupo .'</td></tr>
                <tr><td>Modalidad: </td><td style="font-weight: bold">'. $modalidad .'</td></tr><? } ?>
                <tr><td>Fecha de inicio: </td><td style="font-weight: bold">'. $fechaini .'</td></tr>
                <tr><td>Fecha de finalización: </td><td style="font-weight: bold">'. $fechafin .'</td></tr>
                <tr><td>Número de horas: </td><td style="font-weight: bold">'. $horastotales .'</td></tr>
                <tr><td>Datos del tutor: </td><td style="font-weight: bold">'. $docente .'</td></tr>
                <tr><td>Email tutor: </td><td style="font-weight: bold">'. $emailtutor .'</td></tr>
                <tr><td>Teléfono: </td><td style="font-weight: bold">'. $tlftutor .'</td></tr>
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold">'. $dias .' de '. $horario .'</td></tr>';

                if ($modalidad == "Teleformación") {
                    $mail->Body    .= '<tr><td>Enlace: </td><td style="font-weight: bold">'. $url .'</td></tr>
                    <tr><td>Usuario: </td><td style="font-weight: bold">'. $user .'</td></tr>
                    <tr><td>Contraseña: </td><td style="font-weight: bold">'. $pass .'</td></tr>';
                }

                $mail->Body    .= '</table>
                
                <br>Un saludo.<br>

                -------------- <br>
                <img src="http://gestion.eduka-te.com/app/documentacion/guias/img/footermailgesti.png"><br>
                 <span style="font-size: 10px">Eduka-te Solutions<br>
                Calle Londres, 11, 38660 Costa Adeje, Santa Cruz de Tenerife<br><br>
               La información contenida en este mensaje y/o archivo(s) adjunto(s) es confidencial/privilegiada y está destinada a ser leída sólo por la(s) persona(s) a la(s) que va dirigida.<br>

                AVISO LEGAL y PROTECCIÓN DE DATOS en <a href="http://eduka-te.avisolegal.info/" style="box-sizing: border-box; background-color: transparent; color: rgb(0, 160, 205); text-decoration: none" target="_blank" rel="noreferrer"><strong style="box-sizing: border-box; font-weight: 700"><em style="box-sizing: border-box">PINCHE AQUÍ</em></strong></a></span>';

            } else {

                $titulo = $mail->Subject = 'Test de Autoevaluación acción formativa '.$naccion.'.'.$ngrupo.' - '.$alumno;
                $mail->Body    = 'Buenos días, <br><br>


                Nos ponemos en contacto contigo para comunicarte que hemos procedido a activar las claves que tienes asignadas para que puedas acceder a la acción formativa:<br><br>

                Prueba de nivel - Idioma Inglés<br><br>

                La dirección web de nuestro campus virtual es:<br><br>

                <a href=""></a><br><br>


                Claves de acceso<br><br>';

                $mail->Body .= 'Usuario: '.$user."<br>";
                $mail->Body .= 'Contraseña: '.$pass."<br><br>";

                $mail->Body .= 'El Test de Autoevaluación está diseñado para ayudar al alumno/a en la elección del nivel al que puede acceder. Los resultados de este test son orientativos y NO conforman una Prueba de Clasificación.<br><br>

                Realización del Test de Autoevaluación<br><br>

                    - Permítase un máximo de 45 minutos para realizar el Test.<br>
                    - Elija sólo una respuesta correcta para cada pregunta.<br>
                    - No debe contestar al azar. Esto permitirá que la prueba sea lo más fiable posible.<br>
                    - Adjudicación de Nivel después de realizar el Test de Autoevaluación<br><br>


                RESULTADOS NIVEL AL QUE PUEDE OPTAR<br><br>

                    - Entre 0 y 10 preguntas correctas Principiante A1<br>
                    - Entre 11 y 21 preguntas correctas Elemental A2<br>
                    - Entre 22 y 30 preguntas correctas Preintermedio B1<br><br>


                Agradeciéndote tu interés por nuestras actividades formativas, reciba un cordial saludo.<br>

                -------------- <br>
                ';

            }

            $mail->CharSet = 'UTF-8';

            if(!$mail->send()) {
               echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
               exit;
            } else {
                echo "<pre>";
                print_r($mail);
                echo "</pre>";
                registrarMailBD($para, $titulo, $cc, $link);
                echo 'Email enviado con éxito.';
                
                // include('../../gestibot.php');
            }

        }

    // }
    // catch(HTML2PDF_exception $e) {
    //     echo $e;
    //     exit;
    // }
