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

include_once './funciones.php';

$id_mat = $_GET['id_matricula'];
$id_alu = $_GET['id_alumno'];


$q = 'SELECT d.* FROM docentes d, mat_doc md 
WHERE md.id_docente = d.id 
AND md.id_matricula = '.$id_mat;
$q = mysqli_query($link, $q);

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

$q = mysqli_query($link, $q);

	echo '
	<h3>Acción</h3>
	<table class="table table-striped">
			<thead>
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
	
$q = 'SELECT a.id AS id_alumno, a.nombre, a.apellido, a.apellido2, a.email, a.telefono, m.*, ac.*, ga.ngrupo, m.id as id_matricula, mp.progreso
FROM mat_alu_cta_emp mp, matriculas m, alumnos a, grupos_acciones ga, acciones ac 
WHERE mp.id_matricula = m.id
AND mp.id_alumno = a.id
AND m.id_accion = ac.id 
AND m.id_grupo = ga.id 
AND m.id = '.$id_mat;

$q = mysqli_query($link, $q);

			while ($row = mysqli_fetch_array($q)) { 

				echo '<h3>Alumno</h3>
				<table class="table table-striped">
						<thead>
							<tr> 
								<th>Alumno</th>
								<th>Email</th>					
								<th>Teléfono</th>
								<th>Teléfono Trabajo</th>
								<th>Progreso</th>
							</tr>
						</thead>
						<tbody>';

				echo '<tr>';
				echo '<td>'.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'</td>';
				echo '<td>'.$row[email].'</td>';
				echo '<td>'.$row[telefono].'</td>';
				echo '<td>'.$row[telefono2].'</td>';
				echo '<td>'.$row[progreso].'</td>';
				echo '</tr>';

				   echo '</tbody>
				</table>';

				$qc = 'SELECT c.* FROM contactos_tutorias c
				WHERE c.id_matricula = '.$id_mat.' AND c.id_alumno = '.$row[id_alumno].'
				ORDER BY numcontacto ASC';
				// echo $q;
				$qc = mysqli_query($link, $qc);


				echo '<h3>Contactos</h3>
					<table class="table table-striped">
							<thead>
								<tr> 
									<th>Nº</th>
									<th>Fecha</th>	
									<th>Tipo Contacto</th>					
									<th>Contenido</th>
									<th>Respuesta</th>
								</tr>
							</thead>
							<tbody>';

							while ($rowc = mysqli_fetch_array($qc)) { 
								echo '<tr>';
								echo '<td>'.$rowc[numcontacto].'</td>';
								echo '<td style="width: 15%">'.date("d/m/Y H:i",strtotime($rowc[fechacontacto])).'</td>';
								echo '<td>'.$rowc[tipocontacto].'</td>';
								echo '<td>'.$rowc[contenido].'</td>';
								echo '<td>'.$rowc[respuesta].'</td>';				
								echo '</tr>';
							}

					   echo '</tbody>
					</table>';

			}

echo '</div>';
	   


		



?>