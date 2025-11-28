<?

    //$baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');
    setlocale(LC_TIME,"es_ES");


// print_r($_POST);

// echo $_POST[motivo];
// echo $_POST[nuevoimporte];
if ($_POST[tabla] == 'facturacion_bonificada') $tipo = ''; else $tipo = "Privado";

$prefijo = 'R';
$fechaActual = date('Y-m-d H:i:s');
//echo $fechaActual;
$q = 'SELECT MAX(numero) as numero,prefijo FROM facturacion_rectificativa LIMIT 0,1';
$q = mysqli_query($link, $q);
$row = mysqli_fetch_array($q);
$numero = $row[numero]+1;
$numerof = $prefijo.$numero;
//echo $numerof;


if ($_POST[empfacturar] != 0) {
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


$q = 'SELECT @idmat:=m.id, @idemp:=e.id, mc.costes_imparticion, m.fechaini, m.fechafin, a.id as id_accion, a.denominacion, a.numeroaccion, ga.ngrupo, e.razonsocial, a.horastotales,a.modalidad, e.*, (SELECT count(*) FROM mat_alu_cta_emp WHERE id_matricula = @idmat ) as nparticipantesgrupo , (SELECT count(*) FROM mat_alu_cta_emp WHERE id_empresa = @idemp AND id_matricula = @idmat) as nparticipantesemp, c.email as emailcomercial
FROM mat_costes mc, matriculas m, mat_alu_cta_emp ma, acciones a, grupos_acciones ga, empresas e, '.$_POST[tabla].' f, comerciales c
WHERE mc.id_matricula = m.id
AND c.id = e.comercial
AND m.id = ma.id_matricula
AND ma.id_empresa = e.id
AND m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id = '.$_POST[mat].'
AND ma.id_empresa = '.$_POST[emp].'
AND f.id = '.$_POST[idfac].'
GROUP BY e.id, m.id';
 //echo $q;
$q = mysqli_query($link, $q);

 //echo $_POST[motivo];
 //echo $_POST[nuevoimporte];

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

.tabla-desc td { border:1px solid #ccc; height: 20px; font-size: 12px;  }
.tabla-desc th { border:1px solid #ccc; text-align: center; height: 30px; background-color: #ccc }

</style>

<?

    while ( $row = mysqli_fetch_array($q) ) {

        $emailcomercial = $row[emailcomercial];
        if ( $_POST[empfacturar] != 0 ) {
            $empresa = quitaTildesConComas($razonsocial);
            $nombreFichero = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        } else {
            $empresa = quitaTildesConComas($row[razonsocial]);
            $nombreFichero = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        }

        // $total = $_POST[importefactura]+$_POST[impuesto]+$_POST[otro]-$_POST[anticipo];
        $total = $_POST[nuevoimporte];

        if ( isset($_POST[genera]) && $_POST[genera] == '1' ) {

            $q1 = 'UPDATE '.$_POST[tabla].' SET estado = "Rectificada" WHERE id = '.$_POST[idfac];
            // echo $q1;
            $q1 = mysqli_query($link, $q1);

            $q = 'INSERT INTO `facturacion_rectificativa`(`numero`, `fecha`, `empresa`, `cobrado`, `base_facturacion`, `base_imponible`, `igic`, `total_factura`, `importe_a_abonar`, `fecha_generacion`, `matricula`, `vencimiento`, `impuesto`, `formapago`, `motivo`, `nuevo_importe`, `factura_rectificada`, `facturar_a`)
            VALUES ("'.$numero.'", "'.$_POST[fechaform].'", "'.$_POST[emp].'", "'.$_POST[anticipo].'", "'.$_POST[importefactura].'", "'.$_POST[importefactura].'", "0", "'.$total.'", "0", "'.$fechaActual.'", "'.$_POST[mat].'", "'.$_POST[vencimiento].'", "'.$_POST[impuesto].'","'.$_POST[formapago].'","'.$_POST[motivoform].'", "'.$total.'", "'.$_POST[idfac].'","'.$_POST[empfacturar].'")';
            // echo $q;
            $q = mysqli_query($link, $q);
            $idfactura = mysqli_insert_id($link);


            $q1 = 'UPDATE `mat_alu_cta_emp` SET factura = "'.$idfactura.'" WHERE id_empresa = '.$_POST[emp].' AND id_matricula = '.$_POST[mat]. ' AND tipo = "'.$tipo.'"';
            // echo $q1;
            $q1 = mysqli_query($link, $q1);


        }

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
                    <div class="gris negrita" style="margin-top:5px">FECHA: <? echo formateaFecha($_POST[fechaform]) ?></div>
                    <div class="gris negrita" style="">Nº: <? echo $numerof ?></div>
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
                <? if ( $_POST[empfacturar] != 0 ) { ?>

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
                <tr>
                    <td><span style="margin-left: 5px">COSTES FORMACIÓN</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo '('.abs($_POST[nuevoimporte]).')' ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">Nº EXPEDIENTE ENTIDAD ORGANIZADORA: B160251AA</span></td><td style="text-align:center"></td><td></td>
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
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES GRUPO: <? echo $row[nparticipantesgrupo] ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES EMPRESA: <? echo $row[nparticipantesemp] ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px"><div style="width:400px"><? echo $_POST[motivoform] ?></div></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px"><div style="width:400px">La presente factura rectifica la factura Nº <? echo $_POST[nfacturaorig].', de fecha '.$_POST[fechaorig].', en importe de: '. $_POST[nuevoimporte] ?> € </div></span> </td><td></td><td></td>
                </tr>



                <tr>
                    <td style="text-align:right" colspan="2">SUBTOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo '('.abs($_POST[nuevoimporte]).')' ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">ANTICIPO&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[anticipo] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TIPO IMPOSITIVO&nbsp;&nbsp;</td><td style="font-size: 9px; text-align:center">exento igic artículo 50.1. 9º <br>Ley 4/2012 de medidas administrativas y fiscales&nbsp;&nbsp;</td>
                </tr>

                <? if ( $_POST[tabla] == 'facturacion_bonificada' ) { ?>
                <tr>
                    <td style="text-align:right" colspan="2">IMPUESTO SOBRE VENTAS&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[impuesto] ?> €&nbsp;&nbsp;</td>
                </tr>
                <? } ?>

                <tr>
                    <td style="text-align:right" colspan="2">OTROS&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[otro] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo '('.abs($_POST[nuevoimporte]).')' ?> €&nbsp;&nbsp;</td>
                </tr>
                 <tr style="background-color: #ccc">
                    <td style="text-align:right" colspan="2"></td><td></td>
                </tr>

                <? if ( $_POST[tabla] == 'facturacion_bonificada' ) { ?>
                <tr>
                    <td style="text-align:right" colspan="2">IMPORTE A BONIFICAR&nbsp;&nbsp;</td><td style="text-align:right"><? echo '('.abs($_POST[nuevoimporte]).')' ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">BONIFICACIÓN&nbsp;&nbsp;</td><td style="text-align:center">TC DE <? echo strtoupper(strftime("%B", strtotime($row[fechafin]))); ?> DE <? echo date("Y") ?></td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">LÍMITE BONIFICACIÓN&nbsp;&nbsp;</td><td style="text-align:center">TC DE DICIEMBRE DE <? echo date("Y") ?></td>
                </tr>
                <? } ?>

                <tr>

                    <td style="text-align:left" colspan="3">&nbsp;&nbsp;FORMA DE PAGO:

                    <?

                    $cifs_march = array('B38751913','B35379841','A38033494','A38089926','H38248852','H38364014','B76534742','E76010859','B38555140','A58058595','W8262389C','B61742565','B38039145','B38013744','A38356937','B38077590','B38015293','B38489688','A38010567','B38528683','A38501482','A61691739','B38062683','A38856571','A07295462','B38597852','B38964490','B38508081','B38379681','A31175383','B76152040','B76097682','A38033502','B38065090','A07632474','B38029971','A35474832','B38086260','A35442904','B86721172','B76014463');

                   $caixa = "LA CAIXA - IBAN: ES38 2100 6786 8102 0018 0068";

                    //if ( in_array($row['cif'], $cifs_march) )
                      //  $cuenta = $march;
                    //else
                        $cuenta = $caixa;

                    if ( $_POST[formapago] == "Transferencia" )
                        echo $_POST[formapago]. " bancaria a la cuenta ".$cuenta;
                    else echo $_POST[formapago];

                    ?>

                    <br>
                    </td>
                </tr>

            </table>

           <!-- <p style="margin-top: 20px; text-align:center "><i><strong>GRACIAS POR CONFIAR EN NOSOTROS</strong></i></p>

            <div style="margin: 15px 0 0 200px;"><img src="img/firma_admin_esfocc.png" style="width:250px" alt=""></div>-->


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
    $html2pdf->Output($nombreFichero);
    if ( isset($_POST[genera]) && $_POST[genera] == '1' )
        $html2pdf->Output($nombreFichero,'F');


    $q = 'SELECT numero
    FROM '.$_POST[tabla].'
    WHERE id = '.$_POST[idfac];
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $row = mysqli_fetch_array($q);
    $num = $row[numero];

    if ( $_POST[tabla] == 'facturacion_privada' ) $pref = "P"; else $pref = "";

    if ( isset($_POST[genera]) && $_POST[genera] == '1' ){
        $mail = new PHPMailer();
        $mail->FromName = 'Gestión EDUKA-TE';
        $mail->addAddress('ivan.cabrera@eduka-te.com');
        // $mail->addAddress('cmunoz@eduka-te.com');
        $mail->addAddress($emailcomercial);

        if ( $emailcomercial == 'ivan.cabrera@eduka-te.com' ) {
            $mail->addAddress('ivan.cabrera@eduka-te.com');
            $mail->addAddress('ivan.cabrera@eduka-te.com');
        }

        $mail->CharSet = 'UTF-8';
        $mail->isHTML(true);
        $mail->addAttachment($nombreFichero);

        $mail->Subject = 'NUEVA FACTURA RECTIFICATIVA '.$numerof.' SOBRE '.$pref.$num;
        $mail->Body = $_POST[motivoform];

        if (!$mail->send())
            echo "error";
        else
            echo "bien";
    }

?>
