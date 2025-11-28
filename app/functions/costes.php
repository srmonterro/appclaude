<?

include_once './funciones.php';

if ($_POST['devuelve'] == '1') {

	devuelveDatosCostes($_POST['id_mat'], $link);

} else if ($_POST['salariominimo'] == '1') {

    calculaConSalarioMinimo($_POST['id_mat'], $_POST['id_emp'], $link);

} else if ($_POST['devuelve'] == '2') {

    devuelveDatosCostesPre($_POST['id_mat'], $_POST['id_emp'], $link);

} else if ($_POST['devuelve'] == '3') {

    devuelveDatosCostesPrePrivado($_POST['id_mat'], $_POST['id_emp'], $link);

} else if ($_POST['calculomax'] == '1') {

	calculoMaximoBonificable($_POST['id_mat'], $link);

} else if ($_POST['guardarcostes'] == '1') {

	guardarCostes($_POST, $link);

} else if ($_POST['guardarcostes'] == '2') {

    guardarCostesPre($_POST, $link);

} else if ($_POST['guardarcostes'] == '3') {

    guardarCostesPrivado($_POST, $link);

} else if ($_POST['comprueba'] == '1') {

    compruebaCampos($_POST['id_mat'], $link);

} else if ($_POST['comprueba'] == '2') {

	compruebaCamposPre($_POST['id_mat'], $_POST['id_emp'], $link);

} else if ($_POST['guardardatoscostes'] == '1') {

	guardarDatosCostes($_POST, $link);

} else if ($_POST['guardardatoscostes'] == '2') {

    guardarDatosCostesPre($_POST, $id_emp, $link);

} else if ($_POST['guardadetalleotros'] == '1') {

    guardaDetalleOtros($_POST['valores'], $link);

}


function guardaDetalleOtros($valores, $link) {


    $coma = ",";
    for ($i=0; $i < count($valores); $i++) {

        if ( $i < count($valores)-1 ) $coma = "";
        $insertar .= '(';
        $insertar .= $valores[$i];
        $insertar .= ')'.$coma;

    }

    $q = 'UPDATE costes_rentabilidad SET detalleotros = "'.$valores.'"';
    mysqli_query($link, $q) or die("error");

}

function calculaConSalarioMinimo($id_mat, $id_emp, $link) {

    $q = 'SELECT count(mp.id_alumno) as cuenta, a.horastotales
    FROM mat_alu_cta_emp mp, empresas e, matriculas m, acciones a
    WHERE e.id = mp.id_empresa
    AND m.id = mp.id_matricula
    AND m.id_accion = a.id
    AND mp.finalizado = 1
    AND mp.tipo = ""
    AND mp.id_matricula = '.$id_mat.'
    AND mp.id_empresa = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link, $q);
    while ($r = mysqli_fetch_assoc($q)) {
        $nparticipantes = $r[cuenta];
        $nhoras = $r[horastotales];
    }
    // echo $nparticipantes;
    echo ($nhoras * $nparticipantes * 4.62);

}

