<?


include './funciones.php';
$anio = 2014;
include './connect.php';


$i = 0;
$order = ' ORDER BY numeroaccion';

 // foreach ($_POST as $key => $value) { 

 //        if ( $value != "" ) {

 //            if ( ++$i>=1 )
 //                $and = ' AND ';
 //            else $and = '';

 //            $i++;


 //            if ($key == 'numeroaccion') {
                
 //                $grupot = split("/", $value);
 //                $value = $grupot[0];
 //                if ($grupot[1] != "")
 //                    $grupo = ' AND ngrupo = '.$grupot[1];
                
 //                $in = ' '.$key.' IN '."('".$value."')";
 //                $like = '';

 //            }

 //            if ( $key == 'modalidad' ) {

 //                $in = $key.' = "'.$value.'"';
 //                $like = '';

 //            }

 //            if ( $key == 'bonificado' ) {

 //                $ngrupo = 'ngrupo';
 //                if ( $value == 'bonificado' ) 
 //                    $like = ' '.$ngrupo.' NOT LIKE "%p%"';
 //                else if ( $value == 'privado' )
 //                    $like = ' '.$ngrupo.' LIKE "%p%"';

 //                $in = '';

 //            }

 //            // if ($key == 'comercial') {                
 //            //     $in = ' c.id IN '."('".$value."')";
 //            //     $comercial = ', comerciales c ';
 //            //     $comercial2 = ' AND e.comercial '
 //            //     $like = '';
 //            //     $fechas = '';
 //            //     $grupo = '';
 //            // }


 //            $campos .= $and.$like.$in.$grupo;

 //        }
        
 //    } 


        echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr style="font-size:11px"> 
                        <th style="text-align:center;">Nº</th>                        
                        <th style="text-align:center;">1.Calidad atención</th>
                        <th style="width:10%">2.Profesionalidad y conomientos de comerciales</th>
                        <th style="text-align:center;">3.Rapidez y eficacia gestiones y docu</th>
                        <th style="text-align:center;">4.Calidad y comprensión de la info recibida</th>
                        <th style="text-align:center;">5.Calidad acciones</th>
                        <th style="text-align:center;">6.Relación calidad/precio servicios</th>
                        <th style="text-align:center;">7.Grado organización acciones</th>
                        <th style="text-align:center;">8.Grado cumplimiento expactativas</th>
                        <th style="text-align:center;">9.Solución quejas/reclamaciones</th>
                        <th style="text-align:center;">10.Cómo conocio el servicio</th>
                        <th style="text-align:center;">CIF</th>
                        <th style="text-align:center;">Observaciones</th>
                    </tr>
                </thead>
                <tbody>';

        $sql = 'SELECT * FROM cuestionarios_evaluacion 
        WHERE fecha >= "'.$_POST[fecha].'-01-01" AND fecha <= "'.$_POST[fecha].'-12-31"';

        // echo $sql;
        $sql = mysqli_query($link, $sql);
        $nrows = mysqli_num_rows($sql);


        $asociaciones = 0;
        $comerciales = 0;
        $aapp = 0;
        $internet = 0;
        $otros = 0;


        // echo $nrows;
        while ($row = mysqli_fetch_assoc($sql)) { 
            // print_r($row);
            // echo $ruta;
            $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[observaciones].'">Leer más</a>';
            echo '<tr style="font-size:11px" class="'.$color.'">';
            echo '<td style="text-align:center;">'. ++$i .'</td>';

            if ($row[pregunta10] == 'Asociaciones')
                $asociaciones++;
            else if($row[pregunta10] == 'Comerciales')
                $comerciales++;
            else if($row[pregunta10] == 'Internet')
                $internet++;
            else if($row[pregunta10] == 'Otros')
                $otros++;
            else if($row[pregunta10] == 'Conocidos')
                $conocidos++;

            for ($k=1; $k <= 10; $k++) { 
                echo '<td style="text-align:center;">'.$row['pregunta'.$k].'</td>';
                $resp_total[$k] += $row['pregunta'.$k];   

                if ( $nrows == $i ) 
                    $resp_total[$k] = $resp_total[$k]/$nrows;

            }

            $q3 = 'SELECT DISTINCT razonsocial 
            FROM empresas
            WHERE cif = "'.$row[cifnif].'"';
            // echo $q3;
            $q3 = mysqli_query($link, $q3);
            $rs = mysqli_fetch_array($q3);


            echo '<td style="text-align:center;">'.$row[cifnif];
            if ( $rs[razonsocial] != "" ) echo "<br><strong>".$rs[razonsocial]."</strong>";
            echo '</td>';

            echo '<td style=";word-wrap: break-word">'.substr($row[observaciones],0, 30);
            if ( $row[observaciones] != "" ) echo $readmore;
            echo '</td>';

            echo '</tr>';

        }

        echo '<tr style="font-size:11px;">';
        echo '<td><strong>MEDIAS:</strong> </td>';

        for ($k=1; $k <= 10; $k++) { 

            if ( $resp_total[$k] < 5 ) $color = 'danger'; else $color = 'success';

            if ( $k <= 9 )
                echo '<td class="'.$color.'" style="font-size:12px;text-align:center;"><strong>'.number_format($resp_total[$k],1).'</strong></td>';
            else {
                echo '<td style="width:10%;">';
                echo '<div class="col-sm-6 pull-left" style="padding:0">%Asociaciones: </div><div class="col-sm-1 pull-right" style="padding:0">'.(int)(($asociaciones*100)/$nrows)."</div><br>";
                echo '<div class="col-sm-6 pull-left" style="padding:0">%Comerciales: </div><div class="col-sm-1 pull-right" style="padding:0">'.(int)(($comerciales*100)/$nrows)."</div><br>";
                echo '<div class="col-sm-6 pull-left" style="padding:0">%Conocidos: </div><div class="col-sm-1 pull-right" style="padding:0">'.(int)(($conocidos*100)/$nrows)."</div><br>";
                echo '<div class="col-sm-6 pull-left" style="padding:0">%Internet: </div><div class="col-sm-1 pull-right" style="padding:0">'.(int)(($internet*100)/$nrows)."</div><br>";
                echo '<div class="col-sm-6 pull-left" style="padding:0">%Otros: </div><div class="col-sm-1 pull-right" style="padding:0">'.(int)(($otros*100)/$nrows)."</div><br>";
                echo '</td>';
            }

        }

        echo '<td></td><td></td>';
        echo '</tr>';

        echo '</tbody>
        </table>';

        // print_r($resp_total);



?>

