<?

include './funciones.php';



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

            if ( ++$i>=1 && ( $key != 'ordenrentabilidad' && $key != 'ordenbeneficio') )
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

            if ($key == 'ordenbeneficio') {
                
                // $rent = '';
                // if ( $key == 'ordenrentabilidad' )
                //     $rent = ',porcentajeventas';

                if ( $value == 'masamenos' )
                    $order = ' ORDER BY margenbeneficio DESC';
                else
                    $order = ' ORDER BY margenbeneficio ASC';

                $in = ''; $like = ''; $grupo = '';
            }

            if ($key == 'ordenrentabilidad') {
                
                // $benef = '';
                // if ( $key == 'ordenbeneficio' )
                //     $benef = ',margenbeneficio';

                if ( $value == 'masamenos' )
                    $order = ' ORDER BY porcentajeventas DESC';
                else
                    $order = ' ORDER BY porcentajeventas ASC';

                $in = ''; $like = ''; $grupo = '';

            }

            // echo $value;
            // if ($key == 'nombre') {
            //     $like = 'co.nombre LIKE '."'%".$value."%'";
            //     $in = ''; $grupo = '';
            //     $fechas = '';
            // }

            // if ($key == 'razonsocial') {
            //     $like = $key.' LIKE '."'%".$value."%'";
            //     $costes = ' (SELECT DISTINCT mc.costes_imparticion
            //     FROM mat_costes mc, mat_alu_cta_emp ma, empresas e, acciones a, matriculas m
            //     WHERE ma.id_matricula = mc.id_matricula 
            //     AND m.id = ma.id_matricula
            //     AND a.id = m.id_accion
            //     AND e.id = ma.id_empresa 
            //     AND mc.id_matricula = @idmat
            //     AND mc.id_empresa = @idemp) as coste ';
            //     $costesemp1 = ' @idemp:=e.id, ';
            //     $costesemp2 = ', @idemp:=e.id ';
            //     $in = ''; $grupo = '';
            //     $fechas = '';
            // }

            if ($key == 'comercial') {                
                $in = ' c.id IN '."('".$value."')";
                // $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            // if ($key == 'fechafin') {
            //     $in = ' '.$key.' <= '."'".$value."'";
            //     $like = ''; $grupo = '';
            //     $fechas = '';
            // }
             
            // if ($key == 'numeroaccion') {
                
            //     $grupot = split("/", $value);
            //     $value = $grupot[0];
            //     if ($grupot[1] != "")
            //         $grupo = ' AND ngrupo = '.$grupot[1];
                
            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';

            // }

            // if ($key == 'docente') {
            //     $key = 'id_docente';
            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = '';
            //     $fechas = '';
            // }

            // if ($key == 'progreso') {
            //     $progre = split("-", $value); 
            //     $in = ' '.$key.' BETWEEN '.$progre[0].' AND '.$progre[1];
            //     $like = ''; 
            //     $fechas = '';
            // }

            // if ($key == 'fechaini') {
            //     $fechas = ' '.$key.' > "'.$value.'"';
            //     $in = ''; $like = '';
            //     $value = '';
            // }
            
            // if ($key == 'fechafin') {      
            //     $fechas = ' '.$key.' < "'.$value.'"';
            //     $in = ''; $like = '';
            //     $value = '';         
            // }        

            // if ($key == 'bonificado') {

            //     $key = 'ngrupo';
            //     if ( $value == 'bonificado' ) 
            //         $in = ' '.$key.' NOT LIKE "%p%"';
            //     else if ( $value == 'privado' )
            //         $in = ' '.$key.' LIKE "%p%"';

            //     $fechas = ''; $like = '';
            // }        

            $campos .= $and.$like.$in.$grupo;

        }
        
    } 


    $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, c.nombre, c.apellido, cr.totalcostes, cr.totalingresos, cr.margenbeneficio, cr.porcentajeventas, ac.modalidad
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c, costes_rentabilidad cr
        WHERE e.comercial = c.id
        AND cr.id_matricula = m.id 
        AND cr.id_matricula = mt.id_matricula 
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND mt.id_empresa = e.id 
        AND m.estado NOT IN ("Anulada")
        '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, c.nombre, c.apellido, cr.totalcostes, cr.totalingresos, cr.margenbeneficio, cr.porcentajeventas, ac.modalidad  
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c, costes_rentabilidad cr
        WHERE e.comercial = c.id
        AND cr.id_matricula = m.id 
        AND cr.id_matricula = mt.id_matricula 
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND m.id NOT IN ( SELECT id_matricula FROM mat_costes )
        AND m.estado NOT IN ("Anulada")
        AND mt.id_empresa = e.id 
        '.$campos.'
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) as razonsocial, ac.numeroaccion, 
        ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, c.nombre , c.apellido, cr.totalcostes, cr.totalingresos, cr.margenbeneficio, cr.porcentajeventas, ac.modalidad
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, ptemp_mat_emp pm, comerciales c, costes_rentabilidad cr
        WHERE e.comercial = c.id
        AND cr.id_matricula = m.id 
        AND m.id = pm.id_matricula
        AND pm.id_empresa = e.id
        AND ac.id = m.id_accion 
        AND ga.id = m.id_grupo 
        AND m.estado NOT IN ("Anulada")
        AND m.id NOT IN ( SELECT id_matricula FROM mat_alu_cta_emp )
        '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo'
        .$order;

    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Nº</th>
                        <th>AF</th>
                        <th>Modalidad</th>
                        <th>Denominación</th>                                
                        <th>Empresa</th>
                        <th>Comercial</th>
                        <th>Costes</th>
                        <th>Ingresos</th>
                        <th>Rentabilidad</th>
                        <th style="width: 11%">% Rentabilidad</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        // $color = ($row[margenbeneficio] < 0) ? 'danger' : 'success';
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo '<td style="text-align:center">'.$row[totalcostes].' €</td>';
        echo '<td style="text-align:center">'.$row[totalingresos].' €</td>';
        echo '<td style="text-align:center">'.$row[margenbeneficio].' €</td>';
        echo '<td style="text-align:center" id="porcentajeventas">'.$row[porcentajeventas].' %</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

