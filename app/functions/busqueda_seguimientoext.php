<?

include './funciones.php';

print_r($_POST);

// if ($_POST['seg-comercial'] == 1) {

//     unset($_POST['seg-comercial']);
//     unset($_POST['buscarempresa']);

//     // $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
//     // $costes = ' (SELECT SUM(mc.costes_imparticion)
//     // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
//     $costesemp1 = '';
//     $costesemp2 = '';
//     $grupo = '';

//     $i = 0;
//     foreach ($_POST as $key => $value) { 

//         if ( $value != "" ) {

//             if ($i>=1)          
//                 $and = ' AND ';
//             $i++;

//             if ($key == 'denominacion') {
//                 $like = $key.' LIKE '."'%".$value."%'";
//                 $in = ''; $grupo = '';
//                 $fechas = '';
//             }

//             if ($key == 'razonsocial') {

//                 if ( $gestion == "" ) {
//                     $like = $key.' LIKE '."'%".$value."%'";
//                     $in = ''; $grupo = '';
//                     $fechas = '';
//                     // $costes = ' (SELECT DISTINCT mc.costes_imparticion
//                     // FROM mat_costes mc, mat_alu_cta_emp ma, empresas e, acciones a, matriculas m
//                     // WHERE ma.id_matricula = mc.id_matricula 
//                     // AND m.id = ma.id_matricula
//                     // AND a.id = m.id_accion
//                     // AND e.id = ma.id_empresa 
//                     // AND mc.id_matricula = @idmat
//                     // AND mc.id_empresa = @idemp) as coste ';
//                     // $costesemp1 = ' @idemp:=e.id, ';
//                     // $costesemp2 = ', @idemp:=e.id ';
//                     // $costesemp3 = ', e.id ';
//                 } else {
//                     $like = $key.' LIKE '."'%".$value."%'";
//                     $in = ''; $grupo = ''; $fechas = '';
//                 }
//             }
             
//             if ($key == 'numeroaccion') {
                
//                 $grupot = split("/", $value);
//                 $value = $grupot[0];
//                 if ($grupot[1] != "")
//                     $grupo = ' AND ngrupo = '.$grupot[1];
                
//                 $in = ' '.$key.' IN '."('".$value."')";
//                 $like = '';
//                 $fechas = '';

//             }

//             if ($key == 'comercial') {   

//                 if ( $gestion != "" )          
//                     $in = ' c.id IN '."('".$value."')";
//                 else {
//                     $in = ' c.id IN '."('".$value."')";
//                     $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
//                 }

//                     $like = '';
//                     $fechas = '';
//                     $grupo = '';
//                 }


//             if ($key == 'agente') {   

//                 $like = $key.' LIKE '."'%".$value."%'";  
//                 $in = '';
//                 $fechas = '';
//                 $grupo = '';

//             }

//             if ($key == 'estado') {
//                 $in = ' '.$key.' IN '."('".$value."')";
//                 $like = ''; 
//                 $fechas = '';
//                 $grupo = '';
//             }

//             if ($key == 'modalidad') {
//                 $in = ' a.'.$key.' IN '."('".$value."')";
//                 $like = ''; 
//                 $fechas = '';
//                 $grupo = '';
//             }

//             if ($key == 'centro') {
//                 $in = ' '.$key.' IN '."('".$value."')";
//                 $like = ''; 
//                 $fechas = '';
//                 $grupo = '';
//             }

//             if ( $key == 'mes_fin' ) {
//                 $in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
//                 $like = '';
//                 $fechas = '';
//                 $grupo = '';
//             }

//             if ($key == 'fechaini') {
//                 $fechas = ' m.'.$key.' >= "'.$value.'"';
//                 $in = ''; $like = '';
//                 $value = '';
//                 $grupo = '';
//             }
            
//             if ($key == 'fechafin') {      
//                 $fechas = ' m.'.$key.' <= "'.$value.'"';
//                 $in = ''; $like = '';
//                 $value = '';    
//                 $grupo = '';     
//             }           

//             if ($key == 'bonificado') {

//                 $key = 'ngrupo';
//                 if ( $value == 'bonificado' ) 
//                     $in = ' '.$key.' NOT LIKE "%p%"';
//                 else if ( $value == 'privado' )
//                     $in = ' '.$key.' LIKE "%p%"';

