<?

include_once './funciones.php';
// $link = connect($_SESSION[anio]);

	if (isset($_POST['cp'])) {
		$q1 = 'SELECT codpostal,poblacion FROM poblaciones WHERE codpostal = '. $_POST['cp'];
		$q1 = mysqli_query($link,$q1);
		while ($row = mysqli_fetch_array($q1)) {
			echo '<option value="'.($row[poblacion]).'">'.$row[codpostal].' - '.$row[poblacion].'</option>';
		}
	} else {
		echo '<option>No hay dato</option>';
	}
?>
