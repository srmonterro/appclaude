<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    setlocale(LC_TIME, "es_ES");


    if ( $_GET[ph] != 0 ) {
        $preciotipo = "P(bruto)/Hora";
        $precio = $_GET[ph];
    }
    else {
        $preciotipo = "P(bruto)/Alumno";
        $precio = $_GET[pa];
    }

    $id_mat = $_GET['id_matricula'];
    $id_docente = $_GET['id_docente'];
    if ( isset($_POST[preacuerdo]) ) $id_mat = $_POST['id_matricula'];

    if (!isset($_POST['preacuerdo']) ) {

        $sql = 'SELECT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo,
            a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.diascheck, m.horariotfin, m.horariomini_nop, m.horariomfin_nop, m.horariotini_nop, m.horariotfin_nop, d.*, d.id as id_docente, md.fechadocini, md.fechadocfin, md.horariodoc, md.numhorasdoc, md.mixto, d.id as iddoc, m.fechaini_nop, m.fechafin_nop
            FROM matriculas m, acciones a, grupos_acciones ga, mat_doc md, docentes d
            WHERE m.id_accion = a.id
            AND m.id_grupo = ga.id
            AND md.id_matricula = m.id
            AND md.id_docente = d.id
            AND m.id = '.$id_mat.'
            AND d.id = '.$id_docente;
            // echo $sql;
            $sql = mysqli_query($link, $sql) or die ("error" . mysqli_error($link));

    }

    if ( isset($_POST['preacuerdo']) ) {

        $sql = 'SELECT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo,
        a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.diascheck, m.horariotfin, m.horariomini_nop, m.horariomfin_nop, m.horariotini_nop, m.horariotfin_nop, d.*, d.id as id_docente, md.fechadocini, md.fechadocfin, md.horariodoc, md.numhorasdoc, md.mixto, d.id as iddoc, m.fechaini_nop, m.fechafin_nop
        FROM matriculas m, acciones a, grupos_acciones ga, mat_doc md, docentes d
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND md.id_matricula = m.id
        AND md.id_docente = d.id
        AND m.id = '.$id_mat;
                // echo $sql;
        $sql = mysqli_query($link, $sql) or die ("error" . mysqli_error($link));

        while ( $row = mysqli_fetch_array($sql) ) {

            echo '<div class="col-md-12" style="margin-top:20px">
                <input type="hidden" id="id_matricula" value="'.$id_mat.'" />
                <div class="col-md-6">
                    <div class="form-group">
                    <label class="control-label" for="docente">Docente:</label>
                    <input value="'. $row[nombre].' '.$row[apellido]. ' '.$row[apellido2] .'" type="text" id="docente" name="docente" class="form-control" readonly/>
                    </div>
                </div>
               <div class="col-md-2">
                    <div class="form-group">
                    <label class="control-label" for="acuerdo">Acuerdo Pago:</label>
                    <input placeholder="30" value="'. $row[acuerdopago] .'" type="text" id="acuerdo-'.$row[iddoc].'" name="acuerdo" class="form-control" />
                </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label class="control-label" for="preciohora">Precio / Hora:</label>
                    <input value="'. $row[preciohora].'" type="text" id="costehora-'.$row[iddoc].'" name="costehora" class="form-control" />
                </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                    <label class="control-label" for="precioalumno">Precio / Alumno:</label>
                    <input value="'. $row[precioalumno].'" type="text" id="costealumno-'.$row[iddoc].'" name="costehora" class="form-control" />
                </div>
                </div>
                <div class="clearfix"></div>
                <div style="margin-top: 10px;"></div>
                <div class="col-md-4">
                    <div class="form-group">
                    <label class="control-label" for="email">Email:</label>
                    <input value="'. $row[email] .'" type="text" id="email" name="email" class="form-control" disabled/>
                </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                    <label class="control-label" for="telefono">Teléfono:</label>
                    <input value="'. $row[telefono] .'" type="text" id="telefono" name="telefono" class="form-control" disabled/>
                </div>
                </div>
                <div class="col-md-3" style="margin-top: 30px;">
                <label>Cláusula no competencia </label>
                <input style="margin-left:20px;" type="checkbox" id="competencia" name="competencia">
                </div>
                <div class="col-md-3 pull-right">
                <a id="acuerdocolaboracion" ph="'.$row[preciohora].'" pa="'.$row[precioalumno].'" acuerdopago="'.$row[acuerdopago].'" competencia="" docente="'.$row[id_docente].'" style="margin-top:25px;" class="pull-right btn btn-warning"><span class="glyphicon glyphicon-list-alt"></span> Ver Acuerdo</a>
                </div>
                </div>
                <div class="clearfix"></div>

            </div>';


        }


    } else {

    while ( $row = mysqli_fetch_array($sql) ) {

        $fechainio = $row[fechaini];

        if ( $row[fechadocini] != "0000-00-00" ) {
            $fechaini = formateaFecha($row[fechadocini]);
            $fechafin = formateaFecha($row[fechadocfin]);
        } else {
            $fechaini = formateaFecha($row[fechaini]);
            $fechafin = formateaFecha($row[fechafin]);
        }

        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];

        $horario = "";

        if ( $row[horariodoc] != "" )
            $horario = $row[horariodoc];
        else {
            if ( $row[horariomini] !== "" )
                $horario = $row[horariomini].' - '.$row[horariomfin];
            if ( $row[horariomini] !== "" && $row[horariotini] !== "" )
                $horario .= ' | ';
            if ( $row[horariotini] != "" )
                $horario .= $row[horariotini].' - '.$row[horariotfin];

        }
        $tipodoc = $row['tipodoc'];

        if ( $row[modalidad] == "Mixta" && $row[mixto] == 'od' ) {

            // echo "no presencial";

            $horario = "";

            if ( $row[horariodoc] != "" )
                $horario = $row[horariodoc];
            else {
                if ( $row[horariomini_nop] !== "" )
                    $horario = $row[horariomini_nop].' - '.$row[horariomfin_nop];
                if ( $row[horariomini_nop] !== "" && $row[horariotini] !== "" )
                    $horario .= ' | ';
                if ( $row[horariotini_nop] != "" )
                    $horario .= $row[horariotini_nop].' - '.$row[horariotfin_nop];
            }

            $fechaini = formateaFecha($row[fechaini_nop]);
            $fechafin = formateaFecha($row[fechafin_nop]);


        }


        $diascheck =  $row[diascheck];
        $numhorasdoc = $row[numhorasdoc];

        if ($numhorasdoc == 0) $numhorasdoc = $row[horastotales];
        if ($tipodoc == "Empresa") $numhorasdoc = $row[horastotales];

        $coma = ', ';
        for ($i=0; $i < strlen($diascheck) ; $i++) {

            if ( $i == strlen($diascheck)-1 ) $coma = '';
            if ( $diascheck[$i] == 'L' ) $dias_semana .= 'Lunes'.$coma;
            if ( $diascheck[$i] == 'M' ) $dias_semana .= 'Martes'.$coma;
            if ( $diascheck[$i] == 'X' ) $dias_semana .= 'Miércoles'.$coma;
            if ( $diascheck[$i] == 'J' ) $dias_semana .= 'Jueves'.$coma;
            if ( $diascheck[$i] == 'V' ) $dias_semana .= 'Viernes'.$coma;
            if ( $diascheck[$i] == 'S' ) $dias_semana .= 'Sábado'.$coma;
            if ( $diascheck[$i] == 'D' ) $dias_semana .= 'Domingo'.$coma;

        }

        // if ( $horariomini !== "" )
        // $horario = $horariomini.' - '.$horariomfin;
        // if ( $horariomini !== "" && $horariotini !== "" )
        // $horario .= ' | ';
        // if ( $horariotini != "" )
        // $horario .= $horariotini.' - '.$horariotfin;


        if ( $row[modalidad] == 'Presencial' ||  $row[modalidad] == 'Mixta' ) {

            $q = 'SELECT c.nombrecentro, c.direccioncentro, c.codigopostal as cpcentro, c.localidad,
            c.provincia
            FROM centros c, matriculas m
            WHERE m.centro = c.id
            AND m.id = '.$id_mat;
            $q = mysqli_query($link, $q);

            $rows = mysqli_fetch_array($q);
            $centro = 'El lugar de impartición es en la sede de '. ucwords(mb_strtolower($rows[nombrecentro],"UTF-8")).', situado en la '. ucwords(mb_strtolower($rows[direccioncentro],"UTF-8")) .', '. $rows[cpcentro] .', '. ucwords(mb_strtolower($rows[localidad],"UTF-8")) . ', '. ucwords(mb_strtolower($rows[provincia],"UTF-8")).'.';

        } else $centro = "";

            $docente = mb_strtolower($row[nombre],"UTF-8").' '.mb_strtolower($row[apellido],"UTF-8").' '.mb_strtolower($row[apellido2],"UTF-8");
            $docente = ucwords($docente);
            $nombreFichero = "Acuerdo_".$naccion."-".$ngrupo."_".str_replace(' ', '-', quitaTildes($docente)).".pdf";
    // echo $nombreFichero;
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

</style>


    <? if ( $row[situacionlaboral] == "Autonomo" || $row[situacionlaboral] == "Otro" ) {


    if ( $row[situacionlaboral] == "Otro" ) { ?>

    <!--  -->
    <!--  -->
    <!-- CERTIFICADO DOCENTES NO OBLIGATORIEDAD -->
    <!--  -->
    <!--  -->

        <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">

            <page_header height="100px">
                <div style="margin: 30px 0 30px 50px">
                    <img style="width: 200px" src="guias/img/logo.png" alt=""></div>
            </page_header>

            <div style="margin-bottom: 50px">
                <div style="margin-top: 20px;"><h2 style="text-align:center;">CERTIFICADO DOCENTES NO OBLIGATORIEDAD ALTA Y COTIZACIÓN EN RETA</h2></div>
            </div>

            <p>D. <? echo $docente ?>, con DNI <? echo $row[documento] ?>,  y domicilio en <? echo ( ucwords(mb_strtolower($row[direccion])) .', '. $row[codigopostal] .', '. ucwords(mb_strtolower($row[poblacion])) . ', '. ucwords(mb_strtolower($row[provincia])).'.' ) ?>, como docente del curso <? echo $row[denominacion] ?>, acción <? echo $naccion ?>/<? echo $ngrupo ?>.</p>

            <p style="margin-top: 80px;"><strong>CERTIFICA:</strong></p><br>
            <p>Que en la actualidad se encuentra dado de alta en el Régimen General de la Seguridad Social, y que, de forma accesoria y no habitual, imparte servicios docentes (cursos), no obteniendo por dicha actividad ingresos superiores al 75 % del Salario Mínimo Interprofesional Anual, por lo que no existe la obligación de alta y cotización en el Régimen Especial de Trabajadores Autónomos (RETA), tal y como establece la jurisprudencia del Tribunal Supremo.</p>

            <p style="margin-top: 70px;">En Santa Cruz de Tenerife, a <? $fecha = strtotime('-1 day', strtotime($fechainio)); echo date('d/m/Y', $fecha); ?></p>

            <p style="margin-top: 50px;">Fdo.: </p>

        </page>

    <? } ?>

    <!--  -->
    <!--  -->
    <!-- COMPROMISO DE COLABORACIÓN DOCENTES -->
    <!--  -->
    <!--  -->

    <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/logo.png" alt=""></div>
        </page_header>

        <div style="margin-bottom: 50px">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">COMPROMISO DE COLABORACIÓN EN LA PRESTACIÓN DE SERVICIOS DOCENTES</h2></div>
        </div>

        <p><strong>INTERVIENEN:</strong></p><BR>

        

        <p>Por una parte, el Sr/Sra. <? echo $docente ?>, con NIF <? echo $row[documento] ?>, y domicilio a efectos de este compromiso, en la <? echo ( ucwords(mb_strtolower($row[direccion])) .', '. $row[codigopostal] .', '. ucwords(mb_strtolower($row[poblacion])) . ', '. ucwords(mb_strtolower($row[provincia])).'.' ) ?></p><br>

        

        <p>Por otra parte, la Sra. Ana Isabel Alves Vieira, con NIE X7142443T, en representación de Eduka-te Solutions , S.L.U. con CIF B76757764, y domicilio social en calle José Hernández Alfonso, s/n, 38620 San Miguel de Abona, Santa Cruz de Tenerife.</p><br><br><br>

        <p><strong>EXPONEN:</strong></p><br>
        <ul style="list-style-type: upper-roman">
            <li> <p>Que Eduka-te Solutions , S.L.U. es una entidad dedicada entre otras actividades a la realización de cursos de formación continua para empresas.</p></li>
            <li> <p>Que <? echo $docente ?> posee la capacitación necesaria para impartir la docencia en formación continua para el reciclaje profesional y la propia organización para desarrollar adecuadamente los cursos de las especialidades abajo relacionadas.</p></li>
            <li> <p>Que las dos partes han llegado a un acuerdo sobre las condiciones que regularán sus relaciones en el desarrollo de acciones formativas para trabajadores en activo, según las obligaciones para entidades de gestión y entidades de formación recogidas en la ley 30/2015, por la que se regula el Sistema de Formación Profesional para el empleo en el ámbito laboral,  y suscriben un compromiso de colaboración estipulando los siguientes.</p></li>
        </ul><br>

        <p><strong>PACTOS:</strong></p><br>
        <p> <strong>I.- Objeto del compromiso</strong><br><br></p>
        <? if ( ($row[situacionlaboral] == 'Autonomo' && ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia')) && $tipodoc != 'Empresa' ){ ?>
            
            <p>El objeto del presente compromiso es la <strong>tutorización de acciones formativas en modalidad teleformación.</strong></p><br>
            <? } else {?>
        
                <p>El objeto del presente compromiso es la prestación de servicios docentes por parte del/la experto/a en la/s siguiente/es acción/es formativa/s:</p><br>

            <table class="accion">
                <tr>
                    <th>ACCION / GRUPO</th>
                    <th>DENOMINACIÓN ACCIÓN FORMATIVA</th>
                    <th>HORAS</th>
                    <? if ( ( ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia') && $row[situacionlaboral] != 'Autonomo' )
                    || ( $row[modalidad] == 'Presencial' || $row[modalidad] == 'Mixta' || $tipodoc == 'Empresa' ) ) { ?>
                    <th style="text-align:center"><? echo $preciotipo ?> <BR> Docencia <BR> <span style="text-align:center; font-size: 10px">IGIC incluído</span></th><? } ?>
                </tr>
                <tr>
                    <td style="width:10%"><? echo $naccion.'/'.$ngrupo ?></td>
                    <td style="width:55%"><? echo $row[denominacion] ?></td>
                    <td style="width:10%"><? echo $numhorasdoc.' h/curso' ?></td>
                    <? if ( ( ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia') && $row[situacionlaboral] != 'Autonomo' )
                    || ( $row[modalidad] == 'Presencial' || $row[modalidad] == 'Mixta' || $tipodoc == 'Empresa' ) ) { ?>
                    <td style="width:10%"><? echo $precio. ' €' ?></td><? } ?>
                </tr>

            </table>
            <? } ?>
    </page>

    <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/logo.png" alt=""></div>
        </page_header>
        <? if ( ($row[situacionlaboral] == 'Autonomo' && ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia')) && $tipodoc != 'Empresa' ){ ?>
            <? } else {?>
        <p><? echo $centro ?> Las fechas y los horarios previstos del curso son del <? echo $fechaini .' a '. $fechafin ?>, en horario: <? echo $dias_semana.' de '.$horario ?>.
        La calendarización y el cronograma del/los curso/s se realizarán de acuerdo con la empresa/s arriba relacionada/s y quedarán constatados en la ficha del curso.
        El inicio efectivo del curso, y la necesidad efectiva de la docencia actúan como condición suspensiva de este compromiso.
        </p><br>
        <? } ?>
        <p><strong>II.- Remuneración y forma de pago.</strong><br><br>
            <p>1.- Al precio hora pactado se le aplicará  la retención correspondiente del I.R.P.F. por rendimiento de actividad económica, en caso que la ley así lo estipule.</p>
            <p>2.- El pago se realizará en el plazo de los <? echo $_GET['acuerdo'] ?> días siguientes al mes de impartición del curso, y una vez  presentada en Eduka-te Solutions , S.L.U. toda la documentación correspondiente a las acciones formativas, junto con la correspondiente minuta del curso. </p>
            <p>3.- Cualquier cambio en las condiciones acordadas se comunicará con antelación y deberá tener la confirmación por parte de la empresa Eduka-te Solutions , S.L.U.</p>
            <p>4.- El trabajador o impartidor deberá estar dado de alta en el régimen general, o autónomo.</p>
            <br>

            <? if ( ($row[situacionlaboral] == 'Autonomo' && ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia')) && $tipodoc != 'Empresa' ){ ?>
            <table class="accion">
                <tr>
                    <td colspan="4" style="text-align:center"><strong>TABLA SALARIAL TUTORIAS ONLINE</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">TUTORIA</td>
                 
                </tr>
                <tr>
                    <td>Duración curso (horas)</td>
                    <td>€/alumno</td>
                    
                </tr>
                <tr>
                    <td>30 a 35 h</td>
                    <td>20€</td>
                    
                </tr>
                <tr>
                    <td>40 a 45 h</td>
                    <td>30€</td>
                    
                </tr>
                <tr>
                    <td>______ horas</td>
                    <td>______€</td>
                    
                </tr>
                <tr>
                <td>______ horas</td>
                    <td>______€</td>
                    
                </tr>
            </table><br>

            <p>Para cursos con una duración inferior o superior  se negociaran las condiciones según el caso.</p>  
        </p>

        <p><strong>III.- Duración del compromiso</strong><br><br>
        El objeto del presente contrato es la prestación de servicios de Tutorización de acciones formativas en modalidad de Teleformación durante el periodo del: 01/01/2023 al 31/12/2023</p><br>

        <p><strong>IV.- Obligaciones del experto/a</strong><br><br>
        <p>El experto/a <? echo $docente ?> asume las siguientes obligaciones derivadas de la actividad docente:</p>
        <p>1.- El día del inicio del curso,  dar la bienvenida a los participantes, utilizando la mensajería interna de la plataforma. </p>
        <p>2.- Realizar seguimiento semanal de los alumnos, informándolos de su progreso y motivándolos a seguir. </p>
        <p>3.- Plantear como mínimo un tema de debate o pregunta por semana que implique la participación activa de los alumnos del curso, utilizando el foro, creado en el curso. </p>
        <p>4.- Subir mínimo dos recursos adicionales durante el transcurso de la formación (documentos, páginas web, video) relacionados con el contenido del curso, con el fin de ampliar los conocimientos de los participantes, en el bloque Biblioteca de recursos.</p>
        <p>5.- Resolver las dudas que plantean los alumnos sobre el contenido del curso en un plazo máximo de 48 horas.</p>
        <p>6.- Durante la última semana de la formación, recordar a los alumnos la necesidad de cumplimentar y enviar el cuestionario de evaluación de la calidad.</p>
        <p>7.- Reflejar el seguimiento de los alumnos y toda incidencia ocurrida en la tabla de seguimiento que se le facilito y entregarlo a EDUKA-TE  SOLUTIONS, S.L.U al finalizar la acción formativa.</p>
        <p>8.- Informar de cualquier cambio y/o incidencia que se pudiera producir durante el transcurso de la acción formativa, en el mismo momento en que este se produzca.</p>
        <p>9.- El desarrollo de la las tutorías según el calendario y el horario establecido.</p>
        <p>10.- Controlar el progreso de los alumnos, velando por la correcta realización del curso.</p>
        <p>11.- Realizar todas las actuaciones de seguimiento del proceso formativo que la entidad solicitante considere oportunas.</p>
        <p>12.- Representar a la entidad solicitante ante el alumnado, la empresa participante y colaborar con toda aquella persona vinculada al SEPE y/o a FUNDAE en el caso de ser necesario.</p>
        </p><br>
        <? } else {?>
        </p>
        

<p><strong>III.- Duración del compromiso</strong><br><br>
La vigencia del presente compromiso queda limitada a la duración de la/s acción/es formativas objeto de este compromiso, siendo las mismas las comunicadas a la fundación estatal para la formación en el empleo.</p><br>

<p><strong>IV.- Obligaciones del experto/a</strong><br><br>
<p>El experto/a <? echo $docente ?> asume las siguientes obligaciones derivadas de la actividad docente:</p>
<p>1.- Deberá asegurarse que la entidad gestora recibe, dentro de plazo, la documentación original necesaria para justificar y certificar la ejecución del plan de formación.</p>
<p>2.-Viene obligado a informar de cualquier cambio y/o incidencia que se pudiera producir durante el transcurso de la acción formativa, en el mismo momento en que este se produzca.</p>
<p>3.- Facilitar  el original de los apuntes del curso a Eduka-te Solutions , S.L.U. para la realización de  los dossieres de los alumnos, con 1 mes de antelación como mínimo del inicio del curso.</p>
<p>4.- El desarrollo de la docencia según el calendario, el horario, el total de las horas y el lugar donde se haya establecido con la empresa participante o colectivo al que va dirigido el curso, que figuran detallados en la ficha del curso.</p>
<p>5.- La adaptación del nivel de los contenidos del programa a las características del alumnado y según los criterios de la empresa que ha solicitado la formación para sus profesionales, y de acuerdo con  la entidad solicitante.</p>
<p>6.- Controlar la asistencia de los alumnos, velando por la correcta cumplimentación de los formularios y justificar la suya propia mediante los documentos que entrega la entidad solicitante de acuerdo con estas finalidades.</p>
<p>7.- Informar puntualmente a la empresa Eduka-te Solutions , S.L.U. de cualquier incidencia sea cual sea su gravedad que afecte a fechas, horarios, lugar de impartición, asistencia del alumnado, visitas e inspecciones, etc…..</p>
<p>8.- Realizar todas las actuaciones de seguimiento del proceso formativo que la entidad solicitante considere oportunas.</p>
<p>9.- Representar a la entidad solicitante ante el alumnado, la empresa participante y colaborar con toda aquella persona vinculada al SEPE y/o a la Fundación Estatal para la Formación en el Empleo que debidamente acreditada se persone en el lugar de impartición durante todo el periodo de realización de la acción formativa.</p>
</p><br>
<? } ?>
        <p><strong>V.- Obligaciones de la organización.</strong><br><br>
        La empresa Eduka-te Solutions , S.L.U. se obliga a facilitar la prestación del servicio docente que desarrollará el/la experto/a y a suministrar los materiales que razonablemente sean necesarios, para el buen desarrollo de las acciones formativas.
        Se obliga a realizar el pago según las estipulaciones previstas en el apartado 2 del epígrafe II, previa entrega de la documentación requerida.</p><br>

        <? if ( $_GET[competencia] == 1 ) { ?>
        <p><strong>VI.- Cláusula de no competencia.</strong><br><br>

        El experto/a <? echo $docente ?> reconoce que el destinatario de la acción formativa a desarrollar, reseñada en el punto I, forma parte de la clientela de Eduka-te Solutions y, por lo tanto, se compromete a no prestar ningún servicio docente a dicho destinatario que suponga competencia desleal con la actividad desarrollada por Eduka-te Solutions, empresa que contrata sus servicios. Esta cláusula tendrá una vigencia de un año a contar desde el día siguiente a la finalización de la acción formativa objeto del presente contrato.
        </p><br>
        <? } ?>

        <p><strong>VII.- Notificaciones.</strong><br><br>
        Todos los avisos comunicaciones entre las partes, derivados de la realización del presente compromiso se enviarán a las direcciones que figuran en el encabezamiento.
        Cualquier cambio se deberá comunicar a la otra con antelación suficiente, siempre dentro de los plazos establecidos. Para aquellas circunstancias no previstas, se comunicará con la máxima antelación posible.
        En caso de incumplimiento por alguna de las partes de las obligaciones derivadas del presente compromiso de colaboración, y siempre que no sea posible llegar a un acuerdo amistoso, ambas partes se someten a los tribunales de la jurisdicción de San Cristóbal de la Laguna.</p><br>

        <p><strong>VIII.- LOPD.</strong><br><br>
        Información básica sobre Protección de Datos
RESPONSABLE · Eduka-te Solutions SLU| FINALIDAD DEL TRATAMIENTO · Mantener y seguir el cumplimiento de/l servicio/s
solicitado/s y/o contratado/s. | LEGITIMACIÓN · Consentimiento del interesado y/o cumplimiento de/l servicio/s y/o contrato/s |
DESTINATARIOS · No se cederán datos a terceros, salvo obligación legal | DERECHOS · Usted podrá solicitar el acceso,
rectificación y/o supresión de sus datos, así como otros derechos, como se explica en la información adicional.
Puede consultar la información adicional y detallada sobre Protección de Datos en nuestra página web: http://edukate.avisolegal.info/.</p>

        <p style="margin-top: 10px;">Y como prueba de conformidad, firman este documento, en todas sus hojas y por duplicado en S/C de Tenerife, a <?
        $fecha = strtotime('-1 day', strtotime($fechainio)); echo date('d/m/Y', $fecha);  ?></p>


        <div style="margin-top: 80px">
                <table>
                    <tr>
                    <td style="width:0px"></td>
                    <td style="width:300px"><strong><? echo $docente ?></strong></td>
                    <td style="width:180px"></td>
                    <td style="margin-right:20px">
                        <img style="margin-top: -100px; width: 160px;" src="../img/sello_edukate.png"><br>
                    </td>
                    </tr>
                    <tr><td align="right" colspan="4"><strong>EDUKA-TE SOLUTIONS, S.L.U.</strong></td></tr>
                </table>
        </div>


    </page>

    <? } else { ?>

    <!--  -->
    <!--  -->
    <!-- ANEXO AL CONTRATO LABORAL -->
    <!--  -->
    <!--  -->

    <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/logo.png" alt=""></div>
        </page_header>

        <div style="margin-bottom: 50px">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">ANEXO AL CONTRATO LABORAL DE <BR>
            <? echo $docente ?></h2></div>
        </div>

        <p><strong>INTERVIENEN:</strong></p><BR>
        <p>Por una parte, el Sr/Sra. <? echo $docente ?>, con NIF <? echo $row[documento] ?>, y domicilio a efectos de este compromiso, en la <? echo ( ucwords(mb_strtolower($row[direccion])) .', '. $row[codigopostal] .', '. ucwords(mb_strtolower($row[poblacion])) . ', '. ucwords(mb_strtolower($row[provincia])) ) ?>.</p><br>
        <p>Por otra parte, la Sra. Ana Isabel Alves Vieira, con NIE X7142443T, en representación de Eduka-te Solutions , S.L.U. con domicilio social en calle José Hernández Alfonso, s/n, 38620 San Miguel de Abona, Santa Cruz de Tenerife.</p><br>
        <p>Reunidos en la calidad en que intervienen, aseguran tener la capacidad legal necesaria para comprometerse en los términos redactados en el presente compromiso y, en virtud de esto,</p><br><br>

        <p><strong>EXPONEN:</strong></p><br>
        <ul style="list-style-type: upper-roman">
            <li> <p>Que Eduka-te Solutions , S.L.U. es una entidad dedicada entre otras actividades a la realización de cursos de formación continua para empresas.</p></li>
            <li> <p>Que <? echo $docente ?> posee la capacitación necesaria para impartir la docencia en formación continua para el reciclaje profesional y la propia organización para desarrollar adecuadamente los cursos de las especialidades abajo relacionadas.</p></li>
            <li> <p>Que las dos partes han llegado a un acuerdo sobre las condiciones que regularán la relación laboral en el desarrollo de acciones formativas reseñadas en el punto I de los PACTOS y suscriben el presente ANEXO al contrato laboral formalizado, estipulando los siguientes:</p></li>
        </ul><br>



    </page>

    <page backleft="60px" backright="60px" backtop="200px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/logo.png" alt=""></div>
        </page_header>

        <p><strong>PACTOS:</strong></p><br>
        <p> <strong>I.- Objeto del compromiso</strong><br><br>El objeto del presente compromiso es la prestación de servicios docentes por parte del/la experto/a en la/s siguiente/es acción/es formativa/s:</p><br>

            <table class="accion">
                <tr>
                    <th>ACCION / GRUPO</th>
                    <th>DENOMINACIÓN ACCIÓN FORMATIVA</th>
                    <th>HORAS</th>
                    <th style="text-align:center"><? echo $preciotipo ?> <BR> Docencia <BR> <span style="text-align:center; font-size: 10px">IGIC incluído</span></th>
                </tr>
                <tr>
                    <td style="width:10%"><? echo $naccion.'/'.$ngrupo ?></td>
                    <td style="width:55%"><? echo $row[denominacion] ?></td>
                    <td style="width:10%"><? echo $numhorasdoc.' h/curso' ?></td>
                    <td style="width:10%"><? echo $precio. ' €' ?></td>
                </tr>

            </table><br>

        <p><? echo $centro ?> Las fechas y los horarios previstos del curso son del <? echo $fechaini .' a '. $fechafin ?>, en horario: <? echo $dias_semana.' de '.$horario ?>.
        </p><br>

        <p><strong>II.- Obligaciones del experto/a</strong><br><br>
        <p>El experto/a <? echo $docente ?> asume las siguientes obligaciones derivadas de la actividad docente:</p>
        <p>1.- Deberá asegurarse que la entidad gestora recibe, dentro de plazo, la documentación original necesaria para justificar y certificar la ejecución del plan de formación.</p>
        <p>2.-Viene obligado a informar de cualquier cambio y/o incidencia que se pudiera producir durante el transcurso de la acción formativa, en el mismo momento en que este se produzca.</p>
        <p>3.- Facilitar  el original de los apuntes del curso a Eduka-te Solutions , S.L.U. para la realización de  los dossieres de los alumnos, con 1 mes de antelación como mínimo del inicio del curso.</p>
        <p>4.- El desarrollo de la docencia según el calendario, el horario, el total de las horas y el lugar donde se haya establecido con la empresa participante o colectivo al que va dirigido el curso, que figuran detallados en la ficha del curso.</p>
        <p>5.- La adaptación del nivel de los contenidos del programa a las características del alumnado y según los criterios de la empresa que ha solicitado la formación para sus profesionales, y de acuerdo con  la entidad solicitante.</p>
        <p>6.- Controlar la asistencia de los alumnos, velando por la correcta cumplimentación de los formularios y justificar la suya propia mediante los documentos que entrega la entidad solicitante de acuerdo con estas finalidades.</p>
        <p>7.- Informar puntualmente a la empresa Eduka-te Solutions , S.L.U. de cualquier incidencia sea cual sea su gravedad que afecte a fechas, horarios, lugar de impartición, asistencia del alumnado, visitas e inspecciones, etc.</p>
        <p>8.- Realizar todas las actuaciones de seguimiento del proceso formativo que la entidad solicitante considere oportunas.</p>
        <p>9.- Representar a la entidad solicitante ante el alumnado, la empresa participante y colaborar con toda aquella persona vinculada al SEPE y/o a la Fundación Estatal para la Formación en el Empleo para la Formación y el Empleo que debidamente acreditada se persone en el lugar de impartición durante todo el periodo de realización de la acción formativa.</p>
        </p><br>

        <p><strong>III.- Obligaciones de la organización.</strong><br><br>
        La empresa Eduka-te Solutions , S.L.U. se obliga a facilitar la prestación del servicio docente que desarrollará el/la experto/a y a suministrar los materiales que razonablemente sean necesarios, para el buen desarrollo de las acciones formativas.
        Se obliga a realizar el pago de la nómina correspondiente dentro de los 15 primeros días del mes siguiente al del mes en que se impartió la acción formativa reseñada en el punto I, previa entrega de la documentación requerida.</p><br>


        <? if ( $_GET[competencia] == 1 ) { ?>

        <p><strong>IV.- Cláusula de no competencia.</strong><br><br>

        El experto/a <? echo $docente ?> reconoce que el destinatario de la acción formativa a desarrollar, reseñada en el punto I, forma parte de la clientela de ESFOCC y, por lo tanto, se compromete a no prestar ningún servicio docente a dicho destinatario que suponga competencia desleal con la actividad desarrollada por ESFOCC, empresa que contrata sus servicios. Esta cláusula tendrá una vigencia de un año a contar desde el día siguiente a la finalización de la acción formativa objeto del presente contrato.
        </p>

        <? } ?>


        <p>Y como prueba de conformidad, firman este documento, en todas sus hojas y por duplicado en S/C de Tenerife, a <? $fecha = strtotime('-1 day', strtotime($fechainio)); echo date('d/m/Y', $fecha); ?></p>
        <br>
        <div style="margin-top: 120px">
                <table>
                    <tr>
                        <td style="width:25px"></td>
                        <td style="width:300px"><strong><? echo $docente ?></strong></td>
                        <td style="width:180px"></td>
                    </tr>
                </table>
                <table style="margin-top:5px; margin-left:450px;">
                    <tr>
                        <td><img style="width: 200px;" src="../img/sello_edukate"></td>
                    </tr>
                </table>
        </div>


    </page>


<? }

        $content = ob_get_clean();

        // $html2pdf->setModeDebug();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'D');
        $html2pdf->Output($nombreFichero);

    }
}
