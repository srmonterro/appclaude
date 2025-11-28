<?

include_once ('../functions/funciones.php');

if ($_GET['id_matricula'])
    $id_mat = $_GET['id_matricula'];


$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, ga.ngrupo, m.fechaini, m.fechafin
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
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
    }

    header('Content-type: text/xml');
    header('Content-Disposition: attachment; filename='.$naccion.'.'.$ngrupo.'.xml');

    
    $sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, ga.ngrupo, m.fechaini, m.fechafin, a.modalidad, a.mixta, a.horasdistancia, a.horaspresenciales
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
        $horaspresenciales = $row[horaspresenciales];
        $fechaini = $row[fechaini];
        $fechafin = $row[fechafin];
        $modalidad = $row[modalidad];
        $mixta = $row[mixta];
        $horasdistancia = $row[horasdistancia];
    }

    $sql = 'SELECT m.*, d.*, md.mixto
    FROM matriculas m, mat_doc md, docentes d
    WHERE m.id ='.$id_mat.'
    AND md.id_matricula = m.id
    AND md.id_docente = d.id';
    $sql = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($sql)) { 
        
        $horariomini = $row[horariomini];
        $horariomfin = $row[horariomfin];
        $horariotini = $row[horariotini];
        $horariotfin = $row[horariotfin];
        $diascheck = $row[diascheck];
    
        $horariomini_nop = $row[horariomini_nop];
        $horariomfin_nop = $row[horariomfin_nop];
        $horariotini_nop = $row[horariotini_nop];
        $horariotfin_nop = $row[horariotfin_nop];
        $diascheckod = $row[diascheckod];

        $tipo_docente = $row[tipo_docente];
        // echo
        $documento = $row[documento];

        if ( $row[nombre] == $row[apellido] || strlen($row[apellido]) <= 2 ) {

            if ( $row[mixto] == 'od' ) {
                $docente_nop = $row[nombre];
                $documento_nop = $row[documento];
            }
            else 
                $docente = $row[nombre];
                

        } else {

            if ( $row[mixto] == 'od' ) {
                $docente_nop_nombre = $row[nombre]; 
                $docente_nop_ap1 = $row[apellido];
                $docente_nop_ap2 = $row[apellido2];
                $documento_nop = $row[documento];
            }
            else 
                $docente = $row[nombre].' '.$row[apellido].' '.$row[apellido2];
            
        }

        if ( $mixta == "Teleformación" )
            $horastotalestele = $horasdistancia;
        else
            $horastotalesdist = $horasdistancia;

        $poblaciondoc = $row[poblacion];
        $provinciadoc = $row[provincia];
        $cpdoc = $row[codigopostal];
        $direcciondoc = $row[direccion];
        $empresadoc = $row[nombre];
        $cifdoc = $row[documento];
        $tlfempdoc = $row[telefono];

    }
    
    $sql = 'SELECT `nombrecentro`, `direccioncentro`, `codigopostal`, `localidad`, `provincia`, m.observaciones
    FROM matriculas m, centros c
    WHERE m.centro = c.id
    AND m.id = '.$id_mat;
    $sql = mysqli_query($link, $sql);
    
    while ($row = mysqli_fetch_array($sql)) { 
        $nombrecentro = $row[nombrecentro];
        $direccioncentro = $row[direccioncentro];
        $codpostal = $row[codigopostal];
        $localidad = $row[localidad];
        $observaciones = $row[observaciones];
    }
    
    