function guardarDatosCostesPre($datos, $id_emp, $link) {

    $table_name = 'empresas';

    foreach ($datos as $clave => $valor)
        $valores[$clave] = $valor;

    $id_matricula = $valores['id_matricula'];
    $id_accion = $valores['id_accion'];
    $id_emp = $valores['id_emp'];
    unset($valores['id_accion']);
    unset($valores['metodo']);
    unset($valores['id_matricula']);
    unset($valores['guardardatoscostes']);
    unset($valores['id_emp']);
    unset($valores['observacionesfin']);


    $sql = 'UPDATE '.$table_name.' SET ';
    $c = count($valores);
    $coma = ", ";

    foreach ($valores as $key => $value) {
        if (++$i === $c)
            $coma = "";
        $sql .= $key .' = '.'"'.$value.'"'.$coma;
    }

    $sql .= ' WHERE id = '.$id_emp;
    // echo $sql;
    $sql = mysqli_query($link, $sql) or die("error:" . mysqli_error($link));

    // formula: coste_salarial = nhoras x participantes x coste hora trabajador

    $q = 'SELECT plantillamedia,horasmediasano,cuotaformprof
    FROM empresas WHERE id = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_assoc($q);
    $plantillamedia = $row['plantillamedia'];
    $horasmediasano = $row['horasmediasano'];
    $cuotaformprof = $row['cuotaformprof'];

    $q = 'SELECT count(mp.id_alumno) FROM
    mat_alu_cta_emp mp, empresas e
    WHERE e.id = mp.id_empresa
    AND mp.finalizado = 1
    AND mp.tipo = ""
    AND mp.id_matricula = '.$id_matricula.'
    AND mp.id_empresa = '.$id_emp;
    // echo $q;
    $q = mysqli_query($link, $q);
    $nparticipantes = mysqli_fetch_row($q);
    $nparticipantes = $nparticipantes[0];
    // echo "participantes: ".$nparticipantes;


    $q = 'SELECT horastotales
    FROM acciones WHERE id = '.$id_accion;
    // echo $q;
    $q = mysqli_query($link, $q);
    $nhoras = mysqli_fetch_row($q);
    $nhoras = $nhoras[0];

    $totalsueldoanual = $cuotaformprof * 100 / 0.7;
    // echo $totalsueldoanual."-";
    $totalssanual = $totalsueldoanual * 0.32;
    // echo $totalssanual.'-';
    $costehoratrabajador =  ($totalsueldoanual + $totalssanual)/($horasmediasano * $plantillamedia);
    // echo $costehoratrabajador."-";
    $costes_salariales = number_format($nhoras * $nparticipantes * $costehoratrabajador,2);
    echo $costes_salariales;
}

function guardardatoscostes($datos, $link) {

	$table_name = 'empresas';
    // echo "entra";

	foreach ($datos as $clave => $valor)
		$valores[$clave] = $valor;

	$id_matricula = $valores['id_matricula'];
	$id_accion = $valores['id_accion'];
	unset($valores['id_accion']);
	unset($valores['id_matricula']);
	unset($valores['guardardatoscostes']);

	$q = 'SELECT id_empresa FROM
	mat_alu_cta_emp WHERE id_matricula = '.$id_matricula;
	$q = mysqli_query($link, $q);
	$id_empresa = mysqli_fetch_row($q);

	$sql = 'UPDATE '.$table_name.' SET ';
	$c = count($valores);
	$coma = ", ";

	foreach ($valores as $key => $value) {
		if (++$i === $c)
			$coma = "";
		$sql .= $key .' = '.'"'.$value.'"'.$coma;
	}

	$sql .= ' WHERE id = '.$id_empresa[0];
	// echo $sql;
	$sql = mysqli_query($link, $sql);

	// formula: coste_salarial = nhoras x participantes x coste hora trabajador

	$q = 'SELECT plantillamedia,horasmediasano,cuotaformprof
	FROM empresas WHERE id = '.$id_empresa[0];
	$q = mysqli_query($link, $q);
	$row = mysqli_fetch_assoc($q);
	$plantillamedia = $row['plantillamedia'];
	$horasmediasano = $row['horasmediasano'];
	$cuotaformprof = $row['cuotaformprof'];


	$q = 'SELECT horastotales
	FROM acciones WHERE id = '.$id_accion;
	$q = mysqli_query($link, $q);
	$nhoras = mysqli_fetch_row($q);
	$nhoras = $nhoras[0];

	$nparticipantes = 1; // en principio
	$totalsueldoanual = $cuotaformprof * 100 / 0.7;
	$totalssanual = $totalsueldoanual * 0.32;
	$costehoratrabajador =  ($totalsueldoanual + $totalssanual)/($horasmediasano * $plantillamedia);

	$costes_salariales = number_format($nhoras * $nparticipantes * $costehoratrabajador,2);
	echo $costes_salariales;
}

