<?

include './funciones.php';
$anio = devuelveAnioReal();

// $facturado_a = ' AND f.empresa = e.id ';
    $i = 0;
 foreach ($_POST as $key => $value) {

    // echo $key[bonificado];

    // $comercial = ' AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            $i++;



            if ( $key == 'mes' ) {
                $in = ' AND fechaini >= "'.$anio.'-'.$value.'-01'.'" AND fechafin <= "'.$anio.'-'.$value.'-'.date('t', strtotime($anio.'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }


            if ($key == 'modalidad') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'docente') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND d.id IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'situacionlaboral') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            //cgutierrez - filtro por INCENDIOS
            if ($key == 'incendios') {

                if ( $_SESSION['user'] == 'pablotutor') {
                    $value = "1";
                }
                $in = ' AND ac.incendios IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }


            // if ($key == 'finalizado') {

            //     // if ( $_SESSION['user'] == 'isabel' )
            //         // $in = ' c.id IN '."('".$value."')";
            //     // else
            //     $finalizado = ' AND ma.'.$key.' IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }


            // if ($key == 'formapago') {

            //     $in = ' e.formapago IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }



            $campos .= $fechas.$like.$in;

        }


    }



    $q = 'SELECT @idmat:=m.id as mat, m.diascheck, ac.horastotales, ac.modalidad, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, ac.denominacion, d.nombre, d.apellido, d.apellido2, m.grupo, m.estado, " - " as nalumnosfin, (SELECT COUNT(id_alumno) FROM mat_alu_cta_emp WHERE id_matricula = @idmat ) as nalumnostotal, ac.incendios
        FROM acciones ac, grupos_acciones ga, matriculas m, docentes d, mat_doc md
        WHERE ac.id = m.id_accion
        AND ga.id = m.id_grupo
        AND m.id = md.id_matricula
        AND m.estado IN("Comunicada","Creada")
        AND md.id_docente = d.id '
        .$campos.'
        UNION
        SELECT @idmat:=m.id as mat, m.diascheck, ac.horastotales, ac.modalidad, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.horariomini, m.horariomfin, ac.denominacion, d.nombre, d.apellido, d.apellido2, m.grupo, m.estado, (SELECT COUNT(id_alumno) FROM mat_alu_cta_emp WHERE id_matricula = @idmat AND finalizado = 1 ) as nalumnosfin, (SELECT COUNT(id_alumno) FROM mat_alu_cta_emp WHERE id_matricula = @idmat ) as nalumnostotal, ac.incendios
        FROM acciones ac, grupos_acciones ga, matriculas m, docentes d, mat_doc md, mat_alu_cta_emp ma, alumnos a
        WHERE ac.id = m.id_accion
        AND ga.id = m.id_grupo
        AND m.id = md.id_matricula
        AND ma.id_matricula = m.id
        AND ma.id_alumno = a.id
        AND m.estado IN("Finalizada","Facturada","Liquidada", "Gratuita")
        AND md.id_docente = d.id'
        .$campos.$finalizado;

    // $q = 'SELECT @idmat:=m.id as mat, m.diascheck, ac.horastotales, ac.modalidad, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, d.* FROM acciones ac, grupos_acciones ga, matriculas m, docentes d, mat_doc md WHERE ac.id = m.id_accion AND ga.id = m.id_grupo AND m.id = md.id_matricula AND md.id_docente = d.id AND d.id IN ('6')';


    // if ( $_SESSION['user'] == 'root' ) {
    //     echo $q;
    // }

    $q = mysqli_query($link, $q) or die('error' . mysqli_error($link));

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">AF</th>
                        <th style="text-align:center; width:15%;">Fecha</th>
                        <th style="text-align:center">Horario</th>
                        <th style="text-align:center">Denominación</th>
                        <th style="text-align:center">Modalidad</th>
                        <th style="text-align:center">Docente</th>
                        <th style="text-align:center">Horas</th>
                        <th style="text-align:center">Dias</th>
                        <th style="text-align:center">Fin/Total</th>
                    </tr>
                </thead>
                <tbody>';

    // $i=0;

    // while ( $row = mysqli_fetch_array($q)) {
    //     echo "<pre>";
    //     print_r($row);
    //     echo "</pre>";
    // }

    while ( $row = mysqli_fetch_array($q) ) {

        $color = colorSeguimientoEstado($row[estado]);
        echo '<tr style="font-size:10px" class="'.$color.'">';
        echo '<td id="id" style="display:none">'.$row[mat].'</td>';
        echo '<td style="text-align:center" id="grupo">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td style="text-align:center" id="fecha">'.formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]).'</td>';
       echo '<td style="text-align:center" id="fecha">'.$row[horariomini].' - '.$row[horariomfin].'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[denominacion].'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[modalidad].'</td>';
        echo '<td style="text-align:center" id="doc">'.$row[nombre].' '.$row[apellido].' '.$row[apellido2]  .'</td>';
        echo '<td style="text-align:center" id="horas">'.$row[horastotales]  .'</td>';
        echo '<td style="text-align:center" id="dias">'.$row[diascheck].'</td>';
        echo '<td style="text-align:center" id="dias">'.$row[nalumnosfin].' / '.$row[nalumnostotal].'</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

