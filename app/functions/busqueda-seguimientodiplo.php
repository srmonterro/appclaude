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

    // print_r($_POST);

        if ( $value != "" ) {

            $i++;

            if ($key == 'numeroaccion') {
                
                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];
                
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            if ($key == 'denominacion') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'modalidad') {
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'fechaini') {
                $fechas = ' AND '.$key.' >= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
            }
            
            if ($key == 'fechafin') {      
                $fechas = ' AND '.$key.' <= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';         
            } 

            if ($key == 'nombre') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'apellido') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'apellido2') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }


            $campos .= $fechas.$like.$in.$grupo;

        }

        
    } 
            


    $q = "SELECT @idmat:=m.id as mat, ma.id_alumno as id_alu, ac.modalidad, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion, al.nombre, al.apellido, al.apellido2, m.grupo
        FROM acciones ac, grupos_acciones ga, matriculas m, mat_alu_cta_emp ma, alumnos al
        WHERE ac.id = m.id_accion
        AND ga.id = m.id_grupo 
        AND m.id = ma.id_matricula
        AND al.id = ma.id_alumno
        AND m.estado NOT IN('Anulada')
        AND ac.modalidad IN ('Teleformación', 'A Distancia')
        " .$campos;

    // echo $q;
    $q = mysqli_query($link, $q) or die('error' . mysqli_error($link) );

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>                         
                        <th style="text-align:center">AF</th>     
                        <th style="text-align:center; width:15%;">Fecha</th>  
                        <th style="text-align:center">Denominación</th> 
                        <th style="text-align:center">Modalidad</th>   
                        <th style="text-align:center; width:22%">Alumno</th>   
                        <th style="text-align:center width:5%;">Diploma Enviado</th>                         
                        <th style="text-align:center width:3%;">Diploma Descargado</th> 
                        <th style="text-align:center width:3%;">Ip Descarga</th> 
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_array($q) ) {

        $i = 0;
        $like = $row[nombre].' '.$row[apellido];
        $like2 = $row[numeroaccion].'/'.$row[ngrupo];

        $qx = "SELECT * FROM registro_emails 
        WHERE titulo 
        LIKE '%diploma%'
        AND titulo LIKE '%".$like."%'
        AND titulo LIKE '%".$like2."%'";
        // echo $qx;
        $qx = mysqli_query($link, $qx) or die("error:" .mysqli_error($link));
        
        if ( mysqli_num_rows($qx) > 0 ) $i++;
        $rowx = mysqli_fetch_array($qx);


        $qy = 'SELECT *
        FROM confirmaciones_diplomas
        WHERE id_matricula = '.$row[mat].'
        AND id_alumno = '.$row[id_alu];
        $qy = mysqli_query($link, $qy) or die("error:" .mysqli_error($link));

        if ( mysqli_num_rows($qy) > 0 ) $i++;
        $rowy = mysqli_fetch_array($qy);


        if ( $i == 0 )
            $color = 'danger';
        else if ( $i == 1 )
            $color = 'info';
        else
            $color = 'success';


        if ( $row[grupo] == 1 ) $grupal = 'GRUPAL';
        else $grupal = '';

        echo '<tr style="font-size:10px" class="'.$color.'">';   
        echo '<td id="id" style="display:none">'.$row[mat].'</td>';     
        echo '<td style="text-align:center" id="grupo">'.$row[numeroaccion].'/'.$row[ngrupo].'<br>'.$grupal.'</td>';
        echo '<td style="text-align:center" id="fecha">'.formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]).'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[denominacion].'</td>';
        echo '<td style="text-align:center" id="mat">'.$row[modalidad].'</td>';    
        echo '<td style="text-align:center" id="alu">'.$row[nombre].' '.$row[apellido].' '.$row[apellido2]  .'</td>';    
        echo '<td style="text-align:center" id="enviado">'; 
        if ( $rowx[fecha] != "" )  
            echo formateaFechaHora($rowx[fecha]);  
        else
            echo '';
        echo '</td>';  
        echo '<td style="text-align:center" id="descargado">';
        if ( $rowy[fechahora] != "" )  
            echo formateaFechaHora($rowy[fechahora]);  
        else
            echo '';
        echo '</td>';
        echo '<td style="text-align:center" id="descargado">';
        if ( $rowy[ip] != "" )  
            echo $rowy[ip];  
        else
            echo '';
        echo '</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

