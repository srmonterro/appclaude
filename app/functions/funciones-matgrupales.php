<?

include_once './funciones.php';
// session_start();

if ( $_POST['devolvermatonline'] == 1 )
	devolverDatosMatriculaOnline($_POST[id], $link);
else if ( $_POST['verempresaso'] == 1 )
	mostrarEmpresasOnlineGrupo($_POST[id], $link);
else if ( $_POST['verdocenteso'] == 1 )
	mostrarDocentesOnlineGrupo($_POST[id], $link);
else if ( $_POST['guardauserpass_grupal'] == 1 )
    guardaUserGrupal($_POST['id_alu'], $_POST['id_mat'], $_POST['tipo'], $_POST['user'], $_POST['pass'], $link);
else if ( $_POST['guardauserbon_grupal'] == 1 )
    guardaUserBon($_POST['id_alu'], $_POST['id_mat'], $_POST['tipo'], $_POST['user'], $_POST['pass'], $_POST['finalizado'],$link);
else
	matricularGrupoOnline($_POST, $link);


function guardaUserGrupal($id_alu, $id_mat, $tipo, $user, $pass, $link) {

    if ( $tipo == 'bonificado' ) $tipo = "";
    else $tipo = "Privado";

    $q = 'UPDATE mat_alu_cta_emp SET user = "'.$user.'", pass = "'.$pass.'" WHERE id_alumno = '.$id_alu.' AND id_matricula = '.$id_mat.' AND tipo = "'.$tipo.'"';
    echo $q;
    $q = mysqli_query($link, $q) or die('error insertando' . mysqli_error($link));

}
function guardaUserBon($id_alu, $id_mat, $tipo, $user, $pass, $finalizado, $link) {

    if ( $tipo == 'bonificado' ) $tipo = "";
    else $tipo = "Privado";
    //$finalizado = 1;
    $q = 'UPDATE mat_alu_cta_emp SET finalizado = "'.$finalizado.'", pass = "'.$pass.'" WHERE id_alumno = '.$id_alu.' AND id_matricula = '.$id_mat.' AND tipo = "'.$tipo.'"';
    echo $q;
    $q = mysqli_query($link, $q) or die('error insertando' . mysqli_error($link));

}


