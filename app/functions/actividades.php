<table class="table table-striped">
<thead>
<tr>
<th>Número</th>
<th>Actividad</th>
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

if ( $_POST[clave] != "" )
	$q1 = 'SELECT * FROM actividadestripartita
	WHERE actividad LIKE "%'.$_POST['clave'].'%"';
else
	$q1 = 'SELECT DISTINCT a.* FROM actividadestripartita a, empresas e
	WHERE e.actividad = a.codigo';


$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td id="codigo">';
	echo($row[codigo]);
	echo "</td>";
	echo "<td>";
	echo($row[actividad]);
	echo "</td>";
	echo '<td><a id="anadiractividad" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>