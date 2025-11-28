<?

include './funciones.php';

if ( isRoot() ){
    //echo "Llega";
    // echo "Seg Facturacion: ".$_POST['seg-facturacion'];
    // echo "<br>buscarempresa: ".$_POST['buscarempresa'];
    // echo "<br>seg-comercial: ".$_POST['seg-comercial'];
    //echo "<br>seg-comercial: ".$_POST['seg-comercial'];
}

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

} else if ( $_POST['buscarempresa'] == 2 ) {


    unset($_POST['seg-comercial']);
    unset($_POST['buscarempresa']);

    // DIFERENCIA EMPRESAS ONLINE Y PRESENCIALES.

    if ( $_POST['razonsocial'] == "" ) {


    } else {

        $q = 'SELECT e.id, cif, nombrecomercial, razonsocial, c.nombre
        FROM empresas e, grupos_empresas ge, comerciales c
        WHERE e.grupo = ge.id
        AND c.id = e.comercial
        AND razonsocial LIKE "%' . $_POST[razonsocial] . '%"';

    }

    $q = mysqli_query($link, $q);

    echo '<table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nombre Comercial</th>
                    <th>Razón Social</th>
                    <th>Comercial</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = mysqli_fetch_array($q)) {
            echo "<tr>";
            echo '<td style="display:none" id="id">';
            print($row[id]);
            echo "</td>";
            echo '<td id="nombrecomercial">';
            print($row[nombrecomercial]);
            echo "</td>";
            echo '<td id="razonsocial">';
            print($row[razonsocial]);
            echo "</td>";
            echo '<td id="comercial">';

            if ( $row[nombre] == 'Marketing' || $row[nombre] == 'Asesoría' )
                $comercial = 'No asignado';
            else
                $comercial = $row[nombre];

            print($comercial);
            echo "</td>";
            echo "</tr>";
        }

        echo '</tbody>
        </table>';

} else if ( $_POST['seg-comercial'] == "0" ) {

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

            if ($key == 'modalidad') {
                $in = ' '.$key.' = "'.$value.'"';
                $fechas = ''; $like = '';
                $value = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' '.$key.' <= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
            }

            if ($key == 'bfinalizado') {

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' finalizado IN '."('".$value."')";
                $like = '';
                $fechas = '';
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

    $q = 'SELECT a.nombre as nombrealu,
        a.apellido as apealu,
        a.apellido2 as ape2alu,
        e.razonsocial,
        ac.numeroaccion,
        ga.ngrupo,
        m.fechaini,
        m.fechafin,
        mt.progreso,
        d.nombre,
        d.apellido,
        ac.denominacion,
        ac.url,
        mt.finalizado,
        a.documento,
        ac.courseid,
        m.estado,
        mt.dedicacion,
        mt.progreso2,
        mt.tipo
    FROM alumnos a, acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt, mat_doc md, docentes d
    WHERE a.id = mt.id_alumno
    AND ac.id = m.id_accion
    AND e.id = mt.id_empresa
    AND ga.id = m.id_grupo
    AND m.id = mt.id_matricula
    AND m.id = md.id_matricula
    AND md.id_docente = d.id
    AND estado IN("Comunicada","Finalizada", "Gratuita", "Facturada", "Anulada")
    AND '.$campos.' GROUP BY a.id
    UNION
    SELECT
        null as nombrealu,
        null as apealu,
        null as ape2alu,
        null as razonsocial,
        ac.numeroaccion,
        ga.ngrupo,
        m.fechaini,
        m.fechafin,
        null as progreso,
        d.nombre,
        d.apellido,
        ac.denominacion,
        ac.url,
        null as finalizado,
        null as documento,
        ac.courseid,
        m.estado,
        "-",
        "-",
        ""
    FROM acciones ac, grupos_acciones ga, matriculas m, mat_doc md, docentes d
    WHERE ac.id = m.id_accion
    AND ga.id = m.id_grupo
    AND m.id = md.id_matricula
    AND md.id_docente = d.id
    AND estado IN("Comunicada", "Creada", "Anulada")
    AND '.$campos;


    if ( isRoot() ) echo $q;

    $q = mysqli_query($link, $q);

    echo '<table style="margin-top: 15px; font-size:11px !important;" class="table">
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
                        <th>Progreso<br>Contenido</th>
                        <th>Progreso<br>Cuestionario</th>
                        <th>Plataforma</th>
                        <th style="width: 12%">Estado<br>Alumno</th>
                        <th style="width: 12%">Estado<br>Matrícula</th>
                        <th>% Dedicación</th>
                        <th>Conexiones</th>
                        <th>Calificaciones</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        $botonesListados = '';

        $anio = strftime('%y', strtotime($row[fechaini]));
        $mes = strftime('%m', strtotime($row[fechaini]))-1;
        $user = 'alum'.$anio.$mes.substr($row[documento], 1,4);

        $urlListadoMoodle = '/contratos/forms/listados-moodle.php?user_name='.$user.'&curso='.$row[courseid].'&accion='.$row[numeroaccion].'&grupo='.$row[ngrupo].'&plataforma=campusfpe&listado=1';

        $botonesListados = '<td><a target="_blank" href="'.$urlListadoMoodle.'" id="listado-moodle" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-list-alt"></span></a></td>';

        $urlListadoMoodle = '/contratos/forms/listados-moodle.php?user_name='.$user.'&curso='.$row[courseid].'&accion='.$row[numeroaccion].'&grupo='.$row[ngrupo].'&plataforma=campusfpe&listado=2';

        $botonesListados .= '<td><a target="_blank" href="'.$urlListadoMoodle.'" id="listado-moodle" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-list-alt"></span></a></td>';

        $color = colorFinalizacion($row[finalizado], $row[tipo]);
        echo '<tr style="font-size:10px" class="'.$color.'">';
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[nombrealu].' '.$row[apealu].' '.$row[ape2alu].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo '<td>'.$row[progreso].'%</td>';
        echo '<td>'.$row[progreso2].'%</td>';
        echo '<td>';
        if ( strpos($row[url], 'campus') !== FALSE )
            echo 'Moodle';
        else
            echo 'System';
        echo '</td>';
        echo '<td>';
        if ( $row[finalizado] == 0 ) echo "En Progreso";
        else if ( $row[finalizado] == 1 ) {
            if ( $row[tipo] == "Privado" )
                echo "Finalizado - Privado";
            else
                echo "Finalizado - Bonificado";
        }
        else echo "NO Finalizado";
        echo '</td>';
        echo '<td>'.$row['estado'].'</td>';
        echo '<td>'.$row['dedicacion'].'</td>';
        if ( strpos($row[url], 'campus') !== FALSE )   // MOODLE
        {
            echo $botonesListados;
        }
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

                $comercial = 1;
                if ( $gestion != "" ) {
                    $in = ' c.id IN '."('".$value."')";
                    $incomercial = ' c.id IN '."('".$value."')";
                }
                else {
                    $in = ' c.id IN '."('".$value."')";
                    $comercial = '( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                }

                    $like = '';
                    $fechas = '';
                    $grupo = '';
                }


            if ($key == 'agente') {

                $agente = 1;
                $like = $key.' LIKE '."'%".$value."%'";
                if ( $value == "Isabel" )
                    $inagente = ' c.id IN (7,3) ';
                else if ( $value == "Amparo" )
                    $inagente = ' c.id IN (12,3) ';
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
                $fechas2 = ' AND '.$key.' >= "'.$value.'"';
                $in = ''; $like = '';
                $value = '';
                $grupo = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' '.$key.' <= "'.$value.'"';
                $fechas2 = ' '.$key.' <= "'.$value.'"';
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

    if ( $gestion != "" ) {


        $q = 'SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
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
        AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
        AND mc.mes_bonificable = 0
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
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
        AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
        AND mc.mes_bonificable <> 0
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, CONCAT(" ** ",FORMAT( (presupuesto/(SELECT count(*) FROM ptemp_mat_emp ma WHERE ma.id_matricula = @mat)  ),2)," ** ") as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, ptemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND modalidad IN("Presencial", "Mixta")
        AND m.estado IN("Comunicada","Creada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, CONCAT(" ** ",FORMAT( (presupuesto/(SELECT count(*) FROM otemp_mat_emp ma WHERE ma.id_matricula = @mat) ),2) ," ** ") as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, otemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND m.grupo = 1
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada","Creada")
        AND '.$campos.'
          UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, FORMAT(cr.precioventamat,2) as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, costes_rentabilidad cr
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND cr.id_matricula = m.id
        AND ma.tipo = ""
        AND m.grupo = 0
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada", "Creada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, FORMAT(cr.precioventamat,2) as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c,
        costes_rentabilidad cr
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND cr.id_matricula = m.id
        AND ma.tipo = "Privado"
        AND m.grupo = 0
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, m.tipo_docente, e.razonsocial, c.nombre as comercial, 0 as coste, m.estado, e.agente, e.iban, e.formapago
        ,m.incidencias, m.incidenciasfinamanda
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND m.estado IN("Gratuita")
        AND '.$campos.'
        ORDER BY numeroaccion, ngrupo ASC
        ';
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
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.tipo_docente, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre, c.apellido, '.$costesemp1.''
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
        ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, m.tipo_docente, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre, c.apellido, m.presupuesto as coste '.$costesemp2.'
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
        ga.ngrupo, m.fechaini, m.fechafin, m.tipo_docente, m.estado, ac.denominacion, e.iban, e.formapago, c.nombre , c.apellido, m.presupuesto as coste
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
    if ( isRoot() ) {

    }

    $q = mysqli_query($link, $q) or die ("error:" .mysqli_error($link) );


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
                        <th>Imparte</th>
                        <th>Estado</th>
                        <th>Coste</th>';

                    echo '</tr>
                </thead>
                <tbody>';

    $i = 0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        if ( $gestion != "" ) {
            $total += str_replace(",","", str_replace("*", "", $row[coste]) );
        }

        $color = colorSeguimientoEstado($row[estado]);

        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[incidencias].'">Leer más</a>';
        $readmore2 = '...<br><a id="obscuest" href="#" obs="'.$row[incidenciasfinamanda].'">Leer más</a>';

        echo '<tr style="font-size:11px" class="'.$color.'">';
        // echo '<td>'.$row[mat].'</td>';
        echo '<td>'. ++$i .'</td>';
        echo '<td>&nbsp'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        echo '<td>'.$row[iban].'</td>';
        echo '<td>'.$row[formapago].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[comercial].'</td>';
        echo '<td>'.$row[tipo_docente].'</td>';
        // echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo '<td>'.$row[estado].'</td>';
        echo '<td id="coste" style="width: 8%">';

        if ( $gestion != "" )
            echo $row[coste].' €';
        else
            echo number_format($row[coste],2,',','.');
        echo '</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidencias],0, 50);
        if ( $row[incidencias] != "" ) echo $readmore;
        echo '</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidenciasfinamanda],0, 50);
        if ( $row[incidenciasfinamanda] != "" ) echo $readmore2;
        echo '</td>';

        // echo '<td>'.$total.'</td>';
        echo '</tr>';


    }

    if ( $agente == 1 )
        $campos2 = ' AND '.$inagente;
    else if ( $comercial == 1 )
        $campos2 = ' AND '.$incomercial;


    $q = 'SELECT DISTINCT @mat:=s.id, s.numero, "", s.modalidad, "", s.formacion as denominacion, s.fechaini, s.fechafin, s.empresas, c.nombre as comercial, s.presupuesto as coste, s.estado_peticion, "", "", "","",""
        FROM peticiones_formativas s, comerciales c
        WHERE s.id_comercial = c.id
        AND estado_peticion = "Pendiente" AND s.tiposol = "SM"
        '.$campos2;
        echo $q;
    $q = mysqli_query($link, $q) or die ("error:" .mysqli_error($link) );

    while ( $row = mysqli_fetch_assoc($q) ) {


        // añado costes de solicitudes al total
        // if ( $gestion != "" ) {
        //     $total += str_replace(",","", str_replace("*", "", floatval( ($row[coste]) )));
        // }

        $color = colorSeguimientoEstado($row[estado]);

        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[incidencias].'">Leer más</a>';
        $readmore2 = '...<br><a id="obscuest" href="#" obs="'.$row[incidenciasfinamanda].'">Leer más</a>';

        echo '<tr style="font-size:11px" class="'.$color.'">';
        // echo '<td>'.$row[mat].'</td>';
        echo '<td>'. ++$i .'</td>';
        echo '<td>SM'.$row[numero].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[empresas].'</td>';
        echo '<td>'.$row[iban].'</td>';
        echo '<td>'.$row[formapago].'</td>';
        echo '<td></td>';
        echo '<td></td>';
        echo '<td>'.$row[comercial].'</td>';
        echo '<td>'.$row[agente].'</td>';
        // echo '<td>'.$row[nombre].' '.$row[apellido].'</td>';
        echo '<td>'.$row[estado_sol].'</td>';
        echo '<td id="coste" style="width: 8%">';

        if ( $gestion != "" )
            echo $row[coste].' €';
        else
            echo number_format($row[coste],2,',','.');
        echo '</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidencias],0, 50);
        if ( $row[incidencias] != "" ) echo $readmore;
        echo '</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidenciasfinamanda],0, 50);
        if ( $row[incidenciasfinamanda] != "" ) echo $readmore2;
        echo '</td>';

        // echo '<td>'.$total.'</td>';
        echo '</tr>';


    }


    echo '</tbody>';

    if ( $gestion != ""  )
        echo '<tr><td colspan="9"></td><td colspan="2" class="success">Total Costes: </td><td colspan="3" style="text-align:center; font-size: 16px" class="success"><strong>'.$total.' €</strong></td></tr>';

    echo '</table>'; echo $costetotal;

} else if ( $_POST['seg-facturacion'] == "1" || $_POST['seg-facturacion-comercial'] == "1" ) {

    //cgutierrez

    $baseurl = $_SERVER['DOCUMENT_ROOT'].'/gestion/app';

    unset($_POST['seg-facturacion']);
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

            if ($key == 'numeroaccion') {

                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];

                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            if ($key == 'denominacion') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

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

            if ( $key == 'mes_fin' ) {
                $in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'estado') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
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

            if ( $key == 'mes_fin' ) {
                $in = ' fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $mes_fin = ' p.fechaini >= "'.date('Y').'-'.$value.'-01'.'" AND p.fechaini <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $mes_fing = ' g.fecha >= "'.date('Y').'-'.$value.'-01'.'" AND g.fecha <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ( $key == 'trimestre' ) {
                $value = explode('-', $value);
                $in = ' fechafin >= "'.date('Y').'-'.$value[0].'-01'.'" AND fechafin <= "'.date('Y').'-'.$value[1].'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $trimestre = ' p.fechaini >= "'.date('Y').'-'.$value[0].'-01'.'" AND p.fechaini <= "'.date('Y').'-'.$value[1].'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $trimestreg = ' g.fecha >= "'.date('Y').'-'.$value[0].'-01'.'" AND g.fecha <= "'.date('Y').'-'.$value[1].'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
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

            if ($key == 'modalidad') {
                $in = ' '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            $campos .= $and.$fechas.$like.$in.$grupo;

        }

    }

    if ( $gestion != "" ) {

        $q = 'SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
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
        AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
        AND mc.mes_bonificable = 0
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, FORMAT(mc.costes_imparticion,2) as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
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
        AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
        AND mc.mes_bonificable <> 0
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, CONCAT(" ** ",FORMAT( (presupuesto/(SELECT count(*) FROM ptemp_mat_emp ma WHERE ma.id_matricula = @mat)  ),2)," ** ") as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, ptemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND modalidad IN("Presencial", "Mixta")
        AND m.estado IN("Comunicada","Creada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, CONCAT(" ** ",FORMAT( (presupuesto/(SELECT count(*) FROM otemp_mat_emp ma WHERE ma.id_matricula = @mat) ),2) ," ** ") as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, otemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND m.grupo = 1
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada","Creada")
        AND '.$campos.'
          UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, FORMAT(cr.precioventamat,2) as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
        FROM acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, costes_rentabilidad cr
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND cr.id_matricula = m.id
        AND ma.tipo = ""
        AND m.grupo = 0
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, FORMAT(cr.precioventamat,2) as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c,
        costes_rentabilidad cr
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND cr.id_matricula = m.id
        AND ma.tipo = "Privado"
        AND m.grupo = 0
        AND modalidad IN("Teleformación","A Distancia")
        AND m.estado IN("Comunicada")
        AND '.$campos.'
        UNION
        SELECT DISTINCT @mat:=m.id as mat, @emp:=e.id as emp, m.presupuesto, m.tipo_docente, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, c.id as id_comercial, 0 as coste, m.estado, e.agente, e.iban, e.formapago, m.incidencias, m.incidenciasfinamanda
        FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c
        WHERE m.id = ma.id_matricula
        AND e.comercial = c.id
        AND ma.id_alumno = a.id
        AND m.id_grupo = ga.id
        AND m.id_accion = ac.id
        AND ma.id_empresa = e.id
        AND m.estado IN("Gratuita")
        AND '.$campos.'
        ORDER BY numeroaccion, ngrupo';

    }

    if (isRoot()){
     //   echo $q;
    }

    $q = mysqli_query($link, $q) or die ("error:" .mysqli_error($link) );

    echo    '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Acción</th>
                        <th>Denominación</th>
                        <th>Modalidad</th>
                        <th>Empresa</th>
                        <th>Inicio</th>
                        <th>Fin</th>
                        <th>Comercial</th>
                        <th>Imparte</th>
                        <th>Estado</th>
                        <th>Presupuestado</th>
                        <th>Ingresos</th>
                        <th>Gastos</th>
                        <th>Diferencia</th>
                        <th>%Des.</th>
                        <th>Obs.</th>
                        <th>Obs. Fin</th>
                        <th></th>';

    echo            '</tr>
                </thead>
                <tbody>';

    $i = 0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        $ingresos = 0;
        $costes = 0;
        $diferencia = 0;
        $id_comercial = $row['id_comercial'];

        //SI EL ESTADO ES CREADA, COMUNICADA O FINALIZADA COGE LOS DATOS DE costes_rentabilidad
        //en caso contrario los coge de facturacion_matriculas_acre y de mat_items_gastos
        if ( ($row[estado] != 'Creada') && ($row[estado] != 'Comunicada') && ($row[estado] != 'Finalizada'))
        {
            $q2 = "SELECT format(sum(fma.importe),2) as importe_facturacion
                FROM facturacion_matriculas_acre fma
                WHERE fma.id_matricula = ".$row['mat'];

            $q2 = mysqli_query($link, $q2) or die ("error:" .mysqli_error($link) );

            while ( $row2 = mysqli_fetch_assoc($q2) ) {
                $ingresos += str_replace(",","", str_replace("*", "", $row2[importe_facturacion]) );
            }

            $q3 = "SELECT format(sum(mig.cantidad * ig.precio),2) as importe_items
                FROM mat_items_gastos AS mig,
                items_gastos AS ig
                WHERE ig.id = mig.id_item AND mig.id_mat = ".$row['mat'];

            $q3 = mysqli_query($link, $q3) or die ("error:" .mysqli_error($link) );

            while ( $row3 = mysqli_fetch_assoc($q3) ) {
                $costes += str_replace(",","", str_replace("*", "", $row[coste]) ) + $row3[importe_items];
            }
        } else {
            $q2 = "SELECT totalingresos, totalcostes
                FROM costes_rentabilidad
                WHERE id_matricula = ".$row['mat'];

            $q2 = mysqli_query($link, $q2) or die ("error:" .mysqli_error($link) );

            while ( $row2 = mysqli_fetch_assoc($q2) ) {
                $ingresos += str_replace(",","", str_replace("*", "", $row2[totalingresos]) );
                $costes += str_replace(",","", str_replace("*", "", $row2[totalcostes]) );
            }
        }

        $totalFinalIngresos = 0;
        $totalFinalGastos = 0;
        $totalImporteClientes = 0;
        $totalImporteAcreedores = 0;
        $totalCosteDocente = 0;
        $totalCosteAula = 0;
        $totalAdministracion = 0;
        $totalfungibles = 0;

        $qClientes = "SELECT
            e.razonsocial,
            total_factura as importe,
            fecha,
            estado,
            numero
            FROM facturacion_bonificada AS f
            LEFT JOIN empresas AS e ON f.empresa = e.id
            WHERE matricula = ".$row['mat']." AND e.id = ".$row[emp]."
            UNION
            SELECT
            e.razonsocial,
            total_factura as importe,
            fecha,
            estado,
            numero
            FROM facturacion_privada AS f
            LEFT JOIN empresas AS e ON f.empresa = e.id
            WHERE matricula = ".$row['mat']." AND e.id = ".$row[emp];

        if (isRoot()){
            // echo $qClientes;
        }

        $qClientes = mysqli_query($link, $qClientes) or die(" error Buscar Facturas Clientes:" .mysqli_error($link));

        while ($rowClientes = mysqli_fetch_array($qClientes)) {
            $totalImporteClientes += $rowClientes[importe];
        }
        $totalFinalIngresos += $totalImporteClientes;

        $qAcreedores = "SELECT acre.razonsocial,
            f.fecha,
            f.importe,
            f.porcentaje,
            acre.razonsocial,
            fa.numero
            FROM facturacion_matriculas_acre AS f
            INNER JOIN matriculas AS m ON f.id_matricula = m.id
            INNER JOIN acciones AS a ON m.id_accion = a.id
            INNER JOIN facturacion_acreedores AS fa ON f.id_factura = fa.id
            INNER JOIN acreedores AS acre ON fa.acreedor = acre.id
            WHERE m.id = ".$row['mat'];

        if (isRoot()){
            // echo $qAcreedores;
        }

        $qAcreedores = mysqli_query($link, $qAcreedores) or die(" error Buscar Facturas Matriculas:" .mysqli_error($link));

        while ($rowAcreedores = mysqli_fetch_array($qAcreedores)) {
            $totalImporteAcreedores += $rowAcreedores[importe];
        }

        $totalFinalGastos += $totalImporteAcreedores;

        $qRentabilidad = "SELECT
            cr.costeaula,
            cr.costedocente,
            cr.fungibledidac,
            cr.administracion,
            cr.otrosgastos,
            cr.precioventamat,
            cr.alumnosestimados,
            cr.totalingresos,
            cr.totalcostes,
            cr.margenbeneficio,
            cr.porcentajeventas,
            cr.ventasrequerido,
            cr.nalumnosnecesario
            FROM costes_rentabilidad AS cr
            WHERE cr.id_matricula = ".$row['mat'];

        if (isRoot()){
            // echo $qRentabilidad;
        }

        $qRentabilidad = mysqli_query($link, $qRentabilidad) or die("error Buscar Costes Rentabilidad:" .mysqli_error($link));

        while ($rowRentabilidad = mysqli_fetch_array($qRentabilidad)) {
            $totalCosteDocente += $rowRentabilidad[costedocente];
            $totalCosteAula += $rowRentabilidad[costeaula];
            $totalAdministracion += $rowRentabilidad[administracion];
        }

        if ( ( $row['estado'] != "Facturada" ) && ( $row['estado'] != "Liquidada" ) ){

            $totalFinalGastos += $totalCosteDocente;
            $totalFinalGastos += $totalCosteAula;

        }

        // se suma SIEMPRE y son 312
        $totalFinalGastos += $totalAdministracion;

        $qItemsFungibles = "SELECT mig.*, ig.item, round(mig.cantidad * ig.precio, 2) AS importe_item
            FROM mat_items_gastos AS mig INNER JOIN items_gastos AS ig ON mig.id_item = ig.id
            WHERE mig.id_mat = ".$row['mat'];

        if (isRoot()){
            // echo $qItemsFungibles;
        }

        $qItemsFungibles = mysqli_query($link, $qItemsFungibles) or die("error Buscar Items Fungible:" .mysqli_error($link));

        while ($rowItemsFungibles = mysqli_fetch_array($qItemsFungibles)) {
            $totalfungibles += $rowItemsFungibles[importe_item];
        }

        if (  ($row['estado'] != "Facturada" ) && ( $row['estado'] != "Liquidada" ) ) {
            $totalFinalGastos += $totalfungibles;
        }

        //$totalingresos += $ingresos;
        //$totalcostes += $costes;

        $globalpresupuesto += $row['presupuesto'];

        $totalingresos = $totalFinalIngresos;
        $globalingresos += $totalingresos;

        $totalcostes = $totalFinalGastos;
        $globalcostes += $totalcostes;

        $diferencia = $totalingresos - $totalcostes;
        $globaldiferencia = $globalingresos - $globalcostes;

        $porcentaje = (($diferencia * 100)/$totalingresos);

        $urlControFacturacionAcciones = 'index.php?form_control-facturacion-acciones-acre&id_matricula='.$row['mat'].'&id_empresa='.$row['emp'];

        //$botonDetalle = '<td><a target="_blank" href="'.$urlControFacturacionAcciones.'" id="detalle_SeguimientoFacturacion" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-list-alt"></span></a></td>';
        $botonDetalle = '<td><a id="detalleSeguimientoFacturacion" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-list-alt"></span></a></td>';

        $color = colorSeguimientoEstado($row[estado]);

        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[incidencias].'">Leer más</a>';
        $readmore2 = '...<br><a id="obscuest" href="#" obs="'.$row[incidenciasfinamanda].'">Leer más</a>';

        echo '<tr style="font-size:11px" class="'.$color.'">';
        echo '<td style="display:none" id="id_mat">';
        print($row[mat]);
        echo "</td>";
        echo '<td style="display:none" id="id_emp">';
        print($row[emp]);
        echo "</td>";
        echo '<td>'. ++$i .'</td>';
        echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td>'.$row[denominacion].'</td>';
        echo '<td>'.$row[modalidad].'</td>';
        echo '<td>'.$row[razonsocial].'</td>';
        //echo '<td>'.$row[iban].'</td>';
        //echo '<td>'.$row[formapago].'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
        echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
        echo '<td>'.$row[comercial].'</td>';
        echo '<td>'.$row[tipo_docente].'</td>';
        echo '<td>'.$row[estado].'</td>';
        echo '<td>'.$row[presupuesto].'</td>';
        echo '<td id="ingresos" style="width: 8%">'.$totalingresos.' €</td>';
        echo '<td id="coste" style="width: 8%">';
        echo $totalcostes.' €';
        echo '</td>';
        echo '<td id="diferencia" style="width: 8%">'.$diferencia.' €</td>';
        echo '<td id="porcentaje" style="width: 8%">'.number_format($porcentaje,2).'%</td>';
        //if ( $ingresos != "" ){

        //}
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidencias],0, 20);
        if ( $row[incidencias] != "" ) echo $readmore;
        echo '</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[incidenciasfinamanda],0, 20);
        if ( $row[incidenciasfinamanda] != "" ) echo $readmore2;
        echo '</td>';
        echo $botonDetalle;
        echo '</tr>';

    }
    echo '</tbody>';


    $globaldiferencia = $globalingresos - $globalcostes;

    if ( $gestion != ""  )
    {
        echo '<tr>';
        echo '<td colspan="9"></td>';
        echo '<td colspan="2" class="info">Total Presupuestado: </td><td colspan="3" style="text-align:right; font-size: 16px" class="info"><strong>'.$globalpresupuesto.' €</strong></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="9"></td>';
        echo '<td colspan="2" class="success">Total Ingresos: </td><td colspan="3" style="text-align:right; font-size: 16px" class="success"><strong>'.$globalingresos.' €</strong></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="9"></td>';
        echo '<td colspan="2" class="warning">Total Gastos: </td><td colspan="3" style="text-align:right; font-size: 16px" class="warning"><strong>'.$globalcostes.' €</strong></td>';
        echo '</tr>';
        echo '<tr>';
        echo '<td colspan="9"></td>';
        echo '<td colspan="2" class="active">Total Diferencia: </td><td colspan="3" style="text-align:right; font-size: 16px" class="active"><strong>'.$globaldiferencia.' €</strong></td>';
        echo '</tr>';
    }
    echo '</table>'; echo $costetotal;



    // CALCULO DE GASTOS / PETICIONES ACUMULADAS EN EL MES O TRIMESTRE
    // IMPUTACION DE COSTE SALARIAL

    if ( $_POST['seg-facturacion-comercial'] == "1" ) {


        if ( $id_comercial != "" ) {

            $qv = 'SELECT CONCAT(tiposol, numero), p.origen, p.horario, p.idavuelta, p.tipoviaje, p.fechaini, p.fechafin, p.importeviaje, observaciones
            FROM peticiones_gastos g
            INNER JOIN peticiones_viajes p ON p.id_peticion = g.id
            INNER JOIN usuarios u ON u.id = g.id_usuario
            INNER JOIN comerciales c ON c.id = u.id_comercial
            WHERE tiposol = "SV" AND estado <> "Anulada" AND '.$mes_fin.$trimestre.' AND c.id = "'.$id_comercial.'"';
            // echo $qv;
            $qv = mysqli_query($link, $qv) or die("error select : " .mysqli_error($link));

            if ( mysqli_num_rows($qv) > 0 ) {

                while ( $rowv = mysqli_fetch_assoc($qv) ) {

                    $viajes[] = $rowv;
                    $coste['viajes'] += $rowv['importeviaje'];

                }

                $headers = array('Nº', 'Origen - Destino', 'Horario', 'Ida/Vuelta', 'Transporte', 'Fecha Ida', 'Fecha Vuelta', 'Importe', 'Observaciones');
                $bloqueViajes = arrayTable($headers, $viajes, true);

            }
            if ( !isset($coste['viajes']) ) $coste['viajes'] = 0;

            $qa = 'SELECT CONCAT(tiposol, numero), p.origen, p.horario, p.idavuelta, p.tipoviaje, p.fechaini, p.fechafin, p.importeviaje, observaciones
            FROM peticiones_gastos g
            INNER JOIN peticiones_viajes p ON p.id_peticion = g.id
            INNER JOIN usuarios u ON u.id = g.id_usuario
            INNER JOIN comerciales c ON c.id = u.id_comercial
            WHERE tiposol = "SA" AND estado <> "Anulada" AND '.$mes_fin.$trimestre.' AND c.id = "'.$id_comercial.'"';
            // echo $qa;
            $qa = mysqli_query($link, $qa) or die("error select : " .mysqli_error($link));

            if ( mysqli_num_rows($qa) > 0 ) {

                while ( $rowa = mysqli_fetch_assoc($qa) ) {

                    $alojamiento[] = $rowa;
                    $coste['alojamiento'] += $rowa['importealojamiento'];

                }

                $headers = array('Nº', 'Lugar', 'Fecha Inicio', 'Fecha Fin', 'Nº Personas', 'Importe<br>Alojamiento', 'Observaciones');
                $bloqueAlojamiento = arrayTable($headers, $alojamiento, true);

            }
            if ( !isset($coste['alojamiento']) ) $coste['alojamiento'] = 0;

            $qg = 'SELECT CONCAT(tiposol, numero), observaciones, importedietas, importemateriales, importegasolina
            FROM peticiones_gastos g
            INNER JOIN usuarios u ON u.id = g.id_usuario
            INNER JOIN comerciales c ON c.id = u.id_comercial
            WHERE tiposol = "SN" AND estado <> "Anulada" AND '.$mes_fing.$trimestreg.' AND c.id = "'.$id_comercial.'"';
            // echo $qg;
            $qg = mysqli_query($link, $qg) or die("error select : " .mysqli_error($link));

            if ( mysqli_num_rows($qg) > 0 ) {

                while ( $rowg = mysqli_fetch_assoc($qg) ) {

                    $ngastos[] = $rowg;
                    $coste['gastos'] += $rowg['importedietas']+$rowg['importegasolina']+$rowg['importegasolina'];

                }

                $headers = array('Nº', 'Motivo/Observaciones', 'Importe<br>Dietas', 'Importe<br>Materiales', 'Importe<br>Gasolina');
                $bloqueNgastos = arrayTable($headers, $ngastos, true);
            }
            if ( !isset($coste['gastos']) ) $coste['gastos'] = 0;


        }

        $q = 'SELECT coste_salarial
        FROM nominas_usuarios n, usuarios u, comerciales c
        WHERE u.id = n.usuario
        AND u.id_comercial = c.id
        AND c.id = "'.$id_comercial.'"';
        $q = mysqli_query($link, $q) or die("error select : " .mysqli_error($link));

        $row = mysqli_fetch_assoc($q);
        $coste['salarial'] = $row['coste_salarial'];
        if ( isset($trimestre) || isset($trimestreg) ) {
            $coste['salarial'] = $coste['salarial']*3;
        }

        $coste['total'] = $coste['gastos'] + $coste['alojamiento'] + $coste['viajes'] + $coste['salarial'];

        $headers = array('Costes Viajes', 'Costes Alojamiento', 'Costes Otros Gastos', 'Coste Salarial', 'Total');
        $bloqueResumen = arrayTable($headers, $coste, true);

        echo '<div id="divgastos" class="col-md-12">';

        echo '<h3 style="margin-top: 40px">Resumen Gastos</h3>';
        echo $bloqueResumen;

        if ( $bloqueViajes ) echo '<h3 style="margin-top: 40px">Gastos Viajes</h3>';
        echo $bloqueViajes;

        if ( $bloqueAlojamiento ) echo '<h3 style="margin-top: 40px">Gastos Alojamiento</h3>';
        echo $bloqueAlojamiento;

        if ( $bloqueNgastos ) echo '<h3 style="margin-top: 40px">Otros Gastos</h3>';
        echo $bloqueNgastos;

        echo '</div>';


    }

}
?>