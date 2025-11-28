<div class="container">
	
	<div class="col-md-12">

		<?
			$anio = devuelveAnioReal();

			if ( $anio == 2014 ) 
				$link = connect2014();
			else
				include_once ('../functions/connect.php');

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechaini >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad NOT IN("A Distancia")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $row = mysqli_fetch_assoc($q);
		    $alumnostotal = $row[alutotal];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechaini >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnospresencial = $row[alupresencial];

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixto
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechaini >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosmixto = $row[alumixto];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechaini >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosonline = $row[aluonline];

		        
		?>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Nº de Alumnos formados al año (Presencial, Online, Mixta).</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">TOTALES <? echo $anio ?></h4>
		</div>

		<!-- List group -->

		<ul class="list-group">
			<li class="list-group-item"><span class="badge"><? echo $alumnostotal ?></span>
    		Número de alumnos formados al año
  			</li>
			<li class="list-group-item"><span class="badge"><? echo $alumnospresencial ?></span>
    		Número de alumnos formados presencial
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosmixto ?></span>
    		Número de alumnos formados mixto
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosonline ?></span>
    		Número de alumnos formados online
  			</li>
		</ul>
	</div>


	</div>
	<div class="col-md-6">

	<?      // FEBRERO


			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad NOT IN("A Distancia")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $row = mysqli_fetch_assoc($q);
		    $alumnostotal = $row[alutotal];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnospresencial = $row[alupresencial];

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixto
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosmixto = $row[alumixto];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosonline = $row[aluonline];

		        
		?>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Nº de Alumnos formados al año (Presencial, Online, Mixta).</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">FEBRERO <? echo $anio ?></h4>
		</div>

		<!-- List group -->

		<ul class="list-group">
			<li class="list-group-item"><span class="badge"><? echo $alumnostotal ?></span>
    		Número de alumnos formados al año
  			</li>
			<li class="list-group-item"><span class="badge"><? echo $alumnospresencial ?></span>
    		Número de alumnos formados presencial
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosmixto ?></span>
    		Número de alumnos formados mixto
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosonline ?></span>
    		Número de alumnos formados online
  			</li>
		</ul>
	</div>

	</div>

	<div class="col-md-6">
	<?      // JUNIO

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad NOT IN("A Distancia")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $row = mysqli_fetch_assoc($q);
		    $alumnostotal = $row[alutotal];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnospresencial = $row[alupresencial];

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixto
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosmixto = $row[alumixto];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosonline = $row[aluonline];

		        
		?>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Nº de Alumnos formados al año (Presencial, Online, Mixta).</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">JUNIO <? echo $anio ?></h4>
		</div>

		<!-- List group -->

		<ul class="list-group">
			<li class="list-group-item"><span class="badge"><? echo $alumnostotal ?></span>
    		Número de alumnos formados al año
  			</li>
			<li class="list-group-item"><span class="badge"><? echo $alumnospresencial ?></span>
    		Número de alumnos formados presencial
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosmixto ?></span>
    		Número de alumnos formados mixto
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosonline ?></span>
    		Número de alumnos formados online
  			</li>
		</ul>
	</div>

	</div>
	<div class="col-md-6">
	<?



		// SEPTIEMBRE

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad NOT IN("A Distancia")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $row = mysqli_fetch_assoc($q);
		    $alumnostotal = $row[alutotal];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnospresencial = $row[alupresencial];

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixto
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosmixto = $row[alumixto];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosonline = $row[aluonline];

		        
		?>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Nº de Alumnos formados al año (Presencial, Online, Mixta).</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">SEPTIEMBRE <? echo $anio ?></h4>
		</div>

		<!-- List group -->

		<ul class="list-group">
			<li class="list-group-item"><span class="badge"><? echo $alumnostotal ?></span>
    		Número de alumnos formados al año
  			</li>
			<li class="list-group-item"><span class="badge"><? echo $alumnospresencial ?></span>
    		Número de alumnos formados presencial
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosmixto ?></span>
    		Número de alumnos formados mixto
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosonline ?></span>
    		Número de alumnos formados online
  			</li>
		</ul>
	</div>
	
	</div>
	<div class="col-md-6">

	<?


	// DICIEMBRE

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alutotal
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad NOT IN("A Distancia")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $row = mysqli_fetch_assoc($q);
		    $alumnostotal = $row[alutotal];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnospresencial = $row[alupresencial];

			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixto
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosmixto = $row[alumixto];

		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    // echo mysqli_num_rows($q);
		    $row = mysqli_fetch_assoc($q);
		    $alumnosonline = $row[aluonline];

		        
		?>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Nº de Alumnos formados al año (Presencial, Online, Mixta).</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">DICIEMBRE <? echo $anio ?></h4>
		</div>

		<!-- List group -->

		<ul class="list-group">
			<li class="list-group-item"><span class="badge"><? echo $alumnostotal ?></span>
    		Número de alumnos formados al año
  			</li>
			<li class="list-group-item"><span class="badge"><? echo $alumnospresencial ?></span>
    		Número de alumnos formados presencial
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosmixto ?></span>
    		Número de alumnos formados mixto
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo $alumnosonline ?></span>
    		Número de alumnos formados online
  			</li>
		</ul>
	</div>

	</div>

	<div class="col-md-12">

	<?

			// TOTAL MEDIAS
			$suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[alupresencial];
		    }
		    // echo "<br>".$suma."<br>";
		    $mediapresencial = $suma / $cuenta;

		    // $alumnospresencial = $row[alupresencial];
		    // $mediapresencial = array_sum($alumnospresencial) / count($alumnospresencial); 
		    // echo $mediapresencial;

		    $suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[aluonline];
		    }
		    $mediaonline = $suma / $cuenta;

		    $suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixta
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {	
		    	$suma += $row[alumixta];
		    }
		    $mediamixta = $suma / $cuenta;
		    // echo $mediamixta;


		        
		?>


					<div class="clearfix"></div>

		<br><HR><br>
		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Media de alumnos por curso Presencial, Online y Mixta.</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">TOTALES <? echo $anio ?></h4>
		</div>
		<ul class="list-group">

			<li class="list-group-item"><span class="badge"><? echo round($mediapresencial) ?></span>
    		Media de alumnos por curso Presencial
  			</li>
			<li class="list-group-item"><span class="badge"><? echo round($mediaonline) ?></span>
    		Media de alumnos por curso Online
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo round($mediamixta) ?></span>
    		Media de alumnos por curso Mixta
  			</li>
		</ul>
	</div>

	</div>



	<div class="col-md-6">

	<?

			// FEBRERO MEDIAS
			$suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[alupresencial];
		    }
		    $mediapresencial = $suma / $cuenta;
		    // $alumnospresencial = $row[alupresencial];
		    // $mediapresencial = array_sum($alumnospresencial) / count($alumnospresencial); 
		    // echo $mediapresencial;

		    $suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[aluonline];
		    }
		    $mediaonline = $suma / $cuenta;

		    $suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixta
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-02-28"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {	
		    	$suma += $row[alumixta];
		    }
		    $mediamixta = $suma / $cuenta;
		    // echo $mediamixta;


		        
		?>

		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Media de alumnos por curso Presencial, Online y Mixta.</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">FEBRERO <? echo $anio ?></h4>
		</div>
		<ul class="list-group">

			<li class="list-group-item"><span class="badge"><? echo round($mediapresencial) ?></span>
    		Media de alumnos por curso Presencial
  			</li>
			<li class="list-group-item"><span class="badge"><? echo round($mediaonline) ?></span>
    		Media de alumnos por curso Online
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo round($mediamixta) ?></span>
    		Media de alumnos por curso Mixta
  			</li>
		</ul>
	</div>

	</div>
	<div class="col-md-6">

		<?

			// JUNIO MEDIAS

			$suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[alupresencial];
		    }
		    $mediapresencial = $suma / $cuenta;
		    // $alumnospresencial = $row[alupresencial];
		    // $mediapresencial = array_sum($alumnospresencial) / count($alumnospresencial); 
		    // echo $mediapresencial;

		    $suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[aluonline];
		    }
		    $mediaonline = $suma / $cuenta;

		    $suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixta
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-06-30"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {	
		    	$suma += $row[alumixta];
		    }
		    $mediamixta = $suma / $cuenta;
		    // echo $mediamixta;


		        
		?>

		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Media de alumnos por curso Presencial, Online y Mixta.</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">JUNIO <? echo $anio ?></h4>
		</div>
		<ul class="list-group">

			<li class="list-group-item"><span class="badge"><? echo round($mediapresencial) ?></span>
    		Media de alumnos por curso Presencial
  			</li>
			<li class="list-group-item"><span class="badge"><? echo round($mediaonline) ?></span>
    		Media de alumnos por curso Online
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo round($mediamixta) ?></span>
    		Media de alumnos por curso Mixta
  			</li>
		</ul>
	</div>


	</div>
	<div class="col-md-6">
		<?

			// SEPTIEMBRE MEDIAS

			$suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[alupresencial];
		    }
		    $mediapresencial = $suma / $cuenta;
		    // $alumnospresencial = $row[alupresencial];
		    // $mediapresencial = array_sum($alumnospresencial) / count($alumnospresencial); 
		    // echo $mediapresencial;

		    $suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[aluonline];
		    }
		    $mediaonline = $suma / $cuenta;

		    $suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixta
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-09-30"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {	
		    	$suma += $row[alumixta];
		    }
		    $mediamixta = $suma / $cuenta;
		    // echo $mediamixta;


		        
		?>

		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Media de alumnos por curso Presencial, Online y Mixta.</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">SEPTIEMBRE <? echo $anio ?></h4>
		</div>
		<ul class="list-group">

			<li class="list-group-item"><span class="badge"><? echo round($mediapresencial) ?></span>
    		Media de alumnos por curso Presencial
  			</li>
			<li class="list-group-item"><span class="badge"><? echo round($mediaonline) ?></span>
    		Media de alumnos por curso Online
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo round($mediamixta) ?></span>
    		Media de alumnos por curso Mixta
  			</li>
		</ul>
	</div>

	</div>
	<div class="col-md-6">

		<?

			// DICIEMBRE MEDIAS
			$suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alupresencial
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Presencial")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[alupresencial];
		    }
		    $mediapresencial = $suma / $cuenta;
		    // $alumnospresencial = $row[alupresencial];
		    // $mediapresencial = array_sum($alumnospresencial) / count($alumnospresencial); 
		    // echo $mediapresencial;

		    $suma = 0;
			$q = 'SELECT DISTINCT COUNT(ma.id_alumno) as aluonline
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Teleformación")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {		    	
		    	$suma += $row[aluonline];
		    }
		    $mediaonline = $suma / $cuenta;

		    $suma = 0;
		    $q = 'SELECT DISTINCT COUNT(ma.id_alumno) as alumixta
			FROM mat_alu_cta_emp ma, matriculas m, alumnos a, acciones ac
			WHERE ma.id_alumno = a.id
			AND m.id = ma.id_matricula
			AND m.id_accion = ac.id
			AND m.fechafin >= "'.$anio.'-01-01" AND m.fechafin <= "'.$anio.'-12-31"
			AND modalidad IN("Mixta")
			AND m.estado NOT IN ("Anulada")
			GROUP BY m.id';
		    $q = mysqli_query($link, $q) or die("error".mysqli_error($link));

		    $cuenta = mysqli_num_rows($q);
		    // echo $cuenta;
		    while ( $row = mysqli_fetch_array($q) ) {	
		    	$suma += $row[alumixta];
		    }
		    $mediamixta = $suma / $cuenta;
		    // echo $mediamixta;


		        
		?>

		<div class="panel panel-default">
		<!-- Default panel contents -->
		<div class="panel-heading"><strong>Media de alumnos por curso Presencial, Online y Mixta.</strong></div>
		<div class="panel-body">
			<h4 style="text-align: center">DICIEMBRE <? echo $anio ?></h4>
		</div>
		<ul class="list-group">

			<li class="list-group-item"><span class="badge"><? echo round($mediapresencial) ?></span>
    		Media de alumnos por curso Presencial
  			</li>
			<li class="list-group-item"><span class="badge"><? echo round($mediaonline) ?></span>
    		Media de alumnos por curso Online
  			</li>
  			<li class="list-group-item"><span class="badge"><? echo round($mediamixta) ?></span>
    		Media de alumnos por curso Mixta
  			</li>
		</ul>
	</div>

	</div>
	
</div>