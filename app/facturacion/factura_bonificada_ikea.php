<?
    
    // session_start();

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    // $gestion = devuelveAnio();
    setlocale(LC_TIME,"es_ES");

    // echo $_POST[tipofra];
    if ( $_POST[tipofra] == 'gestion' ) {
        $q5 = 'SELECT numero
        FROM facturacion_privada 
        WHERE empresa = '.$_POST[emp].' 
        AND matricula = '.$_POST[mat];
    } else {
        $q5 = 'SELECT numero
        FROM facturacion_bonificada
        WHERE empresa = '.$_POST[emp].' 
        AND matricula = '.$_POST[mat];
    }
    // echo $q;
    $q5 = mysqli_query($link, $q5);

    if ( mysqli_num_rows($q5) == 0 || isset($_POST[modifica]) ) { 

    if ( $_POST[tipofra] == 'gestion' ) {
        $prefijo = 'P';
        $q = 'SELECT MAX(numero) as numero FROM facturacion_privada LIMIT 0,1';
    }
    else {
        $q = 'SELECT MAX(numero) as numero FROM facturacion_bonificada LIMIT 0,1';
        $prefijo = '';
    }

    $fechaActual = date('Y-m-d H:i:s');

    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_array($q);
    $numeroMaxTabla = $row[numero]+1;
    $numero = $_POST[numero];// $numero = $numero[1];

    if ( $numeroMaxTabla == $numero )
        $numeroFinal = $numero;
    else
        $numeroFinal = $numeroMaxTabla;

    if ( isset($_POST[modifica]) ) $numeroFinal = $numero;

    $q = 'SELECT @idmat:=m.id, @idemp:=e.id, mc.costes_imparticion, m.fechaini, m.fechafin, a.id as id_accion, a.denominacion, a.numeroaccion, ga.ngrupo, e.razonsocial, a.horastotales,a.modalidad, e.*, (SELECT count(*) FROM mat_alu_cta_emp WHERE id_matricula = @idmat AND tipo = "") as nparticipantesgrupo , (SELECT count(*) FROM mat_alu_cta_emp WHERE id_empresa = @idemp AND id_matricula = @idmat AND tipo = "") as nparticipantesemp
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

.tabla-desc td { border:1px solid #ccc; height: 20px; font-size: 12px;  }
.tabla-desc th { border:1px solid #ccc; text-align: center; height: 30px; background-color: #ccc }

</style>

<?

    while ( $row = mysqli_fetch_array($q) ) {

        $empresa = quitaTildesConComas($row[razonsocial]);
        $nombreFichero = 'facturas/'.$prefijo.$numeroFinal.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        $total = $_POST[importefactura]+$_POST[impuesto]+$_POST[otro];
        $pendiente = $total-$_POST[anticipo];

        $fecha_vencimiento = date('Y-m-d', strtotime($_POST[fechafactura]. ' + '.$_POST[vencimiento].' days'));

        if ( isset($_POST[genera]) ) {
            
            if ( $_POST[tipofra] == 'gestion' ) 
                $q = 'INSERT INTO `facturacion_privada`(`numero`, `fecha`, `empresa`, `cobrado`, `base_facturacion`, `base_imponible`, `igic`, `total_factura`, `importe_a_abonar`, `fecha_generacion`, `matricula`, `vencimiento`, `impuesto`, `formapago`, `fecha_vencimiento`, `importe_a_bonificar`, `observaciones`, `IKEA`) 
                VALUES ("'.$numeroFinal.'", "'.$_POST[fechafactura].'", "'.$_POST[emp].'", "'.$_POST[anticipo].'", "'.$_POST[importefactura].'", "'.$_POST[importefactura].'", "0", "'.$total.'", "'.$pendiente.'", "'.$fechaActual.'", "'.$_POST[mat].'", "'.$_POST[vencimiento].'", "'.$_POST[impuesto].'","'.$_POST[formapago].'","'.$fecha_vencimiento.'","'.$_POST[costes_imparticion].'","'.$_POST[observaciones].'", "1")';  
            else
                $q = 'INSERT INTO `facturacion_bonificada`(`numero`, `fecha`, `empresa`, `cobrado`, `base_facturacion`, `base_imponible`, `igic`, `total_factura`, `importe_a_abonar`, `fecha_generacion`, `matricula`, `vencimiento`, `impuesto`, `formapago`, `fecha_vencimiento`, `importe_a_bonificar`, `observaciones`, `IKEA`) 
                VALUES ("'.$numeroFinal.'", "'.$_POST[fechafactura].'", "'.$_POST[emp].'", "'.$_POST[anticipo].'", "'.$_POST[importefactura].'", "'.$_POST[importefactura].'", "0", "'.$total.'", "'.$pendiente.'", "'.$fechaActual.'", "'.$_POST[mat].'", "'.$_POST[vencimiento].'", "'.$_POST[impuesto].'","'.$_POST[formapago].'","'.$fecha_vencimiento.'","'.$_POST[costes_imparticion].'","'.$_POST[observaciones].'", "1")';  

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

            if ( $_POST[tipofra] == 'gestion' ) 
                $q = 'UPDATE facturacion_privada SET fecha = "'.$_POST[fechafactura].'", cobrado = "'.$_POST[anticipo].'", base_facturacion = "'.$_POST[importefactura].'", base_imponible = "'.$_POST[importefactura].'", importe_a_abonar = "'.$pendiente.'", importe_a_bonificar = "'.$_POST[costes_imparticion].'", total_factura = "'.$total.'", fecha_generacion = "'.$fechaActual.'", vencimiento = "'.$_POST[vencimiento].'", impuesto = "'.$_POST[impuesto].'", formapago = "'.$_POST[formapago].'", fecha_vencimiento = "'.$fecha_vencimiento.'", observaciones = "'.$_POST[observaciones].'", IKEA = "1" WHERE id = '.$_POST[idfac];
            else
                $q = 'UPDATE facturacion_bonificada SET fecha = "'.$_POST[fechafactura].'", cobrado = "'.$_POST[anticipo].'", base_facturacion = "'.$_POST[importefactura].'", base_imponible = "'.$_POST[importefactura].'", importe_a_abonar = "'.$pendiente.'", importe_a_bonificar = "'.$_POST[costes_imparticion].'", total_factura = "'.$total.'", fecha_generacion = "'.$fechaActual.'", vencimiento = "'.$_POST[vencimiento].'", impuesto = "'.$_POST[impuesto].'", formapago = "'.$_POST[formapago].'", fecha_vencimiento = "'.$fecha_vencimiento.'", observaciones = "'.$_POST[observaciones].'", IKEA = "1" WHERE id = '.$_POST[idfac];
            // echo $q;
            $q = mysqli_query($link, $q);

        }

        $q = 'UPDATE empresas SET vencimiento = "'.$_POST[vencimiento].'" WHERE id = '.$_POST[emp];
        $q = mysqli_query($link, $q);


?>
<page backleft="40px" backright="40px" backtop="140px" backbottom="60px" pagegroup="new">
        <page_header height="100px">        
        <table>
            <tr>
            <td>
                <div style="margin: 30px 0 0 30px"><img style="width: 200px" src="img/esfocclogo.png" alt=""></div>
            </td>
            <td>
                <div style="margin: 40px 0 0 350px; color: #ccc; font-weight: bold">
                    <span style="font-size: 32px;">FACTURA</span><br>
                    <div class="gris negrita" style="margin-top:5px">FECHA: <? echo formateaFecha($_POST[fechafactura]) ?></div>
                    <div class="gris negrita" style="">Nº: <? echo $numeroFinal ?></div>
                </div>
            </td>
            </tr>
        </table>
        </page_header>

            <table style="width:100%; margin-top: 20px;">
                <tr>
                <td style="font-size: 11px;">
                    <strong>ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN SL</strong><br>
                CIF B76567718<br>
                C./ LAS SEGUIDILLAS, 9 - ZONA INDUSTRIAL LLANOS DEL CAMELLO<br> 
                38639 CHAFIRAS, LAS (SAN MIGUEL DE ABONA)<br>
                Teléfono (34) 922100008-922104980<br>
                Fax (34) 922103580
                </td>
                <td style="font-size: 11px;">
                    <div style="margin: -30px 0 0 60px; width: 280px"><span class="gris negrita" style="margin-bottom: 5px;">PARA: </span><br>
                        <strong><? echo $row[razonsocial] ?></strong><br> 
                        NIF: <? echo $row[cif] ?><br>
                        <? echo $row[domiciliosocial] ?><br>
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

                <? if ( $_POST[tipofra] == 'formacion' ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">COSTES FORMACIÓN</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo $_POST[costes_imparticion] ?> €&nbsp;&nbsp;</td>
                </tr>
                <? } ?>

                <? if ( $_POST[tipofra] == 'gestion' ) { ?>
                <tr>
                    <td><span style="margin-left: 5px">COSTE GESTIÓN FORMACIÓN</span></td><td style="text-align:center"> I </td><td style="text-align:right"><? echo $_POST[importefactura] ?> €&nbsp;&nbsp;</td>
                </tr>
                <? } ?>
                <tr>
                    <td><span style="margin-left: 5px">Nº EXPEDIENTE ENTIDAD ORGANIZADORA: B141798AD</span></td><td style="text-align:center"></td><td></td>
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
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES GRUPO: <? echo $row[nparticipantesgrupo] ?></span> </td><td></td><td></td>
                </tr>
                <tr>
                    <td><span style="margin-left: 5px">Nº PARTICIPANTES EMPRESA: <? echo $row[nparticipantesemp] ?></span> </td><td></td><td></td>
                </tr>
                <? if ($_POST['observaciones'] != "") { ?>
                <tr>
                    <td><span style="margin-left: 5px">OBSERVACIONES: <? echo '<br><div style="margin-left: 5px; width:400px">'. nl2br($_POST['observaciones']) .'</div>' ?></span> </td><td></td><td></td>
                </tr>
                <? } ?>
                <tr>
                    <td style="text-align:right" colspan="2">SUBTOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[importefactura] ?>&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">ANTICIPO&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[anticipo] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TIPO IMPOSITIVO&nbsp;&nbsp;</td><td style="font-size: 9px; text-align:center">exento igic artículo 50. Uno. 10o <br>Ley 4/2012 de medidas administrativas y fiscales&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">IMPUESTO SOBRE VENTAS&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[impuesto] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">TOTAL&nbsp;&nbsp;</td><td style="text-align:right"><? echo $total ?> €&nbsp;&nbsp;</td>
                </tr>
                 <tr style="background-color: #ccc">
                    <td style="text-align:right" colspan="2"></td><td></td>
                </tr>
                <? if ( $_POST[tipofra] == 'formacion' ) { ?>
                <tr>
                    <td style="text-align:right" colspan="2">IMPORTE A BONIFICAR&nbsp;&nbsp;</td><td style="text-align:right"><? echo $_POST[costes_imparticion] ?> €&nbsp;&nbsp;</td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">BONIFICACIÓN&nbsp;&nbsp;</td><td style="text-align:center">TC DE <? echo strtoupper(strftime("%B", strtotime($row[fechafin]))); ?> DE <? echo $anio ?></td>
                </tr>
                <tr>
                    <td style="text-align:right" colspan="2">LÍMITE BONIFICACIÓN&nbsp;&nbsp;</td><td style="text-align:center">TC DE DICIEMBRE DE <? echo $anio ?></td>
                </tr>
                <? } ?>
                <tr>
                     <td style="text-align:left" colspan="3">&nbsp;&nbsp;FORMA DE PAGO: 
                    <? 
                    if ( $_POST[formapago] == "Transferencia" ) 
                        echo $_POST[formapago]. " bancaria a la cuenta LA CAIXA - IBAN: ES79 2100 3926 6102 0017 8101";
                    else echo $_POST[formapago];
                     ?>
                    <br>
                    Fecha de vencimiento: <? echo formateaFecha($fecha_vencimiento); ?> 
                    </td>
                </tr>

            </table>

            <p style="margin-top: 30px; text-align:center "><i><strong>GRACIAS POR CONFIAR EN NOSOTROS</strong></i></p>

            <div style="margin: 10px 0 0 200px;"><img src="img/firma_admin_esfocc.png" style="width:230px" alt=""></div>

        <page_footer>
            <div style="left:0px; "><img style="margin-bottom: 20px;width:150px" src="img/logo-ISO9001_color.png" alt=""></div>
            <div style="padding: 0 40px 15px 40px ;"><p style="text-align:center; font-size: 8px">Escuela Superior de Formación y Cualificación, S.L.U. inscrita en el Registro Mercantil de Santa Cruz de Tenerife en el Folio 40, del tomo 3224, hoja TF-49976, inscripción 1a, C.I.F B-76567718</p></div>
         <div style="padding: 0 40px 15px 40px ;"><p style="text-align:justify; font-size: 8px">En cumplimiento de lo que se dispone en el artículo 5 de la Ley Orgánica 15/1999, de 13 de diciembre, de Protección de Datos de Carácter Personal (LOPD), Escuela Superior de Formación y Cualificación S.L.U. le informa que los datos de carácter personal que nos proporciona se recogerán en el fichero “CLIENTES” cuyo responsable es   ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L.U., con la finalidad de gestionar nuestra relación comercial y, en su caso, la exposición de imágenes.

En virtud de lo dispuesto en el artículo 15 y siguientes de la LOPD y en los términos que indica su Reglamento de desarrollo aprobado por Real Decreto 1720/2007, de 21 de diciembre, en cualquier momento el titular de los datos personales podrá ejercer sus derechos de acceso, rectificación, cancelación y oposición, dirigiéndose por escrito a ESCUELA SUPERIOR DE FORMACIÓN Y CUALIFICACIÓN S.L.U  (C/ Seguidillas, nº 9, Plan parcial Llano del Camello 38639. San Miguel de Abona. Sta. Cruz de Tenerife).
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
