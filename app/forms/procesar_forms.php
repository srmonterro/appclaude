<?

include_once '../functions/funciones.php';

// si viene con $_POST[id] es UPDATE!

// print_r($_POST['empresasmulti']);

$tabla = $_POST['tabla'];
unset($_POST['tabla']);


if (isset($_POST['matricula'])) {

	$matricula = $_POST['matricula'];
	unset($_POST['matricula']);
}

$valores = array();

foreach ($_POST as $clave => $valor)
	$valores[$clave] = $valor;

// print_r($valores['empresasmulti']);


if ($matricula == '1') {

	matricular($_POST, $link);

} else {

	if ($valores[id] != "") {

		// echo "entra";
		actualizar($tabla, $valores, $link);

	} else {

		if (isset($valores[values])) {

			for ($i = 0; $i < sizeof($_POST[values]); $i++) {
			 	$datosEmpresa[$_POST[values][$i][name]] = $_POST[values][$i][value];
			}

			$tabla = $datosEmpresa['tabla'];
			unset($datosEmpresa['tabla']);
			print_r($datosEmpresa);
			$id = insertar($tabla, $datosEmpresa, $link);
			print_r($valores[contactos]);
			if ( $valores['contactos'] != "" || isset($valores['contactos']) )
				insertarContactos ($id, $valores['contactos'], $link);

		} else
			insertar($tabla, $valores, $link);
	}
}

?>