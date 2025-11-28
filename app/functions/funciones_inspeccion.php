<?

include './funciones.php';


	// function comprobarEnvioExp($id, $naccion, $ngrupo, $link) {

	// 	$qz = 'SELECT DISTINCT razonsocial
	//     FROM empresas
	//     WHERE id = '.$id
	//     $qz = mysqli_query($link, $qz) or die("error:" .mysqli_error($link));

	//     $rowz = mysqli_fetch_array($qz);

	//     $qx = 'SELECT DISTINCT  fecha FROM registro_emails r
	//     WHERE titulo
	//     LIKE "%Expediente Digital '.$naccion.'/'.$ngrupo.'%"
	//     AND titulo LIKE "%'.$rowz[razonsocial].'%"';
	//     $qx = mysqli_query($link, $qx) or die("error:" .mysqli_error($link));

	//     if ( mysqli_num_rows($qx) > 0 ) {
	//     	$rowx = mysqli_fetch_array($link, $qx);
	//     	return $rowx[fecha];
	//     } else
	//     	return "";

	// }


$sec = basename($_SERVER['HTTP_REFERER'], ".php");

// session_start();
$gestion = devuelveAnio();

$accion = $_POST['accion'];
$id_mat = $_POST['id_mat'];
$doc = $_POST['doc'];
// $id_emp = $_POST['id_emp'];


if ( $sec == 'index.php?form_docufinal' || $sec == 'index.php?form_docufinalonlinedist' || $doc == 'listadoessscan' )

	$sql = 'SELECT DISTINCT  a.numeroaccion, ga.ngrupo, a.modalidad, m.estado
	FROM matriculas m, acciones a, grupos_acciones ga
	WHERE m.id_accion = a.id
	AND m.id_grupo = ga.id
	AND m.id = '.$id_mat.'
	LIMIT 1';

else

	$sql = 'SELECT DISTINCT  a.numeroaccion, ga.ngrupo, a.modalidad, CONCAT(al.nombre,"_", al.apellido) as alu, m.estado, m.solicitud
	FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma, alumnos al
	WHERE m.id_accion = a.id
	AND m.id_grupo = ga.id
	AND m.id = ma.id_matricula
	AND ma.id_alumno = al.id
	AND m.id = '.$id_mat.'
	LIMIT 1';

$sql = mysqli_query($link, $sql) or die("error ");
// echo $sql;
while ($row = mysqli_fetch_assoc($sql)) {
	$naccion = $row['numeroaccion'];
	$ngrupo = $row['ngrupo'];
	$modalidad = $row['modalidad'];
	$alumno = strtolower( quitaTildes(trim($row['alu'])) );
	$estado = $row[estado];
	$solicitud = $row[solicitud];
}

$rutaprev = dirname(__DIR__).'/documentacion'.$gestion.'/inspeccion/';
$ruta = dirname(__DIR__).'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';
$rutabase = $basepath.'/documentacion'.$gestion.'/inspeccion/'.$naccion.'-'.$ngrupo.'/';
$rutadocentes = dirname(__DIR__).'/documentacion'.$gestion.'/docentes/';
$rutaempresa = dirname(__DIR__).'/pdf_tripartita'.$gestion.'/empresa/';
$rutaempresanexo = dirname(__DIR__).'/pdf_tripartita/empresa/';

if ( !file_exists($ruta) )
		mkdir($ruta);

