<?

include_once ('../functions/funciones.php');

if ($_GET['id_matricula'])
	$id_mat = $_GET['id_matricula'];

	$sql = 'SELECT COUNT( id_matricula ) as numParticipantes
	FROM mat_alu_cta_emp
	WHERE id_matricula = '.$id_mat;
	$sql = mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($sql);
	$numParticipantes = $row[numParticipantes];
	if ( $numParticipantes == 0 )
		$numParticipantes = 80;

	$sql = 'SELECT DISTINCT a.numeroaccion, a.denominacion, a.horastotales, ga.ngrupo, m.fechaini, m.fechafin, a.*, m.tipo_docente
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
		$tipo_docente = $row[tipo_docente];

		if ( $row[url] == "Externa" ) {
			$externo = 1;
			$url_externa = $row[url_externa];
			$usuario_externa = $row[usuario_externa];
			$pass_externa = $row[pass_externa];
			$nombrecentro = $row[nombrecentro];
			$cifcentro = $row[cifcentro];
			$direccioncentro = $row[direccioncentro];
			$cpcentro = $row[cpcentro];
			$telefonocentro = $row[telefonocentro];
			$poblacioncentro = $row[poblacioncentro];
		}
	}

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="'.$naccion.'.'.$ngrupo.'.xml"');

	$sql = 'SELECT m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.horasteleformacion, m.observaciones
	FROM matriculas m
	WHERE m.id ='.$id_mat;
	$sql = mysqli_query($link, $sql);

	while ($row = mysqli_fetch_array($sql)) {
		$horariomini = $row[horariomini];
		$horariomfin = $row[horariomfin];
		$horariotini = $row[horariotini];
		$horariotfin = $row[horariotfin];
		$diascheck = $row[diascheck];
		$observaciones = $row[observaciones];
	}

//<cumAportPrivada>false</cumAportPrivada>
$text .= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
	<grupos>
	<grupo>
	<idAccion>'. $naccion .'</idAccion>
	<idGrupo>'. $ngrupo .'</idGrupo>
	<descripcion>'. $denominacion .'</descripcion>
	
	
	<NumeroParticipante>'. $numParticipantes .'</NumeroParticipante>
	<fechaInicio>'. date("d/m/Y", strtotime($fechaini)) .'</fechaInicio>
	<fechaFin>'. date("d/m/Y", strtotime($fechafin)) .'</fechaFin>
	<responsable>Iván Cabrera</responsable>
	<telefonoContacto>619325543</telefonoContacto>
	<distanciaTeleformacion>
	<asistenciaTeleformacion>
	<centro>';

	if ( $externo == 1 ) {
		$text .= '
		<cif>'.$cifcentro.'</cif>
		<nombreCentro>'.$nombrecentro.'</nombreCentro>
		<direccionDetallada>'.$direccioncentro.'</direccionDetallada>
		<codPostal>'.$cpcentro.'</codPostal>
		<localidad>'.$poblacioncentro.'</localidad>
		</centro>
		<telefono>'.$telefonocentro.'</telefono>
		';

	} else {
		$text .= '
		<cif>B76757764</cif>
		<nombreCentro>Eduka-te Solutions, S.L.U.</nombreCentro>
		<direccionDetallada>C./ Londres, 11</direccionDetallada>
		<codPostal>38660</codPostal>
		<localidad>COSTA ADEJE</localidad>
		</centro>
		<telefono>822615260</telefono>
		';
	}

	$text .= '
	</asistenciaTeleformacion>
	<horario>
	<horaTotales>'. $horastotales .'</horaTotales>
	';

	if ($horariomini != '') {
	$text .= '<horaInicioTramo1>'. $horariomini .'</horaInicioTramo1>
	<horaFinTramo1>'. $horariomfin .'</horaFinTramo1>
	';
	}

	if ($horariotini != '') {
	$text .= '<horaInicioTramo2>'. $horariotini .'</horaInicioTramo2>
	<horaFinTramo2>'. $horariotfin .'</horaFinTramo2>
	';
	}

	$text .= '<dias>'. $diascheck .'</dias>
	</horario>
	';

	$sql = 'SELECT d.*, m.perfil, m.numhorasdoc
    FROM docentes d, mat_doc m
    WHERE m.id_docente = d.id
    AND m.id_matricula = '.$id_mat;
    $sql = mysqli_query($link, $sql);

    while ($row = mysqli_fetch_array($sql)) {

    	if ( $row['tipodoc'] == "Empresa" ) {
    		$row[documento] = $row[documentodocente];
    		$row[nombre] = $row[nombredocente];
    		$row[apellido] = $row[apellidodocente];
    		$row[apellido2] = $row[apellido2docente];
    		// if ( $row[numhorasdoc] != "" && $row[numhorasdoc] != 0 )
    			// $horastotales = $row[numhorasdoc];
    	}
        $text .= '<Tutor>
        <numeroHoras>'. $row[numhorasdoc] .'</numeroHoras>
        <tipoDocumento>10</tipoDocumento>
        <documento>'. $row[documento] .'</documento>
        <nombre>'. $row[nombre] .'</nombre>
        <apellido1>'. $row[apellido] .'</apellido1>
        <apellido2>'. $row[apellido2] .'</apellido2>
		<telefono>'.$row[telefono].'</telefono>
		<correoElectronico>'.$row[email].'</correoElectronico>';
        

        $text.='
        <tutoria>
        	<tipoTutoria>
        		<tutorias>1</tutorias>
        	</tipoTutoria>
        	<descripcion></descripcion>
        </tutoria>
        <tutoria>
        	<tipoTutoria>
        		<tutorias>3</tutorias>
        	</tipoTutoria>
        	<descripcion></descripcion>
        </tutoria>
        </Tutor>
        ';
    }
	$text .= '</distanciaTeleformacion>
	';

	$url = explode("?", $_SERVER[HTTP_REFERER]);
	if ( $url[1] == 'form_matricula_ini' || $url[1] == 'form_matricula_ini#' ) {

		$sql = 'SELECT e.id, e.razonsocial, e.cif
    	FROM otemp_mat_emp pm, empresas e
    	WHERE e.id = pm.id_empresa
    	AND pm.id_matricula = '.$id_mat;

	} else {

		$sql = 'SELECT DISTINCT e.cif, m.jornadalaboral
		FROM empresas e, mat_alu_cta_emp m, alumnos a
		WHERE m.id_empresa = e.id
		AND m.id_alumno = a.id
		AND m.id_matricula = '.$id_mat;

	}

	$sql = mysqli_query($link, $sql);

	$text .= '<EmpresasParticipantes>
	';
	while ($row = mysqli_fetch_array($sql)) {
		$jornadalaboral = ($row[jornadalaboral] == 0) ? 0 : $row[jornadalaboral];
		$text .= '<empresa>
		<cifEmpresaParticipante>'. $row[cif] .'</cifEmpresaParticipante>
		<jornadaLaboral>'. $jornadalaboral .'</jornadaLaboral>
		</empresa>
		';
	}

	$text .= '</EmpresasParticipantes>
	<observaciones>'. $observaciones .'</observaciones>
	</grupo>
	</grupos>';

echo $text;
?>