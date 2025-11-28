<?


include './funciones.php';


if ( $_POST['nombrecomercial'] == "" ) {

        // $q = 'SELECT e.id, cif, razonsocial, ge.grupo, e.vencimiento
        // FROM empresas e, grupos_empresas ge
        // WHERE e.grupo = ge.id';

    } else {

        $q = 'SELECT e.id, cif, nombrecomercial, razonsocial, c.nombre
        FROM empresas e, grupos_empresas ge, comerciales c
        WHERE e.grupo = ge.id 
        AND c.id = e.comercial
        AND nombrecomercial LIKE "%' . $_POST[nombrecomercial] . '%"';      

    }

    $q = mysqli_query($link, $q);

    echo '<table class="table table-striped">
            <thead>
                <tr> 
                    <th style="display:none;">ID</th>
                    <th>Nombre Comercial</th>
                    <th>Razón Social</th>                    
                    <th>Comercial</th>
                </tr>
            </thead>
            <tbody>';

        while ($row = mysqli_fetch_array($q)) { 
            echo "<tr>";            
            echo '<td style="display:none" id="id">';
            print($row[id]);
            echo "</td>";
            echo '<td id="nombrecomercial">';
            print($row[nombrecomercial]);
            echo "</td>";
            echo '<td id="razonsocial">';
            print($row[razonsocial]);
            echo "</td>";
            echo '<td id="comercial">';
            if ( $row[nombre] == 'Marketing' || $row[nombre] == 'Asesoría' )
                $comercial = 'No asignado';
            else
                $comercial = $row[nombre];

            print($comercial);

            echo "</td>";
            echo "</tr>";
        }
        
        echo '</tbody>
        </table>';

?>