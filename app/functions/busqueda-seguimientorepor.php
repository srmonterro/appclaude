<?

include './funciones.php';
$anio = devuelveAnioReal();

// $facturado_a = ' AND f.empresa = e.id ';
    $i = 0;
 foreach ($_POST as $key => $value) { 

    // echo $key[bonificado];
    $and = ' AND ';
    // $comercial = ' AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            $i++;

            if ( $key == 'mes' ) {
                $in = ' AND fecha >= "'.$anio.'-'.$value.'-01'.'" AND fecha <= "'.$anio.'-'.$value.'-'.date('t', strtotime($anio.'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }


            if ( $key == 'fecha' ) {
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
            }


            if ($key == 'comercial') {    

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND c.id IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }
            

            $campos .= $fechas.$like.$in;

        }

        
    } 
            


    $q = 'SELECT r.*, c.*, c.nombre as comercial, e.contacto as contactor, e.email as emailr, e.telefono as tlfr, e.empresa as empresa
    FROM reportescomerciales r, comerciales c, empresas_reportes e
    WHERE c.id = r.id_comercial
    AND e.id = r.id_empresa
    '.$campos;
    // echo $q;
    $q = mysqli_query($link, $q) or die(mysqli_error($link));

    
    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th>Tipo Contacto</th>                        
                        <th>Fecha Inserción</th>
                        <th>Fecha Contacto</th>
                        <th>Prox. Contacto</th>
                        <th>Comercial</th>
                        <th>Empresa</th>                                
                        <th>Proyecto/Formación</th>
                        <th>Prioridad</th>                        
                        <th>Observaciones</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {


        $readmore = '... <a style="font-size: 11px;" id="obscuest" style="cursor:pointer" obs="'.$row[observaciones].'">Leer más</a>';
        $datosempresa = '<a id="datosempresarepor" style="cursor:pointer" empresa="'.$row[empresa].'" contacto="'.$row[contactor].'" email="'.$row[emailr].'" tlf="'.$row[tlfr].'">'.$row[empresa].'</a>';
        // if (strpos($row[respuesta], 'err') !== false) $color = 'danger'; else $color = 'success';
        echo '<tr class="'.$color.'">';
        echo '<td>'.$row[tipocontacto].'</td>';
        echo '<td>'.date("d/m/Y H:i:s", strtotime($row['fechainsercion'])-3600).'</td>';
        echo '<td>'.formateaFecha($row[fecha]).'</td>';
        echo '<td>'.formateaFecha($row[procontacto]).'</td>';
        echo '<td>'.$row[comercial].'</td>';
        echo '<td>'.$datosempresa.'</td>';
        echo '<td>'.$row[formacion].'</td>';
        echo '<td>'.$row[prioridad].'</td>';
        echo '<td style=";word-wrap: break-word">'.substr($row[observaciones],0, 10);
            if ( $row[observaciones] != "" ) echo $readmore;
        echo '</td>';
        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

