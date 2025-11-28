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
         //$alu = ' AND ma.id_alumno = '.$id_alu;

        $user = $_POST[user];
        $pass = $_POST[pass];

        $q = 'UPDATE mat_alu_cta_emp SET user = "'.$user.'", pass = "'.$pass.'" WHERE id_matricula = '.$id_mat.'
        AND id_alumno = '.$id_alu;
        $q = mysqli_query($link, $q);


        if ( $_POST[tipo] == 'bonificado' || $_GET[tipo] == 'bonificado')
            $tipo = ' AND ma.tipo = "" ';
        else
            $tipo = ' AND ma.tipo = "Privado" ';

        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, a.nacciondino, a.nsystem, a.courseid, ga.ngrupo,
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

    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, a.nacciondino, a.nsystem, a.courseid, ga.ngrupo,
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
        $horasmin = round($horastotales*0.3);
        $fechaini = date("d/m/Y",strtotime($row[fechaini]));
        $fechafin = date("d/m/Y",strtotime($row[fechafin]));
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $modalidad = $row[modalidad];
        $temas = $row[nacciondino];
        $evaluaciones = $row[nsystem];
        $evalfin = $row[courseid];
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
        $desde = date("d-m-Y",strtotime($row[fechaini]));
        $hastafin = date("d-m-Y",strtotime($row[fechafin]));
        $fechai = new DateTime(date("Y-m-d",strtotime($row[fechaini])));
        $fechaf = new DateTime(date("Y-m-d",strtotime($row[fechafin])));
        $diff = $fechai->diff($fechaf);
        $intervalo=($diff->days+1)/$temas;
       

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


    $nombreFichero = "pdf/GuiaDidactica_".$naccion."-".$ngrupo.".pdf";

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
ol.listareq li {
    
    padding: 10px 10px 10px 0px;
    font-size: 14px;
    text-align: justify;
}
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

