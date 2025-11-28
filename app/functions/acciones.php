<table class="table table-striped">
<thead>
<tr>
<th>Id</th>
<th>Número</th>
<th>Denominación</th>
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
	$q1 = 'SELECT a.* FROM acciones AS a INNER JOIN grupos_acciones AS g ON a.id = g.id_accion
	WHERE a.denominacion LIKE "%'.$_POST['clave'].'%"';
else
	$q1 = 'SELECT DISTINCT a.* FROM acciones AS a INNER JOIN grupos_acciones AS g ON a.id = g.id_accion';


$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td id="numero">';
	echo($row[id]);
	echo "</td>";
	echo "<td>";
	echo($row[numero]);
	echo "</td>";
	echo "<td>";
	echo($row[denominacion]);
	echo "</td>";
	echo '<td><a id="anadiractividad" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>