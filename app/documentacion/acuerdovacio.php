<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    setlocale(LC_TIME, "es_ES");

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



    <!--  -->
    <!--  -->
    <!-- COMPROMISO DE COLABORACIÓN DOCENTES -->
    <!--  -->
    <!--  -->

    <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/esfocclogo.png" alt=""></div>
        </page_header>

        <div style="margin-bottom: 50px">
            <div style="margin-top: 20px;"><h2 style="text-align:center;">COMPROMISO DE COLABORACIÓN EN LA PRESTACIÓN DE SERVICIOS DOCENTES</h2></div>
        </div>

        <p><strong>INTERVIENEN:</strong></p><BR>

        <? if ( $row[id_docente] == 66 ) { ?>

            <p>Por una parte, el Sr. Manuel Lorenzo Padilla, con DNI 43772526F en representación de la Sociedad De Prevención Fraternidad Muprespa Slu, con NIF B84454172, y domicilio a efectos de este compromiso en Calle Manuel Oraá Y Arocha, 38008, Santa Cruz De Tenerife, Santa Cruz De Tenerife.</p>

        <? } else { ?>

        <p>Por una parte, el Sr/Sra. <? echo "XXXXXXXXXXXX" ?>, con NIF <? echo "XXXXXXXXXXXX" ?>, y domicilio a efectos de este compromiso, en XXXXXXXXXXX</p><br>

        <? } ?>

        <p>Por otra parte, el Sr. Daniel Álvarez Benítez, con NIF 78565562T, en representación Escuela Superior de Formación y Cualificación , S.L.U. con domicilio social en calle Seguidillas, s/n, nave 9, Plan Parcial Llano del Camello, 38639 San Miguel de Abona, Santa Cruz de Tenerife.</p><br><br><br>

        <p><strong>EXPONEN:</strong></p><br>
        <ul style="list-style-type: upper-roman">
            <li> <p>Que la Escuela Superior de Formación y Cualificación , S.L.U. es una entidad dedicada entre otras actividades a la realización de cursos de formación continua para empresas.</p></li>
            <li> <p>Que <? echo "XXXXXXXXXXXX" ?> posee la capacitación necesaria para impartir la docencia en formación continua para el reciclaje profesional y la propia organización para desarrollar adecuadamente los cursos de las especialidades abajo relacionadas.</p></li>
            <li> <p>Que las dos partes han llegado a un acuerdo sobre las condiciones que regularán sus relaciones en el desarrollo de acciones formativas para trabajadores en activo, según las obligaciones para entidades de gestión y entidades de formación recogidas en la ley 30/2015, por la que se regula el Sistema de Formación Profesional para el empleo en el ámbito laboral,  y suscriben un compromiso de colaboración estipulando los siguientes.</p></li>
        </ul><br>

        <p><strong>PACTOS:</strong></p><br>
        <p> <strong>I.- Objeto del compromiso</strong><br><br>El objeto del presente compromiso es la prestación de servicios docentes por parte del/la experto/a en la/s siguiente/es acción/es formativa/s:</p><br>

            <table class="accion">
                <tr>
                    <th>ACCION / GRUPO</th>
                    <th>DENOMINACIÓN ACCIÓN FORMATIVA</th>
                    <th>HORAS</th>
                    <? if ( ( ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia') && $row[situacionlaboral] != 'Autonomo' )
                    || ( $row[modalidad] == 'Presencial' || $row[modalidad] == 'Mixta' ) ) { ?>
                    <th style="text-align:center">P (bruto) / Hora <BR> Docencia <BR> <span style="text-align:center; font-size: 10px">IGIC incluído</span></th><? } ?>
                </tr>
                <tr>
                    <td style="width:10%"><? echo "X/X" ?></td>
                    <td style="width:55%"><? echo "XXXXXXXXXXXX" ?></td>
                    <td style="width:10%"><? echo 'X h/curso' ?></td>
                    <? if ( ( ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia') && $row[situacionlaboral] != 'Autonomo' )
                    || ( $row[modalidad] == 'Presencial' || $row[modalidad] == 'Mixta' ) ) { ?>
                    <td style="width:10%"><? echo 'X €/h' ?></td><? } ?>
                </tr>

            </table>

    </page>

    <page backleft="60px" backright="60px" backtop="140px" backbottom="60px">
        <page_header height="100px">
            <div style="margin: 30px 0 30px 50px">
                <img style="width: 200px" src="guias/img/esfocclogo.png" alt=""></div>
        </page_header>

        <p><? echo "XXXXXXXXXXXX" ?> Las fechas y los horarios previstos del curso son del <? echo $fechaini .' a '. $fechafin ?>, en horario: <? echo $dias_semana.' de '.$horario ?>.
        La calendarización y el cronograma del/los curso/s se realizarán de acuerdo con la empresa/s arriba relacionada/s y quedarán constatados en la ficha del curso.
        El inicio efectivo del curso, y la necesidad efectiva de la docencia actúan como condición suspensiva de este compromiso.
        </p><br>

        <p><strong>II.- Remuneración y forma de pago.</strong><br><br>
            <p>1.- Al precio hora pactado se le aplicará  la retención correspondiente del I.R.P.F. por rendimiento de actividad económica, en caso que la ley así lo estipule.</p>
            <p>2.- El pago se realizará en el plazo de los <? echo "XX" ?> días siguientes al mes de impartición del curso, y una vez  presentada en la Escuela Superior de Formación y Cualificación , S.L.U. toda la documentación correspondiente a las acciones formativas, junto con la correspondiente minuta del curso. </p>
            <p>3.- Cualquier cambio en las condiciones acordadas se comunicará con antelación y deberá tener la confirmación por parte de la empresa Escuela Superior de Formación y Cualificación , S.L.U.</p>
            <p>4.- El trabajador o impartidor deberá estar dado de alta en el régimen general, o autónomo.</p>
            <br>

            <? if ( $row[situacionlaboral] == 'Autonomo' && ($row[modalidad] == 'Teleformación' || $row[modalidad] == 'A Distancia') ){ ?>
            <table class="accion">
                <tr>
                    <td colspan="4" style="text-align:center"><strong>TABLA SALARIAL TUTORIAS ONLINE/DISTANCIA</strong></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">TUTORIA INDIVIDUAL</td>
                    <td colspan="2" style="text-align:center">TUTORIA GRUPO</td>
                </tr>
                <tr>
                    <td>Duración curso (horas)</td>
                    <td>€/alumno</td>
                    <td>Duración curso (horas)</td>
                    <td>€/alumno</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>5 €</td>
                    <td>6</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>10 €</td>
                    <td>20</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>30</td>
                    <td>15 €</td>
                    <td>30</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>40</td>
                    <td>20 €</td>
                    <td>40</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>60</td>
                    <td>30 €</td>
                    <td>60</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>80</td>
                    <td>40 €</td>
                    <td>80</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>100</td>
                    <td>50 €</td>
                    <td>100</td>
                    <td>"+3€/alumno"</td>
                </tr>
                <tr>
                    <td>120</td>
                    <td>60 €</td>
                    <td>120</td>
                    <td>"+3€/alumno"</td>
                </tr>
            </table>

            <? } ?>
        </p>

        <p><strong>III.- Duración del compromiso</strong><br><br>
        La vigencia del presente compromiso queda limitada a la duración de la/s acción/es formativas objeto de este compromiso, siendo las mismas las comunicadas a la fund    ación tripartita para la formación en el empleo.</p><br>

        <p><strong>IV.- Obligaciones del experto/a</strong><br><br>
        <p>El experto/a <? echo "XXXXXXXXXXXX" ?> asume las siguientes obligaciones derivadas de la actividad docente:</p>
        <p>1.- Deberá asegurarse que la entidad gestora recibe, dentro de plazo, la documentación original necesaria para justificar y certificar la ejecución del plan de formación.</p>
        <p>2.-Viene obligado a informar de cualquier cambio y/o incidencia que se pudiera producir durante el transcurso de la acción formativa, en el mismo momento en que este se produzca.</p>
        <p>3.- Facilitar  el original de los apuntes del curso a la Escuela Superior de Formación y Cualificación , S.L.U. para la realización de  los dossieres de los alumnos, con 1 mes de antelación como mínimo del inicio del curso.</p>
        <p>4.- El desarrollo de la docencia según el calendario, el horario, el total de las horas y el lugar donde se haya establecido con la empresa participante o colectivo al que va dirigido el curso, que figuran detallados en la ficha del curso.</p>
        <p>5.- La adaptación del nivel de los contenidos del programa a las características del alumnado y según los criterios de la empresa que ha solicitado la formación para sus profesionales, y de acuerdo con  la entidad solicitante.</p>
        <p>6.- Controlar la asistencia de los alumnos, velando por la correcta cumplimentación de los formularios y justificar la suya propia mediante los documentos que entrega la entidad solicitante de acuerdo con estas finalidades.</p>
        <p>7.- Informar puntualmente a la empresa Escuela Superior de Formación y Cualificación , S.L.U. de cualquier incidencia sea cual sea su gravedad que afecte a fechas, horarios, lugar de impartición, asistencia del alumnado, visitas e inspecciones, etc…..</p>
        <p>8.- Realizar todas las actuaciones de seguimiento del proceso formativo que la entidad solicitante considere oportunas.</p>
        <p>9.- Representar a la entidad solicitante ante el alumnado, la empresa participante y colaborar con toda aquella persona vinculada al SEPE y/o a la Fundación Estatal para la Formación en el Empleo para la Formación y el Empleo que debidamente acreditada se persone en el lugar de impartición durante todo el periodo de realización de la acción formativa.</p>
        </p><br>

        <p><strong>V.- Obligaciones de la organización.</strong><br><br>
        La empresa Escuela Superior de Formación y Cualificación , S.L.U. se obliga a facilitar la prestación del servicio docente que desarrollará el/la experto/a y a suministrar los materiales que razonablemente sean necesarios, para el buen desarrollo de las acciones formativas.
        Se obliga a realizar el pago según las estipulaciones previstas en el apartado 2 del epígrafe II, previa entrega de la documentación requerida.</p><br>

        <? if ( $_GET[competencia] == 1 ) { ?>
        <p><strong>VI.- Cláusula de no competencia.</strong><br><br>

        El experto/a <? echo "XXXXXXXXXXXX" ?> reconoce que el destinatario de la acción formativa a desarrollar, reseñada en el punto I, forma parte de la clientela de ESFOCC y, por lo tanto, se compromete a no prestar ningún servicio docente a dicho destinatario que suponga competencia desleal con la actividad desarrollada por ESFOCC, empresa que contrata sus servicios. Esta cláusula tendrá una vigencia de un año a contar desde el día siguiente a la finalización de la acción formativa objeto del presente contrato.
        </p><br>
        <? } ?>

        <p><strong>VII.- Notificaciones.</strong><br><br>
        Todos los avisos comunicaciones entre las partes, derivados de la realización del presente compromiso se enviarán a las direcciones que figuran en el encabezamiento.
        Cualquier cambio se deberá comunicar a la otra con antelación suficiente, siempre dentro de los plazos establecidos. Para aquellas circunstancias no previstas, se comunicará con la máxima antelación posible.
        En caso de incumplimiento por alguna de las partes de las obligaciones derivadas del presente compromiso de colaboración, y siempre que no sea posible llegar a un acuerdo amistoso, ambas partes se someten a los tribunales de la jurisdicción de San Cristóbal de la Laguna.</p><br>

        <p><strong>VIII.- LOPD.</strong><br><br>
        Las partes contratantes se obligan a cumplir, en los que le afecte, la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal, así como cualquier disposición futura que pudiera desarrollarla o sustituirla de conformidad con lo establecido en la Ley Orgánica de protección de Datos de Carácter personal  15/1999, de 13 diciembre y R.D. 1720/2007, de 21 de diciembre, por el que se aprueba el Reglamento de desarrollo de la Ley Orgánica 15/1999, de 13 de diciembre, de protección de datos de carácter personal, Vd. queda informado y consiente expresamente que los datos de carácter personal que proporciona ya sean propios o de un tercero, serán incorporados a los ficheros de  ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN DE CANARIAS S.L. (ESFOCC), con domicilio en calle Seguidillas, s/n, nave 9, Plan Parcial Llano del Camello, 38639 San Miguel de Abona, Santa Cruz de Tenerife, para que éste pueda efectuar el tratamiento, automatizado o no, de los mismos con la finalidad de  poder cumplir con las obligaciones que asume con este contrato, prestando su consentimiento expreso para que dichos datos puedan ser comunicados para su utilización con los fines anteriores a <? echo "XXXXXXXXXXXX" ?>. Así mismo, queda informado que podrá ejercer los derechos de acceso, rectificación cancelación y oposición dirigiéndose a la dirección indicada anteriormente.<br><br>

        Ambas partes se obligan a salvaguardar los datos a los que pudiera tener acceso con ocasión del presente contrato. Si se accede a datos personales dentro del ámbito de la LOPD, ESFOCC asume respecto  los datos proporcionados por <? echo "XXXXXXXXXXXX" ?> las obligaciones y responsabilidades que establece el artículo 12 de la Ley Orgánica 15/1999,  no siendo considerado comunicación ni cesión de datos el acceso por ESFOCC a los datos de carácter personal de los alumnos proporcionados por <? echo "XXXXXXXXXXXX" ?> ya que dicho acceso, y el correspondiente tratamiento, es necesario para realizar la prestación del servicio contratado.<br><br>

        Es por ello, que a los efectos de la normativa de protección de datos, ESFOCC será considerada como “encargada de tratamiento”  de los datos de <? echo "XXXXXXXXXXXX" ?> y, de acuerdo con ello, se establece expresamente que ESFOCC únicamente tratará los datos conforme a las instrucciones de <? echo "XXXXXXXXXXXX" ?>, expresadas en el presente acuerdo, y donde su uso se limitará a los datos personales  de los alumnos proporcionados por <? echo "XXXXXXXXXXXX" ?>, a los únicos y exclusivos efectos de dar cumplimiento a las obligaciones que asume con motivo de este contrato ESFOCC se compromete a adoptar las medidas de seguridad a que se refiere el Art. 9 de la Ley Orgánica 15/1999, de 13 de diciembre de Protección de Datos de Carácter Personal, y demás normas aplicables a  esta materia. Se hace contar que, atendiendo a la naturaleza de los datos de los alumnos proporcionados a ESFOCC, las medidas de seguridad aplicables al tratamiento de los mismos son de nivel BÁSICO.</p>

        <p style="margin-top: 10px;">Y como prueba de conformidad, firman este documento, en todas sus hojas y por duplicado en S/C de Tenerife, a XX/XX/XXXX</p>


        <div style="margin-top: 80px">
                <table>
                    <tr>
                    <td style="width:0px"></td>
                    <td style="width:300px"><strong><? echo "XXXXXXXXXXXX" ?></strong></td>
                    <td style="width:180px"></td>
                    <td style="margin-right:20px">
                        <img style="margin-top: -100px; width: 160px;" src="../img/firma_admin_esfocc.png"><br>
                    </td>
                    </tr>
                    <tr><td align="right" colspan="4"><strong>ESFOCC, S.L.U.</strong></td></tr>
                </table>
        </div>


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


