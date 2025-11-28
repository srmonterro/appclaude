<?

	include('./funciones.php');

		$q = 'SELECT max(numeroaccion) as naccion
	    FROM acciones
	    WHERE tipoformacionac = "'.$_POST[tipo].'"' and' modalidad = "'.$_POST[modalidad].'"';
	   //echo $q;
	    $q = mysqli_query($link, $q);
	    $row = mysqli_fetch_array($q);
	    $naccion = $row[naccion];
		//echo $naccion;
	    $naccion = $naccion+1;

	    if ( $naccion == 1 && $_POST[tipo] == 'Bonificada')
	    	$naccion = substr($gestion, -2)."000";

		
		//if ( $naccion == 1 && $_POST[tipo] == 'Valora' && $gestion == 2023)
		//	$naccion = 8000;
		if ( $naccion == 1 && $_POST[tipo] == 'Valora')
			$naccion = 1;
		if ( $naccion == 1 && $_POST[tipo] == 'Nordotel')
			$naccion = substr($gestion, -2)."0000";
		//if ( $naccion == 1 && $_POST[tipo] == 'Dinosol')
			//$naccion = 7000;
		//if ( $naccion == 1 && $_POST[tipo] == 'Privado')
	    	//$naccion = 2000;
		//$naccion = $naccion+1;

	echo $naccion;

?>