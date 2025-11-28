<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    // echo $baseurl.'/plugins/html2pdf/html2pdf.class.php';

    setlocale(LC_TIME, "es_ES");

    $fechaLarga = date("d"). ' de '. ucfirst((strftime("%B"))). ' de ' .(date("Y"));

    $idprop = $_GET[idprop];

    $q = 'SELECT p.*
    FROM peticiones_formativas p
    WHERE id = '.$idprop;
    echo $q;
    $q = mysqli_query($link, $q) or die("error busqueda prop ". mysqli_error($link));

    while ( $row = mysqli_fetch_array($q) ) {

        $nombreFichero = "Acuerdo_".$naccion."-".$ngrupo."_".str_replace(' ', '-', quitaTildes($row[empresa])).".pdf";
        // ob_start();

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
.rojoesfocc {
    color: #cc0000;
}
.margintop40 {
    margin-top: 40px;
}
.margintop20 {
    margin-top: 20px;
}

</style>



    <!--  -->
    <!--  -->
    <!-- PORTADA DE PROPUESTA -->
    <!--  -->
    <!--  -->

    <page backimg="img/FondoDocPropuestasFormativas.png" backleft="60px" backright="60px" backtop="60px" backbottom="60px">
        <page_header height="100px">
        </page_header>

        <div style="width:400px; margin-top: 200px">
            <h2><? echo $row[formacion] ?></h2>
        </div>

        <div style="width:400px; margin-top:150px">
            <h3><? echo $row[razonsocial] ?></h3>
        </div>
    </page>

    <page backimg="img/FondoDocPropuestasFormativas.png" backleft="60px" backright="60px" backtop="90px" backbottom="60px">

        <h2 class="rojoesfocc" style="margin: 0 0 50px 50px">INDICE</h2>
        <ul style="list-style:none">
            <li><h2><span class="rojoesfocc">1.-</span> <span style="margin-right: 50px;">Introducción</span></h2></li>
            <li><h2><span class="rojoesfocc">2.-</span> <span style="margin-right: 50px;">Objetivos</span></h2></li>
            <li><h2><span class="rojoesfocc">3.-</span> <span style="margin-right: 50px;">Contenido</span></h2></li>
            <li><h2><span class="rojoesfocc">4.-</span> <span style="margin-right: 50px;">Metodología</span></h2></li>
            <li><h2><span class="rojoesfocc">5.-</span> <span style="margin-right: 50px;">Presupuesto</span></h2></li>
        </ul>


    </page>

    <page pageset="old" backleft="60px" backright="60px" backtop="60px" backbottom="60px">

        <h1 class="rojoesfocc">Introducción</h1>
        <hr class="rojoesfocc">
        <p class="margintop20">La siguiente propuesta formativa es para la formación <? echo $row[formacion] ?>, con una duración de <? echo $row[horastotales] ?> horas. Se incluye los objetivos, los contenidos, la metodología y el presupuesto. </p>

        <h1 class="rojoesfocc margintop40">Objetivos</h1>
        <hr class="rojoesfocc ">
        <p class="margintop20">
            <? echo nl2br($row[objetivos]) ?>
        </p>

        <h1 class="rojoesfocc margintop40">Contenido</h1>
        <hr class="rojoesfocc ">
        <p class="margintop20">
            <? echo nl2br( $row[contenido] ) ?>
        </p>
    </page>

    <page pageset="old" backleft="60px" backright="60px" backtop="60px" backbottom="60px">

        <h1 class="rojoesfocc ">Metodología</h1>
        <hr class="rojoesfocc ">
        <p class="margintop20">La metodología  de formación presencial se centra en los intereses, expectativas y necesidades del alumnado y, se orienta a la aplicación de los conocimientos adquiridos en la práctica profesional del alumnado.</p>

        <p>En el proceso de enseñanza-aprendizaje se combinará el método expositivo con la realización de actividades prácticas y dinámicas que contribuyan a consolidar los conocimientos adquiridos, utilizando los recursos y materiales adecuados para la consecución de los objetivos previstos.</p>


        <? if ( $row[tablaprecios] == 'No' ) { ?>

            <p>La modalidad será <strong><? echo strtolower($row[modalidad]) ?></strong> y tendrá una duración de <strong><? echo $row[horastotales] ?> horas</strong>.
            El lugar de impartición será a determinar por el cliente. El número máximo de alumnos será 25.</p>

        <? } else { ?>

            <p>La modalidad será <strong><? echo strtolower($row[modalidad]) ?></strong> y tendrá una duración <strong>8 horas</strong> para <strong>SEGURIDAD CONTRA INCENDIOS NIVEL I</strong> y de <strong>16 horas</strong> para <strong>SEGURIDAD CONTRA INCENDIOS NIVEL II</strong>.
            El lugar de impartición serán las instalaciones del cliente.</p>

        <? } ?>

        <h1 class="rojoesfocc margintop20">Presupuesto</h1>
        <hr class="rojoesfocc ">

        <? if ( $row[tablaprecios] == 'No' ) { ?>

            <p class="margintop20">El coste para la acción formativa con una duración <? echo $row[horastotales] ?> horas y <? echo $row[numalumnos] ?> alumnos es: </p>
            <br>
            <p style="text-align: center; margin-bottom: 20px; font-size: 24px"><strong><? echo $row[presupuesto].' €'?></strong></p>

        <? } else { ?>

            <p class="margintop20">El coste para la acción formativa se detalla en las siguientes tablas: </p><br>

            <p><strong>SEGURIDAD CONTRA INCENDIOS NIVEL I</strong>, con una duración de 8 horas:</p>

            <table style="margin-left: 245px">
                <tr>
                    <th>Nº PAX</th>
                    <th>Precio PAX</th>
                    <th>Precio GRUPO</th>
                </tr>
                <tr>
                    <td>10</td>
                    <td>60,00 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>54,55 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>50,00 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>46,15 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>42,86 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>40,00 €</td>
                    <td>600,00 €</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>39,00 €</td>
                    <td>624,00 €</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>38,00 €</td>
                    <td>646,00 €</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>37,00 €</td>
                    <td>666,00 €</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>36,00 €</td>
                    <td>684,00 €</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>35,00 €</td>
                    <td>700,00 €</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>34,00 €</td>
                    <td>714,00 €</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>33,00 €</td>
                    <td>726,00 €</td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>32,00 €</td>
                    <td>736,00 €</td>
                </tr>
                <tr>
                    <td>24</td>
                    <td>31,00 €</td>
                    <td>744,00 €</td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>30,00 €</td>
                    <td>750,00 €</td>
                </tr>
            </table>

            <br>

            <p><strong>SEGURIDAD CONTRA INCENDIOS NIVEL II</strong>, con una duración de 16 horas:</p>

            <table>
                <tr>
                <th>Nº PAX</th>
                <th>Precio PAX</th>
                <th>Precio GRUPO</th>
                </tr>
                <tr></tr>
                    <td>10</td>
                    <td>130,44 €</td>
                    <td>1.304,40 €</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>130,44 €</td>
                    <td>1.434,84 €</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>130,44 €</td>
                    <td>1.565,28 €</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>130,44 €</td>
                    <td>1.695,72 €</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>130,44 €</td>
                    <td>1.826,16 €</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>126,09 €</td>
                    <td>1.891,38 €</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>125,67 €</td>
                    <td>2.010,74 €</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>125,22 €</td>
                    <td>2.128,77 €</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>124,77 €</td>
                    <td>2.245,91 €</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>124,28 €</td>
                    <td>2.361,31 €</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>122,08 €</td>
                    <td>2.441,58 €</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>121,55 €</td>
                    <td>2.552,55 €</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>121,01 €</td>
                    <td>2.662,15 €</td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>120,42 €</td>
                    <td>2.769,67 €</td>
                </tr>
                <tr>
                    <td>24</td>
                    <td>119,81 €</td>
                    <td>2.875,33 €</td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>116,66 €</td>
                    <td>2.916,55 €</td>
                </tr>
            </table>


        <? } ?>
        <p>Es <strong>100% bonificable</strong> para aquellas empresas que dispongan el crédito asignado para la formación establecido por la Fundación Estatal para la Formación en el Empleo y estén al corriente de la seguridad social.</p>

        <p class="margintop20">INCLUYE:</p>
        <div style="margin-left:30px;">
            <p>-   Manual didáctico de acuerdo con las necesidades de los alumnos.</p>
            <p>-   Material fungible: portadocumentos o mochila, block de notas, bolígrafo.</p>
            <p>-   Docente.</p>
            <p>-   Certificado de aprovechamiento.</p>
            <p>-   Gestión telemática en la Fundación Estatal para la Formación en el Empleo si el cliente lo requiere.</p>
        </div>

        <p class="" style="margin-top: 40px;text-align: center">Santa Cruz de Tenerife, <? echo $fechaLarga ?></p>
        <p class="" style="margin-top: 60px;text-align: center">FIRMA CLIENTE</p>

        <p style="margin-top: 45px; font-size: 9px">
            En cumplimiento de lo que se dispone en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (LOPD), Escuela Superior de Formación y Cualificación S.L le informa que los datos de carácter personal que nos proporciona se recogerán en el fichero “CLIENTES” cuyo responsable es   ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L.U, con la finalidad de gestionar nuestra relación comercial y, en su caso, la exposición de imágenes.</p>

        <p style="font-size: 9px">En virtud de lo dispuesto en el artículo 15 y siguientes de la LOPD y en los términos que indica su Reglamento de desarrollo aprobado por Real Decreto 1720/2007, de 21 de diciembre, en cualquier momento el titular de los datos personales podrá ejercer sus derechos de acceso, rectificación, cancelación y oposición, dirigiéndose por escrito a ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L.U  (C/ Seguidillas, nº 9, del plan parcial Llano del Camello 38639. San Miguel de Abona. Sta. Cruz de Tenerife).

        </p>

    </page>



<? }
        // $content = ob_get_clean();

        // // $html2pdf->setModeDebug();
        // $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
        // $html2pdf->setDefaultFont('Arial');
        // $html2pdf->writeHTML($content);
        // // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
        // // $html2pdf->Output($nombreFichero,'D');
        // $html2pdf->Output($nombreFichero);


