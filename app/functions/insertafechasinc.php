<?

	echo "<pre>";
	print_r($_POST);
	echo "</pre>";

	include './funciones.php';

	$idmat = $_POST[idmat];

	if ( isset($_POST[tipo]) )
		$tipo = ', "'.$_POST[tipo].'"';

	if ( isset($_POST[fechasinc]) ) {

		$arraypartido = array_chunk($_POST[fechasinc], 5);
		// print_r($arraypartido);

		for ($i=0; $i < count($arraypartido); $i++) {
			$fin = ', ';
			$ini = '(';
			$acoma = ',';
			for ($k=0; $k < count($arraypartido[$i]); $k++) {

				if ( $k == count($arraypartido[$i])-1 ) {
					if ( $i == count($arraypartido)-1 )
						$acoma = '';
					$fin = ', '.$idmat.$tipo.')'.$acoma;
				}

				if ( $k != 0 )
					$ini = '';
				$fechas .= $ini.'"'.$arraypartido[$i][$k][value].'"'.$fin;

			}
		}
		// echo "<br>".$fechas."<br>";

		$q = 'INSERT IGNORE INTO `fechas_incluir`(`dia`, `horariomini`, `horariomfin`, `horariotini`, `horariotfin`, `id_matricula`, `tipo`)
		VALUES '.$fechas;
		echo "<br>";
		echo $q;
		echo "<br>";
	    $q = mysqli_query($link, $q) or die("error". mysqli_error($link));

	}

	if ( isset($_POST[fechasincod]) ) {

		$arraypartido = array_chunk($_POST[fechasincod], 5);
		// print_r($arraypartido);

		for ($i=0; $i < count($arraypartido); $i++) {
			$fin = ', ';
			$ini = '(';
			$acoma = ',';
			for ($k=0; $k < count($arraypartido[$i]); $k++) {

				if ( $k == count($arraypartido[$i])-1 ) {
					if ( $i == count($arraypartido)-1 )
						$acoma = '';
					$fin = ', '.$idmat.$tipo.')'.$acoma;
				}

				if ( $k != 0 )
					$ini = '';
				$fechas .= $ini.'"'.$arraypartido[$i][$k][value].'"'.$fin;

			}
		}
		// echo "<br>".$fechas."<br>";

		$q = 'INSERT IGNORE INTO `fechas_incluir`(`dia`, `horariomini`, `horariomfin`, `horariotini`, `horariotfin`, `id_matricula`, `tipo`)
		VALUES '.$fechas;
		echo "<br>";
		echo $q;
		echo "<br>";
	    $q = mysqli_query($link, $q) or die("error". mysqli_error($link));

	}


?>