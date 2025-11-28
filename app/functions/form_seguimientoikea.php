<?

include './funciones.php';


if ( $_POST['buscarempresa'] == 1 ) {

    unset($_POST['seg-comercial']);
    unset($_POST['buscarempresa']);
    
    // DIFERENCIA EMPRESAS ONLINE Y PRESENCIALES.

    if ( $_POST['razonsocial'] == "" ) {

        $q = 'SELECT e.id, cif, razonsocial, ge.grupo, e.vencimiento
        FROM empresas e, grupos_empresas ge
        WHERE e.grupo = ge.id';

    } else {

        $q = 'SELECT e.id, cif, razonsocial, ge.grupo, e.vencimiento 
        FROM empresas e, grupos_empresas ge
        WHERE e.grupo = ge.id 
        AND razonsocial LIKE "%' . $_POST[razonsocial] . '%"';      

    }

    $q = mysqli_query($link, $q);

    echo '<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Nombre Fiscal</th>
                    <th>CIF</th>
                    <th>Grupo</th>
                    <th>Vencimiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';

        while ($row = mysqli_fetch_array($q)) { 
            echo "<tr>";            
            echo '<td style="display:none" id="id">';
            print($_POST[id]);
            echo "</td>";
            echo '<td style="display:none" id="idempfac">';
            print($row[id]);
            echo "</td>";
            echo '<td id="razonsocial">';
            print($row[razonsocial]);
            echo "</td>";
            echo '<td>';
            print($row[cif]);
            echo "</td>";
            echo '<td>';
            print($row[grupo]);
            echo "</td>";
            echo '<td id="vencimiento">';
            print($row[vencimiento]);
            echo "</td>";
            echo '<td><a id="segseleccionarempresa" name="empresas" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';  
        }
        
        echo '</tbody>
        </table>';


} else if ( $_POST['seg-comercial'] == 0 ) {

    unset($_POST['seg-comercial']);
    unset($_POST['buscarempresa']);

    $i = 0;
    foreach ($_POST as $key => $value) { 

        if ( $value != "" ) {

            if ($i>=1)          
                $and = ' AND ';
            $i++;

            if ($key == 'denominacion') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
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

            if ($key == 'docente') {
                $key = 'id_docente';
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
            }

            if ($key == 'progreso') {
                $progre = split("-", $value); 
                $in = ' '.$key.' BETWEEN '.$progre[0].' AND '.$progre[1];
                $like = ''; 
                $fechas = '';
            }

            if ($key == 'fechaini') {
                $fechas = ' '.$key.' >= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
            }
            
            if ($key == 'fechafin') {      
                $fechas = ' '.$key.' <= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';         
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


    $q = 'SELECT a.nombre as nombrealu, a.apellido as apealu, a.apellido2 as ape2alu, e.razonsocial, ac.numeroaccion, ga.ngrupo, 
    m.fechaini, m.fechafin, mt.progreso, d.nombre, d.apellido, ac.denominacion
    FROM alumnos a, acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, mat_doc md, docentes d 
    WHERE a.id = mt.id_alumno 
    AND ac.id = m.id_accion 
    AND e.id = mt.id_empresa 
    AND ga.id = m.id_grupo 
    AND m.id = mt.id_matricula 
    AND m.id = md.id_matricula 
    AND md.id_docente = d.id 
    AND ac.modalidad = "Teleformación"
    AND '.$campos;
    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Nº</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Alumno</th>
                        <th>Empresa</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Docente</th>
                        <th>Progreso</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        $color = colorSeguimiento($row[progreso]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[nombrealu].' '.$row[apealu].' '.$row[ape2alu].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo '<td>'.$row[progreso].'%</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';


} else if ($_POST['seg-comercial'] == 1) {

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
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {

                if ( $gestion == "" ) {
                    $like = $key.' LIKE '."'%".$value."%'";
                    $in = ''; $grupo = '';
                    $fechas = '';
                    $costes = ' (SELECT DISTINCT mc.costes_imparticion
                    FROM mat_costes mc, mat_alu_cta_emp ma, empresas e, acciones a, matriculas m
                    WHERE ma.id_matricula = mc.id_matricula 
                    AND m.id = ma.id_matricula
                    AND a.id = m.id_accion
                    AND e.id = ma.id_empresa 
                    AND mc.id_matricula = @idmat
                    AND mc.id_empresa = @idemp) as coste ';
                    $costesemp1 = ' @idemp:=e.id, ';
                    $costesemp2 = ', @idemp:=e.id ';
                    $costesemp3 = ', e.id ';
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
                $fechas = ' '.$key.' >= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
                $grupo = '';
            }
            
            if ($key == 'fechafin') {      
                $fechas = ' '.$key.' <= "'.$value.'"';
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

    // echo $gestion;
    if ( $gestion == 2015 ) {


        $q = 'SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago, FORMAT(mc.costes_imparticion,2) as costet
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND mc.id_matricula = ma.id_matricula
        AND mc.id_empresa = ma.id_empresa
        AND ma.tipo = "Privado"
        AND mc.mes_bonificable = 0
        AND '.$campos.'
                UNION 
        SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago, FORMAT(mc.costes_imparticion,2) as costet
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND mc.id_matricula = ma.id_matricula
        AND mc.id_empresa = ma.id_empresa
        AND ma.tipo = ""
        AND mc.mes_bonificable <> 0
        AND '.$campos.'
                UNION
SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, CONCAT(" ** ",FORMAT(presupuesto,2)," ** ") as coste, m.estado, e.agente, e.iban, e.formapago, FORMAT(presupuesto,2) as costet        
FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND ma.tipo = "Privado"
        AND m.id NOT IN( SELECT id_matricula FROM mat_costes )
        AND '.$campos.'              
        UNION 
        SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, CONCAT(" ** ",FORMAT(presupuesto,2)," ** ") as coste, m.estado, e.agente, e.iban, e.formapago, FORMAT(presupuesto,2) as costet        
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND ma.tipo = ""
        AND m.id NOT IN( SELECT id_matricula FROM mat_costes )     
        AND '.$campos.'
        UNION 
        SELECT DISTINCT ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, CONCAT(" ** ",FORMAT(presupuesto,2)," ** ") as coste, m.estado, e.agente, e.iban, e.formapago, FORMAT(presupuesto,2) as costet        
        FROM alumnos a, acciones ac, matriculas m, empresas e, grupos_acciones ga, comerciales c, ptemp_mat_emp ma
        WHERE e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id                
        AND ma.id_matricula = m.id
        AND m.estado NOT IN ("Finalizada")
        AND '.$campos.'
        ORDER BY numeroaccion, ngrupo';
        // echo $q;

    } else {


    // echo $campos."<br>";
    if ( $_SESSION['user'] != 'oscar' && $_SESSION['user'] != 'efren' && $_SESSION['user'] != 'isabel' ) {

        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, 
        IF(m.comercial <> 0, c.nombre, GROUP_CONCAT( DISTINCT c.nombre SEPARATOR  " | " ) ) AS comercial, '.$costesemp1.''  
        .$costes.'
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c, mat_costes mc
        WHERE '.$comercial.'
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND mc.id_matricula = m.id
        AND mc.id_matricula = mt.id_matricula 
        AND mt.id_empresa = e.id 
        AND '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, GROUP_CONCAT( DISTINCT c.nombre SEPARATOR  " | " ) AS comercial, m.presupuesto as coste '.$costesemp2.'   
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c
        WHERE '.$comercial.'
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND m.id NOT IN ( SELECT id_matricula FROM mat_costes )
        AND mt.id_empresa = e.id 
        AND '.$campos.'
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) as razonsocial, ac.numeroaccion, 
        ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, GROUP_CONCAT( DISTINCT c.nombre SEPARATOR  " | " ) AS comercial, m.presupuesto as coste '.$costesemp3.'
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, comerciales c, ptemp_mat_emp pm
        WHERE '.$comercial.'
        AND m.id = pm.id_matricula
        AND pm.id_empresa = e.id
        AND ac.id = m.id_accion 
        AND ga.id = m.id_grupo 
        AND m.id NOT IN ( SELECT id_matricula FROM mat_alu_cta_emp )
        AND '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo
        ORDER BY numeroaccion';



    
    } else { 

        $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre, c.apellido, '.$costesemp1.''  
        .$costes.'
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c, mat_costes mc
        WHERE '.$comercial.'
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND mc.id_matricula = m.id
        AND mc.id_matricula = mt.id_matricula 
        AND mt.id_empresa = e.id 
        AND '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) AS razonsocial, 
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre, c.apellido, m.presupuesto as coste '.$costesemp2.'   
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, comerciales c
        WHERE '.$comercial.'
        AND ac.id = m.id_accion 
        AND e.id = mt.id_empresa 
        AND ga.id = m.id_grupo 
        AND m.id = mt.id_matricula
        AND m.id NOT IN ( SELECT id_matricula FROM mat_costes )
        AND mt.id_empresa = e.id 
        AND '.$campos.'
        GROUP BY ac.numeroaccion, ga.ngrupo

        UNION 

        SELECT m.id as mat, ac.modalidad, GROUP_CONCAT( DISTINCT e.razonsocial SEPARATOR  " | " ) as razonsocial, ac.numeroaccion, 
        ga.ngrupo, m.fechaini, m.fechafin, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre , c.apellido, m.presupuesto as coste 
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, comerciales c, ptemp_mat_emp pm
        WHERE '.$comercial.'
        AND m.id = pm.id_matricula
        AND pm.id_empresa = e.id
        AND ac.id = m.id_accion 
        AND ga.id = m.id_grupo 
        AND m.id NOT IN ( SELECT id_matricula FROM mat_alu_cta_emp )
        AND '.$campos.' 
        GROUP BY ac.numeroaccion, ga.ngrupo
        ORDER BY numeroaccion';

    }
    }   

    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr> 
                        <th>Nº</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Modalidad</th>
                        <th>Empresa</th>
                        <th>IBAN</th>
                        <th>Pago</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Comercial</th>
                        <th>Agente</th>
                        <th>Estado</th>
                        <th>Coste</th>';

                    echo '</tr>
                </thead>
                <tbody>';

    $i = 0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        
        if ( $gestion != "" )
            $total += str_replace(",","",$row[costet]); 

        $color = colorSeguimientoEstado($row[estado]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        // echo '<td>'.$row[mat].'</td>';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[iban].'</td>';
        echo '<td>'.$row[formapago].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[comercial].'</td>';     
        echo '<td>'.$row[agente].'</td>';      
        // echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';      
        echo '<td>'.$row[estado].'</td>';                
        echo '<td id="coste" style="width: 8%">';
        if ( $gestion != "" )
            echo $row[coste].' €';
        else
            echo number_format($row[coste],2,',','.');
        echo '</td>';
        // echo '<td>'.$total.'</td>';
        echo '</tr>';
    

    }
    echo '</tbody>';
    if ( $gestion != ""  )
        echo '<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>';

    echo '</table>'; 


} 

?>
