<?
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
    include_once($baseurl.'/functions/funciones.php');
    include_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

ob_start(); ?>

<style type="text/Css">

    * {
        margin:0;
        padding:0;
        line-height: 1.5;
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
    ol li { font-size: 15px; padding-bottom: 10px;}

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
        font-size: 13px;
        line-height: 1.2;
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

    h4 {
        margin: 40px 0 10px 0;
    }

    .salto {
        /*page-break-before: always;*/
        page-break-inside: auto;
    }


    </style>



        <!--  -->
        <!--  -->
        <!-- RLT -->
        <!--  -->
        <!--  -->
        <?
            // echo "a";

                $tipo = $_GET[tipo];

                // if ( $tipo == "P" ) {

                    $qini = 'SELECT e.sedesmultiples, e.cif
                    FROM empresas e
                    WHERE e.id = "'.$_GET[id_emp].'"';
                    // echo $qini;
                    $qini = mysqli_query($link, $qini) or die("error select : " .mysqli_error($link));

                    $rowini = mysqli_fetch_assoc($qini);
                    // if ( $rowini[sedesmultiples] == 1 ) {

                        $qx = 'SELECT e.razonsocial
                        FROM empresas e
                        WHERE e.cif = "'.$rowini[cif].'"
                        ORDER BY razonsocial ASC';

                        $qx = mysqli_query($link, $qx) or die("error select : " .mysqli_error($link));

                        while ( $rowx = mysqli_fetch_assoc($qx) ) {

                            $empresas[] = $rowx[razonsocial];

                        }

                    // } else {
                        // $empresas[] = $_GET[id_emp];
                    // }

                    // print_r($empresas);
                // }


                $existe = 0;
                $mediosp = "Se utilizarán  todos  aquellos  que  se  consideren  pertinentes  para lograr un óptimo aprovechamiento de la acción formativa:

                Al inicio del curso se le entregará a cada uno de los alumnos un manual específico sobre la materia.
                Durante  el  desarrollo  de  las  jornadas  formativas  se  utilizará  una  metodología dinámica y participativa, cuyo objetivo será la construcción de un aprendizaje significativo, partiendo de las expectativas y las necesidades formativas del alumno, y orientada a la aplicación de los conocimientos adquiridos en la práctica profesional del alumnado.
                Para  el  desarrollo  de  la Acción  Formativa  se  cuenta  con  un  formador  de  reconocida  valía  en  la  impartición  de  la acción, que  desarrollará  el  temario  correspondiente  de  forma  teórico -práctico  utilizando  las  metodologías más idóneas según los casos.
                El aula donde se impartirá la formación contará con todos los recursos técnicos necesarios para que el formador pueda impartir dicha formación: pizarra, retroproyector, pantalla, ordenador, etc., además con las condiciones de habitabilidad, seguridad y espacio suficiente.";

                $medioso = "A través de la plataforma virtual se realizarán todas las actividades que integran el curso: contenido teórico, casos prácticos y/o ejercicios, evaluaciones, etc..
                Durante el trascurso de la acción formativa, el alumno cuenta con un tutor con formación y experiencia en la materia, que le guiará durante todo el proceso formativo, realizando un seguimiento individualizado y proporcionándole orientación y apoyo durante el proceso de aprendizaje.
                La metodología de la formación online destaca por su flexibilidad, adaptándose el proceso de enseñanza- aprendizaje totalmente a las necesidades, ritmos y tiempos de aprendizaje  del alumno.";

                $criterios = "Los trabajadores considerados prioritarios en las acciones formativas financiadas a través del sistema de bonificaciones son:

                ·         Trabajadores de pequeñas y medianas empresas.
                ·         Mujeres.
                ·         Mayores de 45 años.
                ·         Trabajadores de baja cualificación.
                ·         Personas con discapacidad.
                ·         Víctimas del terrorismo y de violencia de género.";



                if ( $tipo == "P" )

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*, c.*, c.localidad as localidadcentro, c.provincia as provinciacentro, c.codigopostal as cpcentro, a.modalidad, a.horastotales,a.diploma, m.observaciones
                    FROM matriculas m, acciones a, grupos_acciones ga, ptemp_mat_emp ma, empresas e, centros c
                    WHERE m.id_accion = a.id
                    AND m.centro = c.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];

                else if ( $tipo == "G" )
                        
                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*, a.modalidad, a.horastotales, a.diploma, m.observaciones
                    FROM matriculas m, acciones a, grupos_acciones ga, otemp_mat_emp ma, empresas e
                    WHERE m.id_accion = a.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];

                else

                    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*
                    FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e
                    WHERE m.id_accion = a.id
                    AND m.id_grupo = ga.id
                    AND ma.id_matricula = m.id
                    AND ma.id_empresa = e.id
                    AND e.id = '.$_GET[id_emp].'
                    AND m.id = '.$_GET[id_mat];

                // echo $sql;
                $sql = mysqli_query($link, $sql) or die ("error".mysqli_error($link) );


                if ( mysqli_num_rows($sql) < 1 ) {

                    // echo "entra";
                    $anio = date('Y');
                    $anio = $anio - 1;
                    // echo $anio;
                    include_once ('../functions/connect.php');

                    // $lista_bd = mysql_list_dbs($link);
                    // print_r($lista_bd);


                    if ( $tipo == "P" )

                        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*, c.*, c.localidad as localidadcentro, c.provincia as provinciacentro, c.codigopostal as cpcentro, a.modalidad, a.horastotales, a.diploma, m.observaciones
                        FROM matriculas m, acciones a, grupos_acciones ga, ptemp_mat_emp ma, empresas e, centros c
                        WHERE m.id_accion = a.id
                        AND m.centro = c.id
                        AND m.id_grupo = ga.id
                        AND ma.id_matricula = m.id
                        AND ma.id_empresa = e.id
                        AND e.id = '.$_GET[id_emp].'
                        AND m.id = '.$_GET[id_mat];

                    else if ( $tipo == "G" )

                        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*, a.modalidad, a.horastotales, a.diploma, m.observaciones
                        FROM matriculas m, acciones a, grupos_acciones ga, otemp_mat_emp ma, empresas e
                        WHERE m.id_accion = a.id
                        -- AND m.centro = c.id
                        AND m.id_grupo = ga.id
                        AND ma.id_matricula = m.id
                        AND ma.id_empresa = e.id
                        AND e.id = '.$_GET[id_emp].'
                        AND m.id = '.$_GET[id_mat];

                    else

                        $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, ga.ngrupo, m.fechaini, m.fechafin, e.razonsocial, m.comercial, e.*, a.objetivos, a.contenido, m.*, c.*, c.localidad as localidadcentro, c.provincia as provinciacentro, c.codigopostal as cpcentro, a.modalidad, a.horastotales, a.diploma, m.observaciones
                        FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, empresas e, centros c
                        WHERE m.id_accion = a.id
                        AND m.centro = c.id
                        AND m.id_grupo = ga.id
                        AND ma.id_matricula = m.id
                        AND ma.id_empresa = e.id
                        AND e.id = '.$_GET[id_emp].'
                        AND m.id = '.$_GET[id_mat];

                    // echo $sql;
                    $sql = mysqli_query($link, $sql) or die ("error".mysqli_error($link) );


                }

                while ($row = mysqli_fetch_array($sql)) {

                    if ( $row[modalidad] == 'Teleformación' ) {
                        $medios = $medioso;
                        $trabajadores = 80;
                    }
                    else {
                        $medios = $mediosp;
                        if ( $row[diploma] == "DESA" ) {

                            $qf = 'SELECT md.id_docente
                            FROM matriculas m, mat_doc md
                            WHERE md.id_matricula = m.id
                            AND m.id = '.$_GET[id_mat];
                            $qf = mysqli_query($link, $qf) or die("error select mat doc" . mysqli_error($link));

                            $n = mysqli_num_rows($qf);

                            if ( $n>1 ) $trabajadores = 16; else $trabajadores = 8;

                        } else {
                            $trabajadores = 30;
                        }
                    }
                    // echo "test";
                    $colectivos = "Todos los trabajadores asalariados que prestan servicios en empresas privadas - o entidades públicas no incluidas en el ámbito de aplicación de los acuerdos de formación en las Administraciones públicas - y cotizan a la Seguridad Social en concepto de Formación Profesional, así como los trabajadores que se encuentran en las siguientes situaciones:

                    ·         Trabajadores fijos discontinuos en los períodos de no ocupación.

                    ·         Trabajadores que acceden a situación de desempleo cuando se encuentran realizando formación.

                    ·         Trabajadores acogidos a regulación de empleo en sus períodos de suspensión de empleo por expediente autorizado.

                    ·         Trabajadores afectados por medidas temporales de suspensión de contrato por causas económicas, técnicas, organizativas o de producción, en sus períodos de suspensión de empleo.<br>
                    Número máximo de trabajadores: ".$trabajadores;


                    if ( $row[fechaini_nop] != "" && $row[fechaini_nop] != "0000-00-00" )
                        $mixo = 1;

                    $fechaini = $row[fechaini];
                    $fecha15 = date('Y-m-d', strtotime('-15 day', strtotime($fechaini)));


                foreach ($empresas as $key => $razonsocial) {
                    // echo "entra con ".$id_emp."<br>";

                ?>

                   <page backleft="40px" backright="40px" backtop="50px" backbottom="60px">

                        <page_footer>
                            <div style="text-align:center; padding: 7px;">
                                <span style="font-size: 10px; "><strong>[[page_cu]]</strong> - INFORMACIÓN A LA RLT - GRUPO FORMATIVO <? echo $row[numeroaccion].'/'.$row[ngrupo].': '. $row[denominacion] ?></span>
                            </div>

                        </page_footer>

                        <div style="">
                            <div style="margin-top: 5px;"><h3 style="text-align:center;">INFORMACIÓN A LA REPRESENTACIÓN LEGAL TRABAJADORES</h3></div>
                        </div>
                        <p style="margin-top: 5px"><h4>Datos de la empresa</h4></p>
                        <p>Razón Social: <? echo $razonsocial ?></p>
                        <p>CIF/NIF: <? echo $row[cif] ?> </p>
                        <p>Domicilio: <? echo $row[domiciliosocial] ?></p>

                        <div style="width:100%; margin: 10px 0 10px 0">
                        <p style="text-align: justify">De conformidad con el artículo 13 del Real Decreto 694/2017,  de 3 de julio, y con anterioridad al inicio de la ejecución de las acciones formativas del presente ejercicio,  con fecha  <? echo formateaFecha($fecha15) ?>, ponemos a disposición de la representación legal de los trabajadores la información sobre la acción formativa <? echo $row[numeroaccion].'/'.$row[ngrupo] ?> del curso <? echo $row[denominacion] ?> de formación continua:</p>
                        </div>

                        <p style="margin-left: 20px">1.  Denominación, objetivos y descripción de las acciones a desarrollar.</p>
                        <p style="margin-left: 20px">2.  Colectivos destinatarios y número de participantes por acciones.</p>
                        <p style="margin-left: 20px">3.  Calendario previsto de ejecución.</p>
                        <p style="margin-left: 20px">4.  Medios pedagógicos.</p>
                        <p style="margin-left: 20px">5.  Criterios de selección de los participantes.</p>
                        <p style="margin-left: 20px">6.  Lugar previsto de impartición de las acciones formativas.</p>
                        <p style="margin-left: 20px">7.  Balance de las acciones formativas desarrolladas en el ejercicio precedente.</p>                   
                        <div style="width:100%; margin: 10px 0 10px 0">
                        <p style="text-align: justify"> Asimismo, la representación legal de los trabajadores emitirá un informe(1) sobre las acciones formativas a desarrollar por la empresa en el plazo de 15 días desde la recepción de la documentación anteriormente descrita, transcurrido el cual sin que se haya remitido el citado informe se entenderá cumplido este trámite.</p>
                        <h6>(1).- Se emitirá informe por cada centro de trabajo con RLT, debiendo incorporar firma de la RLT suficientemente acreditada (con independencia del centro en el que se desarrolle la formación).</h6>
                        <p><h4>Identificación de la RLT</h4></p>
                        <p style="margin-left: 20px">__ Comité Intercentros</p>
                        <p style="margin-left: 20px">__ Comité de Empresa</p>
                        <p style="margin-left: 20px">__ Comité de Empresa Conjunto. Centros a los que representa:____________________________</p>
                        <p style="margin-left: 20px">__ Delegado/s de Personal</p>
                        <p style="margin-left: 20px">__ Comisión Interna de Formación</p>
                        <p style="margin-left: 20px">__ Secciones Sindicales Constituidas. Sindicatos:___________________________</p>
                        <h6>Se indicara el porcentaje de todos y cada uno de los sindicatos en relación con el total % RLT indicada en este documento </h6>
                        </div>
                        
                        <table style="margin-top:30px;">
                            <tr>
                                <td>
                                    <p style="margin-top: 10px">En representación de la Empresa: </p>
                                    <p style="">Nombre y apellidos: </p>
                                    <p>CIF/NIF: </p>
                                    <p>Firma original:</p>
                                </td>
                                <td style="width: 200px;"></td>
                                <td style="">
                                    <p style="margin-top: 10px ">Acuse de recibo por parte de la R.L.T.:</p>
                                    <p>Nombre y apellidos:</p>
                                    <p>NIF: </p>
                                    <p>Firma original:</p>
                                </td>
                            </tr>
                        </table>





                    </page>
                    <page backleft="40px" backright="40px" backtop="50px" backbottom="80px">

                        <page_footer>
                            <div style="text-align:center; padding: 7px;">
                                <span style="font-size: 10px; "><strong>[[page_cu]]</strong> - INFORMACIÓN A LA RLT <? echo $row[numeroaccion].'/'.$row[ngrupo].' del curso '. $row[denominacion] ?></span>
                            </div>

                        </page_footer>


                        <h4>Denominación, objetivos y descripción de las acciones a desarrollar.</h4>
                        <p>OBJETIVOS</p>
                        <p><? echo nl2br(($row[objetivos])) ?></p><br>
                         <p class="salto">CONTENIDOS</p>
                        <p><? echo nl2br(($row[contenido])) ?></p>

                    </page>


                    <page backleft="40px" backright="40px" backtop="50px" backbottom="80px">

                        <page_footer>
                            <div style="text-align:center; padding: 7px;">
                                <span style="font-size: 10px; "><strong>[[page_cu]]</strong> - INFORMACIÓN A LA RLT <? echo $row[numeroaccion].'/'.$row[ngrupo].' del curso '. $row[denominacion] ?></span>
                            </div>

                        </page_footer>


                        <h4>Colectivos destinatarios y número de participantes por acciones.</h4>
                        <p><? echo nl2br($colectivos) ?></p>

                        <h4>Calendario previsto de ejecución.</h4>
                            <p>El curso se desarrolla en modalidad <? echo strtolower($row[modalidad]) ?> y tiene una duración de <? echo $row[horastotales] ?> horas </p>
                            <p>Fechas: <? echo formateaFecha($row[fechaini]) .' - '. formateaFecha($row[fechafin]) ?></p>
                            <p>Horario: <? echo devuelveDias($row[diascheck]) .' de '. devuelveHorario($row[horariomini], $row[horariomfin], $row[horariotini], $row[horariotfin]) ?></p>

                            <? if ( $mixto == 1 ) {
                                echo "<p>Parte no presencial: <br> Fechas: ".$row[fechaini_nop]." - ".$row[fechafin_nop]."</p>";
                                echo "<p>Horario: ". devuelveHorario($row[horariomini_nop], $row[horariomfin_nop], $row[horariotini_nop], $row[horariotfin_nop]). "</p>";
                            }

                            if ( $row[observaciones] !== NULL && $row[observaciones] != "" ) {
                                echo "<p>Observaciones: ".$row[observaciones]."</p>";
                            }

                            ?>
                        <h4>Medios pedagógicos.</h4>
                            <p><? echo nl2br($medios) ?></p>



                    </page>

                    <page backleft="40px" backright="40px" backtop="50px" backbottom="80px">

                        <page_footer>
                            <div style="text-align:center; padding: 7px;">
                                <span style="font-size: 10px; "><strong>[[page_cu]]</strong> - INFORMACIÓN A LA RLT <? echo $row[numeroaccion].'/'.$row[ngrupo].' del curso '. $row[denominacion] ?></span>
                            </div>

                        </page_footer>

                        <h4>Criterios de selección de los participantes.</h4>
                            <p><? echo nl2br($criterios) ?></p>
                            <? if ( $tipo != "G" ) { ?>

                        <h4>Lugar previsto de impartición de las acciones formativas.</h4>
                            <p>Centro: <? echo $row[nombrecentro] ?> </p>
                            <p>Dirección Centro: <? echo $row[direccioncentro].', '.$row[cpcentro].', '.$row[localidadcentro].', '.$row[provinciacentro] ?> </p>
                            <? } ?>
                        <h4>Balance de las acciones formativas desarrolladas en el ejercicio precedente.</h4>
                            <p>Se adjunta informe de empresa proporcionado por la Fundación Estatal para la Formación en el Empleo.</p>


                    </page>

                    <?


            }

        } // foreach


        $content = ob_get_clean();
        $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setModeDebug();
        $html2pdf->setDefaultFont('Arial');
        $html2pdf->writeHTML($content);
        // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        $html2pdf->Output($nombreFichero);



