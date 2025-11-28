<?

    // session_start();

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    // $anio = devuelveAnioReal();
    setlocale(LC_TIME,"es_ES");


    $q5 = 'SELECT numero
    FROM facturacion_bonificada
    WHERE empresa = '.$_POST[emp].'
    AND matricula = '.$_POST[mat].'
    AND estado <> "Rectificada"';
    // echo $q;
    $q5 = mysqli_query($link, $q5);

    if ( mysqli_num_rows($q5) == 0 || isset($_POST[modifica]) ) {

$prefijo = '';
$fechaActual = date('Y-m-d H:i:s');
// echo $fechaActual;
$q = 'SELECT MAX(numero) as numero FROM facturacion_bonificada LIMIT 0,1';
$q = mysqli_query($link, $q);
$row = mysqli_fetch_array($q);
$numeroMaxTabla = $row[numero]+1;
$numero = $_POST[numero];// $numero = $numero[1];

if ( $numeroMaxTabla == $numero )
    $numeroFinal = $numero;
else
    $numeroFinal = $numeroMaxTabla;

if ( isset($_POST[modifica]) ) $numeroFinal = $numero;

// $numeroFinal = '271';

$q = 'SELECT @idmat:=m.id, @idemp:=e.id, mc.costes_imparticion, mc.importe_a_bonificar, m.fechaini, m.fechafin, a.id as id_accion, a.denominacion, a.numeroaccion, ga.ngrupo, e.razonsocial, a.horastotales,a.modalidad, e.*, (SELECT count(*) FROM mat_alu_cta_emp WHERE id_matricula = @idmat AND tipo = "") as nparticipantesgrupo , (SELECT count(*) FROM mat_alu_cta_emp WHERE id_empresa = @idemp AND id_matricula = @idmat AND tipo = "") as nparticipantesemp, mc.mes_bonificable, mc.igic
FROM mat_costes mc, matriculas m, mat_alu_cta_emp ma, acciones a, grupos_acciones ga, empresas e
WHERE mc.id_matricula = m.id
AND m.id = ma.id_matricula
AND ma.id_empresa = e.id
AND ma.id_empresa = mc.id_empresa
AND m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id = '.$_POST[mat].'
AND ma.id_empresa = '.$_POST[emp];
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

.tabla-desc td { border:1px solid #ccc; height: 17px; font-size: 12px;  }
.tabla-desc th { border:1px solid #ccc; text-align: center; height: 20px; background-color: #ccc }

</style>

<?

    while ( $row = mysqli_fetch_array($q) ) {

        $mes_bonificable = $row[mes_bonificable];
        $empresa = quitaTildesConComas($row[razonsocial]);
       
        $nombreFichero = 'facturas/'.$prefijo.$numeroFinal.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        if ( $row[domiciliofiscal] == "" || $row[domiciliofiscal] === NULL ) {
            $direccion = $row[domiciliosocial];
        } else {
            $direccion = $row[domiciliofiscal];
        }


        $igic = $row[igic];

        if ( $igic != 0 && $igic != "" ) {
            $total = $_POST[costes_imparticion]+$_POST[costes_organizacion];
        } else {
            $total = $_POST[importefactura]+$_POST[impuesto]+$_POST[otro];
        }
        $total2 = $total+$igic;
        $pendiente = $total2-$_POST[anticipo];
        // $total = $total + $_POST[costes_organizacion] + $_POST[costes_indirectos];

        if ($row[importe_a_bonificar] != 0 && $row[importe_a_bonificar] != NULL && $row[importe_a_bonificar] != "" )
            $abonif = $row[importe_a_bonificar];
        else $abonif = $total2;

        if ( $_POST['fechafactura'] >= "2023-12-01" && $_POST['fechafactura'] <= "2023-12-31" ) {
            $fecha_vencimiento = "2023-01-31";
        } else {
            $fecha_vencimiento = date('Y-m-d', strtotime($_POST[fechafactura]. ' + '.$_POST[vencimiento].' days'));
        }

        if ( isset($_POST[genera]) ) {

            $q = 'INSERT INTO `facturacion_bonificada`(`numero`, `fecha`, `empresa`, `cobrado`, `base_facturacion`, `base_imponible`, `igic`, `total_factura`, `importe_a_abonar`, `fecha_generacion`, `matricula`, `vencimiento`, `impuesto`, `formapago`, `fecha_vencimiento`, `importe_a_bonificar`, `observaciones`, `costes_organizacion`, `costes_indirectos`, `costes_imparticion`)
            VALUES ("'.$numeroFinal.'", "'.$_POST[fechafactura].'", "'.$_POST[emp].'", "'.$_POST[anticipo].'", "'.$_POST[importefactura].'", "'.$_POST[importefactura].'", "'.$igic.'", "'.$total2.'", "'.$pendiente.'", "'.$fechaActual.'", "'.$_POST[mat].'", "'.$_POST[vencimiento].'", "'.$_POST[impuesto].'","'.$_POST[formapago].'","'.$fecha_vencimiento.'","'.$abonif.'","'.addslashes($_POST[observaciones]).'","'.$_POST[costes_organizacion].'","'.$_POST[costes_indirectos].'","'.$_POST[costes_imparticion].'")';
            // echo $q;
            $q = mysqli_query($link, $q);
            $idfactura = mysqli_insert_id($link);

            $q1 = 'UPDATE `mat_alu_cta_emp` SET factura = "'.$idfactura.'" WHERE id_empresa = '.$_POST[emp].' AND id_matricula = '.$_POST[mat]. ' AND tipo = ""';
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

            if ( $rx[suma] == NULL || $rx[suma] == 0 ) {
                $q3 = 'UPDATE `matriculas` SET estado = "Facturada" WHERE id = '.$_POST[mat];
                $q3 = mysqli_query($link, $q3);
            }

        } else if ( isset($_POST[modifica]) ) {

            $q = 'UPDATE facturacion_bonificada SET fecha = "'.$_POST[fechafactura].'", cobrado = "'.$_POST[anticipo].'", base_facturacion = "'.$_POST[importefactura].'", base_imponible = "'.$_POST[importefactura].'", importe_a_abonar = "'.$pendiente.'", importe_a_bonificar = "'.$abonif.'", total_factura = "'.$total2.'", igic = "'.$igic.'", fecha_generacion = "'.$fechaActual.'", vencimiento = "'.$_POST[vencimiento].'", impuesto = "'.$_POST[impuesto].'", formapago = "'.$_POST[formapago].'", fecha_vencimiento = "'.$fecha_vencimiento.'", observaciones = "'.addslashes($_POST[observaciones]).'", costes_organizacion = "'.$_POST[costes_organizacion].'", costes_indirectos = "'.$_POST[costes_indirectos].'", costes_imparticion = "'.$_POST[costes_imparticion].'" WHERE id = '.$_POST[idfac];
            // echo $q;
            $q = mysqli_query($link, $q);

        }

        // $fechafra = date('Y-m-d', strtotime("last day of this month"));
        $fechafracobro = date('Y-m-d', strtotime("+2 months", strtotime($_POST[fechafactura])));
        $mescobro = strftime('%B', strtotime($fechafracobro)).' de '.strftime('%Y', strtotime($fechafracobro));

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
                   <!-- <div class="gris negrita" style="">Nº: <? echo $numeroFinal ?>/23</div> -->
                    <div class="gris negrita" style="">Nº: <? echo $numeroFinal ?>/<? echo substr($gestion, -2) ?></div>
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
                <td style="font-size: 11px;">
                    <div style="margin: -30px 0 0 60px; width: 280px"><span class="gris negrita" style="margin-bottom: 5px;">PARA: </span><br>
                        <strong><? echo $row[razonsocial] ?></strong><br>
                        NIF: <? echo $row[cif] ?><br>
                        <? echo $direccion ?><br>
                        <? echo $row[codigopostal] ?> <? echo $row[poblacion] ?><br>
                        <? echo $row[provincia] ?>
                    </div>
                </td>
                </tr>
            </table>

            <table class="tabla-desc" style="margin-top: 35px;width:100%">
                <tr>
                    <th style="width:60%; text-align:center">DESCRIPCIÓN</th>
                    <th style="width:10%; text-align:center">I</th>
                    <th style="width:20%; text-align:center">IMPORTE</th>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">COSTES DIRECTOS</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo $_POST[costes_imparticion] ?> €&nbsp;&nbsp;</td>
                </tr>

                <? if ( $_POST[costes_organizacion] != 0 ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">COSTES ORGANIZACIÓN</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo $_POST[costes_organizacion] ?> €&nbsp;&nbsp;</td>
                </tr><? } ?>

                <? if ( $_POST[costes_indirectos] != 0 ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">COSTES INDIRECTOS</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo $_POST[costes_indirectos] ?> €&nbsp;&nbsp;</td>
                </tr><? } ?>

                <tr>
                    <td></td><td></td><td></td>
                </tr>
                <tr>
                    <td style="width:60%"><span style="margin: 5px">DENOMINACIÓN ACCIÓN FORMATIVA: </span><br> <span style="margin: 5px"><? echo mb_strtoupper($row[denominacion]) ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">Nº ACCIÓN FORMATIVA: <? echo $row[numeroaccion] ?> | Nº GRUPO: <? echo $row[ngrupo] ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">FECHA DE INICIO: <? echo formateaFecha($row[fechaini]) ?></span>  </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">FECHA DE FIN: <? echo formateaFecha($row[fechafin]) ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">MODALIDAD: <? echo mb_strtoupper($row[modalidad]) ?> ( <? echo $row[horastotales] ?> HORAS )</span> </td><td></td><td></td>
                </tr>
                
                <tr>
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES EMPRESA: <? echo $row[nparticipantesemp] ?></span> </td><td></td><td></td>
                </tr>
                <? if ($_POST['observaciones'] != "") { ?>
                <tr>
                    <td><span style="margin-left: 5px">OBSERVACIONES: <? echo '<br><div style="margin-left: 5px; width:400px">'. nl2br($_POST['observaciones']) .'</div>' ?></span> </td><td></td><td></td>
                </tr>
                <? } ?>

                <? if ( $igic != "" && $igic != "0" ) { ?>
                <tr>
                    <td style="text-align:right" colspan="2">Otros costes&nbsp;&nbsp;<br>no bonificables&nbsp;&nbsp;</td><td style="text-align:right"><? echo $igic ?> €&nbsp;&nbsp;</td>
                </tr>
                <? } ?>
                <tr>
                    <td style="text-align:right" colspan="2">TIPO IMPOSITIVO&nbsp;&nbsp;</td><td style="font-size: 9px; text-align:center">Exento igic artículo 50.1. 9º<br>Ley 4/2012 de medidas administrativas y fiscales&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">IGIC&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[impuesto] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">OTROS&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[otro] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo $total2 ?> €&nbsp;&nbsp;</td>
                </tr>
                 <tr style="background-color: #ccc">
                    <td style="text-align:right" colspan="2"></td><td></td>
                </tr>
                <?
                // echo $row[importe_a_bonificar];
                if ($row[importe_a_bonificar] != 0 && $row[importe_a_bonificar] != NULL && $row[importe_a_bonificar] != "" )
                    $abonif = $row[importe_a_bonificar];
                else $abonif = $total2; ?>

                
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
    $html2pdf->writeHTML($content);
    // $html2pdf->createIndex('indice', 25, 12, false, true, 2);
    if ( isset($_POST[genera]) || isset($_POST[modifica]) ) {
        $html2pdf->Output($nombreFichero, 'F');
        echo $idfactura;
    }
    else
        $html2pdf->Output($nombreFichero);

    // echo $idfactura;

} else {
    echo "existe";
}

?>
