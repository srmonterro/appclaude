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


            // if ($key == 'formapago') {    

            //     $in = ' e.formapago IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            //     $grupo = '';
            // }

            

            $campos .= $fechas.$like.$in;

        }

        
    } 
            


    $q = "SELECT @idmat:=m.id as mat, ac.modalidad, ac.numweroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, al.nombre, al.apellido, al.apellido2
        FROM acciones ac, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, alumnos al
        WHERE ac.id = m.id_accion
        AND ga.id = m.id_grupo 
        AND m.id = md.id_matricula
        AND al.id = ma.id_alumno
        AND a.modalidad IN ('Teleformación', 'A Distancia')
        AND " .$campos;

    echo $q;
    $q = mysqli_query($link, $q) or die('error' . mysqli_error($link) );

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>                         
                        <th style="text-align:center">AF</th>     
                        <th style="text-align:center; width:15%;">Fecha</th>  
                        <th style="text-align:center">Denominación</th> 
                        <th style="text-align:center">Modalidad</th>   
                        <th style="text-align:center">Alumno</th>   
                        <th style="text-align:center">Diploma Enviado</th>                         
                        <th style="text-align:center">Diploma Descargado</th> 
                        <th style="text-align:center">Ip Descarga</th> 
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_array($q) ) {

        $like = $row[nombre].' '.$row[apellido];

        $qx = "SELECT * FROM registro_emails 
        WHERE titulo 
        LIKE '%diploma%'
        AND titulo LIKE '%".$like."%'";
        $qx = mysqli_query($link, $qx) or die("error:" .mysqli_error($link));
        $rowx = mysqli_fetch_array($qx);


        $qy = 'SELECT *
        FROM confirmaciones_diplomas
        WHERE id_matricula = '.$row[mat];
        $qy = mysqli_query($link, $qy) or die("error:" .mysqli_error($link));
        $rowy = mysqli_fetch_array($qy);


        $color = colorSeguimientoEstado($row[estado]);
        echo '<tr style="font-size:10px" class="'.$color.'">';   
        echo '<td id="id" style="display:none">'.$row[mat].'</td>';     
        echo '<td style="text-align:center" id="grupo">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td style="text-align:center" id="fecha">'.formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]).'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[denominacion].'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[modalidad].'</td>';    
        echo '<td style="text-align:center" id="alu">'.$row[nombre].' '.$row[apellido].' '.$row[apellido2]  .'</td>';    
        echo '<td style="text-align:center" id="enviado">'.$rowx[fecha]  .'</td>';  
        echo '<td style="text-align:center" id="descargado">'.$rowy[fechahora].'</td>';  
        echo '<td style="text-align:center" id="alu">'.$rowy[ip].'</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