function guardarCostesPrivado ($datos, $link) {

	$table_name = 'mat_costes';
    foreach ($datos as $clave => $valor)
        $valores[$clave] = $valor;

    $id_coste = $valores['id_coste'];
    $id_matricula = $valores['id_matricula'];
    $id_emp = $valores['id_emp'];
    $observacionesfin = $valores['observacionesfin'];

    unset($valores['id_coste']);
    unset($valores['id_matricula']);
    unset($valores['guardarcostes']);
    unset($valores['metodo']);
    unset($valores['id_emp']);
    unset($valores['costes_ind']);
    unset($valores['observacionesfin']);

    $fields = array_keys($valores);

    $sql = 'SELECT DISTINCT a.numeroaccion, ga.ngrupo, a.modalidad, m.solicitud
	FROM matriculas m, acciones a, grupos_acciones ga, mat_alu_cta_emp ma
	WHERE m.id_accion = a.id
	AND m.id_grupo = ga.id
    AND ma.id_matricula = m.id
    AND ma.tipo = "Privado"
	AND m.id = '.$id_matricula;
	$sql = mysqli_query($link, $sql);

	while ($row = mysqli_fetch_assoc($sql)) {
	    $naccion = $row['numeroaccion'];
	    $ngrupo = $row['ngrupo'];
	    $modalidad = $row['modalidad'];
	}

    if ($id_coste != "0") {

        //$fields = array_keys($valores);
        $sql = 'UPDATE '.$table_name.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }

        $sql .= ' WHERE id ='.$id_coste;
        echo $sql;
        $sql = mysqli_query($link, $sql);

        $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        $sql = mysqli_query($link, $sql);

        $ngrupo .= "-".$id_emp;
        if ( $valores['costes_imparticion'] != 0 ) {

            if ( $modalidad == 'Presencial' || $modalidad == 'Mixta' )
        	   enviarMailNotif($naccion, $ngrupo, 'pm-modfinp', $link, '', $_SESSION[user]);
            else
               enviarMailNotif($naccion, $ngrupo, 'td-modfinpgrupo', $link, '', $_SESSION[user]);

       }


    } else if ($id_coste == "0") {

         $sql = "INSERT INTO ".$table_name."
        (`".implode('`,`', $fields)."`,`id_matricula`, `id_empresa`)
        VALUES('".implode("','", $valores)."','".$id_matricula."','".$id_emp."')";
        //echo $sql;
        $sql = mysqli_query($link, $sql);

        $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        $sql = mysqli_query($link, $sql);

        $ngrupo .= "-".$id_emp;

        if ( $valores['costes_imparticion'] != 0 ) {

            if ( $modalidad == 'Presencial' || $modalidad == 'Mixta' )
               enviarMailNotif($naccion, $ngrupo, 'pm-finp', $link, '', $_SESSION[user]);
            else
               enviarMailNotif($naccion, $ngrupo, 'td-finpgrupo', $link, '', $_SESSION[user]);

        }

    }

}

