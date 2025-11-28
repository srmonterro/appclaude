<?php
$enlace = mysqli_connect("formacioaigs2019.mysql.db","formacioaigs2019","Solutions2019","formacioaigs2019");

/* comprobar la conexión */
if (mysqli_connect_errno()) {
    printf("Conexión fallida: %s\n", mysqli_connect_error());
    exit();
}

/* comprobar si el servidor sigue funcionando */
if (mysqli_ping($enlace)) {
    printf ("¡La conexión está bien!\n");
} else {
    printf ("Error: %s\n", mysqli_error($enlace));
}

/* cerrar la conexión */
mysqli_close($enlace);
?>