if ( $accion == 'obtener' ) {

	$q1 = 'SELECT DISTINCT ga.ngrupo, ga.id_accion, m.id, m.fechaini, m.fechafin, a.numeroaccion, a.denominacion, a.horastotales,
	a.modalidad, m.estado, m.horariomini, m.horariomfin, m.horariotini, m.horariotfin, m.diascheck, m.observaciones, m.grupo, m.solicitud, m.mediainicial, m.mediafinal, m.valoracioncurso, m.observacionesinspeccion
	FROM acciones a, matriculas m, grupos_acciones ga
	WHERE m.id_accion = a.id
	AND m.id_grupo = ga.id
	AND m.id = '.$id_mat.'
	LIMIT 0,1';
	// echo $q1;
	$q1 = mysqli_query($link,$q1);

	$rows = array();
	while($r = mysqli_fetch_assoc($q1)) {
		$grupo = $r[grupo];
    	$rows[0] = $r;
    	$observacionesinspeccion = $r[observacionesinspeccion];
	}



	if ( $modalidad == 'Teleformación' ) {

		if ( $grupo == 0 ) {

			if ( file_exists($ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_onlinecert] = 1;
			else
				$rows[existe_onlinecert] = 0;

		} else {

			$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM mat_alu_cta_emp ma, empresas e
		    WHERE ma.id_empresa = e.id

		    AND ma.id_matricula = '.$id_mat;
		    $q = mysqli_query($link, $q);

	    	while ( $row = mysqli_fetch_array($q) ) {

		    	$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
		    	$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

		        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label>Justificantes - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmemps-'.$row[id].'" id="pmemps-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmemps-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmemps-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

		        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> RLT - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmrlts-'.$row[id].'" id="pmrlts-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmrlts-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmrlts-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-rlt"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';
		        // echo $inputs;

	    	}

	    	$rows[inputsemp] = $inputs;

		}

		if ( file_exists($ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_onlinerlt] = 1;
		else
			$rows[existe_onlinerlt] = 0;


	} else if ( $modalidad == 'A Distancia' ) {


		if ( $grupo == 0 ) {

	 		if ( file_exists($ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_distcert] = 1;
			else
				$rows[existe_distcert] = 0;

		} else {

			$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM mat_alu_cta_emp ma, empresas e
		    WHERE ma.id_empresa = e.id

		    AND ma.id_matricula = '.$id_mat;
		    $q = mysqli_query($link, $q);

	    	while ( $row = mysqli_fetch_array($q) ) {

		    	$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
		    	$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

		        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Lista de Asistencia y Justificantes - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmemps-'.$row[id].'" id="pmemps-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmemps-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmemps-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';



	    	}

	    	$rows[inputsemp] = $inputs;

			if ( file_exists($ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_distretorno] = 1;
			else
				$rows[existe_distretorno] = 0;

			if ( file_exists($ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_distexamen] = 1;
			else
				$rows[existe_distexamen] = 0;

			if ( file_exists($ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_distcuest] = 1;
			else
				$rows[existe_distcuest] = 0;

			if ( file_exists($ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf') )
				$rows[existe_distrlt] = 1;
			else
				$rows[existe_distrlt] = 0;

		}

	} else {

		// if ( file_exists($ruta . 'pmcert-' . $naccion.'_'.$ngrupo.'.pdf') )
		// 	$rows[existe_pmcert] = 1;
		// else
		// 	$rows[existe_pmcert] = 0;

		// if ( file_exists($ruta . 'pmmaterial-' . $naccion.'_'.$ngrupo.'.pdf') )
		// 	$rows[existe_pmmaterial] = 1;
		// else
		// 	$rows[existe_pmmaterial] = 0;

		// if ( file_exists($ruta . 'pmlistasist-' . $naccion.'_'.$ngrupo.'.pdf') )
		// 	$rows[existe_pmlistasist] = 1;
		// else
		// 	$rows[existe_pmlistasist] = 0;

		if ( $sec == 'index.php?form_docufinal' || $sec == 'index.php?form_docufinal#' ) {

			if ( $estado == 'Finalizada' || $estado == 'Facturada' || $estado == 'Gratuita' )

				$q = 'SELECT DISTINCT  e.id, e.razonsocial, e.email_facturas, e.email
			    FROM mat_alu_cta_emp ma, empresas e
			    WHERE ma.id_empresa = e.id
		    	AND ma.id_matricula = '.$id_mat;

			else

				$q = 'SELECT DISTINCT  e.id, e.razonsocial, e.email_facturas, e.email
				FROM temp_empresas ma, empresas e
				WHERE ma.cif = e.cif
				AND ma.id_matricula = '.$id_mat;


		} else

			$q = 'SELECT DISTINCT  e.id, e.razonsocial, e.email_facturas, e.email
		    FROM mat_alu_cta_emp ma, empresas e
		    WHERE ma.id_empresa = e.id
	    	AND ma.id_matricula = '.$id_mat;

	    // echo $q;
	    $q = mysqli_query($link, $q);

	    while ( $row = mysqli_fetch_array($q) ) {

	    	if ( $row[email_facturas] == "" ) $email = $row[email];
            else $email = $row[email_facturas];

	    	$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
	    	$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	    	$inputsikea = '<div style="margin-top:10px;margin-left: -30px;" class="col-md-12"><div class="col-md-3"><div class="form-group"><label class="control-label" for="mediainicial">Nota media inicial:</label><input type="text" id="mediainicial" name="mediainicial" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="mediafinal">Nota media final:</label><input type="text" id="mediafinal" name="mediafinal" class="form-control" /></div></div><div class="col-md-3"><div class="form-group"><label class="control-label" for="valoracioncurso">Valoración del curso:</label><input type="text" id="valoracioncurso" name="valoracioncurso" class="form-control" /></div></div><a style="margin-top:25px" id="guardarmediasik" class="boton btn btn-primary"> Guardar </a></div><div class="clearfix"></div>';

	    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:30px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Lista de Asistencia y Justificantes - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmemps-'.$row[id].'" id="pmemps-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmemps-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmemps-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-asist"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

	        $archivo = $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Ficha de Participante - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmfichas-'.$row[id].'" id="pmfichas-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmfichas-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmfichas-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-fichas"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

	        $archivo = $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Examen de Conocimientos - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmexamenes-'.$row[id].'" id="pmexamenes-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmexamenes-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmexamenes-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-exam"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

	        $archivo = $ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Cuestionario de Calidad - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmcuestionarios-'.$row[id].'" id="pmcuestionarios-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmcuestionarios-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmcuestionarios-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-cuest"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

	        $archivo = $ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	    	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> RLT - Empresa: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="pmrlts-'.$row[id].'" id="pmrlts-'.$row[id].'" class="btn btn-default"/><a id="subirpdfpmrlts-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdfpmrlts-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-rlt"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';


	        $archivo = $ruta . 'facturagastos-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

	       	if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-12"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Factura gastos: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="facturagastos-'.$row[id].'" id="facturagastos-'.$row[id].'" class="btn btn-default"/><a id="subirpdffacturagastos-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdffacturagastos-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-fra"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><div class="clearfix"></div><span class="fininputsemp"></span>';

	        $archivo = $ruta . 'listadoessscan-' . $naccion.'_'.$ngrupo.'.pdf';

	        if ( file_exists($archivo) ) $color = 'green'; else $color = 'red';

	        // $inputs .= '<div style="margin-top:10px;margin-left: -15px;" class="col-md-7"><form id="premix1" action="" method="post" enctype="multipart/form-data"><label> Listado ESSSCAN: '.$row[razonsocial].' </label><br><input style="float:left" type="file" name="listadoessscan-'.$row[id].'" id="listadoessscan-'.$row[id].'" class="btn btn-default"/><a id="subirpdflistadoessscan-'.$row[id].'" class="btn boton btn-primary"><span class="glyphicon glyphicon-open"></span> Subir PDF </a><a id="mostrarpdflistadoessscan-'.$row[id].'" style="" class="btn boton btn-success"><span class="glyphicon glyphicon-save"></span> Mostrar PDF </a></form><div style="float:left;" id="comp-'.$row[id].'-fra"><div id="esta"><span style="margin-top: 10px; margin-left: 5px; color: '.$color.'" class="glyphicon glyphicon-ok-circle"></span></div></div></div><span class="fininputsemp"></span>';


	        // $fecha = comprobarEnvioExp($row[id], $rows[naccion], $rows[ngrupo], $link);

	        // echo $rows[naccion]; echo $rows[ngrupo];



	        $inputs .= '<div class="clearfix"></div><div style="overflow:auto; margin-top:10px;margin-left: -30px;" class="col-md-12"><div class="col-md-5"><div class="form-group"><label class="control-label" for="email_envio">Email:</label><input value="'. $email . '" type="text" id="email_envio'.$row[id].'" name="email_envio" class="form-control" /></div></div><div class="col-md-2" style="margin-top: 25px"><a id="emailexpediente" idemp="'.$row[id].'" style="float:left; width: 100%; margin-top: 0px; " class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar Expediente</a></div></div><p>'. $fecha .'</p><div class="clearfix"></div><hr>';


	    }

	    //cgutierrez TextArea de Observaciones con botón de envio
    	$inputs .= '<div class="clearfix"></div><div style="overflow:auto; margin-top:10px;margin-left: -30px;" class="col-md-12"><div class="col-md-6"><div class="form-group"><label class="control-label" for="email_envio">Observaciones:</label><textarea rows="4" cols="60" name="observaciones'.$row[id].'" id="observaciones'.$row[id].'" class="btn btn-default" style="text-align:left" >'.$observacionesinspeccion.'</textarea></div></div><div class="col-md-2" style="margin-top: 25px"><a id="emailobservaciones" idemp="'.$row[id].'" style="float:left; width: 100%; margin-top: 0px; " class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span> Enviar </a></div></div><p>'. $fecha .'</p><div class="clearfix"></div>';

	    // $rows[inputsemp] = $inputs;

	    if ( $sec == 'index.php?form_docufinal' || $sec == 'index.php?form_docufinalonlinedist' )
	    	$rows[inputsemp] = $inputsikea.$inputs;
	    else
	    	$rows[inputsemp] = $inputs;

		if ( file_exists($ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_pmfichasist] = 1;
		else
			$rows[existe_pmfichasist] = 0;

		if ( file_exists($ruta . 'pmexamen-' . $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_pmexamen] = 1;
		else
			$rows[existe_pmexamen] = 0;

		if ( file_exists($ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_pmcuest] = 1;
		else
			$rows[existe_pmcuest] = 0;

		if ( file_exists($ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_pmrlt] = 1;
		else
			$rows[existe_pmrlt] = 0;

		if ( file_exists($ruta . 'facturagastos-' . $emp . '-'. $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_factura] = 1;
		else
			$rows[existe_factura] = 0;

		if ( file_exists($ruta . 'listadoessscan-'. $naccion.'_'.$ngrupo.'.pdf') )
			$rows[existe_listadoessscan] = 1;
		else
			$rows[existe_listadoessscan] = 0;

	}


	if ( file_exists($ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf') )
		$rows[existe_requerimiento] = 1;
	else
		$rows[existe_requerimiento] = 0;


	echo json_encode($rows);



} else if ( $accion == 'subir' ) {

	// echo "hola";

	if ($_FILES["file"]["error"] > 0) {

	    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
	    return false;

	} else if ( isset($_POST[id_emp] ) ) {


			$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM empresas e
		    WHERE e.id = '.$_POST[id_emp];
		    // echo $q;
		    $q = mysqli_query($link, $q);
		    $row = mysqli_fetch_array($q);

		    // echo $emp;

		    $emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));

		    // echo $emp;

		switch ($doc) {

			case 'pmemps':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

		    case 'pmfichas':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	break;

	        case 'pmexamenes':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	break;

	       	case 'pmcuestionarios':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	break;

	        case 'pmrlts':
	        	$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	break;

	        case 'facturagastos':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'facturagastos-' . $emp . '-'. $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'facturagastos-' . $emp . '-'. $naccion.'_'.$ngrupo.'.pdf',0755);
				break;


	    	}



	} else {

		switch ($doc) {

			case 'onlinecert':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'onlinerlt':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'distcert':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'distretorno':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'distexamen':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'distcuest':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'distrlt':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'distrlt-' .  $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'distrlt-' .  $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'pmfichasist':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'pmexamen':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmexamen-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'pmexamen-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'pmcuest':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'pmrlt':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'requerimiento':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf');
	            chmod($ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf',0755);
				break;

			case 'listadoessscan':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'listadoessscan-'. $naccion.'_'.$ngrupo.'.pdf');
				chmod($ruta . 'listadoessscan-'. $naccion.'_'.$ngrupo.'.pdf',0755);

				enviarMailSimple('Subido Listado ESSSCAN '.$naccion.'/'.$ngrupo, 'ytejera@eduka-te.com,ccoll_formacion@eduka-te.com', $link);

				break;


		}
	}

	if ( $move == 'true' ) {

		if ( strpos($solicitud, 'IK') !== false )
			envioMailIKEA($naccion, $ngrupo, 'ikea_docufinal', $link, $modalidad);
        echo "bien";
	}
    else
        echo "error";


} else if ( $accion == 'mostrar' ) {

	if ( isset($_POST[id_emp] ) ) {

		$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM empresas e
		    WHERE e.id = '.$_POST[id_emp];
		    // echo $q;
		    $q = mysqli_query($link, $q);
		    $row = mysqli_fetch_array($q);

		    $emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));

		    // echo $emp;
		    $archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';


		switch ($doc) {

			case 'pmemps':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

		    case 'pmfichas':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	        case 'pmexamenes':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	       	case 'pmcuestionarios':
				$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'pmcuestionarios-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	        case 'pmrlts':
	        	$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'pmrlts-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	        case 'facturagastos':
	        	$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'facturagastos-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'facturagastos-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'facturagastos-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	        case 'listadoessscan':
	        	$move = move_uploaded_file($_FILES["file"]["tmp_name"], $ruta . 'listadoessscan-' . $naccion.'_'.$ngrupo.'.pdf');
	        	chmod($ruta . 'listadoessscan-' . $naccion.'_'.$ngrupo.'.pdf',0755);
	        	$rutafinal = $rutabase . 'listadoessscan-' . $naccion.'_'.$ngrupo.'.pdf';
	        	break;

	    }

	} else {

		switch ($doc) {

			case 'onlinecert':
				$archivo = $ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'onlinerlt':
				$archivo = $ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'distcert':
				$archivo = $ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'distretorno':
				$archivo = $ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'distexamen':
				$archivo = $ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'distcuest':
				$archivo = $ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'distrlt':
				$archivo = $ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmcert':
				$archivo = $ruta . 'pmcert-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmcert-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmmaterial':
				$archivo = $ruta . 'pmmaterial-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmmaterial-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmlistasist':
				$archivo = $ruta . 'pmlistasist-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmlistasist-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmfichasist':
				$archivo = $ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmexamen':
				$archivo = $ruta . 'pmexamen-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmexamen-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmcuest':
				$archivo = $ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'pmrlt':
				$archivo = $ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

			case 'requerimiento':
				$archivo = $ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf';
				$rutafinal = $rutabase . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf';
				break;

		}

	}

	 if ( file_exists($archivo) )

            echo ($rutafinal);

        else {

            // echo "no";
            echo ($rutafinal);
    }


} else if ( $accion == 'zip' ) {

	$i = 0;
	$j = 0;
	$files = array();
	$docentespdfa = array();

	$q = 'SELECT DISTINCT d.nombre, d.apellido, d.documento
	FROM grupos_acciones ga, acciones a, matriculas m, mat_doc md, docentes d
	WHERE m.id_grupo = ga.id
	AND ga.id_accion = m.id_accion
	AND ga.id_accion = a.id
	AND md.id_matricula = m.id
	AND md.id_docente = d.id
	AND a.numeroaccion = "'.$naccion.'"
	AND ga.ngrupo = "'.$ngrupo.'"';
	$q = mysqli_query($link, $q);

	$nrows = mysqli_num_rows($q);

	if ( $nrows > 1 ) { // MIXTA ( 2 docentes )

		while ( $rows = mysqli_fetch_array($q) ) {
			$j++;
    		$docentespdfa[$j] = normaliza($rows[nombre].'_'.$rows[apellido].'_'.$rows[documento]);
    	}
    	// print_r($docentespdfa);

    	if ( file_exists($rutadocentes . $docentespdfa[1] . '-cv.pdf') ) {
    		array_push($files, $rutadocentes . $docentespdfa[1] . '-cv.pdf');
    		$i++;
	    }
	    if ( file_exists($rutadocentes . $docentespdfa[1] . '-contrato.pdf') ) {
    		array_push($files, $rutadocentes . $docentespdfa[1] . '-contrato.pdf');
    		$i++;
	    }
	    if ( file_exists($rutadocentes . $docentespdfa[2] . '-cv.pdf') ) {
    		array_push($files, $rutadocentes . $docentespdfa[2] . '-cv.pdf');
    		$i++;
    	}
    	if ( file_exists($rutadocentes . $docentespdfa[2] . '-contrato.pdf') ) {
    		array_push($files, $rutadocentes . $docentespdfa[2] . '-contrato.pdf');
    		$i++;
    	}

    } else {

	    $row = mysqli_fetch_assoc($q);
	    $docentepdf = normaliza($row[nombre].'_'.$row[apellido].'_'.$row[documento]);

	    if ( file_exists($rutadocentes . $docentepdf . '-cv.pdf') ) {
	    	array_push($files, $rutadocentes . $docentepdf . '-cv.pdf');
	    	$i++;
	    }

	    if ( file_exists($rutadocentes . $docentepdf . '-contrato.pdf') ) {
	    	array_push($files, $rutadocentes . $docentepdf . '-contrato.pdf');
	    	$i++;
	    }

	}


	$q = 'SELECT DISTINCT  e.cif
	FROM mat_alu_cta_emp ma, matriculas m, empresas e
	WHERE ma.id_matricula = m.id
	AND ma.id_empresa = e.id
	AND m.id = '.$id_mat;
	$q = mysqli_query($link, $q);

	if ( mysqli_num_rows($q) > 0 ) {

	    while ( $row = mysqli_fetch_array($q) ) {

	    	if ( file_exists($rutaempresanexo . $row[cif].'-anexo.pdf') ) {
				array_push($files, $rutaempresanexo . $row[cif].'-anexo.pdf');
				$i++;
			}

	    }

	} else {

		$q1 = 'SELECT DISTINCT  e.cif
		FROM ptemp_mat_emp ma, matriculas m, empresas e
		WHERE ma.id_matricula = m.id
		AND ma.id_empresa = e.id
		AND m.id = '.$id_mat;
		$q1 = mysqli_query($link, $q1);

		while ( $rows = mysqli_fetch_array($q1) ) {

	    	if ( file_exists($rutaempresanexo . $rows[cif].'-anexo.pdf') ) {
				array_push($files, $rutaempresanexo . $rows[cif].'-anexo.pdf');
				$i++;
			}

	    }

	}

	if ( file_exists($ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf') ) {
		array_push($files, $ruta . 'requerimiento-' . $naccion.'_'.$ngrupo.'.pdf');
		$i++;
	}

	if ( $modalidad == 'Teleformación' ) {

		if ( file_exists($ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'onlinecert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}

		if ( file_exists($ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'onlinerlt-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}

		$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM empresas e, mat_alu_cta_emp ma
		    WHERE ma.id_empresa = e.id

		    AND ma.id_matricula = '.$id_mat;
		    // echo $q;
		    $q = mysqli_query($link, $q);

		    while ( $row = mysqli_fetch_array($q) ) {

	    		$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
	    		$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}
		    }

	} else if ( $modalidad == 'A Distancia' ) {

		if ( file_exists($ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'distcert-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}

		if ( file_exists($ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'distretorno-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}
		if ( file_exists($ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'distexamen-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}
		if ( file_exists($ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'distcuest-' . $alumno . '-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}
		if ( file_exists($ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
			array_push($files, $ruta . 'distrlt-' . $naccion.'_'.$ngrupo.'.pdf');
			$i++;
		}

		$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM empresas e, mat_alu_cta_emp ma
		    WHERE ma.id_empresa = e.id

		    AND ma.id_matricula = '.$id_mat;
		    // echo $q;
		    $q = mysqli_query($link, $q);

		    while ( $row = mysqli_fetch_array($q) ) {

	    		$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
	    		$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}
		    }

	} else {


		$q = 'SELECT DISTINCT  e.id, e.razonsocial
		    FROM empresas e, mat_alu_cta_emp ma
		    WHERE ma.id_empresa = e.id

		    AND ma.id_matricula = '.$id_mat;
		    // echo $q;
		    $q = mysqli_query($link, $q);

		    while ( $row = mysqli_fetch_array($q) ) {

	    		$emp = quitaTildesConComas(str_replace(' ', '', $row[razonsocial]));
	    		$archivo = $ruta . 'listasist_justif-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}

		    	$archivo = $ruta . 'pmfichas-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}

		    	$archivo = $ruta . 'pmexamenes-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}

		    	$archivo = $ruta . 'pmcuest-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}

		    	$archivo = $ruta . 'pmrlt-' . $emp . '-' . $naccion.'_'.$ngrupo.'.pdf';

		    	if ( file_exists($archivo) ) {
		    		array_push($files, $archivo);
		    		$i++;
		    	}
		    }


		// if ( file_exists($ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf') ) {
		// 	array_push($files, $ruta . 'pmfichasist-' . $naccion.'_'.$ngrupo.'.pdf');
		// 	$i++;
		// }
		// if ( file_exists($ruta . 'pmexamenes-' . $naccion.'_'.$ngrupo.'.pdf') ) {
		// 	array_push($files, $ruta . 'pmexamenes-' . $naccion.'_'.$ngrupo.'.pdf');
		// 	$i++;
		// }
		// if ( file_exists($ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf') ) {
		// 	array_push($files, $ruta . 'pmcuest-' . $naccion.'_'.$ngrupo.'.pdf');
		// 	$i++;
		// }
		// if ( file_exists($ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf') ) {
		// 	array_push($files, $ruta . 'pmrlt-' . $naccion.'_'.$ngrupo.'.pdf');
		// 	$i++;
		// }

	}

	if ( $i > 0 )
		$resul = create_zip($files, $ruta.$naccion.'_'.$ngrupo.'.zip');

	if ( $resul == 1 ) {
		echo ($rutabase.$naccion.'_'.$ngrupo.'.zip');
	}
	else {
		echo "no";
	}

}


?>