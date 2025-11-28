<?

error_reporting(E_ALL);

$baseurl = $_SERVER['DOCUMENT_ROOT'].'/app';
// require_once($baseurl.'/plugins/PHPMailer/PHPMailerAutoload.php');
//
include_once '../../functions/funciones.php';
require_once 'Classes/PHPExcel.php';
require_once 'Classes/PHPExcel/IOFactory.php';

 // print_r(get_included_files());

$rutabasedoc = '/home/edukateccx/www/gestion/app/import'.$gestion.'/doc/';
//echo $rutabasedoc;
$id_mat = $_POST["id_mat"];
$tipo = $_POST["tipo"];

if ( isset($_POST["bonificado"]) )
	$bonificado = $_POST["bonificado"];

$sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad, m.solicitud, a.denominacion, m.*
FROM matriculas m, acciones a, grupos_acciones ga
WHERE m.id_accion = a.id
AND m.id_grupo = ga.id
AND m.id = '.$id_mat;

$sql = mysqli_query($link, $sql);

while ($row = mysqli_fetch_assoc($sql)) {
    $naccion = $row['numeroaccion'];
    $ngrupo = $row['ngrupo'];
    $modalidad = $row['modalidad'];
    $solicitud = $row['solicitud'];
    $denominacion = $row['denominacion'];
    $fechaini = $row['fechaini'];
    $fechafin = $row['fechafin'];
    $externo = $row['externo'];
}


// $ngrupo = 9;
$archivo = $naccion.'-'.$ngrupo.$tipo.$bonificado.'.xlsx';
$inputFileName = '../../import'.$gestion.'/'.$tipo.'/'.$archivo;
$rutabs = $rutabasedoc.$archivo;
 echo $rutabs;


$col = 0;



