<?

include_once './funciones.php';
// $link = connect($_SESSION[anio]);

	if (isset($_POST['cp'])) {
		$q1 = 'SELECT DISTINCT provincia FROM provincias,poblaciones WHERE poblaciones.id_provincia = provincias.id_provincia AND poblaciones.codpostal = '. $_POST['cp'];
		$q1 = mysqli_query($link,$q1);
		while ($row = mysqli_fetch_array($q1)) {
			echo '<option value="'.$row[provincia].'">'.$row[provincia].'</option>';
		}
	} else {
		echo '<option>No hay datos</option>';
	}
?>