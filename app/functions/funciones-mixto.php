<?

include_once './funciones.php';
session_start();

if ($_POST['devolvermatmix'] == '1')
    devolverDatosMatriculaMix($_POST['id'], $link);
else
    matricular_mixto($_POST, $link);


function devolverDatosMatriculaMix($id, $link) {

    // datos de la accion - matricula: tabla: matriculas
    $q1 = 'SELECT ga.ngrupo, ga.id_accion, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, a.horastotales, a.modalidad, m.estado,
    m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.comercial, m.observaciones, m.presupuesto, m.*
    FROM acciones a, matriculas m, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id = '.$id.'
    LIMIT 0,1';
    $q1 = mysqli_query($link,$q1);
    $rows = array();
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[0] = $r;
    }

    $q1 = 'SELECT COUNT( id_matricula ) as cuentas
    FROM ptemp_mat_emp
    WHERE id_matricula = '.$id.'
    UNION ALL
    SELECT COUNT( id_docente )
    FROM mat_doc
    WHERE id_matricula = '.$id.'
    AND mixto = "p"
    UNION ALL
    SELECT COUNT( id_docente )
    FROM mat_doc
    WHERE id_matricula = '.$id.'
    AND mixto = "od"';
    // echo $q1;
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }
    // echo $q1;

    $q1 = 'SELECT DISTINCT c.*
    FROM centros c, matriculas m
    WHERE c.id_matricula = m.id
    AND m.id = '.$id.'
    LIMIT 0,1';
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    $q1 = 'SELECT DISTINCT c.id as comercialempresa
    FROM comerciales c, ptemp_mat_emp m, empresas e
    WHERE m.id_empresa = e.id
    AND e.comercial = c.id
    AND m.id_matricula = '.$id;

    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    $q1 = 'SELECT DISTINCT c.*
    FROM costes_rentabilidad c, matriculas m
    WHERE m.id = c.id_matricula
    AND m.id = '.$id;

    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[rentabilidad] = $r;
    }

    // print_r($rows);
    echo json_encode($rows);

}

