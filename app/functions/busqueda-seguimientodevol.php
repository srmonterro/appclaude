<?

include './funciones.php';


$facturado_a = ' AND f.empresa = e.id ';
    $i = 0;
 foreach ($_POST as $key => $value) { 

    // echo $key[bonificado];
    
    $comercial = ' AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';


        if ( $value != "" ) {

            // if ($i>=3)          
            //     $and = ' AND ';
            // $i++;

            // echo $key;
            // echo $i;
            if ($key == 'facturar_a') {    
                // echo "entra";
                $facturado_a = ' AND f.facturar_a = e.id ';
                $fechas = '';
                // $in = ''; $like = ''; $fechas = ''; $grupo = '';
            }

            if ($key == 'bonificado') {

                    if ( $value == 'Cualquiera' ) {

                        $tabla = 'facturacion_bonificada';
                        $tabla1 = 'facturacion_privada';
                        $tabla2 = 'facturacion_rectificativa';
                        $todo = 1;
                        $camporectificar = '<th>Rectificar</th>';
                        $btnrectificar = '<a id="rectificarFactura" tabla="'.$tabla.'" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-edit"></span> </a>'; 

                    } else {

                        $camporectificar = '<th>Rectificar</th>';

                        if ( $value == 'bonificado' ) {
                            $tabla = 'facturacion_bonificada'; 
                        } else if ( $value == 'privado' ) {
                            $tabla = 'facturacion_privada';
                        } else { 
                            $tabla = 'facturacion_rectificativa';
                            $btnrectificar = '';
                            $camporectificar = '';
                    }
                }

                $in = '';
                $like = ''; $fechas = ''; $grupo = '';
            }
             
            if ($key == 'numeroaccion') {
                
                $grupot = split("/", $value);
                $value = $grupot[0];
                if ($grupot[1] != "")
                    $grupo = ' AND ngrupo = '.$grupot[1];
                
                $in = ' AND '.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';

            }

            if ( $key == 'mes_fin' ) {
                $in = ' AND fechafin >= "'.date('Y').'-'.$value.'-01'.'" AND fechafin <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
            }

            if ( $key == 'acumulado' ) { 
                $mes = '01';
                $in = '';
                $like = '';
                $fechas = '';
                $grupo = ''; 
            }

            if ( $key == 'mes_vencimiento' ) {

                    // echo $mes;
                if ($mes != '01') $mes = $value;
                $in = ' AND fecha_vencimiento >= "'.date('Y').'-'.$mes.'-01'.'" AND fecha_vencimiento <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';                    

                $like = '';
                $fechas = '';
                $grupo = '';
            }


            if ( $key == 'estado' ) {
                $in = ' AND f.'.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
            }

            if ($key == 'denominacion') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ($key == 'razonsocial') {
                $like = ' AND '.$key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }
             
            if ($key == 'fechaini') {
                $fechas = ' AND f.fecha >= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = ''; $value = '';
            }
            
            if ($key == 'fechafin') {      
                $fechas = ' AND f.fecha <= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = '';         
                $value = '';
            }     
            if ($key == 'numero') {      

                $todo = 2;
                if ( strpos($value, 'P') !== FALSE ) { 
                    $value = substr($value, 1);
                    $tabla = 'facturacion_privada';
                } else if ( strpos($value, 'R') !== FALSE ) {
                    $value = substr($value, 1);
                    $tabla = 'facturacion_rectificativa';
                } else {
                    $tabla = 'facturacion_bonificada';
                }

                $fechas = '';
                $in = ' AND f.'.$key.' IN '."('".$value."')";
                $like = '';
            }          

            if ($key == 'grupoempresa') {

                $in = ' AND e.grupo IN '."('".$value."') AND e.grupo = g.id";
                $like = '';
                $fechas = '';
                $grupo = '';

            }
            if ($key == 'comercial') {    

                // if ( $_SESSION['user'] == 'isabel' )
                    // $in = ' c.id IN '."('".$value."')";
                // else
                $in = ' AND c.id IN '."('".$value."')";
                $comercial = ' AND ( (m.comercial = c.id AND '.$in.') OR (e.comercial = c.id AND m.comercial IN ("0") ) ) ';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'formapago') {    

                $in = ' AND e.formapago IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'formapago') {    

                $in = ' AND e.formapago IN '."('".$value."')";
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'modalidad') {    

                if ($value == 'Presencial') $value = 'Presencial","Mixta';
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'modalidad') {    

                if ($value == 'Presencial') $value = 'Presencial","Mixta';
                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
                $fechas = '';
                $grupo = '';
            }
            
            if ($key == 'total_factura') {    

                $in = ' AND '.$key.' IN ("'.$value.'")';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            $campos .= $and.$fechas.$like.$in.$grupo;

        }

        
    } 
            



    $q = 'SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        f.cobrado, f.base_facturacion, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, cd.fecha as fechadevol, f.fecha as fechafra, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, cd.devolucion, cd.gasto_devolucion        
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, facturacion_bonificada f, comerciales c, grupos_empresas g, conciliaciones_devolu cd
        WHERE ac.id = m.id_accion
        '.$comercial.' 
        AND ga.id = m.id_grupo 
        AND cd.factura = f.id
        AND f.matricula = m.id 
        '.$facturado_a.' 
        '.$campos.'
        GROUP BY e.id,m.id,numero
        UNION
        SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        f.cobrado, f.base_facturacion, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, cd.fecha as fechadevol, f.fecha as fechafra, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial, f.facturar_a, e.formapago, cd.devolucion, cd.gasto_devolucion        
        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, facturacion_privada f, comerciales c, grupos_empresas g, conciliaciones_devolu cd
        WHERE ac.id = m.id_accion
        '.$comercial.' 
        AND ga.id = m.id_grupo 
        AND cd.factura = f.id
        AND f.matricula = m.id 
        '.$facturado_a.' 
        '.$campos.'
        GROUP BY e.id,m.id,numero
        ORDER BY numero DESC';


    // echo $q;
    $q = mysqli_query($link, $q);


    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>                         
                        <th style="text-align:center">Nº</th> 
                        <th style="text-align:center">Fecha Fra</th>
                        <th style="text-align:center">Fecha Devol.</th>
                        <th style="text-align:center">Grupo</th>     
                        <th style="text-align:center">Denominación</th>     
                        <th style="text-align:center">Empresa</th>     
                        <th style="text-align:center">Comercial</th>                         
                        <th style="text-align:center">Total</th>
                        <th style="text-align:center">Devolución</th>
                        <th style="text-align:center">Gastos Devol.</th>
                        <th style="text-align:center">Vencimiento</th>
                        <th style="text-align:center">Pago</th>
                        <th style="text-align:center">Detalle</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {

        // $id_total_facturas = 'total_facturas';
        // $prefijo = $row[prefijo];
        // if ( $prefijo == 'R' ) $id_total_facturas = '';
        // if ( $row[estado] == 'Rectificada') $id_total_facturas = '';
        // $numero = $row[numero];
        // $numerof = $prefijo.$numero;
        // $empresa = quitaTildesConComas($row[razonsocial]);
        // $nombreFichero = 'facturacion/facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';
        // $nombreFicheroMail = 'facturas/'.$numerof.'_'.$empresa.'_'.$row[numeroaccion].'-'.$row[ngrupo].'.pdf';

        // $titulo = 'Factura acción formativa '.$row[numeroaccion].'/'.$row[ngrupo].' - '.$row[razonsocial].' - '.$row[modalidad];
        // if ( compruebaEnvioEmail($titulo, $link) === 1 ) $esta = 'green'; else $esta = 'red';

        if ( $row[cobrado] > 0 && $row[importe_a_abonar] > 0 ) $row[estado] = 'PendienteAlgo';
        $color = colorFacturas($row[estado]);
        echo '<tr style="font-size:10px" class="'.$color.'">';   
        echo '<td id="id" style="display:none">'.$row[idfac].'</td>';     
        echo '<td id="numero">'.$row[prefijo].$row[numero].'</td>';
        echo '<td id="fecha">'.formateaFecha($row[fechafra]).'</td>';
        echo '<td id="fecha">'.formateaFecha($row[fechadevol]).'</td>';
        echo '<td id="grupo">'.$row[numeroaccion].'/'.$row[ngrupo].'</td>';
        echo '<td id="mat">'.$row[denominacion].'</td>';    
        
        if ($row[facturar_a] != 0) {
            $q4 = 'SELECT e.razonsocial as razonsocialfac, e.cif as ciffac, e.domiciliofiscal, e.domiciliosocial, e.codigopostal, e.poblacion, e.provincia, email_facturas, c.nombre
            FROM empresas e, comerciales c
            WHERE e.comercial = c.id
            AND e.id = '.$row[facturar_a];
            $q4 = mysqli_query($link, $q4);
            $r4 = mysqli_fetch_array($q4);

            echo '<td style="text-align: center">'.$r4[razonsocialfac].'</td>';
            echo '<td style="text-align: center" id="comercial">'.$r4[nombre].'</td>';
        } else {
            echo '<td style="text-align: center">'.$row[razonsocial].'</td>';
            echo '<td style="text-align: center" id="comercial">'.$row[nombrecomercial].'</td>';
        }
        
        echo '<td id="'.$id_total_facturas.'" style="text-align: center">'.$row[total_factura].'</td>';
        echo '<td id="devolucion" style="text-align: center">'.$row[devolucion].'</td>';
        echo '<td id="gasto_devolucion" style="text-align: center">'.$row[gasto_devolucion].'</td>';
        echo '<td id="vencimiento" style="text-align: center">'.formateaFecha($row[fecha_vencimiento]).'</td>';
        echo '<td id="formapago" style="text-align: center">'.$row[formapago].'</td>';
        // echo '<td style="text-align: center">'.$row[base_facturacion].'</td>';
        
        // echo '<td style="text-align: center">'.$row[importe_a_abonar].'</td>';
        
        if ( $prefijo == 'R' ) $tabla = 'facturacion_rectificativa';
        else if ( $prefijo == 'P' ) $tabla = 'facturacion_privada';
        else $tabla = 'facturacion_bonificada';
        echo '<td style="text-align: center"><a id="detalleFacturaDevol" tabla="'.$tabla.'" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';

        echo '</tr>';

    }
    echo '</tbody>
        </table>';



?>

