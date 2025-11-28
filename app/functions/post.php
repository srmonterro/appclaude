<?

$link = connect();
// // echo $link;
guardarDatos($_POST, $link);
// echo "hola";

function guardarDatos($valores, $link) {

	$q = "INSERT INTO datos
	(`".implode('`,`', array_keys($valores))."`)
	VALUES('".implode("','", $valores)."')";
	echo $q;
	$q = mysqli_query($link, $q) or die("error insert : " .mysqli_error($link));
    
}



function connect() {

    $link = mysqli_connect("localhost","mycharlasc","NFbUAuTh","formulario");

    /* check connection */
    if (!$link)  {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}



?>