function guardarCostes($datos, $link) {

	$table_name = 'mat_costes';
	foreach ($datos as $clave => $valor)
		$valores[$clave] = $valor;

	$id_coste = $valores['id_coste'];
	$id_matricula = $valores['id_matricula'];
    // $observacionesfin = $valores['observacionesfin'];

	unset($valores['id_coste']);
	unset($valores['id_matricula']);
	unset($valores['guardarcostes']);
	unset($valores['metodo']);
    $tipofra = $valores[tipofra];
    unset($valores['tipofra']);

    if ( $valores[igic] == "" || $valores[igic] === NULL )
        unset($valores[igic]);

    $q = 'UPDATE matriculas SET tipofra = "'.$tipofra.'" WHERE id = '.$id_matricula;
    $q = mysqli_query($link, $q) or die("error ". mysqli_error($link) );

	$fields = array_keys($valores);


	$q = 'SELECT id_empresa FROM
	mat_alu_cta_emp WHERE id_matricula = '.$id_matricula;
	$q = mysqli_query($link, $q);
	$id_empresa = mysqli_fetch_row($q);


	if ($id_coste != "0") {

	    //$fields = array_keys($valores);
		$sql = 'UPDATE '.$table_name.' SET ';
		$c = count($valores);
		$coma = ", ";

		foreach ($valores as $key => $value) {
			if (++$i === $c)
				$coma = "";
			$sql .= $key .' = '.'"'.$value.'"'.$coma;
		}

		$sql .= ' WHERE id ='.$id_coste;
		echo $sql;
		$sql = mysqli_query($link, $sql);

        // $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        // $sql = mysqli_query($link, $sql);

	} else if ($id_coste == "0") {

		 $sql = "INSERT INTO ".$table_name."
	    (`".implode('`,`', $fields)."`,`id_matricula`, `id_empresa`)
	    VALUES('".implode("','", $valores)."','".$id_matricula."','".$id_empresa[0]."')";
		echo $sql;
		$sql = mysqli_query($link, $sql);

        // $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        // $sql = mysqli_query($link, $sql);
	}

}

function guardarCostesPre($datos, $link) {

    $table_name = 'mat_costes';
    foreach ($datos as $clave => $valor)
        $valores[$clave] = $valor;

    print_r($valores);
    $id_coste = $valores['id_coste'];
    $id_matricula = $valores['id_matricula'];
    $id_emp = $valores['id_emp'];
    $observacionesfin = $valores['observacionesfin'];

    unset($valores['id_coste']);
    unset($valores['id_matricula']);
    unset($valores['guardarcostes']);
    unset($valores['metodo']);
    unset($valores['id_emp']);
    unset($valores['costes_ind']);
    unset($valores['observacionesfin']);
    unset($valores['plantillamedia']);
    if ( $valores[igic] == "" || $valores[igic] === NULL )
        unset($valores[igic]);

    $fields = array_keys($valores);

    if ($id_coste != "0") {

        //$fields = array_keys($valores);
        $sql = 'UPDATE '.$table_name.' SET ';
        $c = count($valores);
        $coma = ", ";

        foreach ($valores as $key => $value) {
            if (++$i === $c)
                $coma = "";
            $sql .= $key .' = '.'"'.$value.'"'.$coma;
        }

        $sql .= ' WHERE id ='.$id_coste;
        echo $sql;
        $sql = mysqli_query($link, $sql);

        $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die("error" . mysqli_error($link));

    } else if ($id_coste == "0") {

         $sql = "INSERT INTO ".$table_name."
        (`".implode('`,`', $fields)."`,`id_matricula`, `id_empresa`)
        VALUES('".implode("','", $valores)."','".$id_matricula."','".$id_emp."')";
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die("error" . mysqli_error($link));

        $sql = 'UPDATE matriculas SET observacionesfin = "'.addslashes($observacionesfin).'" WHERE id = '.$id_matricula;
        // echo $sql;
        $sql = mysqli_query($link, $sql) or die("error" . mysqli_error($link));
    }


    // $q = 'SELECT a.numeroaccion, ga.ngrupo, e.razonsocial
    // FROM empresas e, mat_alu_cta_emp ma, matriculas m, acciones a, grupos_acciones ga
    // WHERE e.id = ma.id_empresa
    // AND m.id = ma.id_matricula
    // AND m.id_grupo = ga.id
    // AND m.id_accion = a.id
    // AND ma.tipo = ""
    // AND m.id = "'.$id_matricula.'"
    // AND e.id = "'.$id_emp.'"';
    // $q = mysqli_query($link, $q) or die("error" . mysqli_error($link));

    // $row = mysqli_fetch_array($q);

    // enviarMailNotif($row[numeroaccion], $row[ngrupo], 'costes_actualizados', $link, $row[razonsocial], $_SESSION[user]);

}


