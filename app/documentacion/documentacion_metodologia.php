<?
	
	include_once '../functions/funciones.php';
	// $id_docente = $_POST["id_docente"];
	$idmat = $_POST[id_matricula];

    $sql = 'SELECT denominacion,numeroaccion
    FROM acciones a, matriculas m
    WHERE m.id_accion = a.id
    AND m.id = '.$idmat;

    $sql = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($sql);
    $metodologiapdf = 'Metodologia-'.normaliza($row[denominacion]).'-'.$row[numeroaccion].'.pdf';


    $filenamedir = './acciones/'.$metodologiapdf;
    $filename = 'http://gestion.esfocc.com/app/documentacion/acciones/'.$metodologiapdf;

    if ( file_exists($filenamedir) )
        echo $filename;
    else 
        echo 0;




?>