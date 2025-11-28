<?    

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    setlocale(LC_TIME, "es_ES");

    if ( !isset($_POST[enviomail]) )
        $id_mat = $_GET['id_matricula'];
    else
        $id_mat = $_POST['id_matricula'];

    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, ga.ngrupo, 
        a.contenido, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, 
        CONCAT(d.nombre," ",d.apellido," ",d.apellido2) as docente, d.email as emailtutor, a.url, ma.user, ma.pass, al.documento,
        CONCAT(al.nombre," ", al.apellido," ", al.apellido2) as alumno, e.razonsocial, a.objetivos, al.email as emailalumno, d.telefono
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
        $docente = $row[docente];
        $alumno = $row[alumno];
        $razonsocial = $row[razonsocial];
        $url = $row[url];
        $emailtutor = $row[emailtutor];
        $user = $row[user];
        $pass = $row[pass];
        $objetivos = $row[objetivos];
        $emailalumno = $row[emailalumno];
        $tlftutor = $row[telefono];
        $documento = $row[documento];
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


<? 
    if ( $modalidad == 'Teleformación' ) { 

    if ( !isset($_POST[enviomail]) ) { ?>

    <!--  -->
    <!--  -->
    <!-- JUSTIFICANTE DE CERTIFICADO -->
    <!--  -->
    <!--  -->
    
    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
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
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
        </page_header>

            <h1 class="tituloguia">GUÍA DEL ALUMNO</h1>
            <h4 class="datosportada">EMPRESA: <? echo $razonsocial ?></h4>
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
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
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
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
        </page_header>   
        <page_footer>
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>
            
            
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
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold"><? echo "Lunes a Viernes de ". $horario ?></td></tr>
                <tr><td>Enlace: </td><td style="font-weight: bold"><? echo $url ?></td></tr>
                <tr><td>Usuario: </td><td style="font-weight: bold"><? echo $user ?></td></tr>
                <tr><td>Contraseña: </td><td style="font-weight: bold"><? echo $pass ?></td></tr>

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
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
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


    <!--  -->
    <!--  -->
    <!--  -->
    <!-- A DISTANCIA -->
    <!--  -->
    <!--  -->
    <!--  -->


    <? } else { ?> 



    <!--  -->
    <!-- PRIMERA HOJA. RETORNO. -->
    <!--  -->

    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
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
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold"><? echo "Lunes a Viernes de ". $horario ?></td></tr>

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
    

    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
        </page_header>

            <h1 class="tituloguia">GUÍA DEL ALUMNO</h1>
            <h4 class="datosportada">EMPRESA: <? echo $razonsocial ?></h4>
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
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
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
                <li>Material entregado</li>
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
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
        </page_header>   
        <page_footer>
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>
            
            
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
                <tr><td>Horario de Tutorías: </td><td style="font-weight: bold"><? echo "Lunes a Viernes de ". $horario ?></td></tr>

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
        
    </page>


    <page backleft="40px" backright="40px" backtop="140px" backbottom="60px">
        <page_header height="100px">        
            <div style="margin: 30px 0 0 30px">
                <img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
        </page_header>   
        <page_footer>
            <div class="circulo">
                <span class="pie">[[page_cu]]</span>
            </div>
        </page_footer>

            
            <h3 style="" class="tituloseccion">5. Metodología de la Formación E-learning y a Distancia</h3>
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
            

            <h3 class="tituloseccion">6. Evaluación</h3>
            <p>La evaluación pretende verificar la eficacia de la formación que a lo largo del curso va obteniendo. Pero no sólo esto, a través de la misma, se trata de establecer un nexo de unión entre los alumnos y el profesorado del curso, faceta ésta muy importante en un curso a distancia o teleformación. </p>
            <p>El sistema de evaluación que se va a seguir a lo largo del curso no pretende, en modo alguno, someter a presión al alumno ante las distintas pruebas propuestas.</p>
            <p>Antes, al contrario, se trata de que el propio alumno se “autoevalúe”, es decir, sea él mismo quién sepa si ha asimilado la materia estudiada o si es necesario un nuevo repaso o el esclarecimiento de algunos puntos confusos.</p>
            <p>Al final de cada libro encontrará una prueba de evaluación final. Esta prueba que no lleva solucionario, debe enviarla, una vez cumplimentada, a nuestra central, es decir debe introducirla en los sobres que le adjuntamos y depositarla en un buzón, sin franquear, ya que con los gastos de franqueo correrá el centro, pues los sobres llevan la dirección con franqueo en destino. <strong>NO OLVIDE FIRMAR SUS PRUEBAS DE EVALUACIÓN</strong>.</p>
            <p>Al terminar el curso recibirá un certificado de formación, documento que acredita la formación que ha recibido. </p>

            
            <div style="margin: 15px 0 25px 0; padding: 15px; border: 2px color #c80000">
                <p><strong>Muy importante:</strong></p>
                <p><strong>Las pruebas de evaluación y el cuestionario de calidad deberán remitirlos al centro, en un sobre, a la finalización del curso. En caso contrario no podremos darlo por finalizado, con lo cuál no le será expedido el certificado de formación, ni su empresa podrá bonificarse el importe del curso. </strong></p>
            </div>

            <h3 class="tituloseccion">7. Técnicas Orientativas de Estudio</h3>
        
            <p>Estudiar a distancia es muy distinto a estudiar de una forma convencional o presencial. Se trata de diferentes opciones para seguir aprendiendo. En muchas ocasiones el aprendizaje a distancia es la única opción posible para las personas que están trabajando, y por lo tanto, no pueden asistir a las clases presenciales.</p>
            <p>Tiene que empezar por estar convencido de que se puede estudiar a distancia con tanta o mayor eficacia que en los cursos presenciales. Sin este convencimiento su rendimiento en el estudio será mucho menor.</p>
            
            <h4 class="tituloseccion">7.1. Requisitos para el estudio eficaz</h4>
            <p>Su estudio requiere esfuerzo intelectual y determinadas técnicas para que resulte eficaz. Son necesarios determinados aspectos, a los que habitualmente no se les presta mucha atención:</p>

            <ul class="listatexto">
                <li>Disponer de un lugar privado, tranquilo y silencioso.</li>
                <li>Contar con la mesa suficiente y cómoda, donde pueda disponer de todo el material necesario para su sesión de estudio.</li>
                <li>Y prestar especial atención a la orientación de la luz y a una buena temperatura ambiente.</li>
            </ul>

            <h4 class="tituloseccion">7.2. Planificación del trabajo:</h4>

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

            <h4 class="tituloseccion">7.3. La sesión de estudio</h4>
            <p>Es importante que sea una actividad más dentro de las 24 horas del día. El intervalo ideal de una sesión de estudio debe ser de 1 ó 1,5 horas consecutivas, dependiendo de sus circunstancias personales y las dificultades de los temas de estudio.</p>
            <p>Los requisitos previos para una buena sesión de estudio pueden ser los siguientes:</p>

            <ul class="listatexto">
                <li>Actitud: estar dispuesto para el estudio.</li>
                <li>Organización del estudio: según con el ritmo personal de trabajo que tenga.</li>
                <li>Distribución de las materias: dependiendo de la dificultad que tengan las materias a estudiar.</li>
            </ul>

            
            <h3 class="tituloseccion">8. Sistema de Seguimiento y Apoyo al Alumno</h3>
            
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
            $mail->From = 'gestion@eduka-te.com';
            $mail->FromName = 'Gestión ESFOCC';
            $mail->addAddress($emailalumno);                   // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo('icabrera@eduka-te.com');
            // $mail->addCC('icabrera@eduka-te.com');
            $mail->addBCC('irivero@eduka-te.com');
            $mail->addBCC('icabrera@eduka-te.com');
            // $mail->ConfirmReadingTo('aperojo@eduka-te.com');
            // $mail->WordWrap = 50;                                   // Set word wrap to 50 characters
            $mail->addAttachment($nombreFichero);                   // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');   // Optional name
            $mail->isHTML(true);                                    // Set email format to HTML

            $titulo = $mail->Subject = 'Guía del alumno y datos de acceso acción formativa '.$naccion.'.'.$ngrupo.' - '.$alumno;
            $mail->Body    = 'Buenos días, <br><br>
            Adjunto a este correo le enviamos la GUÍA DEL ALUMNO y los DATOS DE ACCESO para el seguimiento del curso on line que comenzará en breve con nosotros.<br><br>
            Para cualquier duda o consulta no dude en contactar con nosotros.<br><br>
            <b><span style="color:#C80000">Le agradeceríamos nos respondiese a este correo confirmando que ha recibido correctamente la GUÍA DEL ALUMNO adjunta con los DATOS DE ACCESO.</span></b><br><br>
            Un saludo.<br>
            -------------- <br>
            <img src="http://gestion.esfocc.com/app/documentacion/guias/img/footermailgesti.png"><br>
            <span style="font-size: 10px">Confidencialidad<br>
            Este correo electrónico y, en su caso, cualquier fichero anexo al mismo, contiene información de carácter confidencial exclusivamente dirigida a su destinatario o destinatarios y propiedad de ESFOCC S.L. Queda prohibida su divulgación, copia o distribución a terceros sin la previa autorización escrita de ESFOCC S.L, en virtud de la legislación vigente. En el caso de haber recibido este correo electrónico por error, se ruega notificar inmediatamente esta circunstancia mediante reenvío a la dirección electrónica del remitente y la destrucción del mismo.
            <br>Confidentiality<br>
            The information in this e-mail and in any attachments is classified as ESFOCC S.L. Confidential and Proprietary Information and solely for the attention and use of the named addressee(s). You are hereby notified that any dissemination, distribution or copy of this communication is prohibited without the prior written consent of ESFOCC S.L. and is s strictly prohibited by law. If you have received this communication in error, please, notify the sender by reply e-mail.</span>'; 


            $mail->CharSet = 'UTF-8';

            if(!$mail->send()) {
               echo 'Error. Email no enviado: ' . $mail->ErrorInfo;
               exit;
            }

            registrarMailBD($para, $titulo, $cc, $link);
            echo 'Email enviado con éxito.';

        }

    // }
    // catch(HTML2PDF_exception $e) {
    //     echo $e;
    //     exit;
    // }
