<?

include './funciones.php';

$gestion = devuelveAnio();

if ( $_POST['regeneral'] == '1' )
	mostrarRegGeneral($link);
else if ( $_POST['prevcertificado'] == '1' )
	previoCertificado($_POST['id_matricula'], $link);
else
	mostrarRegDias($dia, $link);



function previoCertificado($id_matricula, $link) {

	echo '
	<div style="margin: 20px 0px 0px 15px;" class="col-md-12">
		<a id="todoscert" name="'. $id_matricula .'" class="btn btn-danger"><span class="glyphicon glyphicon-list-alt"></span> Todos los certificados</a>
	</div>';

	$q = 'SELECT @id_emp:=e.id, e.razonsocial, e.cif, e.id,

    (SELECT count(*)
    FROM mat_alu_cta_emp ma
    WHERE ma.id_matricula = '.$id_matricula.'
    AND ma.id_empresa = @id_emp) as nalumnos

    FROM empresas e, mat_alu_cta_emp ma
    WHERE ma.id_empresa = e.id
    AND ma.id_matricula = '.$id_matricula.'
    GROUP BY ma.id_empresa';
    // echo $q;
    $q = mysqli_query($link, $q);


    while ( $row = mysqli_fetch_array($q) ) {

        echo '
        <div style="margin: 15px 0px 20px 0px; overflow: auto" class="col-md-12">
            <div class="col-md-8">
                <div class="form-group">
                    <label class="control-label" for="razonsocial">Empresa:</label>
                    <input value="'. $row[razonsocial] .'" type="text" id="razonsocial" name="razonsocial" class="form-control" disabled />
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label class="control-label" for="nalumnos">Nº Alumnos:</label>
                    <input value="'. $row[nalumnos] .'" type="text" id="nalumnos" name="nalumnos" class="form-control" disabled />
                </div>
            </div>
            <div style="margin-top: 25px" class="col-md-2">
                <a style="width: 100%; font-size: 12px" id="cert-empresa" name="'. $row[id] .'" class="btn btn-danger"><span class="glyphicon glyphicon-bookmark"></span> Certificado</a>
            </div>
        </div>';

    }

}

function mostrarRegGeneral($link) {

	// SOLO SE VAN A MOSTRAR LAS FINALIZADAS PORQUE INVOLUCRO LA TABLA MAT_ALU_CTA_EMP

	if ( $gestion == 2014 ) {

			// SOLO SE VAN A MOSTRAR LAS FINALIZADAS PORQUE INVOLUCRO LA TABLA MAT_ALU_CTA_EMP
		$q = 'SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (17)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		UNION
		SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (18)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		UNION
		SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (1001)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		UNION
		SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (1006)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		UNION
		SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (1017)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		UNION
		SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (1027)
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		ORDER BY fechafin,codiploma';


	} else {

		$q = 'SELECT ac.denominacion, @emp:=mt.id_empresa, @mat:=m.id as mat, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,  ac.nivel_incendios,
		(SELECT CONCAT( LPAD(MIN(mt.codiploma), 5, 0), "-" , LPAD(MAX(mt.codiploma), 5, 0) )
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat
		AND mt.id_empresa = @emp) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.incendios = 1
		AND m.estado NOT IN("Anulada")
		GROUP BY e.razonsocial, ga.ngrupo
		ORDER BY fechafin,codiploma';

	}
	// echo $q;
	$q = mysqli_query($link, $q);


	echo '
	<table class="table table-striped">
			<thead>
				<tr>
					<th style="display:none;">ID</th>
					<th>AF</th>
					<th>Razón Social</th>
					<th>CIF</th>
					<th>Nº Certificado</th>
					<th>Nº Diplomas</th>
					<th>Código</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>';


	while ($row = mysqli_fetch_array($q)) {

			echo '<tr'; if( ($row[numeroaccion].'/'.$row[ngrupo]) != $af )
			echo ' style="border-top: 2px solid #ccc"><td id="id" style="display:none;">';
			echo($row[mat]);
			echo "</td>";
			echo '<td>';
			print($row[numeroaccion].'/'.$row[ngrupo]);
			echo "</td>";
			echo '<td>';
			print($row[razonsocial]);
			echo "</td>";
			echo '<td>';
			echo($row[cif]);
			echo "</td>";
			echo '<td>';
			if ( $gestion == 2014 )
				print(str_pad($row[grupoincendios], 5, "0", STR_PAD_LEFT).'/'.date("Y",strtotime($row[fechafin])).'/'.$row[nivel_incendios] );
			else
				print(str_pad($row[grupoincendios], 5, "0", STR_PAD_LEFT).'/'.date("Y",strtotime($row[fechafin])).'/'.$row[nivel_incendios] );
			echo "</td>";
			echo '<td>';
			print($row[ndiplomas]);
			echo "</td>";
			echo '<td>';
			print(str_pad($row[codiploma], 5, "0", STR_PAD_LEFT));
			echo "</td>";
			echo '<td>';
			print(date("d/m/Y", strtotime($row[fechafin])));
			echo "</td></tr>";
			// $fechaprev = $row[fechafin];
			$af = $row[numeroaccion].'/'.$row[ngrupo];
	}
	echo '</tbody>
	</table>';

}

