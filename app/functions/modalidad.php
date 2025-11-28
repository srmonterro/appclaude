<?

	include('./funciones.php');

		$q = 'SELECT max(numeroaccion) as naccion
	    FROM acciones
	    WHERE modalidad = "'.$_POST[modalidad].'" and tipoformacionac = "'.$_POST[tipo].'"';
	    //echo $q;
	    $q = mysqli_query($link, $q);
	    $row = mysqli_fetch_array($q);
	    $naccion = $row[naccion];
	    $naccion = $naccion+1;

	    if ( $naccion == 1 && $_POST[modalidad] == 'Presencial')
	    	$naccion = substr($gestion, -2)."000";
			
		//if ( $naccion == 1 && $_POST[modalidad] == 'Mixta')
			//$naccion = 1;
		//if ( $naccion == 1 && $_POST[tipo] == 'Cervecera')
			//$naccion = 6000;
		//if ( $naccion == 1 && $_POST[tipo] == 'Dinosol')
			//$naccion = 7000;
		if ( $naccion == 1 && $_POST[modalidad] == 'Teleformación')
	    	$naccion = substr($gestion, -2)."500";

	echo $naccion;

?>