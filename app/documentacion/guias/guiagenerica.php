<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
    //echo $baseurl;
    include_once($baseurl.'/functions/funciones.php');
    //require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    setlocale(LC_TIME, "es_ES");

    $VIN_ingles = array('1003','1018','1006','1004','1019','1037');

    $id_accion = $_GET[id];

    $sql = 'SELECT DISTINCT * FROM acciones a WHERE id = '.$id_accion;

        //echo $sql;
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
        // $docente = $row[docente];
        $alumno = $row[alumno];
        $razonsocial = $row[razonsocial];
        $url = '<a href="'.$row[url].'">'.$row[url].'</a>';
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
    color: #C80000;
    margin-top: 200px;
    text-align: center;
}

.indice {
    color: #C80000;
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
    font-size: 16px;
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
    color: #C80000;
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
    border: 1px solid #C80000;
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
    border: 1px solid #c80000;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}

.tablacert th {
    border: 2px solid #c80000;
    margin-top: 10px;
    text-align: center;
    padding: 5px;
}

</style>


    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/logo.png" alt=""></div>
        </page_header>

            <h1 class="tituloguia">GUÍA DEL ALUMNO</h1>

        <page_footer>
            <div style="left:0px; "><img style="margin-bottom: -35px; width:150px" src="img/logo.png" alt=""></div>
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

        <div class="cuadroindice">
            <h1 class="indice">
                ÍNDICE
            </h1>
            <hr>
            <ol class="listaindice">
                <li>Datos del Curso</li>
                <li>Objetivos</li>
                <li>Contenidos</li>
                <li>Metodología de la Formación E-learning y a Distancia</li>
                <li>Evaluación</li>
                <li>Técnicas Orientativas de Estudio
                    <ol>
                        <li>Requisitos para el estudio eficaz</li>
                        <li>Planificación del trabajo</li>
                        <li>La sesión de estudio</li>
                    </ol>
                </li>
                <li>Sistema de Seguimiento y Apoyo al Alumno</li>
            </ol>
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

            <h3 style="margin-top: 10px" class="tituloseccion">1. Datos del Curso</h3>
            <table class="listadatos">

                <tr><td>Denominación de la Acción Formativa:</td> <td style="font-weight: bold"><? echo $denominacion ?></td></tr>
                <? if ($id != "idspring") { ?>
                <tr><td>Acción Formativa: </td><td style="font-weight: bold"><? echo $naccion ?></td></tr>

            </table>
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

            <h3 style="" class="tituloseccion">4. Metodología de la Formación E-learning y a Distancia</h3>
            <p>El proceso de enseñanza se lleva a cabo siguiendo una metodología de estudio a distancia (distancia pura o teleformación), lo que exige conocer las indicaciones prácticas necesarias para un mejor aprovechamiento del tiempo.</p>
            <p>El rango diferencial de la educación a distancia, respecto a la presencial, es la separación física entre alumno y profesor. Este aspecto, que a simple vista puede sugerir un deterioro de la calidad de la enseñanza, queda superado con buen planteamiento metodológico en cuanto a organización de las tutorías, estructuración de los textos y el apoyo de otros medios didácticos.</p>
            <p>Nadie, hoy en día, pone en duda la efectividad de esta formación, por su carácter flexible pudiéndose adaptar a las necesidades de cada trabajador, a su tiempo y a su ritmo de aprendizaje.</p>
            <p>Todo depende, y en su caso más que nunca, de la constancia, el esfuerzo personal y la ilusión del alumno, que es aún más imprescindible que en la enseñanza presencial.</p>
            <p>Los cursos están orientados a la capacitación profesional para el trabajo y, hoy por hoy, la demanda de empleo pasa por una mayor cualificación de los trabajadores; el camino para conseguirlo es ofrecer una formación de calidad adecuada a necesidades reales de los trabajadores.</p>
            <p>Por esta razón, una preocupación central a la hora de abordar cualquier programa es que esté basado en necesidades reales de formación. Cada especialidad formativa que se desarrolla está enmarcada dentro del mercado de trabajo, el cual presenta características y problemáticas diferenciales que vienen determinadas por la situación sectorial, por la realidad laboral y por las funciones desempeñadas en el ámbito más concreto de la empresa.</p>
            <p>El diseño de estos cursos está adaptado a las características de los alumnos que van a recibir la formación.</p>
            <p>Los materiales que utilizará son didácticos, ya que cuentan con:</p>
            <ul class="listatexto">
                <li>Objetivos generales y específicos claramente formulados.</li>
                <li>Sistemas de evaluación de aprendizaje integrados en la actividad diaria. </li>
                <li>Ejemplos y consejos prácticos que conecten la actividad con realidad. </li>
                <li>Adaptados a la manera peculiar de aprender de los adultos.</li>
            </ul>
            <p>Deseamos que el curso despierte en usted, al menos, el mismo interés que ha movido a las personas del equipo que han intervenido en su elaboración.</p>


            <h3 class="tituloseccion">5. Evaluación</h3>

            <p>La evaluación pretende verificar la eficacia de la formación que a lo largo del curso va obteniendo. Pero no sólo esto, a través de la misma, se trata de establecer un nexo de unión entre los alumnos y el profesorado del curso, faceta ésta muy importante en un curso a distancia o teleformación.</p>
            <p>El sistema de evaluación que se va a seguir a lo largo del curso no pretende, en modo alguno, someter a presión al alumno ante las distintas pruebas propuestas.</p>
            <p>Antes, al contrario, se trata de que el propio alumno se “autoevalúe”, es decir, sea él mismo quién sepa si ha asimilado la materia estudiada o si es necesario un nuevo repaso o el esclarecimiento de algunos puntos confusos.</p>
            <p>Al terminar el curso recibirá un certificado de formación, documento que acredita la formación que ha recibido.</p>


            <h3 class="tituloseccion">6. Técnicas Orientativas de Estudio</h3>

            <p>Estudiar a distancia es muy distinto a estudiar de una forma convencional o presencial. Se trata de diferentes opciones para seguir aprendiendo. En muchas ocasiones el aprendizaje a distancia es la única opción posible para las personas que están trabajando, y por lo tanto, no pueden asistir a las clases presenciales.</p>
            <p>Tiene que empezar por estar convencido de que se puede estudiar a distancia con tanta o mayor eficacia que en los cursos presenciales. Sin este convencimiento su rendimiento en el estudio será mucho menor.</p>

            <h4 class="tituloseccion">6.1. Requisitos para el estudio eficaz</h4>
            <p>Su estudio requiere esfuerzo intelectual y determinadas técnicas para que resulte eficaz. Son necesarios determinados aspectos, a los que habitualmente no se les presta mucha atención:</p>

            <ul class="listatexto">
                <li>Disponer de un lugar privado, tranquilo y silencioso.</li>
                <li>Contar con la mesa suficiente y cómoda, donde pueda disponer de todo el material necesario para su sesión de estudio.</li>
                <li>Y prestar especial atención a la orientación de la luz y a una buena temperatura ambiente.</li>
            </ul>

            <h4 class="tituloseccion">6.2. Planificación del trabajo:</h4>

            <p><strong>Organización del estudio:</strong></p>
            <p>Como otra actividad cualquiera, su estudio debe ir encaminado a conseguir el máximo rendimiento. Tiene que asumir desde el principio la responsabilidad de ajustar los objetivos y el ritmo de estudio, para que resulte adecuado a sus posibilidades y necesidades. Pero no basta con la planificación, falta lo más importante, cumplirlo.</p>
            <p>Las ventajas de una buena planificación, pueden ser las siguientes:</p>

            <ul class="listatexto">
                <li>Mejor aprovechamiento del tiempo.</li>
                <li>Evitar pérdidas de tiempo.</li>
                <li>Crear hábitos.</li>
                <li>Obligar a una regularidad en el trabajo.</li>
            </ul>

            <p><strong>Elaboración del programa personal:</strong></p>
            <p>Para la realización del programa de estudio personal, tiene que tener en cuenta lo siguiente:</p>

            <ul class="listatexto">
                <li>Determinar el tiempo real del que dispone.</li>
                <li>Contar con el resto de actividades y compromisos.</li>
                <li>Seleccionar los mejores momentos del día para el estudio. </li>
                <li>Asignar un tiempo de estudio igual para todos los días.</li>
            </ul>

            <p style="margin-top: 15px">Toda esta planificación vendrá determinada por:</p>

            <ul class="listatexto">
                <li>Una planificación previa.</li>
                <li>El material didáctico de estudio.</li>
                <li>Las actividades a realizar (estudio de temas, elaboración de trabajos, realización de</li>
                <li>resúmenes y repasos, etc.) durante el curso.</li>
            </ul>

            <h4 class="tituloseccion">6.3. La sesión de estudio</h4>
            <p>Es importante que sea una actividad más dentro de las 24 horas del día. El intervalo ideal de una sesión de estudio debe ser de 1 ó 1,5 horas consecutivas, dependiendo de sus circunstancias personales y las dificultades de los temas de estudio.</p>
            <p>Los requisitos previos para una buena sesión de estudio pueden ser los siguientes:</p>

            <ul class="listatexto">
                <li>Actitud: estar dispuesto para el estudio.</li>
                <li>Organización del estudio: según con el ritmo personal de trabajo que tenga.</li>
                <li>Distribución de las materias: dependiendo de la dificultad que tengan las materias a estudiar.</li>
            </ul>


            <h3 class="tituloseccion">7. Sistema de Seguimiento y Apoyo al Alumno</h3>

            <p>Para el estudio de cada uno de los módulos contara con los siguientes apoyos:</p>
            <ul class="listatexto">
                <li>Texto escrito donde se plantean y resuelven todos los problemas correspondientes a cada tema. Además, en casi todos los cursos, al final de cada capítulo encontrará una serie de ejercicios que deberá resolver antes de pasar al capítulo siguiente. Estos ejercicios van acompañados de sus correspondientes solucionarios, para que usted mismo se autoevalúe.</li>
                <li>Asimismo, para cualquier sugerencia o mejora podrá enviar un correo a la siguiente dirección:</li>
            </ul>
            <p style="margin-top: 20px; font-size: 16px; font-weight: bold; text-align: center">
                <a href="mailto:sugerencias@eduka-te.com">sugerencias@eduka-te.com</a></p>
            <hr>

    </page>


    <? }


    $content = ob_get_clean();

        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        //$html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // $html2pdf->Output($nombreFichero,'F');
        $html2pdf->Output($nombreFichero);


