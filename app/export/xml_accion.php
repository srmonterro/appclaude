<?

include_once ('../functions/funciones.php');

if ($_GET['id_accion'])
	$id_acc = $_GET['id_accion'];
	//echo $link;
	$sql = 'SELECT DISTINCT a.*
	FROM acciones a
	WHERE a.id = '.$id_acc;

	$sql = mysqli_query($link, $sql) or die("error".mysqli_error($link));
	while ($row = mysqli_fetch_array($sql)) {
		$naccion = $row[numeroaccion];
		$denominacion = $row[denominacion];
		$objetivos = $row[objetivos];
		$contenido = $row[contenido];
		$codgrupo = $row[id_grupo];
		$horastotales = $row[horastotales];
		$modalidad = $row[modalidad];
		$horasPr = $row[horaspresenciales];
		$horasOtro = $row[horasdistancia];
		$mixta = $row[mixta];
		$url = $row[url];
		$urlorig = $url;
		$cif_externa = $row[cifcentro];
		$razon_externa = $row[nombrecentro];
		$url_externa = $row[url_externa];
		$user_externa = $row[usuario_externa];
		$pass_externa = $row[pass_externa];
		$area_profesional = $row[area_profesional];
	}

header('Content-type: text/xml');
header('Content-Disposition: attachment; filename="'.$naccion.'.xml"');

$text .= '<AccionesFormativas>
<AccionFormativa>
<codAccion>'. $naccion .'</codAccion>
<nombreAccion>'. $denominacion .'</nombreAccion>
<codGrupoAccion>'. $codgrupo .'</codGrupoAccion>
<codAreaProfesional>'.$area_profesional.'</codAreaProfesional>
';

if ( $modalidad == 'Presencial' ) {

	$modnumero = 7;
	$modsimple = '<modalidadPresencial>
	<horasPr>'. $horastotales .'</horasPr>
	
	</modalidadPresencial>
	<nivelFormacion>1</nivelFormacion>';
	$text .= $modsimple;

} else if ( $modalidad == 'A Distancia' ) {

	$modnumero = 8;
	$modsimple = '<modalidadSimple>
	<horas>'. $horastotales .'</horas>
	<modalidad>'. $modnumero .'</modalidad>
	</modalidadSimple>';
	$text .= $modsimple;

} else if ( $modalidad == 'Teleformación' ) {

	$modnumero = 10;
	$modsimple = '<modalidadTeleformacion>
	<horasTe>'. $horastotales .'</horasTe>
	
	</modalidadTeleformacion>';
	$text .= $modsimple;

	$url = explode('://', $url);

	if ( $urlorig == "Externa" ) {
		$online = '<cifPlataforma>'.$cif_externa.'</cifPlataforma>
		<razonSocialPlataforma>'.$razon_externa.'</razonSocialPlataforma>
		<uri>'.$url_externa.'</uri>
		<usuario>'.$user_externa.'</usuario>
		<password>'.$pass_externa.'</password>';
	} else if ( $url[1][0] != 'e'  ) { // MOODLE
		$online = '<cifPlataforma>B76757764</cifPlataforma>
		<razonSocialPlataforma>Eduka-te Solutions, S.L.U.</razonSocialPlataforma>
		<uri>https://www.trainingeduka-te.com/</uri>
		<usuario>supervisoredkt25</usuario>
		<password>Superv.edkt25*</password>';
	} else if ( $urlorig == "Externa" ) {
		$online = '<cifPlataforma>'.$cif_externa.'</cifPlataforma>
		<razonSocialPlataforma>'.$razon_externa.'</razonSocialPlataforma>
		<uri>'.$url_externa.'</uri>
		<usuario>'.$user_externa.'</usuario>
		<password>'.$pass_externa.'</password>';
	} else {
		$online = '<cifPlataforma>A46154225</cifPlataforma>
		<razonSocialPlataforma>Computer Aided Elearning SA</razonSocialPlataforma>
		<uri>https://eduka-te.dexway.com</uri>
		<usuario>superv.25dexway</usuario>
		<password>Edukadexway25</password>';
	}
	$text .= $online;

}  else if ( $modalidad == "Mixta" ) {

	$modnumero = 9;
	$modsimple = '<modalidadSimple>
	<horas>'. $horastotales .'</horas>
	<modalidad>'. $modnumero .'</modalidad>
	</modalidadSimple>';
	$text .= $modsimple;

	$modmixta = '
	<modalidadMixta>
	<horasPr>'. $horasPr .'</horasPr>
	';

	if ( $mixta == "A Distancia" )
	$modmixta .= '<horasDi>'. $horasOtro .'</horasDi>
	';
	else
	$modmixta .= '<horasTe>'. $horasOtro .'</horasTe>
	';

	$modmixta .= '</modalidadMixta>';
	$text .= $modmixta;

	// $text.=$url;
	$url = explode('://', $url);

	if ( $urlorig == "Externa" ) {
		$online = '<uri>'.$url_externa.'</uri>
		<usuario>'.$user_externa.'</usuario>
		<password>'.$pass_externa.'</password>';
	} else if ( $url[1][0] != 'e'  ) { // MOODLE
		$online = '<uri>https://www.trainingeduka-te.com/</uri>
		<usuario>supervisoredkt25</usuario>
		<password>Superv.edkt25*</password>';
	} else if ( $urlorig == "Externa" ) {
		$online = '<uri>'.$url_externa.'</uri>
		<usuario>'.$user_externa.'</usuario>
		<password>'.$pass_externa.'</password>';
	} else {
		$online = '<uri>https://eduka-te.dexway.com</uri>
		<usuario>superv.25dexway</usuario>
		<password>Edukadexway25*</password>';
	}
	$text .= $online;
}

$text .= '

<objetivos>'. $objetivos .'</objetivos>
<contenidos>'. $contenido .'</contenidos>';

$text .= '</AccionFormativa>
</AccionesFormativas>';


echo $text;
?>