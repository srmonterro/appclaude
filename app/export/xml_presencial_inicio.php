<?

include_once ('../functions/funciones.php');

if ($_GET['id_matricula'])
    $id_mat = $_GET['id_matricula'];



    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, a.tipoformacionac, ga.ngrupo, m.fechaini, m.fechafin, m.diascheck, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.aulavirtual
    FROM matriculas m, acciones a, grupos_acciones ga
    WHERE m.id_accion = a.id
    AND m.id_grupo = ga.id
    AND m.id ='.$id_mat;
    $sql = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($sql)) {
        $naccion = $row[numeroaccion];
        $ngrupo = $row[ngrupo];
        $denominacion = $row[denominacion];
        $horastotales = $row[horastotales];
        $tipoaccion = $row[tipoformacionac];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $diascheck = $row[diascheck];
        $aulavirtual = $row[aulavirtual];
    }

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename='.$naccion.'.'.$ngrupo.'.xml');

    $esIslas = false;

    $sql = 'SELECT m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.horasteleformacion, m.tipo_docente, d.*, m.diascheck, d.id as id_docente
    FROM matriculas m, mat_doc md, docentes d
    WHERE m.id ='.$id_mat.'
    AND md.id_matricula = m.id
    AND md.id_docente = d.id';
    $sql = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($sql)) {
        $tipo_docente = $row[tipo_docente];
        $documento = $row[documento];
        // echo count($row[apellido]);

        if ( $documento == "B76571140" ) // ISLAS PREVENCION
            $esIslas = true;

        if ( $row[nombre] == $row[apellido] || strlen($row[apellido]) <= 2 )
            $docente = $row[nombre];
        else
            $docente = $row[nombre].' '.$row[apellido].' '.$row[apellido2];
            $direcciondoc = $row[direccion];
            $codpostdoc = $row[codigopostal];
            $localidaddoc = $row[poblacion];
    }

    $sql = 'SELECT `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, m.observaciones, m.tipo_docente, m.diascheck
    FROM matriculas m, centros c
    WHERE m.centro = c.id
    AND m.id = '.$id_mat;
    $sql = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($sql)) {
        $cifcentro = $row[cifcentro];
        $nombrecentro = $row[nombrecentro];
        $direccioncentro = $row[direccioncentro];
        $codpostal = $row[codigopostal];
        $localidad = $row[localidad];
        $observaciones = $row[observaciones];
        // $tipo_docente = $row[tipo_docente];
    }


