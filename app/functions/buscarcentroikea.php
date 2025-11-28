<?


    include_once './funciones.php';

    if ( $_POST[centro] != "" )
        $where = ' WHERE tienda LIKE "%'.$centro.'%"';

    $q = 'SELECT c.*
    FROM ikea_tiendas c
    '. $where;
    // echo $q;
    $q = mysqli_query($link, $q);


            
    echo '<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Centro</th>
                    <th>Dirección</th>
                    <th>CP</th>
                    <th>Localidad</th>
                    <th>Provincia</th>
                    <th></th>
                </tr>
            </thead>
            <tbody style="font-size: 11px;">';

    while ( $row = mysqli_fetch_array($q) ) {

        echo '<tr><td id="id" style="display:none;">';
        echo($row[id]);
        echo "</td>";
        echo '<td id="tienda">';
        echo($row[tienda]);
        echo "</td>";
        echo "<td>";
        print($row[direccion]);
        echo "</td>";
        echo "<td>";
        print($row[codigopostal]);
        echo "</td>";
        echo "<td>";
        print($row[poblacion]);
        echo "</td>";
        echo "<td>";
        print($row[provincia]);
        echo "</td>";
        echo '<td><a id="seleccionarcentroikea" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-plus-sign"></span> </a></td></tr>';
    }
    echo '</tbody></table>';

?>
