<?

include_once './funciones.php';


if ( $_POST['bonificable'] == 1 ) {

	$q1 = 'SELECT ngrupo FROM grupos_acciones 
	WHERE id IN (SELECT max(id)
	FROM grupos_acciones 
	WHERE id_accion = '.$_POST[id].'
	AND ngrupo NOT LIKE "%p%")';
	$q1 = mysqli_query($link,$q1);
	$id = mysqli_fetch_row($q1);

	if ( is_null($id[0]) )
		echo "1";
	else
		echo $id[0]+1;

} else if ( $_POST['bonificable'] == 0 ) {

	$q1 = 'SELECT ngrupo FROM grupos_acciones 
	WHERE id IN (SELECT max(id)
	FROM grupos_acciones 
	WHERE id_accion = '.$_POST[id].'
	AND ngrupo LIKE "%p%")';
	$q1 = mysqli_query($link,$q1);
	$id = mysqli_fetch_row($q1);
	
	if ( is_null($id[0]) )
		echo "1p";
	else {
		echo ($id[0]+1); echo 'p';	
	}

}



?>