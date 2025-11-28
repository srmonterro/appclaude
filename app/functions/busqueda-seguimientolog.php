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

            if ($key == 'fechaini') {
                $fechas = ' '.$key.' = "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' '.$key.' = "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
            }

            if ($key == 'modalidad') {
                $in = ' '.$key.' = "'.$value.'"';
                $fechas = ''; $like = '';
                $value = '';
            }

            $campos .= $and.$like.$in.$grupo.$fechas;

        }

    }


        echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>AF</th>
                        <th>Modalidad</th>
                        <th>Denominación</th>
                        <th>Fechas</th>
                        <th>Horario</th>
                        <th>Docente</th>
                        <th>Comercial</th>
                        <th>Observaciones Logística</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = 'SELECT DISTINCT @mid:=m.id, a.numeroaccion, ga.ngrupo, a.modalidad, a.denominacion, fechaini, fechafin, m.incidencias, m.observacioneslogistica, m.*,

        (select group_concat(distinct d.nombre," ",d.apellido) from mat_doc md
        left join matriculas m ON md.id_matricula = m.id
        left join docentes d ON d.id = md.id_docente
        where m.id = @mid
        ) as docentes,

        (select group_concat(distinct nombre) from ptemp_mat_emp ma
        left join matriculas m ON ma.id_matricula = m.id
        left join empresas e ON ma.id_empresa = e.id
        left join comerciales c ON c.id = e.comercial
        where m.id = @mid
        ) as comerciales

        FROM matriculas m
        INNER JOIN acciones a ON m.id_accion = a.id
        INNER JOIN grupos_acciones ga ON m.id_grupo = ga.id

        '.$campos;

        // echo $sql;
        $sql = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($sql)) {

            if ( $row[horariomini] !== "" )
                $horario = $row[horariomini].' - '.$row[horariomfin];
            if ( $row[horariomini] !== "" && $row[horariotini] !== "" )
                $horario .= ' | ';
            if ( $row[horariotini] != "" )
                $horario .= $row[horariotini].' - '.$row[horariotfin];

            $readmore2 = '...<br><a id="obscuest" href="#" obs="'.$row[observacioneslogistica].'">Leer más</a>';
                // echo $ruta;
            echo '<tr style="font-size:11px" class="'.$color.'">';
            echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
            echo '<td>'.$row[modalidad].'</td>';
            echo '<td style="width:30% !important">'.$row[denominacion].'</td>';
            echo '<td style="width:10% !important">'.formateaFecha($row[fechaini]).'<br>'.formateaFecha($row[fechafin]).'</td>';
            echo '<td style="width:10%" >'.$horario.'</td>';
            echo '<td>'.$row[docentes].'</td>';
            echo '<td>'.$row[comerciales].'</td>';
            echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[observacioneslogistica],0, 100);
                if ( $row[observacioneslogistica] != "" ) echo $readmore2;
            echo '</td>';
            echo '</tr>';

        }
    echo '</tbody>
        </table>';



?>

