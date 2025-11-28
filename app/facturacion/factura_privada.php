<?
    // session_start();

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    // $anio = devuelveAnioReal();
    setlocale(LC_TIME,"es_ES");


   // if ( isset($_POST[observaciones]) ) {
     //   $_POST[observaciones] = htmlspecialchars($_POST[observaciones]);
    //}
    // echo $_POST[observaciones];

    $q5 = 'SELECT numero
    FROM facturacion_privada
    WHERE empresa = '.$_POST[emp].'
    AND matricula = '.$_POST[mat].'
    AND estado <> "Rectificada"';
    // echo $q;
    $q5 = mysqli_query($link, $q5);

    if ( mysqli_num_rows($q5) == 0 || isset($_POST[modifica]) ) {


$prefijo = 'P';
$fechaActual = date('Y-m-d H:i:s');
// echo $fechaActual;
$q = 'SELECT MAX(numero) as numero FROM facturacion_privada LIMIT 0,1';
$q = mysqli_query($link, $q);
$row = mysqli_fetch_array($q);
$numeroMaxTabla = $row[numero]+1;
$numero = $_POST[numero];// $numero = $numero[1];

if ( $numeroMaxTabla == $numero )
    $numeroFinal = $numero;
else
    $numeroFinal = $numeroMaxTabla;
// $numero = $numero[1];

if ( isset($_POST[modifica]) ) $numeroFinal = $numero;

// echo $_POST['empfacturar'];
// $numeroFinal = '188';
// $total = 750;

if ($_POST[empfacturar] != "") {
    $q4 = 'SELECT razonsocial, cif, domiciliofiscal, domiciliosocial, codigopostal, poblacion, provincia
    FROM empresas
    WHERE id = '.$_POST[empfacturar];
    $q4 = mysqli_query($link, $q4);

    $row = mysqli_fetch_array($q4);
    $razonsocial = $row[razonsocial];
    $cif = $row[cif];
    $domiciliofiscal = $row[domiciliofiscal];
    $domiciliosocial = $row[domiciliosocial];
    if ( $domiciliofiscal == "" ) $domicilio = $row[domiciliosocial]; else $domicilio = $row[domiciliofiscal];
    $codigopostal = $row[codigopostal];
    $poblacion = $row[poblacion];
    $provincia = $row[provincia];

}


$q = 'SELECT @idmat:=m.id, @idemp:=e.id, mc.costes_imparticion, m.estado, m.fechaini, m.fechafin, a.denominacion, a.numeroaccion, ga.ngrupo, e.razonsocial, a.horastotales,a.modalidad, e.*, (SELECT count(*) FROM mat_alu_cta_emp WHERE id_matricula = @idmat AND tipo = "Privado" ) as nparticipantesgrupo , (SELECT count(*) FROM mat_alu_cta_emp WHERE id_empresa = @idemp AND id_matricula = @idmat AND tipo = "Privado") as nparticipantesemp, a.diploma, m.af_factura
FROM mat_costes mc, matriculas m, mat_alu_cta_emp ma, acciones a, grupos_acciones ga, empresas e
WHERE mc.id_matricula = m.id
AND m.id = ma.id_matricula
AND ma.id_empresa = e.id
AND m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id = '.$_POST[mat].'
AND ma.id_empresa = '.$_POST[emp].'
GROUP by razonsocial';
// echo $q;
$q = mysqli_query($link, $q);


    ob_start();

?>

<style>

* {
    margin:0;
    padding:0;
    /*font-family: sans-serif;*/
}

.page {
    position: relative;
    width: 21cm;
    height: 31.14cm;
    padding: 15px 30px;
}


@page {
    size: A4;
    margin: 0;
}

.gris { color: #ccc; }
.negrita { font-weight: bold; }

.tabla-desc {
    width: 700px;
    border-collapse: collapse;
}

td { padding: 2px; }
.tabla-desc td { border:1px solid #ccc; height: 13px; font-size: 12px;  }
.tabla-desc th { border:1px solid #ccc; text-align: center; height: 20px; background-color: #ccc }

</style>

<?

    while ( $row = mysqli_fetch_array($q) ) {

        //NO MOSTRAR AF/GRUPO EN TABLA
        if ( $row[numeroaccion] == "1072" && $row[ngrupo] == '1p' )
            $nomostraraf = 1;

        $grupo = $row[grupo];

        $estado = $row[estado];

        if ( $_POST[empfacturar] != "" ) {
            $empresa = quitaTildesConComas($razonsocial);
            $nombreFichero = 'facturas/'.$prefijo.$numeroFinal.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        } else {
            $empresa = quitaTildesConComas($row[razonsocial]);
            $nombreFichero = 'facturas/'.$prefijo.$numeroFinal.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        }


        if ( $_POST[empfacturar] != "" ) {
            $qc = 'SELECT SUM(mc.costes_imparticion) as total
            FROM mat_costes mc
            WHERE id_matricula = '.$_POST[mat];

            $qc = mysqli_query($link, $qc);

            $rc = mysqli_fetch_array($qc);

            $total = $rc[total]+$_POST[otro];
            $total = round($total,2);
            // $total = 750;
            // echo $total;

        } else {
            $total = $_POST[importefactura]+$_POST[otro];
        }

        $pendiente = $total-$_POST[anticipo];

        $fecha_vencimiento = date('Y-m-d', strtotime($_POST[fechafactura]. ' + '.$_POST[vencimiento].' days'));
        // $total = 150;

        if ( isset($_POST[genera]) ) {


            $q = 'INSERT INTO `facturacion_privada`(`numero`, `fecha`, `empresa`, `cobrado`, `base_facturacion`, `base_imponible`, `igic`, `total_factura`, `importe_a_abonar`, `fecha_generacion`, `matricula`, `vencimiento`, `formapago`, `fecha_vencimiento`, `facturar_a`, `observaciones`)
            VALUES ("'.$numeroFinal.'", "'.$_POST[fechafactura].'", "'.$_POST[emp].'", "'.$_POST[anticipo].'", "'.$_POST[importefactura].'", "'.$_POST[importefactura].'", "0", "'.$total.'", "'.$pendiente.'", "'.$fechaActual.'", "'.$_POST[mat].'", "'.$_POST[vencimiento].'","'.$_POST[formapago].'", "'.$fecha_vencimiento.'", "'.$_POST['empfacturar'].'", "'.$_POST['observaciones'].'")';
            // echo $q;
            $q = mysqli_query($link, $q) or die("error insertando". mysqli_error($link));
            $idfactura = mysqli_insert_id($link);

            $q1 = 'UPDATE `mat_alu_cta_emp` SET factura = "'.$idfactura.'" WHERE id_empresa = '.$_POST[emp].' AND id_matricula = '.$_POST[mat]. ' AND tipo = "Privado"';
            // echo $q1;
            $q1 = mysqli_query($link, $q1);

            // $q2 = 'SELECT DISTINCT @emp:=ma.id_empresa,factura,
            // ( SELECT mc.costes_imparticion
            // FROM mat_costes mc
            // WHERE mc.id_empresa = @emp
            // and mc.id_matricula = '.$_POST[mat].' ) as coste
            // FROM mat_alu_cta_emp ma, mat_costes mc
            // WHERE ma.id_matricula = '.$_POST[mat].'
            // AND ma.id_matricula = mc.id_matricula
            // AND ma.factura = 0';
            // $q2 = mysqli_query($link, $q2);
            // $c = 0;

            // while ( $rx = mysqli_fetch_array($q2) ) {

            //     if ( $rx[coste] != 0 && $rx[coste] != NULL )
            //         $c++;

            // }
            // if ( $c == 0 ) {

            //     $q3 = 'UPDATE `matriculas` SET estado = "Facturada" WHERE id = '.$_POST[mat];
            //     $q3 = mysqli_query($link, $q3);

            // }

            $q2 = 'SELECT SUM(mc.costes_imparticion) as suma
            FROM mat_costes mc, mat_alu_cta_emp ma
            WHERE ma.id_matricula = '.$_POST[mat].'
            AND ma.id_matricula = mc.id_matricula
            AND ma.id_empresa = mc.id_empresa
            AND ma.factura = 0';
            $q2 = mysqli_query($link, $q2);

            $rx = mysqli_fetch_array($link, $q2);

            if ( $rx[suma] == NULL || $rx[suma] == 0 || $_POST[empfacturar] != "" ) {

                if ( $estado != "Comunicada" ) {
                    $q3 = 'UPDATE `matriculas` SET estado = "Facturada" WHERE id = '.$_POST[mat];
                    $q3 = mysqli_query($link, $q3);
                }
            }

        } else if ( isset($_POST[modifica]) ) {

            $q = 'UPDATE facturacion_privada SET fecha = "'.$_POST[fechafactura].'", cobrado = "'.$_POST[anticipo].'", base_facturacion = "'.$_POST[importefactura].'", base_imponible = "'.$_POST[importefactura].'", total_factura = "'.$total.'", importe_a_abonar = "'.$pendiente.'", fecha_generacion = "'.$fechaActual.'", vencimiento = "'.$_POST[vencimiento].'", formapago = "'.$_POST[formapago].'", fecha_vencimiento = "'.$fecha_vencimiento.'", facturar_a = "'.$_POST['empfacturar'].'", observaciones = "'.$_POST['observaciones'].'" WHERE id = '.$_POST[idfac];
            // echo $q;
            $q = mysqli_query($link, $q) or die("error update".mysqli_error($link));

        }

        $q = 'UPDATE empresas SET vencimiento = "'.$_POST[vencimiento].'" WHERE id = '.$_POST[emp];
        $q = mysqli_query($link, $q);


?>
<page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">
        <table>
            <tr>
            <td>
                <div style="margin: 30px 0 0 30px"><img style="width: 200px" src="img/logo.png" alt=""></div>
            </td>
            <td>
                <div style="margin: 40px 0 0 350px; color: #ccc; font-weight: bold">
                    <span style="font-size: 32px;">FACTURA</span><br>
                    <div class="gris negrita" style="margin-top:5px">FECHA: <? echo formateaFecha($_POST[fechafactura]) ?></div>
                    <!-- <div class="gris negrita" style="">Nº: <? echo $prefijo.$numeroFinal ?>/23</div> -->
                    <div class="gris negrita" style="">Nº: <? echo $prefijo.$numeroFinal ?>/<? echo substr($gestion, -2) ?></div>
                </div>
            </td>
            </tr>
        </table>
        </page_header>

            <table style="width:100%; margin-top: 20px;">
                <tr>
                <td style="font-size: 11px;">
                    <strong>EDUKA-TE SOLUTIONS, S.L.U.</strong><br>
                CIF B76757764<br>
                C./ JOSÉ HERNÁNDEZ ALFONSO, S/N - VISTAS DE CHASNA<br>
                38620 - SAN MIGUEL DE ABONA (SANTA CRUZ DE TENERIFE)<br>
                Teléfono (34) 822615260<br>
                info@eduka-te.com
                </td>
                <? if ( $_POST[empfacturar] != "" ) { ?>

<td style="font-size: 11px;">
    <div style="margin: -30px 0 0 60px; width: 280px"><span class="gris negrita" style="margin-bottom: 5px;">PARA: </span><br>
        <strong><? echo $razonsocial ?></strong><br>
        NIF: <? echo $cif ?><br>
        <? echo $domicilio ?><br>
        <? echo $codigopostal ?> <? echo $poblacion ?><br>
        <? echo $provincia ?>
    </div>
</td>

<? } else { ?>
<td style="font-size: 11px;">
    <div style="margin: -30px 0 0 60px; width: 280px"><span class="gris negrita" style="margin-bottom: 5px;">PARA: </span><br>
        <strong><? echo $row[razonsocial] ?></strong><br>
        NIF: <? echo $row[cif] ?><br>
        <? if ( $row[domiciliofiscal] == "" ) echo $row[domiciliosocial]; else echo $row[domiciliofiscal]; ?><br>
        <? echo $row[codigopostal] ?> <? echo $row[poblacion] ?><br>
        <? echo $row[provincia] ?>
    </div>
</td>
<? } ?>

</tr>
</table>

<table class="tabla-desc" style="margin-top: 35px;width:100%">
                <tr>
                    <th style="width:60%; text-align:center">DESCRIPCIÓN</th>
                    <th style="width:10%; text-align:center">I</th>
                    <th style="width:20%; text-align:center">IMPORTE</th>
                </tr>

                <? if ( $grupo != 26 ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">COSTES FORMACIÓN</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? if ($_POST[empfacturar] != "" ) echo $total; else echo $_POST[importefactura]; ?> €&nbsp;&nbsp;</td>
                </tr>

<!--            <tr><td style="width:40%"> Impartición de cursos de formación continua de reciclaje, acción número 98006: HABILIDADES DIRECTIVAS PARA MANDOS INTERMEDIOS 2015, con una duración de 8 horas, modalidad presencial, para RIUSA II SA según se detalla:</td><td></td><td></td></tr> -->
<!--                 <tr><td style="width:40%"> Impartición de formación:<br><br>
                Impartición de formación: "SOPORTE VITAL BÁSICO Y UTILIZACIÓN DESA" <br>
AF: 98009 ; Duración: 8 horas; Modalidad: Presencial<br>
Lugar de impartición: Aula Desarrollo de RRHH-Playa del Inglés<br>
Horario: 09:00 a 18:00 <br></td><td></td><td></td></tr>
<tr><td>Grupo 00002: El 01 de Diciembre de 2015<br>
Participantes: 08 </td><td></td><td style="text-align:right">530 €&nbsp;&nbsp;</td></tr>
<tr><td>Grupo 00003: El 02 de Diciembre de 2015<br>
Participantes: 08</td><td></td><td style="text-align:right">530 €&nbsp;&nbsp;</td></tr>
 -->
                <!--<tr><td style="width:40%"> AF: 28<br> Duración: 8 horas; Modalidad: Presencial
Lugar de impartición: Aula Desarrollo de RRHH-Playa del Inglés
Horario: 09:00 a 18:00
Grupo 00003: El 19 de Noviembre de 2015; participantes: 08 Grupo 00004: El 20 de Noviembre de 2015; participantes: 08</td><td style="text-align:center">I</td><td style="text-align:right">750 €</td></tr>
                <tr><td style="width:40%"> Grupo 19: Miércoles, 20/05/2015, de 09:00 a 18:00, Riu Palace Tres Islas, a 07 participantes</td><td style="text-align:center">I</td><td style="text-align:right">1000 €</td></tr>
                <tr><td style="width:40%"> Grupo 20: Jueves, 21/05/2015, de 09:00 a 18:00, Riu Palace Tres Islas, a 06 participantes</td><td style="text-align:center">I</td><td style="text-align:right">1000 €</td></tr>
                <tr><td style="width:40%"> Grupo 21: Viernes, 22/05/2015, de 09:00 a 18:00, Riu Palace Tres Islas, a 05 participantes</td><td style="text-align:center">I</td><td style="text-align:right">750 €</td></tr>
 -->
                <? if ( $row[numeroaccion] == "1156" && $row[ngrupo] == '1p' ) $row[denominacion] = "INFORMÁTICA"; ?>
                <tr>
                    <td style="width:60%"><span style="margin: 5px">DENOMINACIÓN ACCIÓN FORMATIVA: </span><br> <span style="margin: 5px"><? echo mb_strtoupper($row[denominacion]) ?></span> </td><td></td><td></td>

                </tr>
                <? if ( $nomostraraf != 1 ) {

                    if ( isset($row[af_factura]) && $row[af_factura] != "" ) {
                        $af = explode('/', $row[af_factura]);
                        $numeroaccion = $af[0];
                        $ngrupo = $af[1];
                    } else {
                        $numeroaccion = $row[numeroaccion];
                        $ngrupo = $row[ngrupo];
                    }

                 ?>
                <tr>
                    <td><span style="margin-left: 5px">Nº ACCIÓN FORMATIVA: <? echo $numeroaccion ?> | Nº GRUPO: <? echo $ngrupo ?></span> </td><td></td><td></td>
                </tr>
                <? } ?>
                <tr>
                    <td><span style="margin-left: 5px">FECHA DE INICIO: <? echo formateaFecha($row[fechaini]) ?></span>  </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">FECHA DE FIN: <? echo formateaFecha($row[fechafin]) ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">MODALIDAD: <? echo mb_strtoupper($row[modalidad]) ?> ( <? echo $row[horastotales] ?> HORAS )</span> </td><td></td><td></td>
                </tr>


                <? if ( $_POST['empfacturar'] == "" ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES EMPRESA: <? echo $row[nparticipantesemp] ?></span> </td><td></td><td></td>
                </tr>
                <? } else { ?>

                    <tr>
                        <td><span style="margin-left: 5px">Nº PARTICIPANTES GRUPO: <? echo $row[nparticipantesgrupo] ?></span> </td><td></td><td></td>
                    </tr>

                <? } ?>
                <? if ($row[diploma] == 'VIN') {

                    $q3 = 'SELECT CONCAT_WS(" ",nombre,apellido,apellido2) as alumno
                    FROM alumnos a, mat_alu_cta_emp ma
                    WHERE ma.id_alumno = a.id
                    AND ma.id_matricula = '.$_POST[mat].'
                    AND ma.id_empresa = '.$_POST[emp];
                    $q3 = mysqli_query($link, $q3);

                    $rb = mysqli_fetch_array($q3);

                    ?>
                <tr>
                    <td><span style="margin-left: 5px">DATOS DEL ALUMNO: <? echo $rb[alumno] ?></span> </td><td></td><td></td>
                </tr>
                <? } ?>

                <? } ?>
                <? if ($_POST['observaciones'] != "") { ?>
                <tr>
                    <td <? if ( $grupo == 26 ) echo 'colspan="3"' ?>>

                    <span style="margin-left: 5px"><? if ( $grupo != 26 ) {
                        echo "OBSERVACIONES: ";
                    } ?>
                    <? if ( $grupo == 26 ) {
                        echo '<br><div style="margin-left: 5px; width:100%">'. nl2br($_POST['observaciones']) .'</div>' ?></span>
                    </td>
                    <? } else {
                        echo '<br><div style="margin-left: 5px; width:400px">'.nl2br($_POST['observaciones'])."</div></span></td><td></td><td></td>";
                    } ?>

                </tr>
                <? } ?>

                <tr>
                    <td style="text-align:right" colspan="2">SUBTOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? if ($_POST[empfacturar] != "" ) echo $total; else echo $_POST[importefactura];  ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">ANTICIPO&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[anticipo] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TIPO IMPOSITIVO&nbsp;&nbsp;</td><td style="font-size: 9px; text-align:center">exento igic artículo 50.1. 9º <br>Ley 4/2012 de medidas administrativas y fiscales&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">OTROS&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[otro] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo $total ?> €&nbsp;&nbsp;</td>
                </tr>
                 <tr style="background-color: #ccc">
                    <td style="text-align:right" colspan="2"></td><td></td>
                </tr>
                <tr>
                    <td style="text-align:left" colspan="3">&nbsp;&nbsp;FORMA DE PAGO:
                    <?

                    // $cifs_march = array('B38751913','B35379841','A38033494','A38089926','H38248852','H38364014','B76534742','E76010859','B38555140','A58058595','W8262389C','B61742565','B38039145','B38013744','A38356937','B38077590','B38015293','B38489688','A38010567','B38528683','A38501482','A61691739','B38062683','A38856571','A07295462','B38597852','B38964490','B38508081','B38379681','A31175383','B76152040','B76097682','A38033502','B38065090','A07632474','B38029971','A35474832','B38086260','A35442904','B86721172','B76014463');

                    
                    $caixa = "LA CAIXA - IBAN: ES38 2100 6786 8102 0018 0068";
                   

                    // if ( in_array($row['cif'], $cifs_march) )
                        // $cuenta = $march;
                    // else
                        $cuenta = $caixa;

                    if ( $_POST[formapago] == "Transferencia" )
                        echo $_POST[formapago]. " bancaria a la cuenta ".$cuenta;
                    else echo $_POST[formapago];

                    ?>

                    <br>
                    Fecha de vencimiento: <? echo formateaFecha($fecha_vencimiento); ?>
                    </td>
                </tr>

            </table>

            <!-- <p style="margin-top: 30px; text-align:center "><i><strong>GRACIAS POR CONFIAR EN NOSOTROS</strong></i></p>

            <div style="margin: 10px 0 0 220px;"><img src="img/logo.png" style="width:200px" alt=""></div> -->

        <page_footer>
           <!--  <div style="left:0px; "><img style="margin-bottom: 20px;width:150px" src="img/logo.png" alt=""></div> -->
            <div style="padding: 0 40px 15px 40px ;"><p style="text-align:justify; font-size: 8px">RGPD·RESPONSABLE ·Eduka-te Solutions SLU | FINALIDAD DEL TRATAMIENTO· Mantener y seguir el cumplimiento de/l servicio/s solicitado/s y/o contratado/s como cliente y/o la gestión comercial.| LEGITIMACIÓN · Consentimiento del interesado y/o cumplimiento de/l servicio/s y/o contrato/s | DESTINATARIOS · No se cederán datos a terceros, salvo obligación legal | DERECHOS · Usted podrá solicitar el acceso, rectificación y/o supresión de sus datos, así como otros derechos, como se explica en la información adicional.</p></div>
         <div style="padding: 0 40px 15px 40px ;"><p style="text-align:center; font-size: 8px">Puede consultar la información adicional y detallada sobre Protección de Datos en nuestra página web: http://eduka-te.avisolegal.info/.
</p></div>
        </page_footer>
    </page>

<?
    }

    $content = ob_get_clean();

    $html2pdf = new HTML2PDF('P', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
    // $html2pdf->setModeDebug();
    $html2pdf->setDefaultFont('Arial');
    // $content = mb_convert_encoding($content, 'UTF-8', 'UTF-8');
    $html2pdf->writeHTML($content);
    // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
    // $html2pdf->Output($nombreFichero);
    // echo $nombreFichero;
    if ( isset($_POST[genera]) || isset($_POST[modifica]) ) {
        $html2pdf->Output($nombreFichero,'F');
        // echo "ey";
        echo $idfactura;
    }
    else
        $html2pdf->Output($nombreFichero);

} else {
    echo "existe";
}