//                 $fechas = ''; $like = '';
//             }        

//             $campos .= $and.$fechas.$like.$in.$grupo;

//         }
        
//     } 


//         $q = '
//         SELECT DISTINCT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro, CONCAT("(", m.presupuesto,")") as costes_imparticion
//         FROM matriculas m, acciones a, grupos_acciones ga, centros c, ptemp_mat_emp pm, grupos_empresa ge, empresas e
//         WHERE m.id_accion = a.id      
//         AND ga.id = m.id_grupo 
//         AND m.centro = c.id
//         AND ge.id = e.grupo
//         AND pm.id_empresa = e.id
//         AND pm.id_matricula = m.id
//         AND estado IN("Comunicada")
//         AND a.modalidad IN("Presencial", "Mixta")
//         AND m.estado NOT IN ("Anulada","Oculto") 
//         AND '.$campos.'
//         UNION 
//         SELECT DISTINCT m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro, mc.costes_imparticion
//         FROM matriculas m, acciones a, grupos_acciones ga, centros c, mat_costes mc, mat_alu_cta_emp pm, grupos_empresa ge, empresas e
//         WHERE m.id_accion = a.id
//         AND mc.id_matricula = m.id
//         AND ga.id = m.id_grupo 
//         AND m.centro = c.id
//         AND ge.id = e.grupo
//         AND pm.id_empresa = e.id
//         AND pm.id_matricula = m.id       
//         AND estado IN("Finalizada", "Facturada")
//         AND m.estado NOT IN ("Anulada","Oculto") 
//         AND '.$campos.'
//         ORDER BY id DESC';
   
//     $rutaini = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';
//     $rutafin = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/fin/';
//     echo $q;
//     // $q = mysqli_query($link, $q) or die("error ".mysqli_error($link));


//     echo '<table style="margin-top: 15px;" class="table">
//                 <thead>
//                     <tr> 
//                         <th>Acción/Grupo</th>                        
//                         <th>Denominación</th>
//                         <th>Centro</th>
//                         <th>Horas</th>                        
//                         <th>Modalidad</th>
//                         <th>Inicio</th>
//                         <th>Fin</th>
//                         <th>Estado</th>
//                         <th style="width:6%">Costes</th>
//                         <th>Notif. Inicio</th>
//                         <th>Notif. Fin</th>';
//                     echo '</tr>
//                 </thead>
//                 <tbody>';

//     $i = 0;
//     while ( $row = mysqli_fetch_assoc($q) ) {

        
//         $total += str_replace(",","",$row[costet]); 

//         $color = colorSeguimientoEstado($row[estado]);
//         echo '<tr style="font-size:11px" class="'.$color.'">';
//         echo '<td style="display:none" id="id_mat">'.$row[id].'</td>';
//         echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';     
//         echo '<td>'.$row[denominacion].'</td>';
//         echo '<td>'.$row[nombrecentro].'</td>';
//         echo '<td>'.$row[horastotales].'</td>';
//         echo '<td>'.$row[modalidad].'</td>';
//         echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
//         echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';        
//         echo '<td>'.$row[estado].'</td>';
//         echo '<td style="">'.$row[costes_imparticion].' €</td>';

//         if ( file_exists($rutaini . $row[numeroaccion].'-'.$row[ngrupo].'ini.pdf') ) 
//             echo '<td><a class="btn-xs btn-success" id="mostrarpdfini"><span class="glyphicon glyphicon-save"></span></a></td>';
//         else
//             echo '<td><a class="btn-xs btn-danger" id="mostrarpdfini"><span class="glyphicon glyphicon-remove"></span></a></td>';

//         if ( file_exists($rutafin . $row[numeroaccion].'-'.$row[ngrupo].'fin.pdf') ) 
//             echo '<td><a class="btn-xs btn-succcess" id="mostrarpdffin"><span class="glyphicon glyphicon-save"></span></a></td>';
//         else
//             echo '<td><a class="btn-xs btn-danger" id="mostrarpdffin"><span class="glyphicon glyphicon-remove"></span></a></td>';
//         // echo '<td>'.$total.'</td>';
//         echo '</tr>';
    

//     }
//     echo '</tbody>';
//     // if ( $gestion != ""  )
//         // echo '<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>';

//     echo '</table>'; 


// } 

?>
