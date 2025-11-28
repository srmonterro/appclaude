<?

include './funciones.php';



    $i = 0;
 foreach ($_POST as $key => $value) { 

    $comercial = '( e.comercial = c.id ) ';
    $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            // $and = ' AND ';
            // $i++;

            if ($key == 'nombre') {
                $like = 'AND co.nombre LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

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
                $in = ' AND c.id IN '."('".$value."')";
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

            $campos .= $fechas.$like.$in.$grupo;

        }
        
    } 


    $q = 'SELECT co.*
        FROM comisionistas co, comerciales c
        WHERE co.comercial = c.id 
        '.$campos;

    // $q = 'SELECT co.nombre as comisionistanombre, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) as razonsocial, c.nombre
    //     FROM empresas e, comerciales c, comisionistas co
    //     WHERE e.comercial = c.id
    //     AND e.comisionista = co.id
    //     AND co.id <> 0
    //     '.$campos.'
    //     GROUP BY comisionistanombre,razonsocial';

    // echo $q;
    $q = mysqli_query($link, $q);


    // echo '<table style="margin-top: 15px;" class="table">
    //             <thead>
    //                 <tr> 
    //                     <th>Nº</th>
    //                     <th>Comisionista</th>
    //                     <th>Empresa</th>                                
    //                     <th>Comercial</th>
    //                 </tr>
    //             </thead>
    //             <tbody>';

    $i=0;
    // while ( $row = mysqli_fetch_assoc($q) ) {

    //     // $color = colorSeguimiento($row[progreso]);
    //     echo '<tr style="font-size:11px" class="'.$color.'">';
    //     echo '<td>'. ++$i .'</td>';
    //     echo '<td>'.$row[comisionistanombre].'</td>';
    //     echo '<td>'.$row[razonsocial].'</td>';
    //     echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
    //     echo '</tr>';

    // }

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Nº</th>
                        <th>Comisionista</th>
                        <th>Telefono</th>                           
                        <th>Email</th>
                        <th>Asesor</th>
                        <th>Contacto</th>
                    </tr>
                </thead>
                <tbody>';
    while ( $row = mysqli_fetch_assoc($q) ) {

        // $color = colorSeguimiento($row[progreso]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[nombre].'</td>';
        echo '<td>'.$row[telefono].'</td>';
        echo '<td>'.$row[email].'</td>';
        echo '<td>'.$row[asesor].'</td>';
        echo '<td>'.$row[contacto].'</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

