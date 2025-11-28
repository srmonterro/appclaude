<?

$link = connectExt($anio);

function connectExt($anio) {
	

	$link = mysqli_connect("edukateccxgs".$gestion.".mysql.db","edukateccxgs".$gestion,"Solutions".$gestion,"edukateccxgs".$gestion);}
    //echo $link;

    /* check connection */
    if (!$link)  {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;
}

?>