<?

include_once ('../functions/funciones.php');

if ($_GET['id_matricula'])
	$id_mat = $_GET['id_matricula'];

	$sql = 'SELECT COUNT( id_matricula ) as numParticipantes 
	FROM mat_alu_cta_emp 
	WHERE id_matricula = '.$id_mat;
	$sql = mysqli_query($link, $sql);
	$row = mysqli_fetch_array($sql);
	$numParticipantes = $row[numParticipantes];
	if ( $numParticipantes == 0 )
		$numParticipantes = 80;
	
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
	
	
$text .= '<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
	<grupos xmlns="http://www.fundaciontripartita.es/schemas">
	<grupo>
	<idAccion>'. $naccion .'</idAccion>
	<idGrupo>'. $ngrupo .'</idGrupo>
	<descripcion>'. $denominacion .'</descripcion>
	<cumAportPrivada>false</cumAportPrivada>
	<tipoFormacion>
	<mediosPropios>false</mediosPropios>
	<mediosEntidadOrganizadora>false</mediosEntidadOrganizadora>
	<mediosCentro>true</mediosCentro>
	</tipoFormacion>
	<NumeroParticipante>'. $numParticipantes .'</NumeroParticipante>
	<fechaInicio>'. date("d/m/Y", strtotime($fechaini)) .'</fechaInicio>
	<fechaFin>'. date("d/m/Y", strtotime($fechafin)) .'</fechaFin>
	<responsable>Daniel Álvarez Benitez</responsable>
	<telefonoContacto>922100008</telefonoContacto>
	<distanciaTeleformacion>
	<asistenciaDistancia>
	<centro>
	<cif>B76567718</cif>
	<nombreCentro>Escuela Superior de Formación y Cualificación de Canarias, SL</nombreCentro>
	<direccionDetallada>C./ Las Seguidillas, 9 - Zona Industrial Llanos del Camello</direccionDetallada>
	<codPostal>38639</codPostal>
	<localidad>CHAFIRAS, LAS (SAN MIGUEL DE ABONA)</localidad>
	</centro>
	<telefono>922100008</telefono>
	</asistenciaDistancia>
	<horario>
	<horaTotales>'. $horastotales .'</horaTotales>
	';
	
	if ($horariomini != '') {
	$text .= '<horaInicioMañana>'. $horariomini .'</horaInicioMañana>
	<horaFinMañana>'. $horariomfin .'</horaFinMañana>
	';
	}

	if ($horariotini != '') {
	$text .= '<horaInicioTarde>'. $horariotini .'</horaInicioTarde>
	<horaFinTarde>'. $horariotfin .'</horaFinTarde>
	';
	}

	$text .= '<dias>'. $diascheck .'</dias>
	</horario>
	';
	
	$sql = 'SELECT d.nombre, d.apellido, d.apellido2, d.documento
	FROM docentes d, mat_doc m
	WHERE m.id_docente = d.id
	AND m.id_matricula = '.$id_mat;
	$sql = mysqli_query($link, $sql);
	
	while ($row = mysqli_fetch_array($sql)) {
		$text .= '<Tutor>
		<numeroHoras>'. $horastotales .'</numeroHoras>
		<nif>'. $row[documento] .'</nif>
		<nombre>'. $row[nombre] .'</nombre>
		<apellido1>'. $row[apellido] .'</apellido1>
		<apellido2>'. $row[apellido2] .'</apellido2>
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
		AND a.id = m.id_alumno
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