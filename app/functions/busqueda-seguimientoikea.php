<?

include './funciones.php';


if ($_POST['seg-comercial'] == 1) {

    unset($_POST['seg-comercial']);
    unset($_POST['buscarempresa']);
    $interna = $_POST[interna];
    unset($_POST['interna']);

    // $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';

    $i = 0;
    foreach ($_POST as $key => $value) {

        if ( $value != "" ) {

            // if ($i>=1)
                // $and = ' AND ';
            $i++;

            if ($key == 'denominacion') {
                $like = ' AND a.'.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'cif') {
                $razonsocial = 1;
                // echo "entro";
                if ( $gestion == "" ) {
                    $in = ' AND t.id_empresa IN '."('".$value."')";
                    $like = ''; $grupo = '';
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
                    $in = ' AND  t.id_empresa IN '."('".$value."')";
                    $like = ''; $grupo = ''; $fechas = '';
                }
            }

            if ($key == 'numeroaccion') {

                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];

                $in = ' AND  '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            if ($key == 'comercial') {

                if ( $gestion != "" )
                    $in = ' AND  c.id IN '."('".$value."')";
                else {
                    $in = ' AND  c.id IN '."('".$value."')";
                    $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                }

                    $like = '';
                    $fechas = '';
                    $grupo = '';
                }


            if ($key == 'agente') {

                $like = '  AND '.$key.' LIKE '."'%".$value."%'";
                $in = '';
                $fechas = '';
                $grupo = '';

            }

            if ($key == 'tienda_asignada') {

                $like = '';
                $in = '  AND '.$key.' IN '."('".$value."')";
                $fechas = '';
                $grupo = '';

            }

            if ($key == 'estado') {
                $in = ' AND  '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'modalidad') {
                $in = ' AND  a.'.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'centro') {
                $in = ' AND  '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ( $key == 'mes_fin' ) {
                $in = ' AND  fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'fechaini') {
                $fechas = ' AND  m.'.$key.' >= "'.$value.'"';
                $in = ' '; $like = '';
                $value = '';
                $grupo = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' AND  m.'.$key.' <= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
                $grupo = '';
            }

            if ($key == 'bonificado') {

                $key = 'ngrupo';
                if ( $value == 'bonificado' )
                    $in = ' AND  '.$key.' NOT LIKE "%p%"';
                else if ( $value == 'privado' )
                    $in = ' AND  '.$key.' LIKE "%p%"';

                $fechas = ''; $like = '';
            }

            $campos .= $and.$fechas.$like.$in.$grupo;

        }

    }

        echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th> ID </th>
                        <th>Nº Solicitud</th>
                        <th>Usuario</th>
                        <th>Acción/Grupo</th>
                        <th>Denominación</th>
                        <th>Razón Social</th>
                        <th>Materia</th>
                        <th>Interna</th>
                        <th>Tienda</th>
                        <th>Horas</th>
                        <th>Modalidad</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Estado</th>
                        <th style="width:5%">Costes</th>
                        <th>Incidencias</th>
                        <th>Participantes</th>
                        <th>Excel<br>Participantes</th>
                        <th>Notif. Inicio</th>
                        <th>Notif. Fin</th>';
                    echo '</tr>
                </thead>
                <tbody>';



    $rutaini = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/inicio/';
    $rutadoc = dirname(__DIR__).'/ikea'.$gestion.'/tablasparticipantes/';
    $rutadocf = 'ikea'.$gestion.'/tablasparticipantes/';
    $rutafin = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/fin/';



    if ( $interna == "" || $interna == "No" ) {

        if ( $razonsocial == 1 ) {


            $q = '
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro,


            ROUND(m.presupuesto*((t.nalus)/(SELECT SUM(nalus) FROM temp_empresas_ikea WHERE id_solicitud = @id_sol)),2) as costes_imparticion,

            s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, centros c, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud
            AND t.id_solicitud = s.id
            AND ga.id = m.id_grupo
            AND m.centro = c.id
            AND m.id_solicitudikea = s.id
            AND estado IN("Comunicada", "Creada")
            AND a.modalidad IN("Presencial", "Mixta")
            AND m.estado NOT IN ("Oculto")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, "" as nombrecentro, ROUND(mc.costes_imparticion,2) as costes_imparticion, s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, temp_empresas_ikea t, empresas e, mat_costes mc
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud
            AND t.id_solicitud = s.id
            AND mc.id_matricula = m.id AND m.grupo = 0
            AND ga.id = m.id_grupo AND m.id_solicitudikea = s.id AND m.estado NOT IN ("Oculto")
            AND estado IN("Comunicada", "Creada")
            AND a.modalidad IN("Teleformación", "A Distancia")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, "" as nombrecentro,

            ROUND(m.presupuesto*((t.nalus)/(SELECT SUM(nalus) FROM temp_empresas_ikea WHERE id_solicitud = @id_sol)),2) as costes_imparticion,

            s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud
            AND t.id_solicitud = s.id
            AND m.grupo = 1
            AND ga.id = m.id_grupo AND m.id_solicitudikea = s.id AND m.estado NOT IN ("Oculto")
            AND estado IN("Comunicada", "Creada")
            AND a.modalidad IN("Teleformación", "A Distancia")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro, ROUND(mc.costes_imparticion,2), s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, centros c, mat_costes mc, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud
            AND t.id_solicitud = s.id
            AND mc.id_matricula = m.id
            AND ga.id = m.id_grupo
            AND m.centro = c.id
            AND m.id_solicitudikea = s.id
            AND estado IN("Finalizada", "Facturada","Liquidada")
            AND m.estado NOT IN ("Oculto")
            '.$campos.'
            ORDER BY id DESC';


        } else {

            $q = '
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro,

            ROUND(m.presupuesto*((t.nalus)/(SELECT SUM(nalus) FROM temp_empresas_ikea WHERE id_solicitud = @id_sol)),2) as costes_imparticion

            , s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, centros c, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud
            AND ga.id = m.id_grupo
            AND m.centro = c.id
            AND m.id_solicitudikea = s.id
            AND estado IN("Comunicada")
            AND a.modalidad IN("Presencial", "Mixta")
            AND m.estado NOT IN ("Oculto")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, "" as nombrecentro, ROUND(mc.costes_imparticion,2) as costes_imparticion, s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, mat_costes mc, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud  AND ga.id = m.id_grupo AND m.id_solicitudikea = s.id AND m.estado NOT IN ("Oculto") AND m.grupo = 0
            AND mc.id_matricula = m.id
            AND mc.id_empresa = e.id
            AND a.modalidad IN("Teleformación", "A Distancia")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, "" as nombrecentro,

            ROUND(m.presupuesto*((t.nalus)/(SELECT SUM(nalus) FROM temp_empresas_ikea WHERE id_solicitud = @id_sol)),2) as costes_imparticion

            , s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, temp_empresas_ikea t, empresas e
            WHERE m.id_accion = a.id
            AND e.id = t.id_empresa
            AND s.id = t.id_solicitud  AND ga.id = m.id_grupo AND m.id_solicitudikea = s.id AND m.estado NOT IN ("Oculto") AND m.grupo = 1
            AND a.modalidad IN("Teleformación", "A Distancia")
            '.$campos.'
            UNION
            SELECT DISTINCT @id_sol:=s.id as id_solicitud, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.horastotales, a.modalidad, a.denominacion, ga.ngrupo, m.estado, m.solicitud, c.nombrecentro, ROUND(mc.costes_imparticion,2) as costes_imparticion, s.interna, s.materia, s.tienda_asignada, e.razonsocial, e.id as id_emp, m.id as id_mat, s.denominacion as demsol, s.numero as nsol, s.usuario, s.numalumnos, incidenciasfinamanda
            FROM matriculas m, acciones a, grupos_acciones ga, ikea_solicitudes s, centros c, mat_costes mc, empresas e
            WHERE m.id_accion = a.id
            AND mc.id_matricula = m.id
            AND mc.id_empresa = e.id
            AND ga.id = m.id_grupo
            AND m.centro = c.id
            AND m.id_solicitudikea = s.id
            AND estado IN("Finalizada", "Facturada","Liquidada")
            AND m.estado NOT IN ("Oculto")
            '.$campos.'

            ORDER BY id DESC';

        }



    if ( isRoot() ) echo $q;
    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));



    $i = 0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        if ( $gestion != "" )
            $total += str_replace(",","",$row[costes_imparticion]);

        $color = colorSeguimientoEstado($row[estado]);
        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td  id="id_mat">'.$row[id].'</td>';
        echo '<td>'.$row[solicitud].'</td>';
        echo '<td>'.$row[usuario].'</td>';
        echo '<td style="width:5%">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[materia].'</td>';
        echo '<td>'.$row[interna].'</td>';
        echo '<td>'.$row[tienda_asignada].'</td>';
        echo '<td>'.$row[horastotales].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[estado].'</td>';
        echo '<td style="">'.$row[costes_imparticion].' €</td>';

        if ( strpos($ngrupo, 'p') !== FALSE )
            $boton = 'mostrarAlumnosEmpPrePrivado';
        else
            $boton = 'mostrarAlumnosEmpPre';

        if ( $row[estado] == "Finalizada" || $row[estado] == "Facturada" ) {
            $tipo = 'tipo="fin"';
        } else {
            $tipo = 'tipo="docu"';
        }

        if ( $row[incidenciasfinamanda] != "" && $row[incidenciasfinamanda] !== NULL )
            $btncolor = ' btn-success ';
        else
            $btncolor = ' btn-warning ';
        echo '<td '.$clase.' style="text-align:center"><a incidencias="'.$row[incidenciasfinamanda].'" name="'.$row[id_emp].'" id_mat="'.$row[id_mat].'" '.$tipo.' class="btn-xs '.$btncolor.'" id="incidenciasikea"><span class="glyphicon glyphicon-list-alt"></span></a></td>';

        echo '<td style="text-align:center"><a name="'.$row[id_emp].'" id_mat="'.$row[id_mat].'" '.$tipo.' class="btn-xs btn-success" id="'.$boton.'"><span class="glyphicon glyphicon-list-alt"></span></a></td>';

        // echo ($rutadoc . $row[numero].'_'.$row[demsol].'.xlsx');

        if ( file_exists($rutadoc . $row[nsol].'_'.$row[demsol].'.xlsx') )
            echo '<td style="text-align:center"><a href="'.$rutadocf.$row[nsol].'_'.$row[demsol].'.xlsx" class="btn-xs btn-success"><span class="glyphicon glyphicon-save"></span></a></td>';
        else
            echo '<td style="text-align:center"><a href="'.$rutadocf.$row[nsol].'_'.$row[demsol].'.xlsx" class="btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';

        if ( file_exists($rutaini . $row[numeroaccion].'-'.$row[ngrupo].'ini.pdf') )
            echo '<td><a class="btn-xs btn-success" id="mostrarpdfini"><span class="glyphicon glyphicon-save"></span></a></td>';
        else
            echo '<td><a class="btn-xs btn-danger" id="mostrarpdfini"><span class="glyphicon glyphicon-remove"></span></a></td>';

        if ( file_exists($rutafin . $row[numeroaccion].'-'.$row[ngrupo].'fin.pdf') )
            echo '<td><a class="btn-xs btn-success" id="mostrarpdffin"><span class="glyphicon glyphicon-save"></span></a></td>';
        else
            echo '<td><a class="btn-xs btn-danger" id="mostrarpdffin"><span class="glyphicon glyphicon-remove"></span></a></td>';

        echo '</tr>';


        }
    }

    if ( $interna != "No" ) {

        $qx = 'SELECT DISTINCT *
        FROM ikea_solicitudes i, temp_empresas_ikea t, empresas e
        WHERE t.id_empresa = e.id
        AND t.id_solicitud = i.id
        AND interna = "Si"';
        $qx = mysqli_query($link, $qx) or die("error select : " .mysqli_error($link));


        while ( $rx = mysqli_fetch_assoc($qx) ) {


            echo '<tr style="font-size:11px">';
            echo '<td  id="id_mat">'.$rx[id].'</td>';
            echo '<td>IK'.$rx[numero].'</td>';
            echo '<td>'.$rx[usuario].'</td>';
            echo '<td> - </td>';
            echo '<td>'.$rx[denominacion].'</td>';
            echo '<td>'.$rx[razonsocial].'</td>';
            echo '<td>'.$rx[materia].'</td>';
            echo '<td>'.$rx[interna].'</td>';
            echo '<td>'.$rx[tienda_asignada].'</td>';
            echo '<td>'.$rx[horastotales].'</td>';
            echo '<td>'.$rx[modalidad].'</td>';
            echo '<td>'.date("d/m/Y",strtotime($rx[fechaini])).'</td>';
            echo '<td>'.date("d/m/Y",strtotime($rx[fechafin])).'</td>';
            echo '<td> - </td>';
            echo '<td>'.$rx[importeformador].'</td>';
            echo '<td>'.$rx[numalumnos].'</td>';
            if ( file_exists($rutadoc . $rx[numero].'_'.$rx[denominacion].'.xlsx') )
                echo '<td style="text-align:center"><a href="'.$rutadocf.$rx[numero].'_'.$rx[denominacion].'.xlsx" class="btn-xs btn-success"><span class="glyphicon glyphicon-save"></span></a></td>';
            else
                echo '<td style="text-align:center"><a href="'.$rutadocf.$rx[numero].'_'.$rx[denominacion].'.xlsx" class="btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>';

            echo '<td> - </td>';
            echo '<td> - </td>';
            // echo '<td>'.$rx[estado].'</td>';
            // echo '<td style="">'.$rx[costes_imparticion].' €</td>';
            echo '</tr>';


        }
    }

    echo '</tbody>';
     if ( $gestion != ""  )
         echo '<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>';

    echo '</table>';


}

?>
