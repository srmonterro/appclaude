<?

	include './funciones.php';

	if ( isset($_POST[modalidad]) )
		$modalidad = ' AND modalidad IN ('.$_POST[modalidad].') ';

	if ( $_POST[tipo] == 'Inicio' )
		$fecha = 'm.fechaini';
	else
		$fecha = 'm.fechafin';

    if ( isset($_POST[denominaciones]) && $_POST[denominaciones] == 1 )
        $denominacion = '-'.$row[denominacion];

    if (($_POST[mes]==1 || $_POST[mes]==3) && ($_POST[mes]==5 || $_POST[mes]==7) && ($_POST[mes]==8 || $_POST[mes]==10) && ($_POST[mes]==12))
    {
	    $q = 'SELECT '.$fecha.' as fecha, a.numeroaccion, ga.ngrupo, a.denominacion
        FROM matriculas m, grupos_acciones ga, acciones a
        WHERE m.id_grupo = ga.id
        AND m.id_accion = a.id
        AND m.estado NOT IN("Anulada") 
        AND '.$fecha.' >= "'. date('Y').'-'.$_POST[mes].'-01" AND '.$fecha.' <= "'. date('Y').'-'.$_POST[mes].'-31"
        '.$modalidad;}

    elseif ($_POST[mes]==2){
        $q = 'SELECT '.$fecha.' as fecha, a.numeroaccion, ga.ngrupo, a.denominacion
        FROM matriculas m, grupos_acciones ga, acciones a
        WHERE m.id_grupo = ga.id
        AND m.id_accion = a.id
        AND m.estado NOT IN("Anulada") 
        AND '.$fecha.' >= "'. date('Y').'-'.$_POST[mes].'-01" AND '.$fecha.' <= "'. date('Y').'-'.$_POST[mes].'-28"
        '.$modalidad;}
    else {
        $q = 'SELECT '.$fecha.' as fecha, a.numeroaccion, ga.ngrupo, a.denominacion
        FROM matriculas m, grupos_acciones ga, acciones a
        WHERE m.id_grupo = ga.id
        AND m.id_accion = a.id
        AND m.estado NOT IN("Anulada") 
        AND '.$fecha.' >= "'. date('Y').'-'.$_POST[mes].'-01" AND '.$fecha.' <= "'. date('Y').'-'.$_POST[mes].'-30"
        '.$modalidad;}
     //echo $q;
    $q = mysqli_query($link, $q) or die("error:" .mysqli_error($link));

    $i = 0;
    $fechasd = array();
    while ( $row = mysqli_fetch_assoc($q) ) {

        if ( isset($_POST[denominaciones]) && $_POST[denominaciones] == 1 )
            $denominacion = '-'.$row[denominacion];

        $fechas[title] = $row[numeroaccion].'/'.$row[ngrupo].$denominacion;
        $fechas[start] = $row[fecha];

        array_push($fechasd, $fechas);
        
    }

    echo json_encode($fechasd);

?>