$text .= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <grupos>
    <grupo>
        <idAccion>'. $naccion .'</idAccion>
        <idGrupo>'. $ngrupo .'</idGrupo>
        <descripcion>'. $denominacion .'</descripcion>
        <NumeroParticipante>30</NumeroParticipante>
        <fechaInicio>'. date("d/m/Y", strtotime($fechaini)) .'</fechaInicio>
        <fechaFin>'. date("d/m/Y", strtotime($fechafin)) .'</fechaFin>';

        if ( $naccion >= 5000 && $naccion < 6000 ) {
            $responsable = 'CARMEN MARRERO DELGADO';
            $responsabletlf = '971910576';
        } else if ( $naccion >= 6000 && $naccion < 7000 ) {
            $responsable = '';
            $responsabletlf = '';
        } else if ( $naccion >= 7000 && $naccion < 8000 ) {
            $responsable = '';
            $responsabletlf = '';
        } else {
            $responsable = 'Shirley González';
            $responsabletlf = '687150766';
        }

        $text .= '
        <responsable>'.$responsable.'</responsable>
        <telefonoContacto>'.$responsabletlf.'</telefonoContacto>
        <jornadaPresencial>';
            if ($tipoaccion == "Valora") { 
                if ( $tipo_docente == "EDUKATE" || $tipo_docente === NULL ) {

                $text .= '
                <centro>
                    <tipoDocumentoCentro>90</tipoDocumentoCentro>
                    <documentoCentro>B76757764</documentoCentro>
                    <nombreCentro>EDUKA-TE SOLUTIONS, SL</nombreCentro>
                    <direccionDetallada>C/ Londres 11</direccionDetallada>
                    <codPostal>38660</codPostal>
                    <localidad>COSTA ADEJE</localidad>
                </centro>
                <lugarImparticion>
                    <nombreCentro>'. $nombrecentro .'</nombreCentro>
                    <direccionDetallada>'. $direccioncentro .'</direccionDetallada>
                    <codPostal>'. $codpostal .'</codPostal>
                    <localidad>'. $localidad .'</localidad>
                </lugarImparticion>
                <horario>
                    <horaTotales>'. $horastotales .'</horaTotales>';
    
                } else {
    
                $text .= '
                <centro>
                     <tipoDocumentoCentro>90</tipoDocumentoCentro>
                    <cdocumentoCentro>'.$documento.'</documentoCentro>
                    <nombreCentro>'.$docente.'</nombreCentro>
                    <direccionDetallada>'. $direcciondoc .'</direccionDetallada>
                    <codPostal>'. $codpostdoc .'</codPostal>
                    <localidad>'. $localidaddoc .'</localidad>
                </centro>
                <lugarImparticion>
                    <nombreCentro>'. $nombrecentro .'</nombreCentro>
                    <direccionDetallada>'. $direccioncentro .'</direccionDetallada>
                    <codPostal>'. $codpostal .'</codPostal>
                    <localidad>'. $localidad .'</localidad>
                </lugarImparticion>
                <horario>
                    <horaTotales>'. $horastotales .'</horaTotales>';
    
                }} else {
                
            if ( $tipo_docente == "EDUKATE" || $tipo_docente === NULL ) {

            $text .= '
            <centro>
                <cif>B76757764</cif>
                <nombreCentro>EDUKA-TE SOLUTIONS, SL</nombreCentro>
                <direccionDetallada>C/ Londres 11</direccionDetallada>
                <codPostal>38660</codPostal>
                <localidad>COSTA ADEJE</localidad>
            </centro>
            <lugarImparticion>
                <nombreCentro>'. $nombrecentro .'</nombreCentro>
                <direccionDetallada>'. $direccioncentro .'</direccionDetallada>
                <codPostal>'. $codpostal .'</codPostal>
                <localidad>'. $localidad .'</localidad>
            </lugarImparticion>
            <horario>
                <horaTotales>'. $horastotales .'</horaTotales>';

            } else {

            $text .= '
            <centro>
                <cif>'.$documento.'</cif>
                <nombreCentro>'.$docente.'</nombreCentro>
                <direccionDetallada>'. $direcciondoc .'</direccionDetallada>
                <codPostal>'. $codpostdoc .'</codPostal>
                <localidad>'. $localidaddoc .'</localidad>
            </centro>
            <lugarImparticion>
                <nombreCentro>'. $nombrecentro .'</nombreCentro>
                <direccionDetallada>'. $direccioncentro .'</direccionDetallada>
                <codPostal>'. $codpostal .'</codPostal>
                <localidad>'. $localidad .'</localidad>
            </lugarImparticion>
            <horario>
                <horaTotales>'. $horastotales .'</horaTotales>';

            }
        }

        if ($horariomini != '') {
        $text .= '
                <horaInicioTramo1>'. $horariomini .'</horaInicioTramo1>
                <horaFinTramo1>'. $horariomfin .'</horaFinTramo1>';
        }

        if ($horariotini != '') {
        $text .= '
                <horaInicioTramo2>'. $horariotini .'</horaInicioTramo2>
                <horaFinTramo2>'. $horariotfin .'</horaFinTramo2>';
        }

        $text .= '
                <dias>'. $diascheck .'</dias>
            </horario>';

        $fechaInicioCalendario = strtotime($fechaini);
        $fechaFinCalendario = strtotime($fechafin);
        //$arrayDiasSemana = str_split($diascheck);

        $dias = array('','L','M','X','J','V','S','D');

        // Obtener las fechas a excluir para esta matrícula específica
        $fechas_excluir = array();
        $sql_excluir = "SELECT fecha FROM fechas_excluir WHERE id_matricula = ".$id_mat;
        $result_excluir = mysqli_query($link, $sql_excluir);
        while ($row_excluir = mysqli_fetch_array($result_excluir)) {
            $fechas_excluir[] = date("Y-m-d", strtotime($row_excluir['fecha']));
        }

        $i=$fechaInicioCalendario;

        while($i <= $fechaFinCalendario){
            $diasemana = date('N', $i);
            $dia = $dias[$diasemana];
            $fecha_actual = date("Y-m-d", $i);
            
            // Comprueba si la fecha actual está en el array de fechas a excluir
            $excluir_fecha = in_array($fecha_actual, $fechas_excluir);
            
            // Solo genera el calendario si el día está en diascheck Y la fecha no está en la lista de exclusiones
            if(strstr($diascheck, $dia) && !$excluir_fecha)
            {
                $text .= '
                    <calendario>                    
                        <fecha_imparticion>'. date("d/m/Y", $i) .'</fecha_imparticion>';
        
                if ($horariomini != '') {
                    $text .= '
                        <horario_inicio_tramo1>'. $horariomini .'</horario_inicio_tramo1>
                        <horario_fin_tramo1>'. $horariomfin .'</horario_fin_tramo1>';
                }
        
                if ($horariotini != '') {
                    $text .= '
                        <horario_inicio_tramo2>'. $horariotini .'</horario_inicio_tramo2>
                        <horario_fin_tramo2>'. $horariotfin .'</horario_fin_tramo2>';
                }
                
                $text .='
                    </calendario>';
            }
            
            $i+=86400; // Avanza un día (86400 segundos)

        }

        /*$text.='
            </horario>';*/

        $sql = 'SELECT d.*, m.*, d.id as id_docente
        FROM docentes d, mat_doc m
        WHERE m.id_docente = d.id
        AND m.id_matricula = '.$id_mat;
        // echo $sql;
        $sql = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_array($sql)) {

            if ( $row['tipodoc'] == "Empresa" ) {
                $row[documento] = $row[documentodocente];
                $row[nombre] = $row[nombredocente];
                $row[apellido] = $row[apellidodocente];
                $row[apellido2] = $row[apellido2docente];
                // if ( $row[numhorasdoc] != "" && $row[numhorasdoc] != 0 )
                //     $horastotales = $row[numhorasdoc];
            }

            $text .= '
            <Tutor>
                <numeroHoras>'. $row[numhorasdoc] .'</numeroHoras>
                <tipoDocumento>10</tipoDocumento>
                <documento>'. $row[documento] .'</documento>
                <nombre>'. $row[nombre] .'</nombre>
                <apellido1>'. $row[apellido] .'</apellido1>
                <apellido2>'. $row[apellido2] .'</apellido2>';

                if ( $row[id_docente] == '3' ) { // anja
                    $text.='
                <telefono>658141168</telefono>
                <correoElectronico>alena.tutor@eduka-te.com</correoElectronico>';
                } else if ($row[id_docente] == '17') { // pablo
                    $text.='
                <telefono>922100008</telefono>
                <correoElectronico>prodriguez@eduka-te.com</correoElectronico>';
                } else if ($row[id_docente] == '156') { // carlos
                    $text.='
                <telefono>922100008</telefono>
                <correoElectronico>cgutierrez@eduka-te.com</correoElectronico>';
                } else if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {
                    $text.='
                <telefono>'.$row[telefono].'</telefono>
                <correoElectronico>'.$row[email].'</correoElectronico>';
                } else if ( $esIslas ) {
                    $text.='
                <telefono>922084784</telefono>
                <correoElectronico>formacion.tpc@islasprevencion.com</correoElectronico>';
                } else {
                    $text.='
                <telefono>'.$row[telefono].'</telefono>
                <correoElectronico>'.$row[email].'</correoElectronico>';
                }

    $text.='
            </Tutor>';
    }
    $text .= '
        </jornadaPresencial>
        ';
        if ($aulavirtual == '1') {
            $text .= '
                    <aulaVirtual>
                        <medio>Aula virtual integrado en Moodle</medio>
                        <conexion>https://www.trainingeduka-te.com/, usuario: supervisoraulav25, contraseña: Edk.superv25*</conexion>
                        <contacto>Shirley González</contacto>
                        <telefono>687150766</telefono>
                        <bimodal>false</bimodal>
                        <sinParticipantesEnCentro>true</sinParticipantesEnCentro>
                        <sinDocentesEnCentro>true</sinDocentesEnCentro>
                    </aulaVirtual>';
            };
        //if ( $naccion < 5000 ) {

            $sql = 'SELECT DISTINCT e.cif
            FROM empresas e, ptemp_mat_emp m
            WHERE m.id_empresa = e.id
            AND m.id_matricula = '.$id_mat;
            $sql = mysqli_query($link, $sql);

            $text .= '<EmpresasParticipantes>';
            while ($row = mysqli_fetch_array($sql)) {

            $text .= '
            <empresa>
                <cifEmpresaParticipante>'. $row[cif] .'</cifEmpresaParticipante>
            </empresa>';
            }

        $text .= '
        </EmpresasParticipantes>';

        //}

        $text .='
        <observaciones>'. $observaciones .'</observaciones>
        </grupo>
    </grupos>';

// $text = preg_replace('/\t/', '', $text);

echo $text;
?>