<?

include './funciones.php';


$gestion = devuelveAnio();
$i = 0;
$order = ' ORDER BY numeroaccion';

 foreach ($_POST as $key => $value) {

    // $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    // $costesemp1 = '';
    // $costesemp2 = '';
    // $grupo = '';


        if ( $value != "" ) {

            if ( ++$i>=1 )
                $and = ' AND ';
            else $and = '';

            $i++;


            if ($key == 'numeroaccion') {

                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';

            }

            if ( $key == 'modalidad' ) {

                $in = $key.' = "'.$value.'"';
                $like = '';

            }

            if ( $key == 'bonificado' ) {

                $ngrupo = 'ngrupo';
                if ( $value == 'bonificado' )
                    $like = ' '.$ngrupo.' NOT LIKE "%p%"';
                else if ( $value == 'privado' )
                    $like = ' '.$ngrupo.' LIKE "%p%"';

                $in = '';

            }

            if ( $key == 'mes_fin' ) {
                //$in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $in = ' fechafin >= "'.$gestion.'-'.$value.'-01'.'" AND fechafin <= "'.$gestion.'-'.$value.'-'.date('t', strtotime($gestion.'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                $grupo = '';
            }


            $campos .= $and.$like.$in.$grupo;

        }

    }


        echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>AF</th>
                        <th>Modalidad</th>
                        <th>Denominación</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th style="width:10%">Justif. y Asist.</th>
                        <th>RLT</th>
                        <th>Retorno</th>
                        <th>Examen</th>
                        <th>Cuestionario</th>
                        <th>Requerimiento</th>
                        <th>Participante</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad, CONCAT(al.nombre,"_", al.apellido) as alu, fechaini, fechafin, m.grupo, m.id as idmat, a.denominacion, m.fechaini, m.fechafin
        FROM matriculas m, acciones a, grupos_acciones ga, alumnos al, mat_alu_cta_emp ma '.$comercial.'
        WHERE m.id_accion = a.id
        '.$comercial2.'
        AND m.id_grupo = ga.id
        AND ma.id_alumno = al.id
        AND ma.id_matricula = m.id
        '.$campos.'
        GROUP BY numeroaccion,ngrupo';

        // echo $sql;
        $sql = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($sql)) {

            // echo $ruta;
            $id_mat = $row[idmat];
            $naccion = $row['numeroaccion'];
            $ngrupo = $row['ngrupo'];
            $modalidad = $row['modalidad'];
            $grupo = $row['grupo'];
            $alumno = strtolower( quitaTildes(trim($row['alu'])) );
            $ruta = dirname(__DIR__).'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';

            $justif = "NO";
            $rlt = "NO";
            $distretorno = "NO";
            $examen = "NO";
            $cuestionario = "NO";
            $requerimiento = "NO";
            $ficha = "NO";

            $cuentaemp = 0; $cuenta = 0; $total = 0; $totalemp = 0;
        if ( $modalidad == 'Teleformación' ) {

            $cuenta = 0;

            if ( $grupo == 0 ) {

                $total = 2;

                if ( file_exists($ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $justif = "SI";
                }
                if ( file_exists($ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $rlt = "SI";
                }

            } else {


                if ( file_exists($ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $rlt = "SI";
                }

                $q = 'SELECT DISTINCT e.id, e.razonsocial
                FROM mat_alu_cta_emp ma, empresas e
                WHERE ma.id_empresa = e.id
                AND ma.tipo = ""
                AND ma.id_matricula = '.$id_mat;
                // echo $q;
                $q = mysqli_query($link, $q);

                $cuentaemp = 0; $cuenta = 0; $total = 0; $totalemp = 0;
                while ( $rows = mysqli_fetch_array($q) ) {

                    $totalemp++;
                    $emp = quitaTildesConComas(str_replace(' ', '', $rows[razonsocial]));
                    $archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
                    // echo $archivo."<br>";
                    if ( file_exists($archivo) ) $cuentaemp++;

                } $total = $totalemp + 1;

            }

        } else if ( $modalidad == 'A Distancia' ) {

            $cuenta = 0;

            if ( $grupo == 0 ) {

                $total = 5;

                if ( file_exists($ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $justif = 1;
                }
                if ( file_exists($ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $distretorno = "SI";
                }
                if ( file_exists($ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $examen = "SI";
                }
                if ( file_exists($ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $cuestionario = "SI";
                }
                if ( file_exists($ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $rlt = "SI";
                }

            } else {

                if ( file_exists($ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $distretorno = "SI";
                }
                if ( file_exists($ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $examen = "SI";
                }
                if ( file_exists($ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $cuestionario = "SI";
                }
                if ( file_exists($ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
                    $cuenta++; $rlt = "SI";
                }

                $q = 'SELECT DISTINCT e.id, e.razonsocial
                FROM mat_alu_cta_emp ma, empresas e
                WHERE ma.id_empresa = e.id
                AND ma.id_matricula = '.$id_mat;
                // echo $q;
                $q = mysqli_query($link, $q);

                $cuentaemp = 0; $cuenta = 0; $total = 0; $totalemp = 0;
                while ( $rows = mysqli_fetch_array($q) ) {

                    $totalemp++;
                    $emp = quitaTildesConComas(str_replace(' ', '', $rows[razonsocial]));
                    $archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
                    // echo $archivo."<br>";

                    if ( file_exists($archivo) ) $cuentaemp++;

                } $total = $totalemp + 4;

            }

        } else {

            $q = 'SELECT DISTINCT e.id, e.razonsocial
            FROM mat_alu_cta_emp ma, empresas e
            WHERE ma.id_empresa = e.id
            AND ma.id_matricula = '.$id_mat;
            // echo $q;
            $q = mysqli_query($link, $q);

            $cuentaemp = 0; $cuenta = 0; $total = 0; $totalemp = 0;
            while ( $rows = mysqli_fetch_array($q) ) {

                $totalemp++;
                $emp = quitaTildesConComas(str_replace(' ', '', $rows[razonsocial]));
                $archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
                // echo $archivo."<br>";
                if ( file_exists($archivo) ) $cuentaemp++;

            }

            $total = $totalemp + 4;

            if ( file_exists($ruta . 'pmfichas-' . $emp .'-'. $naccion.'_'.$ngrupo.'.pdf') ) {
                $cuenta++; $ficha = "SI";
            }

            if ( file_exists($ruta . 'pmexamenes-' . $emp .'-'. $naccion.'_'.$ngrupo.'.pdf') ) {
                $cuenta++; $examen = "SI";
            }

            if ( file_exists($ruta . 'pmcuestionarios-' . $emp .'-'. $naccion.'_'.$ngrupo.'.pdf') ) {
                $cuenta++; $cuestionario = "SI";
            }

            if ( file_exists($ruta . 'pmrlts-' . $emp .'-'. $naccion.'_'.$ngrupo.'.pdf') ) {
                $cuenta++; $rlt = "SI";
            }

        }


        $color = 'warning';

        if ( $modalidad != "Presencial" && $modalidad != "Mixta" && $grupo != 0 ) {

            if ( ($cuenta == $total) ) $color = 'success';

        } else {

            if ( ($cuenta == $total) && ( $cuentaemp == $totalemp ) ) $color = 'success';

        }

        if ( file_exists($ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf') ) {
            $color = 'danger'; $requerimiento = "SI";
        }

        if ( $cuenta == 0 && $cuentaemp == 0 ) {
            $color = 'blanco';
        }


        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';

        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.formateaFecha($row[fechaini]).'</td>';
        echo '<td>'.formateaFecha($row[fechafin]).'</td>';

        if ( ($modalidad == "Presencial" || $modalidad == "Mixta") ) {

            if ( ($cuentaemp == $totalemp) && $totalemp != 0 ) echo '<td style="text-align:center">SI</td>';
            else echo '<td style="text-align:center">NO</td>';

        } else echo '<td style="text-align:center">'.$justif.'</td>';

        echo '<td style="text-align:center">'.$rlt.'</td>';

        if ( $modalidad != "A Distancia" ) echo '<td style="text-align:center"> - </td>';
        else echo '<td style="text-align:center">'.$retorno.'</td>';
        if ( $modalidad == "Teleformación" ) echo '<td style="text-align:center"> - </td>';
        else echo '<td style="text-align:center">'.$examen.'</td>';
        if ( $modalidad == "Teleformación" ) echo '<td style="text-align:center"> - </td>';
        else echo '<td style="text-align:center">'.$cuestionario.'</td>';
        echo '<td style="text-align:center">'.$requerimiento.'</td>';

        if ( $modalidad != "Presencial" && $modalidad != "Mixta" ) echo '<td style="text-align:center"> - </td>';
        else echo '<td style="text-align:center">'.$ficha.'</td>';
        // echo '<td>'.$cuentaemp.' | '.$totalemp.'</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