function compruebaCampos( $id_mat, $link ) {

	$q = 'SELECT horasmediasano,cuotaformprof,plantillamedia
	FROM empresas e, mat_alu_cta_emp ma
	WHERE ma.id_empresa = e.id
    AND ma.finalizado = 1
	AND ma.id_matricula = '.$id_mat;
	$q = mysqli_query($link, $q);

	while($r = mysqli_fetch_assoc($q)) {
		$rows[] = $r;
	}

	echo json_encode($rows);
}

function compruebaCamposPre( $id_mat, $id_emp, $link ) {

    $q = 'SELECT DISTINCT horasmediasano,cuotaformprof,plantillamedia
    FROM empresas e, mat_alu_cta_emp ma
    WHERE ma.id_empresa = e.id
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = '.$id_emp;
    $q = mysqli_query($link, $q);

    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }

    echo json_encode($rows);
}

function devuelveDatosCostes ($id_mat, $link) {

	$q = 'SELECT id_empresa, razonsocial, porcentajecof, ma.id_matricula
	FROM mat_alu_cta_emp ma, empresas e
	WHERE e.id = ma.id_empresa
	AND ma.id_matricula = '.$id_mat;
	$q = mysqli_query($link, $q);
	$id_emp = '';
	while($r = mysqli_fetch_assoc($q)) {
		$id_emp = $r['id_empresa'];
    	$rows[] = $r;
	}

	$q = 'SELECT mc.*, m.tipofra
	FROM mat_costes mc, empresas e, matriculas m
	WHERE mc.id_empresa = e.id
    AND m.id = mc.id_matricula
	AND mc.id_empresa = '.$id_emp.'
	AND mc.id_matricula = '.$id_mat;
	//echo $q;
	$q = mysqli_query($link, $q);

	if (mysqli_num_rows($q) > 0) {

		while($r = mysqli_fetch_assoc($q)) {
	    	$rows[] = $r;
		}

	} else {

		$max_bonificable['maximo_bonificable'] = calculoMaximoBonificable($id_mat, $link);
		$rows[] = $max_bonificable;
		$q = 'SELECT fechafin FROM matriculas m
		WHERE m.id = '.$id_mat;
		$q = mysqli_query($link, $q);

		$row = mysqli_fetch_row($q);
        // echo $row[0];
		$fecha = explode("-", $row[0]);
		$mes = $fecha[1];
		if ( $mes[0] == "0" )
			$mes = $mes[1];
		$mmes['mes_bonificable'] = $mes;
		$rows[] = $mmes;
	}

	echo json_encode($rows);
}

function devuelveDatosCostesPre ($id_mat, $id_emp, $link) {

    $q = 'SELECT DISTINCT id_empresa, razonsocial, porcentajecof, plantillamedia
    FROM mat_alu_cta_emp ma, empresas e
    WHERE e.id = ma.id_empresa
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = '.$id_emp;

    $q = mysqli_query($link, $q);
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }

    $q = 'SELECT mc.*
    FROM mat_costes mc, empresas e
    WHERE mc.id_empresa = e.id
    AND mc.id_empresa = '.$id_emp.'
    AND mc.id_matricula = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q);

    if (mysqli_num_rows($q) > 0) {

        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }

    } else {

        $max_bonificable['maximo_bonificable'] = calculoMaximoBonificablePre($id_mat, $id_emp, $link);
        $rows[] = $max_bonificable;
        $q = 'SELECT fechafin FROM matriculas m
        WHERE m.id = '.$id_mat;
        $q = mysqli_query($link, $q);

        $row = mysqli_fetch_row($q);
        // echo $row[0];
        $fecha = explode("-", $row[0]);

        $mes = $fecha[1];
        if ( $mes[0] == "0" )
            $mes = $mes[1];
        $mmes['mes_bonificable'] = $mes;
        $rows[] = $mmes;
    }

    $q = 'SELECT DISTINCT count(*)
    FROM mat_alu_cta_emp ma, empresas e, alumnos a
    WHERE e.id = ma.id_empresa
    AND a.id = ma.id_alumno
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = '.$id_emp.'
    AND ma.tipo = ""';
    // echo $q;
    $q = mysqli_query($link, $q);
    $ntrabajadores = mysqli_fetch_row($q);
    $rows[ntrabajadores] = $ntrabajadores[0];

    echo json_encode($rows);
}


