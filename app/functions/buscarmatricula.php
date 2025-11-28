<!--
//**************************************************//
// Autor:       cgutierrez                          //
// Fecha:       03/10/2016                          //
// Descripción: Muestra ventana emergente con listado//
//              de las matrículas	        		//
//**************************************************//
-->
<table class="table table-striped">
<thead>
<tr>
<th>Numero</th>
<th>Acción</th>
<th>Estado</th>
<th>Inicio</th>
<th>Fin</th>
</tr>
</thead>
<tbody>
<?

include_once './funciones.php';

//echo "llega<br>";

if($_POST[clave] != ""){
	$numeroaccion = explode("/",$_POST[clave]);	
}


if ( $_POST[clave] != "" ){
	$q1 = "SELECT m.id, 
		a.numeroaccion, 
		ga.ngrupo,
		a.denominacion,
		m.estado,
		m.fechaini,
		m.fechafin
		FROM matriculas AS m
		INNER JOIN acciones AS a ON m.id_accion = a.id
		INNER JOIN grupos_acciones AS ga on m.id_grupo = ga.id
		WHERE a.numeroaccion = ".$numeroaccion[0]." and ngrupo = ".$numeroaccion[1]."";
		
} else {
	$q1 = "SELECT m.id, 
		a.numeroaccion, 
		ga.ngrupo,		
		a.denominacion,
		m.estado,
		m.fechaini,
		m.fechafin
		FROM matriculas AS m
		INNER JOIN acciones AS a ON m.id_accion = a.id
		INNER JOIN grupos_acciones AS ga on m.id_grupo = ga.id";
}

//if (isroot()) echo "SQL: ".$q1;

//echo "SQL: ".$q1;

$q1 = mysqli_query($link,$q1);

while ($row = mysqli_fetch_assoc($q1)) {
	echo '<tr><td style="display:none" id="id">'.$row[id].'</td>';
	echo('<td id="accion'.$_POST['nuevo'].'">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>');
	echo('<td id="denominacion">'.$row[denominacion].'</td>');
	echo('<td id="estado">'.$row[estado].'</td>');
	echo('<td id="fechaini">'.formateaFecha($row[fechaini]).'</td>');
	echo('<td id="fechafin">'.formateaFecha($row[fechafin]).'</td>');
	echo '<td><a id="seleccionamatriculaform" href="#" class="btn btn-xs btn-primary" nuevo="'.$_POST['nuevo'].'"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
	
}
?>
</tbody>
</table>