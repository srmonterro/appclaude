<?

	// echo "<pre>";
	// print_r($_POST);
	// echo "</pre>";

	include './funciones.php';

	//$idmat = $_POST['idmat'];

	if ( isset($_POST[valores]) ) {

		$arraypartido = array_chunk($_POST[valores], 2);

		for ($i=0; $i < count($arraypartido); $i++) {
			for ($k=0; $k < count($arraypartido[$i]); $k++) {

				if ( $k != 0 )
					$ini = ',';

				$items .= $ini.'("'.$arraypartido[$i][$k][0].'", "'.$arraypartido[$i][$k][1].'", "'.$arraypartido[$i][$k][2].'", "'.$arraypartido[$i][$k][3].'",  "'.$arraypartido[$i][$k][4].'")';

				echo $items;

				$id_mat = $arraypartido[$i][$k][2];
				$tipo = $arraypartido[$i][$k][4];

				if ( $id_mat != 0 ) {
					$actualizacion = 1;
				}

			}
		}

		if ($actualizacion == 1) {

			$q = "DELETE FROM mat_items_gastos WHERE id_mat = ".$id_mat. " AND tipo_item = ".$tipo;

			$q = mysqli_query($link, $q) or die("error". mysqli_error($link));

		}

		$q = 'INSERT INTO mat_items_gastos(id_item, cantidad, id_mat, id_temp, tipo_item)
				VALUES '.$items;

		echo $q."<br>";

		$q = mysqli_query($link, $q) or die("error ". mysqli_error($link));

	}

	else if ( isset($_POST['fungibles']) ) { // viene de formulario de gastos fungibles

		echo "llega";

		arrayTexT($_POST['fungibles']);

		$q = 'DELETE FROM mat_items_gastos WHERE id_peticion = "'.$_POST['fungibles'][0]['id_peticion'].'"';
		echo $q."<br>";
		$q = mysqli_query($link, $q) or die("error". mysqli_error($link));

		$q = 'INSERT INTO mat_items_gastos(id_item, cantidad, id_solicitud, id_solicitudikea, id_peticion)
				VALUES ';
		foreach ($_POST['fungibles'] as $key => $value) {

			$coma = ', ';
			$i++;
			if ( $i == count($_POST['fungibles']) )
				$coma = '';

			$q .= '( "'.$value['id_item'].'", "'.$value['cantidad'].'", "'.$value['id_solicitud'].'", "'.$value['id_solicitudikea'].'", "'.$value['id_peticion'].'" )'.$coma;
		}

		echo $q."<br>";

		$q = mysqli_query($link, $q) or die("error ". mysqli_error($link));

	} else if ( isset($_POST['viajes']) ) { // viene de formulario de gastos fungibles

		// echo "llega";

		unset($_POST['viajes'][0]);

		$q = 'DELETE FROM peticiones_viajes WHERE id_peticion = "'.$_POST['viajes'][1]['id_peticion'].'"';
		echo $q."<br>";
		$q = mysqli_query($link, $q) or die("error". mysqli_error($link));

		foreach ($_POST['viajes'] as $v => $vi) {

			echo "entra";

			arrayText($_POST['viajes']);
			arrayText($v);

			if ( count($vi) > 0 ) {

				$fields = array_keys($vi);
				$q = "INSERT INTO peticiones_viajes
		        (`".implode('`,`', $fields)."`)
		        VALUES('".implode("','", $vi)."')";
		        echo $q."<br>";

		        $q = mysqli_query($link, $q) or die("error ". mysqli_error($link));

	    	}


		}


	}

?>