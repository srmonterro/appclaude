<?

include_once './funciones.php';

$valores = $_POST['items'];

$coma = ",";
    for ($i=0; $i < count($valores); $i++) { 
        
        if ( $i < count($valores)-1 ) $coma = "";
        $insertar .= '(';
        $insertar .= $valores[$i];
        $insertar .= ')'.$coma;

    }

    $q = 'UPDATE costes_rentabilidad SET detalleotros = "'.$insertar.'" WHERE id = '.$id;
    echo $q."<br>";
    // mysqli_query($link, $q) or die("error");
    echo $insertar;

?>