function devuelveDatosCostesPrePrivado ($id_mat, $id_emp, $link) {

    $q = 'SELECT DISTINCT id_empresa, razonsocial, porcentajecof
    FROM mat_alu_cta_emp ma, empresas e
    WHERE e.id = ma.id_empresa
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = '.$id_emp.'
    AND ma.tipo IN("Privado")';

    $q = mysqli_query($link, $q);
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }

    $q = 'SELECT mc.*
    FROM mat_costes mc, empresas e
    WHERE mc.id_empresa = e.id
    AND mc.mes_bonificable = 0
    AND mc.id_empresa = '.$id_emp.'
    AND mc.id_matricula = '.$id_mat;
    // echo $q;
    $q = mysqli_query($link, $q);

    if (mysqli_num_rows($q) > 0) {

        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }

    }

    $q = 'SELECT DISTINCT count(*)
    FROM mat_alu_cta_emp ma, empresas e, alumnos a
    WHERE e.id = ma.id_empresa
    AND a.id = ma.id_alumno
    AND ma.finalizado = 1
    AND ma.id_matricula = '.$id_mat.'
    AND ma.id_empresa = '.$id_emp.'
    AND ma.tipo IN("Privado")';
    $q = mysqli_query($link, $q);
    $ntrabajadores = mysqli_fetch_row($q);
    $rows[ntrabajadores] = $ntrabajadores[0];

    echo json_encode($rows);
}



function calculoMaximoBonificable($id_mat, $link) {

	$q = 'SELECT id_empresa FROM mat_alu_cta_emp
    WHERE id_matricula = '.$id_mat;
    $q = mysqli_query($link, $q);
	$id_emp = mysqli_fetch_row($q);

	$q = 'SELECT modalidad, nivel, horastotales
	FROM acciones a, matriculas m
	WHERE m.id_accion = a.id
	AND m.id = '.$id_mat;
	$q = mysqli_query($link, $q);
	$row = mysqli_fetch_assoc($q);
	$modalidad = $row['modalidad'];
	$nivel = $row['nivel'];
	$horastotales = $row['horastotales'];

	$q = 'SELECT plantillamedia
	FROM empresas e
	WHERE e.id = '.$id_emp[0];
	$q = mysqli_query($link, $q);
	$plantillamedia = mysqli_fetch_row($q);
	$plantillamedia = $plantillamedia[0];

	$importe = "";

	switch ($plantillamedia) {
		case ($plantillamedia >= 250):

			if ($modalidad == "Presencial") {
				if ($nivel == "Básica")
					$importe = "9";
				else if ($nivel == "Superior")
					$importe = "13";
			}
			else if ($modalidad == "Teleformación")
				$importe = "7.50";
			else if ($modalidad == "A Distancia")
			  	$importe = "5.50";

			break;

		case ($plantillamedia >= 50 && $plantillamedia <= 249 ):

			if ($modalidad == "Presencial") {
				if ($nivel == "Básica")
					$importe = "9";
				else if ($nivel == "Superior")
					$importe = "13";
			}
			else if ($modalidad == "Teleformación")
				$importe = "7.50";
			else if ($modalidad == "A Distancia")
			  	$importe = "5.50";

			break;

		case ($plantillamedia >= 10 && $plantillamedia <= 49 ):

			if ($modalidad == "Presencial") {
				if ($nivel == "Básica")
					$importe = "9";
				else if ($nivel == "Superior")
					$importe = "13";
			}
			else if ($modalidad == "Teleformación")
				$importe = "7.50";
			else if ($modalidad == "A Distancia")
			  	$importe = "5.50";

			break;

        case ($plantillamedia < 10 ):

            if ($modalidad == "Presencial") {
                if ($nivel == "Básica")
                    $importe = "9";
                else if ($nivel == "Superior")
                    $importe = "13";
            }
            else if ($modalidad == "Teleformación")
                $importe = "7.5";
            else if ($modalidad == "A Distancia")
                $importe = "5.5";

            break;

		default:
			$importe = "";
			break;
	}
		 // echo 'max bonificable = '.$importe.' * '.$horastotales.' * '.$nalumnos[0];
	return $max_bonificable = $importe * $horastotales; // numero de participantes, 1 * matricula

}

