<?

include './funciones.php';


if ($_POST['seg-comercial'] == 1) {

    unset($_POST['seg-comercial']);
    unset($_POST['buscarempresa']);

    $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    $costes = ' (SELECT SUM(mc.costes_imparticion)
    FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';

    $i = 0;
    foreach ($_POST as $key => $value) { 

        if ( $value != "" ) {

            if ($i>=1)          
                $and = ' AND ';
            $i++;

            if ($key == 'denominacion') {
                $like = ' formacion LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {

                if ( $gestion == "" ) {
                    $like = $key.' LIKE '."'%".$value."%'";
                    $in = ''; $grupo = '';
                    $fechas = '';
                    // $costes = ' (SELECT DISTINCT mc.costes_imparticion
                    // FROM mat_costes mc, mat_alu_cta_emp ma, empresas e, acciones a, matriculas m
                    // WHERE ma.id_matricula = mc.id_matricula 
                    // AND m.id = ma.id_matricula
                    // AND a.id = m.id_accion
                    // AND e.id = ma.id_empresa 
                    // AND mc.id_matricula = @idmat
                    // AND mc.id_empresa = @idemp) as coste ';
                    // $costesemp1 = ' @idemp:=e.id, ';
                    // $costesemp2 = ', @idemp:=e.id ';
                    // $costesemp3 = ', e.id ';
                } else {
                    $like = $key.' LIKE '."'%".$value."%'";
                    $in = ''; $grupo = ''; $fechas = '';
                }
            }
             
            if ($key == 'numeroaccion') {
                
                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];
                
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            if ($key == 'comercial') {   

                if ( $gestion != "" )          
                    $in = ' c.id IN '."('".$value."')";
                else {
                    $in = ' c.id IN '."('".$value."')";
                    $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                }

                    $like = '';
                    $fechas = '';
                    $grupo = '';
                }


            if ($key == 'agente') {   

                $like = $key.' LIKE '."'%".$value."%'";  
                $in = '';
                $fechas = '';
                $grupo = '';

            }

            if ($key == 'estado') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = ''; 
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'modalidad') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = ''; 
                $fechas = '';
                $grupo = '';
            }

            if ( $key == 'mes_fin' ) {
                $in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                $grupo = '';
            }
            // if ($key == 'iban') {
            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = ''; 
            //     $fechas = '';
            //     $grupo = '';
            // }

            //  if ($key == 'formapago') {
            //     $in = ' '.$key.' IN '."('".$value."')";
            //     $like = ''; 
            //     $fechas = '';
            //     $grupo = '';
            // }

            if ($key == 'fechaini') {
                $fechas = ' p.'.$key.' >= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
                $grupo = '';
            }
            
            if ($key == 'fechafin') {      
                $fechas = ' p.'.$key.' <= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';    
                $grupo = '';     
            }           

            if ($key == 'bonificado') {

                $key = 'ngrupo';
                if ( $value == 'bonificado' ) 
                    $in = ' '.$key.' NOT LIKE "%p%"';
                else if ( $value == 'privado' )
                    $in = ' '.$key.' LIKE "%p%"';

                $fechas = ''; $like = '';
            }        

            $campos .= $and.$fechas.$like.$in.$grupo;

        }
        
    } 

        $q = 'SELECT DISTINCT p.*, c.nombre, pf.*
        FROM propuestas_formativas p, comerciales c, peticiones_formativas pf
        WHERE p.id_comercial = c.id 
        AND pf.numero = p.numsolicitud
        AND '.$campos;


    // echo $q;
    $q = mysqli_query($link, $q) or die(mysqli_error($link));


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Nº</th>                        
                        <th>Comercial</th>
                        <th>Denominación</th>
                        <th>Empresa</th>
                        <th>Modalidad</th>
                        <th>Horas</th>                        
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th>Fecha Petición</th>
                        <th>Fecha Propuesta</th>
                        <th>Fecha Firma</th>
                        <th>Maduración</th>';
                echo '</tr>
                </thead>
                <tbody>';

    $i = 0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        $color = colorSeguimientoIKEA($row[estado_propuesta]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        // echo '<td>'.$row[mat].'</td>';
        echo '<td>P'.$row[numero].'</td>';  
        echo '<td>'.$row[nombre].'</td>';     
        echo '<td>'.$row[formacion].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[horastotales].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';        
        echo '<td>'.$row[estado_propuesta].'</td>';                
        echo '<td>'.formateaFecha($row[fecha_peticion]).'</td>';                
        echo '<td>'.$propuesta = formateaFecha($row[fecha_propuesta]).'</td>';
        echo '<td>'.$firma = formateaFecha($row[fecha_firma]).'</td>';                
        $maduracion = $firma - $propuesta;
        echo '<td>'.$maduracion.' días</td>';                
        // echo '<td>'.$total.'</td>';
        echo '</tr>';
    

    }
    echo '</tbody>';
    // if ( $gestion != ""  )
        // echo '<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>';

    echo '</table>'; 


} 

?>
