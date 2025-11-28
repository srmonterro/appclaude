<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Bootstrap -->
	<link href="../css/bootstrap.css" rel="stylesheet">
	<link href="../css/esfocc.css" rel="stylesheet">
</head>

<style>

    td { font-size: 13px; }

</style>

<?

// $_SESSION['anio'] = 2015;

include_once './funciones.php';

$id_mat = $_GET['id_matricula'];

if ( isset( $_GET['id_alumno'] ) ) {
	$individual = ' AND mp.id_alumno = '.$_GET[id_alumno];
}


$q = 'SELECT d.* FROM docentes d, mat_doc md
WHERE md.id_docente = d.id
AND ( md.mixto = "od" OR md.mixto = "" )
AND md.id_matricula = '.$id_mat;

//echo $q;

$q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

echo '<div class="container">';

while ($row = mysqli_fetch_array($q)) {

	echo '<h3 style="text-align: center">Tutor: '.$row[nombre].' '.$row[apellido].'</h3>';

}

$q= 'SELECT DISTINCT a.id AS id_alumno, a.nombre, a.apellido, a.apellido2, a.email, a.telefono, m.*, ac.*, ga.ngrupo, m.id as id_matricula, mp.progreso
FROM mat_alu_cta_emp mp, matriculas m, alumnos a, grupos_acciones ga, acciones ac
WHERE mp.id_matricula = m.id
AND mp.id_alumno = a.id
AND m.id_accion = ac.id
AND m.id_grupo = ga.id
AND m.id = '.$id_mat.'
GROUP BY denominacion';

$q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

	echo '
	<table class="table table-striped">
			<thead>
				<tr><td colspan="5"><h3 style="text-align:center">Datos de la Acción</h3></td>
				<tr>
					<th>Acción/Grupo</th>
					<th>Denominación</th>
					<th>Fecha Inicio</th>
					<th>Fecha Fin</th>
					<th>Horas</th>
				</tr>
			</thead>
			<tbody>';

			while ($row = mysqli_fetch_array($q)) {
				// $id_alu = $row['id_alumno'];
				echo '<tr>';
				echo '<td>'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
				echo '<td>'.$row[denominacion].'</td>';
				echo '<td>'.date("d/m/Y",strtotime($row[fechaini])).'</td>';
				echo '<td>'.date("d/m/Y",strtotime($row[fechafin])).'</td>';
				echo '<td>'.$row[horastotales].'</td>';
				echo '</tr>';
			}

	   echo '</tbody>
	</table>';

// $q = 'SELECT a.id AS id_alumno, a.nombre, a.apellido, a.apellido2, a.email, a.telefono, m.*, ac.*, ga.ngrupo, m.id as id_matricula, mp.progreso
// FROM mat_alu_cta_emp mp, matriculas m, alumnos a, grupos_acciones ga, acciones ac
// WHERE mp.id_matricula = m.id
// AND mp.id_alumno = a.id
// AND m.id_accion = ac.id
// AND m.id_grupo = ga.id
// AND m.id = '.$id_mat;

// $q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

// 	echo '<h3>Alumno</h3>
// 	<table class="table table-striped">
// 			<thead>
// 				<tr>
// 					<th>Alumno</th>
// 					<th>Email</th>
// 					<th>Teléfono</th>
// 					<th>Teléfono Trabajo</th>
// 					<th>Progreso</th>
// 				</tr>
// 			</thead>
// 			<tbody>';

// 			while ($row = mysqli_fetch_array($q)) {
// 				echo '<tr>';
// 				echo '<td>'.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'</td>';
// 				echo '<td>'.$row[email].'</td>';
// 				echo '<td>'.$row[telefono].'</td>';
// 				echo '<td>'.$row[telefono2].'</td>';
// 				echo '<td>'.$row[progreso].'</td>';
// 				echo '</tr>';
// 			}

// 	   echo '</tbody>
// 	</table>';


$q = 'SELECT c.`fechacontacto`, c.tipocontacto, c.contenido, c.respuesta, a.nombre, a.apellido, a.apellido2,  a.email, a.telefono, a.tlftrabajo, a.documento, mp.progreso, mp.progreso2, a.id as id_alumno, finalizado
FROM contactos_tutorias c, alumnos a, mat_alu_cta_emp mp
WHERE a.id = c.id_alumno
AND mp.id_alumno = a.id
AND mp.id_matricula = c.id_matricula
AND c.id_matricula = '.$id_mat.'
AND contenido <> ""
'.$individual.'
ORDER BY nombre, apellido, fechacontacto ASC';
	// echo $q;
$q = mysqli_query($link, $q) or die("error ".mysqli_error($link));

while ($row = mysqli_fetch_array($q)) {

	if ( $row[finalizado] == 1 )
		$row[finalizado] = 'Finalizado';
	else if ( $row[finalizado] == 2 )
		$row[finalizado] = 'NO Finalizado';
	else
		$row[finalizado] = 'En Progreso';

	$i++;
	if ( $row[id_alumno] != $id_alumno_ant || $i == 1 ) {

		echo '
		<table class="table table-striped">
			<thead>
				<tr><td colspan="6"><h3 style="text-align:center">Datos del Alumno</h3></td>
				<tr>
					<th>Alumno</th>
					<th>Email</th>
					<th>Teléfono</th>
					<th>Teléfono Trabajo</th>
					<th>Progreso<br>Contenido</th>
					<th>Progreso<br>Cuestionario</th>
					<th>Estado</th>
				</tr>
			</thead>
			<tbody>';

		echo '<tr>';
				echo '<td>'.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'</td>';
				echo '<td>'.$row[email].'</td>';
				echo '<td>'.$row[telefono].'</td>';
				echo '<td>'.$row[tlftrabajo].'</td>';
				echo '<td>'.$row[progreso].'</td>';
				echo '<td>'.$row[progreso2].'</td>';
				echo '<td>'.$row[finalizado].'</td>';
		echo '</tr>';

		echo '
			<table class="table table-striped">
					<thead>
						<tr><td colspan="4"><h3 style="text-align:center">Contactos</h3></td>
						<tr>
							<th>Fecha</th>
							<th>Tipo Contacto</th>
							<th>Contenido</th>
							<th>Respuesta</th>

						</tr>
					</thead>
					<tbody>';

	}
	echo '<tr>';
	echo '<td style="width: 15%">'.date("d/m/Y H:i",strtotime($row[fechacontacto])).'</td>';
	echo '<td>'.$row[tipocontacto].'</td>';
	echo '<td>'.$row[contenido].'</td>';
	echo '<td>'.$row[respuesta].'</td>';
	echo '</tr>';

	$id_alumno_ant = $row[id_alumno];
}

	   echo '</tbody>
	</table>
	</div>';


?>