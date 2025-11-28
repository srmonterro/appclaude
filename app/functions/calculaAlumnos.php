<?

include_once './funciones.php';

if ( isset($_POST[comercial]) ) {

	if ( $_POST[comercial] == 3 )
		$comerciales = '3, 7, 10, 12';
	else
		$comerciales = $_POST[comercial];

	$comercialtabla = ', comerciales c, empresas e';
	$comercial = ' AND e.id = ma.id_empresa AND e.comercial = c.id AND e.comercial IN ('.$comerciales.')';

} else {
	$comercialtabla = '';
	$comercial = '';
}


$resul = array();

for ($a=2020; $a <= date('Y'); $a++) {


	$link = connect($a);

	${'alus'.$a} = array();

	for ($i=0; $i < 12; $i++) {

		$j = $i+1;
		$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
		FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac '.$comercialtabla.'
		WHERE ma.id_alumno = a.id
		'. $comercial .'
		AND m.id = ma.id_matricula
		AND m.id_accion = ac.id
		AND ac.modalidad IN ("Presencial","Teleformación")
		AND m.estado IN ("Finalizada", "Facturada","Liquidada", "Gratuita")
		AND m.estado NOT IN ("Anulada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT COUNT(ma.id) as alutotal
		FROM temp_alumnos ma, matriculas m, acciones ac '.$comercialtabla.'
		WHERE m.id = ma.id_matricula
		'. $comercial .'
		AND m.id_accion = ac.id
		AND ac.modalidad IN ("Presencial","Teleformación")
		AND m.estado IN ("Comunicada")
		AND m.estado NOT IN ("Anulada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT COUNT(ma.id) as alutotal
		FROM temp_alumnosp ma, matriculas m, acciones ac '.$comercialtabla.'
		WHERE m.id = ma.id_matricula
		'. $comercial .'
		AND m.id_accion = ac.id
		AND ac.modalidad IN ("Presencial","Teleformación")
		AND m.estado IN ("Comunicada")
		AND m.estado NOT IN ("Anulada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"';
						// echo $q."<br>";
		$q = mysqli_query($link, $q) or die("error" . mysqli_error($link));
		$suma = 0;
		while ($row = mysqli_fetch_array($q)) {
			$suma = $row[alutotal]+$suma;
		}

						// echo $row[alutotal];
		${'alus'.$a}[$i] = $suma;
		// echo $alus2015[0];

		$qx = 'SELECT DISTINCT COUNT(m.id) as mattotal
		FROM matriculas m, acciones ac
		WHERE m.id_accion = ac.id
		AND m.estado NOT IN ("Anulada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"';
						// echo $qx;
		$qx = mysqli_query($link, $qx) or die("error" . mysqli_error($link));
		$rowx = mysqli_fetch_array($qx);

		${'mat'.$a}[$i] = $rowx[mattotal];


		$qy = 'SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND ma.id_alumno = a.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND mc.id_matricula = ma.id_matricula
		AND mc.id_empresa = ma.id_empresa
		AND ma.tipo = "Privado"
		AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
		AND mc.mes_bonificable = 0
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND ma.id_alumno = a.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND mc.id_matricula = ma.id_matricula
		AND mc.id_empresa = ma.id_empresa
		AND ma.tipo = ""
		AND m.estado IN("Finalizada","Gratuita","Facturada","Liquidada")
		AND mc.mes_bonificable <> 0
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT( (presupuesto/(SELECT count(*) FROM ptemp_mat_emp ma WHERE ma.id_matricula = @mat)  ),2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM acciones ac, matriculas m, ptemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND modalidad IN("Presencial", "Mixta")
		AND m.estado IN("Comunicada","Creada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT( (presupuesto/(SELECT count(*) FROM otemp_mat_emp ma WHERE ma.id_matricula = @mat) ),2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM acciones ac, matriculas m, otemp_mat_emp ma, empresas e, grupos_acciones ga, comerciales c
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND m.grupo = 1
		AND modalidad IN("Teleformación","A Distancia")
		AND m.estado IN("Comunicada","Creada")
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND mc.id_matricula = ma.id_matricula
		AND mc.id_empresa = ma.id_empresa
		AND ma.tipo = ""
		AND m.grupo = 0
		AND modalidad IN("Teleformación","A Distancia")
		AND m.estado IN("Comunicada")
		AND mc.mes_bonificable <> 0
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"
		UNION
		SELECT DISTINCT @mat:=m.id, @emp:=e.id, ac.numeroaccion, ac.modalidad, ga.ngrupo, ac.denominacion, m.fechaini, m.fechafin, e.razonsocial, c.nombre as comercial, FORMAT(mc.costes_imparticion,2) as facttotal, m.estado, e.agente, e.iban, e.formapago
		FROM alumnos a, acciones ac, matriculas m, mat_alu_cta_emp ma, empresas e, grupos_acciones ga, comerciales c, mat_costes mc
		WHERE m.id = ma.id_matricula
		AND e.comercial = c.id
		AND ma.id_alumno = a.id
		AND m.id_grupo = ga.id
		AND m.id_accion = ac.id
		AND ma.id_empresa = e.id
		AND mc.id_matricula = ma.id_matricula
		AND mc.id_empresa = ma.id_empresa
		AND ma.tipo = "Privado"
		AND m.grupo = 0
		AND modalidad IN("Teleformación","A Distancia")
		AND m.estado IN("Comunicada")
		AND mc.mes_bonificable = 0
		AND m.fechafin >= "'.$a.'-'.$j.'-01" AND m.fechafin <= "'.$a.'-'.$j.'-31"';
						// echo $qy;
		$qy = mysqli_query($link, $qy) or die("error" . mysqli_error($link));
						// $rowy = mysqli_fetch_array($qy);

						// if ( $rowy[facttotal] == null ) $rowy[facttotal] = 0;

		$suma = 0;
		while ($rowy = mysqli_fetch_array($qy)) {

			if ( $rowy[facttotal] == null ) $rowy[facttotal] = 0;
			$suma = str_replace(',', '', $rowy[facttotal])+$suma;
		}

		${'fac'.$a}[$i] = round($suma, 2);

	}

	//$resul[2014] = $alus2014;
	//$resul[20141] = $mat2014;
	//$resul[20142] = $fac2014;
	$resul[$a] = ${'alus'.$a};
	$resul[$a.'1'] = ${'mat'.$a};
	$resul[$a.'2'] = ${'fac'.$a};

	// print_r($resul);

}


echo json_encode($resul);

?>
