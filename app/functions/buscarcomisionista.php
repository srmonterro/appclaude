<table class="table table-striped">
<thead>
<tr>
<th>Tipo</th>
<th>Nombre</th>
<th>Comercial</th>
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
	$q1 = 'SELECT * FROM comisionistas
	WHERE nombre LIKE "%'.$_POST['clave'].'%"';
else
	$q1 = 'SELECT DISTINCT c.* FROM comisionistas c, empresas e
	WHERE e.comisionista = c.id';

//echo $q1;
$q1 = mysqli_query($link,$q1) or die("error". mysqli_error($link));

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td style="display:none" id="id">'.$row[id].'</td>';
	echo('<td>'.$row[tipocomisionista].'</td>');
	echo('<td id="nombre">'.$row[nombre].'</td>');
	echo('<td>'.$row[comercial].'</td>');
	echo '<td><a id="anadircomisionista" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>