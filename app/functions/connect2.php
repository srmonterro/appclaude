<?

   $link = mysqli_connect("formacioaigs2019.mysql.db","formacioaigs2019","Solutions2019","formacioaigs2019");
    echo $link;

    /* check connection */
    if (!$link)  {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_set_charset($link,"utf8");
    return $link;

?>