function mostrarRegDias($dia, $link) {


	if ( $gestion == 2014 ) {

		$q = 'SELECT ac.denominacion, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas,
		(SELECT CONCAT(MIN(mt.codiploma),"-",MAX(mt.codiploma))
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.numeroaccion IN (17,18,1001,1006,1017,1027)
		AND m.estado NOT IN("Anulada")
		AND m.fechafin IN ("'.$_POST[dia].'")
		GROUP BY e.razonsocial, ga.ngrupo
		ORDER BY m.fechaini';

	} else {

		$q = 'SELECT ac.denominacion, @mat:=m.id, ac.numeroaccion, ga.ngrupo, m.grupoincendios, e.razonsocial, e.cif, m.fechafin, count(*) as ndiplomas, ac.nivel_incendios,
		(SELECT CONCAT(MIN(mt.codiploma),"-",MAX(mt.codiploma))
		FROM mat_alu_cta_emp mt
		WHERE mt.id_matricula = @mat) as codiploma
		FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, mat_alu_cta_emp mt
		WHERE ac.id = m.id_accion
		AND e.id = mt.id_empresa
		AND ga.id = m.id_grupo
		AND m.id = mt.id_matricula
		AND mt.id_empresa = e.id
		AND ac.incendios = 1
		AND m.estado NOT IN("Anulada")
		AND m.fechafin IN ("'.$_POST[dia].'")
		GROUP BY e.razonsocial, ga.ngrupo
		ORDER BY m.fechaini';


	}
	// echo $q;
	$q = mysqli_query($link, $q);


	echo '
	<table class="table table-striped">
			<thead>
				<tr>
					<th style="display:none;">ID</th>
					<th>AF</th>
					<th>Razón Social</th>
					<th>CIF</th>
					<th>Nº Certificado</th>
					<th>Nº Diplomas</th>
					<th>Código</th>
					<th>Fecha</th>
				</tr>
			</thead>
			<tbody>';

	while ($row = mysqli_fetch_array($q)) {

			echo '<tr'; if( $row['fechafin'] != $fechaprev )
			echo ' style="border-top: 2px solid #ccc"><td id="id" style="display:none;">';
			echo($row[id]);
			echo "</td>";
			echo '<td>';
			print($row[numeroaccion].'/'.$row[ngrupo]);
			echo "</td>";
			echo '<td>';
			print($row[razonsocial]);
			echo "</td>";
			echo '<td>';
			echo($row[cif]);
			echo "</td>";
			echo '<td>';
			if ( $gestion == '2014' )
				print(str_pad($row[grupoincendios], 5, "0", STR_PAD_LEFT).'/'.date("Y",strtotime($row[fechafin])).'/'.$row[nivel_incendios] );
			else
				print(str_pad($row[grupoincendios], 5, "0", STR_PAD_LEFT).'/'.date("Y",strtotime($row[fechafin])).'/'.$row[nivel_incendios] );
			echo "</td>";
			echo '<td>';
			print($row[ndiplomas]);
			echo "</td>";
			echo '<td>';
			print(str_pad($row[codiploma], 5, "0", STR_PAD_LEFT));
			echo "</td>";
			echo '<td>';
			print(date("d/m/Y", strtotime($row[fechafin])));
			echo "</td></tr>";
			$fechaprev = $row[fechafin];
	}
	echo '</tbody>
	</table>';

}


?>