<?

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';
    include_once($baseurl.'/functions/funciones.php');
    require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');


    $fechaHasta = new DateTime(date('Y-m-d'));
    // $fechaDesde = new DateTime(date('Y-m-d'));
    // $fechaDesde = $fechaDesde->modify('-14 days');
    $fechaHasta = $fechaHasta->modify('-10 days');
    $fechaHasta = $fechaHasta->format('Y-m-d');
    // $fechaDesde = $fechaDesde->format('Y-m-d');

    $comerciales = array
    (
        array("Oscar-Isa",3,"irivero@eduka-te.com"),
        array("Oscar-Amparo",3,"avalle@eduka-te.com")
        // array("Efren",4,"egavalda@eduka-te.com"),
        // array("Pedro",10,"irivero@eduka-te.com"),
        // array("Gerardo",16,"gzerpa@eduka-te.com"),
        // array("Ana",2,"aalves@eduka-te.com")
    );


    for ($i=0; $i < count($comerciales); $i++) {

          // echo "<pre>";
          // print_r($comerciales);
          // echo "</pre>pre>";

        $mail = new PHPMailer;

        $mail->FromName = 'Gestión ESFOCC';
        // $mail->addAddress('aperojo@eduka-te.com');
        $mail->isHTML(true);

        // $mail->addAddress('aperojo@eduka-te.com');
        $fecha = date('Y-m-d');
        // $maniana = date('Y-m-d', strtotime('+1 day', strtotime($fecha)));
        // $manianaa = formateaFecha($maniana);

        $mail->CharSet = 'UTF-8';
        $titulo = 'Seguimiento alumnos '.$comerciales[$i][0] . ' - ' . formateaFecha($fecha);
        $mail->Subject = $titulo;


        if ( $comerciales[$i][0] == "Oscar-Isa" )
            $agente = ' AND e.agente = "Isabel" AND a.modalidad IN("Teleformación") ';
        else if ( $comerciales[$i][0] == "Oscar-Amparo" )
            $agente = ' AND e.agente = "Amparo" ';


        $cuerpo = '<table cellspacing="10" id="tablamatriculas" class="table table-striped" style="font-size:12px">
                    <thead>
                        <tr> <!-- AQUI UN SWITCH? !-->
                            <th>Acción</th>
                            <th>Denominación</th>
                            <th>Alumno</th>
                            <th>Tipo</th>
                            <th>Empresa</th>
                            <th>Inicio</th>
                            <th>Fin</th>
                            <th>Progreso<br>Contenido</th>
                            <th>Progreso<br>Cuestionario</th>
                            <th>Dedicación</th>
                            <th>Estado</th>
                            <th>Estado<br>Matrícula</th>
                        </tr>
                    </thead>
                    <tbody>';
        // OSCAR
        $q1 = 'SELECT DISTINCT al.nombre, al.apellido, e.razonsocial, ma.progreso, ma.finalizado, a.numeroaccion, ga.ngrupo, a.denominacion, m.fechaini, m.fechafin, ma.tipo, ma.progreso2, ma.finalizado, m.estado, ma.dedicacion
        FROM matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, acciones a, comerciales c, alumnos al
        WHERE m.id = ma.id_matricula
        AND ma.id_alumno = al.id
        AND ma.id_empresa = e.id
        AND e.comercial = c.id
        '.$agente.'
        AND a.diploma <> "VIN"
        AND a.denominacion NOT LIKE "%PRUEBA%"
        AND m.estado IN("Comunicada", "Finalizada")
        AND ga.id = m.id_grupo
        AND a.id = m.id_accion
        AND m.fechafin >= "'.$fechaHasta.'"
        AND c.id = '.$comerciales[$i][1];

        // echo $q1."<br><br>";
        $q1 = mysqli_query($link, $q1) or die("error" . mysqli_error($link) );

        while ( $row2 = mysqli_fetch_array($q1) ) {

            if ( $row[finalizado] == 0 )
                $finalizado = 'En progreso';
            else if ( $row[finalizado] == 1 )
                $finalizado = 'Finalizado';
            else if ( $row[finalizado] == 2 )
                $finalizado = 'NO finalizado';

            $envia = 1;
            $cuerpo .= '
            <tr style="font-size:12px">
                <td>'.$row2[numeroaccion].'/'.$row2[ngrupo].'</td>
                <td>'.$row2[denominacion].'</td>
                <td>'.$row2[nombre].' '.$row2[apellido].'</td>
                <td>';
                if ($row2[tipo]=="")
                    $cuerpo.="Bonificado";
                else
                    $cuerpo.="Privado";
                $cuerpo.='</td>
                <td>'.$row2[razonsocial].'</td>
                <td>'.formateaFecha($row2[fechaini]).'</td>
                <td>'.formateaFecha($row2[fechafin]).'</td>
                <td>'.$row2[progreso].' %</td>
                <td>'.$row2[progreso2].' %</td>
                <td>'.$row2[dedicacion].' %</td>
                <td>'.$finalizado.'</td>
                <td>'.$row2[estado].'</td>
            </tr>';

        }
        $cuerpo .= '</tbody></table>';
        // echo $cuerpo;
        $mail->Body = $cuerpo;
        $para = $comerciales[$i][2];

        $mail->addAddress($para);
        $mail->addBCC('backup-gestion@eduka-te.com');
        // $mail->addAddress('aperojo@eduka-te.com');

        $dia = strftime('%u', strtotime($fecha) );

        if ( $envia == 1 && $dia == 5 ) {

            if(!$mail->send())  {
                echo "error1";
            } else {
                registrarMailBD($para, $titulo, $bcc, $link);
            }
        }

        $mail->ClearAddresses();
        $envia = 0;
        $cuerpo = "";
        $agente = "";

    }


?>
