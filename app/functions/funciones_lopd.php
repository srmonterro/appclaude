<?php

if (isset($_POST['prueba'])) {

	/*echo 'llego';*/

	$listaUsuarios = json_decode($_POST['listado']);

	echo $listadoUsuarios;

	/*var_dump($listaUsuarios);*/

	/*foreach ($listaUsuarios as $key => $value) {
		echo $key.': '.$value;
	}*/

	/*for ($i=0; $i < count($listaUsuarios); $i++) {

		echo $listaUsuarios[i];

	}*/

}

/*Crea una opcion de radiobutton de si o no con el nombre que recibe por parametro.*/
function opcionesRadio($name){

	echo '<label class="radio-inline"><input type="radio" name="'.$name.'" value="Si">Si</label>';
	echo '<label class="radio-inline"><input type="radio" name="'.$name.'" value="No">No</label>';

}

?>