if ( file_exists($rutabs) ) {


	// $objReader = PHPExcel_IOFactory::createReader('Excel2015');

	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
	// $objPHPExcel = $objReader->load($inputFileName);
	/*
	$objWorksheet = $objPHPExcel->getActiveSheet();

	$highestRow = $objWorksheet->getHighestRow();
	$highestColumn = $objWorksheet->getHighestColumn();
	$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
	$rows = array();
	$rowscheck = array();
	$comaMedio = ', ';



	while ( $objWorksheet->getCellByColumnAndRow($col, $highestRow)->getCalculatedValue() == "" ) {
		$highestRow = $highestRow - 1;
	}

	?>

	<table style="font-size:9px" class="table table-striped">
		<thead>
		<tr>
			<th>Nº</th>
			<th>Apellido 1</th>
			<th>Apellido 2</th>
			<th>Nombre</th>
			<th>NIF/NIE</th>
			<th>NºSS</th>
			<th>Empresa</th>
			<th>CIF</th>
			<th>Cta Cotización</th>
			<th>FechaNac</th>
			<th>Sexo</th>
			<th>Discap.</th>
			<th>Violencia</th>
			<th>Terror.</th>
			<th>Cat. Profe.</th>
			<th>Grupo Cot.</th>
			<th>Estudios</th>
			<th>Email</th>
			<th>Teléfono</th>
		</tr>
		</thead>

	<?

	for ($row = 2; $row <= $highestRow; ++$row) {

		if ($row == $highestRow) $comaMedio = '';
		$values .= '( ';
		$coma = ', ';
		$comaApe = '';

		$numrow = $row - 1;
		echo "<tr>";
		echo '<td>'. $numrow . '</td>';
		for ($col = 0; $col <= 17; ++$col) {


		  	if ( PHPExcel_Shared_Date::isDateTime($objWorksheet->getCellByColumnAndRow($col, $row) ) && ($objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue()) != "" ) {

		    	$rows[$col] = PHPExcel_Shared_Date::ExcelToPHPObject($objWorksheet->getCellByColumnAndRow($col, $row)->getValue())->format('Y-m-d');

		    } else {

				$rows[$col] = trim($objWorksheet->getCellByColumnAndRow($col, $row)->getCalculatedValue());

		    }

		    	if ( $col == '0' ) $rows[0] = mb_strtoupper($rows[0], 'UTF-8');
			    if ( $col == '1' ) $rows[1] = mb_strtoupper($rows[1], 'UTF-8');
			    if ( $col == '2' ) $rows[2] = mb_strtoupper($rows[2], 'UTF-8');

			    if ( $col == '3') {


					// CHECK DNI/NIE
				// 	if ( strlen($rows[3]) != 9 )
				// 		$errores .= "<br>"."El campo 'NIF/NIE' debe tener una longitud de 9 caractéres"." Fila: ".($row-1);


				// 	$errordni = valida_nif_cif_nie($rows[3]);

				// 	if ( $errordni == 0 ) $errores .= "<br>"."El campo 'NIF/NIE' tiene un formato NO válido (Ej. 12345678W)."." Fila: ".($row-1);
				// 	if ( $errordni == -1 ) $errores .= "<br>"."La letra del campo 'NIF' NO es correcta."." Fila: ".($row-1);
				// 	if ( $errordni == -3 ) $errores .= "<br>"."La letra del campo 'NIE' NO es correcta."." Fila: ".($row-1);
				}

				if ( $col == '4' ) {

					$rows[4] = preg_replace('/[^a-zA-Z0-9]/','',$rows[4]);

					// CHECK NUMERO DE LA SEGURIDAD SOCIAL
				// 	if ( strlen($rows[4]) == 12 || strlen($rows[4]) == 14 ) {

				// 		if ( substr($rows[4],2,1) == 0 && substr($rows[4],3,1) == 0 )
				// 			$rows[4] = substr($rows[4], 0, 2) . substr($rows[4], 4);
				// 		else
				// 			$rows[4] = substr($rows[4], 0, 12);

				// 	} else if ( strlen($rows[4]) == 11 && (substr($rows[4], 0, 2) != 38 || substr($rows[4], 0, 2) != 35)) {

				// 		$rows[4] = "0".$rows[4];

				// 	} else
				// 		$errores .= "<br>"."El campo 'seguridad social' debe tener una longitud de 12 o 14 dígitos."." Fila: ".($row-1);
				}

			    if ( $col == '5' ) $rows[5] = strtoupper($rows[5]);

			    if ( $col == '6' ) {
					$rows[6] = preg_replace('/[^a-zA-Z0-9]/','',$rows[6]);

						// if ( $rows[6] != "CIF" ) {
					// echo "<br>".$rows[6]."<br>";

					$q = 'SELECT e.cif
					FROM empresas e, ptemp_mat_emp pt
					WHERE pt.id_empresa = e.id
					AND pt.id_matricula = '.$id_mat.'
					AND e.cif = "'.$rows[6].'"';
					// echo $q;
					$q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

					$rowx = mysqli_fetch_array($q);

					if ( mysqli_num_rows($q) == 0 ) {
					  	$errores .= '<p style="font-size:16px;color:red;margin-left:15px;"> La empresa con CIF '.$rows[6].' no está notificada en el inicio.</p><br>';
					  	$rows[6] = '<span style="color:red">'.$rows[6].'</span>';
					  	$cifs .= $rows[6].' / ';
					} else {
						$rows[6] = $rows[6];
					}


					// CHECK DNI/NIE
				// 	if ( strlen($rows[6]) != 9 )
				// 		$errores .= "<br>"."El campo 'CIF' debe tener una longitud de 9 caractéres"." Fila: ".($row-1);

				// 	$errorcif = valida_nif_cif_nie($rows[6]);

				// 	if ( $errorcif == 0 ) $errores .= "<br>"."El campo 'CIF' tiene un formato NO válido (Ej. 12345678W)."." Fila: ".($row-1);
				// 	if ( $errorcif == -2 ) $errores .= "<br>"."La letra del campo 'CIF NO es correcta."." Fila: ".($row-1);
				// 	if ( $errorcif == -3 ) $errores .= "<br>"."La letra del campo 'CIF NO es correcta."." Fila: ".($row-1);
				}

				if ( $col == '7' ) {

					$rows[7] = preg_replace('/[^0-9]/','', $rows[7]);

					// CHECK CUENTA DE COTIZACION
				// 	if ( strlen($rows[7]) == 10 ) { // si son 10

				// 		if ( substr($rows[7],2,1) == 0 ) // y el 3ero es 0
				// 			$rows[7] = substr($rows[7], 0, 2) . substr($rows[7], 3); // lo quito y me quedo con el resto
				// 		else
				// 			$rows[7] = substr($rows[7], 0, 9); // si no es 0, quito el ultimo

				// 	} else if ( strlen($rows[7]) == 11 ) {  // si son 11

				// 		if ( substr($rows[7],2,1) == 0 && substr($rows[7],3,1) == 0 )  // y 3ro y 4o son ceros
				// 			$rows[7] = substr($rows[7],0,2) . substr($rows[7],4); // los quito y me quedo con el resto
				// 		else
				// 			$rows[7] = substr($rows[7],0,9); // si no son 0, me quedo con los 9 primeros

				// 	} else if ( strlen($rows[7]) == 8 && (substr($rows[7], 0, 2) != 38 || substr($rows[7], 0, 2) != 35) ) {

				// 		// si son 8 y los dos primeros son 35 o 38, entonces falta un 0 al principio
				// 		$rows[7] = "0".$rows[7];

				// 	} else
				// 		$errores .= "<br>"."El campo 'cuenta cotización' debe tener una longitud de 9 u 11 dígitos."." Fila: ".($row-1);

				}


				// if ( $col == 8 ) {
				// 	if ( !PHPExcel_Shared_Date::isDateTime($objWorksheet->getCellByColumnAndRow($col, $row) ) )
				// 		$errores .= "<br>"."El campo 'FechaNac' debe tener formato 'fecha' en Excel."." Fila: ".($row-1);

				// }

				// if ( $col == '13' ) {
				// 	// comprobar si es numero
				// 	if ( !is_numeric($rows[13]) || strlen($rows[13]) > 2 )
				// 		$errores .= "<br>"."El campo 'categoría profesional' debe ser un único número entero."." Fila: ".($row-1);

				// 	if ( $rows[13] < $min || $rows[13] > $maxCat )
				// 		$errores .= "<br>"."El campo 'categoría profesional' debe estar comprendido entre ".$min."-".$maxCat." Fila: ".($row-1);
				// }

				// if ( $col == 14 ) {
				// 	if ( !is_numeric($rows[14]) || strlen($rows[14]) > 2 )
				// 		$errores .= "<br>"."El campo 'grupo cotización' debe ser un único número entero."." Fila: ".($row-1);
				// 	if ( $rows[14] < $min || $rows[14] > $maxCot )
				// 		$errores .= "<br>"."El campo 'grupo cotización' debe estar comprendido entre ".$min."-".$maxCot." Fila: ".($row-1);
				// }

				// if ( $col == 15 ) {
				// 	if ( !is_numeric($rows[15]) || strlen($rows[15]) > 2 )
				// 		$errores .= "<br>"."El campo 'estudios' debe ser un único número entero."." Fila: ".($row-1);
				// 	if ( $rows[15] < $min || $rows[15] > $maxEstu )
				// 		$errores .= "<br>"."El campo 'categoría profesional' debe estar comprendido entre ".$min."-".$maxEstu." Fila: ".($row-1);
				// }

			    echo '<td>'.trim($rows[$col]).'</td>';
			    //$apellidos = explode(" ", $rows[0]);

			    // if ($col == '0')
			    // 	$comaApe = ', ';
			    if ( $col == '17' )
			    	$coma = '';
			    $values .= '"'.$rows[$col].'"'.$coma;

			    if ( $col == '3' )
			    	$values .= '"'.nifonie($rows[$col]).'"'.$coma;
		}

		echo "</tr>";

		// $values .= ')'.$comaMedio;
		$values .= ', '.$id_mat.')'.$comaMedio;
	}
	// ?>			</tbody>
	</table>


	<?
	echo $errores;

	if ( strlen($errores) >= 1 ) {
		//enviarMailNotif($naccion, $ngrupo, 'aviso_excel_bonif', $link, $cifs);
		return false;
	}

	$q = 'DELETE FROM importar_temporal WHERE 1';
	$q = mysqli_query($link,$q);

	// $q = 'INSERT INTO importar_temporal
	// (apellido, apellido2, nombre, documento, tipodocumento, niss, razonsocial, cif, cuentacotizacion, fechanac, sexo, discapacidad, afectadosviolenciagenero, afectadosterrorismo, categoriaprofesional, grupocotizacion, nivelestudios, id_matricula)
	// VALUES '.$values;
	$q = 'INSERT INTO importar_temporal
	(apellido, apellido2, nombre, documento, tipodocumento, niss, razonsocial, cif, cuentacotizacion, fechanac, sexo, discapacidad, afectadosviolenciagenero, afectadosterrorismo, categoriaprofesional, grupocotizacion, nivelestudios, email, telefono, id_matricula)
	VALUES '.$values;
	// echo $q;
	$q = mysqli_query($link,$q);
	$insertados = mysqli_affected_rows($link);
	echo "<br>";
	echo '<span style="margin-left:5px"> Filas insertadas: </span>'.$insertados;
	echo "<br>";


	$q = 'DELETE FROM temp_alumnos WHERE id_matricula = '.$id_mat;
	// $q = 'DELETE FROM temp_alumnos WHERE id_matricula = '.$id_mat;
	$q = mysqli_query($link,$q) or die('error: '.mysqli_error($link) );
	$q = 'DELETE FROM temp_empresas WHERE id_matricula = '.$id_mat;
	// $q = 'DELETE FROM temp_empresas WHERE id_matricula = '.$id_mat;
	$q = mysqli_query($link,$q) or die('error: '.mysqli_error($link) );


	$q = 'INSERT IGNORE INTO temp_empresas
	(`razonsocial`, `cif`, `id_matricula` )
	SELECT   `razonsocial`, `cif`, '.$id_mat.'
	FROM  `importar_temporal` it
	GROUP BY cif';

	// $q = 'INSERT INTO temp_empresas
	// (`razonsocial`, `cif` )
	// SELECT   `razonsocial`, `cif`
	// FROM  `importar_temporal` it';
	//echo $q;
	$q = mysqli_query($link, $q) or die('error: '.mysqli_error($link) );


	$q = 'INSERT IGNORE INTO temp_alumnos
	(`nombre`, `apellido`, `apellido2`, `documento`, `tipodocumento`, `niss`, `fechanac`, `sexo`, `discapacidad`, `afectadosviolenciagenero`, `afectadosterrorismo`, `categoriaprofesional`, `grupocotizacion`, `nivelestudios`, `cuentacotizacion`, `email`, `telefono`, `id_empresa`, `id_matricula`)
	SELECT  `nombre`, `apellido`, `apellido2`, `documento`, `tipodocumento`, `niss`, `fechanac`, `sexo`, `discapacidad`, `afectadosviolenciagenero`, `afectadosterrorismo`, `categoriaprofesional`, `grupocotizacion`, `nivelestudios`, `cuentacotizacion`, it.email, it.telefono, e.id, '.$id_mat.'
	FROM importar_temporal it, temp_empresas e
	WHERE it.cif = e.cif
	AND it.id_matricula = e.id_matricula';

	// $q = 'INSERT INTO temp_alumnos
	// (`nombre`, `apellido`, `apellido2`, `documento`, `tipodocumento`, `niss`, `fechanac`, `sexo`, `discapacidad`, `afectadosviolenciagenero`, `afectadosterrorismo`, `categoriaprofesional`, `grupocotizacion`, `nivelestudios`, `cuentacotizacion`, `id_empresa`, `telefono`, `email`)
	// SELECT  `nombre`, `apellido`, `apellido2`, `documento`, `tipodocumento`, `niss`, `fechanac`, `sexo`, `discapacidad`, `afectadosviolenciagenero`, `afectadosterrorismo`, `categoriaprofesional`, `grupocotizacion`, `nivelestudios`, `cuentacotizacion`, e.id, it.telefono, it.email
	// FROM importar_temporal it, temp_empresas e
	// WHERE it.cif = e.cif
	// AND it.razonsocial = e.razonsocial';
	//echo $q;
	$q = mysqli_query($link, $q) or die('error: '.mysqli_error($link) );


	$fecha = date('Y-m-d');
	if ( strpos($solicitud, 'IK') !== FALSE && $fecha <= $fechafin ) {

		// echo "envioMailIKEA";
		envioMailIKEA('', '','ikea_documentacion', $link, $id_mat);

	} else if ( $externo != "" && $fecha <= $fechafin ) {

		envioMailExterno('', '', 'ext_documentacion', $link, $id_mat);
	}

} else {

	echo "no";
}

*/

?>
