<table class="table table-striped">
<thead>
<tr>
<th>Tipo</th>
<th>Nombre</th>
<th>CIF</th>
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
	$q1 = 'SELECT * FROM acreedores
	WHERE razonsocial LIKE "%'.$_POST['clave'].'%"';
else
	$q1 = 'SELECT DISTINCT * FROM acreedores';


echo $q1;
$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td style="display:none" id="id">'.$row[id].'</td>';
	echo('<td>'.$row[tipoacreedor].'</td>');
	echo('<td id="nombre">'.$row[razonsocial].'</td>');
	echo('<td>'.$row[cif].'</td>');
	echo '<td><a id="seleccionaracreedorform" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>