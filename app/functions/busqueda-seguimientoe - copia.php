<?

include './funciones.php';
// session_start();

    // unset($_POST['seg-comercial']);
    // unset($_POST['buscarempresa']);

    // $comercial = '( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    // $costesemp1 = '';
    // $costesemp2 = '';
    // $grupo = '';

    $i = 0;
    // print_r($_POST);
    $comercial = ' AND e.comercial NOT IN(8,9)';
    foreach ($_POST as $key => $value) {

        if ( $value != "" ) {

            $and = ' AND ';

            if ($key == 'operador') {
                $op = $value;
                $and = '';
                $in = '';
            }

            if ($key == 'credito') {
                $in = ' AND credito '.$op.$value;
                $like = '';
            }

            if ($key == 'fecha_revision') {
                $in = ' AND e.fecha_revision IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'estado_revision') {
                $in = ' AND e.estado_revision IN '."('".$value."')";
                $like = '';
            }

            if ($key == 'zona') {
                $in = ' JOIN poblaciones p ON e.codigopostal = p.codpostal JOIN zonas z ON p.idzona = z.id AND z.id IN '."('".$value."')";
                $like = '';
                $zona = '';
            }

            if ($key == 'razonsocial') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = '';
            }

            if ($key == 'provincia') {
                $in = ' AND e.'.$key.' IN '."('".$value."')";
                $like = '';

            }

            if ($key == 'poblacion') {
                if ( isset($_POST[zona]) && $_POST[zona] != "" )
                    $in = ' AND p.poblacion IN '."('".$value."')";
                else {
                    $in = ' AND e.poblacion IN '."('".$value."')";
                    $zona = ' JOIN poblaciones p ON e.poblacion = p.poblacion ';
                }
                $like = '';

            }

            if ($key == 'codigopostal') {
                $in = ' AND e.'.$key.' IN '."('".$value."')";
                $like = '';

            }

            if ($key == 'actividad') {
                $in = ' AND e.actividad IN '."('".$value."')";
                $like = '';
                // $in = '';

            }

            if ($key == 'categoria') {
                $in = ' AND e.categoria IN '."('".$value."')";
                $like = '';
                // $in = '';

            }

            if ($key == 'razonsocial') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = '';

            }

            if ($key == 'comercial') {

                // if ( $_SESSION[user] == "oscar" ) {
                //     $in = ' AND c.id NOT IN (1,2)';
                // }
                // else
                $in = ' AND c.id IN '."('".$value."')";

                $like = '';
                // if ( $value == 8 || $value == 9 )
                //     $comercial = '';
            }

            $campos .= $like.$in;

        }

    }

    // $q = 'SELECT DISTINCT e.*, CONCAT(c.nombre," ",c.apellido) as comercial, a.actividad
    // FROM empresas e, comerciales c, actividadestripartita a '.$zona.'
    // WHERE e.comercial = c.id
    // '.$actividad.'
    // '.$campos.$comercial;

    if ( $_SESSION[user] == "oscar" ) {
        $q = 'SELECT DISTINCT e.*, CONCAT(c.nombre," ",c.apellido) as comercial, a.actividad
        FROM empresas e
        LEFT JOIN actividadestripartita a ON a.codigo = e.actividad
        LEFT JOIN categorias_empresa ce ON ce.id = e.categoria
        JOIN comerciales c ON c.id = e.comercial AND c.id NOT IN(2,1) '.$campos.'
        AND e.email <> "" AND e.mailing = 1';
    } else {
        $q = 'SELECT DISTINCT e.*, CONCAT(c.nombre," ",c.apellido) as comercial, a.actividad, ce.categoria as categoria_nombre
        FROM empresas e
        LEFT JOIN actividadestripartita a ON a.codigo = e.actividad
        LEFT JOIN categorias_empresa ce ON ce.id = e.categoria
        JOIN comerciales c ON c.id = e.comercial '.$campos.'
        AND e.email <> "" AND e.mailing = 1';
    }
    // echo $q;
    $q = mysqli_query($link, $q) or die("error". mysqli_error($link));


        echo '<table style="margin-top: 15px;" class="table">
                    <thead>
                        <tr>
                            <th>Nº</th>
                            <th>Nombre Comercial</th>
                            <th>Razón Social</th>
                            <th>Actividad</th>
                            <th>Categoría</th>
                            <th>Email</th>
                            <th>Teléfono</th>
                            <th>Plantilla</th>
                            <th>Crédito</th>
                            <th>Población</th>
                            <th>Comercial</th>
                            <th>Revisión</th>
                            <th>Observaciones</th>
                        </tr>
                    </thead>
                    <tbody>';

        $j = 0;
        $total = mysqli_num_rows($q);
        while ( $row = mysqli_fetch_assoc($q) ) {

            $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[observaciones].'">Leer más</a>';

            $chars = strlen($row[categoria_nombre]);

            if ( $chars > 30 )
                $puntos = ' ...';
            else
                $puntos = '';

            if ( strpos($row[email], ',') !== FALSE ) {

                $emails = explode(',', $row[email]);
                    // print_r($emails);
                for ($i=0; $i < count($emails); $i++) {

                    echo '<tr style="font-size:11px">';
                    echo '<td>'. ++$j .'</td>';
                    if ( $row[nombrecomercial] == "" )
                        echo '<td id="nombrecomercial"></td>';
                    else
                        echo '<td id="nombrecomercial">'.$row[nombrecomercial].'</td>';

                    echo '<td id="razonsocial">'.$row[razonsocial].'</td>';
                    echo '<td>'.$row[actividad].'</td>';
                    echo '<td>'.substr($row[categoria_nombre],0, 30).$puntos.'</td>';
                    echo '<td id="email">'.$emails[$i].'</td>';
                    echo '<td>'.$row[telefono].'</td>';
                    // echo '<td >'.$row[actividad].'</td>';
                    echo '<td>'.$row[plantillamedia].'</td>';
                    echo '<td>'.$row[credito].'</td>';
                    echo '<td style="width: 10%">'.$row[poblacion].'</td>';
                    echo '<td>'.$row[comercial].'</td>';
                    echo '<td>';
                    if ($row[estado_revision] == "Revisada")
                        echo formateaFecha($row[fecha_revision]);
                    else
                        echo "";
                    echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[observaciones],0, 30);
                        if ( $row[observaciones] != "" ) echo $readmore;
                    echo '</td>';
                    echo '</tr>';

                }

            } else {

                echo '<tr style="font-size:11px">';
                echo '<td>'. ++$j .'</td>';
                if ( $row[nombrecomercial] == "" )
                    echo '<td id="nombrecomercial"></td>';
                else
                    echo '<td id="nombrecomercial">'.$row[nombrecomercial].'</td>';
                echo '<td id="razonsocial">'.$row[razonsocial].'</td>';
                echo '<td>'.$row[actividad].'</td>';
                echo '<td>'.substr($row[categoria_nombre],0, 30).$puntos.'</td>';
                echo '<td id="email">'.$row[email].'</td>';
                echo '<td>'.$row[telefono].'</td>';
                // echo '<td >'.$row[actividad].'</td>';
                echo '<td>'.$row[plantillamedia].'</td>';
                echo '<td>'.$row[credito].'</td>';
                echo '<td style="width: 10%">'.$row[poblacion].'</td>';
                echo '<td>'.$row[comercial].'</td>';
                echo '<td>';
                if ($row[estado_revision] == "Revisada")
                    echo formateaFecha($row[fecha_revision]);
                else
                    echo "";
                echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[observaciones],0, 30);
                    if ( $row[observaciones] != "" ) echo $readmore;
                echo '</td>';
                echo '</tr>';

            }

        }

        $qc = 'SELECT c.nombre, c.email
        FROM comerciales c
        WHERE email <> ""
        AND email <> "abenitez@eduka-te.com" 
        AND c.id NOT IN (4, 2, 6, 16) ';
        $qc = mysqli_query($link, $qc) or die("error:" .mysqli_error($link));

        while ( $rowc = mysqli_fetch_array($qc) ) {

            echo '<tr style="font-size:11px">';
            echo '<td>'. ++$j .'</td>';
            echo '<td id="razonsocial">'.$rowc[nombre].' '.$rowc[apellido] .'</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td id="email">'.$rowc[email].'</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td style="width: 10%"></td>';
            echo '<td></td>';
            echo '</tr>';

        }

            echo '<tr style="font-size:11px">';
            echo '<td>'. ++$j .'</td>';
            echo '<td id="razonsocial">Pamela Sepúlveda</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td id="email">psepulveda@eduka-te.com</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td style="width: 10%"></td>';
            echo '<td></td>';
            echo '</tr>';

            /*echo '<tr style="font-size:11px">';
            echo '<td>'. ++$j .'</td>';
            echo '<td id="razonsocial">Shirley González</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td id="email">mchinea@eduka-te.com</td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td></td>';
            echo '<td style="width: 10%"></td>';
            echo '<td></td>';
            echo '</tr>';*/



        echo '</tbody>
        </table>';




?>