function mostrarDocentesOnlineGrupo($id, $link) {

    $q = 'SELECT d.*, pm.perfil, pm.numhorasdoc
    FROM mat_doc pm, docentes d
    WHERE d.id = pm.id_docente
    AND pm.id_matricula = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q);

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Documento</th>
                    <th>Perfil</th>
                    <th>Nº Horas</th>
                    <th>Proveedor</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?


        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";

            if ( $row['tipodoc'] == "Persona" || $row['tipodoc'] == "" ) {

                echo '<td id="nombre">';
                echo($row[nombre]);
                echo "</td>";
                echo '<td id="apellido">';
                echo($row[apellido]);
                echo "</td>";
                echo '<td id="documento">';
                echo($row[documento]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo(devuelvePerfil($row[perfil]));
                echo "</td>";
                echo '<td id="numhorasdoc">';
                echo($row[numhorasdoc]);
                echo "</td>";

                echo '<td id="proveedor">';
                echo('-');
                echo "</td>";

            } else if ( $row['tipodoc'] == "Empresa" ) {

                echo '<td id="nombredocente">';
                echo($row[nombredocente]);
                echo "</td>";
                echo '<td id="apellidodocente">';
                echo($row[apellidodocente]);
                echo "</td>";
                echo '<td id="documento">';
                echo($row[documentodocente]);
                echo "</td>";
                echo '<td id="proveedor">';
                echo(devuelvePerfil($row[perfil]));
                echo "</td>";
                echo '<td id="numhorasdoc">';
                echo($row[numhorasdoc]);
                echo "</td>";

                echo '<td id="proveedor">';
                echo($row[nombre].' - '.$row[documento]);
                echo "</td>";

            }
            echo '<td><a id="matpborrardocentemat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}


function devuelvePerfil($id) {

    switch ($id) {

        case '1':
            return "Formador";
        break;

        case '3':
            return "Formador / Dinamizador";
        break;
    }

}

function mostrarEmpresasOnlineGrupo($id, $link) {

    $q = 'SELECT e.id, e.razonsocial, e.cif, e.representacionlegal
    FROM otemp_mat_emp pm, empresas e
    WHERE e.id = pm.id_empresa
    AND pm.id_matricula = '.$id;
    // echo $q;
    $q = mysqli_query($link, $q);

    ?>

    <div class="modal-body mostrartabla">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th style="display:none;">ID</th>
                    <th>Empresa</th>
                    <th>CIF</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        <?

        while ($row = mysqli_fetch_array($q)) {
            echo '<tr><td id="id" style="display:none;">';
            echo($row[id]);
            echo "</td>";
            echo "<td>";
            echo($row[razonsocial]);
            echo "</td>";
            echo "<td>";
            print($row[cif]);
            echo "</td>";
            echo "<td>";
            if ( $row[representacionlegal] == 1)
            print('<a target="_blank" href="http://gestion.eduka-te.com/app/documentacion/rltpremix.php?id_mat='.$id.'&tipo=G&id_emp='.$row[id].'">RLT</a>');
            echo "</td>";
            echo '<td><a id="matoborraralumnomat" name="matriculas" href="#" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a></td></tr>';
        } ?>
            </tbody>
        </table>
    </div>

    <?

}



function matricularGrupoOnline($valores, $link) {

	echo "<br>";
    print_r($valores['id_alumno']);
    print_r($valores['numerocuenta']);
    print_r($valores['id_docente']);
    print_r($valores['id_empresa']);
    print_r($valores['id_matricula']);
    print_r($valores['jornadalaboral']);
    echo "<br>";
    print_r($valores['ngrupo']);
    echo "<br>";

    $esGrupo = 1;
    $coma = ",";
    $q = 'SELECT numeroaccion FROM acciones
    WHERE id = ' . $valores['id_accion'];
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_array($q);
    $numeroaccion = $row['numeroaccion'];
    $grupo = $valores['ngrupo'];

    if ($valores['id_matricula'] == "") {// si hay id de matricula, es actualización
        // insertar grupos con su numero de accion
        // hay que traerse ngrupo del calculado en el form
        $q1 = 'INSERT IGNORE INTO grupos_acciones
        (id_accion, ngrupo)
        VALUES ("' . $valores['id_accion'] . '","' . $valores['ngrupo'] . '")';
        echo $q1 . "<br>";
        $q1 = mysqli_query($link,$q1);
        $id_grupo = mysqli_insert_id($link);
        echo "grupo insertado " . $id_grupo;
        $q = 'SELECT max(id) FROM matriculas';
        $q = mysqli_query($link,$q);
        $id = mysqli_fetch_row($q);
        $id = $id[0] + 1;


        // inserto el centro de formacion presencial

        // echo "tamano nombrecentro".sizeof($valores['nombrecentro']);
        $id_centro = 0;

        if (strlen($valores['nombrecentro']) > 0) {

            if ( $valores['id_centro'] != "" && $valores['centronuevo'] == "No" ) {

                $id_centro = $valores['id_centro'];

            } else {

                // $q = 'SELECT max(id)
                // FROM centros';
                // $q = mysqli_query($link, $q);

                // $row = mysqli_fetch_row($q);
                // $id_centro = $row[0] + 1;
                // echo $id_centro;
                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '",
                "' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1);
                $id_centro = mysqli_insert_id($link);

            }

        }



        // inserto  matricula - accion
        $q1 = 'INSERT IGNORE INTO matriculas
        (id, id_accion, fechaini, fechafin, id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, fechacreacion, presupuesto, comercial, observaciones, grupo, solicitud, id_solicitud, id_solicitudikea, tipo_docente, grupo_dino)
        VALUES ("' . $id . '","' . $valores['id_accion'] . '","' . $valores['fechaini'] . '","' . $valores['fechafin'] . '","' . $id_grupo . '",
        "' . $valores['estado'] . '","' . $valores['horariomini'] . '","' . $valores['horariomfin'] . '","' . $valores['horariotini'] . '",
        "' . $valores['horariotfin'] . '","' . $valores['diascheck'] . '","' . date("Y-m-d") . '","' . $valores['presupuesto'] . '","' . $valores['comercial'] . '","' . $valores['observaciones'] . '","' . $esGrupo . '", "'.$valores['solicitud'].'", "'.$valores['id_solicitud'].'", "'.$valores['id_solicitudikea'].'", "'.$valores['tipo_docente'].'", "'.$valores['grupo_dino'].'")';
        echo $q1 . "<br>";
        $q1 = mysqli_query($link,$q1);

        $coma = ",";

        $enviarlt = 0;
        if ( sizeof($valores['id_empresa']) > 0 ) {
            for ($i = 0; $i < sizeof($valores['id_empresa']); $i++) {

                // comprueba num cuenta
                compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

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
            $q1 = 'INSERT IGNORE INTO otemp_mat_emp
            (id_matricula, id_empresa)
            VALUES ' . $empresas;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);

        }

        $coma = ",";
        if ( sizeof($valores['id_docente']) > 0 ) {
            for ($i = 0; $i < sizeof($valores['id_docente']); $i++) {
                if ($i == sizeof($valores['id_docente']) - 1)
                    $coma = "";
                $docentes .= '("' . $id . '","' . $valores['id_docente'][$i] . '", "' . $valores['perfil'][$i] . '", "' . $valores['numhorasdoc'][$i] . '")' . $coma;
            }

            // inserto  matricula - docentes
            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, perfil, numhorasdoc)
             VALUES ' . $docentes;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
        }

        $coma = ",";

        if ( strlen($valores[precioventamat]) > 0 || strlen($valores[justificacion]) > 0 || strlen($valores[justificacion]) > 0 ) {
            $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`, `justificacion`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'","'.$valores[justificacion].'")';
            // echo $q1;
            $q1 = mysqli_query($link,$q1);
        }
        // if ( sizeof($valores['fechas']) > 0 ) {
        //     print_r($valores['fechas']);
        //     $fechas = explode(",", $valores['fechas']);
        //     for ($i=0; $i < sizeof($fechas); $i++) {
        //         if ($i == sizeof($fechas) - 1) $coma = "";
        //         $values .= '("'.$id.'","'.$fechas[$i].'")' . $coma;
        //     }
        //     $q = 'INSERT IGNORE INTO fechas_excluir
        //     (id_matricula, fecha)
        //     VALUES '.$values;
        //     echo $q;
        //     $q = mysqli_query($link, $q);
        // }


        if ( $valores['solicitud'] != "" && $valores['solicitud'] != "undefined" ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = $valores[id_solicitudikea];

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = $valores[id_solicitud];

            }

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update' .mysqli_error($link));

        }

        enviarMailNotif($numeroaccion,$grupo,'o-ini-grupo',$link, '', $_SESSION[user]);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'td-ini-tutor',$link);
            envioMailCalidad("", $valores[id_docente][0], $link);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'G');

        // if ( sizeof($valores['id_empresa']) > 0 )
        //     enviarRLTpremix($valores[id_empresa], $id, $link);

    } else {

        $id = $valores['id_matricula'];
        $fechaComunicada = '';
        $fechaFinalizada = '';
        if ($valores['estado'] == 'Comunicada')
            $fechaComunicada = date("Y-m-d");
        if ($valores['estado'] == 'Finalizada') {

            $fechaFinalizada = date("Y-m-d");
            $q = 'SELECT numeroaccion FROM acciones
            WHERE id = '.$valores['id_accion'];
            $q = mysqli_query($link,$q);
            $row = mysqli_fetch_array($q);
            $numeroaccion = $row['numeroaccion'];
            $grupo = $valores['ngrupo'];

            enviarMailNotif($numeroaccion, $grupo, 'aviso_diplomas', $link );

            // if ( strpos($grupo, "p")  )
            //     enviarMailNotif($numeroaccion, $grupo, 'td-finpgrupo', $link);
        }
        if ($valores['estado'] == 'Anulada')
            enviarMailNotif($numeroaccion,$grupo,'o-anu-grupo',$link);



        $qup = 'SELECT m.id_accion, fechaini, fechafin, m.tipo_docente, m.id_grupo, estado, horariomini, horariomfin, horariotini, horariotfin, diascheck, fechacreacion, presupuesto, comercial, observaciones, grupo, solicitud, id_solicitud, id_solicitudikea, r.*, a.numeroaccion, ga.ngrupo, a.denominacion
        FROM matriculas m, costes_rentabilidad r, acciones a, grupos_acciones ga
        WHERE m.id = '.$id.'
        AND r.id_matricula = m.id
        AND m.id_grupo = ga.id
        AND m.id_accion = a.id';
        echo $qup;
        $qup = mysqli_query($link, $qup) or die("error" . mysqli_error($link) );

        $row = mysqli_fetch_assoc($qup);

        // for ($z=0; $z < count($row); $z++) {
        unset($valores[matricula]);
        unset($valores[tiposolicitud]);
        unset($valores[id_coste]);
        // print_r($valores);
        // echo "<br>";
        // print_r($row);
        $dif = array_diff_assoc($valores, $row);
        echo "diferencias: ".print_r($dif);
        $t = "<pre>".print_r($dif, true)."</pre>";
        $t = str_replace('Array', '', $t);
        if ( count($dif) > 0 )  {
            enviarMailNotif($numeroaccion, $grupo, 'cambios-mat-grupal', $link, $t, $_SESSION[user]);
        }

        // }
        // echo "</pre>";


        if ( strlen($valores['nombrecentro']) > 0 ) {


            if ( $id_centro != "" && $centronuevo == "No" ) {

                $q1 = 'UPDATE centros SET
                nombrecentro = ' . '"' . $valores['nombrecentro'] . '"' . ', direccioncentro = ' . '"' . $valores['direccioncentro'] . '"' . ', codigopostal = ' . '"' . $valores['codigopostal'] . '"' .
                ', localidad = ' . '"' . $valores['poblacion'] . '"' . ', provincia = ' . '"' . $valores['provincia'] . '" WHERE id = ' . $id_centro;
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link, $q1);

            } else {

                // $q = 'SELECT max(id)
                // FROM centros';
                // $q = mysqli_query($link, $q);

                // $row = mysqli_fetch_row($q);
                // $id_centro = $row[0] + 1;
                // echo $id_centro;

                $q1 = 'INSERT IGNORE INTO `centros`( `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, `id_matricula`)
                VALUES ("' . $valores['nombrecentro'] . '","' . $valores['direccioncentro'] . '","' . $valores['codigopostal'] . '","' . $valores['poblacion'] . '","' . $valores['provincia'] . '","' . $id . '")';
                // echo $q1 . "<br>";
                $q1 = mysqli_query($link,$q1);
                $id_centro = mysqli_insert_id($link);

            }

        }


        $q1 = 'UPDATE matriculas SET
            fechaini = ' . '"' . $valores['fechaini'] . '"' . ', fechafin = ' . '"' . $valores['fechafin'] . '"' . ', estado = ' . '"' . $valores['estado'] . '"' .
            ', horariomini = ' . '"' . $valores['horariomini'] . '"' . ', horariomfin = ' . '"' . $valores['horariomfin'] . '"' . ', horariotini = ' . '"' .
            $valores['horariotini'] . '"' . ', horariotfin = ' . '"' . $valores['horariotfin'] . '"' . ', diascheck = ' . '"' . $valores['diascheck'] . '"' .
            ', fechacomunicacion = ' . '"' . $fechaComunicada . '"' . ', fechafinalizacion = ' . '"' . $fechaFinalizada . '"' . ', presupuesto = ' . '"' . $valores['presupuesto'] . '"' .
            ', comercial = ' . '"' . $valores['comercial'] . '"' . ', observaciones = ' . '"' . $valores['observaciones'] . '"'.', id_solicitud = '.'"'. $valores['id_solicitud'] .'"'.', id_solicitudikea = '.'"'. $valores['id_solicitudikea'] .'"'.', solicitud = '.'"'. $valores['solicitud'] .'"'.', tipo_docente = '.'"'. $valores['tipo_docente'] .'"'.', grupo_dino = '.'"'. $valores['grupo_dino'] .'"'.
            ' WHERE id = ' . $id;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link, $q1);


        $enviarlt = 0;
        $coma = ",";
        if ( sizeof($valores['id_empresa']) > 0 ) {

            // comprueba num cuenta
            // compruebaNumCuenta($valores['id_empresa'][$i], $numeroaccion, $grupo, $link);

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
            $q1 = 'INSERT IGNORE INTO otemp_mat_emp
            (id_matricula, id_empresa)
            VALUES ' . $empresas;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevaempgrupal',$link,'',$_SESSION[user]);

        }


        $coma = ",";
        if ( sizeof($valores['id_docente']) > 0 ) {

            for ($i = 0; $i < sizeof($valores['id_docente']); $i++) {
                if ($i == sizeof($valores['id_docente']) - 1)
                    $coma = "";
                $docentes .= '("' . $id . '","' . $valores['id_docente'][$i] . '", "' . $valores['perfil'][$i] . '", "' . $valores['numhorasdoc'][$i] . '")' . $coma;

            }

            $q1 = 'INSERT IGNORE INTO mat_doc
            (id_matricula, id_docente, perfil, numhorasdoc)
            VALUES ' . $docentes;
            echo $q1 . "<br>";
            $q1 = mysqli_query($link,$q1);
            enviarMailNotif($numeroaccion,$grupo,'p-act-nuevodocgrupal',$link, '', $_SESSION[user]);
        }

       // if ( strlen($valores[precioventamat]) > 0 || strlen($valores[justificacion]) > 0  ) {

         //   $q = 'SELECT id
           // FROM costes_rentabilidad
            //WHERE id_matricula = '.$id;
            //$q = mysqli_query($link, $q);
            // $row = mysqli_fetch_array($q);

            //if ( mysqli_num_rows($q) > 0 ) {

              //  $q1 = 'UPDATE `costes_rentabilidad` SET costeaula = "'.$valores[costeaula].'", fungibledidac = "'.$valores[fungibledidac].'", alumnosestimados = "'.$valores[alumnosestimados].'", precioventamat = "'.$valores[precioventamat].'", totalingresos = "'.$valores[totalingresos].'", totalcostes = "'.$valores[totalcostes].'", costedocente = "'.$valores[costedocente].'", administracion = "'.$valores[administracion].'", otrosgastos = "'.$valores[otrosgastos].'", margenbeneficio = "'.$valores[margenbeneficio].'", porcentajeventas = "'.$valores[porcentajeventas].'", justificacion = "'.$valores[justificacion].'" WHERE id_matricula = "'.$id.'"';
               // echo $q1;
                //$q1 = mysqli_query($link,$q1);

            //} else {

              //  $q1 = 'INSERT IGNORE INTO `costes_rentabilidad`(`costeaula`, `fungibledidac`, `alumnosestimados`, `precioventamat`, `totalingresos`, `totalcostes`, `costedocente`, `administracion`, `otrosgastos`, `margenbeneficio`, `porcentajeventas`, `id_matricula`, `justificacion`) VALUES ("'.$valores[costeaula].'","'.$valores[fungibledidac].'","'.$valores[alumnosestimados].'","'.$valores[precioventamat].'","'.$valores[totalingresos].'","'.$valores[totalcostes].'","'.$valores[costedocente].'","'.$valores[administracion].'","'.$valores[otrosgastos].'","'.$valores[margenbeneficio].'","'.$valores[porcentajeventas].'","'.$id.'","'.$valores[justificacion].'")';
               // echo $q1;
               // $q1 = mysqli_query($link,$q1);

           // }
       // }
        // $coma = ",";
        // if ( sizeof($valores['fechas']) > 0 ) {
        //     print_r($valores['fechas']);
        //     $fechas = explode(",", $valores['fechas']);
        //     for ($i=0; $i < sizeof($fechas); $i++) {
        //         if ($i == sizeof($fechas) - 1) $coma = "";
        //         $values .= '("'.$id.'","'.$fechas[$i].'")' . $coma;
        //     }
        //     $q = 'INSERT IGNORE INTO fechas_excluir
        //     (id_matricula, fecha)
        //     VALUES '.$values;
        //     echo $q;
        //     $q = mysqli_query($link, $q);
        // }


        if ( $valores['solicitud'] != "" && $valores['solicitud'] != undefined ) {

            if ( strpos($valores['solicitud'],'IK') !== FALSE ) {

                $tabla = 'ikea_solicitudes';
                $campot = 'estadosolikea';
                $valor = $valores[id_solicitudikea];

            } else {

                $tabla = 'peticiones_formativas';
                $campot = 'estado_peticion';
                $valor = $valores[id_solicitud];

            }

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Aceptada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update' .mysqli_error($link));

        }

        if ( $valores['estado'] == 'Anulada' ) {

            $tabla = 'peticiones_formativas';
            $campot = 'estado_peticion';
            $valor = $valores[id_solicitud];

            $q2 = 'UPDATE '.$tabla.' SET '. $campot. ' = "Anulada"
            WHERE id = "'. $valor .'"';
            // echo $q2;
            $q2 = mysqli_query($link, $q2) or die('error:update sol anulada' .mysqli_error($link));


        }



        enviarMailNotif($numeroaccion, $grupo, 'o-act-grupo',$link);

        if ($valores['estado'] == 'Comunicada') {
            enviarMailNotif($numeroaccion, $grupo, 'td-ini-tutor',$link);
            envioMailCalidad("", $valores[id_docente][0], $link);
        }

        if ($valores['estado'] == 'Gratuita') {
            enviarMailNotif($numeroaccion, $grupo, 'aviso_diplomas', $link );
            enviarMailNotif($numeroaccion, $grupo, 'mat-a-gratis', $link, 'Grupal', '', $_SESSION[user]);
        }

        if ( $enviarlt == 1 )
            enviarMailNotif($numeroaccion,$grupo,'p-rltiniciop',$link,'P');

    }

}



function devolverDatosMatriculaOnline($id,$link) {
    // datos de la accion - matricula: tabla: matriculas
    $q1 = 'SELECT ga.ngrupo, ga.id_accion, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.contenido, a.denominacion, a.horastotales, a.modalidad, m.*
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
    FROM otemp_mat_emp
    WHERE id_matricula = '.$id.'
    UNION ALL
    SELECT COUNT( id_docente )
    FROM mat_doc
    WHERE id_matricula = '.$id;
    $q1 = mysqli_query($link,$q1);
    while($r = mysqli_fetch_assoc($q1)) {
        $rows[] = $r;
    }

    $q1 = 'SELECT DISTINCT c.id as comercialempresa
    FROM comerciales c, otemp_mat_emp m, empresas e
    WHERE m.id_empresa = e.id
    AND e.comercial = c.id
    AND m.id_matricula = '.$id.'
    LIMIT 0,1';

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

    echo json_encode($rows);

}


?>
