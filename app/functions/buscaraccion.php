<table class="table table-striped">
<thead>
<tr>
<th>Número</th>
<th>Acción</th>
<th>Modalidad</th>
<th>Horas</th>
</tr>
</thead>
<tbody>
<?

include_once './funciones.php';

// $palabras = explode(' ', $_POST['clave']);
// $q1 = 'SELECT *, MATCH actividad AGAINST("'.$_POST['clave'].'") AS score
// FROM actividadestripartita
// WHERE MATCH actividad AGAINST("'.$_POST['clave'].'")
// ORDER BY score DESC';

// if ( $_POST[clave] != "" )
$q1 = 'SELECT DISTINCT * FROM acciones
	WHERE denominacion LIKE "%'.$_POST['clave'].'%"
	AND numeroaccion <> 0';
// else
// 	$q1 = 'SELECT DISTINCT * FROM acciones
// 	AND numeroaccion NOT IN("3","16","17")
// 	WHERE numeroaccion <> 0';

// echo $q1;
$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td style="display:none" id="id">'.$row[id].'</td>';
	echo('<td id="numeroaccion">'.$row[numeroaccion].'</td>');
	echo('<td id="denominacion">'.$row[denominacion].'</td>');
	echo('<td id="modalidad">'.$row[modalidad].'</td>');
	echo('<td id="horastotales">'.$row[horastotales].'</td>');
	echo('<td style="display:none" id="objetivos">'.$row[objetivos].'</td>');
	echo('<td style="display:none" id="contenidos">'.$row[contenido].'</td>');
	echo '<td><a id="anadiraccion" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';

}
?>
</tbody>
</table>