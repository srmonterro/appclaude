<table class="table table-striped">
<thead>
<tr>
<th>Número</th>
<th>Nombre Grupo</th>
</tr>
</thead>
<tbody>
<?

include_once './funciones.php';
// $link = connect($_SESSION[anio]);

$palabras = explode(' ', $_POST['clave']);
// $q1 = 'SELECT *,MATCH grupo AGAINST("'.$_POST['clave'].'") AS score
// FROM grupostripartita
// WHERE MATCH grupo AGAINST("'.$_POST['clave'].'")            
// ORDER BY score DESC';
$q1 = 'SELECT * FROM grupostripartita 
WHERE grupo LIKE "%'. $_POST['clave'] .'%" ';
$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td id="codigo">';
	echo($row[codigo]);
	echo "</td>";
	echo "<td>";
	echo($row[grupo]);
	echo "</td>";
	echo '<td><a id="anadirgrupo" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>
