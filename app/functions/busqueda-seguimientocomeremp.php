<?

include './funciones.php';
$anio = devuelveAnioReal();

// $facturado_a = ' AND f.empresa = e.id ';
    $i = 0;
 foreach ($_POST as $key => $value) { 

        if ( $value != "" ) {

            $i++;

            if ( $key == 'razonsocial' ) {
                $like = ' AND '.$key.' IN '."('".$value."')";
                $in = '';
                $fechas = '';
            }

        
            $campos .= $fechas.$like.$in;

        }

        
    } 
            


    $q = "SELECT * 
        FROM empresas e, comerciales c
        WHERE c.id = e.comercial"
        .$campos;

    // echo $q;
    $q = mysqli_query($link, $q) or die('error');

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>                         
                        <th style="text-align:center">Nombre Comercial</th> 
                        <th style="text-align:center">Razón Social</th>      
                        <th style="text-align:center">Comercial</th>                                           
                    </tr>
                </thead>
                <tbody>';

    while ( $row = mysqli_fetch_array($q) ) {

        echo '<tr>';
        echo '<td style="text-align:center" id="nombrecomercial">'.$row[nombrecomercial].'</td>';
        echo '<td style="text-align:center" id="razonsocial">'.$row[razonsocial].'</td>';
        echo '<td style="text-align:center" id="comercial">'.$row[nombre].'</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