$text .= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
    <grupos xmlns="http://www.fundaciontripartita.es/schemas">
    <grupo>
    <idAccion>'. $naccion .'</idAccion>
    <idGrupo>'. $ngrupo .'</idGrupo>
    <descripcion>'. $denominacion .'</descripcion>
    <cumAportPrivada>false</cumAportPrivada>
    <tipoFormacion>';

    if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {

        $text .= '<medios>EntidadOrganizadora</medios>';

    } else {

        $text .= '<medios>EntidadInscrita</medios>';

    }

    $text .= '
    </tipoFormacion>
    <NumeroParticipante>25</NumeroParticipante>
    <fechaInicio>'. date("d/m/Y", strtotime($fechaini)) .'</fechaInicio>
    <fechaFin>'. date("d/m/Y", strtotime($fechafin)) .'</fechaFin>
    <responsable>Daniel Álvarez Benitez</responsable>
    <telefonoContacto>922100008</telefonoContacto>
    <jornadaPresencial>';
        if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {
        
            $text .= '
            <centro>
                <cif>B76567718</cif>
                <nombreCentro>Escuela Superior de Formación y Cualificación de Canarias, SL</nombreCentro>
            </centro>';

        } else {

            $text .= '
            <centro>
                <cif>'.$documento.'</cif>
                <nombreCentro>'.$docente.'</nombreCentro>
            </centro>';

        }

        $text .= '
        <lugarImparticion>
            <nombreCentro>'. $nombrecentro .'</nombreCentro>
            <direccionDetallada>'. $direccioncentro .'</direccionDetallada>
            <codPostal>'. $codpostal .'</codPostal>
            <localidad>'. $localidad .'</localidad>
        </lugarImparticion>
        <horario>
        <horaTotales>'. $horaspresenciales .'</horaTotales>';
    
    if ($horariomini != '') {
    $text .= '
        <horaInicioMañana>'. $horariomini .'</horaInicioMañana>
        <horaFinMañana>'. $horariomfin .'</horaFinMañana>';
    }

    if ($horariotini != '') {
    $text .= '
        <horaInicioTarde>'. $horariotini .'</horaInicioTarde>
        <horaFinTarde>'. $horariotfin .'</horaFinTarde>';
    }

    $text .= '<dias>'. $diascheck .'</dias>
        </horario>
    </jornadaPresencial>
    ';
    
    if ( $modalidad == "Mixta" ) {

        $text .= '
        <distanciaTeleformacion>';

            if ( $mixta == 'Teleformación' ) {

                if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {
                    $text .=
                    '<asistenciaTeleformacion>
                        <centro>
                        <cif>B76567718</cif>
                        <nombreCentro>Escuela Superior de Formación y Cualificación de Canarias, SL</nombreCentro>
                        <direccionDetallada>C./ Las Seguidillas, 9 - Zona Industrial Llanos del Camello</direccionDetallada>
                        <codPostal>38639</codPostal>
                        <localidad>CHAFIRAS, LAS (SAN MIGUEL DE ABONA)</localidad>
                        </centro>
                        <telefono>922100008</telefono>
                        </asistenciaTeleformacion>
                        ';
                } else {
                    $text .=
                '<asistenciaTeleformacion>
                    <centro>
                    <cif>'.$cifdoc.'</cif>
                    <nombreCentro>'.$empresadoc.'</nombreCentro>
                    <direccionDetallada>'.$direcciondoc.'</direccionDetallada>
                    <codPostal>'.$cpdoc.'</codPostal>
                    <localidad>'.$poblaciondoc.'</localidad>
                    </centro>
                    <telefono>'.$tlfempdoc.'</telefono>
                    </asistenciaTeleformacion>
                    ';
                }

                $text .= 
                '<horario>
                        <horaTotales>'.$horastotalestele.'</horaTotales>';
                        if ($horariomini_nop != '') {
                            $text .= '
                                <horaInicioMañana>'. $horariomini_nop .'</horaInicioMañana>
                                <horaFinMañana>'. $horariomfin_nop .'</horaFinMañana>';
                            }

                            if ($horariotini_nop != '') {
                            $text .= '
                                <horaInicioTarde>'. $horariotini_nop .'</horaInicioTarde>
                                <horaFinTarde>'. $horariotfin_nop .'</horaFinTarde>';
                            }

                            $text .= '<dias>'. $diascheckod .'</dias>
                    </horario>';

                    $q = 'SELECT nombre, apellido, apellido2, documento, nombredocente, apellidodocente, apellido2docente, documentodocente, telefonodocente
                    FROM mat_doc md, docentes d
                    WHERE d.id = md.id_docente
                    AND md.mixto = "od"
                    AND md.id_matricula = '.$id_mat;
                    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                    while ( $rowd = mysqli_fetch_array($q) ) {

                        if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {

                            $text .= '
                            <Tutor>
                                <numeroHoras>'.$horastotalesdist.'</numeroHoras>
                                <nif>'. $rowd[documento] .'</nif>
                                <nombre>'. $rowd[nombre] .'</nombre>
                                <apellido1>'. $rowd[apellido] .'</apellido1>
                                <apellido2>'. $rowd[apellido2] .'</apellido2>
                            </Tutor>
                            ';
                                                
                        } else {

                            $text .= '
                            <Tutor>
                                <numeroHoras>'.$horastotalesdist.'</numeroHoras>
                                <nif>'. $rowd[documentodocente] .'</nif>
                                <nombre>'. $rowd[nombredocente] .'</nombre>
                                <apellido1>'. $rowd[apellidodocente] .'</apellido1>
                                <apellido2>'. $rowd[apellido2docente] .'</apellido2>
                            </Tutor>
                            ';

                        }

                    }
                    

            } else {


                if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {
                    $text .=
                    '<asistenciaDistancia>
                        <centro>
                        <cif>B76567718</cif>
                        <nombreCentro>Escuela Superior de Formación y Cualificación de Canarias, SL</nombreCentro>
                        <direccionDetallada>C./ Las Seguidillas, 9 - Zona Industrial Llanos del Camello</direccionDetallada>
                        <codPostal>38639</codPostal>
                        <localidad>CHAFIRAS, LAS (SAN MIGUEL DE ABONA)</localidad>
                        </centro>
                        <telefono>922100008</telefono>';
                } else {
                    $text .=
                '<asistenciaDistancia>
                    <centro>
                    <cif>'.$cifdoc.'</cif>
                    <nombreCentro>'.$empresadoc.'</nombreCentro>
                    <direccionDetallada>'.$direcciondoc.'</direccionDetallada>
                    <codPostal>'.$cpdoc.'</codPostal>
                    <localidad>'.$poblaciondoc.'</localidad>
                    </centro>
                    <telefono>'.$tlfempdoc.'</telefono>';
                }

                $text .= '</asistenciaDistancia>
                <horario>
                        <horaTotales>'.$horastotalesdist.'</horaTotales>';

                        if ($horariomini_nop != '') {
                            $text .= '
                                <horaInicioMañana>'. $horariomini_nop .'</horaInicioMañana>
                                <horaFinMañana>'. $horariomfin_nop .'</horaFinMañana>';
                            }

                            if ($horariotini_nop != '') {
                            $text .= '
                                <horaInicioTarde>'. $horariotini_nop .'</horaInicioTarde>
                                <horaFinTarde>'. $horariotfin_nop .'</horaFinTarde>';
                            }

                            $text .= '<dias>'. $diascheckod .'</dias>
                    </horario>';

                    $q = 'SELECT nombre, apellido, apellido2, documento, nombredocente, apellidodocente, apellido2docente, documentodocente, telefonodocente
                    FROM mat_doc md, docentes d
                    WHERE d.id = md.id_docente
                    AND md.mixto = "od"
                    AND md.id_matricula = '.$id_mat;
                    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

                    while ( $rowd = mysqli_fetch_array($q) ) {

                        if ( $tipo_docente == "ESFOCC" || $tipo_docente === NULL ) {

                            $text .= '
                            <Tutor>
                                <numeroHoras>'.$horastotalesdist.'</numeroHoras>
                                <nif>'. $rowd[documento] .'</nif>
                                <nombre>'. $rowd[nombre] .'</nombre>
                                <apellido1>'. $rowd[apellido] .'</apellido1>
                                <apellido2>'. $rowd[apellido2] .'</apellido2>
                            </Tutor>
                            ';
                                                
                        } else {

                            $text .= '
                            <Tutor>
                                <numeroHoras>'.$horastotalesdist.'</numeroHoras>
                                <nif>'. $rowd[documentodocente] .'</nif>
                                <nombre>'. $rowd[nombredocente] .'</nombre>
                                <apellido1>'. $rowd[apellidodocente] .'</apellido1>
                                <apellido2>'. $rowd[apellido2docente] .'</apellido2>
                            </Tutor>
                            ';

                        }

                    }
                    

            }
            
        $text .= '
        </distanciaTeleformacion>';
    }

    
    $sql = 'SELECT DISTINCT e.cif
    FROM empresas e, ptemp_mat_emp m
    WHERE m.id_empresa = e.id
    AND m.id_matricula = '.$id_mat;
    $sql = mysqli_query($link, $sql);
    
    $text .= '<EmpresasParticipantes>
    ';
    while ($row = mysqli_fetch_array($sql)) {
        $text .= '<empresa>
        <cifEmpresaParticipante>'. $row[cif] .'</cifEmpresaParticipante>
        </empresa>
        ';
    }

    $text .= '</EmpresasParticipantes>
    <observaciones>'. $observaciones .'</observaciones>
    </grupo>
    </grupos>';

echo $text;
?>