<?php

include_once './funciones.php';

$consulta = 'SELECT numero, fecha, tiposol, estado, usuario, observaciones FROM peticiones_gastos';
// $operador = '';

if (isset($_POST['consulta'])) {

	/*Una vez entro en consulta, elimino el valor de consulta
	en el array para dejar solo los valores de los campos.*/
	unset($_POST['consulta']);

	// compruebaCamposForm();

	// /*echo $consulta;*/

	// imprimeTabla($consulta, $link);

}

// function compruebaCamposForm($consulta){

// 	// global $consulta;

	if (!empty($_POST)) {

		foreach ($_POST as $key => $value) {

			//Separo el nombre de campo con la accion.
			$keys = explode('-', $key);

			if($value != ""){

				if ($contador == 0) {
					$where .= ' WHERE ';
					$contador++;
				}else if ($contador == 1) {
					$where = '';
					$and = ' AND ';
				}else{
					$and = '';
				}

				if ($keys[1] == 'in') {

					$operador = " IN ('".$value."')";

				} else if($keys[1] == 'like'){

					$operador = " LIKE '%".$value."%'";

				}

				$consulta .= $where.$and.$keys[0].$operador;

			}

		}

		$consulta .= ' ORDER BY estado';

	}

	
// echo
// }

//Imprime la consulta en una tabla y la devuelve a la funcion ajax.
// function imprimeTabla($consulta, $link){

// 	// global $link;

	echo $consulta;
	
	$resultado_consulta = mysqli_query($link, $consulta) or die("error select: ".mysqli_error($link));

	while ($row = mysqli_fetch_assoc($resultado_consulta)) {

		$resul[] = $row;

	// echo 'Llega ';
	}

	$nombres_columnas = array();

	$registro = mysqli_fetch_fields($resultado_consulta);

	foreach ($registro as $columna) {
		$nombres_columnas[] = $columna->name;
		// echo 'Llega 2 ';
	}

	$resul = arrayTable($nombres_columnas, $resul, true, true, '', '');

	echo json_encode($resul);

// }



?>