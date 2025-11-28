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

            // if ($key == 'comercial') {
            //     $in = ' c.id IN '."('".$value."')";
            //     $comercial = ', comerciales c ';
            //     $comercial2 = ' AND e.comercial '
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }


            $campos .= $and.$like.$in.$grupo;

        }

    }


        echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>AF</th>
                        <th>Modalidad</th>
                        <th>Denominación</th>
                        <th>Fechas</th>
                        <th>Incidencias Inicio</th>
                        <th>Incidencias Finalización</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad, a.denominacion, fechaini, fechafin, m.incidencias, m.incidenciasfinamanda
        FROM matriculas m, acciones a, grupos_acciones ga
        WHERE m.id_accion = a.id
        AND m.id_grupo = ga.id
        AND (m.incidencias <> "" OR m.incidenciasfinamanda <> "")
        '.$campos;

        // echo $sql;
        $sql = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($sql)) {
        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[incidencias].'">Leer más</a>';
        $readmore2 = '...<br><a id="obscuest" href="#" obs="'.$row[incidenciasfinamanda].'">Leer más</a>';
            // echo $ruta;
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td style="width:30% !important">'.$row[denominacion].'</td>';
        echo '<td style="width:10% !important">'.formateaFecha($row[fechaini]).'<br>'.formateaFecha($row[fechafin]).'</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidencias],0, 100);
            if ( $row[incidencias] != "" ) echo $readmore;
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidenciasfinamanda],0, 100);
            if ( $row[incidenciasfinamanda] != "" ) echo $readmore2;
        echo '</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

