<?

include_once './funciones.php';

    if ( $_POST['razonsocial'] == "" ) {

        $q = 'SELECT e.*
        FROM empresas_reportes e';

    } else {

        $q = 'SELECT e.*
        FROM empresas_reportes e 
        WHERE empresa LIKE "%' . $_POST[razonsocial] . '%"';      
    }

    echo $q;
    $q = mysqli_query($link, $q);

    echo '<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Razón Social</th>
                    <th>Contacto</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>';

        while ($row = mysqli_fetch_array($q)) { 
            echo "<tr>";            
            echo '<td style="display:none" id="id">';
            print($row[id]);
            echo "</td>";
            echo '<td id="razonsocial">';
            print($row[empresa]);
            echo "</td>";
            echo '<td>';
            print($row[contacto]);
            echo "</td>";
            echo '<td>';
            print($row[telefono]);
            echo "</td>";
            echo '<td>';
            print($row[email]);
            echo "</td>";
            echo '<td><a id="segseleccionarempresa" href="#" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span> </a></td></tr>';  
        }
        
        echo '</tbody>
        </table>';


?>