<table class="table table-striped">
<thead>
<tr>
<th>Nº</th>
<th>Formación</th>
<th>Modalidad</th>
<th>Lugar</th>
<th>Fechas</th>
</tr>
</thead>
<tbody>
<?

include_once './funciones.php';

if ($_POST[tiposolicitud] == 'IKEA') {
	$tabla = 'ikea_solicitudes';
	$campo = 'denominacion';
	$ik = 'IK';
} else if ($_POST[tiposolicitud] == 'ESFOCC') {
	$tabla = 'peticiones_formativas';
	$campo = 'formacion';
	$ik = 'S';
} else {
	$tabla = 'peticiones_formativas';
	$campo = 'formacion';
	$ik = 'P';
}
// $palabras = explode(' ', $_POST['clave']);
// $q1 = 'SELECT *, MATCH actividad AGAINST("'.$_POST['clave'].'") AS score
// FROM actividadestripartita
// WHERE MATCH actividad AGAINST("'.$_POST['clave'].'")
// ORDER BY score DESC';

if ( $_POST[solicitud] != "" )
	$q1 = 'SELECT DISTINCT * FROM '.$tabla.'
	WHERE ('.$campo.' LIKE "%'.$_POST['solicitud'].'%") OR (numero LIKE "%'.$_POST['solicitud'].'%")';
else
	$q1 = 'SELECT DISTINCT * FROM '.$tabla;

$q1 .= ' ORDER BY id DESC';
$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td style="display:none" id="id">'.$row[id].'</td>';
	echo('<td id="numero">'.$ik.$row[numero].'</td>');
	// echo('<td id="comercial">'.$row[nombrecomercial].'</td>');
	echo('<td id="denominacion">'.$row[$campo].'</td>');
	echo('<td id="modalidad">'.$row[modalidad].'</td>');
	echo('<td id="lugar">'.$row[lugar].'</td>');
	echo('<td id="nombrecentro">'.$row[nombrecentro].'</td>');
	echo('<td style="display:none" id="horaspresenciales">'.$row[horaspresenciales].'</td>');
	echo('<td style="display:none" id="horasdistancia">'.$row[horasdistancia].'</td>');
	echo('<td style="display:none" id="horastotales">'.$row[horastotales].'</td>');
	echo('<td style="display:none" id="fechaini">'.$row[fechaini].'</td>');
	echo('<td style="display:none" id="fechafin">'.$row[fechafin].'</td>');
	echo('<td style="display:none" id="numalumnos">'.$row[numalumnos].'</td>');
	echo('<td style="display:none" id="id_comercial">'.$row[id_comercial].'</td>');
	echo('<td style="display:none" id="presupuesto">'.$row[presupuesto].'</td>');
	echo('<td style="display:none" id="observaciones">'.$row[observaciones].'</td>');
	echo('<td style="display:none" id="tipoformacionpropuesta">'.$row[tipoformacionpropuesta].'</td>');
	echo('<td style="width:20%" id="fechas">'.formateaFecha($row[fechaini]).' - '.formateaFecha($row[fechafin]).'</td>');
	echo '<td><a id="seleccionarsolmat" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';

}
?>
</tbody>
</table>