function calculoMaximoBonificablePre($id_mat, $id_emp, $link) {

    $q = 'SELECT count(mp.id_alumno) FROM
    mat_alu_cta_emp mp, empresas e
    WHERE e.id = mp.id_empresa
    AND mp.finalizado = 1
    AND mp.tipo = ""
    AND mp.id_matricula = '.$id_mat.'
    AND mp.id_empresa = '.$id_emp;
    $q = mysqli_query($link, $q);
    $nalumnos = mysqli_fetch_row($q);

    $q = 'SELECT modalidad, nivel, horastotales
    FROM acciones a, matriculas m
    WHERE m.id_accion = a.id
    AND m.id = '.$id_mat;
    $q = mysqli_query($link, $q);
    $row = mysqli_fetch_assoc($q);
    $modalidad = $row['modalidad'];
    $nivel = $row['nivel'];
    $horastotales = $row['horastotales'];

    $q = 'SELECT plantillamedia
    FROM empresas e
    WHERE e.id = '.$id_emp;
    $q = mysqli_query($link, $q);
    $plantillamedia = mysqli_fetch_row($q);
    $plantillamedia = $plantillamedia[0];
    // echo "plantilla: ".$plantillamedia;
    $importe = "";
    // echo $modalidad;
    switch ($plantillamedia) {
        case ($plantillamedia >= 250):

            // echo "entra<br>";
            if ($modalidad == "Presencial") {
                if ($nivel == "Básica")
                    $importe = "9";
                else if ($nivel == "Superior")
                    $importe = "13";
            }
            else if ($modalidad == "Teleformación")
                $importe = "7.50";
            else if ($modalidad == "A Distancia")
                $importe = "5.50";

            break;

        case ($plantillamedia >= 50 && $plantillamedia <= 249 ):

            if ($modalidad == "Presencial") {
                if ($nivel == "Básica")
                    $importe = "9";
                else if ($nivel == "Superior")
                    $importe = "13";
            }
            else if ($modalidad == "Teleformación")
                $importe = "7.50";
            else if ($modalidad == "A Distancia")
                $importe = "5.50";

            break;

        case ($plantillamedia >= 10 && $plantillamedia <= 49 ):

            if ($modalidad == "Presencial") {
                if ($nivel == "Básica")
                    $importe = "9";
                else if ($nivel == "Superior")
                    $importe = "13";
            }
            else if ($modalidad == "Teleformación")
                $importe = "7.50";
            else if ($modalidad == "A Distancia")
                $importe = "5.50";

            break;

        case ($plantillamedia < 10 ):

            if ($modalidad == "Presencial") {
                if ($nivel == "Básica")
                    $importe = "9";
                else if ($nivel == "Superior")
                    $importe = "13";
            }
            else if ($modalidad == "Teleformación")
                $importe = "7.5";
            else if ($modalidad == "A Distancia")
                $importe = "5.5";

            break;

        default:
            $importe = "";
        break;

    }

    // echo "importe:".$importe;
    // return $max_bonificable = $importe .'*'. $horastotales .'*'. $nalumnos[0];
    return $max_bonificable = $importe * $horastotales * $nalumnos[0]; // numero de participantes, 1 * matricula

}

?>