function matricular_mixto ($valores, $link) {


    // echo "<br>";
    // print_r($valores['id_alumno']);
    // print_r($valores['numerocuenta']);
    // print_r($valores['id_docente']);
    // print_r($valores['id_empresa']);
    // print_r($valores['id_matricula']);
    // print_r($valores['jornadalaboral']);
    // echo "<br>";
    // print_r($valores['ngrupo']);
    // echo "<br>";
    $coma = ",";

    $q = 'SELECT numeroaccion, horastotales FROM acciones
    WHERE id = '.$valores['id_accion'];
    $q = mysqli_query($link,$q);
    $row = mysqli_fetch_array($q);
    $numeroaccion = $row['numeroaccion'];
    $grupo = $valores['ngrupo'];
    $horastotales = $row['horastotales'];


    if ( $valores['id_matricula'] == "" ) { // si hay id de matricula, es actualización

        // insertar grupos con su numero de accion
        // hay que traerse ngrupo del calculado en el form
        // print_r($valores);
        $q1 = 'INSERT IGNORE INTO grupos_acciones
        (id_accion, ngrupo)
        VALUES ("'.$valores['id_accion'].'","'.$valores['ngrupo'].'")';
        // echo $q1."<br>";
        $q1 = mysqli_query($link,$q1) or die("error insert grupo" . mysqli_error($link));
        $id_grupo = mysqli_insert_id($link);
        // echo "grupo insertado ".$id_grupo;

        $q = 'SELECT max(id) FROM matriculas';
        $q = mysqli_query($link,$q);
        $id = mysqli_fetch_row($q);
        $id = $id[0] + 1;


         $id_centro = 0;

        if (strlen($valores['nombrecentro']) > 0) {

            if ( $valores['id_centro'] != "" ) {

                $id_centro = $valores['id_centro'];

            } else {

                $q = 'SELECT max(id)
                FROM centros';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_row($q);
                $id_centro = $row[0] + 1;
                // echo $id_centro;
                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '",
                "' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1) or die("error insert centro" . mysqli_error($link));

            }

        }

        // inserto  matricula - accion
        $q1 = 'INSERT IGNORE INTO matriculas
        (id, id_accion, fechaini, fechafin, id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, diascheckod, fechacreacion, presupuesto, comercial, observaciones, horariomini_nop, horariomfin_nop, horariotini_nop, horariotfin_nop, fechaini_nop, fechafin_nop, observacionesmatod, solicitud, id_solicitudikea, id_solicitud, tipo_docente, centro, incidencias, grupo_dino )
        VALUES ("' . $id . '","' . $valores['id_accion'] . '","' . $valores['fechaini'] . '","' . $valores['fechafin'] . '","' . $id_grupo . '", "' . $valores['estado'] . '","' . $valores['horariomini'] . '","' . $valores['horariomfin'] . '","' . $valores['horariotini'] . '", "' . $valores['horariotfin'] . '","' . $valores['diascheck'] . '","' . $valores['diascheckod'] . '","' . date("Y-m-d") . '","' . $valores['presupuesto'] . '","' . $valores['comercial'] . '","' . $valores['observacionesmat'] . '","' . $valores['horariomini_nop'] . '","' . $valores['horariomfin_nop'] . '","' . $valores['horariotini_nop'] . '","' . $valores['horariotfin_nop'] . '","' . $valores['fechaini_nop'] . '","' . $valores['fechafin_nop'] . '","' . $valores['observacionesmatod'] . '","' . $valores['solicitud'] . '","' . $valores['id_solicitudikea'] . '","' . $valores['id_solicitud'] . '","' . $valores['tipo_docente'] . '", "' . $valores['id_centro'] . '", "' . $valores['incidencias'] . '", "'.$valores['grupo_dino'].'")';
        // echo $q1 . "<br>";
        $q1 = mysqli_query($link,$q1) or die("error insert mat" . mysqli_error($link));


        $enviarlt = 0;
        $coma = ",";
        if ( sizeof($valores['id_empresa']) > 0 ) {

            for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {

                // comprueba num cuenta
                // compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

                if ( strpos($grupo, "p") === FALSE ) {

                    $qrlt = 'SELECT razonsocial FROM empresas
                    WHERE id = "'.$valores[id_empresa][$i].'"
                    AND representacionlegal = 1';
                    // echo $qrlt;
                    $qrlt = mysqli_query($link, $qrlt) or die("error rlt");

                    if ( mysqli_num_rows($qrlt) > 0 ) $enviarlt = 1;

                }

                if ($i == sizeof($valores['id_empresa']) - 1)
                    $coma = "";
                $empresas .= ' ("' . $id . '","' . $valores['id_empresa'][$i] . '")' . $coma;
            }

            // EN TABLA TEMPORAL! NO NUMCUENTA, NO ALUMNO, NO JORNADAS
            // inserto  matricula - empresas
            $q1 = 'INSERT IGNORE INTO ptemp_mat_emp
            (id_matricula, id_empresa)
             VALUES ' . $empresas;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);

        }


        if ( $valores['solicitud'] != "" && $valores['solicitud'] != undefined ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = substr($valores[solicitud], 2,4);

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = substr($valores[solicitud], 1,4);

            }

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE numero = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update' .mysqli_error($link));

        }

        $coma = ",";
        if ( sizeof($valores['id_docentempre']) > 0 ) {

            // DOCENTES PARA PRESENCIAL
            for ($i=0; $i < sizeof($valores['id_docentempre']); $i++) {
            if( $i == sizeof($valores['id_docentempre'])-1 )
                $coma = "";
            $docentespre .= ' ("'.$id.'","'.$valores['id_docentempre'][$i].'","p")'.$coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, mixto)
             VALUES '.$docentespre;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1) or die("error insert doc pre" . mysqli_error($link));

        }

        $coma = ",";
        if ( sizeof($valores['id_docenteod']) > 0 ) {

            // DOCENTES PARA ONLINE / DISTANCIA
            for ($i=0; $i < sizeof($valores['id_docenteod']); $i++) {
            if( $i == sizeof($valores['id_docenteod'])-1 )
                $coma = "";
            $docentesod .= ' ("'.$id.'","'.$valores['id_docenteod'][$i].'","od")'.$coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, mixto)
             VALUES '.$docentesod;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1) or die("error insert docod" . mysqli_error($link));

        }

        $coma = ",";
        if ( sizeof($valores['fechas']) > 0 ) {
            // print_r($valores['fechas']);
            $fechas = explode(",", $valores['fechas']);
            for ($i=0; $i < sizeof($fechas); $i++) {
                if ($i == sizeof($fechas) - 1) $coma = "";
                $values .= '("'.$id.'","'.$fechas[$i].'")' . $coma;
            }
            $q = 'INSERT IGNORE INTO fechas_excluir
            (id_matricula, fecha)
            VALUES '.$values;
            // echo $q;
            $q = mysqli_query($link, $q);
        }

        if ( strlen($valores[precioventamat]) > 0 ) {
            $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'")';
            // echo $q1;
            $q1 = mysqli_query($link,$q1) or die("error insert renta" . mysqli_error($link));
        }

        echo $id;

        enviarMailNotif($numeroaccion, $grupo, 'm-ini', $link, '', $_SESSION[user]);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id);
            envioMailCalidad("", $valores[id_docenteod][0], $link);
            envioMailCalidad("", $valores[id_docentempre][0], $link);
        }



    } else {

        $id = $valores['id_matricula'];

        $fechaComunicada = '';
        $fechaFinalizada = '';

        if ($valores['estado'] == 'Comunicada') {
            $fechaComunicada = date("Y-m-d");
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id,$_SESSION[user]);
        }

        if ($valores['estado'] == 'Finalizada')
            $fechaFinalizada = date("Y-m-d");

        if ($valores['estado'] == 'Anulada') {
            enviarMailNotif($numeroaccion,$grupo,'pm-anu',$link,'',$_SESSION[user]);
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta-anu',$link,$id);
        }

        if ( strlen($valores['nombrecentro']) > 0 ) {


            if ( $valores['id_centro'] != "" ) {

                $id_centro = $valores['id_centro'];

                $q1 = 'UPDATE centros SET
                nombrecentro = ' . '"' . $valores['nombrecentro'] . '"' . ', direccioncentro = ' . '"' . $valores['direccioncentro'] . '"' . ', codigopostal = ' . '"' . $valores['codigopostal'] . '"' .
                ', localidad = ' . '"' . $valores['poblacion'] . '"' . ', provincia = ' . '"' . $valores['provincia'] . '" WHERE id = ' . $id_centro;
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link, $q1);

            } else {

                $q = 'SELECT max(id)
                FROM centros';
                $q = mysqli_query($link, $q);

                $row = mysqli_fetch_row($q);
                $id_centro = $row[0] + 1;
                // echo $id_centro;

                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '",
                "' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1);

            }

        }

        $q1 = 'UPDATE matriculas SET
            fechaini = ' . '"' . $valores['fechaini'] . '"' . ', fechafin = ' . '"' . $valores['fechafin'] . '"' . ', estado = ' . '"' . $valores['estado'] . '"' .
            ', horariomini = ' . '"' . $valores['horariomini'] . '"' . ', horariomfin = ' . '"' . $valores['horariomfin'] . '"' . ', horariotini = ' . '"' .
            $valores['horariotini'] . '"' . ', horariotfin = ' . '"' . $valores['horariotfin'] . '"' . ', diascheck = ' . '"' . $valores['diascheck'] . '"' .
            ', diascheckod = ' . '"' . $valores['diascheckod'] . '"'.', fechacomunicacion = ' . '"' . $fechaComunicada . '"' . ', fechafinalizacion = ' . '"' . $fechaFinalizada . '"' . ', presupuesto = ' . '"' . $valores['presupuesto'] . '"' .', observaciones = ' . '"' . $valores['observacionesmat'] . '"' .', comercial = ' . '"' . $valores['comercial'] . '"' . ', centro = ' . '"' . $id_centro . '"' . ', horariomini_nop = ' . '"' . $valores['horariomini_nop'] . '"' . ', horariomfin_nop = ' . '"' . $valores['horariomfin_nop'] . '"' . ', horariotini_nop = ' . '"' . $valores['horariotini_nop'] . '"' . ', horariotfin_nop = ' . '"' . $valores['horariotfin_nop'] . '"' . ',fechaini_nop = ' . '"' . $valores['fechaini_nop'] . '"' . ', fechafin_nop = ' . '"' . $valores['fechafin_nop'] . '"'.', observacionesmatod = ' . '"' . $valores['observacionesmatod'] . '"'.', solicitud = ' . '"' . $valores['solicitud'] . '"' . ', id_solicitudikea = ' . '"' . $valores['id_solicitudikea'] . '"' . ', id_solicitud = ' . '"' . $valores['id_solicitud'] . '"'.', tipo_docente = ' . '"' . $valores['tipo_docente'] . '"'.', centro = ' . '"' . $valores['id_centro'] . '"'.', incidencias = "'.$valores[incidencias].'"'.', grupo_dino = "'. $valores['grupo_dino'] .'" WHERE id = ' . $id;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link, $q1) or die("error" . mysqli_error($link));


        $enviarlt = 0;
        $coma = ",";
        if ( sizeof($valores['id_empresa']) > 0 ) {

            for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {

            if ( strpos($grupo, "p") === FALSE ) {

                $qrlt = 'SELECT razonsocial FROM empresas
                WHERE id = "'.$valores[id_empresa][$i].'"
                AND representacionlegal = 1';
                // echo $qrlt;
                $qrlt = mysqli_query($link, $qrlt) or die("error rlt");

                if ( mysqli_num_rows($qrlt) > 0 ) $enviarlt = 1;

            }


                    if ($i == sizeof($valores['id_empresa']) - 1)
                        $coma = "";
                    $empresas .= ' ("' . $id . '","' . $valores['id_empresa'][$i] . '")' . $coma;
            }


            // EN TABLA TEMPORAL! NO NUMCUENTA, NO ALUMNO, NO JORNADAS
            // inserto  matricula - empresas
            $q1 = 'INSERT IGNORE INTO ptemp_mat_emp
            (id_matricula, id_empresa)
            VALUES ' . $empresas;
            // echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevaemp', $link,'',$_SESSION[user]);

        }

        $coma = ",";
        if ( sizeof($valores['id_docentempre']) > 0 ) {

            // DOCENTES PARA PRESENCIAL
            for ($i=0; $i < sizeof($valores['id_docentempre']); $i++) {
            if( $i == sizeof($valores['id_docentempre'])-1 )
                $coma = "";
            $docentespre .= ' ("'.$id.'","'.$valores['id_docentempre'][$i].'","'.'p'.'")'.$coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, mixto)
             VALUES '.$docentespre;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);

        }

        $coma = ",";
        if ( sizeof($valores['id_docenteod']) > 0 ) {

            // DOCENTES PARA ONLINE / DISTANCIA
            for ($i=0; $i < sizeof($valores['id_docenteod']); $i++) {
            if( $i == sizeof($valores['id_docenteod'])-1 )
                $coma = "";
            $docentesod .= ' ("'.$id.'","'.$valores['id_docenteod'][$i].'","'.'od'.'")'.$coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, mixto)
             VALUES '.$docentesod;
             // echo $q1."<br>";
            $q1 = mysqli_query($link,$q1);

        }

        $coma = ",";
        if ( sizeof($valores['fechas']) > 0 ) {
            // print_r($valores['fechas']);
            $fechas = explode(",", $valores['fechas']);
            for ($i=0; $i < sizeof($fechas); $i++) {
                if ($i == sizeof($fechas) - 1) $coma = "";
                $values .= '("'.$id.'","'.$fechas[$i].'", "p")' . $coma;
            }
            $q = 'INSERT IGNORE INTO fechas_excluir
            (id_matricula, fecha, tipo)
            VALUES '.$values;
            // echo $q;
            $q = mysqli_query($link, $q);
        }


        $coma = ",";
        if ( sizeof($valores['fechasod']) > 0 ) {
            // print_r($valores['fechasod']);
            $fechasod = explode(",", $valores['fechasod']);
            for ($i=0; $i < sizeof($fechasod); $i++) {
                if ($i == sizeof($fechasod) - 1) $coma = "";
                $values .= '("'.$id.'","'.$fechasod[$i].'", "od")' . $coma;
            }
            $q = 'INSERT IGNORE INTO fechas_excluir
            (id_matricula, fecha, tipo)
            VALUES '.$values;
            // echo $q;
            $q = mysqli_query($link, $q);
        }

        if ( strlen($valores[precioventamat]) > 0 ) {

            $q = 'SELECT id
            FROM costes_rentabilidad
            WHERE id_matricula = '.$id;
            $q = mysqli_query($link, $q);
            // $row = mysqli_fetch_array($q);

            if ( mysqli_num_rows($q) > 0 ) {

                $q1 = 'UPDATE `costes_rentabilidad` SET costeaula = "'.$valores[costeaula].'", fungibledidac = "'.$valores[fungibledidac].'", alumnosestimados = "'.$valores[alumnosestimados].'", precioventamat = "'.$valores[precioventamat].'", totalingresos = "'.$valores[totalingresos].'", totalcostes = "'.$valores[totalcostes].'", costedocente = "'.$valores[costedocente].'", administracion = "'.$valores[administracion].'", otrosgastos = "'.$valores[otrosgastos].'", margenbeneficio = "'.$valores[margenbeneficio].'", porcentajeventas = "'.$valores[porcentajeventas].'" WHERE id_matricula = "'.$id.'"';
                // echo $q1;
                $q1 = mysqli_query($link,$q1);

            } else {

                $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'")';
                // echo $q1;
                $q1 = mysqli_query($link,$q1);

            }
        }

        enviarMailNotif($numeroaccion, $grupo, 'm-act', $link);

        if ($valores['estado'] == 'Gratuita') {
            enviarMailNotif($numeroaccion, $grupo, 'pm-alta',$link,$id);
            enviarMailNotif($numeroaccion, $grupo, 'aviso_diplomas', $link );
            enviarMailNotif($numeroaccion, $grupo, 'mat-a-gratis', $link, 'Mixta', '', $_SESSION[user]);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'P');

        echo $id;


    }

}


?>