ul.listareq li {
    
    padding: 10px 10px 10px 0px;
    font-size: 14px;
    text-align: justify;
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

    if ( !isset($_POST[enviomail]) && $modalidad != "Teleformación" ) { ?>
        <!--  -->
        <!--  -->
        <!-- JUSTIFICANTE DE CERTIFICADO -->
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






   <page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">
            <div>
                <img class="center" src="img/logo.png" alt=""></div>
        </page_header>

            <h1 class="tituloguia">GUÍA DIDÁCTICA</h1>
            <h4 class="datosportada">ACCIÓN/GRUPO: <? echo $naccion ?>/<? echo $ngrupo ?></h4>
            <h4 class="datosportada">DENOMINACIÓN: <? echo $denominacion ?></h4>

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
            <p>Estimado alumno/a, </p>
            <p>Desde Eduka-te Solutions queremos darte la bienvenida al curso que vas a realizar como parte de la formación programada por tu empresa.</p>
            <p>Dispones de un tutor/a, que te guiará durante todo el curso, realizando actividades de apoyo y seguimiento, dando respuesta a los problemas y las consultas.</p>
            <p>El tutor también subirá actividades y recursos adicionales en el curso, y planteará preguntas,  con el fin de enriquecer la experiencia del aprendizaje y comprobar el nivel de los contenidos adquiridos. </p>
            
            <h3 style="margin-top: 10px" class="tituloseccion">1. Datos del Curso</h3>
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
                <tr><td>Observaciones: </td><td style="font-weight: bold"><? echo $observaciones ?></td></tr>
                

            </table>
            <br>
            <br>

<h3 style="margin-top: 10px" class="tituloseccion">2. Objetivos</h3>
<p>
    <? echo nl2br($objetivos) ?>
</p>

<h3 class="tituloseccion">3. Contenidos</h3>
<p>
    <? echo nl2br($contenido) ?>
</p>
            
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

        <h3 style="margin-top: 10px" class="tituloseccion">4. Requisitos técnicos para la correcta realización del curso</h3>
        <div style="margin-top: 10px">
        <p>Nuestra Plataforma de Teleformación, basada en la plataforma Moodle, exige unos <span style="color: #87be5e;"><strong>Requisitos Técnicos</strong></span> para una visualización correcta de los cursos.</p>
        <p>A la plataforma se accede a través de un navegador web. Soporta cualquier navegador excepto versiones antiguas de Internet Explorer (IE10 o superior).</p>
        <p>Disponer de conexión a a internet y configurar el naavegador utilizado para permitir las <a href="https://autogestion.ugd.edu.ar/web/guest/wiki;jsessionid=39b6adb157f65a72356633fa8ed7?p_p_id=54_INSTANCE_9AMi&p_p_lifecycle=0&p_p_state=normal&p_p_mode=view&p_p_col_id=column-1&p_p_col_pos=1&p_p_col_count=2&_54_INSTANCE_9AMi_struts_action=%2Fwiki_display%2Fview&_54_INSTANCE_9AMi_nodeName=Ayuda+Autogestion+Docente&_54_INSTANCE_9AMi_title=Habilitar%20ventanas%20emergentes">ventanas emergentes</a></p>
        <p>En cuanto a hardware, cualquier equipo puede valer. Según el equipo puede funcionar más o menos lento, como ocurre con cualquier otro programa.</p>
        <p>Sistema responsive, adaptable al tamaño de: </p>
        <ul class="listareq">
        <li>Smartphones y Tablets (<i>iOS / Android</i>)</li>
        <li>Portátiles y Equipos de sobremesa (<i>Windows / </i><i>macOS</i><i> / Linux</i>)</li>
        </ul>
        
   
<
<p>A continuación puede descargarse estas aplicaciones, si no dispone de algunas de alguna de ellas, a través de los siguientes enlaces:</p>
<p><a href="https://www.mozilla.org/es-ES/firefox/new/" target="_blank" title="Descarga Mozilla Firefox"><img width="100" vspace="0" hspace="20" border="0" src="https://formacionuniversitaria.online/pluginfile.php/1560/mod_page/content/4/firefox.png" alt="Descarga Mozilla Firefox" title="Descarga Mozilla Firefox" style="border: 0; margin-left: 20px; margin-right: 20px; margin-top: 0px; margin-bottom: 0px;"></a>&nbsp;<a href="https://get.adobe.com/reader/?loc=es"><img src="https://formacionuniversitaria.online/pluginfile.php/1560/mod_page/content/4/acrobat_reader.png" width="100" height="auto" alt="Acrobat Reader"></a><a href="https://www.google.com/chrome/browser/desktop/index.html" target="_blank" title="Descarga Adobe PDF"><img width="100" vspace="0" hspace="20" border="0" src="https://formacionuniversitaria.online/pluginfile.php/1560/mod_page/content/4/chrome.png" alt="Descarga Adobe PDF" title="Descarga Adobe PDF" style="border: 0; margin-left: 20px; margin-right: 20px; margin-top: 0px; margin-bottom: 0px;"></a><a href="http://www.openoffice.org/es/" target="_blank" title="Descarga OpenOffice"><img width="100" vspace="0" hspace="20" border="0" src="https://formacionuniversitaria.online/pluginfile.php/1560/mod_page/content/4/openoffice.png" alt="Descarga OpenOffice" title="Descarga OpenOffice" style="border: 0; margin-left: 20px; margin-right: 20px; margin-top: 0px; margin-bottom: 0px;"></a></p>
<p></p>
</div>
           

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

            <h3 style="margin-top: 10px" class="tituloseccion">5. Metodología de aprendizaje</h3>
            <p>La metodología de formación online destaca por su flexibilidad, adaptándose el proceso de enseñanza aprendizaje totalmente a los intereses, necesidades y ritmos del alumnado. El diseño de estos cursos está adaptado a las características de los alumnos que van a recibir la formación. 
            Los materiales que utilizará son didácticos, ya que cuentan con: </p>
            
           <ul class="listareq">
            <li>Objetivos claramente formulados.</li>
            <li>Sistemas de evaluación de aprendizaje integrados en la actividad diaria.</li>
            <li>Ejemplos y consejos prácticos que conecten la actividad con realidad.</li>
            <li>Adaptados a la manera peculiar de aprender de los adultos. </li>
           </ul>
           <p>Todo depende, y en su caso más que nunca, de la constancia, el esfuerzo personal y la ilusión del alumno, que es aún más imprescindible que en la enseñanza presencial.</p><br>
           <p><strong>Tu curso se compone de <? echo $temas ?> temas y/o unidades de contenido teórico, <? echo $evaluaciones ?> evaluaciones (1 por cada tema) y <? echo $evalfin ?> evaluación/es final/es.</strong></p><br>
           <p>Para finalizar correctamente, debes:</p>
           
           <ol class="listareq">
                <li>Visualizar un mínimo del <strong>75% del temario del curso y realizar un mínimo del 75% de las evaluaciones.</strong></li>
                <li>Tiempo de dedicación al curso: recomendamos un mínimo del 30% de la duración total del curso. En el caso de esta formación, <strong>el tiempo de dedicación debe ser igual o superior a <? echo $horasmin ?> horas.</strong> </li>
                <li>Toda la formación- temario, autoevaluación, evaluación final,  se realiza a través de la plataforma.<br> NO SE CONSIDERA TELEFORMACIÓN LA MERA DESCARGA DE CONTENIDOS EN PDF.</li>
                <li>Participar activamente en las actividades propuestas por el tutor. <br> A lo largo del curso el tutor irá proponiendo actividades y tareas con el fin de ayudarte a avanzar y facilitar tu aprendizaje.</li>
                <li>Cumplimentar y enviar el cuestionario de evaluación de la calidad de las acciones formativas.</li>

            </ol>
            
            <h3 style="margin-top: 10px" class="tituloseccion">6. Evaluación</h3>
            <p>El sistema de evaluación que se va a seguir a lo largo del curso no pretende, en modo alguno, someter a presión al alumno ante las distintas pruebas propuestas.</p>
            <p>Antes, al contrario, se trata de que el propio alumno se “autoevalúe”, es decir, sea él mismo quién sepa si ha asimilado la materia estudiada o si es necesario un nuevo repaso o el esclarecimiento de algunos puntos confusos.</p>
            <p>Los <strong>cuestionarios de evaluación y evaluación final </strong> corregirán automáticamente y devolverán una <strong>puntuación máxima de 100. Se considerará superado, al alcanzar una puntuación de 50 puntos.</strong> Es importante tener en cuenta que no podrás acceder a los cuestionarios hasta que no hayas visto todos los contenidos de la unidad correspondiente.</p>
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

            <h3 style="margin-top: 10px" class="tituloseccion">7. Tutorización y seguimiento</h3>
            <p>Dispones de un tutor, que te guiará durante todo el curso, realizando actividades de apoyo y seguimiento, dando respuesta a los problemas y las consultas. 
            El tutor se comunicará contigo por las siguientes vías:</p>
            <ul class="listareq">
            <li>Mensajería interna de la plataforma.</li>
            <li>Foro.</li>
            <li>Chat.</li>
            <li>Correo electrónico.</li>
            <li>Teléfono (en caso de ser necesario)</li>
           </ul><br>
           <p>Te recomendamos que toda la comunicación con el tutor la realices de alguna de las herramientas de la plataforma: Mensajería de la plataforma, Foro, Chat. </p>

           <h3 style="margin-top: 10px" class="tituloseccion">8. Temporalización recomendada</h3>
           <table class="tablacert" style="width:100%; margin-top: 25px;" >
    
                <tr>
                    <th style="width: 5%;">Nº</th>
                    <th style="width: 45%;">CONTENIDO</th>
                    <th style="width: 25%;">DESDE</th>
                    <th style="width: 25%;">HASTA</th>
                </tr>

<? $ntemas=1;
   

    while ($ntemas<=$temas) { 
        //$hasta=date("d/m/Y",(strtotime($desde)+(86400*round($intervalo))));
        $hasta=date('d-m-Y',(strtotime($desde) + ($intervalo*86400)));?>
        <tr><td><? echo $ntemas++ ?></td><td>Unidad <? echo( $ntemas-1 ) ?></td><td><? echo $desde ?></td><td><? echo $hasta ?></td></tr>

   <? $desde=$hasta;}?>
   <tr><td><? echo $ntemas++ ?></td><td>Repaso y Evaluación final</td><td><? echo($desde) ?></td><td><? echo($hastafin) ?></td></tr>
   </table><br>
   <p><strong>·Días para realizar la formación:  <? echo ($diff->days +1)?> dias.</strong></p>
   <p><strong>·Días de dedicación para cada tema/unidad:  <? echo round($intervalo, 1) ?> dias.</strong></p>
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

            <h3 style="margin-top: 10px" class="tituloseccion">9. Técnicas Orientativas de Estudio</h3>
            <p>Estudiar a distancia es muy distinto a estudiar de una forma convencional o presencial. Se trata de diferentes opciones para seguir aprendiendo. En muchas ocasiones el aprendizaje a distancia es la única opción posible para las personas que están trabajando, y por lo tanto, no pueden asistir a las clases presenciales.</p>
            <p>Tiene que empezar por estar convencido de que se puede estudiar a distancia con tanta o mayor eficacia que en los cursos presenciales. Sin este convencimiento su rendimiento en el estudio será mucho menor.</p>
            <h4 style="margin-top: 10px" class="tituloseccion">9.1. Requisitos para el estudio eficaz</h4>
            <p>Su estudio requiere esfuerzo intelectual y determinadas técnicas para que resulte eficaz. Son necesarios determinados aspectos, a los que habitualmente no se les presta mucha atención:</p>
            <ul class="listareq">
            <li>Disponer de un lugar privado, tranquilo y silencioso.</li>
            <li>Contar con una mesa de tamaño suficiente y una silla cómoda, donde pueda disponer de todo el material necesario para su sesión de estudio.</li>
            <li>Y prestar especial atención a la orientación de la luz y a una buena temperatura ambiente.</li>
            </ul>
            <h4 style="margin-top: 10px" class="tituloseccion">9.2. Planificación del trabajo</h4>
            <p><strong>Organización del estudio:</strong></p>
            <p>Como otra actividad cualquiera, su estudio debe ir encaminado a conseguir el máximo rendimiento. Tiene que asumir desde el principio la responsabilidad de ajustar los objetivos y el ritmo de estudio, para que resulte adecuado a sus posibilidades y necesidades. Pero no basta con la planificación, falta lo más importante, cumplirlo.</p>
            <p>Las ventajas de una buena planificación, pueden ser las siguientes:</p>
           
           <ol class="listareq">
                <li>Mejor aprovechamiento del tiempo.</li>
                <li>Evitar pérdidas de tiempo.</li>
                <li>Crear hábitos.</li>
                <li>Obligar a una regularidad en el trabajo.</li>
            </ol>
            
            <p><strong>Elaboración del programa personal:</strong></p>
            <p>Para la realización del programa de estudio personal, tiene que tener en cuenta lo siguiente:</p>
           
           <ol class="listareq">
                <li>Determinar el tiempo real del que dispone.</li>
                <li>Contar con el resto de actividades y compromisos.</li>
                <li>Seleccionar los mejores momentos del día para el estudio.</li>
                <li>Asignar un tiempo de estudio igual para todos los días.</li>
           </ol>
           
           <p>Toda esta planificación vendrá determinada por:</p>
           
           <ol class="listareq">
                <li>Una planificación previa.</li>
                <li>El material didáctico de estudio.</li>
                <li>Las actividades a realizar (estudio de temas, elaboración de trabajos, realización de resúmenes y repasos, etc.) durante el curso.</li>
            </ol> 
            <h4 style="margin-top: 10px" class="tituloseccion">9.3. La sesión de estudio</h4>
            <p>Es importante que sea una actividad más dentro de las 24 horas del día. El intervalo ideal de una sesión de estudio debe ser de 1 ó 1,5 horas consecutivas, dependiendo de sus circunstancias personales y las dificultades de los temas de estudio.</p>
            <p>Los requisitos previos para una buena sesión de estudio pueden ser los siguientes:</p>
            <ul class="listareq">
            <li>Actitud: estar dispuesto para el estudio.</li>
            <li>Organización del estudio: según con el ritmo personal de trabajo que tenga.</li>
            <li>Distribución de las materias: dependiendo de la dificultad que tengan las materias a estudiar.</li>
            </ul>

            <h3 style="margin-top: 10px" class="tituloseccion">10. Sistema de Seguimiento y Apoyo al Alumno</h3>
            <p>Para el estudio de cada uno de los módulos contara con los siguientes apoyos:</p>
           
           <ul class="listareq">
                <li>Texto escrito donde se plantean y resuelven todos los problemas correspondientes a cada tema. Además, en casi todos los cursos, al final de cada capítulo encontrará una serie de ejercicios que deberá resolver antes de pasar al capítulo siguiente. Estos ejercicios van acompañados de sus correspondientes solucionarios, para que usted mismo se autoevalúe.</li>
                <li>Asimismo, para cualquier sugerencia o mejora podrá enviar un correo a la siguiente dirección:</li>
                
            </ul> 
            <p style="margin-top: 20px; font-size: 16px; font-weight: bold; text-align: center">
                <a href="mailto:soporte@eduka-te.com">soporte@eduka-te.com</a></p>
                <hr>
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
                $mail->addAttachment($nombreFichero);
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
                <b><span style="color:#87BE5E">Le agradeceríamos nos respondiese a este correo confirmando que ha recibido correctamente la GUÍA DEL ALUMNO adjunta con los DATOS DE ACCESO.</span></b><br><br><br>';

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
                <span style="color:#87BE5E"><strong>IMPORTANTE: El tiempo mínimo de conexión para obtener la calificación de APTO ha de ser, cómo mínimo, el 30% de la duración de la acción formativa.</strong></span><br><br>
                Un saludo.<br>

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
