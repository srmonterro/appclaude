<?

include './funciones.php';

$i = 0;

$busqNomina = false;
$campos = "";


$tipoBusq = $_POST['opcionFacturacionSeleccionada'];
unset($_POST['opcionFacturacionSeleccionada']);

if ( $tipoBusq == 'Docente' ) {
    $busqNomina = true;
}
// if ( isRoot() ) arrayText($_POST);

foreach ($_POST as $key => $value) {

    // echo $key[bonificado];

    $comercial = ' AND ( (m.comercial = c.id AND m.comercial <> 0) OR (e.comercial = c.id) )';
    // $costes = ' (SELECT SUM(DISTINCT mc.costes_imparticion)
    // FROM mat_costes mc where mc.id_matricula = @idmat) AS coste ';
    $costesemp1 = '';
    $costesemp2 = '';
    $grupo = '';

        if ( $value != "" ) {

            // if ($i>=1)
            //     $and = ' AND ';
            // $i++;

            // echo $key;


            if ( $key == 'mes_vencimiento' ) {

                if ($mes != '01') $mes = $value;
                $anio=date('Y');
                if ($mes == '12') $anio= date('Y')-1;
                $in = ' AND fecha_vencimiento >= "'.$anio.'-'.$mes.'-01'.'" AND fecha_vencimiento <= "'.$anio.'-'.$value.'-'.date('t', strtotime($anio.'/'.$value.'/01')).'"';
                // $in = ' fecha_vencimiento >= "'.date('Y').'-'.$value.'-01'.'" AND fecha_vencimiento <= "'.date('Y').'-'.$value.'-'.date('t', strtotime(date('Y').'/'.$value.'/01')).'"';
                $like = '';
                $fechas = '';
                
                   
            }

            if ( $key == 'estado' ) {
                $in = ' AND f.'.$key.' IN '."('".$value."')";
                $like = '';
                $fechas = '';
            }

            if ($key == 'denominacion') {
                $like = $key.' LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
            }

            if ( $key == 'acumulado' ) {
                $mes = '01';
                $in = '';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'acreedor') {
                $like = ' AND razonsocial LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
                $fechas = '';
            }

            /*if ($key == 'fechaini') {
                $fechas = ' AND f.fecha >= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = ''; $value = '';
            }

            if ($key == 'fechafin') {
                $fechas = ' AND f.fecha <= "'.$value.'"';
                $in = ''; $like = '';
                $grupo = '';
                $value = '';
            }*/

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

            if ($key == 'importe') {

                $value = str_replace(",", ".", $value);
                $in = ' AND '.$key.' = '.$value.'';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            if ($key == 'pendiente') {

                $value = str_replace(",", ".", $value);
                $in = ' AND '.$key.' = '.$value.'';
                $like = '';
                $fechas = '';
                $grupo = '';
            }

            ///cgutierrez: 17/10/2016 solicitado por Vicente
            if ($key == 'tipo') {
                $like = ' AND tipoacreedor LIKE '."'%".$value."%'";
                $in = ''; $grupo = '';
                $fechas = '';
                $fechas = '';
            }

            //EDICION HECHA POR OCTAVIO 16/05/2017

            if ($key == 'id_docente') {
                // $busqNomina = true;
                $like = ' AND f.id_docente = '.$value.'';
                $in = ''; $grupo = '';
                $fechas = '';
                $fechas = '';
            }

            if ($key == 'fecha_inicio') {
                // $busqNomina = true;
                $like = ' AND f.fecha_inicio = \''.$value.'\'';
                $in = ''; $grupo = '';
                $fechas = '';
                $fechas = '';
            }

            if ($key == 'fecha_fin') {
                // $busqNomina = true;
                $like = ' AND f.fecha_fin = \''.$value.'\'';
                $in = ''; $grupo = '';
                $fechas = '';
                $fechas = '';
            }

            if (!$busqNomina) {

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

            }


            //TERMINA EDICION

            $campos .= $fechas.$like.$in.$grupo;

        }

    }

    // if ($todo == 1)

        // $union = ' UNION
        //                 SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        //                 f.cobrado, f.base_facturacion, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial
        //                 FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla1.' f, comerciales c
        //                 WHERE ac.id = m.id_accion
        //                 '.$comercial.'
        //                 AND ga.id = m.id_grupo
        //                 AND f.matricula = m.id
        //                 AND f.empresa = e.id
        //                 AND '.$campos.'
        //                 GROUP BY e.id,m.id
        //                  UNION
        //                 SELECT @idmat:=m.id as mat, ac.modalidad, e.razonsocial, ac.numeroaccion, ga.ngrupo, m.fechaini, m.fechafin, ac.denominacion,
        //                 f.cobrado, f.base_facturacion, f.total_factura, f.importe_a_abonar, f.estado, f.prefijo, f.numero, f.fecha, f.id as idfac, f.fecha_vencimiento, c.nombre as nombrecomercial                        FROM acciones ac, empresas e, grupos_acciones ga, matriculas m, '.$tabla2.' f, comerciales c
        //                 WHERE ac.id = m.id_accion
        //                 '.$comercial.'
        //                 AND ga.id = m.id_grupo
        //                 AND f.matricula = m.id
        //                 AND f.empresa = e.id
        //                 AND '.$campos.'
        //                 GROUP BY e.id,m.id';


    // CONSULTA PARA TIPO FACTURA

    if ( !$busqNomina ) {

        $q = 'SELECT a.razonsocial, a.tipoacreedor, f.*, f.id as idfac
            FROM acreedores a, facturacion_acreedores f
            WHERE f.acreedor = a.id
            '.$campos.'
            ORDER BY id DESC';

    } else {

        $q = 'SELECT d.nombre, d.apellido, d.apellido2, f.*, f.id AS idfac FROM facturacion_acreedores f, docentes d WHERE d.id = f.id_docente'.$campos.' ORDER BY id DESC';

    }
    //TODO: CONSULTA PARA TIPO NOMINA

    //PRUEBAS OCTAVIO
    //FUNCIONA POR DOCENTE

    // $camposNomina = array('id_docente', 'mes', 'anio');

    // foreach ($camposNomina as $key => $value) {
        // if (isset($_POST[$value]) && $_POST[$value] != "") {
            // $nomina = true;
    //         $q = 'SELECT d.nombre, d.apellido, d.apellido2, f.* FROM facturacion_acreedores f, docentes d WHERE d.id = f.id_docente'.$campos;
    //     }
    // }

    //TERMINAN PRUEBAS


    if ( $_SESSION[user] == 'root' ){
        echo $q."<br><br>".$campos;
    }

    $q = mysqli_query($link, $q) or die("error consulta acreedores " . mysqli_error($link));

    echo '<table style="margin-top: 15px;" class="table">
                <thead>
                    <tr>
                        <th style="text-align:center">Nº</th>
                        <th style="text-align:center">Fecha</th>
                        <th style="text-align:center">Acreedor</th>
                        <th style="text-align:center">Tipo</th>
                        <th style="text-align:center">Importe</th>
                        <th style="text-align:center">Pagado</th>
                        <th style="text-align:center">Pendiente</th>
                        <th style="text-align:center">Vencimiento</th>
                        <th style="text-align:center">Fecha Vencimiento</th>
                        <th style="text-align:center">Observaciones</th>';
                        //AÑADIDOS OCTAVIO 16/05/2017
                        if($busqNomina){
                            echo '<th style="text-align:center">Docente</th>';
                        }
                    echo '<th style="text-align:center">Detalle</th>
                    </tr>
                </thead>
                <tbody>';

    $i=0;
    while ( $row = mysqli_fetch_assoc($q) ) {
        $readmore = '...<br><a id="obscuest" href="#" obs="'.$row[observaciones].'">Leer más</a>';


        $color = colorFacturas($row[estado]);
        echo '<tr style="font-size:10px" class="'.$color.'">';
        echo '<td style="text-align:center; display:none" id="id">'.$row[idfac].'</td>';
        echo '<td style="text-align:center" id="numero">'.$row[numero].'</td>';

        if($busqNomina){
            echo '<td style="text-align:center" id="fecha">'.formateaFecha($row[fecha_inicio]).' - '.formateaFecha($row[fecha_fin]).'</td>';
            echo '<td style="text-align:center" id="acreedor">'.$row[nombre].' '.$row[apellido].' '.$row[apellido2].'</td>';
            echo '<td style="text-align:center" id="tipoacreedor">Docente</td>';
        }else{
            echo '<td style="text-align:center" id="fecha">'.formateaFecha($row[fecha]).'</td>';
            echo '<td style="text-align:center" id="acreedor">'.$row[razonsocial].'</td>';
            echo '<td style="text-align:center" id="tipoacreedor">'.$row[tipoacreedor].'</td>';
        }

        echo '<td style="text-align:center" id="importe">'.$row[importe].'</td>';
        echo '<td style="text-align:center" id="pagado">'.$row[pagado].'</td>';
        echo '<td style="text-align:center" id="pendiente">'.$row[pendiente].'</td>';
        echo '<td style="text-align:center" >'.$row[vencimiento].'</td>';
        echo '<td style="text-align:center" >'.formateaFecha($row[fecha_vencimiento]).'</td>';
        echo '<td id="observaciones" style="word-wrap: break-word">'.substr($row[observaciones],0, 30);
            if ( $row[observaciones] != "" ) echo $readmore;
        echo '</td>';
        echo '<td id="observacioneslargas" style="display:none;word-wrap: break-word">'.$row[observaciones].'</td>';
        //EDICION HECHA POR OCTAVIO 16/05/2017
        if($busqNomina){
        echo '<td style="text-align:center" id="docente">'.$row[nombre].' '.$row[apellido].'</td>';
        // echo '<td style="text-align:center" id="fechainicio">'.$row[fecha_inicio].'</td>';
        // echo '<td style="text-align:center" id="fechafin">'.$row[fecha_fin].'</td>';
        $nombreDetalle = 'detalleNomina';
        }else{
            $nombreDetalle = 'detalleFacturaAcre';
        }
        echo '<td style="text-align: center"><a id="'.$nombreDetalle.'" tabla="facturacion_bonificada" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';
        //TERMINA EDICION
        /*echo '<td style="text-align: center"><a id="detalleFacturaAcre" tabla="facturacion_bonificada" class="btn btn-xs btn-warning"><span class="glyphicon glyphicon-list-alt"></span> </a></td>';*/
        echo '<td style="text-align: center">
        <a id="borrarFacturaAcre" idfra="'.$row[idfac].'" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove"></span> </a>
        </td>';
        // echo '<td style="text-align: center">'.$row[base_facturacion].'</td>';

        // echo '<td style="text-align: center">'.$row[importe_a_abonar].'</td>';

        echo '</tr>';

    }
    echo '</tbody>
        </table>';

?>