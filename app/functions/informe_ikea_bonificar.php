<?
    setlocale(LC_TIME, "es_ES");

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
    require_once($baseurl.'/plugins/html2pdf/html2pdf.class.php');

    $gestion = '2016';
    $link = connectAnio($gestion);
    // $mesant = date("m")-1;
    $mesant = date("m");
    $mesant = str_pad($mesant, 2, '0', STR_PAD_LEFT);

    // $fecha_ant = date('Y-m-d', strtotime('first day of last month'));
    $fecha_ant = '2016-12-06';

    // ULTIMO INFORME 5/12/2016
    $fecha = $fecha_ant;
    // $fecha_ant = explode('-', $fecha_ant);
    // $fecha = $fecha_ant[0].'-'.$fecha_ant[1].'-01';

    $q = 'SELECT f.importe_a_bonificar, f.total_factura, f.costes_organizacion, e.*, a.*, ga.*, m.*, e.id as id_empresa, f.cuentacotizacion, e.id, f.prefijo, f.importe_a_bonificar as importe_a_bonificar, factura_privado
    FROM facturacion_privada f, matriculas m, empresas e, acciones a, grupos_acciones ga
    WHERE f.empresa = e.id
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = f.matricula
    AND IKEA = 1
    AND f.estado NOT IN("Rectificada", "Rectificativa")
    AND (f.importe_a_bonificar > 0 AND f.importe_a_bonificar IS NOT NULL)
    AND numeroaccion < 6000
    AND fechafinalizacion >= "'.$fecha.'"
    AND f.cuentacotizacion LIKE "07%"
    UNION
    SELECT f.importe_a_bonificar, f.total_factura, f.costes_organizacion, e.*, a.*, ga.*, m.*, e.id as id_empresa, f.cuentacotizacion, e.id, f.prefijo, f.importe_a_bonificar, factura_privado
    FROM facturacion_bonificada f, matriculas m, empresas e, acciones a, grupos_acciones ga
    WHERE f.empresa = e.id
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = f.matricula
    AND IKEA = 1
    AND f.estado NOT IN("Rectificada", "Rectificativa")
    AND (f.importe_a_bonificar > 0 AND f.importe_a_bonificar IS NOT NULL)
    AND numeroaccion < 6000
    AND fechafinalizacion >= "'.$fecha.'"
    AND f.cuentacotizacion LIKE "07%"
    ORDER BY numeroaccion';
    echo $q;
    $q = mysqli_query($link, $q) or die("error:" . mysqli_error($link) );
    // $date = mktime( 0, 0, 0, $month, 1, $year );
    // $mes = strftime( '%B', strtotime( '-1 month', time() ));
    // $mes = strftime( '%B' );
    // $mes = ucfirst($mes);
    $anio = gestion;




    $cccanarias = array("29","35","38");

    $cuenta = mysqli_num_rows($q);
    for ($i=0; $i < $cuenta; $i++) {
        $resul[$i] = mysqli_fetch_assoc($q);
    }

    // echo "<pre>";
    // print_r($resul);
    // echo "</pre>";

        ob_start();

        ?>


            <style type="text/css">

            * {
                margin:0;
                padding:0;
                /*font-family: 'Conv_estre',Sans-Serif;*/
            }

            th, td { padding: 5px; }
            table { font-size: 12px; border-collapse: collapse; }
            td {border: 1px solid #ccc; overflow: auto}
            th {border: 1px solid #ccc; background-color: #ccc}


            </style>

            <page backleft="40px" backright="40px" backtop="40px" backbottom="40px">


                <table style="width:100%; margin-top: 30px">
                    <thead>
                        <tr>
                            <th style="text-align:center">CIF</th>
                            <th style="text-align:center">Empresa</th>
                            <th style="text-align:center">Cuenta Cotización</th>
                            <th style="text-align:center">Acción/Grupo</th>
                            <th style="text-align:center">Denominación</th>
                            <th style="text-align:center">Horas</th>
                            <th style="text-align:center">Fecha Inicio</th>
                            <th style="text-align:center">Fecha Fin</th>
                            <th style="text-align:center">Fecha Fin<br> Tripartita</th>
                            <th style="text-align:center">Importe a bonificar</th>
                        </tr>
                    </thead>
                    <tbody>


            <?

                for ($i=0; $i < $cuenta; $i++) { $cifs[$i] = $resul[$i][cif]; ?>

                    <tr>

                        <td style="text-align:center" ><? echo $resul[$i][cif] ?></td>
                        <td style="text-align:center" style="width:15%"><? echo $resul[$i][razonsocial] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][cuentacotizacion] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][numeroaccion].'/'. $resul[$i][ngrupo] ?></td>
                        <td style="text-align:center" style="width:20%"><? echo $resul[$i][denominacion] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][horastotales] ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechaini]) ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechafin]) ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechafinalizacion]) ?></td>

                        <td style="text-align:center" ><? echo $resul[$i][importe_a_bonificar] .' €'?></td>

                    </tr>

                <? } ?>

                    </tbody>
                </table>
            </page>

            <?

                // echo "entra";

                // $para = 'maramis@economistas.org';
                $para = 'aperojo@eduka-te.com';


                $cifs = array_unique($cifs);
                $informe = '../documentacion'.$gestion.'/ikea_informes/IKEA_informe_bonificar_'.$mes.$gestion.'_Baleares.pdf';

                $content = ob_get_clean();
                $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
                // $html2pdf->setModeDebug();
                $html2pdf->setDefaultFont('Arial');
                $html2pdf->writeHTML($content);
                $html2pdf->Output($informe, 'F');

                $mail = new PHPMailer();
                $mail->FromName = 'Gestión ESFOCC';

                $mail->addAddress($para);
                $mail->addCC('ccoll_formacion@eduka-te.com');
                $mail->addCC('laura.garcia@woden.es');
                // $mail->addCC('egavalda@eduka-te.com');
                // // $mail->addBCC('aperojo@eduka-te.com');
                // // $mail->addBCC('icabrera@eduka-te.com');
                $mail->addAttachment($informe);

                foreach ($cifs as $key => $value) {
                    $informemp = '../pdf_tripartita'.$gestion.'/empresa/'.$value.'-informe.pdf';
                    // echo $informemp;
                    $mail->addAttachment($informemp);
                }

                $mail->addAttachment($informe);
                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);

                    echo "<br>".$email."<br>";

                    $mail->Subject = '[IKEA] Informe bonificaciones '.$mes.' '.$gestion.' - Asesoría Baleares';
                    $mail->Body = 'Buenos días, <br><br>Adjunto a este email se envía el informe de bonificaciones<br><br>Saludos.';

                    if (!$mail->send())
                        echo "error";
                    else
                        echo "bien";


    $q = 'SELECT f.importe_a_bonificar, f.total_factura, f.costes_organizacion, e.*, a.*, ga.*, m.*, e.id as id_empresa, f.cuentacotizacion, e.id, f.prefijo, f.importe_a_bonificar as importe_a_bonificar, factura_privado
    FROM facturacion_privada f, matriculas m, empresas e, acciones a, grupos_acciones ga
    WHERE f.empresa = e.id
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = f.matricula
    AND IKEA = 1
    AND f.estado NOT IN("Rectificada", "Rectificativa")
    AND (f.importe_a_bonificar > 0 AND f.importe_a_bonificar IS NOT NULL)
    AND numeroaccion < 6000
    AND fechafinalizacion > "'.$fecha.'"
    AND (f.cuentacotizacion LIKE "29%" || f.cuentacotizacion LIKE "35%" || f.cuentacotizacion LIKE "38%")
    UNION
    SELECT f.importe_a_bonificar, f.total_factura, f.costes_organizacion, e.*, a.*, ga.*, m.*, e.id as id_empresa, f.cuentacotizacion, e.id, f.prefijo, f.importe_a_bonificar, factura_privado
    FROM facturacion_bonificada f, matriculas m, empresas e, acciones a, grupos_acciones ga
    WHERE f.empresa = e.id
    AND m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = f.matricula
    AND IKEA = 1
    AND f.estado NOT IN("Rectificada", "Rectificativa")
    AND (f.importe_a_bonificar > 0 AND f.importe_a_bonificar IS NOT NULL)
    AND numeroaccion < 6000
    AND fechafinalizacion > "'.$fecha.'"
    AND (f.cuentacotizacion LIKE "29%" || f.cuentacotizacion LIKE "35%" || f.cuentacotizacion LIKE "38%")
    ORDER BY numeroaccion';
    echo "<br><br>".$q;
    $q = mysqli_query($link, $q) or die("error:" . mysqli_error($link) );
    // $date = mktime( 0, 0, 0, $month, 1, $year );
    // $mes = strftime( '%B', strtotime( '-1 month', time() ));
    // $mes = strftime( '%B' );
    // $mes = ucfirst($mes);
    $anio = date('Y');


    $cccanarias = array("29","35","38");

    $cuenta = mysqli_num_rows($q);
    for ($i=0; $i < $cuenta; $i++) {
        $resul[$i] = mysqli_fetch_assoc($q);
    }

    // echo "<pre>";
    // print_r($resul);
    // echo "</pre>";


    ob_start();

        ?>


            <style type="text/css">

            * {
                margin:0;
                padding:0;
                /*font-family: 'Conv_estre',Sans-Serif;*/
            }

            th, td { padding: 5px; }
            table { font-size: 12px; border-collapse: collapse; }
            td {border: 1px solid #ccc; overflow: auto}
            th {border: 1px solid #ccc; background-color: #ccc}


            </style>

            <page backleft="40px" backright="40px" backtop="40px" backbottom="40px">


                <table style="width:100%; margin-top: 30px">
                    <thead>
                        <tr>
                            <th style="text-align:center">CIF</th>
                            <th style="text-align:center">Empresa</th>
                            <th style="text-align:center">Cuenta Cotización</th>
                            <th style="text-align:center">Acción/Grupo</th>
                            <th style="text-align:center">Denominación</th>
                            <th style="text-align:center">Horas</th>
                            <th style="text-align:center">Fecha Inicio</th>
                            <th style="text-align:center">Fecha Fin</th>
                            <th style="text-align:center">Fecha Fin<br> Tripartita</th>
                            <th style="text-align:center">Importe a bonificar</th>
                        </tr>
                    </thead>
                    <tbody>


            <?

                for ($i=0; $i < $cuenta; $i++) { $cifs2[$i] = $resul[$i][cif]; ?>

                    <tr>

                        <td style="text-align:center" ><? echo $resul[$i][cif] ?></td>
                        <td style="text-align:center" style="width:15%"><? echo $resul[$i][razonsocial] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][cuentacotizacion] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][numeroaccion].'/'. $resul[$i][ngrupo] ?></td>
                        <td style="text-align:center" style="width:20%"><? echo $resul[$i][denominacion] ?></td>
                        <td style="text-align:center" ><? echo $resul[$i][horastotales] ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechaini]) ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechafin]) ?></td>
                        <td style="text-align:center" ><? echo formateaFecha($resul[$i][fechafinalizacion]) ?></td>

                        <td style="text-align:center" ><? echo $resul[$i][importe_a_bonificar] .' €'?></td>

                    </tr>

                <? } ?>

                    </tbody>
                </table>
            </page>

            <?


                // // $para = 'mercedes@bouma.es';
                $para = 'aperojo@eduka-te.com';

                $cifs2 = array_unique($cifs2);
                // print_r($cifs2);
                $informe = '../documentacion'.$gestion.'/ikea_informes/IKEA_informe_bonificar_'.$mes.$gestion.'_Canarias.pdf';

                $content = ob_get_clean();
                $html2pdf = new HTML2PDF('L', 'A4', 'es', true, 'UTF-8', array(0, 0, 0, 0));
                // $html2pdf->setModeDebug();
                $html2pdf->setDefaultFont('Arial');
                $html2pdf->writeHTML($content);
                $html2pdf->Output($informe, 'F');

                $mail = new PHPMailer();
                $mail->FromName = 'Gestión ESFOCC';
                $mail->addAddress($para);
                $mail->addCC('ccoll_formacion@eduka-te.com');
                $mail->addCC('laura.garcia@woden.es');
                // $mail->addCC('egavalda@eduka-te.com');
                // $mail->addBCC('aperojo@eduka-te.com');
                // $mail->addBCC('icabrera@eduka-te.com');
                $mail->addAttachment($informe);

                foreach ($cifs2 as $key => $value) {
                    $informemp = '../pdf_tripartita'.$gestion.'/empresa/'.$value.'-informe.pdf';
                    // echo $informemp;
                    $mail->addAttachment($informemp);
                }

                $mail->CharSet = 'UTF-8';
                $mail->isHTML(true);

                    echo "<br>".$email."<br>";

                    $mail->Subject = '[IKEA] Informe bonificaciones '.$mes.' '.$gestion.' - Asesoría Canarias';
                    $mail->Body = 'Buenos días, <br><br>Adjunto a este email se envía el informe de bonificaciones<br><br>Saludos.';

                    if (!$mail->send())
                        echo "error";
                    else
                        echo "bien";
